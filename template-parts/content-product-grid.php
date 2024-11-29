<?php
/**
 * Template part for displaying products horizontal grids
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coast_Machinery
 */

global $product;
$attachment_ids = $product->get_gallery_image_ids();
$hover_image = '';
if ($attachment_ids) {
  $hover = wp_get_attachment_image_src($attachment_ids[0], 'full');
  $hover_image = aq_resize($hover[0], 160, 170, true, true, true);
}
?>

<div class="col-lg-4 col-sm-6 col-12 proditems__box">
    <div class="proditems__inn" data-hover="<?php echo $hover_image; ?>">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <div class="proditems__img">
            <span class="proditems__hover"></span>
            <?php if ($product->get_image_id()) {
              $prod_img = wp_get_attachment_image_url(
                $product->get_image_id(),
                'full'
              );
              $image_thumb = aq_resize($prod_img, 160, 170, true, true, true);
              echo '<img width="160" height="170" src="' .
                $image_thumb .
                '" alt="' .
                get_the_title() .
                '" />';
            } else {
              $logo_icon = get_field('logo_icon', 'options');
              echo '<img class="noimage" src="' .
                $logo_icon['url'] .
                '" alt="' .
                get_the_title() .
                '" />';
            } ?>
        </div>
        <div class="proditems__cont">
            <span class="proditems__sku">SKU: <?php echo $product->get_sku(); ?></span>
            <h5><?php the_title(); ?></h5>
            <?php if ($price_html = $product->get_price_html()) {
              echo '<span class="proditems__price">' . $price_html . '</span>';
            } ?>
            <div class="proditems__btns">
                <a data-cart-url="<?php echo wc_get_cart_url(); ?>" href="<?php echo woo_in_cart(
  $product->get_id()
)
  ? wc_get_cart_url()
  : $product->add_to_cart_url(); ?>" class="proditems__link <?php echo $product->is_purchasable() &&
$product->is_in_stock() &&
!woo_in_cart($product->get_id())
  ? 'addtocart'
  : 'cwc_nostock'; ?>">
                    <?php echo woo_in_cart($product->get_id())
                      ? "View Cart"
                      : $product->add_to_cart_text(); ?>
                </a>
            </div>
        </div>
    </div>
</div>