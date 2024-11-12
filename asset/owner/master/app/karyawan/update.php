<?php
include '../../../../../env/env.php'; // Pastikan path ke file konfigurasi database benar
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $nik = $_POST['nik'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $no_telp = $_POST['no_telp'];
    $no_rekening = $_POST['no_rekening'];
    $agama = $_POST['agama'];
    $golongan = $_POST['golongan'];
    $alamat = $_POST['alamat'];

    // Validasi data jika diperlukan

    $query = "UPDATE karyawan SET nama='$nama', nip='$nip', nik='$nik', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', telpon='$no_telp', no_rek='$no_rekening', agama='$agama', golongan_id='$golongan', alamat='$alamat' WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data karyawan berhasil disimpan.'); 
        window.history.back();</script>";
    } else {
        echo "<script>alert('Data karyawan gagal disimpan.'); 
        window.history.back();</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid request method.'); 
    window.history.back();</script>";
}
