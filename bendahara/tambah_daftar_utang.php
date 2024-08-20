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
  if (isset($_POST['tambah_utang'])) {
    // Mengambil data dari form
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $nama_debitur = $_POST['nama_debitur'];
    $jumlah = $_POST['jumlah'];
    $status = $_POST['status'];

    // Memanggil fungsi untuk menambahkan data ke database
    $result = tambahUtang($tanggal, $keterangan, $nama_debitur, $jumlah, $status);

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
                  window.location.href = 'dashboard_daftar_utang.php'; // Ubah sesuai dengan halaman yang diinginkan
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
                  window.location.href = 'tambah_utang.php'; // Ubah sesuai dengan halaman input
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
                    <input type="date" class="form-control" name="tanggal" step="0.01" min="0" require />
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
                    <label>Nama Debitur</label>
                  </td>
                  <td>
                    <input type="text" class="form-control" name="nama_debitur" require />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Jumlah</label>
                  </td>
                  <td>
                    <input type="number" class="form-control" name="jumlah" id="jumlah" require />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Status</label>
                  </td>
                  <td>
                    <Select class="form-select" name="status" require>
                      <option>PILIH</option>
                      <option value="LUNAS">LUNAS</option>
                      <option value="LUNAS">LUNAS 50%</option>
                      <option value="BELUM LUNAS">BELUM LUNAS</option>
                    </Select>
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
                    <button name="tambah_utang" type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Input Data</button>
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
    <script src="js/bendahara.js"></script>


</body>

</html>