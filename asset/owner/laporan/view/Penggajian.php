<div class="col-md-10 main-content">
    <h5 class="mb-4 fw-bold">Laporan Penggajian</h5>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Filter Laporan</h5>
            <form action="pdf/rekap_penggajian.php" method="get">
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
            <h5 class="card-title">Table Penggajian</h5>

            <!-- Input Pencarian -->
            <div class="mb-3">
                <input
                    type="text"
                    id="searchKaryawan"
                    class="form-control"
                    placeholder="Cari Data Penggajian..." />
            </div>

            <div class="table-scroll">
                <table class="table table-striped" id="karyawanTable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Gaji Pokok</th>
                            <th scope="col">Asistens</th>
                            <th scope="col">Toltal Gaji</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT p.*, k.nama, g.gaji_pokok
                        FROM penggajian p 
                        JOIN karyawan k ON p.karyawan_id = k.id
                        JOIN golongan g ON k.golongan_id = g.id");
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td>Rp. <?= $data['gaji_pokok'] ?></td>
                                <td>Rp. <?= $data['asistensi'] ?></td>
                                <td>Rp. <?= $data['total'] ?></td>
                                <td>
                                    <a href="pdf/penggajian.php?id=<?= $data['id'] ?>" class="btn btn-success" target="_blank" style="border: 1px solid #000;">
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