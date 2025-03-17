<?php 
session_start();

if (!isset($_SESSION['tbl_user']['id_user'])) {
  header('location: ../Sign/login.php'); // Alihkan ke halaman login jika tidak ada sesi
  exit;
}

$id_user = $_SESSION['tbl_user']['id_user'];

require "../include/function.php";

// Inisialisasi variabel tanggal
$tanggalAwal = isset($_POST['tangalAwal']) ? $_POST['tangalAwal'] : '';
$tanggalAkhir = isset($_POST['tangalAkhir']) ? $_POST['tangalAkhir'] : '';

// Query untuk mengambil data berdasarkan tanggal
$query = "SELECT * FROM tbl_transaksi WHERE id_user = '$id_user'";

if ($tanggalAwal && $tanggalAkhir) {
  $query .= " AND tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'";
}

$penjualan = mysqli_query($connection,$query);
$h1 = mysqli_num_rows($penjualan);//jumlah pelangan

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
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link href="../DataTables/datatables.min.css" rel="stylesheet">

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
             <li class="menu-item">
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
             <li class="menu-item active">
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
              <a href="setingAkun.php" class="menu-link">
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
               
              
            <!--Tabel Pelangan-->
            <div class="card">
                <h5 class="card-header">Laporan Data Transaksi</h5>
                <div class="card-header">
                  <form action="" method="post">
                <div class="mb-3 row">
                    <label for="html5-date-input" class="col-md-1 col-form-label">Date</label>
                    <div class="col-md-4">
                      <input class="form-control" type="date" value="2025-03-10" id="html5-date-input" name="tangalAwal" />
                    </div>
                    <div class="col-md-4">
                      <input class="form-control" type="date" value="2025-03-10" id="html5-date-input" name="tangalAkhir"/>
                    </div>
                    <div class="col-md-1">
                    <button type="submit" class="btn btn-primary"><i class='bx bx-search-alt-2'></i></button>
                    </div>
                </div>
                </form>
                </div>
                  <div class="card-body">
                    <div class="table-responsive text-nowrap">
                    <table id="tabel-data-penjualan" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Kode Pelangan</th>
                            <th>Jumalah</th>
                            <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                           $i = 1; // penomoran
                           while ($dataPenjualan = mysqli_fetch_array($penjualan)) {
                               $kodeTransaksi = $dataPenjualan['kode_transaksi'];
                               $idpelangan = $dataPenjualan['id_pelangan'];
                               $jumlah = $dataPenjualan['total'];
                            
                          ?>
                          <tr>
                              <td><?=$i++;?></td>
                              <td><?=$kodeTransaksi;?></td>
                              <td><?=$idpelangan;?></td>
                              <td><?=$jumlah;?></td>
                              <td>
                              <div class="action text-center">
                                  <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editlaporan<?=$kodeTransaksi;?>">Edit</button>
  
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletelaporan<?=$kodeTransaksi;?>">Delete</button>
                                  </div>
                              </td>

 <!--Delete Modal-->
 <div class="modal fade" id="deletelaporan<?=$kodeTransaksi;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body mb-3">
                    <h5>Apakah Anda Yakin, ingin menghapus <?=$kodeTransaksi;?></h5>
                    <input type="hidden" name="trans" value="<?=$kodeTransaksi;?>">
                    <button type="submit" class="btn btn-danger" name="hapus_transaksi">Hapus</button>
                </div>
            </form>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

                          </tr>  

<!-- Edit Modal -->
<div class="modal fade" id="editlaporan<?=$kodeTransaksi;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Penjualan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                      <form method="POST">
                                        <div class="row mb-3">
                                          <label class="col-sm-3 col-form-label" for="basic-default-name">Kode Transaksi</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" id="basic-default-name" name="kodetransaksi" value="<?=$kodeTransaksi;?>" readonly/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-3 col-form-label" for="basic-default-name">Kode Pelangan</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" id="basic-default-name" name="kodepelangan" value="<?=$idpelangan;?>" required/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-3 col-form-label" for="basic-default-name">Jumlah Transaksi</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" id="basic-default-name" name="jumlah" value="<?=$jumlah;?>" require/>
                                          </div>
                                        </div>
                                        <div class="col-sm-10">
                                          <button type="submit" class="btn btn-primary" name="update_laporan">Update</button>
                                        </div>
                                        </form>
                                      </div>
                                      <div class="modal-footer">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <!-- /Edit Modal-->

                          <?php
                            };//end of while                              
                            ?>

                      </tbody>
                    </table>  
                    </div>
                  </div>
                </div>
                <!-- / Tabel Pelangan -->
                

               
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
                  , made with ❤️ by Nanda & Nyla || ITB AAS Indonesia
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
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="../DataTables/datatables.min.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
    $(document).ready(function(){
        $('#tabel-data-penjualan').DataTable();
    });
</script>
  </body>
</html>
