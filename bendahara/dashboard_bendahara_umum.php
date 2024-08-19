<?php
// Query tampil data
require('../function/function.php');
$daftarLaporan = tampil_data("SELECT * FROM laporan_keuangan");
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
        <div class="mb-3">
          <a class="btn btn-primary text-white" href="tambah_transaksi.php">Tambah</a>
        </div>
        <div class="row g-4 mb-4">
          <div class="table-responsive">
            <table class="table app-table-hover mb-0 text-left">
              <thead>
                <tr>
                  <th class="cell">No.</th>
                  <th class="cell">Tanggal</th>
                  <th class="cell">Keterangan</th>
                  <th class="cell">Ref</th>
                  <th class="cell">Debit</th>
                  <th class="cell">Kredit</th>
                  <th class="cell">Saldo</th>
                  <th class="cell">Tindakan</th>
                </tr>
              </thead>

              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($daftarLaporan as $data) : ?>
                  <tr>
                    <td class="cell"><?= $i; ?></td>
                    <td class="cell"><?= $data['tanggal'] ?></td>
                    <td class="cell"><?= $data['keterangan'] ?></td>
                    <td class="cell"><img src="<?= $data['ref']; ?>" alt="Gagal menampilkan data" width="60"></td>
                    <td class="cell"><?= $data['debit'] ?></td>
                    <td class="cell"><?= $data['kredit'] ?></td>
                    <td class="cell"><?= $data['saldo'] ?></td>
                    <td>
                      <a class="btn btn-primary text-white p-2" href="edit_transaksi.php?id=<?= urlencode($data['id'])?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                      </a>
                      <button class="btn btn-danger text-white p-2" href="#" onclick="confirmDelete('<?= urlencode($data['id']) ?>')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                          <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                        </svg>
                      </button>
                    </td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
              </tbody>
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