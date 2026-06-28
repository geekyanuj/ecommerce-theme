<?php
get_header();

?>

<!-- ======= SHOP PAGE ======= -->
<div class="page" id="page-shop">
    <div class="shop-header">
        <h1>🛒 Our Shop</h1>
        <p>Premium grocery products — farm fresh, quality assured, delivered fast.</p>
        <div class="shop-filters">
            <button class="filter-btn active" onclick="filterProducts('all',this)">All Products</button>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
            ));

            foreach ($categories as $category) {
                echo '<button class="filter-btn" onclick="filterProducts(\'' . esc_attr($category->slug) . '\',this)">' . esc_html($category->name) . '</button>';
            }
            ?>
        </div>
    </div>
    <div class="shop-grid" id="shop-prod-grid">

        <?php
        if (have_posts()):

            while (have_posts()):
                the_post();

                get_template_part(
                    'template-parts/product-card',
                    null,
                    [
                        'product' => wc_get_product(get_the_ID())
                    ]
                );

            endwhile;
            ?>

            <div class="pagination">
                <?php the_posts_pagination(); ?>
            </div>

            <?php
        else:
            echo '<p>No products found.</p>';
        endif;
        ?>

    </div>
</div>

<?php
get_footer();
?>