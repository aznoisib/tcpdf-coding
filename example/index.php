<?php
require_once('tcpdf/tcpdf.php');
require 'koneksi.php'; // load koneksi database

//konfigurasi TCPDF
$pageDimension = array('15000,1000');
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $pageDimension, true, 'UTF-8', false);
//TCPDF('L', 'mm', array('41','89'), true, 'UTF-8', false);
 //case 'A0' : {$pf = array( 2383.937, 3370.394); break;}
    //case 'A1' : {$pf = array( 1683.780, 2383.937); break;}
    //case 'A2' : {$pf = array( 1190.551, 1683.780); break;}
    //case 'A3' : {$pf = array(  841.890, 1190.551); break;}
    //case 'A4' : {$pf = array(  595.276,  841.890); break;}
    //case 'A5' : {$pf = array(  419.528,  595.276); break;}
    //case 'A6' : {$pf = array(  297.638,  419.528); break;}
$pdf = new TCPDF('L','mm','A4', true, 'UTF-8', false);
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


<tr bgcolor="#ffffff"> <th colspan="5"><img src="/MEMOold/production/berkas/img/EDIT.PNG"  width="50" height="50">PT.KAHATEX </th> <th colspan="6">MEMO OVER SHIFT</th> <th colspan="5">Detail from Remarks</th> </tr>

 <tr bgcolor="#ffffff">
                            <th align="center">Shift</th>
                            <th align="center">Line</th>
                             <th align="center">Style</th>
                              <th align="center">Hari</th>
                               <th align="center">Order</th>
                                <th align="center">Article</th>
                                <th align="center">Selling region</th>
                                <th align="center">Absenteeism</th>
                                <th align="center">Tgl</th>
                                <th align="center">Tgt / jam</th>
                                <th align="center">Tgt eff (%)</th>
                                <th align="center">Rft (%)</th>
                                <th align="center">Qty pdk</th>
                                <th align="center">Akumulasi output</th>
                                <th align="center">Balance qty</th>
                                <th align="center">Jumlah wip di line</th>
                        </tr>



                        ';

 foreach ($data as $row) 
                {
                    $i++;
                    $html.='
<tr bgcolor="#ffffff">
                            
                            <td>'.$row['shift'].'</td>
                            <td>'.$row['line'].'</td>
                              <td>'.$row['style'].'</td>
                               <td>'.$row['hari'].'</td>
                                <td>'.$row['order'].'</td>
                                 <td>'.$row['article'].'</td> 
                                 <td>'.$row['selling_region'].'</td>

                                  <td>'.$row['absenteeism'].'</td>
                                   <td>'.$row['tgl'].'</td>
                                 <td>'.$row['tgt_jam'].'</td>
                                  <td>'.$row['tgt_eff'].'</td>

                                   <td>'.$row['rft'].'</td>
                                    <td>'.$row['qty_pdk'].'</td>
                                     <td>'.$row['shift'].'</td>
                                      <td>'.$row['shift'].'</td>
                                       <td>'.$row['shift'].'</td>
                            
                        </tr>

 

                    ';
                }


 $html.='</table>';

 $html.='  <table border="1" cellspacing="1" bgcolor="#666666" cellpadding="2"><tr bgcolor="#ffffff">
                           
                            <th align="center">Masalah yang terjadi</th>
                            <th align="center">C.A.P / Penyelesaian</th>
                            
                        </tr>

                        ';
            foreach ($data as $row) 
                {
                    $i++;
                    $html.='
<tr bgcolor="#ffffff">
                           
                            <td>'.$row['shift'].'</td>
                            <td>'.$row['line'].'</td>
                            
                        </tr>



                    ';
                }



           


            $html.='</table>';


          $html.='  <table border="1" cellspacing="1" bgcolor="#666666" cellpadding="2"><tr bgcolor="#ffffff">
                           
                            <th align="center">TOP 3 Deffect</th>
                            <th align="center">Bottel neck</th>
                            
                        </tr>

                        ';
            foreach ($data as $row) 
                {
                    $i++;
                    $html.='
<tr bgcolor="#ffffff">
                           
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