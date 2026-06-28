<?php get_header(); ?>



<!-- ======= HOME PAGE ======= -->
<?php get_template_part('template-parts/hero'); ?>

<?php get_template_part('template-parts/certifications'); ?>
<section class="sec reveal">
    <div class="brand-grid">
        <?php get_template_part('template-parts/story'); ?>
        <div style="display:flex;justify-content:center;">
            <div class="brand-card" style="width:100%;max-width:360px;">🌿
                <p
                    style="font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--forest);margin-top:.9rem;font-weight:600;">
                    Farm to Kitchen</p>
                <p style="font-size:.82rem;color:var(--text-s);margin-top:.3rem;">Direct sourcing. Zero compromise.
                </p>
                <div class="brand-promise">"Pure Ingredients. Honest Quality. Everyday Freshness."</div>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('template-parts/categories'); ?>
<section class="sec reveal">
    <div class="centered">
        <div class="sec-label">Our Promise</div>
        <h2 class="sec-title">Freshness You Can <em>Feel</em></h2>
        <p class="sec-sub">Six reasons thousands of families trust ANNEO Fresh every day.</p>
    </div>
    <div class="why-grid">
        <div class="why-card">
            <div class="why-icon">🌱</div>
            <h3>Farm To Kitchen</h3>
            <p>Direct sourcing from trusted farms, zero middlemen.</p>
        </div>
        <div class="why-card">
            <div class="why-icon">📦</div>
            <h3>Premium Packaging</h3>
            <p>Sealed to preserve freshness, aroma and nutrition.</p>
        </div>
        <div class="why-card">
            <div class="why-icon">🔬</div>
            <h3>Quality Assured</h3>
            <p>Every batch rigorously inspected before the ANNEO seal.</p>
        </div>
        <div class="why-card">
            <div class="why-icon">💰</div>
            <h3>Affordable Excellence</h3>
            <p>Premium quality, fair prices — healthy food for all.</p>
        </div>
        <div class="why-card">
            <div class="why-icon">🚚</div>
            <h3>Fast Delivery</h3>
            <p>Quick, reliable doorstep delivery across India.</p>
        </div>
        <div class="why-card">
            <div class="why-icon">💳</div>
            <h3>Easy Payment</h3>
            <p>UPI, Paytm, PhonePe, Cards or COD — your choice.</p>
        </div>
    </div>
</section>
<?php get_template_part('template-parts/featured-products'); ?>
<section class="sec reveal">
    <div class="centered">
        <div class="sec-label">How It Works</div>
        <h2 class="sec-title">Farm To Your Kitchen</h2>
        <p class="sec-sub">Every ANNEO Fresh product follows a strict four-step journey.</p>
    </div>
    <div class="process-row">
        <div class="proc-step">
            <div class="step-circle">🌾</div>
            <h3>Farm Sourcing</h3>
            <p>Direct from trusted farms.</p>
        </div>
        <div class="proc-step">
            <div class="step-circle">🔬</div>
            <h3>Quality Check</h3>
            <p>Tested for purity and freshness.</p>
        </div>
        <div class="proc-step">
            <div class="step-circle">📦</div>
            <h3>Premium Packing</h3>
            <p>Hygienically sealed for goodness.</p>
        </div>
        <div class="proc-step">
            <div class="step-circle">🏠</div>
            <h3>Doorstep Delivery</h3>
            <p>Fast, safe delivery to you.</p>
        </div>
    </div>
</section>
<section class="sec sec-alt reveal">
    <div class="centered">
        <div class="sec-label">Save More</div>
        <h2 class="sec-title">Special Offers On Every Order</h2>
        <p class="sec-sub">More savings, more freshness — every time you shop with us.</p>
    </div>
    <div class="offers-grid">
        <div class="offer-card"><span class="offer-icon">🚚</span>
            <h3>Free Delivery</h3>
            <p>Above ₹499 on all orders.</p>
        </div>
        <div class="offer-card"><span class="offer-icon">🎉</span>
            <h3>First Order Discount</h3>
            <p>Exclusive welcome offer for new customers.</p>
        </div>
        <div class="offer-card"><span class="offer-icon">🎁</span>
            <h3>Combo Savings</h3>
            <p>Save big with our curated combo packs.</p>
        </div>
        <div class="offer-card"><span class="offer-icon">📊</span>
            <h3>Wholesale Pricing</h3>
            <p>Special pricing for bulk and business orders.</p>
        </div>
    </div>
</section>
<section class="sec reveal" style="padding-top:0;padding-bottom:2rem;">
    <div class="dist-wrap">
        <div>
            <div class="sec-label" style="color:var(--gold);">Partner With Us</div>
            <h2>Become A Distributor</h2>
            <p>Grow your business with ANNEO Fresh. Join our expanding partner network across India.</p>
            <a class="btn-gold" href="<?php echo get_permalink(get_page_by_path('contact')); ?>">🤝 Become A Distributor →</a>
        </div>
        <ul class="dist-list">
            <li>Attractive Profit Margins</li>
            <li>Marketing &amp; Brand Support</li>
            <li>Fast &amp; Reliable Product Supply</li>
            <li>Exclusive Distributor Benefits</li>
            <li>Dedicated Account Manager</li>
        </ul>
    </div>
</section>
<?php get_template_part('template-parts/reviews'); ?>
<section class="sec" style="padding-top:1rem;padding-bottom:4rem;">
    <div class="nl-wrap">
        <h2>Stay Fresh, Stay Healthy</h2>
        <p>Get recipes, health tips and exclusive offers in your inbox.</p>
        <div class="nl-form">
            <input type="email" id="nl-email" placeholder="Enter your email address...">
            <button class="btn-primary" onclick="handleNewsletter()" style="white-space:nowrap;">Subscribe
                🌿</button>
        </div>
    </div>
</section>


<?php get_footer(); ?>