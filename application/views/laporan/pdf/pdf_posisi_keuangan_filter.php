<?php
defined('BASEPATH') or exit('No direct script access allowed');
// error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL


class RPDF extends FPDF
{
	// Page Header
	function Header()
	{
		if ($this->PageNo() == 1) {
			$this->SetFont('Arial', 'I', 9);
			$this->SetFillColor(255, 255, 255);
			$this->Cell(90, 6, '', 0, 0, 'L', 1);
			$this->Cell(100, 6, "Printed date : " . date('d-M-Y'), 0, 1, 'R', 1);
			$this->Line(10, $this->GetY(), 200, $this->GetY());
		} else {
			$this->SetFont('Arial', 'I', 9);
			$this->SetFillColor(255, 255, 255);
			$this->Cell(90, 6, "Laporan Laba Rugi", 0, 0, 'L', 1);
			$this->Cell(100, 6, "Printed date : " . date('d-M-Y'), 0, 1, 'R', 1);
		}
	}

	// Page Content
	function Content($jenis, $akun, $total_jenis, $total_aset, $total_liabilitas_ekuitas, $tgl)
	{
		if ($this->PageNo() == 1) {
			$this->Ln(3);
			$this->SetFont('Arial', 'B', 12);
			$this->SetFillColor(255, 255, 255);
			$this->Cell(0, 6, "TOKO ANITA", 0, 1, 'C', 1);
			$this->Cell(0, 6, "Laporan Posisi Keuangan", 0, 1, 'C', 1);
			$this->Cell(0, 6, date("d-M-Y",  strtotime($tgl['mulai'])) . ' s/d ' . date("d-M-Y",  strtotime($tgl['selesai'])), 0, 1, 'C', 1);
			$this->Ln(2);
		} else {
		}


		$this->SetLineWidth(0.8);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);

