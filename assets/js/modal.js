
/* ===== CLICK DELEGATION For Modals===== */
document.addEventListener("click", (e) => {

    const open = e.target.closest("[data-open]");

    if (open) {
        e.preventDefault();
        openModal(open.dataset.open);
    }

    const close = e.target.closest("[data-close]");

    if (close) {
        closeModal(close.dataset.close);
    }
});


document.addEventListener("click", (e) => {
  const sw = e.target.closest("[data-switch]");

  if (!sw) return;

  e.preventDefault();

  const [from, to] = sw.dataset.switch.split(":");

  closeModal(from);
  openModal(to);
});

function openModal(id) {
  document.getElementById(`modal-${id}`)?.classList.add("open");

  document.body.style.overflow = "hidden";
}

function closeModal(id) {
  document.getElementById(`modal-${id}`)?.classList.remove("open");

  document.body.style.overflow = "";
}

