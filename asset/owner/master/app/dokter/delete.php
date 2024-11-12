<?php
include '../../../../../env/env.php'; // Pastikan path ke file konfigurasi database benar
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM karyawan WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data dokter berhasil dihapus.');
        window.history.back();</script>";
    }
}
