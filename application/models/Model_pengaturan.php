<?php

class Model_pengaturan extends CI_Model {

    public function get_users(){
        $this->db->select('*');
        $this->db->from('user');

        return $this->db->get();
    }

}
