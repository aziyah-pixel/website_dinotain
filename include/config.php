<?php

$host = "localhost";
$username = "root";
$password = "";
$database_name = "db_dinotain";
$connection = mysqli_connect($host, $username, $password, $database_name);

if(isset($_POST["login"]) ) {
  
    $username = strtolower($_POST["username"]);
    $password = $_POST["password"];
    
    $result = mysqli_query($connection, "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'");
    
    // menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($result);

    // cek apakah username dan password di temukan pada database
    if($cek > 0){

    $data = mysqli_fetch_assoc($result);

    // cek jika login sebagai admin
    if($data['level']=="admin"){

    // buat session login dan username
    $_SESSION['login'] = true;
    $_SESSION['tbl_user']['username'] = $username;
    $_SESSION['tbl_user']['level'] = "admin";
    // alihkan ke halaman dashboard admin
    header("location:../admin/index.php");
    exit;

    // cek jika login sebagai user
    }else if($data['level']=="user"){
    // buat session login dan username
    $_SESSION['login'] = true;
    $_SESSION['tbl_user']['username'] = $username;
    $_SESSION['tbl_user']['level'] = "user";
    // alihkan ke halaman dashboard pegawai
    header("location: ../html/index.php");

    }else{

    // alihkan ke halaman login kembali
    header("location:index.php?pesan=gagal");
    } 
    }
}
    


    ?>