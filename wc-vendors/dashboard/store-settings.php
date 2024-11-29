<?php
/**
 * The template for displaying the store settings form
 *
 * Override this template by copying it to yourtheme/wc-vendors/dashboard/
 *
 * @package    WCVendors_Pro
 * @version    1.7.5
 */

$settings_social = (array) get_option('wcvendors_hide_settings_social');
$social_total = count($settings_social);
$social_count = 0;
foreach ($settings_social as $value) {
  if (1 == $value) {
    ++$social_count;
  }
}
?>

<h1><?php _e('Settings', 'wcvendors-pro'); ?></h1>

<?php do_action('wcvendors_settings_before_form'); ?>
<form method="post" id="wcv-store-settings" action="#" class="wcv-form">
    <?php WCVendors_Pro_Store_Form::form_data(); ?>
    <div class="wcv-tabs top" data-prevent-url-change="true">
        <div class="form-item">
            <?php WCVendors_Pro_Store_Form::store_name($store_name); ?>
            <?php do_action('wcvendors_settings_after_shop_name'); ?>
        </div>

        <div class="row">
            <div class="col-sm-6 form-item">
                <?php do_action('wcvendors_settings_before_company_url'); ?>
                <?php WCVendors_Pro_Store_Form::company_url(); ?>
                <?php do_action('wcvendors_settings_after_company_url'); ?>
            </div>
            <div class="col-sm-6 form-item">
                <?php do_action('wcvendors_settings_before_store_phone'); ?>
                <?php WCVendors_Pro_Store_Form::store_phone(); ?>
                <?php do_action('wcvendors_settings_after_store_phone'); ?>
            </div>
        </div>

        <?php do_action('wcvendors_settings_before_address'); ?>
        <div class="row">
            <div class="col-sm-6 form-item">
                <?php WCVendors_Pro_Store_Form::store_address1(); ?>
            </div>
            <div class="col-sm-6 form-item">
                <?php WCVendors_Pro_Store_Form::store_address2(); ?>
            </div>
            <div class="col-sm-6 form-item">
                <?php WCVendors_Pro_Store_Form::store_address_country(); ?>
            </div>
            <div class="col-sm-6 form-item">
                <?php WCVendors_Pro_Store_Form::store_address_state(); ?>
            </div>
            <div class="col-sm-6 form-item">
                <?php WCVendors_Pro_Store_Form::store_address_city(); ?>
            </div>
            <div class="col-sm-6 form-item">
                <?php WCVendors_Pro_Store_Form::store_address_postcode(); ?>
            </div>
        </div>
        <?php do_action('wcvendors_settings_after_address'); ?>

        <div class="form-item">
            <?php WCVendors_Pro_Store_Form::store_description(
              $store_description
            ); ?>
        </div>
        <?php do_action('wcvendors_settings_after_shop_description'); ?>
        <?php do_action('wcvendors_settings_after_store_tab'); ?>

        <div class="form-item">
            <?php do_action('wcvendors_settings_before_shipping_tab'); ?>
            <?php WCVendors_Pro_Store_Form::shipping_from($shipping_details); ?>
            <?php do_action('wcvendors_settings_after_shipping_tab'); ?>
        </div>

        <?php WCVendors_Pro_Store_Form::save_button(
          __('Save Changes', 'wcvendors-pro')
        ); ?>
    </div>
</form>
<?php do_action('wcvendors_settings_after_form');