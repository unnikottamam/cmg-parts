<?php
/**
 * Template Name: Brands
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */

 get_header();

 while (have_posts()) {
   the_post();
   ?>
<section class="pt-3 pb-4 py-md-4">
    <div class="container">
        <h1 class="fs-3 mb-2"><?php the_title(); ?></h1>
        <?php
        $page = get_query_var('paged') ? get_query_var('paged') : 1;
        $per_page = 30;
        $total_nums = count(get_terms('pwb-brand'));
        $offset = ($page - 1) * $per_page;
        $term_args = [
          'number' => $per_page,
          'offset' => $offset,
        ];
        $terms = get_terms('pwb-brand', $term_args);
        if ($terms) {
          echo '<div class="row g-2 row-cols-xl-5 row-cols-lg-4 row-cols-2 row-cols-md-3">';
          foreach ($terms as $term) {
            $term_acf = $term->taxonomy . '_' . $term->term_id;
            $term_link = get_term_link($term);
            ?>
        <div class="col">
            <a href="<?php echo esc_url($term_link); ?>"
                class="border d-flex flex-column justify-content-center align-items-center shadow border-1 gap-1 py-1">
                <?php
                if (get_field('brand_logo_url', $term_acf)) { ?>
                <img src="<?php echo get_field('brand_logo_url', $term_acf); ?>"
                    alt="<?php echo $term->name; ?> Used Woodworking, Metalworking, Stone & Glass Machinery parts">
                <?php } elseif (get_field('brand_logo', $term_acf)) {
                  $brand_logo = get_field('brand_logo', $term_acf); ?>
                <img src="<?php echo $brand_logo['url']; ?>" alt="<?php echo $term->name; ?>">
                <?php } else {
                  $logo_icon = get_field('logo_icon', 'options'); ?>
                <img class="noimage"
                    src="https://www.coastmachinery.com/wp-content/uploads/2020/11/used-machinery-dealer-north-america.png"
                    alt="<?php echo $term->name; ?>">
                <?php } ?>
                <span class="fw-medium pt-1"><?php echo $term->name; ?></span>
            </a>
        </div>
        <?php }
          echo '</div>';
          $big = 999999999;
          $links = paginate_links([
            'prev_text' =>
              '<svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>',
            'next_text' =>
              '<svg width="16" height="16" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>',
            'type' => 'array',
            'end_size' => 2,
            'mid_size' => 1,
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'total' => ceil($total_nums / $per_page),
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
</section>
<?php }

get_footer();