<div class="col-md-10 main-content">
    <h5 class="mb-4 mt fw-bold">Penggajian Overview</h5>

    <!-- Form Input Tindakan -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Input Penggajian</h5>

            <!-- Form Input Penggajian Baru -->
            <form action="app/penggajian/input.php" method="post">

                <div class="row mb-3">
                    <div class="col-md-6 mb3">
                        <label class="form-label fw-bold">Pilih Bulan</label>
                        <div class="input-group">
                            <input type="month" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m') ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Cari Karyawan</label>
                        <input list="karyawanList" class="form-control" id="transactionNumber" name="karyawan" placeholder="Masukkan karyawan" onchange="updateHarga()" required>
                        <datalist id="karyawanList">
                            <?php
                            $current_date = date('F Y');
                            $tanggal = date('Y-m-t'); // Mengambil tanggal terakhir bulan ini
                            $query_karyawan = mysqli_query($conn, "SELECT k.*, g.nama_golongan, g.gaji_pokok,
                            g.tunjangan_makan, g.overtime, g.tunjangan_pasien, g.ro1, g.ro2, g.ro3, g.non_regio
                            FROM karyawan k 
                            JOIN golongan g ON k.golongan_id = g.id
                            LEFT JOIN asistens a ON k.id = a.id_karyawan
                            WHERE g.nama_golongan != 'Dokter'
                            AND NOT EXISTS (
                                SELECT 1 FROM penggajian p 
                                WHERE p.karyawan_id = k.id 
                                AND p.tanggal = '$tanggal'
                            )
                            GROUP BY k.id");
                            $karyawan_data = [];
                            while ($row = mysqli_fetch_assoc($query_karyawan)) {
                                echo "<option value='{$row['nama']} ({$row['nama_golongan']})' 
                                data-gaji='{$row['gaji_pokok']}'
                                data-tunjangan_makan='{$row['tunjangan_makan']}'
                                data-overtime='{$row['overtime']}'
                                data-id='{$row['id']}'
                                ></option>";
                                $karyawan_data[$row['nama']] = $row['id'];
                            }
                            ?>
                        </datalist>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Gaji Pokok</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                id="gaji_pokok"
                                required
                                readonly
                                name="gaji_pokok" />
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_karyawan" id="id_karyawan">

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-submit mt-4" name="simpan">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Recent Penggajian</h5>

            <!-- Input Pencarian -->
            <div class="mb-3">
                <input
                    type="text"
                    id="searchKaryawan"
                    class="form-control"
                    placeholder="Cari Karyawan..." />
            </div>

            <div class="table-scroll">
                <table class="table table-striped" id="karyawanTable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Bulan/Tahun</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Golongan</th>
                            <th scope="col">Gaji Pokok</th>
                            <th scope="col">Asistensi</th>
                            <th scope="col">Total Gaji</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query_penggajian = mysqli_query($conn, "SELECT p.*, k.nama, k.golongan_id, g.nama_golongan, g.gaji_pokok
                        FROM penggajian p 
                        JOIN karyawan k ON p.karyawan_id = k.id
                        JOIN golongan g ON k.golongan_id = g.id
                        ORDER BY p.id DESC");
                        while ($row_penggajian = mysqli_fetch_assoc($query_penggajian)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= date('F Y', strtotime($row_penggajian['tanggal'])) ?></td>
                                <td><?= $row_penggajian['nama'] ?></td>
                                <td><?= $row_penggajian['nama_golongan'] ?></td>
                                <td>Rp. <?= $row_penggajian['gaji_pokok'] ?></td>
                                <td>Rp. <?= $row_penggajian['asistensi'] ?></td>
                                <td>Rp. <?= $row_penggajian['total'] ?></td>
                                <td>
                                    <?php
                                    $badge_class = 'bg-warning'; // Default class
                                    if ($row_penggajian['status'] === 'Completed') {
                                        $badge_class = 'bg-success';
                                        $link_page = 'View';
                                    } else {
                                        $link_page = 'Detail_transaksi';
                                    }
                                    ?>
                                    <span class="badge <?php echo $badge_class; ?>"><?php echo $row_penggajian['status']; ?></span>
                                </td>
                                <td>
                                    <?php if ($row_penggajian['status'] === 'Pending' && $row_penggajian['total'] != '0'): ?>
                                        <button class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#transferModal<?= $row_penggajian['id'] ?>">
                                            Transfer
                                        </button>
                                        <?php endif; ?>
                                    <a href="app/penggajian/delete.php?id=<?= $row_penggajian['id'] ?>" class="btn btn-danger delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$query_penggajian = mysqli_query($conn, "SELECT p.*, k.nama, k.no_rek
FROM penggajian p
JOIN karyawan k ON p.karyawan_id = k.id
ORDER BY p.id DESC");
while ($row_penggajian = mysqli_fetch_assoc($query_penggajian)) {
?>
    <div
        class="modal fade"
        id="transferModal<?= $row_penggajian['id'] ?>"
        data-bs-backdrop="static"
        aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border: 1px solid #000; box-shadow: 4px 4px 0 0 rgba(0, 0, 0, 0.9);">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Tindakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="app/penggajian/update.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_penggajian" value="<?= $row_penggajian['id'] ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Karyawan</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nama"
                                    required
                                    placeholder="Masukkan Nama"
                                    value="<?= $row_penggajian['nama'] ?>" />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="transactionDate" class="form-label fw-bold">Total Gaji</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="total"
                                        value="<?= $row_penggajian['total'] ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">No. Rekening</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="no_rek"
                                    value="<?= $row_penggajian['no_rek'] ?>" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p
                                    name="note"
                                    id="note"
                                    class="form-control text-center"
                                    style="border:none; background-color: red; color: #fff;">
                                    Setelah menyelesaikan transfer, Anda tidak dapat MENGHAPUS / MENGUBAH data ini.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mt-2 mb-2" data-bs-dismiss="modal">
                                Kembali
                            </button>
                            <button type="submit" class="btn btn-submit mt-2 mb-2 ms-2" onclick="return confirm('Apakah Anda yakin sudah melakukan transfer?')" name="simpan">
                                Selesai
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>

<script>
    function updateHarga() {
        var karyawanInput = document.getElementById('transactionNumber');
        var gajiPokokInput = document.getElementById('gaji_pokok');
        var id_karyawanInput = document.getElementById('id_karyawan');
        var selectedOption = karyawanInput.list.querySelector(`option[value="${karyawanInput.value}"]`);

        if (selectedOption) {
            var gajiPokok = selectedOption.getAttribute('data-gaji');
            var id_karyawan = selectedOption.getAttribute('data-id');
            gajiPokokInput.value = gajiPokok;
            id_karyawanInput.value = id_karyawan;

        } else {
            gajiPokokInput.value = ''; // Reset if no valid option is selected
            id_karyawanInput.value = '';
        }
    }
</script>