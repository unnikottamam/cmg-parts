<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Coast_Machinery
 */

$search_uri = $_SERVER['URI'];
$search_str = $_SERVER['QUERY_STRING'];
wp_redirect("$search_uri?$search_str&post_type=product");
exit();