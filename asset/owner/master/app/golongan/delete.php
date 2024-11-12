<?php
include '../../../../../env/env.php'; // Pastikan path ke file konfigurasi database benar
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM golongan WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data golongan berhasil dihapus.');
        window.location.href = '../../../master/index.php?page=Golongan#recent-golongan';</script>";
    }
}
