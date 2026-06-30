/* ===== CUSTOM CURSOR ===== */
const dot = document.getElementById("cursor-dot"),
  ring = document.getElementById("cursor-ring");
let mx = 0,
  my = 0,
  rx = 0,
  ry = 0;
document.addEventListener("mousemove", (e) => {
  mx = e.clientX;
  my = e.clientY;
  dot.style.left = mx + "px";
  dot.style.top = my + "px";
});
(function loop() {
  rx += (mx - rx) * 0.11;
  ry += (my - ry) * 0.11;
  ring.style.left = rx + "px";
  ring.style.top = ry + "px";
  requestAnimationFrame(loop);
})();
document.addEventListener("mousedown", () => {
  dot.classList.add("click");
  ring.style.width = "20px";
  ring.style.height = "20px";
  ring.style.opacity = "1";
});
document.addEventListener("mouseup", () => {
  dot.classList.remove("click");
  ring.style.width = "";
  ring.style.height = "";
  ring.style.opacity = "";
});
function addCursorHover(sel) {
  document.querySelectorAll(sel).forEach((el) => {
    el.addEventListener("mouseenter", () => {
      dot.classList.add("hov");
      ring.classList.add("hov");
    });
    el.addEventListener("mouseleave", () => {
      dot.classList.remove("hov");
      ring.classList.remove("hov");
    });
  });
}
addCursorHover(
  "a,button,.cat-card,.prod-card,.pay-method-card,.offer-card,.why-card,.rev-card,[data-page],[data-filter-shop],[data-wa]",
);
