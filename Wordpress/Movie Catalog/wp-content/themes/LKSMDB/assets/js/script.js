document.addEventListener("DOMContentLoaded", function () {
  const likeButton = document.getElementById("like-button");

  if (likeButton) {
    likeButton.addEventListener("click", function () {
      const postId = this.getAttribute("data-post-id");

      fetch(lksmdb_data.ajax_url, {
        method: "POST",
        body: new URLSearchParams({
          action: "increase_like_count",
          post_id: postId,
        }),
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            document.getElementById("like-count").innerText =
              data.data.new_count;
          }
        });
    });
  }

  function heightContainer() {
    const navbar = document.getElementById("navbar-container");
    const footer = document.getElementById("footer-container");
    const authContainer = document.getElementById("auth-fullscreen");

    const navbarHeight = navbar ? navbar.offsetHeight : 0;
    const footerHeight = footer ? footer.offsetHeight : 0;
    const windowHeight = window.innerHeight;

    const targetHeight = windowHeight - navbarHeight - footerHeight;
    if (authContainer) {
      authContainer.style.minHeight = `${targetHeight}px`;
    }
  }

  window.addEventListener("load", heightContainer);
  window.addEventListener("resize", heightContainer);

  const backToTopBtn = document.getElementById("back-top");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 300) {
      backToTopBtn.classList.add("show");
    } else {
      backToTopBtn.classList.remove("show");
    }
  });

  backToTopBtn.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  const hamburgerIcon = document.getElementById("hamburger-icon");
  const navbarList = document.getElementById("navbar-list");
  hamburgerIcon.addEventListener("click", function () {
    navbarList.classList.toggle("active");
  });
});
