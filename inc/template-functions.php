<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Coast_Machinery
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function coast_machinery_body_classes($classes)
{
  // Adds a class of hfeed to non-singular pages.
  if (!is_singular()) {
    $classes[] = 'hfeed';
  }

  // Adds a class of no-sidebar when there is no sidebar present.
  if (!is_active_sidebar('sidebar-1')) {
    $classes[] = 'no-sidebar';
  }

  return $classes;
}
add_filter('body_class', 'coast_machinery_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function coast_machinery_pingback_header()
{
  if (is_singular() && pings_open()) {
    printf(
      '<link rel="pingback" href="%s">',
      esc_url(get_bloginfo('pingback_url'))
    );
  }
}
add_action('wp_head', 'coast_machinery_pingback_header');

// Search Form Widget
function search_form_widget($form)
{
  return '<form class="position-relative search-form" action="' . home_url('/') . '" method="get">
    <div class="input-group">
      <input class="search-keyword form-control rounded-start border-1 border-danger" type="search" name="s" value="' . get_search_query() . '" placeholder="Search Products..." />
      <input type="hidden" name="post_type" value="product" />
      <button type="submit" class="btn btn-outline-danger px-2 rounded-0 rounded-end">
        <span class="visually-hidden">Search</span>
        <svg width="16" height="16" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path></svg>
      </button>
    </div>
    <ul class="search-results m-0 list-unstyled top-100 w-100 position-absolute left-0"></ul>
  </form>';
}
add_filter('get_search_form', 'search_form_widget');

if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
}

// Change Menu Active Clas
function change_menu_classes($css_classes)
{
  $css_classes = str_replace("current-menu-item", "active", $css_classes);
  $css_classes = str_replace("current_page_item", "active", $css_classes);
  $css_classes = str_replace("current-menu-parent", "active", $css_classes);
  $css_classes = str_replace("current-menu-ancestor", "active", $css_classes);
  return $css_classes;
}
add_filter('nav_menu_css_class', 'change_menu_classes');

// Mega Menu
function shop_megamenu($item_output, $item)
{
  if (!get_field('shop_menu', $item)) {
    return $item_output;
  }

  $megamenu = '<div class="megamenu"><div class="row">';

  $mega_inn = '';
  if (have_rows('menu_items', $item)) {
    $count = 0;
    $mega_inn .= '<div class="megamenu__left col-lg-3 d-none d-lg-block"><ul>';
    while (have_rows('menu_items', $item)) {
      the_row();
      if (get_sub_field('title_link')) {
        $count++;
        $link = get_sub_field('title_link');
        if ($count == 1) {
          $mega_inn .= '<li class="active lgactive">';
        } else {
          $mega_inn .= '<li>';
        }
        $mega_inn .=
          '<a data-tab="#menu_tab_' .
          $count .
          '" href="' .
          $link['url'] .
          '"><span>' .
          $link['title'] .
          '</span></a>';
        $mega_inn .= '</li>';
      }
    }
    $mega_inn .= '</ul></div>';
  }

  if (have_rows('menu_items', $item)) {
    $count = 0;
    $mega_inn .= '<div class="megamenu__right col-lg col-12">';
    while (have_rows('menu_items', $item)) {
      the_row();
      $count++;
      if ($count == 1) {
        $mega_inn .=
          '<div id="menu_tab_' .
          $count .
          '" class="megamenu__tab active lgactive">';
      } else {
        $mega_inn .= '<div id="menu_tab_' . $count . '" class="megamenu__tab">';
      }
      if (get_sub_field('title_link')) {
        $link = get_sub_field('title_link');
        $mega_inn .=
          '<h3><a href="' .
          $link['url'] .
          '">' .
          $link['title'] .
          '<span></span></a></h3>';
      }
      if (have_rows('menu_inner', $item)) {
        $mega_inn .= '<div class="row mob_inn__row justify-content-between">';
        while (have_rows('menu_inner', $item)) {
          the_row();
          $mega_inn .=
            '<div class="col-12 ' .
            get_sub_field('class') .
            '">' .
            get_sub_field("contents") .
            '</div>';
        }
        $mega_inn .= '</div>';
      }
      $mega_inn .= '</div>';
    }
    $mega_inn .= '</div>';
  }

  $megamenu .= $mega_inn;
  $megamenu .= '</div></div>';

  return $item_output . $megamenu;
}
add_filter('walker_nav_menu_start_el', 'shop_megamenu', 15, 2);

