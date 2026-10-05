<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class DirectInvoice extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Quotation_model');
        $this->load->model('Estimation_model');
        $this->load->model('Inspection_view_model');
        $this->load->model('SpareParts_model');
        $this->load->model('Customer_model');
        $this->load->model('Vehicle_model');
        $this->load->model('Jobcard_model');
        $this->load->helper('amount');
        $this->load->model('Accounts_model');


        $this->load->model('Supplier_model');
        $this->load->model('Direct_quotation_model');

        $this->load->model('Direct_Invoice_Model');

        $this->load->model('Service_model');
    }
    // public function index()
    // {
    //     $data['title'] = 'Invoice List';

    //     // Get all invoices with customer & vehicle details
    //     $data['invoices'] = $this->Invoice_model->get_all_invoices();
    //     $data['jobcards'] = $this->Jobcard_model->get_all_jobcards_completed();



    //     $data['sundry_accounts1'] = $this->Accounts_model->get_gen_ledger_detors_records();
    //     $data['sundry_accounts2'] = $this->Accounts_model->get_general_ledger_by_group('Sales Accounts');
    //     $data['sundry_accounts3'] = $this->Accounts_model->get_all_general_ledger_accounts();

    //     // log_message('error', 'Sundry Accounts 1 (Debtors): ' . print_r($data['sundry_accounts1'], true));
    //     // log_message('error', 'Sundry Accounts 2 (Sales Accounts): ' . print_r($data['sundry_accounts2'], true));
    //     // log_message('error', 'Sundry Accounts 3 (All GL Accounts): ' . print_r($data['sundry_accounts3'], true));




    //     $data['main_content'] = 'direct_invoice/generate_direct_invoice';
    //     $this->load->view('includes/template', $data);
    // }

    // public function generate()
    // {
    //     $data['title'] = 'Invoice List';
    //     $data['username'] = $this->session->userdata('username');
    //     $data['userid'] = $this->session->userdata('user_id');

    //     $data['invoices'] = $this->Invoice_model->get_all_invoices_with_payment();
    //     // log_message('error', 'Invoice List: ' . print_r($data['invoices'], true));
    //     $data['main_content'] = 'invoice/index';
    //     $this->load->view('includes/template', $data);
    // }



    public function index()

    {
        $data['title'] = 'Direct Invoice';


        ////////////////////////////////start quotations code//////////////////


        $year = date('Y');

        $last = $this->db
            ->like('invoice_no', "INVD-$year-", 'after')
            ->order_by('invoice_id', 'DESC')
            ->limit(1)
            ->get('direct_invoices')
            ->row();

        if ($last) {
            $last_no = intval(substr($last->invoice_no, -4));
            $new_no  = str_pad($last_no + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $new_no = '0001';
        }

        $data['invoice_no'] = "INVD-$year-$new_no";
        /////////////////////////////////////////////





        $data['username'] = $this->session->userdata('username');
        $data['userid'] = $this->session->userdata('user_id');


        $this->load->model('Direct_quotation_model');
        $data['services_master'] = $this->Direct_quotation_model->get_all_services();


        $data['parts'] = $this->SpareParts_model->get_all_parts();
        $data['brands'] = $this->SpareParts_model->get_all_brands();
        $data['unit_records'] = $this->Supplier_model->get_units();
        $data['Newparts'] = $this->SpareParts_model
            ->get_parts_by_part_type("New Parts");

        $data['afterparts'] = $this->SpareParts_model
            ->get_parts_by_part_type("Aftermarket Parts");

        $data['usedparts'] = $this->SpareParts_model
            ->get_parts_by_part_type("Used Parts");

        // print_r($data['brands']);
        // exit;


        $data['sundry_accounts1'] = $this->Accounts_model->get_gen_ledger_detors_records();
        $data['sundry_accounts2'] = $this->Accounts_model->get_general_ledger_by_group('Sales Accounts');
        $data['sundry_accounts3'] = $this->Accounts_model->get_all_general_ledger_accounts();


        $data['main_content'] = 'direct_invoice/generate_direct_invoice';
        $this->load->view('includes/template', $data);
    }


    public function add_invoice()
    {
        $post = $this->input->post();
        $invoice_date = $post['edate'] ?? date('Y-m-d');

        $data = [
            'branch_id'           => $post['branch_id'] ?? get_primary_branch_id(),
            'subtotal'            => $post['subtotal'] ?? 0,
            'tax_amount'          => $post['tax_amount'] ?? 0,
            'tdiscount'           => $post['tdiscount'] ?? 0,
            'grand_total'         => $post['grand_total'] ?? 0,
            'remarks'             => $post['remarks'] ?? '',
            'status'              => 'Approved',
            'invoice_type'        => 'TI',
            'srvice_discount'     => $post['service_discount'] ?? 0,
            'sublet_discount'     => $post['sublet_discount'] ?? 0,
            'quotation_date'      => $invoice_date,
            'est_delivery_date'   => $post['estdeldate'] ?? null,
            'est_completion_time' => $post['completiontime'] ?? null,
            'customer_estimated_price' => $post['estimatedprice'] ?? 0,
            'part_id'             => $post['part_id'] ?? [],
            'part_qty'            => $post['part_qty'] ?? [],
            'unit_price'          => $post['unit_price'] ?? [],
            'selling_price'       => $post['selling_price'] ?? [],
            'total_price'         => $post['total_price'] ?? [],
            'discount'            => $post['discount'] ?? [],
            'discountamt'         => $post['discountamt'] ?? [],
            'part_type'           => $post['part_type'] ?? [],
            'customer_selected'   => $post['customer_selected'] ?? [],
            'partremarks'         => $post['part_warrenty'] ?? [],
            'service_id'          => $post['service_id'] ?? [],
            'service_time'        => $post['service_time'] ?? [],
            'service_cost'        => $post['service_cost'] ?? [],
            'total_cost'          => $post['total_cost'] ?? [],
            'job_description'     => $post['job_description'] ?? [],
            'job_amount'          => $post['job_amount'] ?? [],
            'kmin'                => $post['kmin'] ?? '',
            'completiontime'      => $post['completiontime'] ?? '',
            'estdeldate'          => $post['estdeldate'] ?? '',
            'vehicle_vinNo'       => $post['vehicle_vinNo'] ?? '',
            'vehicle_numberPlate' => $post['vehicle_numberPlate'] ?? '',
            'vehicle_model'       => $post['vehicle_model'] ?? '',
            'quotation_time'      => $post['quotation_time'] ?? '',
            'invoice_no'          => $post['invoice_no'] ?? '',
            'customer_name'       => $post['customer_name'] ?? '',
            'customer_contact'    => $post['customer_contact'] ?? '',
            'customer_email'      => $post['customer_email'] ?? '',
            'customer_approval'   => $post['customer_approval'] ?? '',
            'adv_paid'            => $post['advance_paid'] ?? 0,
            'balance_after_invoice' => $post['balance_total'] ?? 0,
        ];

        $this->db->trans_begin();
        try {
            $result = $this->Direct_Invoice_Model->saveInvoice($data);
            if (!$result) {
                throw new RuntimeException('Invoice could not be saved.');
            }
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Invoice Added Successfully');
            redirect('DirectInvoice/invoice_list/');
        } catch (RuntimeException $e) {
            $this->db->trans_rollback();
            log_message('error', '[DIRECT_INVOICE] Save failed: ' . $e->getMessage());
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('DirectInvoice/');
        }
    }


    public function invoice_list()
    {

        $data['title'] = 'Direct Invoice List';
        $data['quotations'] = $this->Direct_Invoice_Model->get_all_invoice();
        $company_id = get_current_company_id();
        $wa_settings = $this->db->get_where('whatsapp_settings', ['company_id' => $company_id])->row();
        $data['whatsapp_enabled'] = !empty($wa_settings->whatsapp_enabled);



        $data['main_content'] = 'direct_invoice/list_direct_invoice';
        $this->load->view('includes/template', $data);
    }

    public function send_email($invoice_id)
    {
        $invoice = $this->Direct_Invoice_Model->get_Invoice($invoice_id);
        if (!$invoice) return $this->email_response(false, 'Direct invoice not found.');
        $recipient = trim($this->input->post('email')) ?: ($invoice->customer_email ?? '');
        if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) return $this->email_response(false, 'Please enter a valid email address.');

        $data = [
            'document_type' => 'Direct Invoice', 'document_no' => $invoice->invoice_no, 'document_date' => $invoice->invoice_date,
            'customer_name' => $invoice->customer_name, 'vehicle_no' => $invoice->vehicle_numberPlate,
            'items' => array_merge($this->Direct_Invoice_Model->get_services($invoice_id), $this->Direct_Invoice_Model->get_parts_type_forquote($invoice_id, 'New Parts'), $this->Direct_Invoice_Model->get_parts_type_forquote($invoice_id, 'Aftermarket Parts'), $this->Direct_Invoice_Model->get_parts_type_forquote($invoice_id, 'Used Parts'), $this->Direct_Invoice_Model->get_job_descriptions($invoice_id)),
            'total' => $invoice->grand_total,
        ];
        $options = new Options(); $options->set('isRemoteEnabled', true); $dompdf = new Dompdf($options);
        $dompdf->loadHtml($this->load->view('email/document_pdf', $data, true)); $dompdf->setPaper('A4', 'portrait'); $dompdf->render();
        $cache_dir = FCPATH . 'application/cache/';
        if (!is_dir($cache_dir)) { mkdir($cache_dir, 0755, true); }
        $pdf_path = $cache_dir . 'direct_invoice_' . $invoice_id . '_' . uniqid() . '.pdf'; file_put_contents($pdf_path, $dompdf->output());
        $this->load->library('gms_mailer');
        $company_id   = get_current_company_id();
        $company_name = $this->gms_mailer->get_company_name($company_id);
        $result = $this->gms_mailer->send_notification($recipient, 'invoice_sent', [
            '{customer_name}' => $invoice->customer_name, '{vehicle_no}' => $invoice->vehicle_numberPlate,
            '{invoice_no}' => $invoice->invoice_no,
            '{amount}' => number_format((float) $invoice->grand_total, 2),
            '{invoice_amount}' => number_format((float) $invoice->grand_total, 2),
            '{date}' => date('d/m/Y', strtotime($invoice->invoice_date)), '{company_name}' => $company_name,
        ], $pdf_path, $company_id);
        @unlink($pdf_path);
        return $this->email_response($result['status'], $result['message']);
    }

    private function email_response($status, $message)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode(['status' => (bool) $status, 'message' => $message]));
    }

    public function delete($invoice_id)
    {
        $this->Direct_Invoice_Model->delete_invoice($invoice_id);

        redirect('DirectInvoice/invoice_list');
    }
    public function edit($invoice_id)
    {

        $data['username'] = $this->session->userdata('username');
        $data['userid'] = $this->session->userdata('user_id');

        // 1️⃣ Get estimation header
        $data['invoice'] = $this->Direct_Invoice_Model->get_Invoice($invoice_id);
        if (!($data['invoice'])) show_404();


        // print_r($data['quotation'] );
        // exit;
        // get customer and vehicle details

        // Customer from inspection
        // $customer = $this->Customer_model
        // 	->get_customer($estimation->customer_id);

        // Vehicle from inspection
        // $vehicle = $this->Vehicle_model
        // 	->get_vehicle($estimation->vehicle_id);


        // 2️⃣ Appointment + customer + vehicle
        // $appointment = $this->Estimation_model
        // 	->get_appointment_details($estimation->appointment_id);

        // 3️⃣ Sub tables
        // $job_descriptions = $this->Estimation_model
        // 	->get_job_descriptions($estimation_id);

        // $parts_used = $this->Estimation_model
        // 	->get_parts($estimation_id);

        // $parts_used_new = $this->Estimation_model
        // 	->get_parts_type($estimation_id, "New Parts");

        // $parts_used_after = $this->Estimation_model
        // 	->get_parts_type($estimation_id, "Aftermarket Parts");

        // $parts_used_used = $this->Estimation_model
        // 	->get_parts_type($estimation_id, "Used Parts");


        $parts_used_new = $this->Direct_Invoice_Model
            ->get_parts_type_forquote($data['invoice']->invoice_id, "New Parts");

        $parts_used_after = $this->Direct_Invoice_Model
            ->get_parts_type_forquote($data['invoice']->invoice_id, "Aftermarket Parts");

        $parts_used_used = $this->Direct_Invoice_Model
            ->get_parts_type_forquote($data['invoice']->invoice_id, "Used Parts");

        $services_used = $this->Direct_Invoice_Model
            ->get_services($invoice_id);


        $job_descriptions = $this->Direct_Invoice_Model
            ->get_job_descriptions($invoice_id);


        // 4️⃣ Masters (dropdown data)
        $data['parts'] = $this->SpareParts_model->get_all_parts();
        $data['brands'] = $this->SpareParts_model->get_all_brands();


        $data['services_master'] = $this->db->where('status', 'Active')
            ->get('services_master')
            ->result();




        // $inspection = $this->Inspection_view_model->get_by_inspection($estimation->inspection_id);
        // $data['kms'] = $inspection->km_reading ?? $estimation->kmin;
        // $data['estdate'] = $inspection->deliverytime ?? $estimation->est_completion_time;



        // $data['technicians'] = $this->Employee_model->get_active_technicians();
        $data['service_discount'] = $estimation->service_discount ?? null;
        $data['sublet_discount'] = $estimation->sublet_discount ?? null;

        $data['unit_records'] = $this->Supplier_model->get_units();

        $data['usedbrands'] = $this->SpareParts_model
            ->get_brands_by_part_type("Used Parts");
        $data['newbrands'] = $this->SpareParts_model
            ->get_brands_by_part_type("New Parts");
        $data['afterbrands'] = $this->SpareParts_model
            ->get_brands_by_part_type("Aftermarket Parts");

        $data['Newparts'] = $this->SpareParts_model
            ->get_parts_by_part_type("New Parts");

        $data['afterparts'] = $this->SpareParts_model
            ->get_parts_by_part_type("Aftermarket Parts");
        $data['usedparts'] = $this->SpareParts_model
            ->get_parts_by_part_type("Used Parts");

        // 5️⃣ Send data to view
        // $data['estimation']       = $estimation;
        // $data['appointment']      = $appointment;

        // $data['customer']      = $customer;
        // $data['vehicle']      = $vehicle;
        // $data['parts_used']       = $parts_used;
        $data['parts_used_new']       = $parts_used_new;
        $data['parts_used_after']       = $parts_used_after;
        $data['parts_used_used']       = $parts_used_used;
        $data['services_used']    = $services_used;
        $data['job_descriptions'] = $job_descriptions;


        // $data['estimation_id'] = $estimation_id;
        // $data['estimation_no'] = $estimation->estimation_no;


        $data['sundry_accounts1'] = $this->Accounts_model->get_gen_ledger_detors_records();
        $data['sundry_accounts2'] = $this->Accounts_model->get_general_ledger_by_group('Sales Accounts');
        $data['sundry_accounts3'] = $this->Accounts_model->get_all_general_ledger_accounts();


        $data['title'] = 'Invoice Edit';




        $data['main_content'] = 'direct_invoice/edit_direct_invoice';
        $this->load->view('includes/template', $data);
    }


    public function update()
    {
        $invoice_id      = $this->input->post('invoice_id');
        $create_revision = $this->input->post('create_revision');

        if (!$invoice_id) {
            show_error('Invalid Quotation');
        }

        $original = $this->db
            ->where('invoice_id', $invoice_id)
            ->get('direct_invoices')
            ->row();

        if (!$original) {
            show_error('invoice not found');
        }

        $quotationData = [
            'branch_id'       => $this->input->post('branch_id') ?: get_primary_branch_id(),
            'subtotal'        => $this->input->post('subtotal'),
            'tax_amount'      => $this->input->post('tax_amount'),
            'discount_amount' => $this->input->post('tdiscount'),
            'grand_total'     => $this->input->post('grand_total'),
            'status'          => $this->input->post('custapproval')
                ? ucfirst(strtolower($this->input->post('custapproval')))
                : 'Draft',
            'customer_approval'        => $this->input->post('custapproval'),
            'customer_estimated_price' => $this->input->post('customer_estimated_price'),
            'est_delivery_date'        => $this->input->post('estdeldate'),
            'est_completion_time'      => $this->input->post('completiontime'),
            'invoice_date'             => $this->input->post('edate'),
            'remarks'         => $this->input->post('remarks'),
            'kmin'            => $this->input->post('kmin'),
            'srvice_discount' => $this->input->post('service_discount'),
            'sublet_discount' => $this->input->post('sublet_discount'),
            'adv_paid'        => $this->input->post('advance_paid'),
            'balance_after_invoice' => $this->input->post('balance_total'),
        ];

        $this->db->trans_begin();
        try {
            $this->Direct_Invoice_Model->update_direct_invoice($invoice_id, $quotationData);

            $this->Direct_Invoice_Model->save_job_descriptions(
                $invoice_id,
                $this->input->post('job_description') ?? [],
                $this->input->post('job_amount') ?? [],
                $this->input->post('sublet_discount')
            );

            $this->Direct_Invoice_Model->save_parts(
                $invoice_id,
                $this->input->post('part_id')       ?? [],
                $this->input->post('part_qty')      ?? [],
                $this->input->post('unit_price')    ?? [],
                $this->input->post('selling_price') ?? [],
                $this->input->post('total_price')   ?? [],
                $this->input->post('markup')        ?? [],
                $this->input->post('discount')      ?? [],
                $this->input->post('discountamt')   ?? [],
                $this->input->post('part_type')     ?? [],
                $this->input->post('brand_id')      ?? [],
                $this->input->post('customer_selected') ?? [],
                $this->input->post('part_warrenty') ?? []
            );

            $this->Direct_Invoice_Model->save_services(
                $invoice_id,
                $this->input->post('service_id')   ?? [],
                $this->input->post('service_time') ?? [],
                $this->input->post('service_cost') ?? [],
                $this->input->post('total_cost')   ?? [],
                $this->input->post('service_discount')
            );

            $this->db->trans_commit();
            redirect('DirectInvoice/edit/' . $invoice_id);

        } catch (RuntimeException $e) {
            $this->db->trans_rollback();
            log_message('error', '[DIRECT_INVOICE] Update failed: ' . $e->getMessage());
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('DirectInvoice/edit/' . $invoice_id);
        }
    }
}
