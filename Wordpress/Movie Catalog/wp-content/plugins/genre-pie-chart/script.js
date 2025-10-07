document.addEventListener("DOMContentLoaded", function () {
  if (!window.genrePieChartData) return;

  const ctx = document.getElementById(genrePieChartData.chartId);
  if (!ctx) return;

  new Chart(ctx.getContext("2d"), {
    type: "pie",
    data: {
      labels: genrePieChartData.labels,
      datasets: [
        {
          label: "Posts per Genre",
          data: genrePieChartData.data,
          backgroundColor: [
            "#FF6384",
            "#36A2EB",
            "#FFCE56",
            "#4BC0C0",
            "#9966FF",
            "#FF9F40",
            "#E7E9ED",
            "#76A346",
            "#A34676",
            "#4676A3",
          ],
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "bottom",
        },
      },
    },
  });
});
