<?php
/**
 * The template for displaying the Product edit form
 *
 * Override this template by copying it to yourtheme/wc-vendors/dashboard/
 *
 * @package    WCVendors_Pro
 * @version    1.6.3
 */

/**
 *   DO NOT EDIT ANY OF THE LINES BELOW UNLESS YOU KNOW WHAT YOU'RE DOING
 */

$title = is_numeric($object_id)
  ? __('Save Changes', 'wcvendors-pro')
  : __('Add Product', 'wcvendors-pro');
$page_title = is_numeric($object_id)
  ? __('Edit Product', 'wcvendors-pro')
  : __('Add Product', 'wcvendors-pro');
$product = is_numeric($object_id) ? wc_get_product($object_id) : null;
$post = is_numeric($object_id) ? get_post($object_id) : null;

$product_title =
  isset($product) && null !== $product ? $product->get_title() : '';
$product_description =
  isset($product) && null !== $product ? $post->post_content : '';
$product_short_description =
  isset($product) && null !== $product ? $post->post_excerpt : '';
$post_status = isset($product) && null !== $product ? $post->post_status : '';
?>

<?php do_action('wcvendors_before_product_form'); ?>
<h1><?php echo $page_title; ?></h1>
<form method="post" action="" id="wcv-product-edit" class="wcv-form">
    <div class="row">
        <?php do_action('wcv_before_product_details', $object_id); ?>
        <div class="col-sm-6 form-item">
            <?php WCVendors_Pro_Product_Form::title(
              $object_id,
              $product_title
            ); ?>
        </div>
        <div class="col-sm-6 form-item">
            <?php WCVendors_Pro_Form_Helper::input([
              'post_id' => $object_id,
              'type' => 'text',
              'id' => '_wcv_custom_product_location',
              'label' => __('Location (Optional)', 'wcvendors-pro'),
              'placeholder' => __('E.g. Langley', 'wcvendors-pro'),
            ]); ?>
        </div>
        <div class="col-sm-6 form-item">
            <?php
            $activecat = wp_get_post_terms($object_id, 'product_cat');
            $term_id = "";
            if ($activecat) {
              $term_id = $activecat[0]->term_id;
            }
            ?>
            <label for="product_cat">Category *</label>
            <select id="product_cat" name="product_cat[]" class="form-control" required
                data-parsley-error-message="Please select a category.">
                <option value="">Select a Category</option>
                <?php
                $prod_cat = get_terms([
                  'taxonomy' => 'product_cat',
                  'parent' => 0,
                  'exclude' => [15],
                ]);
                foreach ($prod_cat as $cat) { ?>
                <optgroup label="<?php echo $cat->name; ?>">
                    <?php
                    $cats_inn = get_terms([
                      'taxonomy' => 'product_cat',
                      'parent' => $cat->term_id,
                    ]);
                    foreach ($cats_inn as $cat_inn) { ?>
                    <option <?php if ($activecat) {
                      selected($term_id, $cat_inn->term_id);
                    } ?> value="<?php echo $cat_inn->term_id; ?>"><?php echo $cat_inn->name; ?></option>
                    <?php }
                    ?>
                    <option <?php if ($activecat) {
                      selected($term_id, $cat->term_id);
                    } ?> value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
                </optgroup>
                <?php }
                ?>
            </select>
        </div>
        <div class="col-sm-6 form-item">
            <?php WCVendors_Pro_Product_Form::prices($object_id); ?>
            <p class="m-0 pt-1" style="font-size: 14px; line-height: 1.3;">*What is the retail price including CMG’s 20%
                commission</p>
        </div>
        <div class="col-12 form-item mb-3">
            <?php WCVendors_Pro_Product_Form::description(
              $object_id,
              $product_description
            ); ?>
        </div>
        <?php do_action('wcv_after_product_details', $object_id); ?>

        <div class="col-12">
            <h2 class="mt-2 mb-3">Specifications</h2>
        </div>
        <div class="col-md-4 col-6 form-item">
            <?php WCVendors_Pro_Product_Form::weight($object_id); ?>
        </div>
        <?php WCVendors_Pro_Product_Form::dimensions($object_id); ?>

        <?php do_action('wcv_before_attributes_tab', $object_id); ?>
        <?php WCVendors_Pro_Product_Form::product_attributes($object_id); ?>
        <?php do_action(
          'wcv_product_options_attributes_product_data',
          $object_id
        ); ?>
        <?php do_action('wcv_after_attributes_tab', $object_id); ?>
    </div>

    <div class="text-center">
        <hr>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <h3 class="wcv__danger">Follow our guidelines</h3>
                <p>Please follow our instructions while uploading product images and videos, so that your product
                    will be easily reached out to the buyers.</p>
                <a data-toggle="modal" data-target="#media-modal" href="#media-modal"
                    class="btn btn-sm btn-danger">Media upload instructions</a>
            </div>
        </div>
    </div>
    <div class="wcv-product-media">
        <?php do_action('wcv_before_product_media', $object_id); ?>
        <?php WCVendors_Pro_Form_helper::product_media_uploader($object_id); ?>
        <?php do_action('wcv_after_product_media', $object_id); ?>
    </div>

    <div class="wcv-product-video">
        <?php
        function wcv_product_video($value)
        {
          echo '<h6>Video Uploader <br /><small>Upload a phone video of your machine in action. Try to put material through to show your machine in working order.</small></h6>';
          WCVendors_Pro_Form_Helper::file_uploader(
            [
              'id' => '_wcv_custom_product_video',
              'header_text' => __('Video uploader', 'wcvendors-pro'),
              'add_text' => __('Add video', 'wcvendors-pro'),
              'remove_text' => __('Remove video', 'wcvendors-pro'),
              'file_meta_key' => '_wcv_custom_product_video',
              'save_button' => __('Add video', 'wcvendors-pro'),
              'window_title' => __('Select video', 'wcvendors-pro'),
              'value' => $value,
            ],
            'video'
          );
        }
        wcv_product_video(
          get_post_meta($object_id, '_wcv_custom_product_video', true)
        );
        ?>
    </div>

    <?php do_action('wcv_after_product_simple_before', $object_id); ?>
    <?php WCVendors_Pro_Product_Form::product_type_hidden(
      $object_id,
      'simple'
    ); ?>
    <?php do_action('wcv_after_product_simple_after', $object_id); ?>

    <input type="hidden" name="_manage_stock" id="_manage_stock" value="yes">
    <input type="hidden" name="_stock" id="_stock" value="1">

    <?php WCVendors_Pro_Product_Form::form_data(
      $object_id,
      $post_status,
      $template
    ); ?>

    <?php WCVendors_Pro_Product_Form::save_button($title); ?>
    <?php WCVendors_Pro_Product_Form::draft_button(
      __('Save Draft', 'wcvendors-pro')
    ); ?>
