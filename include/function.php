<?php

$host = "localhost";
$username = "root";
$password = "";
$database_name = "db_dinotain";
$connection = mysqli_connect($host, $username, $password, $database_name);

// Menambahkan data barang 
function tambahBarang($dataBarang) {
  global $connection;
  
  $id_user = htmlspecialchars($dataBarang["id_user"]);
  $idbarang = htmlspecialchars($dataBarang["id_barang"]);
  $namabarang = htmlspecialchars($dataBarang["nama_barang"]);
  $harga = htmlspecialchars($dataBarang["harga"]);  
  
  $queryInsertDataBarang = "INSERT INTO tbl_barang VALUES('$id_user', '$idbarang', '$namabarang', '$harga')";
  
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

// delete data barang


// Menambahkan data Pelangan 
function tambahPelangan($dataPelangan) {
  global $connection;
  
  $iduser = htmlspecialchars($dataPelangan["id_user"]);
  $namaPelangan = htmlspecialchars($dataPelangan["nama_pelangan"]);
  $alamat = htmlspecialchars($dataPelangan["alamat"]);
  $noTelepon = htmlspecialchars($dataPelangan["noTelepon"]);  
  
  $queryInsertDataPelangan = "INSERT INTO tbl_pelangan (id_user, nama_pelangan, alamat, no_telep) VALUES ('$iduser', '$namaPelangan', '$alamat', '$noTelepon')";
  
  mysqli_query($connection, $queryInsertDataPelangan);
  return mysqli_affected_rows($connection);
  
}    

//update data pelangan
if(isset($_POST['update_pelangan'])){
  $idpelangan = $_POST['idpelangan'];
  $namaPelangan = $_POST['namaPelangan'];
  $alamat = $_POST['alamat'];
  $telepon = $_POST['telepon'];
  
  $updatePelangan = mysqli_query($connection,"UPDATE tbl_pelangan SET nama_pelangan='$namaPelangan', alamat='$alamat', no_telep='$telepon' ");

  if($updatePelangan){
    header('location:dataPelangan.php');
    } else {
      echo"<script>
      alert('Data pelangan gagal diupdate!');
      </script>";
    }
}

//hapus pelangan
if(isset($_POST['hapus_pelangan'])){
  $idpelangan = $_POST['idPelangan'];

  $hapuspelangan = mysqli_query($connection,"DELETE FROM tbl_pelangan WHERE id_pelangan='$idpelangan'");
  if($hapuspelangan){
    header('location:dataPelangan.php');
  }else{
    echo"<script>
      alert('Data gagal dihapus!');
      </script>";
  }
} 

//membaca tabel
function queryReadData($dataKategori) {
  global $connection;//global mengakses variabel yang di definisikan di luar function dan sebaliknya,
  $result = mysqli_query($connection, $dataKategori);
  $items = [];
  while($item = mysqli_fetch_assoc($result)) {
    $items[] = $item;
  }     
  return $items;
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

?>