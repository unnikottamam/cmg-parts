<?php
/**
 * Template Name: City Based Products
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */

get_header();

while (have_posts()) {

  the_post();
  $state = get_field("select_state");
  $state_name = explode(",", $state['label']);
  ?>
<section class="py-30 city__header">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                <h1><?php the_title(); ?></h1>
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <?php the_content(); ?>
                    </div>
                    <div class="col-md-4">
                        <div class="city__misc">
                            <svg width="16" height="16" viewBox="0 0 16 16">
                                <path
                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            In <?php echo $state_name[0]; ?>
                        </div>
                        <div class="city__misc">
                            Until Oct. 2021
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php the_post_thumbnail('full', ['class' => 'city__header--bg']); ?>
</section>
<section class="machinelist coastcont">
    <div class="container city__contbox px-lg-4">
        <div class="row justify-content-end align-items-start">
            <aside class="col-lg-3 pt-0 pt-lg-4">
                <div class="machinelist__form mt-0">
                    <p>Contact an Expert</p>
                    <div class="machinelist__forminn">
                        <?php get_template_part(
                          'template-parts/contact',
                          'form',
                          [
                            'type' => 'home',
                            'source' => 'Landing Page - ' . $state['label'],
                          ]
                        ); ?>
                    </div>
                </div>
            </aside>
            <main class="col-lg-9 machinelist__main pt-4 d-flex flex-column">
                <div class="machinelist__products order-2">
                    <?php
                    $args = [
                      'post_type' => 'product',
                      'posts_per_page' => -1,
                      'meta_query' => [
                        "relation" => "AND",
                        [
                          'key' => '_stock_status',
                          'value' => 'instock',
                          'compare' => '=',
                        ],
                        [
                          "key" => "product_state",
                          "value" => $state['value'],
                        ],
                      ],
                    ];
                    query_posts($args);
                    $existsval = [];
                    if (have_posts()) {
                      echo '<div class="row used__machinerow">';
                      while (have_posts()) {
                        the_post();
                        get_template_part('woocommerce/content', 'product');
                        $product_cats = wp_get_post_terms(
                          $post->ID,
                          'product_cat',
                          [
                            'orderby' => 'term_order',
                          ]
                        );
                        if (
                          $product_cats &&
                          !in_array($product_cats[0], $existsval)
                        ) {
                          $existsval[] = $product_cats[0];
                        }
                      }
                      echo '</div>';
                    }
                    wp_reset_query();
                    ?>
                </div>
                <div class="city__cont text-center">
                    <select id="city__select" class="form-control">
                        <option value="all">Filter By Category</option>
                        <?php foreach ($existsval as $cat) { ?>
                        <option value="<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></option>
                        <?php } ?>
                        <option value="all">All Machines</option>
                    </select>
                </div>
            </main>
        </div>
    </div>
</section>
<?php
}

get_footer();
?>

<script>
$('#city__select').change(function() {
    let selected = $(this).val();
    if (selected == "all") {
        $(".used__machine").removeClass('d-none');
    } else {
        $(".used__machine").addClass('d-none');
        $(`.used__machine.product_cat-${selected}`).removeClass('d-none');
    }
});
const getUrlParameter = function getUrlParameter(sParam) {
    let sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};
let state = getUrlParameter('state');
if (state) {
    $('#city__select option').each(function() {
        if (this.value == state) {
            $("#city__select").val(state);
            $("#city__select").change();
            return false;
        }
    });
}
</script>