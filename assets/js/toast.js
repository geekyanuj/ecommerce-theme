/* ===== TOAST ===== */
let tt;
export function showToast(msg) {
  const t = document.getElementById("toast");
  t.textContent = msg;
  t.classList.add("show");
  clearTimeout(tt);
  tt = setTimeout(() => t.classList.remove("show"), 3200);
}