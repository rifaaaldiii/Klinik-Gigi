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
    $diskon_jm = $_POST['diskon_jm'];
    $dp = $_POST['dp'];
    $grand_total = $_POST['grand_total'];
    $catatan = $_POST['catatan'];

    $query = "INSERT INTO detail_transaksi (id, notrans, tindakan, harga, jm, modal, total, diskon, dp, catatan) VALUES (NULL, '$notrans', '$nama_tindakan', '$harga_tindakan', '$total_jasa_medis', '$modal', '$grand_total', '$diskon_lyt',  '$dp', '$catatan')";
    mysqli_query($conn, $query);

    echo "<script>alert('Tindakan berhasil di input');</script>";
    echo "<script>window.location.href = '../../index.php?page=Detail_transaksi&notrans=$notrans';</script>";
    exit();
}
