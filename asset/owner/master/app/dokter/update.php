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

    // Validasi data jika ada yang kosong
    if (empty($nama) || empty($nip) || empty($nik) || empty($jenis_kelamin) || empty($tanggal_lahir) || empty($no_telp) || empty($no_rekening) || empty($agama) || empty($golongan) || empty($alamat)) {
        echo "<script>alert('Semua field harus diisi.'); 
        window.history.back();</script>";
        exit;
    }

    // Ubah query menjadi UPDATE
    $query = "UPDATE karyawan SET 
              nama='$nama', 
              jenis_kelamin='$jenis_kelamin', 
              tanggal_lahir='$tanggal_lahir', 
              telpon='$no_telp', 
              no_rek='$no_rekening', 
              agama='$agama', 
              golongan_id='$golongan', 
              alamat='$alamat',
              nip = '$nip',
              nik = '$nik'
              WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data dokter berhasil diperbarui.'); 
        window.history.back();</script>";
    } else {
        echo "<script>alert('Data dokter gagal diperbarui.'); 
        window.history.back();</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid request method.'); 
    window.history.back();</script>";
}
