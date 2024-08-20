<?php
require ('../function/function.php');

// Set header untuk mengembalikan JSON
header('Content-Type: application/json');

// Ambil ID dari parameter URL
$id = urldecode($_GET['id']);

// Hapus data dari database
$sql = "DELETE FROM daftar_piutang WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'Record deleted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error deleting record: ' . $conn->error]);
}

// Tutup koneksi
$conn->close();
exit();
?>
