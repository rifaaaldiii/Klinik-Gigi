<?php
include '../../../../env/env.php';
session_start();

if (isset($_POST['simpan'])) {
    $bonus = $_POST['bonus'];
    $jumlahovertime = $_POST['jumlah_total_overtime'];
    $jumlahtunjangan_makan = $_POST['jumlah_total_tunjangan_makan'];
    $jumlahtunjangan_pasien = $_POST['jumlah_total_tunjangan_pasien'];
    $jumlahregio_1 = $_POST['jumlah_total_regio_1'];
    $jumlahregio_2 = $_POST['jumlah_total_regio_2'];
    $jumlahregio_3 = $_POST['jumlah_total_regio_3'];
    $jumlahnonregio = $_POST['jumlah_total_non_regio'];
    $asistensi = $_POST['total_asistens'];
    $id_penggajian = $_POST['id_penggajian'];
    $id_karyawan = $_POST['id_karyawan'];
    $tanggal = $_POST['tanggal'];
    $status = 'Completed';
    
    $query_insert = mysqli_query($conn, "INSERT INTO detail_gaji 
    (penggajian_id, karyawan_id, bonus, overtime, makan, jumlah_pasien, ro1, ro2, ro3, non_regio) VALUES 
    ('$id_penggajian', '$id_karyawan', '$bonus', '$jumlahovertime', '$jumlahtunjangan_makan', '$jumlahtunjangan_pasien', '$jumlahregio_1', '$jumlahregio_2', '$jumlahregio_3', '$jumlahnonregio')");

    $query_penggajian = mysqli_query($conn, "SELECT * FROM penggajian WHERE id = '$id_penggajian'");
    $data_penggajian = mysqli_fetch_assoc($query_penggajian);
    $total = $data_penggajian['gaji_pokok'] + $asistensi;

    $query_update = mysqli_query($conn, "UPDATE penggajian SET asistensi = '$asistensi', total = '$total' WHERE id = '$id_penggajian'");
    $query_update_asistens = mysqli_query($conn, "UPDATE asistens SET status = '$status' WHERE id_karyawan = '$id_karyawan' AND status = 'Pending'");

    if ($query_insert && $query_update && $query_update_asistens) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href = '../../index.php?page=Penggajian';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan'); window.history.back();</script>";
    }
}
