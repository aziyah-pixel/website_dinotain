<?php
require "../include/function.php"; // Pastikan untuk menyertakan koneksi database

if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];
    $result = mysqli_query($connection, "SELECT harga FROM tbl_barang WHERE nama_barang = '$id_barang'");

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo $data['harga']; // Kembalikan harga barang
    } else {
        echo 0; // Jika tidak ditemukan, kembalikan 0
    }
}
?>