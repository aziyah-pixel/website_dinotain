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
}

var_dump($nama); 

$pelangan = queryReadData("SELECT * FROM tbl_pelangan");

// Mengambil kode transaksi terakhir
$sql = "SELECT kode_transaksi FROM tbl_transaksi ORDER BY kode_transaksi DESC LIMIT 1";
$result = $connection->query($sql);

$kodeTransaksi = 'TRN1'; // Default jika tidak ada transaksi
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Mengambil nomor dari kode transaksi terakhir
    $lastKode = $row['kode_transaksi'];
    $lastNumber = (int)substr($lastKode, 3); // Mengambil angka setelah 'TRN'
    $newNumber = $lastNumber + 1; // Menambah satu
    $kodeTransaksi = 'TRN' . $newNumber; // Membuat kode transaksi baru
}

if(isset($_POST["dataTransaksi"]) ) {
  
  if(tambahdataTransaksi($_POST) > 0) {
    header("Location: detail_transaksi.php?id_transaksi=".$kodeTransaksi);
  }else {
    echo "<script>
    alert('Data ada yang salah!');
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

    <title>Dashboard dinotain</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

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
            <li class="menu-item">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
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
              <a href="../Sign/login.php" class="menu-link">
              <i class='menu-icon tf-icons bx bx-lock-open-alt'></i>
                <div data-i18n="Analytics">Log Out</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
               
                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">TRANSAKSI PENJUALAN</h5>
                      <label for=""><?php
                            echo date('d-m-Y H:i:s'); // Format: DD-BB-TTTT HH:MM:SS
                        ?></label>
                    </div>
                    <div class="card-body">
                      <form method="post" id="datatransaksiForm">
                        <div class="row mb-3">
                          <input type="hidden" name="id_user" id="" value="<?=$id_user?>">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">nama Kasir</label>
                          <div class="col-sm-10">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">: <?=$nama;?></label>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Transaksi</label>
                          <div class="col-sm-10">
                          <input
                              class="form-control"
                              type="text"
                              id="kodetransaksi"
                              name="kodetransaksi"
                              value="<?=$kodeTransaksi;?>"
                              readonly/>                          </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Jenis Pelanggan</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="jenisPelanggan" name="jenis_pelanggan" aria-label="Default select example">
                                    <option selected>Pilih Jenis Pelanggan</option>
                                    <option value="umum">Umum</option>
                                    <option value="member">Member</option>
                                </select>
                            </div>
                        </div>
                        <fieldset class="additional-form-group" id="additionalForm" hidden>
                        <div class="row mb-3">
                          <div class="col-sm-2 col-form-label">
                          <label for="exampleFormControlSelect1" class="form-label">Nama Pelangan</label>
                          </div>
                          <div class="col-sm-10">
                          <select class="form-select col-sm-10" id="exampleFormControlSelect1" aria-label="Default select example" name="pelangan">
                            <option selected>pilih Pelangan</option>
                            <?php foreach ($pelangan as $item) : ?>
                              <option value="<?= $item["id_pelangan"]; ?>"><?= $item["nama_pelangan"]; ?></option>                             
                           <?php endforeach; ?>
                          </select>
                        </div>
                        </div>
                        </fieldset>
                       
                        <div class="row mt-3">
                        <div class="col-sm-2 col-form-label"></div>
                          <div class="col-sm-10">
                          <a  href="detail_transaksi.php" id="review"><button type="submit" class="btn btn-primary" name="dataTransaksi">Selanjutnya</button></a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--/Basic Layout-->
              </div>
            </div>
            <!-- / Content -->
          </div>
            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  ,made with ❤️ by Nanda & Nyla || ITB AAS INDONESIA
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

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
      const jenisPelanggan = document.getElementById('jenisPelanggan');
    const additionalForm = document.getElementById('additionalForm');

    // Menyembunyikan form tambahan pada awal
    additionalForm.hidden = true;

    // Menambahkan event listener untuk dropdown
    jenisPelanggan.addEventListener('change', (event) => {
        if (event.target.value === 'member') {
            additionalForm.hidden = false; // Tampilkan form tambahan jika "Member" dipilih
        } else {
            additionalForm.hidden = true; // Sembunyikan form tambahan jika "Umum" dipilih
        }
    });
    </script>

   
  </body>
</html>
