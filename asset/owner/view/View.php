<div class="col-md-10 main-content">
    <h5 class="mb-4 mt fw-bold">Detail Transaksi</h5>

    <!-- Form Input Tindakan -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Detail Tindakan</h5>

            <!-- Form Input Tindakan -->
            <?php
            $notrans = $_GET['notrans'];
            $query_transaksi = mysqli_query($conn, "SELECT t.*, k.nama 
            FROM transaksi t
            JOIN karyawan k ON t.dokter = k.id
            WHERE notrans = '$notrans'");
            $row_transaksi = mysqli_fetch_assoc($query_transaksi);
            ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="transactionNumber" class="form-label fw-bold">No. Transaksi</label>
                    <input
                        type="text"
                        class="form-control"
                        id="transactionNumber"
                        value="<?php echo $row_transaksi['notrans']; ?>"
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
                        value="<?php echo $row_transaksi['tanggal']; ?>"
                        name="tanggal" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dokterName" class="form-label fw-bold">Dokter</label>
                    <input
                        type="text"
                        class="form-control"
                        value="<?php echo $row_transaksi['nama']; ?>"
                        readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="clientName" class="form-label fw-bold">Nama Klien</label>
                    <input
                        type="text"
                        class="form-control"
                        value="<?php echo $row_transaksi['nama_klien']; ?>"
                        readonly>
                </div>
            </div>

            <!-- Daftar Tindakan -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Daftar Tindakan</h5>
                    <div class="table-scroll">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Tindakan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jasa Medis</th>
                                    <th scope="col">Modal</th>
                                    <th scope="col">Diskon</th>
                                    <th scope="col">DP</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $notrans = $_GET['notrans'];
                                $query_detail = mysqli_query($conn, "SELECT *
                        FROM detail_transaksi
                        WHERE notrans = '$notrans'
                        ORDER BY id DESC");

                                if (mysqli_num_rows($query_detail) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_detail)) {
                                ?>
                                        <tr>
                                            <td scope="row"><?php echo $no++; ?></td>
                                            <td><?php echo $row['tindakan']; ?></td>
                                            <td>Rp. <?php echo $row['harga']; ?></td>
                                            <td><?php echo $row['jm']; ?></td>
                                            <td>Rp. <?php echo $row['modal']; ?></td>
                                            <td><?php echo $row['diskon']; ?>%</td>
                                            <td>Rp. <?php echo $row['dp']; ?></td>
                                            <td><?php echo $row['catatan']; ?></td>
                                            <td>Rp. <?php echo $row['total']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="11" class="text-center">Tidak ada tindakan</td>
                                    </tr>
                                <?php } ?>
                                <!-- More rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Daftar Asistens -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Daftar Asistens</h5>
                    <div class="table-scroll">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Asistens</th>
                                    <th scope="col">Tipe Regio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $notrans = $_GET['notrans'];
                                $query_asistens = mysqli_query($conn, "SELECT a.*, k.nama
                                    FROM asistens a
                                    JOIN karyawan k ON a.id_karyawan = k.id
                                    WHERE notrans = '$notrans'
                                    ORDER BY id DESC");

                                if (mysqli_num_rows($query_asistens) > 0) {
                                    while ($row_asistens = mysqli_fetch_assoc($query_asistens)) {
                                        // Determine the type of regio
                                        $tipe_regio = '';
                                        if ($row_asistens['ro1'] == 1) {
                                            $tipe_regio = 'Regio 1';
                                        } elseif ($row_asistens['ro2'] == 1) {
                                            $tipe_regio = 'Regio 2';
                                        } elseif ($row_asistens['ro3'] == 1) {
                                            $tipe_regio = 'Regio 3';
                                        } elseif ($row_asistens['non_regio'] == 1) {
                                            $tipe_regio = 'Non Regio';
                                        }
                                ?>
                                        <tr>
                                            <td scope="row"><?php echo $no++; ?></td>
                                            <td><?php echo $row_asistens['nama']; ?></td>
                                            <td><?php echo $tipe_regio; ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada tindakan</td>
                                    </tr>
                                <?php } ?>
                                <!-- More rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Metode Pembayaran</h5>

            <div class="row">
                <?php
                $notrans = $_GET['notrans'];
                $query_detail_transaksi = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE notrans = '$notrans'");
                $row_detail_transaksi = mysqli_fetch_assoc($query_detail_transaksi);
                ?>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Metode Pembayaran</label>
                    <input
                        type="text"
                        name="cash"
                        class="form-control"
                        placeholder="Masukkan cash"
                        min="0"
                        value="<?php echo $row_detail_transaksi['metode']; ?>"
                        readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Grand Total</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <?php
                        $grand_total = 0;
                        $notrans = $_GET['notrans'];
                        $result = mysqli_query($conn, "SELECT SUM(total) as grand_total 
                            FROM detail_transaksi 
                            WHERE notrans = '$notrans'");
                        $grand_total = mysqli_fetch_assoc($result);
                        if ($grand_total) {
                            $grand_total = $grand_total['grand_total'];
                        ?>
                            <input type="number" name="g_total" class="form-control" placeholder="Grand Total" readonly value="<?php echo $grand_total; ?>">
                        <?php } ?>
                    </div>
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Catatan</label>
                    <textarea
                        name="catatan"
                        class="form-control"
                        placeholder="Masukkan catatan"
                        readonly><?php echo $row_transaksi['catatan']; ?></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="index.php?page=Transaksi" class="btn btn-primary mt-4">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>