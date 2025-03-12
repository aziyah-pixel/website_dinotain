<?php
require "../include/koneksi.php";
require "function.php";
$user = mysqli_query($connection,"SELECT id_user, full_nama, nama_usaha, email, katagori_usaha, no_tel, alamat FROM tbl_user WHERE level='user'");

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
            <li class="menu-item active">
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
              <li class="menu-item">
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

              <div class="card">
                <h5 class="card-header">Data User</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabel-data-user" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                            <tr>
                              <th>No </th>
                              <th>Nama Pemilik</th>
                              <th>Nama Usaha</th>
                              <th>Katagori Usaha</th>
                              <th>Email</th>
                              <th>Alamat</th>
                              <th>No Telepon</th>
                              <th>Action</th>
                            </tr>
                      </thead>
                          <tbody>
                          <?php
                              $get = mysqli_query($connection,"SELECT id_user, full_nama, nama_usaha, katagori_usaha, email, no_tel, alamat FROM tbl_user WHERE level='user'");
                              $i = 1; //penomoran

                              while($user=mysqli_fetch_array($get)){
                              $iduser = $user['id_user'];
                              $namauser = $user['full_nama'];
                              $namausaha = $user['nama_usaha'];
                              $katagori = $user['katagori_usaha'];
                              $email = $user['email'];
                              $alamat = $user['alamat'];
                              $telepon = $user['no_tel'];

                            ?>
                            <tr>
                              <td><?php echo $i++; ?></td>
                                <td><?=$namauser; ?></td>
                                <td><?=$namausaha; ?> </td>
                                <td><?=$katagori; ?></td>
                                <td><?=$email; ?></td>
                                <td><?=$alamat; ?></td>
                                <td><?=$telepon; ?></td>
                                <td>
                                  <div class="action text-center">
                                  <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edituser<?=$iduser;?>">Edit</button>
  
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteuser<?=$iduser;?>">Delete</button>
                                  </div>
                                </td>

                                <!--Delete Modal-->
<div class="modal fade" id="deleteuser<?=$iduser;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body mb-3">
                    <h5>Apakah Anda Yakin, ingin menghapus <?=$namauser;?></h5>
                    <input type="hidden" name="id_user" value="<?=$iduser;?>">
                    <button type="submit" class="btn btn-danger" name="hapus_user">Hapus</button>
                </div>
            </form>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--/Delete Modal -->
                              
                                
                            </tr>  

                                <!-- Edit Modal -->
                                <div class="modal fade" id="edituser<?=$iduser;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                      <form method="POST">
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pemilik</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" id="basic-default-name" name="namauser" value="<?=$namauser;?>" required/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Usaha</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" id="basic-default-name" name="namausaha" value="<?=$namausaha;?>" required/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Katagori Usaha</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" id="basic-default-name" name="katagori" value="<?=$katagori;?>" required/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
                                          <div class="col-sm-10">
                                            <input type="email" class="form-control" id="basic-default-name" name="email" value="<?=$email;?>" required/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Alamat</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" id="basic-default-name" name="alamat" value="<?=$alamat;?>" required/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">No Telepon</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" id="basic-default-name" name="telepon" value="<?=$telepon;?>" required/>
                                          </div>
                                        </div>


                                        <div class="col-sm-10">
                                        <input type="hidden" name="iduser" value="<?=$iduser;?>">
                                          <button type="submit" class="btn btn-primary" name="update_user">Update</button>
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
                  , made with ❤️ by Nanda & Nyla || ITB AAS Indonesia                </div>
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

    <script src="../DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>



    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
    $(document).ready(function(){
        $('#tabel-data-user').DataTable();
    });
</script>

  </body>
</html>
