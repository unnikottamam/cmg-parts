<?php
/**
 * Template Name: Woocommerce
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */

get_header();
while (have_posts()) {
  the_post(); ?>
<section id="post-<?php the_ID(); ?>" <?php post_class('py-3 py-md-4'); ?>>
    <div class="container accountcont">
        <div class="row">
            <div class="col-12">
                <h1 class="fs-3 mb-2"><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php
}
get_footer();
?>