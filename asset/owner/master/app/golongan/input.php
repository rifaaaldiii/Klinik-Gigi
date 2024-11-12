<?php
include '../../../../../env/env.php'; // Pastikan path ke file konfigurasi database benar
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $tunjangan_makan = $_POST['tunjangan_makan'];
    $tunjangan_pasien = $_POST['tunjangan_pasien'];
    $overtime = $_POST['overtime'];
    $non_regio = $_POST['non_regio'];
    $ro1 = $_POST['ro1'];
    $ro2 = $_POST['ro2'];
    $ro3 = $_POST['ro3'];

    $query = "INSERT INTO golongan (nama_golongan, gaji_pokok, tunjangan_makan, tunjangan_pasien, overtime, non_regio, ro1, ro2, ro3) 
              VALUES ('$nama', '$gaji_pokok', '$tunjangan_makan', '$tunjangan_pasien', '$overtime', '$non_regio', '$ro1', '$ro2', '$ro3')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data golongan berhasil disimpan.'); 
        window.location.href = '../../../master/index.php?page=Golongan';</script>";
    } else {
        echo "<script>alert('Data golongan gagal disimpan.'); 
        window.history.back();</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid request method.'); 
    window.history.back();</script>";
}
