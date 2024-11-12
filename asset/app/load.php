<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wait ...</title>
  <link rel="icon" href="../img/logo.png" />
  <link rel="stylesheet" href="../css/load.css" />
</head>

<body>
  <div class="loader">
    <div class="loader-logo">
      <img src="../img/logo.png" alt="logo" />
    </div>
    <div class="loader-bar"></div>
  </div>

  <script>
    window.addEventListener("load", function() {
      const loader = document.querySelector(".loader");

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
            window.location.href = "../../index.php";
          }, 500);
        }, 1500);
      });
    });
  </script>
</body>

</html>