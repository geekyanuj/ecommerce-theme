<?php
/*
Template Name: About Page Template
*/
// Rest of your layout code starts here...
get_header();
?>
<div class="about-hero">
  <div class="sec-label" style="color:rgba(255,255,255,.5);justify-content:center;">Our Story</div>
  <h1>About ANNEO Fresh</h1>
  <p>We believe every meal deserves the purest ingredients. From trusted farms to your kitchen, we bring nature's
    goodness — honestly, affordably, and with love.</p>
</div>
<div class="about-content">
  <div class="brand-grid" style="gap:3rem;">
    <div>
      <h2 class="sec-title">Our Mission</h2>
      <p>At ANNEO Fresh, our mission is simple — to make pure, fresh, and natural grocery products accessible to every
        Indian family. We work directly with over 200 trusted farms across India to eliminate middlemen and bring you
        quality you can taste.</p>
      <p>Every product bears the ANNEO seal only after passing through rigorous quality checks. We believe in
        transparent sourcing, honest labeling, and packaging that preserves what nature intended.</p>
      <div class="about-mission">
        <h3>🌿 Our Promise</h3>
        <p>"Pure Ingredients. Honest Quality. Everyday Freshness." — This isn't just a tagline. It is the standard we
          hold ourselves to in every batch, every packet, every delivery.</p>
      </div>
    </div>
    <div>
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-num">10K+</div>
          <div class="stat-lbl">Happy Families</div>
        </div>
        <div class="stat-card">
          <div class="stat-num">50+</div>
          <div class="stat-lbl">Premium Products</div>
        </div>
        <div class="stat-card">
          <div class="stat-num">100%</div>
          <div class="stat-lbl">Quality Assured</div>
        </div>
        <div class="stat-card">
          <div class="stat-num">200+</div>
          <div class="stat-lbl">Trusted Farms</div>
        </div>
      </div>
      <div class="brand-card" style="margin-top:1.5rem;font-size:3.5rem;">🌾
        <p
          style="font-family:'Playfair Display',serif;font-size:1rem;color:var(--forest);margin-top:.8rem;font-weight:600;">
          Farm to Kitchen</p>
        <p style="font-size:.8rem;color:var(--text-s);">Direct sourcing. Zero compromise.</p>
      </div>
    </div>
  </div>
</div>
<div class="cert-detail-section">
  <h2 class="sec-title centered" style="margin-bottom:1.5rem;">Our Certifications</h2>
  <div class="cert-cards">
    <div class="cert-card">
      <div class="cert-card-icon">🏛️</div>
      <h3>FSSAI Certified</h3>
      <p>Compliant with FSSAI food safety standards for safe and hygienic products.</p>
      <div class="cert-num">License No: [Add Your Number]</div>
    </div>
    <div class="cert-card">
      <div class="cert-card-icon">🌐</div>
      <h3>ISO 9001:2015</h3>
      <p>ISO certified quality management system ensuring consistent top-tier quality.</p>
      <div class="cert-num">Cert No: [Add Your Number]</div>
    </div>
    <div class="cert-card">
      <div class="cert-card-icon">🦁</div>
      <h3>Make In India</h3>
      <p>Proudly manufactured in India supporting local farmers and communities.</p>
      <div class="cert-num">Reg. No: [Add Your Number]</div>
    </div>
  </div>
</div>

<?php
get_footer();
?>