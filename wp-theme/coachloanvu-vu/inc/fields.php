<?php
/**
 * Native Custom Fields Engine (zero plugin).
 *
 * Provides ACF-compatible reader functions so existing templates keep working
 * without the ACF plugin. Data is stored in native WordPress post meta:
 *   - Scalar fields      → single meta value (string, or attachment ID for images)
 *   - Repeater fields    → single meta value holding an array of rows
 *   - Global settings    → single site option 'clv_global' (associative array)
 */

defined('ABSPATH') || exit;

/* ============================================================
   Post ID resolver
   ============================================================ */
function clv_resolve_pid($post_id = null) {
    if ($post_id === 'option' || $post_id === 'options') {
        return 'option';
    }
    if (is_numeric($post_id)) {
        return (int) $post_id;
    }
    return get_the_ID() ?: 0;
}

/* ============================================================
   Repeater loop state (flat repeaters; supports nesting via stack)
   ============================================================ */
$GLOBALS['__clv_loop_stack'] = [];

if (!function_exists('have_rows')) {
    /**
     * ACF-compatible have_rows(). Reads a repeater array from post meta.
     */
    function have_rows($selector, $post_id = null) {
        $pid   = clv_resolve_pid($post_id);
        $stack = &$GLOBALS['__clv_loop_stack'];
        $depth = count($stack);
        $top   = $depth ? $stack[$depth - 1] : null;

        // Continuing an already-active loop for the same selector?
        if ($top && $top['selector'] === $selector && $top['pid'] === $pid) {
            if ($top['i'] + 1 < count($top['rows'])) {
                return true;
            }
            array_pop($stack); // loop exhausted
            return false;
        }

        // Begin a new loop.
        $rows = ($pid === 'option')
            ? clv_option_raw($selector)
            : get_post_meta($pid, $selector, true);

        if (!is_array($rows) || empty($rows)) {
            return false;
        }

        $stack[] = [
            'selector' => $selector,
            'pid'      => $pid,
            'rows'     => array_values($rows),
            'i'        => -1,
        ];
        return true;
    }
}

if (!function_exists('the_row')) {
    function the_row() {
        $stack = &$GLOBALS['__clv_loop_stack'];
        $depth = count($stack);
        if (!$depth) {
            return false;
        }
        $stack[$depth - 1]['i']++;
        $row = $stack[$depth - 1];
        return $row['rows'][$row['i']] ?? false;
    }
}

if (!function_exists('get_sub_field')) {
    function get_sub_field($name) {
        $stack = $GLOBALS['__clv_loop_stack'];
        $depth = count($stack);
        if (!$depth) {
            return null;
        }
        $top = $stack[$depth - 1];
        $row = $top['rows'][$top['i']] ?? [];
        return $row[$name] ?? null;
    }
}

if (!function_exists('get_row_index')) {
    function get_row_index() {
        $stack = $GLOBALS['__clv_loop_stack'];
        $depth = count($stack);
        if (!$depth) {
            return 0;
        }
        return $stack[$depth - 1]['i'] + 1;
    }
}

if (!function_exists('get_field')) {
    /**
     * ACF-compatible get_field(). Returns null when empty (so `?:` defaults work).
     */
    function get_field($selector, $post_id = null, $format = true) {
        $pid = clv_resolve_pid($post_id);

        if ($pid === 'option') {
            $value = clv_option_raw($selector);
        } else {
            $value = get_post_meta($pid, $selector, true);
        }

        if ($value === '' || $value === false || $value === null) {
            return null;
        }
        return $value;
    }
}

if (!function_exists('the_field')) {
    function the_field($selector, $post_id = null) {
        echo get_field($selector, $post_id);
    }
}

/* ============================================================
   Global Settings (replaces ACF Options Page) → option 'clv_global'
   ============================================================ */
function clv_global_all(): array {
    $opt = get_option('clv_global', []);
    return is_array($opt) ? $opt : [];
}

function clv_option_raw(string $key) {
    $all = clv_global_all();
    return $all[$key] ?? '';
}
