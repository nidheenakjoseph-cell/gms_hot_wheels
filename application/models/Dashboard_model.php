<?php
class Dashboard_model extends CI_Model
{
	private function normalize_jobcard_status($status)
	{
		$status = strtolower(trim((string) ($status ?? '')));

		if ($status === '' || $status === 'null') {
			return 'Finished';
		}

		if ($status === 'completed') {
			return 'Finished';
		}

		if ($status === 'in progress' || $status === 'in-progress') {
			return 'In Progress';
		}

		if ($status === 'scheduled') {
			return 'Scheduled';
		}

		if ($status === 'draft') {
			return 'Draft';
		}

		if ($status === 'pending') {
			return 'Pending';
		}

		return ucfirst(strtolower($status));
	}

	private function normalize_estimation_status($status)
	{
		$status = strtolower(trim((string) ($status ?? '')));

		if ($status === '' || $status === 'null') {
			return 'Draft';
		}

		if ($status === 'approved') {
			return 'Approved';
		}

		if ($status === 'rejected') {
			return 'Rejected';
		}

		if ($status === 'converted') {
			return 'Converted';
		}

		if ($status === 'draft') {
			return 'Draft';
		}

		if ($status === 'pending') {
			return 'Pending';
		}

		if ($status === 'in progress' || $status === 'in-progress') {
			return 'In Progress';
		}

		return ucfirst(strtolower(str_replace(['-', '_'], ' ', $status)));
	}

