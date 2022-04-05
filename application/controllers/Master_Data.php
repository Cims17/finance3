<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_Data extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('myfpdf');
		$this->output->disable_cache();
		if ($this->session->userdata('idUser') == null) {
			redirect('auth/login');
		}
	}

	public function saldo_awal()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');
		if ($mulai) {
			$data['akun'] = $this->Model_akun->get_akun_filter($selesai, $mulai)->result_array();
			$data['log1'] = $this->Model_akun->get_saldo_awal_log()->result_array();
			$data['tgl'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai
			);
			// echo json_encode($data['akun']);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('master_data/saldo_awal', $data);
			$this->load->view('template/footer');
		} else {

			$data['akun'] = $this->Model_akun->get_akun_saldo()->result_array();
			$data['log1'] = $this->Model_akun->get_saldo_awal_log()->result_array();
			$data['tgl'] = array(
				'mulai'      => '0000-00-00',
				'selesai'       => '0000-00-00'
			);
			// echo json_encode($data['akun']);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('master_data/saldo_awal', $data);
			$this->load->view('template/footer');
		}
	}

	public function tambah_saldo()
	{
		$data['akun'] = $this->Model_akun->get_akun()->result_array();

		// $data['akun2'] = $this->Model_akun->get_akun()->result_row();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/tambah_saldo', $data);
		$this->load->view('template/footer');
	}
	public function getSaldoAkhir()
	{
		$idAkun = $this->input->post('id', TRUE);
		$data = $this->Model_akun->cek_saldo($idAkun)->row();
		echo $data->saldoAkhir;
		// echo $data->saldoAkhir;
	}
	public function save_saldo()
	{
		$idAkun = $this->input->post('idAkun');
		$nominal = $this->input->post('saldoAwal');
		$saldoAwal = filter_var($nominal, FILTER_SANITIZE_NUMBER_INT);
		$tanggal	= $this->input->post('tanggal');
		$jenisSaldo = $this->input->post('jenisSaldo');
		// echo $saldoAwal;
		$keterangan = $this->input->post('keterangan');

		if ($jenisSaldo == "Kredit") {
			$data3 = array(
				'idAkun'        => $idAkun,
				'kredit'       => $saldoAwal,
				'keterangan'       => $keterangan,
				'input_from'       => 'Saldo Awal',
				'tanggal'		=> $tanggal,	
			);
			
			$save = $this->Model_akun->insert_log($data3);
			if ($save) {
				$data2 = array(
					'idAkun'        => $idAkun,
					'kredit'       => $saldoAwal,
					'idLog'       => $this->db->insert_id(),
					'tanggal'		=> $tanggal,	
				);
				$this->Model_akuntansi->insert_data('kredit_log', $data2);
				$data = array(
					'idAkun'	=> $idAkun,
					'saldoAwal'	=> $saldoAwal,
					'tipe_awal'	=> $jenisSaldo,
					'tanggal'		=> $tanggal,		
				);

				$this->Model_akuntansi->insert_data('saldo_awal_log', $data);
				redirect('master_data/saldo_awal');
			}
		} else {
            $data3 = array(
				'idAkun'        => $idAkun,
				'debit'       => $saldoAwal,
				'keterangan'       => $keterangan,
				'input_from'       => 'Saldo Awal',
				'tanggal'		=> $tanggal,	
			);
			
			$save = $this->Model_akun->insert_log($data3);
			if ($save) {
				$data2 = array(
					'idAkun'        => $idAkun,
					'debit'       => $saldoAwal,
					'idLog'       => $this->db->insert_id(),
					'tanggal'		=> $tanggal,	
				);
				$this->Model_akuntansi->insert_data('debit_log', $data2);
				$data = array(
					'idAkun'        => $idAkun,
					'saldoAwal'       => $saldoAwal,
					'tipe_awal'	=> $jenisSaldo	,
					'tanggal'		=> $tanggal,	
				);

				$this->Model_akuntansi->insert_data('saldo_awal_log', $data);
				redirect('master_data/saldo_awal');
			}
        }

		// var_dump($keterangan);
		// $saldo_ada = $this->db->get_where('saldo_awal_log', ['idAkun' => $idAkun])->row();

		// echo $saldo_awal_ada;
		// if ($saldo_ada) {
		// 	$data = array(
		// 		'idAkun'        => $idAkun,
		// 		'saldoAwal'       => $saldoAwal,
		// 	);
		// 	$update = $this->Model_akuntansi->update_data('saldo_awal_log', $data, $idAkun, 'idAkun');
		// 	if ($update) {
		// 		$data3 = array(
		// 			'idAkun'        => $idAkun,
		// 			'saldoAwal'       => $saldoAwal,
		// 			'keterangan'       => $keterangan,
		// 			'input_from'       => 'Saldo Awal'
		// 		);
		// 		$this->Model_akun->insert_log($data3);
		// 		redirect('master_data/saldo_awal');
		// 	}
		// } else {
		// 	$data = array(
		// 		'idAkun'        => $idAkun,
		// 		'saldoAwal'       => $saldoAwal,
		// 	);
		// 	$update = $this->Model_akuntansi->insert_data('saldo_awal_log', $data);
		// 	if ($update) {
		// 		$data3 = array(
		// 			'idAkun'        => $idAkun,
		// 			'saldoAwal'       => $saldoAwal,
		// 			'keterangan'       => $keterangan,
		// 			'input_from'       => 'Saldo Awal'
		// 		);
		// 		$this->Model_akun->insert_log($data3);
		// 		redirect('master_data/saldo_awal');
		// 	}
		// }
	}

	public function edit_saldo($id)
	{
		$saldoAwal = $this->input->post('saldoAwal');
		$tipe_saldo = $this->input->post('tipe_saldo');
		$saldoLawas = $this->input->post('saldoLawas');
		
		$idLog = $this->input->post('idLog');
		if ($saldoLawas != $tipe_saldo) {
            if ($tipe_saldo == "Kredit") {
                $this->db->delete('debit_log', array('idLog' => $idLog));
                $data3 = array(
                    'kredit'       => $saldoAwal,
                    'debit'     => 0
                );
                $save = $this->Model_laporan->update_data('log_akun', $data3, $idLog, 'idLog');
                if ($save) {
                    $data = array(
                        'idAkun'        => $id,
                        'kredit'       => $saldoAwal,
                        'idLog'       => $idLog,
                    );
                    $this->Model_laporan->insert_data('kredit_log', $data);
                }
            } else {
                $this->db->delete('kredit_log', array('idLog' => $idLog));
                $data3 = array(
                    'debit'       => $saldoAwal,
                    'kredit'     => 0
                );
                $save = $this->Model_laporan->update_data('log_akun', $data3, $idLog, 'idLog');
                
                if ($save) {
                    $data = array(
                        'idAkun'        => $id,
                        'debit'       => $saldoAwal,
                        'idLog'       => $idLog,
                    );
                    $this->Model_laporan->insert_data('debit_log', $data);
                }
            }
        }else{
            if ($tipe_saldo == "Kredit") {
                $data3 = array(
                    'kredit'       => $saldoAwal,
                    
                );
                $save = $this->Model_laporan->update_data('log_akun', $data3, $idLog, 'idLog');
                if ($save) {
                    $data = array(
                        'kredit'       => $saldoAwal,
                    );
                    $this->Model_laporan->update_data('kredit_log', $data, $idLog, 'idLog');
                }
            } else {
                $data3 = array(
                    'debit'       => $saldoAwal,
                );
                $save = $this->Model_laporan->update_data('log_akun', $data3, $idLog, 'idLog');
                
                if ($save) {
                    $data = array(
                        'idAkun'        => $id,
                        'debit'       => $saldoAwal,
                        'idLog'       => $idLog,
                    );
                    $this->Model_laporan->update_data('debit_log', $data, $idLog, 'idLog');
                }
            }
        }
		$data4 = array(
			'saldoAwal'    => $saldoAwal,
			'tipe_awal'       => $tipe_saldo
		);
		$save = $this->Model_laporan->update_data('saldo_awal_log', $data4, $id, 'idAkun');
		if ($save) {
			redirect('master_data/saldo_awal');
		}
	}

	//DATA PERUSAHAAN

	public function info_perusahaan()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');

		if ($mulai) {
			$data['perusahaan'] = $this->Model_akun->get_perusahaan_filter($selesai, $mulai)->result_array();
			$data['tgl'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai
			);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('master_data/info_perusahaan', $data);
			$this->load->view('template/footer');
		} else {
			$data['perusahaan'] = $this->Model_akun->get_perusahaan()->result_array();
			$data['tgl'] = array(
				'mulai'      => '0000-00-00',
				'selesai'       => '0000-00-00'
			);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('master_data/info_perusahaan', $data);
			$this->load->view('template/footer');
		}
	}

	public function pdfinfo_perusahaan()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');

		if ($mulai) {
			$data['perusahaan'] = $this->Model_akun->get_perusahaan_filter($selesai, $mulai)->result_array();
			$data['tgl'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai
			);
			$this->load->view('master_data/pdf/pdfinfo_perusahaanfix', $data);
		} else {
			$data['perusahaan'] = $this->Model_akun->get_perusahaan()->result_array();
			$data['tgl'] = array(
				'mulai'      => '0000-00-00',
				'selesai'       => '0000-00-00'
			);
			$this->load->view('master_data/pdf/pdfinfo_perusahaanallfix', $data);
		}
	}
	public function pdfinfo_perusahaanall()
	{
		$data['perusahaan'] = $this->Model_akun->get_perusahaan()->result_array();
		$this->load->view('master_data/pdf/pdfinfo_perusahaanallfix', $data);
	}

	public function tambah_perusahaan()
	{

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/tambah_perusahaan');
		$this->load->view('template/footer');
	}

	public function save_perusahaan()
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$npwp = $this->input->post('npwp');
		$data2 = array(
			'nama'        => $nama,
			'alamat'       => $alamat,
			'npwp'       => $npwp
		);
		$save = $this->Model_akun->insert_perusahaan($data2);
		if ($save) {
			$this->session->set_flashdata(
				'berhasil_perusahaan',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Data Perusahaan Berhasil Ditambah","success")  
						</script>'
			);
			redirect('master_data/info_perusahaan');
		}
	}

	public function update_perusahaan($id)
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$npwp = $this->input->post('npwp');

		$data = array(
			'nama'        => $nama,
			'alamat'       => $alamat,
			'npwp'       => $npwp,
		);

		$where = array('id' => $id);

		$this->db->update('perusahaan', $data, $where);
		$this->session->set_flashdata(
			'berhasil_perusahaan',
			'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data perusahaan berhasil diupdate","success"); 
                            </script>'
		);
		redirect('master_data/info_perusahaan');
	}

	public function delete_perusahaan($id)
	{
		// $id = $this->input->post('id');
		$this->db->delete('perusahaan', array('id' => $id));
	}


	// DATA AKUN
	public function data_perkiraan_akun()
	{
		$data['akun'] = $this->Model_akun->get_akun()->result_array();
		// echo json_encode($data['akun']);
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/data_perkiraan', $data);
		$this->load->view('template/footer');
	}


	public function jenis_akun()
	{
		$data['jenis']	= $this->Model_akun->get_jenis_akun()->result_array();
		$data['tipe']	= $this->Model_akun->get_tipe_akun()->result_array();
		// echo json_encode($data['akun']);
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/jenis_akun', $data);
		$this->load->view('template/footer');
	}

	public function tambah_jenis_akun()
	{
		$jenis	= $this->input->post('jenis');
		$kode	= $this->input->post('kode');
		$tipe	= $this->input->post('id_tipeakun');

		$data = array(
			'namaJenis'		=> $jenis,
			'kodeJenis'		=> $kode,
			'id_tipeAkun'	=> $tipe,
		);

		$this->db->insert('jenis_akun', $data);

		$this->session->set_flashdata(
			'berhasil_tambah_jenis_akun',
			'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
					<script type ="text/JavaScript">  
					swal("Berhasil","Jenis Akun Berhasil Ditambahkan","success")  
					</script>'
		);
		redirect('master_data/jenis_akun');
	}

	public function edit_jenis_akun()
	{
		$jenis 			= $this->input->post('jenis');
		$kode  			= $this->input->post('kode');
		$id				= $this->input->post('id');
		$id_tipeAkun	= $this->input->post('id_tipeakun');

		$data = array(
			'namaJenis'		=> $jenis,
			'kodeJenis'		=> $kode,
			'id_tipeAkun'	=> $id_tipeAkun,
		);

		$save = $this->Model_akun->update($data, 'jenis_akun', $id, 'idJenis');
		if ($save) {
			$this->session->set_flashdata(
				'berhasil_tambah_jenis_akun',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Jenis Akun Berhasil Diubah","success")  
						</script>'
			);
			redirect('master_data/jenis_akun');
		}
	}

	public function delete_jenis_akun($id)
	{
		// $id = $this->input->post('id');
		$this->db->delete('jenis_akun', array('idJenis' => $id));
	}
	public function tambah_akun()
	{
		$data['jenis'] = $this->Model_akun->get_jenis_akun()->result_array();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/tambah_akun', $data);
		$this->load->view('template/footer');
	}

	public function get_kodejenis()
	{
		// POST data
		$postData = $this->input->post();

		// get data
		$data = $this->Model_akun->get_kodejenismodal($postData);

		echo json_encode($data);
	}

	public function edit_akun($id)
	{
		$data['akun'] = $this->Model_akun->get_detail_akun($id)->row();
		$data['jenis'] = $this->Model_akun->get_jenis_akun()->result_array();
		// echo json_encode($data['akun']);
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/edit_akun', $data);
		$this->load->view('template/footer');
	}

	public function save_akun()
	{
		$nama		= $this->input->post('namaAkun');
		$kode		= $this->input->post('kodeAkun');
		$keterangan	= $this->input->post('keterangan');
		$jenis		= $this->input->post('jenis');

		$data = array(
			'namaAkun'		=> $nama,
			'kodeAkun'		=> $this->input->post('kodeJenis') . '-' . $kode,
			'idJenis'		=> $jenis,
			'keterangan'	=> $keterangan
		);

		$save	= $this->Model_akun->insert_akun($data);

		if ($save) {
			redirect('master_data/data_perkiraan_akun');
		}
	}

	public function update_akun()
	{
		$nama = $this->input->post('namaAkun');
		$id = $this->input->post('idAkun');
		$kode = $this->input->post('kodeAkun');
		$jenis = $this->input->post('jenis');
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'namaAkun'        => $nama,
			'kodeAkun'       => $kode,
			'idJenis'           => $jenis,
			'keterangan'           => $keterangan,
		);
		$save = $this->Model_akun->update($data, 'akun', $id, 'idAkun');
		if ($save) {
			redirect('master_data/data_perkiraan_akun');
		}
	}

	public function delete_akun($id)
	{
		// $id = $this->input->post('id');
		$this->db->delete('kredit_log', array('idAkun' => $id));
		$this->db->delete('debit_log', array('idAkun' => $id));
		$this->db->delete('saldo_awal_log', array('idAkun' => $id));
		$this->db->delete('log_akun', array('idAkun' => $id));
		$this->db->delete('akun', array('idAkun' => $id));
	}


	//Data Barang
	public function data_barang()
	{
		$data['barang'] = $this->Model_akun->get_barang()->result_array();

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/data_barang', $data);
		$this->load->view('template/footer');
	}

	public function pdfdata_barang()
	{
		$data['barang'] = $this->Model_akun->get_barang()->result_array();
		$this->load->view('master_data/pdf/pdfdata_barang', $data);
	}


	public function tambah_barang()
	{
		$data['jenis'] = $this->Model_akun->get_jenis()->result_array();

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/tambah_barang', $data);
		$this->load->view('template/footer');
	}

	public function tambah_barang_beli($nama, $jml)
	{
		$data['jenis']	= $this->Model_akun->get_jenis()->result_array();
		$data['nama']	= str_replace("_", " ", $nama);
		$data['jml']	= $jml;

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/tambah_barang_beli', $data);
		$this->load->view('template/footer');
	}

	public function jenis_barang()
	{
		$data['jenisBarang'] = $this->Model_akun->get_jenis()->result_array();

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/jenis_barang', $data);
		$this->load->view('template/footer');
	}

	public function tambah_jenis_barang()
	{
		$nama = $this->input->post('nama');

		$data = array(
			'namaJenis'	=> $nama,
		);

		$this->db->insert('jenis_barang', $data);

		$this->session->set_flashdata(
			'berhasil_jenis_barang',
			'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
					<script type ="text/JavaScript">  
					swal("Berhasil","Jenis Barang Berhasil Ditambahkan","success")  
					</script>'
		);
		redirect('master_data/jenis_barang');
	}

	public function edit_jenis_barang()
	{
		$nama = $this->input->post('nama');
		$kode  = $this->input->post('kode');
		$id    = $this->input->post('id');

		$data = array(
			'namaJenis'	=> $nama,
		);

		$save = $this->Model_akun->update($data, 'jenis_barang', $id, 'idJenis');
		if ($save) {
			$this->session->set_flashdata(
				'berhasil_jenis_barang',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Jenis Barang Berhasil Diubah","success")  
						</script>'
			);
			redirect('master_data/jenis_barang');
		}
	}

	public function edit_barang($id)
	{
		$data['barang'] = $this->Model_akun->get_detail_barang('barang', 'idBarang', $id)->row();
		$data['jenis'] = $this->Model_akun->get_jenis()->result_array();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/edit_barang', $data);
		$this->load->view('template/footer');
	}

	public function save_barang()
	{
		$nama = $this->input->post('namaBarang');
		$kode = $this->input->post('kodeBarang');
		$jenisBarang = $this->input->post('jenisBarang');
		$stok = $this->input->post('stok');
		$harga = $this->input->post('harga');
		$harga2 = filter_var($harga, FILTER_SANITIZE_NUMBER_INT);
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'nama'        => $nama,
			'kodeBarang'  => $kode,
			'idJenis'     => $jenisBarang,
			'stok'		  => $stok,
			'harga'       => $harga2,
			'keterangan'  => $keterangan,

		);
		$save = $this->Model_akun->insert_barang($data);
		if ($save) {
			$this->session->set_flashdata(
				'berhasil_tambah_barang',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Data barang Berhasil Ditambah","success")  
						</script>'
			);
			redirect('master_data/data_barang');
		}
	}

	public function update_barang()
	{
		$nama = $this->input->post('nama');
		$id = $this->input->post('idBarang');
		$kode = $this->input->post('kodeBarang');
		$jenis = $this->input->post('idJenis');
		$stok  = $this->input->post('stok');
		$harga = $this->input->post('harga');
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'kodeBarang'        => $kode,
			'nama'      		=> $nama,
			'idJenis'           => $jenis,
			'stok'				=> $stok,
			'harga'             => $harga,
			'keterangan'        => $keterangan
		);
		$save = $this->Model_akun->update($data, 'barang', $id, 'idBarang');
		if ($save) {
			$this->session->set_flashdata(
				'berhasil_update_barang',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Data Barang Berhasil Diubah","success")  
						</script>'
			);
			redirect('master_data/data_barang');
		}
	}

	public function delete_jenis_barang($id)
	{
		// $id = $this->input->post('id');
		$this->db->delete('jenis_barang', array('idJenis' => $id));
	}

	public function delete_barang($id)
	{
		// $id = $this->input->post('id');
		$this->db->delete('barang', array('idBarang' => $id));
	}

	// DATA PELANGGAN
	public function data_pelanggan()
	{

		$data['pelanggan'] = $this->Model_akun->get_pelanggan()->result_array();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/data_pelanggan', $data);
		$this->load->view('template/footer');
	}

	public function pdfdata_pelanggan()
	{
		$data['pelanggan'] = $this->Model_akun->get_pelanggan()->result_array();
		$this->load->view('master_data/pdf/pdfdata_pelangganfix', $data);
	}

	public function tambah_pelanggan()
	{

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/tambah_pelanggan');
		$this->load->view('template/footer');
	}

	public function edit_pelanggan($id)
	{
		$data['pelanggan'] = $this->Model_akun->get_detail('pelanggan', 'idPelanggan', $id)->row();

		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/edit_pelanggan', $data);
		$this->load->view('template/footer');
	}


	public function save_pelanggan()
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$notelp = $this->input->post('notelp');
		$status = $this->input->post('status');

		$data = array(
			'nama'        => $nama,
			'alamat'       => $alamat,
			'no_telp'           => $notelp,
			'status'            => $status

		);
		$save = $this->Model_akun->insert_pelanggan($data);
		if ($save) {
			$this->session->set_flashdata(
				'berhasil_pelanggan',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Data Pelanggan Berhasil Disimpan","success")  
						</script>'
			);
			redirect('master_data/data_pelanggan');
		}
	}

	public function update_pelanggan()
	{
		$id = $this->input->post('idPelanggan');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$notelp = $this->input->post('notelp');
		$status = $this->input->post('status');

		$data = array(
			'nama'        => $nama,
			'alamat'       => $alamat,
			'no_telp'           => $notelp,
			'status'            => $status
		);
		$save = $this->Model_akun->update($data, 'pelanggan', $id, 'idPelanggan');
		if ($save) {
			$this->session->set_flashdata(
				'berhasil_pelanggan',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Data Pelanggan Berhasil Diubah","success")  
						</script>'
			);
			redirect('master_data/data_pelanggan');
		}
	}

	public function delete_pelanggan($id)
	{
		// $id = $this->input->post('id');
		$this->db->delete('pelanggan', array('idPelanggan' => $id));
	}


	// DATA SUPPLIER
	public function data_supplier()
	{
		$data['supplier'] = $this->Model_akun->get_supplier()->result_array();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/data_supplier', $data);
		$this->load->view('template/footer');
	}

	public function pdfdata_supplier()
	{
		$data['supplier'] = $this->Model_akun->get_supplier()->result_array();
		$this->load->view('master_data/pdf/pdfdata_supplierfix', $data);
	}


	public function tambah_supplier()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/tambah_supplier');
		$this->load->view('template/footer');
	}

	public function edit_supplier($id)
	{
		$data['supplier'] = $this->Model_akun->get_detail('supplier', 'idSupp', $id)->row();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('master_data/edit_supplier', $data);
		$this->load->view('template/footer');
	}

	public function save_supplier()
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$notelp = $this->input->post('notelp');

		$data = array(
			'nama'        => $nama,
			'alamat'      => $alamat,
			'no_telp'     => $notelp

		);
		$save = $this->Model_akun->insert_supplier($data);
		if ($save) {
			$this->session->set_flashdata(
				'berhasil_supplier',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Data Supplier Berhasil Ditambah","success")  
						</script>'
			);
			redirect('master_data/data_supplier');
		}
	}

	public function update_supplier()
	{
		$nama = $this->input->post('nama');
		$id = $this->input->post('idSupp');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('notelp');
		$data = array(
			'nama'        => $nama,
			'alamat'       => $alamat,
			'no_telp'           => $no_telp
		);
		$save = $this->Model_akun->update($data, 'supplier', $id, 'idSupp');
		if ($save) {
			$this->session->set_flashdata(
				'berhasil_supplier',
				'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Data Supplier Berhasil Diubah","success")  
						</script>'
			);
			redirect('master_data/data_supplier');
		}
	}

	public function delete_supplier($id)
	{
		// $id = $this->input->post('id');
		$this->db->delete('supplier', array('idSupp' => $id));
	}
}
