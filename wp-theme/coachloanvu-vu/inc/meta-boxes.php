<?php
/**
 * Native meta boxes (zero plugin).
 * Renders per-page custom fields grouped by section, with rich-text (wp_editor),
 * media-library image pickers and a JS-based repeater. Saves to post meta.
 */

defined('ABSPATH') || exit;

/** Resolve which field group applies to a given page. */
function clv_group_for_post($post) {
    if (!$post) return null;
    $groups   = clv_field_groups();
    $tpl      = get_page_template_slug($post->ID);
    $is_front = ((int) get_option('page_on_front') === (int) $post->ID);

    foreach ($groups as $key => $g) {
        $g['key'] = $key;
        $m = $g['match'] ?? [];
        if (!empty($m['front_page']) && $is_front)          return $g;
        if (!empty($m['template']) && $m['template'] === $tpl) return $g;
    }
    return null;
}

/** Register one meta box per section. */
add_action('add_meta_boxes_page', function ($post) {
    $g = clv_group_for_post($post);
    if (!$g) return;

    foreach ($g['sections'] as $si => $section) {
        add_meta_box(
            'clv_sec_' . $g['key'] . '_' . $si,
            '⚙ ' . $section['title'],
            'clv_render_meta_box',
            'page',
            'normal',
            'high',
            ['group' => $g, 'section' => $section]
        );
    }
});

/** Render a section meta box. */
function clv_render_meta_box($post, $box) {
    static $nonce_done = false;
    if (!$nonce_done) {
        wp_nonce_field('clv_save_fields', 'clv_fields_nonce');
        $nonce_done = true;
    }
    $fields = $box['args']['section']['fields'];
    echo '<div class="clv-fields">';
    foreach ($fields as $name => $def) {
        clv_render_field($post->ID, $name, $def);
    }
    echo '</div>';
}

/** Render a single field row. */
function clv_render_field($post_id, $name, $def) {
    $type  = $def['type'] ?? 'text';
    $label = $def['label'] ?? $name;
    $value = get_post_meta($post_id, $name, true);

    echo '<div class="clv-field clv-field-' . esc_attr($type) . '" style="margin:0 0 18px;">';
    if ($type !== 'repeater') {
        echo '<label style="display:block;font-weight:600;margin-bottom:4px;">' . esc_html($label) . '</label>';
    }

    switch ($type) {
        case 'textarea':
            printf('<textarea name="clv[%s]" rows="3" class="large-text">%s</textarea>',
                esc_attr($name), esc_textarea($value));
            break;

        case 'wysiwyg':
            wp_editor($value, 'clv_' . $name, [
                'textarea_name' => 'clv[' . $name . ']',
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny'         => true,
            ]);
            break;

        case 'url':
            printf('<input type="url" name="clv[%s]" value="%s" class="large-text">',
                esc_attr($name), esc_attr($value));
            break;

        case 'image':
            clv_render_image_field($name, $value);
            break;

        case 'select':
            $options = $def['options'] ?? [];
            printf('<select name="clv[%s]">', esc_attr($name));
            foreach ($options as $ov => $ol) {
                printf('<option value="%s"%s>%s</option>',
                    esc_attr($ov), selected($value, $ov, false), esc_html($ol));
            }
            echo '</select>';
            break;

        case 'repeater':
            clv_render_repeater($post_id, $name, $def);
            break;

        case 'text':
        default:
            printf('<input type="text" name="clv[%s]" value="%s" class="large-text">',
                esc_attr($name), esc_attr($value));
            break;
    }

    if (!empty($def['hint'])) {
        echo '<p class="description" style="margin-top:3px;">' . esc_html($def['hint']) . '</p>';
    }
    echo '</div>';
}

