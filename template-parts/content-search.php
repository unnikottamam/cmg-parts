<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coast_Machinery
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <?php the_title(
          sprintf('<h2><a href="%s" rel="bookmark">', esc_url(get_permalink())),
          '</a></h2>'
        ); ?>

        <?php if ('post' === get_post_type()): ?>
        <div class="entry-meta">
            <?php
            coast_machinery_posted_on();
            coast_machinery_posted_by();
            ?>
        </div>
        <?php endif; ?>
    </header>
    <?php coast_machinery_post_thumbnail(); ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
    <footer class="entry-footer">
        <?php coast_machinery_entry_footer(); ?>
    </footer>
</article>