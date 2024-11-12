<?php
include '../../../../../env/env.php'; // Pastikan path ke file konfigurasi database benar
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jasa_medis = $_POST['jasa_medis'];
    $harga = $_POST['harga'];

    $query = "UPDATE tindakan SET nama_tindakan = '$nama', jm = '$jasa_medis', harga = '$harga' WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data tindakan berhasil diubah.'); 
        window.location.href = '../../../master/index.php?page=Tindakan';</script>";
    } else {
        echo "<script>alert('Data tindakan gagal diubah.'); 
        window.history.back();</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid request method.'); 
    window.history.back();</script>";
}
