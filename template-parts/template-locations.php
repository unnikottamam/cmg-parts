<?php
/**
 * Template Name: Locations Page
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package cmg-web
 */
get_header(); ?>

    <section id="post-<?php the_ID(); ?>" <?php post_class('py-5 pageheight'); ?>>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-11">
                    <div class="pagebox">
                        <?php
                        $page_link = get_permalink();
                        $can_lists = [];
                        $usa_lists = [];
                        $canada_values = [
                            "Canada",
                            "Alberta",
                            "British Columbia",
                            "Manitoba",
                            "New Brunswick",
                            "Newfoundland and Labrador",
                            "Northwest Territories",
                            "Nova Scotia",
                            "Nunavut",
                            "Ontario",
                            "Prince Edward Island",
                            "Quebec",
                            "Saskatchewan",
                            "Yukon",
                        ];
                        $usa_values = [
                            "USA",
                            "Alabama",
                            "Alaska",
                            "Arizona",
                            "Arkansas",
                            "California",
                            "Colorado",
                            "Connecticut",
                            "Delaware",
                            "Florida",
                            "Georgia",
                            "Hawaii",
                            "Idaho",
                            "Illinois",
                            "Indiana",
                            "Iowa",
                            "Kansas",
                            "Kentucky",
                            "Louisiana",
                            "Maine",
                            "Maryland",
                            "Massachusetts",
                            "Michigan",
                            "Minnesota",
                            "Mississippi",
                            "Missouri",
                            "Montana",
                            "Nebraska",
                            "Nevada",
                            "New Hampshire",
                            "New Jersey",
                            "New Mexico",
                            "New York",
                            "North Carolina",
                            "North Dakota",
                            "Ohio",
                            "Oklahoma",
                            "Oregon",
                            "Pennsylvania",
                            "Rhode Island",
                            "South Carolina",
                            "South Dakota",
                            "Tennessee",
                            "Texas",
                            "Utah",
                            "Vermont",
                            "Virginia",
                            "Washington",
                            "West Virginia",
                            "Wisconsin",
                            "Wyoming",
                        ];
                        foreach ($canada_values as $prov_value) {
                            $can_lists[sanitize_title($prov_value)] = $prov_value;
                        }
                        foreach ($usa_values as $state_value) {
                            $usa_lists[sanitize_title($state_value)] = $state_value;
                        }
                        if (isset($_GET['region'])) {
                            $region = $_GET['region'];
                            $args = [
                                'post_type' => 'used-machine-parts',
                                'posts_per_page' => -1,
                                'meta_query' => [
                                    [
                                        'key' => 'location_slug',
                                        'value' => $region,
                                        'compare' => '=',
                                    ],
                                ],
                                'meta_key' => 'city_slug',
                                'orderby' => 'meta_value',
                                'order' => 'ASC',
                            ];

                            $region_list = [];
                            $title = ucwords(str_replace("-", " ", $region));
                            query_posts($args);
                            if (have_posts()) {
                                echo '<h1>We sell and ship used machinery to the following areas in ' .
                                    $title .
                                    '</h1>';
                                echo '<ul class="citylists">';
                                while (have_posts()) {
                                    the_post();
                                    if (!in_array(get_field('city_slug'), $region_list)) {
                                        $region_list[] = get_field('city_slug'); ?>
                                        <li>
                                            <a href="<?php echo $page_link; ?>?city=<?php the_field(
                                                'city_slug'
                                            ); ?>">
                                                <?php the_field('city_name'); ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                wp_reset_query();
                                echo '</ul>';
                            } else {
                                echo '<h1>Location not found in ' .
                                    $title .
                                    '</h1><p>We sell used machinery all over North America. You can see all the locations we service below: </p><a href="' .
                                    $page_link .
                                    '" class="btn btn-primary btn-xs">See All Locations</a>';
                            }
                        } elseif (isset($_GET['city'])) {
                            $city = $_GET['city'];
                            $args = [
                                'post_type' => 'used-machine-parts',
                                'posts_per_page' => -1,
                                'meta_query' => [
                                    [
                                        'key' => 'city_slug',
                                        'value' => $city,
                                        'compare' => '=',
                                    ],
                                ],
                                'order' => 'ASC',
                                'orderby' => 'title',
                            ];

                            $title = ucwords(str_replace("-", " ", $city));
                            query_posts($args);
                            if (have_posts()) {
                                echo '<h1>Machinery available in ' . $title . '</h1>';
                                echo '<ul class="citylists">';
                                while (have_posts()) {

                                    the_post();
                                    $term = get_field('select_category');
                                    ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php echo get_field(
                                                'display_name',
                                                $term->taxonomy . '_' . $term->term_id
                                            ); ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                wp_reset_query();
                                echo '</ul>';
                            } else {
                                echo '<h1>We sell and ship used machinery all over North America</h1><p>We provide used machinery services to all over North America. You can see all the locations here: </p><a href="' .
                                    $page_link .
                                    '" class="btn btn-primary btn-xs">See All Locations</a>';
                            }
                        } else {
                            ?>
                            <div class="commcont">
                                <?php while (have_posts()) {
                                    the_post();
                                    the_content();
                                } ?>
                            </div>
                            <?php
                            $count = 0;
                            foreach ($can_lists as $key => $value) {
                                $count++;
                                if ($count == 1) { ?>
                                    <h2>
                                        We sell and ship used machinery to the following provinces in
                                        <a href="<?php echo $page_link; ?>?region=<?php echo $key; ?>"><?php echo $value; ?></a>
                                    </h2>
                                    <?php echo '<ul class="citylists">';
                                } else { ?>
                                    <li>
                                        <a href="<?php echo $page_link; ?>?region=<?php echo $key; ?>"><?php echo $value; ?></a>
                                    </li>
                                <?php }
                            }
                            echo '</ul>';
                            $count = 0;
                            foreach ($usa_lists as $key => $value) {
                                $count++;
                                if ($count == 1) { ?>
                                    <h2>
                                        We sell and ship used machinery to the following states in
                                        <a href="<?php echo $page_link; ?>?region=<?php echo $key; ?>"><?php echo $value; ?></a>
                                    </h2>
                                    <?php echo '<ul class="citylists">';
                                } else { ?>
                                    <li>
                                        <a href="<?php echo $page_link; ?>?region=<?php echo $key; ?>"><?php echo $value; ?></a>
                                    </li>
                                <?php }
                            }
                            echo '</ul>';

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer();
