<?php
/**
 * Template Name: Landing Page Listing
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */
get_header(); ?>

<section id="post-<?php the_ID(); ?>" <?php post_class('pt-2 pb-3 py-md-3'); ?>>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="pagebox">
                    <?php
                    if (have_posts()) {
                      while (have_posts()) {
                        the_post();
                        the_content();
                      }
                    }
                    $paged = get_query_var('paged')
                      ? get_query_var('paged')
                      : 1;
                    $args = [
                      'post_type' => 'used-machine-parts',
                      'posts_per_page' => 30,
                      'paged' => $paged,
                      'orderby ' => 'ID',
                      'order' => 'ASC',
                    ];
                    query_posts($args);
                    if (have_posts()) {
                      echo '<ul class="citylists">';
                      while (have_posts()) {
                        the_post();
                        $term = get_field('select_category');
                        ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php echo get_field(
                              'display_name',
                              $term->taxonomy . '_' . $term->term_id
                            ) .
                              " - " .
                              get_field('city_name'); ?>
                        </a>
                    </li>
                    <?php }
                      echo '</ul>';
                      $links = paginate_links([
                        'prev_text' => '<svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>',
                        'next_text' => '<svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>',
                        'type' => 'array',
                        'end_size' => 2,
                        'mid_size' => 1,
                      ]);
                      if ($links) {
                        echo '<nav><ul class="list-unstyled d-flex flex-wrap gap-1 pt-3">';
                        foreach ($links as $link) {
                          $link = str_replace("current", "active", $link);
                          echo '<li>'.str_replace("page-numbers", "btn btn-sm btn-outline-primary", $link).'</li>';
                        }
                        echo '</ul></nav>';
                      }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();