// Add Only Products to Search
function custom_search_post_types($query)
{
  if (!$query->is_admin && $query->is_search) {
    $query->set('post_type', ['product']);
    add_filter('posts_join', 'az_search_join');
    add_filter('posts_where', 'az_search_where');
    add_filter('posts_groupby', 'az_search_groupby');
  }
  return $query;
}
add_filter('pre_get_posts', 'custom_search_post_types');

function az_search_join($join)
{
  global $wpdb;
  $join .=
    " LEFT JOIN $wpdb->postmeta gm ON (" .
    $wpdb->posts .
    ".ID = gm.post_id AND gm.meta_key='_sku')";
  return $join;
}

function az_search_where($where)
{
  global $wpdb;
  $where = preg_replace(
    "/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
    "({$wpdb->posts}.post_title LIKE $1) OR (gm.meta_value LIKE $1)",
    $where
  );
  return $where;
}
function az_search_groupby($groupby)
{
  global $wpdb;
  $mygroupby = "{$wpdb->posts}.ID";
  if (preg_match("/$mygroupby/", $groupby)) {
    return $groupby;
  }
  if (!strlen(trim($groupby))) {
    return $mygroupby;
  }
  return $groupby . ", " . $mygroupby;
}

// Search API
function search_api($data)
{
  $search = $data->get_param('search');
  $args = [
    "post_type" => "product",
    "posts_per_page" => 8,
    "meta_query" => [
      "relation" => "OR",
      [
        "key" => "prod_title",
        "value" => $search,
        "compare" => "LIKE",
      ],
      [
        "key" => "title",
        "value" => $search,
        "compare" => "LIKE",
      ],
      [
        "key" => "_sku",
        "value" => $search,
        "compare" => "LIKE",
      ],
    ],
  ];

  $query = new WP_Query($args);
  if ($query->have_posts()) {
    $count = 0;
    while ($query->have_posts()) {
      $query->the_post();
      $post = get_post(get_the_ID());
      if ($post->_stock_status == 'instock' && $count < 4) {
        $count++;
        $out_data[] = [
          "title" => $post->post_title,
          "img" => get_the_post_thumbnail_url($post->ID, "thumbnail"),
          "url" => get_permalink($post->ID),
          "sku" => $post->_sku,
        ];
      }
    }
    wp_reset_query();
  }
  wp_send_json($out_data);
}
add_action("rest_api_init", function () {
  register_rest_route("wp/v3", "/search-product", [
    "methods" => "GET",
    "callback" => "search_api",
  ]);
});

// Category List API
function cats_api()
{
  $product_cats = get_terms([
    'taxonomy' => 'product_cat',
    'parent' => 0,
    'exclude' => [15],
  ]);

  if ($product_cats) {
    foreach ($product_cats as $category) {
      $out_data[] = [
        "title" => $category->name,
        "id" => $category->term_id,
        "parent" => 0,
      ];
      $category_inn = get_terms([
        'taxonomy' => 'product_cat',
        'parent' => $category->term_id,
      ]);
      if ($category_inn) {
        foreach ($category_inn as $cat_inn) {
          $out_data[] = [
            "title" => $cat_inn->name,
            "id" => $cat_inn->term_id,
            "parent" => $category->term_id,
          ];
        }
      }
    }
  }
  wp_send_json($out_data);
}
add_action("rest_api_init", function () {
  register_rest_route("wp/v3", "/cats", [
    "methods" => "GET",
    "callback" => "cats_api",
  ]);
});

