<div class="col-md-10 main-content">
    <h5 class="mb-4 fw-bold">Laporan Transaksi</h5>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Filter Laporan</h5>
            <form action="pdf/rekap_transaksi.php" method="get">
                <div class="header__title text-sm mb-4" style="flex:1;">
                    <div class="d-flex justify-content-end mb-4 mt-0" style="gap: 1rem;">
                        <div class="input-group" style="width: 200px;">
                            <input style="border-radius: 12px;" type="month" name="bulan" id="tanggalFilterTransaksi" class="form-control" placeholder="Bulan & Tahun">
                        </div>
                        <button type="submit" class="btn btn-success" style="border: 1px solid #000;">
                            <i class="fa fa-file-pdf"></i> Download PDF
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Recent Transaksi -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Table Transaksi</h5>

            <!-- Input Pencarian -->
            <div class="mb-3">
                <input
                    type="text"
                    id="searchKaryawan"
                    class="form-control"
                    placeholder="Cari Data Transaksi..." />
            </div>

            <div class="table-scroll">
                <table class="table table-striped" id="karyawanTable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">No. Transaksi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Dokter</th>
                            <th scope="col">Nama Klien</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT t.*, k.nama
                        FROM transaksi t 
                        JOIN karyawan k ON t.dokter = k.id 
                        WHERE t.status = 'Completed'");
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $data['notrans'] ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['nama_klien'] ?></td>
                                <td>Rp. <?= $data['total'] ?></td>
                                <td>
                                    <a href="pdf/transaksi.php?notrans=<?= $data['notrans'] ?>" class="btn btn-success" target="_blank" style="border: 1px solid #000;">
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