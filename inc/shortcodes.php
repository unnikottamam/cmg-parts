<?php
/**
 * Register all shortcodes
 *
 * @return null
 */
function register_shortcodes()
{
  add_shortcode('menu', 'print_menu_shortcode');
  add_shortcode('social-media', 'shortcode_social_media');
  add_shortcode('contact-list', 'shortcode_contact_list');
  add_shortcode('button', 'shortcode_button');
  add_shortcode('related-products', 'shortcode_relprods');
}
add_action('init', 'register_shortcodes');

/**
 * Menu Shortcode Callback
 */
function print_menu_shortcode($atts, $content = null)
{
  extract(shortcode_atts(['name' => null, 'class' => null], $atts));
  return wp_nav_menu([
    'menu' => $name,
    'menu_class' => $class,
    'echo' => false,
  ]);
}

/**
 * Social Media Shortcode Callback
 */
function shortcode_social_media()
{
  $html = '<ul class="socialicons">';
  $html .= '<li><a target="_blank" rel="noreferrer" href="https://www.facebook.com/CoastMachineryGroup/">
  <svg viewBox="0 0 24 24"><path d="m15.997 3.985h2.191v-3.816c-.378-.052-1.678-.169-3.192-.169-3.159 0-5.323 1.987-5.323 5.639v3.361h-3.486v4.266h3.486v10.734h4.274v-10.733h3.345l.531-4.266h-3.877v-2.939c.001-1.233.333-2.077 2.051-2.077z"/></svg><span class="sr-only">Facebook</span></a></li>';
  $html .= '<li><a target="_blank" rel="noreferrer" href="https://www.pinterest.ca/cmachinery/">
    <svg viewBox="0 0 511.977 511.977"><path d="M262.948 0C122.628 0 48.004 89.92 48.004 187.968c0 45.472 25.408 102.176 66.08 120.16 6.176 2.784 9.536 1.6 10.912-4.128 1.216-4.352 6.56-25.312 9.152-35.2.8-3.168.384-5.92-2.176-8.896-13.504-15.616-24.224-44.064-24.224-70.752 0-68.384 54.368-134.784 146.88-134.784 80 0 135.968 51.968 135.968 126.304 0 84-44.448 142.112-102.208 142.112-31.968 0-55.776-25.088-48.224-56.128 9.12-36.96 27.008-76.704 27.008-103.36 0-23.904-13.504-43.68-41.088-43.68-32.544 0-58.944 32.224-58.944 75.488 0 27.488 9.728 46.048 9.728 46.048l-38.176 154.336c-10.112 41.12 1.376 107.712 2.368 113.44.608 3.168 4.16 4.16 6.144 1.568 3.168-4.16 42.08-59.68 52.992-99.808l20.256-73.92c10.72 19.36 41.664 35.584 74.624 35.584 98.048 0 168.896-86.176 168.896-193.12C463.62 76.704 375.876 0 262.948 0z"/></svg><span class="sr-only">Pinterest</span></a></li>';
  $html .= '<li><a target="_blank" rel="noreferrer" href="https://www.linkedin.com/company/coast-machinery-group/">
    <svg viewBox="0 0 24 24"><path d="M23.994 24v-.001H24v-8.802c0-4.306-.927-7.623-5.961-7.623-2.42 0-4.044 1.328-4.707 2.587h-.07V7.976H8.489v16.023h4.97v-7.934c0-2.089.396-4.109 2.983-4.109 2.549 0 2.587 2.384 2.587 4.243V24zM.396 7.977h4.976V24H.396zM2.882 0C1.291 0 0 1.291 0 2.882s1.291 2.909 2.882 2.909 2.882-1.318 2.882-2.909S4.472 0 2.882 0z"/></svg><span class="sr-only">Linkedin</span></a></li>';
  $html .= '<li><a target="_blank" rel="noreferrer" href="https://www.instagram.com/coastmac/">
    <svg viewBox="0 0 511 511.9"><path d="M510.949 150.5c-1.199-27.199-5.598-45.898-11.898-62.102-6.5-17.199-16.5-32.598-29.602-45.398-12.801-13-28.301-23.102-45.301-29.5C407.851 7.199 389.25 2.801 362.05 1.602 334.648.301 325.949 0 256.449 0s-78.199.301-105.5 1.5c-27.199 1.199-45.898 5.602-62.098 11.898-17.203 6.5-32.602 16.5-45.402 29.602-13 12.801-23.098 28.301-29.5 45.301-6.301 16.301-10.699 34.898-11.898 62.098C.75 177.801.449 186.5.449 256l1.5 105.5c1.199 27.199 5.602 45.898 11.902 62.102 6.5 17.199 16.598 32.598 29.598 45.398 12.801 13 28.301 23.102 45.301 29.5 16.301 6.301 34.898 10.699 62.102 11.898 27.297 1.203 36 1.5 105.5 1.5l105.5-1.5c27.199-1.199 45.898-5.598 62.098-11.898 34.402-13.301 61.602-40.5 74.902-74.898 6.297-16.301 10.699-34.902 11.898-62.102 1.199-27.301 1.5-36 1.5-105.5l-1.301-105.5zm-46.098 209c-1.102 25-5.301 38.5-8.801 47.5a84.92 84.92 0 0 1-48.602 48.602c-9 3.5-22.598 7.699-47.5 8.797-27 1.203-35.098 1.5-103.398 1.5s-76.5-.297-103.402-1.5c-25-1.098-38.5-5.297-47.5-8.797C94.551 451.5 84.449 445 76.25 436.5c-8.5-8.301-15-18.301-19.102-29.398-3.5-9-7.699-22.602-8.797-47.5-1.203-27-1.5-35.102-1.5-103.402l1.5-103.398c1.098-25 5.297-38.5 8.797-47.5 4.102-11.103 10.602-21.2 19.204-29.404 8.297-8.5 18.297-15 29.398-19.098 9-3.5 22.602-7.699 47.5-8.801 27-1.199 35.102-1.5 103.398-1.5 68.402 0 76.5.301 103.402 1.5 25 1.102 38.5 5.301 47.5 8.801 11.098 4.098 21.199 10.598 29.398 19.098 8.5 8.301 15 18.301 19.102 29.402 3.5 9 7.699 22.598 8.801 47.5 1.199 27 1.5 35.098 1.5 103.398l-1.5 103.301zm-208.402-235c-72.598 0-131.5 58.898-131.5 131.5s58.902 131.5 131.5 131.5 131.5-58.898 131.5-131.5-58.898-131.5-131.5-131.5zm0 216.801c-47.098 0-85.301-38.199-85.301-85.301s38.203-85.301 85.301-85.301S341.75 208.898 341.75 256s-38.199 85.301-85.301 85.301zm0 0"/><path d="M423.852 119.301c0 16.953-13.746 30.699-30.703 30.699s-30.699-13.746-30.699-30.699 13.746-30.699 30.699-30.699 30.703 13.742 30.703 30.699zm0 0"/></svg><span class="sr-only">Instagram</span></a></li>';
  $html .= '</ul>';
  return $html;
}

