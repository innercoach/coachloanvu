<?php
/**
 * Native "Site Settings" admin page (replaces ACF Options Page).
 * Stores global header/footer/social values in option 'clv_global'.
 */

defined('ABSPATH') || exit;

/** Field schema for the global settings page (grouped by section). */
function clv_global_fields(): array {
    return [
        'Header' => [
            'global_logo_text'    => ['label' => 'Logo (cho phép HTML, dùng <span> cho phần vàng)', 'type' => 'text'],
            'global_nav_cta_label'=> ['label' => 'Nút CTA trên menu',  'type' => 'text'],
            'global_nav_cta_url'  => ['label' => 'Link nút CTA menu',  'type' => 'url'],
        ],
        'Footer' => [
            'global_footer_tagline'   => ['label' => 'Tagline footer', 'type' => 'textarea'],
            'global_footer_copyright' => ['label' => 'Dòng bản quyền',  'type' => 'text'],
        ],
        'Social' => [
            'global_social_facebook'  => ['label' => 'Facebook URL',  'type' => 'url'],
            'global_social_instagram' => ['label' => 'Instagram URL', 'type' => 'url'],
            'global_social_email'     => ['label' => 'Email',         'type' => 'text'],
        ],
    ];
}

add_action('admin_menu', function () {
    add_menu_page(
        'Cài đặt Website',
        'Cài đặt Website',
        'edit_theme_options',
        'clv-site-settings',
        'clv_render_settings_page',
        'dashicons-admin-site-alt3',
        59
    );
});

add_action('admin_init', function () {
    register_setting('clv_global_group', 'clv_global', [
        'type'              => 'array',
        'sanitize_callback' => 'clv_sanitize_global',
        'default'           => [],
    ]);
});

function clv_sanitize_global($input): array {
    $out    = [];
    $fields = clv_global_fields();
    foreach ($fields as $section => $items) {
        foreach ($items as $key => $def) {
            $val = $input[$key] ?? '';
            switch ($def['type']) {
                case 'url':
                    $out[$key] = esc_url_raw(trim($val));
                    break;
                case 'textarea':
                    $out[$key] = sanitize_textarea_field($val);
                    break;
                case 'text':
                default:
                    // Allow limited HTML (e.g. <span> in logo)
                    $out[$key] = wp_kses_post($val);
                    break;
            }
        }
    }
    return $out;
}

function clv_render_settings_page(): void {
    if (!current_user_can('edit_theme_options')) return;
    $values = clv_global_all();
    ?>
    <div class="wrap">
        <h1>Cài đặt Website</h1>
        <p>Các giá trị toàn site dùng cho header, footer và mạng xã hội.</p>
        <form method="post" action="options.php">
            <?php settings_fields('clv_global_group'); ?>
            <?php foreach (clv_global_fields() as $section => $items): ?>
                <h2 style="margin-top:24px;border-bottom:1px solid #ddd;padding-bottom:6px;"><?php echo esc_html($section); ?></h2>
                <table class="form-table" role="presentation"><tbody>
                <?php foreach ($items as $key => $def):
                    $val = $values[$key] ?? ''; ?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($def['label']); ?></label></th>
                        <td>
                            <?php if ($def['type'] === 'textarea'): ?>
                                <textarea id="<?php echo esc_attr($key); ?>" name="clv_global[<?php echo esc_attr($key); ?>]" rows="3" class="large-text"><?php echo esc_textarea($val); ?></textarea>
                            <?php else: ?>
                                <input type="text" id="<?php echo esc_attr($key); ?>" name="clv_global[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($val); ?>" class="regular-text" style="min-width:420px;">
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody></table>
            <?php endforeach; ?>
            <?php submit_button('Lưu cài đặt'); ?>
        </form>
    </div>
    <?php
}