	/**
	 * Get active job cards for dashboard
	 */
	public function get_active_job_cards()
	{
		$this->db
		->select(" 
			jc.jobcard_id,
			jc.jobcard_no,
			CASE
				WHEN LOWER(TRIM(COALESCE(jc.status, ''))) IN ('finished', 'completed', 'null') THEN 'Finished'
				WHEN LOWER(TRIM(COALESCE(jc.status, ''))) IN ('in progress', 'in-progress') THEN 'In Progress'
				WHEN LOWER(TRIM(COALESCE(jc.status, ''))) = 'scheduled' THEN 'Scheduled'
				WHEN LOWER(TRIM(COALESCE(jc.status, ''))) = 'draft' THEN 'Draft'
				WHEN LOWER(TRIM(COALESCE(jc.status, ''))) = 'pending' THEN 'Pending'
				WHEN TRIM(COALESCE(jc.status, '')) = '' THEN 'Finished'
				ELSE COALESCE(jc.status, 'Unknown')
			END AS normalized_status,
			jc.expected_delivery_date,
			c.name AS customer_name,
			v.registration_no,
			COALESCE(
				(SELECT e.employee_name FROM employees e WHERE e.employee_id = jc.technician_id LIMIT 1),
				(SELECT e2.employee_name
				 FROM jobcard_services js
				 LEFT JOIN employees e2 ON e2.employee_id = js.employee_id
				 WHERE js.jobcard_id = jc.jobcard_id AND js.employee_id IS NOT NULL AND js.employee_id <> 0
				 ORDER BY js.jobcard_service_id ASC
				 LIMIT 1),
				'Unassigned'
			) AS technician_name
		")
		->from('job_cards jc')
		->join('customers c', 'c.customer_id = jc.customer_id')
		->join('vehicles v', 'v.vehicle_id = jc.vehicle_id')
		->where_in('LOWER(TRIM(COALESCE(jc.status, "")))', ['pending', 'in progress', 'in-progress']);

		apply_branch_filter('jc');

		return $this->db
			->order_by('jc.created_at', 'DESC')
			->limit(10)
			->get()
			->result();
	}
	public function get_pending_job_cards()
	{
		return $this->db
			->select(" 
                jc.jobcard_id,
                jc.jobcard_no,
                CASE
                    WHEN LOWER(TRIM(COALESCE(jc.status, ''))) IN ('finished', 'completed', 'null') THEN 'Finished'
                    WHEN LOWER(TRIM(COALESCE(jc.status, ''))) IN ('in progress', 'in-progress') THEN 'In Progress'
                    WHEN LOWER(TRIM(COALESCE(jc.status, ''))) = 'scheduled' THEN 'Scheduled'
                    WHEN LOWER(TRIM(COALESCE(jc.status, ''))) = 'draft' THEN 'Draft'
                    WHEN LOWER(TRIM(COALESCE(jc.status, ''))) = 'pending' THEN 'Pending'
                    WHEN TRIM(COALESCE(jc.status, '')) = '' THEN 'Finished'
                    ELSE COALESCE(jc.status, 'Unknown')
                END AS normalized_status,
                jc.expected_delivery_date,
                c.name AS customer_name,
                v.registration_no,
                COALESCE(
                    (SELECT e.employee_name FROM employees e WHERE e.employee_id = jc.technician_id LIMIT 1),
                    (SELECT e2.employee_name
                     FROM jobcard_services js
                     LEFT JOIN employees e2 ON e2.employee_id = js.employee_id
                     WHERE js.jobcard_id = jc.jobcard_id AND js.employee_id IS NOT NULL AND js.employee_id <> 0
                     ORDER BY js.jobcard_service_id ASC
                     LIMIT 1),
                    'Unassigned'
                ) AS technician_name
            ")
			->from('job_cards jc')
			->join('customers c', 'c.customer_id = jc.customer_id')
			->join('vehicles v', 'v.vehicle_id = jc.vehicle_id')
			->where_in('LOWER(TRIM(COALESCE(jc.status, "")))', ['pending', 'in progress', 'in-progress'])
			->order_by('jc.created_at', 'DESC')
			->limit(10) // dashboard-friendly
			->get()
			->result();
	}

	public function get_Scheduled_job_cards_count()
	{
		$this->db
			->from('job_cards jc')
			->where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'scheduled'", null, false);
		apply_branch_filter('jc');
		return $this->db->count_all_results();

	}
	public function get_inprogress_job_cards_count()
	{
		 $this->db
			->from('job_cards jc')
			->group_start()
				->where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'in progress'", null, false)
				->or_where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'in-progress'", null, false)
			->group_end();
			apply_branch_filter('jc');
			return $this->db->count_all_results();
	}
	public function get_finished_job_cards_count()
	{
		$this->db
			->from('job_cards jc')
			->group_start()
				->where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'finished'", null, false)
				->or_where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'completed'", null, false)
				->or_where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'null'", null, false)
				->or_where('TRIM(COALESCE(jc.status, "")) = ""', null, false)
				->or_where('jc.status IS NULL', null, false)
			->group_end();

		apply_branch_filter('jc');

		return $this->db->count_all_results();
	}

	public function get_active_job_cards_count()
	{
		 $this->db
			->from('job_cards jc')
			->group_start()
				->where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'scheduled'", null, false)
				->or_where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'in progress'", null, false)
				->or_where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'in-progress'", null, false)
				->or_where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'finished'", null, false)
				->or_where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'completed'", null, false)
				->or_where("LOWER(TRIM(COALESCE(jc.status, ''))) = 'null'", null, false)
				->or_where('TRIM(COALESCE(jc.status, "")) = ""', null, false)
				->or_where('jc.status IS NULL', null, false)
			->group_end();
			apply_branch_filter('jc');
			return $this->db->count_all_results();
	}
	public function get_customers_count()
	{
		 $this->db
			->from('customers c');
			apply_branch_filter('c');
			return $this->db
			->count_all_results();
	}
	public function get_vehicles_count()
	{
		$this->db
			->from('vehicles v')
			->join('customers c', 'c.customer_id = v.customer_id');
			apply_branch_filter('c');
			return $this->db->count_all_results();

	}
	public function get_total_revenue($can_view_job_card = null, $can_view_scrap = null)
	{
		if ($can_view_job_card === null) {
			$can_view_job_card = function_exists('user_can_access_page') ? user_can_access_page('Jobcard', 'index') : true;
		}
		if ($can_view_scrap === null) {
			$can_view_scrap = function_exists('user_can_access_page') ? user_can_access_page('Scrap', 'index') : true;
		}

        $branch_ids = get_selected_branch_ids();
        $branch_condition_i = '';
        $branch_condition_ss = '';

        if ($branch_ids !== 'all' && !empty($branch_ids)) {
            $branch_list = implode(',', array_map('intval', $branch_ids));
            $branch_condition_i = " AND i.branch_id IN ($branch_list)";
            $branch_condition_ss = " AND ss.branch_id IN ($branch_list)";
        }

        $parts = [];
        if ($can_view_job_card) {
            $parts[] = "COALESCE((SELECT SUM(i.grand_total) FROM invoices i WHERE 1=1 $branch_condition_i), 0)";
        }
        if ($can_view_scrap) {
            $parts[] = "COALESCE((SELECT SUM(ss.grand_total) FROM scrap_sales ss WHERE 1=1 $branch_condition_ss), 0)";
        }

        if (empty($parts)) {
            return 0.0;
        }

        $row = $this->db->query(
            "SELECT (" . implode(' + ', $parts) . ") AS total_revenue"
        )->row();

        return (float) ($row->total_revenue ?? 0);
	}
	public function get_grn_count()
	{
		return $this->db
			->from('purchase_grn_master')
			->count_all_results();
	}
	public function get_purchase_order_count()
	{
		return $this->db
			->from('purchase_order_master')
			->count_all_results();
	}
	public function get_purchase_return_count()
	{
		return $this->db
			->from('purchase_return')
			->count_all_results();
	}

	public function get_total_purchase_amount()
	{
		$this->db
			->select('SUM(po.grand_total) as total')
			->from('purchase_order_master po')
			->where('po.cancelled', 0);

		apply_branch_filter('po');

		return $this->db
			->get()
			->row()
			->total ?? 0;
	}
public function get_parts_po_summary()
{
    $this->db
        ->select('COUNT(po_id) as count, SUM(grand_total) as total')
        ->from('purchase_order_master po')
        ->where('po.purchase_type', 'PARTS')
        ->where('po.cancelled', 0);
		apply_branch_filter('po');
       return $this->db
			->get()
			->row();
}
public function get_service_po_summary()
{
     $this->db
        ->select('COUNT(po_id) as count, SUM(grand_total) as total')
        ->from('purchase_order_master po')
        ->where('po.purchase_type', 'SERVICE')
        ->where('po.cancelled', 0);
		apply_branch_filter('po');
	return $this->db
        ->get()
        ->row();
}




	public function get_recent_estimations()
	{
		 $this->db
			->select(" 
            e.estimation_id,
            e.estimation_no,
            e.grand_total,
            e.status,
            CASE
                WHEN LOWER(TRIM(COALESCE(e.status, ''))) = 'draft' THEN 'Draft'
                WHEN LOWER(TRIM(COALESCE(e.status, ''))) = 'approved' THEN 'Approved'
                WHEN LOWER(TRIM(COALESCE(e.status, ''))) = 'rejected' THEN 'Rejected'
                WHEN LOWER(TRIM(COALESCE(e.status, ''))) = 'converted' THEN 'Converted'
                WHEN LOWER(TRIM(COALESCE(e.status, ''))) = 'pending' THEN 'Pending'
                WHEN TRIM(COALESCE(e.status, '')) = '' THEN 'Draft'
                ELSE COALESCE(e.status, 'Draft')
            END AS normalized_status,
            e.created_at,
            c.name AS customer_name,
            v.registration_no
        ")
			->from('estimations e')
			->join('customers c', 'c.customer_id = e.customer_id')
			->join('vehicles v', 'v.vehicle_id = e.vehicle_id')
			->order_by('e.created_at', 'DESC')
			->limit(10);
			apply_branch_filter('e'); // dashboard friendly
			return $this->db->get()
			->result();
	}

	public function get_low_stock_items_old()
	{
		return $this->db
			->select('
            sp.part_id,
            sp.part_name,
            sp.min_stock,
            vb.brand_name,

            IFNULL(SUM(si.qty), 0) AS stock_in_qty,
            IFNULL(SUM(so.qty), 0) AS stock_out_qty,

            (IFNULL(SUM(si.qty), 0) - IFNULL(SUM(so.qty), 0)) AS current_stock
        ')
			->from('spare_parts sp')

			// Brand (optional)
			->join(
				'vehicle_brands vb',
				'vb.brand_id = sp.brand_id',
				'left'
			)

			// Stock In
			->join(
				'stock_in si',
				'si.part_id = sp.part_id',
				'left'
			)

			// Stock Out
			->join(
				'stock_out so',
				'so.part_id = sp.part_id',
				'left'
			)

			->group_by('sp.part_id')

			// Low / Out stock condition
			->having('current_stock <= sp.min_stock')

			->order_by('current_stock', 'ASC')

			->limit(10)
			->get()
			->result();
	}

	public function get_low_stock_items()
	{
		$this->db
			->select('
				sp.part_id,
				sp.part_name,
				sp.min_stock,
				vb.brand_name,
				IFNULL(ss.current_stock, 0) AS current_stock
			')
			->from('spare_parts sp')
			->join('vehicle_brands vb', 'vb.brand_id = sp.brand_id', 'left')
			->join('stock_summary ss', 'ss.part_id = sp.part_id', 'left')
			->where('IFNULL(ss.current_stock, 0) <= sp.min_stock')
			->order_by('ss.current_stock', 'ASC')
			->limit(10);
			apply_branch_filter('sp');
			return $this->db->get()->result();
	}


	public function get_recent_inspections()
	{
		 $this->db
			->select('
            i.inspection_id,
            i.status,
            i.km_reading,
            i.inspection_date,
            c.name AS customer_name,
            v.registration_no
        ')
			->from('inspections i')
			->join('customers c', 'c.customer_id = i.customer_id')
			->join('vehicles v', 'v.vehicle_id = i.vehicle_id')
			->order_by('i.created_at', 'DESC')
			->limit(10);
			apply_branch_filter('i'); // dashboard friendly
			return $this->db->get()
			->result();
	}

	public function get_jobcard_time_report()
	{
		// Get jobcards with description count & employee
		$sql = "
			SELECT 
				j.jobcard_id,
				j.jobcard_no,
				e.employee_name AS employee_name,
				COUNT(d.jobcard_description_id) AS total_jobs
			FROM job_cards j
			JOIN jobcard_descriptions d ON d.jobcard_id = j.jobcard_id
			JOIN employees e ON e.employee_id = d.employee_id
			WHERE j.status != 'COMPLETED'
			GROUP BY j.jobcard_id, e.employee_id
			";

		$rows = $this->db->query($sql)->result();

		foreach ($rows as &$row) {
			$row->worked_hours = $this->calculate_worked_hours($row->jobcard_id);
			$row->completed_jobs = $this->get_completed_jobs($row->jobcard_id);

			$row->progress = $row->total_jobs > 0
				? round(($row->completed_jobs / $row->total_jobs) * 100)
				: 0;
		}

		return $rows;
	}
	private function calculate_worked_hours($jobcard_id)
	{
		$logs = $this->db
			->where('jobcard_id', $jobcard_id)
			->order_by('jobcard_description_id, log_time')
			->get('jobcard_work_logs')
			->result();

		$totalSeconds = 0;
		$lastStart = [];

		foreach ($logs as $log) {

			$key = $log->jobcard_description_id;

			if (in_array($log->status, ['START', 'RESUME'])) {
				$lastStart[$key] = strtotime($log->log_time);
			}

			if (in_array($log->status, ['PAUSE', 'STOP']) && isset($lastStart[$key])) {
				$totalSeconds += strtotime($log->log_time) - $lastStart[$key];
				unset($lastStart[$key]);
			}
		}

		return round($totalSeconds / 3600, 2); // hours
	}

	private function get_completed_jobs($jobcard_id)
	{
		return $this->db
			->select('COUNT(DISTINCT jobcard_description_id) AS completed')
			->where('jobcard_id', $jobcard_id)
			->where('status', 'STOP')
			->get('jobcard_work_logs')
			->row()
			->completed ?? 0;
	}


	public function get_jobcard_job_completion123()
	{
		return $this->db
			->select('
            jc.jobcard_id,
            jc.jobcard_no,

            COUNT(DISTINCT jd.jobcard_description_id) AS total_jobs,

            COUNT(DISTINCT CASE 
                WHEN wl.status = "STOP" 
                THEN wl.jobcard_description_id 
            END) AS completed_jobs
        ')
			->from('job_cards jc')
			->join(
				'jobcard_descriptions jd',
				'jd.jobcard_id = jc.jobcard_id',
				'left'
			)
			->join(
				'jobcard_work_logs wl',
				'wl.jobcard_description_id = jd.jobcard_description_id',
				'left'
			)
			->group_by('jc.jobcard_id')
			->order_by('jc.created_at', 'DESC')
			->get()
			->result();
	}

	public function get_jobcard_job_completionold()
	{
		return $this->db
			->select('
            jc.jobcard_id,
            jc.jobcard_no,

            COUNT(DISTINCT js.jobcard_service_id) AS total_jobs,

            COUNT(DISTINCT CASE
                WHEN wl.status = "STOP"
                THEN wl.jobcard_service_id
            END) AS completed_jobs
        ')
			->from('job_cards jc')
			->join(
				'jobcard_services js',
				'js.jobcard_id = jc.jobcard_id',
				'left'
			)
			->join(
				'jobcard_work_logs wl',
				'wl.jobcard_service_id = js.jobcard_service_id',
				'left'
			)
			->group_by('jc.jobcard_id')
			->order_by('jc.created_at', 'DESC')
			->get()
			->result();
	}
	public function get_jobcard_job_completion()
	{
		 $this->db
			->select('
            jc.jobcard_id,
            jc.jobcard_no,
            jc.jobcard_date,

            c.name AS customer_name,
            v.registration_no,
            v.model,

            COUNT(DISTINCT js.jobcard_service_id) AS total_jobs,

            COUNT(DISTINCT CASE
                WHEN wl.status = "STOP"
                THEN wl.jobcard_service_id
            END) AS completed_jobs
        ')
			->from('job_cards jc')

			->join('customers c', 'c.customer_id = jc.customer_id', 'left')
			->join('vehicles v', 'v.vehicle_id = jc.vehicle_id', 'left')

			->join('jobcard_services js', 'js.jobcard_id = jc.jobcard_id', 'left')

			->join(
				'jobcard_work_logs wl',
				'wl.jobcard_service_id = js.jobcard_service_id',
				'left'
			)

			->group_by('jc.jobcard_id')
			->order_by('jc.created_at', 'DESC')
			->limit(10);
			apply_branch_filter('jc');
			return $this->db->get()
			->result();
	}


	public function get_jobcard_job_progress()
	{
		$standardMinutes = 60; // 1 hour per job (configurable)

		$sql = "
    SELECT
        jc.jobcard_id,
        jc.jobcard_no,

        COUNT(DISTINCT jd.jobcard_description_id) AS total_jobs,

        SUM(
            CASE
                -- COMPLETED JOB
                WHEN stop_log.jobcard_description_id IS NOT NULL THEN 100

                -- RUNNING JOB
                WHEN start_log.jobcard_description_id IS NOT NULL THEN
                    LEAST(
                        (IFNULL(running_minutes.minutes, 0) / {$standardMinutes}) * 100,
                        99
                    )

                -- NOT STARTED
                ELSE 0
            END
        ) AS total_progress
    FROM job_cards jc
    LEFT JOIN jobcard_descriptions jd
        ON jd.jobcard_id = jc.jobcard_id

    -- STOP LOG
    LEFT JOIN (
        SELECT DISTINCT jobcard_description_id
        FROM jobcard_work_logs
        WHERE status = 'STOP'
    ) stop_log
        ON stop_log.jobcard_description_id = jd.jobcard_description_id

    -- START / RESUME EXISTENCE
    LEFT JOIN (
        SELECT DISTINCT jobcard_description_id
        FROM jobcard_work_logs
        WHERE status IN ('START','RESUME')
    ) start_log
        ON start_log.jobcard_description_id = jd.jobcard_description_id

    -- RUNNING TIME (no STOP yet)
    LEFT JOIN (
        SELECT
            wl.jobcard_description_id,
            SUM(
                TIMESTAMPDIFF(
                    MINUTE,
                    wl.log_time,
                    NOW()
                )
            ) AS minutes
        FROM jobcard_work_logs wl
        WHERE wl.status IN ('START','RESUME')
          AND NOT EXISTS (
              SELECT 1 FROM jobcard_work_logs s
              WHERE s.jobcard_description_id = wl.jobcard_description_id
                AND s.status = 'STOP'
          )
        GROUP BY wl.jobcard_description_id
    ) running_minutes
        ON running_minutes.jobcard_description_id = jd.jobcard_description_id

    GROUP BY jc.jobcard_id
    ORDER BY jc.created_at DESC
    ";

		return $this->db->query($sql)->result();
	}

	// public function get_revenue_summary()
	// {
	// 	$query = $this->db->query("
	// 	SELECT
	// 		IFNULL(SUM(i.grand_total), 0) AS total_invoice_amount,

	// 		IFNULL((
	// 			SELECT SUM(v.amount)
	// 			FROM voucher_transaction v
	// 			WHERE v.voucher_type = 'R'
	// 			AND v.drcr_type = 'Cr'
	// 			AND v.cancel = 0
	// 			AND v.branch_id IN (" . implode(',', get_selected_branch_ids()) . ")
	// 		), 0) AS total_collected_amount

	// 	FROM invoices i
	// 	WHERE i.invoice_type = 'TI'
	// 	AND i.branch_id IN (" . implode(',', get_selected_branch_ids()) . ")
	// "); 

	// $row = $query->row();

	// $row->pending_amount =
	// 	$row->total_invoice_amount - $row->total_collected_amount;

	// return $row;
	// }

public function get_revenue_summary($from_date, $to_date, $can_view_job_card = null, $can_view_scrap = null)
{
    if ($can_view_job_card === null) {
        $can_view_job_card = function_exists('user_can_access_page') ? user_can_access_page('Jobcard', 'index') : true;
    }
    if ($can_view_scrap === null) {
        $can_view_scrap = function_exists('user_can_access_page') ? user_can_access_page('Scrap', 'index') : true;
    }

    $branch_ids = get_selected_branch_ids();

    $branch_condition_i  = '';
    $branch_condition_ss = '';

    if ($branch_ids !== 'all' && !empty($branch_ids)) {

        $branch_ids = array_map('intval', $branch_ids);
        $branch_list = implode(',', $branch_ids);

        $branch_condition_i  = " AND i.branch_id IN ($branch_list) ";
        $branch_condition_ss = " AND ss.branch_id IN ($branch_list) ";
    }

    $select_jobcard_revenue = $can_view_job_card
        ? "IFNULL((
            SELECT SUM(i.grand_total)
            FROM invoices i
            WHERE i.invoice_date >= ?
              AND i.invoice_date <= ?
              $branch_condition_i
        ), 0)"
        : "0";

    $select_scrap_revenue = $can_view_scrap
        ? "IFNULL((
            SELECT SUM(ss.grand_total)
            FROM scrap_sales ss
            WHERE ss.sale_date >= ?
              AND ss.sale_date <= ?
              $branch_condition_ss
        ), 0)"
        : "0";

    $select_jobcard_collected = $can_view_job_card
        ? "IFNULL((
            SELECT SUM(
                (
                    SELECT IFNULL(SUM(vt.amount), 0)
                    FROM voucher_transaction vt
                    JOIN job_cards jc
                        ON jc.jobcard_id = i.jobcard_id
                    JOIN general_ledger gl
                        ON gl.customer_id = jc.customer_id
                    WHERE
                        (
                            vt.invoice_code = i.invoice_no
                            OR
                            (
                                vt.trans_id = i.quotation_id
                                AND vt.trans_type = 'R'
                            )
                        )
                        AND vt.account_id = gl.account_id
                        AND vt.voucher_type = 'R'
                        AND vt.drcr_type = 'Cr'
                        AND vt.cancel = 0
                )
            )
            FROM invoices i
            WHERE i.invoice_date >= ?
              AND i.invoice_date <= ?
              $branch_condition_i
        ), 0)"
        : "0";

    $select_scrap_collected = $can_view_scrap
        ? "IFNULL((
            SELECT SUM(
                ss.grand_total -
                IFNULL(ss.balance, ss.grand_total)
            )
            FROM scrap_sales ss
            WHERE ss.sale_date >= ?
              AND ss.sale_date <= ?
              $branch_condition_ss
        ), 0)"
        : "0";

    $params = [];
    if ($can_view_job_card) {
        $params[] = $from_date;
        $params[] = $to_date;
    }
    if ($can_view_scrap) {
        $params[] = $from_date;
        $params[] = $to_date;
    }
    if ($can_view_job_card) {
        $params[] = $from_date;
        $params[] = $to_date;
    }
    if ($can_view_scrap) {
        $params[] = $from_date;
        $params[] = $to_date;
    }

    $sql = "
        SELECT
            $select_jobcard_revenue AS jobcard_revenue,
            $select_scrap_revenue AS scrap_revenue,
            $select_jobcard_collected AS jobcard_collected,
            $select_scrap_collected AS scrap_collected
    ";

    $query = !empty($params)
        ? $this->db->query($sql, $params)
        : $this->db->query($sql);

    $row = $query->row();

    $row->jobcard_revenue   = $can_view_job_card ? (float) ($row->jobcard_revenue ?? 0) : 0.0;
    $row->scrap_revenue     = $can_view_scrap ? (float) ($row->scrap_revenue ?? 0) : 0.0;
    $row->jobcard_collected = $can_view_job_card ? (float) ($row->jobcard_collected ?? 0) : 0.0;
    $row->scrap_collected   = $can_view_scrap ? (float) ($row->scrap_collected ?? 0) : 0.0;

    /* Combined Revenue based on access */
    $row->total_invoice_amount =
        $row->jobcard_revenue +
        $row->scrap_revenue;

    /* Combined Collected based on access */
    $row->total_collected_amount =
        $row->jobcard_collected +
        $row->scrap_collected;

    /* Pending */
    $row->pending_amount = max(0,
        $row->total_invoice_amount -
        $row->total_collected_amount);

    return $row;
}

public function get_revenue_collection_chart($filter = '12_months', $can_view_job_card = null, $can_view_scrap = null)
{
    if ($can_view_job_card === null) {
        $can_view_job_card = function_exists('user_can_access_page') ? user_can_access_page('Jobcard', 'index') : true;
    }
    if ($can_view_scrap === null) {
        $can_view_scrap = function_exists('user_can_access_page') ? user_can_access_page('Scrap', 'index') : true;
    }

    $today = date('Y-m-d');

    switch ($filter) {

        case 'last_week':

            $from_date = date(
                'Y-m-d',
                strtotime('-6 days')
            );

            $to_date = $today;

            $group_format = '%Y-%m-%d';

            $display_format = 'd M';

            break;


        case 'last_month':

            $from_date = date(
                'Y-m-d',
                strtotime('-29 days')
            );

            $to_date = $today;

            $group_format = '%Y-%m-%d';

            $display_format = 'd M';

            break;


        case '6_months':

            $from_date = date(
                'Y-m-01',
                strtotime('-5 months')
            );

            $to_date = $today;

            $group_format = '%Y-%m';

            $display_format = 'M Y';

            break;


        case '12_months':

            $from_date = date(
                'Y-m-01',
                strtotime('-11 months')
            );

            $to_date = $today;

            $group_format = '%Y-%m';

            $display_format = 'M Y';

            break;


        case 'full_revenue':

            $start_dates = [];

            if ($can_view_job_card) {
                $invoice_start = $this->db
                    ->select_min('invoice_date')
                    ->get('invoices')
                    ->row();

                if (!empty($invoice_start->invoice_date)) {
                    $start_dates[] = $invoice_start->invoice_date;
                }
            }

            if ($can_view_scrap) {
                $scrap_start = $this->db
                    ->select_min('sale_date')
                    ->get('scrap_sales')
                    ->row();

                if (!empty($scrap_start->sale_date)) {
                    $start_dates[] = $scrap_start->sale_date;
                }
            }

            if (!empty($start_dates)) {
                $from_date = min($start_dates);
            } else {
                $from_date = $today;
            }

            $to_date = $today;

            $group_format = '%Y-%m';

            $display_format = 'M Y';

            break;


        default:

            $from_date = date(
                'Y-m-01',
                strtotime('-11 months')
            );

            $to_date = $today;

            $group_format = '%Y-%m';

            $display_format = 'M Y';

            break;
    }

    $branch_ids = get_selected_branch_ids();

    $invoice_branch_condition = '';
    $scrap_branch_condition   = '';


    if ($branch_ids !== 'all' && !empty($branch_ids)) {

        $branch_ids = array_map(
            'intval',
            $branch_ids
        );

        $branch_list = implode(
            ',',
            $branch_ids
        );

        $invoice_branch_condition =
            " AND i.branch_id IN ($branch_list) ";

        $scrap_branch_condition =
            " AND ss.branch_id IN ($branch_list) ";
    }

    $revenue_subqueries = [];
    $revenue_params = [];

    if ($can_view_job_card) {
        $revenue_subqueries[] = "
            SELECT
                DATE_FORMAT(
                    i.invoice_date,
                    '$group_format'
                ) AS month_key,
                SUM(i.grand_total) AS revenue
            FROM invoices i
            WHERE i.invoice_date >= ?
              AND i.invoice_date <= ?
              $invoice_branch_condition
            GROUP BY
                DATE_FORMAT(
                    i.invoice_date,
                    '$group_format'
                )
        ";
        $revenue_params[] = $from_date;
        $revenue_params[] = $to_date;
    }

    if ($can_view_scrap) {
        $revenue_subqueries[] = "
            SELECT
                DATE_FORMAT(
                    ss.sale_date,
                    '$group_format'
                ) AS month_key,
                SUM(ss.grand_total) AS revenue
            FROM scrap_sales ss
            WHERE ss.sale_date >= ?
              AND ss.sale_date <= ?
              $scrap_branch_condition
            GROUP BY
                DATE_FORMAT(
                    ss.sale_date,
                    '$group_format'
                )
        ";
        $revenue_params[] = $from_date;
        $revenue_params[] = $to_date;
    }

    $revenue_data = [];
    if (!empty($revenue_subqueries)) {
        $revenue_sql = "
            SELECT
                month_key,
                SUM(revenue) AS revenue
            FROM
            (
                " . implode(" UNION ALL ", $revenue_subqueries) . "
            ) revenue_data
            GROUP BY month_key
            ORDER BY month_key
        ";

        $revenue_query = $this->db->query(
            $revenue_sql,
            $revenue_params
        );

        foreach ($revenue_query->result() as $row) {
            $revenue_data[$row->month_key] =
                (float) $row->revenue;
        }
    }

    $collection_subqueries = [];
    $collection_params = [];

    if ($can_view_job_card) {
        $collection_subqueries[] = "
            SELECT
                DATE_FORMAT(
                    vt.voucher_date,
                    '$group_format'
                ) AS month_key,
                SUM(vt.amount) AS collection
            FROM voucher_transaction vt
            INNER JOIN invoices i
                ON (
                    vt.invoice_code = i.invoice_no
                    OR
                    (
                        vt.trans_id = i.quotation_id
                        AND vt.trans_type = 'R'
                    )
                )
            INNER JOIN job_cards jc
                ON jc.jobcard_id = i.jobcard_id
            INNER JOIN general_ledger gl
                ON gl.customer_id = jc.customer_id
            WHERE vt.voucher_type = 'R'
              AND vt.drcr_type = 'Cr'
              AND vt.cancel = 0
              AND vt.account_id = gl.account_id
              AND vt.voucher_date >= ?
              AND vt.voucher_date <= ?
            GROUP BY
                DATE_FORMAT(
                    vt.voucher_date,
                    '$group_format'
                )
        ";
        $collection_params[] = $from_date;
        $collection_params[] = $to_date;
    }

    if ($can_view_scrap) {
        $collection_subqueries[] = "
            SELECT
                DATE_FORMAT(
                    ss.sale_date,
                    '$group_format'
                ) AS month_key,
                SUM(
                    ss.grand_total -
                    IFNULL(
                        ss.balance,
                        ss.grand_total
                    )
                ) AS collection
            FROM scrap_sales ss
            WHERE ss.sale_date >= ?
              AND ss.sale_date <= ?
              $scrap_branch_condition
            GROUP BY
                DATE_FORMAT(
                    ss.sale_date,
                    '$group_format'
                )
        ";
        $collection_params[] = $from_date;
        $collection_params[] = $to_date;
    }

    $collection_data = [];
    if (!empty($collection_subqueries)) {
        $collection_sql = "
            SELECT
                month_key,
                SUM(collection) AS collection
            FROM
            (
                " . implode(" UNION ALL ", $collection_subqueries) . "
            ) collection_data
            GROUP BY month_key
            ORDER BY month_key
        ";

        $collection_query = $this->db->query(
            $collection_sql,
            $collection_params
        );

        foreach ($collection_query->result() as $row) {
            $collection_data[$row->month_key] =
                (float) $row->collection;
        }
    }


    $labels = [];

    $revenue = [];

    $collection = [];

    $pending = [];

    if (
        $filter === 'last_week' ||
        $filter === 'last_month'
    ) {

        $current = strtotime($from_date);

        $end = strtotime($to_date);


        while ($current <= $end) {

            $key = date(
                'Y-m-d',
                $current
            );


            $labels[] = date(
                $display_format,
                $current
            );


            $monthly_revenue =
                isset($revenue_data[$key])
                    ? $revenue_data[$key]
                    : 0;


            $monthly_collection =
                isset($collection_data[$key])
                    ? $collection_data[$key]
                    : 0;


            $monthly_pending =
                $monthly_revenue -
                $monthly_collection;


            /*
             * Prevent negative pending.
             */

            if ($monthly_pending < 0) {
                $monthly_pending = 0;
            }


            $revenue[] =
                round(
                    $monthly_revenue,
                    2
                );


            $collection[] =
                round(
                    $monthly_collection,
                    2
                );


            $pending[] =
                round(
                    $monthly_pending,
                    2
                );


            $current = strtotime(
                '+1 day',
                $current
            );
        }

    }

    else {

        $current = strtotime(
            date(
                'Y-m-01',
                strtotime($from_date)
            )
        );


        $end = strtotime(
            date(
                'Y-m-01',
                strtotime($to_date)
            )
        );


        while ($current <= $end) {

            $key = date(
                'Y-m',
                $current
            );


            $labels[] = date(
                $display_format,
                $current
            );


            $monthly_revenue =
                isset($revenue_data[$key])
                    ? $revenue_data[$key]
                    : 0;


            $monthly_collection =
                isset($collection_data[$key])
                    ? $collection_data[$key]
                    : 0;


            $monthly_pending =
                $monthly_revenue -
                $monthly_collection;


            if ($monthly_pending < 0) {
                $monthly_pending = 0;
            }


            $revenue[] =
                round(
                    $monthly_revenue,
                    2
                );


            $collection[] =
                round(
                    $monthly_collection,
                    2
                );


            $pending[] =
                round(
                    $monthly_pending,
                    2
                );


            $current = strtotime(
                '+1 month',
                $current
            );
        }
    }


// Total revenue for selected period
$total_revenue = array_sum(
    array_map('floatval', $revenue)
);

// Total collection for selected period
$total_collection = array_sum(
    array_map('floatval', $collection)
);

// Total pending for selected period
$total_pending = $total_revenue - $total_collection;

// Prevent negative pending
if ($total_pending < 0) {
    $total_pending = 0;
}

// Collection percentage
$collection_percentage = 0;

if ($total_revenue > 0) {
    $collection_percentage =
        ($total_collection / $total_revenue) * 100;
}


// =========================================================
// RETURN CHART + SUMMARY
// =========================================================

return [

    'filter' =>
        $filter,

    'from_date' =>
        $from_date,

    'to_date' =>
        $to_date,

    'labels' =>
        $labels,

    'revenue' =>
        $revenue,

    'collection' =>
        $collection,

    'pending' =>
        $pending,

    // Summary for selected filter
    'summary' => [

        'revenue' =>
            round($total_revenue, 2),

        'collection' =>
            round($total_collection, 2),

        'pending' =>
            round($total_pending, 2),

        'percentage' =>
            round($collection_percentage, 2)
    ]
];

}


	public function get_cash_bank_balances11()
	{
		$sql = "SELECT 
                gl.account_id,
                gl.account_name,
                ag.group_name,

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0) AS balance

            FROM general_ledger gl

            LEFT JOIN account_group ag 
                ON ag.group_no = gl.group_no

            LEFT JOIN voucher_transaction vt 
                ON vt.account_id = gl.account_id
                AND vt.cancel = 0

            -- WHERE ag.group_name IN ('Cash', 'Bank')
			WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

            GROUP BY gl.account_id
            ORDER BY ag.group_name, gl.account_name";

		return $this->db->query($sql)->result();
	}

