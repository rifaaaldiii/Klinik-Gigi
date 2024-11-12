<?php
include '../../../../env/env.php';
session_start();

if (isset($_POST['simpan'])) {
    $notrans = $_POST['notrans'];
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
