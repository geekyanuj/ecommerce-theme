<div class="modal-overlay" id="modal-buynow">
    <div class="modal-box">
        <button id="close-btn" class="modal-close">✕</button>
        <h2>⚡ Quick Buy</h2>
        <div id="buy-product-preview"
            style="display:flex;align-items:center;gap:1rem;background:var(--cream2);border-radius:14px;padding:1rem;margin-bottom:1.2rem;">
        </div>
        <div class="modal-field"><label>Full Name</label><input type="text" id="buy-name" placeholder="Your name"></div>
        <div class="modal-field"><label>Mobile Number</label><input type="tel" id="buy-phone"
                placeholder="+91 XXXXX XXXXX">
        </div>
        <div class="modal-field"><label>Delivery Address</label><textarea id="buy-addr"
                placeholder="Full delivery address with pincode..."></textarea></div>
        <div class="modal-field"><label>Payment Method</label>
            <select id="buy-payment">
                <option value="upi">UPI</option>
                <option value="paytm">Paytm</option>
                <option value="phonepay">PhonePe</option>
                <option value="gpay">Google Pay</option>
                <option value="card">Debit / Credit Card</option>
                <option value="cod">Cash on Delivery</option>
            </select>
        </div>
        <button class="modal-btn" onclick="handleBuyNow()">Confirm Order ✅</button>
    </div>
</div>