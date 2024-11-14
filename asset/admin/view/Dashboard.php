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
                    <h6 class="mb-3">Sales</h6>
                    <div class="text-center mt-2">
                        <h4 class="mb-2">Rp. 0</h4>
                        <small class="text-success">4,234 more than usual</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card__header">
                <div
                    class="card-body2 d-flex flex-column"
                    style="background: var(--bg-card-2)">
                    <h6 class="mb-3">Orders</h6>
                    <div class="text-center mt-2">
                        <h4 class="mb-2">Rp. 2.567.000</h4>
                        <small class="text-danger">234 less than usual</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card__header">
                <div
                    class="card-body3 d-flex flex-column"
                    style="background: var(--bg-card-3)">
                    <h6 class="mb-3">Products</h6>
                    <div class="text-center mt-2">
                        <h4 class="mb-2">Rp. 587.000</h4>
                        <small class="text-success">23 more than usual</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card__header">
                <div
                    class="card-body4 d-flex flex-column"
                    style="background: var(--bg-card-4)">
                    <h6 class="mb-3">Customers</h6>
                    <div class="text-center mt-2">
                        <h4 class="mb-2">Rp. 4.300.000</h4>
                        <small class="text-danger">34 less than usual</small>
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