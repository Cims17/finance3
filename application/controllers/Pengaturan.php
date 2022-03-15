<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		if ($this->session->userdata('idUser') == null) {
			redirect('auth/login');
		}
	}

    public function index(){
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pengaturan_akun');
        $this->load->view('template/footer');
    }
    
    public function profile(){
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('profile');
        $this->load->view('template/footer');
    }
}
