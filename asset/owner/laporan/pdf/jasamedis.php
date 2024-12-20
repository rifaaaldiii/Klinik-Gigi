<?php
require("tcpdf/tcpdf.php");
include "../../../../env/env.php";

if (isset($_GET['dokter'])) {
    $dokter = $_GET['dokter'];
    $bulan = $_GET['bulan'];


    // Ambil data transaksi
    $query = mysqli_query($conn, "SELECT 
        t.*,
        k.nama,
        dt.tindakan,
        dt.harga,
        dt.jm,
        dt.diskon
        FROM transaksi t
        JOIN karyawan k ON t.dokter = k.id
        JOIN detail_transaksi dt ON t.notrans = dt.notrans
        WHERE t.dokter = '$dokter'
        AND DATE_FORMAT(t.tanggal, '%Y-%m') = '$bulan'");
    $data = mysqli_fetch_assoc($query);



    // Buat objek PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pdf->AddPage();

    // Atur opacity terlebih dahulu sebelum menambahkan gambar
    $pdf->setAlpha(0.3); // Membuat lebih transparan (nilai 0.1 lebih transparan dari 0.2)
    $pdf->Image('../../../img/logo.png', 70, 55, 70, 70, 'png', '', 'C', false, 300, '', false, false, 0, false, false, false);
    $pdf->setAlpha(1); // Kembalikan opacity ke normal untuk teks

    // Header   
    $pdf->setAlpha(1); // Mengembalikan opacity ke normal untuk teks
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'KLINIK GIGI LUV YOUR TEETH', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(0, 5, 'Making People Smile Is Our Business', 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(0, 5, 'Jl. Sayabulu No.2, Kel.Serang, Kec. Serang, Serang-Banten 42116 Indonesia,', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Telp: 081310680640, E-mail: doktergigilyt@gmail.com', 0, 1, 'C');
    $pdf->Line(10, 45, 200, 45);
    $pdf->Line(10, 46, 200, 46);

    // Judul Laporan
    $pdf->Ln(15);
    $pdf->SetFont('helvetica', 'B', 13);
    $pdf->Cell(0, 5, 'Laporan Jasa Medis', 0, 1, 'C');
    $pdf->Ln(10);

    // Informasi Transaksi
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(40, 5, 'Dokter', 0, 0);
    $pdf->Cell(5, 5, ':', 0, 0);
    $pdf->Cell(0, 5, $data['nama'], 0, 1);

    $pdf->Cell(40, 5, 'Periode', 0, 0);
    $pdf->Cell(5, 5, ':', 0, 0);
    $pdf->Cell(0, 5, date('F Y', strtotime($data['tanggal'])), 0, 1);
    $pdf->Ln(10);

    // Tabel
    $pdf->SetFont('helvetica', 'B', 10);
    $header = array('Tanggal', 'Nama Klien', 'Tindakan', 'Harga', 'Modal', 'Jasa Medis', 'Dis JM', 'Catatan');
    $w = array(18, 21, 40, 22, 22, 22, 15, 30);

    // Header Tabel
    for ($i = 0; $i < count($header); $i++) {
        $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
    }
    $pdf->Ln();
    // Isi Tabel
    $pdf->SetFont('helvetica', '', 9);
    $query_detail = mysqli_query($conn, "SELECT 
        dt.tindakan,
        dt.harga,
        dt.jm,
        dt.modal,
        dt.catatan,
        dt.diskon_jm,
        t.notrans,
        t.tanggal,
        t.nama_klien

        FROM detail_transaksi dt 
        JOIN transaksi t ON dt.notrans = t.notrans
        WHERE t.dokter = '$dokter'
        AND DATE_FORMAT(t.tanggal, '%Y-%m') = '$bulan'");

    while ($row = mysqli_fetch_assoc($query_detail)) {
        $xPos = $pdf->GetX();
        $yPos = $pdf->GetY();

        // Simpan posisi awal
        $startX = $xPos;

        // Hitung tinggi yang dibutuhkan untuk nama klien
        $pdf->SetXY($xPos + $w[0], $yPos);
        $pdf->MultiCell($w[1], 7, $row['nama_klien'], 0, 'L');
        $namaKlienHeight = $pdf->GetY() - $yPos;

        // Hitung tinggi yang dibutuhkan untuk tindakan
        $pdf->SetXY($xPos + array_sum(array_slice($w, 0, 2)), $yPos);
        $pdf->MultiCell($w[2], 7, $row['tindakan'], 0, 'L');
        $tindakanHeight = $pdf->GetY() - $yPos;

        // Hitung tinggi yang dibutuhkan untuk catatan
        $pdf->SetXY($xPos + array_sum(array_slice($w, 0, 7)), $yPos);
        $pdf->MultiCell($w[7], 7, $row['catatan'], 0, 'L');
        $catatanHeight = $pdf->GetY() - $yPos;

        // Gunakan tinggi yang paling besar
        $height = max($namaKlienHeight, $tindakanHeight, $catatanHeight, 7);

        // Kembali ke posisi awal
        $pdf->SetXY($startX, $yPos);

        // Cetak semua kolom dengan tinggi yang sama
        $pdf->Cell($w[0], $height, date('d/m/Y', strtotime($row['tanggal'])), 1, 0, 'C');

        // Cetak nama klien dengan MultiCell
        $pdf->MultiCell($w[1], $height, $row['nama_klien'], 1, 'L');
        $pdf->SetXY($startX + array_sum(array_slice($w, 0, 2)), $yPos);

        // Cetak tindakan dengan MultiCell
        $pdf->MultiCell($w[2], $height, $row['tindakan'], 1, 'L');
        $pdf->SetXY($startX + array_sum(array_slice($w, 0, 3)), $yPos);

        // Cetak kolom-kolom nilai
        $pdf->Cell($w[3], $height, 'Rp. ' . number_format($row['harga']), 1, 0, 'L');
        $pdf->Cell($w[4], $height, 'Rp. ' . number_format($row['modal']), 1, 0, 'L');
        $pdf->Cell($w[5], $height, 'Rp. ' . number_format($row['jm']), 1, 0, 'L');
        $pdf->Cell($w[6], $height, empty($row['diskon_jm']) ? '0%' : $row['diskon_jm'] . '%', 1, 0, 'R');
        // Cetak catatan dengan MultiCell
        $pdf->MultiCell($w[7], $height, $row['catatan'], 1, 'L');

        // Pindah ke baris berikutnya
        $pdf->SetY($yPos + $height);
    }

    // Sebelum output PDF, hitung total
    $query_total = mysqli_query($conn, "SELECT 
        SUM(dt.jm) as total_jm
        FROM detail_transaksi dt 
        JOIN transaksi t ON dt.notrans = t.notrans
        WHERE t.dokter = '$dokter'");
    $total_data = mysqli_fetch_assoc($query_total);

    // Hitung total
    $total = $total_data['total_jm'];

    // Tampilkan total
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(array_sum($w) - 30, 7, 'TOTAL JASA MEDIS', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Rp. ' . number_format($total), 1, 1, 'L');


    // TTD
    $pdf->Ln(18);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(0, 5, 'Serang, ....................... ' . date('Y'), 0, 1, 'R');
    $pdf->Ln(18);
    $pdf->Cell(0, 5, 'Kepala Klinik                         ', 0, 1, 'R');
    // Output PDF (gunakan timestamp sebagai nama file)
    $timestamp = date('Y-m-d_H-i-s');
    $pdf->Output($data['nama'] . '_' . date('F Y', strtotime($data['tanggal'])) . '.pdf', 'I');
}
