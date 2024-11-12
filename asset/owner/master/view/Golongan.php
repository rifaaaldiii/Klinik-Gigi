<?php
$query_golongan = mysqli_query($conn, "SELECT * FROM golongan");
?>

<div class="col-md-10 main-content">
    <h5 class="mb-4 mt fw-bold">Golongan Overview</h5>

    <!-- Form Input Transaksi -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Input Golongan Baru</h5>
            <form action="app/golongan/input.php" method="post">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Nama Golongan</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nama"
                            required
                            placeholder="Masukkan Nama" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="transactionDate" class="form-label fw-bold">Gaji Pokok</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="number"
                                class="form-control"
                                name="gaji_pokok"
                                placeholder="Masukkan Gaji Pokok"
                                min="0"
                                value="0" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Tunjangan Pasien</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="number"
                                class="form-control"
                                name="tunjangan_pasien"
                                placeholder="Masukkan Tunjangan Pasien"
                                min="0"
                                value="0" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Tunjangan Makan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="number"
                                class="form-control"
                                name="tunjangan_makan"
                                placeholder="Masukkan Tunjangan Makan"
                                min="0"
                                value="0" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Overtime</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="number"
                                class="form-control"
                                name="overtime"
                                placeholder="Masukkan Overtime"
                                min="0"
                                value="0" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Non Regio</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="number"
                                class="form-control"
                                name="non_regio"
                                placeholder="Masukkan Non Regio"
                                min="0"
                                value="0" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Regio 1</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="number"
                                class="form-control"
                                name="ro1"
                                placeholder="Masukkan Regio 1"
                                min="0"
                                value="0" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Regio 2</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="number"
                                class="form-control"
                                name="ro2"
                                placeholder="Masukkan Regio 2"
                                min="0"
                                value="0" />
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Regio 3</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="number"
                                class="form-control"
                                name="ro3"
                                placeholder="Masukkan Regio 3"
                                min="0"
                                value="0" />
                        </div>
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
    <div class="card mt-4" id="recent-golongan">
        <div class="card-body">
            <h5 class="card-title">Recent Golongan</h5>

            <!-- Input Pencarian -->
            <div class="mb-3">
                <input
                    type="text"
                    id="searchKaryawan"
                    class="form-control"
                    placeholder="Cari Golongan..." />
            </div>

            <div class="table-scroll">
                <table class="table table-striped" id="karyawanTable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Golongan</th>
                            <th scope="col">Gaji Pokok</th>
                            <th scope="col">Tunjangan Pasien</th>
                            <th scope="col">Tunjangan Makan</th>
                            <th scope="col">Overtime</th>
                            <th scope="col">Non Regio</th>
                            <th scope="col">Regio 1</th>
                            <th scope="col">Regio 2</th>
                            <th scope="col">Regio 3</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query_golongan = mysqli_query($conn, "SELECT * FROM golongan ORDER BY id DESC");
                        while ($row_golongan = mysqli_fetch_assoc($query_golongan)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row_golongan['nama_golongan'] ?></td>
                                <td><?= $row_golongan['gaji_pokok'] ?></td>
                                <td><?= $row_golongan['tunjangan_pasien'] ?></td>
                                <td><?= $row_golongan['tunjangan_makan'] ?></td>
                                <td><?= $row_golongan['overtime'] ?></td>
                                <td><?= $row_golongan['non_regio'] ?></td>
                                <td><?= $row_golongan['ro1'] ?></td>
                                <td><?= $row_golongan['ro2'] ?></td>
                                <td><?= $row_golongan['ro3'] ?></td>
                                <td>
                                    <button class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $row_golongan['id'] ?>">Edit</button>
                                    <a href="app/golongan/delete.php?id=<?= $row_golongan['id'] ?>" class="btn btn-danger delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
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
    $query_golongan = mysqli_query($conn, "SELECT * FROM golongan ORDER BY id DESC");
    while ($row_golongan = mysqli_fetch_assoc($query_golongan)) {
    ?>
        <div
            class="modal fade"
            id="editModal<?= $row_golongan['id'] ?>"
            data-bs-backdrop="static"
            aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border: 1px solid #000; box-shadow: 4px 4px 0 0 rgba(0, 0, 0, 0.9);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Golongan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="app/golongan/update.php" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row_golongan['id'] ?>">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Nama</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nama"
                                        id="nama"
                                        value="<?= $row_golongan['nama_golongan'] ?>"
                                        placeholder="Masukkan nama"
                                        required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="transactionDate" class="form-label fw-bold">Gaji Pokok</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="gaji_pokok"
                                        id="gaji_pokok"
                                        value="<?= $row_golongan['gaji_pokok'] ?>"
                                        placeholder="Masukkan Gaji Pokok" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Tunjangan Pasien</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="tunjangan_pasien"
                                        id="tunjangan_pasien"
                                        value="<?= $row_golongan['tunjangan_pasien'] ?>"
                                        placeholder="Masukkan Tunjangan Pasien" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Tunjangan Makan</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="tunjangan_makan"
                                        id="tunjangan_makan"
                                        value="<?= $row_golongan['tunjangan_makan'] ?>"
                                        placeholder="Masukkan Tunjangan Makan" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Overtime</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="overtime"
                                        id="overtime"
                                        value="<?= $row_golongan['overtime'] ?>" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Non Regio</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="non_regio"
                                        id="non_regio"
                                        value="<?= $row_golongan['non_regio'] ?>"
                                        placeholder="Masukkan Non Regio" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Regio 1</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="ro1"
                                        id="ro1"
                                        value="<?= $row_golongan['ro1'] ?>"
                                        placeholder="Masukkan Regio 1" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Regio 2</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="ro2"
                                        id="ro2"
                                        value="<?= $row_golongan['ro2'] ?>"
                                        placeholder="Masukkan Regio 2" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Regio 3</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="ro3"
                                        id="ro3"
                                        value="<?= $row_golongan['ro3'] ?>"
                                        placeholder="Masukkan Regio 3" />
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