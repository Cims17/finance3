<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak_pdf extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
		$this->load->library('myfpdf');
        $this->output->disable_cache();
        if ($this->session->userdata('idUser') == null) {
            redirect('auth/login');
        }
    }

	public function pdfinfo_perusahaan()
	{
		$mulai = $this->input->post('mulai');
        $selesai = $this->input->post('selesai');

		if ($mulai) {
            $data['perusahaan'] = $this->Model_akun->get_perusahaan_filter($selesai, $mulai)->result_array();
            $data['tgl'] = array(
                'mulai'      => $mulai,
                'selesai'       => $selesai
            );
            $this->load->view('master_data/pdf/pdfinfo_perusahaanfix', $data);
        }else{
            $data['perusahaan'] = $this->Model_akun->get_perusahaan()->result_array();
            $data['tgl'] = array(
                'mulai'      => '0000-00-00',
                'selesai'       => '0000-00-00'
            );
            $this->load->view('master_data/pdf/pdfinfo_perusahaanfix', $data);
        }

	}
	public function pdfinfo_perusahaanall()
	{
		$data['perusahaan'] = $this->Model_akun->get_perusahaan()->result_array();
		$this->load->view('master_data/pdf/pdfinfo_perusahaanallfix', $data);


	}

	public function pdfdata_barang()
	{
		$data['barang'] = $this->Model_akun->get_barang()->result_array();
		
		$this->load->view('master_data/pdf/pdfdata_barangfix', $data);
	}

	public function pdfdata_supplier()
	{
		$data['supplier'] = $this->Model_akun->get_supplier()->result_array();
		$this->load->view('master_data/pdf/pdfdata_supplier',$data);
	}


	## PDF TRANSAKSI
	public function pdf_data_penjualan()
    {
        $mulai = $this->input->post('mulai');
        $selesai = $this->input->post('selesai');

        if ($mulai) {
			$data['penjualan'] = $this->Model_transaksi->get_penjualan_filter($selesai, $mulai)->result_array();
			$data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan_filter($selesai, $mulai)->result_array();
            $data['tgl'] = array(
                'mulai'      => $mulai,
                'selesai'       => $selesai
            );
            $this->load->view('transaksi/pdf/pdf_data_penjualan_filter', $data);
        }else{
            $data['penjualan'] = $this->Model_transaksi->get_penjualan()->result_array();
			$data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan()->result_array();
            $data['tgl'] = array(
                'mulai'      => '0000-00-00',
                'selesai'       => '0000-00-00'
            );
            $this->load->view('transaksi/pdf/pdf_data_penjualanall',$data);
        }

    }

	public function pdf_data_pembelian()
    {
        $data['pembelian']			= $this->Model_transaksi->get_pembelian()->result_array() ;
		$data['jumlah_pembelian']   = $this->Model_laporan->total_pembelian()->result_array();

        $this->load->view('transaksi/pdf/pdf_data_pembelian',$data);
    }

}
