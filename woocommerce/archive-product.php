<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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

get_header('shop');
do_action('woocommerce_before_main_content');
?>
<section class="pt-2 pb-3 pt-md-3 pb-md-4">
    <div class="container">
        <?php if (apply_filters('woocommerce_show_page_title', true)) { ?>
        <h1 class="fs-3 mb-1"><?php echo woocommerce_page_title(); ?></h1>
        <?php }
        do_action('woocommerce_archive_description');
        if (woocommerce_product_loop()) {
          do_action('woocommerce_before_shop_loop');
          woocommerce_product_loop_start();
          if (wc_get_loop_prop('total')) {
            while (have_posts()) {
              the_post();
              do_action('woocommerce_shop_loop');
              get_template_part('woocommerce/content', 'product');
            }
          }
          woocommerce_product_loop_end();
          do_action('woocommerce_after_shop_loop');
        } else {
          do_action('woocommerce_no_products_found');
        } ?>
    </div>
</section>
<?php
do_action('woocommerce_after_main_content');
get_footer('shop');