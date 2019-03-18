
<?php
if(isset($_POST['submit'])){
  $link = mysqli_connect('127.0.0.1','root','root',$_COOKIE['namaKelas']);
  // CONNECT DATABASE
  // $link = mysqli_connect('127.0.0.1','root','root','haduh');

  if(!$link){
    echo "<br>";
    die('ada error <br>' . mysqli_connect_error());
  }
  if( isset($_COOKIE['namaKelas']) && isset($_COOKIE['kelompok']) && isset($_COOKIE['jumlahData']) && isset($_POST['nama'])){
    // MENGECEK SATU-SATU KELOMPOK ADA YANG MASIH KOSONG ATAU TIDAK
    $count = 0;
    for ($i=0; $i < $_COOKIE['kelompok'] ; $i++) {
      $query = "SELECT * FROM " . $_COOKIE['namaKelas'] . $i ;
      $status = mysqli_query($link,$query);
      if ( mysqli_num_rows($status) >= $_COOKIE['jumlahData'] ){
        $count = $count + 1;
      }
    }
    // MENGECEK SATU-SATU KELOMPOK ADA YANG MASIH KOSONG ATAU TIDAK
    if( $count < $_COOKIE['kelompok'] ){
      $a = 0;
      //PERULANGAN BILA KELOMPOK YANG MAU DIMASUKKIN UDAH PENUH
      while ($a != 1) {
        $rand = rand(0,($_COOKIE['kelompok']-1));

        $query = "SELECT * FROM " . $_COOKIE['namaKelas'] . $rand ;
        $status = mysqli_query($link,$query);

        if ( mysqli_num_rows($status) < $_COOKIE['jumlahData'] ) {

          $query = "INSERT INTO " . $_COOKIE['namaKelas'] . $rand . "(nama) VALUES ('" . $_POST['nama'] . "') ";

          if (mysqli_query($link,$query)){
            echo "Data berhasil dimasukkan! <br><br>";
            $a = 1;
          }else{
            echo "Gagal memasukkan data.<br><br>";
            $a = 1;
          }
        }
        // echo "<br>" . $query;
      }
    }else {
      echo "Maaf Semua Kelompok Sudah Penuh.<br><br>";
    }
  }else{
    echo 'Maaf Sesi Bearakhir<br><br>';
  }

  //KELUARIN ISINYA
  for ($i=0; $i < $_COOKIE['kelompok']; $i++) {
    $query = "SELECT * FROM " . $_COOKIE['namaKelas'] . $i;
    $hasil = mysqli_query($link,$query);

    echo "Kelompok " . ($i+1) . "<br>";

    if ( mysqli_num_rows($hasil) > 0 ){
      while ($data = mysqli_fetch_assoc($hasil)) {
        echo $data['nama'] . "<br>";
      }
    }
    echo "<br>";
  }

  mysqli_close($link);
}

?>

<h1>Isi form untuk masukin nama kamu!</h1>
<div class="container">
  <form class="" action="input.php" method="post">
    Nama : <input type="text" name="nama" value="">
    <input class="tombol" type="submit" name="submit" value="Go!!">
  </form>
</div>
