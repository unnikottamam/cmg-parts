<?php
/**
 * Table template
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.wcvendors.com
 * @since      1.0.0
 *
 * @package    WCVendors_Pro
 * @subpackage WCVendors_Pro/public/partials/helpers/table
 */
?>

<style>
nav[aria-label="Navigation"]:first-child {
    display: none;
}
</style>
<table class="table wcvendors-table wcvendors-table-<?php echo $this->id; ?> wcv-table">
    <?php
    $quick_links = [];
    $products_disabled = wc_string_to_bool(
      get_option('wcvendors_product_management_cap', 'no')
    );
    $add_product_link = WCVendors_Pro_Product_Controller::get_default_product_template();
    if (!$products_disabled) {
      $quick_links['product'] = [
        'url' =>
          '/dashboard/' .
          apply_filters('wcv_add_product_url', $add_product_link['url_path']),
        'label' => __('Add product', 'wcvendors-pro'),
      ];
      get_template_part('wc-vendors/dashboard/quick', 'links', [
        'links' => $quick_links,
      ]);
    }
    ?>
    <?php $this->display_columns(); ?>
    <?php $this->display_rows(); ?>
</table>