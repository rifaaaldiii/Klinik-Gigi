<?php

include '../../../../env/env.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notrans = $_POST['notrans'];
    $asistens = $_POST['asistens_id'];
    $tipe_regio = $_POST['tipe_regio'];
    if ($tipe_regio == '1') {
        $ro1 = 0;
        $ro2 = 0;
        $ro3 = 0;
        $non_regio = 1;
    } else if ($tipe_regio == '2') {
        $ro1 = 1;
        $ro2 = 0;
        $ro3 = 0;
        $non_regio = 0;
    } else if ($tipe_regio == '3') {
        $ro1 = 0;
        $ro2 = 1;
        $ro3 = 0;
        $non_regio = 0;
    } else if ($tipe_regio == '4') {
        $ro1 = 0;
        $ro2 = 0;
        $ro3 = 1;
        $non_regio = 0;
    }

    $query = "INSERT INTO asistens (id, notrans, id_karyawan, ro1, ro2, ro3, non_regio) VALUES (NULL, '$notrans', '$asistens', '$ro1', '$ro2', '$ro3', '$non_regio')";
    mysqli_query($conn, $query);

    echo "<script>alert('Asistens berhasil di input');</script>";
    echo "<script>window.location.href = '../../index.php?page=Detail_transaksi&notrans=$notrans#input_asistens';</script>";
    exit();
}
