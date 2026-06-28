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