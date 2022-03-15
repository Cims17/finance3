<?php

class Model_akun extends CI_Model {

    public function get_akun(){
        $this->db->select('*');
        $this->db->from('akun,jenis_akun');
        $this->db->where('akun.idJenis = jenis_akun.idJenis');
        // $this->db->join('saldo', 'akun.idAkun=saldo.idAkun');

        return $this->db->get();
    }

    public function get_akun_saldo(){
        $this->db->select('*');
        $this->db->from('akun,jenis_akun');
        $this->db->where('akun.idJenis = jenis_akun.idJenis');
        $this->db->where('akun.saldoAwal != 0');
        // $this->db->join('saldo', 'akun.idAkun=saldo.idAkun');

        return $this->db->get();
    }


    public function getsaldoAkhir(){ 
        return $this->db->select_sum('saldoAkhir')->get('akun');
    }

    public function get_jenis_akun(){
        $this->db->select('*');
        $this->db->from('jenis_akun');
        return $this->db->get();
    }

    public function get_akun_filter($selesai, $mulai){
        $this->db->select('saldo_awal_log.*, akun.kodeAkun, akun.namaAkun, akun.saldoAkhir,jenis_akun.namaJenis');
        $this->db->from('saldo_awal_log, akun,jenis_akun');
        $this->db->where('akun.idJenis = jenis_akun.idJenis');
        $this->db->where('saldo_awal_log.idAkun = akun.idAkun');
        $this->db->where('saldo_awal_log.tanggal <=', $selesai);
        $this->db->where('saldo_awal_log.tanggal >=', $mulai);

        return $this->db->get();
    }

    public function get_detail($db,$tabel, $id){
        $this->db->select('*');
        $this->db->from($db);
        $this->db->where($tabel , $id);
        // $this->db->join('saldo', 'akun.idAkun=saldo.idAkun');

        return $this->db->get();
    }

    public function get_detail_akun($id){
        $this->db->select('*');
        $this->db->from('akun, jenis_akun');
        $this->db->where('akun.idJenis = jenis_akun.idJenis');
        $this->db->where('akun.idAkun' , $id);
        // $this->db->join('saldo', 'akun.idAkun=saldo.idAkun');

        return $this->db->get();
    }

    public function get_detail_barang($db,$tabel, $id){
        $this->db->select('*');
        $this->db->from($db);
        $this->db->where($tabel , $id);
        $this->db->join('jenis_barang', 'barang.idJenis=jenis_barang.idJenis');

        return $this->db->get();
    }

    public function update($data,$tabel,$id, $row){
        $this->db->where($row, $id);
        return $this->db->update($tabel, $data);
    }

    
    public function cek_saldo($id){
        $saldo_ada = $this->db->get_where('akun', ['idAkun' => $id]);
        return $saldo_ada;
    }
    public function insert_akun($data){
        return $this->db->insert('akun', $data);
    }

    public function insert_log($data){
        return $this->db->insert('log_akun', $data);
    }

    public function insert_saldoAwal($tabel,$data){
        return $this->db->insert($tabel, $data);
    }

    
    public function get_perusahaan(){
        $this->db->select('*');
        $this->db->from('perusahaan');
        // $this->db->join('saldo', 'akun.idAkun=saldo.idAkun');

        return $this->db->get();
    }
    public function get_perusahaan_filter($selesai, $mulai){
        $this->db->select('*');
        $this->db->from('perusahaan');
        $this->db->where('tanggal <=', $selesai);
        $this->db->where('tanggal >=', $mulai);
        return $this->db->get();
    }

    public function insert_perusahaan($data){
        return $this->db->insert('perusahaan', $data);
    }

    public function get_barang(){
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('jenis_barang', 'barang.idJenis=jenis_barang.idJenis');

        return $this->db->get();
    }

	//Model Transaksi => Penjualan
	public function get_rowbarang(){
		return $this->db->join('jenis_barang', 'barang.idJenis = jenis_barang.idJenis')
		->get('barang')->num_rows();
	}

	public function show_data() {

		return $this->db->get('jenis_barang')->result(); 
	}

    public function filter_barang($jenis, $number, $offset)
    {
        if ($jenis != '') {
            return $this->db->join('jenis_barang', 'barang.idJenis = jenis_barang.idJenis')
                ->where('barang.idJenis', $jenis)
                ->get('barang')->result();
        } else {
            return $this->db->join('jenis_barang', 'barang.idJenis = jenis_barang.idJenis')
                ->get('barang', $number, $offset)->result();
        }
    }

    public function get_jenis(){
        $this->db->select('*');
        $this->db->from('jenis_barang');
        return $this->db->get();
    }

    public function insert_barang($data){
        return $this->db->insert('barang', $data);
    }


    public function get_pelanggan(){
        $this->db->select('*');
        $this->db->from('pelanggan');
        return $this->db->get();
    }
    public function insert_pelanggan($data){
        return $this->db->insert('pelanggan', $data);
    }

    public function get_supplier(){
        $this->db->select('*');
        $this->db->from('supplier');
        return $this->db->get();
    }
    public function insert_supplier($data){
        return $this->db->insert('supplier', $data);
    }
}
