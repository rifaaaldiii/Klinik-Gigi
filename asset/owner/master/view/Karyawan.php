<?php
$query_karyawan = mysqli_query($conn, "SELECT k.*, g.nama_golongan 
FROM karyawan k 
JOIN golongan g ON k.golongan_id = g.id
WHERE g.nama_golongan = 'Dokter'");

?>

<div class="col-md-10 main-content">
    <h5 class="mb-4 mt fw-bold">Karyawan Overview</h5>

    <!-- Form Input Transaksi -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Input Karyawan Baru</h5>
            <form action="app/karyawan/input.php" method="post">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nama"
                            required
                            placeholder="Masukkan Nama" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="transactionDate" class="form-label fw-bold">NIP</label>
                        <input
                            type="number"
                            class="form-control"
                            required
                            name="nip"
                            placeholder="Masukkan NIP" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">NIK</label>
                        <input
                            type="number"
                            class="form-control"
                            required
                            name="nik"
                            placeholder="Masukkan NIK" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Tanggal Lahir</label>
                        <input
                            type="date"
                            class="form-control"
                            required
                            name="tanggal_lahir"
                            placeholder="Masukkan Tanggal Lahir" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">No. Telp</label>
                        <input
                            type="number"
                            class="form-control"
                            required
                            name="no_telp"
                            placeholder="Masukkan No. Telp" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">No. Rekening</label>
                        <input
                            type="text"
                            class="form-control"
                            required
                            name="no_rekening"
                            placeholder="Masukkan No. Rekening" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Agama</label>
                        <select name="agama" id="agama" class="form-control" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Golongan</label>
                        <select name="golongan" id="golongan" class="form-control" required>
                            <option value="">Pilih Golongan</option>
                            <?php
                            $query_golongan = mysqli_query($conn, "SELECT * FROM golongan
                            WHERE nama_golongan != 'Dokter'");
                            while ($row = mysqli_fetch_assoc($query_golongan)) {
                                echo "<option value='{$row['id']}'>{$row['nama_golongan']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <textarea
                            name="alamat"
                            id="alamat"
                            class="form-control"
                            required
                            placeholder="Masukkan Alamat"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-submit mt-4" name="simpan">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Recent Karyawan -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Recent Karyawan</h5>

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
                            <th scope="col">Nama</th>
                            <th scope="col">NIP</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">No. Telpon</th>
                            <th scope="col">No. Rekening</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Golongan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query_karyawan = mysqli_query($conn, "SELECT k.*, g.nama_golongan 
                        FROM karyawan k 
                        JOIN golongan g ON k.golongan_id = g.id
                        WHERE g.nama_golongan != 'Dokter'
                        ORDER BY k.id DESC");
                        while ($row_karyawan = mysqli_fetch_assoc($query_karyawan)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row_karyawan['nama'] ?></td>
                                <td><?= $row_karyawan['nip'] ?></td>
                                <td><?= $row_karyawan['nik'] ?></td>
                                <td><?= $row_karyawan['jenis_kelamin'] ?></td>
                                <td><?= $row_karyawan['tanggal_lahir'] ?></td>
                                <td><?= $row_karyawan['telpon'] ?></td>
                                <td><?= $row_karyawan['no_rek'] ?></td>
                                <td><?= $row_karyawan['agama'] ?></td>
                                <td><?= $row_karyawan['nama_golongan'] ?></td>
                                <td><?= $row_karyawan['alamat'] ?></td>
                                <td>
                                    <button class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $row_karyawan['id'] ?>">Edit</button>
                                    <a href="app/karyawan/delete.php?id=<?= $row_karyawan['id'] ?>" class="btn btn-danger delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
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

    <?php
    $query_karyawan = mysqli_query($conn, "SELECT k.*, g.nama_golongan 
    FROM karyawan k 
    JOIN golongan g ON k.golongan_id = g.id
    WHERE g.nama_golongan != 'Dokter'
    ORDER BY k.id DESC");
    while ($row_karyawan = mysqli_fetch_assoc($query_karyawan)) {
    ?>
        <div
            class="modal fade"
            id="editModal<?= $row_karyawan['id'] ?>"
            data-bs-backdrop="static"
            aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border: 1px solid #000; box-shadow: 4px 4px 0 0 rgba(0, 0, 0, 0.9);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="app/karyawan/update.php" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row_karyawan['id'] ?>">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Nama</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nama"
                                        id="nama"
                                        value="<?= $row_karyawan['nama'] ?>"
                                        placeholder="Masukkan nama"
                                        required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="transactionDate" class="form-label fw-bold">NIP</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        required
                                        name="nip"
                                        id="nip"
                                        value="<?= $row_karyawan['nip'] ?>"
                                        placeholder="Masukkan NIP" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">NIK</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        required
                                        name="nik"
                                        id="nik"
                                        value="<?= $row_karyawan['nik'] ?>"
                                        placeholder="Masukkan NIK" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Jenis Kelamin</label>

                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <option value="<?= $row_karyawan['jenis_kelamin'] ?>"><?= $row_karyawan['jenis_kelamin'] ?></option>
                                        <?php if ($row_karyawan['jenis_kelamin'] != 'Laki-laki'): ?>
                                            <option value="Laki-laki">Laki-laki</option>
                                        <?php endif; ?>
                                        <?php if ($row_karyawan['jenis_kelamin'] != 'Perempuan'): ?>
                                            <option value="Perempuan">Perempuan</option>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Tanggal Lahir</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        required
                                        name="tanggal_lahir"
                                        id="tanggal_lahir"
                                        value="<?= $row_karyawan['tanggal_lahir'] ?>" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">No. Telp</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        required
                                        name="no_telp"
                                        id="no_telp"
                                        value="<?= $row_karyawan['telpon'] ?>"
                                        placeholder="Masukkan No. Telp" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">No. Rekening</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        required
                                        name="no_rekening"
                                        id="no_rekening"
                                        value="<?= $row_karyawan['no_rek'] ?>"
                                        placeholder="Masukkan No. Rekening" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Agama</label>
                                    <select name="agama" id="agama" class="form-control" required>
                                        <option value="<?= $row_karyawan['agama'] ?>"><?= $row_karyawan['agama'] ?></option>
                                        <?php if ($row_karyawan['agama'] != 'Islam'): ?>
                                            <option value="Islam">Islam</option>
                                        <?php endif; ?>
                                        <?php if ($row_karyawan['agama'] != 'Kristen'): ?>
                                            <option value="Kristen">Kristen</option>
                                        <?php endif; ?>
                                        <?php if ($row_karyawan['agama'] != 'Budha'): ?>
                                            <option value="Budha">Budha</option>
                                        <?php endif; ?>
                                        <?php if ($row_karyawan['agama'] != 'Katolik'): ?>
                                            <option value="Katolik">Katolik</option>
                                        <?php endif; ?>
                                        <?php if ($row_karyawan['agama'] != 'Hindu'): ?>
                                            <option value="Hindu">Hindu</option>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Golongan</label>
                                    <select name="golongan" id="golongan" class="form-control" required>
                                        <option value="<?= $row_karyawan['golongan_id'] ?>"><?= $row_karyawan['nama_golongan'] ?></option>
                                        <?php
                                        $query_golongan = mysqli_query($conn, "SELECT * FROM golongan
                                        WHERE nama_golongan != 'Dokter'");
                                        while ($row = mysqli_fetch_assoc($query_golongan)) {
                                            echo "<option value='{$row['id']}'>{$row['nama_golongan']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Alamat</label>
                                    <textarea
                                        name="alamat"
                                        id="alamat"
                                        class="form-control"
                                        required
                                        placeholder="Masukkan Alamat"><?= $row_karyawan['alamat'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary mt-2 mb-2" data-bs-dismiss="modal">
                                    Kembali
                                </button>
                                <button type="submit" class="btn btn-submit mt-2 mb-2 ms-2" name="simpan">
                                    Simpan
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
</div>