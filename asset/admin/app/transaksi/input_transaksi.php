<?php

include '../../../../env/env.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notrans = $_POST['notrans'];
    $cash = $_POST['cash'];
    $transfer = $_POST['transfer'];
    $catatan = $_POST['catatan'];
    $total_bayar = $_POST['g_total'];
    $status = 'Completed';

    // Validasi jika cash + transfer tidak sama dengan total_bayar
    if (($cash + $transfer) != $total_bayar) {
        echo "<script>alert('Pembayaran tidak terpenuhi');</script>";
        echo "<script>window.history.back();</script>";
        exit();
    }

    if ($cash > 0 && $transfer > 0) {
        $metode_pembayaran = 'Cash + Transfer';
    } elseif ($cash > 0) {
        $metode_pembayaran = 'Cash';
    } else {
        $metode_pembayaran = 'Transfer';
    }

    $query = "UPDATE detail_transaksi SET metode = '$metode_pembayaran' WHERE notrans = '$notrans'";
    mysqli_query($conn, $query);

    $query = "UPDATE transaksi SET total = '$total_bayar', status = '$status' WHERE notrans = '$notrans'";
    mysqli_query($conn, $query);

    echo "<script>alert('Transaksi berhasil di input');</script>";
    echo "<script>window.location.href = '../../index.php?page=Transaksi';</script>";
    exit();
}
