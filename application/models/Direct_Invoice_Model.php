<?php
class Direct_Invoice_Model extends CI_Model
{

    public function create_invoice($data)
    {
        if (!isset($data['branch_id'])) {
            $data['branch_id'] = get_primary_branch_id();
        }

        $type = $data['invoice_type'];
        $invoice_no   = $data['invoice_no'];
        // Pull out extra fields
        $customer_id  = $data['customer_id'] ?? null;
        // ❗ Remove fields NOT in invoices table
        unset($data['customer_id']);


        $this->db->insert('invoices', $data);
        $insertid = $this->db->insert_id();



        if ($type == 'TI') {
            /// unblocking stock//////////////////
            $qqid = $this->input->post('qid');
            // add code for Voucher entry here ///

            $AccountCode = $invoice_no;

            $vdate = $this->input->post('invoice_date_hidden');
            $vtime = date('h:i:s');

            // Cancel any pre-existing voucher lines for this invoice_no to prevent
            // duplicate Cr entries if both create_invoice() and saveInvoice() are called.
            $this->db->where('voucher_code', $AccountCode)
                     ->where_in('voucher_type', ['S'])
                     ->where('cancel', 0)
                     ->update('voucher_transaction', ['cancel' => 1]);

            /// debit entry 
            for ($i = 0; $i < count($_POST['inv_debtor']); $i++) {
                $debtor = $_POST['inv_debtor'][$i];
                $dr_amount = $_POST['inv_dr_amount'][$i];
                if ($dr_amount > 0) {
                    $data = array(
                        'voucher_code' => $AccountCode,
                        'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
                        'voucher_type' => 'S',  /// Sales invoice  entry
                        'customer_id' => $customer_id,
                        'account_id' => $debtor,
                        'amount' => $dr_amount,
                        'drcr_type' => 'Dr',
                        //'narration' => $this->input->post('narration'),
                        'trans_id' => $insertid,
                        'trans_type' => 'S',
                        'recordCreatedBy' => $this->session->userdata('user_id'),
                        'invoice_code' => $AccountCode,
                        'invoice_amount' => $dr_amount,
                    );
                    insert_voucher_transaction($data);
                    $vid = $this->db->insert_id();
                }
            }

            // credit entry
            for ($i = 0; $i < count($_POST['inv_creditor']); $i++) {
                $creditor = $_POST['inv_creditor'][$i];
                $cr_amount = $_POST['inv_cr_amount'][$i];
                if ($cr_amount > 0) {
                    $drcr_type = ((int)$creditor === 1122) ? 'Dr' : 'Cr';
                    $data = array(
                        'voucher_code' => $AccountCode,
                        'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
                        'voucher_type' => 'S',  /// Sales invoice  entry
                        'customer_id' => $customer_id,
                        'account_id' => $creditor,
                        'amount' => $cr_amount,
                        'drcr_type' => $drcr_type,
                        //'narration' => $this->input->post('narration'),
                        'trans_id' => $insertid,
                        'trans_type' => 'S',
                        'recordCreatedBy' => $this->session->userdata('user_id'),
                        'invoice_code' => $AccountCode,
                        'invoice_amount' => $cr_amount,
                    );
                    insert_voucher_transaction($data);
                    $vid = $this->db->insert_id();
                }
            }

            // ======================== advance voucher entry ==========================

            $advance = $this->input->post('advance_paid') ?? 0;
            $advance = floatval($advance);
            if ($advance > 0) {

                $code_prefix = "ADV/" . date('y') . "/";
                $this->load->model('Accounts_model');
                $num = $this->Accounts_model->get_account_code_count_for_advance($code_prefix, 'ADV') + 1;
                $advance_code = $code_prefix . sprintf("%05d", $num);

                $cash_account = '23'; // or fixed ledger id
                $data = array(
                    'voucher_code' => $advance_code,
                    'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
                    'voucher_type' => 'R', // Receipt
                    'customer_id' => $customer_id,
                    'account_id' => $cash_account,
                    'amount' => $advance,
                    'drcr_type' => 'Dr',
                    'trans_id' => $insertid,
                    'trans_type' => 'ADV',
                    'recordCreatedBy' => $this->session->userdata('user_id'),
                    'invoice_code' => $AccountCode,
                    'invoice_amount' => $advance,
                );
                insert_voucher_transaction($data);


                $customer_ledger = $_POST['inv_debtor'][0]; // usually first debtor is customer
                $data = array(
                    'voucher_code' => $advance_code,
                    'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
                    'voucher_type' => 'R',
                    'customer_id' => $customer_id,
                    'account_id' => $customer_ledger,
                    'amount' => $advance,
                    'drcr_type' => 'Cr',
                    'trans_id' => $insertid,
                    'trans_type' => 'ADV',
                    'recordCreatedBy' => $this->session->userdata('user_id'),
                    'invoice_code' => $AccountCode,
                    'invoice_amount' => $advance,
                );
                insert_voucher_transaction($data);
            }
            // ======================== advance voucher entry ==========================
            // if ($vid) {
            // 	$user_se_id = $this->session->userdata('session_id');
            // 	$uid = $this->session->userdata('user_id');
            // 	$page_name = explode('index.php/', $_SERVER['REQUEST_URI']);
            // 	$ci = get_instance();
            // 	$ci->load->helper('log');
            // 	$log_msg = add_log_entry($uid, 1, $page_name[1], 'voucher_transaction', 'voucher_id', $vid);
            // 	return $insertid;
            // }
        }



        return $insertid;
    }


