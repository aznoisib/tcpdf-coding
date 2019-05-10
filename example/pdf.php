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
$pdf = new TCPDF('P','mm','P2', true, 'UTF-8', false);

$pdf->SetTitle('Daftar Produk');
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


 

<style>
img {
  float: left;
}
table > tr > th { position: absolute;
    top : 50%;
    left: 50%;
 border-bottom: 2px solid black;
    font-family: Helvetica, Arial, sans-serif;
        font-weight: bold;
}
table {
   
}
tr.no-bottom-border th {
   border-bottom: none;
  
}
table.first {
      border: 2px solid black;
    }
</style>
         



  

                        ';

 foreach ($data as $row) 
                {
                    $i++;
                    $html.='

 
 <h3 align="center">Memo Over Shift PT.KAHATEX</h3>

<table class="first" cellpadding="2" cellspacing="2">

                

<tr width="50%" valign="bottom" height="300"> 
 <th colspan="2"><img src="/MEMOold/production/berkas/img/EDIT.PNG" >  </th>
<th width="50%" valign="bottom" height="300" colspan="3">PT.KAHATEX </th> <th colspan="7">MEMO OVER SHIFT</th> <th colspan="5">Detail from Remarks</th> </tr>

 


 
<tr bgcolor="#ffffff">
<th align="center">No</th>
                            <th align="center">Shift</th>
                           
                        </tr>


<tr bgcolor="#ffffff">
                            <td align="center" rowspan="6">'.$i.'</td>
                             <th align="center">Shift</th>
                            
                            <td>'.$row['shift'].'</td>



 <th align="center">Shift</th>
                            
                            <td>'.$row['shift'].'</td>




                        </tr>



<tr bgcolor="#ffffff" class="no-bottom-border">
                           
                             <th align="center">Shift</th>
                            
                            <td>'.$row['shift'].'</td>



 <th align="center">Shift</th>
                            
                            <td>'.$row['shift'].'</td>



                            
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


 $html.='<table border="1"><tbody><tr valign="top">
<td width="30%">Title</td><td>:</td><td><strong><a href="/site_19.xhtml?get-q=Kepalang Restu  &amp;get-server=1">Kepalang Restu  </a></strong></td></tr>
<tr valign="top"><td width="30%">Album</td><td>:</td><td>Kepalang Restu - Single</td></tr><tr valign="top"><td width="30%">Artist</td><td>:</td>
<td><strong><a href="/site_19.xhtml?get-q=Nella Kharisma&amp;get-server=1">Nella Kharisma</a></strong></td></tr>
<tr valign="top"><td width="30%">Duration</td><td>:</td><td>03.77</td></tr>
<tr valign="top"><td width="30%">Audio Summary</td><td>:</td><td>Audio: mp3, 44100 Hz, stereo, s16p, 256 kb/s</td></tr>
<tr valign="top"><td width="30%">Bit Rate</td><td>:</td><td>256000</td></tr>
<tr valign="top"><td width="30%">Sample Rate</td><td>:</td><td>44100</td></tr>
<tr valign="top"><td width="30%">Added</td><td>:</td><td>2019-05-08</td></tr>
<tr valign="top"><td width="30%">Today</td><td>:</td><td>0x Downloaded</td></tr></tbody></table>




<table border="1">
   <tr>
      <td width="100%" colspan="4">
         <table border="0">
            <tr>
               <!-- This should work -->
               <td width="18%" style="border-right-style: dotted;">Test 1</td>
               <td width="12%">Test 2</td>
               <td width="20%">Test 3</td>
            </tr>
            <tr>
               <!-- As should this -->
               <td width="18%" style="border-right-style: dotted;">Test 4</td>
               <td width="12%">Test 5</td>
               <td width="20%">Test 6</td>
            </tr>
            <tr>
               <!-- However, this does not. -->
               <td width="18%" style="border-right-style: dotted">Test Broken</td>
               <td width="12%">Test :)</td>
               <td width="20%">Test :)</td>
            </tr>                
         </table>
      </td>
   </tr>
</table>


<table class="table tab-content" style="width:95%" align="center">
    <tr class="row">
        <td style="width:100px; height=100%;" rowspan="2">kkkk</td>
        <td colspan="2"><h4 class="h4">This is a new Car please call</h4></td>
    </tr>
    <tr>
        <td style="width:70%">this is a car ad this is a car adthis is a car adthis is a car adthis is a car ad
            this is a car adthis is a car adthis is a car adthis is a car adthis is a car ad
            this is a car ad this is a car adthis is a car adthis is a car adthis is a car ad
            this is a car adthis is a car adthis is a car ... &nbsp&nbsp <a style="font-weight:bold; color:Red" href="#">3 mins ago</a></td>
        <td  valign="top">$5000</td>
        <td><b>Smart Cars</b></td>
    </tr>
</table>


';

 




            


          


// store old margin values
$margins = $pdf->getMargins();

// set new left margin
$pdf->SetTopMargin(150);

// output the HTML content

$pdf->writeHTML($html, true, 0, true, true);

// restore the left margin
//$pdf->SetLeftMargin($margins['left']);

 

           //$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 1, true, 'C', true);

//hasil print
ob_end_clean();
$pdf->Output('prosedur-L-a4-table.pdf','I');




 
}

?>