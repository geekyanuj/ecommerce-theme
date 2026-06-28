<section class="sec sec-alt reveal">
    <div class="centered">
        <div class="sec-label">Top Picks</div>
        <h2 class="sec-title">Customer Favorites</h2>
        <p class="sec-sub">Our most loved products — tried, tested and trusted by families across India.</p>
    </div>
    <div class="prod-grid" id="home-prod-grid">
        <?php

        $featured_ids = wc_get_featured_product_ids();

        $args = array(
            'post_type' => 'product',
            'post__in' => $featured_ids,
            'posts_per_page' => 8,
            'orderby' => 'post__in',
        );

        $query = new WP_Query($args);

        if ($query->have_posts()):

            while ($query->have_posts()):
                $query->the_post();

                get_template_part(
                    'template-parts/product-card',
                    null,
                    [
                        'product' => wc_get_product(get_the_ID())
                    ]
                );
                

            endwhile;

            wp_reset_postdata();

        else:

            echo '<p>No featured products found.</p>';

        endif;
        ?>
    </div>
    <div style="text-align:center;margin-top:2rem;"><a class="btn-primary" href="<?php echo esc_url(get_permalink(get_page_by_path('shop'))); ?>">View All Products →</a>
    </div>
</section>