</form>

<script>
jQuery(function($) {
    $('#wcv-product-edit').submit(function() {
        $(".wcv__attrchange").each(function(i) {
            var new_attribute_name = $(this).val();
            var taxonomy = $(this).data('taxonomy');
            var taxonomyName = $(this).data('taxonomy');
            var newInputVal = $(this).parent().find('.sr-only');
            var currentList = $(this).data('terms');

            if (new_attribute_name) {
                if (currentList.toLowerCase().indexOf(new_attribute_name) >= 0) {
                    newInputVal.val(new_attribute_name);
                } else {
                    var data = {
                        action: 'wcv_json_add_new_attribute',
                        taxonomy: taxonomy,
                        term: new_attribute_name,
                        security: wcv_frontend_product.wcv_add_attribute_nonce
                    };
                    $.post(wcv_frontend_product.ajax_url, data, function(response) {
                        if (response.error) {} else if (response.slug) {
                            newInputVal.val(response.name);
                        }
                    });
                }
                $(this).parent().append(
                    `<div class="attrinfo tip success">${new_attribute_name} is successfully added as ${taxonomyName}</div>`
                );
            } else {
                newInputVal.val("");
            }
        });
        return true;
    });
});
</script>

<?php do_action('wcvendors_after_product_form'); ?>

<div class="modal fade webmodal wcv__modal" id="media-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-4">
                <h2>Image / Video upload guidelines</h2>
                <hr>
                <div class="row text-center">
                    <div class="col-sm-6 wcv__guide">
                        <img src="https://www.coastmachinery.com/wp-content/uploads/2020/11/used-machinery-products-focus.png"
                            alt="Good">
                        <h5>Focus</h5>
                        <p>Photos are clear, sharp and in focus.</p>
                    </div>
                    <div class="col-sm-6 wcv__guide">
                        <img src="https://www.coastmachinery.com/wp-content/uploads/2020/11/used-machinery-products-lighting.png"
                            alt="Good">
                        <h5>Lighting</h5>
                        <p>Equipment is well lit and clearly visible.</p>
                    </div>
                    <div class="col-sm-6 wcv__guide">
                        <img src="https://www.coastmachinery.com/wp-content/uploads/2020/11/used-machinery-products-presentable.png"
                            alt="Good">
                        <h5>Presentable</h5>
                        <p>Ensure the machine is clean and presentable.</p>
                    </div>
                    <div class="col-sm-6 wcv__guide">
                        <img src="https://www.coastmachinery.com/wp-content/uploads/2020/11/used-machinery-products-details.png"
                            alt="Good">
                        <h5>Details</h5>
                        <p>Include photos of manufacturer’s tags: model, serial #, voltage, phase, etc.</p>
                    </div>
                    <div class="col-sm-6 wcv__guide">
                        <img src="https://www.coastmachinery.com/wp-content/uploads/2020/11/used-machinery-products-orientation.png"
                            alt="Good">
                        <h5>Orientation</h5>
                        <p>All photos must be taken in horizontal landscape, in fact 1:1 ratio is recommended.</p>
                    </div>
                    <div class="col-sm-6 wcv__guide">
                        <img src="https://www.coastmachinery.com/wp-content/uploads/2020/11/used-machinery-products-positioning.png"
                            alt="Good">
                        <h5>Positioning</h5>
                        <p>Include full frame shots of the equipment; do not cut off parts and ensure the subject is
                            centered.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>