<?php
/**
 * Template part for displaying category modal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coast_Machinery
 */
?>

<div class="modal fade catmodal" id="category-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <nav class="productsmenu">
                    <button class="catmodal__trigg d-block d-md-none" aria-label="Product Categories">Product
                        Categories</button>
                    <?php
                    $product_cats = get_terms([
                      'taxonomy' => 'product_cat',
                      'parent' => 0,
                      'exclude' => [15],
                    ]);
                    if ($product_cats) {
                      echo '<ul class="catmanu">';
                      foreach ($product_cats as $category) { ?>
                    <li data-product="<?php echo $category->slug; ?>">
                        <a href="#coast-machine-<?php echo $category->slug; ?>">
                            <?php echo get_field('friendly_name', $category)
                              ? get_field('friendly_name', $category)
                              : $category->name; ?>
                        </a>
                    </li>
                    <?php }
                      echo '</ul>';
                    }
                    ?>
                </nav>
                <?php
                $product_cats = get_terms([
                  'taxonomy' => 'product_cat',
                  'parent' => 0,
                  'exclude' => [15],
                ]);
                if ($product_cats) {
                  foreach ($product_cats as $category) {
                    echo '<div id="coast-machine-' .
                      $category->slug .
                      '" class="catmodal__tab">'; ?>
                <div class="modalhead">
                    <h2><?php echo $category->name; ?></h2>
                    <a href="<?php echo esc_url(
                      get_term_link($category)
                    ); ?>">View All</a>
                </div>
                <?php
                $category_inn = get_terms([
                  'taxonomy' => 'product_cat',
                  'parent' => $category->term_id,
                ]);
                if ($category_inn) { ?>
                <nav class="productsmenu__inn">
                    <ul>
                        <?php foreach ($category_inn as $cat_inn) {
                          $cats_subs_subs = null;
                          $cats_subs_subs = get_terms([
                            'taxonomy' => 'product_cat',
                            'parent' => $cat_inn->term_id,
                          ]);
                          if ($cats_subs_subs) { ?>
                        <li class="haschild">
                            <a href="<?php echo esc_url(
                              get_term_link($cat_inn)
                            ); ?>">
                                <?php echo $cat_inn->name; ?>
                            </a>
                            <span></span>
                            <ul class="submenu">
                                <?php foreach (
                                  $cats_subs_subs
                                  as $cat_inn_sub
                                ) {
                                  $cats_subs_inn = get_terms([
                                    'taxonomy' => 'product_cat',
                                    'parent' => $cat_inn_sub->term_id,
                                  ]);
                                  if ($cats_subs_inn) { ?>
                                <li class="haschild">
                                    <a href="<?php echo esc_url(
                                      get_term_link($cat_inn_sub)
                                    ); ?>">
                                        <?php echo $cat_inn_sub->name; ?>
                                    </a>
                                    <span></span>
                                    <ul class="submenu">
                                        <?php foreach (
                                          $cats_subs_inn
                                          as $cats_inn
                                        ) { ?>
                                        <li><a href="<?php echo esc_url(
                                          get_term_link($cats_inn)
                                        ); ?>"><?php echo $cats_inn->name; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } else { ?>
                                <li><a href="<?php echo esc_url(
                                  get_term_link($cat_inn_sub)
                                ); ?>"><?php echo $cat_inn_sub->name; ?></a></li>
                                <?php }
                                } ?>
                            </ul>
                        </li>
                        <?php } else { ?>
                        <li>
                            <a href="<?php echo esc_url(
                              get_term_link($cat_inn)
                            ); ?>">
                                <?php echo $cat_inn->name; ?>
                            </a>
                        </li>
                        <?php }
                        } ?>
                    </ul>
                </nav>
                <?php }
                echo '</div>';

                  }
                }
                ?>
            </div>
        </div>
    </div>
</div>