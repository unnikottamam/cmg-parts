<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if (!defined('ABSPATH')) {
  exit(); // Exit if accessed directly.
}

if (is_user_logged_in()) {
  return;
}
if (!is_page(125202)) { ?>
<div class="row accountcont pt-1">
    <div class="col-md-8 col-lg-6 col-12">
        <?php } ?>
        <form class="woocommerce-form woocommerce-form-login login pb-4" method="post"
            <?php echo $hidden ? 'style="display:none;"' : ''; ?>>
            <?php do_action('woocommerce_login_form_start'); ?>
            <?php echo $message ? wpautop(wptexturize($message)) : ''; ?>

            <div class="row row-gap-1">
                <div class="fw-medium d-flex flex-column row-gap-1 col-12 form-row form-row-first">
                    <label for="username">
                        <?php esc_html_e('Username or email *', 'woocommerce'); ?>
                    </label>
                    <input type="text" class="form-control" name="username" id="username" autocomplete="username" />
                </div>
                <div class="fw-medium d-flex flex-column row-gap-1 col-12 form-row form-row-last">
                    <label for="password">
                        <?php esc_html_e('Password *', 'woocommerce'); ?>
                    </label>
                    <input class="form-control" type="password" name="password" id="password"
                        autocomplete="current-password" />
                </div>
                <div class="col-12">
                    <?php do_action('woocommerce_login_form'); ?>
                </div>
                <div class="col-12 pb-1">
                    <div class="form-check">
                        <input class="form-check-input woocommerce-form__input woocommerce-form__input-checkbox"
                            name="rememberme" type="checkbox" id="rememberme" value="forever" />
                        <label
                            class="fw-normal woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme"
                            for="rememberme">
                            <?php esc_html_e('Remember me', 'woocommerce'); ?>
                        </label>
                    </div>
                </div>
            </div>

            <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
            <input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>" />
            <div class="row align-items-center">
                <div class="col-sm-4 col-12 py-1">
                    <button type="submit"
                        class="woocommerce-button btn btn-success btn text-uppercase d-flex column-gap-1 woocommerce-form-login__submit"
                        name="login" value="<?php esc_attr_e('Login', 'woocommerce'); ?>">
                        <?php esc_html_e('Login', 'woocommerce'); ?>
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                            <path fill-rule="evenodd"
                                d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                        </svg>
                    </button>
                </div>
                <div class="col-sm-8 col-12 py-1 text-sm-end">
                    <a class="lost_password border-1 border-bottom text-primary border-primary-subtle fw-medium"
                        href="<?php echo esc_url(wp_lostpassword_url()); ?>">
                        <?php esc_html_e(
                            'Lost your password?',
                            'woocommerce'
                        ); ?>
                    </a>
                </div>
            </div>
            <?php do_action('woocommerce_login_form_end'); ?>
        </form>
        <?php if (!is_page(125202)) { ?>
    </div>
</div>
<?php }