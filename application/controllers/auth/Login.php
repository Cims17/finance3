<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		// if ($this->session->userdata('role_id') != 77) {
		// 	redirect('auth/login');
		// }
	}

	public function index()
	{
		$this->load->view('auth/template/header');
		$this->load->view('auth/login');
		$this->load->view('auth/template/footer');
		
	}

	public function login_user()
	{
		$this->form_validation->set_rules('email', 'email', 'required', ['required' => 'Email wajib diisi!']);
		$this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Password wajib diisi!']);
		if ($this->form_validation->run() == FALSE) {
			
			// $this->load->view('auth/template/header');

			// $this->load->view('auth/login');
			// $this->load->view('auth/template/footer');
		} else {
			$auth = $this->Model_login->cek_login();

			if ($auth == FALSE) {
				$this->session->set_flashdata('pesan', '<div style="justify-content:center;" class="text-center alert alert-danger alert-dismissible fade show" role="alert">Password Anda Salah!</div>');
				redirect('auth/login');
			} else {
				$this->session->set_userdata('username', $auth->username);
				
				$this->session->set_userdata('email', $auth->email);
				$this->session->set_userdata('role', $auth->role);
				$this->session->set_userdata('idUser', $auth->idUser);
				redirect('/');
				// switch ($auth->role) {
				// 	case :
						
				// 		break;
				// 	default:
				// 		break;
				// }
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}
}
