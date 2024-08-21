<?php
$page = 4;
// Cek session terlebih dahulu
session_start();
if (!isset($_SESSION['nim'])) {
  header('Location: login.php');
  exit();
}
// Set waktu expired dalam detik (misalnya 30 menit)
$session_timeout = 30 * 60; // 30 menit = 30 * 60 detik

// Cek apakah session sudah expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
  session_unset(); // Hapus semua data session
  session_destroy(); // Hapus session
  header('Location: ../login.php'); // Redirect ke halaman login
  exit();
}
$_SESSION['last_activity'] = time(); // Perbarui waktu aktivitas terakhir
// Ambil info user yang login
$nim = $_SESSION['nim'];
// Query tampil data
require('../function/function.php');
$daftarLaporan = tampil_data("SELECT * FROM laporan_keuangan");
//Mengambil info user
$infoUser = tampil_data_user($nim);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dashboard Bendahara Umum</title>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
  <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
  <link rel="shortcut icon" href="../assets/images/logo_kmk_nonbg.png">
  <!-- FontAwesome JS-->
  <script defer src="../assets/plugins/fontawesome/js/all.min.js"></script>
  <!-- App CSS -->
  <link id="theme-style" rel="stylesheet" href="../assets/css/portal.css">
  <!-- Sweatalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="app">

  <?php
  require 'navigation/header.php';
  ?>

  <div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
      <div class="container-xl">
        <div class="row g-4 mb-4">
          <div class="table-responsive">
            <table cellpadding="10">
              <!-- Form input -->
              <form class="app-search-form" method="post">
                <tr>
                  <td><h5>Informasi Akun</h5></td>
                  <td></td>
                </tr>
                <tr>
                  <td>
                    <label>Nama Lengkap</label>
                  </td>
                  <td>
                    <input type="text" class="form-control" step="0.01" min="0" value="<?= $infoUser['nama']; ?>" disabled />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>NIM</label>
                  </td>
                  <td>
                    <input type="text" class="form-control" step="0.01" min="0" value="<?= $infoUser['nim']; ?>" disabled />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Jabatan</label>
                  </td>
                  <td>
                    <input type="text" class="form-control" step="0.01" min="0" value="<?= $infoUser['jabatan']; ?>" disabled />
                  </td>
                </tr>
              </form>
              <!-- End of form input -->
            </table>
          </div><!--//table-responsive-->
        </div><!--//container-fluid-->
      </div><!--//app-content-->
    </div><!--//app-wrapper-->
    <!-- Javascript -->
    <script src="../assets/plugins/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Charts JS -->
    <script src="../assets/plugins/chart.js/chart.min.js"></script>
    <script src="../assets/js/index-charts.js"></script>

    <!-- Page Specific JS -->
    <script src="../assets/js/app.js"></script>
    <!-- script bendahara -->
    <script src="js/bendahara.js"></script>

</body>

</html>