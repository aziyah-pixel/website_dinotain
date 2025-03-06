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
  $stok = htmlspecialchars($dataBarang["stok"]);  
  
  $queryInsertDataBarang = "INSERT INTO tbl_barang VALUES('$idbarang', '$namabarang', '$stok')";
  
  mysqli_query($connection, $queryInsertDataBarang);
  return mysqli_affected_rows($connection);
  
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