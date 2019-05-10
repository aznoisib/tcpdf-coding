<?php
require_once('tcpdf/tcpdf.php');
require 'koneksi.php'; // load koneksi database

//konfigurasi TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Daftar Produk');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');

            $pdf->AddPage();



if(isset($_GET['tanggal'])){
                $tgl = $_GET['tanggal'];
                $nama = $_GET['nama'];




$sql = "SELECT * FROM gm1 WHERE tgl='$tgl' AND shift like '%".$nama."%'";

$data = array();
if ($result = mysqli_query($connect, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
//print_r($data);

//$colors = array('red', 'blue', 'green', 'yellow');


            $i=0;
            $html='
<style>
table > tr > th {
  
    font-family: Helvetica, Arial, sans-serif;
        font-weight: bold;
}


</style>
 



            <h3 align="center">Memo Over Shift PT.KAHATEX</h3>
                    <table border="1" cellspacing="1" bgcolor="#666666" cellpadding="2">


<tr bgcolor="#ffffff">
                            <th width="33%" align="left"><img src="/MEMOold/production/berkas/img/EDIT.PNG"  width="50" height="50">PT.KAHATEX </th>
                            <th width="33%" align="center">MEMO OVER SHIFT</th>
                            <th width="33%" align="center">Detail from Remarks</th>
                        </tr> 
<tr>
    <th colspan="2">Monthly Savings</th>
  </tr>

                        <tr bgcolor="#ffffff">
                            <th width="8.3%" align="center">Shift</th>
                            <th width="8.3%" align="center">Line</th>
                             <th width="8.3%" align="center">Style</th>
                              <th width="8.3%" align="center">Hari</th>
                               <th width="8.3%" align="center">Order</th>
                                <th width="8.3%" align="center">Article</th>
                                <th width="8.3%" align="center">Selling region</th>
                                <th width="15%" align="center">Absenteeism</th>
                                <th width="12%" align="center">Tanggal</th>
                                <th width="8.3%" align="center">Tgt / jam</th>
                                <th width="8.3%" align="center">Tgt eff (%)</th>
                        </tr> 



<tr>
<th>1a</th>
<th>2a</th>
<th>1b</th>
<th>2b</th>
<th>1</th>
<th>2</th>
<th>3</th>
<th>Absenteeism</th>
<th>5</th>
<th>6</th>
<th>7</th>
<th>8</th>
</tr><tr>
    <td>John</td>
    <td>Doe reeee reeeeee errrrrr reeeee</td>
  </tr>




                        ';

 foreach ($data as $row) 
                {
                    $i++;
                    $html.='
<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
                            <td>'.$row['shift'].'</td>
                            <td>'.$row['line'].'</td>
                            
                        </tr>



                    ';
                }




 $html.=' <tr bgcolor="#ffffff">
                            <th width="5%" align="center">No</th>
                            <th width="25%" align="center">Nama Produk</th>
                            <th width="45%" align="center">Deskripsi</th>
                            <th width="15%" align="center">Harga</th>
                        </tr>

                        ';
            foreach ($data as $row) 
                {
                    $i++;
                    $html.='
<tr bgcolor="#ffffff">
                            <td align="center">'.$i.'</td>
                            <td>'.$row['shift'].'</td>
                            <td>'.$row['line'].'</td>
                            
                        </tr>



                    ';
                }



           


            $html.='</table>';


         









            $pdf->writeHTML($html, true, false, true, false, '');

//hasil print
$pdf->Output('buatpdf.pdf','I');



}
?>