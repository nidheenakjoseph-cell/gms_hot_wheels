<?php

class Whatsapp
{
    private $access_token;
    private $phone_number_id;

    public function __construct()
    {
        $CI =& get_instance();

        $CI->config->load('whatsapp');

        $this->access_token =
            $CI->config->item('wa_access_token');

        $this->phone_number_id =
            $CI->config->item('wa_phone_number_id');
    }
    public function sendText($mobile, $message)
{
    $url = "https://graph.facebook.com/v23.0/" .
           $this->phone_number_id .
           "/messages";

    $payload = [
        "messaging_product" => "whatsapp",
        "to" => $mobile,
        "type" => "text",
        "text" => [
            "body" => $message
        ]
    ];

    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer ".$this->access_token,
            "Content-Type: application/json"
        ],
        CURLOPT_POSTFIELDS => json_encode($payload)
    ]);

    $response = curl_exec($ch);

    $result = [
        'http_code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
        'curl_error' => curl_error($ch),
        'response' => json_decode($response, true)
    ];

    curl_close($ch);

    return $result;
}

// public function sendTemplate(
//     $mobile,
//     $template_name,
//     $parameters = []
// )
// {
//     $url = "https://graph.facebook.com/v25.0/" .
//             $this->phone_number_id .
//             "/messages";

//     $components = [];

//     if(!empty($parameters))
//     {
//         $body_parameters = [];

//         foreach($parameters as $value)
//         {
//             $body_parameters[] = [
//                 "type" => "text",
//                 "text" => $value
//             ];
//         }

//         $components[] = [
//             "type" => "body",
//             "parameters" => $body_parameters
//         ];
//     }

//     $payload = [
//         "messaging_product" => "whatsapp",
//         "to" => $mobile,
//         "type" => "template",
//         "template" => [
//             "name" => $template_name,
//             "language" => [
//                 "code" => "en"
//             ],
//             "components" => $components
//         ]
//     ];

//     $ch = curl_init();

//     curl_setopt_array($ch,[
//         CURLOPT_URL => $url,
//         CURLOPT_POST => true,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_HTTPHEADER => [
//             "Authorization: Bearer ".$this->access_token,
//             "Content-Type: application/json"
//         ],
//         CURLOPT_POSTFIELDS => json_encode($payload)
//     ]);

//     $response = curl_exec($ch);

//     curl_close($ch);

//     return json_decode($response,true);
// }
public function sendTemplate(
    $mobile,
    $template_name,
    $parameters = []
)
{
    $url = "https://graph.facebook.com/v25.0/" .
            $this->phone_number_id .
            "/messages";

    $components = [];

    if(!empty($parameters))
    {
        $body_parameters = [];

        foreach($parameters as $value)
        {
            $body_parameters[] = [
                "type" => "text",
                "text" => $value
            ];
        }

        $components[] = [
            "type" => "body",
            "parameters" => $body_parameters
        ];
    }

    $payload = [
        "messaging_product" => "whatsapp",
        "to" => $mobile,
        "type" => "template",
        "template" => [
            "name" => $template_name,
            "language" => [
                "code" => "en"
            ],
            "components" => $components
        ]
    ];

    $ch = curl_init();

    curl_setopt_array($ch,[
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer ".$this->access_token,
            "Content-Type: application/json"
        ],
        CURLOPT_POSTFIELDS => json_encode($payload)
    ]);

    $response = curl_exec($ch);

    curl_close($ch);

    return json_decode($response,true);
}
}