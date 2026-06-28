<!-- ======= PAYMENT PAGE ======= -->
<div class="page" id="page-payment">
  <div class="pay-hero">
    <div class="sec-label" style="color:rgba(255,255,255,.5);justify-content:center;">🔒 Secure Checkout</div>
    <h1>💳 Easy Payment</h1>
    <p>Pay safely via UPI, Paytm, PhonePe, Google Pay or Cash on Delivery</p>
  </div>
  <div class="pay-body-full">
    <div style="max-width:820px;margin:0 auto;">
      <!-- Order Summary -->
      <div class="pay-order-summary">
        <h3>🧾 Order Summary</h3>
        <div id="pay-items-list">
          <div class="pay-order-item"><span>Cart is empty — <a style="color:#5B27B5;cursor:pointer;" data-page="shop">Go to Shop →</a></span></div>
        </div>
      </div>
      <!-- Delivery Details -->
      <div class="pay-order-summary">
        <h3>🚚 Delivery Details</h3>
        <input type="text" class="pay-input" id="pay-cust-name" placeholder="Your Full Name">
        <input type="tel" class="pay-input" id="pay-cust-phone" placeholder="Mobile Number">
        <textarea class="pay-input" id="pay-cust-addr" placeholder="Full Delivery Address with Pincode" style="height:75px;resize:vertical;margin-bottom:0;"></textarea>
      </div>
      <!-- Method Grid -->
      <h3 style="color:var(--forest);margin:1.5rem 0 1rem;font-family:'Playfair Display',serif;">Select Payment Method</h3>
      <div class="pay-methods-grid">
        <div class="pay-method-card" id="pmc-upi" onclick="selectPayMethod('upi',this)"><div class="check">✓</div><span class="pay-icon">📱</span><h4>UPI</h4><p>Any UPI App</p></div>
        <div class="pay-method-card" onclick="selectPayMethod('paytm',this)"><div class="check">✓</div><span class="pay-icon">💙</span><h4>Paytm</h4><p>Paytm Wallet &amp; UPI</p></div>
        <div class="pay-method-card" onclick="selectPayMethod('phonepay',this)"><div class="check">✓</div><span class="pay-icon">💜</span><h4>PhonePe</h4><p>PhonePe App</p></div>
        <div class="pay-method-card" onclick="selectPayMethod('gpay',this)"><div class="check">✓</div><span class="pay-icon">🎨</span><h4>Google Pay</h4><p>GPay UPI</p></div>
        <div class="pay-method-card" onclick="selectPayMethod('card',this)"><div class="check">✓</div><span class="pay-icon">💳</span><h4>Debit/Credit Card</h4><p>Needs payment gateway</p></div>
        <div class="pay-method-card" onclick="selectPayMethod('cod',this)"><div class="check">✓</div><span class="pay-icon">💵</span><h4>Cash on Delivery</h4><p>Pay when you receive</p></div>
      </div>
      <!-- UPI / Paytm / PhonePe / GPay shared panel — all route to the same real UPI ID -->
      <div class="pay-detail-panel" id="panel-upi">
        <h3 id="upi-panel-title">📱 Pay via UPI</h3>
        <div class="upi-id-display">
          <h4>Scan with any UPI app to pay</h4>
          <img id="upi-qr-img" src="" alt="UPI QR Code" width="180" height="180">
          <div class="upi-id-val">UPI ID: <span id="upi-id-text">6206850162-2@axl</span></div>
          <div class="upi-amt" id="upi-amt-text">Amount: ₹0</div>
        </div>
        <button class="pay-btn" id="upi-pay-btn" onclick="processPayment('upi')">🔒 I've Completed the Payment</button>
        <div class="pay-secure">🔒 On mobile, tap the button to open your UPI app directly · On desktop, scan the QR</div>
      </div>
      <!-- Card Panel — honest notice instead of a fake success flow -->
      <div class="pay-detail-panel" id="panel-card">
        <h3>💳 Pay via Debit / Credit Card</h3>
        <p style="font-size:.83rem;color:var(--text-s);margin-bottom:1rem;">Card payments need a licensed payment gateway (Razorpay / PayU / Cashfree) connected to a backend — that isn't set up yet. Please pay via UPI or Cash on Delivery for now.</p>
        <button class="pay-btn" onclick="document.getElementById('pmc-upi').click()">📱 Pay via UPI Instead</button>
      </div>
      <!-- COD Panel -->
      <div class="pay-detail-panel" id="panel-cod">
        <h3>💵 Cash on Delivery</h3>
        <p style="font-size:.83rem;color:var(--text-s);margin-bottom:1rem;">Pay in cash when your order arrives. No advance payment required.</p>
        <button class="pay-btn" style="background:linear-gradient(135deg,var(--forest),var(--forest-m));" onclick="processPayment('cod')">✅ Confirm COD Order</button>
      </div>
      <!-- Success -->
      <div class="pay-success" id="pay-success-box">
        <div class="tick">✅</div>
        <h2>Order Confirmed!</h2>
        <p id="pay-success-msg">Your payment was successful. Thank you for choosing ANNEO Fresh!</p>
        <button class="btn-primary" style="margin-top:1.3rem;" data-page="shop">🛒 Continue Shopping</button>
      </div>
    </div>
  </div>
</div>