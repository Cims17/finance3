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
		$penjualan = $this->Model_dashboard->get_penjualan_dashboard('penjualan');
        $data['akun'] = $this->Model_akun->get_akun()->num_rows();
        $data['saldo'] = $this->Model_akun->getsaldoAkhir()->result_array();
        $data['transaksi'] = $this->db->select('*')->get('penjualan')->num_rows();

		for ($i = 0; $i < count($penjualan); $i++) {
			$pb[] = array(
				$i => $penjualan[$i][0]->total,
			);
		}
		$data['penjualan'] = $pb;
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }

	
}
