<?php
/**
 * Template Name: Consignment Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cmg-web
 */

if (is_user_logged_in()) {
  $user_meta = get_userdata(get_current_user_id());
  $roles = $user_meta->roles;
  if (in_array("vendor", $roles)) {
    wp_redirect("/dashboard");
    die();
  }
}
get_header();
?>
<section class="pt-2 pb-3 pt-md-3 pb-md-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-7 col-md-9">
                <?php if (have_posts()) {
                      while (have_posts()) {
                        the_post(); ?>
                <div class="text-center">
                    <h1 class="fs-2 mb-1"><?php the_title(); ?></h1>
                    <p class="fs-5">
                        With 22 years of experience in the <strong>Used machinery industry</strong>, CMG can find buyers
                        for your used machines.
                    </p>
                </div>
                <ol class="row list-unstyled m-0 row-gap-2 py-2">
                    <li class="col-md-6 col-12 d-flex align-items-start gap-2">
                        <img width="32" height="32"
                            src="<?php echo get_template_directory_uri(); ?>/images/newsletter.png"
                            alt="Consign your machine">
                        <p class="mb-0">Access To <strong>Over 25,000</strong> Newsletter <strong>Subscribers</strong>
                        </p>
                    </li>
                    <li class="col-md-6 col-12 d-flex align-items-start gap-2">
                        <img width="32" height="32" src="<?php echo get_template_directory_uri(); ?>/images/reach.png"
                            alt="Used machinery dealer in washington">
                        <p class="mb-0"><strong>Over 35,000</strong> Website <strong>Visitors</strong> A Month</p>
                    </li>
                    <li class="col-md-6 col-12 d-flex align-items-start gap-2">
                        <img width="32" height="32"
                            src="<?php echo get_template_directory_uri(); ?>/images/google-seo.png"
                            alt="Used woodworking machinery dealer">
                        <p class="mb-0">Get <strong>Top Search Results On Google</strong> When Selling Your Machines</p>
                    </li>
                    <li class="col-md-6 col-12 d-flex align-items-start gap-2">
                        <img width="32" height="32" src="<?php echo get_template_directory_uri(); ?>/images/portal.png"
                            alt="used machinery dashboard">
                        <p class="mb-0">Keep Track Of Your Machines And Online Visitors With <strong>Your Own Login
                                through our
                                website
                                portal</strong></p>
                    </li>
                </ol>
                <?php }
                    } ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7 col-xl-6 col-md-9">
                <div class="row justify-content-center text-center">
                    <div class="col-12 col-md-6 py-1">
                        <a class="rounded-pill btn btn-outline-primary shadow-lg d-flex text-start column-gap-2 fs-6 btn-lg fw-bold justify-content-center"
                            href="<?php echo get_page_link(125202); ?>">
                            <svg width="20" height="20" viewBox="0 0 16 16">
                                <path
                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                <path
                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                            Login To <br>Your Dashboard
                        </a>
                    </div>
                    <div class="col-12 col-md-6 py-1">
                        <a class="rounded-pill btn btn-outline-success shadow-lg d-flex text-start column-gap-2 fs-6 btn-lg fw-bold justify-content-center"
                            href="<?php echo get_page_link(125202); ?>">
                            <svg width="20" height="20" viewBox="0 0 16 16">
                                <path
                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                <path
                                    d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                            Register As<br>A Vendor
                        </a>
                    </div>
                </div>
                <h3 class="mb-2 text-center mt-4 position-relative">
                    <hr class="m-0 position-absolute top-50 start-0 w-100">
                    <span class="bg-body position-relative z-1 px-2">Still have questions?</span>
                </h3>
                <div id="signup-for-consignment"
                    class="consignment__form shadow-lg p-3 border border-primary rounded-3">
                    <p class="fw-medium text-primary">
                        Submit your product information & we will set up a dashboard for you.
                    </p>
                    <form onsubmit="return false;" id="consignmentform" class="needs-validation" method="post"
                        action="<?php echo get_template_directory_uri(); ?>/inc/consignment-form.php">
                        <input type="hidden" name="currency" class="formcurrency">
                        <input type="hidden" name="captcha_res" class="captcha_res">
                        <div class="contactform__output d-none"></div>
                        <div class="row row-gap-2">
                            <div class="col-md-6 fw-medium d-flex flex-column row-gap-1">
                                <label for="firstnameConsign"><strong>First Name *</strong></label>
                                <input type="text" required name="firstname" id="firstnameConsign"
                                    placeholder="E.g. John" class="form-control">
                                <div class="invalid-feedback">
                                    Please provide your first name.
                                </div>
                            </div>
                            <div class="col-md-6 fw-medium d-flex flex-column row-gap-1">
                                <label for="lastnamConsigne"><strong>Last Name *</strong></label>
                                <input type="text" required name="lastname" id="lastnameConsign" placeholder="E.g. Doe"
                                    class="form-control">
                                <div class="invalid-feedback">
                                    Please provide your last name.
                                </div>
                            </div>
                            <div class="col-md-6 fw-medium d-flex flex-column row-gap-1">
                                <label for="emailidConsign"><strong>Email Address *</strong></label>
                                <input type="email" required name="email_id" id="emailidConsign"
                                    placeholder="E.g. john@doe.com" class="form-control">
                                <div class="invalid-feedback">
                                    Please provide a valid email address
                                </div>
                            </div>
                            <div class="col-md-6 fw-medium d-flex flex-column row-gap-1">
                                <label for="contactnoConsign"><strong>Phone Number *</strong></label>
                                <input type="tel" required name="contact_no" id="contactnoConsign"
                                    placeholder="E.g. +1 888 888 8888" class="form-control">
                                <div class="invalid-feedback">
                                    Please provide your contact number
                                </div>
                            </div>
                            <div class="col-md-6 fw-medium d-flex flex-column row-gap-1">
                                <label for="productTypeConsign"><strong>Product Type *</strong></label>
                                <input type="text" required name="product_type" id="productTypeConsign"
                                    placeholder="E.g. Band Saws" class="form-control">
                                <div class="invalid-feedback">
                                    Please provide your product type
                                </div>
                            </div>
                            <div class="col-md-6 fw-medium d-flex flex-column row-gap-1">
                                <label for="locationConsign"><strong>Location *</strong></label>
                                <input type="text" required name="location" id="locationConsign"
                                    placeholder="E.g. Langley, BC" class="form-control">
                                <div class="invalid-feedback">
                                    Please provide your location
                                </div>
                            </div>
                            <div class="col-12 fw-medium d-flex flex-column row-gap-1">
                                <label for="messageConsign"><strong>Product Description</strong></label>
                                <textarea name="message" id="messageConsign"
                                    placeholder="Describe any damage / repairs of your product"
                                    class="form-control"></textarea>
                            </div>
                            <div class="error_ele d-none">
                                <div
                                    class="error_form fs-6 fw-medium d-inline-flex h5 m-0 py-1 px-2 rounded-2 text-danger bg-danger-subtle">
                                </div>
                            </div>
                        </div>
                    </form>
                    <button type="submit"
                        class="form_submit btn btn-outline-success shadow-lg d-flex column-gap-2 mt-2 text-uppercase">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372zm-2.54 1.183L5.93 9.363 1.591 6.602z">
                            </path>
                            <path
                                d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686">
                            </path>
                        </svg>
                        Submit Your Product
                    </button>
                </div>
                <h3 class="mb-2 text-center mt-4 position-relative">
                    <hr class="m-0 position-absolute top-50 start-0 w-100">
                    <span class="bg-body position-relative z-1 px-2">
                        CMG's Consignment Process
                    </span>
                </h3>
                <p class="text-center fs-5">Selling Your Machine Is Done In 6 Easy Steps</p>
            </div>
        </div>
    </div>
