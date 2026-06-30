/* ===== CART ===== */
function addToCart(product_id) {
  $.ajax({
    url: anneo.ajax_url,

    type: "POST",

    data: {
      action: "anneo_add_to_cart",

      product_id: product_id,

      quantity: 1,
    },

    success: function (res) {
      renderCart(res.cart);

      updateCartCount(res.count);
    },
  });
}
// function removeFromCart(id) {
//   cart = cart.filter((x) => x.id !== id);
//   updateCartCount();
//   renderCartModal();
//   updatePaySummary();
// }
// function updateCartCount() {
//   document.getElementById("cart-count").textContent = cart.reduce(
//     (a, x) => a + x.qty,
//     0,
//   );
// }
// function renderCartModal() {
//   const c = document.getElementById("cart-items-container"),
//     f = document.getElementById("cart-footer");
//   if (!cart.length) {
//     c.innerHTML =
//       '<div class="cart-empty"><span>🛒</span><p>Your bag is empty.<br>Start shopping!</p></div>';
//     f.style.display = "none";
//     return;
//   }
//   const total = cart.reduce((a, x) => a + x.price * x.qty, 0);
//   c.innerHTML = cart
//     .map(
//       (p) =>
//         `<div class="cart-item"><div class="cart-item-icon">${p.icon}</div><div class="cart-item-info"><h4>${p.name}</h4><p>Qty: ${p.qty} × ₹${p.price}</p></div><span class="cart-item-price">₹${p.price * p.qty}</span><button class="cart-remove" onclick="removeFromCart(${p.id})">✕</button></div>`,
//     )
//     .join("");
//   document.getElementById("cart-total-val").textContent = "₹" + total;
//   f.style.display = "block";
// }

//new


function saveCart() {
  localStorage.setItem("anneo_cart", JSON.stringify(cart));
  renderCart();
  updateCartCount();
}

function renderCart() {
  const container = document.getElementById("cart-items-container");
  const footer = document.getElementById("cart-footer");
  const totalEl = document.getElementById("cart-total-val");

  if (!container) return;

  container.innerHTML = "";

  if (cart.length === 0) {
    container.innerHTML = `
            <div class="cart-empty">
                <h3>Your bag is empty 🛒</h3>
                <p>Add some delicious products.</p>
            </div>
        `;

    footer.style.display = "none";
    return;
  }

  let total = 0;

  cart.forEach((item, index) => {
    total += item.price * item.qty;

    container.insertAdjacentHTML(
      "beforeend",
      `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}">

                <div class="cart-info">
                    <h4>${item.name}</h4>
                    <small>₹${item.price}</small>

                    <div class="cart-qty">
                        <button class="qty-minus" data-index="${index}">−</button>

                        <span>${item.qty}</span>

                        <button class="qty-plus" data-index="${index}">+</button>
                    </div>
                </div>

                <div class="cart-right">
                    <strong>₹${item.price * item.qty}</strong>

                    <button class="cart-remove" data-index="${index}">
                        ✕
                    </button>
                </div>
            </div>
            `,
    );
  });

  footer.style.display = "block";
  totalEl.textContent = `₹${total}`;
}

// quntity change and remove item
document.addEventListener("click", (e) => {
  if (e.target.matches(".qty-plus")) {
    cart[e.target.dataset.index].qty++;
    saveCart();
  }

  if (e.target.matches(".qty-minus")) {
    const i = e.target.dataset.index;

    cart[i].qty--;

    if (cart[i].qty <= 0) cart.splice(i, 1);

    saveCart();
  }

  if (e.target.matches(".cart-remove")) {
    cart.splice(e.target.dataset.index, 1);
    saveCart();
  }
});

//update cart count
function updateCartCount() {
  const count = cart.reduce((t, item) => t + item.qty, 0);

  document.getElementById("cart-count").textContent = count;
}

// function to open cart modal
function openCartModal() {
  renderCart();

  document.getElementById("modal-cart").classList.add("open");
}



