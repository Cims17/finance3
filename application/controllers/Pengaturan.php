<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		if ($this->session->userdata('idUser') == null) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['users'] = $this->Model_pengaturan->get_users()->result_array();

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pengaturan_akun', $data);
		$this->load->view('template/footer');
	}

	public function tambah_user()
	{

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('tambah_akun');
		$this->load->view('template/footer');
	}

	public function save_user()
	{
		$username	= $this->input->post('username');
		$email		= $this->input->post('email');
		$password	= password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$role		= $this->input->post('role');

		$data2	= array(
			'username'	=> $username,
			'email'		=> $email,
			'password'	=> $password,
			'role'		=> $role
		);

		$save = $this->db->insert('user', $data2);
		if ($save) {
			$this->session->set_flashdata(
				'berhasil_user',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Data User Berhasil Ditambah","success")  
						</script>'
			);
			redirect('pengaturan');
		}
	}

	public function update_user($id)
	{
		$username	= $this->input->post('username');
		$email		= $this->input->post('email');
		$role		= $this->input->post('role');

		$data	= array(
			'username'	=> $username,
			'email'		=> $email,
			'role'		=> $role
		);

		$where = array('idUser' => $id);

		$this->db->update('user', $data, $where);
		$this->session->set_flashdata(
			'berhasil_user',
			'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data User berhasil diupdate","success"); 
                            </script>'
		);
		redirect('pengaturan');
	}

	public function profile()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('profile');
		$this->load->view('template/footer');
	}
}
