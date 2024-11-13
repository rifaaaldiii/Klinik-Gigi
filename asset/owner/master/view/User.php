<?php
$query_user = mysqli_query($conn, "SELECT * FROM user");
?>

<div class="col-md-10 main-content">
    <h5 class="mb-4 mt fw-bold">User Overview</h5>

    <!-- Form Input Transaksi -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Input User Baru</h5>
            <form action="app/user/input.php" method="post">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            name="username"
                            required
                            placeholder="Masukkan Username" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="transactionDate" class="form-label fw-bold">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            required
                            placeholder="Masukkan Email" />
                        </select>
                    </div>



                    <div class="col-md-4 mb-3">
                        <label for="transactionDate" class="form-label fw-bold">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="" selected disabled>Pilih Role</option>
                            <option value="owner">Owner</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="transactionDate" class="form-label fw-bold">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            name="pass"
                            required
                            placeholder="Masukkan Password" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="transactionDate" class="form-label fw-bold">Confirm Password</label>
                        <input
                            type="password"
                            class="form-control"
                            name="pass2"
                            required
                            placeholder="Masukkan Confirm Password" />
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

    <!-- Recent User -->
    <div class="card mt-4" id="recent-user">
        <div class="card-body">
            <h5 class="card-title">Recent User</h5>

            <!-- Input Pencarian -->
            <div class="mb-3">
                <input
                    type="text"
                    id="searchKaryawan"
                    class="form-control"
                    placeholder="Cari User..." />
            </div>

            <div class="table-scroll">
                <table class="table table-striped" id="karyawanTable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query_user = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
                        while ($row_user = mysqli_fetch_assoc($query_user)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $row_user['username'] ?></td>
                                <td><?= $row_user['email'] ?></td>
                                <td><?= $row_user['role'] ?></td>
                                <td>
                                    <button class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $row_user['id'] ?>">Edit</button>
                                    <a href="app/user/delete.php?id=<?= $row_user['id'] ?>" class="btn btn-danger delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
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
    $query_user = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
    while ($row_user = mysqli_fetch_assoc($query_user)) {
    ?>
        <div
            class="modal fade"
            id="editModal<?= $row_user['id'] ?>"
            data-bs-backdrop="static"
            aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border: 1px solid #000; box-shadow: 4px 4px 0 0 rgba(0, 0, 0, 0.9);">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="app/user/update.php" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row_user['id'] ?>">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Username</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="username"
                                        required
                                        placeholder="Masukkan Username"
                                        value="<?= $row_user['username'] ?>" />
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="transactionDate" class="form-label fw-bold">Email</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        name="email"
                                        required
                                        placeholder="Masukkan Email"
                                        value="<?= $row_user['email'] ?>" />
                                    </select>
                                </div>



                                <div class="col-md-4 mb-3">
                                    <label for="transactionDate" class="form-label fw-bold">Role</label>
                                    <select name="role" id="role" class="form-select" required>
                                        <option value="" selected disabled>Pilih Role</option>
                                        <option value="owner" <?= $row_user['role'] == 'owner' ? 'selected' : '' ?>>Owner</option>
                                        <option value="admin" <?= $row_user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="transactionDate" class="form-label fw-bold">Password</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="pass"
                                        required
                                        placeholder="Masukkan Password"
                                        value="<?= $row_user['password'] ?>" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="transactionDate" class="form-label fw-bold">Confirm Password</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        name="pass2"
                                        required
                                        placeholder="Masukkan Confirm Password"
                                        value="<?= $row_user['password'] ?>" />
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