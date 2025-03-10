<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database_name = "db_dinotain";
$connection = mysqli_connect($host, $username, $password, $database_name);


// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($connection,"SELECT * FROM tbl_user WHERE username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

 $data = mysqli_fetch_assoc($login);

 // cek jika user login sebagai admin
 if($data['level']=="admin"){

  // buat session login dan username
  $_SESSION['login'] = true;
  $_SESSION['username'] = $username;
  $_SESSION['level'] = "admin";
  // alihkan ke halaman dashboard admin
  header("location:../admin/index.php");

 // cek jika user login sebagai pegawai
 }else if($data['level']=="user"){
  // buat session login dan username
  $_SESSION['login'] = true;
  $_SESSION['username'] = $username;
  $_SESSION['level'] = "user";
  // alihkan ke halaman dashboard pegawai
  header("location: ../html/index.php");

 }else{

  // alihkan ke halaman login kembali
  header("location:index.php?pesan=gagal");
 } 
}else{
 header("location:index.php?pesan=gagal");
}

?>