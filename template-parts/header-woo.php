<?php
/**
 * Template part for displaying header woo cart and currency
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coast_Machinery
 */
?>

<li>
    <a href="<?php echo wc_get_cart_url(); ?>" class="header__cart">
        <span class="header__cartnum"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        <svg viewBox="0 0 16 16">
            <path
                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
        </svg>
    </a>
</li>
<li>
    <?php echo do_shortcode('[woo_multi_currency]'); ?>
</li>