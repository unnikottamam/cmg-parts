<?php
/**
 * Location Content
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

<div class="tab-pane fade locationimg <?php if ($count == 1) {
  echo 'show active';
} ?>" id="tab-location" role="tabpanel" aria-labelledby="tab-title-location">
    <?php
    $location_text = get_field('location')
      ? get_field('location')
      : "CMG Warehouse";
    echo "<span class='location_text'>$location_text</span>";
    $alt = get_field('location') ? get_field('location') : "North America";
    if (
      get_field('location') == 'CMG Warehouse' ||
      get_field('location') == 'canada-bc' ||
      !get_field('location')
    ) { ?>
    <img src="<?php echo get_template_directory_uri(); ?>/img/canada-bc.png"
        alt="Used <?php echo get_the_title(); ?> in <?php echo $alt; ?>">
    <?php } else { ?>
    <img src="<?php echo get_template_directory_uri(); ?>/img/<?php the_field(
  'location'
); ?>.png" alt="Used <?php echo get_the_title(); ?> in <?php echo $alt; ?>">
    <?php }
    ?>
</div>

<?php