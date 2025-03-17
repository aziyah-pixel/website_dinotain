<?php
require "../include/function.php"; // Pastikan koneksi database sudah ada

if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    // Ambil harga dan ID barang dari database
    $query = "SELECT id_barang, harga FROM tbl_barang WHERE nama_barang = '$id_barang'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        if ($data) {
            // Mengembalikan data dalam format JSON
            echo json_encode([
                'harga' => $data['harga'],
                'id_barang' => $data['id_barang']
            ]);
        } else {
            echo json_encode(['harga' => null, 'id_barang' => null]);
        }
    } else {
        echo json_encode(['harga' => null, 'id_barang' => null]);
    }
} else {
    echo json_encode(['harga' => null, 'id_barang' => null]);
}
?>