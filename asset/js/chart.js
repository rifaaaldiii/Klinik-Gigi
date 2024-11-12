const ctx = document.getElementById("salesChart").getContext("2d");
new Chart(ctx, {
  type: "line",
  data: {
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
    datasets: [
      {
        label: "Target sales",
        data: [300, 220, 350, 120, 350, 370, 60, 80, 350, 400, 100, 70],
        borderColor: "#28a745",
        fill: false,
      },
      {
        label: "Current sales",
        data: [180, 100, 200, 110, 90, 80, 70, 60, 150, 70, 100, 110],
        borderColor: "#dc3545",
        fill: false,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
  },
});
