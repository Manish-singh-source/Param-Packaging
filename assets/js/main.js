(function () {
  const slides = Array.from(document.querySelectorAll(".static-slide"));
  const dotsWrap = document.querySelector(".static-dots");
  const prev = document.querySelector(".static-prev");
  const next = document.querySelector(".static-next");
  let current = 0;
  let timer;

  function goTo(index) {
    if (!slides.length || !dotsWrap) return;
    current = (index + slides.length) % slides.length;
    slides.forEach((slide, i) => slide.classList.toggle("active", i === current));
    Array.from(dotsWrap.children).forEach((dot, i) => dot.classList.toggle("active", i === current));
  }

  function play() {
    clearInterval(timer);
    timer = setInterval(() => goTo(current + 1), 4500);
  }

  if (slides.length && dotsWrap && prev && next) {
    slides.forEach((_, i) => {
      const dot = document.createElement("button");
      dot.type = "button";
      dot.setAttribute("aria-label", "Go to slide " + (i + 1));
      dot.addEventListener("click", () => {
        goTo(i);
        play();
      });
      dotsWrap.appendChild(dot);
    });
    prev.addEventListener("click", () => {
      goTo(current - 1);
      play();
    });
    next.addEventListener("click", () => {
      goTo(current + 1);
      play();
    });
    goTo(0);
    play();
  }

  const toggle = document.querySelector(".navbar-toggle");
  const nav = document.querySelector(".navbar-collapse");
  if (toggle && nav) {
    toggle.addEventListener("click", () => {
      const open = nav.classList.toggle("in");
      toggle.setAttribute("aria-expanded", String(open));
    });
    nav.addEventListener("click", (event) => {
      if (event.target.closest("a")) {
        nav.classList.remove("in");
        toggle.setAttribute("aria-expanded", "false");
      }
    });
  }

  document.querySelectorAll(".contactForm form").forEach((form) => {
    form.addEventListener("submit", () => {
      const button = form.querySelector(".submit-message-btn");
      if (!button) return;
      const label = button.querySelector("span") || button;
      button.disabled = true;
      button.classList.add("loading");
      label.textContent = button.dataset.loadingText || "Sending...";
    });
  });

  document.querySelectorAll('a[href*="#"]').forEach((link) => {
    link.addEventListener("click", (event) => {
      const url = new URL(link.href, window.location.href);
      if (url.pathname !== window.location.pathname || !url.hash) return;

      const target = document.querySelector(url.hash);
      if (!target) return;

      event.preventDefault();
      const header = document.querySelector(".navbar");
      const offset = header ? header.offsetHeight : 0;
      const top = target.getBoundingClientRect().top + window.pageYOffset - offset;

      window.scrollTo({ top, behavior: "smooth" });
      history.pushState(null, "", url.hash);
    });
  });

  const reveals = document.querySelectorAll(".static-reveal, .contentbox, .about-us-main");
  if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    reveals.forEach((el) => observer.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("visible"));
  }

  function setupCardSlider(navSelector, viewportSelector) {
    const navLinks = Array.from(document.querySelectorAll(navSelector + " a"));
    const viewport = document.querySelector(viewportSelector);
    const strip = viewport ? viewport.querySelector(".static-card-strip") : null;
    if (!navLinks.length || !viewport || !strip) return;

    navLinks.forEach((link) => {
      link.addEventListener("click", (event) => {
        event.preventDefault();
        const target = document.querySelector(link.getAttribute("href"));
        if (!target) return;
        const maxLeft = Math.max(0, strip.scrollWidth - viewport.clientWidth);
        const nextLeft = Math.min(target.offsetLeft, maxLeft);
        strip.style.left = "-" + nextLeft + "px";
        navLinks.forEach((item) => item.classList.toggle("active", item === link));
      });
    });
  }

  setupCardSlider("#nav2", "#content");
  setupCardSlider("#nav3", "#content2");

  const zoomLinks = Array.from(document.querySelectorAll(".zoom-link"));
  if (zoomLinks.length) {
    const modal = document.createElement("div");
    modal.className = "zoom-modal";
    modal.innerHTML = '<button type="button" aria-label="Close image">×</button><img alt="">';
    document.body.appendChild(modal);
    const modalImage = modal.querySelector("img");
    const close = modal.querySelector("button");

    function closeModal() {
      modal.classList.remove("open");
      modalImage.removeAttribute("src");
    }

    zoomLinks.forEach((link) => {
      link.addEventListener("click", (event) => {
        event.preventDefault();
        modalImage.src = link.href;
        modalImage.alt = link.title || "Zoomed image";
        modal.classList.add("open");
      });
    });

    close.addEventListener("click", closeModal);
    modal.addEventListener("click", (event) => {
      if (event.target === modal) closeModal();
    });
    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") closeModal();
    });
  }
})();
