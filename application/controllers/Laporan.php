<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Laporan extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('myfpdf');
		if ($this->session->userdata('idUser') == null) {
			redirect('login');
		}
	}

	public function laporan_laba_rugi()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');

		if ($mulai) {
			$data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan_filter($selesai, $mulai)->result_array();
			$data['jumlah_pembelian']   = $this->Model_laporan->total_pembelian_filter($selesai, $mulai)->result_array();
			$data['total_jenis']		= $this->Model_laporan->get_posisi_keuangan_totaljenis($mulai, $selesai)->result_array();
			$data['jenis']	= $this->Model_akun->get_jenis_akun()->result_array();
			$data['akun']	= $this->Model_laporan->get_posisi_keuangan($mulai, $selesai)->result_array();
			$data['tgl'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai
			);

			// total tipe akun aset
			$data['debit_beban'] =array();
			$data['kredit_beban'] =array();
			$data['debit_hpp'] =array();
			$data['kredit_hpp'] =array();
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 2) {
                    array_push($data['debit_beban'], $ttl_jns['debit']);
					array_push($data['kredit_beban'], $ttl_jns['kredit']);
                }
			}

			//total tipe aku HPP
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 5) {
                    array_push($data['debit_hpp'], $ttl_jns['debit']);
					array_push($data['kredit_hpp'], $ttl_jns['kredit']);
                }
			}

			$data['total_beban'] =array_sum($data['debit_beban']) - array_sum($data['kredit_beban']);

			//HPP

			// $barang						= $this->Model_laporan->get_stok_barang()->row();
			// $penjualan		= $this->Model_laporan->get_stok_penjualan()->row();
			// $stokpenjualanfilter		= $this->Model_laporan->get_stok_penjualanfilter($mulai,$selesai)->row();
			// $pembelian		= $this->Model_laporan->get_pembelianfilter($mulai,$selesai)->row();
			// $stokpenjualansebelum		= $this->Model_laporan->get_stok_penjualansebelum($selesai)->row();

			// $total_awal  = ($barang->stok + $stokpenjualansebelum->kuantitas) * $barang->harga ;
			// $total_pembelian = $pembelian->totalPembelian;
			// $total_akhir = ($barang->stok + $penjualan->kuantitas - $stokpenjualansebelum->kuantitas )* $barang->harga;

			// $data['total_hpp'] = $total_awal +$total_pembelian-$total_akhir;

			$data['total_hpp'] =array_sum($data['debit_hpp']) - array_sum($data['kredit_hpp']);

			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('laporan/laba_rugi', $data);
			$this->load->view('template/footer');
		} else {
			$data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan()->result_array();
			$data['jumlah_pembelian']   = $this->Model_laporan->total_pembelian()->result_array();
			$data['total_jenis']		= $this->Model_laporan->get_posisi_keuangan_totaljenis_all()->result_array();
			$data['jenis']	= $this->Model_akun->get_jenis_akun()->result_array();
			$data['akun']	= $this->Model_laporan->get_posisi_keuangan_all()->result_array();
			$data['tgl'] = array(
				'mulai'      => '0000-00-00',
				'selesai'       => '0000-00-00'
			);

			// total tipe akun aset
			$data['debit_beban'] =array();
			$data['kredit_beban'] =array();
			$data['debit_hpp'] =array();
			$data['kredit_hpp'] =array();
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 2) {
                    array_push($data['debit_beban'], $ttl_jns['debit']);
					array_push($data['kredit_beban'], $ttl_jns['kredit']);
                }
			}

			//total tipe aku HPP
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 5) {
                    array_push($data['debit_hpp'], $ttl_jns['debit']);
					array_push($data['kredit_hpp'], $ttl_jns['kredit']);
                }
			}

			$data['total_beban'] =array_sum($data['debit_beban']) - array_sum($data['kredit_beban']);
			$data['total_hpp'] =array_sum($data['debit_hpp']) - array_sum($data['kredit_hpp']);

			
			// $barang		= $this->Model_laporan->get_stok_barang()->row();
			// $penjualan		= $this->Model_laporan->get_stok_penjualan()->row();
			// $pembelian		= $this->Model_laporan->get_pembelian()->row();

			// $total_awal  = ($barang->stok + $penjualan->kuantitas) * $barang->harga ;
			// $total_pembelian = $pembelian->totalPembelian;
			// $total_akhir = $barang->stok * $barang->harga;

			// $data['total_hpp'] = $total_awal +$total_pembelian-$total_akhir;

			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('laporan/laba_rugi', $data);
			$this->load->view('template/footer');
		}


		// $data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan()->result_array();
		// $data['jumlah_pembelian']   = $this->Model_laporan->total_pembelian()->result_array();

		// $this->load->view('template/header');
		// $this->load->view('template/sidebar');
		// $this->load->view('laporan/laba_rugi',$data);
		// $this->load->view('template/footer');
	}

	public function laporanpdf_laba_rugi()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');

		if ($mulai) {
			$data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan_filter($selesai, $mulai)->result_array();
			$data['jumlah_pembelian']   = $this->Model_laporan->total_pembelian_filter($selesai, $mulai)->result_array();
			$data['total_jenis']		= $this->Model_laporan->get_posisi_keuangan_totaljenis($mulai, $selesai)->result_array();
			$data['jenis']	= $this->Model_akun->get_jenis_akun()->result_array();
			$data['akun']	= $this->Model_laporan->get_posisi_keuangan($mulai, $selesai)->result_array();
			$data['tgl'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai
			);

			// total tipe akun aset
			$data['debit_beban'] =array();
			$data['kredit_beban'] =array();
			$data['debit_hpp'] =array();
			$data['kredit_hpp'] =array();
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 2) {
                    array_push($data['debit_beban'], $ttl_jns['debit']);
					array_push($data['kredit_beban'], $ttl_jns['kredit']);
                }
			}

			//total tipe aku HPP
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 5) {
                    array_push($data['debit_hpp'], $ttl_jns['debit']);
					array_push($data['kredit_hpp'], $ttl_jns['kredit']);
                }
			}

			$data['total_beban'] =array_sum($data['debit_beban']) - array_sum($data['kredit_beban']);
			$data['total_hpp'] =array_sum($data['debit_hpp']) - array_sum($data['kredit_hpp']);

			$this->load->view('laporan/pdf/pdf_laba_rugi_filter', $data);

		} else {
			$data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan()->result_array();
			$data['jumlah_pembelian']   = $this->Model_laporan->total_pembelian()->result_array();
			$data['total_jenis']		= $this->Model_laporan->get_posisi_keuangan_totaljenis_all()->result_array();
			$data['jenis']	= $this->Model_akun->get_jenis_akun()->result_array();
			$data['akun']	= $this->Model_laporan->get_posisi_keuangan_all()->result_array();
			$data['tgl'] = array(
				'mulai'      => '0000-00-00',
				'selesai'       => '0000-00-00'
			);

			// total tipe akun aset
			$data['debit_beban'] =array();
			$data['kredit_beban'] =array();
			$data['debit_hpp'] =array();
			$data['kredit_hpp'] =array();
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 2) {
                    array_push($data['debit_beban'], $ttl_jns['debit']);
					array_push($data['kredit_beban'], $ttl_jns['kredit']);
                }
			}

			//total tipe aku HPP
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 5) {
                    array_push($data['debit_hpp'], $ttl_jns['debit']);
					array_push($data['kredit_hpp'], $ttl_jns['kredit']);
                }
			}

			$data['total_beban'] =array_sum($data['debit_beban']) - array_sum($data['kredit_beban']);
			$data['total_hpp'] =array_sum($data['debit_hpp']) - array_sum($data['kredit_hpp']);

			$this->load->view('laporan/pdf/pdf_laba_rugi_filter', $data);
		}


		// $data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan()->result_array();
		// $data['jumlah_pembelian']   = $this->Model_laporan->total_pembelian()->result_array();

		// $this->load->view('template/header');
		// $this->load->view('template/sidebar');
		// $this->load->view('laporan/laba_rugi',$data);
		// $this->load->view('template/footer');
	}

	public function laporan_posisi_keuangan()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');
		if (!$mulai) {
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('laporan/posisi_keuangan');
			$this->load->view('template/footer');
		} else {
			$data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan_filter($selesai, $mulai)->result_array();
			$data['total_jenis']	= $this->Model_laporan->get_posisi_keuangan_totaljenis($mulai, $selesai)->result_array();
			$data['total_tipe']	= $this->Model_laporan->get_posisi_keuangan_totaltipe($mulai, $selesai)->result_array();

			// print_r($data['jumlah_penjualan']);
			// die();

			// total tipe akun aset
			$data['debit_aset'] =array();
			$data['kredit_aset'] =array();
			$data['debit_liabilitas_ekuitas'] =array();
			$data['kredit_liabilitas_ekuitas'] =array();
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 3) {
                    array_push($data['debit_aset'], $ttl_jns['debit']);
					array_push($data['kredit_aset'], $ttl_jns['kredit']);
                }
			}

			$data['total_aset'] =array_sum($data['debit_aset']) - array_sum($data['kredit_aset']);

			//total tipe aku liabilitas dan ekuitas
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 4) {
                    array_push($data['debit_liabilitas_ekuitas'], $ttl_jns['debit']);
					array_push($data['kredit_liabilitas_ekuitas'], $ttl_jns['kredit']);
                }
			}

			$data['total_liabilitas_ekuitas'] =array_sum($data['debit_liabilitas_ekuitas']) - array_sum($data['kredit_liabilitas_ekuitas']);


			// Menghitung laba/rugi bersihhhh
			// total tipe akun aset
			$data['debit_beban'] =array();
			$data['kredit_beban'] =array();
			$data['debit_hpp'] =array();
			$data['kredit_hpp'] =array();
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 2) {
                    array_push($data['debit_beban'], $ttl_jns['debit']);
					array_push($data['kredit_beban'], $ttl_jns['kredit']);
                }
			}

			//total tipe aku HPP
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 5) {
                    array_push($data['debit_hpp'], $ttl_jns['debit']);
					array_push($data['kredit_hpp'], $ttl_jns['kredit']);
                }
			}

			$data['total_beban'] =array_sum($data['debit_beban']) - array_sum($data['kredit_beban']);
			$data['total_hpp'] =array_sum($data['debit_hpp']) - array_sum($data['kredit_hpp']);
			$data['ttl_pjl']=array_sum(array_column($data['jumlah_penjualan'],'totalPenjualan'));
			$data['laba_rugi_bersih'] = ($data['ttl_pjl'] - $data['total_hpp']) -  $data['total_beban'];

			$data['akun']	= $this->Model_laporan->get_posisi_keuangan($mulai, $selesai)->result_array();
			$data['jenis']	= $this->Model_akun->get_jenis_akun()->result_array();
			$data['tipe']	= $this->Model_akun->get_tipe_akun()->result_array();

			$data['nama'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai,
			);

			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('laporan/posisi_keuangan_filter', $data);
			$this->load->view('template/footer');
		}
	}

	public function laporanpdf_posisi_keuangan()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');
		if (!$mulai) {
			$this->load->view('laporan/pdf/pdf_posisi_keuangan_filter');
		} else {
			$data['jumlah_penjualan']   = $this->Model_laporan->total_penjualan_filter($selesai, $mulai)->result_array();
			$data['total_jenis']	= $this->Model_laporan->get_posisi_keuangan_totaljenis($mulai, $selesai)->result_array();
			$data['total_tipe']	= $this->Model_laporan->get_posisi_keuangan_totaltipe($mulai, $selesai)->result_array();

			// total tipe akun aset
			$data['debit_aset'] =array();
			$data['kredit_aset'] =array();
			$data['debit_liabilitas_ekuitas'] =array();
			$data['kredit_liabilitas_ekuitas'] =array();
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 3) {
                    array_push($data['debit_aset'], $ttl_jns['debit']);
					array_push($data['kredit_aset'], $ttl_jns['kredit']);
                }
			}

			$data['total_aset'] =array_sum($data['debit_aset']) - array_sum($data['kredit_aset']);

			//total tipe aku liabilitas dan ekuitas
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 4) {
                    array_push($data['debit_liabilitas_ekuitas'], $ttl_jns['debit']);
					array_push($data['kredit_liabilitas_ekuitas'], $ttl_jns['kredit']);
                }
			}

			$data['total_liabilitas_ekuitas'] =array_sum($data['debit_liabilitas_ekuitas']) - array_sum($data['kredit_liabilitas_ekuitas']);


			// Menghitung laba/rugi bersihhhh
			// total tipe akun aset
			$data['debit_beban'] =array();
			$data['kredit_beban'] =array();
			$data['debit_hpp'] =array();
			$data['kredit_hpp'] =array();
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 2) {
                    array_push($data['debit_beban'], $ttl_jns['debit']);
					array_push($data['kredit_beban'], $ttl_jns['kredit']);
                }
			}

			//total tipe aku HPP
			foreach ($data['total_jenis'] as $ttl_jns) {
                if ($ttl_jns['id_tipeAkun'] == 5) {
                    array_push($data['debit_hpp'], $ttl_jns['debit']);
					array_push($data['kredit_hpp'], $ttl_jns['kredit']);
                }
			}

			$data['total_beban'] =array_sum($data['debit_beban']) - array_sum($data['kredit_beban']);
			$data['total_hpp'] =array_sum($data['debit_hpp']) - array_sum($data['kredit_hpp']);
			$data['ttl_pjl']=array_sum(array_column($data['jumlah_penjualan'],'totalPenjualan'));
			$data['laba_rugi_bersih'] = ($data['ttl_pjl'] - $data['total_hpp']) -  $data['total_beban'];

			$data['akun']	= $this->Model_laporan->get_posisi_keuangan($mulai, $selesai)->result_array();
			$data['jenis']	= $this->Model_akun->get_jenis_akun()->result_array();
			$data['tipe']	= $this->Model_akun->get_tipe_akun()->result_array();

			$data['tgl'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai,
			);
			$this->load->view('laporan/pdf/pdf_posisi_keuangan_filter', $data);
		}
	}


	public function laporan_posisi_keuangan_filter()
	{
		$mulai = $this->input->post('mulai');
		$selesai = $this->input->post('selesai');
		if (!$mulai) {
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('laporan/posisi_keuangan');
			$this->load->view('template/footer');
		} else {
			$data['total_jenis']	= $this->Model_laporan->get_posisi_keuangan_totaljenis($mulai, $selesai)->result_array();
			$data['akun']	= $this->Model_laporan->get_posisi_keuangan($mulai, $selesai)->result_array();
			$data['jenis']	= $this->Model_akun->get_jenis_akun()->result_array();
			$data['tipe']	= $this->Model_akun->get_tipe_akun()->result_array();

			$data['nama'] = array(
				'mulai'      => $mulai,
				'selesai'       => $selesai,
			);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('laporan/posisi_keuangan_filter', $data);
			$this->load->view('template/footer');
		}
	}

	// public function export()
	// {
	// 	$id = $this->session->userdata('idUser');
	// 	$transaksi = $this->Model_transaksi->get_transaksi($id)->result();
	// 	$spreadsheet = new Spreadsheet;
	// 	$spreadsheet->getActiveSheet()->setCellValue('B1', "Laporan Daftar Transaksi");
	// 	$spreadsheet->getActiveSheet()->mergeCells("B1:G1");
	// 	$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
	// 	$spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
	// 	$spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setSize(18)->setBold(true);
	// 	$spreadsheet->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
	// 	$spreadsheet->getActiveSheet()->getStyle('B1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

	// 	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
	// 	$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(4);
	// 	$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(18);
	// 	$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(17);
	// 	$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(19);
	// 	$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(24);
	// 	$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(16);

	// 	$spreadsheet->setActiveSheetIndex(0)
	// 		->setCellValue('B2', 'No')
	// 		->setCellValue('C2', 'Transaksi')
	// 		->setCellValue('D2', 'Jenis Transaksi')
	// 		->setCellValue('E2', 'Tanggal')
	// 		->setCellValue('F2', 'Jumlah')
	// 		->setCellValue('G2', 'Tipe');
	// 	$spreadsheet->getActiveSheet()->getStyle('B2:G2')->getFont()->setBold(true);

	// 	$styleArray = array(
	// 		'borders' => array(
	// 			'allBorders' => array(
	// 				'borderStyle' => Border::BORDER_THIN,
	// 				'color' => array('argb' => '00000000'),
	// 			),
	// 		),
	// 		'fill' => array(
	// 			'fillType' => Fill::FILL_SOLID,
	// 			'startColor' => array('argb' => 'FF87CEEB')
	// 		),
	// 		'alignment' => [
	// 			'vertical' => Alignment::VERTICAL_CENTER,
	// 			'horizontal' => Alignment::HORIZONTAL_CENTER,
	// 		],
	// 	);
	// 	$styleArray2 = array(
	// 		'borders' => array(
	// 			'allBorders' => array(
	// 				'borderStyle' => Border::BORDER_THIN,
	// 				'color' => array('argb' => '00000000'),
	// 			),
	// 		),
	// 		'fill' => array(
	// 			'fillType' => Fill::FILL_SOLID,
	// 			'startColor' => array('argb' => 'FFE0FFFF')
	// 		),
	// 		'alignment' => [
	// 			'vertical' => Alignment::VERTICAL_CENTER,
	// 			'horizontal' => Alignment::HORIZONTAL_CENTER,
	// 		],
	// 		'numberFormat' => [
	// 			'formatCode' => NumberFormat::FORMAT_CURRENCY_EUR
	// 		]
	// 	);
	// 	$styleArray4 = array(
	// 		'borders' => array(
	// 			'allBorders' => array(
	// 				'borderStyle' => Border::BORDER_THIN,
	// 				'color' => array('argb' => '00000000'),
	// 			),
	// 		),
	// 		'fill' => array(
	// 			'fillType' => Fill::FILL_SOLID,
	// 			'startColor' => array('argb' => 'FFE0FFFF')
	// 		),
	// 		'alignment' => [
	// 			'vertical' => Alignment::VERTICAL_CENTER,
	// 			'horizontal' => Alignment::HORIZONTAL_CENTER,
	// 		],
	// 	);
	// 	$styleArray3 = array(
	// 		'borders' => array(
	// 			'allBorders' => array(
	// 				'borderStyle' => Border::BORDER_THIN,
	// 				'color' => array('argb' => '00000000'),
	// 			),
	// 		),
	// 		'fill' => array(
	// 			'fillType' => Fill::FILL_SOLID,
	// 			'startColor' => array('argb' => 'FFFFFF00')
	// 		),
	// 		'alignment' => [
	// 			'vertical' => Alignment::VERTICAL_CENTER,
	// 			'horizontal' => Alignment::HORIZONTAL_CENTER,
	// 		],
	// 		'numberFormat' => [
	// 			'formatCode' => NumberFormat::FORMAT_CURRENCY_EUR
	// 		]
	// 	);
	// 	$spreadsheet->getActiveSheet()->getStyle('B2:G2')->applyFromArray($styleArray);
	// 	$kolom = 3;
	// 	$nomor = 1;
	// 	foreach ($transaksi as $pengguna) {
	// 		$spreadsheet->setActiveSheetIndex(0)
	// 			->setCellValue('B' . $kolom, $nomor)
	// 			->setCellValue('C' . $kolom, $pengguna->judul)
	// 			->setCellValue('D' . $kolom, $pengguna->jenis_transaksi)
	// 			->setCellValue('E' . $kolom, $pengguna->tanggal)
	// 			->setCellValue('F' . $kolom, $pengguna->jumlah)
	// 			->setCellValue('G' . $kolom, $pengguna->tipe_transaksi);
	// 		$spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':G' . $kolom)->applyFromArray($styleArray2);
	// 		$spreadsheet->getActiveSheet()->getStyle('B' . $kolom)->applyFromArray($styleArray4);
	// 		$kolom++;
	// 		$nomor++;
	// 	}
	// 	$kolom2 = $kolom + 1;
	// 	$kolom3 = $kolom2 + 1;
	// 	$spreadsheet->setActiveSheetIndex(0)
	// 		->setCellValue('B' . $kolom2, $nomor);
	// 	$spreadsheet->getActiveSheet()->setCellValue('B' . $kolom2, "Total Transaksi");
	// 	$spreadsheet->getActiveSheet()->mergeCells('B' . $kolom2 . ':G' . $kolom2);
	// 	$spreadsheet->getActiveSheet()->getRowDimension($kolom2)->setRowHeight(40);
	// 	$spreadsheet->getActiveSheet()->getStyle('B' . $kolom2)->getFont()->setSize(18)->setBold(true);
	// 	$spreadsheet->getActiveSheet()->getStyle('B' . $kolom2)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
	// 	$spreadsheet->getActiveSheet()->getStyle('B' . $kolom2)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
	// 	$spreadsheet->getActiveSheet()->setCellValue('B' . $kolom3, "No");
	// 	$spreadsheet->getActiveSheet()->setCellValue('C' . $kolom3, "Jenis");
	// 	$spreadsheet->getActiveSheet()->mergeCells('C' . $kolom3 . ':D' . $kolom3);
	// 	$spreadsheet->getActiveSheet()->setCellValue('E' . $kolom3, "Jumlah");
	// 	$spreadsheet->getActiveSheet()->getRowDimension($kolom3)->setRowHeight(20);
	// 	$spreadsheet->getActiveSheet()->mergeCells('E' . $kolom3 . ':G' . $kolom3);

	// 	$spreadsheet->getActiveSheet()->getStyle('B' . $kolom3 . ':G' . $kolom3)->getFont()->setBold(true);
	// 	$spreadsheet->getActiveSheet()->getStyle('B' . $kolom3 . ':G' . $kolom3)->applyFromArray($styleArray);
	// 	$kolom4 = $kolom3 +1;
	// 	$kolom5 = $kolom4 +1;
	// 	$kolom6 = $kolom5 +1;
	// 	$spreadsheet->getActiveSheet()->setCellValue('B' . $kolom4, "1");
	// 	$spreadsheet->getActiveSheet()->setCellValue('B' . $kolom5, "2");
	// 	$spreadsheet->getActiveSheet()->setCellValue('C' . $kolom4, "Pengeluaran");
	// 	$spreadsheet->getActiveSheet()->setCellValue('C' . $kolom5, "Pemasukan");
	// 	$spreadsheet->getActiveSheet()->getStyle('C' . $kolom4 . ':G' . $kolom4)->applyFromArray($styleArray2);
	// 	$spreadsheet->getActiveSheet()->getStyle('C' . $kolom5 . ':G' . $kolom5)->applyFromArray($styleArray2);
	// 	$spreadsheet->getActiveSheet()->getStyle('B' . $kolom4 )->applyFromArray($styleArray4);
	// 	$spreadsheet->getActiveSheet()->getStyle('B' . $kolom5 )->applyFromArray($styleArray4);
	// 	$spreadsheet->getActiveSheet()->mergeCells('C' . $kolom4 . ':D' . $kolom4);
	// 	$spreadsheet->getActiveSheet()->mergeCells('E' . $kolom4 . ':G' . $kolom4);
	// 	$spreadsheet->getActiveSheet()->mergeCells('C' . $kolom5 . ':D' . $kolom5);
	// 	$spreadsheet->getActiveSheet()->mergeCells('E' . $kolom5 . ':G' . $kolom5);
	// 	$spreadsheet->getActiveSheet()->mergeCells('C' . $kolom6 . ':D' . $kolom6);
	// 	$spreadsheet->getActiveSheet()->getStyle('C' . $kolom6)->getFont()->setBold(true);
	// 	$spreadsheet->getActiveSheet()->setCellValue('C' . $kolom6, "TOTAL SALDO");
	// 	$spreadsheet->getActiveSheet()->mergeCells('E' . $kolom6 . ':G' . $kolom6);
	// 	$spreadsheet->getActiveSheet()->getStyle('C' . $kolom6 . ':G' . $kolom6)->applyFromArray($styleArray3);
	// 	$pengeluaran= $this->Model_laporan->get_pengeluaran($id)->row();
	// 	$pemasukan = $this->Model_laporan->get_pemasukan($id)->row();

	// 	if($pengeluaran->jumlah){
	// 		$spreadsheet->getActiveSheet()->setCellValue('E' . $kolom4, $pengeluaran->jumlah);
	// 	}else{
	// 		$spreadsheet->getActiveSheet()->setCellValue('E' . $kolom4, "0");
	// 	}
	// 	if($pemasukan->jumlah){

	// 		$spreadsheet->getActiveSheet()->setCellValue('E' . $kolom5, $pemasukan->jumlah);
	// 	}else{
	// 		$spreadsheet->getActiveSheet()->setCellValue('E' . $kolom5, "0");
	// 	}
	// 	$sal = $this->Model_dashboard->get_data($id)->row();
	// 	$spreadsheet->getActiveSheet()->setCellValue('E' . $kolom6, ''. $sal->saldo);
	// 	$writer = new Xlsx($spreadsheet);

	// 	header('Content-Type: application/vnd.ms-excel');
	// 	header('Content-Disposition: attachment;filename="Laporan.xlsx"');
	// 	header('Cache-Control: max-age=0');

	// 	$writer->save('php://output');
	// }
}
