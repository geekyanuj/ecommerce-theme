/* ===== TOAST ===== */
let tt;
export function showToast(msg, type = "success") {
  const t = document.getElementById("toast");

  t.textContent = msg;

  t.classList.remove("show-success", "show-error", "show-warning");
  t.classList.add(`show-${type}`);

  clearTimeout(tt);

  tt = setTimeout(() => {
    t.classList.remove("show-success", "show-error", "show-warning");
  }, 3200);
}

function focusField(id, message) {
  const el = document.getElementById(id);

  if (!el) return;

  el.focus();
  el.classList.add("input-error");

  showToast(message, "error");

  setTimeout(() => {
    el.classList.remove("input-error");
  }, 3000);
}