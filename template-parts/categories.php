<section class="sec sec-alt reveal">
        <div class="centered">
                <div class="sec-label">Browse All</div>
                <h2 class="sec-title">Shop By Category</h2>
                <p class="sec-sub">Everything your kitchen needs, sourced with care and packed with love.</p>
        </div>
        <div class="cat-grid">


                <?php
                $categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                ));

                if (!empty($categories) && !is_wp_error($categories)):
                        foreach ($categories as $category):

                                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                                ?>

                                <a href="<?php echo esc_url(get_term_link($category)); ?>" class="cat-card" data-page="categories"
                                        data-category="<?php echo esc_attr($category->slug); ?>">

                                        <span class="cat-icon-img">
                                                <?php
                                                if ($thumbnail_id) {
                                                        echo wp_get_attachment_image($thumbnail_id, 'medium', false, array('class' => 'cat-icon-img'));
                                                }
                                                ?>

                                        </span>

                                        <span class="cat-lbl">
                                                <?php echo esc_html($category->name); ?>
                                        </span>

                                </a>

                                <?php
                        endforeach;
                endif;
                ?>

        </div>




</section>