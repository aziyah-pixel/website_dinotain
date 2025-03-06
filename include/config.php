<?php
$host     = "localhost";    // Nama host
$username = "root";         // Username database
$password = "";  		    // Password database
$database = "dinotain";   // Nama database

/**
 * FUngsi koneksi database.
 */
function conn($host, $username, $password, $database)
{
    $conn = mysqli_connect($host, $username, $password, $database);
    // Menampilkan pesan error jika database tidak terhubung
    return ($conn) ? $conn : "Koneksi database gagal: " . mysqli_connect_error();
}

$config = conn($host, $username, $password, $database);

?>