<div class="col-md-10 main-content">
    <h5 class="mb-4 mt fw-bold">Penggajian Overview</h5>

    <!-- Form Input Tindakan -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Input Penggajian Bulan Ini</h5>

            <!-- Form Input Penggajian Baru -->
            <form action="app/penggajian/input.php" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Cari Karyawan</label>
                        <input list="karyawanList" class="form-control" id="transactionNumber" name="karyawan" placeholder="Masukkan karyawan" onchange="updateHarga()" required>
                        <datalist id="karyawanList">
                            <?php
                            $current_month = date('Y-m');
                            $query_karyawan = mysqli_query($conn, "SELECT k.*, g.nama_golongan, g.gaji_pokok,
                            g.tunjangan_makan, g.overtime, g.tunjangan_pasien, g.ro1, g.ro2, g.ro3, g.non_regio
                            FROM karyawan k 
                            JOIN golongan g ON k.golongan_id = g.id 
                            WHERE g.nama_golongan != 'Dokter'
                            AND k.id NOT IN (
                                SELECT p.karyawan_id FROM penggajian p 
                                WHERE DATE_FORMAT(p.tanggal, '%Y-%m') = '$current_month'
                            )");
                            $karyawan_data = [];
                            while ($row = mysqli_fetch_assoc($query_karyawan)) {
                                echo "<option value='{$row['nama']}' 
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
                <input type="hidden" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>">

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
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Golongan</th>
                            <th scope="col">Gaji Pokok</th>
                            <th scope="col">Asistensi</th>
                            <th scope="col">Total Gaji</th>
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
                                <td><?= $row_penggajian['tanggal'] ?></td>
                                <td><?= $row_penggajian['nama'] ?></td>
                                <td><?= $row_penggajian['nama_golongan'] ?></td>
                                <td>Rp. <?= $row_penggajian['gaji_pokok'] ?></td>
                                <td>Rp. <?= $row_penggajian['asistensi'] ?></td>
                                <td>Rp. <?= $row_penggajian['total'] ?></td>
                                <td>
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