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
$totalBayar = $dataTransaksi[0]['total_bayar'];
$kembali = $dataTransaksi[0]['kembalian'];

$pelanggan = queryReadData("SELECT nama_pelangan FROM tbl_pelangan WHERE id_pelangan = '$idPelanggan'");
$namaPelanggan = "Umum";
if (!empty($pelanggan) && is_array($pelanggan) && isset($pelanggan[0]['nama_pelangan'])) {
    $namaPelanggan = $pelanggan[0]['nama_pelangan']; // Ambil nama pelanggan
}

$barang = queryReadData("SELECT * FROM tbl_barang WHERE id_user='$id_user'");


$Detail = mysqli_query($connection,"SELECT * FROM tbl_detail_transaksi WHERE kode_transaksi = '$kodeTransaksi'");
$totalBelanjaan = 0; 
$h1 = mysqli_num_rows($Detail);//jumlah pelangan

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper">
      <div class="layout-container">

        <!-- Menu -->
        
        <!-- / Menu -->

        <!-- Layout container -->
       

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">

              <form method="post" id="detailtransaksiForm">
                <div class="card">
                <h5 class="card-header text-center">Transaksi Penjualan</h5>
               <div class="card-body">
                
                    <div class="row mb-3">
                    <label for="" class="text-end"><?php
                            echo date('d-m-Y H:i:s'); // Format: DD-BB-TTTT HH:MM:SS
                        ?></label>
                    </div>
                        <div class="row">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Transaksi</label>
                          <div class="col-sm-10">
                            <input type="hidden" name="idtransaksi" id="" value="<?=$kodeTransaksi;?>">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">: <?=$kodeTransaksi;?></label>
                          </div>
                        </div>
                        <div class="row">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">nama Kasir</label>
                          <div class="col-sm-10">
                          <label class="col-sm-10 col-form-label" for="basic-default-name">: <?=$nama;?></label>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pelangan</label>
                          <div class="col-sm-10">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">: <?= htmlspecialchars($namaPelanggan); ?> </label>
                        </div>
                        </div>
                       
               </div>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabel-data-transaksi" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama Barang</th>
                              <th>Harga</th>
                              <th>Qty</th>
                              <th>Total</th>
                            </tr>
                      </thead>
                          <tbody>
                          <?php
                           $i = 1; // penomoran
                           while ($detailTransaksi = mysqli_fetch_array($Detail)) {
                               $nama_brg = $detailTransaksi['nama_barang'];
                               $harga = $detailTransaksi['harga'];
                               $qty = $detailTransaksi['qty'];
                               $total = $harga * $qty;
                               $totalBelanjaan += $total;                          ?>

                            <tr>
                                <td><?=$i++;?></td>
                                <td><?=$nama_brg;?></td>
                                <td><?=$harga;?></td>
                                <td><?=$qty;?></td> 
                                <td><?=$total;?></td>                                                             
                            </tr> 
                            
                            <?php
                            };//end of while                              
                            ?>

                          </tbody>
                    </table>  
                  </div>

                  <div class="row mt-3">
                  <input type="hidden" name="tu" id="" value="<?php
                                            echo date('d-m-Y H:i:s'); // Format: DD-BB-TTTT HH:MM:SS
                                        ?>"/>
                          <label class="col-sm-8 col-form-label text-end" for="basic-default-name">Total Belanjaan</label>
                          <div class="col-sm-4">
                            <input type="text" name="total" id="total" value="<?=$totalBelanjaan;?>" readonly/>
                          </div>
                </div>
                <div class="row">
                          <label class="col-sm-8 col-form-label text-end" for="basic-default-name">Total Bayar</label>
                          <div class="col-sm-4">
                            <input type="text" name="bayar" id="bayar" value="<?=$totalBayar?>" oninput="calculateChange()"/>
                          </div>
                </div>
                <div class="row">
                          <label class="col-sm-8 col-form-label text-end" for="basic-default-name">Kembalian</label>
                          <div class="col-sm-4">
                            <input type="text" name="kembalian" id="kembalian" value="<?=$kembali?>" readonly/>
                          </div>
                </div>
                



               

                </div>
              </div>

              </form>

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

    <script src="../DataTables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
function fetchPrice(nama_barang) {
    if (nama_barang) {
        $.ajax({
            url: 'get_harga_barang.php', // Ganti dengan URL yang sesuai
            type: 'GET',
            data: { id: nama_barang },
            success: function(data) {
                $('#harga').val(data); // Set nilai harga ke input harga
            }
        });
    } else {
        $('#harga').val(''); // Kosongkan jika tidak ada barang yang dipilih
    }
}


</script>

    <script>
    $(document).ready(function(){
        $('#tabel-data-transaksi').DataTable();
    });
    </script>

    <script>
        window.print();
    </script>
  </body>
</html>
