<?php 
session_start();

if (!isset($_SESSION['tbl_user']['id_user'])) {
  header('location: login.php'); // Alihkan ke halaman login jika tidak ada sesi
  exit;
}

$id_user = $_SESSION['tbl_user']['id_user'];

require "../include/function.php";

//update data user

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_akun']))   {
  // Ambil data dari form
  $account = [
      'id_user' => $_POST['id_user'], 
      'nama' => $_POST['nama'], 
      'nama_usaha' => $_POST['nama_usaha'], 
      'kusaha' => $_POST['kusaha'], 
      'email' => $_POST['email'],
      'phoneNumber' => $_POST['phoneNumber'], 
      'provinsi' => $_POST['provinsi'], 
      'alamat' => $_POST['alamat'], 
      'kode_pos' => $_POST['kode_pos'], 
      'pesan_nota' => $_POST['pesan_nota'] 
  ];

  // Panggil fungsi updateAkun
  $result = updateAkun($account);

  // Jika Anda ingin memberikan umpan balik kepada pengguna
  if ($result) {
      echo "<script>alert('Data berhasil diperbarui');</script>";
  } else {
      echo "<script>alert('Gagal memperbarui data');</script>";
  }
}

$query = "SELECT id_provinsi, provinsi FROM tbl_provinsi"; // Ganti dengan nama tabel dan kolom yang sesuai
$result = mysqli_query($connection, $query);

$provinsi = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $provinsi[] = $row; // Simpan hasil ke dalam array
    }
}

$kategori = queryReadData("SELECT * FROM tbl_katagori");
$akun = mysqli_query($connection,"SELECT * FROM tbl_user WHERE id_user = '$id_user'");

//$informatika = "informatika";

if(isset($_POST['kirim'])){
  $user = $_POST['id_use'];
  $waktu = $_POST['wak'];
  $kate = $_POST['kapeng'];
  $isi = $_POST['isi'];

  $tambahaduan = mysqli_query($connection,"INSERT INTO tbl_inbox_cs (id_user, katagori, isi_inbox, tanggal) VALUES ('$user', '$kate', '$isi', '$waktu')");

  if($tambahaduan){
    header('location:setingAkun.php');
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

    <title>Account settings - Account | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

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

    <!-- Page CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
                <div data-i18n="Analytics">Input Barang</div>
              </a>
            </li>
             <!-- data pelangan -->
             <li class="menu-item">
              <a href="dataPelangan.php" class="menu-link">
              <i class='menu-icon tf-icons bx bxs-user-account'></i>
                <div data-i18n="Analytics">Input Pelangan</div>
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
            <li class="menu-item active">
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
                <div class="col-md-12">
                  <div class="card mb-4">
                  <?php
                           while ($dataUser = mysqli_fetch_array($akun)) {
                               $username = $dataUser['full_nama'];
                               $namaUsaha = $dataUser['nama_usaha'];
                               $katagori_usaha = $dataUser['katagori_usaha'];
                               $email = $dataUser['email'];
                               $telepon = $dataUser['no_tel'];
                               $pro = $dataUser['provinsi'];
                               $alamat = $dataUser['alamat'];
                               $kodepos = $dataUser['kode_pos'];
                               $pesan = $dataUser['pesan_nota'];


                          ?>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST">
                      <input type="hidden" name="id_user" value="<?=$id_user; ?>">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nama Pemilik</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="nama"
                              value="<?=$username;?>"
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">nama usaha</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="nama_usaha"
                              value="<?=$namaUsaha;?>"
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="timeZones" class="form-label">Katagori Usaha</label>
                            <select id="timeZones" class="select2 form-select" name="kusaha">
                            <option selected><?= $katagori_usaha; ?></option>
                              <?php foreach ($kategori as $item) : ?>
                              <option><?= $item["nama_katagori"]; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="<?=$email;?>"
                              placeholder="@gmail.com"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">no tlfpn</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"></span>
                              <input
                                type="text"
                                id="phoneNumber"
                                name="phoneNumber"
                                class="form-control"
                                value="<?=$telepon;?>"
                              />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="timeZones" class="form-label">Provinsi</label>
                            <select id="timeZones" class="select2 form-select" name="provinsi">
                            <option selected><?= $pro; ?></option>
                              <?php foreach ($provinsi as $item) : ?>
                              <option><?= $item["provinsi"]; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">alamat</label>
                            <input class="form-control" type="text" id="state" name="alamat" value="<?=$alamat;?>" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">kode pos</label>
                            <input
                              type="text"
                              class="form-control"
                              id="zipCode"
                              name="kode_pos"
                              maxlength="6"
                              value="<?=$kodepos;?>"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">pesan nota</label>
                            <input class="form-control" type="text" id="state" name="pesan_nota" value="<?=$pesan;?>" />
                          </div>
                          <div class="mb-3 col-md-6 row mt-3">
                            <label for="state" class="form-label"></label>
                            <div class="col-md-6 text-end">
                             <!-- Button trigger modal -->
                              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#pengaduan">
                                Pengaduan
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="pengaduan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form action="" method="post">
                                        <div class="row text-start">
                                        <input type="hidden" name="id_use" value="<?=$id_user; ?>">
                                        <input type="hidden" name="wak" id="" value="<?php
                                            echo date('Y-m-d'); // Format: DD-BB-TTTT HH:MM:SS
                                        ?>">
                                        <div class="mb-3 col-md-12">
                                          <label for="timeZones" class="form-label">Kategori Pengaduan</label>
                                          <select id="timeZones" class="select2 form-select" name="kapeng">
                                          <option selected>pilih kategori</option>
                                            <option>Pengaduan</option>
                                            <option>Saran</option>
                                            <option>Kritik</option>
                                          </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="exampleFormControlTextarea1" class="form-label">Isi</label>
                                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="isi" required></textarea>
                                        </div>
                                        <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
                                        </div>
                                      </form>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <a href="https://api.whatsapp.com/send/?phone=6282137374862&text&type=phone_number&app_absent=0" class="btn btn-success" target="blank">
                              <i class="bi bi-whatsapp"></i> Konsultasi
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="mt-2">
                         <button type="submit" class="btn btn-primary me-2" name="update_akun">Save changes</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                    <?php
                            };//end of while                              
                            ?>
                  </div>
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
                  , made with ❤️ by Nanda & Nyla||ITB AAS Indonesia
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

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
