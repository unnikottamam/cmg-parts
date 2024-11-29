<?php
/**
 * No Stock Product Section
 *
 */
defined('ABSPATH') || exit();
global $product;

$cats = wc_get_product_terms(
  $product->get_id(),
  'product_cat',
  apply_filters('woocommerce_breadcrumb_product_terms_args', [
    'orderby' => 'parent',
    'order' => 'DESC',
  ])
);
if ($cats) { ?>
<?php echo do_shortcode('[related-products id="' . $cats[0]->term_id . '"]'); ?>
<hr>
<?php }