// Mobile Home Screen API
function mobile_home_api()
{
  $src = "";
  $title = "";
  $link_exists = false;
  $linktitle = "";
  $url = "";
  if (have_rows('app_home_screen', 'options')) {
    while (have_rows('app_home_screen', 'options')) {
      the_row();
      $image = get_sub_field('banner');
      $title = get_sub_field('title');
      $src = $image['url'];
      if (get_sub_field('link')) {
        $link = get_sub_field('link');
        $link_exists = true;
        $linktitle = $link['title'];
        $url = $link['url'];
      }
    }
  }
  $out_data = [
    "src" => $src,
    "title" => $title,
    "link_exists" => $link_exists,
    "linktitle" => $linktitle,
    "url" => $url,
  ];
  wp_send_json($out_data);
}
add_action("rest_api_init", function () {
  register_rest_route("wp/v3", "/homescreen", [
    "methods" => "GET",
    "callback" => "mobile_home_api",
  ]);
});

// Product Author API
function prod_auth_api($data)
{
  $id = $data->get_param('id');
  if (!$id) {
    return;
  }
  $args = [
    "post_type" => "product",
    "posts_per_page" => -1,
    "author" => $id,
  ];
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $product = wc_get_product(get_the_ID());
      $out_data[] = [
        "id" => $product->get_id(),
        "name" => $product->get_name(),
        "slug" => $product->get_slug(),
        "permalink" => get_permalink($product->get_id()),
        "status" => $product->get_status(),
        "stock_status" => $product->get_stock_status(),
        "stock_status" => $product->get_stock_status(),
        "stock_quantity" => $product->get_stock_quantity(),
        "price" => $product->get_price(),
        "categories" => get_the_terms($product->get_id(), 'product_cat'),
        "sku" => $product->get_sku(),
        "images" => [
          [
            'id' => (int) $product->get_image_id(),
            'src' => wp_get_attachment_url($product->get_image_id()),
            'name' => get_the_title($product->get_image_id()),
            'alt' => get_post_meta(
              $product->get_image_id(),
              '_wp_attachment_image_alt',
              true
            ),
          ],
        ],
        "meta_data" => [
          [
            "key" => "lead_count",
            "value" => get_post_meta($product->get_id(), 'lead_count', true),
          ],
        ],
      ];
    }
    wp_reset_query();
  }
  wp_send_json($out_data);
}
add_action("rest_api_init", function () {
  register_rest_route("wp/v3", "/prodauth", [
    "methods" => "GET",
    "callback" => "prod_auth_api",
  ]);
});

// Product Added by User Custom API
function productadd_custom_api($data)
{
  $user = $data->get_param('user');
  $password = $data->get_param('key');
  $product = $data->get_param('product');
  if (!$password || !$product || !$user) {
    return;
  }

  $data = "username=$user&password=$password";
  $url = "https://coastmachinery.com/wp-json/jwt-auth/v1/token/";
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $headers = ["Content-Type: application/x-www-form-urlencoded"];
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $resp = curl_exec($curl);
  $output = json_decode($resp);
  curl_close($curl);

  if (!$output->token) {
    return;
  }
  $arg = [
    'ID' => $product,
    'post_author' => $output->userid,
  ];
  wp_update_post($arg);
  $out_data = ["status" => "success"];
  wp_send_json($out_data);
}
add_action("rest_api_init", function () {
  register_rest_route("wp/v3", "/useraddproduct", [
    "methods" => "GET",
    "callback" => "productadd_custom_api",
  ]);
});

