<?php
class Appointment extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Appointment_model');
		$this->load->model('Customer_model');
		$this->load->model('Vehicle_model');
		$this->load->helper(array('form', 'url', 'branch_helper'));
	}
 
	// List
	public function index()
	{
		$data['appointments'] = $this->Appointment_model->get_all_appointments();

		$data['title'] = "Appointments";
		$data['main_content'] = 'appointment/appointment_list';
		$this->load->view('includes/template', $data);
	}

	// Add Form
	public function add()
	{
		$data['customers'] = $this->Customer_model->get_all_customers();
		$data['today_date'] = date('Y-m-d');
		$data['current_time'] = date('H:i');
		$data['title'] = "Add Appointment";
		$data['main_content'] = 'appointment/add_appointment_form';
		$this->load->view('includes/template', $data);
	}

 

	// Save
	public function save()
	{
		$data = [
			'branch_id'         => $this->input->post('branch_id') ?: get_primary_branch_id(),
			'customer_id'       => $this->input->post('customer_id'),
			'vehicle_id'        => $this->input->post('vehicle_id'),
			'appointment_date'  => $this->input->post('appointment_date'),
			'appointment_time'  => $this->input->post('appointment_time'),
			'service_type'      => $this->input->post('appointment_type'),
			'notes'             => $this->input->post('notes'),
			'status'            => 'Pending'
		];

		// ðŸ‘‡ get appointment_id from model
		$appointment_id = $this->Appointment_model->add($data);

		// ðŸ”´ Redirect to inspection with appointment_id
		redirect('appointment/edit/' . $appointment_id);
	}

	// Edit Form


	public function edit($appointment_id)
	{
		$this->load->model("Customer_model");
		$this->load->model("Vehicle_model");
		$this->load->model("Appointment_model");

		$data['appointment'] = $this->Appointment_model->get_appointment($appointment_id);

		// For dropdowns
		$data['customers'] = $this->Customer_model->get_all_customers();
		$data['vehicles']  = $this->Vehicle_model->get_all_vehicles();

		$data['title'] = "Edit Appointment";
		$data['main_content'] = "appointment/appointment_edit_form";
		$this->load->view("includes/template", $data);
	}

	// Update
	public function update()
	{
		$id = $this->input->post('appointment_id');

		$data = [
			'branch_id'         => $this->input->post('branch_id') ?: get_primary_branch_id(),
			'customer_id'       => $this->input->post('customer_id'),
			'vehicle_id'        => $this->input->post('vehicle_id'),
			'appointment_date'  => $this->input->post('appointment_date'),
			'appointment_time'  => $this->input->post('appointment_time'),
			'service_type'      => $this->input->post('service_type'),
			'notes'             => $this->input->post('notes'),
			'status'            => $this->input->post('status'),
		];

		$this->Appointment_model->update_appointment($id, $data);

		$this->session->set_flashdata("success", "Appointment Updated Successfully");
		redirect("appointment");
	}

	// Delete
	public function delete($id)
	{
		$this->Appointment_model->delete($id);
		$this->session->set_flashdata('success', 'Appointment Deleted!');
		redirect('appointment');
	}

	public function getVehiclesByCustomer($customer_id)
	{
		$this->load->model('Vehicle_model');
		$vehicles = $this->Vehicle_model->get_vehicles_by_customerreg($customer_id);
		echo json_encode($vehicles);
	}

	// ================================================================================================
	public function reminders($days = 15)
	{
		$from = date('Y-m-d');
		$to   = date('Y-m-d', strtotime("+{$days} days"));

		$data['appointments'] = $this->Appointment_model->get_upcoming_appointments($from, $to);
		$data['main_content'] = 'appointment/appointment_reminder';
		$data['title'] = 'Upcoming Appointments & Reminders';
		$this->load->view('includes/template', $data);
	}

public function send_reminder()
{
    // Always return JSON
    $this->output->set_content_type('application/json');

    $appointment_id = $this->input->post('appointment_id');

    if (empty($appointment_id)) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status'  => 'error',
                'message' => 'Missing appointment ID.'
            ]));
    }

    // Get appointment
    $appointment = $this->Appointment_model->get_appointment($appointment_id);

    if (!$appointment) {
        return $this->output
            ->set_status_header(404)
            ->set_output(json_encode([
                'status'  => 'error',
                'message' => 'Appointment not found.'
            ]));
    }

    // Check customer email
    if (empty($appointment->customer_email)) {
        return $this->output
            ->set_status_header(400)
            ->set_output(json_encode([
                'status'  => 'error',
                'message' => 'Customer email not found.'
            ]));
    }

    // Compose message
    $msg = "Reminder: Dear {$appointment->customer_name}, ";

    $msg .= "your vehicle ({$appointment->registration_no}) ";

    $msg .= "has an appointment on {$appointment->appointment_date}";

    if (!empty($appointment->appointment_time)) {
        $msg .= " at {$appointment->appointment_time}";
    }

    if (!empty($appointment->service_type)) {
        $msg .= " for {$appointment->service_type}";
    }

    $msg .= ". - Your Garage";


    // Load email library
    $this->load->library('email');


    // Configure email
    $this->email->from(
        'no-reply@yourgarage.local',
        'Your Garage'
    );

    $this->email->to($appointment->customer_email);

    $this->email->subject('Service Appointment Reminder');

    $this->email->message($msg);


    // Send email
    if (!$this->email->send()) {

        $error = $this->email->print_debugger();

        log_message(
            'error',
            'Appointment reminder email failed for appointment ID '
            . $appointment_id . ': ' . $error
        );

        return $this->output
            ->set_status_header(500)
            ->set_output(json_encode([
                'status'  => 'error',
                'message' => 'Failed to send reminder email.'
            ]));
    }


    // Email successfully sent
    $this->Appointment_model->mark_reminder_sent($appointment_id);


    return $this->output
        ->set_status_header(200)
        ->set_output(json_encode([
            'status'  => 'ok',
            'message' => 'Reminder sent successfully.'
        ]));
}

	// AJAX helper to return appointment details (json)
	public function get_details_ajax()
	{
		$appointment_id = $this->input->post('appointment_id');
		$a = $this->Appointment_model->get_appointment($appointment_id);
		if (!$a) {
			echo json_encode(['status' => 'error']);
		} else {
			echo json_encode(['status' => 'ok', 'data' => $a]);
		}
	}

	
}

