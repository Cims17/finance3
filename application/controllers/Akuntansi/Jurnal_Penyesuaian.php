<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Jurnal_Penyesuaian extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		if ($this->session->userdata('idUser') == null) {
			redirect('auth/login');
		}
	}


	public function index()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');

		if ($mulai) {
			$data['penyesuaian']   = $this->Model_akuntansi->get_jurnal_penyesuaian_filter($selesai, $mulai)->result_array();
			$data['tgl'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai
			);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('akuntansi/jurnal_penyelesaian', $data);
			$this->load->view('template/footer');
		} else {
			$data['penyesuaian'] = $this->Model_akuntansi->get_all_jurnal_penyesuaian()->result_array();
			$data['tgl'] = array(
				'mulai'      => '0000-00-00',
				'selesai'       => '0000-00-00'
			);

			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('akuntansi/jurnal_penyesuaian_clear', $data);
			$this->load->view('template/footer');
		}
	}


	public function tambah_jurnal_penyesuaian()
	{
		$data['akun'] = $this->Model_akun->get_akun()->result_array();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('akuntansi/tambah_jurnal_penyesuaian', $data);
		$this->load->view('template/footer');
	}

	public function save_jurnal_penyesuaian()
	{
		$idAkun 	= $this->input->post('idAkun');
		$saldo 		= $this->input->post('jenisSaldo');
		$saldoAwal	= $this->input->post('nominal');
		$nominal 	= filter_var($saldoAwal, FILTER_SANITIZE_NUMBER_INT);
		$keterangan = $this->input->post('keterangan');
		$tanggal	= $this->input->post('tanggal');
		if ($saldo == "Kredit") {
			$data3 = array(
				'idAkun'        => $idAkun,
				'kredit'       => $nominal,
				'keterangan'       => $keterangan,
				'input_from'       => 'Jurnal Penyesuaian',
				'tanggal'		=> $tanggal,
			);
			$save = $this->Model_akun->insert_log($data3);
			if ($save) {
				$data = array(
					'idAkun'        => $idAkun,
					'kredit'       => $nominal,
					'idLog'       => $this->db->insert_id(),
					'tanggal'		=> $tanggal,
				);

				$this->Model_akuntansi->insert_data('kredit_log', $data);
				redirect('akuntansi/jurnal_penyesuaian');
			}
		} else {
			$data3 = array(
				'idAkun'        => $idAkun,
				'debit'       => $nominal,
				'keterangan'       => $keterangan,
				'input_from'       => 'Jurnal Penyesuaian',
				'tanggal'		=> $tanggal,
			);
			$save = $this->Model_akun->insert_log($data3);

			if ($save) {
				$data = array(
					'idAkun'        => $idAkun,
					'debit'       => $nominal,
					'idLog'       => $this->db->insert_id(),
					'tanggal'		=> $tanggal,
				);
				$this->Model_akuntansi->insert_data('debit_log', $data);
				redirect('akuntansi/jurnal_penyesuaian');
			}
		}
	}

	public function edit_jurnal_penyesuaian($idLog)
	{
		$data['akun'] = $this->Model_akun->get_akun()->result_array();
		$data['jurnal'] = $this->Model_akun->get_detail('log_akun', 'idLog', $idLog)->row();
		$data2 = $data['jurnal'];

		$data['akun2'] = $this->Model_akun->get_detail('akun', 'idAkun', $data2->idAkun)->row();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('akuntansi/edit_jurnal_penyesuaian', $data);
		$this->load->view('template/footer');
	}

	public function update_jurnal_penyesuaian()
	{
		$saldo = $this->input->post('jenisSaldo');
		$idLog = $this->input->post('idLog');
		$idAkun = $this->input->post('idAkun');
		$saldoLawas = $this->input->post('saldoLawas');

		$nominal = $this->input->post('nominal');
		$keterangan = $this->input->post('keterangan');
		// $tabel, $data,$id,$rowid
		if ($saldoLawas != $saldo) {
			if ($saldo == "Kredit") {
				$this->db->delete('debit_log', array('idLog' => $idLog));
				$data3 = array(
					'kredit'       => $nominal,
					'keterangan'       => $keterangan,
					'debit'     => 0
				);
				$save = $this->Model_akuntansi->update_data('log_akun', $data3, $idLog, 'idLog');
				if ($save) {
					$data = array(
						'idAkun'        => $idAkun,
						'kredit'       => $nominal,
						'idLog'       => $idLog,
					);
					$this->Model_akuntansi->insert_data('kredit_log', $data);
					redirect('akuntansi/jurnal_penyesuaian');
				}
			} else {
				$this->db->delete('kredit_log', array('idLog' => $idLog));
				$data3 = array(
					'debit'       => $nominal,
					'keterangan'       => $keterangan,
					'kredit'     => 0
				);
				$save = $this->Model_akuntansi->update_data('log_akun', $data3, $idLog, 'idLog');

				if ($save) {
					$data = array(
						'idAkun'        => $idAkun,
						'debit'       => $nominal,
						'idLog'       => $idLog,
					);
					$this->Model_akuntansi->insert_data('debit_log', $data);
					redirect('akuntansi/jurnal_penyesuaian');
				}
			}
		} else {
			if ($saldo == "Kredit") {
				$data3 = array(
					'kredit'       => $nominal,
					'keterangan'       => $keterangan,

				);
				$save = $this->Model_akuntansi->update_data('log_akun', $data3, $idLog, 'idLog');
				if ($save) {
					$data = array(
						'kredit'       => $nominal,
					);
					$this->Model_akuntansi->update_data('kredit_log', $data, $idLog, 'idLog');
					redirect('akuntansi/jurnal_penyesuaian');
				}
			} else {
				$data3 = array(
					'debit'       => $nominal,
					'keterangan'       => $keterangan,
				);
				$save = $this->Model_akuntansi->update_data('log_akun', $data3, $idLog, 'idLog');

				if ($save) {
					$data = array(
						'debit'       => $nominal
					);
					$this->Model_akuntansi->update_data('debit_log', $data, $idLog, 'idLog');
					redirect('akuntansi/jurnal_penyesuaian');
				}
			}
		}
	}

	public function delete_jurnal_penyesuaian($idLog)
	{
	    $this->db->delete('kredit_log', array('idLog' => $idLog));
		$this->db->delete('debit_log', array('idLog' => $idLog));
		$this->db->delete('log_akun', array('idLog' => $idLog));
	}
}
