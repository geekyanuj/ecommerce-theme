/* ===== WHATSAPP ===== */
document.getElementById("wa-float-btn").addEventListener("click", () => {
  document.getElementById("modal-wa").classList.add("open");
  document.body.style.overflow = "hidden";
});

document.getElementById("wa-close-btn").addEventListener("click", () => {
  document.getElementById("modal-wa").classList.remove("open");
  document.body.style.overflow = "";
});

document.getElementById("modal-wa").addEventListener("click", function (e) {
  if (e.target === this) {
    this.classList.remove("open");
    document.body.style.overflow = "";
  }
});

document.getElementById("wa-send-btn").addEventListener("click", function (e) {
  e.preventDefault();
  const name = document.getElementById("wa-name").value.trim() || "Customer";
  const msg =
    document.getElementById("wa-msg").value.trim() ||
    "Hello, I want to know more about your products.";
  window.open(
    "https://wa.me/" +
      OWNER_WA_NUMBER +
      "?text=" +
      encodeURIComponent("Hi ANNEO Fresh!\nMy name is " + name + ".\n\n" + msg),
    "_blank",
  );
  document.getElementById("modal-wa").classList.remove("open");
  document.body.style.overflow = "";
});

function sendOrderToWhatsApp(info) {
  const lines = ["🛍️ *New Order — ANNEO Fresh*", ""];
  if (info.items && info.items.length) {
    lines.push("*Items:*");
    info.items.forEach((it) =>
      lines.push("• " + it.name + " x" + it.qty + " — ₹" + it.price * it.qty),
    );
    lines.push("");
  } else if (info.product) {
    lines.push("*Item:* " + info.product, "");
  }
  lines.push("*Amount:* ₹" + info.amount);
  lines.push("*Payment Method:* " + info.method);
  lines.push("*Customer Name:* " + (info.name || "-"));
  lines.push("*Phone:* " + (info.phone || "-"));
  lines.push("*Address:* " + (info.addr || "-"));
  window.open(
    "https://wa.me/" +
      OWNER_WA_NUMBER +
      "?text=" +
      encodeURIComponent(lines.join("\n")),
    "_blank",
  );
}
