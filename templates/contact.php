
<?php
/*
Template Name: Contact Page Template
*/
// Rest of your layout code starts here...
get_header();
?>
<div class="contact-hero">
  <div class="sec-label" style="color:rgba(255,255,255,.5);justify-content:center;">Get In Touch</div>
  <h1>Contact Us</h1>
  <p>We'd love to hear from you — for orders, partnerships or just a hello!</p>
</div>
<div class="contact-body">
  <div class="contact-form">
    <h2>Send A Message</h2>
    <div class="form-row">
      <div class="form-field"><label>Your Name</label><input type="text" placeholder="Full Name"></div>
      <div class="form-field"><label>Phone Number</label><input type="tel" placeholder="+91 XXXXX XXXXX"></div>
    </div>
    <div class="form-field"><label>Email Address</label><input type="email" placeholder="you@example.com"></div>
    <div class="form-field"><label>Subject</label>
      <select>
        <option>General Inquiry</option>
        <option>Order Issue</option>
        <option>Become a Distributor</option>
        <option>Bulk / Wholesale Inquiry</option>
        <option>Feedback</option>
      </select>
    </div>
    <div class="form-field"><label>Message</label><textarea placeholder="Write your message here..."></textarea></div>
    <button class="btn-primary" style="width:100%;justify-content:center;" onclick="handleContactForm()">Send Message
      📨</button>
  </div>
  <div class="contact-info">
    <div class="info-card">
      <div class="info-icon">📍</div>
      <div>
        <h4>Address</h4>
        <p>Malviya Mohalla, New Delhi, India</p>
      </div>
    </div>
    <div class="info-card">
      <div class="info-icon">📞</div>
      <div>
        <h4>Phone</h4>
        <p>+91 XXXXX XXXXX<br>Mon–Sat · 9AM–7PM</p>
      </div>
    </div>
    <div class="info-card">
      <div class="info-icon">📧</div>
      <div>
        <h4>Email</h4>
        <p>support@anneofresh.com</p>
      </div>
    </div>
    <div class="info-card">
      <div class="info-icon">💬</div>
      <div>
        <h4>WhatsApp</h4>
        <p>Chat with us instantly for orders &amp; queries.</p><button class="btn-primary"
          style="margin-top:.6rem;font-size:.78rem;padding:.48rem 1.1rem;" data-wa="1">Open WhatsApp →</button>
      </div>
    </div>
  </div>
</div>


<?php
get_footer();
?>