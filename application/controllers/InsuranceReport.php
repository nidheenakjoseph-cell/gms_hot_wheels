<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsuranceReport extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Insurance_report_model');
    }

    public function reports()
    {
        $data['title'] = 'Insurance Reports';

        $data['policies'] =
            $this->Insurance_report_model->get_policy_report();

        $data['upcoming_renewals'] =
            $this->Insurance_report_model->get_upcoming_renewals(30);

        $data['claims'] =
            $this->Insurance_report_model->get_claims_report();

        $data['payments'] =
            $this->Insurance_report_model->get_payment_report();

        $data['main_content'] = 'insurance/list_reports';
            
        $this->load->view('includes/template', $data);
    }

    public function print_report()
    {
        $report_type = $this->input->post('report_type');

        switch ($report_type) {

            case 'policies':

                $data['title'] = 'Insurance Policy Report';

                $data['policies'] =
                    $this->Insurance_report_model
                        ->get_policy_report();

                $this->load->view(
                    'insurance/print/policy_report',
                    $data
                );

                break;

            case 'renewals':

                $data['title'] =
                    'Upcoming Insurance Renewals';

                $data['upcoming_renewals'] =
                    $this->Insurance_report_model
                        ->get_upcoming_renewals();

                $this->load->view(
                    'insurance/print/upcoming_renewal_report',
                    $data
                );

                break;

            case 'claims':

                $data['title'] =
                    'Insurance Claims Report';

                $data['claims'] =
                    $this->Insurance_report_model
                        ->get_claims_report();

                $this->load->view(
                    'insurance/print/claim_report',
                    $data
                );

                break;

            case 'payments':

                $data['title'] =
                    'Insurance Payment Report';

                $data['payments'] =
                    $this->Insurance_report_model
                        ->get_payment_report();

                $this->load->view(
                    'insurance/print/payment_report',
                    $data
                );

                break;

            default:

                show_error(
                    'Invalid report type.',
                    400
                );
        }
    }

}