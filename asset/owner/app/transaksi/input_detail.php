<?php

include '../../../../env/env.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notrans = $_POST['notrans'];
    $harga_tindakan = $_POST['harga_tindakan'];
    $nama_tindakan = $_POST['nama_tindakan'];
    $total_jasa_medis = $_POST['total_jasa_medis'];
    $modal = $_POST['modal'];
    $diskon_lyt = $_POST['diskon_lyt'];
    $grand_total = $_POST['grand_total'];
    $dp = '0';
    $diskon_jm = '0';

    $query = "INSERT INTO detail_transaksi (id, notrans, tindakan, harga, jm, modal, total, diskon, dp, diskon_jm) VALUES (NULL, '$notrans', '$nama_tindakan', '$harga_tindakan', '$total_jasa_medis', '$modal', '$grand_total', '$diskon_lyt', '$dp', '$diskon_jm')";
    mysqli_query($conn, $query);

    echo "<script>alert('Tindakan berhasil di input');</script>";
    echo "<script>window.location.href = '../../index.php?page=Detail_transaksi&notrans=$notrans';</script>";
    exit();
}
