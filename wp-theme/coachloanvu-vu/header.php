<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" role="banner">
    <div class="container nav">

        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo" aria-label="<?php bloginfo('name'); ?> – Trang chủ">
            <?php
            $logo_text = clv_option('global_logo_text', 'Coach <span>Loan Vu</span>');
            echo wp_kses_post($logo_text);
            ?>
        </a>

        <!-- Mobile Toggle -->
        <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="primary-nav">
            <span></span><span></span><span></span>
        </button>

        <!-- Primary Navigation -->
        <nav id="primary-nav" class="nav-links" role="navigation" aria-label="Điều hướng chính">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '%3$s', // Output li's directly, no wrapper ul
                    'walker'         => new CLV_Nav_Walker(),
                ]);
            } else {
                // Fallback hardcoded nav
                $current = basename(get_permalink());
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>"
                   class="<?php echo is_front_page() ? 'active' : ''; ?>">Trang chủ</a>
                <a href="<?php echo esc_url(home_url('/#services')); ?>">Dịch vụ</a>
                <a href="<?php echo esc_url(home_url('/passion-to-profit/')); ?>"
                   class="<?php echo is_page('passion-to-profit') ? 'active' : ''; ?>">Passion to Profit</a>
                <a href="<?php echo esc_url(home_url('/business-to-freedom/')); ?>"
                   class="<?php echo is_page('business-to-freedom') ? 'active' : ''; ?>">Business to Freedom</a>
                <a href="<?php echo esc_url(home_url('/business-mastery/')); ?>"
                   class="<?php echo is_page('business-mastery') ? 'active' : ''; ?>">Business Mastery</a>
                <?php
            }
            ?>

            <!-- CTA Button -->
            <?php
            $cta_label = clv_option('global_nav_cta_label', 'Thảo luận chiến lược');
            $cta_url   = clv_option('global_nav_cta_url', home_url('/lien-he/'));
            ?>
            <a href="<?php echo esc_url($cta_url); ?>"
               class="btn btn-primary"
               style="background:var(--gold-accent, #C9A84C); color:#000;">
                <?php echo esc_html($cta_label); ?>
            </a>
        </nav>

    </div>
</header><!-- .site-header -->

<?php
/* ── Custom Nav Walker: strips <ul> wrapper, adds active class ── */
if (!class_exists('CLV_Nav_Walker')) :
class CLV_Nav_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes    = empty($item->classes) ? [] : (array) $item->classes;
        $is_active  = in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes);
        $is_btn     = in_array('nav-cta', $classes);  // custom class for CTA item

        if ($is_btn) {
            $output .= sprintf(
                '<a href="%s" class="btn btn-primary" style="background:var(--gold-accent, #C9A84C);color:#000;">%s</a>',
                esc_url($item->url),
                esc_html($item->title)
            );
        } else {
            $output .= sprintf(
                '<a href="%s" class="%s">%s</a>',
                esc_url($item->url),
                $is_active ? 'active' : '',
                esc_html($item->title)
            );
        }
    }
    // Skip end_el, start_lvl, end_lvl for flat nav
    public function end_el(&$output, $item, $depth = 0, $args = null) {}
    public function start_lvl(&$output, $depth = 0, $args = null) {}
    public function end_lvl(&$output, $depth = 0, $args = null) {}
}
endif;
