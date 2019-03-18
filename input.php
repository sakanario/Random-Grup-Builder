<link rel="stylesheet" href="random.css" />
<div style="">
  <?php

  // CONNECT DATABASE
  $link = mysqli_connect('127.0.0.1','root','root',$_COOKIE['namaKelas']);
  //AMBIL INFORMASI METADATA
  $query = "SELECT * FROM metadata";
  $hasil = mysqli_query($link,$query);
  $data = mysqli_fetch_assoc($hasil);
  $namaKelas = $data['namaKelas'];
  $jumlahKelompok = $data['jumlahKelompok'];
  $jumlahData = $data['jumlahData'];
  $pesan = "";


  if(isset($_POST['submit'])){

    if(!$link){
      echo "<br>";
      die('ada error <br>' . mysqli_connect_error());
    }

    if( isset($namaKelas) && isset($jumlahKelompok) && isset($jumlahData) && isset($_POST['nama'])){
      // MENGECEK SATU-SATU KELOMPOK ADA YANG MASIH KOSONG ATAU TIDAK
      $count = 0;
      for ($i=0; $i < $jumlahKelompok ; $i++) {
        $query = "SELECT * FROM " . $namaKelas . $i ;
        $status = mysqli_query($link,$query);
        if ( mysqli_num_rows($status) >= $jumlahData ){
          $count = $count + 1;
        }
      }
      // MENGECEK SATU-SATU KELOMPOK ADA YANG MASIH KOSONG ATAU TIDAK
      if( $count < $jumlahKelompok ){
        $a = 0;
        //PERULANGAN BILA KELOMPOK YANG MAU DIMASUKKIN UDAH PENUH
        while ($a != 1) {
          $rand = rand(0,($jumlahKelompok-1));

          $query = "SELECT * FROM " . $namaKelas . $rand ;
          $status = mysqli_query($link,$query);

          if ( mysqli_num_rows($status) < $jumlahData ) {

            $query = "INSERT INTO " . $namaKelas . $rand . "(nama) VALUES ('" . $_POST['nama'] . "') ";

            if (mysqli_query($link,$query)){
              $pesan ="Data berhasil dimasukkan!";
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


  }
  echo "Nama Kelas : " . $namaKelas . "  <br>";
  echo "Jumlah anggota maksimum per kelompok : " . $jumlahData ."  <br><br>";
  //KELUARIN ISINYA
  for ($i=0; $i < $jumlahKelompok; $i++) {
    $query = "SELECT * FROM " . $namaKelas . $i;
    $hasil = mysqli_query($link,$query);

    echo "Kelompok " . ($i+1) . "<br>";

    if ( mysqli_num_rows($hasil) > 0 ){
      while ($data = mysqli_fetch_assoc($hasil)) {
        echo $data['nama'] . "<br>";
      }
    }
    echo "<br>";
  }


  echo $pesan;

  mysqli_close($link);
  ?>
</div>

<div class="mid">
  <!--  untuk membuat tombol ketengah butuh bantuan div biar dia ditengahnya div -->
  <button class="tombol tombol1" onclick="muncul()">Tap untuk masukin nama kamu!</button>
</div>

<div id="id01" style="border: 1px solid #ccc;" class="modal">

    <form class="modal-content animate" action="input.php" method="post">
      Nama : <input type="text" name="nama" value="">
      <input class="tombol" type="submit" name="submit" value="Go!!">
    </form>

</div>

<script src="anu.js" type="text/javascript"></script>