		$this->Ln(3);
		$this->SetFont('Arial', 'B', 15);
		$this->SetFillColor(255, 255, 255);
		$this->Cell(25, 6, 'Aset', 0, 1, 'L');
		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);
		$this->SetFont('Arial', '', 10);
		$this->Ln(3);
		$no = 0;
		foreach ($jenis as $jns) {
			if ($jns['id_tipeAkun'] == 3) {
				$this->Ln(3);
				$this->SetFont('Arial', 'B', 11);
				$this->SetFillColor(255, 255, 255);
				$this->SetX(15);
				$this->Cell(30, 6, $jns['namaJenis'], 0, 0, 'L');
				$this->Cell(80, 6, '', 0, 0, 'L');
				$this->Cell(50, 6, '', 0, 1, 'R');
				$this->SetFont('Arial', '', 10);
				$this->SetLineWidth(0.3);
				$this->Line(10, $this->GetY(), 200, $this->GetY());
				$this->SetLineWidth(0);
				$this->Ln(5);

				foreach ($akun as $ak) {
					if ($jns['idJenis'] == $ak['idJenis']) {
						$this->SetFont('Arial', '', 11);
						$this->SetFillColor(255, 255, 255);
						$this->SetX(15);
						$this->Cell(70, 6, $ak['namaAkun'], 0, 0, 'L');
						$this->Cell(75, 6, "Rp. " . number_format($ak['debit'] - $ak['kredit']), 0, 1, 'R');
						$this->SetFont('Arial', '', 10);
						$this->Ln(1);
					}
				}
				$this->SetLineWidth(0.3);
				$this->Line(10, $this->GetY(), 200, $this->GetY());
				$this->SetLineWidth(0);
				$this->SetFont('Arial', 'B', 11);
				$this->SetFillColor(255, 255, 255);
				$this->SetX(15);
				$this->Cell(100, 6, "Total " . $jns['namaJenis'], 0, 0, 'L');
				foreach ($total_jenis as $ttl_jns) {
					if ($jns['idJenis'] == $ttl_jns['idJenis']) {
						$this->Cell(60, 6, "Rp. " . number_format($ttl_jns['debit'] - $ttl_jns['kredit']), 0, 1, 'R');
					}
				}
				$this->SetFont('Arial', '', 10);
				$this->Ln(1);
				$this->SetLineWidth(0.6);
				$this->Line(10, $this->GetY()+6, 200, $this->GetY()+6);
				$this->SetLineWidth(0);
				$this->Ln(3);
			}
		}
		$this->Ln(3);
		$this->SetFont('Arial', 'B', 15);
		$this->SetFillColor(255, 255, 255);
		$this->Cell(50, 6, 'Total Aset', 0, 0, 'L');
		$this->Cell(70, 6, '', 0, 0, 'L');
		$this->Cell(70, 6, "Rp. " . number_format($total_aset), 0, 1, 'R');
		$this->Ln(6);
		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);
		$this->Ln(6);

		$this->Ln(3);
		$this->SetFont('Arial', 'B', 15);
		$this->SetFillColor(255, 255, 255);
		$this->Cell(25, 6, 'Liabilitas dan Ekuitas', 0, 1, 'L');
		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);
		$this->SetFont('Arial', '', 10);
		$this->Ln(3);
		$no = 0;
		foreach ($jenis as $jns) {
			if ($jns['id_tipeAkun'] == 4) {
				$this->Ln(3);
				$this->SetFont('Arial', 'B', 11);
				$this->SetFillColor(255, 255, 255);
				$this->SetX(15);
				$this->Cell(160, 6, $jns['namaJenis'], 0, 1, 'L');
				$this->SetFont('Arial', '', 10);
				$this->SetLineWidth(0.3);
				$this->Line(10, $this->GetY(), 200, $this->GetY());
				$this->SetLineWidth(0);
				$this->Ln(5);

				foreach ($akun as $ak) {
					if ($jns['idJenis'] == $ak['idJenis']) {
						$this->SetFont('Arial', '', 11);
						$this->SetFillColor(255, 255, 255);
						$this->SetX(15);
						$this->Cell(70, 6, $ak['namaAkun'], 0, 0, 'L');
						$this->Cell(75, 6, "Rp. " . number_format($ak['debit'] - $ak['kredit']), 0, 1, 'R');
						$this->SetFont('Arial', '', 10);
						$this->Ln(1);
					}
				}
				$this->SetLineWidth(0.3);
				$this->Line(10, $this->GetY(), 200, $this->GetY());
				$this->SetLineWidth(0);
				$this->SetFont('Arial', 'B', 11);
				$this->SetFillColor(255, 255, 255);
				$this->SetX(15);
				$this->Cell(100, 6, "Total " . $jns['namaJenis'], 0, 0, 'L');
				foreach ($total_jenis as $ttl_jns) {
					if ($jns['idJenis'] == $ttl_jns['idJenis']) {
						$this->Cell(60, 6, "Rp. " . number_format($ttl_jns['debit'] - $ttl_jns['kredit']), 0, 1, 'R');
					}
				}
				$this->SetFont('Arial', '', 10);
				$this->Ln(1);
				$this->SetLineWidth(0.6);
				$this->Line(10, $this->GetY()+6, 200, $this->GetY()+6);
				$this->SetLineWidth(0);
				$this->Ln(3);
			}
		}
		$this->Ln(3);
		$this->SetFont('Arial', 'B', 15);
		$this->SetFillColor(255, 255, 255);
		$this->Cell(50, 6, 'Total Liabilitas dan Ekuitas', 0, 0, 'L');
		$this->Cell(70, 6, '', 0, 0, 'L');
		$this->Cell(70, 6, "Rp. " . number_format($total_liabilitas_ekuitas), 0, 1, 'R');
		$this->Ln(6);
		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);
		$this->Ln(6);


		$no = 0;

		$this->Ln(3);
	}

	// Page Footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Buat Garis Horizontal
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		//Arial Italic 9
		$this->SetFont('Arial', 'I', 9);
		$this->Cell(0, 10, 'Copyright@' . date('Y'), 0, 0, 'L');
		//nomor halaman
		$this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'R');
	}
}

error_reporting(0);
$this->myfpdf = new RPDF();
$this->myfpdf->AliasNbPages();
$this->myfpdf->AddPage();
$this->myfpdf->SetTitle('LAPORAN POSISI KEUANGAN TOKO ANITA', true);
$this->myfpdf->Content($jenis, $akun, $total_jenis, $total_aset, $total_liabilitas_ekuitas, $tgl);
$this->myfpdf->Output('laporan-posisi-keuangan [' . date("d-M-Y",  strtotime($tgl['mulai'])) . ' s/d ' . date("d-M-Y",  strtotime($tgl['selesai'])) . '].pdf', 'I');
