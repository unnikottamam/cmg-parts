<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coast_Machinery
 */
?>

<article id="blog<?php the_ID(); ?>" <?php post_class('col-lg-4 col-sm-6'); ?>>
    <a href="<?php the_permalink(); ?>"
        class="h-100 d-flex flex-wrap flex-column border border-dark-subtle bg-white position-relative">
        <div class="blog__img shadow position-relative d-flex justify-content-center">
            <?php
            $fullImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $altText = get_the_post_thumbnail_caption()
              ? get_the_post_thumbnail_caption()
              : get_the_title();
            if ($fullImg) {
              $imgUrl = aq_resize($fullImg, 400, 200, true, true, true);
              echo '<img width="400" height="200" src="' .$imgUrl .'" alt="' .$altText .'" />';
            }

            if ('post' === get_post_type()) {
              $blogTime =
                '<time class="d-inline-block fs-6 ms-3 mb-2 bg-white shadow-sm border border-dark-subtle rounded-1 py-1 px-2 fw-semibold position-absolute start-0 bottom-0 fs-6" datetime="%1$s">%2$s<sup>%3$s</sup> %4$s, %5$s</time>';
              $blogTime = sprintf(
                $blogTime,
                esc_attr(get_the_date(DATE_W3C)),
                esc_html(get_the_date('d')),
                esc_html(get_the_date('S')),
                esc_html(get_the_date('F')),
                esc_html(get_the_date('Y'))
              );
            }
            echo $blogTime; ?>
        </div>
        <div class="p-3 pb-5">
            <?php
            the_title('<h2 class="fs-5 mb-1">', '</h2>');
            echo "<p>" . wp_trim_words(get_the_excerpt(), 16, '...') . "</p>";
            ?>
            <span class="btn btn-outline-primary d-inline-flex column-gap-1 position-absolute bottom-0 mb-3">
                Read More
                <svg width="16" height="16" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5">
                    </path>
                </svg>
            </span>
        </div>
    </a>
</article>