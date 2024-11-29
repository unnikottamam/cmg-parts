<?php
function codex_custom_init()
{
    register_taxonomy('pwb-brand', 'product', [
        'label' => __('Brand'),
        'rewrite' => ['slug' => 'brand'],
        'hierarchical' => true,
    ]);

    $args = [
        'public' => true,
        'label' => 'Landing Pages',
        'menu_icon' => 'dashicons-location-alt',
        'supports' => ['title'],
        'rewrite' => ['slug' => 'used-machine-parts'],
    ];
    register_post_type('used-machine-parts', $args);
}

add_action('init', 'codex_custom_init');