/**
 * Contact List Shortcode Callback
 */
function shortcode_contact_list()
{
  $html = '<ul class="footcontact">';
  $html .=
    '<li><a href="tel:+16045562225"><span><svg viewBox="0 0 16 16"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg></span>+1 (604) 556-2225<br>(Canada)</a></li>';
  $html .=
    '<li><a href="tel:+18555565121"><span><svg viewBox="0 0 16 16"><path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg></span>+1 (855) 556-5121<br>(International)</a></li>';
  $html .=
    '<li><a href="mailto:sales@coastmachinery.com"><span><svg viewBox="0 0 16 16"><path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/></svg></span>sales@coastmachinery.com</a></li>';
  $html .=
    '<li><a target="_blank" rel="noreferrer" href="https://g.page/CoastMachineryGroup"><span><svg viewBox="0 0 16 16"><path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/><path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg></span>Unit 170 - 31789 King Rd,<br>Abbotsford, BC - V2T 5Z2,<br>Canada</a></li>';
  $html .= '</ul>';
  return $html;
}

/**
 * Button Shortcode Callback
 */
function shortcode_button($atts, $content = null)
{
  extract(
    shortcode_atts(
      ['text' => 'Read More', 'url' => null, 'class' => null],
      $atts
    )
  );
  $html =
    '<a class="btn btn-primary btn-xs ' .
    $class .
    '" href="' .
    $url .
    '">' .
    $text .
    '</a>';
  return $html;
}

