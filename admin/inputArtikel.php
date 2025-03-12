<?php
session_start();

if(!isset($_SESSION["login"]) ) {
  header("Location: ../Sign/login.php");
  exit;
}

require "function.php";

if(isset($_POST["tambah_artikel"]) ) {
  
  if(tambahArtikel($_POST) > 0) {
    header("Location: index.php");
  }else {
    echo "<script>
    alert('Data Artikel gagal ditambahkan!');
    </script>";
  }
}

$artikel = mysqli_query($connection,"SELECT * FROM tbl_artikel");

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
    <style>
      .more-content {
            display: none; /* Sembunyikan konten tambahan secara default */
        }
        .read-more {
            color: blue;
            cursor: pointer;
            text-decoration: underline;
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

          <!--Master Data-->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Master Data</span>
            </li>
            <!-- data User -->
            <li class="menu-item">
              <a href="dataUser.php" class="menu-link">
              <i class='menu-icon tf-icons bx bxs-user-detail'></i>
                <div data-i18n="Analytics">Data User</div>
              </a>
            </li>
            <!-- data Katagori -->
             <li class="menu-item">
              <a href="dataKatagori.php" class="menu-link">
              <i class='menu-icon tf-icons bx bx-copy-alt'></i>
                <div data-i18n="Analytics">Data Katogori Usaha</div>
              </a>
            </li>
            <!-- data rovinsi -->
             <li class="menu-item">
              <a href="dataProvinsi.php" class="menu-link">
              <i class='menu-icon tf-icons bx bx-map'></i>
                <div data-i18n="Analytics">Data Provinsi</div>
              </a>
            </li>
            <!-- Artikel -->
              <li class="menu-item active">
                <a href="inputArtikel.php" class="menu-link">
                <i class='menu-icon tf-icons bx bx-paste'></i>
                  <div data-i18n="Analytics">Input Artikel</div>
                  </a>
              </li>

          <!--Laporan-->
              <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Laporan</span>
            </li>
            <!-- laporan masange -->
            <li class="menu-item">
              <a href="laporanPesan.php" class="menu-link">
              <i class='menu-icon tf-icons bx bx-message-detail'></i>
                <div data-i18n="Analytics">Data Message</div>
              </a>
            </li>

          <!--Pages-->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Pages</span>
            </li>
            <li class="menu-item">
            <a href="../Sign/login.php" class="menu-link" target="">
              <i class='menu-icon tf-icons bx bx-log-out-circle' ></i>
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

              <!--From Input-->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Input Artikel</h5>
                    </div>
                    <div class="card-body">
                      <form method="post" enctype="multipart/form-data" >
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">ID Artikel</label>
                          <div class="col-sm-10">
                          <input 
                               type="text" 
                               class="form-control" 
                                name = "id_artikel"
                                id="basic-default-kode"
                               aria-describedby="additional_kode_information"
                               require/>
                                            <span id="additional_kode_information" class="form-text">
                                                <em>ID artikel boleh dikosongi</em>
                                            </span> 
                          </div>

                        </div>
                        <div class="row mb-3">
                          <label for="exampleDataList" class="col-sm-2 col-form-label">Katgori Artikel</label>
                          <div class="col-sm-10">
                            <input
                              class="form-select"
                              list="datalistOptions"
                              id="exampleDataList"
                              name="katagori_artikel"
                              placeholder="Type to search..."
                              require/>
                            
                            <datalist id="datalistOptions">
                              <option value="Promosi"></option>
                              <option value="Berita"></option>
                            </datalist>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Judul Artikel</label>
                          <div class="col-sm-10">
                             <input type="text" class="form-control" id="basic-default-name" name="judul_artikel" placeholder="" required/>
                          </div>
                        </div>

                        <div class="row mb-3">
                         <label for="formFile" class="col-sm-2 col-form-label">Upload Foto</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="file" id="formFileMultiple" name="foto_artikel"require/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-message">Isi</label>
                          <div class="col-sm-10">
                            <textarea
                              id="basic-default-message"
                              name="isi_artikel"
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-message2"
                            ></textarea>
                          </div>
                        </div>
                        <div class="row mb-3">
                        <label for="html5-url-input" class="col-md-2 col-form-label">URL Artikel</label>
                          <div class="col-sm-10">
                          <input
                            class="form-control"
                            type="url"
                            value="https://themeselection.com"
                            id="html5-url-input"
                            name="url_artikel"
                          />
                          </div>
                        </div>

                        <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
                        <div class="col-md-10">
                          <input class="form-control" type="date" value="2025-03-10" id="html5-date-input" name="date_artikel"/>
                        </div>
                      </div>

                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary" name="tambah_artikel">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <!--  /From input-->

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
                  , made with ❤️ by Nanda & Nyla || ITB AAS INDONESIA
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

    <!-- READ MORE-->
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
