<?php
/**
 * Functions which enhance the WC Vendor plugin
 *
 * @package Coast_Machinery
 */

// After login redirect
function my_login_redirect($redirect_to, $request, $user)
{
  if (isset($user->roles) && is_array($user->roles)) {
    if (in_array('pending_vendor', $user->roles)) {
      return home_url();
    } else {
      return $redirect_to;
    }
  } else {
    return $redirect_to;
  }
}
add_filter('login_redirect', 'my_login_redirect', 10, 3);

// the filter wcv_dashboard_nav_class callback
function wc_navclass_change()
{
  return 'vendormod__nav';
}
add_filter('wcv_dashboard_nav_class', 'wc_navclass_change', 10, 1);

// the filter_wcv_store_save_button callback
function vendor_store_save_btn()
{
  $args = [
    'id' => 'save_button',
    'value' => $button_text,
    'class' => 'btn btn-outline-primary',
  ];
  return $args;
}
add_filter('wcv_store_save_button', 'vendor_store_save_btn', 10, 1);

// the filter_wcv_product_save_button callback
function vendor_prod_save_btn($param)
{
  $args = [
    'id' => 'save_button',
    'value' => 'Submit Product',
    'class' => 'btn btn-primary',
  ];
  return $args;
}
add_filter('wcv_product_save_button', 'vendor_prod_save_btn', 10, 1);

// the filter_wcv_product_draft_button callback
function vendor_prod_draft_btn()
{
  $args = [
    'id' => 'draft_button',
    'value' => 'Save As Draft',
    'class' => 'btn btn-outline-primary',
  ];
  return $args;
}
add_filter('wcv_product_draft_button', 'vendor_prod_draft_btn', 10, 1);

// Remove WC Vendor Styles
function wcv_ink_styles()
{
  return '';
}
add_filter('wcv_pro_ink_style', 'wcv_ink_styles');

function wcv_dash_styles()
{
  return get_template_directory_uri() . '/dist/css/wcv.min.css';
}
add_filter('wcv_pro_dashboard_style', 'wcv_dash_styles');

// the filter_wcv_order_update_button callback
function wcv_order_update_btn($param)
{
  $args = [
    'id' => 'update_button',
    'value' => __('Update', 'wcvendors-pro'),
    'class' => 'btn btn-outline-primary btn-sm',
    'wrapper_start' => '<div class="control-group"><div class="control">',
    'wrapper_end' => '</div></div>',
  ];
  return $args;
}
add_filter('wcv_order_update_button', 'wcv_order_update_btn', 10, 1);

// the filter_wcv_dashboard_update_button callback
add_filter('wcv_dashboard_update_button', 'wcv_order_update_btn', 10, 1);

// the filter_wcv_product_table_actions_path callback
function wcv_prod_table_path($param)
{
  $path =
    get_stylesheet_directory() .
    '/wc-vendors/partials/wcvendors-pro-table-actions.php';
  return $path;
}
add_filter('wcv_product_table_actions_path', 'wcv_prod_table_path', 10, 1);

// the filter_wcvendors_pro_product_attribute_path callback
function wcv_prod_pro_attr_path($param)
{
  $path =
    get_stylesheet_directory() .
    '/wc-vendors/partials/wcvendors-pro-product-attribute.php';
  return $path;
}
add_filter(
  'wcvendors_pro_product_attribute_path',
  'wcv_prod_pro_attr_path',
  10,
  1
);

// the filter_wcvendors_pro_product_form_product_attributes_path callback
function wcv_prod_form_attr_path($param)
{
  $path =
    get_stylesheet_directory() .
    '/wc-vendors/partials/wcvendors-pro-attributes.php';
  return $path;
}
add_filter(
  'wcvendors_pro_product_form_product_attributes_path',
  'wcv_prod_form_attr_path',
  10,
  1
);

