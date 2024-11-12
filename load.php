<?php
include "env/env.php";
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['password']) && !isset($_SESSION['username']) && !isset($_SESSION['role'])) {
  header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wait ...</title>
  <link rel="icon" href="asset/img/logo.png" />
  <link rel="stylesheet" href="asset/css/load.css" />
</head>

<body>
  <div class="loader">
    <div class="loader-logo">
      <img src="asset/img/logo.png" alt="logo" />
    </div>
    <div class="loader-bar"></div>
  </div>

  <script>
    window.addEventListener("load", function() {
      const loader = document.querySelector(".loader");

      // Mendapatkan nilai role dari PHP dan menyimpannya dalam variabel JavaScript
      const userRole = "<?php echo $_SESSION['role']; ?>";

      Promise.all(
        Array.from(document.images)
        .filter((img) => !img.complete)
        .map(
          (img) =>
          new Promise((resolve) => {
            img.onload = img.onerror = resolve;
          })
        )
      ).then(() => {
        setTimeout(() => {
          loader.style.opacity = "0";
          setTimeout(() => {
            loader.style.display = "none";
            // Menggunakan variabel JavaScript untuk menentukan arah navigasi
            if (userRole === "owner") {
              window.location.href = "asset/owner/index.php?page=Dashboard";
            } else {
              window.location.href = "asset/admin/index.php";
            }
          }, 500);
        }, 1500);
      });
    });
  </script>
</body>

</html>