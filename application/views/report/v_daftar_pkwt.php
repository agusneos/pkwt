<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PDF extends FPDF
{
    // Load data
    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }
    // Simple table
    function BasicTable($header, $data)
    {
        // Header
        $this->Cell(0.9);
        foreach($header as $col)
            $this->Cell(3.4,0.5,$col,1,0,'C');
        $this->Ln();
        // Data    
        foreach($data as $row)
        {
            $this->Cell(0.9);
            foreach($row as $col)
                $this->Cell(3.4,0.5,$col,1,0,'C');
            $this->Ln();
        }
    }
    // Page footer
    

}

// definisi class
$fpdf = new PDF();
// variable awal
date_default_timezone_set('Asia/Jakarta');
$fpdf->FPDF("P","cm","A4");
$fpdf->SetMargins(1.5,3.5,1.5);
//$fpdf->AliasNbPages();
$fpdf->AddPage();

$fpdf->SetFont('Arial','',9);


//$fpdf->SetFillColor(245,245,245);

///End Fungsi

///Awal Data Ditampilkan
foreach($pkwt->result() as $data)
{
    $fpdf->Ln();    
    $fpdf->Cell(4,0.5,$data->departemen,1,0,'C');
    $fpdf->Cell(4,0.5,$data->bagian,1,0,'C');
    $fpdf->Cell(2,0.5,$data->emply_name,1,0,'C');
    $fpdf->Cell(2,0.5,$data->emply_start,1,0,'C');
    $fpdf->Cell(2,0.5,$data->awal,1,0,'C');
    $fpdf->Cell(2,0.5,$data->perpanjangan,1,0,'C');
    $fpdf->Cell(2,0.5,$data->pembaharuan,1,0,'C');
    


}

$fpdf->Output("Daftar PKWT.pdf","I");
