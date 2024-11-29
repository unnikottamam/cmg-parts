<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit();
global $product;

if (!$product_attributes) {
  return;
} ?>
<table class="border table table-striped table">
    <?php
    $counter = 0;
    foreach ($product_attributes as $key => $attribute ) {
      $counter++;
      $lastClass = count($product_attributes) === $counter ? "border-bottom-0" : "";
      ?>
    <tr class="fs-6 attributes-item--<?php echo esc_attr($key); ?>">
        <th class="<?php echo $lastClass; ?>"><?php echo wp_kses_post($attribute['label']); ?></th>
        <td class="border-start <?php echo $lastClass; ?>">
            <?php
            if ($key == 'weight' && $product->get_date_created() < strtotime(2021 - 03 - 24)) {
              echo round(wc_get_weight($product->get_weight(), 'kg', 'lbs'), 2) . " lbs";
            } else {
              echo wp_kses_post($attribute['value']);
            } ?>
        </td>
    </tr>
    <?php } ?>
</table>