// Location API
function location_api($data)
{
  $state = $data->get_param('state');
  $args = [
    "post_type" => "product",
    "posts_per_page" => -1,
    "meta_query" => [
      [
        "key" => "product_state",
        "value" => $state,
      ],
    ],
  ];

  $query = new WP_Query($args);
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $product = get_post(get_the_ID());
      if ($product->_stock_status == 'instock') {
        $product_cats = wp_get_post_terms($product->ID, 'product_cat', [
          'orderby' => 'term_order',
        ]);
        $cat1 = $product_cats ? $product_cats[0] : '';
        $out_data[] = [
          "image" => get_the_post_thumbnail_url(
            $product->ID,
            "woocommerce_gallery_thumbnail"
          ),
          "catname" => $cat1->name,
          "catid" => $cat1->term_id,
          "catslug" => $cat1->slug,
        ];
      }
    }
    wp_reset_query();
    shuffle($out_data);
  }
  wp_send_json($out_data);
}
add_action("rest_api_init", function () {
  register_rest_route("wp/v3", "/location", [
    "methods" => "GET",
    "callback" => "location_api",
  ]);
});

// Filter array of objects with key value
function filterByCat($items, $filterVal)
{
  return array_filter($items, function ($item) use ($filterVal) {
    if ($item->catid == $filterVal) {
      return true;
    }
  });
}

function get_woo_attribute($attr, $id)
{
  $attributes = $attr;
  if (!$attributes) {
    return;
  }
  $display_result = [];
  foreach ($attributes as $attribute) {
    if ($attribute->get_variation()) {
      continue;
    }
    $name = $attribute->get_name();
    if ($attribute->is_taxonomy()) {
      $terms = wp_get_post_terms($id, $name, 'all');
      $attrtax = $terms[0]->taxonomy;
      $attribute_taxonomy = get_taxonomy($attrtax);
      if (isset($attribute_taxonomy->labels->singular_name)) {
        $tax_label = $attribute_taxonomy->labels->singular_name;
      } elseif (isset($attribute_taxonomy->label)) {
        $tax_label = $attribute_taxonomy->label;
        if (0 === strpos($tax_label, 'Product ')) {
          $tax_label = substr($tax_label, 8);
        }
      }
      $tax_terms = [];
      foreach ($terms as $term) {
        $single_term = esc_html($term->name);
        array_push($tax_terms, $single_term);
      }
      $display_result[$tax_label] = esc_html(implode(', ', $tax_terms));
    } else {
      $data = esc_html(implode(', ', $attribute->get_options())) . '';
      $display_result[$name] = $data;
    }
  }
  return $display_result;
}

// Tag Cloud Filter
add_filter('widget_tag_cloud_args', 'coast_tag_cloud');
function coast_tag_cloud()
{
  $args = [
    'smallest' => 15,
    'largest' => 15,
    'unit' => 'px',
    'number' => 8,
    'format' => 'list',
    'separator' => '\n',
    'echo' => false,
  ];
  return $args;
}

// Admin Custom Styles
function admin_styles()
{
  echo '<style>
  .menu-item-bar .menu-item-handle, .menu-item-settings {
    width: 100%;
    box-sizing: border-box;
  }
  .menu-item-settings .acf-editor-wrap iframe {
    min-height: 150px;
  }
  #menu-management .menu-item-handle.ui-sortable-handle, #menu-management .menu-item-settings {
    max-width: none;
  }
  </style>';
}
add_action('admin_head', 'admin_styles');

// ACF Save Products
function product_save($post_id)
{
  $title = get_the_title($post_id);
  if (!get_field('prod_title', $post_id)) {
    update_field("prod_title", $title, $post_id);
  }
}
add_action('acf/save_post', 'product_save');

// Exclude products from a particular category on the shop page
function custom_pre_get_posts_query($q)
{
  $tax_query = (array) $q->get('tax_query');
  $tax_query[] = [
    'taxonomy' => 'product_cat',
    'field' => 'term_id',
    'terms' => [15],
    'operator' => 'NOT IN',
  ];
  $q->set('tax_query', $tax_query);
}
add_action('woocommerce_product_query', 'custom_pre_get_posts_query');

