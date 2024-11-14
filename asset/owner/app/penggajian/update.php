<?php
include '../../../../env/env.php';
session_start();

if (isset($_POST['simpan'])) {
    $id_penggajian = $_POST['id_penggajian'];
    $status = 'Completed';

    $query_update = mysqli_query($conn, "UPDATE penggajian SET status = '$status' WHERE id = '$id_penggajian'");
    if ($query_update) {
        echo "<script>alert('Data berhasil disimpan'); window.location.href = '../../index.php?page=Penggajian';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan'); window.history.back();</script>";
    }
}
