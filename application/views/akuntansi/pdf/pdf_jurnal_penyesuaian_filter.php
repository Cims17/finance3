<?php
defined('BASEPATH') or exit('No direct script access allowed');
// error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL


class RPDF extends FPDF
{
	// Page Header

	private $widths;
	private $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths = $w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns = $a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++)
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h = 7 * $nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			//Draw the border
			$this->Rect($x, $y, $w, $h);
			//Print the text
			$this->MultiCell($w, 7, $data[$i], 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if ($this->GetY() + $h > $this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w, $txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw = &$this->CurrentFont['cw'];
		if ($w == 0)
			$w = $this->w - $this->rMargin - $this->x;
		$wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 and $s[$nb - 1] == "\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while ($i < $nb) {
			$c = $s[$i];
			if ($c == "\n") {
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
				continue;
			}
			if ($c == ' ')
				$sep = $i;
			$l += $cw[$c];
			if ($l > $wmax) {
				if ($sep == -1) {
					if ($i == $j)
						$i++;
				} else
					$i = $sep + 1;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
			} else
				$i++;
		}
		return $nl;
	}

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
			$this->Cell(90, 6, "Jurnal penyesuaian", 0, 0, 'L', 1);
			$this->Cell(100, 6, "Printed date : " . date('d-M-Y'), 0, 1, 'R', 1);
		}
	}

	// Page Content
	function Content($penyesuaian,$tgl,$jumlah_total_debit,$jumlah_total_kredit)
	{
		$border = 0;
		//   $this->AddPage();
		$this->SetAutoPageBreak(true, 60);
		$this->AliasNbPages();
		$left = 25;

		//header
		if ($this->PageNo() == 1) {

			$this->Ln(3);
			$this->SetFont('Arial', 'B', 14);
			$this->SetFillColor(255, 255, 255);
			$this->Cell(0, 6, "TOKO ANITA", 0, 1, 'C', 1);
			$this->Cell(0, 6, "Jurnal Penyesuaian", 0, 1, 'C', 1);
			$this->Cell(0, 6, date("d-M-Y",  strtotime($tgl['mulai'])).' s/d '.date("d-M-Y",  strtotime($tgl['selesai'])),0,1,'C',1);
			$this->Ln(2);

			$this->SetLineWidth(0.8);
			$this->Line(10, $this->GetY(), 200, $this->GetY());
			$this->SetLineWidth(0);
		} else {
		}

		$this->Ln(3);
		$h = 6;
		$left = 40;
		$top = 80;
		#tableheader
		$this->SetFont('Arial', 'B', 10);
		$this->SetFillColor(255);
		$left = $this->GetX();
		$this->Cell(25, $h, 'Tanggal', 1, 0, 'C', true);
		$this->SetX($left += 25);
		$this->Cell(25, $h, 'Kode Akun', 1, 0, 'C', true);
		$this->SetX($left += 25);
		$this->Cell(30, $h, 'Nama Akun', 1, 0, 'C', true);
		$this->SetX($left += 30);
		$this->Cell(50, $h, 'Keterangan', 1, 0, 'C', true);
		$this->SetX($left += 50);
		$this->Cell(30, $h, 'Debit', 1, 0, 'C', true);
		$this->SetX($left += 30);
		$this->Cell(30, $h, 'Kredit', 1, 1, 'C', true);
		//$this->Ln(20);

		$this->SetFont('Arial', '', 10);
		$this->SetWidths(array(25, 25, 30, 50, 30, 30));
		$this->SetAligns(array('C', 'C', 'L', 'L', 'R', 'R'));
		$no = 1;
		$this->SetFillColor(255);
		foreach ($penyesuaian as $ps) {
			$this->Row(
				array(
					$ps['tanggal'],
					$ps['kodeAkun'],
					$ps['namaAkun'],
					$ps['keterangan'],
					"Rp.". number_format($ps['debit']),
					"Rp.". number_format($ps['kredit'])
				)
			);
		}
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(130, $h, 'Jumlah Total', 1, 0, 'R', true);
		$this->Cell(30, $h, "Rp.". number_format($jumlah_total_debit), 1, 0, 'R', true);
		$this->Cell(30, $h, "Rp.". number_format($jumlah_total_kredit), 1, 0, 'R', true);
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
$this->myfpdf->SetTitle('LAPORAN JURNAL PENYESUAIAN TOKO ANITA', true);
$this->myfpdf->Content($penyesuaian,$tgl,$jumlah_total_debit,$jumlah_total_kredit);
$this->myfpdf->Output('laporan-jurnal-penyesuaian-toko-anita ['.date("d-M-Y",  strtotime($tgl['mulai'])).' s/d '.date("d-M-Y",  strtotime($tgl['selesai'])).'].pdf', 'I');
