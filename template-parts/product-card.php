<?php
$product = $args['product'] ?? null;

if (!$product || !is_a($product, 'WC_Product')) {
    return;
}
?>

<div class="prod-card">

    <div class="prod-thumb">
        <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
            <?php echo $product->get_image('woocommerce_thumbnail'); ?>

            <?php
            $allowed_badges = get_allowed_badge_tags();

            $tags = get_the_terms($product->get_id(), 'product_tag');

            if ($tags && !is_wp_error($tags)) {
                foreach ($tags as $tag) {
                    if (!in_array($tag->slug, $allowed_badges, true)) {
                        continue;
                    }

                    echo '<span class="prod-badge badge-' . esc_attr($tag->slug) . '">';
                    echo esc_html($tag->name);
                    echo '</span>';
                }
            }
            ?>
        </a>
    </div>

    <div class="prod-info">
        <h3>
            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"
                style="text-decoration:none; color:inherit;">
                <?php echo esc_html($product->get_name()); ?>
            </a>
        </h3>

        <p>
            <?php
            echo wp_trim_words(
                $product->get_short_description()
                ?: $product->get_description(),
                12
            );
            ?>
        </p>
    </div>

    <div class="prod-price">
        <?php echo $product->get_price_html(); ?>
    </div>

    <div class="prod-actions">

        <?php
        woocommerce_template_loop_add_to_cart();
        ?>

        <a class="prod-buy btn" href="<?php echo esc_url('?add-to-cart=' . $product->get_id()); ?>">
            Buy Now
        </a>


    </div>

</div>



<!-- <div class="prod-card">
    <div class="prod-thumb">${p.badge ? `<span class="prod-badge">${p.badge}</span>` : ""}</div>
    <div class="prod-info">
        <h3>${p.name}</h3>
        <p>${p.desc}</p>
    </div>
    <div class="prod-price">₹${p.price}</div>
    <div class="prod-actions">
        <button class="prod-cart" onclick="addToCart(${p.id})">🛒 Add</button>
        <button class="prod-buy" onclick="openBuyNow(${p.id})">Buy Now</button>
    </div>
</div> -->