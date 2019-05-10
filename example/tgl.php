<!DOCTYPE html>
<html>
<head>
	<title>MENAMPILKAN DATA DARI DATABASE SESUAI TANGGAL DENGAN PHP - WWW.MALASNGODING.COM</title>
</head>
<body>

	<center>

		<h2>Memo Over Shift PT.KAHATEX</h2>


		<?php 
		include 'koneksi.php';
		?>

		<br/><br/><br/>

		
 <center>
        <tr><H1>Memo Over Shift PT.KAHATEX</H1></tr>
        <h3>Tambah data baru</h3>
       


<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputName2">Tanggal</label>
    <input type= "date" class="form-control" name="tanggal" id="tglp">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">Shift</label>
    <select class="form-control" name="shift">
   <option value=""> -- Pilih Shift -- </option>
                            <option value="pagi">Pagi</option>
                            <option value="sore">Sore</option>
</select>
   
  </div>

<div class="form-group">
    <label for="exampleInputEmail2">Garment</label>
    <select class="form-control" name="garment">
   <option value=""> -- Pilih Garment -- </option>
                            <option value="gm1">Garment 1</option>
                            <option value="gm2">Garment 2</option>
                            <option value="gm3">Garment 3</option>
                            <option value="gm4">Garment 4</option>
</select>
   
  </div>


  <button type="submit" class="btn btn-default">Tampilkan</button>
  <button type="submit" class="btn btn-default">Cetak pdf</button>
</form>



    </center>
 <hr>



   

     
  <table class="table table-bordered"> 
   




 <thead>
      <tr>
        <th>SHIFT</th>
        <th>LINE</th>
        <th>STYLE </th>
           <th>TGT EFF% </th>   <th>HARI KE </th>   <th>RFT% </th>   <th>ORDER </th>   <th>STYLE </th>   <th>STYLE </th>   <th>STYLE </th>   <th>STYLE </th>   <th>STYLE </th>   <th>STYLE </th>   <th>STYLE </th>   <th>STYLE </th>   <th>STYLE </th>   <th>STYLE </th>
      </tr>
    </thead>
      <?php 
      $no = 1;





if(isset($_GET['tanggal']) && !empty($_GET['tanggal']) && isset($_GET['shift']) && !empty($_GET['shift']) && isset($_GET['garment']) && !empty($_GET['garment']))
{
      
        $tgl = $_GET['tanggal'];
        $sft = $_GET['shift'];
        $gmr = $_GET['garment'];
        //$sql = mysqli_query($connect,"select * from barang_masuk where tanggal='$tgl'");
//$sql=" SELECT * FROM nama WHERE fname like '%".$nama."%' OR barang_masuk like '%".$tgl."%'";
$sql = mysqli_query($connect,"SELECT * FROM $gmr WHERE tgl='$tgl' AND shift like '%".$sft."%'");

      
      
      while($data = mysqli_fetch_array($sql)){
      ?>

 
 <tbody>
      <tr>
        <td><?php echo $data['shift']; ?></td>
      <td><?php echo $data['line']; ?></td>
      <td><?php echo $data['rft']; ?></td>
       
      </tr>
      
    </tbody>





     
      <?php 
      }
    }
      ?>
    </table>





 
                      </div></form>
</body>
</html>