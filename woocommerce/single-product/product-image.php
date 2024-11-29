<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit();
if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;
$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$attachIds = $product->get_gallery_image_ids();
$prodImg = wp_get_attachment_image_src($product->get_image_id(), 'full');
?>
<div class="machinery__gallery text-center position-sticky">
    <figure class="d-block m-0 pb-1">
        <?php if ($prodImg) {
            $prodImgLg = aq_resize($prodImg[0], 352, 352, true, true, true);
            $prodAlt = get_post_meta($product->get_image_id(), '_wp_attachment_image_alt', true);
            $zoomImage = aq_resize($prodImg[0], 840, 840, true, true, true);
        ?>
            <a id="zoom-container" data-zoom="<?php echo $zoomImage; ?>" data-index="0"
                class="gallery-item d-flex overflow-hidden border rounded-top-4 border-1 border-secondary"
                href="<?php echo $prodImg[0]; ?>">
                <img id="zoom-image" src="<?php echo $prodImgLg; ?>"
                    alt="<?php echo $prodAlt ? $prodAlt : 'Used ' . $product->get_name(); ?>" loading="lazy" class="w-100"
                    title="<?php echo $prodAlt ? $prodAlt : 'Used ' . $product->get_name(); ?>" width="352" height="352">
            </a>
        <?php } ?>
    </figure>
    <div class="row justify-content-center m-0 machinery__thumbs">
        <?php
        $thumb = wp_get_attachment_image_src($product->get_image_id(), 'woocommerce_gallery_thumbnail');
        if ($thumb) {
            echo '<a data-index="0" class="gallery-item col p-0 border border-1 border-secondary" href="' . $prodImg[0] . '">'; ?>
            <img src="<?php echo $thumb[0]; ?>" alt="<?php echo $prodAlt ? $prodAlt : 'Used ' . $product->get_name(); ?>"
                class="w-100" loading="lazy" title="<?php echo $prodAlt ? $prodAlt : 'Used ' . $product->get_name(); ?>"
                width="66" height="66">
            <?php echo '</a>';
        }
        $count = 0;
        foreach ($attachIds as $attachId) {
            $count++;
            if ($count == 4) { ?>
                <button data-index="<?php echo $count ?>"
                    class="gallery-item bg-opacity-10 bg-secondary border border-1 col h6 m-0 p-0">
                    View <br>More<br>
                    <svg width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                    </svg>
                </button>
            <?php break;
            }
            $thumb = wp_get_attachment_image_src($attachId, 'woocommerce_gallery_thumbnail');
            $alt = get_post_meta($attachId, '_wp_attachment_image_alt', true);
            echo '<a data-index="' . $count . '" class="gallery-item col p-0 border border-1" href="' . wp_get_attachment_image_src($attachId, 'full')[0] . '">';
            ?>
            <img src="<?php echo $thumb[0]; ?>" alt="<?php echo $alt ? $alt : 'Used ' . $product->get_name(); ?>"
                class="w-100" loading="lazy" title="<?php echo $alt ? $alt : 'Used ' . $product->get_name(); ?>" width="66"
                height="66">
        <?php echo '</a>';
        } ?>
    </div>
    <?php if (get_field('youtube_id')) { ?>
        <button data-toggle="modal" data-target="#videoModal" href="#videoModal"
            data-video="<?php the_field('youtube_id'); ?>" class="mt-3 btn btn-outline-primary product__video">
            Watch Video
        </button>
    <?php } ?>
</div>
<div id="pswpGallery" class="pswp d-none" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg opacity-75"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>