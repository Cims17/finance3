<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_Besar extends CI_Controller
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
        $data['akun'] = $this->Model_akun->get_akun()->result_array();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('akuntansi/buku_besar', $data);
        $this->load->view('template/footer');
    }

    public function akun()
    {
        $idAkun = $this->input->post('idAkun');
        $mulai = $this->input->post('mulai');
        $selesai = $this->input->post('selesai');
        if (!$idAkun) {
            redirect('akuntansi/buku_besar');
        }else{
            $data['filter'] = $this->Model_akuntansi->get_buku_besar($idAkun, $mulai, $selesai)->result_array();

            $data['akun'] = $this->Model_akun->get_detail('akun', 'idAkun', $idAkun)->row();
            $data['akun2'] = $this->Model_akun->get_akun()->result_array();
            $data['nama'] = array(
                'mulai'      => $mulai,
                'selesai'       => $selesai
            );
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('akuntansi/buku_besar_filter', $data);
            $this->load->view('template/footer');
        }
        
    }
}
