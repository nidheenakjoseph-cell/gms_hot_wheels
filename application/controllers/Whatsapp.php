<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function callback()
    {
        $code = $this->input->get('code');

        if (empty($code))
        {
            show_error('Authorization code missing');
        }

        $company_id = get_current_company_id();

        if (empty($company_id))
        {
            show_error('Company not identified in session');
        }

        $this->load->library('Whatsapp_library');

        $result = $this->whatsapp_library->connectBusiness(
            $company_id,
            $code
        );

        echo '<pre>';
        print_r($result);
        exit;
    }
}

