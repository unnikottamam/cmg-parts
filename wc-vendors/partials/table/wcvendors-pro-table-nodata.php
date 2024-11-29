<?php
/**
 * To display if there is no table data
 *
 * This is used to display there is no table data
 *
 * @link       http://www.wcvendors.com
 * @since      1.0.0
 *
 * @package    WCVendors_Pro
 * @subpackage WCVendors_Pro/public/partials/helpers/table
 */
?>

<h3><?php echo $no_data_notice; ?></h3>
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