<?php
  require('../function/function.php');
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
  <!-- Logic -->
  <?php
  // Memeriksa apakah form telah disubmit
  if (isset($_POST['tambah_transaksi'])) {
      // Mengambil data dari form
      $tanggal = $_POST['tanggal'];
      $keterangan = $_POST['keterangan'];
      $debit = isset($_POST['debit']) ? $_POST['debit'] : '';
      $kredit = isset($_POST['kredit']) ? $_POST['kredit'] : '';
      $ref = $_FILES['ref'];

      // Memanggil fungsi untuk menambahkan data ke database
      $result = tambahLaporan($tanggal, $keterangan, $debit, $kredit, $ref);

      // Menggunakan SweetAlert untuk memberikan umpan balik kepada pengguna
      if ($result['status']) {
          echo "<script>
              Swal.fire({
                  title: 'Berhasil!',
                  text: '{$result['message']}',
                  icon: 'success',
                  confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = 'dashboard_bendahara_umum.php'; // Ubah sesuai dengan halaman yang diinginkan
                  }
              });
          </script>";
      } else {
          echo "<script>
              Swal.fire({
                  title: 'Gagal!',
                  text: '{$result['message']}',
                  icon: 'error',
                  confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = 'tambah_transaksi.php'; // Ubah sesuai dengan halaman input
                  }
              });
          </script>";
      }
  }
  ?>


  <!-- Sidebar -->
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
              <form class="app-search-form" method="post" enctype="multipart/form-data">
                <tr>
                  <td>
                    <label>Tanggal</label>
                  </td>
                  <td>
                    <input type="date" class="form-control" name="tanggal" step="0.01" min="0" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Keterangan</label>
                  </td>
                  <td>
                    <input type="text" class="form-control" name="keterangan" require />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Ref (Bukti)</label>
                  </td>
                  <td>
                    <input type="file" class="form-control" name="ref" require />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Debit</label>
                  </td>
                  <td>
                    <input type="number" class="form-control" name="debit" id="debit" required />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Kredit</label>
                  </td>
                  <td>
                    <input type="number" class="form-control" name="kredit" id="kredit" required />
                  </td>
                </tr>
                <!-- Tambah Jarak -->
                <tr>
                  <td>
                  </td>
                  <td>
                  </td>
                </tr>

                <tr>
                  <td>
                    <button name="tambah_transaksi" type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Input Data</button>
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

    <!-- script transaksi baru -->
    <script src="../assets/js/bendahara.js"></script>


</body>

</html>