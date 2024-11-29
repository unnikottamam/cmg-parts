<?php
/**
 * Location Tab Item
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if (!defined('ABSPATH')) {
  exit();
}

global $product;
?>
<li class="nav-item nav-item_tab" id="tab-title-location" role="tab" aria-controls="tab-location">
    <a class="nav-link <?php if ($count == 1) {
      echo 'show active';
    } ?>" data-toggle="tab" href="#tab-location">Location</a>
</li>
<?php