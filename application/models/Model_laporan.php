<?php

class Model_laporan extends CI_Model {

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

    public function get_pengeluaran($idUser){
        $this->db->select_sum('jumlah');
        $this->db->from('transaksi');
        $this->db->where('idUser' , $idUser);
        $this->db->where('tipe_transaksi' , 'Pengeluaran');

        return $this->db->get();
    }
    public function get_pemasukan($idUser){
        $this->db->select_sum('jumlah');
        $this->db->from('transaksi');
        $this->db->where('idUser' , $idUser);
        $this->db->where('tipe_transaksi' , 'Pemasukan');

        return $this->db->get();
    }
}
