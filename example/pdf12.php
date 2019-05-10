<?php
if(isset($_GET['tanggal']) && !empty($_GET['tanggal']) && isset($_GET['shift']) && !empty($_GET['shift']) && isset($_GET['garment']) && !empty($_GET['garment']) && isset($_GET['klompok']) && !empty($_GET['klompok']))
{
       $tgl = $_GET['tanggal'];
        $sft = $_GET['shift'];
        $gmr = $_GET['garment'];
        $klp = $_GET['klompok'];

//Procedural File: tcpdf_config.php
//http://www.sicosonda.pt/commonHTML/tcpdf/doc/com-tecnick-tcpdf/_config---tcpdf_config.php.html

//PDF_PAGE_ORIENTATION = 'P'
//page orientation (P=portrait, L=landscape)


//PDF_UNIT = 'mm'
//document unit of measure [pt=point, mm=millimeter, cm=centimeter, in=inch]

require_once('tcpdf/tcpdf.php');
require 'koneksi.php'; // load koneksi database

//konfigurasi TCPDF
$pageDimension = array('841.890,1190.551');
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $pageDimension, true, 'UTF-8', false);
//TCPDF('L', 'mm', array('41','89'), true, 'UTF-8', false);
 //case 'A0' : {$pf = array( 2383.937, 3370.394); break;}
    //case 'A1' : {$pf = array( 1683.780, 2383.937); break;}
    //case 'A2' : {$pf = array( 1190.551, 1683.780); break;}
    //case 'A3' : {$pf = array(  841.890, 1190.551); break;}
    //case 'A4' : {$pf = array(  595.276,  841.890); break;}
    //case 'A5' : {$pf = array(  419.528,  595.276); break;}
    //case 'A6' : {$pf = array(  297.638,  419.528); break;}
$sql = mysqli_query($connect,"SELECT * FROM $gmr WHERE tgl='$tgl' AND shift like '%".$sft."%' AND kelompok like '%".$klp."%'");
$rowcount=mysqli_num_rows($sql);
$rowcountc=mysqli_num_rows($sql);
 //$rowcounts=$rowcount*100+($rowcount*20);
if ($rowcount>1) {
  if ($rowcount<=3) { $rowcounts=$rowcount*($rowcount*155/$rowcount);}else{$rowcounts=$rowcount*($rowcount*115/$rowcount);}


}else{$rowcounts=$rowcounts=$rowcount*365;}

$custom_layout = array($rowcounts, 365);

//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);
//procedural potrait
//$pdf = new TCPDF('P','mm','A2', true, 'UTF-8', false);

//procedural landscape
//$pdf = new TCPDF('L','mm','A2', true, 'UTF-8', false);

//creative potrait one page a6
//$a6 = 419.528;
//$rowcountc=$rowcountc*100+($a6/$rowcount+$rowcount)*($a6/199);
//creative landscape one page
//$pdf = new TCPDF('P','mm',array($rowcountc,$a6), true, 'UTF-8', false);


//creative landscape one page a6
$a4 = 841.890;
$rowcountc=$rowcountc*100;
$pdf = new TCPDF('L','mm',array('Rotate' => 90,'A4'), true, 'UTF-8', false);
$PDF_HEADER_LOGO = "EDIT.PNG";//any image file. check correct path.
$PDF_HEADER_LOGO_WIDTH = "20";
$PDF_HEADER_TITLE = "Data memo $gmr";
$PDF_HEADER_STRING = "Tanggal: $tgl\n"
."Kelompok: $klp\n"
."Shift: $sft";
$pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
$pdf->SetTitle('Memo Over Shift PT.KAHATEX');
            // set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set margins

// set auto page breaks

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 $pdf->AddPage();
            //$pdf->AddPage('L');
 //$pdf->SetFillColor( 232, 239, 242 );
//$pdf->Rect( 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'F' );










  
$data = array();
if ($result = $sql) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
//print_r($data);

//$colors = array('red', 'blue', 'green', 'yellow');


            $i=0;
            $html='


 

         



                        ';

 foreach ($data as $row) 
                {
                    $i++;
                    $html.='

<style>
table > tr > th {
  
    font-family: Helvetica, Arial, sans-serif;
        font-weight: bold;
}
table {
    border-left: 0px solid;
    border-right: 0px solid;
}
tr.no-bottom-border th {
   border-bottom: none;
  
}
</style>
 

   <h3 align="center">Memo Over Shift PT.KAHATEX</h3>

<table border="1" cellspacing="1" bgcolor="#fffff" cellpadding="2">

                   


<tr bgcolor="#ffffff">   <th style="text-align:center" colspan="5">&nbsp; <br/> PT.KAHATEX </th> <th style="text-align:center" colspan="7">&nbsp; <br/>  MEMO OVER SHIFT<br/></th> <th style=" vertical-align: middle;
    text-align:center;" colspan="5">&nbsp; <br/>  Detail from Remarks</th> </tr>

 



<tr bgcolor="#ffffff">
<th align="center">No</th>
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


<tr bgcolor="#ffffff">
                            <td style="line-height: 2000%;" align="center" rowspan="5">'.$i.'</td>
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
                                     <td>'.$row['akm_output'].'</td>
                                      <td>'.$row['blnce_qty'].'</td>
                                       <td>'.$rowcountc.'</td>
                            
                        </tr>
 <tr bgcolor="#ffffff">
        
      <th colspan="8">Masalah yang terjadi</th>
                            <th colspan="8" align="center">C.A.P / Penyelesaian</th>



      </tr>
 
  <tr bgcolor="#ffffff">
        <td height="115" colspan="8">'.$row['mslh_terjadi'].'</td>
                                       <td height="115" colspan="8">'.$row['cap_pnylesaian'].'</td>
     
      
      </tr>







  <tr bgcolor="#ffffff">
        
       <th colspan="8">Top 3 deffect</th>
    <th colspan="8">Bottle neck</th>
</tr>


<tr bgcolor="#ffffff">

       <td height="98" colspan="8">'.$row['top_3deffect'].'</td>
                                       <td height="98" colspan="8">'.$row['btl_neck'].'</td>
     
      
      </tr>
 
</table>
                    ';
                }


 //$html.='</table>';

 




            


          











            $pdf->writeHTML($html, true, false, true, false, '');

//hasil print
ob_end_clean();
$pdf->Output('prosedur-L-a4-table.pdf','I');




 
}

?>