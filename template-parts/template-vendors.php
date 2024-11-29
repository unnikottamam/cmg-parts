<?php
/**
 * Template Name: Vendors
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */

get_header();

while (have_posts()) {
  the_post(); ?>
<section <?php post_class('py-3 py-md-5 vendormod'); ?>>
    <div class="container">
        <div class="row ">
            <div class="col-12">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php
}

get_footer();