<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alerts extends MY_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('gms_mailer');
    }

    /**
     * Workflow: Triggered when a new job card is checked in
     */
    public function trigger_jobcard($jobcard_id) 
    {
        // Fetch matching metadata fields from your database (Mocked values shown below)
        $customer_email = 'customer@example.com';
    
        $placeholders = [
            '{customer_name}' => 'John Doe',
            '{vehicle_no}'    => 'MH-12-AB-1234',
            '{jobcard_no}'    => 'JC-2026-904',
            '{est_delivery}'  => '2026-06-26 05:00 PM'
        ];

        $result = $this->gms_mailer->send_notification($customer_email, 'jobcard_created', $placeholders, null, get_current_company_id());
        echo json_encode($result);
    }

    /**
     * Workflow: Triggered when a quotation is generated
     */
    public function trigger_quotation($quotation_id) 
    {
        $customer_email = 'customer@example.com';
        
        $placeholders = [
            '{customer_name}' => 'John Doe',
            '{vehicle_no}'    => 'MH-12-AB-1234',
            '{quotation_no}'  => 'QT-88392',
            '{amount}'        => '8,450.00',
            '{date}'          => date('d/m/Y'),
            '{company_name}'  => 'Demo Garage Solutions LLC'
        ];

        // Optional: Reference file generation paths to add an attachment
        $pdf_file_path = FCPATH . 'uploads/quotations/QT-88392.pdf';

        $result = $this->gms_mailer->send_notification($customer_email, 'quotation_sent', $placeholders, $pdf_file_path, get_current_company_id());
        echo json_encode($result);
    }

    /**
     * Workflow: Triggered when the final invoice is closed
     */
    public function trigger_invoice($invoice_id) 
    {
        $customer_email = 'customer@example.com';
        
        $placeholders = [
            '{customer_name}' => 'John Doe',
            '{vehicle_no}'    => 'MH-12-AB-1234',
            '{invoice_no}'    => 'INV-2026-004',
            '{amount}'        => '12,300.00',
            '{date}'          => date('d/m/Y'),
            '{company_name}'  => 'Demo Garage Solutions LLC'
        ];

        $pdf_file_path = FCPATH . 'uploads/invoices/INV-2026-004.pdf';

        $result = $this->gms_mailer->send_notification($customer_email, 'invoice_sent', $placeholders, $pdf_file_path, get_current_company_id());
        echo json_encode($result);
    }
}

