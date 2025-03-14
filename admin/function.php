<?php

$host = "localhost";
$username = "root";
$password = "";
$database_name = "db_dinotain";
$connection = mysqli_connect($host, $username, $password, $database_name);

// Updete data Barang
if(isset($_POST['update_user'])){
    $iduser = $_POST['iduser'];
    $namauser = $_POST['namauser'];
    $namausaha = $_POST['namausaha'];
    $katagori = $_POST['katagori'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat']; 
    
    $updateUser = mysqli_query($connection,"UPDATE tbl_user SET full_nama='$namauser', nama_usaha='$namausaha', katagori_usaha='$katagori', email='$email', no_tel='$telepon', alamat='$alamat' WHERE id_user='$iduser'");

    if($updateUser){
      header('location:dataUser.php');
      } else {
        echo"<script>
        alert('Data User gagal diupdate!');
        </script>";
      }
}

//hapus data user
if(isset($_POST['hapus_user'])){
  $iduser = $_POST['id_user'];
  var_dump($iduser); // Debugging: lihat nilai id_user

  $hapusUser = mysqli_query($connection,"DELETE FROM tbl_user WHERE id_user='$iduser'");
  if($hapusUser){
    header('location:dataUser.php');
  }else{
    echo"<script>
      alert('Data user gagal dihapus!');
      </script>";
  }
} 

// Menambahkan data Katagori 
function tambahKatagori($dataKatagori) {
  global $connection;
  
  $idkatagori = htmlspecialchars($dataKatagori["idkatagori"]);
  $namakatagori = htmlspecialchars($dataKatagori["namakatagori"]);
  
  $queryInsertDataKatagori = "INSERT INTO tbl_katagori VALUES('$idkatagori', '$namakatagori')";
  
  mysqli_query($connection, $queryInsertDataKatagori);
  return mysqli_affected_rows($connection);
  
}  

// Updete data Katagori
if(isset($_POST['update_katagori'])){
  $idkatagori = $_POST['id_katagori'];
  $namakatagori = $_POST['namaKatagori'];
  
  $updateKatagori = mysqli_query($connection,"UPDATE tbl_katagori SET nama_katagori='$namakatagori' WHERE id_katagori='$idkatagori'");

  if($updateKatagori){
    header('location:dataKatagori.php');
    } else {
      echo"<script>
      alert('Data Katagori gagal diupdate!');
      </script>";
    }
}

//menghapus data katagori
if(isset($_POST['hapus_Katagori'])){
  $idkatagori = $_POST['idKatagori'];

  $hapuskatagori = mysqli_query($connection,"DELETE FROM tbl_katagori WHERE id_katagori='$idkatagori'");
  if($hapuskatagori){
    header('location:dataKatagori.php');
  }else{
    echo"<script>
      alert('Data Katagori gagal dihapus!');
      </script>";
  }
} 

//Menambahkan data Provinsi
function tambahProvinsi($dataProvinsi) {
  global $connection;
  
  $idprovinsi = htmlspecialchars($dataProvinsi["idprovinsi"]);
  $namaprovinsi = htmlspecialchars($dataProvinsi["namaprovinsi"]);
  
  $queryInsertDataProvinsi = "INSERT INTO tbl_provinsi VALUES('$idprovinsi', '$namaprovinsi')";
  
  mysqli_query($connection, $queryInsertDataProvinsi);
  return mysqli_affected_rows($connection);
  
}  

// Updete data Provinsi
if(isset($_POST['update_provinsi'])){
  $idprovinsi = $_POST['id_provinsi'];
  $namaprovinsi = $_POST['namaProvinsi'];
  
  $updateProvinsi = mysqli_query($connection,"UPDATE tbl_provinsi SET provinsi='$namaprovinsi' WHERE id_provinsi='$idprovinsi'");

  if($updateProvinsi){
    header('location:dataProvinsi.php');
    } else {
      echo"<script>
      alert('Data Provinsi gagal diupdate!');
      </script>";
    }
}

//menghaus data provinsi
if(isset($_POST['hapus_provinsi'])){
  $idprovinsi = $_POST['idProvinsi'];

  $hapusProvinsi = mysqli_query($connection,"DELETE FROM tbl_provinsi WHERE id_provinsi='$idprovinsi'");
  if($hapusProvinsi){
    header('location:dataProvinsi.php');
  }else{
    echo"<script>
      alert('Data Provinsi gagal dihapus!');
      </script>";
  }
} 

//menambahkan data artikel 
function tambahArtikel($dataArtikel) {
  global $connection;
  
  $idArtikel = htmlspecialchars($dataArtikel["id_artikel"]);
  $kategoriArtikel = $dataArtikel["katagori_artikel"];
  $judulArtikel = htmlspecialchars($dataArtikel["judul_artikel"]);
  $img = uploadimg();
  $isi = htmlspecialchars($dataArtikel["isi_artikel"]);
  $link = htmlspecialchars($dataArtikel["url_artikel"]);
  $tangal = $dataArtikel["date_artikel"];
  
  if(!$img) {
    return 0;
  } 
  
  $queryInsertDataArtikel = "INSERT INTO tbl_artikel VALUES('$idArtikel', '$kategoriArtikel', '$img', '$judulArtikel', '$isi', '$link', '$tangal')";
  
  mysqli_query($connection, $queryInsertDataArtikel);
  return mysqli_affected_rows($connection);
  
}       

// Function upload gambar 
function uploadimg() {
  $namaFile = $_FILES["foto_artikel"]["name"];
  $ukuranFile = $_FILES["foto_artikel"]["size"];
  $error = $_FILES["foto_artikel"]["error"];
  $tmpName = $_FILES["foto_artikel"]["tmp_name"];
  
  // cek apakah ada gambar yg diupload
  if($error === 4) {
    echo "<script>
    alert('Silahkan upload foto terlebih dahulu!')
    </script>";
    return 0;
  }
  
  // cek kesesuaian format gambar
  $jpg = "jpg";
  $jpeg = "jpeg";
  $png = "png";
  $svg = "svg";
  $bmp = "bmp";
  $psd = "psd";
  $tiff = "tiff";
  $formatGambarValid = [$jpg, $jpeg, $png, $svg, $bmp, $psd, $tiff];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  
  if(!in_array($ekstensiGambar, $formatGambarValid)) {
    echo "<script>
    alert('Format file tidak sesuai');
    </script>";
    return 0;
  }
  
  // batas ukuran file
  if($ukuranFile > 2000000) {
    echo "<script>
    alert('Ukuran file terlalu besar!');
    </script>";
    return 0;
  }
  
   //generate nama file baru, agar nama file tdk ada yg sama
  $namaFileBaru = uniqid();
  $namaFileBaru .= ".";
  $namaFileBaru .= $ekstensiGambar;
  
  move_uploaded_file($tmpName, 'imgDB/' . $namaFileBaru);
  return $namaFileBaru;
} 

//membaca data
function queryReadData($dataKategori) {
  global $connection;//global mengakses variabel yang di definisikan di luar function dan sebaliknya,
  $result = mysqli_query($connection, $dataKategori);
  $items = [];
  while($item = mysqli_fetch_assoc($result)) {
    $items[] = $item;
  }     
  return $items;
}

// UPDATE data artikel 
function updateartikel($dataArtikel) {
  global $connection;

  $gambarLama = htmlspecialchars($dataArtikel["fotoLama"]);
  $idArtikel = htmlspecialchars($dataArtikel["id_artikel"]);
  $kategoriArtikel = $dataArtikel["katagori_artikel"];
  $judulArtikel = htmlspecialchars($dataArtikel["judul_artikel"]);
  $isiArtikel = htmlspecialchars($dataArtikel["isi_artikel"]);
  $link = htmlspecialchars($dataArtikel["url_artikel"]);
  $tanggal = $dataArtikel["date_artikel"];  
  
  // pengecekan mengganti gambar || tidak
  if($_FILES["foto_artikel"]["error"] === 4) {
    $foto = $gambarLama;
  }else {
    $foto = uploadimg();
  }
  // 4 === gagal upload gambar
  // 0 === berhasil upload gambar
  
  $queryUpdateArtikel = "UPDATE tbl_artikel SET 
  id_artikel = '$idArtikel',
  katagori_artikel = '$kategoriArtikel',
  foto = '$foto',
  judul_artikel = '$judulArtikel',
   isi = '$isiArtikel',
  link = '$link',
  tanggal = '$tanggal'
  WHERE id_artikel = '$idArtikel'
  ";
  
  mysqli_query($connection, $queryUpdateArtikel);
  return mysqli_affected_rows($connection);
}

//hapus artikel
if(isset($_POST['hapus_artikel'])){
  $idArtikel = $_POST['idArtikel'];

  $hapusArtikel = mysqli_query($connection,"DELETE FROM tbl_artikel WHERE id_artikel='$idArtikel'");
  if($hapusArtikel){
    header('location:index.php');
  }else{
    echo"<script>
      alert('Data Provinsi gagal dihapus!');
      </script>";
  }
} 

//mencari data
function searchartikel($keyword) {
  // search data artikel
  $querySearch = "SELECT * FROM tbl_artikel 
  WHERE
  judul_artikel LIKE '%$keyword%' OR
  katagori_artikel LIKE '%$keyword%'
  ";
  return queryReadData($querySearch);
}

//memberi tangapan
if(isset($_POST['update_pesan'])){
  $idPesan = $_POST['id_pesan'];
  $balasan = $_POST['balasan'];
  
  $updatePesan = mysqli_query($connection,"UPDATE tbl_inbox_cs SET tanggapan='$balasan' WHERE id_inbox='$idPesan'");

  if($updatePesan){
    header('location:laporanPesan.php');
    } else {
      echo"<script>
      alert('pesan gagal dibalas!');
      </script>";
    }
}

// Updete data transaksi
if(isset($_POST['transaksi'])){
  $transaksi = $_POST['idtransaksi'];
  $total = $_POST['total'];
  $bayar = $_POST['bayar'];
  $tanggal = $_POST['to'];
  
  $updateTransaksi = mysqli_query($connection,"UPDATE tbl_transaksi SET total='$total', total_bayar='$bayar', tanggal='$tanggal' WHERE kode_transaksi='$transaksi'");

  if($updateTransaksi){
    header('location:.php');
    } else {
      echo"<script>
      alert('Data User gagal diupdate!');
      </script>";
    }
}

?>