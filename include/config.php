<?php

$host = "localhost";
$username = "root";
$password = "";
$database_name = "db_dinotain";
$connection = mysqli_connect($host, $username, $password, $database_name);

if (isset($_POST["login"])) {
    $username = strtolower($_POST["username"]);
    $password = $_POST["password"];
    
    // menggunakan prepared statements untuk keamanan
    $stmt = $connection->prepare("SELECT * FROM tbl_user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($result);

    // cek apakah username ditemukan pada database
    if ($cek > 0) {
        $data = mysqli_fetch_assoc($result);
        $id_user = $data['id_user'];

        // Verifikasi password
        if (password_verify($password, $data['password'])) { // Pastikan password disimpan dengan hash
            // cek jika login sebagai admin
            if ($data['level'] == "admin") {
                // buat session login dan username
                $_SESSION['login'] = true;
                $_SESSION['tbl_user']['username'] = $username;
                $_SESSION['tbl_user']['level'] = "admin";
                $_SESSION['tbl_user']['id_user'] = $id_user;
                // alihkan ke halaman dashboard admin
                header("location:../admin/index.php");
                exit;

            // cek jika login sebagai user
            } else if ($data['level'] == "user") {
                // buat session login dan username
                $_SESSION['login'] = true;
                $_SESSION['tbl_user']['username'] = $username;
                $_SESSION['tbl_user']['level'] = "user";
                $_SESSION['tbl_user']['id_user'] = $id_user; 
                // alihkan ke halaman dashboard user
                header("location: ../html/index.php");
                exit;
            }
        } else {
            // Jika password salah
            echo "<script>
                alert('Password salah!');
                </script>";
        }
    } else {
        // Jika username tidak ditemukan
        echo "<script>
            alert('Username tidak ditemukan!');
            </script>";
    }
}    
/* register */
function signUp($data) {
    global $connection;
    
    $username = htmlspecialchars($data["username"]);
    $namusaha = htmlspecialchars(strtolower($data["namusaha"]));
    $password = mysqli_real_escape_string($connection, $data["password"]);
    $kusaha = htmlspecialchars($data["kusaha"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $provinsi = htmlspecialchars($data["provinsi"]);
    $noTlp = htmlspecialchars($data["telepon"]);
    $kodepos = htmlspecialchars($data["kodepos"]);
    $email = htmlspecialchars($data["email"]);
    $pesan = htmlspecialchars($data["pesan"]);
    $nama = htmlspecialchars($data["nama"]);
    $level = "user";

      // cek NIM sudah ada / belum 
    $usernameResult = mysqli_query($connection, "SELECT username FROM tbl_user WHERE username = '$username'");
    if(mysqli_fetch_assoc($usernameResult)) {
      echo "<script>
      alert('username sudah terdaftar, silahkan gunakan username lain!');
      </script>";
      return 0;
    }
    
    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    
    $querySignUp = "INSERT INTO tbl_user VALUES('', '$username', '$password', '$level', '$nama', '$namusaha', '$kusaha', '$email', '$noTlp', '$provinsi', '$alamat', '$kodepos', '$pesan')";
    mysqli_query($connection, $querySignUp);
    return mysqli_affected_rows($connection);
    
  }
  

    ?>