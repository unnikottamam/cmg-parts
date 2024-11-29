<?php
/**
 * Template Name: Craiglist Listing
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */
if (isset($_GET['id'])) {
  $url_id = $_GET['id'];
} else {
  wp_redirect(home_url());
  exit();
}
$user = wp_get_current_user();
$allowed_roles = ['administrator'];
if (array_intersect($allowed_roles, $user->roles)) {
  $req =
    "https://www.coastmachinery.com/wp-json/wp/v3/coast-machines?id=" . $url_id;

  $args = [
    'post_type' => 'product',
    'posts_per_page' => 1,
    'p' => $url_id,
  ];

  $query = new WP_Query($args);
  if ($query->have_posts()) {
    $count = 0;
    while ($query->have_posts()) {
      $query->the_post();
      $product = wc_get_product(get_the_ID());

      $product_cats = wp_get_post_terms($product->get_id(), 'product_cat', [
        'orderby' => 'term_order',
      ]);
      $first_term = array_pop($product_cats);

      $title =
        "<h1><strong>Used " .
        ucwords($product->get_name()) .
        " - in " .
        ucwords($first_term->name) .
        " </strong><br />For Sale On Craigslist.Org Classifieds</h1><hr />";
      echo $title;

      echo "<p><strong>SKU: </strong>" . $product->get_sku();
      if ($price_html = $product->get_price_html()) {
        echo "<br /><strong>Price: </strong>" . wp_strip_all_tags($price_html);
      }
      echo "</p>";

      if (!get_field('craiglist_des') && !get_field('craiglist_tags')) {
        $content = str_ireplace(
          ['<h6', '</h6>'],
          ['<h4', '</h4>'],
          get_the_content()
        );
        echo $content;

        $parent_cats = get_ancestors($first_term->term_id, 'product_cat');
        $parent_cat = get_term_by('id', array_pop($parent_cats), 'product_cat');
        $terms = get_the_terms(get_the_ID(), 'product_cat');
        if ($terms && !is_wp_error($terms)) {
          echo "<p><strong>Categorized in: </strong></p><ul>";
          echo $parent_cat
            ? "<li><strong>" . ucwords($parent_cat->name) . "</strong></li>"
            : '';
          foreach ($terms as $term) {
            echo "<li><strong>" . ucwords($term->name) . "</strong></li>";
          }
          echo "</ul>";
        }
      } else {
        the_field('craiglist_des');

        $parent_cats = get_ancestors($first_term->term_id, 'product_cat');
        $parent_cat = get_term_by('id', array_pop($parent_cats), 'product_cat');
        $terms = get_the_terms(get_the_ID(), 'product_cat');
        if ($terms && !is_wp_error($terms)) {
          echo "<p><strong>Categorized in: </strong></p><ul>";
          echo $parent_cat
            ? "<li><strong>" . ucwords($parent_cat->name) . "</strong></li>"
            : '';
          foreach ($terms as $term) {
            echo "<li><strong>" . ucwords($term->name) . "</strong></li>";
          }
          echo "</ul>";
        }

        if (
          $product->get_weight() ||
          $product->get_length() ||
          $product->get_width() ||
          $product->get_height()
        ) {
          $product->get_weight();
          echo "<p><strong>Dimensions: </strong></p><ul>";
          echo $product->get_weight()
            ? "<li><strong>Weight: </strong>" .
              round(wc_get_weight($product->get_weight(), 'kg', 'lbs'), 2) .
              " lbs</li>"
            : '';
          echo $product->get_length()
            ? "<li><strong>Length: </strong>" .
              $product->get_length() .
              " inches</li>"
            : '';
          echo $product->get_width()
            ? "<li><strong>Width: </strong>" .
              $product->get_width() .
              " inches</li>"
            : '';
          echo $product->get_height()
            ? "<li><strong>Height: </strong>" .
              $product->get_height() .
              " inches</li>"
            : '';
          echo "</ul>";
        }

        $woo_attrs = get_woo_attribute(
          $product->get_attributes(),
          get_the_ID()
        );
        if ($woo_attrs) {
          echo '<strong>More Information: </strong><ol>';
          foreach ($woo_attrs as $key => $value) {
            echo '<li><strong>' . $key . ':</strong> ' . $value . '</li>';
          }
          echo '</ol>';
        }
        the_field('craiglist_tags');
      }
    }
  }
  wp_reset_query();
}