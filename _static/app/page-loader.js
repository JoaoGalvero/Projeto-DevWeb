// ==========================================
// PAGE LOADER + SINCRONIZAÇÃO COM O BLUR
// ==========================================

window.addEventListener("DOMContentLoaded", () => {
  const loader = document.getElementById("page-loading");
  const transition = document.getElementById("page-transition");
  if (!loader || !transition) return;

  // Evita loader em reloads
  const navEntries = performance.getEntriesByType("navigation");
  const isReload = navEntries.length && navEntries[0].type === "reload";
  if (isReload) {
    loader.style.display = "none";
    return;
  }

  // Adiciona o listener ao blur (quando ele termina de entrar)
  transition.addEventListener("transitionend", () => {
    // Somente se o blur estiver visível (ou seja, cobrindo a tela)
    const computedStyle = window.getComputedStyle(transition);
    if (computedStyle.transform.includes("matrix(1, 0, 0, 1, 0, 0)")) {
      // blur 100% na tela → ativa o page loader
      loader.classList.add("active");
    }
  });

  // Quando a página termina de carregar → desativa loader
  window.addEventListener("load", () => {
    setTimeout(() => loader.classList.remove("active"), 200);
  });

  // Intercepta cliques
  document.querySelectorAll("a[href], .btn-voltar").forEach(link => {
    link.addEventListener("click", e => {
      const href = link.getAttribute("href");
      if (!href || href.startsWith("#")) return;

      e.preventDefault();

      // ativa o blur deslizante
      transition.style.transition = "transform 0.8s ease-in-out";
      transition.style.transform = "translateX(0)";

      // o page loader vai entrar automaticamente após o transitionend
      transition.addEventListener(
        "transitionend",
        () => {
          // troca de página enquanto o blur e o loader estão ativos
          setTimeout(() => (window.location.href = href), 500);
        },
        { once: true }
      );
    });
  });
});
