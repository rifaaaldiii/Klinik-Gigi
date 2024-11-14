<?php

include '../../../../env/env.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notrans = $_POST['notrans'];
    $harga_tindakan = $_POST['harga_tindakan'];
    $nama_tindakan = $_POST['nama_tindakan'];
    $jumlah_total = $_POST['jumlah_total'];
    $total_jasa_medis = $_POST['total_jasa_medis'];
    $modal = $_POST['modal'];
    $diskon_lyt = $_POST['diskon_lyt'];
    $grand_total = $_POST['grand_total'];
    $dp = '0';
    $diskon_jm = '0';
    $catatan = '';
    $harga = $jumlah_total + $harga_tindakan;

    $query = "INSERT INTO detail_transaksi
     (id, 
     notrans, 
     tindakan, 
     harga, 
     jm, 
     modal, 
     total, 
     diskon, 
     dp, 
     diskon_jm, 
     catatan) VALUES 
     (NULL, 
     '$notrans', 
     '$nama_tindakan', 
     '$harga', 
     '$total_jasa_medis', 
     '$modal', 
     '$grand_total', 
     '$diskon_lyt', 
     '$dp', 
     '$diskon_jm', 
     '$catatan')";
    mysqli_query($conn, $query);

    echo "<script>alert('Tindakan berhasil di input');</script>";
    echo "<script>window.location.href = '../../index.php?page=Detail_transaksi&notrans=$notrans';</script>";
    exit();
}
