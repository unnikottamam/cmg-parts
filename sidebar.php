<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Coast_Machinery
 */

if (!is_active_sidebar('sidebar-1')) {
  return;
} ?>

<aside class="d-flex flex-column gap-2">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>