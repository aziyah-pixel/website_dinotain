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

//seting akun
function updateAkun($account) {
  global $connection;

  // Ambil account dari array $account
  $id_user = $account['iduser'];
  $nama = $account['nama'];
  $nama_usaha = $account['nama_usaha'];
  $katagori_usaha = $account['kusaha'];
  $email = $account['email'];
  $no_tel = $account['phoneNumber'];
  $provinsi = $account['provinsi'];
  $alamat = $account['alamat'];
  $kode_pos = $account['kode_pos'];
  $pesan_nota = $account['pesan_nota'];

  // Siapkan query untuk memperbarui data
  $stmt = $connection->prepare("UPDATE tbl_user SET full_nama = ?, nama_usaha = ?, katagori_usaha = ?, email = ?, no_tel = ?, provinsi = ?, alamat = ?, kode_pos = ?, pesan_nota = ? WHERE id_user = ?");
  
  // Bind parameter
  $stmt->bind_param("sssssssssi", $nama, $nama_usaha, $katagori_usaha, $email, $no_tel, $provinsi, $alamat, $kode_pos, $pesan_nota, $id_user);

  // Eksekusi query
  if ($stmt->execute()) {
      return 1; // Mengembalikan 1 jika berhasil
  } else {
      return 0; // Mengembalikan 0 jika gagal
  }

  // Tutup statement
  $stmt->close();
}

function tambahdataTransaksi($dataTransaksi) {
  global $connection;
  
  $kodeTransaksi = htmlspecialchars($dataTransaksi["kodetransaksi"]);
  $id_pelangan = htmlspecialchars($dataTransaksi["pelangan"]);
  $id_user = htmlspecialchars($dataTransaksi["id_user"]);
  
  $queryInsertTransaksi = "INSERT INTO tbl_transaksi (kode_transaksi, id_pelangan, id_user) VALUES('$kodeTransaksi', '$id_pelangan', '$id_user')";
  
  mysqli_query($connection, $queryInsertTransaksi);
  return mysqli_affected_rows($connection);
  
}  

function tambahDetailTransaksi($dataDetailBarang) {
  global $connection;
  
  $kodeTransaksi = htmlspecialchars($dataDetailBarang["idtransaksi"]);
  $id_user = htmlspecialchars($dataDetailBarang["iduse"]);
  $namabarang = htmlspecialchars($dataDetailBarang["namabarang"]);
  $qty = htmlspecialchars($dataDetailBarang["qty"]);  
  $tanggal = htmlspecialchars($dataDetailBarang["waktu"]);
  $pelangan = htmlspecialchars($dataDetailBarang["idpel"]);  
  $harga = htmlspecialchars($dataDetailBarang["harga"]);   
  
  $queryInsertDataDetail = "INSERT INTO tbl_detail_transaksi VALUES('', '$kodeTransaksi', '$id_user', '$pelangan', '$namabarang', '$qty', '$harga', '$tanggal')";
  
  mysqli_query($connection, $queryInsertDataDetail);
  return mysqli_affected_rows($connection);
  
}  

// Updete data transaksi
if(isset($_POST['transaksi'])){
  $transaksi = $_POST['idtransaksi'];
  $total = $_POST['total'];
  $bayar = $_POST['bayar'];
  $tanggal = $_POST['tu'];
  
  $updateTransaksi = mysqli_query($connection,"UPDATE tbl_transaksi SET total='$total', total_bayar='$bayar', tanggal='$tanggal' WHERE kode_transaksi='$transaksi'");

  if($updateTransaksi){
    $_SESSION['transaksi_berhasil'] = true;
    } else {
      echo"<script>
      alert('transaksi gagal');
      </script>";
    }
}




?>