<?php

include '../../../../env/env.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notrans = $_POST['notrans'];
    $asistens = $_POST['asistens_id'];
    $tipe_regio = $_POST['tipe_regio'];
    $tanggal = $_POST['tanggal'];
    
    // Validasi jika asistens kosong atau 0
    if (empty($asistens) || $asistens == '0') {
        echo "<script>alert('Data asisten sudah terinput!');</script>";
        echo "<script>window.location.href = '../../index.php?page=Detail_transaksi&notrans=$notrans#input_asistens';</script>";
        exit();
    }

    // Cek apakah asisten sudah terdaftar
    $check_asisten = mysqli_query($conn, "SELECT id_karyawan FROM asistens WHERE id_karyawan = '$asistens' AND notrans = '$notrans'");
    if (mysqli_num_rows($check_asisten) > 0) {
        echo "<script>alert('Asisten ini sudah terdaftar untuk transaksi ini!');</script>";
        echo "<script>window.location.href = '../../index.php?page=Detail_transaksi&notrans=$notrans#input_asistens';</script>";
        exit();
    }

    $status = 'Pending';
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

    $query = "INSERT INTO asistens (id, notrans, id_karyawan, tanggal, ro1, ro2, ro3, non_regio, status) VALUES (NULL, '$notrans', '$asistens', '$tanggal', '$ro1', '$ro2', '$ro3', '$non_regio', '$status')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Asistens berhasil di input');</script>";
    } else {
        echo "<script>alert('Gagal menambahkan asisten!');</script>";
    }
    echo "<script>window.location.href = '../../index.php?page=Detail_transaksi&notrans=$notrans#input_asistens';</script>";
    exit();
}