// Essential files
require_once 'aq_resizer.php';
require_once 'customepostitem.php';
require_once 'shortcodes.php';
require_once 'landing-contents.php';

// Remove jectpack css files
add_filter('jetpack_sharing_counts', '__return_false', 99);
add_filter('jetpack_implode_frontend_css', '__return_false', 99);

// Remove woocommerce files to prevent load in certain pages
function remove_woocommerce_files()
{
  if (
    !is_cart() &&
    !is_account_page() &&
    !is_checkout() &&
    !is_page_template('template-parts/template-vendors.php')
  ) {
    wp_dequeue_style('stripe_styles');
    wp_dequeue_style('select2');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('woocommerce-general');
    wp_dequeue_style('woocommerce-layout');
    wp_dequeue_style('woocommerce-smallscreen');
    wp_dequeue_style('woocommerce_frontend_styles');
    wp_dequeue_style('woocommerce_fancybox_styles');
    wp_dequeue_style('woocommerce_chosen_styles');
    wp_dequeue_style('woocommerce_prettyPhoto_css');
    wp_dequeue_script('wc_price_slider');
    wp_dequeue_script('wc-single-product');
    wp_dequeue_script('wc-add-to-cart');
    wp_dequeue_script('wc-cart-fragments');
    wp_dequeue_script('wc-checkout');
    wp_dequeue_script('wc-add-to-cart-variation');
    wp_dequeue_script('wc-single-product');
    wp_dequeue_script('wc-cart');
    wp_dequeue_script('wc-chosen');
    wp_dequeue_script('woocommerce');
    wp_dequeue_script('prettyPhoto');
    wp_dequeue_script('prettyPhoto-init');
    wp_dequeue_script('jquery-blockui');
    wp_dequeue_script('jquery-placeholder');
    wp_dequeue_script('jqueryui');
    wp_deregister_script('jquery');
    wp_dequeue_script('jquery');

    $wstyles = [
      'wp-block-library',
      'wc-blocks-style',
      'classic-theme-styles-inline'
    ];
    foreach ($wstyles as $wstyle) {
      wp_deregister_style($wstyle);
    }
    $wscripts = [
      'wc-blocks-middleware',
      'wc-blocks-data-store',
      'wc-order-attribution',
      'sourcebuster-js',
    ];
    foreach ($wscripts as $wscript) {
      wp_deregister_script($wscript);
    }
  }
  if (
    !is_admin() &&
    !is_woocommerce() &&
    !is_cart() &&
    !is_account_page() &&
    !is_checkout()
  ) {
    wp_deregister_script('wp-polyfill');
    wp_deregister_script('regenerator-runtime');
  }
}
add_action('wp_enqueue_scripts', 'remove_woocommerce_files', 20);

// Remove block editor styles to prevent loading
function remove_wp_block_library()
{
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wc-block-style');
  wp_dequeue_style('wc-blocks-style');
  wp_dequeue_style('wc-blocks-vendors-style-css');
  wp_dequeue_style('woo-multi-currency');
  wp_dequeue_style('wmc-flags');
  wp_deregister_script('woo-multi-currency');
  wp_dequeue_script('woo-multi-currency');
  wp_dequeue_script('fancybox');
}
add_action('wp_enqueue_scripts', 'remove_wp_block_library', 20);

// Remove WP scripts to prevent loading
function wp_deregister_scripts()
{
  wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'wp_deregister_scripts');

// Disable Emojis
function disable_emoji_feature()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'disable_emoji_feature');

