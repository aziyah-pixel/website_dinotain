<?php

$host = "localhost";
$username = "root";
$password = "";
$database_name = "db_dinotain";
$connection = mysqli_connect($host, $username, $password, $database_name);

if(isset($_POST["login"]) ) {
  
    $username = strtolower($_POST["username"]);
    $password = $_POST["password"];
    
    // menggunakan prepared statements untuk keamanan
    $stmt = $connection->prepare("SELECT * FROM tbl_user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($result);

    // cek apakah username dan password di temukan pada database
    if($cek > 0){

    $data = mysqli_fetch_assoc($result);
    $id_user = $data['id_user'];

    // cek jika login sebagai admin
    if($data['level']=="admin"){

    // buat session login dan username
    $_SESSION['login'] = true;
    $_SESSION['tbl_user']['username'] = $username;
    $_SESSION['tbl_user']['level'] = "admin";
    $_SESSION['tbl_user']['id_user'] = $id_user;
    // alihkan ke halaman dashboard admin
    header("location:../admin/index.php");
    exit;

    // cek jika login sebagai user
    }else if($data['level']=="user"){
    // buat session login dan username
    $_SESSION['login'] = true;
    $_SESSION['tbl_user']['username'] = $username;
    $_SESSION['tbl_user']['level'] = "user";
    $_SESSION['tbl_user']['id_user'] = $id_user; 
    // alihkan ke halaman dashboard user
    header("location: ../html/index.php");
    exit;
    }else{

    // alihkan ke halaman login kembali
    header("location:index.php?pesan=gagal");
    } 
    }
}
    


    ?>