<?php
/**
 * Product Next Prev Navigation
 *
 */
defined('ABSPATH') || exit();
global $product;

$product_cats = wp_get_post_terms($product->get_id(), 'product_cat', [
  'fields' => 'ids',
  'orderby' => 'term_order',
]);
$first_term = array_pop($product_cats);
if ($product->get_date_created()) {
  $args = [
    'date_query' => [
      [
        'column' => 'post_date_gmt',
        'before' => [
          'year' => $product->get_date_created()->format('Y'),
          'month' => $product->get_date_created()->format('m'),
          'day' => $product->get_date_created()->format('d'),
        ],
      ],
    ],
    'tax_query' => [
      [
        'taxonomy' => 'product_cat',
        'field' => 'term_id',
        'terms' => [$first_term],
      ],
    ],
    'meta_query' => [
      [
        'key' => '_stock_status',
        'value' => 'instock',
        'compare' => '=',
      ],
    ],
    'posts_per_page' => 1,
  ];
  $args2 = [
    'date_query' => [
      [
        'column' => 'post_date_gmt',
        'after' => [
          'year' => $product->get_date_created()->format('Y'),
          'month' => $product->get_date_created()->format('m'),
          'day' => $product->get_date_created()->format('d'),
        ],
      ],
    ],
    'tax_query' => [
      [
        'taxonomy' => 'product_cat',
        'field' => 'term_id',
        'terms' => [$first_term],
      ],
    ],
    'meta_query' => [
      [
        'key' => '_stock_status',
        'value' => 'instock',
        'compare' => '=',
      ],
    ],
    'posts_per_page' => 1,
  ];
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $prev_link = get_the_permalink();
      $prev_title = get_the_title();
    }
  }
  wp_reset_query();
  $query = new WP_Query($args2);
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $next_link = get_the_permalink();
      $next_title = get_the_title();
    }
  }
  wp_reset_query();
  if ($prev_link || $next_link) { ?>
<nav class="navigation postnav" role="navigation" aria-label="Posts">
    <div class="nav-links">
        <?php
        if ($prev_link) { ?>
        <div class="nav-previous">
            <a href="<?php echo $prev_link; ?>" rel="prev"><span>Previous</span><?php echo $prev_title; ?></a>
        </div>
        <?php }
        if ($next_link) { ?>
        <div class="nav-next">
            <a href="<?php echo $next_link; ?>" rel="next"><span>Next</span><?php echo $next_title; ?></a>
        </div>
        <?php }
        ?>
    </div>
</nav>
<?php }
}