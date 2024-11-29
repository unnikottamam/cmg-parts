<?php
/**
 * Product Table Main Actions
 *
 * This file is used to add the table actions before and after a table
 *
 * @link       http://www.wcvendors.com
 * @since      1.2.4
 * @version    1.7.3
 * @package    WCVendors_Pro
 * @subpackage WCVendors_Pro/public/partials/product
 */

$links = paginate_links(
  apply_filters(
    'wcv_product_pagination_args',
    [
      'base' => add_query_arg('paged', '%#%'),
      'format' => '',
      'current' => get_query_var('paged') ? get_query_var('paged') : 1,
      'total' => $this->max_num_pages,
      'prev_next' => true,

      'prev_text' =>
        '<svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>',
      'next_text' =>
        '<svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>',
      'type' => 'array',
    ],
    get_query_var('paged') ? get_query_var('paged') : 1,
    $this->max_num_pages
  )
);
if ($links) {
  echo '<nav aria-label="Navigation"><ul class="pagination">';
  foreach ($links as $link) {
    echo '<li class="page-item">' .
      str_replace("page-numbers", "page-link", $link) .
      '</li>';
  }
  echo '</ul></nav>';
}
?>