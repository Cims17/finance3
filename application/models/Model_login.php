<?php

class Model_login extends CI_Model
{
	public function cek_login()
	{
		$email		= set_value('email');
		$password	= set_value('password');
		$role		= set_value('role');

		$this->input->post('email', $email);
		$this->input->post('password', $password);
		$this->input->post('role', $role);

		$cek  	= $this->db->get_where('user', ['email' => $email] );
		// $cek	= $this->db->get_where('role', ['role' => $role]);

		if ($cek->num_rows() > 0) {
			$hasil = $cek->row();
			if (password_verify($password, $hasil->password)) {
				if($role == $hasil->role ){
					return $hasil;
				}elseif($role == 0){
					$this->session->set_flashdata('pesan', '<div style="justify-content:center;" class="text-center alert alert-danger alert-dismissible fade show" role="alert">Belum memilih jenis akun!</div>');
					redirect('auth/login');
				}  else {
					$this->session->set_flashdata('pesan', '<div style="justify-content:center;" class="text-center alert alert-danger alert-dismissible fade show" role="alert">Email tidak ditemukan pada jenis akun yang dipilih!</div>');
					redirect('auth/login');
				}
			}  else {

				return array();
			}
		} else {
			$this->session->set_flashdata('pesan', '<div style="justify-content:center;" class="text-center alert alert-danger alert-dismissible fade show" role="alert">Email tidak ditemukan!</div>');
			redirect('auth/login');
		}
	}
	public function daftar_user($data, $table)
	{
		$this->db->insert($table, $data);
		return true;
	}

	public function link_saldo($data){
		$this->db->insert('saldo', $data);
		return true;
	}
}
