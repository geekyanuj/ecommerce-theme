<?php
$id = $args['id'] ?? '';
$title = $args['title'] ?? '';
?>

<div class="modal-overlay" id="modal-<?php echo esc_attr($id); ?>">
    <div class="modal-box">

        <button class="modal-close" data-close="<?php echo esc_attr($id); ?>">
            ✕
        </button>

        <?php if ($title): ?>
            <h2><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php
        if (!empty($args['content'])) {
            echo $args['content'];
        }
        ?>

    </div>
</div>