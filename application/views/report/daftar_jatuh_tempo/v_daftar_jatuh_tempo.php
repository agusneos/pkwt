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
        $this->Cell(5,1,'Daftar Jatuh Tempo',0,0,'C');
        // Line break
        $this->Ln(1);
    }   

}

// definisi class
$pdf = new PDF();
// variable awal
date_default_timezone_set('Asia/Jakarta');
$pdf->FPDF("P","cm","A4");
$pdf->SetMargins(2,1,1);
//$pdf->AliasNbPages();
$pdf->AddPage();

function kosong($data)
{
    if ($data == 0)
    {
        return '';
    }
    else
    {
        return $data;
    }
}

$height = 0.6;
$pdf->SetFont('Arial','',9);

foreach($rows->result() as $data)
{    
}
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(2, 3.5);
$pdf->Cell(3,$height*2,'DEPARTEMEN',1,0,'C');
$pdf->Cell(12,$height,$data->TAHUN,1,0,'C');
$pdf->Cell(2,$height*2,'Total',1,0,'C');
$pdf->SetXY(5, 4.1);
$pdf->Cell(1,$height,'Jan',1,0,'C');
$pdf->Cell(1,$height,'Feb',1,0,'C');
$pdf->Cell(1,$height,'Mar',1,0,'C');
$pdf->Cell(1,$height,'Apr',1,0,'C');
$pdf->Cell(1,$height,'Mei',1,0,'C');
$pdf->Cell(1,$height,'Jun',1,0,'C');
$pdf->Cell(1,$height,'Jul',1,0,'C');
$pdf->Cell(1,$height,'Agt',1,0,'C');
$pdf->Cell(1,$height,'Sep',1,0,'C');
$pdf->Cell(1,$height,'Okt',1,0,'C');
$pdf->Cell(1,$height,'Nov',1,0,'C');
$pdf->Cell(1,$height,'Des',1,0,'C');
$pdf->SetFont('Arial','',9);

$tot_jan = 0;
$tot_feb = 0;
$tot_mar = 0;
$tot_apr = 0;
$tot_mei = 0;
$tot_jun = 0;
$tot_jul = 0;
$tot_agt = 0;
$tot_sep = 0;
$tot_okt = 0;
$tot_nov = 0;
$tot_des = 0;
$tot_tot = 0;
///Awal Data Ditampilkan

foreach($rows->result() as $data)
{
    $pdf->Ln();
    $pdf->Cell(3,$height,$data->DEPARTEMEN,1,0,'C');
    $pdf->Cell(1,$height,kosong($data->JAN),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->FEB),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->MAR),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->APR),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->MEI),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->JUN),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->JUL),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->AGT),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->SEP),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->OKT),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->NOV),1,0,'C');
    $pdf->Cell(1,$height,kosong($data->DES),1,0,'C');
    $pdf->Cell(2,$height,kosong($data->TOTAL),1,0,'C');
    
    $tot_jan += $data->JAN;
    $tot_feb += $data->FEB;
    $tot_mar += $data->MAR;
    $tot_apr += $data->APR;
    $tot_mei += $data->MEI;
    $tot_jun += $data->JUN;
    $tot_jul += $data->JUL;
    $tot_agt += $data->AGT;
    $tot_sep += $data->SEP;
    $tot_okt += $data->OKT;
    $tot_nov += $data->NOV;
    $tot_des += $data->DES;
    $tot_tot += $data->TOTAL;
    
}

$pdf->Ln();
$pdf->SetFont('Arial','B',9);
$pdf->Cell(3,$height,'TOTAL',1,0,'C');
$pdf->Cell(1,$height,$tot_jan,1,0,'C');
$pdf->Cell(1,$height,$tot_feb,1,0,'C');
$pdf->Cell(1,$height,$tot_mar,1,0,'C');
$pdf->Cell(1,$height,$tot_apr,1,0,'C');
$pdf->Cell(1,$height,$tot_mei,1,0,'C');
$pdf->Cell(1,$height,$tot_jun,1,0,'C');
$pdf->Cell(1,$height,$tot_jul,1,0,'C');
$pdf->Cell(1,$height,$tot_agt,1,0,'C');
$pdf->Cell(1,$height,$tot_sep,1,0,'C');
$pdf->Cell(1,$height,$tot_okt,1,0,'C');
$pdf->Cell(1,$height,$tot_nov,1,0,'C');
$pdf->Cell(1,$height,$tot_des,1,0,'C');
$pdf->Cell(2,$height,$tot_tot,1,0,'C');

$pdf->Output("Habis Jatuh Tempo.pdf","I");

/* End of file v_daftar_jatuh_tempo.php */
/* Location: ./views/report/daftar_jatuh_tempo/v_daftar_jatuh_tempo.php */