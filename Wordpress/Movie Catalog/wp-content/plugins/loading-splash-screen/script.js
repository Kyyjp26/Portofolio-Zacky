document.addEventListener("DOMContentLoaded", function () {
  const loader = document.getElementById("lssa-loader");

  if (loader) {
    setTimeout(() => {
      loader.style.opacity = "0";
      setTimeout(() => {
        loader.style.opacity = "none";
        loader.style.display = "none";
      }, 300);
    }, 1000);
  }
});
