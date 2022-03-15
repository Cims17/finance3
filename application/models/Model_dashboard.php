<?php

class Model_dashboard extends CI_Model {

    public function get_data($idUser){
        $this->db->select('*');
        $this->db->from('saldo');
        $this->db->where('idUser='.$idUser);

        return $this->db->get();
    }
}