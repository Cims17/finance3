<?php
defined('BASEPATH') or exit('No direct script access allowed');
// error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL


class RPDF extends FPDF{
	// Page Header
	function Header()
	{
        if ($this->PageNo() == 1) {
            $this->SetFont('Arial', 'I', 9);
            $this->SetFillColor(255, 255, 255);
            $this->Cell(90, 6, '', 0, 0, 'L', 1);
            $this->Cell(100, 6, "Printed date : " . date('d-M-Y'), 0, 1, 'R', 1);
            $this->Line(10, $this->GetY(), 200, $this->GetY());
        }else{
			$this->SetFont('Arial','I',9);
			$this->SetFillColor(255,255,255);
			$this->Cell(90,6,"Laporan Laba Rugi",0,0,'L',1);
			$this->Cell(100,6,"Printed date : " . date('d-M-Y'),0,1,'R',1);
		}
	}

	// Page Content
	function Content($jumlah_penjualan, $jumlah_pembelian, $jumlah_total, $tgl, $jenis, $akun, $total_hpp, $total_beban){
		$this->Ln(3);
		$this->SetFont('Arial', 'B', 12);
		$this->SetFillColor(255, 255, 255);
		$this->Cell(0, 6, "TOKO ANITA",0,1,'C',1);
		$this->Cell(0, 6, "Laporan Laba Rugi",0,1,'C',1);
		$this->Cell(0, 6, date("d-M-Y",  strtotime($tgl['mulai'])).' s/d '.date("d-M-Y",  strtotime($tgl['selesai'])),0,1,'C',1);
		$this->Ln(2);

		$this->SetLineWidth(0.8);
		$this->Line(10,$this->GetY(),200,$this->GetY());
		$this->SetLineWidth(0);
		
		$this->Ln(3);
		$this->SetFont('Arial', 'B', 12);
		$this->SetFillColor(255, 255, 255);
		$this->Cell(25,6,'Pendapatan',0,1,'L');
		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);
		$this->SetFont('Arial','',10);
		$this->Ln(3);
		$no=0;
		foreach ($jumlah_penjualan as $jml_pjl);
			$this->SetFont('Arial', '', 11);
			$this->SetFillColor(255, 255, 255);
			$this->SetX(25);
			$this->Cell(70,6,'Pendapatan',0,0,'L');
			$this->Cell(90,6,"Rp. ". number_format($jml_pjl['totalPenjualan']),0,1,'R');
			$this->SetFont('Arial','',10);
			$this->Ln(1);

		foreach ($jenis as $jns){
            if ($jns['id_tipeAkun'] == 5) {
                foreach ($akun as $ak) {
                    if ($jns['idJenis'] == $ak['idJenis']) {
                        $this->SetFont('Arial', '', 11);
                        $this->SetFillColor(255, 255, 255);
                        $this->SetX(25);
                        $this->Cell(70, 6, $ak['namaAkun'], 0, 0, 'L');
                        $this->Cell(90, 6, "Rp. ". number_format($ak['debit'] - $ak['kredit']), 0, 1, 'R');
                        $this->SetFont('Arial', '', 10);
                        $this->Ln(1);
                    }
                }
            }
		}

		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);

		$this->Ln(3);
		$this->SetFont('Arial', 'B', 12);
		$this->SetFillColor(255, 255, 255);
		$this->Cell(50,6,'Laba Kotor',0,0,'L');
		$this->Cell(70,6,'',0,0,'L');
		$this->Cell(70,6,"Rp. ". number_format($jml_pjl['totalPenjualan'] - $total_hpp),0,1,'R');
		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);

		$this->Ln(3);
		$this->SetFont('Arial', 'B', 12);
		$this->SetFillColor(255, 255, 255);
		$this->Cell(25,6,'Beban',0,1,'L');
		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);
		$this->SetFont('Arial','',10);
		$this->Ln(3);
		$no=0;
		foreach ($jumlah_pembelian as $jml_pbl);
			$this->SetFont('Arial', '', 11);
			$this->SetFillColor(255, 255, 255);
			$this->SetX(25);
			$this->Cell(70,6,'Pembelian',0,0,'L');
			$this->Cell(90,6,"Rp. ". number_format($jml_pbl['totalPembelian']),0,1,'R');
			$this->SetFont('Arial','',10);
			$this->Ln(1);

		foreach ($jenis as $jns){
            if ($jns['id_tipeAkun'] == 2) {
                foreach ($akun as $ak) {
                    if ($jns['idJenis'] == $ak['idJenis']) {
                        $this->SetFont('Arial', '', 11);
                        $this->SetFillColor(255, 255, 255);
                        $this->SetX(25);
                        $this->Cell(70, 6, $ak['namaAkun'], 0, 0, 'L');
                        $this->Cell(90, 6, "Rp. ". number_format($ak['debit'] - $ak['kredit']), 0, 1, 'R');
                        $this->SetFont('Arial', '', 10);
                        $this->Ln(1);
                    }
                }
            }
		}

		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);

		$this->Ln(3);
		$this->SetFont('Arial', 'B', 12);
		$this->SetFillColor(255, 255, 255);
		$this->Cell(50,6,'Total Beban',0,0,'L');
		$this->Cell(70,6,'',0,0,'L');
		$this->Cell(70,6,"Rp. ". number_format($jml_pbl['totalPembelian'] + $total_beban),0,1,'R');
		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);

		$this->Ln(3);
		$this->SetFont('Arial', 'B', 12);
		$this->SetFillColor(255, 255, 255);
		$this->Cell(50,6,'Laba / Rugi Bersih',0,0,'L');
		$this->Cell(70,6,'',0,0,'L');
		$this->Cell(70,6,"Rp. ". number_format(($jml_pjl['totalPenjualan'] - $total_hpp) - ($jml_pbl['totalPembelian'] + $total_beban)),0,1,'R');
		$this->SetLineWidth(0.6);
		$this->Line(10, $this->GetY(), 200, $this->GetY());
		$this->SetLineWidth(0);
	}

	// Page Footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Buat Garis Horizontal
		$this->Line(10,$this->GetY(),200,$this->GetY());
		//Arial Italic 9
		$this->SetFont('Arial', 'I', 9);
		$this->Cell(0,10,'Copyright@'.date('Y'),0,0,'L');
		//nomor halaman
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');

	}
}

error_reporting(0);
$this->myfpdf = new RPDF();
$this->myfpdf->AliasNbPages();
$this->myfpdf->AddPage();
$this->myfpdf->SetTitle('LAPORAN LABA RUGI TOKO ANITA',true);
$this->myfpdf->Content($jumlah_penjualan, $jumlah_pembelian, $jumlah_total, $tgl, $jenis, $akun, $total_hpp, $total_beban );
$this->myfpdf->Output('laporan-laba-rugi ['.date("d-M-Y",  strtotime($tgl['mulai'])).' s/d '.date("d-M-Y",  strtotime($tgl['selesai'])).'].pdf','I');
?>
