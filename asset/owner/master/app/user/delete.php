<?php
include '../../../../../env/env.php'; // Pastikan path ke file konfigurasi database benar
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id == $_SESSION['id']) {
        echo "<script>alert('Data user tidak dapat dihapus.');
        window.history.back();</script>";
        return;
    }

    $query = "DELETE FROM user WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data user berhasil dihapus.');
        window.location.href = '../../../master/index.php?page=User#recent-user';</script>";
    }
}
