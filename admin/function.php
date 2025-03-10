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


?>