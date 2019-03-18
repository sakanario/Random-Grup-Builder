<link rel="stylesheet" href="random.css"/>

<?php
  if(isset($_POST['submit1'])){
    setcookie('namaKelas',$_POST['kelas'],time()+1000);
    header('Location:input.php');
  }
?>

 <div style = "display: flex;justify-content:   center;">
     <h1>Selamat Datang di Web Pembuat Kelompok!</h1>
   </div>
   <div style = "display: flex;justify-content:   center;">
     Web ini akan membantu kamu membuat kelompok dengan acak dengan menjunjung tinggi keadilan!!
     </div>

<div style="border: 0px solid #f1f1f1;" class="container">

  <form style="border: 3px solid #f1f1f1;padding-left:30px;padding-right:30px;margin-top:20px;"action='baru.php' method="post" >
    <div style = "display: flex;justify-content:   center;">
      <span>Kamu kosma yang mau buat kelas?</span>
    </div>
    <input style = "margin-top: 30px;"class="tombol" type="submit" name="baruu" value="Buat Kelas Baruu!">
  </form>

  <form style="border: 3px solid #f1f1f1;" action="index.php" method="post">
    <div style = "display: flex;justify-content:   center;">
      <span>Kosma sudah buatin kelas? <br><br></span>
    </div>
    Kode kelas : <input type="text" name="kelas" value="">
    <input class="tombol" type="submit" name="submit1" value="Menuju ke kelas mu!!">
  </form>

</div>
