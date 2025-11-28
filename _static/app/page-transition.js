window.addEventListener("load", () => {
  const transition = document.getElementById("page-transition");
  const loader = document.getElementById("page-loader");
  if (!transition || !loader) return;

  const navEntries = performance.getEntriesByType("navigation");
  const isReload = navEntries.length && navEntries[0].type === "reload";
  const direction = sessionStorage.getItem("transitionDirection");
  sessionStorage.removeItem("transitionDirection");

  if (isReload) {
    transition.style.transition = "none";
    transition.style.transform = "translateX(-100%)";
    loader.classList.remove("active");
  } else {
    transition.style.transition = "none";
    if (direction === "right" || direction === "left") {
      transition.style.transform = "translateX(0)";
      transition.getBoundingClientRect();
      requestAnimationFrame(() => {
        transition.style.transition = "transform 0.8s ease-in-out";
        transition.style.transform =
          direction === "right"
            ? "translateX(-100%)"
            : "translateX(100%)";
      });
    } else {
      transition.style.transform = "translateX(-100%)";
    }
    loader.classList.add("active");
    setTimeout(() => {
      loader.classList.remove("active");
    }, 300);
  }

  const handleTransition = (href, from) => {
    sessionStorage.setItem("transitionDirection", from);
    document.body.style.pointerEvents = "none";
    loader.classList.remove("active");
    transition.style.transition = "none";
    transition.style.transform =
      from === "left" ? "translateX(-100%)" : "translateX(100%)";
    transition.getBoundingClientRect();
    requestAnimationFrame(() => {
      transition.style.transition = "transform 1s ease-in-out";
      transition.style.transform = "translateX(0)";
    });
    transition.addEventListener(
      "transitionend",
      () => {
        void loader.offsetHeight;
        setTimeout(() => {
          loader.classList.add("active");
          setTimeout(() => {
            window.location.href = href;
          }, 400);
        }, 50);
      },
      { once: true }
    );
  };

  document.querySelectorAll("a[href]").forEach(link => {
    link.addEventListener("click", e => {
      const href = link.getAttribute("href");
      if (!href || href.startsWith("#")) return;
      e.preventDefault();
      handleTransition(href, "left");
    });
  });

  document.querySelectorAll(".btn-voltar").forEach(button => {
    button.addEventListener("click", e => {
      e.preventDefault();
      handleTransition(`${window.location.origin}/index.php`, "right");
    });
  });

  loader.addEventListener("transitionend", e => {
    if (!loader.classList.contains("active") && e.propertyName === "opacity") {
      document.body.style.pointerEvents = "auto";
    }
  });
});