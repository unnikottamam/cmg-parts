<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit();

global $product;
if (empty($product) || !$product->is_visible()) {
    return;
}

$hoverImg = '';
$attachIds = $product->get_gallery_image_ids();
if ($attachIds) {
    $hover = wp_get_attachment_image_src($attachIds[0], 'full');
    $hoverImg = aq_resize($hover[0], 203, 203, true, true, true);
}

$catName = "";
$terms = get_the_terms($product->get_id(), 'product_cat');
if ($terms && !is_wp_error($terms)) {
    $firstCat = array_shift($terms);
    $catName = $firstCat->name;
} ?>

<div class="col">
    <a href="<?php echo get_permalink($product->get_id()); ?>" class="card h-100 shadow-sm overflow-hidden">
        <div class="text-center position-relative overflow-hidden card__img">
            <div
                class="position-absolute bottom-0 left-0 z-1 bg-primary py-1 px-2 text-white fs-6 rounded-end-pill shadow-lg border-white border-top border-end">
                SKU: <?php echo $product->get_sku(); ?>
            </div>
            <?php
            $prodImg = aq_resize(get_the_post_thumbnail_url(null, 'full'), 203, 203, true, true, true);
            $alt = get_post_meta($product->get_image_id(), '_wp_attachment_image_alt', true) ?: "Used " . $product->get_name();
            echo '<img class="w-100 d-block object-fit-cover" src="' . $prodImg . '" alt="' . $alt . '">';
            echo $hoverImg ? '<img src="' . $hoverImg . '" class="position-absolute bottom-0">' : '';
            ?>
        </div>
        <div class="card-body">
            <?php echo $catName ? '<span class="fs-6">' . $catName . '</span>' : ""; ?>
            <h2 class="fs-5 pt-1 m-0">
                <?php echo $product->get_name(); ?>
            </h2>
        </div>
        <div class="d-flex justify-content-between align-items-center px-2 border-top">
            <div class="w-60 text-success fs-6 border-end py-1">
                <?php
                if ($product->get_price_html()) {
                    $priceContent = wp_strip_all_tags($product->get_price_html());
                    $dollarPos = strpos($priceContent, '$');
                    if ($dollarPos !== false) {
                        $beforeDollar = substr($priceContent, 0, $dollarPos);
                        $afterDollar = substr($priceContent, $dollarPos + 1);
                        echo $beforeDollar . "<br /><span class='fw-bold'>$$afterDollar</span>";
                    } else {
                        echo $priceContent;
                    }
                } ?>
            </div>
            <button type="button" class="btn btn-outline-primary px-2 btn-sm">
                <svg width="16" height="16" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2">
                    </path>
                </svg>
                <span class="d-none d-md-inline-block">View</span>
            </button>
        </div>
    </a>
</div>