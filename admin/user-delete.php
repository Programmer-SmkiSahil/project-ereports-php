<?php
require '../configs/connect.php';

// Buat Variabel yang menampung ID
$id = $_GET['id'];

// Buat Method untuk menghapus Data
if (isset($id)) {
    // Query untuk menghapus data berdasarkan ID
    $conn->query("DELETE FROM users WHERE id = $id");
    // Pengecekan apakah data berhasil dihapus
    if ($conn->affected_rows > 0) {
        echo "<script>
                alert('Data berhasil dihapus!');
              </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
              </script>";
    }
    Header ("Location: user-management.php");
    exit;
}