// Single product functions
function update_product_info($product)
{
  $attr_cont = "";
  if (!get_post_meta($product->get_id(), '_yoast_wpseo_metadesc', true)) {
    $woo_attrs = get_woo_attribute(
      $product->get_attributes(),
      $product->get_id()
    );
    if ($woo_attrs) {
      $total_attr = count($woo_attrs);
      $attr_count = 0;
      foreach ($woo_attrs as $key => $value) {
        $attr_count++;
        if ($attr_count == $total_attr && $attr_count != 1) {
          $attr_cont .= " & ";
        } elseif ($attr_count == 1) {
          $attr_cont .= ". ";
        } else {
          $attr_cont .= ", ";
        }
        if (strpos($value, $key) !== false) {
          $attr_cont .= ucwords($value);
        } else {
          $attr_cont .= ucwords($value) . " " . ucwords($key);
        }
      }
    }
    $seo_desc =
      "Used " .
      $product->get_name() .
      " from Coast Machinery" .
      $attr_cont .
      ". All machines tested with a 45-day running warranty.";
    $prod_data = [
      'ID' => $product->get_id(),
      'meta_input' => [
        '_yoast_wpseo_metadesc' => $seo_desc,
      ],
    ];
    wp_update_post($prod_data);
  }
}

// Login form shortcode
function my_render_wc_login_form($atts)
{
  if (!is_user_logged_in()) {
    if (
      function_exists('woocommerce_login_form') &&
      function_exists('woocommerce_output_all_notices')
    ) {
      //render the WooCommerce login form
      ob_start();
      woocommerce_output_all_notices();
      woocommerce_login_form();
      return ob_get_clean();
    } else {
      //render the WordPress login form
      return wp_login_form(['echo' => false]);
    }
  } else {
    return "Hello there! Welcome back.";
  }
}
add_shortcode('web_login_form', 'my_render_wc_login_form');

/*
 * Zoho Inventory Functions
 *
 */

// When user profile updated
// Add Vendor to Zoho Inventory
function add_new_vendor($user_id, $old_user_data)
{
  $inital_update = get_field('inital_update', 'user_' . $user_id . '');
  $vendor_id = get_field('vendor_id', 'user_' . $user_id . '');
  $vendor_number = intval(get_field('vendor_number', 'user_' . $user_id . ''));
  if (!$inital_update && $vendor_number && !$vendor_id) {
    update_field('inital_update', true, 'user_' . $user_id . '');
    $email = get_userdata($user_id)->user_email;
    $first_name = get_user_meta($user_id, 'first_name', true);
    $last_name = get_user_meta($user_id, 'last_name', true);
    $vendor_name = get_user_meta($user_id, 'pv_shop_name', true);
    $description = get_user_meta($user_id, 'pv_shop_description', true);

    // Create vendor in Inventory
    $curl_pointer = curl_init();
    $url = "https://inventory.zoho.com/api/v1/contacts";
    $data =
      'JSONString={"contact_name": "' .
      $vendor_name .
      '","company_name": "' .
      $vendor_name .
      '","contact_type": "vendor","website": "' .
      $company_url .
      '","currency_id": 1360069000000000101,"contact_persons": [{"email": "' .
      $email .
      '","phone": "' .
      $phone .
      '","first_name": "' .
      $first_name .
      '","last_name": "' .
      $last_name .
      '"}],"custom_fields": [{"api_name": "cf_vendor","value": ' .
      $vendor_number .
      '}],"billing_address": {"address": "' .
      $address1 .
      '","street2": "' .
      $address2 .
      '","city": "' .
      $city .
      '","state": "' .
      $state .
      '","zip": "' .
      $postcode .
      '","country": "' .
      $country .
      '"}}';
    curl_setopt($curl_pointer, CURLOPT_URL, $url);
    curl_setopt($curl_pointer, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_pointer, CURLOPT_POST, 1);
    curl_setopt($curl_pointer, CURLOPT_POSTFIELDS, $data);
    $headersArray = [];
    $accesscode = accessGen();
    $headersArray[] = "Authorization" . ":" . "Zoho-oauthtoken " . $accesscode;
    $headers = [
      "Content-Type: application/x-www-form-urlencoded",
      "Content-length: .strlen($data)",
    ];
    curl_setopt($curl_pointer, CURLOPT_HTTPHEADER, $headersArray);

    $result = curl_exec($curl_pointer);
    $responseInfo = curl_getinfo($curl_pointer);
    curl_close($curl_pointer);
    if ($responseInfo['http_code'] != 204) {
      $output = json_decode($result);
      if ($output->contact->contact_id) {
        update_field(
          'vendor_id',
          $output->contact->contact_id,
          'user_' . $user_id . ''
        );
      }
      $to = $email;
      $headers = [
        "Content-Type: text/html; charset=UTF-8",
        "From: Coast Machinery Group <online@coastmachinery.com>",
      ];
      $title = "CMG Assigned you a Vendor Number";
      $btnlink = "https://www.coastmachinery.com/used-machinery-vendor";
      $btntext = "Login To Dashboard";
      $message = "<div style='text-align: center; padding: 40px 15px; background: #fafafa; color: #000;'><h1 style='font-family: sans-serif; font-size: 18px; font-weight: normal; margin: 0; margin-bottom: 15px;'>$title</h1><p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'><strong>Your Vendor Number is $vendor_number</strong></p>";
      $message .=
        '<a href="' .
        $btnlink .
        '" target="_blank" style="border: solid 1px #00548c; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #00548c; border-color: #00548c; color: #ffffff;">' .
        $btntext .
        '</a></div>';
      wp_mail($to, $title, $message, $headers);
    }
  }
}
add_action('profile_update', 'add_new_vendor', 10, 2);

