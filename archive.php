<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coast_Machinery
 */

get_header(); ?>

<section class="py-3 py-md-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-2">
                <?php if (have_posts()) { ?>
                <?php
                the_archive_title('<h1 class="fs-3 mb-2">', '</h1>');
                the_archive_description(
                  '<div class="archive-description">',
                  '</div>'
                );
                ?>
                <?php
                echo '<div class="row g-2 pt-1">';
                while (have_posts()) {
                  the_post();
                  get_template_part('template-parts/content', get_post_type());
                }
                echo '</div>';
                $links = paginate_links([
                  'prev_text' =>
                    '<svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>',
                  'next_text' =>
                    '<svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>',
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
                } else {get_template_part('template-parts/content', 'none');} ?>
            </div>
            <div class="col-lg-3 order-lg-0 pt-3 pt-lg-0">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();