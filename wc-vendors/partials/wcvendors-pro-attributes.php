<?php
/**
 * Product Attributes
 *
 * This file is used to load the overall product attributes
 *
 * @link    http://www.wcvendors.com
 * @version 1.7.7
 * @since   1.3.0
 *
 * @package    WCVendors_Pro
 * @subpackage WCVendors_Pro/public/partials/product
 */
?>

<?php
global $wc_product_attributes;

// Product attributes - taxonomies and custom, ordered, with visibility and variation attributes set
$attribute_taxonomies = wc_get_attribute_taxonomies();

if ($attribute_taxonomies) {
  $count = 0;
  foreach ($attribute_taxonomies as $key => $tax) {

    if (
      in_array(
        $tax->attribute_id,
        explode(',', get_option('wcvendors_hide_attributes_list', ''))
      )
    ) {
      continue;
    }
    echo '<div class="col-md-4 col-6 form-item">';
    $label = $tax->attribute_label
      ? $tax->attribute_label
      : $tax->attribute_name;
    $i = $count++;
    $taxonomy = sanitize_text_field(
      wc_attribute_taxonomy_name($tax->attribute_name)
    );
    $position = $i;
    $metabox_class = [];
    $attribute = [
      'name' => $taxonomy,
      'value' => '',
      'is_visible' => apply_filters(
        'woocommerce_attribute_default_visibility',
        1
      ),
      'is_variation' => 0,
      'is_taxonomy' => $taxonomy ? 1 : 0,
    ];

    if ($taxonomy) {
      $attribute_taxonomy = $wc_product_attributes[$taxonomy];
      $metabox_class[] = 'taxonomy';
      $metabox_class[] = $taxonomy;
      $attribute_label = wc_attribute_label($taxonomy);
    } else {
      $attribute_label = '';
    }

    $attribute_types = wc_get_attribute_types();

    if (
      !array_key_exists(
        $attribute_taxonomy->attribute_type,
        $attribute_types
      ) ||
      !$attribute_taxonomy->attribute_type == 'text' ||
      !($attribute_taxonomy->attribute_type == 'select')
    ) {
      $attribute_taxonomy->attribute_type = 'select';
    }
    if ($attribute['is_taxonomy']) { ?>
<input type="hidden" name="attribute_names[<?php echo $i; ?>]" value="<?php echo esc_attr(
  $taxonomy
); ?>" />
<?php } else { ?>
<input type="text" class="form-control attribute_name" name="attribute_names[<?php echo $i; ?>]"
    value="<?php echo esc_attr($attribute['name']); ?>" />
<?php }
    ?>
<input type="hidden" name="attribute_position[<?php echo $i; ?>]" class="attribute_position" value="<?php echo esc_attr(
  $position
); ?>" id="attribute_position_<?php echo $i; ?>" />
<input type="hidden" name="attribute_is_taxonomy[<?php echo $i; ?>]" value="<?php echo $attribute[
  'is_taxonomy'
]
  ? 1
  : 0; ?>" />
<input type="hidden" name="attribute_visibility[<?php echo $i; ?>]" value="1" />
<?php
if ($attribute['is_taxonomy']) {
  if ($attribute_taxonomy->attribute_id == 4) { ?>
<label for="attribute_values_<?php echo $i; ?>"><?php echo $label; ?></label>
<select id="attribute_values_<?php echo $i; ?>" class="form-control" name="attribute_values[<?php echo $i; ?>][]">
    <option value="">Select <?php echo $label; ?> (Optional)</option>
    <?php
    $args = [
      'orderby' => !empty($attribute_taxonomy->attribute_orderby)
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
            has_term(absint($term->term_id), $taxonomy, $post_id),
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
      'orderby' => !empty($attribute_taxonomy->attribute_orderby)
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
        if (has_term(absint($term->term_id), $taxonomy, $post_id)) {
          $value[] = $term->name;
        }
      }
    }
    ?>
<label for="attribute_item_<?php echo $i; ?>"><?php echo $label; ?></label>
<div class="control-group">
    <input id="attribute_values_<?php echo $i; ?>" value="<?php echo $value[0]
  ? $value[0]
  : ''; ?>" class="sr-only d-none" type="text" name="attribute_values[<?php echo $i; ?>][]">
    <input id="attribute_item_<?php echo $i; ?>" type="text" value="<?php echo $value[0]
  ? $value[0]
  : ''; ?>" data-taxonomy="<?php echo $attribute_label; ?>" data-terms='<?php echo implode(
  ",",
  $termlist
); ?>' class="form-control wcv__attrchange" placeholder="<?php echo $label; ?> (Optional)">
</div>
<?php }
  do_action('wcv_product_option_terms', $attribute_taxonomy, $i, $attribute);
}
echo '</div>';

  }
}
?>
<input type="hidden" id="wcv-variation-attributes" data-variation_attr="" />