/** Image picker (stores attachment ID). */
function clv_render_image_field($name, $value, $input_name = null) {
    $input_name = $input_name ?: 'clv[' . $name . ']';
    $att_id     = (int) $value;
    $url        = $att_id ? wp_get_attachment_image_url($att_id, 'medium') : '';
    ?>
    <div class="clv-image" data-name="<?php echo esc_attr($name); ?>">
        <input type="hidden" class="clv-image-id" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($att_id); ?>">
        <div class="clv-image-preview" style="margin-bottom:6px;">
            <?php if ($url): ?><img src="<?php echo esc_url($url); ?>" style="max-width:160px;height:auto;border:1px solid #ddd;border-radius:4px;display:block;"><?php endif; ?>
        </div>
        <button type="button" class="button clv-image-select">Chọn ảnh</button>
        <button type="button" class="button clv-image-clear"<?php echo $att_id ? '' : ' style="display:none;"'; ?>>Xoá</button>
    </div>
    <?php
}

/** Repeater field (rows of subfields). */
function clv_render_repeater($post_id, $name, $def) {
    $rows     = get_post_meta($post_id, $name, true);
    $rows     = is_array($rows) ? array_values($rows) : [];
    $subfields = $def['subfields'] ?? [];
    $label    = $def['label'] ?? $name;
    ?>
    <div class="clv-repeater" data-name="<?php echo esc_attr($name); ?>">
        <strong style="display:block;margin-bottom:6px;"><?php echo esc_html($label); ?></strong>
        <div class="clv-rep-rows">
            <?php foreach ($rows as $i => $row) {
                clv_render_repeater_row($name, $i, $subfields, $row);
            } ?>
        </div>
        <button type="button" class="button button-secondary clv-rep-add" style="margin-top:6px;">+ Thêm dòng</button>

        <script type="text/html" class="clv-rep-tpl">
            <?php clv_render_repeater_row($name, '__INDEX__', $subfields, []); ?>
        </script>
    </div>
    <?php
}

function clv_render_repeater_row($name, $index, $subfields, $row) {
    echo '<div class="clv-rep-row" style="border:1px solid #e0e0e0;border-radius:6px;padding:12px;margin-bottom:8px;background:#fafafa;position:relative;">';
    echo '<button type="button" class="button-link clv-rep-remove" style="position:absolute;top:8px;right:10px;color:#b32d2e;">✕ Xoá</button>';
    foreach ($subfields as $sname => $sdef) {
        $stype  = $sdef['type'] ?? 'text';
        $slabel = $sdef['label'] ?? $sname;
        $sval   = is_array($row) ? ($row[$sname] ?? '') : '';
        $field_name = sprintf('clv[%s][%s][%s]', $name, $index, $sname);

        echo '<div style="margin:0 0 10px;">';
        echo '<label style="display:block;font-weight:600;margin-bottom:3px;font-size:12px;">' . esc_html($slabel) . '</label>';
        switch ($stype) {
            case 'textarea':
                printf('<textarea name="%s" rows="2" class="large-text">%s</textarea>', esc_attr($field_name), esc_textarea($sval));
                break;
            case 'image':
                clv_render_image_field($name . '_' . $sname, $sval, $field_name);
                break;
            case 'select':
                $options = $sdef['options'] ?? [];
                printf('<select name="%s">', esc_attr($field_name));
                foreach ($options as $ov => $ol) {
                    printf('<option value="%s"%s>%s</option>', esc_attr($ov), selected($sval, $ov, false), esc_html($ol));
                }
                echo '</select>';
                break;
            default:
                printf('<input type="text" name="%s" value="%s" class="large-text">', esc_attr($field_name), esc_attr($sval));
                break;
        }
        echo '</div>';
    }
    echo '</div>';
}

/* ============================================================
   SAVE
   ============================================================ */
