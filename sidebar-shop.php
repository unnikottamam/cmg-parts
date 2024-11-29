<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Coast_Machinery
 */
?>

<aside id="shopsidebar" class="shopsidebar">
    <nav>
        <button aria-label="Product Categories" class="sidemenutrig">Product Categories</button>
        <?php
        $product_cats = get_terms([
          'taxonomy' => 'product_cat',
          'parent' => 0,
          'hide_empty' => true,
          'exclude' => [15],
        ]);
        if ($product_cats) {
          echo '<ul class="sidecatmenu">';
          foreach ($product_cats as $category) { ?>
        <li <?php if (
          get_queried_object()->term_id == $category->term_id ||
          term_is_ancestor_of(
            $category->term_id,
            get_queried_object(),
            'product_cat'
          )
        ) { ?>class="active" <?php } ?>>
            <a title="<?php echo $category->name; ?>" data-pop="<?php echo $category->slug; ?>" href="#category-modal">
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
</aside>