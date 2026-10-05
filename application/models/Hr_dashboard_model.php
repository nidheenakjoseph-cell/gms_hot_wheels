<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr_dashboard_model extends CI_Model
{
    protected $employee_table =
        'employees';

    protected $resignation_table =
        'employee_resignation';

    protected $leave_table =
        'employee_leave';

    protected $salary_table =
        'salary_structure';

    protected $salary_advance_table =
        'employee_salary_advance';

    protected $allowance_master_table =
        'allowance_master';

    protected $passport_release_table =
        'employee_document_details';

    protected $holiday_table =
        'holiday_master';

    protected $branch_table =
        'branches';

    protected $attendance_table =
        'employee_attendance';

    public function __construct()
    {
        parent::__construct();
    }

    public function resolve_date_range(
        $date_range,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $today =
            date('Y-m-d');

        if (
            !empty($from_date) &&
            !empty($to_date)
        ) {

            return array(
                'from_date' => $from_date,
                'to_date'   => $to_date
            );
        }

        switch ($date_range) {

            case 'today':

                return array(
                    'from_date' => $today,
                    'to_date'   => $today
                );

            case 'this_week':

                return array(
                    'from_date' =>
                        date(
                            'Y-m-d',
                            strtotime('monday this week')
                        ),

                    'to_date' =>
                        date(
                            'Y-m-d',
                            strtotime('sunday this week')
                        )
                );

            case 'this_month':

                return array(
                    'from_date' =>
                        date('Y-m-01'),

                    'to_date' =>
                        date('Y-m-t')
                );

            case '6_months':

                return array(
                    'from_date' =>
                        date(
                            'Y-m-d',
                            strtotime('-5 months')
                        ),

                    'to_date' =>
                        $today
                );

            case '12_months':

                return array(
                    'from_date' =>
                        date(
                            'Y-m-d',
                            strtotime('-11 months')
                        ),

                    'to_date' =>
                        $today
                );

            case 'full_hr_data':

                return array(
                    'from_date' => NULL,
                    'to_date'   => NULL
                );

            default:

                return array(
                    'from_date' =>
                        date('Y-m-01'),

                    'to_date' =>
                        date('Y-m-t')
                );
        }
    }

    public function get_branches()
    {
        return $this->db
            ->select(
                'branch_id, branch_code, branch_name'
            )
            ->from(
                $this->branch_table
            )
            ->where(
                'is_active',
                1
            )
            ->order_by(
                'branch_name',
                'ASC'
            )
            ->get()
            ->result();
    }

    public function get_employee_summary(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->from(
                $this->employee_table
            );

        $this->apply_branch_filter(
            $branch_id,
            'branch_id'
        );

        $total_employees =
            $this->db
                ->count_all_results();

        $this->db
            ->from(
                $this->employee_table
            )
            ->where(
                'status',
                'Active'
            );

        $this->apply_branch_filter(
            $branch_id,
            'branch_id'
        );

        $active_employees =
            $this->db
                ->count_all_results();

        $this->db
            ->from(
                $this->employee_table
            );

        $this->apply_branch_filter(
            $branch_id,
            'branch_id'
        );

        $this->apply_date_filter(
            'joining_date',
            $from_date,
            $to_date
        );

        $new_joinings =
            $this->db
                ->count_all_results();

        $this->db
            ->select(
                'r.resig_id'
            )
            ->from(
                $this->resignation_table . ' r'
            )
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = r.employee_id',
                'inner'
            );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $this->apply_date_filter(
            'r.resignation_date',
            $from_date,
            $to_date
        );

        $resignations =
            $this->db
                ->count_all_results();

        return array(

            'total_employees' =>
                $total_employees,

            'active_employees' =>
                $active_employees,

            'new_joinings' =>
                $new_joinings,

            'resignations' =>
                $resignations
        );
    }

    public function get_leave_summary(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->from(
                $this->leave_table . ' el'
            );

        if (
            $branch_id !== NULL &&
            $branch_id !== ''
        ) {

            $this->db->join(
                $this->employee_table . ' e',
                'e.employee_id = el.employee_id',
                'inner'
            );

            $this->db->where(
                'e.branch_id',
                (int) $branch_id
            );
        }

        $this->apply_date_filter(
            'el.application_date',
            $from_date,
            $to_date
        );

        $leave_applications =
            $this->db
                ->count_all_results();

        $today =
            date('Y-m-d');

        $this->db
            ->select(
                'el.employee_id'
            )
            ->from(
                $this->leave_table . ' el'
            );

        if (
            $branch_id !== NULL &&
            $branch_id !== ''
        ) {

            $this->db->join(
                $this->employee_table . ' e',
                'e.employee_id = el.employee_id',
                'inner'
            );

            $this->db->where(
                'e.branch_id',
                (int) $branch_id
            );
        }

        $this->db
            ->where(
                'el.start_date <=',
                $today
            )
            ->where(
                'el.end_date >=',
                $today
            )
            ->group_by(
                'el.employee_id'
            );

        $employees_on_leave =
            $this->db
                ->get()
                ->num_rows();

        return array(

            'leave_applications' =>
                $leave_applications,

            'leave_days_taken' =>
                $leave_days_taken,

            'available_leave' =>
                $available_leave,

            'employees_on_leave' =>
                $employees_on_leave
        );
    }

    public function get_salary_summary(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->select("
                ss.emp_id,
                ss.basic_salary,
                ss.total_allowances,
                ss.total_deductions,
                ss.gross_salary,
                ss.effective_date,
                ss.sid
            ", FALSE)
            ->from('salary_structure ss');

        $this->db->join(
            'employees e',
            'e.employee_id = ss.emp_id',
            'INNER'
        );

        if (
            $branch_id !== NULL &&
            $branch_id !== '' &&
            $branch_id != '0'
        ) {

            $this->db->where(
                'e.branch_id',
                (int) $branch_id
            );
        }

        if (!empty($from_date)) {

            $this->db->where(
                'DATE(ss.effective_date) >=',
                $from_date
            );
        }

        if (!empty($to_date)) {

            $this->db->where(
                'DATE(ss.effective_date) <=',
                $to_date
            );
        }

        $salary_query = $this->db->get();

        $employee_count   = 0;
        $basic_salary     = 0;
        $total_allowances = 0;
        $total_deductions = 0;
        $gross_salary     = 0;

        if (
            $salary_query &&
            $salary_query->num_rows() > 0
        ) {

            $salary_by_employee = array();

            foreach ($salary_query->result() as $row) {

                $emp_id = $row->emp_id;

                if (!isset($salary_by_employee[$emp_id])) {

                    $salary_by_employee[$emp_id] = $row;

                    continue;
                }

                $existing_date = strtotime(
                    $salary_by_employee[$emp_id]->effective_date
                );

                $current_date = strtotime(
                    $row->effective_date
                );

                if ($current_date > $existing_date) {

                    $salary_by_employee[$emp_id] = $row;

                } elseif (
                    $current_date == $existing_date &&
                    $row->sid >
                    $salary_by_employee[$emp_id]->sid
                ) {

                    $salary_by_employee[$emp_id] = $row;
                }
            }

            $employee_count =
                count($salary_by_employee);

            foreach (
                $salary_by_employee as $row
            ) {

                $basic_salary +=
                    (float) $row->basic_salary;

                $total_allowances +=
                    (float) $row->total_allowances;

                $total_deductions +=
                    (float) $row->total_deductions;

                $gross_salary +=
                    (float) $row->gross_salary;
            }
        }

        return array(

            'employee_count' =>
                $employee_count,

            'basic_salary' =>
                $basic_salary,

            'total_allowances' =>
                $total_allowances,

            'total_deductions' =>
                $total_deductions,

            'gross_salary' =>
                $gross_salary
        );
    }

    public function get_salary_advance_summary(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->select("
                COUNT(*) AS advance_count,

                COALESCE(
                    SUM(a.amount),
                    0
                ) AS advance_amount,

                COALESCE(
                    SUM(
                        CASE
                            WHEN UPPER(
                                TRIM(a.payment_mode)
                            ) = 'CASH'
                            THEN a.amount
                            ELSE 0
                        END
                    ),
                    0
                ) AS cash_amount,

                COALESCE(
                    SUM(
                        CASE
                            WHEN UPPER(
                                TRIM(a.payment_mode)
                            ) = 'BANK'
                            THEN a.amount
                            ELSE 0
                        END
                    ),
                    0
                ) AS bank_amount
            ", FALSE)
            ->from(
                $this->salary_advance_table . ' a'
            )
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = a.emp_id',
                'left'
            );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $this->apply_date_filter(
            'a.advance_date',
            $from_date,
            $to_date
        );

        $row =
            $this->db
                ->get()
                ->row();

        return array(

            'advance_count' =>
                $row
                    ? (int) $row->advance_count
                    : 0,

            'advance_amount' =>
                $row
                    ? (float) $row->advance_amount
                    : 0,

            'cash_amount' =>
                $row
                    ? (float) $row->cash_amount
                    : 0,

            'bank_amount' =>
                $row
                    ? (float) $row->bank_amount
                    : 0
        );
    }

    public function get_employee_movement_chart(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $labels =
            array();

        $joinings =
            array();

        $resignations =
            array();

        if (
            empty($from_date) ||
            empty($to_date)
        ) {

            $from_date =
                date(
                    'Y-m-d',
                    strtotime('-11 months')
                );

            $to_date =
                date('Y-m-d');
        }

        $start =
            new DateTime(
                date(
                    'Y-m-01',
                    strtotime($from_date)
                )
            );

        $end =
            new DateTime(
                date(
                    'Y-m-01',
                    strtotime($to_date)
                )
            );

        while ($start <= $end) {

            $month_start =
                $start->format('Y-m-01');

            $month_end =
                $start->format('Y-m-t');


            $labels[] =
                $start->format('M Y');

            $this->db
                ->from(
                    $this->employee_table
                )
                ->where(
                    'joining_date >=',
                    $month_start
                )
                ->where(
                    'joining_date <=',
                    $month_end
                );

            $this->apply_branch_filter(
                $branch_id,
                'branch_id'
            );

            $joinings[] =
                (int) $this->db
                    ->count_all_results();

            $this->db
                ->select(
                    'r.resig_id'
                )
                ->from(
                    $this->resignation_table . ' r'
                )
                ->join(
                    $this->employee_table . ' e',
                    'e.employee_id = r.employee_id',
                    'inner'
                )
                ->where(
                    'r.resignation_date >=',
                    $month_start
                )
                ->where(
                    'r.resignation_date <=',
                    $month_end
                );

            $this->apply_branch_filter(
                $branch_id,
                'e.branch_id'
            );

            $resignations[] =
                (int) $this->db
                    ->count_all_results();


            $start->modify(
                '+1 month'
            );
        }

        return array(

            'labels' =>
                $labels,

            'joinings' =>
                $joinings,

            'resignations' =>
                $resignations
        );
    }

    public function get_department_chart(
        $branch_id = NULL
    ) {

        $this->db
            ->select(
                'd.department_name,
                 COUNT(e.employee_id) AS employee_count',
                FALSE
            )
            ->from(
                $this->employee_table . ' e'
            )
            ->join(
                'departments d',
                'd.department_id = e.department_id',
                'left'
            );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $this->db
            ->where(
                'e.status',
                'Active'
            )
            ->group_by(
                'e.department_id'
            )
            ->order_by(
                'employee_count',
                'DESC'
            );

        $rows =
            $this->db
                ->get()
                ->result();

        $labels =
            array();

        $values =
            array();

        foreach ($rows as $row) {

            $labels[] =
                !empty($row->department_name)
                    ? $row->department_name
                    : 'Unknown';

            $values[] =
                (int) $row->employee_count;
        }

        return array(

            'labels' =>
                $labels,

            'values' =>
                $values
        );
    }

    public function get_branch_chart(
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->select(
                'b.branch_name,
                 COUNT(e.employee_id) AS employee_count',
                FALSE
            )
            ->from(
                $this->employee_table . ' e'
            )
            ->join(
                $this->branch_table . ' b',
                'b.branch_id = e.branch_id',
                'left'
            )
            ->where(
                'e.status',
                'Active'
            )
            ->group_by(
                'e.branch_id'
            )
            ->order_by(
                'employee_count',
                'DESC'
            );

        $rows =
            $this->db
                ->get()
                ->result();

        $labels =
            array();

        $values =
            array();

        foreach ($rows as $row) {

            $labels[] =
                !empty($row->branch_name)
                    ? $row->branch_name
                    : 'Unknown';

            $values[] =
                (int) $row->employee_count;
        }

        return array(

            'labels' =>
                $labels,

            'values' =>
                $values
        );
    }

    public function get_allowance_summary(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->select("
                am.sno AS allowance_id,
                am.allowance_name,
                am.allowance_type,
                COALESCE(SUM(ssd.amount), 0) AS amount
            ", FALSE)
            ->from('salary_structure_details ssd')

            ->join(
                $this->allowance_master_table . ' am',
                'am.sno = ssd.allowance_id',
                'inner'
            )

            ->join(
                $this->salary_table . ' ss',
                'ss.sid = ssd.sid',
                'left'
            )

            ->join(
                $this->employee_table . ' e',
                'e.employee_id = ssd.employee_id',
                'left'
            )

            ->where(
                'am.allowance_type',
                'A'
            );

        if ($branch_id !== NULL && $branch_id !== '') {

            $this->db->where(
                'e.branch_id',
                (int) $branch_id
            );
        }

        if (!empty($from_date) && !empty($to_date)) {

            $this->db
                ->where(
                    'DATE(ss.effective_date) >=',
                    $from_date
                )
                ->where(
                    'DATE(ss.effective_date) <=',
                    $to_date
                );
        }

        $this->db
            ->group_by(array(
                'am.sno',
                'am.allowance_name',
                'am.allowance_type'
            ))
            ->order_by(
                'amount',
                'DESC'
            );

        return $this->db
            ->get()
            ->result();
    }

    public function get_deduction_summary(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->select("
                am.sno AS allowance_id,
                am.allowance_name,
                am.allowance_type,
                COALESCE(SUM(ssd.amount), 0) AS amount
            ", FALSE)
            ->from('salary_structure_details ssd')

            ->join(
                $this->allowance_master_table . ' am',
                'am.sno = ssd.allowance_id',
                'inner'
            )

            ->join(
                $this->salary_table . ' ss',
                'ss.sid = ssd.sid',
                'left'
            )

            ->join(
                $this->employee_table . ' e',
                'e.employee_id = ssd.employee_id',
                'left'
            )

            ->where(
                'am.allowance_type',
                'D'
            );

        if ($branch_id !== NULL && $branch_id !== '') {

            $this->db->where(
                'e.branch_id',
                (int) $branch_id
            );
        }

        if (!empty($from_date) && !empty($to_date)) {

            $this->db
                ->where(
                    'DATE(ss.effective_date) >=',
                    $from_date
                )
                ->where(
                    'DATE(ss.effective_date) <=',
                    $to_date
                );
        }

        $this->db
            ->group_by(array(
                'am.sno',
                'am.allowance_name',
                'am.allowance_type'
            ))
            ->order_by(
                'amount',
                'DESC'
            );

        return $this->db
            ->get()
            ->result();
    }

    public function get_passport_summary(
        $branch_id = NULL
    ) {

        $today =
            date('Y-m-d');

        $three_months =
            date(
                'Y-m-d',
                strtotime('+3 months')
            );

        $this->db
        ->select('COUNT(DISTINCT p.emp_id) AS total', FALSE)
        ->from(
            $this->passport_release_table . ' p'
        )
        ->join(
            $this->employee_table . ' e',
            'e.employee_id = p.emp_id',
            'inner'
        )
        ->where(
            "LOWER(TRIM(p.document_name)) = 'passport'",
            NULL,
            FALSE
        );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $row = $this->db
            ->get()
            ->row();

        $with_passport = $row
            ? (int) $row->total
            : 0;

        $this->db
            ->select(
                'COUNT(DISTINCT p.emp_id) AS total',
                FALSE
            )
            ->from(
                $this->passport_release_table . ' p'
            )
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = p.emp_id',
                'inner'
            )
            ->where(
                "LOWER(TRIM(p.document_name)) = 'passport'",
                NULL,
                FALSE
            )
            ->where(
                'p.expiry_date IS NOT NULL',
                NULL,
                FALSE
            )
            ->where(
                "p.expiry_date != '0000-00-00'",
                NULL,
                FALSE
            )
            ->where(
                'DATE(p.expiry_date) < CURDATE()',
                NULL,
                FALSE
            );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $row =
            $this->db
                ->get()
                ->row();

        $expired =
            $row
                ? (int) $row->total
                : 0;

        $this->db
            ->select(
                'COUNT(DISTINCT p.emp_id) AS total',
                FALSE
            )
            ->from(
                $this->passport_release_table . ' p'
            )
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = p.emp_id',
                'inner'
            )
            ->where(
                "LOWER(TRIM(p.document_name)) = 'passport'",
                NULL,
                FALSE
            )
            ->where(
                'p.expiry_date IS NOT NULL',
                NULL,
                FALSE
            )
            ->where(
                "p.expiry_date != '0000-00-00'",
                NULL,
                FALSE
            )
            ->where(
                'DATE(p.expiry_date) >= CURDATE()',
                NULL,
                FALSE
            )
            ->where(
                'DATE(p.expiry_date) <= DATE_ADD(CURDATE(), INTERVAL 3 MONTH)',
                NULL,
                FALSE
            );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $row =
            $this->db
                ->get()
                ->row();

        $expiring_soon =
            $row
                ? (int) $row->total
                : 0;

        $this->db
            ->select(
                'COUNT(DISTINCT p.emp_id) AS total',
                FALSE
            )
            ->from(
                $this->passport_release_table . ' p'
            )
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = p.emp_id',
                'inner'
            )
            ->where(
                "LOWER(TRIM(p.document_name)) = 'passport'",
                NULL,
                FALSE
            )
            ->where(
                "LOWER(TRIM(p.posession)) = 'company'",
                NULL,
                FALSE
            );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $row =
            $this->db
                ->get()
                ->row();

        $held_by_company =
            $row
                ? (int) $row->total
                : 0;

        $this->db
            ->select(
                'COUNT(DISTINCT p.emp_id) AS total',
                FALSE
            )
            ->from(
                $this->passport_release_table . ' p'
            )
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = p.emp_id',
                'inner'
            )
            ->where(
                "LOWER(TRIM(p.document_name)) = 'passport'",
                NULL,
                FALSE
            )
            ->where(
                "LOWER(TRIM(p.posession)) = 'their own'",
                NULL,
                FALSE
            );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $row =
            $this->db
                ->get()
                ->row();

        $held_by_employee =
            $row
                ? (int) $row->total
                : 0;

        return array(

            'with_passport' =>
                $with_passport,

            'expired' =>
                $expired,

            'expiring_soon' =>
                $expiring_soon,

            'held_by_company' =>
                $held_by_company,

            'held_by_employee' =>
                $held_by_employee
        );
    }

    public function get_passport_expiry_alerts(
        $branch_id = NULL
    ) {

        $today =
            date('Y-m-d');

        $six_months =
            date(
                'Y-m-d',
                strtotime('+6 months')
            );

        $this->db
            ->select("
                p.emp_id AS employee_id,
                e.employee_name,
                e.employee_code,
                p.document_number,
                p.issue_date,
                p.expiry_date,
                p.outdate,
                p.indate,
                p.posession,
                p.reason,
                p.remark,
                e.branch_id
            ", FALSE)
            ->from(
                $this->passport_release_table . ' p'
            )
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = p.emp_id',
                'inner'
            )
            ->where(
                'LOWER(TRIM(p.document_name))',
                'passport'
            )
            ->where(
                'p.expiry_date IS NOT NULL',
                NULL,
                FALSE
            )
            ->where(
                'p.expiry_date !=',
                '0000-00-00'
            )
            ->where(
                'p.expiry_date <=',
                $six_months
            );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $this->db
            ->order_by(
                'p.expiry_date',
                'ASC'
            )
            ->limit(10);

        $rows =
            $this->db
                ->get()
                ->result();

        foreach ($rows as $row) {

            if (
                empty(
                    $row->expiry_date
                )
            ) {

                $row->expiry_status =
                    'No Expiry Date';

                continue;
            }

            if (
                $row->expiry_date <
                $today
            ) {

                $row->expiry_status =
                    'Expired';

            } else {

                $days =
                    (
                        strtotime(
                            $row->expiry_date
                        )
                        -
                        strtotime(
                            $today
                        )
                    ) / 86400;


                if ($days <= 90) {

                    $row->expiry_status =
                        'Expiring Soon';

                } else {

                    $row->expiry_status =
                        'Valid';
                }
            }
        }

        return $rows;
    }

    public function get_holiday_summary()
    {

        $year =
            date('Y');


        $this->db
            ->from(
                $this->holiday_table
            )
            ->where(
                'YEAR(h_date)',
                $year,
                FALSE
            );

        $total =
            $this->db
                ->count_all_results();

        return array(

            'total_holidays' =>
                $total
        );
    }

    public function get_upcoming_holidays()
    {

        $today =
            date('Y-m-d');

        return $this->db
            ->select("
                holiday_code,
                holiday_name,
                h_date,
                holiday_des,
                created_by,
                created_date
            ")
            ->from(
                $this->holiday_table
            )
            ->where(
                'h_date >=',
                $today
            )
            ->order_by(
                'h_date',
                'ASC'
            )
            ->limit(10)
            ->get()
            ->result();
    }

    public function get_resignation_summary(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->from(
                $this->resignation_table . ' r'
            )
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = r.employee_id',
                'inner'
            );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $this->apply_date_filter(
            'r.resignation_date',
            $from_date,
            $to_date
        );

        $total_resignations =
            $this->db
                ->count_all_results();

        $today =
            date('Y-m-d');

        $this->db
            ->from(
                $this->resignation_table . ' r'
            )
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = r.employee_id',
                'inner'
            )
            ->where(
                'r.last_working_date >=',
                $today
            );

        $this->apply_branch_filter(
            $branch_id,
            'e.branch_id'
        );

        $pending_last_working_dates =
            $this->db
                ->count_all_results();

        return array(

            'total_resignations' =>
                $total_resignations,

            'pending_last_working_dates' =>
                $pending_last_working_dates
        );
    }

    public function get_recent_resignations(
        $branch_id = NULL
    ) {

        $this->db
            ->select("
                r.resig_id,
                r.employee_id,
                r.resign_code,
                r.resignation_date,
                r.last_working_date,
                r.notice_days,
                r.reason,
                e.employee_name,
                e.employee_code,
                e.branch_id
            ")
            ->from(
                $this->resignation_table . ' r'
            )
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = r.employee_id',
                'left'
            );


        if (
            $branch_id !== NULL &&
            $branch_id !== ''
        ) {

            $this->db->where(
                'e.branch_id',
                (int) $branch_id
            );
        }

        $this->db
            ->order_by(
                'r.resignation_date',
                'DESC'
            )
            ->limit(10);

        return $this->db
            ->get()
            ->result();
    }

    public function get_hr_reminders($branch_id = NULL)
    {
        $today = date('Y-m-d');
        $six_months = date('Y-m-d', strtotime('+6 months'));

        $this->db
            ->from($this->passport_release_table . ' d');

        if ($branch_id !== NULL && $branch_id !== '') {
            $this->db
                ->join(
                    $this->employee_table . ' e',
                    'e.employee_id = d.emp_id',
                    'inner'
                )
                ->where('e.branch_id', (int) $branch_id);
        }

        $this->db
            ->where('LOWER(TRIM(d.document_name)) =', 'passport')
            ->where('d.expiry_date IS NOT NULL', NULL, FALSE)
            ->where('d.expiry_date !=', '0000-00-00')
            ->where('DATE(d.expiry_date) <', $today);

        $passport_expired = $this->db->count_all_results();

        $this->db
            ->from($this->passport_release_table . ' d');

        if ($branch_id !== NULL && $branch_id !== '') {
            $this->db
                ->join(
                    $this->employee_table . ' e',
                    'e.employee_id = d.emp_id',
                    'inner'
                )
                ->where('e.branch_id', (int) $branch_id);
        }

        $this->db
            ->where('LOWER(TRIM(d.document_name)) =', 'passport')
            ->where('d.expiry_date IS NOT NULL', NULL, FALSE)
            ->where('d.expiry_date !=', '0000-00-00')
            ->where('DATE(d.expiry_date) >=', $today)
            ->where('DATE(d.expiry_date) <=', $six_months);

        $passport_expiring = $this->db->count_all_results();

        $this->db
            ->from($this->resignation_table . ' r')
            ->join(
                $this->employee_table . ' e',
                'e.employee_id = r.employee_id',
                'inner'
            );

        $this->apply_branch_filter($branch_id, 'e.branch_id');

        $this->db
            ->where('r.last_working_date >=', $today);

        $pending_exits = $this->db->count_all_results();

        return array(
            'passport_expired'          => (int) $passport_expired,
            'passport_expiring'         => (int) $passport_expiring,
            'pending_exits'             => (int) $pending_exits,
        );
    }

    private function apply_branch_filter(
        $branch_id,
        $column = 'branch_id'
    ) {

        if (
            $branch_id !== NULL &&
            $branch_id !== ''
        ) {

            $this->db->where(
                $column,
                (int) $branch_id
            );
        }
    }

    private function apply_date_filter(
        $column,
        $from_date = NULL,
        $to_date = NULL
    ) {

        if (!empty($from_date)) {

            $this->db->where(
                $column . ' >=',
                $from_date
            );
        }

        if (!empty($to_date)) {

            $this->db->where(
                $column . ' <=',
                $to_date
            );
        }
    }

    public function get_attendance_summary(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->select("
                COUNT(*) AS total_records,

                SUM(
                    CASE
                        WHEN UPPER(
                            TRIM(ea.attendence)
                        ) = 'P'
                        THEN 1
                        ELSE 0
                    END
                ) AS present_count,

                SUM(
                    CASE
                        WHEN UPPER(
                            TRIM(ea.attendence)
                        ) = 'A'
                        THEN 1
                        ELSE 0
                    END
                ) AS absent_count
            ")
            ->from(
                $this->attendance_table . ' ea'
            );

        if (
            $branch_id !== NULL &&
            $branch_id !== ''
        ) {

            $this->db
                ->join(
                    $this->employee_table . ' e',
                    'e.employee_id = ea.employee_id',
                    'inner'
                )
                ->where(
                    'e.branch_id',
                    (int) $branch_id
                );
        }

        if (!empty($from_date)) {

            $this->db->where(
                'DATE(ea.Attendance_date) >=',
                $from_date
            );
        }

        if (!empty($to_date)) {

            $this->db->where(
                'DATE(ea.Attendance_date) <=',
                $to_date
            );
        }

        $result =
            $this->db
                ->get()
                ->row();

        $total_records =
            !empty($result->total_records)
                ? (int) $result->total_records
                : 0;

        $present_count =
            !empty($result->present_count)
                ? (int) $result->present_count
                : 0;

        $absent_count =
            !empty($result->absent_count)
                ? (int) $result->absent_count
                : 0;

        $attendance_percentage =
            0;

        if ($total_records > 0) {

            $attendance_percentage =
                round(
                    (
                        $present_count
                        /
                        $total_records
                    ) * 100,
                    2
                );
        }

        return array(

            'total_records' =>
                $total_records,

            'present_count' =>
                $present_count,

            'absent_count' =>
                $absent_count,

            'attendance_percentage' =>
                $attendance_percentage
        );
    }

    public function get_attendance_trend(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->select("
                DATE(ea.Attendance_date)
                    AS attendance_date,

                SUM(
                    CASE
                        WHEN UPPER(
                            TRIM(ea.attendence)
                        ) = 'P'
                        THEN 1
                        ELSE 0
                    END
                ) AS present_count,

                SUM(
                    CASE
                        WHEN UPPER(
                            TRIM(ea.attendence)
                        ) = 'A'
                        THEN 1
                        ELSE 0
                    END
                ) AS absent_count
            ")
            ->from(
                $this->attendance_table . ' ea'
            );

        if (
            $branch_id !== NULL &&
            $branch_id !== ''
        ) {

            $this->db
                ->join(
                    $this->employee_table . ' e',
                    'e.employee_id = ea.employee_id',
                    'inner'
                )
                ->where(
                    'e.branch_id',
                    (int) $branch_id
                );
        }

        if (!empty($from_date)) {

            $this->db->where(
                'DATE(ea.Attendance_date) >=',
                $from_date
            );
        }

        if (!empty($to_date)) {

            $this->db->where(
                'DATE(ea.Attendance_date) <=',
                $to_date
            );
        }

        $this->db
            ->group_by(
                'DATE(ea.Attendance_date)'
            )
            ->order_by(
                'DATE(ea.Attendance_date)',
                'ASC'
            );

        $query =
            $this->db
                ->get();

        $labels =
            array();

        $present =
            array();

        $absent =
            array();

        foreach (
            $query->result()
            as $row
        ) {

            $labels[] =
                date(
                    'd M',
                    strtotime(
                        $row->attendance_date
                    )
                );

            $present[] =
                (int) $row->present_count;

            $absent[] =
                (int) $row->absent_count;
        }

        return array(

            'labels' =>
                $labels,

            'present' =>
                $present,

            'absent' =>
                $absent
        );
    }

    private function get_latest_passport_records($branch_id = NULL)
    {
        $this->db
            ->select('
                d.emp_id,
                d.document_name,
                d.status,
                d.document_number,
                d.issue_date,
                d.expiry_date,
                d.outdate,
                d.indate,
                d.posession,
                d.reason,
                d.remark,
                e.employee_name,
                e.employee_code,
                e.branch_id
            ')
            ->from('employee_document_details d')
            ->join(
                'employees e',
                'e.employee_id = d.emp_id',
                'inner'
            )
            ->where('d.document_name', 'passport')
            ->order_by('d.issue_date', 'DESC');

        $this->apply_branch_filter($branch_id, 'e.branch_id');

        $query = $this->db->get();

        if (!$query) {
            return array();
        }

        $rows = $query->result();

        $latest = array();

        foreach ($rows as $row) {

            if (!isset($latest[$row->emp_id])) {
                $latest[$row->emp_id] = $row;
            }
        }

        return array_values($latest);
    }

}