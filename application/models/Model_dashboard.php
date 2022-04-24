<?php

class Model_dashboard extends CI_Model {

    public function get_data($idUser){
        $this->db->select('*');
        $this->db->from('saldo');
        $this->db->where('idUser='.$idUser);

        return $this->db->get();
    }

	public function get_penjualan_dashboard($tabel){
        $tahun = '2021';
        $penjualan = array(''.$tahun.'-01',''.$tahun.'-02',''.$tahun.'-03',''.$tahun.'-04',''.$tahun.'-05',''.$tahun.'-06',''.$tahun.'-07',''.$tahun.'-08',''.$tahun.'-09',''.$tahun.'-10',''.$tahun.'-11',''.$tahun.'-12');
            
        for($i=0; $i<count($penjualan); $i++){
            $this->db->select_sum('total');
            $this->db->from($tabel);
            $this->db->like('tanggal', $penjualan[$i]);
            $data[$i] = $this->db->get()->result();
        }
        return $data;
    }
}
