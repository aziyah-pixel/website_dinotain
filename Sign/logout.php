<?php 
// Logout untuk menghilangkan Session
session_start();
$_SESSION = [];
session_unset();// hanya menghapus sesi agar dapat digunakan
session_destroy();//menghancurkan semua data yang terkait dengan sesi saat ini.

header("Location:login.php");
  exit;
?>