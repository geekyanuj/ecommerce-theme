import "./custom-cursor.js";

/* ===== SCROLL + REVEAL ===== */
const stb = document.getElementById("stb");
window.addEventListener("scroll", () =>
  stb.classList.toggle("vis", scrollY > 400),
);
stb.addEventListener("click", () =>
  window.scrollTo({ top: 0, behavior: "smooth" }),
);
if (typeof IntersectionObserver !== "undefined") {
  const ro = new IntersectionObserver(
    (es) => {
      es.forEach((e) => {
        if (e.isIntersecting) e.target.classList.add("vis");
      });
    },
    { threshold: 0.08 },
  );
  document.querySelectorAll(".reveal").forEach((el) => ro.observe(el));
} else
  document.querySelectorAll(".reveal").forEach((el) => el.classList.add("vis"));




import "./modal.js";
import "./toast.js";
import "./whatsapp.js";
import "./navigation.js";
import "./cart.js";

import "./checkout.js";

import "./wishlist.js";

import "./payment.js";

import "./account.js";

import "./newsletter.js";







document.getElementById("mm-login-btn").addEventListener("click", (e) => {
  e.preventDefault();
  closeMobile();
  openModal("login");
});
document.getElementById("mm-signup-btn").addEventListener("click", (e) => {
  e.preventDefault();
  closeMobile();
  openModal("signup");
});

/* ===== HAMBURGER ===== */
const hbg = document.getElementById("hbg"),
  mmenu = document.getElementById("mmenu");
hbg.addEventListener("click", () => {
  hbg.classList.toggle("open");
  mmenu.classList.toggle("open");
  document.body.style.overflow = mmenu.classList.contains("open")
    ? "hidden"
    : "";
});
function closeMobile() {
  hbg.classList.remove("open");
  mmenu.classList.remove("open");
  document.body.style.overflow = "";
}



function filterProducts(cat, btn) {
  currentFilter = cat;
  document
    .querySelectorAll(".filter-btn")
    .forEach((b) => b.classList.remove("active"));
  if (btn) btn.classList.add("active");
  renderShop(cat);
}
function filterAndGoShop(cat) {
  currentFilter = cat;
  renderShop(cat);
  showPage("shop");
  document.querySelectorAll(".filter-btn").forEach((b) => {
    const fn = b.getAttribute("onclick") || "";
    b.classList.toggle("active", fn.includes("'" + cat + "'"));
  });
}


