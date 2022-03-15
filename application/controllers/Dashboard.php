<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		if ($this->session->userdata('idUser') == null) {
			redirect('auth/login');
		}
	}

    public function index(){
		$data['akun'] = $this->Model_akun->get_akun()->num_rows();
		$data['saldo'] = $this->Model_akun->getsaldoAkhir()->row();
		$data['penjualan'] = $this->db->select('*')->get('penjualan')->num_rows();
		
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}
