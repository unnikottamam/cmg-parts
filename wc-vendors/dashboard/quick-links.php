<?php
/**
 * The template for displaying the dashboard quicklinks
 *
 * Override this template by copying it to yourtheme/wc-vendors/dashboard/
 *
 * @package    WCVendors_Pro
 * @version    1.6.6
 */

$quick_links = $args['links'] ? $args['links'] : $quick_links;

$object = get_query_var('object');
$vendor_id = get_current_user_id();
$store_name = get_user_meta($vendor_id, 'pv_shop_name', true);
$store_number = get_field('vendor_number', 'user_' . $vendor_id . '');

if (!$object) { ?>
<div class="wcv__quicklinks">
    <div class="row">
        <div class="col-md-5">
            <?php if (!empty(wcv_is_dashboard_page())) { ?>
            <h2 class="mb-1"><?php echo $store_name; ?></h2>
            <?php echo $store_number
              ? "<h6 class='wcv__danger'><strong>Vendor Number : " .
                $store_number .
                "</strong></h6>"
              : "<h6 class='wcv__danger'>We will assign you a vendor number soon, but you can add your machine(s).</h6>"; ?>
            <?php } ?>

            <?php do_action('wcv_dashboard_before_quick_actions'); ?>
            <?php foreach ($quick_links as $link => $details): ?>
            <a href="<?php echo $details[
              'url'
            ]; ?>" class="btn btn-sm btn-outline-primary quick-link-btn <?php echo $link; ?>">
                <?php echo $details['label']; ?>
            </a>
            <?php endforeach; ?>
            <?php do_action('wcv_dashboard_after_quick_actions'); ?>
            <?php do_action('wcv_dashboard_before_usage_statistics'); ?>

            <?php foreach ($stats as $key => $stat): ?>
            <?php $stat = wp_parse_args($stat, [
              'icon' => '',
              'template' => '%s / %s',
              'over' => false,
            ]); ?>
            <button class="btn btn-primary <?php echo $key; ?> <?php echo $stat[
   'over'
 ]
   ? 'over_limit'
   : ''; ?>">
                <?php if ($stat['icon']): ?>
                <svg class="wcv-icon wcv-icon-sm">
                    <use xlink:href="<?php echo WCV_PRO_PUBLIC_ASSETS_URL; ?>svg/wcv-icons.svg#<?php echo $stat[
  'icon'
]; ?>"></use>
                </svg>
                <?php endif; ?>
                <?php echo sprintf(
                  $stat['template'],
                  $stat['usage'],
                  $stat['limit']
                ); ?>
            </button>
            <?php endforeach; ?>

            <?php do_action('wcv_dashboard_after_usage_statistics'); ?>
            <div class="mb-2"></div>
        </div>
        <div class="col-md-7">
            <h5>Contact Details</h5>
            <p>
                Customer Name :
                <?php if (
                  !get_userdata($vendor_id)->user_firstname &&
                  !get_userdata($vendor_id)->user_lastname
                ) {
                  echo get_userdata($vendor_id)->display_name;
                } else {
                  echo get_userdata($vendor_id)->user_firstname .
                    ' ' .
                    get_userdata($vendor_id)->user_lastname;
                } ?>
                <br>Email: <?php echo get_userdata($vendor_id)->user_email; ?>
                <br>Cell Number:
                <?php echo get_user_meta(
                  $vendor_id,
                  '_wcv_store_phone',
                  true
                ); ?>
            </p>
            <address>
                <?php
                echo get_user_meta($vendor_id, '_wcv_store_address1', true);
                echo get_user_meta($vendor_id, '_wcv_store_address2', true)
                  ? '<br />' .
                    get_user_meta($vendor_id, '_wcv_store_address2', true)
                  : '';
                echo '<br />' .
                  get_user_meta($vendor_id, '_wcv_store_city', true);
                echo ', ' .
                  get_user_meta($vendor_id, '_wcv_store_postcode', true);
                echo get_user_meta($vendor_id, '_wcv_store_state', true)
                  ? '<br />' .
                    get_user_meta($vendor_id, '_wcv_store_state', true) .
                    ', '
                  : '<br />';
                echo get_user_meta($vendor_id, '_wcv_store_country', true);
                ?>
            </address>
        </div>
    </div>
</div>
<?php } else {
  do_action('wcv_dashboard_before_quick_actions');
  foreach ($quick_links as $link => $details): ?>
<a href="<?php echo $details[
  'url'
]; ?>" class="btn btn-sm btn-outline-primary quick-link-btn <?php echo $link; ?>">
    <?php echo $details['label']; ?>
</a>
<?php endforeach;
  do_action('wcv_dashboard_after_quick_actions');
  do_action('wcv_dashboard_before_usage_statistics');

  foreach ($stats as $key => $stat):
    $stat = wp_parse_args($stat, [
      'icon' => '',
      'template' => '%s / %s',
      'over' => false,
    ]); ?>
<button class="btn btn-primary <?php echo $key; ?> <?php echo $stat['over']
   ? 'over_limit'
   : ''; ?>">
    <?php
    if ($stat['icon']): ?>
    <svg class="wcv-icon wcv-icon-sm">
        <use xlink:href="<?php echo WCV_PRO_PUBLIC_ASSETS_URL; ?>svg/wcv-icons.svg#<?php echo $stat[
  'icon'
]; ?>"></use>
    </svg>
    <?php endif;
    echo sprintf($stat['template'], $stat['usage'], $stat['limit']);
    ?>
</button>
<?php
  endforeach;
  do_action('wcv_dashboard_after_usage_statistics');
  ?>
<div class="mb-2"></div>
<?php }