// Product publish for the first time
// Add Product to Zoho Inventory
function product_to_inventory($new_status, $old_status, $post)
{
  global $post;
  if (
    $post->post_type !== 'product' ||
    $new_status !== 'publish' ||
    $old_status === 'publish'
  ) {
    return;
  }
  $vendor_number = 999;
  $vendor_name = "Coast Machinery Group Inc (2019)";
  $product = wc_get_product($post->ID);
  $user_id = get_post_field('post_author', $post->ID);
  if ($user_id) {
    $vendor_number = get_field('vendor_number', 'user_' . $user_id . '')
      ? get_field('vendor_number', 'user_' . $user_id . '')
      : $vendor_number;
    $vendor_name = get_user_meta($user_id, 'pv_shop_name', true)
      ? get_user_meta($user_id, 'pv_shop_name', true)
      : $vendor_name;
  }
  if ($vendor_name == "Coast Machinery Group Inc (2019)") {
    $inventory_type = "1360 Inventory - CMG";
    $accountid = "1360069000000871007";
    $preff_vendor = ',"vendor_id": "1360069000003749327"';
  } else {
    $inventory_type = "1363 Inventory - CMG:Consignment Inventory";
    $accountid = "1360069000000602009";
    $vendor_id = get_field('vendor_id', 'user_' . $user_id . '');
    $preff_vendor = ',"vendor_id": "' . $vendor_id . '"';
  }
  if ($product->get_sku() && $product->get_name() && $product->get_price()) {
    $pa_hp = array_shift(
      woocommerce_get_product_terms($product->get_id(), 'pa_hp', 'names')
    );
    $hp = $pa_hp
      ? ',{"customfield_id": "1360069000003607025","value": "' . $pa_hp . '"}'
      : '';
    $pa_voltage = array_shift(
      woocommerce_get_product_terms($product->get_id(), 'pa_voltage', 'names')
    );
    $voltage = $pa_voltage
      ? ',{"customfield_id": "1360069000003607031","value": "' .
      $pa_voltage .
      '"}'
      : '';
    $pa_phase = array_shift(
      woocommerce_get_product_terms($product->get_id(), 'pa_phase', 'names')
    );
    $phase = $pa_phase
      ? ',{"customfield_id": "1360069000003607037","value": "' .
      $pa_phase .
      '"}'
      : '';
    $pa_year = array_shift(
      woocommerce_get_product_terms($product->get_id(), 'pa_year-mfg', 'names')
    );
    $mfg = $pa_year
      ? ',{"customfield_id": "1360069000004045792","value": "' . $pa_year . '"}'
      : '';

    $curl_pointer = curl_init();
    $url = "https://inventory.zoho.com/api/v1/items";
    $data =
      'JSONString={"name": "' .
      $product->get_name() .
      '","initial_stock": "' .
      $product->get_stock_quantity() .
      '","sku": "' .
      $product->get_sku() .
      '","item_type": "inventory","is_returnable": true,"unit": "Machine","account_id": "1360069000000871009","account_name": "4020 Revenue:Product sales","purchase_account_id": "1360069000000871013","purchase_account_name": "5220 Cost of Goods Sold:Cost of Products:Machine Purchases","purchase_description": "","purchase_rate": 0,"pricebook_rate": 0,"track_batch_number": false,"inventory_account_id": "' .
      $accountid .
      '","inventory_account_name":  "' .
      $inventory_type .
      '","is_taxable": true,"rate": "' .
      $product->get_price() .
      '","sales_rate": "' .
      $product->get_price() .
      '","package_details": {"length": "' .
      $product->get_length() .
      '","width": "' .
      $product->get_width() .
      '","height": "' .
      $product->get_height() .
      '","weight": "' .
      $product->get_weight() .
      '"},"custom_fields": [{"customfield_id": "1360069000000602017","value": "' .
      $inventory_type .
      '"}' .
      $hp .
      $voltage .
      $phase .
      $mfg .
      ',{"customfield_id": "1360069000004879249","value": "' .
      $vendor_name .
      '"}]' .
      $preff_vendor .
      '}';
    curl_setopt($curl_pointer, CURLOPT_URL, $url);
    curl_setopt($curl_pointer, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_pointer, CURLOPT_POST, 1);
    curl_setopt($curl_pointer, CURLOPT_POSTFIELDS, $data);
    $headersArray = [];

    $accesscode = accessGen();
    $headersArray[] = "Authorization" . ":" . "Zoho-oauthtoken " . $accesscode;
    $headers = [
      "Content-Type: application/x-www-form-urlencoded",
      "Content-length: " . strlen($data),
    ];
    curl_setopt($curl_pointer, CURLOPT_HTTPHEADER, $headersArray);
    $result = curl_exec($curl_pointer);
    $responseInfo = curl_getinfo($curl_pointer);
    curl_close($curl_pointer);
  }
}
add_action('transition_post_status', 'product_to_inventory', 10, 3);

