<?php
/**
 * The template for displaying landing pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Coast_Machinery
 */

get_header();
$term = get_field('select_category');
$location = get_field('select_location');
$city_name = get_field('city_name');
$data_country = false;
if (
  get_field('select_location') == "Canada" ||
  get_field('select_location') == "USA"
) {
  $data_country = true;
}
$data_location =
  str_replace(' ', '-', strtolower($city_name)) .
  ',' .
  str_replace(' ', '-', strtolower($location));
?>
<section id="scrollContent" data-country="<?php echo $data_country; ?>" data-location="<?php echo $data_location; ?>"
    <?php post_class('pt-2 pb-3 py-md-3 bg-white bg-gradient'); ?>>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 pe-lg-4 col-md-10">
                <h1 class="fs-3 mb-2">
                    Quality used <?php echo get_field('display_name', $term->taxonomy . '_' . $term->term_id); ?> easily
                    shipped to <?php echo $city_name; echo ', ' . $location; ?>
                </h1>
                <?php echo str_replace("&", "and", get_field('hero_contents')); ?>
                <a class="btn btn-outline-success shadow-lg d-inline-flex column-gap-1 mt-2 text-uppercase"
                    href="#used-<?php echo esc_html($term->slug); ?>">
                    Buy Used
                    <?php echo str_replace(" and ", " & ", get_field('display_name', $term->taxonomy . '_' . $term->term_id)); ?>
                    <svg width="16" height="16" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.854 14.854a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V3.5A2.5 2.5 0 0 1 6.5 1h8a.5.5 0 0 1 0 1h-8A1.5 1.5 0 0 0 5 3.5v9.793l3.146-3.147a.5.5 0 0 1 .708.708z" />
                    </svg>
                </a>
            </div>
            <div class="col-lg-5 col-xl-4 col-md-10 pt-3 pt-lg-0 pb-2">
                <h2 class="fs-5 mb-2 text-success">
                    Contact Our Sales Team
                </h2>
                <?php get_template_part('template-parts/contact', 'form', [
                    'random' => rand(0, 99),
                    'type' => 'contact-page',
                ]); ?>
                <button type="button"
                    class="form_submit btn btn-outline-danger shadow-lg d-flex column-gap-2 mt-2 text-uppercase">
                    <svg width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z">
                        </path>
                        <path
                            d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686">
                        </path>
                    </svg>
                    Contact Sales Team
                </button>
            </div>
        </div>
    </div>
</section>
<section class="shadow-lg text-white bg-danger bg-gradient py-4 px-2 position-relative">
    <div class="position-absolute w-100 h-100 start-0 top-0 bg-primary bg-opacity-75"></div>
    <div class="container position-relative z-1">
        <div class="row row-gap-2">
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3">
                    <img width="44" height="44"
                        src="<?php echo get_template_directory_uri(); ?>/images/used-machinery-dealer.svg"
                        alt="Used <?php echo esc_html($term->name); ?> Dealer in <?php echo $city_name; echo ', ' . $location; ?>">
                    <div>
                        <h3 class="text-white mb-1 fs-4 fw-normal">Expertise</h3>
                        <p class="m-0"><?php the_field('info_content_1'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3">
                    <img width="44" height="44"
                        src="<?php echo get_template_directory_uri(); ?>/images/quality-used-machinery.svg"
                        alt="Qaulaity Used <?php echo esc_html($term->name); ?> in <?php echo $city_name; echo ', ' . $location; ?>">
                    <div>
                        <h3 class="text-white mb-1 fs-4 fw-normal">Quality</h3>
                        <p class="m-0"><?php the_field('info_content_2'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-3 no-border">
                    <img width="44" height="44"
                        src="<?php echo get_template_directory_uri(); ?>/images/used-machinery-warehouse.svg"
                        alt="Quality Used <?php echo esc_html($term->name); ?> machinery in <?php echo $city_name; echo ', ' . $location; ?>">
                    <div>
                        <h3 class="text-white mb-1 fs-4 fw-normal">Warehouse</h3>
                        <p class="m-0"><?php the_field('info_content_3'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section data-bs-spy="scroll" data-bs-target="#scrollContent" id="used-<?php echo esc_html($term->slug); ?>"
    data-origin="<?php echo ucwords($data_location, ","); ?>" class="py-3 py-md-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="commcont">
                    <h2 class="fs-3 mb-1"><?php the_field('products_title'); ?></h2>
                    <p><?php the_field('products_contents'); ?></p>
                </div>
                <?php echo do_shortcode(
                  '[products category="' .
                    $term->term_id .
                    '" per_page="20" paginate="true" columns="4" orderby="date" order="desc"]'
                ); ?>
            </div>
        </div>
    </div>
</section>
<section class="shadow-lg py-3 border-top border-bottom border-secondary">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6 col-12">
                <h2 class="fs-3 mb-2">
                    Contact Our Sales Team
                    <span class="d-block fs-5 text-secondary">Monday-Friday. 7.30am – 4.30pm</span>
                </h2>
                <p class="m-0">Effortlessly connect with our dedicated Sales Team for expert guidance on inquiries &
                    requirements related to our wide range of used machinery.<br>
                    <strong>Your success is our priority!</strong>
                </p>
            </div>
        </div>
    </div>
</section>
<section class="py-4 bg-white">
    <div class="container">
        <div class="row justify-content-center row-gap-3">
            <div class="col-lg-4 col-sm-6 text-center">
                <div class="d-inline-flex flex-column text-start">
                    <div class="shadow-lg border-primary border border-3 rounded-5 overflow-hidden">
                        <img class="w-100"
                            src="https://www.coastmachineryparts.com/wp-content/uploads/2020/11/used-machinery-ceo-mitch-brennan-350x208.jpg"
                            alt="Used woodworking machinery in , ">
                    </div>
                    <h4 class="pt-2 mb-0">
                        <span class="fs-6 text-danger d-block fw-medium">CEO</span>
                        Mitch Brennan
                    </h4>
                    <a class="d-inline-flex gap-2 mt-1" href="tel:+16045562225">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zm10.762.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708" />
                        </svg>
                        +1 604 556 2225
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <div class="d-inline-flex flex-column text-start">
                    <div class="shadow-lg border-primary border border-3 rounded-5 overflow-hidden">
                        <img class="w-100"
                            src="https://www.coastmachineryparts.com/wp-content/uploads/2020/11/used-woodworking-machinery-manager-cyril-350x208.jpg"
                            alt="Used woodworking machinery dealer in , ">
                    </div>
                    <h4 class="pt-2 mb-0">
                        <span class="fs-6 text-danger d-block fw-medium">Office/ Marketing Manager</span>
                        Cyril Aucoin
                    </h4>
                    <a class="d-inline-flex gap-2 mt-1" href="tel:+16045562225">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zm10.762.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708" />
                        </svg>
                        +1 604 556 2225
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();