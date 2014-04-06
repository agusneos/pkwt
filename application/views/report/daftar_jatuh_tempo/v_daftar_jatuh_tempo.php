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

$pdf->Cell(3,$height*2,'DEPARTEMEN',1,0,'C');
$pdf->Cell(12,$height,'2014',1,0,'C');
$pdf->Cell(2,$height*2,'Total',1,0,'C');
$pdf->SetXY(5, 3.6);
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

$pdf->SetXY(2, 4.2);
$pdf->Cell(3,$height,'ACCOUNTING',1,0,'C');
$pdf->Cell(1,$height,'A1',1,0,'C');
$pdf->Cell(1,$height,'A2',1,0,'C');
$pdf->Cell(1,$height,'A3',1,0,'C');
$pdf->Cell(1,$height,'A4',1,0,'C');
$pdf->Cell(1,$height,'A5',1,0,'C');
$pdf->Cell(1,$height,'A6',1,0,'C');
$pdf->Cell(1,$height,'A7',1,0,'C');
$pdf->Cell(1,$height,'A8',1,0,'C');
$pdf->Cell(1,$height,'A9',1,0,'C');
$pdf->Cell(1,$height,'A10',1,0,'C');
$pdf->Cell(1,$height,'A11',1,0,'C');
$pdf->Cell(1,$height,'A12',1,0,'C');
$pdf->Cell(2,$height,'ATotal',1,0,'C');
$pdf->Ln();
$pdf->Cell(3,$height,'ENGINEERING',1,0,'C');
$pdf->Cell(1,$height,'E1',1,0,'C');
$pdf->Cell(1,$height,'E2',1,0,'C');
$pdf->Cell(1,$height,'E3',1,0,'C');
$pdf->Cell(1,$height,'E4',1,0,'C');
$pdf->Cell(1,$height,'E5',1,0,'C');
$pdf->Cell(1,$height,'E6',1,0,'C');
$pdf->Cell(1,$height,'E7',1,0,'C');
$pdf->Cell(1,$height,'E8',1,0,'C');
$pdf->Cell(1,$height,'E9',1,0,'C');
$pdf->Cell(1,$height,'E10',1,0,'C');
$pdf->Cell(1,$height,'E11',1,0,'C');
$pdf->Cell(1,$height,'E12',1,0,'C');
$pdf->Cell(2,$height,'ETotal',1,0,'C');
$pdf->Ln();
$pdf->Cell(3,$height,'HRD-GA',1,0,'C');
$pdf->Cell(1,$height,'H1',1,0,'C');
$pdf->Cell(1,$height,'H2',1,0,'C');
$pdf->Cell(1,$height,'H3',1,0,'C');
$pdf->Cell(1,$height,'H4',1,0,'C');
$pdf->Cell(1,$height,'H5',1,0,'C');
$pdf->Cell(1,$height,'H6',1,0,'C');
$pdf->Cell(1,$height,'H7',1,0,'C');
$pdf->Cell(1,$height,'H8',1,0,'C');
$pdf->Cell(1,$height,'H9',1,0,'C');
$pdf->Cell(1,$height,'H10',1,0,'C');
$pdf->Cell(1,$height,'H11',1,0,'C');
$pdf->Cell(1,$height,'H12',1,0,'C');
$pdf->Cell(2,$height,'HTotal',1,0,'C');
$pdf->Ln();
$pdf->Cell(3,$height,'PPIC',1,0,'C');
$pdf->Cell(1,$height,'P1',1,0,'C');
$pdf->Cell(1,$height,'P2',1,0,'C');
$pdf->Cell(1,$height,'P3',1,0,'C');
$pdf->Cell(1,$height,'P4',1,0,'C');
$pdf->Cell(1,$height,'P5',1,0,'C');
$pdf->Cell(1,$height,'P6',1,0,'C');
$pdf->Cell(1,$height,'P7',1,0,'C');
$pdf->Cell(1,$height,'P8',1,0,'C');
$pdf->Cell(1,$height,'P9',1,0,'C');
$pdf->Cell(1,$height,'P10',1,0,'C');
$pdf->Cell(1,$height,'P11',1,0,'C');
$pdf->Cell(1,$height,'P12',1,0,'C');
$pdf->Cell(2,$height,'PTotal',1,0,'C');
$pdf->Ln();
$pdf->Cell(3,$height,'PRODUKSI 1',1,0,'C');
$pdf->Cell(1,$height,'P1-1',1,0,'C');
$pdf->Cell(1,$height,'P1-2',1,0,'C');
$pdf->Cell(1,$height,'P1-3',1,0,'C');
$pdf->Cell(1,$height,'P1-4',1,0,'C');
$pdf->Cell(1,$height,'P1-5',1,0,'C');
$pdf->Cell(1,$height,'P1-6',1,0,'C');
$pdf->Cell(1,$height,'P1-7',1,0,'C');
$pdf->Cell(1,$height,'P1-8',1,0,'C');
$pdf->Cell(1,$height,'P1-9',1,0,'C');
$pdf->Cell(1,$height,'P1-10',1,0,'C');
$pdf->Cell(1,$height,'P1-11',1,0,'C');
$pdf->Cell(1,$height,'P1-12',1,0,'C');
$pdf->Cell(2,$height,'P1-Total',1,0,'C');
$pdf->Ln();
$pdf->Cell(3,$height,'PRODUKSI 2',1,0,'C');
$pdf->Cell(1,$height,'P2-1',1,0,'C');
$pdf->Cell(1,$height,'P2-2',1,0,'C');
$pdf->Cell(1,$height,'P2-3',1,0,'C');
$pdf->Cell(1,$height,'P2-4',1,0,'C');
$pdf->Cell(1,$height,'P2-5',1,0,'C');
$pdf->Cell(1,$height,'P2-6',1,0,'C');
$pdf->Cell(1,$height,'P2-7',1,0,'C');
$pdf->Cell(1,$height,'P2-8',1,0,'C');
$pdf->Cell(1,$height,'P2-9',1,0,'C');
$pdf->Cell(1,$height,'P2-10',1,0,'C');
$pdf->Cell(1,$height,'P2-11',1,0,'C');
$pdf->Cell(1,$height,'P2-12',1,0,'C');
$pdf->Cell(2,$height,'P2-Total',1,0,'C');
$pdf->Ln();
$pdf->Cell(3,$height,'PURCHASING',1,0,'C');
$pdf->Cell(1,$height,'PU1',1,0,'C');
$pdf->Cell(1,$height,'PU2',1,0,'C');
$pdf->Cell(1,$height,'PU3',1,0,'C');
$pdf->Cell(1,$height,'PU4',1,0,'C');
$pdf->Cell(1,$height,'PU5',1,0,'C');
$pdf->Cell(1,$height,'PU6',1,0,'C');
$pdf->Cell(1,$height,'PU7',1,0,'C');
$pdf->Cell(1,$height,'PU8',1,0,'C');
$pdf->Cell(1,$height,'PU9',1,0,'C');
$pdf->Cell(1,$height,'PU10',1,0,'C');
$pdf->Cell(1,$height,'PU11',1,0,'C');
$pdf->Cell(1,$height,'PU12',1,0,'C');
$pdf->Cell(2,$height,'PUTotal',1,0,'C');
$pdf->Ln();
$pdf->Cell(3,$height,'QA',1,0,'C');
$pdf->Cell(1,$height,'QA1',1,0,'C');
$pdf->Cell(1,$height,'QA2',1,0,'C');
$pdf->Cell(1,$height,'QA3',1,0,'C');
$pdf->Cell(1,$height,'QA4',1,0,'C');
$pdf->Cell(1,$height,'QA5',1,0,'C');
$pdf->Cell(1,$height,'QA6',1,0,'C');
$pdf->Cell(1,$height,'QA7',1,0,'C');
$pdf->Cell(1,$height,'QA8',1,0,'C');
$pdf->Cell(1,$height,'QA9',1,0,'C');
$pdf->Cell(1,$height,'QA10',1,0,'C');
$pdf->Cell(1,$height,'QA11',1,0,'C');
$pdf->Cell(1,$height,'QA12',1,0,'C');
$pdf->Cell(2,$height,'QATotal',1,0,'C');
$pdf->Ln();
$pdf->Cell(3,$height,'QHSE',1,0,'C');
$pdf->Cell(1,$height,'QH1',1,0,'C');
$pdf->Cell(1,$height,'QH2',1,0,'C');
$pdf->Cell(1,$height,'QH3',1,0,'C');
$pdf->Cell(1,$height,'QH4',1,0,'C');
$pdf->Cell(1,$height,'QH5',1,0,'C');
$pdf->Cell(1,$height,'QH6',1,0,'C');
$pdf->Cell(1,$height,'QH7',1,0,'C');
$pdf->Cell(1,$height,'QH8',1,0,'C');
$pdf->Cell(1,$height,'QH9',1,0,'C');
$pdf->Cell(1,$height,'QH10',1,0,'C');
$pdf->Cell(1,$height,'QH11',1,0,'C');
$pdf->Cell(1,$height,'QH12',1,0,'C');
$pdf->Cell(2,$height,'QHTotal',1,0,'C');
$pdf->Ln();
$pdf->Cell(3,$height,'Total',1,0,'C');
$pdf->Cell(1,$height,'TO1',1,0,'C');
$pdf->Cell(1,$height,'TO2',1,0,'C');
$pdf->Cell(1,$height,'TO3',1,0,'C');
$pdf->Cell(1,$height,'TO4',1,0,'C');
$pdf->Cell(1,$height,'TO5',1,0,'C');
$pdf->Cell(1,$height,'TO6',1,0,'C');
$pdf->Cell(1,$height,'TO7',1,0,'C');
$pdf->Cell(1,$height,'TO8',1,0,'C');
$pdf->Cell(1,$height,'TO9',1,0,'C');
$pdf->Cell(1,$height,'TO10',1,0,'C');
$pdf->Cell(1,$height,'TO11',1,0,'C');
$pdf->Cell(1,$height,'TO12',1,0,'C');
$pdf->Cell(2,$height,'SUBTotal',1,0,'C');

foreach($rows->result() as $data)
{    
}
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(2, 15);
$pdf->Cell(3,$height*2,'DEPARTEMEN',1,0,'C');
$pdf->Cell(12,$height,$data->TAHUN,1,0,'C');
$pdf->Cell(2,$height*2,'Total',1,0,'C');
$pdf->SetXY(5, 15.6);
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