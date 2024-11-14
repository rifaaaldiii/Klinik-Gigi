<div class="col-md-10 main-content">
    <h5 class="mb-4 fw-bold">Laporan Jasa Medis</h5>

    <!-- Recent Transaksi -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Table Jasa Medis</h5>

            <!-- Input Pencarian -->
            <div class="mb-3">
                <input
                    type="text"
                    id="searchKaryawan"
                    class="form-control"
                    placeholder="Cari Data Jasa Medis..." />
            </div>

            <div class="table-scroll">
                <table class="table table-striped" id="karyawanTable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Dokter</th>
                            <th scope="col">Harga Tindakan</th>
                            <th scope="col">Jasa Medis</th>
                            <th scope="col">Diskon JM</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT dt.notrans, t.tanggal, k.nama, t.dokter,
                            SUM(dt.jm) as total_jm, 
                            SUM(dt.diskon_jm) as total_diskon_jm,
                            SUM(dt.harga) as total_harga
                        FROM detail_transaksi dt
                        JOIN transaksi t ON dt.notrans = t.notrans
                        JOIN karyawan k ON t.dokter = k.id
                        GROUP BY t.dokter, t.tanggal
                        ORDER BY t.tanggal DESC");
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td>Rp. <?= $data['total_harga'] ?></td>
                                <td>Rp. <?= $data['total_jm'] ?></td>
                                <td>Rp. <?= $data['total_diskon_jm'] ?></td>
                                <td>
                                    <a href="pdf/jasamedis.php?dokter=<?= $data['dokter'] ?>&bulan=<?= date('Y-m', strtotime($data['tanggal']))  ?>" class="btn btn-success" target="_blank" style="border: 1px solid #000;">
                                        <i class="fa-solid fa-print"></i> Print
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>