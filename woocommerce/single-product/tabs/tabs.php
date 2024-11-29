<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if (!defined('ABSPATH')) {
  exit();
}

global $product;
$product_tabs = apply_filters('woocommerce_product_tabs', []);
$quantity = $product->get_stock_quantity() ?: 0;
if (!empty($product_tabs)) { ?>
<div class="pt-2">
    <div class="border-top d-flex flex-wrap tab-btns" role="tablist">
        <?php
        $count = 0;
        foreach ($product_tabs as $key => $product_tab) {
          $count++; ?>
        <button
            class="btn tab-btn px-1 px-md-2 text-uppercase fw-medium fs-6 rounded-0 d-flex column-gap-1 <?php echo $count === 1 ? "border-secondary bg-secondary-subtle fw-bold text-primary bg-gradient" : ""; ?>"
            data-toggle="tab" data-tab="tab-<?php echo esc_attr($key); ?>">
            <?php
            echo wp_kses_post(apply_filters(
              'woocommerce_product_' . $key . '_tab_title',
              $product_tab['title'],
              $key
            )); ?>
        </button>
        <?php }
        $count++;
        if ($quantity) { ?>
        <button class="btn px-1 px-md-2 text-danger text-uppercase fw-medium fs-6 rounded-0 d-flex column-gap-1"
            data-bs-toggle="modal" data-bs-target="#shippingModal">
            Ship Estimate
            <svg width="16" height="16" viewBox="0 0 16 16">
                <path
                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
            </svg>
        </button>
        <?php } else { ?>
        <button
            class="btn tab-btn px-1 px-md-2 text-uppercase fw-medium fs-6 rounded-0 d-flex column-gap-1 <?php echo $count === 1 ? "border-secondary bg-secondary-subtle fw-bold text-primary bg-gradient" : ""; ?>"
            data-toggle="tab" data-tab="tab-similar">
            Similar Machines
            <svg width="16" height="16" viewBox="0 0 16 16">
                <path
                    d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
            </svg>
        </button>
        <?php } ?>
    </div>
    <div id="prodMain" class="border-top">
        <div class="row">
            <div class="col <?php echo !$quantity ? 'order-2' : ''; ?>">
                <div class="position-relative h-100 p<?php echo $quantity ? 'e' : 's'; ?>-md-3 pt-2 pb-md-3 pb-2">
                    <div
                        class="border-end d-none d-md-block position-absolute h-100 top-0 <?php echo $quantity ? 'end' : 'start'; ?>-0">
                    </div>
                    <div
                        class="border-top d-block d-md-none position-absolute w-100 start-0 <?php echo $quantity ? 'bottom' : 'top'; ?>-0">
                    </div>
                    <?php
                    $count = 0;
                    foreach ($product_tabs as $key => $product_tab) {
                      $count++; ?>
                    <div class="tab-content <?php echo $count === 1 ? "" : "d-none"; ?>"
                        id="tab-<?php echo esc_attr($key); ?>" role="tabpanel"
                        aria-labelledby="tab-title-<?php echo esc_attr($key); ?>">
                        <?php if (isset($product_tab['callback'])) {
                          call_user_func($product_tab['callback'], $key, $product_tab);
                        } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-5 pt-2 pb-3">
                <h2 class='h5 mb-1 text-success pb-1'>
                    <?php echo $quantity ? "Make An Offer" : "Out of stock?"; ?>
                </h2>
                <?php
                echo $quantity ? "" : '<p>We have similar machines in used Woodworking Machines, Contact our <strong class="text-primary border-bottom">used machienery experts</strong> for more details.</p>';
                get_template_part('template-parts/contact', 'form', [
                  'random' => rand(0, 99),
                  'type' => !$quantity ? 'out-of-stock' : 'offer',
                  'source' => !$quantity ? 'Out of Stock' : 'Price Offer'
                ]); ?>
                <button type="button" class="form_submit btn btn-outline-success shadow-lg d-flex column-gap-2 mt-2">
                    <svg width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z" />
                        <path
                            d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686" />
                    </svg>
                    SUBMIT
                </button>
            </div>
        </div>
    </div>
    <?php
    $count++;
    if (!$quantity) { ?>
    <div class="border-top pt-2 pb-3 tab-content <?php echo $count === 1 ? "" : "d-none"; ?>" id="tab-similar"
        role="tabpanel" aria-labelledby="tab-title-similar">
        <?php
        $cats = wc_get_product_terms(
          $product->get_id(),
          'product_cat',
          apply_filters('woocommerce_breadcrumb_product_terms_args', [
            'orderby' => 'parent',
            'order' => 'DESC',
          ])
        );
        if ($cats) {
          echo do_shortcode(
            '[related-products id="' . $cats[0]->term_id . '"]'
          );
        } ?>
    </div>
    <?php }
    do_action('woocommerce_product_after_tabs'); ?>
</div>
<?php }