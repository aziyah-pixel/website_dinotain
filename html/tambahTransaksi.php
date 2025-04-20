<?php
session_start();

if (!isset($_SESSION['tbl_user']['id_user'])) {
  header('location: ../Sign/login.php'); // Alihkan ke halaman login jika tidak ada sesi
  exit;
}

$id_user = $_SESSION['tbl_user']['id_user'];

require "../include/function.php";

$data = mysqli_query($connection,"SELECT * FROM tbl_user WHERE id_user = '$id_user'");
while($datauser=mysqli_fetch_array($data)){
  $nama = $datauser['full_nama'];
};

$kodeTransaksi = $_GET["id_transaksi"];
//var_dump($kodeTransaksi);
$dataTransaksi = queryReadData("SELECT * FROM tbl_transaksi WHERE kode_transaksi='$kodeTransaksi'");


if (empty($dataTransaksi) || !is_array($dataTransaksi) || !isset($dataTransaksi[0])) {
  die("Data tidak ditemukan.");
}
// Ambil id_user dan id_pelangan dari data transaksi
$idUser  = $dataTransaksi[0]['id_user'];
$idPelanggan = $dataTransaksi[0]['id_pelangan']; 

$pelanggan = queryReadData("SELECT nama_pelangan FROM tbl_pelangan WHERE id_pelangan = '$idPelanggan'");
$namaPelanggan = "Umum";
if (!empty($pelanggan) && is_array($pelanggan) && isset($pelanggan[0]['nama_pelangan'])) {
  $namaPelanggan = $pelanggan[0]['nama_pelangan']; // Ambil nama pelanggan
}

$barang = queryReadData("SELECT * FROM tbl_barang WHERE id_user='$id_user'");

if(isset($_POST["cari"]) ) {
  //buat variabel dan ambil apa saja yg diketikkan user di dalam input dan kirimkan ke function search.
  $barang = searchbarang($_POST["keyword"]);
}


if(isset($_POST["tambah"]) ) {
  
  if(tambahDetailTransaksi($_POST) > 0) {
    header('location: tambahTransaksi.php?id_transaksi='.$kodeTransaksi);
  }else {
    echo "<script>
    alert('Data gagal ditambahkan!');
    </script>";
  }
}

$Detail = mysqli_query($connection,"SELECT * FROM tbl_detail_transaksi WHERE kode_transaksi = '$kodeTransaksi'");
$totalBelanjaan = 0; 
$h1 = mysqli_num_rows($Detail);//jumlah pelangan

if(isset($_POST['hapus'])){
  $dtl = $_POST['iddetail'];

  $hapus = mysqli_query($connection,"DELETE FROM tbl_detail_transaksi WHERE id_detail='$dtl'");
  if($hapus){
    header('location:tambahTransaksi.php?id_transaksi='.$kodeTransaksi);
  }else{
    echo"<script>
      alert('Data gagal dihapus!');
      </script>";
  }
} 


