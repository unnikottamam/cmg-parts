<?php

/**
 * Coast Machinery functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Coast_Machinery
 */

if (!defined('_S_VERSION')) {
  // Replace the version number of the theme on each release.
  define('_S_VERSION', '1.0.0');
}

if (!function_exists('coast_machinery_setup')) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function coast_machinery_setup()
  {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Coast Machinery, use a find and replace
     * to change 'coast-machinery' to the name of your theme in all the template files.
     */
    load_theme_textdomain(
      'coast-machinery',
      get_template_directory() . '/languages'
    );

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus([
      'menu-1' => esc_html__('Primary', 'coast-machinery'),
    ]);

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', [
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    ]);

    // Set up the WordPress core custom background feature.
    add_theme_support(
      'custom-background',
      apply_filters('coast_machinery_custom_background_args', [
        'default-color' => 'ffffff',
        'default-image' => '',
      ])
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support('custom-logo', [
      'height' => 250,
      'width' => 250,
      'flex-width' => true,
      'flex-height' => true,
    ]);
  }
endif;
add_action('after_setup_theme', 'coast_machinery_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function coast_machinery_content_width()
{
  $GLOBALS['content_width'] = apply_filters(
    'coast_machinery_content_width',
    640
  );
}
add_action('after_setup_theme', 'coast_machinery_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function coast_machinery_widgets_init()
{
  register_sidebar([
    'name' => esc_html__('Sidebar', 'coast-machinery'),
    'id' => 'sidebar-1',
    'description' => esc_html__('Add widgets here.', 'coast-machinery'),
    'before_widget' => '<div id="%1$s" class="sidewidgets %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="fs-4 mb-1">',
    'after_title' => '</h2>',
  ]);
  register_sidebar([
    'name' => esc_html__('Sidebar Shop', 'coast-machinery'),
    'id' => 'sidebar-2',
    'description' => esc_html__('Add widgets here.', 'coast-machinery'),
    'before_widget' => '<div id="%1$s" class="sidewidgets %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="fs-4 mb-1">',
    'after_title' => '</h2>',
  ]);
}
add_action('widgets_init', 'coast_machinery_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function coast_machinery_scripts()
{
  wp_enqueue_style(
    'coast-machinery-style',
    get_stylesheet_uri(),
    [],
    _S_VERSION
  );
  wp_style_add_data('coast-machinery-style', 'rtl', 'replace');
}
// add_action('wp_enqueue_scripts', 'coast_machinery_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
  require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
  require get_template_directory() . '/inc/woocommerce.php';
}

function allow_unsafe_urls($args)
{
  $args['reject_unsafe_urls'] = false;
  return $args;
};

add_filter('http_request_args', 'allow_unsafe_urls');