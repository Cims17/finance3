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
			$data['jumlah_total_debit']	= array_sum(array_column($data['umum'],'debit'));
			$data['jumlah_total_kredit']	= array_sum(array_column($data['umum'],'kredit'));
			$data['tgl'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai
			);
			$this->load->view('akuntansi/pdf/pdf_jurnal_umum_filter', $data);
		} else {
			$data['umum']				= $this->Model_akuntansi->get_all_jurnal_umum()->result_array();
			$data['jumlah_total_debit']	= array_sum(array_column($data['umum'],'debit'));
			$data['jumlah_total_kredit']	= array_sum(array_column($data['umum'],'kredit'));
			$data['tgl'] = array(
				'mulai'      => '0000-00-00',
				'selesai'       => '0000-00-00'
			);

			$this->load->view('akuntansi/pdf/pdf_jurnal_umum_all', $data);
		}
	}

	public function pdf_jurnal_penyesuaian()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');

		if ($mulai) {
			$data['penyesuaian']   = $this->Model_akuntansi->get_jurnal_penyesuaian_filter($selesai, $mulai)->result_array();
			$data['jumlah_total_debit']	= array_sum(array_column($data['penyesuaian'],'debit'));
			$data['jumlah_total_kredit']	= array_sum(array_column($data['penyesuaian'],'kredit'));
			$data['tgl'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai
			);
			$this->load->view('akuntansi/pdf/pdf_jurnal_penyesuaian_filter', $data);
		} else {
			$data['penyesuaian'] = $this->Model_akuntansi->get_all_jurnal_penyesuaian()->result_array();
			$data['jumlah_total_debit']	= array_sum(array_column($data['penyesuaian'],'debit'));
			$data['jumlah_total_kredit']	= array_sum(array_column($data['penyesuaian'],'kredit'));
			$data['tgl'] = array(
				'mulai'      => '0000-00-00',
				'selesai'       => '0000-00-00'
			);

			$this->load->view('akuntansi/pdf/pdf_jurnal_penyesuaian_all', $data);
		}
	}

	public function pdf_buku_besar()
    {
        $idAkun = $this->input->post('idAkun');
        $mulai = $this->input->post('mulai');
        $selesai = $this->input->post('selesai');
        if (!$idAkun) {
            redirect('akuntansi/buku_besar');
        } else {
            $data['filter'] = $this->Model_akuntansi->get_buku_besar($idAkun, $mulai, $selesai)->result_array();
            $data['akun'] = $this->Model_akun->get_detail('akun', 'idAkun', $idAkun)->row();
			$data['jumlah_total_debit']	= array_sum(array_column($data['filter'],'debit'));
			$data['jumlah_total_kredit']	= array_sum(array_column($data['filter'],'kredit'));
            $data['akun2'] = $this->Model_akun->get_akun()->result_array();
            $data['nama'] = array(
                'mulai'      => $mulai,
                'selesai'       => $selesai,
                'namaAkun'  => $data['akun']->namaAkun,
				'kodeAkun'  => $data['akun']->kodeAkun
            );
            $this->load->view('akuntansi/pdf/pdf_buku_besar', $data);
        }
    }
}