	public function get_cash_bank_balances()
{
        $branch_ids = get_selected_branch_ids();
        $branch_condition = '';

        if ($branch_ids !== 'all' && !empty($branch_ids)) {
            $branch_list = implode(',', array_map('intval', $branch_ids));
            $branch_condition = " AND vt.branch_id IN ($branch_list)";
        }

	$sql = "SELECT 
            gl.account_id,
            gl.account_name,
            ag.group_name,

            (
                IFNULL(
                    CASE 
                        WHEN gl.opening_bal_type = 'Dr' THEN gl.opening_balance
                        WHEN gl.opening_bal_type = 'Cr' THEN -gl.opening_balance
                        ELSE 0
                    END
                ,0)

                +

                IFNULL(SUM(
                    CASE 
                        WHEN vt.drcr_type = 'Dr' THEN vt.amount
                        WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                    END
                ),0)

            ) AS balance

        FROM general_ledger gl

        LEFT JOIN account_group ag 
            ON ag.group_no = gl.group_no

        LEFT JOIN voucher_transaction vt 
            ON vt.account_id = gl.account_id
            AND vt.cancel = 0
            $branch_condition

        WHERE ag.group_name IN ('Cash-in-hand', 'Bank Accounts')

        GROUP BY gl.account_id
        ORDER BY ag.group_name, gl.account_name";

return $this->db->query($sql)->result();
}
public function get_jobcard_status_chart($filter = '12_months')
{
    // =====================================================
    // 1. VALIDATE FILTER
    // =====================================================

    $allowed_filters = [
        'last_week',
        'last_month',
        '6_months',
        '12_months',
        'full_jobcards'
    ];

    if (!in_array($filter, $allowed_filters, true)) {
        $filter = '12_months';
    }


    // =====================================================
    // 2. DATE RANGE
    // =====================================================

    $today = date('Y-m-d');

    switch ($filter) {

        case 'last_week':

            $from_date = date(
                'Y-m-d',
                strtotime('-6 days')
            );

            $to_date = $today;

            break;


        case 'last_month':

            $from_date = date(
                'Y-m-d',
                strtotime('-29 days')
            );

            $to_date = $today;

            break;


        case '6_months':

            $from_date = date(
                'Y-m-01',
                strtotime('-5 months')
            );

            $to_date = $today;

            break;


        case '12_months':

            $from_date = date(
                'Y-m-01',
                strtotime('-11 months')
            );

            $to_date = $today;

            break;


        case 'full_jobcards':

            /*
             * Get the earliest job card date.
             * Use jobcard_date first.
             */

            $this->db
                ->select('MIN(jc.jobcard_date) AS earliest_date')
                ->from('job_cards jc');

            apply_branch_filter('jc');

            $row = $this->db
                ->get()
                ->row();

            if (!empty($row->earliest_date)) {

                $from_date = date(
                    'Y-m-d',
                    strtotime($row->earliest_date)
                );

            } else {

                $from_date = $today;
            }

            $to_date = $today;

            break;


        default:

            $from_date = date(
                'Y-m-01',
                strtotime('-11 months')
            );

            $to_date = $today;

            break;
    }


    // =====================================================
    // 3. GET JOB CARD STATUS COUNTS
    // =====================================================

    $this->db
        ->select("
            COUNT(*) AS total,

            SUM(
                CASE
                    WHEN LOWER(TRIM(COALESCE(jc.status, ''))) = 'scheduled'
                    THEN 1
                    ELSE 0
                END
            ) AS scheduled,

            SUM(
                CASE
                    WHEN LOWER(TRIM(COALESCE(jc.status, ''))) = 'in progress'
                         OR LOWER(TRIM(COALESCE(jc.status, ''))) = 'in-progress'
                    THEN 1
                    ELSE 0
                END
            ) AS in_progress,

            SUM(
                CASE
                    WHEN LOWER(TRIM(COALESCE(jc.status, ''))) = 'finished'
                         OR LOWER(TRIM(COALESCE(jc.status, ''))) = 'completed'
                         OR LOWER(TRIM(COALESCE(jc.status, ''))) = 'null'
                         OR TRIM(COALESCE(jc.status, '')) = ''
                         OR jc.status IS NULL
                    THEN 1
                    ELSE 0
                END
            ) AS finished
        ")
        ->from('job_cards jc')
        ->where('DATE(jc.jobcard_date) >=', $from_date)
        ->where('DATE(jc.jobcard_date) <=', $to_date);

    apply_branch_filter('jc');

    $row = $this->db
        ->get()
        ->row();


    // =====================================================
    // 4. CONVERT VALUES TO INTEGER
    // =====================================================

    $total = (int) ($row->total ?? 0);

    $scheduled = (int) ($row->scheduled ?? 0);

    $in_progress = (int) ($row->in_progress ?? 0);

    $finished = (int) ($row->finished ?? 0);


    // =====================================================
    // 5. COMPLETION RATE
    // =====================================================

    $completion_rate = 0;

    if ($total > 0) {

        $completion_rate =
            ($finished / $total) * 100;
    }


    // =====================================================
    // 6. RETURN DATA
    // =====================================================

    return [

        'filter' => $filter,

        'from_date' => $from_date,

        'to_date' => $to_date,

        'scheduled' => $scheduled,

        'in_progress' => $in_progress,

        'finished' => $finished,

        'total' => $total,

        'completion_rate' =>
            round($completion_rate, 2)
    ];
}


	/**
	 * Executive dashboard summary.
	 * Uses only tables/columns already used by this model.
	 */
	public function get_dashboard_summary($can_view_job_card = null, $can_view_scrap = null)
	{
		if ($can_view_job_card === null) {
			$can_view_job_card = function_exists('user_can_access_page') ? user_can_access_page('Jobcard', 'index') : true;
		}
		if ($can_view_scrap === null) {
			$can_view_scrap = function_exists('user_can_access_page') ? user_can_access_page('Scrap', 'index') : true;
		}

		$summary = new stdClass();

		$summary->total_revenue = (float) $this->get_total_revenue($can_view_job_card, $can_view_scrap);
		$summary->total_purchase = (float) $this->get_total_purchase_amount();
		$summary->active_customers = (int) $this->get_customers_count();
		$summary->vehicles = (int) $this->get_vehicles_count();
		$summary->scheduled_job_cards = (int) $this->get_Scheduled_job_cards_count();
		$summary->in_progress_job_cards = (int) $this->get_inprogress_job_cards_count();
		$summary->finished_job_cards = (int) $this->get_finished_job_cards_count();
		$summary->active_job_cards = (int) $this->get_active_job_cards_count();

		$summary->low_stock_count = (int) $this->get_low_stock_count();
		$summary->cash_balance = (float) $this->get_cash_bank_total();

		$summary->collection = 0;
		$summary->pending = 0;
		$summary->collection_rate = 0;

		$period = $this->get_revenue_summary(
			date('Y-m-01'),
			date('Y-m-d'),
			$can_view_job_card,
			$can_view_scrap
		);

		$summary->monthly_revenue = (float) ($period->total_invoice_amount ?? 0);
		$summary->monthly_collection = (float) ($period->total_collected_amount ?? 0);
		$summary->monthly_pending = max(0, $summary->monthly_revenue - $summary->monthly_collection);
		$summary->monthly_collection_rate = $summary->monthly_revenue > 0
			? round(($summary->monthly_collection / $summary->monthly_revenue) * 100, 2)
			: 0;

		return $summary;
	}

	public function get_low_stock_count()
	{
		$this->db
			->from('spare_parts sp')
			->join('stock_summary ss', 'ss.part_id = sp.part_id', 'left')
			->where('IFNULL(ss.current_stock, 0) <= sp.min_stock');

		apply_branch_filter('sp');
		return (int) $this->db->count_all_results();
	}

	public function get_cash_bank_total()
	{
		$rows = $this->get_cash_bank_balances();
		$total = 0;
		foreach ($rows as $row) {
			$total += (float) ($row->balance ?? 0);
		}
		return $total;
	}

	public function get_dashboard_notifications()
	{
		$notifications = [];

		$low = $this->get_low_stock_items();
		if (!empty($low)) {
			$notifications[] = (object) [
				'type' => 'warning',
				'title' => 'Inventory alert',
				'message' => count($low) . ' item(s) are at or below minimum stock.',
				'url' => base_url('index.php/spareparts')
			];
		}

		if ((int) $this->get_Scheduled_job_cards_count() > 0) {
			$notifications[] = (object) [
				'type' => 'info',
				'title' => 'Scheduled job cards',
				'message' => $this->get_Scheduled_job_cards_count() . ' job card(s) are scheduled.',
				'url' => base_url('index.php/Jobcard')
			];
		}

		return array_slice($notifications, 0, 5);
	}

}
