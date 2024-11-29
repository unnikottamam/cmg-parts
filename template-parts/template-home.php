<?php
/**
 * Template Name: Home
 */

get_header();
?>
    <section class="position-relative">
        <div class="container">
            <div class="row">
                <div class="py-3 col-lg-6 order-0 position-relative">
                    <h1 class="fs-5 mb-1 text-center text-lg-start text-primary-emphasis">
                        Buy High Quality Used Woodworking, Metalworking, and Stoneworking Machinery Parts and Tools.
                        <span class="d-block fs-6 text-success">
                        Fully Tested | Covered by a 45 Day Running Warranty
                    </span>
                    </h1>
                    <ul class="list-unstyled row row-cols-2 row-cols-lg-auto mb-0">
                        <li class="col pe-1">
                            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"
                               class="btn btn-primary d-inline-flex column-gap-1 px-2 w-100 justify-content-center rounded-5">
                                Our Inventory
                                <svg width="16" height="16" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                </svg>
                            </a>
                        </li>
                        <li class="col ps-1">
                            <a href="https://www.coastmachinery.com/sell-your-machines-with-coast-machinery-group/"
                               target="_blank"
                               class="btn btn-outline-dark d-inline-flex column-gap-1 px-2 w-100 justify-content-center rounded-5">
                                Sell Your Machines
                                <svg width="16" height="16" viewBox="0 0 16 16">
                                    <path
                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div style="margin-top: -1px;" class="col-12 pb-3 z-1 order-1 order-lg-2 bg-body">
                    <span class="position-absolute start-0 w-100 border-top z-1"></span>
                    <h2 class="d-flex py-3 mb-0 align-items-center justify-content-between justify-content-lg-start">
                    <span
                            class="bg-secondary-subtle border-4 border-bottom border-secondary border-start fs-4 px-3 py-1 shadow bg-gradient rounded-start-pill">
                        Latest Arrivals
                    </span>
                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"
                           class=" btn btn-sm btn-outline-dark ms-3 fs-6 shadow d-flex column-gap-1">
                            See More
                            <svg width="16" height="16" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                            </svg>
                        </a>
                    </h2>
                    <div
                            class="row justify-content-center g-1 row-cols-xl-5 row-cols-lg-4 row-cols-2 row-cols-md-3 prod__grids">
                        <?php
                        $args = [
                            'post_type' => 'product',
                            'posts_per_page' => 20,
                            'tax_query' => [
                                [
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => [15],
                                    'operator' => 'NOT IN',
                                ],
                            ],
                            'meta_query' => [
                                [
                                    'key' => '_stock_status',
                                    'value' => 'instock',
                                    'compare' => '=',
                                ],
                            ],
                        ];
                        query_posts($args);
                        while (have_posts()) {
                            the_post();
                            get_template_part('woocommerce/content', 'product');
                        }
                        wp_reset_query();
                        ?>
                    </div>
                    <div class="position-relative text-center py-3">
                        <hr class="position-absolute top-50 translate-middle-y w-100 start-0">
                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"
                           class="btn btn-lg btn-outline-primary position-relative z-1 d-inline-flex column-gap-1 shadow-lg bg__white">
                            View More Products
                            <svg width="20" height="20" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </a>
                    </div>
                    <div class="px-3 px-lg-4 shadow border border-danger-subtle">
                        <div class="row">
                            <div class="pt-3 pb-md-3 py-lg-4 pe-md-0 ps-lg-0 col-md-6 position-relative">
                                <div class="position-absolute border-end border-danger-subtle top-0 end-0 h-100 d-none d-md-block">
                                </div>
                                <h2 class="fs-3 mb-1">
                                    Used Machine Parts and Tooling
                                </h2>
                                <h3 class="h5 pe-md-2 text-body fw-normal m-0">
                                    Since opening its doors over <?php echo date('Y') - 2000; ?>
                                    years ago, Coast Machinery Group has become a source
                                    for CNC parts like electrical components, such as servo motors, VFDs , servo packs,
                                    and auto transformers.
                                </h3>
                                <hr class="my-3 opacity-100 border-danger-subtle">
                                <ul class="d-flex flex-column gap-2 list-unstyled m-0">
                                    <li class="d-flex gap-2 align-items-start">
                                        <svg width="20" height="20" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                        30 Years Experience In Selling Machinery Parts and Tooling
                                    </li>
                                    <li class="d-flex gap-2 align-items-start">
                                        <svg width="20" height="20" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                        Machinery Parts Tested By Experienced Technicians
                                    </li>
                                    <li class="d-flex gap-2 align-items-start">
                                        <svg width="20" height="20" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </svg>
                                        Machine Parts for Edgebanders, CNC Machines, and Beam Saws
                                    </li>
                                </ul>
                                <hr class="mt-3 d-block d-md-none opacity-100 border-danger-subtle">
                            </div>
                            <div class="py-3 py-lg-4 ps-md-4 col-md-6 d-flex flex-column justify-content-center row-gap-2">
                                <div>
                                    <h3 class="fs-5 mb-1 d-flex flex-wrap gap-2 align-items-center">
                                        <svg fill="#a531f8" width="22" height="22"
                                             viewBox="0 0 16 16">
                                            <path
                                                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                                        </svg>
                                        LTL Freight Shipping
                                    </h3>
                                    <p class="m-0">We source carriers to ship your purchase at the best rates.</p>
                                </div>
                                <div>
                                    <h3 class="fs-5 mb-1 d-flex flex-wrap gap-2 align-items-center">
                                        <svg fill="#a531f8" width="22" height="22"
                                             viewBox="0 0 16 16">
                                            <path
                                                    d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56"/>
                                            <path
                                                    d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z"/>
                                        </svg>
                                        45 Day Running Warranty
                                    </h3>
                                    <p class="m-0">
                                        Some conditions apply.
                                        <a class="btn btn-outline-danger btn-sm fs-6 px-1 py-0"
                                           href="<?php echo get_page_link(211); ?>">
                                            Details here
                                        </a>
                                    </p>
                                </div>
                                <div>
                                    <h3 class="fs-5 mb-1 d-flex flex-wrap gap-2 align-items-center">
                                        <svg fill="#a531f8" width="22" height="22"
                                             viewBox="0 0 16 16">
                                            <path
                                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                                            <path
                                                    d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                        </svg>
                                        Secure Payments
                                    </h3>
                                    <p class="m-0">Secure checkout, credit card information is not stored</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section class="py-3">
        <div class="container">
            <h2 class="d-flex mb-0 align-items-center justify-content-between justify-content-lg-start">
            <span
                    class="bg-secondary-subtle border-4 border-bottom border-secondary border-start fs-4 px-3 py-1 shadow bg-gradient rounded-start-pill">
                Our Articles
            </span>
                <a href="./newsroom/" class="btn btn-sm btn-outline-dark ms-3 fs-6 shadow d-flex column-gap-1">
                    More Articles
                    <svg width="16" height="16" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                        </path>
                    </svg>
                </a>
            </h2>
            <div class="row g-2 pt-3">
                <?php
                wp_reset_postdata();
                $category = get_sub_field('blog_category');
                $args = [
                    'post_type' => 'post',
                    'posts_per_page' => 4,
                ];
                query_posts($args);
                while (have_posts()) {
                    the_post();
                    get_template_part('template-parts/content', 'blog');
                }
                wp_reset_query();
                ?>
            </div>
        </div>
    </section>

    <section class="pb-3 py-lg-4">
        <div class="container pb-2 pb-lg-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div
                            class="shadow-lg p-md-4 p-3 border border-3 border-secondary-subtle bg-white bg-gradient rounded-5">
                        <div class="row align-items-center p-2 p-md-0 row-gap-3">
                            <div class="col-lg-8">
                                <h2 class="h2 mb-1 text-dark">Get In Touch With Us</h2>
                                <p class="h5 m-0 fw-normal text-body">
                                    Whether you’re looking to purchase used machinery from us or looking to consign
                                    machinery with us, let’s connect and find a solution that works best for you
                                </p>
                            </div>
                            <div class="col-lg-4 text-lg-end">
                                <button data-bs-toggle="modal" data-bs-target="#formModal"
                                        class="btn btn-lg btn-outline-secondary shadow d-inline-flex border-2 column-gap-2 px-3">
                                    Contact Sales Team
                                    <svg width="20" height="20" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();
