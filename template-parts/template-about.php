<?php
/**
 * Template Name: About Us
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */

get_header();
while (have_posts()) {
    the_post();
    ?>
    <section class="pt-3 pb-4 py-md-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 pe-lg-4 col-md-10">
                    <h3 class="fs-5 mb-1 text-success border-bottom border-success d-inline-flex">
                        <?php the_title(); ?>
                    </h3>
                    <?php the_content(); ?>
                </div>
                <div class="col-lg-5 col-xl-4 col-md-10">
                    <h2 class="fs-5 mb-2 text-success">
                        Contact Us
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                    d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.73 1.73 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.73 1.73 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.73 1.73 0 0 0 3.407 2.31zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
                        </svg>
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
                                        d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zm10.762.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708"/>
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
                            <span class="fs-6 text-danger d-block fw-medium">Director of Operations</span>
                            Cyril Aucoin
                        </h4>
                        <a class="d-inline-flex gap-2 mt-1" href="tel:+16045562225">
                            <svg width="16" height="16" viewBox="0 0 16 16">
                                <path
                                        d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zm10.762.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708"/>
                            </svg>
                            +1 604 556 2225
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }

get_footer();