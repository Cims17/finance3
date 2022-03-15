<?php
defined('BASEPATH') or exit('No direct script access allowed');
// error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL


class RPDF extends FPDF{
	// Page Header

private $widths;
  private $aligns;

  function SetWidths($w)
  {
	  //Set the array of column widths
	  $this->widths=$w;
  }

  function SetAligns($a)
  {
	  //Set the array of column alignments
	  $this->aligns=$a;
  }

  function Row($data)
  {
	  //Calculate the height of the row
	  $nb=0;
	  for($i=0;$i<count($data);$i++)
		  $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	  $h=10*$nb;
	  //Issue a page break first if needed
	  $this->CheckPageBreak($h);
	  //Draw the cells of the row
	  for($i=0;$i<count($data);$i++)
	  {
		  $w=$this->widths[$i];
		  $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		  //Save the current position
		  $x=$this->GetX();
		  $y=$this->GetY();
		  //Draw the border
		  $this->Rect($x,$y,$w,$h);
		  //Print the text
		  $this->MultiCell($w,10,$data[$i],0,$a);
		  //Put the position to the right of the cell
		  $this->SetXY($x+$w,$y);
	  }
	  //Go to the next line
	  $this->Ln($h);
  }

  function CheckPageBreak($h)
  {
	  //If the height h would cause an overflow, add a new page immediately
	  if($this->GetY()+$h>$this->PageBreakTrigger)
		  $this->AddPage($this->CurOrientation);
  }

  function NbLines($w,$txt)
  {
	  //Computes the number of lines a MultiCell of width w will take
	  $cw=&$this->CurrentFont['cw'];
	  if($w==0)
		  $w=$this->w-$this->rMargin-$this->x;
	  $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	  $s=str_replace("\r",'',$txt);
	  $nb=strlen($s);
	  if($nb>0 and $s[$nb-1]=="\n")
		  $nb--;
	  $sep=-1;
	  $i=0;
	  $j=0;
	  $l=0;
	  $nl=1;
	  while($i<$nb)
	  {
		  $c=$s[$i];
		  if($c=="\n")
		  {
			  $i++;
			  $sep=-1;
			  $j=$i;
			  $l=0;
			  $nl++;
			  continue;
		  }
		  if($c==' ')
			  $sep=$i;
		  $l+=$cw[$c];
		  if($l>$wmax)
		  {
			  if($sep==-1)
			  {
				  if($i==$j)
					  $i++;
			  }
			  else
				  $i=$sep+1;
			  $sep=-1;
			  $j=$i;
			  $l=0;
			  $nl++;
		  }
		  else
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
        }else{
			$this->SetFont('Arial','I',9);
			$this->SetFillColor(255,255,255);
			$this->Cell(90,6,"Info Perusahaan",0,0,'L',1);
			$this->Cell(100,6,"Printed date : " . date('d-M-Y'),0,1,'R',1);
		}

	}

	// Page Content
	function Content($perusahaan,$tgl){
		$border = 0;
	//   $this->AddPage();
	  $this->SetAutoPageBreak(true,60);
	  $this->AliasNbPages();
	  $left = 25;

	  //header
	  $this->Ln(3);
	  $this->SetFont('Arial', 'B', 12);
	  $this->SetFillColor(255, 255, 255);
	  $this->Cell(0, 6, "TOKO ANITA",0,1,'C',1);
	  $this->Cell(0, 6, "Laporan Info Perusahaan",0,1,'C',1);
	  $this->Cell(0, 6, date("d-M-Y",  strtotime($tgl['mulai'])).' s/d '.date("d-M-Y",  strtotime($tgl['selesai'])),0,1,'C',1);
	  $this->Ln(2);

	  $this->SetLineWidth(0.8);
	  $this->Line(10,$this->GetY(),200,$this->GetY());
	  $this->SetLineWidth(0);

	  $this->Ln(3);
	  $h = 13;
	  $left = 40;
	  $top = 80;
	  #tableheader
	  $this->SetFont('Arial', 'B', 10);
	  $this->SetFillColor(200,200,200);
	  $left = $this->GetX();
	  $this->Cell(8,$h,'NO',1,0,'C',true);
	  $this->SetX($left += 8); $this->Cell(38, $h, 'Nama Perusahaan', 1, 0, 'C',true);
	  $this->SetX($left += 38); $this->Cell(80, $h, 'Alamat', 1, 0, 'C',true);
	  $this->SetX($left += 80); $this->Cell(40, $h, 'NPWP', 1, 0, 'C',true);
	  $this->SetX($left += 40); $this->Cell(25, $h, 'Tanggal Input', 1, 1, 'C',true);
	  //$this->Ln(20);

	  $this->SetFont('Arial','',10);
	  $this->SetWidths(array(8,38,80,40,25));
	  $this->SetAligns(array('C','L','L','L','L'));
	  $no = 1; $this->SetFillColor(255);
	  foreach ($perusahaan as $ps) {
		  $this->Row(
			  array($no++,
			  $ps['nama'],
			  $ps['alamat'],
			  $ps['npwp'],
			  $ps['tanggal']
		  ));
	  }
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
$this->myfpdf->SetTitle('LAPORAN INFO PERUSAHAAN TOKO ANITA',true);
$this->myfpdf->Content($perusahaan,$tgl);
$this->myfpdf->Output('laporan-info-perusahaan-toko-anita ['.date("d-M-Y",  strtotime($tgl['mulai'])).' s/d '.date("d-M-Y",  strtotime($tgl['selesai'])).'].pdf','I');
?>
