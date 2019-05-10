<?php
 require_once 'tcpdf/tcpdf.php';
 $tgl_sekarang = date("d F Y");
 
class YudhaPDF extends TCPDF {
 public function Header() {
        $image_file = "<img src=\"logo.jpg\" width=\"180\" height=\"70\"/>";
  $this->SetY(10);
  $isi_header="<table align=\"right\">
     <tr>
      <td>".$image_file."</td>
     </tr>
    </table>";
  $this->writeHTML($isi_header, true, false, false, false, '');
    }
 
 public function Footer() {
        $image_file = "<img src=\"logo.jpg\" width=\"180\" height=\"70\"/>";
  $this->SetY(-40);
  $this->writeHTML($image_file, true, false, false, false, '');
        $this->SetY(-15);
  $this->writeHTML("<hr>", true, false, false, false, '');
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 10, ''.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

  $pdf = new YudhaPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
   
 $pdf->SetTitle('Laporan Yudha');
 $pdf->SetSubject('Laporan Yudha');
   
 $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
 $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
 $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
   
 $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 $pdf->AddPage();
   
 $pdf->SetFont('helvetica', '', 10);
 $pdf->SetY(30);
 $isi = "<br><table>
     <tr>
      <td align=\"center\"><h4>CONTOH LAPORAN</h4></td>
     </tr>
    </table>
    <br><hr><p></p>
    Tanggal : ".$tgl_sekarang." <br>
    <table border=\"1\">
     <tr>
      <th> No </th>
      <th> Produk </th>
     </tr>
     <tr>
      <td> 1</td>
      <td> Mouse</td>
     </tr>
     <tr>
      <td> 2</td>
      <td> Kucing</td>
     </tr>
    </table>";

  $pdf->writeHTML($isi, true, false, false, false, '');
     
 $namaPDF = 'laporan.pdf';
 $pdf->Output($namaPDF,'I');
?>
