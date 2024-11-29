<?php
/**
 * Product Attribute
 *
 * This file is used to load the product attribute
 *
 * @link       http://www.wcvendors.com
 * @since      1.3.0
 * @version    1.7.3
 *
 * @package    WCVendors_Pro
 * @subpackage WCVendors_Pro/public/partials
 */
?>

<div data-index_value="<?php echo $i; ?>" data-label="<?php echo esc_html(
  $attribute_label
); ?>" data-taxonomy="<?php echo esc_attr(
  $taxonomy
); ?>" class="woocommerce_attribute wcv__attribute wcv-metabox closed <?php echo esc_attr(
  implode(' ', $metabox_class)
); ?>" rel="<?php echo $position; ?>">
    <h5 class="wcvattribute__title wcv__attrtitle">
        <strong class="attribute_name">
            <?php echo esc_html($attribute_label); ?>
        </strong>
        <a href="#" class="remove_row">
            <?php _e('Remove', 'wcvendors-pro'); ?>
        </a>
    </h5>

    <div class="wcv_attribute_data wcv-metabox-content wcv__attrcont">
        <div class="control-group" data-index_value="<?php echo $i; ?>">
            <?php if ($attribute['is_taxonomy']): ?>
            <input type="hidden" name="attribute_names[<?php echo $i; ?>]" value="<?php echo esc_attr(
  $taxonomy
); ?>" />
            <?php else: ?>
            <input type="text" class="form-control attribute_name" name="attribute_names[<?php echo $i; ?>]"
                value="<?php echo esc_attr($attribute['name']); ?>" />
            <?php endif; ?>
            <input type="hidden" name="attribute_position[<?php echo $i; ?>]" class="attribute_position" value="<?php echo esc_attr(
  $position
); ?>" id="attribute_position_<?php echo $i; ?>" />
            <input type="hidden" name="attribute_is_taxonomy[<?php echo $i; ?>]" value="<?php echo $attribute[
  'is_taxonomy'
]
  ? 1
  : 0; ?>" />
            <input type="hidden" name="attribute_visibility[<?php echo $i; ?>]" value="1" />
        </div>

        <div class="control-group">
            <div class="control wcv__attrcontrol" data-index_value="<?php echo $i; ?>"
                data-taxonomy="<?php echo $taxonomy; ?>" data-label="<?php echo esc_html(
  $attribute_label
); ?>">
                <?php if ($attribute['is_taxonomy']) {
                  if ($attribute_taxonomy->attribute_id == 4) { ?>
                <select id="attribute_values_<?php echo $i; ?>" class="form-control"
                    name="attribute_values[<?php echo $i; ?>][]">
                    <?php
                    $args = [
                      'orderby' => !empty(
                        $attribute_taxonomy->attribute_orderby
                      )
                        ? $attribute_taxonomy->attribute_orderby
                        : 'name',
                      'hide_empty' => 0,
                    ];
                    $all_terms = get_terms(
                      $taxonomy,
                      apply_filters('wcv_product_attribute_terms', $args)
                    );
                    if ($all_terms) {
                      foreach ($all_terms as $term) {
                        echo '<option value="' .
                          esc_attr($term->slug) .
                          '" ' .
                          selected(
                            has_term(
                              absint($term->term_id),
                              $taxonomy,
                              $post_id
                            ),
                            true,
                            false
                          ) .
                          '>' .
                          $term->name .
                          '</option>';
                      }
                    }
                    ?>
                </select>
                <?php } else {
                    $termlist = [];
                    $value = [];
                    $args = [
                      'orderby' => !empty(
                        $attribute_taxonomy->attribute_orderby
                      )
                        ? $attribute_taxonomy->attribute_orderby
                        : 'name',
                      'hide_empty' => 0,
                    ];
                    $all_terms = get_terms(
                      $taxonomy,
                      apply_filters('wcv_product_attribute_terms', $args)
                    );
                    if ($all_terms) {
                      foreach ($all_terms as $term) {
                        $termlist[] = $term->name;
                        if (
                          has_term(absint($term->term_id), $taxonomy, $post_id)
                        ) {
                          $value[] = $term->name;
                        }
                      }
                    }
                    ?>
                <div class="wcv__addblock">
                    <input id="attribute_values_<?php echo $i; ?>" value="<?php echo $value[0]
  ? $value[0]
  : ''; ?>" class="sr-only d-none" type="text" name="attribute_values[<?php echo $i; ?>][]">
                    <input type="text" value="<?php echo $value[0]
                      ? $value[0]
                      : ''; ?>" class="form-control wcv__attrchange" placeholder="Enter Value & press add button">
                    <button type="button" data-terms="<?php echo implode(
                      ",",
                      $termlist
                    ); ?>" class="wcv__addattr wcv__addbtn" data-selectid="attribute_values_<?php echo $i; ?>">
                        <?php _e('Add', 'wcvendors-pro'); ?>
                    </button>
                </div>
                <?php }
                  do_action(
                    'wcv_product_option_terms',
                    $attribute_taxonomy,
                    $i,
                    $attribute
                  );
                } ?>
            </div>
        </div>
    </div>
</div>