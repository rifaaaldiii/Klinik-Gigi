<?php
$query_tindakan = mysqli_query($conn, "SELECT * FROM tindakan");
?>

<div class="col-md-10 main-content">
    <h5 class="mb-4 mt fw-bold">Tindakan Overview</h5>

    <!-- Form Input Transaksi -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Input Tindakan Baru</h5>
            <form action="app/tindakan/input.php" method="post">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Nama Tindakan</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nama"
                            required
                            placeholder="Masukkan Nama" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="transactionDate" class="form-label fw-bold">Jasa Medis</label>
                        <select name="jasa_medis" id="jasa_medis" class="form-select">
                            <option value="0">Harga X 50%</option>
                            <option value="1">Harga</option>
                            <option value="2">Harga - 20.0000</option>
                            <option value="3">Harga X 65%</option>
                            <option value="4">( Harga - Modal ) X 50%</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="transactionDate" class="form-label fw-bold">Harga Tindakan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="number"
                                class="form-control"
                                name="harga"
                                placeholder="Masukkan Harga Tindakan"
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
            <h5 class="card-title">Recent Tindakan</h5>

            <!-- Input Pencarian -->
            <div class="mb-3">
                <input
                    type="text"
                    id="searchKaryawan"
                    class="form-control"
                    placeholder="Cari Tindakan..." />
            </div>

            <div class="table-scroll">
                <table class="table table-striped" id="karyawanTable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Tindakan</th>
                            <th scope="col">Tipe Jasa Medis</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query_tindakan = mysqli_query($conn, "SELECT * FROM tindakan ORDER BY id DESC");
                        while ($row_tindakan = mysqli_fetch_assoc($query_tindakan)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row_tindakan['nama_tindakan'] ?></td>
                                <td
                                    <?php
                                    switch ($row_tindakan['jm']) {
                                        case 0:
                                            echo 'style="background-color: none;"';
                                            break;
                                        case 1:
                                            echo 'style="background-color: yellow;"';
                                            break;
                                        case 2:
                                            echo 'style="background-color: green;"';
                                            break;
                                        case 3:
                                            echo 'style="background-color: blue;"';
                                            break;
                                        case 4:
                                            echo 'style="background-color: gray;"';
                                            break;
                                    }
                                    ?>>
                                    <?= $row_tindakan['jm'] ?>
                                </td>
                                <td>Rp. <?= $row_tindakan['harga'] ?></td>
                                <td>
                                    <button class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $row_tindakan['id'] ?>">Edit</button>
                                    <a href="app/tindakan/delete.php?id=<?= $row_tindakan['id'] ?>" class="btn btn-danger delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
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
    $query_tindakan = mysqli_query($conn, "SELECT * FROM tindakan ORDER BY id DESC");
    while ($row_tindakan = mysqli_fetch_assoc($query_tindakan)) {
    ?>
        <div
            class="modal fade"
            id="editModal<?= $row_tindakan['id'] ?>"
            data-bs-backdrop="static"
            aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border: 1px solid #000; box-shadow: 4px 4px 0 0 rgba(0, 0, 0, 0.9);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Tindakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="app/tindakan/update.php" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row_tindakan['id'] ?>">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Nama Tindakan</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nama"
                                        required
                                        placeholder="Masukkan Nama"
                                        value="<?= $row_tindakan['nama_tindakan'] ?>" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="transactionDate" class="form-label fw-bold">Jasa Medis</label>
                                    <select name="jasa_medis" id="jasa_medis" class="form-select">
                                        <option value="0" <?= $row_tindakan['jm'] == 0 ? 'selected' : '' ?>>Harga X 50%</option>
                                        <option value="1" <?= $row_tindakan['jm'] == 1 ? 'selected' : '' ?>>Harga</option>
                                        <option value="2" <?= $row_tindakan['jm'] == 2 ? 'selected' : '' ?>>Harga - 20.0000</option>
                                        <option value="3" <?= $row_tindakan['jm'] == 3 ? 'selected' : '' ?>>Harga X 65%</option>
                                        <option value="4" <?= $row_tindakan['jm'] == 4 ? 'selected' : '' ?>>( Harga - Modal ) X 50%</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="transactionDate" class="form-label fw-bold">Harga Tindakan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="harga"
                                            placeholder="Masukkan Harga Tindakan"
                                            min="0"
                                            value="<?= $row_tindakan['harga'] ?>" />
                                    </div>
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