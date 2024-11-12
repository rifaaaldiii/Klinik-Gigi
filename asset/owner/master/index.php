<?php
include "../../../env/env.php";
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['password']) && !isset($_SESSION['username']) && !isset($_SESSION['role'])) {
  header("location:../../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Klinik Gigi - <?php echo $_GET['page']; ?></title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="icon" href="../../img/logo.png" />
  <link rel="stylesheet" href="../../css/all.css" />
</head>

<body>
  <header
    class="header d-flex align-items-center px-3 justify-content-between">
    <div class="d-flex align-items-center">
      <button class="btn btn-light d-xl-none me-2" id="toggleSidebar">
        <i class="fas fa-bars"></i>
      </button>
      <h2 class="mb-0 fw-bold">
        Klinik <span class="text-secondary fw-bold s">Gigi</span>
      </h2>
    </div>
    <div class="d-flex align-items-center">
      <div class="dropdown me-3">
        <button
          class="btn btn-light dropdown-toggle d-flex align-items-center"
          type="button"
          data-bs-toggle="dropdown">
          <?php echo $_SESSION['username']; ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <span class="dropdown-item">Username:
              <?php echo $_SESSION['username']; ?></span>
          </li>
          <li>
            <span class="dropdown-item">Email:
              <?php echo $_SESSION['email']; ?></span>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <a
              class="dropdown-item"
              href="../../app/logout.php"
              onclick="return confirm('Apakah Anda yakin ingin keluar ?');">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-xl-2 col-lg-3 col-md-4">
        <div class="sidebar" id="sidebar">
          <div class="nav flex-column">
            <a
              href="../index.php?page=Dashboard"
              class="nav-link <?php echo $_GET['page'] == 'Dashboard' ? 'active' : ''; ?>">
              <i class="fas fa-home"></i> Dashboard
            </a>

            <a
              href="../index.php?page=Transaksi"
              class="nav-link <?php echo $_GET['page'] == 'Transaksi' ? 'active' : ''; ?>">
              <i class="fas fa-money-bill"></i> Transaksi
            </a>

            <a
              href="../index.php?page=Penggajian"
              class="nav-link <?php echo $_GET['page'] == 'Penggajian' ? 'active' : ''; ?>">
              <i class="fas fa-envelope"></i> Penggajian
            </a>

            <!-- Dropdown Master Data -->
            <div class="dropdown">
              <a
                class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                href="#"
                role="button"
                data-bs-toggle="dropdown">
                <span>Laporan</span>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Transaksi</a></li>
                <li><a class="dropdown-item" href="#">Penggajian</a></li>
                <li><a class="dropdown-item" href="#">Jasa Medis</a></li>
              </ul>
            </div>

            <div class="dropdown">
              <a
                class="nav-link dropdown-toggle d-flex justify-content-between align-items-center"
                href="#"
                role="button"
                data-bs-toggle="dropdown">
                <span>Master Data</span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="index.php?page=Dokter">Dokter</a>
                </li>
                <li>
                  <a class="dropdown-item" href="index.php?page=Karyawan">Karyawan</a>
                </li>
                <li>
                  <a class="dropdown-item" href="index.php?page=Golongan">Golongan</a>
                </li>
                <li>
                  <a class="dropdown-item" href="index.php?page=Tindakan">Tindakan</a>
                </li>
                <li>
                  <a class="dropdown-item" href="index.php?page=User">User</a>
                </li>
              </ul>
            </div>
          </div>
          <!-- Tambahkan copyright di sini -->
          <div class="mt-auto text-center copyright">
            <small class="text-muted">&copy; 2024 Inovasi Digital Co. All rights reserved.</small>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <?php
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        include 'view/' . $page . '.php';
      } else {
        // redirect ke halaman default jika parameter page tidak ada
        include 'view/Master.php';
      }
      ?>
    </div>
  </div>

  <div class="sidebar-overlay"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../../js/all.js"></script>
  <script src="../../js/chart.js"></script>
</body>

</html>