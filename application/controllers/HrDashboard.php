<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HrDashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Hr_dashboard_model');
    }

    public function index()
    {
        $branch_id = $this->input->get('branch_id', TRUE);

        $from_date = $this->input->get('from_date', TRUE);

        $to_date = $this->input->get('to_date', TRUE);

        if ($branch_id !== NULL && $branch_id !== '') {

            $branch_id = (int) $branch_id;

        } else {

            $branch_id = NULL;
        }

        if (empty($from_date)) {

            $from_date = date('Y-m-01');
        }

        if (empty($to_date)) {

            $to_date = date('Y-m-t');
        }

        $branches =
            $this->Hr_dashboard_model
                 ->get_branches();

        $employee_summary =
            $this->Hr_dashboard_model
                 ->get_employee_summary(
                     $branch_id,
                     $from_date,
                     $to_date
                 );

        $leave_summary =
            $this->Hr_dashboard_model
                 ->get_leave_summary(
                     $branch_id,
                     $from_date,
                     $to_date
                 );

        $salary_summary =
            $this->Hr_dashboard_model
                ->get_salary_summary(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $salary_advance_summary =
            $this->Hr_dashboard_model
                ->get_salary_advance_summary(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $passport_summary =
            $this->Hr_dashboard_model
                 ->get_passport_summary(
                     $branch_id
                 );

        $passport_expiry_alerts =
            $this->Hr_dashboard_model
                 ->get_passport_expiry_alerts(
                     $branch_id
                 );

        $resignation_summary =
            $this->Hr_dashboard_model
                 ->get_resignation_summary(
                     $branch_id,
                     $from_date,
                     $to_date
                 );

        $recent_resignations =
            $this->Hr_dashboard_model
                 ->get_recent_resignations(
                     $branch_id
                 );

        $holiday_summary =
            $this->Hr_dashboard_model
                 ->get_holiday_summary();

        $upcoming_holidays =
            $this->Hr_dashboard_model
                 ->get_upcoming_holidays();

        $hr_reminders =
            $this->Hr_dashboard_model
                 ->get_hr_reminders(
                     $branch_id
                 );

        $employee_movement_chart =
            $this->Hr_dashboard_model
                 ->get_employee_movement_chart(
                     $branch_id,
                     $from_date,
                     $to_date
                 );

        $department_chart =
            $this->Hr_dashboard_model
                 ->get_department_chart(
                     $branch_id
                 );

        $branch_chart =
            $this->Hr_dashboard_model
                 ->get_branch_chart(
                     $from_date,
                     $to_date
                 );

        $allowance_summary =
            $this->Hr_dashboard_model
                 ->get_allowance_summary(
                     $branch_id,
                     $from_date,
                     $to_date
                 );

        $deduction_summary =
            $this->Hr_dashboard_model
                 ->get_deduction_summary(
                     $branch_id,
                     $from_date,
                     $to_date
                 );

        $attendance_summary =
            $this->Hr_dashboard_model
                ->get_attendance_summary(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $attendance_trend =
            $this->Hr_dashboard_model
                ->get_attendance_trend(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data = array(

            'branches'
                => $branches,

            'selected_branch_id'
                => $branch_id,

            'selected_from_date'
                => $from_date,

            'selected_to_date'
                => $to_date,

            'employee_summary'
                => $employee_summary,

            'leave_summary'
                => $leave_summary,

            'salary_summary'
                => $salary_summary,

            'salary_advance_summary'
                => $salary_advance_summary,

            'passport_summary'
                => $passport_summary,

            'passport_expiry_alerts'
                => $passport_expiry_alerts,

            'resignation_summary'
                => $resignation_summary,

            'recent_resignations'
                => $recent_resignations,

            'holiday_summary'
                => $holiday_summary,

            'upcoming_holidays'
                => $upcoming_holidays,

            'employee_movement_chart'
                => $employee_movement_chart,

            'department_chart'
                => $department_chart,

            'branch_chart'
                => $branch_chart,

            'allowance_summary'
                => $allowance_summary,

            'deduction_summary'
                => $deduction_summary,

            'hr_reminders'
                => $hr_reminders,

            'attendance_summary'
                => $attendance_summary,

            'attendance_trend'
                => $attendance_trend
        );

        $data['main_content'] =
            'hr/hr_dashboard';

        $this->load->view(
            'includes/template',
            $data
        );
    }
}