// the filter_wcv_vendor_store_name callback
function wcv_vendor_name($args)
{
  $more_args = [
    'id' => '_wcv_store_name',
    'label' => __('Vendor / Business Name *', 'wcvendors-pro'),
    'placeholder' => __('Vendor / Business name', 'wcvendors-pro'),
    'desc_tip' => false,
    'type' => 'text',
    'class' => 'form-control',
    'wrapper_start' => '',
    'wrapper_end' => '',
    'custom_attributes' => [
      'data-rules' => 'required',
      'data-error' => __('This field is required.', 'wcvendors-pro'),
    ],
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_vendor_store_name', 'wcv_vendor_name', 10, 1);

// the filter_wcv_vendor_company_url callback
function wcv_website_url($args)
{
  $more_args = [
    'id' => '_wcv_company_url',
    'label' => __('Your website URL (Optional)', 'wcvendors-pro'),
    'placeholder' => __('https://yourwebsite.com/', 'wcvendors-pro'),
    'desc_tip' => false,
    'type' => 'url',
    'wrapper_start' => '',
    'wrapper_end' => '',
    'class' => 'form-control',
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_vendor_company_url', 'wcv_website_url', 10, 1);

// the filter_wcv_vendor_store_address1 callback
function wcv_store_address1($args)
{
  $more_args = [
    'id' => '_wcv_store_address1',
    'label' => __('Street Address *', 'wcvendors-pro'),
    'placeholder' => __('Your street address', 'wcvendors-pro'),
    'type' => 'text',
    'class' => 'form-control',
    'wrapper_start' => '',
    'wrapper_end' => '',
    'custom_attributes' => [
      'data-rules' => 'required',
      'data-error' => __('This field is required.', 'wcvendors-pro'),
    ],
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_vendor_store_address1', 'wcv_store_address1', 10, 1);

// the filter_wcv_vendor_store_address2 callback
function wcv_store_address2($args)
{
  $more_args = [
    'id' => '_wcv_store_address2',
    'label' => __('Apartment / unit (Optional)', 'wcvendors-pro'),
    'placeholder' => __('Apartment, unit, suite etc. ', 'wcvendors-pro'),
    'type' => 'text',
    'class' => 'form-control',
    'wrapper_start' => '',
    'wrapper_end' => '',
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_vendor_store_address2', 'wcv_store_address2', 10, 1);

// the filter_wcv_vendor_store_city callback
function wcv_store_city($args)
{
  $more_args = [
    'id' => '_wcv_store_city',
    'label' => __('City / Town *', 'wcvendors-pro'),
    'placeholder' => __('Your city / town name', 'wcvendors-pro'),
    'type' => 'text',
    'wrapper_start' => '',
    'wrapper_end' => '',
    'class' => 'form-control',
    'custom_attributes' => [
      'data-rules' => 'required',
      'data-error' => __('This field is required.', 'wcvendors-pro'),
    ],
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_vendor_store_city', 'wcv_store_city', 10, 1);

// the filter wcv_country_select2 callback
function wcv_select_country($args)
{
  $more_args = [
    'id' => '_wcv_store_country',
    'label' => __('Select Country *', 'wcvendors-pro'),
    'class' => 'form-control',
    'options' => ['CA' => 'Canada', 'US' => 'USA'],
    'wrapper_start' => '',
    'wrapper_end' => '',
    'custom_attributes' => [
      'data-rules' => 'required',
      'data-error' => __('This field is required.', 'wcvendors-pro'),
    ],
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_country_select2', 'wcv_select_country', 10, 1);

// the filter_wcv_vendor_store_state callback
function wcv_store_state($args)
{
  $more_args = [
    'id' => '_wcv_store_state',
    'label' => __('State / Province *', 'wcvendors-pro'),
    'placeholder' => __('Your state / province name', 'wcvendors-pro'),
    'wrapper_start' => '',
    'wrapper_end' => '',
    'class' => 'form-control',
    'custom_attributes' => [
      'data-rules' => 'required',
      'data-error' => __('This field is required.', 'wcvendors-pro'),
    ],
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_vendor_store_state', 'wcv_store_state', 10, 1);

// the filter_wcv_vendor_store_postcode callback
function wcv_store_postcode($args)
{
  $more_args = [
    'id' => '_wcv_store_postcode',
    'label' => __('Zip / Postal code *', 'wcvendors-pro'),
    'placeholder' => __('Your zip / postal code', 'wcvendors-pro'),
    'wrapper_start' => '',
    'wrapper_end' => '',
    'class' => 'form-control',
    'custom_attributes' => [
      'data-rules' => 'required',
      'data-error' => __('This field is required.', 'wcvendors-pro'),
    ],
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_vendor_store_postcode', 'wcv_store_postcode', 10, 1);

// the filter_wcv_vendor_store_phone callback
function wcv_store_phone($args)
{
  $more_args = [
    'id' => '_wcv_store_phone',
    'label' => __('Cell Number *', 'wcvendors-pro'),
    'placeholder' => __('Your cell number', 'wcvendors-pro'),
    'desc_tip' => false,
    'type' => 'tel',
    'wrapper_start' => '',
    'wrapper_end' => '',
    'class' => 'form-control',
    'custom_attributes' => [
      'data-rules' => 'required',
      'data-error' => __('This field is required.', 'wcvendors-pro'),
    ],
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_vendor_store_phone', 'wcv_store_phone', 10, 1);

// the filter_wcv_vendor_store_description callback
function wcv_store_description($args)
{
  $more_args = [
    'id' => 'pv_shop_description',
    'label' => __('Vendor information (Optional)', 'wcvendors-pro'),
    'wrapper_start' => '',
    'wrapper_end' => '',
    'class' => 'form-control',
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_vendor_store_description', 'wcv_store_description', 10, 1);

// the filter_wcv_vendor_shipping_from callback
function wcv_ship_from($args)
{
  $more_args = [
    'label' => __('Your products are shipping from? *', 'wcvendors-pro'),
    'wrapper_start' => '',
    'wrapper_end' => '',
    'desc_tip' => false,
    'class' => 'form-control',
    'options' => [
      'cmg' => __('Coast Machinery', 'wcvendors-pro'),
      'vendor-address' => __('Your address', 'wcvendors-pro'),
    ],
    'custom_attributes' => [
      'data-rules' => 'required',
      'data-error' => __('This field is required.', 'wcvendors-pro'),
    ],
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_vendor_shipping_from', 'wcv_ship_from', 10, 1);

// the filter wcv_product_title callback
function filter_wcv_product_title($args)
{
  $more_args = [
    'label' => __('Product Name *', 'wcvendors-pro'),
    'placeholder' => __('E.g. Belfab Downdraft Table', 'wcvendors-pro'),
    'class' => 'form-control',
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_product_title', 'filter_wcv_product_title', 10, 1);

// the filter_wcv_product_description callback
function filter_wcv_product_description($args)
{
  $more_args = [
    'label' => __('Product Description', 'wcvendors-pro'),
    'placeholder' => __(
      'Describe any damage / repairs of your product',
      'wcvendors-pro'
    ),
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_product_description', 'filter_wcv_product_description');

// the filter_wcv_product_weight callback
function filter_wcv_product_weight($args)
{
  $more_args = [
    'wrapper_start' => '',
    'placeholder' => __('in lbs (Optional)', 'wcvendors-pro'),
    'wrapper_end' => '',
    'desc_tip' => false,
    'type' => 'tel',
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_product_weight', 'filter_wcv_product_weight', 10, 1);

// the filter_wcv_product_length callback
function filter_wcv_product_length($args)
{
  $more_args = [
    'label' => __('Length (inch)', 'wcvendors-pro'),
    'placeholder' => __('in inches (Optional)', 'wcvendors-pro'),
    'wrapper_start' => '<div class="col-md-4 col-6 form-item">',
    'wrapper_end' => '</div>',
    'desc_tip' => false,
    'type' => 'tel',
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_product_length', 'filter_wcv_product_length', 10, 1);

// the filter_wcv_product_width callback
function filter_wcv_product_width($args)
{
  $more_args = [
    'label' => __('Width (inch)', 'wcvendors-pro'),
    'placeholder' => __('in inches (Optional)', 'wcvendors-pro'),
    'wrapper_start' => '<div class="col-md-4 col-6 form-item">',
    'wrapper_end' => '</div>',
    'desc_tip' => false,
    'type' => 'tel',
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_product_width', 'filter_wcv_product_width', 10, 1);

// the filter_wcv_product_height callback
function filter_wcv_product_height($args)
{
  $more_args = [
    'label' => __('Height (inch)', 'wcvendors-pro'),
    'placeholder' => __('in inches (Optional)', 'wcvendors-pro'),
    'wrapper_start' => '<div class="col-md-4 col-6 form-item">',
    'wrapper_end' => '</div>',
    'desc_tip' => false,
    'type' => 'tel',
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_product_height', 'filter_wcv_product_height', 10, 1);

// the filter_wcv_product_categories callback
function filter_wcv_product_categories($args)
{
  $more_args = [
    'class' => 'form-control',
    'label' => __('Category *', 'wcvendors-pro'),
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_product_categories', 'filter_wcv_product_categories', 10, 1);

// the filter wcv_product_price callback
function filter_wcv_product_price($args)
{
  $more_args = [
    'label' =>
      __('Selling Price', 'wcvendors-pro') .
      ' (' .
      get_woocommerce_currency_symbol() .
      ') *',
    'type' => 'tel',
    'placeholder' => __('E.g. 2100', 'wcvendors-pro'),
    'desc_tip' => true,
  ];
  return array_merge($args, $more_args);
}
add_filter('wcv_product_price', 'filter_wcv_product_price', 10, 1);

/*
 * Table template changes
 *
 */

// the filter_wcvendors_pro_table_display_actions_path callback
function wcv_table_action_path($param)
{
  $path =
    get_stylesheet_directory() .
    '/wc-vendors/partials/table/wcvendors-pro-table-actions.php';
  return $path;
}
add_filter(
  'wcvendors_pro_table_display_actions_path',
  'wcv_table_action_path',
  10,
  1
);

// the filter_wcvendors_pro_table_display_rows_path callback
function wcv_table_data_path($param)
{
  $path =
    get_stylesheet_directory() .
    '/wc-vendors/partials/table/wcvendors-pro-table-data.php';
  return $path;
}
add_filter(
  'wcvendors_pro_table_display_rows_path',
  'wcv_table_data_path',
  10,
  1
);

// the filter_wcvendors_pro_table_path callback
function wcv_table_path($param)
{
  $path =
    get_stylesheet_directory() .
    '/wc-vendors/partials/table/wcvendors-pro-table.php';
  return $path;
}
add_filter('wcvendors_pro_table_path', 'wcv_table_path', 10, 1);

// the filter_wcvendors_pro_table_display_columns_path callback
function wcv_table_column_path($param)
{
  $path =
    get_stylesheet_directory() .
    '/wc-vendors/partials/table/wcvendors-pro-table-columns.php';
  return $path;
}
add_filter(
  'wcvendors_pro_table_display_columns_path',
  'wcv_table_column_path',
  10,
  1
);

// the filter_wcvendors_pro_table_no_data_path callback
function wcv_table_nodata_path($param)
{
  $path =
    get_stylesheet_directory() .
    '/wc-vendors/partials/table/wcvendors-pro-table-nodata.php';
  return $path;
}
add_filter('wcvendors_pro_table_no_data_path', 'wcv_table_nodata_path', 10, 1);

// the filter_wcv_product_table_columns callback
function filter_wcv_product_table_columns($param)
{
  $columns = [
    'tn' => __(
      '<svg width="18" height="18" fill="#00548c" viewBox="0 0 16 16"><path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/><path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/></svg>',
      'wcvendors-pro'
    ),
    'details' => __('Details', 'wcvendors-pro'),
  ];
  return $columns;
}
add_filter(
  'wcv_product_table_columns',
  'filter_wcv_product_table_columns',
  10,
  1
);

// Get GA reports for products
require get_template_directory() . '/vendor/autoload.php';
$KEY_FILE_LOCATION = '/home/coastm8/env-vars/service-account-credentials.json';
$client = new Google_Client();
$client->setApplicationName("GA Reporting");
$client->setAuthConfig($KEY_FILE_LOCATION);
$client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
$analytics = new Google_Service_Analytics($client);

function getGAData($id)
{
  if (!$id) {
    return 0;
  }
  $slug = get_post_field('post_name', $id);
  $startdate = get_the_date('Y-m-d', $id);
  $params = [
    'filters' => 'ga:pagePath==/product/' . $slug . '/',
    'metrics' => 'ga:pageviews',
  ];
  global $analytics;
  $results = $analytics->data_ga->get(
    'ga:78189375',
    $startdate,
    'today',
    'ga:sessions',
    $params
  );
  if ($results->getRows() && count($results->getRows()) > 0) {
    $rows = $results->getRows();
    $views = $rows[0][0];
    return $views;
  }
  return 0;
}