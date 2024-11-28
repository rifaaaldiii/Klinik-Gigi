<!-- Main Content -->
<div class="col-md-10 main-content">
    <h5 class="mb-4 fw-bold">Welcome back, <?php echo $_SESSION['username']; ?></h5>

    <!-- Stats Cards -->
    <div class="row mb-3 gx-4 gy-3">
        <div class="col-xl-3 col-md-6">
            <div class="card__header">
                <div
                    class="card-body1 d-flex flex-column"
                    style="background: var(--bg-card-1)">
                    <h6 class="mb-3">Transkasi</h6>
                    <div class="text-center mt-2">
                        <h4 class="mb-2"> Rp. 
                            <?php
                            $query = "SELECT SUM(total) as total FROM transaksi WHERE status = 'Completed' AND MONTH(tanggal) = MONTH(CURRENT_DATE()) AND YEAR(tanggal) = YEAR(CURRENT_DATE())";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            if ($row['total'] == null) {
                                echo "0";
                            } else {
                                echo number_format($row['total'],0,',','.');
                            }
                            ?>
                        </h4>
                        <small class="text-success">
                            <?php
                            $query = "SELECT COUNT(*) AS total FROM transaksi WHERE status = 'Completed' AND MONTH(tanggal) = MONTH(CURRENT_DATE()) AND YEAR(tanggal) = YEAR(CURRENT_DATE())";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['total'];
                            ?>
                            Transaksi
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card__header">
                <div
                    class="card-body2 d-flex flex-column"
                    style="background: var(--bg-card-2)">
                    <h6 class="mb-3">Tindakan</h6>
                    <div class="text-center mt-2">
                        <h4 class="mb-2">Rp. 
                            <?php
                            $month = date('m');
                            $year = date('Y');  
                            $query = "SELECT SUM(dt.total) as total FROM detail_transaksi dt 
                            JOIN transaksi t ON dt.notrans = t.notrans
                            WHERE MONTH(t.tanggal) = $month AND YEAR(t.tanggal) = $year AND t.status = 'Completed'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            if ($row['total'] == null) {
                                echo "0";
                            } else {
                                echo number_format($row['total'],0,',','.');
                            }
                            ?>
                        </h4>
                        <small class="text-danger">
                            <?php 
                            $month = date('m');
                            $year = date('Y');
                            $query = "SELECT COUNT(dt.tindakan) AS total_tindakan
                            FROM detail_transaksi dt
                            JOIN transaksi t ON dt.notrans = t.notrans
                            WHERE MONTH(t.tanggal) = $month AND YEAR(t.tanggal) = $year AND t.status = 'Completed'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            if ($row['total_tindakan'] == null) {
                                echo "0";
                            } else {
                                echo number_format($row['total_tindakan'],0,',','.');
                            }
                            ?>
                            Tindakan
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card__header">
                <div
                    class="card-body3 d-flex flex-column"
                    style="background: var(--bg-card-3)">
                    <h6 class="mb-3">Jasa Medis</h6>
                    <div class="text-center mt-2">
                        <h4 class="mb-2">Rp. 
                            <?php 
                            $month = date('m');
                            $year = date('Y');  
                            $query = "SELECT SUM(dt.jm) as total_jm FROM detail_transaksi dt
                            JOIN transaksi t ON dt.notrans = t.notrans 
                            WHERE MONTH(t.tanggal) = $month AND YEAR(t.tanggal) = $year AND t.status = 'Completed'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            if ($row['total_jm'] == null) {
                                echo "0";
                            } else {
                                echo number_format($row['total_jm'],0,',','.');
                            }
                            ?>
                        </h4>
                        <small class="text-success">
                        <?php 
                            $month = date('m');
                            $year = date('Y');
                            $query = "SELECT COUNT(dt.jm) AS total_jm
                            FROM detail_transaksi dt
                            JOIN transaksi t ON dt.notrans = t.notrans
                            WHERE MONTH(t.tanggal) = $month AND YEAR(t.tanggal) = $year AND t.status = 'Completed'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            if ($row['total_jm'] == null) {
                                echo "0";
                            } else {
                                echo number_format($row['total_jm'],0,',','.');
                            }
                            ?>
                            Jasa Medis
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card__header">
                <div
                    class="card-body4 d-flex flex-column"
                    style="background: var(--bg-card-4)">
                    <h6 class="mb-3">Income</h6>
                    <div class="text-center mt-2">
                        <h4 class="mb-2">Rp. 
                            <?php
                            $year = date('Y');  
                            $query = "SELECT SUM(dt.total) as total_dt FROM detail_transaksi dt
                            JOIN transaksi t ON dt.notrans = t.notrans
                            WHERE YEAR(t.tanggal) = $year AND t.status = 'Completed'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            if ($row['total_dt'] == null) {
                                echo "0";
                            } else {
                                echo number_format($row['total_dt'],0,',','.');
                            }
                            ?>
                        </h4>
                        <small class="text-danger">
                            <?php
                            $year = date('Y');  
                            $query = "SELECT COUNT(*) AS total FROM transaksi WHERE status = 'Completed' AND YEAR(tanggal) = $year";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                                echo $row['total'];
                            ?>
                            Transaksi
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graph Card -->
    <div class="card" style="height: 416px">
        <div class="card-body">
            <h5 class="card-title">Sales difference</h5>
            <div class="mt-1">
                <canvas
                    id="salesChart"
                    style="width: 100%; height: 345px"></canvas>
            </div>
        </div>
    </div>
</div>