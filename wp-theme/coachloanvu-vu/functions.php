<?php
/**
 * Coachloanvu Vu – functions.php
 * Core theme setup: enqueue scripts/styles, native custom fields,
 * site settings, navigation menus, and helper utilities.
 * No external plugins required (native meta boxes + post meta).
 */

defined('ABSPATH') || exit;

/* ============================================================
   0. NATIVE CUSTOM FIELDS ENGINE (zero plugin)
   ============================================================ */
require_once get_template_directory() . '/inc/fields.php';
require_once get_template_directory() . '/inc/field-defs.php';
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/settings-page.php';

/* ============================================================
   1. THEME SETUP
   ============================================================ */
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('responsive-embeds');

    register_nav_menus([
        'primary' => __('Primary Navigation', 'coach-loan-vu'),
        'footer'  => __('Footer Navigation', 'coach-loan-vu'),
    ]);

    load_theme_textdomain('coach-loan-vu', get_template_directory() . '/languages');
});


/* ============================================================
   2. ENQUEUE SCRIPTS & STYLES
   ============================================================ */
// Resource hints for Google Fonts (non-blocking)
add_filter('wp_resource_hints', function ($hints, $relation) {
    if ('preconnect' === $relation) {
        $hints[] = 'https://fonts.googleapis.com';
        $hints[] = ['href' => 'https://fonts.gstatic.com', 'crossorigin'];
    }
    return $hints;
}, 10, 2);

add_action('wp_enqueue_scripts', function () {
    $ver = wp_get_theme()->get('Version');

    // Google Fonts (Philosopher + Be Vietnam Pro + Playfair Display for dv3 luxury)
    wp_enqueue_style(
        'clv-fonts',
        'https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&family=Be+Vietnam+Pro:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap',
        [],
        null
    );

    // Main stylesheet (contains WP theme header – required)
    wp_enqueue_style(
        'clv-main',
        get_stylesheet_uri(),
        ['clv-fonts'],
        $ver
    );

    // Per-page inline CSS is injected via page templates
    // (each service page has its own <style> block kept inline for specificity)

    // Main JS — deferred, in footer (non-render-blocking)
    wp_enqueue_script(
        'clv-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $ver,
        ['in_footer' => true, 'strategy' => 'defer']
    );

    // Pass WP data to JS if needed
    wp_localize_script('clv-main-js', 'clvData', [
        'homeUrl' => esc_url(home_url('/')),
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ]);
});


/* ============================================================
   2b. PERFORMANCE — drop unused core assets on the frontend
   This classic theme renders zero core blocks (page content is
   managed via custom fields), so the block-library CSS, classic
   theme styles and global-styles inline CSS are 100% unused and
   only add render-blocking weight. Pages content is empty so this
   is safe.
   ============================================================ */
add_action('wp_enqueue_scripts', function () {
    if (is_admin()) {
        return;
    }
    // ~60KB of unused block CSS + small classic/global styles
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wp-block-style-variations');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');
    // Per-block on-demand styles / SVG duotone filters (no blocks here)
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
    remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
}, 100);

/* Load Google Fonts without blocking render (print → all on load + noscript fallback). */
add_filter('style_loader_tag', function ($tag, $handle) {
    if ('clv-fonts' !== $handle) {
        return $tag;
    }
    $async = str_replace("media='all'", "media='print' onload=\"this.media='all'\"", $tag);
    return $async . '<noscript>' . $tag . '</noscript>';
}, 10, 2);

/* Preload the LCP hero image (front page + service pages) for faster paint. */
add_action('wp_head', function () {
    $img_id = 0;
    if (is_front_page()) {
        $img_id = (int) get_post_meta(get_the_ID(), 'hero_image', true);
        $fallback = get_template_directory_uri() . '/assets/images/dv3/hero-coach.png';
    } else {
        return; // service pages set their own hero via templates
    }
    if ($img_id) {
        $url = wp_get_attachment_image_url($img_id, 'full');
    } else {
        $url = $fallback ?? '';
    }
    if ($url) {
        printf('<link rel="preload" as="image" href="%s" fetchpriority="high">' . "\n", esc_url($url));
    }
}, 1);


/* ============================================================
   5. HELPER FUNCTIONS
   ============================================================ */

/**
 * Safe ACF get_field() wrapper.
 * Returns $default if ACF is not active or field is empty.
 *
 * @param string $key     ACF field key or name.
 * @param mixed  $post_id Post ID or 'option' for Options page.
 * @param mixed  $default Fallback value.
 * @return mixed
 */
function clv_field(string $key, $post_id = null, $default = '') {
    if (!function_exists('get_field')) {
        return $default;
    }
    $value = get_field($key, $post_id);
    return ($value !== null && $value !== '' && $value !== false) ? $value : $default;
}

/**
 * Safe ACF get_sub_field() wrapper (use inside have_rows loops).
 */
function clv_sub(string $key, $default = '') {
    if (!function_exists('get_sub_field')) {
        return $default;
    }
    $value = get_sub_field($key);
    return ($value !== null && $value !== '' && $value !== false) ? $value : $default;
}