// Access Token Generator
function accessGen()
{
  $acctok__url =
    "https://accounts.zoho.com/oauth/v2/token?refresh_token=1000.a15ad485077f1b5cce28e9d0b81c4148.2dab2d6d2f00285f34c9ee540e983aa0&client_id=1000.8TR16IQ7R9OXWJB1BLUR3VS35X33VZ&client_secret=783f9f3dda7d167a1008da893d924d0f9608dfdc28&grant_type=refresh_token";
  $curl = curl_init($acctok__url);
  curl_setopt($curl, CURLOPT_URL, $acctok__url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $headers = [
    "Content-Type: application/x-www-form-urlencoded",
    "Content-Length: 0",
  ];
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $resp = curl_exec($curl);
  $access__token = json_decode($resp)->access_token;
  return $access__token;
}

// Add Extra field to the JWT plugin
add_filter('jwt_auth_token_before_dispatch', 'add_user_info_jwt', 10, 2);
function add_user_info_jwt($data, $user)
{
  $data['roles'] = implode(',', $user->roles);
  $data['userid'] = $user->ID;
  if (strpos($data['roles'], 'vendor') === false) {
    $output = [
      "code" => "jwt_auth_failed",
      "message" => "Not a Vendor",
    ];
    return $output;
  }
  return $data;
}
