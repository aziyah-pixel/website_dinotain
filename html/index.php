<?php
session_start();

if (!isset($_SESSION['tbl_user']['id_user'])) {
  header('location: ../Sign/login.php'); // Alihkan ke halaman login jika tidak ada sesi
  exit;
}

$id_user = $_SESSION['tbl_user']['id_user'];

require "../include/koneksi.php";

$tanggal_hari_ini = date('Y-m-d');

// Query untuk menghitung jumlah barang yang terjual hari ini
$query = "SELECT SUM(qty) AS total_qty FROM tbl_detail_transaksi WHERE tanggal = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $tanggal_hari_ini);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
  $total_barang_terjual = $row['total_qty'] ? $row['total_qty'] : 0; // Jika tidak ada transaksi, set ke 0
} else {
  $total_barang_terjual = 0; // Jika tidak ada hasil
}

$bulan = date('m'); // Bulan saat ini
$tahun = date('Y'); // Tahun saat ini

// Query untuk menghitung total barang yang terjual bulan ini
$query = "SELECT SUM(qty) AS total_qty FROM tbl_detail_transaksi WHERE MONTH(tanggal) = ? AND YEAR(tanggal) = ? AND id_user = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("iii", $bulan, $tahun, $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Ambil hasil
if ($row = $result->fetch_assoc()) {
    $total_barang_bulanan = $row['total_qty'] ? $row['total_qty'] : 0; // Jika tidak ada transaksi, set ke 0
} else {
    $total_barang_bulanan = 0; // Jika tidak ada hasil
}

