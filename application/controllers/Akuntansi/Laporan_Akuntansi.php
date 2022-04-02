<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Laporan_Akuntansi extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('myfpdf');
		if ($this->session->userdata('idUser') == null) {
			redirect('auth/login');
		}
	}

	public function pdf_jurnal_umum_all()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');

		if ($mulai) {
			$data['umum']   = $this->Model_akuntansi->get_jurnal_umum_filter($selesai, $mulai)->result_array();
			$data['tgl'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai
			);
			$this->load->view('akuntansi/pdf/pdf_jurnal_umum_all', $data);
		} else {
			$data['umum'] = $this->Model_akuntansi->get_all_jurnal_umum()->result_array();
			$data['tgl'] = array(
				'mulai'      => '0000-00-00',
				'selesai'       => '0000-00-00'
			);

			$this->load->view('akuntansi/pdf/pdf_jurnal_umum_all', $data);
		}
	}
}
