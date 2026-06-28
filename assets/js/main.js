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

/* ===== PRODUCTS ===== */
const PRODUCTS = [
  {
    id: 1,
    name: "Premium Besan",
    desc: "Freshly ground gram flour packed with nutrition.",
    price: 149,
    icon: "🧆",
    badge: "Best Seller",
    category: "flour",
  },
  {
    id: 2,
    name: "Stone Ground Atta",
    desc: "Soft rotis, rich nutrition, authentic taste.",
    price: 189,
    icon: "🫓",
    badge: "Top Rated",
    category: "flour",
  },
  {
    id: 3,
    name: "Premium Basmati Rice",
    desc: "Selected long-grain basmati for superior meals.",
    price: 299,
    icon: "🍚",
    badge: "Premium",
    category: "rice",
  },
  {
    id: 4,
    name: "Handpicked Chana Dal",
    desc: "Healthy, protein-rich daily essential.",
    price: 129,
    icon: "🫘",
    badge: "",
    category: "pulses",
  },
  {
    id: 5,
    name: "Pure Red Chilli Powder",
    desc: "Authentic spicy flavor for every recipe.",
    price: 89,
    icon: "🌶",
    badge: "",
    category: "spices",
  },
  {
    id: 6,
    name: "Organic Moong Dal",
    desc: "Pure organic green moong, high protein.",
    price: 159,
    icon: "🌿",
    badge: "Organic",
    category: "organic",
  },
  {
    id: 7,
    name: "Pure Turmeric Powder",
    desc: "Golden haldi, natural and fresh.",
    price: 69,
    icon: "🟡",
    badge: "",
    category: "spices",
  },
  {
    id: 8,
    name: "Mixed Dry Fruits",
    desc: "Premium assorted nuts and dry fruits.",
    price: 349,
    icon: "🥜",
    badge: "Premium",
    category: "dryfruits",
  },
  {
    id: 9,
    name: "Sona Masoori Rice",
    desc: "Light, fluffy everyday rice for families.",
    price: 219,
    icon: "🍛",
    badge: "",
    category: "rice",
  },
  {
    id: 10,
    name: "Organic Wheat Atta",
    desc: "Stone ground organic whole wheat.",
    price: 229,
    icon: "🌾",
    badge: "Organic",
    category: "organic",
  },
  {
    id: 11,
    name: "Coriander Powder",
    desc: "Fresh ground dhaniya, packed with aroma.",
    price: 55,
    icon: "🌱",
    badge: "",
    category: "spices",
  },
  {
    id: 12,
    name: "Combo Pack – Basics",
    desc: "Atta + Besan + Dal — essential trio.",
    price: 399,
    icon: "🎁",
    badge: "Save 20%",
    category: "all",
  },
];
let cart = [],
  currentFilter = "all",
  buyNowProduct = null;

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
function getDeliveryDetails() {
  const n = document.getElementById("pay-cust-name"),
    ph = document.getElementById("pay-cust-phone"),
    a = document.getElementById("pay-cust-addr");
  return {
    name: n ? n.value.trim() : "",
    phone: ph ? ph.value.trim() : "",
    addr: a ? a.value.trim() : "",
  };
}
function validateDeliveryDetails() {
  const d = getDeliveryDetails();
  if (!d.name || !d.phone || !d.addr) {
    showToast("Please fill your name, phone & address ⚠️");
    return null;
  }
  return d;
}
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

