<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coast_Machinery
 */
?>

<section id="post-<?php the_ID(); ?>" <?php post_class('py-3 py-md-4'); ?>>
    <div class="container commcont">
        <div class="row justify-content-center">
            <div class="col-md-11 col-lg-10">
                <div>
                    <h1 class="fs-2 mb-2"><?php the_title(); ?></h1>
                    <?php
                    the_content();
                    if (is_page(27540)) {
                      $taxonomy = 'product_cat';
                      $orderby = 'name';
                      $show_count = true;
                      $pad_counts = true;
                      $hierarchical = true;

                      $args = [
                        'taxonomy' => $taxonomy,
                        'orderby' => $orderby,
                        'show_count' => $show_count,
                        'pad_counts' => $pad_counts,
                        'hierarchical' => $hierarchical,
                      ];
                      ?>
                    <ul>
                        <?php wp_list_categories($args); ?>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>