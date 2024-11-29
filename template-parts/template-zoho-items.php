<?php
/**
 * Template Name: Zoho Items
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */

get_header(); ?>
<section id="post-<?php the_ID(); ?>" <?php post_class('py-4'); ?>>
    <div class="container-fluid">
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

                $request_url = 'https://inventory.zoho.com/api/v1/items';
                $method_name = 'GET';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                if ($method_name == 'GET') {
                  $request_parameters = [
                    'organization_id' => 667838638,
                    'page' => 20,
                    'sort_by' => 'created_time',
                    'per_page' => 200,
                  ];
                  $request_url .= '?' . http_build_query($request_parameters);
                }
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                  'Authorization: Zoho-oauthtoken 1000.421c02778508dcd32c33487600d28070.8094ece957c04ac3c9cc841a13db2e87',
                  'Accept: application/json',
                ]);
                curl_setopt($ch, CURLOPT_URL, $request_url);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);
                $response_info = curl_getinfo($ch);
                curl_close($ch);
                $response_body = substr(
                  $response,
                  $response_info['header_size']
                );
                $jset = json_decode($response_body, true);
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Dimensions</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Model</th>
                            <th scope="col">Serial</th>
                            <th scope="col">HP</th>
                            <th scope="col">Voltage</th>
                            <th scope="col">Phase</th>
                            <th scope="col">Mfg Year</th>
                            <th scope="col">Vendor name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $items = $jset["items"];
                        foreach ($items as $item) {
                          echo '<tr>';
                          echo '<th scope="row">' .
                            $item['item_id'] .
                            '<br />' .
                            $item['name'] .
                            '<br />SKU: ' .
                            $item["sku"] .
                            '</th>';
                          echo '<th scope="row">' .
                            $item["actual_available_for_sale_stock"] .
                            '</th>';
                          $fields = $item["custom_fields"];
                          if ($fields) {
                            echo '<th class="btn-primary" scope="row"></th>';
                            foreach ($fields as $field) {
                              echo '<th class="btn-primary" scope="row">' .
                                $field['value'] .
                                '</th>';
                            }
                          }
                          echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <?php  ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();
?>