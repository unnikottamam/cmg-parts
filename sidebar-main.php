<?php
/**
 * The sidebar containing the category list and form
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Coast_Machinery
 */
?>

<aside class="col-lg-3">
    <div class="machinelist__filter">
        <p class="d-none d-lg-block">Filter by Category</p>
        <ul>
            <li><a href="#category-modal" data-pop="woodworking">Woodworking</a></li>
            <li><a href="#category-modal" data-pop="metal">Metalworking</a></li>
            <li><a href="#category-modal" data-pop="stone-glass">Stone & Glass</a></li>
            <li><a href="#category-modal" data-pop="warehousing">Warehousing</a></li>
        </ul>
    </div>
    <div class="machinelist__form">
        <p>Contact an Expert</p>
        <div class="machinelist__forminn">
            <?php get_template_part('template-parts/contact', 'form', [
              'type' => 'home',
            ]); ?>
        </div>
    </div>
</aside>