    //////////////////////////////////save invoice data///////////////////

    public function saveInvoice($data = [])
    {
        $this->db->trans_start();

        /*
    =====================================
    1. INSERT QUOTATION HEADER
    =====================================
    */

        $invoiceData = [
            'branch_id'                => $data['branch_id'] ?? get_primary_branch_id(),

            'status'                   => $data['status'],
            'invoice_type'                   => $data['invoice_type'],
            'customer_approval'                   => $data['customer_approval'],
            'quotation_time'                => $data['quotation_time'],
            'invoice_no'      => $data['invoice_no'],

            'subtotal'                 => (float)$data['subtotal'],
            'tax_amount'               => (float)$data['tax_amount'],
            'discount_amount'                 => (float)$data['tdiscount'],
            'grand_total'              => (float)$data['grand_total'],
            'remarks'                  => $data['remarks'],

            'srvice_discount'          => (float)$data['srvice_discount'],
            'sublet_discount'          => (float)$data['sublet_discount'],

            'invoice_date'           => $data['quotation_date'],
            'est_delivery_date'        => $data['est_delivery_date'],
            'est_completion_time'      => $data['est_completion_time'],
            'customer_estimated_price' => (float)$data['customer_estimated_price'],

            'kmin'                => $data['kmin'],
            'completiontime'      => $data['completiontime'],
            'estdeldate'          => $data['estdeldate'],

            'vehicle_vinNo'       => $data['vehicle_vinNo'],
            'vehicle_numberPlate' => $data['vehicle_numberPlate'],
            'vehicle_model'       => $data['vehicle_model'],

            'customer_name'       => $data['customer_name'],
            'customer_contact'    => $data['customer_contact'],
            'customer_email'      => $data['customer_email'],
            'adv_paid'                 => $data['adv_paid'],
            'balance_after_invoice'    => $data['balance_after_invoice'],

        ];

        $this->db->insert('direct_invoices', $invoiceData);
        $invoice_id = $this->db->insert_id();

        /*
    =====================================
    2. INSERT PARTS
    =====================================
    */

        if (!empty($data['part_id'])) {

            foreach ($data['part_id'] as $i => $part_id) {

                if (empty($part_id)) {
                    continue;
                }

                $partData = [

                    'invoice_id'  => $invoice_id,
                    'part_id'       => $part_id,
                    'qty'           => $data['part_qty'][$i] ?? 0,
                    'unit_price'    => $data['unit_price'][$i] ?? 0,
                    'selling_price' => $data['selling_price'][$i] ?? 0,
                    'total_price'   => $data['total_price'][$i] ?? 0,

                    'discount'      => $data['discount'][$i] ?? 0,
                    'dis_amount'    => $data['discountamt'][$i] ?? 0,

                    'part_type'     => $data['part_type'][$i] ?? '',

                    'selected'      => (
                        isset($data['customer_selected'][$i]) &&
                        $data['customer_selected'][$i]
                    ) ? 1 : 0,

                    'partremarks'   => $data['partremarks'][$i] ?? '',
                ];

                $this->db->insert('direct_invoice_parts', $partData);
            }
        }

        /*
    =====================================
    3. INSERT SERVICES
    =====================================
    */

        if (!empty($data['service_id'])) {

            foreach ($data['service_id'] as $i => $service_id) {

                if (empty($service_id)) {
                    continue;
                }

                $service_total = (float)($data['total_cost'][$i] ?? 0);

                $serviceData = [

                    'invoice_id'    => $invoice_id,
                    'service_id'      => $service_id,
                    'estimated_time'  => $data['service_time'][$i] ?? 0,
                    'estimated_cost'  => $data['service_cost'][$i] ?? 0,
                    'total_cost'      => $service_total,

                    'discount_amount' => 0,
                    'discount_percentage' => 0,
                    'taxable_amount'  => $service_total,
                ];

                $this->db->insert('direct_invoice_services', $serviceData);
            }
        }

        /*
    =====================================
    4. INSERT SUBLET JOBS
    =====================================
    */

        if (!empty($data['job_description'])) {

            foreach ($data['job_description'] as $i => $description) {

                if (empty($description)) {
                    continue;
                }

                $amount = (float)($data['job_amount'][$i] ?? 0);

                $jobData = [

                    'invoice_id'        => $invoice_id,
                    'description'         => $description,
                    'amount'              => $amount,

                    'discount_amount'     => 0,
                    'discount_percentage' => 0,
                    'taxable_amount'      => $amount,

                    'created_at'          => date('Y-m-d H:i:s'),
                ];

                $this->db->insert('direct_invoice_job_descriptions', $jobData);
            }
        }

        /*
    =====================================
    COMMIT
    =====================================
    */

        $this->db->trans_complete();

        $type = $data['invoice_type'];
        $invoice_no = $data['invoice_no'];
        $vdate = $data['quotation_date'];


        if ($type == 'TI') {
            /// unblocking stock//////////////////
            // add code for Voucher entry here ///

            $AccountCode = $invoice_no;

            $vtime = date('h:i:s');

            // Cancel any pre-existing voucher lines for this invoice_no to prevent
            // duplicate Cr entries if both create_invoice() and saveInvoice() are called.
            $this->db->where('voucher_code', $AccountCode)
                     ->where_in('voucher_type', ['S'])
                     ->where('cancel', 0)
                     ->update('voucher_transaction', ['cancel' => 1]);

            /// debit entry 
            for ($i = 0; $i < count($_POST['inv_debtor']); $i++) {
                $debtor = $_POST['inv_debtor'][$i];
                $dr_amount = $_POST['inv_dr_amount'][$i];
                if ($dr_amount > 0) {
                    $data = array(
                        'voucher_code' => $AccountCode,
                        'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
                        'voucher_type' => 'S',  /// Sales invoice  entry
                        //'customer_id' => $customer_id,
                        'account_id' => $debtor,
                        'amount' => $dr_amount,
                        'drcr_type' => 'Dr',
                        //'narration' => $this->input->post('narration'),
                        'trans_id' => $invoice_id,
                        'trans_type' => 'S',
                        'recordCreatedBy' => $this->session->userdata('user_id'),
                        'invoice_code' => $AccountCode,
                        'invoice_amount' => $dr_amount,
                    );
                    insert_voucher_transaction($data);
                    $vid = $this->db->insert_id();
                }
            }

            // credit entry
            for ($i = 0; $i < count($_POST['inv_creditor']); $i++) {
                $creditor = $_POST['inv_creditor'][$i];
                $cr_amount = $_POST['inv_cr_amount'][$i];
                if ($cr_amount > 0) {
                    $drcr_type = ((int)$creditor === 1122) ? 'Dr' : 'Cr';
                    $data = array(
                        'voucher_code' => $AccountCode,
                        'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
                        'voucher_type' => 'S',  /// Sales invoice  entry
                        //  'customer_id' => $customer_id,
                        'account_id' => $creditor,
                        'amount' => $cr_amount,
                        'drcr_type' => $drcr_type,
                        //'narration' => $this->input->post('narration'),
                        'trans_id' => $invoice_id,
                        'trans_type' => 'S',
                        'recordCreatedBy' => $this->session->userdata('user_id'),
                        'invoice_code' => $AccountCode,
                        'invoice_amount' => $cr_amount,
                    );
                    insert_voucher_transaction($data);
                    $vid = $this->db->insert_id();
                }
            }

            // ======================== advance voucher entry ==========================

            $advance = $this->input->post('advance_paid') ?? 0;
            $advance = floatval($advance);
            if ($advance > 0) {

                $code_prefix = "ADV/" . date('y') . "/";
                $this->load->model('Accounts_model');
                $num = $this->Accounts_model->get_account_code_count_for_advance($code_prefix, 'ADV') + 1;
                $advance_code = $code_prefix . sprintf("%05d", $num);

                $cash_account = '23'; // or fixed ledger id
                $data = array(
                    'voucher_code' => $advance_code,
                    'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
                    'voucher_type' => 'R', // Receipt
                    //   'customer_id' => $customer_id,
                    'account_id' => $cash_account,
                    'amount' => $advance,
                    'drcr_type' => 'Dr',
                    'trans_id' => $invoice_id,
                    'trans_type' => 'ADV',
                    'recordCreatedBy' => $this->session->userdata('user_id'),
                    'invoice_code' => $AccountCode,
                    'invoice_amount' => $advance,
                );
                insert_voucher_transaction($data);


                $customer_ledger = $_POST['inv_debtor'][0]; // usually first debtor is customer
                $data = array(
                    'voucher_code' => $advance_code,
                    'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
                    'voucher_type' => 'R',
                    // 'customer_id' => $customer_id,
                    'account_id' => $customer_ledger,
                    'amount' => $advance,
                    'drcr_type' => 'Cr',
                    'trans_id' => $invoice_id,
                    'trans_type' => 'ADV',
                    'recordCreatedBy' => $this->session->userdata('user_id'),
                    'invoice_code' => $AccountCode,
                    'invoice_amount' => $advance,
                );
                insert_voucher_transaction($data);
            }
            // ======================== advance voucher entry ==========================
            // if ($vid) {
            // 	$user_se_id = $this->session->userdata('session_id');
            // 	$uid = $this->session->userdata('user_id');
            // 	$page_name = explode('index.php/', $_SERVER['REQUEST_URI']);
            // 	$ci = get_instance();
            // 	$ci->load->helper('log');
            // 	$log_msg = add_log_entry($uid, 1, $page_name[1], 'voucher_transaction', 'voucher_id', $vid);
            // 	return $insertid;
            // }
        }

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return $invoice_id;
    }