</section>
<section id="initial-point-of-contact" class="consignment-machinery has-arrow text-center right">
    <div class="container text-center">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Coast-Machinery-Consignment-Contact-Consignment.jpg"
                    alt="The initial point of contact">
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 text-md-start text-center">
                <div class="consignment__cont">
                    <h4>Step 1</h4>
                    <h2>The initial point of contact.</h2>
                    <p>A client reaches out to us for help selling their machines.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="appraisal-process" class="consignment-machinery has-arrow text-center left">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4 order-md-2">
                <img width="320" height="320"
                    src="<?php echo get_template_directory_uri(); ?>/images/Coast-Machinery-Consignment-Appraisal-Process.jpg"
                    alt="Appraisal Process">
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 text-md-start text-center">
                <div class="consignment__cont">
                    <h4>Step 2</h4>
                    <h2>Appraisal Process</h2>
                    <p>We ask for photos and more information on your machines. We provide you with a retail price based
                        on
                        the year and condition of the unit.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="consignment-process" class="consignment-machinery has-arrow text-center right">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <img width="320" height="320"
                    src="<?php echo get_template_directory_uri(); ?>/images/Coast-Machinery-Consignment-Agreement.jpg"
                    alt="Consignment Process">
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 text-md-start text-center">
                <div class="consignment__cont">
                    <h4>Step 3</h4>
                    <h2>Consignment Process</h2>
                    <p>We ask you to review and sign our consignment agreement so that all policies are followed by both
                        parties. </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="client-chooses" class="consignment-machinery has-arrow text-center left last">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4 order-md-2">
                <img width="320" height="320"
                    src="<?php echo get_template_directory_uri(); ?>/images/Coast-Machinery-Consignment-Client-Choose.jpg"
                    alt="Client chooses">
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 text-md-start text-center">
                <div class="consignment__cont">
                    <h4>Step 4</h4>
                    <h2>Client chooses</h2>
                    <p>if they want us to take their machines into our shop, or if they want us to sell them from their
                        own
                        shop.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="consignment-options pb-3">
    <div class="container">
        <div class="row align-items-center justify-content-center justify-content-center">
            <div class="col-lg-10 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 pb-3 text-center consignment__blocks">
                            <div class="p-3 h-100 border border-2 rounded-5 shadow-lg">
                                <h4 class="fs-6 mb-1">Option 1</h4>
                                <h3 class="fs-4 mb-1">Sell from own shop</h3>
                                <p>Seller makes sure machine is accessible for possible buyer to come view it.</p>
                            </div>
                        </div>
                        <div class="col-md-6 pb-3 text-center consignment__blocks">
                            <div class="p-3 h-100 border border-2 rounded-5 shadow-lg bg-secondary bg-opacity-10">
                                <h4 class="fs-6 mb-1">Option 2</h4>
                                <h3 class="fs-4 mb-1">Take machines into our shop</h3>
                                <p>
                                    <strong>Machines are now tested, serviced</strong> and prepared to be photographed
                                    and advertised on 5+ platforms.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<section id="potential-buyers" class="consignment-machinery has-arrow text-center right">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <img width="320" height="320"
                    src="<?php echo get_template_directory_uri(); ?>/images/Coast-Machinery-Consignment-Buyer.jpg"
                    alt="Potential buyers">
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 text-md-start text-center">
                <div class="consignment__cont">
                    <h4>Step 5</h4>
                    <h2>Potential buyers</h2>
                    <p>Potential buyer reaches out to us interested. We then send them a video of the machine running /
                        client comes to view the machine.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="client-is-invoiced" class="consignment-machinery has-arrow text-center left">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4 order-md-2">
                <img width="320" height="320"
                    src="<?php echo get_template_directory_uri(); ?>/images/Coast-Machinery-Consignment-Client-Invoice.jpg"
                    alt="Client is invoiced">
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 text-md-start text-center">
                <div class="consignment__cont">
                    <h4>Step 6</h4>
                    <h2>Client is invoiced</h2>
                    <p>Once payment is received we prepare the shipment by palletizing it, and/or wrapping it to protect
                        it
                        from the weather.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="shipping" class="consignment-machinery right last">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <img width="320" height="320"
                    src="<?php echo get_template_directory_uri(); ?>/images/Coast-Machinery-Consignment-Shipping.jpg"
                    alt="Shipping is arranged">
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 text-md-start text-center">
                <div class="consignment__cont">
                    <h4>Step 7</h4>
                    <h2>Hoorray !</h2>
                    <p>Shipping is arranged and the item is shipped.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<hr>
<section class="consignment-machinery pt-3 pb-3 pb-md-4">
    <div class="container">
        <div class="align-items-center justify-content-center row">
            <div class="col-md-6 col-lg-5 col-xl-4 text-md-start text-center">
                <div class="consignment__cont text-center">
                    <h2 class="fs-4 mb-2">Register Your Machine(s)</h2>
                    <a href="<?php echo get_page_link(125202); ?>"
                        class="btn btn-success text-uppercase d-inline-flex column-gap-1">
                        Sign Up
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4">
                            </path>
                            <path
                                d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<?php get_footer();