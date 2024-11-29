<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Coast_Machinery
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function coast_machinery_woocommerce_setup()
{
    add_theme_support('woocommerce', [
        'gallery_thumbnail_image_width' => 66,
        'thumbnail_image_width' => 150,
        'single_image_width' => 352,
        'product_grid' => [
            'default_rows' => 3,
            'min_rows' => 1,
            'default_columns' => 4,
            'min_columns' => 1,
            'max_columns' => 6,
        ],
    ]);

    add_filter('loop_shop_per_page', function ($cols) {
        return 20;
    });
}

add_action('after_setup_theme', 'coast_machinery_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function coast_machinery_woocommerce_scripts()
{
    if (function_exists('is_woocommerce')) {
        if (is_woocommerce() || is_cart() || is_checkout()) {
            $font_path = WC()->plugin_url() . '/assets/fonts/';
            $inline_font =
                '@font-face {
			font-family: "star";
			src: url("' .
                $font_path .
                'star.eot");
			src: url("' .
                $font_path .
                'star.eot?#iefix") format("embedded-opentype"),
				url("' .
                $font_path .
                'star.woff") format("woff"),
				url("' .
                $font_path .
                'star.ttf") format("truetype"),
				url("' .
                $font_path .
                'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

            wp_add_inline_style('coast-machinery-woocommerce-style', $inline_font);
        }
    }
}

add_action('wp_enqueue_scripts', 'coast_machinery_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function coast_machinery_woocommerce_active_body_class($classes)
{
    $classes[] = 'woocommerce-active';

    return $classes;
}

add_filter('body_class', 'coast_machinery_woocommerce_active_body_class');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function coast_machinery_woocommerce_related_products_args($args)
{
    $defaults = [
        'posts_per_page' => 5,
        'columns' => 5,
    ];

    $args = wp_parse_args($defaults, $args);

    return $args;
}

add_filter('woocommerce_output_related_products_args', 'coast_machinery_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action(
    'woocommerce_before_main_content',
    'woocommerce_output_content_wrapper',
    10
);
remove_action(
    'woocommerce_after_main_content',
    'woocommerce_output_content_wrapper_end',
    10
);

if (!function_exists('coast_machinery_woocommerce_wrapper_before')) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function coast_machinery_woocommerce_wrapper_before()
    {
        ?>
        <main class="woo_main">
        <?php
    }
}
//add_action('woocommerce_before_main_content','coast_machinery_woocommerce_wrapper_before');

if (!function_exists('coast_machinery_woocommerce_wrapper_after')) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function coast_machinery_woocommerce_wrapper_after()
    {
        ?>
        </main>
        <?php
    }
}
//add_action('woocommerce_after_main_content','coast_machinery_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
 */
// if (function_exists('coast_machinery_woocommerce_header__cart')) {
//   coast_machinery_woocommerce_header__cart();
// }

if (!function_exists('coast_machinery_woocommerce_cart_link_fragment')) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function coast_machinery_woocommerce_cart_link_fragment($fragments)
    {
        ob_start();
        coast_machinery_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter(
    'woocommerce_add_to_cart_fragments',
    'coast_machinery_woocommerce_cart_link_fragment'
);

if (!function_exists('coast_machinery_woocommerce_cart_link')) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function coast_machinery_woocommerce_cart_link()
    {
        ?>
        <a class="cart-contents"
           href="<?php echo esc_url(wc_get_cart_url()); ?>"
           title="<?php esc_attr_e('View your shopping cart', 'coast-machinery'); ?>">
            <?php $item_count_text = sprintf(
            /* translators: number of items in the mini cart. */
                _n(
                    '%d item',
                    '%d items',
                    WC()->cart->get_cart_contents_count(),
                    'coast-machinery'
                ),
                WC()->cart->get_cart_contents_count()
            ); ?>
            <span class="amount">
                <?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?>
            </span>
            <span class="count"><?php echo esc_html($item_count_text); ?></span>
        </a>
        <?php
    }
}

if (!function_exists('coast_machinery_woocommerce_header__cart')) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function coast_machinery_woocommerce_header__cart()
    {
        if (is_cart()) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        } ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr($class); ?>">
                <?php coast_machinery_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = [
                    'title' => '',
                ];

                the_widget('WC_Widget_Cart', $instance); ?>
            </li>
        </ul>
        <?php
    }
}

// Make products without price to prevent to buy
add_filter('woocommerce_is_purchasable', 'catalog_mode_on_for_product', 10, 2);
function catalog_mode_on_for_product($is_purchasable, $product)
{
    if (!$product->get_price()) {
        return false;
    }
    return $is_purchasable;
}

// Update cart count when added to cart
function cart_count_change($fragments)
{
    $fragments['.header__cartnum'] = '<span class="header__cartnum">' .WC()->cart->get_cart_contents_count() .'</span>';
    return $fragments;
}

add_filter('woocommerce_add_to_cart_fragments', 'cart_count_change', 10, 1);

// Check a product in the cart
function woo_in_cart($product_id)
{
    global $woocommerce;
    foreach ($woocommerce->cart->get_cart() as $key => $val) {
        $_product = $val['data'];
        if ($product_id == $_product->id) {
            return true;
        }
    }
    return false;
}

// Woocommerce Breadcrumbs change
add_filter('woocommerce_breadcrumb_defaults', 'cmg_woocommerce_breadcrumbs');
function cmg_woocommerce_breadcrumbs()
{
    return [
        'delimiter' => '<li class="list-inline-item">/</li>',
        'wrap_before' =>
            '<nav aria-label="breadcrumb" class="border-bottom border-success-subtle"><div class="container"><ol class="m-0 py-1 list-inline list-unstyled">',
        'wrap_after' => '</ol></div></nav>',
        'before' => '<li class="list-inline-item fw-medium">',
        'after' => '</li>',
    ];
}

// Change Additional Information tab title
add_filter(
    'woocommerce_product_additional_information_tab_title',
    'cmg_information_tab_title'
);
function cmg_information_tab_title()
{
    return 'More Info';
}

// Change form fields
add_filter('woocommerce_form_field', 'woo_form_field');
function woo_form_field($field)
{
    return preg_replace('#form-row#', 'form-row flex-column form-group', $field);
}

add_filter('woocommerce_form_field', 'woo_form_field_select');
function woo_form_field_select($field)
{
    return preg_replace(
        '#country_select#',
        'country_select form-control',
        $field
    );
}

add_filter('woocommerce_form_field', 'woo_form_field_class');
function woo_form_field_class($field)
{
    return preg_replace('#input-text#', 'form-control', $field);
}

// Make Product SKU mandatory before publish
add_action('woocommerce_admin_process_product_object', 'mandatory_product_sku');
add_action(
    'woocommerce_admin_process_variation_object',
    'mandatory_product_sku'
);
function mandatory_product_sku($product)
{
    if (!$product->get_sku('edit')) {
        $message = "";
        if ($product->get_status('edit') === 'publish') {
            $product->set_status('draft');
            $message .= __('Caution! The SKU field is required.', 'woocommerce');
            $message .= ' ' . __('Product has been saved as "DRAFT".', 'woocommerce');
        }
        WC_Admin_Meta_Boxes::add_error($message);
    }
}

// Remove Out of Stock from Search
add_filter('relevanssi_do_not_index', 'rlv_wc3_hidden_filter', 10, 2);
function rlv_wc3_hidden_filter($block, $post_id)
{
    if (
        has_term(
            ['exclude-from-catalog', 'exclude-from-search', 'outofstock'],
            'product_visibility',
            $post_id
        )
    ) {
        $block = true;
    }
    return $block;
}

// WooCommerce Next and Previous Product Navigation
function machineryProdNav()
{
    $prodId = get_the_ID();
    $nextProd = wc_get_product(get_adjacent_post(false, '', false)->ID);
    $prevProd = wc_get_product(get_adjacent_post(false, '', true)->ID);

    if ($nextProd || $prevProd) {
        echo '<div class="row h6 border-top border-bottom border-primary-subtle mx-md-0 mb-2 py-1"><div class="col-6 py-1">';
        if ($prevProd) {
            echo '<a href="' . get_permalink($prevProd->get_id()) . '" class="d-inline-flex flex-column" title="' . esc_attr($prevProd->get_name()) . '"><span><svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/></svg> Previous</span><span class="d-none d-lg-block">' . $prevProd->get_name() . '</span></a>';
        }
        echo '</div><div class="col-6 text-end py-1">';
        if ($nextProd) {
            echo '<a href="' . get_permalink($nextProd->get_id()) . '" class="d-inline-flex flex-column" title="' . esc_attr($nextProd->get_name()) . '"><span>Next <svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/></svg></span><span class="d-none d-lg-block">' . $nextProd->get_name() . '</span></a>';
        }
        echo '</div></div>';
    } else {
        echo "";
    }
}

add_action('woocommerce_after_single_product', 'machineryProdNav', 25);

// Customize WooCommerce product attributes
function custom_woocommerce_attribute($output, $attribute, $value)
{
    $output = preg_replace('/<\/?p>/', '', $output);
    return $output;
}

add_filter('woocommerce_attribute', 'custom_woocommerce_attribute', 10, 3);

// Customize Price
add_filter('woocommerce_get_price_html', 'custom_woo_price_html', 100, 2);
function custom_woo_price_html($price, $product)
{
    $currentPrice = $product->get_sale_price() ? $product->get_sale_price() : $product->get_regular_price();
    $currentPrice = wc_price($currentPrice);
    $currentPrice = str_replace('woocommerce-Price-currencySymbol', 'fw-normal', $currentPrice);
    return '<span class="border-2 border-bottom text-primary border-primary-subtle fs-5 fw-bold">' . $currentPrice . '</span>';
}

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

add_action('woocommerce_cart_calculate_fees', 'add_payment_processing_fee');
function add_payment_processing_fee()
{
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    $percentage = 2.9;
    $fee = (WC()->cart->cart_contents_total + WC()->cart->shipping_total) * $percentage / 100;
    WC()->cart->add_fee('Payment Processing Fee', $fee);
}