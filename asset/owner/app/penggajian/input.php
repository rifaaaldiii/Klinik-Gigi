<?php
include '../../../../env/env.php';
session_start();

if (isset($_POST['simpan'])) {
    $id_karyawan = $_POST['id_karyawan'];
    $tanggal = $_POST['tanggal'];
    $gaji_pokok = $_POST['gaji_pokok'];

    // Cek apakah input kosong
    if (empty($id_karyawan)) {
        echo "<script>alert('Data tidak ditemukan'); window.history.back();</script>";
        exit;
    }

    $tanggal = $_POST['tanggal'];
    $asistensi = '0';
    $total_gaji = '0';

    $query_insert = mysqli_query($conn, "INSERT INTO penggajian (karyawan_id, gaji_pokok, tanggal, asistensi, total) VALUES ('$id_karyawan', '$gaji_pokok', '$tanggal', '$asistensi', '$total_gaji')");
    if ($query_insert) {
        $id_penggajian = mysqli_insert_id($conn);
        echo "<script>alert('Data berhasil disimpan'); window.location.href = '../../index.php?page=Detail_penggajian&id_karyawan=$id_karyawan&id_penggajian=$id_penggajian';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan'); window.history.back();</script>";
    }
}
