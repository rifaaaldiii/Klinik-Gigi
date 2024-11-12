<?php
$query_karyawan = mysqli_query($conn, "SELECT k.*, g.nama_golongan 
FROM karyawan k 
JOIN golongan g ON k.golongan_id = g.id
WHERE g.nama_golongan = 'Dokter'");

?>

<div class="col-md-10 main-content">
    <h5 class="mb-4 mt fw-bold">Transaksi Overview</h5>

    <!-- Form Input Transaksi -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Input Transaksi Baru</h5>
            <form action="app/transaksi/input.php" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="transactionNumber" class="form-label fw-bold">No. Transaksi</label>
                        <?php
                        // Cari nomor transaksi terakhir
                        $query_last_transaksi = mysqli_query($conn, "SELECT notrans FROM transaksi ORDER BY notrans DESC LIMIT 1");
                        $last_transaksi = mysqli_fetch_assoc($query_last_transaksi);

                        // Tentukan nomor transaksi berikutnya
                        if ($last_transaksi) {
                            $last_number = intval(substr($last_transaksi['notrans'], 2)) + 1;
                            $new_transaksi_number = 'TN' . str_pad($last_number, 3, '0', STR_PAD_LEFT);
                        } else {
                            $new_transaksi_number = 'TN001';
                        }
                        ?>
                        <input
                            type="text"
                            class="form-control"
                            id="transactionNumber"
                            value="<?php echo $new_transaksi_number; ?>"
                            placeholder="Masukkan nomor transaksi"
                            required
                            readonly
                            name="notrans" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="transactionDate" class="form-label fw-bold">Tanggal</label>
                        <input
                            type="date"
                            class="form-control"
                            id="transactionDate"
                            required
                            readonly
                            name="tanggal" />
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var today = new Date().toISOString().split('T')[0];
                            document.getElementById('transactionDate').value = today;
                        });
                    </script>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="dokterName" class="form-label fw-bold">Dokter</label>
                        <select name="dokter" id="dokter" class="form-control" required>
                            <option value="">Pilih Dokter</option>
                            <?php
                            mysqli_data_seek($query_karyawan, 0); // Reset pointer
                            while ($row = mysqli_fetch_assoc($query_karyawan)) {
                                echo "<option value='{$row['id']}'>{$row['nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="clientName" class="form-label fw-bold">Nama Klien</label>
                        <input
                            type="text"
                            class="form-control"
                            id="clientName"
                            placeholder="Masukkan nama klien"
                            required
                            name="nama_klien" />
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

    <!-- Recent Transactions -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Recent Transactions</h5>
            <div class="table-scroll">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">No. Transaksi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Dokter</th>
                            <th scope="col">Nama Klien</th>
                            <th scope="col">Total</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query_transaksi = mysqli_query($conn, "SELECT t.*, k.nama 
                        FROM transaksi t 
                        JOIN karyawan k ON t.dokter = k.id
                        ORDER BY t.id DESC");

                        if (mysqli_num_rows($query_transaksi) > 0) {
                            while ($row = mysqli_fetch_assoc($query_transaksi)) {
                        ?>
                                <tr>
                                    <td scope="row"><?php echo $no++; ?></td>
                                    <td><?php echo $row['notrans']; ?></td>
                                    <td><?php echo $row['tanggal']; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['nama_klien']; ?></td>
                                    <td><?php echo $row['total']; ?></td>
                                    <td><?php echo $row['catatan']; ?></td>
                                    <td>
                                        <?php
                                        $badge_class = 'bg-warning'; // Default class
                                        if ($row['status'] === 'Completed') {
                                            $badge_class = 'bg-success';
                                            $link_page = 'View';
                                        } else {
                                            $link_page = 'Detail_transaksi';
                                        }
                                        ?>
                                        <span class="badge <?php echo $badge_class; ?>"><?php echo $row['status']; ?></span>
                                    </td>

                                    <td>
                                        <a href='index.php?page=<?= $link_page ?>&notrans=<?= $row['notrans'] ?>' class="btn btn-primary edit mb-1">View Detail</a>
                                        <a href='app/transaksi/delete.php?id=<?= $row['id'] ?>' class="btn btn-danger delete mb-1" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada transaksi</td>
                            </tr>
                        <?php } ?>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>