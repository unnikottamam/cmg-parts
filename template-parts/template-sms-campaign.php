<?php
/**
 * Template Name: SMS Campaign
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package cmg-web
 */

get_header();
$rand = rand();
?>
    <form novalidate id="contactform_<?php echo $rand; ?>" class="needs-validation" method="post"
          action="<?php echo get_template_directory_uri(); ?>/inc/form-action.php" style="display: flex;
flex-direction: column;
min-height: 100vh;
align-items: center;
justify-content: center;">
        <div style="max-width: 350px;
margin: 2rem auto;
box-shadow: 0 0.85rem 5.5rem 0 rgb(0 0 0 / 15%);
padding: 1rem;
border: 1px solid rgb(0 0 0 / 12%);">
            <section class="pt-4">
                <div class=" container text-center">
                    <a href="<?php echo home_url(); ?>" class="logo">
                        <?php if (get_field('logo', 'options')) {
                            $logo = get_field('logo', 'options');
                            $icon_alt = $logo['alt'] ?: get_bloginfo('title');
                            ?>
                            <img width="190" height="38" src="<?php echo $logo['url']; ?>"
                                 alt="<?php echo $icon_alt; ?>"/>
                            <?php
                        } ?>
                    </a>
                    <div class="row">
                        <input type="hidden" name="lookingfor" value="<?php the_permalink(); ?>">
                        <input type="hidden" name="pagetitle" value="<?php the_title(); ?>">
                        <input type="hidden" name="currency" class="formcurrency">
                        <input type="hidden" name="source" value="SMS Campaign">
                        <input type="hidden" name="captcha_res" class="captcha_res">
                        <div class="contactform__content col-12 p-0 px-2 pt-3">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </section>
            <hr style="margin: 0.5rem -1rem 1.5rem; border-color: rgb(0 0 0 / 12%);">
            <div class="contactform__output d-none"></div>
            <section class="pb-4">
                <div class=" container">
                    <div class="row">
                        <div class="form-item col-12 pb-1">
                            <label for="fullname_<?php echo $rand; ?>">Full Name</label>
                            <input type="text" required name="full_name" id="fullname_<?php echo $rand; ?>"
                                   placeholder="Full Name" class="form-control">
                            <div class="invalid-feedback">
                                Please provide a valid full name.
                            </div>
                        </div>
                        <div class="form-item col-12 pb-1">
                            <label for="emailid_<?php echo $rand; ?>">Email Address</label>
                            <input type="email" required name="email_id" id="emailid_<?php echo $rand; ?>"
                                   placeholder="Email Address" class="form-control">
                            <div class="invalid-feedback">
                                Please provide a valid email address
                            </div>
                        </div>
                        <div class="form-item col-12 pb-1">
                            <label for="contactno_<?php echo $rand; ?>">Phone Number</label>
                            <input type="tel" required name="contact_no" id="contactno_<?php echo $rand; ?>"
                                   placeholder="Phone Number" class="form-control">
                        </div>
                        <div class="form-item col-12 text-center pt-2">
                            <button type="submit" class="btn btn-block btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
<?php get_footer();