<?php
// Sales IQ Details
function salesiq_details($data)
{
  $page_links = [];

  foreach ($page_links as $page_link) {
    $post_id = url_to_postid($page_link);
    if (get_post_type($post_id) == 'product') {
      $product = wc_get_product($post_id);
      $post = get_post(get_the_ID());
      $out_data[] = [
        'stocks' => $product->get_stock_status(),
      ];
    } else {
      $out_data[] = [
        'stocks' => "",
      ];
    }
  }

  wp_send_json($out_data);
}
add_action('rest_api_init', function () {
  register_rest_route('wp/v3', '/salesiq-details', [
    'methods' => 'GET',
    'callback' => 'salesiq_details',
  ]);
});

?>