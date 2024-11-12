<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Klinik Gigi - Login</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link rel="icon" href="asset/img/logo.png" />
  <link rel="stylesheet" href="asset/css/index.css" />
</head>

<body>
  <div class="login-card">
    <div class="logo">
      <div class="logo-icon">
        <img src="asset/img/logo.png" alt="logo" />
      </div>
      <h2>Klinik <span>Gigi</span></h2>
      <small class="text-muted">Silakan masuk ke akun Anda</small>
    </div>

    <form action="asset/app/login.php" method="post">
      <div class="form-group">
        <input
          type="email"
          class="form-control"
          id="email"
          name="email"
          placeholder="Email"
          required />
        <label for="email">Email</label>
      </div>

      <div class="form-group">
        <input
          type="password"
          class="form-control"
          id="password"
          name="password"
          placeholder="Password"
          required />
        <label for="password">Password</label>
      </div>

      <button type="submit" class="btn btn-primary" name="submit">Masuk</button>
    </form>

    <!-- Tambahan untuk Google Auth -->
    <!-- <div class="divider mt-4 mb-3 text-center">
      <span class="divider-text">atau</span>
    </div> -->
    <div class="divider mt-5 mb-2 text-center">
      <small class="text-muted">&copy; 2024 Inovasi Digital Co. All rights reserved.</small>
    </div>

    <!-- <button
      class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-center gap-2">
      <img src="https://www.google.com/favicon.ico" alt="Google" width="20" />
      Masuk dengan Google
    </button>  -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>