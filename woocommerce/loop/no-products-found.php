<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined('ABSPATH') || exit(); ?>
<hr>
<p class="pt-3">Leave us your contact information and we'll contact you when we have something in stock. Have a look at
    our similar
    products.</p>
<div class="row">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="shadow-lg p-3 border">
            <?php get_template_part('template-parts/contact', 'form', [
          'type' => 'contact',
          'random' => rand(0, 99),
        ]); ?>
            <button type="button" class="form_submit mt-2 btn btn-success shadow-lg d-flex column-gap-2">
                <svg width="16" height="16" fill="currentColor"
                    class="bi bi-envelope" viewBox="0 0 16 16">
                    <path
                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z">
                    </path>
                </svg>
                Contact Us
            </button>
        </div>
    </div>
</div>