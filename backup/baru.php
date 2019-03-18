<link rel="stylesheet" href="random.css" />
<?php
// CONNECT DATABASE
$link = mysqli_connect('127.0.0.1','root','root');
if(!$link){
  echo "<br>";
  die('ada error <br>' . mysqli_connect_error());
}

//SUMBIT DI TEKAN
if(isset($_POST['submit'])){
  //BUAT DATABASE BARU DENGAN NAMA KELAS
  $namaKelas = $_POST['namaKelas'];
  setcookie('namaKelas',$namaKelas,time()+1000);

  $query = "CREATE DATABASE $namaKelas";
  if( mysqli_query($link,$query) ){
    echo "Database berhasil dibuat!";
  }else{
    echo "Database gagal dibuat!";
  }
  //SAMBUNG KE DATABASE YANG BARU DIBUAT
  mysqli_close($link);
  $link = mysqli_connect('127.0.0.1','root','root',$namaKelas);
  if(!$link){
    echo "<br>";
    die('ada error <br>' . mysqli_connect_error());
  }
// BUAT TABLE SESUAI JUMLAH KELOMPOK
  $siswa = $_POST['jumlah'];
  $kelompok =  $_POST['jumlahKelompok'];
  setcookie('kelompok',$kelompok,time()+1000);

  $jumlahData = round($siswa/$kelompok);
  setcookie('jumlahData',$kelompok,time()+1000);

  for ($i=0; $i < $kelompok; $i++) {
    $query = "CREATE TABLE " . $namaKelas . $i ." (id INT AUTO_INCREMENT,nama VARCHAR(20) NOT NULL,primary key (id))";
    if (mysqli_query($link,$query)){
      echo "Table " . $namaKelas . $i ." berhasil dibuat!";
      header('Location:input.php');
    }else{
      echo "Gagal Buat Table.";
    }
  }

}
mysqli_close($link);


 ?>

<h1>Ini Kelas Baru</h1>
<div class="container">
  <form class="" action="baru.php" method="post">
    Nama Kelas        : <input type="text" name="namaKelas" value="">
    Jumlah Siswa      : <input class="angka" type="number" name="jumlah" value="">
    Jumlah Kelompok yang akan di buat : <input type="number" name="jumlahKelompok" value="">
    <input class="tombol" type="submit" name="submit" value="Go!!">
  </form>
</div>