function makeCard(p) {
  return `<div class="prod-card">
    <div class="prod-thumb">${p.icon}${p.badge ? `<span class="prod-badge">${p.badge}</span>` : ""}</div>
    <div class="prod-info"><h3>${p.name}</h3><p>${p.desc}</p></div>
    <div class="prod-price">₹${p.price}</div>
    <div class="prod-actions">
      <button class="prod-cart" onclick="addToCart(${p.id})">🛒 Add</button>
      <button class="prod-buy" onclick="openBuyNow(${p.id})">Buy Now</button>
    </div>
  </div>`;
}
function renderHome() {
  const g = document.getElementById("home-prod-grid");
  if (g) g.innerHTML = PRODUCTS.slice(0, 4).map(makeCard).join("");
}
function renderShop(f = "all") {
  const g = document.getElementById("shop-prod-grid");
  if (g)
    g.innerHTML = (
      f === "all"
        ? PRODUCTS
        : PRODUCTS.filter((p) => p.category === f || p.category === "all")
    )
      .map(makeCard)
      .join("");
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

/* ===== CART ===== */
function addToCart(id) {
  const p = PRODUCTS.find((x) => x.id === id);
  if (!p) return;
  const ex = cart.find((x) => x.id === id);
  ex ? ex.qty++ : cart.push({ ...p, qty: 1 });
  updateCartCount();
  showToast("Added: " + p.name + " 🛒");
  updatePaySummary();
}
function removeFromCart(id) {
  cart = cart.filter((x) => x.id !== id);
  updateCartCount();
  renderCartModal();
  updatePaySummary();
}
function updateCartCount() {
  document.getElementById("cart-count").textContent = cart.reduce(
    (a, x) => a + x.qty,
    0,
  );
}
function renderCartModal() {
  const c = document.getElementById("cart-items-container"),
    f = document.getElementById("cart-footer");
  if (!cart.length) {
    c.innerHTML =
      '<div class="cart-empty"><span>🛒</span><p>Your bag is empty.<br>Start shopping!</p></div>';
    f.style.display = "none";
    return;
  }
  const total = cart.reduce((a, x) => a + x.price * x.qty, 0);
  c.innerHTML = cart
    .map(
      (p) =>
        `<div class="cart-item"><div class="cart-item-icon">${p.icon}</div><div class="cart-item-info"><h4>${p.name}</h4><p>Qty: ${p.qty} × ₹${p.price}</p></div><span class="cart-item-price">₹${p.price * p.qty}</span><button class="cart-remove" onclick="removeFromCart(${p.id})">✕</button></div>`,
    )
    .join("");
  document.getElementById("cart-total-val").textContent = "₹" + total;
  f.style.display = "block";
}
function handleCheckout() {
  closeModal("cart");
  showPage("payment");
  updatePaySummary();
}
function updatePaySummary() {
  const el = document.getElementById("pay-items-list");
  if (!el) return;
  if (!cart.length) {
    el.innerHTML =
      '<div class="pay-order-item"><span>Cart is empty — <a style="color:#5B27B5;cursor:pointer;" data-page="shop">Go to Shop →</a></span></div>';
    return;
  }
  const total = cart.reduce((a, x) => a + x.price * x.qty, 0);
  const del =
    total >= 499
      ? '<span style="color:#2E7D32;font-weight:600;">FREE</span>'
      : "₹40";
  el.innerHTML =
    cart
      .map(
        (p) =>
          `<div class="pay-order-item"><span>${p.icon} ${p.name} × ${p.qty}</span><span>₹${p.price * p.qty}</span></div>`,
      )
      .join("") +
    `<div class="pay-order-item"><span>🚚 Delivery</span><span>${del}</span></div>` +
    `<div class="pay-order-item"><span>Total Payable</span><span>₹${total + (total >= 499 ? 0 : 40)}</span></div>`;
}

/* ===== BUY NOW ===== */
function openBuyNow(id) {
  buyNowProduct = PRODUCTS.find((x) => x.id === id);
  if (!buyNowProduct) return;
  document.getElementById("buy-product-preview").innerHTML =
    `<div class="buy-product-icon">${buyNowProduct.icon}</div><div><div class="buy-product-name">${buyNowProduct.name}</div><div class="buy-product-price">₹${buyNowProduct.price}</div></div>`;
  openModal("buynow");
}
function handleBuyNow() {
  const name = document.getElementById("buy-name").value.trim(),
    phone = document.getElementById("buy-phone").value.trim(),
    addr = document.getElementById("buy-addr").value.trim();
  if (!name || !phone || !addr) {
    showToast("Please fill all fields ⚠️");
    return;
  }
  const pay = document.getElementById("buy-payment").value;
  const amount = buyNowProduct.price;
  saveOrder({
    product: buyNowProduct,
    name,
    phone,
    addr,
    payment: pay,
    amount,
    date: new Date().toISOString(),
  });
  sendOrderToWhatsApp({
    product: buyNowProduct.name,
    amount,
    method: pay.toUpperCase(),
    name,
    phone,
    addr,
  });
  closeModal("buynow");
  if (["upi", "paytm", "phonepay", "gpay"].includes(pay)) {
    const link = buildUpiLink(amount, "ANNEO Fresh - " + buyNowProduct.name);
    showToast("Opening UPI app for payment... 💳");
    setTimeout(() => {
      window.location.href = link;
    }, 500);
  } else if (pay === "card") {
    showToast(
      "Card payments coming soon — we will contact you to complete payment.",
    );
  } else {
    showToast("Order confirmed for " + buyNowProduct.name + "! 🌿");
  }
}
function saveOrder(order) {
  try {
    const orders = JSON.parse(localStorage.getItem("anneo_orders") || "[]");
    orders.push(order);
    localStorage.setItem("anneo_orders", JSON.stringify(orders));
  } catch (e) {}
}

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

/* ===== AUTH ===== */
function handleLogin() {
  const e = document.getElementById("l-email").value.trim(),
    p = document.getElementById("l-pass").value;
  if (!e || !p) {
    showToast("Please fill all fields ⚠️");
    return;
  }
  try {
    localStorage.setItem("anneo_user", JSON.stringify({ email: e }));
  } catch (x) {}
  showToast("Logged in successfully! 🌿");
  setTimeout(() => closeModal("login"), 600);
}
function handleSignup() {
  const n = document.getElementById("s-name").value.trim(),
    e = document.getElementById("s-email").value.trim(),
    ph = document.getElementById("s-phone").value.trim(),
    p = document.getElementById("s-pass").value;
  if (!n || !e || !ph || !p) {
    showToast("Please fill all fields ⚠️");
    return;
  }
  try {
    localStorage.setItem(
      "anneo_user",
      JSON.stringify({ name: n, email: e, phone: ph }),
    );
  } catch (x) {}
  showToast("Account created! Welcome to ANNEO Fresh 🌿");
  setTimeout(() => closeModal("signup"), 600);
}
function handleContactForm() {
  showToast("Message sent! We will reply shortly 📨");
}
function handleNewsletter() {
  const e = document.getElementById("nl-email").value.trim();
  if (!e) {
    showToast("Please enter your email ⚠️");
    return;
  }
  showToast("Subscribed! Stay Fresh 🌿");
  document.getElementById("nl-email").value = "";
}

/* ===== MODALS ===== */
function openModal(type) {
  if (type === "cart") renderCartModal();
  document.getElementById("modal-" + type).classList.add("open");
  document.body.style.overflow = "hidden";
}
function closeModal(type) {
  document.getElementById("modal-" + type).classList.remove("open");
  document.body.style.overflow = "";
}
function switchModal(f, t) {
  closeModal(f);
  openModal(t);
}
document.querySelectorAll(".modal-overlay").forEach((el) =>
  el.addEventListener("click", function (e) {
    if (e.target === this) closeModal(this.id.replace("modal-", ""));
  }),
);

/* ===== PAGE ROUTER ===== */
function showPage(name) {
  document
    .querySelectorAll(".page")
    .forEach((p) => p.classList.remove("active"));
  const page = document.getElementById("page-" + name);
  if (page) page.classList.add("active");
  document
    .querySelectorAll(".nav-links a[data-page]")
    .forEach((a) => a.classList.toggle("active", a.dataset.page === name));
  document
    .querySelectorAll(".bn-item[data-page]")
    .forEach((b) => b.classList.toggle("active", b.dataset.page === name));
  window.scrollTo({ top: 0, behavior: "smooth" });
  closeMobile();
  if (name === "home") renderHome();
  if (name === "shop") renderShop(currentFilter);
  if (name === "payment") updatePaySummary();
}

/* ===== CLICK DELEGATION ===== */
document.addEventListener("click", function (e) {
  const pg = e.target.closest("[data-page]");
  if (pg) {
    e.preventDefault();
    showPage(pg.dataset.page);
    return;
  }
  const fs = e.target.closest("[data-filter-shop]");
  if (fs) {
    e.preventDefault();
    filterAndGoShop(fs.dataset.filterShop);
    return;
  }
  const wa = e.target.closest("[data-wa]");
  if (wa) {
    e.preventDefault();
    openWAModal();
    return;
  }
});

/* ===== WHATSAPP ===== */
function openWAModal() {
  document.getElementById("modal-wa").classList.add("open");
  document.body.style.overflow = "hidden";
}
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

/* ===== TOAST ===== */
let tt;
function showToast(msg) {
  const t = document.getElementById("toast");
  t.textContent = msg;
  t.classList.add("show");
  clearTimeout(tt);
  tt = setTimeout(() => t.classList.remove("show"), 3200);
}

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

/* ===== INIT ===== */
renderHome();
renderShop("all");
