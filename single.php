<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Coast_Machinery
 */

get_header(); ?>

<main id="used-machine-blog<?php the_ID(); ?>" <?php post_class('py-3 py-md-4'); ?>>
    <div class="container">
        <div class="row">
            <article class="col-lg-9 order-lg-2">
                <?php while (have_posts()) {
                  the_post(); ?>
                <div class="commcont">
                    <?php
                    the_title('<h1 class="fs-3 mb-2">', '</h1>');
                    $blogTime = "";
                    if ('post' === get_post_type()) {
                      $blogTime =
                        '<time class="d-inline-block fs-6 ms-2 mt-2 bg-white shadow-sm border border-dark-subtle rounded-1 py-1 px-2 fw-semibold position-absolute start-0 top-0 fs-6" datetime="%1$s">Posted On : %2$s<sup>%3$s</sup> %4$s, %5$s</time>';
                      $blogTime = sprintf(
                        $blogTime,
                        esc_attr(get_the_date(DATE_W3C)),
                        esc_html(get_the_date('d')),
                        esc_html(get_the_date('S')),
                        esc_html(get_the_date('F')),
                        esc_html(get_the_date('Y'))
                      );
                    }
                    if (has_post_thumbnail()) {
                      echo '<div class="blog__img shadow-lg position-relative d-flex justify-content-center mb-2">';
                      echo $blogTime;
                      coast_machinery_post_thumbnail();
                      echo '</div>';
                    }
                    the_content();
                    ?>
                </div>
                <nav class="custom-navigation" role="navigation">
                    <div class="row h6 mb-0 border-top border-bottom border-primary-subtle mx-md-0">
                        <div class="col-6 px-lg-0 py-2">
                            <?php previous_post_link('%link', '<svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"></path></svg> Previous'); ?>
                        </div>
                        <div class="col-6 px-lg-0 text-end py-2">
                            <?php next_post_link('%link', 'Next <svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path></svg>'); ?>
                        </div>
                    </div>
                </nav>
                <?php } ?>
            </article>
            <div class="col-lg-3 order-lg-0 pt-3 pt-lg-0">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer();