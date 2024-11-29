<?php
/**
 * Template part for displaying form modal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coast_Machinery
 */

$origin = "";
if (isset($_GET['origin'])) {
  $origin = "&LeadCity=" . $_GET['origin'];
}
?>

<div class="modal fade webmodal" id="form-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-4">
                <?php get_template_part('template-parts/contact', 'form', [
                  'type' => 'contact',
                  'labels' => false,
                  'primary' => true,
                ]); ?>
                <hr>
                <h3>Are you looking to consign your machinery?</h3>
                <p>Interested in consigning your used machinery with us? <br />Contact us to sell your machines today.
                </p>
                <a href="<?php echo get_permalink(
                  123028
                ); ?>" class="btn btn-outline-primary">Sell your machines</a>
            </div>
        </div>
    </div>
</div>