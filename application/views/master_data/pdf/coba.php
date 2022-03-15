<?php
defined('BASEPATH') or exit('No direct script access allowed');
// error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL

class FPDF_AutoWrapTable extends FPDF {
	private $data = array();
	private $options = array(
		'filename' => 'a',
		'destinationfile' => '',
		'paper_size'=>'F4',
		'orientation'=>''
	);

	function __construct($data = array(), $options = array()) {
	  parent::__construct();
	  $this->data = $data;
	  $this->options = $options;
  }

  function Header()
	{
        if ($this->PageNo() == 1) {
            $this->SetFont('Arial', 'I', 9);
            $this->SetFillColor(255, 255, 255);
            $this->Cell(90, 6, '', 0, 0, 'L', 1);
            $this->Cell(100, 6, "Printed date : " . date('d-M-Y'), 0, 1, 'R', 1);
            $this->Line(10, $this->GetY(), 200, $this->GetY());

			$this->Ln(3);
			$this->SetFont('Arial', 'B', 12);
			$this->SetFillColor(255, 255, 255);
			$this->Cell(0, 6, "TOKO ANITA",0,1,'C',1);
			$this->Cell(0, 6, "Laporan Data Pelanggan",0,1,'C',1);
			$this->Ln(2);

			$this->SetLineWidth(0.8);
			$this->Line(10,$this->GetY(),200,$this->GetY());
			$this->SetLineWidth(0);
        }else{
			$this->SetFont('Arial','I',9);
			$this->SetFillColor(255,255,255);
			$this->Cell(90,6,"Data Barang",0,0,'L',1);
			$this->Cell(100,6,"Printed date : " . date('d-M-Y'),0,1,'R',1);
		}

		
	}

  public function rptDetailData () {
	  //
	  $border = 0;
	  $this->AddPage();
	  $this->SetAutoPageBreak(true,60);
	  $this->AliasNbPages();
	  $left = 25;

	  //header
	  $this->SetFont("", "B", 15);
	  $this->MultiCell(0, 12, 'PT. ACHMATIM DOT NET');
	  $this->Cell(0, 1, " ", "B");
	  $this->Ln(10);
	  $this->SetFont("", "B", 12);
	  $this->SetX($left); $this->Cell(0, 10, 'LAPORAN DATA KARYAWAN', 0, 1,'C');
	  $this->Ln(10);

	  $h = 13;
	  $left = 40;
	  $top = 80;
	  #tableheader
	  $this->SetFont('Arial', 'B', 10);
	  $this->SetFillColor(200,200,200);
	  $left = $this->GetX();
	  $this->Cell(8,$h,'NO',1,0,'C',true);
	  $this->SetX($left += 20); $this->Cell(75, $h, 'NIP', 1, 0, 'C',true);
	  $this->SetX($left += 75); $this->Cell(50, $h, 'NAMA', 1, 0, 'C',true);
	  $this->SetX($left += 50); $this->Cell(150, $h, 'ALAMAT', 1, 0, 'C',true);
	  $this->SetX($left += 150); $this->Cell(100, $h, 'EMAIL', 1, 0, 'C',true);
	  $this->SetX($left += 100); $this->Cell(100, $h, 'WEBSITE', 1, 1, 'C',true);
	  //$this->Ln(20);

	  $this->SetFont('Arial','',9);
	  $this->SetWidths(array(20,75,50,150,100,100));
	  $this->SetAligns(array('C','L','L','L','L','L'));
	  $no = 1; $this->SetFillColor(255);
	  foreach ($this->data as $baris) {
		  $this->Row(
			  array($no++,
			  $baris['nip'],
			  $baris['nama'],
			  $baris['alamat'],
			  $baris['email'],
			  $baris['website']
		  ));
	  }

  }

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

  public function printPDF () {

	//   if ($this->options['paper_size'] == "F4") {
	// 	  $a = 8.3 * 72; //1 inch = 72 pt
	// 	  $b = 13.0 * 72;
	// 	  $this->FPDF($this->options['orientation'], "pt", array($a,$b));
	//   } else {
	// 	  $this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
	//   }

	  $this->SetAutoPageBreak(false);
	  $this->AliasNbPages();
	  $this->SetFont("helvetica", "B", 10);
	  //$this->AddPage();

	  $this->rptDetailData();

	  $this->Output('laporan-data-pelanggan-toko-anita ['.date('d-M-Y').'].pdf','I');
	}

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
} //end of class

//contoh penggunaan
$data = array(
  array(
	  'nip'		=> '0111500382',
	  'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	  'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	  'email' 	=> 'achmatim@gmail.com',
	  'website' 	=> 'http://achmatim.net'
  ),
  array(
	  'nip'		=> '0411500101',
	  'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	  'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	  'email' 	=> 'chotimatul.musyarofah@gmail.com',
	  'website' 	=> 'http://contohprogram.info'
  ),
  array(
	  'nip'		=> '1111500200',
	  'nama' 		=> 'MUHAMMAD LINTANG',
	  'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	  'email' 	=> 'achmatim@yahoo.com',
	  'website' 	=> 'http://ebook.achmatim.net'
  ),array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),
array(
	'nip'		=> '0111500382',
	'nama' 		=> 'ACHMAD SOLICHIN dsadf asdfdsa asdfdas adsfdas asfdfdsa asddcsa addsc',
	'alamat' 	=> 'Jalan Ciledug Raya No 99, Petukangan Utara, Jakarta Selatan 12260, DKI Jakarta',
	'email' 	=> 'achmatim@gmail.com',
	'website' 	=> 'http://achmatim.net'
),
array(
	'nip'		=> '0411500101',
	'nama' 		=> 'CHOTIMATUL MUSYAROFAH',
	'alamat' 	=> 'Komplek Japos RT 002/015 Kelurahan Peninggilan, Kec. Ciledug, Tangerang',
	'email' 	=> 'chotimatul.musyarofah@gmail.com',
	'website' 	=> 'http://contohprogram.info'
),
array(
	'nip'		=> '1111500200',
	'nama' 		=> 'MUHAMMAD LINTANG',
	'alamat' 	=> 'Jl. Raya Caplin, Kec. Ciledug, Tangerang, Banten',
	'email' 	=> 'achmatim@yahoo.com',
	'website' 	=> 'http://ebook.achmatim.net'
),

);

//pilihan
$options = array(
  'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
  'destinationfile' => '', //I=inline browser (default), F=local file, D=download
  'paper_size'=>'F4',	//paper size: F4, A3, A4, A5, Letter, Legal
  'orientation'=>'P' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data);
$tabel->printPDF();
?>
