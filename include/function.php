<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database_name = "db_dinotain";
$connection = mysqli_connect($host, $username, $password, $database_name);

// Menambahkan data barang 
function tambahBarang($dataBarang) {
  global $connection;
  
  $idbarang = htmlspecialchars($dataBarang["id_barang"]);
  $namabarang = htmlspecialchars($dataBarang["nama_barang"]);
  $harga = htmlspecialchars($dataBarang["harga"]);  
  
  $queryInsertDataBarang = "INSERT INTO tbl_barang VALUES('$idbarang', '$namabarang', '$harga')";
  
  mysqli_query($connection, $queryInsertDataBarang);
  return mysqli_affected_rows($connection);
  
}  

// Updete data Barang
if(isset($_POST['update_barang'])){
  $kodeBarang = $_POST['idBarang'];
  $namabarang = $_POST['namabarang'];
  $harga = $_POST['harga'];

  $update = mysqli_query($connection,"UPDATE tbl_barang SET nama_barang='$namabarang', harga='$harga' WHERE id_barang='$kodeBarang'");
  if($update){
    header('location:../html/laporanBarang.php');
    } else {
      echo"<script>
      alert('Data Barang gagal diupdate!');
      </script>";
    }
}


// Menambahkan data Pelangan 
function tambahPelangan($dataPelangan) {
  global $connection;
  
  $namaPelangan = htmlspecialchars($dataPelangan["nama_pelangan"]);
  $alamat = htmlspecialchars($dataPelangan["alamat"]);
  $noTelepon = htmlspecialchars($dataPelangan["noTelepon"]);  
  
  $queryInsertDataPelangan = "INSERT INTO tbl_pelangan (nama_pelangan, alamat, no_telep) VALUES ('$namaPelangan', '$alamat', '$noTelepon')";
  
  mysqli_query($connection, $queryInsertDataPelangan);
  return mysqli_affected_rows($connection);
  
}       

?>