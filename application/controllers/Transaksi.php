<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
		$this->load->library('myfpdf');
        if ($this->session->userdata('idUser') == null) {
        	redirect('auth/login');
        }
		date_default_timezone_set('Asia/Jakarta');
    }

	#DATA PENJUALAN
    public function daftar_penjualan()
    {
		$mulai = $this->input->post('mulai');
        $selesai = $this->input->post('selesai');

        if ($mulai) {
			$data['detail_penjualan'] = $this->Model_transaksi->get_penjualan_detail()->result_array();
			$data['penjualan'] = $this->Model_transaksi->get_penjualan_filter($selesai, $mulai)->result_array();
            $data['tgl'] = array(
                'mulai'      => $mulai,
                'selesai'       => $selesai
            );
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('transaksi/data_penjualan', $data);
            $this->load->view('template/footer');
        }else{
			$data['detail_penjualan'] = $this->Model_transaksi->get_penjualan_detail()->result_array();
            $data['penjualan'] = $this->Model_transaksi->get_penjualan()->result_array();
            $data['tgl'] = array(
                'mulai'      => '0000-00-00',
                'selesai'       => '0000-00-00'
            );
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('transaksi/data_penjualan', $data);
            $this->load->view('template/footer');
        }
    }

	public function formatNbr($nbr) {
        if ($nbr == 0 || $nbr == NULL)
            return "001";
        else if ($nbr < 10)
            return "00" . $nbr;
        elseif ($nbr >= 10 && $nbr < 100)
            return "0" . $nbr;
        else
            return strval($nbr);
    }

	function caribarang()
    {
        $key = $this->input->get('q');
        $data = $this->Model_transaksi->hasilcari($key)->result_array();
        foreach ($data as $result) {
			echo "<a href='#' data-id='".  $result["idBarang"] ."' data-name='". str_replace(' ', '_', $result["nama"]) . "' data-price='". $result["harga"] . "' class='add-to-cart'>" . $result["nama"] . " :  Rp.". number_format($result['harga'], 0, '', '.') ."</a> <br/>";
            // echo '<a href="#">' . $result['nama'] . '</a><br />';
        }
    }

    public function tambah_penjualan()
    {
		$kode 	= $this->Model_transaksi->get_nourutPenjualan();
		$tgl 	= date('Ymd');
		$nourut = $this->formatNbr($kode[0]->nomor);

		$data['barang'] 		= $this->Model_akun->get_barang()->result_array();
		$data['jenis'] 			= $this->Model_akun->get_jenis()->result_array();
        $data['pelanggan']		= $this->Model_akun->get_pelanggan()->result_array();
		$data['noTransaksi']	= "A". $tgl . $nourut ;

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('transaksi/tambah_penjualan', $data);
        $this->load->view('template/footer');
    }

	public function terjual() {
		date_default_timezone_set('Asia/Jakarta');
		$total_belanja = $this->input->post('total_belanja');
		$bayar = $this->input->post('bayar');
		$noTransaksi = $this ->input->post('noTransaksi');
		$idPelanggan = $this->input->post('idPelanggan');
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'noTransaksi' => $noTransaksi,
			'tanggal' => date('Y-m-d'),
			'idPelanggan' => $idPelanggan,
			'keterangan' => $keterangan,
			'total' => $total_belanja,
			'bayar' => $bayar,
			'created_at' => date("Y-m-d h:i:sa"),
		);
		$simpan = $this->db->insert('penjualan', $data);
		$insert_id = $this->db->insert_id();

        if ($simpan) {
            $data2 = array();
            foreach ($_POST['namaBarang'] as $key => $val) :
                $ttProduk 	= $_POST['total'][$key];
				$rpl1 		= str_replace('Rp. ', '', $ttProduk);
				$rpl2 		= str_replace('.00', '', $rpl1);
				$data2[] 	= array(
						'idTransaksi'	=> $insert_id,
						'idBarang'		=> $_POST['idBarang'][$key],
						'namaBarang'	=> $_POST['namaBarang'][$key],
						'kuantitas'    	=> $_POST['kuantitas'][$key],
						'total'			=> $rpl2,
					);
			endforeach;
            $this->db->insert_batch('penjualan_detail', $data2);
        

            $this->session->set_flashdata(
                'berhasil_beli',
                '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
						<script type ="text/JavaScript">  
						swal("Berhasil","Data transaksi berhasil ditambahkan","success")  
						</script>'
            );
            redirect('transaksi/tambah_penjualan');
        	}
	}

	public function delete_penjualan($id){

		$this->db->delete('penjualan', array('idTransaksi' => $id));
	}

	public function pdf_data_penjualan()
    {
        $mulai = $this->input->post('mulai');
        $selesai = $this->input->post('selesai');

        if ($mulai) {
            $data['penjualan'] = $this->Model_transaksi->get_penjualan_filter($selesai, $mulai)->result_array();
            $data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan_filter($selesai, $mulai)->result_array();
            $data['tgl'] = array(
                'mulai'      => $mulai,
                'selesai'       => $selesai
            );
            $this->load->view('transaksi/pdf/pdf_data_penjualan_filter', $data);
        } else {
            $data['penjualan'] = $this->Model_transaksi->get_penjualan()->result_array();
            $data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan()->result_array();
            $data['tgl'] = array(
                'mulai'      => '0000-00-00',
                'selesai'       => '0000-00-00'
            );
            $this->load->view('transaksi/pdf/pdf_data_penjualanall', $data);
        }
    }

	#DATA PEMBELIAN
    public function daftar_pembelian()
    {
        $data['pembelian']			= $this->Model_transaksi->get_pembelian()->result_array() ;
		$data['pembelian_detail'] 	= $this->Model_transaksi->get_pembelian_detail()->result_array();
		$barang						= $this->Model_akun->get_barang()->result_array(); 
		$data['namabarang'] =array();
        foreach ($barang as $brg) {
			array_push( $data['namabarang'], $brg['nama']);
        }
		
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('transaksi/data_pembelian', $data);
        $this->load->view('template/footer');
    }

    public function tambah_pembelian()
    {
		date_default_timezone_set('Asia/Jakarta');
		$kode = $this->Model_transaksi->get_nourutPembelian();
		$tgl = date('Ymd');
		$nourut = $this->formatNbr($kode[0]->nomor);
		$data['noTransaksi'] = "B". $tgl . $nourut ;

        $data['supplier'] = $this->Model_akun->get_supplier()->result_array();

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('transaksi/tambah_pembelian', $data);
        $this->load->view('template/footer');
    }

	public function tambah_data_pembelian()
	{
		$noTransaksi	= $this->input->post('noTransaksi');
		$idSupp			= $this->input->post('idSupplier');
		$keterangan		= $this->input->post('keterangan');
		$totalPembelian	= 0;

		foreach($_POST['totalHarga'] as $key => $val) {
			$totalPembelian += $val;

			$data = array(
				'noTransaksi'		=> $noTransaksi,
				'tanggal'			=> date('Y-m-d'),
				'idSupp'			=> $idSupp,
				'keterangan'		=> $keterangan,
				'totalPembelian'	=> $totalPembelian,
			);
		}

		$simpan      = $this->db->insert('pembelian', $data);
		$idPembelian = $this->db->insert_id();
		
		foreach ($_POST['namaBarang'] as $key2 =>$val) :
			$data2[]	= array(
				'idPembelian'	=> $idPembelian,
				'namaBarang'	=> $_POST['namaBarang'][$key2],
				'kuantitas'		=> $_POST['kuantitas'][$key2],
				'harga'			=> $_POST['harga'][$key2],
				'totalHarga'	=> $_POST['totalHarga'][$key2],
			);
		endforeach;
		
		$this->db->insert_batch('pembelian_detail', $data2);
		$this->session->set_flashdata('berhasil_pembelian',
						'<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                        <script type ="text/JavaScript">  
                            swal("Berhasil","Data pembelian berhasil ditambahkan","success")  
                        </script>'  
                );
		redirect('transaksi/daftar_pembelian');
	}

	public function delete_pembelian($id){

		$this->db->delete('pembelian', array('idPembelian' => $id));
	}

}
