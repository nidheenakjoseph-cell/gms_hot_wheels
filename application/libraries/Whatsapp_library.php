<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp_library
{
    protected $CI;

    private $app_id;
    private $app_secret;
    private $api_version;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->database();
        $this->CI->load->config('whatsapp');

        $this->app_id = $this->CI->config->item('whatsapp_app_id');
        $this->app_secret = $this->CI->config->item('whatsapp_app_secret');
        $this->api_version = $this->CI->config->item('whatsapp_api_version');

        if (empty($this->api_version)) {
            $this->api_version = 'v21.0';
        }
    }

    /**
     * Exchange Embedded Signup authorization code for access token.
     */
    public function exchangeToken($code, $redirect_uri = null)
    {
        if (empty($code)) {
            return [
                'success' => false,
                'message' => 'Authorization code is missing.'
            ];
        }

        $url = 'https://graph.facebook.com/'
             . $this->api_version
             . '/oauth/access_token';

        $params = [
            'client_id'     => $this->app_id,
            'client_secret' => $this->app_secret,
            'code'          => $code
        ];

        if (!empty($redirect_uri)) {
            $params['redirect_uri'] = $redirect_uri;
        }

        $result = $this->callApi(
            $url,
            'GET',
            null,
            $params
        );

        // If code exchange failed with redirect_uri, retry without redirect_uri
        // (Embedded Signup JS SDK popup frequently expects no redirect_uri).
        if (empty($result['access_token']) && !empty($redirect_uri)) {
            unset($params['redirect_uri']);
            $retry = $this->callApi($url, 'GET', null, $params);
            if (!empty($retry['access_token'])) {
                $result = $retry;
            }
        }

        if (empty($result['access_token'])) {
            $errorMsg = !empty($result['error']['message'])
                ? $result['error']['message']
                : 'Unable to obtain WhatsApp access token.';

            return [
                'success' => false,
                'message' => $errorMsg,
                'response' => $result
            ];
        }

        return [
            'success' => true,
            'access_token' => $result['access_token'],
            'expires_in' => isset($result['expires_in'])
                ? $result['expires_in']
                : null,
            'response' => $result
        ];
    }

    /**
     * Get current Meta user/business information.
     */
    public function getBusinesses($token)
    {
        if (empty($token)) {
            return [
                'success' => false,
                'message' => 'Access token is missing.'
            ];
        }

        $url = 'https://graph.facebook.com/'
             . $this->api_version
             . '/me';

        $result = $this->callApi(
            $url,
            'GET',
            null,
            [
                'fields' => 'id,name',
                'access_token' => $token
            ]
        );

        if (!empty($result['error'])) {
            return [
                'success' => false,
                'message' => $result['error']['message'],
                'response' => $result
            ];
        }

        return [
            'success' => true,
            'data' => $result
        ];
    }

    /**
     * Get WhatsApp Business Accounts owned by business.
     */
    public function getWaba($business_id, $token)
    {
        if (empty($business_id) || empty($token)) {
            return [
                'success' => false,
                'message' => 'Business ID or access token is missing.'
            ];
        }

        $url = 'https://graph.facebook.com/'
             . $this->api_version
             . '/'
             . rawurlencode($business_id)
             . '/owned_whatsapp_business_accounts';

        $result = $this->callApi(
            $url,
            'GET',
            null,
            [
                'access_token' => $token
            ]
        );

        if (!empty($result['error'])) {
            return [
                'success' => false,
                'message' => $result['error']['message'],
                'response' => $result
            ];
        }

        return [
            'success' => true,
            'data' => $result
        ];
    }

    /**
     * Get phone numbers belonging to WABA.
     */
    public function getPhoneNumbers($waba_id, $token)
    {
        if (empty($waba_id) || empty($token)) {
            return [
                'success' => false,
                'message' => 'WABA ID or access token is missing.'
            ];
        }

        $url = 'https://graph.facebook.com/'
             . $this->api_version
             . '/'
             . rawurlencode($waba_id)
             . '/phone_numbers';

        $result = $this->callApi(
            $url,
            'GET',
            null,
            [
                'access_token' => $token
            ]
        );

        if (!empty($result['error'])) {
            return [
                'success' => false,
                'message' => $result['error']['message'],
                'response' => $result
            ];
        }

        return [
            'success' => true,
            'data' => $result
        ];
    }

    /**
     * Resolve WABA ID from User Access Token using debug_token, businesses, or client accounts.
     */
    public function getWabaFromToken($token)
    {
        // 1. Check debug_token for granular_scopes (official Meta Embedded Signup mechanism)
        $debugUrl = 'https://graph.facebook.com/' . $this->api_version . '/debug_token';
        $appToken = $this->app_id . '|' . $this->app_secret;
        $debug = $this->callApi($debugUrl, 'GET', null, [
            'input_token'  => $token,
            'access_token' => $appToken
        ]);

        if (!empty($debug['data']['granular_scopes'])) {
            foreach ($debug['data']['granular_scopes'] as $scope) {
                if (
                    !empty($scope['scope']) &&
                    $scope['scope'] === 'whatsapp_business_management' &&
                    !empty($scope['target_ids'])
                ) {
                    return [
                        'success' => true,
                        'waba_id' => $scope['target_ids'][0]
                    ];
                }
            }
        }

        // 2. Check /me/businesses -> {business_id}/owned_whatsapp_business_accounts
        $meBusUrl = 'https://graph.facebook.com/' . $this->api_version . '/me/businesses';
        $businesses = $this->callApi($meBusUrl, 'GET', null, ['access_token' => $token]);
        if (!empty($businesses['data'])) {
            foreach ($businesses['data'] as $b) {
                if (!empty($b['id'])) {
                    $waba = $this->getWaba($b['id'], $token);
                    if (!empty($waba['data']['data'][0]['id'])) {
                        return [
                            'success'     => true,
                            'business_id' => $b['id'],
                            'waba_id'     => $waba['data']['data'][0]['id']
                        ];
                    }
                }
            }
        }

        // 3. Check /me/client_whatsapp_business_accounts
        $clientWabaUrl = 'https://graph.facebook.com/' . $this->api_version . '/me/client_whatsapp_business_accounts';
        $clientWaba = $this->callApi($clientWabaUrl, 'GET', null, ['access_token' => $token]);
        if (!empty($clientWaba['data'][0]['id'])) {
            return [
                'success' => true,
                'waba_id' => $clientWaba['data'][0]['id']
            ];
        }

        return [
            'success' => false,
            'message' => 'No WhatsApp Business Account was found. Please ensure you selected a WABA during Embedded Signup.',
            'debug'   => $debug
        ];
    }

    /**
     * Connect company using Embedded Signup authorization code.
     */
    public function connectBusiness($company_id, $code, $redirect_uri = null, $provided_waba_id = null, $provided_phone_id = null)
    {
        if (empty($company_id)) {
            return [
                'success' => false,
                'message' => 'Company ID is missing.'
            ];
        }

        if (empty($code)) {
            return [
                'success' => false,
                'message' => 'Authorization code is missing.'
            ];
        }

        /*
         * 1. Exchange code for token.
         */
        $tokenData = $this->exchangeToken(
            $code,
            $redirect_uri
        );

        if (empty($tokenData['success'])) {
            return $tokenData;
        }

        $token = $tokenData['access_token'];

        /*
         * 2. Find WABA ID (prefer provided WABA ID from Embedded Signup event, fallback to token lookup).
         */
        $business_id = null;
        if (!empty($provided_waba_id)) {
            $waba_id = $provided_waba_id;
        } else {
            $wabaInfo = $this->getWabaFromToken($token);

            if (empty($wabaInfo['success'])) {
                return $wabaInfo;
            }

            $waba_id = $wabaInfo['waba_id'];
            $business_id = !empty($wabaInfo['business_id']) ? $wabaInfo['business_id'] : null;
        }

        /*
         * 3. Get phone numbers.
         */
        if (!empty($provided_phone_id)) {
            $phone_id = $provided_phone_id;
            $phoneDetails = $this->getPhoneNumberDetails($phone_id, $token);
            $display_phone = !empty($phoneDetails['data']['display_phone_number'])
                ? $phoneDetails['data']['display_phone_number']
                : (!empty($phoneDetails['data']['verified_name']) ? $phoneDetails['data']['verified_name'] : $phone_id);
        } else {
            $phones = $this->getPhoneNumbers(
                $waba_id,
                $token
            );

            if (empty($phones['success'])) {
                return $phones;
            }

            if (
                empty($phones['data']['data']) ||
                empty($phones['data']['data'][0]['id'])
            ) {
                return [
                    'success' => false,
                    'message' => 'No WhatsApp phone number was found.',
                    'response' => $phones
                ];
            }

            $phone = $phones['data']['data'][0];
            $phone_id = $phone['id'];
            $display_phone = !empty($phone['display_phone_number'])
                ? $phone['display_phone_number']
                : '';
        }

        /*
         * 5. Save company-specific connection.
         */
        $save = [
            'company_id'      => $company_id,
            'business_id'     => $business_id,
            'waba_id'         => $waba_id,
            'phone_number_id' => $phone_id,
            'whatsapp_number' => $display_phone,
            'access_token'    => $token,
            'whatsapp_enabled'=> 1,
            'connection_type' => 'META_EMBEDDED',
            'connection_status'=> 'CONNECTED',
            'connected_at'    => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s')
        ];

        /*
         * Don't delete the company row.
         * Update if it exists, otherwise insert.
         */
        $existing = $this->CI->db
            ->get_where(
                'whatsapp_settings',
                [
                    'company_id' => $company_id
                ]
            )
            ->row();

        $saveData = $this->filterTableFields('whatsapp_settings', $save);

        if ($existing) {

            $this->CI->db
                ->where('company_id', $company_id)
                ->update(
                    'whatsapp_settings',
                    $saveData
                );

        } else {

            $save['created_at'] = date('Y-m-d H:i:s');
            $saveData = $this->filterTableFields('whatsapp_settings', $save);

            $this->CI->db->insert(
                'whatsapp_settings',
                $saveData
            );
        }

        return [
            'success' => true,
            'message' => 'WhatsApp connected successfully.',
            'data' => $save
        ];
    }

    /**
     * Get company WhatsApp settings.
     */
    public function getSettings($company_id)
    {
        if (empty($company_id)) {
            return null;
        }

        return $this->CI->db
            ->get_where(
                'whatsapp_settings',
                [
                    'company_id' => $company_id
                ]
            )
            ->row();
    }

    /**
     * Check whether company has a WhatsApp connection.
     */
    public function isConnected($company_id)
    {
        $settings = $this->getSettings($company_id);

        if (!$settings) {
            return false;
        }

        if (
            empty($settings->access_token) ||
            empty($settings->phone_number_id)
        ) {
            return false;
        }

        if (
            isset($settings->connection_status) &&
            $settings->connection_status !== 'CONNECTED'
        ) {
            return false;
        }

        return true;
    }

    /**
     * Test the company's WhatsApp phone number.
     */
    public function testConnection($company_id)
    {
        $settings = $this->getSettings($company_id);

        if (!$settings) {
            return [
                'success' => false,
                'message' => 'WhatsApp is not configured.'
            ];
        }

        if (
            empty($settings->access_token) ||
            empty($settings->phone_number_id)
        ) {
            return [
                'success' => false,
                'message' => 'WhatsApp credentials are incomplete.'
            ];
        }

        $url = 'https://graph.facebook.com/'
             . $this->api_version
             . '/'
             . rawurlencode($settings->phone_number_id);

        $result = $this->callApi(
            $url,
            'GET',
            null,
            [
                'access_token' => $settings->access_token
            ]
        );

        if (!empty($result['error'])) {

            $this->CI->db
                ->where('company_id', $company_id)
                ->update(
                    'whatsapp_settings',
                    [
                        'connection_status' => 'DISCONNECTED',
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                );

            return [
                'success' => false,
                'message' => $result['error']['message'],
                'response' => $result
            ];
        }

        $this->CI->db
            ->where('company_id', $company_id)
            ->update(
                'whatsapp_settings',
                [
                    'connection_status' => 'CONNECTED',
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );

        return [
            'success' => true,
            'message' => 'WhatsApp connection is working.',
            'data' => $result
        ];
    }

    /**
     * Save manually supplied Cloud API credentials.
     */
    public function saveManualConnection(
        $company_id,
        $phone_number,
        $phone_number_id,
        $access_token
    ) {
        if (empty($company_id)) {
            return [
                'success' => false,
                'message' => 'Company ID is missing.'
            ];
        }

        if (
            empty($phone_number_id) ||
            empty($access_token)
        ) {
            return [
                'success' => false,
                'message' => 'Phone Number ID and Access Token are required.'
            ];
        }

        /*
         * Validate credentials before marking them connected.
         */
        $test = $this->testRawConnection(
            $phone_number_id,
            $access_token
        );

        if (empty($test['success'])) {
            return $test;
        }

        $existing = $this->getSettings($company_id);

        $save = [
            'company_id' => $company_id,
            'phone_number_id' => $phone_number_id,
            'whatsapp_number' => $phone_number,
            'access_token' => $access_token,
            'whatsapp_enabled' => 1,
            'connection_type' => 'MANUAL',
            'connection_status' => 'CONNECTED',
            'connected_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $saveData = $this->filterTableFields('whatsapp_settings', $save);

        if ($existing) {

            $this->CI->db
                ->where('company_id', $company_id)
                ->update(
                    'whatsapp_settings',
                    $saveData
                );

        } else {

            $save['created_at'] = date('Y-m-d H:i:s');
            $saveData = $this->filterTableFields('whatsapp_settings', $save);

            $this->CI->db
                ->insert(
                    'whatsapp_settings',
                    $saveData
                );
        }

        return [
            'success' => true,
            'message' => 'WhatsApp credentials saved successfully.'
        ];
    }

    /**
     * Test raw Phone Number ID + access token.
     */
    public function testRawConnection(
        $phone_number_id,
        $access_token
    ) {
        $url = 'https://graph.facebook.com/'
             . $this->api_version
             . '/'
             . rawurlencode($phone_number_id);

        $result = $this->callApi(
            $url,
            'GET',
            null,
            [
                'access_token' => $access_token
            ]
        );

        if (!empty($result['error'])) {

            return [
                'success' => false,
                'message' => $result['error']['message'],
                'response' => $result
            ];
        }

        return [
            'success' => true,
            'data' => $result
        ];
    }

    /**
     * Send WhatsApp message using company credentials.
     *
     * NOTE:
     * For production business-initiated conversations,
     * use an approved Meta WhatsApp template where required.
     */
    public function send_message(
        $company_id,
        $mobile,
        $message
    ) {
        $settings = $this->getSettings($company_id);

        if (!$settings) {
            return [
                'success' => false,
                'message' => 'WhatsApp is not configured for this company.'
            ];
        }

        if (
            empty($settings->access_token) ||
            empty($settings->phone_number_id)
        ) {
            return [
                'success' => false,
                'message' => 'WhatsApp credentials are incomplete.'
            ];
        }

        if (empty($mobile)) {
            return [
                'success' => false,
                'message' => 'Customer mobile number is missing.'
            ];
        }

        $mobile = $this->normalizePhone($mobile);

        if (empty($mobile)) {
            return [
                'success' => false,
                'message' => 'Invalid customer mobile number.'
            ];
        }

        $url = 'https://graph.facebook.com/'
             . $this->api_version
             . '/'
             . rawurlencode($settings->phone_number_id)
             . '/messages';

        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $mobile,
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' => $message
            ]
        ];

        $result = $this->callApi(
            $url,
            'POST',
            $payload,
            [
                'Authorization: Bearer ' . $settings->access_token,
                'Content-Type: application/json'
            ]
        );

        if (!empty($result['error'])) {

            return [
                'success' => false,
                'message' => $result['error']['message'],
                'response' => $result
            ];
        }

        return [
            'success' => true,
            'message' => 'WhatsApp message sent.',
            'response' => $result
        ];
    }

    /**
     * Disconnect WhatsApp for company.
     */
    public function disconnect($company_id)
    {
        if (empty($company_id)) {
            return false;
        }

        return $this->CI->db
            ->where('company_id', $company_id)
            ->update(
                'whatsapp_settings',
                [
                    'whatsapp_enabled' => 0,
                    'connection_status' => 'DISCONNECTED',
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
    }

    /**
     * Normalize customer phone.
     *
     * Do NOT hardcode country code 91.
     * Store/use customer numbers with country code.
     */
    private function normalizePhone($phone)
    {
        $phone = trim($phone);

        if ($phone === '') {
            return '';
        }

        $phone = preg_replace('/[^0-9+]/', '', $phone);

        if (strpos($phone, '+') === 0) {
            $phone = substr($phone, 1);
        }

        /*
         * WhatsApp API expects international number.
         * We intentionally do not guess the country code.
         */
        if (strlen($phone) < 8) {
            return '';
        }

        return $phone;
    }

    /**
     * Generic Graph API request.
     */
    private function callApi(
        $url,
        $method = 'GET',
        $body = null,
        $paramsOrHeaders = []
    ) {
        $ch = curl_init();

        if ($method === 'GET') {

            if (!empty($paramsOrHeaders)) {

                $separator = (strpos($url, '?') !== false)
                    ? '&'
                    : '?';

                $url .= $separator .
                    http_build_query($paramsOrHeaders);
            }

        } else {

            if (!empty($paramsOrHeaders)) {

                foreach ($paramsOrHeaders as $header) {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $paramsOrHeaders);
                    break;
                }
            }

            if (!empty($body)) {
                curl_setopt(
                    $ch,
                    CURLOPT_POSTFIELDS,
                    json_encode($body)
                );
            }
        }

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true
        ]);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);

            /*
             * paramsOrHeaders is already being used as headers
             * for POST requests.
             */
            if (!empty($paramsOrHeaders)) {
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    $paramsOrHeaders
                );
            }
        }

        $response = curl_exec($ch);

        $curl_error = curl_error($ch);

        $http_code = curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

        curl_close($ch);

        if ($response === false) {

            return [
                'error' => [
                    'message' => $curl_error ?: 'cURL request failed.'
                ],
                'http_code' => $http_code
            ];
        }

        $decoded = json_decode(
            $response,
            true
        );

        if (!is_array($decoded)) {

            return [
                'error' => [
                    'message' => 'Invalid response received from Meta.'
                ],
                'http_code' => $http_code,
                'raw_response' => $response
            ];
        }

        $decoded['http_code'] = $http_code;

        return $decoded;
    }

    /**
     * Filter associative data array by columns that actually exist in the table.
     */
    private function filterTableFields($table, array $data)
    {
        if ($this->CI->db->table_exists($table)) {
            $fields = $this->CI->db->list_fields($table);
            if (!empty($fields)) {
                return array_intersect_key($data, array_flip($fields));
            }
        }

        return $data;
    }
}