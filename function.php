<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database_name = "db_dinotain";
$connection = mysqli_connect($host, $username, $password, $database_name);

// Menambahkan data barang 
if(isset($_POST['tambahBarang'])){
  $idproduk = $_POST['id_barang'];
  $namaproduk = $_POST['nama_barang'];
  $stok = $_POST['stok'];
  
  $tambahDataBarang = mysqli_query($connection," insert into tbl_barang values ('$idproduk', '$namaproduk', '$stok')");

  if($tambahDataBarang){
    echo "<script>
    alert('Data barang berhasil ditambahkan!');
    </script>";
  }else{
      echo "<script>
      alert('Data barang gagal ditambahkan!');
      </script>";
  }
}
?>