<?php

class Model_akuntansi extends CI_Model
{

	public function get_all_jurnal_umum()
	{
		$this->db->select('log_akun.*, akun.namaAkun, akun.kodeAkun');
		$this->db->from('log_akun, akun');
		$this->db->where('log_akun.idAkun = akun.idAkun');
		$this->db->where('log_akun.input_from', 'Jurnal Umum');
		$this->db->order_by('idLog', 'ASC');
		return $this->db->get();
	}

	public function get_jurnal_umum_filter($selesai, $mulai)
	{
		$this->db->select('log_akun.*, akun.namaAkun, akun.kodeAkun');
		$this->db->from('log_akun, akun');
		$this->db->where('log_akun.idAkun = akun.idAkun');
		$this->db->where('log_akun.input_from', 'Jurnal Umum');
		$this->db->where('tanggal <=', $selesai);
		$this->db->where('tanggal >=', $mulai);
		$this->db->order_by('idLog', 'ASC');
		return $this->db->get();
	}

	public function insert_data($tabel, $data)
	{
		return $this->db->insert($tabel, $data);
	}

	public function update_data($tabel, $data, $id, $rowid)
	{
		$this->db->where($rowid, $id);
		return $this->db->update($tabel, $data);
	}

	public function get_all_jurnal_penyesuaian()
	{
		$this->db->select('log_akun.*, akun.namaAkun, akun.kodeAkun');
		$this->db->from('log_akun, akun');
		$this->db->where('log_akun.idAkun = akun.idAkun');
		$this->db->where('log_akun.input_from', 'Jurnal Penyesuaian');
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get();
	}

	public function get_jurnal_penyesuaian_filter($selesai, $mulai)
	{
		$this->db->select('log_akun.*, akun.namaAkun, akun.kodeAkun');
		$this->db->from('log_akun, akun');
		$this->db->where('log_akun.idAkun = akun.idAkun');
		$this->db->where('log_akun.input_from', 'Jurnal Penyesuaian');
		$this->db->where('tanggal <=', $selesai);
		$this->db->where('tanggal >=', $mulai);
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get();
	}

	public function get_buku_besar($id, $mulai, $selesai)
	{
		$this->db->select('log_akun.*, akun.namaAkun, akun.kodeAkun');
		$this->db->from('log_akun, akun');
		$this->db->where('log_akun.idAkun = akun.idAkun');
		$this->db->where('log_akun.idAkun', $id);
		$this->db->where('log_akun.tanggal <=', $selesai);
		$this->db->where('log_akun.tanggal >=', $mulai);
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get();
	}
}