?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>dinotain</title>

    <meta name="description" content="" />

    <!-- Favicon 
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />-->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <style>
      .more-content {
            display: none; /* Sembunyikan konten tambahan secara default */
        }
        .read-more {
            color: gray;
            cursor: pointer;
            font-style: italic;
        }
        .tamilan{
          display: grid;
          grid-template-columns: 3fr 1fr;
          grid-auto-rows: 150px;

          gap: 10px;
        }
        .[class^='box'] {
          height: 150px;
        }
        .barang {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center; 
            overflow: hidden;
            height: 435px;          /* Atur tinggi container */
            
            transition: overflow 0.3s ease;
        }
        .barang:hover{
          overflow-y: auto;
        }

        .barang-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            width: 120px;
            
            text-align: center;
        }

        .barang-item img {
            width: 100%;
            border-radius: 8px;
        }
        .pesanan{
          border:1px solid #ccc;
          justify-content: center; 
          padding : 5px;
          height: 300px;
          transition: overflow 0.3s ease;
          overflow: hidden;
        }
        .pesanan:hover{
          overflow-y: auto;
        }
        .pesanan-item {
         
            background-color: white;
            border-bottom: 1px solid #ccc;
            
            padding: 10px;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pesanan-details {
            flex: 1;
            
        }
        .qty {
            
            margin-top ; 1px;
        }

        .total {
            font-weight: bold;
            color: #333;
            margin-bottom ; 1px;
        }

    </style>

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
          <a href="index.php" class="app-brand-link">
              <span class="app-brand-logo demo">
              <img src="../assets/img/icons/brands/logo.jpg" alt="" srcset="">
              </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item ">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

             <!-- Berita -->
             <li class="menu-item ">
              <a href="berita.php" class="menu-link">
              <i class='menu-icon tf-icons bx bx-notepad'></i>
                <div data-i18n="Analytics">Berita</div>
              </a>
            </li>

             <!-- Transaksi -->
             <li class="menu-item active">
              <a href="transaksi.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart-alt"></i>
                <div data-i18n="Analytics">Transaksi</div>
              </a>
            </li>

          <!--Master Data-->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Master Data</span>
            </li>
            <!-- data barang -->
            <li class="menu-item">
              <a href="dataBarang.php" class="menu-link">
               <i class='menu-icon tf-icons bx bx-package' ></i>
                <div data-i18n="Analytics">Data Barang</div>
              </a>
            </li>
             <!-- data pelangan -->
             <li class="menu-item">
              <a href="dataPelangan.php" class="menu-link">
              <i class='menu-icon tf-icons bx bxs-user-account'></i>
                <div data-i18n="Analytics">Data Pelangan</div>
              </a>
            </li>

          <!--Laporan-->
              <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Laporan</span>
            </li>
            <!-- laporan barang -->
            <li class="menu-item">
              <a href="laporanBarang.php" class="menu-link">
               <i class='menu-icon tf-icons bx bx-file'></i>
                <div data-i18n="Analytics">Laporan Barang</div>
              </a>
            </li>
             <!-- laporan tansaksi -->
             <li class="menu-item">
              <a href="laporanTransaksi.php" class="menu-link">
              <i class='menu-icon tf-icons bx bx-box'></i>
                <div data-i18n="Analytics">Laporan Transaksi</div>
              </a>
            </li>

          <!--Pages-->
          <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Seting</span>
            </li>
            <li class="menu-item">
              <a href="setingAkun.php" class="menu-link">
              <i class='menu-icon tf-icons bx bx-user-circle'></i>
                <div data-i18n="Analytics">Account</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="../Sign/logout.php" class="menu-link">
              <i class='menu-icon tf-icons bx bx-lock-open-alt'></i>
                <div data-i18n="Analytics">Log Out</div>
              </a>
            </li>
          
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme "
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/1.jpeg" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.jpeg" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo $_SESSION['tbl_user']['username']; ?></span>
                            <small class="text-muted"><?php echo $_SESSION['tbl_user']['level']; ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../Sign/logout.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper mt-0">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">

              <div class="row">
                <!-- Basic -->
                <div class="col-md-7">
                  <div class="card mb-4 p-4">
                    <h5 class="card-header">Daftar Barang</h5>
                    <form action="" method="post">
                      <div class="row">
                      <div class="col-md-8">
                      <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Search..."
                          aria-label="Search..."
                          aria-describedby="basic-addon-search31"
                          name="keyword"
                        />
                      </div>
                      </div>
                      <div class="col-md-2">
                      <button type="submit" class="btn btn-primary" name="cari"><i class='bx bx-search-alt-2'></i></button>
                      </div>
                      </div>
                    </form>
                    <div class="barang mt-4">
                    <?php foreach ($barang as $item) : ?>
                        <div class="barang-item">
                            <img src="../assets/img/produk/<?=$item["produk"]; ?>" alt="" style="height: 100px; object-fit: cover;">
                            <h6><?= $item["nama_barang"]; ?></h6>
                            <input type="hidden" name="iduse" id="" value="<?= $item["id_barang"]; ?>">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahTransaksi<?= $item["id_barang"]; ?>">Tambah</button>
                        </div>
                         <!-- Edit Modal -->
<div class="modal fade" id="tambahTransaksi<?= $item["id_barang"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Pesanan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                      <form method="POST">
                                        <div class="row mb-3">
                                        <input type="hidden" name="iduse" id="" value="<?=$id_user;?>">
                                        <input type="hidden" name="idpel" id="" value="<?=$idPelanggan;?>">
                                        <input type="hidden" name="id_barang" id="" value="<?= $item["id_barang"]; ?>">

                                          <label class="col-sm-3 col-form-label" for="basic-default-name">Nama Barang</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" id="basic-default-name" name="namabarang" value="<?= $item["nama_barang"]; ?>" readonly/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-3 col-form-label" for="basic-default-alamat" >Harga</label>
                                          <div class="col-sm-9">
                                            <input
                                              type="text"
                                              name="harga"
                                              class="form-control"
                                              id="harga"
                                              value="<?= $item["harga"]; ?>"
                                              readonly
                                            />
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-3 col-form-label" for="basic-default-name">Qty</label>
                                          <div class="col-sm-9">
                                          <input type="number" class="form-control" id="basic-default-name" placeholder="" name="qty" require/>
                                          </div>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="hidden" name="idtransaksi" value="<?=$kodeTransaksi;?>">
                                        <input type="hidden" name="waktu" id="" value="<?php
                                            echo date('Y-m-d'); // Format: DD-BB-TTTT HH:MM:SS
                                        ?>">
                                          <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                                        </div>
                                        </form>
                                      </div>
                                      <div class="modal-footer">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <!-- /Edit Modal-->
                            
                        
                        <?php endforeach; ?>

                        
                    </div>
                        
                  </div>
                </div>

                <!-- Merged -->
                <div class="col-md-5 mb-3">
                  <div class="card mb-4">
                    <h5 class="card-header">Transaksi Penjualan</h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                    <label for="" class="text-end" id="current-time"><?php
                            echo date('d-m-Y H:i:s'); // Format: DD-BB-TTTT HH:MM:SS
                        ?></label>
                        <div class="row mt-0">
                          <label class="col-sm-6 col-form-label" for="basic-default-name">Kode Transaksi</label>
                          <div class="col-sm-6">
                            <input type="hidden" name="idtransaksi" id="" value="<?=$kodeTransaksi;?>">
                          <label class="col-sm-6 col-form-label" for="basic-default-name">: <?=$kodeTransaksi;?></label>
                          </div>
                        </div>
                     

                        <div class="pesanan">
                        <?php
                           
                           while ($detailTransaksi = mysqli_fetch_array($Detail)) {
                              $idDetail = $detailTransaksi['id_detail'];
                              $idTransaksi = $detailTransaksi['kode_transaksi'];
                               $nama_brg = $detailTransaksi['nama_barang'];
                               $harga = $detailTransaksi['harga'];
                               $qty = $detailTransaksi['qty'];
                               $total = $harga * $qty;
                               $totalBelanjaan += $total;                          
                               ?>
                        <div class="pesanan-item">
                            <div class="pesanan-details">
                                <h3 class="mt-2 mb-0"><?=$nama_brg;?></h3>
                                <span class="qty"><?=$harga;?> x <?=$qty;?></span>
                                <h6 class="total">Rp. <?=$total;?>,00</h6>
                            </div>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=  $idDetail ; ?>"><i class='bx bx-trash'></i></button>
                        </div>
                         <!--Delete Modal-->
                     <div class="modal fade" id="delete<?=  $idDetail ; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Hapus Pesanan</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form method="post">
                                      <div class="modal-body mb-3">
                                          <h5>Apakah Anda Yakin, ingin menghapus Pesanan</h5>
                                          <input type="hidden" name="iddetail" value="<?= $idDetail ?>">
                                          <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                                      </div>
                                  </form>
                                  <div class="modal-footer">
                                  </div>
                              </div>
                          </div>
                      </div>
                                <!--/Delete Modal -->
                        <?php
                            };//end of while                              
                            ?>
                        </div>
                        <form action="" method="post">
                        <div class="row mt-4">
                           <input type="hidden" name="tu" id="" value="<?php
                                            echo date('Y-m-d'); 
                                        ?>"/>
                          <label class="col-sm-6 col-form-label text-end" for="basic-default-name">Total Belanjaan</label>
                            <div class="col-sm-6 " >
                            <input style="width:80%; border: none;" type="text" name="total" id="total" value="<?=  $totalBelanjaan ; ?>" readonly/>
                            </div>
                        </div>
                        <div class="row mt-0">
                              <label class="col-sm-6 col-form-label text-end" for="basic-default-name">Total Bayar</label>
                              <div class="col-sm-6">
                                <input style="width:80%;" type="text" name="bayar" id="bayar" oninput="calculateChange()"/>
                              </div>
                         </div>
                          <div class="row">
                                <label class="col-sm-6 col-form-label text-end" for="basic-default-name">Kembalian</label>
                                <div class="col-sm-6">
                                  <input style="width:80%; border:none;" type="text" name="kembalian" id="kembalian" readonly/>
                                </div>
                          </div>
                          <div class="col-sm-12 text-end">
                          <input type="hidden" name="idtransaksi" id="" value="<?=$idTransaksi;?>">
                          <button type="submit" class="btn btn-primary" name="transaksi">Bayar</button>    
                          <button type="submit" class="btn btn-secondary" name="kembali">Kembali</button>                                          
                          </div>
                          </form>


              </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by Nanda & Nyla
                </div>
              </div>
            </footer>
            <!-- / Footer -->
    

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!--Read More-->
    <script>
        function toggleContent(element) {
            const moreContent = element.previousElementSibling; // Ambil elemen sebelumnya (konten tambahan)
            if (moreContent.style.display === "none" || moreContent.style.display === "") {
                moreContent.style.display = "inline"; // Tampilkan konten tambahan
                element.textContent = "Read Less"; // Ubah teks menjadi "Read Less"
            } else {
                moreContent.style.display = "none"; // Sembunyikan konten tambahan
                element.textContent = "Read More"; // Ubah teks kembali menjadi "Read More"
            }
        }

        function updateTime() {
        const now = new Date();
        const formattedTime = now.toLocaleString('id-ID', { 
            year: 'numeric', 
            month: '2-digit', 
            day: '2-digit', 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit',
            hour12: false 
        });
        document.getElementById('current-time').innerText = formattedTime;
    }
    setInterval(updateTime, 1000); // Update every second

    function calculateChange() {
        var total = parseFloat($('#total').val()) || 0;
        var bayar = parseFloat($('#bayar').val()) || 0;
        var kembalian = bayar - total;
        $('#kembalian').val(kembalian >= 0 ? kembalian : 0); // Tampilkan kembalian, tidak boleh negatif
    }
    </script>


    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
