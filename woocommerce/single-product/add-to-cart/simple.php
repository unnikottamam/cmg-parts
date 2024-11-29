<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit();

global $product;
if (!$product->is_purchasable()) {
  return;
}

if ($product->is_in_stock()) {
  do_action('woocommerce_before_add_to_cart_form'); ?>
<form class="cart fw-medium"
    action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
    method="post" enctype='multipart/form-data'>
    <?php
    do_action('woocommerce_before_add_to_cart_button');
    do_action('woocommerce_before_add_to_cart_quantity');
    woocommerce_quantity_input([
      'min_value' => apply_filters(
        'woocommerce_quantity_input_min',
        $product->get_min_purchase_quantity(),
        $product
      ),
      'max_value' => apply_filters(
        'woocommerce_quantity_input_max',
        $product->get_max_purchase_quantity(),
        $product
      ),
      'input_value' => isset($_POST['quantity'])
        ? wc_stock_amount(wp_unslash($_POST['quantity']))
        : $product->get_min_purchase_quantity(),
    ]);
    do_action('woocommerce_after_add_to_cart_quantity');
    ?>
    <button type="submit" name="add-to-cart" value="<?php echo esc_attr(
      $product->get_id()
    ); ?>" class="btn btn-outline-primary column-gap-1 d-inline-flex fw-bold rounded-start-pill text-uppercase shadow">
        <?php echo esc_html($product->single_add_to_cart_text()); ?>
        <svg width="16" height="16" viewBox="0 0 16 16">
            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
            <path
                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
        </svg>
    </button>
    <?php do_action('woocommerce_after_add_to_cart_button'); ?>
</form>
<?php do_action('woocommerce_after_add_to_cart_form');
}