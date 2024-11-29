<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if (!defined('ABSPATH')) {
  exit();
} ?>
<div class="col-6 text-end">
    <form method="get" class="dropdown">
        <span class="dropdown-toggle btn btn-sm btn-outline-primary" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <?php foreach ($catalog_orderby_options as $id => $name) {
              if ($orderby === $id) {
                echo '<span>' . esc_html($name) . '</span>';
                break;
              }
            } ?>
        </span>
        <div class="border fs-6 border-1 dropdown-menu dropdown-menu-end overflow-hidden p-0 shadow-lg">
            <?php foreach ($catalog_orderby_options as $id => $name) {
              $obj_id = get_queried_object_id();
              if (is_search()) {
                $search_uri = $_SERVER['URI'];
                $search_str = "s=" . $_GET['s'];
                $link = "$search_uri?$search_str&post_type=product";
                $link .= '&orderby=' . esc_attr($id);
              } else {
                $link = $_SERVER['URI'];
                $link .= '?orderby=' . esc_attr($id);
              }
              ?>
            <a class="dropdown-item py-1 px-2 border-bottom" href="<?php echo $link; ?>"
                <?php selected($orderby, $id); ?>>
                <?php echo esc_html($name); ?>
            </a>
            <?php } ?>
        </div>
        <input type="hidden" name="paged" value="1" />
        <?php wc_query_string_form_fields(null, [
          'orderby',
          'submit',
          'paged',
          'product-page',
        ]); ?>
    </form>
</div>
</div>