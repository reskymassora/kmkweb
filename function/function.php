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
function editLaporan($conn, $id)
{
    // Ambil data dari form
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $debit = isset($_POST['debit']) && $_POST['debit'] !== '' ? $_POST['debit'] : 0;
    $kredit = isset($_POST['kredit']) && $_POST['kredit'] !== '' ? $_POST['kredit'] : 0;

    // Direktori target untuk menyimpan file
    $target_dir = "referensi/";

    // Cek apakah file baru diunggah
    if ($_FILES['ref']['error'] === UPLOAD_ERR_OK) {
        // Ambil nama file asli
        $original_filename = $_FILES['ref']['name'];
        
        // Tambahkan direktori target ke nama file untuk disimpan di database
        $ref = $target_dir . basename($original_filename);

        // Tentukan path lengkap untuk menyimpan file
        $target_file = $target_dir . basename($original_filename);

        // Pindahkan file yang diunggah ke direktori tujuan
        move_uploaded_file($_FILES['ref']['tmp_name'], $target_file);

        // Hapus file lama jika ada
        $old_ref_query = "SELECT ref FROM laporan_keuangan WHERE id = $id";
        $result = mysqli_query($conn, $old_ref_query);
        $old_ref = mysqli_fetch_assoc($result)['ref'];

        if ($old_ref && file_exists($old_ref)) {
            unlink($old_ref);
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

// Update saldo
function updateSaldo($conn)
{
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

// Tambah daftar utang
function tambahUtang($tanggal, $keterangan, $nama_debitur, $jumlah, $status)
{
    global $conn;

    // Insert data ke dalam tabel utang
    $query = "INSERT INTO daftar_utang (tanggal, keterangan, nama_debitur, jumlah, status) 
              VALUES ('$tanggal', '$keterangan', '$nama_debitur', $jumlah, '$status')";

    if (mysqli_query($conn, $query)) {
        return ['status' => true, 'message' => 'Data utang berhasil ditambahkan.'];
    } else {
        return ['status' => false, 'message' => 'Gagal menambahkan data utang: ' . mysqli_error($conn)];
    }
}

// Edit utang
function editUtang($conn, $id)
{
    // Ambil data dari form
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $nama_debitur = $_POST['nama_debitur'];
    $jumlah = $_POST['jumlah'];
    $status = $_POST['status'];

    // Query untuk mengupdate data
    $query = "UPDATE daftar_utang SET 
                tanggal = '$tanggal', 
                keterangan = '$keterangan', 
                nama_debitur = '$nama_debitur', 
                jumlah = $jumlah, 
                status = '$status'
              WHERE id = $id";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Tampilkan SweetAlert setelah berhasil
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data utang berhasil diubah.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboard_daftar_utang.php';
                }
            });
        </script>";
    } else {
        // Tampilkan SweetAlert jika gagal
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Gagal mengubah data utang: " . mysqli_error($conn) . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}

// Tambah daftar piutang
function tambahPiutang($tanggal, $keterangan, $nama_kreditur, $jumlah, $status)
{
    global $conn;

    // Insert data ke dalam tabel utang
    $query = "INSERT INTO daftar_piutang (tanggal, keterangan, nama_kreditur, jumlah, status) 
              VALUES ('$tanggal', '$keterangan', '$nama_kreditur', $jumlah, '$status')";

    if (mysqli_query($conn, $query)) {
        return ['status' => true, 'message' => 'Data Piutang berhasil ditambahkan.'];
    } else {
        return ['status' => false, 'message' => 'Gagal menambahkan data Piutang: ' . mysqli_error($conn)];
    }
}

// Edit Piutang
function editPiutang($conn, $id)
{
    // Ambil data dari form
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $nama_kreditur = $_POST['nama_kreditur'];
    $jumlah = $_POST['jumlah'];
    $status = $_POST['status'];

    // Query untuk mengupdate data
    $query = "UPDATE daftar_piutang SET 
                tanggal = '$tanggal', 
                keterangan = '$keterangan', 
                nama_kreditur = '$nama_kreditur', 
                jumlah = $jumlah, 
                status = '$status'
              WHERE id = $id";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Tampilkan SweetAlert setelah berhasil
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data utang berhasil diubah.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboard_daftar_piutang.php';
                }
            });
        </script>";
    } else {
        // Tampilkan SweetAlert jika gagal
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Gagal mengubah data utang: " . mysqli_error($conn) . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}

