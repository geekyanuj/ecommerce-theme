
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










// new 
// const cart = JSON.parse(localStorage.getItem("cart") || "[]");

// fetch(ajaxurl,{
//     method:"POST",
//     body:new URLSearchParams({
//         action:"anneo_sync_cart",
//         cart:JSON.stringify(cart)
//     })
// }).then(()=>{

//     window.location="/checkout";

// });