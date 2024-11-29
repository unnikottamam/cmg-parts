<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Coast_Machinery
 */

get_header(); ?>

<section class="py-3 pb-4 error-404 not-found">
    <div class="container">
        <div class="row justify-content-center">
            <main class="col-lg-6 col-md-7 col-10 col-xl-4 text-center">
                <h1 class="fs-3 mb-2">
                    <strong>
                        <?php esc_html_e(
                          'Oops! That page can&rsquo;t be found.',
                          'coast-machinery'
                        ); ?>
                    </strong>
                </h1>
                <p>
                    <?php esc_html_e(
                      'It looks like nothing was found at this location. Maybe a search can help you.',
                      'coast-machinery'
                    ); ?>
                </p>
                <?php get_search_form(); ?>
            </main>
        </div>
        <h2 class="text-center fs-4 my-3">Some of our latest products</h2>
        <?php echo do_shortcode('[recent_products limit="20"]'); ?>
    </div>
</section>

<?php get_footer();