<?php
require("tcpdf/tcpdf.php");
include "../../../../env/env.php";

if (isset($_GET['notrans'])) {
    $notrans = $_GET['notrans'];

    // Ambil data transaksi
    $query = mysqli_query($conn, "SELECT 
        t.*,
        k.nama,
        dt.catatan
        FROM transaksi t
        JOIN karyawan k ON t.dokter = k.id
        JOIN detail_transaksi dt ON t.notrans = dt.notrans
        WHERE t.notrans = '$notrans'
        GROUP BY t.notrans, k.nama");
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
    $pdf->Cell(0, 5, 'Laporan Transaksi', 0, 1, 'C');
    $pdf->Ln(10);

    // Informasi Transaksi
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(40, 5, 'No. Transaksi', 0, 0);
    $pdf->Cell(5, 5, ':', 0, 0);
    $pdf->Cell(0, 5, $data['notrans'], 0, 1);

    $pdf->Cell(40, 5, 'Tanggal Transaksi', 0, 0);
    $pdf->Cell(5, 5, ':', 0, 0);
    $pdf->Cell(0, 5, hariIndo($data['tanggal']) . ', ' . date('d F Y', strtotime($data['tanggal'])), 0, 1);

    $pdf->Cell(40, 5, 'Nama Klien', 0, 0);
    $pdf->Cell(5, 5, ':', 0, 0);
    $pdf->Cell(0, 5, $data['nama_klien'], 0, 1);

    $pdf->Cell(40, 5, 'Dokter', 0, 0);
    $pdf->Cell(5, 5, ':', 0, 0);
    $pdf->Cell(0, 5, $data['nama'], 0, 1);
    $pdf->Ln(10);

    // Tabel
    $pdf->SetFont('helvetica', 'B', 10);
    $header = array('Tindakan', 'Harga', 'Diskon', 'Diskon JM', 'Catatan', 'Total');
    $w = array(55, 27, 27, 27, 27, 27);

    // Header Tabel
    for ($i = 0; $i < count($header); $i++) {
        $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
    }
    $pdf->Ln();

    // Isi Tabel
    $pdf->SetFont('helvetica', '', 10);
    $query_detail = mysqli_query($conn, "SELECT 
        dt.tindakan,
        dt.harga,
        dt.diskon,
        dt.diskon_jm,
        dt.total,
        dt.catatan
        FROM detail_transaksi dt 
        WHERE dt.notrans = '$notrans'");

    while ($row = mysqli_fetch_assoc($query_detail)) {
        $xPos = $pdf->GetX();
        $yPos = $pdf->GetY();

        // Simpan posisi awal
        $startX = $xPos;

        // Hitung tinggi yang dibutuhkan untuk tindakan
        $pdf->SetXY($xPos, $yPos);
        $pdf->MultiCell($w[0], 7, $row['tindakan'], 0, 'L');
        $tindakanHeight = $pdf->GetY() - $yPos;

        // Hitung tinggi yang dibutuhkan untuk catatan
        $pdf->SetXY($xPos + $w[0] + $w[1] + $w[2] + $w[3], $yPos);
        $pdf->MultiCell($w[4], 7, $row['catatan'], 0, 'L');
        $catatanHeight = $pdf->GetY() - $yPos;

        // Gunakan tinggi yang paling besar
        $height = max($tindakanHeight, $catatanHeight, 7);

        // Kembali ke posisi awal
        $pdf->SetXY($startX, $yPos);

        // Cetak tindakan dengan MultiCell
        $pdf->MultiCell($w[0], $height, $row['tindakan'], 1, 'L');

        // Cetak kolom-kolom nilai
        $pdf->SetXY($startX + $w[0], $yPos);
        $pdf->Cell($w[1], $height, 'Rp. ' . number_format($row['harga']), 1, 0, 'L');
        $pdf->Cell($w[2], $height, empty($row['diskon']) ? '0%' : $row['diskon'] . '%', 1, 0, 'R');
        $pdf->Cell($w[3], $height, empty($row['diskon_jm']) ? '0%' : $row['diskon_jm'] . '%', 1, 0, 'R');

        // Cetak catatan dengan MultiCell
        $pdf->SetXY($startX + $w[0] + $w[1] + $w[2] + $w[3], $yPos);
        $pdf->MultiCell($w[4], $height, $row['catatan'], 1, 'L');

        // Cetak total
        $pdf->SetXY($startX + $w[0] + $w[1] + $w[2] + $w[3] + $w[4], $yPos);
        $pdf->Cell($w[5], $height, 'Rp. ' . number_format($row['total']), 1, 0, 'L');

        // Pindah ke baris berikutnya
        $pdf->SetY($yPos + $height);
    }

    // Sebelum output PDF, hitung total
    $query_total = mysqli_query($conn, "SELECT 
        SUM(dt.total) as total
        FROM detail_transaksi dt 
        WHERE dt.notrans = '$notrans'");
    $total_data = mysqli_fetch_assoc($query_total);

    // Hitung total
    $total = $total_data['total'];

    // Tampilkan total
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(array_sum($w) - 27, 7, 'GRAND TOTAL', 1, 0, 'C');
    $pdf->Cell(27, 7, 'Rp. ' . number_format($total), 1, 1, 'L');

    // TTD
    $pdf->Ln(18);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(0, 5, 'Serang, ....................... ' . date('Y'), 0, 1, 'R');
    $pdf->Ln(18);
    $pdf->Cell(0, 5, 'Kepala Klinik                         ', 0, 1, 'R');
    // Output PDF
    $pdf->Output('Laporan_Transaksi_' . $notrans . '.pdf', 'I');
}

function hariIndo($tanggal)
{
    $namaHari = date('l', strtotime($tanggal));
    switch ($namaHari) {
        case 'Sunday':
            return 'Minggu';
        case 'Monday':
            return 'Senin';
        case 'Tuesday':
            return 'Selasa';
        case 'Wednesday':
            return 'Rabu';
        case 'Thursday':
            return 'Kamis';
        case 'Friday':
            return 'Jumat';
        case 'Saturday':
            return 'Sabtu';
        default:
            return 'Tidak diketahui';
    }
}
