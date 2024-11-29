<?php
if (!defined('ABSPATH')) {
    exit;
}

if (defined('WP_CLI') && WP_CLI) {
    // wp create-landing-pages --data='[{"city": "Toronto", "location": "Downtown", "category": "Car"}, {"city": "Vancouver", "location": "Kitsilano", "category": "Truck"}]'
    WP_CLI::add_command('create-landing-pages', 'bulk_create_landing_pages');
}

function bulk_create_landing_pages($args, $assoc_args)
{
    $entries = isset($assoc_args['data']) ? json_decode($assoc_args['data'], true) : null;
    if (!$entries || !is_array($entries)) {
        WP_CLI::error('Please provide valid city, location, and post type data as JSON.');
        return;
    }

    foreach ($entries as $entry) {
        if (isset($entry['city'], $entry['location'], $entry['category'])) {
            $catType = str_replace(' ', '-', strtolower($entry['category']));
            $postType = "used-{$catType}-parts";
            if (!post_type_exists($postType)) {
                register_custom_post_type($postType, $entry['category']);
                WP_CLI::success("Custom post type '{$postType}' created.");
            }
            create_landing_page($entry['city'], $entry['location'], $postType, $entry['category']);
            WP_CLI::success("Landing page created for city: {$entry['city']}, location: {$entry['location']}, post type: {$postType}");
        } else {
            WP_CLI::warning('Invalid entry. Skipping...');
        }
    }
}

function register_custom_post_type($postType, $category)
{
    $args = [
        'public' => true,
        'label' => "Landing Pages - {$category}",
        'menu_icon' => 'dashicons-location-alt',
        'supports' => ['title',],
        'rewrite' => ['slug' => $postType],
    ];
    register_post_type($postType, $args);
}

function create_landing_page($cityName, $locationName, $postType, $category)
{
    if (!$cityName || !$locationName || !$postType) {
        return;
    }

    $args = [
        'post_type' => $postType,
        'posts_per_page' => -1,
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => 'city_name',
                'value' => $cityName,
                'compare' => '=',
            ],
            [
                'key' => 'select_location',
                'value' => $locationName,
                'compare' => '=',
            ],
        ],
    ];

    $existing_posts = get_posts($args);
    if (!empty($existing_posts)) {
        return;
    }

    // create an seo-friendly title based on the city and location and category
    $seoTitle = "Quality used {$category} easily shipped to {$locationName}, {$cityName}";

    $page_data = [
        'post_title' => titleGenerator($cityName, $locationName),
        'post_content' => "Content for {$cityName}, {$locationName}.",
        'post_status' => 'publish',
        'post_type' => $postType,
        'meta_input' => [
            'city_name' => $cityName,
            'city_slug' => sanitize_title($cityName),
            'select_location' => $locationName,
            'location_slug' => sanitize_title($locationName),
        ],
    ];
    wp_insert_post($page_data);
}


function titleGenerator(string $city, string $state): string
{
    $matrix = [
        "primary_phrase" => [
            "Your Trusted Source",
            "Leading Supplier",
            "Your Go-To Provider",
            "Your Partner in Quality",
            "Premium Supplier",
            "Industry Expert",
            "Top Destination"
        ],
        "focus" => [
            "for Machinery Tool and Parts",
            "of Tools and parts",
            "of Industrial Tools and Supplies",
        ],
        "location" => [
            "in {{city}}, {{state}}",
            "throughout {{city}}, {{state}}",
            "in and around {{city}}, {{state}}",
            "for the {{city}}, {{state}} Region",
            "across {{city}}, {{state}}",
            "in {{city}}, {{state}} and Surrounding Areas"
        ],
        "additional_context" => [
            "Serving Professionals",
            "Ensuring Customer Satisfaction",
            "Backed by Years of Experience",
            "Designed to Meet Your Needs",
            "with Superior Quality",
            "for All Your Industrial Needs",
            "for Local Businesses"
        ]
    ];

    $primaryPhrase = $matrix["primary_phrase"][array_rand($matrix["primary_phrase"])];
    $focus = $matrix["focus"][array_rand($matrix["focus"])];
    $locationTemplate = $matrix["location"][array_rand($matrix["location"])];
    $additionalContext = $matrix["additional_context"][array_rand($matrix["additional_context"])];

    $location = str_replace(["{{city}}", "{{state}}"], [$city, $state], $locationTemplate);
    return "$primaryPhrase $focus $location, $additionalContext";
}

