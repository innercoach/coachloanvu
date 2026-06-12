<?php
/**
 * index.php — Required WP fallback template.
 * This theme uses custom page templates for all pages.
 * This file handles edge cases (blog, 404, etc.)
 */
get_header(); ?>

<main id="main" role="main">
    <div class="container section">
        <h1>Nội dung không tìm thấy</h1>
        <p>Trang bạn đang tìm kiếm không tồn tại. <a href="<?php echo esc_url(home_url('/')); ?>">Quay về trang chủ</a>.</p>
    </div>
</main>

<?php get_footer();
