<?php
// Detail koneksi database
$servername = "localhost";
$username = "u832397905_kmkdipa";
$password = "KMKundipamks.25";
$dbname = "u832397905_kmkdipa";

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "sisfo_kmk_undipa";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

//Query tampil data
function tampil_data($query)
{
  global $conn;

  $result = mysqli_query($conn, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

// Memeriksa koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

//Tambah Surat Masuk
function tambahSuratMasuk($asal, $arsip)
{
    global $conn;

    // Memeriksa apakah ada file yang diupload
    if (!isset($arsip["name"]) || empty($arsip["name"])) {
        return ["status" => false, "message" => "Maaf, file tidak ditemukan atau tidak terupload."];
    }

    // Mengambil nama file saja tanpa path direktori
    $fileName = basename($arsip["name"]);

    // Menyiapkan direktori untuk menyimpan file
    $target_dir = "surat_masuk/";
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Memeriksa apakah file sudah ada
    if (file_exists($target_file)) {
        return ["status" => false, "message" => "Maaf, file sudah ada."];
    }

    // Memeriksa ukuran file
    if ($arsip["size"] > 5000000) {
        return ["status" => false, "message" => "Maaf, ukuran file terlalu besar."];
    }

    // Memeriksa format file
    if (!in_array($fileType, ["pdf", "jpg", "jpeg", "png"])) {
        return ["status" => false, "message" => "Maaf, hanya file PDF, JPG, JPEG, dan PNG yang diperbolehkan."];
    }

    // Memeriksa apakah $uploadOk diatur menjadi 0 oleh kesalahan
    if ($uploadOk == 0) {
        return ["status" => false, "message" => "Maaf, file Anda tidak terupload."];
    } else {
        if (move_uploaded_file($arsip["tmp_name"], $target_file)) {
            // Menyiapkan statement SQL
            $stmt = $conn->prepare("INSERT INTO surat_masuk (asal_organisasi, gambar) VALUES (?, ?)");
            $stmt->bind_param("ss", $asal, $fileName); // Menggunakan $fileName sebagai nilai gambar

            if ($stmt->execute()) {
                $stmt->close();
                return ["status" => true, "message" => "Data berhasil ditambahkan."];
            } else {
                $message = "Kesalahan: " . $stmt->error;
                $stmt->close();
                return ["status" => false, "message" => $message];
            }
        } else {
            return ["status" => false, "message" => "Maaf, terjadi kesalahan saat mengupload file."];
        }
    }
}

//Tambah Surat Keluar
function tambahSuratKeluar($perihal, $nomor_surat, $arsip)
{
    global $conn;

    // Memeriksa apakah ada file yang diupload
    if (!isset($arsip["name"]) || empty($arsip["name"])) {
        return ["status" => false, "message" => "Maaf, file tidak ditemukan atau tidak terupload."];
    }

    // Mengambil nama file saja tanpa path direktori
    $fileName = basename($arsip["name"]);

    // Menyiapkan direktori untuk menyimpan file
    $target_dir = "surat_keluar/";
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Memeriksa apakah file sudah ada
    if (file_exists($target_file)) {
        return ["status" => false, "message" => "Maaf, file sudah ada."];
    }

    // Memeriksa ukuran file
    if ($arsip["size"] > 500000) {
        return ["status" => false, "message" => "Maaf, ukuran file terlalu besar."];
    }

    // Memeriksa format file
    if (!in_array($fileType, ["pdf", "jpg", "jpeg", "png"])) {
        return ["status" => false, "message" => "Maaf, hanya file PDF, JPG, JPEG, dan PNG yang diperbolehkan."];
    }

    // Memeriksa apakah $uploadOk diatur menjadi 0 oleh kesalahan
    if ($uploadOk == 0) {
        return ["status" => false, "message" => "Maaf, file Anda tidak terupload."];
    } else {
        if (move_uploaded_file($arsip["tmp_name"], $target_file)) {
            // Menyiapkan statement SQL
            $stmt = $conn->prepare("INSERT INTO surat_keluar (perihal, nomor_surat, arsip) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $perihal, $nomor_surat, $fileName);

            if ($stmt->execute()) {
                $stmt->close();
                return ["status" => true, "message" => "Data berhasil ditambahkan."];
            } else {
                $message = "Kesalahan: " . $stmt->error;
                $stmt->close();
                return ["status" => false, "message" => $message];
            }
        } else {
            return ["status" => false, "message" => "Maaf, terjadi kesalahan saat mengupload file."];
        }
    }
}

//Tambah Rapat Baru
function tambahRapatBaru($tanggal, $arsip)
{
    global $conn;

    // Memeriksa apakah ada file yang diupload
    if (!isset($arsip["name"]) || empty($arsip["name"])) {
        return ["status" => false, "message" => "Maaf, file tidak ditemukan atau tidak terupload."];
    }

    // Mengambil nama file saja tanpa path direktori
    $fileName = basename($arsip["name"]);

    // Menyiapkan direktori untuk menyimpan file
    $target_dir = "presensi_rapat/";
    $target_file = $target_dir . $fileName;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Memeriksa apakah file sudah ada
    if (file_exists($target_file)) {
        return ["status" => false, "message" => "Maaf, file sudah ada."];
    }

    // Memeriksa ukuran file
    if ($arsip["size"] > 5000000) {
        return ["status" => false, "message" => "Maaf, ukuran file terlalu besar."];
    }

    // Memeriksa format file
    $allowedTypes = ["pdf", "jpg", "jpeg", "png"];
    if (!in_array($fileType, $allowedTypes)) {
        return ["status" => false, "message" => "Maaf, hanya file PDF, JPG, JPEG, dan PNG yang diperbolehkan."];
    }

    // Memindahkan file yang diupload ke direktori tujuan
    if (move_uploaded_file($arsip["tmp_name"], $target_file)) {
        // Menyiapkan statement SQL
        $stmt = $conn->prepare("INSERT INTO presensi_rapat (tanggal_rapat, arsip) VALUES (?, ?)");
        $stmt->bind_param("ss", $tanggal, $fileName); // Menggunakan $fileName sebagai nilai arsip

        if ($stmt->execute()) {
            $stmt->close();
            return ["status" => true, "message" => "Rapat berhasil ditambahkan."];
        } else {
            $message = "Kesalahan: " . $stmt->error;
            $stmt->close();
            return ["status" => false, "message" => $message];
        }
    } else {
        return ["status" => false, "message" => "Maaf, terjadi kesalahan saat mengupload file."];
    }
}

//Tambah Lampiran
function tambahLampiranBaru($keterangan, $nomor_lampiran, $arsip)
{
    global $conn;

    // Memeriksa apakah ada file yang diupload
    if (!isset($arsip["name"]) || empty($arsip["name"])) {
        return ["status" => false, "message" => "Maaf, file tidak ditemukan atau tidak terupload."];
    }

    // Mengambil nama file saja tanpa path direktori
    $fileName = basename($arsip["name"]);

    // Menyiapkan direktori untuk menyimpan file
    $target_dir = "lampiran/";
    $target_file = $target_dir . $fileName;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Memeriksa apakah file sudah ada
    if (file_exists($target_file)) {
        return ["status" => false, "message" => "Maaf, file sudah ada."];
    }

    // Memeriksa ukuran file
    if ($arsip["size"] > 500000) {
        return ["status" => false, "message" => "Maaf, ukuran file terlalu besar."];
    }

    // Memeriksa format file
    $allowedTypes = ["pdf", "jpg", "jpeg", "png"];
    if (!in_array($fileType, $allowedTypes)) {
        return ["status" => false, "message" => "Maaf, hanya file PDF, JPG, JPEG, dan PNG yang diperbolehkan."];
    }

    // Memindahkan file yang diupload ke direktori tujuan
    if (move_uploaded_file($arsip["tmp_name"], $target_file)) {
        // Menyiapkan statement SQL
        $stmt = $conn->prepare("INSERT INTO lampiran (keterangan, nomor_lampiran, arsip) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $keterangan, $nomor_lampiran, $fileName); // Menggunakan $fileName sebagai nilai arsip

        if ($stmt->execute()) {
            $stmt->close();
            return ["status" => true, "message" => "Lampiran berhasil ditambahkan."];
        } else {
            $message = "Kesalahan: " . $stmt->error;
            $stmt->close();
            return ["status" => false, "message" => $message];
        }
    } else {
        return ["status" => false, "message" => "Maaf, terjadi kesalahan saat mengupload file."];
    }
}


//Pamflet Masuk
function tambahPamfletMasuk($asal, $arsip)
{
    global $conn;

    // Memeriksa apakah ada file yang diupload
    if (!isset($arsip["name"]) || empty($arsip["name"])) {
        return ["status" => false, "message" => "Maaf, file tidak ditemukan atau tidak terupload."];
    }

    // Mengambil nama file saja tanpa path direktori
    $fileName = basename($arsip["name"]);

    // Menyiapkan direktori untuk menyimpan file
    $target_dir = "pamflet_masuk/";
    $target_file = $target_dir . $fileName;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Memeriksa apakah file sudah ada
    if (file_exists($target_file)) {
        return ["status" => false, "message" => "Maaf, file sudah ada."];
    }

    // Memeriksa ukuran file
    if ($arsip["size"] > 5000000) { // Ubah ukuran batas jika diperlukan
        return ["status" => false, "message" => "Maaf, ukuran file terlalu besar."];
    }

    // Memeriksa format file
    $allowedTypes = ["pdf", "jpg", "jpeg", "png"];
    if (!in_array($fileType, $allowedTypes)) {
        return ["status" => false, "message" => "Maaf, hanya file PDF, JPG, JPEG, dan PNG yang diperbolehkan."];
    }

    // Memindahkan file yang diupload ke direktori tujuan
    if (move_uploaded_file($arsip["tmp_name"], $target_file)) {
        // Menyiapkan statement SQL tanpa kolom id
        $stmt = $conn->prepare("INSERT INTO pamflet_masuk (asal_organisasi, arsip) VALUES (?, ?)");
        $stmt->bind_param("ss", $asal, $fileName); // Menggunakan $fileName sebagai nilai arsip

        if ($stmt->execute()) {
            $stmt->close();
            return ["status" => true, "message" => "Pamflet masuk berhasil ditambahkan."];
        } else {
            $message = "Kesalahan: " . $stmt->error;
            $stmt->close();
            return ["status" => false, "message" => $message];
        }
    } else {
        return ["status" => false, "message" => "Maaf, terjadi kesalahan saat mengupload file."];
    }
}



// SOURCE CODE FUNCTION UNTUK BENDAHARA
// Buat Laporan Keuangan
function tambahLaporan($tanggal, $keterangan, $debit, $kredit, $ref)
{
    global $conn;
    // Menentukan lokasi penyimpanan file
    $target_dir = "referensi/";

    // Ubah nama file sebelum disimpan
    $new_file_name = uniqid() . '.' . strtolower(pathinfo($ref["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . $new_file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Memeriksa apakah file adalah gambar
    $check = getimagesize($ref["tmp_name"]);
    if ($check === false) {
        return ['status' => false, 'message' => 'File bukan gambar.'];
    }
    // Memeriksa apakah file sudah ada
    if (file_exists($target_file)) {
        return ['status' => false, 'message' => 'File sudah ada.'];
    }
    // Memeriksa ukuran file
    if ($ref["size"] > 500000) { // Batasan 500KB
        return ['status' => false, 'message' => 'Ukuran file terlalu besar.'];
    }
    // Memeriksa jenis file
    $allowed_file_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_file_types)) {
        return ['status' => false, 'message' => 'Hanya file JPG, JPEG, PNG & GIF yang diizinkan.'];
    }
    // Jika semuanya baik, lanjutkan dengan mengupload file
    if (!move_uploaded_file($ref["tmp_name"], $target_file)) {
        return ['status' => false, 'message' => 'Terjadi kesalahan saat mengupload file.'];
    }
    // Menghitung saldo berdasarkan debit dan kredit
    $saldo = 0;
    // Ambil saldo terakhir
    $query_saldo = "SELECT saldo FROM laporan_keuangan ORDER BY id DESC LIMIT 1";
    $result_saldo = mysqli_query($conn, $query_saldo);
    if ($result_saldo && mysqli_num_rows($result_saldo) > 0) {
        $row = mysqli_fetch_assoc($result_saldo);
        $saldo = (int)$row['saldo'];
    }
    // Update saldo berdasarkan debit dan kredit
    $debit = !empty($debit) ? (int)$debit : 0;
    $kredit = !empty($kredit) ? (int)$kredit : 0;
    $saldo = $saldo + $debit - $kredit;
    // Insert data ke dalam tabel
    $query = "INSERT INTO laporan_keuangan (tanggal, keterangan, debit, kredit, saldo, ref) 
              VALUES ('$tanggal', '$keterangan', $debit, $kredit, $saldo, '$target_file')";

    if (mysqli_query($conn, $query)) {
        return ['status' => true, 'message' => 'Transaksi berhasil ditambahkan.'];
    } else {
        // Hapus file jika insert gagal
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        return ['status' => false, 'message' => 'Gagal menambahkan transaksi: ' . mysqli_error($conn)];
    }
}

// Edit Laporan Keuangan
function editLaporan($conn, $id) {
    // Ambil data dari form
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $debit = isset($_POST['debit']) && $_POST['debit'] !== '' ? $_POST['debit'] : 0;
    $kredit = isset($_POST['kredit']) && $_POST['kredit'] !== '' ? $_POST['kredit'] : 0;

    // Cek apakah file baru diunggah
    if ($_FILES['ref']['error'] === UPLOAD_ERR_OK) {
        // Proses file baru
        $ref = $_FILES['ref']['name'];
        $target_dir = "referensi/";
        $target_file = $target_dir . basename($ref);
        move_uploaded_file($_FILES['ref']['tmp_name'], $target_file);

        // Hapus file lama jika ada
        $old_ref_query = "SELECT ref FROM laporan_keuangan WHERE id = $id";
        $result = mysqli_query($conn, $old_ref_query);
        $old_ref = mysqli_fetch_assoc($result)['ref'];

        if ($old_ref && file_exists($target_dir . $old_ref)) {
            unlink($target_dir . $old_ref);
        }

        // Query untuk mengupdate data dengan file baru
        $query = "UPDATE laporan_keuangan SET tanggal = '$tanggal', keterangan = '$keterangan', ref = '$ref', debit = '$debit', kredit = '$kredit' WHERE id = $id";
    } else {
        // Query untuk mengupdate data tanpa mengubah file
        $query = "UPDATE laporan_keuangan SET tanggal = '$tanggal', keterangan = '$keterangan', debit = '$debit', kredit = '$kredit' WHERE id = $id";
    }

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Update saldo setelah data diubah
        updateSaldo($conn);

        // Tampilkan SweetAlert setelah berhasil
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil diubah.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboard_bendahara_umum.php';
                }
            });
        </script>";
    } else {
        // Tampilkan SweetAlert jika gagal
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Gagal mengubah data.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}

function updateSaldo($conn) {
    // Ambil semua transaksi dan urutkan berdasarkan ID
    $query = "SELECT id, debit, kredit FROM laporan_keuangan ORDER BY id ASC";
    $result = $conn->query($query);

    $previous_saldo = 0;
    while ($row = $result->fetch_assoc()) {
        $new_saldo = $previous_saldo + $row['debit'] - $row['kredit'];
        $conn->query("UPDATE laporan_keuangan SET saldo = $new_saldo WHERE id = " . $row['id']);
        $previous_saldo = $new_saldo;
    }
}








