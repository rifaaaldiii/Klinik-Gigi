<div class="col-md-10 main-content">
    <h5 class="mb-4 mt fw-bold">Detail Transaksi</h5>

    <!-- Form Input Tindakan -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Input Tindakan</h5>

            <!-- Form Input Tindakan -->
            <form action="app/transaksi/input_detail.php" method="post">
                <div class="row">
                    <input type="hidden" name="notrans" id="notrans" value="<?php echo $_GET['notrans']; ?>">
                    <input type="hidden" name="nama_tindakan" id="nama_tindakan">
                    <input type="hidden" name="jm" id="jm">
                    <input type="hidden" name="sisa_dp" id="sisa_dp" oninput="updateJumlahTotal()">
                    <input type="hidden" name="sisa_jm" id="sisa_jm" oninput="updateJumlahTotal()">

                    <div class="col-md-6 mb-3">
                        <label for="transactionNumber" class="form-label fw-bold">Cari Tindakan</label>
                        <input list="tindakanList" class="form-control" id="transactionNumber" name="tindakan" placeholder="Masukkan tindakan" onchange="updateHarga()" required>
                        <datalist id="tindakanList">
                            <?php
                            $query_tindakan = mysqli_query($conn, "SELECT * FROM tindakan");
                            $tindakan_data = [];
                            while ($row = mysqli_fetch_assoc($query_tindakan)) {
                                echo "<option value='{$row['nama_tindakan']}' type-jm='{$row['jm']}'>";
                                $tindakan_data[$row['nama_tindakan']] = $row['harga'];
                            }
                            ?>
                        </datalist>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="transactionDate" class="form-label fw-bold">Harga Tindakan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                id="harga_tindakan"
                                required
                                readonly
                                name="harga_tindakan" />
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <label for="dokterName" class="form-label fw-bold">Input Harga Tambahan / Range</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                min="0"
                                class="form-control"
                                id="harga_manual"
                                name="harga_manual"
                                placeholder="Masukkan harga manual"
                                onchange="updateJumlahTotal()">
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="clientName" class="form-label fw-bold">Banyak Tindakan</label>
                        <input
                            type="number"
                            class="form-control"
                            id="banyak_tindakan"
                            placeholder="Masukkan banyak tindakan"
                            required
                            min="0"
                            name="banyak_tindakan"
                            onchange="updateJumlahTotal()" />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="clientName" class="form-label fw-bold">Jumlah Total Tindakan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                id="jumlah_total"
                                placeholder="Jumlah total tindakan"
                                required
                                name="jumlah_total"
                                readonly />
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Modal</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                min="0"
                                class="form-control"
                                id="modal"
                                name="modal"
                                placeholder="Masukkan modal"
                                onchange="updateJumlahTotal()">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Total Jasa Medis</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                id="total_jasa_medis"
                                name="total_jasa_medis"
                                placeholder="Masukkan total jasa medis"
                                readonly
                                onchange="updateJumlahTotal()">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Diskon LYT</label>
                        <div class="input-group">
                            <input
                                type="number"
                                min="0"
                                class="form-control"
                                id="diskon_lyt"
                                name="diskon_lyt"
                                placeholder="Masukkan diskon LYT"
                                onchange="updateJumlahTotal()">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Diskon JM</label>
                        <div class="input-group">
                            <input
                                type="number"
                                min="0"
                                class="form-control"
                                id="diskon_jm"
                                name="diskon_jm"
                                placeholder="Masukkan diskon JM"
                                onchange="updateJumlahTotal()">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">DP</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                min="0"
                                class="form-control"
                                id="dp"
                                name="dp"
                                placeholder="Masukkan dp"
                                onchange="updateJumlahTotal()">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-8 mb-2">
                        <label class="form-label fw-bold">Catatan</label>
                        <input
                            type="text"
                            class="form-control"
                            id="catatan"
                            name="catatan"
                            placeholder="Masukkan catatan">
                    </div>

                    <div class="col-md-4 mb-2">
                        <label class="form-label fw-bold">Grand Total</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                class="form-control"
                                id="grand_total"
                                name="grand_total"
                                placeholder="Grand Total"
                                readonly>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-submit mt-4" name="simpan">
                        Simpan
                    </button>
                </div>
            </form>

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
                                    <th scope="col">Action</th>
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
                                            <td>
                                                <a href='app/transaksi/delete_detail.php?id=<?= $row['id'] ?>' class="btn btn-danger delete mb-1" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                                            </td>
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
        </div>
    </div>

    <!-- Form Input Asistens -->
    <div class="card mt-4" id="input_asistens">
        <div class="card-body">
            <h5 class="card-title mb-4">Input Asistens</h5>
            <form action="app/transaksi/input_asistens.php" method="post">
                <div class="row">
                    <input type="hidden" name="notrans" id="notrans" value="<?php echo $_GET['notrans']; ?>">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Pilih Asistens</label>
                        <input list="asistensList" name="asistens" class="form-control" placeholder="Pilih Asistens" onchange="updateAsistensId()" required>
                        <input type="hidden" name="asistens_id" id="asistens_id">
                        <datalist id="asistensList">
                            <?php
                            $query_asistens = mysqli_query($conn, "SELECT k.*, g.nama_golongan
                            FROM karyawan k
                            JOIN golongan g ON k.golongan_id = g.id
                            WHERE g.nama_golongan != 'Dokter'");

                            if ($query_asistens) {
                                while ($row_asistens = mysqli_fetch_assoc($query_asistens)) {
                                    echo "<option value='{$row_asistens['nama']}' data-id='{$row_asistens['id']}'>";
                                }
                            } else {
                                echo "<option value=''>Tidak ada data asistens</option>";
                            }
                            ?>
                        </datalist>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tipe Regio</label>
                        <select name="tipe_regio" class="form-select" required>
                            <option value="">Pilih Tipe Regio</option>
                            <option value="1">Non Regio</option>
                            <option value="2">Regio 1</option>
                            <option value="3">Regio 2</option>
                            <option value="4">Regio 3</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-submit mt-4" name="simpan">
                        Simpan
                    </button>
                </div>
            </form>

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
                                    <th scope="col">Action</th>
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
                                            <td>
                                                <a href='app/transaksi/delete_asistens.php?id=<?= $row_asistens['id'] ?>' class="btn btn-danger delete mb-1" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                                            </td>
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
            <form action="app/transaksi/input_transaksi.php" method="post">
                <div class="row">
                    <input type="hidden" name="notrans" id="notrans" value="<?php echo $_GET['notrans']; ?>">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Cash</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" name="cash" class="form-control" placeholder="Masukkan cash" min="0" value="0">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Transfer</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" name="transfer" class="form-control" placeholder="Masukkan transfer" min="0" value="0">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Catatan</label>
                        <textarea name="catatan" class="form-control" placeholder="Masukkan catatan"></textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 mb-3">
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

                <div class="d-flex justify-content-end">

                    <a href="index.php?page=Transaksi" class="btn btn-primary mt-4">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-submit mt-4 ms-2" name="simpan">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const tindakanData = <?php echo json_encode($tindakan_data); ?>;

    function updateHarga() {
        const tindakanInput = document.getElementById('transactionNumber');
        const tindakan = tindakanInput.value;
        const harga = tindakanData[tindakan] || '';

        // Cari elemen <option> yang sesuai dengan tindakan yang dipilih
        const option = Array.from(tindakanInput.list.options).find(opt => opt.value === tindakan);
        const jm = option ? option.getAttribute('type-jm') : '';

        document.getElementById('harga_tindakan').value = harga;
        document.getElementById('nama_tindakan').value = tindakan;
        document.getElementById('jm').value = jm;
        document.getElementById('total_jasa_medis').value = 0;
        document.getElementById('grand_total').value = 0;
        document.getElementById('jumlah_total').value = 0;
        document.getElementById('catatan').value = '';
        document.getElementById('dp').value = 0;
        document.getElementById('modal').value = 0;
        document.getElementById('diskon_lyt').value = 0;
        document.getElementById('diskon_jm').value = 0;
        document.getElementById('harga_manual').value = 0;
        document.getElementById('banyak_tindakan').value = 0;


        if (harga === 0 || harga === '0') {
            alert('Masukkan harga secara manual');
            document.getElementById('harga_manual').focus();
        }
        updateJumlahTotal();
        updateGrandTotal();
    }


    document.getElementById('harga_manual').addEventListener('input', updateJumlahTotal);
    document.getElementById('banyak_tindakan').addEventListener('input', updateJumlahTotal);
    document.getElementById('dp').addEventListener('input', updateJumlahTotal);
    document.getElementById('diskon_lyt').addEventListener('input', updateJumlahTotal);
    document.getElementById('diskon_jm').addEventListener('input', updateJumlahTotal);
    document.getElementById('modal').addEventListener('input', updateJumlahTotal);



    function updateJumlahTotal() {
        const hargaManual = parseFloat(document.getElementById('harga_manual').value) || 0;
        const banyakTindakan = parseInt(document.getElementById('banyak_tindakan').value) || 0;
        const hargaTindakan = parseFloat(document.getElementById('harga_tindakan').value) || 0;
        const dp = parseFloat(document.getElementById('dp').value) || 0;
        const diskonLyt = parseFloat(document.getElementById('diskon_lyt').value) || 0;
        const modal = parseFloat(document.getElementById('modal').value) || 0;
        const jasaMedis = parseFloat(document.getElementById('jm').value) || 0;
        const sisaDp = parseFloat(document.getElementById('sisa_dp').value) || 0;
        const sisaJm = parseFloat(document.getElementById('sisa_jm').value) || 0;

        const jumlahTotal = hargaManual * banyakTindakan;
        const grandTotal = hargaTindakan + jumlahTotal;
        const diskonAmount = (diskonLyt / 100) * grandTotal;
        const totalAfterDiscount = grandTotal - diskonAmount;
        const totalDP = dp > 0 ? dp : totalAfterDiscount;
        document.getElementById('jumlah_total').value = jumlahTotal;
        document.getElementById('grand_total').value = totalDP;

        if (dp > 0) {
            document.getElementById('catatan').value = 'Sisa Pembayaran Tindakan Rp. ' + (totalAfterDiscount - dp);
        } else {
            document.getElementById('catatan').value = '';
        }

        let totalJasaMedis;
        const effectiveTotal = dp > 0 ? dp : grandTotal; // Use grandTotal before discount for jasa medis

        if (jasaMedis == 0) {
            totalJasaMedis = effectiveTotal * 0.5;
        } else if (jasaMedis == 1) {
            totalJasaMedis = effectiveTotal;
        } else if (jasaMedis == 2) {
            totalJasaMedis = 20000 * (1 + banyakTindakan);
        } else if (jasaMedis == 3) {
            totalJasaMedis = effectiveTotal * 0.65;
        } else if (jasaMedis == 4) {
            totalJasaMedis = (effectiveTotal - modal) * 0.5;
        }

        document.getElementById('total_jasa_medis').value = totalJasaMedis;
        const grandTotalValue = parseFloat(document.getElementById('grand_total').value) || 0;
        const diskonJm = parseFloat(document.getElementById('diskon_jm').value) || 0;

        // Perhitungan diskon JM
        const diskonJmAmount = ((diskonJm / 100) * 2) * totalJasaMedis;
        const totalJasaMedisAfterDiskon = Math.round(totalJasaMedis - diskonJmAmount);
        document.getElementById('total_jasa_medis').value = totalJasaMedisAfterDiskon;

        // Perhitungan grand total setelah diskon JM
        const grandTotalAfterDiskonJm = grandTotalValue - diskonJmAmount;
        document.getElementById('grand_total').value = grandTotalAfterDiskonJm;

    }

    function updateAsistensId() {
        const asistensInput = document.querySelector('input[name="asistens"]');
        const selectedOption = Array.from(asistensInput.list.options).find(option => option.value === asistensInput.value);
        const asistensId = selectedOption ? selectedOption.getAttribute('data-id') : '';
        document.getElementById('asistens_id').value = asistensId;
    }
</script>