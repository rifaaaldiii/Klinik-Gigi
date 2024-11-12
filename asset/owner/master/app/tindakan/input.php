<?php
include '../../../../../env/env.php'; // Pastikan path ke file konfigurasi database benar
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jasa_medis = $_POST['jasa_medis'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO tindakan (nama_tindakan, jm, harga) 
              VALUES ('$nama', '$jasa_medis', '$harga')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data tindakan berhasil disimpan.'); 
        window.location.href = '../../../master/index.php?page=Tindakan';</script>";
    } else {
        echo "<script>alert('Data tindakan gagal disimpan.'); 
        window.history.back();</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid request method.'); 
    window.history.back();</script>";
}
