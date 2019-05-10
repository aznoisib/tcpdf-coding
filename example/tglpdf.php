<?php

require'fpdf.php'; // load fpdf class
require 'koneksi.php'; // load koneksi database


class PDF extends FPDF {

    // memberikan warna pada table
    function FancyTable($header, $data) {
        // warna, lebar dan font bold
        $this->SetFillColor(206, 206, 206);
        $this->SetTextColor(30, 30, 30);
        $this->SetDrawColor(89, 89, 89);
        $this->SetLineWidth(.2);
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 50, 50, 30);
        for ($i = 0; $i < count($header); ++$i)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // warna line
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Parsing Data
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['shift'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['tgl'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['style'], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row['hari'], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // tutup line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}
if(isset($_GET['tanggal'])){
                $tgl = $_GET['tanggal'];
                $nama = $_GET['nama'];
$pdf = new PDF();
// tentukan header kolom
$header = array('Shift', 'Tanggal', 'Style', 'Hari');
// Data loading
$sql = "SELECT * FROM gm1 WHERE tgl='$tgl' AND shift like '%".$nama."%'";

$data = array();
if ($result = mysqli_query($connect, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}





$pdf->SetFont('Arial', '', 11);
$pdf->AddPage();
$pdf->FancyTable($header, $data);
$pdf->Output();

}
?>

