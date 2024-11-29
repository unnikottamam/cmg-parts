<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.1
 */

if (!defined('ABSPATH')) {
  exit();
}

$total = isset($total) ? $total : wc_get_loop_prop('total_pages');
$current = isset($current) ? $current : wc_get_loop_prop('current_page');
$base = isset($base)
  ? $base
  : esc_url_raw(
    str_replace(
      999999999,
      '%#%',
      remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))
    )
  );
$format = isset($format) ? $format : 'd-none';

if ($total <= 1) {
  return;
}

$links = paginate_links(
  apply_filters('woocommerce_pagination_args', [
    'base' => $base,
    'format' => $format,
    'add_args' => false,
    'current' => max(1, $current),
    'total' => $total,
    'prev_text' =>
      '<svg width="12" height="12" viewBox="0 0 16 16"><path d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/><span class="visually-hidden">Previous</span></svg>',
    'next_text' =>
      '<svg width="12" height="12" viewBox="0 0 16 16"><path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/><span class="visually-hidden">Next</span></svg>',
    'type' => 'array',
    'end_size' => 2,
    'mid_size' => 1,
  ])
);
if ($links) {
  echo '<nav><ul class="list-unstyled d-flex flex-wrap gap-1 pt-3">';
  foreach ($links as $link) {
    $link = str_replace("current", "active", $link);
    echo '<li>'.str_replace("page-numbers", "btn btn-sm btn-outline-primary", $link).'</li>';
  }
  echo '</ul></nav>';
}