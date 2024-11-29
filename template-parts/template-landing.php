<?php
/**
 * Template Name: Landing Page Creation
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */
$user = wp_get_current_user();
get_header();
?>
    <section id="post-<?php the_ID(); ?>" <?php post_class('py-6'); ?>>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post(); ?>
                            <h1><?php the_title(); ?></h1>
                            <?php the_content();
                        }
                    }
                    $allowed_roles = ['administrator'];
                    if (array_intersect($allowed_roles, $user->roles)) { ?>
                        <form method="post" class="row" action="<?php the_permalink(); ?>">
                            <div class="col-md-6">
                                <div class="form-row">
                                    <label for="city_name" class="form-label">City Name</label>
                                    <input required type="text" class="form-control" name="city_name" id="city_name"
                                           placeholder="Please provide a city name that don't exist in the landing pages">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row">
                                    <label for="location_name" class="form-label">Select State / Country</label>
                                    <select required class="form-control" name="location_name" id="location_name">
                                        <option value="Canada">Canada</option>
                                        <option value="USA">USA</option>
                                        <option value="Alberta">Alberta</option>
                                        <option value="British Columbia">British Columbia</option>
                                        <option value="Manitoba">Manitoba</option>
                                        <option value="New Brunswick">New Brunswick</option>
                                        <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                        <option value="Northwest Territories">Northwest Territories</option>
                                        <option value="Nova Scotia">Nova Scotia</option>
                                        <option value="Nunavut">Nunavut</option>
                                        <option value="Ontario">Ontario</option>
                                        <option value="Prince Edward Island">Prince Edward Island</option>
                                        <option value="Quebec">Quebec</option>
                                        <option value="Saskatchewan">Saskatchewan</option>
                                        <option value="Yukon">Yukon</option>
                                        <option value="Alabama">Alabama</option>
                                        <option value="Alaska">Alaska</option>
                                        <option value="Arizona">Arizona</option>
                                        <option value="Arkansas">Arkansas</option>
                                        <option value="California">California</option>
                                        <option value="Colorado">Colorado</option>
                                        <option value="Connecticut">Connecticut</option>
                                        <option value="Delaware">Delaware</option>
                                        <option value="Florida">Florida</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Hawaii">Hawaii</option>
                                        <option value="Idaho">Idaho</option>
                                        <option value="Illinois">Illinois</option>
                                        <option value="Indiana">Indiana</option>
                                        <option value="Iowa">Iowa</option>
                                        <option value="Kansas">Kansas</option>
                                        <option value="Kentucky">Kentucky</option>
                                        <option value="Louisiana">Louisiana</option>
                                        <option value="Maine">Maine</option>
                                        <option value="Maryland">Maryland</option>
                                        <option value="Massachusetts">Massachusetts</option>
                                        <option value="Michigan">Michigan</option>
                                        <option value="Minnesota">Minnesota</option>
                                        <option value="Mississippi">Mississippi</option>
                                        <option value="Missouri">Missouri</option>
                                        <option value="Montana">Montana</option>
                                        <option value="Nebraska">Nebraska</option>
                                        <option value="Nevada">Nevada</option>
                                        <option value="New Hampshire">New Hampshire</option>
                                        <option value="New Jersey">New Jersey</option>
                                        <option value="New Mexico">New Mexico</option>
                                        <option value="New York">New York</option>
                                        <option value="North Carolina">North Carolina</option>
                                        <option value="North Dakota">North Dakota</option>
                                        <option value="Ohio">Ohio</option>
                                        <option value="Oklahoma">Oklahoma</option>
                                        <option value="Oregon">Oregon</option>
                                        <option value="Pennsylvania">Pennsylvania</option>
                                        <option value="Rhode Island">Rhode Island</option>
                                        <option value="South Carolina">South Carolina</option>
                                        <option value="South Dakota">South Dakota</option>
                                        <option value="Tennessee">Tennessee</option>
                                        <option value="Texas">Texas</option>
                                        <option value="Utah">Utah</option>
                                        <option value="Vermont">Vermont</option>
                                        <option value="Virginia">Virginia</option>
                                        <option value="Washington">Washington</option>
                                        <option value="West Virginia">West Virginia</option>
                                        <option value="Wisconsin">Wisconsin</option>
                                        <option value="Wyoming">Wyoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 pt-2">
                                <button type="submit" class="btn btn-primary btn-sm">Create Landing Pages</button>
                            </div>
                        </form>

                        <?php if (
                            isset($_POST['city_name']) &&
                            isset($_POST['location_name'])
                        ) {
                            $city_name = ucwords($_POST['city_name']);
                            $location_name = $_POST['location_name'];
                            create_landing_page(rtrim($city_name), $location_name);

                            $args = [
                                'post_type' => 'used-machine-parts',
                                'posts_per_page' => -1,
                                'meta_query' => [
                                    'relation' => 'AND',
                                    [
                                        'key' => 'city_name',
                                        'value' => $city_name,
                                        'compare' => '=',
                                    ],
                                    [
                                        'key' => 'select_location',
                                        'value' => $location_name,
                                        'compare' => '=',
                                    ],
                                ],
                            ];

                            $query = new WP_Query($args);
                            if ($query->have_posts()) { ?>
                                <div class="bg-primary-subtle text-primary mb-2 py-1 px-2 rounded-2 my-3">
                                    Created Landing Pages for : <?php echo $city_name .
                                        ' - ' .
                                        $location_name; ?>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">City</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($query->have_posts()) {
                                        $query->the_post(); ?>
                                        <tr>
                                            <td><?php the_title(); ?></td>
                                            <td class="text-right">
                                                <a target="_blank" href="<?php the_permalink(); ?>"
                                                   class="btn btn-primary btn-xs">View</a>
                                            </td>
                                        </tr>
                                        <?php
                                    } ?>
                                    </tbody>
                                </table>
                                <?php wp_reset_query();
                            }
                        }
                    } else { ?>
                        <div class="bg-danger-subtle text-danger mb-2 py-1 px-2 rounded-2">
                            Sorry, You don't have the permission to create landing pages
                        </div>

                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer();