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


if(isset($_POST["tambah"]) ) {
  
  if(tambahDetailTransaksi($_POST) > 0) {
    header('location: detail_transaksi.php?id_transaksi='.$kodeTransaksi);
  }else {
    echo "<script>
    alert('Data gagal ditambahkan!');
    </script>";
  }
}

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
                    <label for="" class="text-end" id="current-time"><?php
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
                       
                        <div class="row mb-1">
                          <div class="col-sm-10">
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTransaksi<?=$kodeTransaksi;?>">Tambah Barang</button>

                          <!-- tambah Modal -->
<div class="modal fade" id="tambahTransaksi<?=$kodeTransaksi;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                      <form method="POST">
                                        <input type="hidden" name="waktu" id="" value="<?php
                                            echo date('Y-m-d'); // Format: DD-BB-TTTT HH:MM:SS
                                        ?>">
                                        <input type="hidden" name="iduse" id="" value="<?=$id_user;?>">
                                        <input type="hidden" name="idpel" id="" value="<?=$idPelanggan;?>">
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Barang</label>
                                          <div class="col-sm-10">
                                          <select id="timeZones" class="select2 form-select"  name="namabarang" onchange="fetchPrice(this.value)">
                                            <option selected>Choose</option>
                                            <?php foreach ($barang as $item) :?>
                                            <option> <?= $item['nama_barang']; ?></option>
                                            <?php endforeach; ?>
                                            </select>                                          
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-alamat" >id</label>
                                          <div class="col-sm-10">
                                            <input
                                              type="text"
                                              name="id_barang"
                                              class="form-control"
                                              id="id_barang"
                                              readonly
                                            />
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-alamat" >Harga</label>
                                          <div class="col-sm-10">
                                            <input
                                              type="text"
                                              name="harga"
                                              class="form-control"
                                              id="harga"
                                              readonly
                                            />
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Qty</label>
                                          <div class="col-sm-10">
                                          <input type="number" class="form-control" id="basic-default-name" placeholder="" name="qty" require/>
                                          </div>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="hidden" name="idtransaksi" value="<?=$kodeTransaksi;?>">
                                          <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                                        </div>
                                        </form>
                                      </div>
                                      <div class="modal-footer">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <!-- /tambah-->
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
                              <th>Action</th>
                            </tr>
                      </thead>
                          <tbody>
                          <?php
                           $i = 1; // penomoran
                           while ($detailTransaksi = mysqli_fetch_array($Detail)) {
                              $idDetail = $detailTransaksi['id_detail'];
                              $idTransaksi = $detailTransaksi['kode_transaksi'];
                               $nama_brg = $detailTransaksi['nama_barang'];
                               $harga = $detailTransaksi['harga'];
                               $qty = $detailTransaksi['qty'];
                               $total = $harga * $qty;
                               $totalBelanjaan += $total;                          
                               ?>

                            <tr>
                                <td><?=$i++;?></td>
                                <td><?=$nama_brg;?></td>
                                <td><?=$harga;?></td>
                                <td><?=$qty;?></td> 
                                <td><?=$total;?></td>                                                              
                                <td>
                                <div class="action text-center">
                                  <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editTransaksi<?=$idDetail;?>">Edit</button>
  
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletTransaksi<?=$idDetail;?>">Delete</button>
                                  </div>
                                </td>
                                <!--Delete Modal-->
 <div class="modal fade" id="deletTransaksi<?=$idDetail;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body mb-3">
                    <h5>Apakah Anda Yakin, ingin menghapus <?=$nama_brg;?></h5>
                    <input type="hidden" name="id_detail" value="<?=$idDetail;?>">
                    <button type="submit" class="btn btn-danger" name="hapus_penjualan">Hapus</button>
                </div>
            </form>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>                                
                            </tr> 

                            <!-- Edit Modal -->
<div class="modal fade" id="editTransaksi<?=$idDetail;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Jumlah Penjualan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                      <form method="POST">
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Barang</label>
                                          <div class="col-sm-10">
                                            <input type="text" class="form-control" id="basic-default-name" name="namaPelangan" value="<?=$nama_brg;?>" readonly/>
                                          </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-name">Qty</label>
                                          <div class="col-sm-10">
                                            <input type="number" class="form-control" id="basic-default-name" name="qtybaru" value="<?=$qty;?>" required/>
                                          </div>
                                        </div>
                                        <div class="col-sm-10">
                                        <input type="hidden" name="kodetransaksi" value="<?=$kodeTransaksi;?>">
                                        <input type="hidden" name="idDetail" value="<?=$idDetail;?>">
                                          <button type="submit" class="btn btn-primary" name="update_pembelian">Update</button>
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

                  <div class="row">
                  <input type="hidden" name="tu" id="" value="<?php
                                            echo date('Y-m-d'); 
                                        ?>"/>
                          <label class="col-sm-8 col-form-label text-end" for="basic-default-name">Total Belanjaan</label>
                          <div class="col-sm-4">
                            <input type="text" name="total" id="total" value="<?=$totalBelanjaan;?>" readonly/>
                          </div>
                </div>
                <div class="row">
                          <label class="col-sm-8 col-form-label text-end" for="basic-default-name">Total Bayar</label>
                          <div class="col-sm-4">
                            <input type="text" name="bayar" id="bayar" oninput="calculateChange()"/>
                          </div>
                </div>
                <div class="row">
                          <label class="col-sm-8 col-form-label text-end" for="basic-default-name">Kembalian</label>
                          <div class="col-sm-4">
                            <input type="text" name="kembalian" id="kembalian" readonly/>
                          </div>
                </div>
                <div class="row">
                          <label class="col-sm-8 col-form-label text-end" for="basic-default-name"></label>
                          <div class="col-sm-4">
                          <button type="submit" class="btn btn-danger" name="transaksi">Bayar</button>   
                          <a href="transaksi.php" rel="noopener noreferrer" class="btn btn-secondary">Kembali</a>        
                        </div>

                          <!--bayar Modal-->
                </div>



               

                </div>
              </div>

              </form>

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
              var response = JSON.parse(data);
              if (response.harga && response.id_barang) {
                    $('#harga').val(response.harga); // Set nilai harga ke input harga
                    $('#id_barang').val(response.id_barang); // Set nilai ID barang ke input ID
                } else {
                    $('#harga').val(''); // Kosongkan jika data tidak valid
                    $('#id_barang').val(''); // Kosongkan ID barang
                    console.error("Data harga atau ID tidak valid:", response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX request failed:", textStatus, errorThrown);
                $('#harga').val(''); // Kosongkan jika terjadi kesalahan
                $('#id_barang').val(''); // Kosongkan ID barang
            }
        });
    } else {
        $('#harga').val(''); // Kosongkan jika tidak ada barang yang dipilih
        $('#id_barang').val(''); // Kosongkan ID barang
    }
}

function calculateChange() {
        var total = parseFloat($('#total').val()) || 0;
        var bayar = parseFloat($('#bayar').val()) || 0;
        var kembalian = bayar - total;
        $('#kembalian').val(kembalian >= 0 ? kembalian : 0); // Tampilkan kembalian, tidak boleh negatif
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
</script>

    <script>
    $(document).ready(function(){
        $('#tabel-data-transaksi').DataTable();
    });
    </script>
  </body>
</html>
