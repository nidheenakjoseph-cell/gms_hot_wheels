<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}

	public function index()
	{
		$logged_in = $this->session->userdata('logged_in') === TRUE || $this->session->userdata('is_logged_in') === TRUE;
		if ($logged_in) {
			redirect('dashboard');
			return;
		}
		$this->load->view('login/login');
	}
 
	public function forgot_password()
	{
		$this->load->view('login/forgot_password');
	}

	public function send_reset_link()
	{
		$email = trim($this->input->post('email'));
		$is_mailtrap_test = $this->input->post('test_mailtrap') === '1';
		$test_recipient = trim($this->input->post('test_recipient'));
		$user = $this->db->get_where('users', ['email' => $email])->row();
		$mail_result = null;

		if ($is_mailtrap_test && (!$user || !filter_var($email, FILTER_VALIDATE_EMAIL))) {
			$this->session->set_flashdata('error', 'Enter the email address of an existing GMS user account.');
			redirect('login/forgot_password');
			return;
		}

		if ($is_mailtrap_test && !filter_var($test_recipient, FILTER_VALIDATE_EMAIL)) {
			$this->session->set_flashdata('error', 'Enter a valid Mailtrap recipient email address.');
			redirect('login/forgot_password');
			return;
		}

		if ($user && filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$token = bin2hex(random_bytes(32));
			$selector = bin2hex(random_bytes(16));

			$this->db->where('user_id', $user->id)->delete('password_reset_tokens');
			$this->db->insert('password_reset_tokens', [
				'user_id' => $user->id,
				'selector' => $selector,
				'token_hash' => hash('sha256', $token),
				'expires_at' => date('Y-m-d H:i:s', time() + 3600),
			]);

			$this->load->library('Gms_mailer');
			$reset_url = base_url('index.php/login/reset_password/' . $selector . '/' . $token);
			$body = '<p>Hello ' . html_escape($user->first_name) . ',</p>'
				. '<p>Use the link below to reset your GMS password. This link expires in 60 minutes and can be used once.</p>'
				. '<p><a href="' . html_escape($reset_url) . '">Reset password</a></p>'
				. '<p>If you did not request this, you can ignore this email.</p>';

			$recipient = $is_mailtrap_test ? $test_recipient : $email;
			$mail_result = $this->gms_mailer->send_raw($recipient, 'GMS password reset', $body);
			if (!$mail_result['status']) {
				log_message('error', 'Password reset email failed for user ' . $user->id . ': ' . $mail_result['message']);
			}
		}

		if ($is_mailtrap_test && $mail_result) {
			$this->session->set_flashdata(
				$mail_result['status'] ? 'success' : 'error',
				$mail_result['status'] ? 'Mailtrap reset email sent successfully.' : 'Mailtrap reset email could not be sent.'
			);
			redirect('login/forgot_password');
			return;
		}

		$this->session->set_flashdata('success', 'If an account exists for that email, a password reset link has been sent.');
		redirect('login/forgot_password');
	}

	public function reset_password($selector = '', $token = '')
	{
		$reset = $this->get_valid_reset($selector, $token);
		if (!$reset) {
			$this->load->view('login/reset_password', ['error' => 'This reset link is invalid or expired.']);
			return;
		}

		$this->load->view('login/reset_password', [
			'selector' => $selector,
			'token' => $token,
		]);
	}

	public function update_password()
	{
		$selector = trim($this->input->post('selector'));
		$token = trim($this->input->post('token'));
		$password = $this->input->post('password');
		$confirmation = $this->input->post('password_confirmation');
		$reset = $this->get_valid_reset($selector, $token);

		if (!$reset) {
			$this->load->view('login/reset_password', ['error' => 'This reset link is invalid or expired.']);
			return;
		}

		if (strlen($password) < 8 || $password !== $confirmation) {
			$this->load->view('login/reset_password', [
				'error' => 'Passwords must match and be at least 8 characters long.',
				'selector' => $selector,
				'token' => $token,
			]);
			return;
		}

		$this->db->where('id', $reset->user_id)->update('users', [
			'password' => password_hash($password, PASSWORD_DEFAULT),
		]);
		$this->db->where('id', $reset->id)->update('password_reset_tokens', [
			'used_at' => date('Y-m-d H:i:s'),
		]);

		$this->session->set_flashdata('success', 'Your password has been reset. You can now sign in.');
		redirect('login');
	}

	private function get_valid_reset($selector, $token)
	{
		if (!preg_match('/^[a-f0-9]{32}$/', $selector) || !preg_match('/^[a-f0-9]{64}$/', $token)) {
			return false;
		}

		$reset = $this->db->get_where('password_reset_tokens', [
			'selector' => $selector,
			'used_at' => null,
		])->row();

		if (!$reset || strtotime($reset->expires_at) < time() || !hash_equals($reset->token_hash, hash('sha256', $token))) {
			return false;
		}

		return $reset;
	}


	// public function verify_login()
	// {

	// 	$username = $this->input->post('username');
	// 	$password = $this->input->post('password');

	// 	log_message('error', 'Login attempt: Username = ' . $username . ', Password = ' . $password);
	// 	$user = $this->db->get_where('users', ['username' => $username])->row();

	// 	if ($user && $password == $user->password) {
	// 		$this->session->set_userdata([
	// 			'user_id' => $user->id,
	// 			'username' => $user->username,
	// 			'role' => $user->role,
	// 			'logged_in' => true
	// 		]);

	// 		// $data['title'] 	 = "Dashboard";
	// 		// // Get session data
	// 		$data['username'] = $this->session->userdata('username');
	// 		$data['userid'] = $this->session->userdata('user_id');
	// 		// $data['main_content'] = 'dashboard.php';
	// 		// $this->load->view('includes/template', $data);
	// 		redirect('dashboard');   // <-- THIS FIXES YOUR ISSUE
    //     return;
	// 	} else {
	// 		$this->session->set_flashdata('error', 'Invalid username or password');
	// 		redirect('Login');
	// 	}
	// }

	public function verify_login()
{
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->db->get_where('users', ['username' => $username])->row();

	$is_password_valid = false;

	if ($user) {
		$is_password_valid = password_verify($password, $user->password);

		if (!$is_password_valid && !preg_match('/^\$2[ayb]\$/', $user->password)) {
			$is_password_valid = hash_equals($user->password, $password);

			if ($is_password_valid) {
				$this->db->where('id', $user->id)->update('users', array(
					'password' => password_hash($password, PASSWORD_DEFAULT)
				));
			}
		}
	}

	if ($user && $is_password_valid) {

		$company_id = (!empty($user->company_id) && (int)$user->company_id > 0) 
			? (int)$user->company_id 
			: resolve_company_id($user->id);

		// Check demo expiry status for this company
		$this->load->helper('company');
		$demo_status = get_company_demo_status($company_id);
		if (!empty($demo_status['demo_enabled']) && !empty($demo_status['is_expired'])) {
			$this->session->set_flashdata('error', 'Your demo access has expired. Please contact the administrator to extend access.');
			redirect('login');
			return;
		}

        $this->session->set_userdata([
            'user_id' => $user->id,
            'username' => $user->username,
            'role' => $user->role,
			'company_id' => $company_id,
            'logged_in' => true,
            'is_logged_in' => true
        ]);

        if (!empty($demo_status['warning_message'])) {
            $this->session->set_flashdata('demo_warning', $demo_status['warning_message']);
        }

        redirect('dashboard');
        return;
    }

    $this->session->set_flashdata('error', 'Invalid username or password');
    redirect('login');
}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

public function hash_all_existing_passwords()
{
    $users = $this->db->get('users')->result();

    foreach ($users as $user) {

        // Skip passwords that are already hashed
        if (
            strpos($user->password, '$2y$') === 0 ||
            strpos($user->password, '$2a$') === 0 ||
            strpos($user->password, '$2b$') === 0
        ) {
            continue;
        }

        $hashed_password = password_hash(
            $user->password,
            PASSWORD_DEFAULT
        );

        $this->db
            ->where('id', $user->id)
            ->update('users', [
                'password' => $hashed_password
            ]);
    }
    echo "All existing passwords have been hashed successfully.";
    return true;
}
}
