<?php
include '../../../../env/env.php';
session_start();

if (isset($_POST['simpan'])) {
    $notrans = $_POST['notrans'];
    
    // Cek apakah notrans sudah ada
    $check_notrans = mysqli_query($conn, "SELECT notrans FROM transaksi WHERE notrans = '$notrans'");
    
    if (mysqli_num_rows($check_notrans) > 0) {
        // Jika notrans sudah ada, ambil angka dari notrans
        $angka = intval(substr($notrans, 2)); // Ambil angka setelah 'TN'
        $angka++; // Tambah 1
        
        // Buat format baru dengan padding 0 di depan
        $notrans = 'TN' . str_pad($angka, 3, '0', STR_PAD_LEFT);
    }
    
    $tanggal = $_POST['tanggal'];
    $nama_klien = $_POST['nama_klien'];
    $dokter = $_POST['dokter'];
    $status = 'Pending';

    $query_insert = mysqli_query($conn, "INSERT INTO transaksi (notrans, tanggal, nama_klien, dokter, status) VALUES ('$notrans', '$tanggal', '$nama_klien', '$dokter', '$status')");

    if ($query_insert) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href = '../../index.php?page=Detail_transaksi&notrans=$notrans';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan'); window.history.back();</script>";
    }
}
