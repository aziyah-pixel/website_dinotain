<?php
require "../include/function.php";

$kategori = queryReadData("SELECT * FROM tbl_katagori");

$query = "SELECT id_provinsi, provinsi FROM tbl_provinsi"; // Ganti dengan nama tabel dan kolom yang sesuai
$result = mysqli_query($connection, $query);

$provinsi = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $provinsi[] = $row; // Simpan hasil ke dalam array
    }
}

require "../include/config.php";

if(isset($_POST["sigUp"]) ) {
  
  if(signUp($_POST) > 0) {
    echo "<script>
    alert('Sign Up berhasil!')
    </script>";
    header('location: login.php');
  }else {
    echo "<script>
    alert('Sign Up gagal!')
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
  class="light-style customizer-hide"
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

    <title>Register Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

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
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container regis">
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
          <div class="card">
          <div class="logo mt-3">
            <img src="../assets/img/icons/brands/logo.jpg" alt="" srcset="" width="250px">
           </div>

           <div class="card-body">
              <form method="post">
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-name">Username</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="basic-default-name" name="username"required/>
                  </div>
                </div>
                <div class="mb-3 row">
                        <label for="html5-password-input" class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-9">
                        <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      required
                    />
                    <span class="input-group-text cursor-pointer" id="togglePassword"><i class="bx bx-hide"></i></span>
                  </div>
                        </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-name">nama usaha</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="basic-default-name" name="namusaha" required/>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-name">Nama Pemilik Usaha </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="basic-default-name" name="nama"required/>
                  </div>
                </div>
                <div class="row mb-3">
                <label for="timeZones" class="col-sm-3 col-form-label">Katagori Usaha</label>
                  <div class="col-sm-9">
                  <select id="timeZones" class="select2 form-select"  name="kusaha">
                            <option selected>Choose</option>
                              <?php foreach ($kategori as $item) : ?>
                              <option><?= $item["nama_katagori"]; ?></option>
                              <?php endforeach; ?>
                  </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-phone">no telepon</label>
                  <div class="col-sm-9">
                    <input
                    name="telepon"
                      type="tel"
                      id="basic-default-phone"
                      class="form-control phone-mask"
                      aria-describedby="basic-default-phone"
                    required/>
                  </div>
                </div>
                <div class="row mb-3">
                <label for="timeZones" class="col-sm-3 col-form-label">Provinsi</label>
                  <div class="col-sm-9">
                  <select id="timeZones" class="select2 form-select"  name="provinsi">
                            <option selected>Choose</option>
                            <?php foreach ($provinsi as $item) : ?>
                <option ><?= $item['provinsi']; ?></option>
            <?php endforeach; ?>
                  </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-alamat">alamat</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="basic-default-alamat" name="alamat" required/>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-kode">kode pos</label>
                  <div class="col-sm-9">
                    <input
                    name="kodepos"
                      type="text"
                      id="basic-default-kode"
                      class="form-control kode-maks"
                      aria-describedby="basic-default-kode"
                      required
                    />
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-email">email</label>
                  <div class="col-sm-9">
                    <div class="input-group input-group-merge">
                      <input
                      name="email"
                        type="email"
                        id="basic-default-email"
                        class="form-control"
                        aria-label="john.doe"
                        aria-describedby="basic-default-email2"
                        required
                      />
                      
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-3 col-form-label" for="basic-default-nota">pesan nota</label>
                  <div class="col-sm-9">
                    <textarea
                    name="pesan"
                      id="basic-default-nota"
                      class="form-control"
                      aria-describedby="basic-icon-default-nota"
                    ></textarea>
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary" name="sigUp">Send</button>
                  </div>
                </div>
              </form><br>
              <p class="text-center">
                <span>Already have an account?</span>
                <a href="login.php">
                  <span>Sign in instead</span>
                </a>
              </p>

            </div>

          </div>
          

           
          </div>
        </div>
    </div>

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
    <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the eye / eye slash icon
        this.querySelector('i').classList.toggle('bx-hide');
        this.querySelector('i').classList.toggle('bx-show');
    });
</script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
