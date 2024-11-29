<?php
/**
 * Template Name: Contact
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */

 get_header();

 while (have_posts()) {
   the_post();
   ?>
<section class="pt-3 pb-0 py-md-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 pe-lg-3 col-md-10">
                <h1 class="fs-3 mb-1"><?php the_title(); ?></h1>
                <?php the_content(); ?>
                <h2 class="fs-5 mb-2 text-success">
                    Connect with Sales
                    <svg width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.73 1.73 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.73 1.73 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.73 1.73 0 0 0 3.407 2.31zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z" />
                    </svg>
                </h2>
                <div class="row">
                    <div class="col-lg-8">
                        <?php get_template_part('template-parts/contact', 'form', [
                            'random' => rand(0, 99),
                            'type' => 'contact-page',
                        ]); ?>
                        <button type="button"
                            class="form_submit btn btn-outline-success shadow-lg d-flex column-gap-2 mt-2">
                            <svg width="16" height="16" viewBox="0 0 16 16">
                                <path
                                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z">
                                </path>
                                <path
                                    d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686">
                                </path>
                            </svg>
                            SUBMIT
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-10 pt-3 pt-lg-0">
                <div class="ratio ratio-4x3 border border-primary-subtle shadow-lg">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2615.910275432947!2d-122.34595868413874!3d49.03131349646907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5485b55814870b75%3A0x18e6a3d56efd06ed!2s31789%20King%20Rd%2C%20Abbotsford%2C%20BC%20V2T%205Z2!5e0!3m2!1sen!2sca!4v1647114390334!5m2!1sen!2sca"
                        allowfullscreen aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-3 py-md-4 bg-secondary-subtle bg-gradient border-top">
    <div class="container fw-bold">
        <ul class="list-unstyled row row-gap-3 fs-5 m-0 justify-content-center">
            <li class="col-xl-3 col-md-4 col-12">
                <a class="d-block" href="tel:+1 (604) 556-2225">
                    <div class="d-flex align-items-center column-gap-1">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z">
                            </path>
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"></path>
                        </svg>
                        Canada
                    </div>
                    (604) 556-2225
                </a>
                <a class="d-block mt-2" href="tel:+1 (855) 556-5121">
                    <div class="d-flex align-items-center column-gap-1">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z">
                            </path>
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"></path>
                        </svg>
                        International
                    </div>
                    +1 (855) 556-5121
                </a>
            </li>
            <li class="col-xl-3 col-md-4 col-12">
                <a class="text-break" href="mailto:sales@coastmachinery.com">
                    <div class="d-flex align-items-center column-gap-1">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z">
                            </path>
                        </svg>
                        Email Us
                    </div>
                    sales@coastmachinery.com
                </a>
                <div class="mt-1 text-primary">
                    Monday-Friday,<br />
                    8am-4:30pm
                </div>
            </li>
            <li class="col-xl-3 col-md-4 col-12">
                <a class="text-break" target="_blank" href="https://goo.gl/maps/qkPh3ESeSYWqTgtU7">
                    <div class="d-flex align-items-center column-gap-1">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                        Location
                    </div>
                    Unit 170 - 31789 King Rd,<br />
                    Abbotsford, BC - V2T 5Z2,<br />
                    Canada
                </a>
            </li>
        </ul>
    </div>
</section>
<?php }

get_footer();