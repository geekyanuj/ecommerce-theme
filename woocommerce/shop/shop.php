<!-- ======= SHOP PAGE ======= -->
<div class="page" id="page-shop">
  <div class="shop-header">
    <h1>🛒 Our Shop</h1>
    <p>Premium grocery products — farm fresh, quality assured, delivered fast.</p>
    <div class="shop-filters">
      <button class="filter-btn active" onclick="filterProducts('all',this)">All Products</button>
      <button class="filter-btn" onclick="filterProducts('flour',this)">Flour &amp; Atta</button>
      <button class="filter-btn" onclick="filterProducts('pulses',this)">Pulses</button>
      <button class="filter-btn" onclick="filterProducts('spices',this)">Spices</button>
      <button class="filter-btn" onclick="filterProducts('rice',this)">Rice</button>
      <button class="filter-btn" onclick="filterProducts('organic',this)">Organic</button>
      <button class="filter-btn" onclick="filterProducts('dryfruits',this)">Dry Fruits</button>
    </div>
  </div>
  <div class="shop-grid" id="shop-prod-grid"></div>
</div>