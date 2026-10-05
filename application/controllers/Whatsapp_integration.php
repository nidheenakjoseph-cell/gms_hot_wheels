<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp_integration extends MY_Controller
{
    public function __construct()
    {
           parent::__construct();

            $this->load->database();
            $this->load->helper(['url', 'company']);

            $this->load->library('Whatsapp_library');
    }

   public function index()
{
    $company_id = get_current_company_id();

    $data['title'] = 'WhatsApp Integration';

    $data['whatsapp'] = $this->db
        ->get_where(
            'whatsapp_settings',
            [
                'company_id' => $company_id
            ]
        )
        ->row();

    $data['whatsapp_templates'] =
        $this->get_whatsapp_templates(
            $company_id
        );

    $data['main_content'] =
        'whatsapp/whatsapp_view';

    $this->load->view(
        'includes/template',
        $data
    );
}

   public function callback()
{
    $company_id = get_current_company_id();

    if (empty($company_id)) {
        show_error(
            'Company could not be identified.',
            400
        );
        return;
    }

    $code = $this->input->get(
        'code',
        TRUE
    );

    if (empty($code)) {
        show_error(
            'Authorization code missing from Meta response.',
            400
        );
        return;
    }

    $redirect_uri = base_url(
        'index.php/Whatsapp_integration/callback'
    );

    $waba_id = $this->input->get('waba_id', TRUE);
    $phone_number_id = $this->input->get('phone_number_id', TRUE);

    $result = $this->whatsapp_library
        ->connectBusiness(
            $company_id,
            $code,
            $redirect_uri,
            $waba_id,
            $phone_number_id
        );

    if (empty($result['success'])) {

        log_message(
            'error',
            'WhatsApp connection failed: ' .
            json_encode($result)
        );

        $message = !empty($result['message'])
            ? $result['message']
            : 'Unable to connect WhatsApp.';

        $this->session->set_flashdata(
            'whatsapp_error',
            $message
        );

        redirect(
            'Whatsapp_integration'
        );

        return;
    }

    $this->session->set_flashdata(
        'whatsapp_success',
        'WhatsApp connected successfully.'
    );

    redirect(
        'Whatsapp_integration'
    );
}

    public function save_whatsapp()
    {
        // $this->_ensure_whatsapp_settings_table();

        $company_id = get_current_company_id();
        $enabled = $this->input->post('whatsapp_enabled');

        $whatsapp_number = trim($this->input->post('whatsapp_number', TRUE) ?? '');
        $phone_number_id = trim($this->input->post('phone_number_id', TRUE) ?? '');
        $access_token    = trim($this->input->post('access_token', TRUE) ?? '');

        $existing = $this->db->get_where('whatsapp_settings', ['company_id' => $company_id])->row();

        // If access token was left blank, retain existing access token
        if (empty($access_token) && !empty($existing) && !empty($existing->access_token)) {
            $access_token = $existing->access_token;
        }

        $is_enabled = ($enabled === '1' || $enabled === 'on' || $enabled === 'true' || (int) $enabled === 1) ? 1 : 0;
        $is_connected = (!empty($phone_number_id) && !empty($access_token));

        $save_data = [
            'whatsapp_number'   => $whatsapp_number,
            'phone_number_id'   => $phone_number_id,
            'access_token'      => $access_token,
            'whatsapp_enabled'  => $is_enabled,
            'connection_type'   => 'MANUAL',
            'connection_status' => $is_connected ? 'CONNECTED' : 'DISCONNECTED',
            'updated_at'        => date('Y-m-d H:i:s')
        ];

        if ($existing) {
            if ($is_connected && empty($existing->connected_at)) {
                $save_data['connected_at'] = date('Y-m-d H:i:s');
            }
            $status = $this->db->update('whatsapp_settings', $save_data, ['company_id' => $company_id]);
        } else {
            $save_data['company_id']   = $company_id;
            $save_data['connected_at'] = $is_connected ? date('Y-m-d H:i:s') : null;
            $save_data['created_at']   = date('Y-m-d H:i:s');
            $status = $this->db->insert('whatsapp_settings', $save_data);
        }

        // Save templates
        $template_types = ['invoice', 'quotation', 'jobcard', 'inspection', 'estimation', 'service_reminder'];
        $template_payload = [];

        foreach ($template_types as $type) {
            $body       = $this->input->post($type . '_template', TRUE);
            $tmpl_name  = trim($this->input->post($type . '_template_name', TRUE) ?? '');
            $meta_lang  = trim($this->input->post($type . '_meta_language', TRUE) ?? 'en_US');
            $disp_mode  = trim($this->input->post($type . '_dispatch_mode', TRUE) ?? 'template');

            $template_payload[] = [
                'company_id'    => $company_id,
                'template_type' => $type,
                'template_name' => $tmpl_name,
                'template_body' => ($body === null || $body === '') ? $this->_default_whatsapp_template($type) : $body,
                'meta_language' => !empty($meta_lang) ? $meta_lang : 'en_US',
                'dispatch_mode' => !empty($disp_mode) ? $disp_mode : 'template',
                'is_active'     => 1,
                'updated_at'    => date('Y-m-d H:i:s')
            ];
        }

        $this->save_whatsapp_templates($company_id, $template_payload);

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['message' => $status ? 'Settings saved successfully.' : 'Failed to save settings.']));
    }

    public function send_document_whatsapp()
    {
        $company_id = get_current_company_id();
        $record_id  = $this->input->post('record_id', TRUE);
        $type       = $this->input->post('type', TRUE);

        $wa_settings = $this->db->get_where('whatsapp_settings', ['company_id' => $company_id])->row();
        if (empty($wa_settings) || empty($wa_settings->whatsapp_enabled)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'WhatsApp messaging is disabled.']));
            return;
        }

        if (empty($record_id) || empty($type)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Invalid request.']));
            return;
        }

        $record = null;
        $template_type = $type;

        switch ($type) {
            case 'invoice':
                $record = $this->db
                    ->select('i.invoice_id, i.invoice_no, i.invoice_date, i.grand_total as amount, i.status, c.name as customer_name, c.phone as customer_phone, v.registration_no, v.brand, v.model')
                    ->from('invoices i')
                    ->join('job_cards j', 'j.jobcard_id = i.jobcard_id', 'left')
                    ->join('customers c', 'c.customer_id = j.customer_id', 'left')
                    ->join('vehicles v', 'v.vehicle_id = j.vehicle_id', 'left')
                    ->where('i.invoice_id', $record_id)
                    ->get()
                    ->row();
                break;

            case 'quotation':
                $record = $this->db
                    ->select('q.quotation_id, q.quotation_no, q.quotation_date, q.subtotal as amount, q.status, c.name as customer_name, c.phone as customer_phone, v.registration_no, v.brand, v.model')
                    ->from('quotations q')
                    ->join('customers c', 'c.customer_id = q.customer_id', 'left')
                    ->join('vehicles v', 'v.vehicle_id = q.vehicle_id', 'left')
                    ->where('q.quotation_id', $record_id)
                    ->get()
                    ->row();
                break;

            case 'direct_invoice':
                $record = $this->db
                    ->select('i.invoice_id, i.invoice_no, i.invoice_date, i.grand_total as amount, i.status, i.customer_name, i.customer_contact as customer_phone, i.vehicle_numberPlate as brand, i.vehicle_model as model, i.vehicle_vinNo as registration_no')
                    ->from('direct_invoices i')
                    ->where('i.invoice_id', $record_id)
                    ->get()
                    ->row();
                $template_type = 'invoice';
                break;

            case 'direct_quotation':
                $record = $this->db
                    ->select('q.quotation_id, q.quotation_no, q.quotation_date, q.subtotal as amount, q.status, q.customer_name, q.customer_contact as customer_phone, q.vehicle_numberPlate as brand, q.vehicle_model as model, q.vehicle_vinNo as registration_no')
                    ->from('direct_quotations q')
                    ->where('q.quotation_id', $record_id)
                    ->get()
                    ->row();
                $template_type = 'quotation';
                break;

            case 'estimation':
                $record = $this->db
                    ->select('e.estimation_id, e.estimation_no, e.estimation_date, e.subtotal as amount, e.status, c.name as customer_name, c.phone as customer_phone, v.registration_no, v.brand, v.model')
                    ->from('estimations e')
                    ->join('customers c', 'c.customer_id = e.customer_id', 'left')
                    ->join('vehicles v', 'v.vehicle_id = e.vehicle_id', 'left')
                    ->where('e.estimation_id', $record_id)
                    ->get()
                    ->row();
                break;

            case 'inspection':
                $record = $this->db
                    ->select('i.inspection_id, i.inspection_date, i.status, c.name as customer_name, c.phone as customer_phone, v.registration_no, v.brand, v.model')
                    ->from('inspections i')
                    ->join('customers c', 'c.customer_id = i.customer_id', 'left')
                    ->join('vehicles v', 'v.vehicle_id = i.vehicle_id', 'left')
                    ->where('i.inspection_id', $record_id)
                    ->get()
                    ->row();
                $template_type = 'inspection';
                break;

            case 'jobcard':
                $record = $this->db
                    ->select('j.jobcard_id, j.jobcard_no, j.jobcard_date, j.status, c.name as customer_name, c.phone as customer_phone, v.registration_no, v.brand, v.model')
                    ->from('job_cards j')
                    ->join('customers c', 'c.customer_id = j.customer_id', 'left')
                    ->join('vehicles v', 'v.vehicle_id = j.vehicle_id', 'left')
                    ->where('j.jobcard_id', $record_id)
                    ->get()
                    ->row();
                break;
        }

        if (empty($record) || empty($record->customer_phone)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Customer phone number not found.']));
            return;
        }

        $phone = preg_replace('/\D+/', '', $record->customer_phone);
        if (strlen($phone) == 10) {
            $phone = '91' . $phone;
        }

        $tmpl_row      = $this->get_template_row_by_type($company_id, $template_type);
        $template_body = !empty($tmpl_row->template_body) ? $tmpl_row->template_body : $this->_default_whatsapp_template($template_type);
        $dispatch_mode = !empty($tmpl_row->dispatch_mode) ? $tmpl_row->dispatch_mode : 'template';
        $template_name = !empty($tmpl_row->template_name) ? trim($tmpl_row->template_name) : '';
        $meta_language = !empty($tmpl_row->meta_language) ? trim($tmpl_row->meta_language) : 'en_US';

        $this->load->library('Whatsapp');

        // Check if sending as Meta Approved Template or Free-form text
        $use_template = ($dispatch_mode === 'template' && !empty($template_name));

        if ($use_template) {
            if ($template_name === 'hello_world') {
                $parameters = [];
            } else {
                $parameters = $this->_extract_template_parameters($template_body, $record, $template_type);
            }

            $result  = $this->whatsapp->sendTemplate($company_id, $phone, $template_name, $parameters, $meta_language);
            $success = !empty($result['response']['messages'][0]['id']);
        } else {
            $message = $this->_build_whatsapp_message($template_body, $record, $template_type);
            $result  = $this->whatsapp->send_message($company_id, $phone, $message);
            $success = !empty($result['response']['messages'][0]['id']);
        }

        if ($success) {
            $this->_mark_document_whatsapp_sent($type, $record_id);
            $resp_msg = $use_template
                ? 'WhatsApp template (' . htmlspecialchars($template_name) . ') dispatched successfully.'
                : 'WhatsApp message sent successfully.';
        } else {
            $err_detail = '';
            if (!empty($result['response']['error']['message'])) {
                $err_detail = $result['response']['error']['message'];
                if (!empty($result['response']['error']['error_data']['details'])) {
                    $err_detail .= ' - ' . $result['response']['error']['error_data']['details'];
                }
            } elseif (!empty($result['message'])) {
                $err_detail = $result['message'];
            }
            $resp_msg = !empty($err_detail) ? $err_detail : 'Failed to send WhatsApp message.';
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => $success,
                'message' => $resp_msg
            ]));
    }

    public function test_connection()
    {
        $company_id = get_current_company_id();

        if (empty($company_id)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(
                    json_encode([
                        'success' => false,
                        'message' => 'Company not identified.'
                    ])
                );
            return;
        }

        $phone_number_id = trim($this->input->post('phone_number_id', TRUE) ?? '');
        $access_token    = trim($this->input->post('access_token', TRUE) ?? '');

        // If credentials not posted or partially posted, fetch existing from DB
        if (empty($phone_number_id) || empty($access_token)) {
            $existing = $this->db->get_where('whatsapp_settings', ['company_id' => $company_id])->row();
            if ($existing) {
                if (empty($phone_number_id) && !empty($existing->phone_number_id)) {
                    $phone_number_id = $existing->phone_number_id;
                }
                if (empty($access_token) && !empty($existing->access_token)) {
                    $access_token = $existing->access_token;
                }
            }
        }

        if (empty($phone_number_id) || empty($access_token)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(
                    json_encode([
                        'success' => false,
                        'message' => 'WhatsApp credentials are incomplete. Please provide Phone Number ID and Access Token.'
                    ])
                );
            return;
        }

        // Test credentials directly with Meta Graph API
        $result = $this->whatsapp_library->testRawConnection($phone_number_id, $access_token);

        if (!empty($result['success'])) {
            $this->db->where('company_id', $company_id)->update('whatsapp_settings', [
                'connection_status' => 'CONNECTED',
                'updated_at'        => date('Y-m-d H:i:s')
            ]);
            $result['message'] = 'WhatsApp connection is working.';
        } else {
            $this->db->where('company_id', $company_id)->update('whatsapp_settings', [
                'connection_status' => 'DISCONNECTED',
                'updated_at'        => date('Y-m-d H:i:s')
            ]);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(
                json_encode($result)
            );
    }

  

    public function send_test_message()
    {
        $company_id = get_current_company_id();
        if (empty($company_id)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Company not identified.']));
            return;
        }

        $phone         = trim($this->input->post('phone', TRUE) ?? '');
        $template_name = trim($this->input->post('template_name', TRUE) ?? 'hello_world');
        $language      = trim($this->input->post('language', TRUE) ?? 'en_US');

        if (empty($phone)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Please enter a valid phone number with country code.']));
            return;
        }

        $this->load->library('Whatsapp');

        $params = [];
        if ($template_name !== 'hello_world') {
            $params = ['Valued Customer', 'TEST-001', '100.00'];
        }

        $result  = $this->whatsapp->sendTemplate($company_id, $phone, $template_name, $params, $language);
        $success = !empty($result['response']['messages'][0]['id']);

        if ($success) {
            $msg = 'Test WhatsApp message sent successfully to ' . htmlspecialchars($phone) . '! (Message ID: ' . $result['response']['messages'][0]['id'] . ')';
        } else {
            $err_detail = '';
            if (!empty($result['response']['error']['message'])) {
                $err_detail = $result['response']['error']['message'];
                if (!empty($result['response']['error']['error_data']['details'])) {
                    $err_detail .= ' - ' . $result['response']['error']['error_data']['details'];
                }
            } elseif (!empty($result['message'])) {
                $err_detail = $result['message'];
            }
            $msg = !empty($err_detail) ? $err_detail : 'Failed to send test WhatsApp message.';
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => $success,
                'message' => $msg,
                'data'    => $result['response'] ?? null
            ]));
    }

    public function get_whatsapp_templates($company_id)
    {
        $rows = $this->db
            ->where('company_id', $company_id)
            ->where('is_active', 1)
            ->order_by('template_type', 'ASC')
            ->get('whatsapp_template')
            ->result();

        $templates = [];
        foreach ($rows as $row) {
            $templates[$row->template_type] = $row;
        }

        foreach (['invoice', 'quotation', 'jobcard', 'inspection', 'estimation', 'service_reminder'] as $type) {
            if (!isset($templates[$type])) {
                $templates[$type] = (object) [
                    'template_type' => $type,
                    'template_name' => '',
                    'template_body' => $this->_default_whatsapp_template($type),
                    'meta_language' => 'en_US',
                    'dispatch_mode' => 'template',
                    'is_active'     => 1
                ];
            }
        }

        return $templates;
    }

    public function save_whatsapp_templates($company_id, $payload)
    {
        foreach ($payload as $item) {
            $existing = $this->db->get_where('whatsapp_template', [
                'company_id'    => $company_id,
                'template_type' => $item['template_type']
            ])->row();

            $data = [
                'template_name' => $item['template_name'],
                'template_body' => $item['template_body'],
                'meta_language' => !empty($item['meta_language']) ? $item['meta_language'] : 'en_US',
                'dispatch_mode' => !empty($item['dispatch_mode']) ? $item['dispatch_mode'] : 'template',
                'is_active'     => !empty($item['is_active']) ? 1 : 0,
                'updated_at'    => date('Y-m-d H:i:s')
            ];

            if ($existing) {
                $this->db->where('id', $existing->id)->update('whatsapp_template', $data);
            } else {
                $data['company_id']    = $company_id;
                $data['template_type'] = $item['template_type'];
                $data['created_at']    = date('Y-m-d H:i:s');
                $this->db->insert('whatsapp_template', $data);
            }
        }

        return true;
    }

    public function get_template_by_type($company_id, $template_type)
    {
        $row = $this->get_template_row_by_type($company_id, $template_type);
        return !empty($row->template_body) ? $row->template_body : $this->_default_whatsapp_template($template_type);
    }

    public function get_template_row_by_type($company_id, $template_type)
    {
        $row = $this->db
            ->where('company_id', $company_id)
            ->where('template_type', $template_type)
            ->where('is_active', 1)
            ->get('whatsapp_template')
            ->row();

        if (!$row) {
            $row = (object) [
                'template_type' => $template_type,
                'template_name' => '',
                'template_body' => $this->_default_whatsapp_template($template_type),
                'meta_language' => 'en_US',
                'dispatch_mode' => 'template',
                'is_active'     => 1
            ];
        }

        return $row;
    }

    private function _extract_template_parameters($template_body, $record, $template_type)
    {
        preg_match_all('/\{[a-zA-Z0-9_]+\}/', (string)$template_body, $matches);
        $tokens = !empty($matches[0]) ? $matches[0] : [];

        $customer_name   = !empty($record->customer_name) ? (string)$record->customer_name : 'Customer';
        $registration_no = !empty($record->registration_no) ? (string)$record->registration_no : '';
        $brand           = !empty($record->brand) ? (string)$record->brand : '';
        $model           = !empty($record->model) ? (string)$record->model : '';
        $amount          = !empty($record->amount) ? number_format((float)$record->amount, 2, '.', '') : '0.00';
        $status          = !empty($record->status) ? (string)$record->status : '';

        $vehicle = trim($brand . ' ' . $model);
        if (empty($vehicle)) {
            $vehicle = $registration_no;
        }

        $doc_no   = '';
        $doc_date = '';
        if ($template_type === 'invoice') {
            $doc_no   = !empty($record->invoice_no) ? $record->invoice_no : '';
            $doc_date = !empty($record->invoice_date) ? date('d-m-Y', strtotime($record->invoice_date)) : '';
        } elseif ($template_type === 'quotation') {
            $doc_no   = !empty($record->quotation_no) ? $record->quotation_no : '';
            $doc_date = !empty($record->quotation_date) ? date('d-m-Y', strtotime($record->quotation_date)) : '';
        } elseif ($template_type === 'jobcard') {
            $doc_no   = !empty($record->jobcard_no) ? $record->jobcard_no : '';
            $doc_date = !empty($record->jobcard_date) ? date('d-m-Y', strtotime($record->jobcard_date)) : '';
        } elseif ($template_type === 'estimation') {
            $doc_no   = !empty($record->estimation_no) ? $record->estimation_no : '';
            $doc_date = !empty($record->estimation_date) ? date('d-m-Y', strtotime($record->estimation_date)) : '';
        } elseif ($template_type === 'inspection') {
            $doc_no   = !empty($record->inspection_id) ? (string)$record->inspection_id : '';
            $doc_date = !empty($record->inspection_date) ? date('d-m-Y', strtotime($record->inspection_date)) : '';
        }

        $map = [
            '{customer_name}'     => $customer_name,
            '{invoice_no}'        => $doc_no,
            '{quotation_no}'      => $doc_no,
            '{jobcard_no}'        => $doc_no,
            '{estimation_no}'     => $doc_no,
            '{amount}'            => $amount,
            '{registration_no}'   => $registration_no,
            '{brand}'             => $brand,
            '{model}'             => $model,
            '{vehicle}'           => $vehicle,
            '{vehicle_no}'        => $registration_no,
            '{status}'            => $status,
            '{invoice_date}'      => $doc_date,
            '{quotation_date}'    => $doc_date,
            '{jobcard_date}'      => $doc_date,
            '{estimation_date}'   => $doc_date,
            '{inspection_date}'   => $doc_date,
            '{next_service_date}' => !empty($record->next_service_date) ? date('d-m-Y', strtotime($record->next_service_date)) : '',
            '{last_service_date}' => !empty($record->last_service_date) ? date('d-m-Y', strtotime($record->last_service_date)) : ''
        ];

        $params = [];
        if (!empty($tokens)) {
            foreach ($tokens as $t) {
                $params[] = isset($map[$t]) ? $map[$t] : '';
            }
        } else {
            if ($template_type === 'invoice' || $template_type === 'quotation' || $template_type === 'estimation') {
                $params = [$customer_name, $doc_no, $amount, $vehicle];
            } elseif ($template_type === 'jobcard') {
                $params = [$customer_name, $doc_no, $vehicle, $status];
            } elseif ($template_type === 'inspection') {
                $params = [$customer_name, $vehicle, $doc_date, $status];
            } else {
                $params = [$customer_name, $registration_no, $doc_date];
            }
        }

        return $params;
    }

    private function _default_whatsapp_template($template_type)
    {
        $defaults = [
            'invoice' => "Hello {customer_name},\n\nYour invoice is ready.\nInvoice No: {invoice_no}\nAmount: {amount}\nThank you!",
            'quotation' => "Hello {customer_name},\n\nYour quotation is ready.\nQuotation No: {quotation_no}\nAmount: {amount}\nThank you!",
            'jobcard' => "Hello {customer_name},\n\nYour job card is ready.\nJob Card No: {jobcard_no}\nVehicle: {brand} {model}\nThank you!",
            'inspection' => "Hi {customer_name},\n\nYour inspection report is ready.\n\nVehicle: {brand} {model}\nRegistration: {registration_no}\nDate: {inspection_date}\nStatus: {status}\n\nPlease view your report.\nThank you!",
            'estimation' => "Hello {customer_name},\n\nYour estimation is ready.\nEstimation No: {estimation_no}\nAmount: {amount}\nThank you!",
            'service_reminder' => "Dear {customer_name},\n\nThis is a friendly reminder that your vehicle {vehicle_no} is due for its next service.\n\nNext Service Date: {next_service_date}\nLast Service Date: {last_service_date}\n\nPlease book your appointment at your earliest convenience.\n\nThank you!"
        ];

        return $defaults[$template_type] ?? $defaults['inspection'];
    }

    private function _build_whatsapp_message($template_body, $record, $template_type)
    {
        $replacements = [];

        $replacements['{customer_name}'] = !empty($record->customer_name) ? $record->customer_name : '';
        $replacements['{brand}'] = !empty($record->brand) ? $record->brand : '';
        $replacements['{model}'] = !empty($record->model) ? $record->model : '';
        $replacements['{registration_no}'] = !empty($record->registration_no) ? $record->registration_no : '';
        $replacements['{amount}'] = !empty($record->amount) ? $record->amount : '';

        if ($template_type === 'invoice') {
            $replacements['{invoice_no}'] = !empty($record->invoice_no) ? $record->invoice_no : '';
            $replacements['{invoice_date}'] = !empty($record->invoice_date) ? date('d-m-Y', strtotime($record->invoice_date)) : '';
        } elseif ($template_type === 'quotation') {
            $replacements['{quotation_no}'] = !empty($record->quotation_no) ? $record->quotation_no : '';
            $replacements['{quotation_date}'] = !empty($record->quotation_date) ? date('d-m-Y', strtotime($record->quotation_date)) : '';
        } elseif ($template_type === 'estimation') {
            $replacements['{estimation_no}'] = !empty($record->estimation_no) ? $record->estimation_no : '';
            $replacements['{estimation_date}'] = !empty($record->estimation_date) ? date('d-m-Y', strtotime($record->estimation_date)) : '';
        } elseif ($template_type === 'inspection') {
            $replacements['{inspection_date}'] = !empty($record->inspection_date) ? date('d-m-Y', strtotime($record->inspection_date)) : '';
            $replacements['{status}'] = !empty($record->status) ? $record->status : '';
        } elseif ($template_type === 'jobcard') {
            $replacements['{jobcard_no}'] = !empty($record->jobcard_no) ? $record->jobcard_no : '';
            $replacements['{jobcard_date}'] = !empty($record->jobcard_date) ? date('d-m-Y', strtotime($record->jobcard_date)) : '';
            $replacements['{status}'] = !empty($record->status) ? $record->status : '';
        }

        return strtr($template_body, $replacements);
    }

    private function _mark_document_whatsapp_sent($type, $record_id)
    {
        $table = null;
        $id_field = null;

        if ($type === 'invoice') {
            $table = 'invoices';
            $id_field = 'invoice_id';
        } elseif ($type === 'quotation') {
            $table = 'quotations';
            $id_field = 'quotation_id';
        } elseif ($type === 'direct_invoice') {
            $table = 'direct_invoices';
            $id_field = 'invoice_id';
        } elseif ($type === 'direct_quotation') {
            $table = 'direct_quotations';
            $id_field = 'quotation_id';
        } elseif ($type === 'estimation') {
            $table = 'estimations';
            $id_field = 'estimation_id';
        } elseif ($type === 'inspection') {
            $table = 'inspections';
            $id_field = 'inspection_id';
        } elseif ($type === 'jobcard') {
            $table = 'job_cards';
            $id_field = 'jobcard_id';
        }

        if ($table && $id_field && $this->db->table_exists($table)) {
            if ($this->db->field_exists('whatsapp_sent', $table)) {
                $this->db->where($id_field, $record_id)->update($table, [
                    'whatsapp_sent' => 1,
                    'whatsapp_sent_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }

    private function _make_curl_request($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    public function save_connection()
{
    $company_id = get_current_company_id();

    if (empty($company_id)) {

        $this->output
            ->set_content_type('application/json')
            ->set_output(
                json_encode([
                    'success' => false,
                    'message' => 'Company not identified.'
                ])
            );

        return;
    }

    $phone_number = trim(
        $this->input->post(
            'whatsapp_number',
            TRUE
        )
    );

    $phone_number_id = trim(
        $this->input->post(
            'phone_number_id',
            TRUE
        )
    );

    $access_token = trim(
        $this->input->post(
            'access_token',
            TRUE
        )
    );

    /*
     * If token is blank, retain existing token.
     */
    if (empty($access_token)) {

        $existing = $this->db
            ->get_where(
                'whatsapp_settings',
                [
                    'company_id' => $company_id
                ]
            )
            ->row();

        if ($existing) {
            $access_token = $existing->access_token;
        }
    }

    $result = $this->whatsapp_library
        ->saveManualConnection(
            $company_id,
            $phone_number,
            $phone_number_id,
            $access_token
        );

    $this->output
        ->set_content_type('application/json')
        ->set_output(
            json_encode($result)
        );
}
public function disconnect()
{
    $company_id = get_current_company_id();

    if (empty($company_id)) {

        $this->output
            ->set_content_type('application/json')
            ->set_output(
                json_encode([
                    'success' => false,
                    'message' => 'Company not identified.'
                ])
            );

        return;
    }

    $result = $this->whatsapp_library
        ->disconnect($company_id);

    $this->output
        ->set_content_type('application/json')
        ->set_output(
            json_encode([
                'success' => $result,
                'message' => $result
                    ? 'WhatsApp disconnected.'
                    : 'Unable to disconnect WhatsApp.'
            ])
        );
}public function update_database()
{
    // Load Database Forge
    $this->load->dbforge();

    $table = 'whatsapp_template';
    $added = [];

    // Check table exists
    if (!$this->db->table_exists($table)) {
        echo "Error: Table whatsapp_template does not exist.";
        return;
    }

    // Add meta_language
    if (!$this->db->field_exists('meta_language', $table)) {

        $fields = [
            'meta_language' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'en_US',
                'null'       => FALSE
            ]
        ];

        if ($this->dbforge->add_column($table, $fields)) {
            $added[] = 'meta_language';
        }
    }

    // Add dispatch_mode
    if (!$this->db->field_exists('dispatch_mode', $table)) {

        $fields = [
            'dispatch_mode' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'template',
                'null'       => FALSE
            ]
        ];

        if ($this->dbforge->add_column($table, $fields)) {
            $added[] = 'dispatch_mode';
        }
    }

    // Result
    if (empty($added)) {

        echo "<h3>Database already up to date.</h3>";

    } else {

        echo "<h3>Database updated successfully.</h3>";

        echo "<ul>";

        foreach ($added as $column) {
            echo "<li>Added: " . htmlspecialchars($column) . "</li>";
        }

        echo "</ul>";
    }
}
}