add_action('save_post_page', function ($post_id, $post) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['clv_fields_nonce']) || !wp_verify_nonce($_POST['clv_fields_nonce'], 'clv_save_fields')) return;
    if (!current_user_can('edit_page', $post_id)) return;

    $g = clv_group_for_post($post);
    if (!$g) return;

    $posted = $_POST['clv'] ?? [];

    foreach ($g['sections'] as $section) {
        foreach ($section['fields'] as $name => $def) {
            $type = $def['type'] ?? 'text';

            if ($type === 'repeater') {
                $rows_in = $posted[$name] ?? [];
                $rows_out = [];
                if (is_array($rows_in)) {
                    foreach ($rows_in as $row) {
                        if (!is_array($row)) continue;
                        $clean = [];
                        $has   = false;
                        foreach ($def['subfields'] as $sname => $sdef) {
                            $sval = $row[$sname] ?? '';
                            $stype = $sdef['type'] ?? 'text';
                            if ($stype === 'image') {
                                $clean[$sname] = (int) $sval;
                            } elseif ($stype === 'textarea') {
                                $clean[$sname] = wp_kses_post($sval);
                            } else {
                                $clean[$sname] = wp_kses_post($sval);
                            }
                            if (!empty($clean[$sname])) $has = true;
                        }
                        if ($has) $rows_out[] = $clean;
                    }
                }
                if ($rows_out) {
                    update_post_meta($post_id, $name, $rows_out);
                } else {
                    delete_post_meta($post_id, $name);
                }
                continue;
            }

            $val = $posted[$name] ?? '';
            switch ($type) {
                case 'image':
                    $val = (int) $val;
                    break;
                case 'url':
                    $val = esc_url_raw(trim($val));
                    break;
                case 'wysiwyg':
                case 'textarea':
                case 'text':
                default:
                    $val = wp_kses_post($val);
                    break;
            }
            if ($val === '' || $val === 0) {
                delete_post_meta($post_id, $name);
            } else {
                update_post_meta($post_id, $name, $val);
            }
        }
    }
}, 10, 2);

/* ============================================================
   ADMIN ASSETS (media + repeater + image picker JS)
   ============================================================ */
add_action('admin_enqueue_scripts', function ($hook) {
    if (!in_array($hook, ['post.php', 'post-new.php'], true)) return;
    wp_enqueue_media();
    add_action('admin_print_footer_scripts', 'clv_admin_inline_js');
});

function clv_admin_inline_js() {
    ?>
    <script>
    (function($){
        // Image picker
        $(document).on('click', '.clv-image-select', function(e){
            e.preventDefault();
            var wrap = $(this).closest('.clv-image');
            var frame = wp.media({ title:'Chọn ảnh', multiple:false, library:{type:'image'} });
            frame.on('select', function(){
                var att = frame.state().get('selection').first().toJSON();
                var url = (att.sizes && att.sizes.medium) ? att.sizes.medium.url : att.url;
                wrap.find('.clv-image-id').val(att.id);
                wrap.find('.clv-image-preview').html('<img src="'+url+'" style="max-width:160px;height:auto;border:1px solid #ddd;border-radius:4px;display:block;">');
                wrap.find('.clv-image-clear').show();
            });
            frame.open();
        });
        $(document).on('click', '.clv-image-clear', function(e){
            e.preventDefault();
            var wrap = $(this).closest('.clv-image');
            wrap.find('.clv-image-id').val('');
            wrap.find('.clv-image-preview').empty();
            $(this).hide();
        });
        // Repeater add
        $(document).on('click', '.clv-rep-add', function(e){
            e.preventDefault();
            var rep = $(this).closest('.clv-repeater');
            var tpl = rep.find('.clv-rep-tpl').html();
            var idx = 'r' + Date.now();
            rep.find('.clv-rep-rows').append(tpl.replace(/__INDEX__/g, idx));
        });
        // Repeater remove
        $(document).on('click', '.clv-rep-remove', function(e){
            e.preventDefault();
            $(this).closest('.clv-rep-row').remove();
        });
    })(jQuery);
    </script>
    <?php
}
