// INICIALIZAÇÃO DO SCRIPT
window.addEventListener("load", () => {
  const transition = document.getElementById("page-transition");
  if (!transition) return;

  // VERIFICAÇÃO DE RECARREGAMENTO (SEM ANIMAÇÃO, MAS MANTÉM FUNCIONALIDADE)
  const navEntries = performance.getEntriesByType("navigation");
  const isReload = navEntries.length && navEntries[0].type === "reload";

  if (isReload) {
    transition.style.transition = "none";
    transition.style.transform = "translateX(-100%)";
  }

  // MÓDULO DE ENTRADA (ANIMAÇÃO AO CARREGAR PÁGINA)
  const direction = sessionStorage.getItem("transitionDirection");
  sessionStorage.removeItem("transitionDirection");

  if (!isReload) {
    transition.style.transition = "none";

    if (direction === "right") {
      transition.style.transform = "translateX(0)";
      transition.getBoundingClientRect();
      requestAnimationFrame(() => {
        transition.style.transition = "transform 0.8s ease-in-out";
        transition.style.transform = "translateX(-100%)";
      });
    } else if (direction === "left") {
      transition.style.transform = "translateX(0)";
      transition.getBoundingClientRect();
      requestAnimationFrame(() => {
        transition.style.transition = "transform 0.8s ease-in-out";
        transition.style.transform = "translateX(100%)";
      });
    } else {
      transition.style.transform = "translateX(-100%)";
    }
  }

  // FUNÇÃO CENTRAL DE TRANSIÇÃO ENTRE PÁGINAS
  const handleTransition = (href, from) => {
    sessionStorage.setItem("transitionDirection", from);
    transition.style.transition = "none";
    transition.style.transform = from === "left" ? "translateX(-100%)" : "translateX(100%)";
    transition.getBoundingClientRect();
    requestAnimationFrame(() => {
      transition.style.transition = "transform 0.8s ease-in-out";
      transition.style.transform = "translateX(0)";
    });
    transition.addEventListener("transitionend", () => window.location.href = href, { once: true });
  };

  // MÓDULO DE NAVEGAÇÃO (LINKS NORMAIS)
  document.querySelectorAll("a[href]").forEach(link => {
    link.addEventListener("click", e => {
      e.preventDefault();
      handleTransition(link.getAttribute("href"), "left");
    });
  });

  // MÓDULO DE BOTÕES DE VOLTAR (TRANSIÇÃO REVERSA)
  document.querySelectorAll(".btn-voltar").forEach(btn => {
    btn.addEventListener("click", e => {
      e.preventDefault();
      handleTransition(`${window.location.origin}/index.html`, "right");
    });
  });
});