/**
 * Realated Products Shortcode Callback
 */
function shortcode_relprods($atts, $content = null)
{
  extract(shortcode_atts(['id' => null], $atts));
  $html = "";
  $id = (int)$id;
  if ($id) {
    $args = [
      'post_type' => 'product',
      'posts_per_page' => 8,
      'orderby' => 'rand',
      'tax_query' => [
        [
          'taxonomy' => 'product_cat',
          'field' => 'term_id',
          'terms' => [$id],
        ],
      ],
      'meta_query' => [
        [
          'key' => '_stock_status',
          'value' => 'instock',
          'compare' => '=',
        ],
      ],
    ];
    query_posts($args);
    $catName = get_term($id)->name;
    $catLink = get_term_link($id, 'product_cat');
    if (have_posts()) {
      $html .= '<p>This unit is currently out of stock, but we have comparable machines in <a class="border-bottom border-primary-subtle" href="'.$catLink.'"><strong>Used '.$catName.'</strong></a>. Here are few similar products in Used '.$catName.'</p><div class="row g-1 row-cols-xl-4 row-cols-lg-3 row-cols-2">';
      while (have_posts()) {
        the_post();
        $product = wc_get_product(get_the_ID());
        $price = "";
        if ($product->get_price_html()) {
            $priceContent = wp_strip_all_tags($product->get_price_html());
            $dollarPos = strpos($priceContent, '$');
            if ($dollarPos !== false) {
              $beforeDollar = substr($priceContent, 0, $dollarPos);
              $afterDollar = substr($priceContent, $dollarPos + 1);
              $price = $beforeDollar . "<br /><span class='fw-bold'>$$afterDollar</span>";
            } else {
              $price = $priceContent;
            }
        }
        $prodName = $product->get_name();
        $imgId = $product->get_image_id();
        $fullImg = wp_get_attachment_image_src($imgId, 'full');

        $html .= '<div class="col"><a class="card h-100 shadow-sm overflow-hidden" href="'.get_permalink($product->get_id()).'">';
        $html .= '<div class="text-center position-relative overflow-hidden card__img">';
        $html .= '<div class="position-absolute bottom-0 left-0 z-1 bg-primary py-1 px-2 text-white fs-6 rounded-end-pill shadow-lg border-white border-top border-end">'.$product->get_sku().'</div>';
        if ($fullImg) {
          $prodImg = aq_resize($fullImg[0], 203, 203, true, true, true);
          $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : "Used $prodName";
          $html .= '<img class="w-100 d-block object-fit-cover" data-img="'.$prodImg.'" width="203" height="203" src="'.$prodImg.'" alt="'.$alt .'">';
        }
        $html .= '</div>';
        $html .= '<div class="card-body"><span class="fs-6"></span><h2 class="fs-6 pt-1 m-0">'.$prodName.'</h2></div>';
        $html .= '<div class="d-flex justify-content-between align-items-center px-2 border-top">';
        $html .= '<div class="w-60 text-success fs-6 border-end py-1">'.$price.'</span></div><button type="button" class="btn btn-outline-primary px-2 btn-sm"><svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"></path></svg><span class="d-none d-md-inline-block">View</span></button>';
        $html .= '</div>';
        $html .= '</a></div>';
      }
      $html .= '</div>';
      wp_reset_query();
    } else {
      $html .=
        '<p>This unit is currently out of stock, but we have comparable machines in <a href="'.$catLink.'">used '.$catName.'</a>.';
    }
    if ($endcat = get_term_by('id', $id, 'product_cat')) {
      $html .='<a class="btn btn-primary mt-3 text-uppercase" href="'.get_term_link($endcat).'">Used machines in '.$endcat->name.'</a>';
    }
  }
  return $html;
}