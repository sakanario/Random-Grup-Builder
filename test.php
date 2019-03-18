<?php
// if(isset($_POST['submit'])){
  // $link = mysqli_connect('127.0.0.1','root','root','Sasuke');
//   $rand = rand(0,3);
//
//   $query = "INSERT INTO bernekle" . $rand . "(nama) VALUES ('Genji') ";
//   echo $query;
//   if (mysqli_query($link,$query)){
//     echo "Data berhasil dimasukkan!";
//   }else{
//     echo "Gagal memasukkan data.";
//   }
// $a = 0;
// while ($a != 1) {
//   echo $a;
//   $a = 1;

  // $count = 0;
  // for ($i=0; $i < 2 ; $i++) {
  //   echo $i;
    // $query = "SELECT * FROM " . $_COOKIE['namaKelas'] . $i ;
    // $status = mysqli_query($link,$query);
    // if ( mysqli_num_rows($status) >= $_COOKIE['jumlahData'] ){
    //   $count = $count + 1;
    // }
//     for ($i=0; $i < 2; $i++) {
//       $query = "SELECT * FROM " . $_COOKIE['namaKelas'] . $i;
//       echo $query. "<br>";
//       // $query = "SELECT * FROM Sasuke" . $i;
//       $hasil = mysqli_query($link,$query);
//
//       echo "Kelompok " . ($i+1) . "<br>";
//
//       if ( mysqli_num_rows($hasil) > 0 ){
//         while ($data = mysqli_fetch_assoc($hasil)) {
//           echo $data['nama'] . "<br>";
//         }
//       }
//       echo "<br>";
//     }
//
// mysqli_close($link);
$namaKelas = 'pahlawan';
$kelompok = 10;
$jumlahData = 5;
$query = "INSERT INTO metadata(namaKelas ,jumlahKelompok, jumlahData) VALUES ('" . $namaKelas  . "'," . $kelompok . "," . $jumlahData . ")";

echo $query;

 ?>

 <div class="container">
   <form class="" action="test.php" method="post">
     Nama : <input type="text" name="nama" value="">
     <input class="tombol" type="submit" name="submit" value="Go!!">
   </form>
 </div>
