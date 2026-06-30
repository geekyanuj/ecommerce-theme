/* ===== PAYMENT ===== */
function selectPayMethod(method, card) {
  document
    .querySelectorAll(".pay-method-card")
    .forEach((c) => c.classList.remove("selected"));
  document
    .querySelectorAll(".pay-detail-panel")
    .forEach((p) => p.classList.remove("active"));
  document.getElementById("pay-success-box").style.display = "none";
  card.classList.add("selected");
  const upiGroup = ["upi", "paytm", "phonepay", "gpay"];
  const panelId = upiGroup.includes(method) ? "upi" : method;
  const panel = document.getElementById("panel-" + panelId);
  if (panel) {
    panel.classList.add("active");
    panel.scrollIntoView({ behavior: "smooth", block: "nearest" });
  }
  if (upiGroup.includes(method)) configureUpiPanel(method);
}
function configureUpiPanel(method) {
  const titles = {
    upi: "📱 Pay via UPI",
    paytm: "💙 Pay via Paytm",
    phonepay: "💜 Pay via PhonePe",
    gpay: "🎨 Pay via Google Pay",
  };
  const titleEl = document.getElementById("upi-panel-title");
  if (titleEl) titleEl.textContent = titles[method] || titles.upi;
  const btn = document.getElementById("upi-pay-btn");
  if (btn) btn.setAttribute("onclick", "processPayment('" + method + "')");
  const amount = getPayableAmount();
  const link = buildUpiLink(amount, "ANNEO Fresh Order");
  const img = document.getElementById("upi-qr-img");
  if (img) img.src = buildQrUrl(link);
  const amtEl = document.getElementById("upi-amt-text");
  if (amtEl) amtEl.textContent = "Amount: ₹" + amount;
}
function processPayment(method) {
  const upiGroup = ["upi", "paytm", "phonepay", "gpay"];
  if (method === "cod") {
    const d = validateDeliveryDetails();
    if (!d) return;
    const amount = getPayableAmount();
    saveOrder({
      cart: [...cart],
      method: "COD",
      ...d,
      amount,
      date: new Date().toISOString(),
    });
    sendOrderToWhatsApp({
      items: [...cart],
      amount,
      method: "Cash on Delivery",
      ...d,
    });
    showPaySuccess("cod");
    return;
  }
  if (upiGroup.includes(method)) {
    const d = validateDeliveryDetails();
    if (!d) return;
    const amount = getPayableAmount();
    saveOrder({
      cart: [...cart],
      method,
      ...d,
      amount,
      date: new Date().toISOString(),
    });
    sendOrderToWhatsApp({
      items: [...cart],
      amount,
      method: method.toUpperCase(),
      ...d,
    });
    showPaySuccess(method);
    return;
  }
  showToast("Card payments are coming soon — please use UPI or COD ⚠️");
}
function showPaySuccess(method) {
  const msgs = {
    upi: "Order received! We will confirm your UPI payment shortly.",
    paytm: "Order received! We will confirm your payment shortly.",
    phonepay: "Order received! We will confirm your payment shortly.",
    gpay: "Order received! We will confirm your payment shortly.",
    cod: "COD order placed — pay on delivery!",
  };
  document.getElementById("pay-success-msg").textContent =
    (msgs[method] || "Order placed!") +
    " Thank you for choosing ANNEO Fresh! 🌿";
  document.getElementById("pay-success-box").style.display = "block";
  document
    .getElementById("pay-success-box")
    .scrollIntoView({ behavior: "smooth" });
  cart = [];
  updateCartCount();
  updatePaySummary();
  showToast("Order Confirmed! 🎉");
}


/* ===== MERCHANT PAYMENT CONFIG ===== */
const MERCHANT_UPI_ID = "6206850162-2@axl";
const MERCHANT_NAME = "ANNEO Fresh";
const OWNER_WA_NUMBER = "916206850162";
function getPayableAmount() {
  const total = cart.reduce((a, x) => a + x.price * x.qty, 0);
  return total + (total > 0 && total < 499 ? 40 : 0);
}
function buildUpiLink(amount, note) {
  const p = new URLSearchParams({
    pa: MERCHANT_UPI_ID,
    pn: MERCHANT_NAME,
    am: Number(amount).toFixed(2),
    cu: "INR",
    tn: note || "ANNEO Fresh Order",
  });
  return "upi://pay?" + p.toString();
}
function buildQrUrl(upiLink) {
  return (
    "https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=" +
    encodeURIComponent(upiLink)
  );
}
