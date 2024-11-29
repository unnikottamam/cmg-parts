<?php
/**
 * The template for displaying the Pro Dashboard navigation
 *
 * Override this template by copying it to yourtheme/wc-vendors/dashboard/
 *
 * @var       $page_url          The permalink to the page
 * @var       $page_label        The page label for the menu item
 * @package    WCVendors_Pro
 * @version    1.0.3
 */
?>
<li id="dashboard-menu-item-<?php echo esc_attr(
  $id
); ?>" class="<?php echo esc_attr($class); ?>">
    <a href="<?php echo esc_html($page_url); ?>" <?php if ($target) {
  echo esc_html('target="' . $target . '"');
} ?>>
        <?php echo esc_html($page_label) == "Dashboard"
          ? "Home Screen"
          : esc_html($page_label); ?>
    </a>
</li>
<?php if ($id === 'settings') { ?>
<li id="dashboard-menu-item-logout">
    <a href="<?php echo wp_logout_url(get_page_link(125202)); ?>">
        Logout
    </a>
</li>
<?php }