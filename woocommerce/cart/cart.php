<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit(); ?>

<div class="accountcont mb-3 cartwrap">
    <?php do_action('woocommerce_before_cart'); ?>
    <div class="row justify-content-between align-items-start cartwrap--row">
        <div class="col-12">
            <form class="woocommerce-cart-form shopcart" action="<?php echo esc_url(
              wc_get_cart_url()
            ); ?>" method="post">
                <?php do_action('woocommerce_before_cart_table'); ?>
                <table class="table table-striped border table-hover cart woocommerce-cart-form__contents">
                    <thead class="thead-primary">
                        <tr>
                            <th class="product-thumbnail d-none d-sm-table-cell">&nbsp;</th>
                            <th class="product-name">
                                <?php esc_html_e('Product', 'woocommerce'); ?>
                            </th>
                            <th class="product-price d-none d-xl-table-cell">
                                <?php esc_html_e('Price', 'woocommerce'); ?>
                            </th>
                            <th class="product-quantity d-none d-xl-table-cell">
                                <?php esc_html_e('Quantity', 'woocommerce'); ?>
                            </th>
                            <th class="product-subtotal d-none d-xl-table-cell">
                                <?php esc_html_e('Subtotal', 'woocommerce'); ?>
                            </th>
                            <th class="product-remove">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do_action('woocommerce_before_cart_contents'); ?>
                        <?php foreach (
                          WC()->cart->get_cart()
                          as $cart_item_key => $cart_item
                        ) {
                          $_product = apply_filters(
                            'woocommerce_cart_item_product',
                            $cart_item['data'],
                            $cart_item,
                            $cart_item_key
                          );
                          $product_id = apply_filters(
                            'woocommerce_cart_item_product_id',
                            $cart_item['product_id'],
                            $cart_item,
                            $cart_item_key
                          );

                          if (
                            $_product &&
                            $_product->exists() &&
                            $cart_item['quantity'] > 0 &&
                            apply_filters(
                              'woocommerce_cart_item_visible',
                              true,
                              $cart_item,
                              $cart_item_key
                            )
                          ) {
                            $product_permalink = apply_filters(
                              'woocommerce_cart_item_permalink',
                              $_product->is_visible()
                                ? $_product->get_permalink($cart_item)
                                : '',
                              $cart_item,
                              $cart_item_key
                            ); ?>
                        <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(
                          apply_filters(
                            'woocommerce_cart_item_class',
                            'cart_item',
                            $cart_item,
                            $cart_item_key
                          )
                        ); ?>">
                            <td class="product-thumbnail d-none d-sm-table-cell">
                                <?php
                                $thumbnail = apply_filters(
                                  'woocommerce_cart_item_thumbnail',
                                  $_product->get_image(),
                                  $cart_item,
                                  $cart_item_key
                                );

                                if (!$product_permalink) {
                                  echo $thumbnail;
                                } else {
                                  printf(
                                    '<a class="d-inline-flex w-25" href="%s">%s</a>',
                                    esc_url($product_permalink),
                                    $thumbnail
                                  );
                                }
                                ?>
                            </td>
                            <td class="product-name" data-title="<?php esc_attr_e(
                              'Product',
                              'woocommerce'
                            ); ?>">
                                <?php
                                if (!$product_permalink) {
                                  echo wp_kses_post(
                                    apply_filters(
                                      'woocommerce_cart_item_name',
                                      $_product->get_name(),
                                      $cart_item,
                                      $cart_item_key
                                    ) . '&nbsp;'
                                  );
                                } else {
                                  echo wp_kses_post(
                                    apply_filters(
                                      'woocommerce_cart_item_name',
                                      sprintf(
                                        '<a href="%s">%s</a>',
                                        esc_url($product_permalink),
                                        $_product->get_name()
                                      ),
                                      $cart_item,
                                      $cart_item_key
                                    )
                                  );
                                }

                                do_action(
                                  'woocommerce_after_cart_item_name',
                                  $cart_item,
                                  $cart_item_key
                                );

                                echo wc_get_formatted_cart_item_data(
                                  $cart_item
                                );

                                if (
                                  $_product->backorders_require_notification() &&
                                  $_product->is_on_backorder(
                                    $cart_item['quantity']
                                  )
                                ) {
                                  echo wp_kses_post(
                                    apply_filters(
                                      'woocommerce_cart_item_backorder_notification',
                                      '<p class="backorder_notification">' .
                                        esc_html__(
                                          'Available on backorder',
                                          'woocommerce'
                                        ) .
                                        '</p>',
                                      $product_id
                                    )
                                  );
                                }
                                ?>

                                <div class="d-block d-xl-none">
                                    <div class="cart__data mt-1">
                                        <div class="cart__datatitle"><?php esc_html_e(
                                          'Price',
                                          'woocommerce'
                                        ); ?></div>
                                        <?php echo apply_filters(
                                          'woocommerce_cart_item_price',
                                          WC()->cart->get_product_price(
                                            $_product
                                          ),
                                          $cart_item,
                                          $cart_item_key
                                        ); ?>
                                    </div>
                                </div>

                                <div class="d-block d-xl-none">
                                    <div class="cart__data">
                                        <div class="cart__datatitle"><?php esc_html_e(
                                          'Quantity',
                                          'woocommerce'
                                        ); ?></div>
                                        <?php
                                        if ($_product->is_sold_individually()) {
                                          $product_quantity = sprintf(
                                            '1 <input type="hidden" name="cart[%s][qty]" value="1" />',
                                            $cart_item_key
                                          );
                                        } else {
                                          $product_quantity = woocommerce_quantity_input(
                                            [
                                              'input_name' => "cart[{$cart_item_key}][qty]",
                                              'input_value' =>
                                                $cart_item['quantity'],
                                              'max_value' => $_product->get_max_purchase_quantity(),
                                              'min_value' => '0',
                                              'product_name' => $_product->get_name(),
                                              'classes' =>
                                                'form-control form-control-sm',
                                            ],
                                            $_product,
                                            false
                                          );
                                        }

                                        echo apply_filters(
                                          'woocommerce_cart_item_quantity',
                                          $product_quantity,
                                          $cart_item_key,
                                          $cart_item
                                        );
                                        ?>
                                    </div>
                                </div>

                                <div class="d-block d-xl-none">
                                    <div class="cart__data">
                                        <div class="cart__datatitle"><?php esc_attr_e(
                                          'Subtotal',
                                          'woocommerce'
                                        ); ?></div>
                                        <?php echo apply_filters(
                                          'woocommerce_cart_item_subtotal',
                                          WC()->cart->get_product_subtotal(
                                            $_product,
                                            $cart_item['quantity']
                                          ),
                                          $cart_item,
                                          $cart_item_key
                                        ); ?>
                                    </div>
                                </div>
                            </td>

                            <td class="product-price d-none d-xl-table-cell" data-title="<?php esc_attr_e(
                              'Price',
                              'woocommerce'
                            ); ?>">
                                <?php echo apply_filters(
                                  'woocommerce_cart_item_price',
                                  WC()->cart->get_product_price($_product),
                                  $cart_item,
                                  $cart_item_key
                                ); ?>
                            </td>
                            <td class="product-quantity d-none d-xl-table-cell" data-title="<?php esc_attr_e(
                              'Quantity',
                              'woocommerce'
                            ); ?>">
                                <?php
                                if ($_product->is_sold_individually()) {
                                  $product_quantity = sprintf(
                                    '1 <input type="hidden" name="cart[%s][qty]" value="1" />',
                                    $cart_item_key
                                  );
                                } else {
                                  $product_quantity = woocommerce_quantity_input(
                                    [
                                      'input_name' => "cart[{$cart_item_key}][qty]",
                                      'input_value' => $cart_item['quantity'],
                                      'max_value' => $_product->get_max_purchase_quantity(),
                                      'min_value' => '0',
                                      'product_name' => $_product->get_name(),
                                      'classes' =>
                                        'form-control form-control-sm',
                                    ],
                                    $_product,
                                    false
                                  );
                                }

                                echo apply_filters(
                                  'woocommerce_cart_item_quantity',
                                  $product_quantity,
                                  $cart_item_key,
                                  $cart_item
                                );
                                ?>
                            </td>
                            <td class="product-subtotal d-none d-xl-table-cell" data-title="<?php esc_attr_e(
                              'Subtotal',
                              'woocommerce'
                            ); ?>">
                                <?php echo apply_filters(
                                  'woocommerce_cart_item_subtotal',
                                  WC()->cart->get_product_subtotal(
                                    $_product,
                                    $cart_item['quantity']
                                  ),
                                  $cart_item,
                                  $cart_item_key
                                ); ?>
                            </td>
                            <td class="product-remove text-right">
                                <?php echo apply_filters(
                                  'woocommerce_cart_item_remove_link',
                                  sprintf(
                                    '<a href="%s" class="remove shopcart__trash" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></a>',
                                    esc_url(
                                      wc_get_cart_remove_url($cart_item_key)
                                    ),
                                    esc_html__(
                                      'Remove this item',
                                      'woocommerce'
                                    ),
                                    esc_attr($product_id),
                                    esc_attr($_product->get_sku())
                                  ),
                                  $cart_item_key
                                ); ?>
                            </td>
                        </tr>
                        <?php
                          }
                        } ?>
                    </tbody>
                </table>
                <?php do_action('woocommerce_cart_contents'); ?>

                <?php if (wc_coupons_enabled()) { ?>
                <div class="coupon">
                    <label for="coupon_code">
                        <?php esc_html_e('Coupon:', 'woocommerce'); ?>
                    </label>
                    <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="<?php esc_attr_e(
                      'Coupon code',
                      'woocommerce'
                    ); ?>" />
                    <button type="submit" class="btn btn-outline-primary" name="apply_coupon" value="<?php esc_attr_e(
                      'Apply coupon',
                      'woocommerce'
                    ); ?>">
                        <?php esc_attr_e('Apply coupon', 'woocommerce'); ?>
                    </button>
                    <?php do_action('woocommerce_cart_coupon'); ?>
                </div>
                <?php } ?>

                <button type="submit" class="btn btn-outline-primary" name="update_cart" value="<?php esc_attr_e(
                  'Update cart',
                  'woocommerce'
                ); ?>">
                    <?php esc_html_e('Update cart', 'woocommerce'); ?>
                </button>

                <?php do_action('woocommerce_cart_actions'); ?>

                <?php wp_nonce_field(
                  'woocommerce-cart',
                  'woocommerce-cart-nonce'
                ); ?>

                <?php do_action('woocommerce_after_cart_contents'); ?>
                <?php do_action('woocommerce_after_cart_table'); ?>
            </form>
        </div>

        <div class="col-12 pt-3">
            <?php do_action('woocommerce_before_cart_collaterals'); ?>
            <div class="cart-collaterals">
                <?php do_action('woocommerce_cart_collaterals'); ?>
            </div>
        </div>
    </div>
    <?php do_action('woocommerce_after_cart'); ?>
</div>