<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Public Legal Controller for Meta / WhatsApp Verification & General Compliance.
 * Extends CI_Controller directly (NOT MY_Controller) to allow public access without authentication.
 */
class Legal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $this->privacy();
    }

    public function privacy()
    {
        $data['title'] = 'Privacy Policy | GMS ERP';
        $data['last_updated'] = 'September 24, 2026';
        $this->load->view('legal/privacy_policy', $data);
    }

    public function terms()
    {
        $data['title'] = 'Terms of Service | GMS ERP';
        $data['last_updated'] = 'September 24, 2026';
        $this->load->view('legal/terms_of_service', $data);
    }
}