    public function get_all_invoice()
    {
        return $this->db
            ->select('
                q.*,

                q.customer_name AS customer_name,
                q.customer_contact AS customer_phone,

                q.vehicle_vinNo as registration_no,

              
               q.vehicle_numberPlate as brand,
                q.vehicle_model as model,

               
            ')
            ->from('direct_invoices q')


            ->order_by('q.invoice_id ', 'DESC')
            ->get()
            ->result();
    }

    public function delete_invoice($invoice_id)
    {
        $this->db->trans_start();

        // 1. Delete job descriptions
        $this->db->where('invoice_id', $invoice_id)
            ->delete('direct_invoice_job_descriptions');

        // 2. Delete quotation parts
        $this->db->where('invoice_id', $invoice_id)
            ->delete('direct_invoice_parts');

        // 3. Delete quotation services
        $this->db->where('invoice_id', $invoice_id)
            ->delete('direct_invoice_services');

        // // 4. Delete child revisions (if any)
        // $this->db->where('parent_quotation_id', $invoice_id)
        //     ->delete('direct_quotations');

        // 5. Delete MAIN quotation (LAST)
        $this->db->where('invoice_id', $invoice_id)
            ->delete('direct_invoices');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }


    public function get_Invoice($invoice_id)
    {
        return $this->db
            ->where('invoice_id', $invoice_id)
            ->get('direct_invoices')
            ->row();
    }

    public function get_services($invoice_id)
    {
        return $this->db
            ->select('qs.*, sm.service_name')
            ->from('direct_invoice_services qs')
            ->join('services_master sm', 'sm.master_service_id = qs.service_id')
            ->where('qs.invoice_id', $invoice_id)
            ->get()
            ->result();
    }


    public function get_parts_type_forquote($invoice_id, $parttype)
    {
        return $this->db
            ->select('ep.*, sp.*')
            ->from('direct_invoice_parts ep')
            ->join('spare_parts sp', 'sp.part_id = ep.part_id')
            ->where('ep.invoice_id', $invoice_id)
            ->where('ep.part_type', $parttype)
            ->get()
            ->result();
    }


    public function get_job_descriptions($invoice_id)
    {
        return $this->db
            ->where('invoice_id', $invoice_id)
            ->get('direct_invoice_job_descriptions')
            ->result();
    }


    // public function update_direct_invoice($invoice_id, $data)
    // {
    //     return $this->db
    //         ->where('invoice_id', $invoice_id)
    //         ->update('direct_invoices', $data);


    //     $this->db->where('trans_id', $invoice_id);
    //     $this->db->delete('voucher_transaction');

    //     $type = 'TI';
    //     $invoice_no = $this->input->post('invoice_no');
    //     $vdate = $this->input->post('quotation_date');

    //     if ($type == 'TI') {
    //         /// unblocking stock//////////////////
    //         // add code for Voucher entry here ///

    //         $AccountCode = $invoice_no;

    //         $vtime = date('h:i:s');

    //         /// debit entry 
    //         for ($i = 0; $i < count($_POST['inv_debtor']); $i++) {
    //             $debtor = $_POST['inv_debtor'][$i];
    //             $dr_amount = $_POST['inv_dr_amount'][$i];
    //             if ($dr_amount > 0) {
    //                 $data = array(
    //                     'voucher_code' => $AccountCode,
    //                     'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
    //                     'voucher_type' => 'S',  /// Sales invoice  entry
    //                     //'customer_id' => $customer_id,
    //                     'account_id' => $debtor,
    //                     'amount' => $dr_amount,
    //                     'drcr_type' => 'Dr',
    //                     //'narration' => $this->input->post('narration'),
    //                     'trans_id' => $invoice_id,
    //                     'trans_type' => 'S',
    //                     'recordCreatedBy' => $this->session->userdata('user_id'),
    //                     'invoice_code' => $AccountCode,
    //                     'invoice_amount' => $dr_amount,
    //                 );
    //                 $this->db->insert('voucher_transaction', $data);
    //                 $vid = $this->db->insert_id();
    //             }
    //         }

    //         // credit entry
    //         for ($i = 0; $i < count($_POST['inv_creditor']); $i++) {
    //             $creditor = $_POST['inv_creditor'][$i];
    //             $cr_amount = $_POST['inv_cr_amount'][$i];
    //             if ($cr_amount > 0) {
    //                 $data = array(
    //                     'voucher_code' => $AccountCode,
    //                     'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
    //                     'voucher_type' => 'S',  /// Sales invoice  entry
    //                     //  'customer_id' => $customer_id,
    //                     'account_id' => $creditor,
    //                     'amount' => $cr_amount,
    //                     'drcr_type' => 'Cr',
    //                     //'narration' => $this->input->post('narration'),
    //                     'trans_id' => $invoice_id,
    //                     'trans_type' => 'S',
    //                     'recordCreatedBy' => $this->session->userdata('user_id'),
    //                     'invoice_code' => $AccountCode,
    //                     'invoice_amount' => $cr_amount,
    //                 );
    //                 $this->db->insert('voucher_transaction', $data);
    //                 $vid = $this->db->insert_id();
    //             }
    //         }

    //         // ======================== advance voucher entry ==========================

    //         $advance = $this->input->post('advance_paid') ?? 0;
    //         $advance = floatval($advance);
    //         if ($advance > 0) {

    //             $code_prefix = "ADV/" . date('y') . "/";
    //             $this->load->model('Accounts_model');
    //             $num = $this->Accounts_model->get_account_code_count_for_advance($code_prefix, 'ADV') + 1;
    //             $advance_code = $code_prefix . sprintf("%05d", $num);

    //             $cash_account = '23'; // or fixed ledger id
    //             $data = array(
    //                 'voucher_code' => $advance_code,
    //                 'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
    //                 'voucher_type' => 'R', // Receipt
    //                 //   'customer_id' => $customer_id,
    //                 'account_id' => $cash_account,
    //                 'amount' => $advance,
    //                 'drcr_type' => 'Dr',
    //                 'trans_id' => $invoice_id,
    //                 'trans_type' => 'ADV',
    //                 'recordCreatedBy' => $this->session->userdata('user_id'),
    //                 'invoice_code' => $AccountCode,
    //                 'invoice_amount' => $advance,
    //             );
    //             $this->db->insert('voucher_transaction', $data);


    //             $customer_ledger = $_POST['inv_debtor'][0]; // usually first debtor is customer
    //             $data = array(
    //                 'voucher_code' => $advance_code,
    //                 'voucher_date' => date('Y-m-d h:i:s', strtotime("$vdate $vtime")),
    //                 'voucher_type' => 'R',
    //                 // 'customer_id' => $customer_id,
    //                 'account_id' => $customer_ledger,
    //                 'amount' => $advance,
    //                 'drcr_type' => 'Cr',
    //                 'trans_id' => $invoice_id,
    //                 'trans_type' => 'ADV',
    //                 'recordCreatedBy' => $this->session->userdata('user_id'),
    //                 'invoice_code' => $AccountCode,
    //                 'invoice_amount' => $advance,
    //             );
    //             $this->db->insert('voucher_transaction', $data);
    //         }
    //         // ======================== advance voucher entry ==========================
    //         // if ($vid) {
    //         // 	$user_se_id = $this->session->userdata('session_id');
    //         // 	$uid = $this->session->userdata('user_id');
    //         // 	$page_name = explode('index.php/', $_SERVER['REQUEST_URI']);
    //         // 	$ci = get_instance();
    //         // 	$ci->load->helper('log');
    //         // 	$log_msg = add_log_entry($uid, 1, $page_name[1], 'voucher_transaction', 'voucher_id', $vid);
    //         // 	return $insertid;
    //         // }
    //     }
    // }
    public function update_direct_invoice($invoice_id, $data)
    {
        // 1. Update the invoice
        $update_result = $this->db
            ->where('invoice_id', $invoice_id)
            ->update('direct_invoices', $data);

        // 2. Delete old voucher transactions
        $this->db->where('trans_id', $invoice_id);
        $this->db->delete('voucher_transaction');

        $type = 'TI';
        $invoice_no = $this->input->post('invoice_no');
        $vdate = $this->input->post('quotation_date');
        $vtime = date('H:i:s'); // 24-hour format

        if ($type == 'TI') {

            $AccountCode = $invoice_no;

            // Debit entries
            $debtor_list = $this->input->post('inv_debtor') ?? [];
            $dr_amounts = $this->input->post('inv_dr_amount') ?? [];

            foreach ($debtor_list as $i => $debtor) {
                $dr_amount = floatval($dr_amounts[$i] ?? 0);
                if ($dr_amount > 0) {
                    $data = [
                        'voucher_code' => $AccountCode,
                        'voucher_date' => date('Y-m-d H:i:s', strtotime("$vdate $vtime")),
                        'voucher_type' => 'S',
                        'account_id' => $debtor,
                        'amount' => $dr_amount,
                        'drcr_type' => 'Dr',
                        'trans_id' => $invoice_id,
                        'trans_type' => 'S',
                        'recordCreatedBy' => $this->session->userdata('user_id'),
                        'invoice_code' => $AccountCode,
                        'invoice_amount' => $dr_amount,
                    ];
                    insert_voucher_transaction($data);
                }
            }

            // Credit entries
            $creditor_list = $this->input->post('inv_creditor') ?? [];
            $cr_amounts = $this->input->post('inv_cr_amount') ?? [];

            foreach ($creditor_list as $i => $creditor) {
                $cr_amount = floatval($cr_amounts[$i] ?? 0);
                if ($cr_amount > 0) {
                    $drcr_type = ((int)$creditor === 1122) ? 'Dr' : 'Cr';
                    $data = [
                        'voucher_code' => $AccountCode,
                        'voucher_date' => date('Y-m-d H:i:s', strtotime("$vdate $vtime")),
                        'voucher_type' => 'S',
                        'account_id' => $creditor,
                        'amount' => $cr_amount,
                        'drcr_type' => $drcr_type,
                        'trans_id' => $invoice_id,
                        'trans_type' => 'S',
                        'recordCreatedBy' => $this->session->userdata('user_id'),
                        'invoice_code' => $AccountCode,
                        'invoice_amount' => $cr_amount,
                    ];
                    insert_voucher_transaction($data);
                }
            }

            // Advance payment
            $advance = floatval($this->input->post('advance_paid') ?? 0);
            if ($advance > 0) {
                $code_prefix = "ADV/" . date('y') . "/";
                $this->load->model('Accounts_model');
                $num = $this->Accounts_model->get_account_code_count_for_advance($code_prefix, 'ADV') + 1;
                $advance_code = $code_prefix . sprintf("%05d", $num);

                $cash_account = '23';
                $data = [
                    'voucher_code' => $advance_code,
                    'voucher_date' => date('Y-m-d H:i:s', strtotime("$vdate $vtime")),
                    'voucher_type' => 'R',
                    'account_id' => $cash_account,
                    'amount' => $advance,
                    'drcr_type' => 'Dr',
                    'trans_id' => $invoice_id,
                    'trans_type' => 'ADV',
                    'recordCreatedBy' => $this->session->userdata('user_id'),
                    'invoice_code' => $AccountCode,
                    'invoice_amount' => $advance,
                ];
                insert_voucher_transaction($data);

                // Credit the customer ledger
                $customer_ledger = $debtor_list[0] ?? null;
                if ($customer_ledger) {
                    $data['account_id'] = $customer_ledger;
                    $data['drcr_type'] = 'Cr';
                    $data['trans_type'] = 'ADV';
                    insert_voucher_transaction($data);
                }
            }
        }

        return $update_result;
    }

    public function save_job_descriptions($invoice_id, $descriptions, $jamt, $subletdiscount)
    {
        // 1. Remove existing records
        $this->db->where('invoice_id', $invoice_id)
            ->delete('direct_invoice_job_descriptions');

        // 2. Calculate subtotal
        $subtotal = 0;
        foreach ($jamt as $amt) {
            $subtotal += (float)$amt;
        }

        // Safety check
        if ($subtotal <= 0) {
            $subtotal = 1;
        }

        $total_discount = (float)$subletdiscount;
        $distributed_discount = 0;
        $last_index = array_key_last($descriptions);

        foreach ($descriptions as $i => $desc) {

            if (trim($desc) === '') continue;

            $amount = (float)$jamt[$i];

            // 3. Proportional discount calculation
            if ($i == $last_index) {
                $discount_amount = round($total_discount - $distributed_discount, 2);
            } else {
                $discount_amount = round(($amount / $subtotal) * $total_discount, 2);
                $distributed_discount += $discount_amount;
            }

            // 4. Discount percentage
            $discount_percentage = ($amount > 0)
                ? round(($discount_amount / $amount) * 100, 2)
                : 0;

            // 5. Taxable amount
            $taxable_amount = round($amount - $discount_amount, 2);

            // 6. Insert
            $this->db->insert('direct_invoice_job_descriptions', [
                'invoice_id'       => $invoice_id,
                'description'         => $desc,
                'amount'              => $amount,
                'discount_amount'     => $discount_amount,
                'discount_percentage' => $discount_percentage,
                'taxable_amount'      => $taxable_amount
            ]);
        }
    }


    public function save_parts($invoice_id, $part_ids, $qtys, $unit_prices, $sell_prices, $totals, $markup, $discount, $discountamt, $parttype, $brandid, $selected, $remarks)
    {


        $this->db->where('invoice_id', $invoice_id)
            ->delete('direct_invoice_parts');

        foreach ($part_ids as $i => $part_id) {
            if (!$part_id) continue;

            // ✅ checkbox-safe logic
            $is_selected = in_array($part_id, $selected) ? 1 : 0;

            $this->db->insert('direct_invoice_parts', [
                'invoice_id' => $invoice_id,
                'part_id'       => $part_id,
                'qty'           => $qtys[$i],
                'unit_price'    => $unit_prices[$i],
                'selling_price' => $sell_prices[$i],
                'total_price'   => $totals[$i],
                'markup_percentage' => $markup[$i],
                'discount' => $discount[$i],
                'dis_amount' => $discountamt[$i],
                'part_type' => $parttype[$i],
                'brand_id' => $brandid[$i],
                'selected' => $is_selected,
                'partremarks' => $remarks[$i]
            ]);
        }
    }
    public function save_services(
        $invoice_id,
        $service_ids,
        $times,
        $costs,
        $totals,
        $service_discount
    ) {
        $this->db->where('invoice_id', $invoice_id)
            ->delete('direct_invoice_services');

        $subtotal = array_sum($totals);

        if ($subtotal <= 0) {
            $subtotal = 1;
        }

        $total_discount = (float)$service_discount;
        $distributed_discount = 0;

        $last_index = array_key_last($service_ids);

        foreach ($service_ids as $i => $service_id) {

            if (!$service_id) continue;

            $amount = (float)$totals[$i];

            if ($i == $last_index) {

                $discount_amount =
                    round($total_discount - $distributed_discount, 2);
            } else {

                $discount_amount =
                    round(($amount / $subtotal) * $total_discount, 2);

                $distributed_discount += $discount_amount;
            }

            $discount_percentage = $amount > 0
                ? round(($discount_amount / $amount) * 100, 2)
                : 0;

            $taxable_amount = $amount - $discount_amount;

            $this->db->insert('direct_invoice_services', [

                'invoice_id' => $invoice_id,
                'service_id' => $service_id,
                'estimated_time' => $times[$i],
                'estimated_cost' => $costs[$i],
                'total_cost' => $totals[$i],

                'discount_percentage' => $discount_percentage,
                'discount_amount' => $discount_amount,
                'taxable_amount' => $taxable_amount
            ]);
        }
    }
}
