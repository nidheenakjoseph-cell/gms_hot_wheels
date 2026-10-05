
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Direct_quotation_model extends CI_Model
{


    public function get_all_services()
    {
        return $this->db->order_by('master_service_id', 'DESC')
            ->get('services_master')
            ->result();
    }



    /////////////////////////////////insert data///////////////////////////


    public function saveQuotation($data = [])
    {
        $this->db->trans_start();

        /*
    =====================================
    1. INSERT QUOTATION HEADER
    =====================================
    */

        $quotationData = [
            'branch_id'                => $data['branch_id'] ?? get_primary_branch_id(),
            'status'                   => $data['status'],
            'customer_approval'                   => $data['customer_approval'],
            'quotation_time'                => $data['quotation_time'],
            'quotation_no'      => $data['quotation_no'],

            'subtotal'                 => (float)$data['subtotal'],
            'tax_amount'               => (float)$data['tax_amount'],
            'discount'                 => (float)$data['tdiscount'],
            'grand_total'              => (float)$data['grand_total'],
            'remarks'                  => $data['remarks'],

            'srvice_discount'          => (float)$data['srvice_discount'],
            'sublet_discount'          => (float)$data['sublet_discount'],

            'quotation_date'           => $data['quotation_date'],
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

        ];

        $this->db->insert('direct_quotations', $quotationData);

        $quotation_id = $this->db->insert_id();

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

                    'quotation_id'  => $quotation_id,
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

                $this->db->insert('direct_quotation_parts', $partData);
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

                    'quotation_id'    => $quotation_id,
                    'service_id'      => $service_id,
                    'estimated_time'  => $data['service_time'][$i] ?? 0,
                    'estimated_cost'  => $data['service_cost'][$i] ?? 0,
                    'total_cost'      => $service_total,

                    'discount_amount' => 0,
                    'discount_percentage' => 0,
                    'taxable_amount'  => $service_total,
                ];

                $this->db->insert('direct_quotation_services', $serviceData);
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

                    'quotation_id'        => $quotation_id,
                    'description'         => $description,
                    'amount'              => $amount,

                    'discount_amount'     => 0,
                    'discount_percentage' => 0,
                    'taxable_amount'      => $amount,

                    'created_at'          => date('Y-m-d H:i:s'),
                ];

                $this->db->insert('direct_quotation_job_descriptions', $jobData);
            }
        }

        /*
    =====================================
    COMMIT
    =====================================
    */

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return $quotation_id;
    }


    public function get_all_quotations()
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
            ->from('direct_quotations q')


            ->order_by('q.quotation_id ', 'DESC')
            ->get()
            ->result();
    }



    public function get_quotation($quotation_id)
    {
        return $this->db
            ->where('quotation_id', $quotation_id)
            ->get('direct_quotations')
            ->row();
    }


    public function delete_quotation($quotation_id)
    {
        $this->db->trans_start();

        // 1. Delete job descriptions
        $this->db->where('quotation_id', $quotation_id)
            ->delete('direct_quotation_job_descriptions');

        // 2. Delete quotation parts
        $this->db->where('quotation_id', $quotation_id)
            ->delete('direct_quotation_parts');

        // 3. Delete quotation services
        $this->db->where('quotation_id', $quotation_id)
            ->delete('direct_quotation_services');

        // 4. Delete child revisions (if any)
        $this->db->where('parent_quotation_id', $quotation_id)
            ->delete('direct_quotations');

        // 5. Delete MAIN quotation (LAST)
        $this->db->where('quotation_id', $quotation_id)
            ->delete('direct_quotations');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }


    public function get_services($quotation_id)
    {
        return $this->db
            ->select('qs.*, sm.service_name')
            ->from('direct_quotation_services qs')
            ->join('services_master sm', 'sm.master_service_id = qs.service_id')
            ->where('qs.quotation_id', $quotation_id)
            ->get()
            ->result();
    }


    public function get_parts_type_forquote($quotation_id, $parttype)
    {
        return $this->db
            ->select('ep.*, sp.*')
            ->from('direct_quotation_parts ep')
            ->join('spare_parts sp', 'sp.part_id = ep.part_id')
            ->where('ep.quotation_id', $quotation_id)
            ->where('ep.part_type', $parttype)
            ->get()
            ->result();
    }


    public function get_job_descriptions($quotation_id)
    {
        return $this->db
            ->where('quotation_id', $quotation_id)
            ->get('direct_quotation_job_descriptions')
            ->result();
    }


    public function update_direct_quotation($quotation_id, $data)
    {
        return $this->db
            ->where('quotation_id', $quotation_id)
            ->update('direct_quotations', $data);
    }

    public function save_job_descriptions($quotation_id, $descriptions, $jamt, $subletdiscount)
    {
        // 1. Remove existing records
        $this->db->where('quotation_id', $quotation_id)
            ->delete('direct_quotation_job_descriptions');

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
            $this->db->insert('direct_quotation_job_descriptions', [
                'quotation_id'       => $quotation_id,
                'description'         => $desc,
                'amount'              => $amount,
                'discount_amount'     => $discount_amount,
                'discount_percentage' => $discount_percentage,
                'taxable_amount'      => $taxable_amount
            ]);
        }
    }


    public function save_parts($quotation_id, $part_ids, $qtys, $unit_prices, $sell_prices, $totals, $markup, $discount, $discountamt, $parttype, $brandid, $selected, $remarks)
    {


        $this->db->where('quotation_id', $quotation_id)
            ->delete('direct_quotation_parts');

        foreach ($part_ids as $i => $part_id) {
            if (!$part_id) continue;

            // ✅ checkbox-safe logic
            $is_selected = in_array($part_id, $selected) ? 1 : 0;

            $this->db->insert('direct_quotation_parts', [
                'quotation_id' => $quotation_id,
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

    public function save_servicesold($quotation_id, $service_names, $times, $costs, $totals, $serdiscount)
    {

        $this->db->where('quotation_id', $quotation_id)
            ->delete('direct_quotation_services');

        foreach ($service_names as $i => $service_name) {
            if (!$service_name) continue;

            $this->db->insert('direct_quotation_services', [
                'quotation_id' => $quotation_id,
                'service_id'    => $service_name, // optional: map later
                'estimated_time' => $times[$i],
                'estimated_cost' => $costs[$i],
                'total_cost'    => $totals[$i]
            ]);

            log_message('error', $this->db->last_query());
            log_message('error', json_encode($this->db->error()));
        }
    }


    public function save_services(
        $quotation_id,
        $service_ids,
        $times,
        $costs,
        $totals,
        $service_discount
    ) {
        $this->db->where('quotation_id', $quotation_id)
            ->delete('direct_quotation_services');

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

            $this->db->insert('direct_quotation_services', [

                'quotation_id' => $quotation_id,
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
