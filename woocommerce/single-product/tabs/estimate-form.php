<?php
/**
 * Single Estimate form
 *
 */
defined('ABSPATH') || exit();
global $product;
?>
<?php get_template_part('template-parts/contact', 'form', [
  'type' => 'ship',
  'title' => 'Ship Estimate',
  'labels' => true,
  'source' => 'Ship Estimate',
]); ?>