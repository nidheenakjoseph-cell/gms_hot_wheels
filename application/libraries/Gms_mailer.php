<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gms_mailer — Centralized SMTP mailer for GMS
 *
 * Features:
 *  - Loads per-company SMTP credentials from `company_smtp_settings` table
 *  - Fetches email templates by key from `email_templates`
 *  - Replaces dynamic placeholders in subject & body
 *  - Supports optional file attachments
 *  - Provides a test_connection() method for SMTP credential validation
 */
class Gms_mailer
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->config->load('email');
        $this->CI->load->library('email');
    }

    /**
     * Configure CI email library with company-specific SMTP settings.
     *
     * @param  int    $company_id  Company whose SMTP credentials to load
     * @return bool   TRUE if SMTP row found and applied, FALSE if using fallback
     */
    protected function _configure_smtp($company_id = 1)
    {
        $this->_smtp_from_email = '';
        $this->_smtp_from_name  = '';

        $row = $this->CI->db
            ->get_where('company_smtp_settings', ['company_id' => $company_id, 'is_active' => 1])
            ->row();

        if (!$row || empty($row->smtp_host)) {
            log_message('error', 'Gms_mailer: No active SMTP config for company ' . $company_id . '.');
            return FALSE;
        }

        $config = [
            'protocol'   => 'smtp',
            'smtp_host'  => $row->smtp_host,
            'smtp_port'  => (int) $row->smtp_port,
            'smtp_user'  => $row->smtp_username,
            'smtp_pass'  => base64_decode($row->smtp_password),
            'smtp_crypto' => ($row->smtp_encryption === 'none') ? '' : $row->smtp_encryption,
            'mailtype'   => 'html',
            'charset'    => 'utf-8',
            'newline'    => "\r\n",
            'wordwrap'   => TRUE,
            'validate'   => TRUE,
        ];

        $this->CI->email->initialize($config);

        // Store the sender details for this company
        $this->_smtp_from_email = $row->smtp_from_email;
        $this->_smtp_from_name  = $row->smtp_from_name;

        return TRUE;
    }

    protected function _configure_mailtrap()
    {
        $this->_smtp_from_email = 'test@gms.local';
        $this->_smtp_from_name  = 'GMS Mailtrap Test';

        $config = [
            'protocol'    => 'smtp',
            'smtp_host'   => $this->CI->config->item('smtp_host'),
            'smtp_port'   => (int) $this->CI->config->item('smtp_port'),
            'smtp_user'   => $this->CI->config->item('smtp_user'),
            'smtp_pass'   => $this->CI->config->item('smtp_pass'),
            'smtp_crypto' => $this->CI->config->item('smtp_crypto'),
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'newline'     => "\r\n",
            'wordwrap'    => TRUE,
            'validate'    => TRUE,
        ];

        if (empty($config['smtp_host']) || empty($config['smtp_user']) || empty($config['smtp_pass'])) {
            log_message('error', 'Gms_mailer: Mailtrap SMTP config is incomplete.');
            return FALSE;
        }

        $this->CI->email->initialize($config);
        return TRUE;
    }

    /** @var string Sender email loaded from DB */
    protected $_smtp_from_email = '';
    /** @var string Sender name loaded from DB */
    protected $_smtp_from_name  = '';

    /**
     * Fetch the real company name from company_master.
     * Falls back to smtp_from_name (already in memory after _configure_smtp),
     * then to the literal string 'GMS'.
     *
     * @param  int    $company_id
     * @return string
     */
    public function get_company_name($company_id = 1)
    {
        $row = $this->CI->db
            ->select('company_name')
            ->get_where('company_master', ['company_id' => $company_id])
            ->row();

        if ($row && !empty($row->company_name)) {
            return $row->company_name;
        }

        // Secondary fallback: SMTP sender name already loaded
        if (!empty($this->_smtp_from_name)) {
            return $this->_smtp_from_name;
        }

        return 'GMS';
    }

    /**
     * Centralized function to dispatch template-driven emails.
     *
     * @param string   $to_email        Recipient email address
     * @param string   $template_key    Key matching email_templates table row
     * @param array    $placeholders    Tokens e.g. ['{customer_name}' => 'John']
     * @param string   $attachment_path Absolute server path to attachment file (optional)
     * @param int      $company_id      Company whose SMTP config to use (default 1)
     * @return array   ['status' => bool, 'message' => string]
     */
    public function send_notification(
        $to_email,
        $template_key,
        $placeholders   = [],
        $attachment_path = null,
        $company_id      = 1
    ) {
        // 1. Fetch template — prefer company-scoped, fallback to first match
        $template = $this->CI->db
            ->get_where('email_templates', [
                'template_key' => $template_key,
                'company_id'   => $company_id,
                'is_active'    => 1,
            ])->row();

        if (!$template) {
            // Attempt global fallback (any company)
            $template = $this->CI->db
                ->get_where('email_templates', ['template_key' => $template_key, 'is_active' => 1])
                ->row();
        }

        if (!$template) {
            log_message('error', 'Gms_mailer: Template key not found: ' . $template_key);
            return ['status' => false, 'message' => 'Email template "' . $template_key . '" not found.'];
        }

        // Keep shared legacy templates accurate for each document section.
        if ($template_key === 'quotation_sent') {
            $placeholders['{amount}'] = $placeholders['{quotation_amount}'] ?? ($placeholders['{amount}'] ?? '');
            $template->html_body = str_replace('Estimated Amount:', 'Quotation Amount:', $template->html_body);
        } elseif ($template_key === 'invoice_sent') {
            $placeholders['{amount}'] = $placeholders['{invoice_amount}'] ?? ($placeholders['{amount}'] ?? '');
            $template->html_body = str_replace('Total Amount:', 'Invoice Amount:', $template->html_body);
        }

        // 2. Parse placeholders
        $parsed_subject = strtr($template->subject,  $placeholders);
        $parsed_body    = strtr($template->html_body, $placeholders);

        // 3. Clear previous state
        $this->CI->email->clear(TRUE);

        // 4. Use Mailtrap only for an explicit test request; production keeps company SMTP.
        $use_mailtrap = $this->CI->input->post('test_mailtrap') === '1';
        $configured = $use_mailtrap
            ? $this->_configure_mailtrap()
            : $this->_configure_smtp($company_id);
        if (!$configured) {
            return [
                'status'  => false,
                'message' => $use_mailtrap
                    ? 'Mailtrap SMTP settings are incomplete.'
                    : 'SMTP settings are not configured for this company.',
            ];
        }

        // 5. Build email
        $from_email = $this->_smtp_from_email;
        $from_name  = $this->_smtp_from_name ?: 'GMS Notification';

        $this->CI->email->from($from_email, $from_name);
        $this->CI->email->to($to_email);
        $this->CI->email->subject($parsed_subject);
        $this->CI->email->message($parsed_body);

        // 6. Attach one or more files if given
        $attachments = is_array($attachment_path) ? $attachment_path : [$attachment_path];
        foreach ($attachments as $file_path) {
            if (empty($file_path)) {
                continue;
            }
            if (!is_file($file_path)) {
                return ['status' => false, 'message' => 'Email attachment could not be prepared.'];
            }
            $this->CI->email->attach($file_path);
        }

        // 7. Send
        if ($this->CI->email->send()) {
            return ['status' => true, 'message' => 'Email sent successfully.'];
        }

        $debug = $this->CI->email->print_debugger(['headers', 'subject', 'body']);
        log_message('error', 'Gms_mailer SMTP error: ' . $debug);
        return [
            'status'  => false,
            'message' => 'Failed to send email. Check SMTP settings.',
            'debug'   => $debug,
        ];
    }

    public function send_raw($to_email, $subject, $body, $company_id = 1)
    {
        $this->CI->email->clear(TRUE);

        $use_mailtrap = $this->CI->input->post('test_mailtrap') === '1';
        $configured = $use_mailtrap
            ? $this->_configure_mailtrap()
            : $this->_configure_smtp($company_id);

        if (!$configured) {
            return [
                'status' => false,
                'message' => $use_mailtrap
                    ? 'Mailtrap SMTP settings are incomplete.'
                    : 'SMTP settings are not configured for this company.',
            ];
        }

        $this->CI->email->from($this->_smtp_from_email, $this->_smtp_from_name ?: 'GMS Notification');
        $this->CI->email->to($to_email);
        $this->CI->email->subject($subject);
        $this->CI->email->message($body);

        if ($this->CI->email->send()) {
            return ['status' => true, 'message' => 'Email sent successfully.'];
        }

        log_message('error', 'Gms_mailer SMTP error: ' . $this->CI->email->print_debugger(['headers', 'subject']));
        return ['status' => false, 'message' => 'Failed to send email. Check SMTP settings.'];
    }

    /**
     * Send a plain test email to verify SMTP credentials.
     *
     * @param int    $company_id    Company SMTP config to test
     * @param string $test_email    Recipient for the test
     * @return array ['status' => bool, 'message' => string]
     */
    public function test_connection($company_id = 1, $test_email = '')
    {
        $this->CI->email->clear(TRUE);

        $smtp_user = 'c3psd8@concepts360plus.com';
        $smtp_pass = 'C3PSDeight';
        $this->CI->email->initialize([
            'protocol'    => 'smtp',
            'smtp_host'   => 'www.greenearthnetwork.in',
            'smtp_port'   => 465,
            'smtp_user'   => $smtp_user,
            'smtp_pass'   => $smtp_pass,
            'smtp_crypto' => 'ssl',
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'newline'     => "\r\n",
            'crlf'        => "\r\n",
            'wordwrap'    => TRUE,
            'validate'    => TRUE,
        ]);

        $from_email = $smtp_user;
        $from_name  = 'GMS';

        $this->CI->email->from($from_email, $from_name);
        $this->CI->email->to($test_email ?: $from_email);
        $this->CI->email->subject('GMS SMTP Test — ' . date('Y-m-d H:i:s'));
        $this->CI->email->message(
            '<p>This is a <strong>test email</strong> from GMS to confirm your SMTP settings are working correctly.</p>'
            . '<p style="color:#888;font-size:12px;">Sent: ' . date('Y-m-d H:i:s') . '</p>'
        );

        if ($this->CI->email->send()) {
            return ['status' => true, 'message' => 'Test email sent successfully to ' . ($test_email ?: $from_email)];
        }

        $debug = $this->CI->email->print_debugger(['headers', 'subject', 'body']);
        log_message('error', 'Gms_mailer test_connection error: ' . $debug);
        return [
            'status'  => false,
            'message' => 'SMTP test failed. Check your credentials.',
            'debug'   => $debug,
        ];
    }
}