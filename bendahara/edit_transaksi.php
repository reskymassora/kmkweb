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

  // Cek apakah tombol 'edit_transaksi' ditekan
  if (isset($_POST['edit_transaksi'])) {
    // Ambil ID dari URL atau parameter lainnya
    $id = $_GET['id'];

    // Panggil fungsi editLaporan
    editLaporan($conn, $id);
  }

  // Edit Laporan Keuangan
  $id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Mengamankan id dan memastikan id adalah integer

  if ($id > 0) {
    $query = "SELECT * FROM laporan_keuangan WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();

      // Mengambil data
      if ($data = $result->fetch_assoc()) {
        $tanggal = $data['tanggal'];
        $keterangan = $data['keterangan'];
        $ref = $data['ref']; // Nama file yang sudah diupload
        $debit = $data['debit'];
        $kredit = $data['kredit'];
      } else {
        echo "Data tidak ditemukan";
        exit;
      }

      $stmt->close();
    } else {
      echo "Query gagal";
      exit;
    }
  } else {
    echo "ID tidak valid";
    exit;
  }
  $conn->close();
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
                    <input type="date" class="form-control" name="tanggal" step="0.01" min="0" value="<?php echo $tanggal; ?>" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Keterangan</label>
                  </td>
                  <td>
                    <input type="text" class="form-control" name="keterangan" require value="<?php echo $keterangan; ?>" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Ref (Bukti)</label>
                  </td>
                  <td>
                    <img id="refPreview" class="p-2" src="<?php echo $ref; ?>" alt="Current Image" width="100px">
                    <input type="file" class="form-control" name="ref" id="refInput" onchange="previewImage(event)" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Debit</label>
                  </td>
                  <td>
                    <input type="number" class="form-control" id="debit" name="debit" id="debit" value="<?php echo $debit; ?>" required />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Kredit</label>
                  </td>
                  <td>
                    <input type="number" class="form-control" id="kredit" name="kredit" id="kredit" value="<?php echo $kredit; ?>" required />
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
                    <button name="edit_transaksi" type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Edit Data</button>
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