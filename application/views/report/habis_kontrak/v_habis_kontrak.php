<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PDF extends FPDF
{    
    function Header()
    {
        // Logo
        $this->Image('assets/images/logo.jpg', 1, 1,7.5,1.2);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Ln(1);
        $this->Cell(7);
        // Title
        //$this->Cell(5,1,'Daftar PKWT',0,0,'C');
        // Line break
        $this->Ln(1);
    }   

}

// definisi class
$pdf = new PDF();
// variable awal
date_default_timezone_set('Asia/Jakarta');
$pdf->FPDF("P","cm","A4");
$pdf->SetMargins(1,1,1);
//$pdf->AliasNbPages();
$pdf->AddPage();


function format_date($tgl)
{
    setlocale (LC_TIME, 'INDONESIAN');
    $tgl = strtotime($tgl);
    $st = strftime( "%d-%b-%Y", $tgl);
    if ($tgl != '')
    {
        return $st;
    }
    else
    {
        return '';
    }
    
}
function hari_ini()
{
    setlocale (LC_TIME, 'INDONESIAN');
    $st = strftime( "%d %B %Y", strtotime(date('d-F-Y')));
    return $st;
}
function periode()
{
    setlocale (LC_TIME, 'INDONESIAN');
    $now = strtotime(date("Y-m-d"));    
    $periode_1 = strftime( "%B %Y",strtotime(date('Y-m-j', strtotime('+ 1 month', $now))));
    $periode_2 = strftime( "%B %Y",strtotime(date('Y-m-j', strtotime('+ 2 month', $now))));;
    return ($periode_1.' & '.$periode_2);
}
function kontrak_I($kontrak)
{
    if ($kontrak == 'I')
    {
        return 'X';
    }
}
function kontrak_P($kontrak)
{
    if ($kontrak == 'P')
    {
        return 'X';
    }
}
function kontrak_II($kontrak)
{
    if ($kontrak == 'II')
    {
        return 'X';
    }
}

$height = 0.5;
$pdf->SetFont('Arial','',9);
$pdf->Cell(5,$height,'Cikarang, '.hari_ini(),0,0,'L');
$pdf->Ln($height*2);
$pdf->Cell(3,$height,'Kepada',0,0,'L');
foreach($rows->result() as $data)
{
    
}
$pdf->Cell(5,$height,': '.$data->Manager,0,0,'L');

$pdf->Ln();
$pdf->Cell(3,$height,'Dari',0,0,'L');
$pdf->Cell(3,$height,': HRD',0,0,'L');
$pdf->Ln();
$pdf->Cell(3,$height,'Perihal',0,0,'L');
$pdf->Cell(3,$height,': Habis Kontrak',0,0,'L');
$pdf->Ln($height*2);
$pdf->Cell(3,$height,'Dengan Hormat,',0,0,'L');
$pdf->Ln($height*2);
$kata1 = 'Berikut diberitahukan data karyawan yang habis kontraknya pada bulan '.
        periode().' sebagai berikut :';
$pdf->MultiCell(0,$height,$kata1,0,'J');

$pdf->SetFont('Arial','B',9);
$pdf->Ln($height);
$pdf->Cell(1,$height*2,'No',1,0,'C');
$pdf->Cell(5,$height*2,'Nama',1,0,'C');
$pdf->Cell(5,$height*2,'Bagian',1,0,'C');
$pdf->Cell(2.5,$height*2,'Tanggal Masuk',1,0,'C');
$pdf->Cell(2.5,$height*2,'Habis Kontrak',1,0,'C');
$pdf->Cell(3,$height,'Kontrak ke',1,2,'C');
$pdf->Cell(1,$height,'1',1,0,'C');
$pdf->Cell(1,$height,'P',1,0,'C');
$pdf->Cell(1,$height,'2',1,0,'C');

$pdf->SetFont('Arial','',9);
$noUrut = 1;
///Awal Data Ditampilkan

foreach($rows->result() as $data)
{
    $pdf->Ln();
    $pdf->Cell(1,$height,$noUrut,1,0,'C');
    $pdf->Cell(5,$height,$data->emply_name,1,0,'L');
    //$pdf->Cell(3,$height,$data->Departemen,1,0,'C');
    $pdf->Cell(5,$height,$data->Bagian,1,0,'L');
    //$pdf->Cell(3,$height,$data->Manager,1,0,'C');
    $pdf->Cell(2.5,$height,format_date($data->emply_start),1,0,'C');
    $pdf->Cell(2.5,$height,format_date($data->pkwt_end),1,0,'C');
    $pdf->Cell(1,$height,kontrak_I($data->pkwt_kk),1,0,'C');
    $pdf->Cell(1,$height,kontrak_P($data->pkwt_kk),1,0,'C');
    $pdf->Cell(1,$height,kontrak_II($data->pkwt_kk),1,0,'C');
    $noUrut++;
}

$pdf->Ln($height*3);
$kata2 = 'Demikian pemberitahuan ini disampaikan, harap memberitahukan ke bagian '. 
            'HRD atas kelanjutan kontrak-kontrak tersebut diatas. Terima kasih.';
$pdf->MultiCell(0,$height,$kata2,0,'J');
$pdf->Ln($height);

$pdf->SetX(10);
$pdf->Cell(3,$height,'Dibuat',0,0,'C');
$pdf->SetX(15);
$pdf->Cell(3,$height,'Diketahui',0,0,'C');

$pdf->Ln($height*5);
$pdf->SetX(10);
$pdf->Cell(3,$height,'Yuli',0,0,'C');
$pdf->SetX(15);
$pdf->Cell(3,$height,'Bambang T',0,0,'C');

$pdf->Output("Habis Kontrak.pdf","I");

/* End of file v_habis_kontrak.php */
/* Location: ./views/report/habis_kontrak/v_habis_kontrak.php */