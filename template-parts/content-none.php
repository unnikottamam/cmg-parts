<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coast_Machinery
 */
?>

<article class="no-results not-found commcont">
    <div class="page-header">
        <h1 class="page-title">
            <?php esc_html_e('Nothing Found', 'coast-machinery'); ?>
        </h1>
    </div>
    <div class="page-content">
        <?php if (is_home() && current_user_can('publish_posts')) {
          printf(
            '<p>' .
              wp_kses(
                __(
                  'Ready to publish your first post? <a href="%1$s">Get started here</a>.',
                  'coast-machinery'
                ),
                [
                  'a' => [
                    'href' => [],
                  ],
                ]
              ) .
              '</p>',
            esc_url(admin_url('post-new.php'))
          );
        } elseif (is_search()) { ?>
        <p>
            <?php esc_html_e(
              'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
              'coast-machinery'
            ); ?>
        </p>
        <?php get_search_form();} else { ?>
        <p>
            <?php esc_html_e(
              'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.',
              'coast-machinery'
            ); ?>
        </p>
        <?php get_search_form();} ?>
    </div>
</article>