$pemasukan = "SELECT SUM(total) AS total_transaksi FROM tbl_transaksi WHERE YEAR(tanggal) = ? AND id_user = ?";
$stmt = $connection->prepare($pemasukan);
$stmt->bind_param("ii", $tahun, $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Ambil hasil
if ($row = $result->fetch_assoc()) {
    $pemasukan_tahunan = $row['total_transaksi'] ? $row['total_transaksi'] : 0; // Jika tidak ada transaksi, set ke 0
} else {
    $pemasukan_tahunan = 0; // Jika tidak ada hasil
}



/*$monthlyIncomeData = [];
for ($month = 1; $month <= 12; $month++) {
    $query = "SELECT SUM(total) AS total_transaksi FROM tbl_transaksi WHERE MONTH(tanggal) = ? AND YEAR(tanggal) = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $month, $tahun);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $monthlyIncomeData[] = $row['total_transaksi'] ? $row['total_transaksi'] : 0; // Set to 0 if no transactions
    } else {
        $monthlyIncomeData[] = 0; // Set to 0 if no result
    }
}

// Convert the array to JSON format for use in JavaScript
$monthlyIncomeDataJson = json_encode($monthlyIncomeData);*/

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
        .scrollable-list {
            max-height: 300px; /* Atur tinggi maksimum sesuai kebutuhan */
            overflow-y: scroll; /* Tambahkan scrollbar jika diperlukan */
        }

        /* Menyembunyikan scrollbar di Webkit (Chrome, Safari) */
        .scrollable-list::-webkit-scrollbar {
            display: none; /* Sembunyikan scrollbar */
        }

        /* Menyembunyikan scrollbar di Firefox */
        .scrollable-list {
            scrollbar-width: none; /* Sembunyikan scrollbar */
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
            <li class="menu-item active">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Berita -->
            <li class="menu-item">
              <a href="berita.php" class="menu-link">
              <i class='menu-icon tf-icons bx bx-notepad'></i>
                <div data-i18n="Analytics">Berita</div>
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
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search 
              <div class="navbar-nav align-items-center">
                <form action="" method="post">
                <div class="nav-item d-flex align-items-center">
                  <input
                    type="search"
                    id="searchInput"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                    name="keyword"
                  />
                  <button type="submit" class="btn btn-primary" name="cari_artikel">cari</button>
                </div>
                </form>
              </div>
               /Search -->

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
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-7 mb-4 order-0 ">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Congratulations <?php echo $_SESSION['tbl_user']['username']; ?> 🎉</h5>
                          <p class="mb-4">
                            Anda Telah Melakukan <span class="fw-bold"><?=$total_barang_terjual;?></span> penjualan Barang hari ini. Periksa Data Penjualan baru Anda di Laporan.
                          </p>

                          <a href="laporanBarang.php" class="btn btn-sm btn-outline-primary">View laporan</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-4 order-1 ">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <?php
                      $pemasukanbln = "SELECT SUM(total) AS total_transaksi FROM tbl_transaksi WHERE MONTH(tanggal) = ? AND YEAR(tanggal) = ? AND id_user = ?";
                      $stmt = $connection->prepare($pemasukanbln);
                      $stmt->bind_param("iii", $bulan, $tahun, $id_user);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      
                      // Ambil hasil
                      if ($row = $result->fetch_assoc()) {
                          $total_pemasukan = $row['total_transaksi'] ? $row['total_transaksi'] : 0; // Jika tidak ada transaksi, set ke 0
                      } else {
                          $total_pemasukan = 0; // Jika tidak ada hasil
                      }
                     
                      ?>
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/wallet-info.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="laporanTransaksi.php">View More</a>
                              </div>
                            </div>
                          </div>
                          <span>Pemasukan<br> pertahun</span>
                          <h3 class="card-title mb-2">Rp. <?=$total_pemasukan?></h3>
                          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <?php
                      $pelangan = "SELECT COUNT(*) as total_pelanggan FROM tbl_pelangan WHERE id_user ='$id_user'";
                      $result = $connection->query($pelangan);
                      
                      // Memeriksa apakah ada hasil
                      if ($result->num_rows > 0) {
                          // Mengambil data
                          $row = $result->fetch_assoc();
                          $jml_pelangan = $row['total_pelanggan'];
                      } else {
                        $jml_pelangan = "Tidak mempunyai Member";
                      }
                      ?>
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/paypal.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="dataPelangan.php">View More</a>
                              </div>
                            </div>
                          </div>
                          <span>Member<br> perbulan</span>
                          <h3 class="card-title text-nowrap mb-1"><?=$jml_pelangan;?> Anggota</h3>
                          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <!-- Expense Overview -->
                  
                        <div class="card h-100">
                          <div class="card-header">
                          <div class="d-flex pt-3">
                                  <div class="avatar flex-shrink-0 me-3">
                                    <img src="../assets/img/icons/unicons/wallet.png" alt="User" />
                                  </div>
                                  <div>
                                    <small class="text-muted d-block">Total Pemasukan</small>
                                    <div class="d-flex align-items-center">
                                      <h6 class="mb-0 me-1">Rp. <?=$pemasukan_tahunan;?></h6>
                                      
                                    </div>
                                  </div>
                                </div>

                          </div>
                          <div class="card-body px-0">
                            <div class="tab-content p-0">
                              <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                <div id="incomeChart"></div>
                                <div class="d-flex justify-content-center pt-4 gap-2">
                                  <div class="flex-shrink-0">
                                  
                                    <div id="expensesOfWeek"></div>
                                  </div>
                                  <div>
                                    <p class="mb-n1 mt-1">Pemasukan Bulan ini</p>
                                    <small class="text-muted">Rp. <?=$total_pemasukan;?></small>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <!--/ Expense Overview -->
                    </div>
                  </div>
                </div>
            
              </div>
             
              
              <div class="row">
                <!-- Order Statistics -->
                <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Statistik Barang</h5>
                        <small class="text-muted"> <?= $total_barang_bulanan?> Total Barang Terjual</small>
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="orederStatistics"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                          <a class="dropdown-item" href="laporanBarang.php">Select All</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                          <h2 class="mb-2"><?= $total_barang_bulanan?></h2>
                          <span>Total barang</span>
                        </div>
                        <div id="orderStatisticsChart"></div>
                      </div>
                      <div id="vertical-example">
                      <script>
                          const orderData = {
                            labels: [],
                            series: []
                          };
                        </script>
                        <ul class="p-0 m-0 scrollable-list">
                          <?php
                          $dataBarang = "
                          SELECT b.nama_barang, COALESCE(SUM(t.qty), 0) AS total_qty
                          FROM tbl_barang b
                          LEFT JOIN tbl_detail_transaksi t ON b.id_barang = t.id_barang 
                          WHERE MONTH(t.tanggal) = ? AND YEAR(t.tanggal) = ? AND t.id_user = ?
                          GROUP BY b.id_barang
                          ORDER BY total_qty DESC
                          LIMIT 5
                          ";
                          
                          $stmt = $connection->prepare($dataBarang);
                          $stmt->bind_param("iii", $bulan, $tahun, $id_user);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          
                          // Cek apakah ada hasil
                          if ($result->num_rows > 0) {
                          // Tampilkan 
                          while ($row = $result->fetch_assoc()) {
                            $nama_barang = htmlspecialchars($row['nama_barang']); 
                            $total_barang = htmlspecialchars($row['total_qty']); 
                          
                          ?>

<script>
        orderData.labels.push("<?= $nama_barang; ?>");
        orderData.series.push(<?= $total_barang; ?>);
      </script>
                                      
                          <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                              <span class="avatar-initial rounded bg-label-primary"
                                ><i class='bx bx-purchase-tag'></i>
                              </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                <h6 class="mb-0"><?=$nama_barang;?></h6>
                                <small class="text-muted">Mobile, Earbuds, TV</small>
                              </div>
                              <div class="user-progress">
                                <small class="fw-semibold"><?=$total_barang;?> Pcs</small>
                              </div>
                            </div>
                          </li>
                      
                        <?php
                        }
                        } else {
                        echo "<label>Tidak ada data transaksi untuk bulan ini.</label>";
                        }?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Order Statistics -->

                <!-- Transactions -->
                <div class="col-md-6 col-lg-6 order-2 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Loyal Member</h5>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0 scrollable-list">
                      <?php
                  $query = "
                  SELECT p.nama_pelangan, p.no_telep, COUNT(t.kode_transaksi) AS jumlah_transaksi
                  FROM tbl_pelangan p
                  LEFT JOIN tbl_transaksi t ON p.id_pelangan = t.id_pelangan
                  WHERE t.id_user = '$id_user'
                  GROUP BY p.id_pelangan
                  ORDER BY jumlah_transaksi DESC
                  LIMIT 10
                   ";

             

                  $result = $connection->query($query);

                  // Cek apakah ada hasil
                  if ($result->num_rows > 0) {
                      // Tampilkan hasil
                      while ($row = $result->fetch_assoc()) {
                          $nama_pelanggan = htmlspecialchars($row['nama_pelangan']); 
                          $telepon = htmlspecialchars($row['no_telep']); 
                          $jumlah_transaksi = htmlspecialchars($row['jumlah_transaksi']); 
                  ?>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="../assets/img/avatars/1.jpeg" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0"><?=$nama_pelanggan?></h6>
                              <small class="text-muted d-block mb-1"><?=$telepon?></small>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0"><?=$jumlah_transaksi?></h6>
                              <span class="text-muted">x</span>
                            </div>
                          </div>
                        </li>
                        <?php
                      }
                    };
                      ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Transactions -->
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
