<div class="col-md-10 main-content">
    <h5 class="mb-4 fw-bold">Laporan Transaksi</h5>
    <!-- Recent Karyawan -->
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
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIP</th>
                            <th scope="col">No. Telpon</th>
                            <th scope="col">No. Rekening</th>
                            <th scope="col">Golongan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Karyawan 1</td>
                            <td>1234567890</td>
                            <td>081234567890</td>
                            <td>1234567890</td>
                            <td>Golongan 1</td>
                            <td>
                                <button class="btn btn-primary edit">Edit</button>
                                <button class="btn btn-danger delete">Delete</button>
                            </td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>