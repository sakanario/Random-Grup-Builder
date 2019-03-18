<link rel="stylesheet" href="random.css" />

<div style = "display: flex;justify-content:   center;">
  <h1 >Buat Kelas Baru</h1>
</div>
<div class="container">
  <form class="" action="baru.php" method="post">
    Nama Kelas        :  <input type="text" name="namaKelas" value="">
    <span style="float : right;">note : Jangan pakai spasi ya!!</span>

    <div style="margin-top : 30px;">
      Jumlah Siswa      : <input class="angka" type="number" name="jumlah" value="">
    </div>
    Jumlah Kelompok yang akan di buat : <input type="number" name="jumlahKelompok" value="">
    <span style="float : right;text-align:right; ">note : Jumlah anggota setiap kelompok adalah jumlah siswa dibagi dengan jumlah kelompoknya, Max anggota 25/kelompok.</span>
    <span style=""></span>

    <input style="margin-top : 40px;" class="tombol" type="submit" name="submit" value="Go!!">
  </form>
</div>

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
      $jumlahData = round($siswa/$kelompok);

      //BUAT TABLE METADATA
      $query = "CREATE TABLE metadata (namaKelas VARCHAR(20) NOT NULL,jumlahKelompok INT(10), jumlahData INT(10))";
      if (mysqli_query($link,$query)){
        echo "Table berhasil dibuat!";
      }else{
        echo "Gagal Buat Table.";
      }

      //INPUT METADATA
      $query = "INSERT INTO metadata(namaKelas ,jumlahKelompok, jumlahData) VALUES ('" . $namaKelas  . "'," . $kelompok . "," . $jumlahData . ")";
      if (mysqli_query($link,$query)){
        echo "Data berhasil dimasukkan!";
      }else{
        echo "Gagal memasukkan data.";
      }

      //BUAT TABLE SEBANYAK JUMLAH KELOMPOKNYA
      for ($i=0; $i < $kelompok; $i++) {
        $query = "CREATE TABLE " . $namaKelas . $i ." (id INT AUTO_INCREMENT,nama VARCHAR(20) NOT NULL,primary key (id))";
        if (mysqli_query($link,$query)){
          echo "Table " . $namaKelas . $i ." berhasil dibuat!";

          header('Location:input.php');
        }else{
          echo "Gagal Buat Table.";
        }
      }
    }else{
      echo "Database gagal dibuat!";
    }
  }
  mysqli_close($link);


  ?>
