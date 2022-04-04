<?php

class Model_laporan extends CI_Model
{

	// Laporan Laba Rugi
	public function total_penjualan()
	{
		$this->db->select('SUM(total) as totalPenjualan');
		$this->db->from('penjualan');
		return $this->db->get();
	}

	public function total_penjualan_filter($selesai, $mulai)
	{
		$this->db->select('SUM(total) as totalPenjualan');
		$this->db->from('penjualan');
		$this->db->where('tanggal <=', $selesai);
		$this->db->where('tanggal >=', $mulai);
		return $this->db->get();
	}

	public function total_pembelian()
	{
		$this->db->select('SUM(totalPembelian) as totalPembelian');
		$this->db->from('pembelian');
		return $this->db->get();
	}

	public function total_pembelian_filter($selesai, $mulai)
	{
		$this->db->select('SUM(totalPembelian) as totalPembelian');
		$this->db->from('pembelian');
		$this->db->where('tanggal <=', $selesai);
		$this->db->where('tanggal >=', $mulai);
		return $this->db->get();
	}

	public function get_pengeluaran($idUser)
	{
		$this->db->select_sum('jumlah');
		$this->db->from('transaksi');
		$this->db->where('idUser', $idUser);
		$this->db->where('tipe_transaksi', 'Pengeluaran');

		return $this->db->get();
	}
	public function get_pemasukan($idUser)
	{
		$this->db->select_sum('jumlah');
		$this->db->from('transaksi');
		$this->db->where('idUser', $idUser);
		$this->db->where('tipe_transaksi', 'Pemasukan');

		return $this->db->get();
	}

	public function get_posisi_keuangan($mulai, $selesai)
	{
		$this->db->select('akun.idAkun, akun.kodeAkun, akun.saldoAwal,akun.namaAkun,akun.idJenis, akun.saldoAkhir, jenis_akun.namaJenis, jenis_akun.kodeJenis');
		$this->db->select_sum('log_akun.kredit');
		$this->db->select_sum('log_akun.debit');
		$this->db->from('akun,jenis_akun,log_akun');
		$this->db->where('akun.idJenis = jenis_akun.idJenis');
		$this->db->where('akun.idAkun = log_akun.idAkun');
		$this->db->where('log_akun.tanggal <=', $selesai);
		$this->db->where('log_akun.tanggal >=', $mulai);
		$this->db->group_by("idAkun");
		return $this->db->get();
	}

	public function get_posisi_keuangan_all()
	{
		$this->db->select('akun.idAkun, akun.kodeAkun, akun.saldoAwal,akun.namaAkun,akun.idJenis, akun.saldoAkhir, jenis_akun.namaJenis, jenis_akun.kodeJenis');
		$this->db->select_sum('log_akun.kredit');
		$this->db->select_sum('log_akun.debit');
		$this->db->from('akun,jenis_akun,log_akun');
		$this->db->where('akun.idJenis = jenis_akun.idJenis');
		$this->db->where('akun.idAkun = log_akun.idAkun');
		$this->db->group_by("idAkun");
		return $this->db->get();
	}

	// public function get_posisi_keuangan_totaljenis($mulai, $selesai){
		// $this->db->select('jenis_akun.idJenis, jenis_akun.kodeJenis, jenis_akun.namaJenis');
	// 	$this->db->select_sum('akun.saldoAwal');
	//     $this->db->select_sum('log_akun.kredit');
	//     $this->db->select_sum('log_akun.debit');
	//     $this->db->from('akun,jenis_akun,log_akun');
	//     $this->db->where('akun.idJenis = jenis_akun.idJenis');
	//     $this->db->where('akun.idAkun = log_akun.idAkun');
	//     $this->db->where('log_akun.tanggal <=', $selesai);
	//     $this->db->where('log_akun.tanggal >=', $mulai);
	//     $this->db->group_by("idJenis"); 
	//     return $this->db->get();
	// }

	public function get_posisi_keuangan_totaljenis($mulai, $selesai)
	{
		$this->db->select('tipe_akun.id_tipeAkun, tipe_akun.nama_tipeAkun');
		$this->db->select('jenis_akun.idJenis');
		$this->db->select_sum('log_akun.debit');
		$this->db->select_sum('log_akun.kredit');
		$this->db->from('jenis_akun,tipe_akun, akun, log_akun');
		$this->db->where('tipe_akun.id_tipeAkun = jenis_akun.id_tipeAkun');
		$this->db->where('jenis_akun.idJenis = akun.idJenis');
		$this->db->where('akun.idAkun = log_akun.idAkun');
		$this->db->where('log_akun.tanggal <=', $selesai);
		$this->db->where('log_akun.tanggal >=', $mulai);
		$this->db->group_by("idJenis");
		return $this->db->get();
	}

	public function get_posisi_keuangan_totaljenis_all()
	{
		$this->db->select('tipe_akun.id_tipeAkun, tipe_akun.nama_tipeAkun');
		$this->db->select('jenis_akun.idJenis');
		$this->db->select_sum('log_akun.debit');
		$this->db->select_sum('log_akun.kredit');
		$this->db->from('jenis_akun,tipe_akun, akun, log_akun');
		$this->db->where('tipe_akun.id_tipeAkun = jenis_akun.id_tipeAkun');
		$this->db->where('jenis_akun.idJenis = akun.idJenis');
		$this->db->where('akun.idAkun = log_akun.idAkun');
		$this->db->group_by("idJenis");
		return $this->db->get();
	}

	public function get_posisi_keuangan_totaltipe($mulai, $selesai)
	{
		$this->db->select('tipe_akun.id_tipeAkun, tipe_akun.nama_tipeAkun');
		$this->db->select_sum('log_akun.debit');
		$this->db->select_sum('log_akun.kredit');
		$this->db->from('tipe_akun,jenis_akun, akun, log_akun');
		$this->db->where('tipe_akun.id_tipeAkun = jenis_akun.id_tipeAkun');
		$this->db->where('jenis_akun.idJenis = akun.idJenis');
		$this->db->where('akun.idAkun = log_akun.idAkun');
		$this->db->where('log_akun.tanggal <=', $selesai);
		$this->db->where('log_akun.tanggal >=', $mulai);
		// $this->db->group_by("idJenis");
		return $this->db->get();
	}

	public function update_data($tabel, $data,$id,$rowid)
    {
        $this->db->where($rowid, $id);
        return $this->db->update($tabel, $data);
    }

	public function insert_data($tabel, $data)
    {
        return $this->db->insert($tabel, $data);
    }
}
