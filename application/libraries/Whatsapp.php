<?php
class Whatsapp
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    private function getCompanyConfig($company_id)
    {
        $wa = $this->CI->db
            ->where('company_id',$company_id)
            ->get('whatsapp_settings')
            ->row();

        if ($wa) {
            return $wa;
        }

        return $this->CI->db
            ->where('company_id',$company_id)
            ->get('company_whatsapp')
            ->row();
    }

    public function sendTemplate(
        $company_id,
        $mobile,
        $template_name,
        $parameters = [],
        $language = 'en_US'
    )
    {
        $wa = $this->getCompanyConfig($company_id);

        if (!$wa || empty($wa->phone_number_id) || empty($wa->access_token)) {
            return [
                'status' => false,
                'http_code' => 400,
                'response' => [
                    'error' => [
                        'message' => 'WhatsApp is not configured. Please check Phone Number ID and Access Token.'
                    ]
                ]
            ];
        }

        $clean_mobile = preg_replace('/\D+/', '', (string)$mobile);
        if (strlen($clean_mobile) === 10) {
            $clean_mobile = '91' . $clean_mobile;
        }

        $url = "https://graph.facebook.com/v21.0/" . $wa->phone_number_id . "/messages";

        $components = [];

        if (!empty($parameters)) {
            $body_parameters = [];
            foreach ($parameters as $value) {
                $body_parameters[] = [
                    "type" => "text",
                    "text" => (string)$value
                ];
            }

            $components[] = [
                "type" => "body",
                "parameters" => $body_parameters
            ];
        }

        $template_payload = [
            "name" => trim($template_name),
            "language" => [
                "code" => !empty($language) ? trim($language) : "en_US"
            ]
        ];

        if (!empty($components)) {
            $template_payload["components"] = $components;
        }

        $payload = [
            "messaging_product" => "whatsapp",
            "to" => $clean_mobile,
            "type" => "template",
            "template" => $template_payload
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $wa->access_token,
                "Content-Type: application/json"
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_TIMEOUT => 20
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response_array = json_decode($response, true);
        $message_id = !empty($response_array['messages'][0]['id']) ? $response_array['messages'][0]['id'] : '';
        $is_sent = ($http_code >= 200 && $http_code < 300 && !empty($message_id));

        if ($this->CI->db->table_exists('whatsapp_logs')) {
            $this->CI->db->insert('whatsapp_logs', [
                'company_id'    => $company_id,
                'mobile'        => $clean_mobile,
                'template_name' => $template_name,
                'message_id'    => $message_id,
                'status'        => $is_sent ? 'Sent' : 'Failed',
                'response'      => $response,
                'created_at'    => date('Y-m-d H:i:s')
            ]);
        }

        return [
            'status'    => $is_sent,
            'http_code' => $http_code,
            'response'  => $response_array
        ];
    }

    public function send_message($company_id, $to, $message)
    {
        $row = $this->getCompanyConfig($company_id);

        if (!$row || empty($row->phone_number_id) || empty($row->access_token)) {
            return [
                'status' => false,
                'http_code' => 400,
                'response' => [
                    'error' => [
                        'message' => 'WhatsApp account not configured.'
                    ]
                ]
            ];
        }

        $clean_mobile = preg_replace('/\D+/', '', (string)$to);
        if (strlen($clean_mobile) === 10) {
            $clean_mobile = '91' . $clean_mobile;
        }

        $url = 'https://graph.facebook.com/v21.0/' . $row->phone_number_id . '/messages';

        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $clean_mobile,
            'type' => 'text',
            'text' => ['body' => $message]
        ];

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $row->access_token,
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_TIMEOUT => 20
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response_array = json_decode($response, true);
        $message_id = !empty($response_array['messages'][0]['id']) ? $response_array['messages'][0]['id'] : '';
        $is_sent = ($http_code >= 200 && $http_code < 300 && !empty($message_id));

        if ($this->CI->db->table_exists('whatsapp_logs')) {
            $this->CI->db->insert('whatsapp_logs', [
                'company_id'    => $company_id,
                'mobile'        => $clean_mobile,
                'template_name' => 'text_message',
                'message_id'    => $message_id,
                'status'        => $is_sent ? 'Sent' : 'Failed',
                'response'      => $response,
                'created_at'    => date('Y-m-d H:i:s')
            ]);
        }

        return [
            'status'    => $is_sent,
            'http_code' => $http_code,
            'response'  => $response_array
        ];
    }
}