<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PDF extends FPDF
{    
    // Page header
    function Header()
    {
        // Logo
        $this->Image('assets/images/hikari.jpg', 1, 1,7.5,1.2);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Ln(1);
        $this->Cell(7);
        // Title
        $this->Cell(5,1,'Daftar PKWT',0,0,'C');
        // Line break
        $this->Ln(1);
    }
    // Page footer
    

}

// definisi class
$fpdf = new PDF();
// variable awal
date_default_timezone_set('Asia/Jakarta');
$fpdf->FPDF("P","cm","A4");
$fpdf->SetMargins(1,1,1);
//$fpdf->AliasNbPages();
$fpdf->AddPage();
$fpdf->SetFont('Arial','',6);

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

function lama_kontrak($date2, $date1)
{
    $diff = abs(strtotime($date2) - strtotime($date1));
    $diff2 = strtotime($date2) - strtotime($date1);
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    if ($diff2 < 0)
    {
        return ('');
    }
    else
    {
        if ($months == 12)
        {
            $years = $years+1;
            $months = $months-12;        
        } 
        if ($months == 0)
        {
            return($years.' Thn');
        }
        else if ($years == 0)
        {
            return($months.' Bln');
        }
        else
        {
            return($years.' Thn, '.$months.' Bln');
        }
    }
}

function hasil($start, $awal, $perpanjangan, $pembaharuan)
{    
    if ($pembaharuan != '')
    {
        return lama_kontrak($pembaharuan, $start);
    }
    else if ($perpanjangan != '')
    {
        return lama_kontrak($perpanjangan, $start);
    }
    else
    {
        return lama_kontrak($awal, $start);
    }
}

$height = 0.4;
$fpdf->Cell(0.7,$height,'No',1,0,'C');
$fpdf->Cell(3,$height,'Departemen',1,0,'C');
$fpdf->Cell(3,$height,'Bagian',1,0,'C');
$fpdf->Cell(4,$height,'Nama Karyawan',1,0,'C');
$fpdf->Cell(1.7,$height,'Masuk',1,0,'C');
$fpdf->Cell(1.7,$height,'Kontrak 1',1,0,'C');
$fpdf->Cell(1.7,$height,'Perpanjangan',1,0,'C');
$fpdf->Cell(1.7,$height,'Pembaharuan',1,0,'C');
$fpdf->Cell(1.7,$height,'Lama Kontrak',1,0,'C');
///End Fungsi
$noUrut = 1;
///Awal Data Ditampilkan
foreach($pkwt->result() as $data)
{
    $fpdf->Ln();
    $fpdf->Cell(0.7,$height,$noUrut,1,0,'C');
    $fpdf->Cell(3,$height,$data->departemen,1,0,'C');
    $fpdf->Cell(3,$height,$data->bagian,1,0,'C');
    $fpdf->Cell(4,$height,$data->nama,1,0,'L');    
    $fpdf->Cell(1.7,$height,format_date($data->start),1,0,'C');
    $fpdf->Cell(1.7,$height,format_date($data->End_Contract_I),1,0,'C');
    $fpdf->Cell(1.7,$height,format_date($data->End_Contract_P),1,0,'C');
    $fpdf->Cell(1.7,$height,format_date($data->End_Contract_II),1,0,'C');
    $fpdf->Cell(1.7,$height,hasil($data->start, $data->End_Contract_I, $data->End_Contract_P, $data->End_Contract_II),1,0,'C');
    $noUrut++;

}

$fpdf->Output("Daftar PKWT.pdf","I");
