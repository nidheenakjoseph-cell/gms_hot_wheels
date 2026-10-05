<?php

class Whatsapp_integration extends MY_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function generate()
	{
		$data['title'] = 'WhatsApp Integration';

		// Get all invoices with customer & vehicle details
		$data['invoices'] = "";
        // $this->Invoice_model->get_all_invoices();

		$data['main_content'] = 'whatsapp/generate';
		$this->load->view('includes/template', $data);
	}

    public function save_whatsapp()
    {
        $company_id = get_current_company_id();

        $data = [
            'company_id'       => $company_id,
            'whatsapp_number'  => $this->input->post('whatsapp_number'),
            'phone_number_id'  => $this->input->post('phone_number_id'),
            'access_token'     => $this->input->post('access_token'),
            'updated_at'       => date('Y-m-d H:i:s')
        ];

        $exists = $this->db
                    ->where('company_id',$company_id)
                    ->get('company_whatsapp')
                    ->row();

        if($exists)
        {
            $this->db->where('company_id',$company_id)
                    ->update('company_whatsapp',$data);
        }
        else
        {
            $data['created_at']=date('Y-m-d H:i:s');

            $this->db->insert(
                'company_whatsapp',
                $data
            );
        }
    }

    public function sendText($company_id,$mobile,$message)
    {
        $CI =& get_instance();

        $wa = $CI->db
                ->where('company_id',$company_id)
                ->get('company_whatsapp')
                ->row();

        if(!$wa)
        {
            return [
                'status' => false,
                'message' => 'WhatsApp not configured'
            ];
        }

        $access_token   = $wa->access_token;
        $phone_number_id = $wa->phone_number_id;

        // send using these values
    }

    public function sendText()
{
    $company_id = get_current_company_id();

    $this->load->library('Whatsapp');

    $result =
    $this->whatsapp->sendTemplate(
        $this->input->post('mobile'),
        'hello_world'
    );

    echo json_encode($result);
}




    public function send()
    {
        $this->load->library('Whatsapp');

        $result = $this->whatsapp->sendText(
            '919495192262',
            'Hello from GMS'
        );

        echo '<pre>';
        print_r($result);
    }

    public function template()
    {
        $this->load->library('Whatsapp');

        // $result = $this->whatsapp->sendTemplate(
        //     '919495192262'
        // );

       $result = $this->whatsapp->sendTemplate(
    "919495192262",
    'job_card_created',
    [
        "test",
        "6666",
        "hhh"
    ]
);

        echo '<pre>';
        print_r($result);
    }
}
?>
