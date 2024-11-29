<?php
/**
 * Show widget
 *
 * This template can be overridden by copying it to yourtheme/woo-currency/woo-currency_widget.php.
 *
 * @author        Cuong Nguyen
 * @package       Woo-currency/Templates
 * @version       1.0
 *
 */

if (!defined('ABSPATH')) {
  exit();
}
$currencies = $settings->get_list_currencies();
$current_currency = $settings->get_current_currency();
$links = $settings->get_links();
$currency_name = get_woocommerce_currencies();
?>

<div class="dropdown">
    <button class="btn px-2 btn-sm btn-outline-white dropdown-toggle d-flex align-items-center column-gap-1"
        type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo $current_currency; ?>
        <?php if (strpos($current_currency, 'USD') !== false) { ?>
        <img class="border-white border" width="20" height="10"
            src="<?php echo get_field('usa_flag', 'options')['url']; ?>"
            alt="<?php echo get_field('usa_flag', 'options')['alt']; ?>">
        <?php } else { ?>
        <img class="border-white border" width="20" height="10"
            src="<?php echo get_field('canada_flag', 'options')['url']; ?>"
            alt="<?php echo get_field('canada_flag', 'options')['alt']; ?>">
        <?php } ?>
    </button>
    <ul class="dropdown-menu shadow w-100">
        <?php foreach ($links as $code => $link) { $value = esc_url($link); ?>
        <li>
            <?php $selected = $current_currency === $code ? "active" : ""; ?>
            <a class="head__currency fs-6 dropdown-item <?php echo $selected; ?> d-flex justify-content-center align-items-center column-gap-1"
                <?php selected($current_currency, $code); ?> href="<?php echo $value; ?>"
                data-currency="<?php echo esc_attr($code); ?>">
                <?php echo esc_attr($code); ?>
                <?php if (strpos($code, 'USD') !== false) { ?>
                <img class="border-white border" width="20" height="10"
                    src="<?php echo get_field('usa_flag', 'options')['url']; ?>"
                    alt="<?php echo get_field('usa_flag', 'options')['alt']; ?>">
                <?php } else { ?>
                <img class="border-white border" width="20" height="10"
                    src="<?php echo get_field('canada_flag', 'options')['url']; ?>"
                    alt="<?php echo get_field('canada_flag', 'options')['alt']; ?>">
                <?php } ?>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>