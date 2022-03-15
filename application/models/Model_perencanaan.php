<?php

class Model_perencanaan extends CI_Model{
    public function get_perencanaan($id){
        $this->db->select('*');
        $this->db->from('perencanaan');
        $this->db->where('idUser' , $id);
        return $this->db->get();
    }

    public function get_budget($id){
        $this->db->select('*');
        $this->db->from('budgeting');
        $this->db->where('idUser' , $id);
        return $this->db->get();
    }

    public function tambah_rencana($data){
        return $this->db->insert('perencanaan', $data);
    }

    public function hapus_rencana($id){
        $this->db->where('idUser' , $id);
        $this->db->delete('perencanaan');
    }

    public function tambah_budget($data){
        return $this->db->insert('budgeting', $data);
    }


}