<?php
/**
 * Template part for displaying equipment modal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coast_Machinery
 */
?>

<div class="modal fade webmodal" id="equipment-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <?php if (have_rows('wanted_list', 'options')) { ?>
                <?php while (have_rows('wanted_list', 'options')) {
                  the_row(); ?>
                <div class="webmodal__cont">
                    <?php the_sub_field('contents'); ?>
                </div>
                <div class="equiplists">
                    <?php if (have_rows('equipment_list')) {
                      echo '<div class="row">';
                      while (have_rows('equipment_list')) {
                        the_row(); ?>
                    <div class="equiplists__item col-md-6">
                        <a href="mailto:sales@coastmachinery.com,Cyril@Coastmachinery.Com?subject=Equipment Wanted Inquiry - <?php the_sub_field(
                          'equipment_name'
                        ); ?>">
                            <?php the_sub_field('equipment_name'); ?>
                        </a>
                    </div>
                    <?php
                      }
                      echo '</div>';
                    } else {
                       ?>
                    <a href="<?php echo get_permalink(
                      101
                    ); ?>" class="btn btn-primary btn-sm">Contact Us</a>
                    <?php
                    } ?>
                </div>
                <?php
                }} ?>
            </div>
        </div>
    </div>
</div>