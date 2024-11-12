// Tambahkan div overlay setelah body tag dibuka
document.body.insertAdjacentHTML(
  "afterbegin",
  '<div class="sidebar-overlay"></div>'
);

document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.querySelector(".sidebar-overlay");
  const toggleBtn = document.getElementById("toggleSidebar");

  if (!sidebar || !toggleBtn) {
    console.error("Sidebar or toggle button not found!");
    return;
  }

  toggleBtn.addEventListener("click", function () {
    console.log("Toggle button clicked");
    sidebar.classList.toggle("show");
    overlay.classList.toggle("show");
    document.body.style.overflow = sidebar.classList.contains("show")
      ? "hidden"
      : "";
  });

  overlay.addEventListener("click", function () {
    console.log("Overlay clicked");
    sidebar.classList.remove("show");
    overlay.classList.remove("show");
    document.body.style.overflow = "";
  });
});

// JavaScript untuk memfilter tabel berdasarkan input pencarian
document
  .getElementById("searchKaryawan")
  .addEventListener("keyup", function () {
    var input = this.value.toLowerCase();
    var rows = document.querySelectorAll("#karyawanTable tbody tr");

    rows.forEach(function (row) {
      var nama = row.cells[1].textContent.toLowerCase();
      if (nama.includes(input)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
