<?php

include '../../../../env/env.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notrans = $_POST['notrans'];
    $id = $_POST['id'];
    $jm = $_POST['jm_total_fix'];
    $grand_total = $_POST['grand_total_fix'];
    $diskon_jm = $_POST['diskon_jm'];
    $dp = $_POST['dp'];
    $catatan = $_POST['catatan'];

    $query = "UPDATE detail_transaksi SET jm = '$jm', total = '$grand_total', diskon_jm = '$diskon_jm', dp = '$dp', catatan = '$catatan' WHERE id = '$id'";
    mysqli_query($conn, $query);

    echo "<script>alert('Tindakan berhasil di input');</script>";
    echo "<script>window.location.href = '../../index.php?page=Detail_transaksi&notrans=$notrans';</script>";
    exit();
}
