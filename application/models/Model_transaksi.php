<?php

class Model_transaksi extends CI_Model {

	//Model Transaksi => Penjualan
	public function get_penjualan(){
		$this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'penjualan.idPelanggan=pelanggan.idPelanggan');
		$this->db->order_by('tanggal', 'ASC');

        return $this->db->get();
	}

	public function get_penjualan_filter($selesai, $mulai){
        $this->db->select('*');
        $this->db->from('penjualan');
		$this->db->join('pelanggan', 'penjualan.idPelanggan=pelanggan.idPelanggan');
        $this->db->where('tanggal <=', $selesai);
        $this->db->where('tanggal >=', $mulai);
		$this->db->order_by('tanggal', 'ASC');
        return $this->db->get();
    }

	public function get_penjualan_detail()
    {
        $this->db->select('*');
        $this->db->from('penjualan_detail');
        $this->db->join('barang', 'barang.idBarang = penjualan_detail.idBarang');
        return $this->db->get('');
    }

	public function get_nourutPenjualan()
	{
		return $this->db->select('max(idTransaksi) as nomor')
			->from('penjualan')->get()->result();
	}

	public function hasilcari($key)
	{
		
			$this->db->like('nama', $key);
			return $this->db->get('barang');
	}

    //Model Transaksi => Pembelian
	public function get_pembelian(){
		$this->db->select('*');
        $this->db->from('pembelian');
        $this->db->join('supplier', 'supplier.idSupp=pembelian.idSupp');
		$this->db->order_by('tanggal', 'ASC');

        return $this->db->get();
	}

	public function get_pembelian_detail()
    {
        return $this->db->get('pembelian_detail');
    }

	public function get_nourutPembelian()
	{
		return $this->db->select('max(idPembelian) as nomor')
			->from('pembelian')->get()->result();
	}


}
