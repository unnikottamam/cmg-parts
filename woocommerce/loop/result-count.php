<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.7.0
 */

if (!defined('ABSPATH')) {
  exit();
} ?>
<div class="row align-items-center pb-2">
    <div class="col-6 fs-6 fw-medium">
        <?php if (1 === intval($total)) {
          _e(
            'Showing 1 product',
            'woocommerce'
          );
        } elseif ($total <= $per_page || -1 === $per_page) {
          printf(
            _n(
              'Showing all %d product',
              'Showing all %d products',
              $total,
              'woocommerce'
            ),
            $total
          );
        } else {
          $first = $per_page * $current - $per_page + 1;
          $last = min($total, $per_page * $current);
          printf(
            _nx(
              'Showing %1$d&ndash;%2$d of %3$d product',
              'Showing %1$d&ndash;%2$d of %3$d products',
              $total,
              'with first and last product',
              'woocommerce'
            ),
            $first,
            $last,
            $total
          );
        } ?>
    </div>