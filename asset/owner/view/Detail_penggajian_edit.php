<div class="col-md-10 main-content">
    <h5 class="mb-4 mt fw-bold">Detail Penggajian</h5>

    <!-- Form Input Tindakan -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Input Bonus</h5>

            <?php
            $id_karyawan = isset($_GET['id_karyawan']) ? $_GET['id_karyawan'] : '';
            $query_karyawan = mysqli_query($conn, "SELECT k.*, 
            g.gaji_pokok, g.overtime, g.tunjangan_makan, g.tunjangan_pasien, g.ro1, g.ro2, g.ro3, g.non_regio 
            FROM karyawan k 
            JOIN golongan g ON k.golongan_id = g.id 
            WHERE k.id = '$id_karyawan'");
            $karyawan_data = mysqli_fetch_assoc($query_karyawan);
            ?>

            <!-- Form Input Tindakan -->
            <form action="app/penggajian/input_bonus.php" method="post">
                <input type="hidden" name="id_penggajian" value="<?php echo isset($_GET['id_penggajian']) ? $_GET['id_penggajian'] : ''; ?>">
                <input type="hidden" name="id_karyawan" value="<?php echo isset($_GET['id_karyawan']) ? $_GET['id_karyawan'] : ''; ?>">
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Bonus</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                class="form-control"
                                name="bonus"
                                min="0"
                                id="bonus"
                                placeholder="Masukkan Bonus"
                                oninput="updateJumlahTotal()">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <label for="dokterName" class="form-label fw-bold">Overtime</label>
                        <input
                            type="number"
                            min="0"
                            class="form-control"
                            id="jumlah_overtime"
                            name="jumlah_overtime"
                            placeholder="Masukkan Jumlah overtime"
                            oninput="updateJumlahTotal()">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="clientName" class="form-label fw-bold">Harga Overtime</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                class="form-control"
                                id="harga_overtime"
                                placeholder="Masukkan harga overtime"
                                required
                                min="0"
                                name="harga_overtime"
                                value="<?php echo $karyawan_data['overtime']; ?>"
                                readonly />
                        </div>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="clientName" class="form-label fw-bold">Jumlah Total Overtime</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                id="jumlah_total_overtime"
                                required
                                name="jumlah_total_overtime"
                                readonly
                                value="0" />
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4 mb-3">
                        <label for="dokterName" class="form-label fw-bold">Tunjangan Makan</label>
                        <input
                            type="number"
                            min="0"
                            class="form-control"
                            id="tunjangan_makan"
                            name="tunjangan_makan"
                            placeholder="Masukkan Jumlah tunjangan makan"
                            oninput="updateJumlahTotal()">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="clientName" class="form-label fw-bold">Harga Tunjangan Makan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                class="form-control"
                                id="harga_tunjangan_makan"
                                placeholder="Masukkan harga tunjangan makan"
                                required
                                min="0"
                                name="harga_tunjangan_makan"
                                value="<?php echo $karyawan_data['tunjangan_makan']; ?>"
                                readonly />
                        </div>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="clientName" class="form-label fw-bold">Jumlah Total Tunjangan Makan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                id="jumlah_total_tunjangan_makan"
                                required
                                name="jumlah_total_tunjangan_makan"
                                readonly
                                value="0" />
                        </div>
                    </div>
                </div>

                <?php
                $id_karyawan = isset($_GET['id_karyawan']) ? $_GET['id_karyawan'] : '';
                $month = date('m');
                $year = date('Y');
                $query_asistens = mysqli_query($conn, "SELECT 
                COUNT(notrans) as jumlah_pasien,
                SUM(ro1) AS Regio_1,
                SUM(ro2) AS Regio_2,
                SUM(ro3) AS Regio_3,
                SUM(non_regio) AS non_regio
                FROM asistens 
                WHERE id_karyawan = '$id_karyawan'
                AND MONTH(tanggal) = '$month'
                AND YEAR(tanggal) = '$year'");
                $asisten_data = mysqli_fetch_assoc($query_asistens);
                ?>

                <div class="row mt-2">
                    <div class="col-md-4 mb-3">
                        <label for="dokterName" class="form-label fw-bold">Tunjangan Pasien</label>
                        <input
                            type="number"
                            min="0"
                            class="form-control"
                            id="tunjangan_pasien"
                            name="tunjangan_pasien"
                            oninput="updateJumlahTotal()"
                            readonly
                            value="<?php echo $asisten_data['jumlah_pasien']; ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="clientName" class="form-label fw-bold">Harga Tunjangan Pasien</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                class="form-control"
                                id="harga_tunjangan_pasien"
                                placeholder="Masukkan harga tunjangan pasien"
                                required
                                min="0"
                                name="harga_tunjangan_pasien"
                                value="<?php echo $karyawan_data['tunjangan_pasien']; ?>"
                                readonly />
                        </div>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="clientName" class="form-label fw-bold">Jumlah Total Tunjangan Pasien</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                id="jumlah_total_tunjangan_pasien"
                                required
                                name="jumlah_total_tunjangan_pasien"
                                readonly
                                value="<?= $asisten_data['jumlah_pasien'] * $karyawan_data['tunjangan_pasien']; ?>" />
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4 mb-3">
                        <label for="dokterName" class="form-label fw-bold">Regio 1</label>
                        <input
                            type="number"
                            min="0"
                            class="form-control"
                            id="regio_1"
                            name="regio_1"
                            oninput="updateJumlahTotal()"
                            readonly
                            value="<?php echo $asisten_data['Regio_1']; ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="clientName" class="form-label fw-bold">Harga Regio 1</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                class="form-control"
                                id="harga_regio_1"
                                placeholder="Masukkan harga regio 1"
                                required
                                min="0"
                                name="harga_regio_1"
                                value="<?php echo $karyawan_data['ro1']; ?>"
                                readonly />
                        </div>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="clientName" class="form-label fw-bold">Jumlah Total Regio 1</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                required
                                id="jumlah_total_regio_1"
                                name="jumlah_total_regio_1"
                                readonly
                                value="<?= $asisten_data['Regio_1'] * $karyawan_data['ro1']; ?>" />
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4 mb-3">
                        <label for="dokterName" class="form-label fw-bold">Regio 2</label>
                        <input
                            type="number"
                            min="0"
                            class="form-control"
                            id="regio_2"
                            name="regio_2"
                            oninput="updateJumlahTotal()"
                            readonly
                            value="<?php echo $asisten_data['Regio_2']; ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="clientName" class="form-label fw-bold">Harga Regio 2</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                class="form-control"
                                id="harga_regio_2"
                                placeholder="Masukkan harga regio 2"
                                required
                                min="0"
                                name="harga_regio_2"
                                value="<?php echo $karyawan_data['ro2']; ?>"
                                readonly />
                        </div>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="clientName" class="form-label fw-bold">Jumlah Total Regio 2</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                required
                                id="jumlah_total_regio_2"
                                name="jumlah_total_regio_2"
                                readonly
                                value="<?= $asisten_data['Regio_2'] * $karyawan_data['ro2']; ?>" />
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4 mb-3">
                        <label for="dokterName" class="form-label fw-bold">Regio 3</label>
                        <input
                            type="number"
                            min="0"
                            class="form-control"
                            id="regio_3"
                            name="regio_3"
                            oninput="updateJumlahTotal()"
                            readonly
                            value="<?php echo $asisten_data['Regio_3']; ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="clientName" class="form-label fw-bold">Harga Regio 3</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                class="form-control"
                                id="harga_regio_3"
                                placeholder="Masukkan harga regio 3"
                                required
                                min="0"
                                name="harga_regio_3"
                                value="<?php echo $karyawan_data['ro3']; ?>"
                                readonly />
                        </div>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="clientName" class="form-label fw-bold">Jumlah Total Regio 3</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                required
                                id="jumlah_total_regio_3"
                                name="jumlah_total_regio_3"
                                readonly
                                value="<?= $asisten_data['Regio_3'] * $karyawan_data['ro3']; ?>" />
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4 mb-3">
                        <label for="dokterName" class="form-label fw-bold">Non Regio</label>
                        <input
                            type="number"
                            min="0"
                            class="form-control"
                            name="non_regio"
                            oninput="updateJumlahTotal()"
                            readonly
                            value="<?php echo $asisten_data['non_regio']; ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="clientName" class="form-label fw-bold">Harga Non Regio</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="number"
                                class="form-control"
                                required
                                min="0"
                                name="harga_non_regio"
                                value="<?php echo $karyawan_data['non_regio']; ?>"
                                readonly />
                        </div>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="clientName" class="form-label fw-bold">Jumlah Total Non Regio</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                required
                                id="jumlah_total_non_regio"
                                name="jumlah_total_non_regio"
                                readonly
                                value="<?= $asisten_data['non_regio'] * $karyawan_data['non_regio']; ?>" />
                        </div>
                    </div>
                </div>

                <?php
                $total_asistens = $asisten_data['jumlah_pasien'] * $karyawan_data['tunjangan_pasien']
                    + $asisten_data['Regio_1'] * $karyawan_data['ro1']
                    + $asisten_data['Regio_2'] * $karyawan_data['ro2']
                    + $asisten_data['Regio_3'] * $karyawan_data['ro3']
                    + $asisten_data['non_regio'] * $karyawan_data['non_regio'];
                ?>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Total Asistens</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input
                                type="text"
                                class="form-control"
                                id="total_asistens"
                                name="total_asistens"
                                readonly
                                value="<?php echo $total_asistens; ?>" />
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
</div>

<script>
    function updateJumlahTotal() {
        var jumlahOvertime = parseFloat(document.getElementById('jumlah_overtime').value) || 0;
        var hargaOvertime = parseFloat(document.getElementById('harga_overtime').value) || 0;
        var jumlahTunjanganMakan = parseFloat(document.getElementById('tunjangan_makan').value) || 0;
        var hargaTunjanganMakan = parseFloat(document.getElementById('harga_tunjangan_makan').value) || 0;
        var bonus = parseFloat(document.getElementById('bonus').value) || 0;

        var totalOvertime = jumlahOvertime * hargaOvertime;
        var totalTunjanganMakan = jumlahTunjanganMakan * hargaTunjanganMakan;
        var totalBonus = bonus;

        document.getElementById('jumlah_total_overtime').value = totalOvertime;
        document.getElementById('jumlah_total_tunjangan_makan').value = totalTunjanganMakan;

        var totalAsistens = <?php echo $total_asistens; ?> + totalBonus + totalOvertime + totalTunjanganMakan;
        document.getElementById('total_asistens').value = totalAsistens;
    }
</script>