/**
 * Options page field shortcut.
 */
function clv_option(string $key, $default = '') {
    return clv_field($key, 'option', $default);
}

/**
 * Render an ACF image field as <img> tag.
 *
 * @param string|array $image  ACF image array or URL string.
 * @param string       $alt    Alt text fallback.
 * @param string       $class  CSS classes.
 * @param string       $size   WP image size (thumbnail, medium, large, full).
 */
function clv_img($image, string $alt = '', string $class = '', string $size = 'full', string $extra = ''): void {
    if (empty($image)) return;

    if (is_array($image)) {
        // Legacy ACF-style array
        $url    = $image['sizes'][$size] ?? $image['url'] ?? '';
        $srcalt = $image['alt'] ?: $alt;
        $w      = $image['width']  ?? '';
        $h      = $image['height'] ?? '';
    } elseif (is_numeric($image)) {
        // Native: stored as attachment ID
        $att_id = (int) $image;
        $url    = wp_get_attachment_image_url($att_id, $size) ?: wp_get_attachment_url($att_id);
        $meta   = wp_get_attachment_image_src($att_id, $size);
        $w      = $meta[1] ?? '';
        $h      = $meta[2] ?? '';
        $altmeta = get_post_meta($att_id, '_wp_attachment_image_alt', true);
        $srcalt = $altmeta ?: $alt;
    } else {
        // Plain URL string
        $url    = $image;
        $srcalt = $alt;
        $w = $h = '';
    }

    if (empty($url)) return;

    $dimensions = ($w && $h) ? " width=\"{$w}\" height=\"{$h}\"" : '';
    $classattr  = $class ? " class=\"{$class}\"" : '';
    echo "<img src=\"" . esc_url($url) . "\" alt=\"" . esc_attr($srcalt) . "\"{$classattr}{$dimensions} {$extra}>";
}

/**
 * Render external URL safely.
 */
function clv_url(string $key, $post_id = null, string $default = '#'): string {
    $val = clv_field($key, $post_id, $default);
    return esc_url($val ?: $default);
}

/**
 * Output escaped text field.
 */
function clv_e(string $key, $post_id = null, string $default = ''): void {
    echo esc_html(clv_field($key, $post_id, $default));
}

/**
 * Output raw (WYSIWYG) field.
 */
function clv_html(string $key, $post_id = null, string $default = ''): void {
    echo wp_kses_post(clv_field($key, $post_id, $default));
}


/* ── BUNDLED THEME IMAGES ───────────────────────────────────────────────────
 * Images are included in assets/images/ inside the theme folder so the site
 * works out of the box without requiring the client to upload anything first.
 * The client can still override images via ACF fields at any time.
 * ──────────────────────────────────────────────────────────────────────────── */

/**
 * Return the absolute URL to a bundled theme image.
 *
 * @param string $path  Relative path inside assets/images/, e.g. 'dv1/hero-coach.png'
 * @return string
 */
function clv_theme_img_url(string $path): string {
    return get_template_directory_uri() . '/assets/images/' . ltrim($path, '/');
}

/**
 * Render an ACF image field with automatic fallback to a bundled theme image.
 *
 * @param string $key           ACF field key.
 * @param mixed  $post_id       Post ID or null.
 * @param string $fallback_path Relative path inside assets/images/ used when ACF field is empty.
 * @param string $alt           Alt text.
 * @param string $class         CSS class(es).
 * @param string $extra         Extra HTML attributes (e.g. loading="lazy").
 */
function clv_img_f(
    string $key,
    $post_id,
    string $fallback_path,
    string $alt   = '',
    string $class = '',
    string $extra = ''
): void {
    $image = clv_field($key, $post_id);

    if ($image) {
        clv_img($image, $alt, $class, 'full', $extra);
    } else {
        // Use bundled theme image
        $url        = clv_theme_img_url($fallback_path);
        $classattr  = $class ? " class=\"{$class}\"" : '';
        echo "<img src=\"" . esc_url($url) . "\" alt=\"" . esc_attr($alt) . "\"{$classattr} {$extra}>";
    }
}


/* ============================================================
   6. NAV ACTIVE CLASS FIX
   Add 'active' class alongside WP's 'current-menu-item'.
   ============================================================ */
add_filter('nav_menu_css_class', function ($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
    return $classes;
}, 10, 2);


/* ============================================================
   7. REMOVE WP CLUTTER FROM <HEAD>
   ============================================================ */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


/* ============================================================
   8. CONTACT FORM 7 – REMOVE AUTO P TAGS
   ============================================================ */
add_filter('wpcf7_autop_or_not', '__return_false');


/* ============================================================
   9. IMAGE SIZES
   ============================================================ */
add_image_size('clv-hero',        900, 900, false);
add_image_size('clv-card',        600, 500, true);
add_image_size('clv-testimonial', 480, 600, true);
add_image_size('clv-avatar',      120, 120, true);
