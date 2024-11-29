<?php
$type = isset($args['type']) ? $args['type'] : '';
$source = isset($args['source']) ? $args['source'] : 'CMG Website';
$labelClass = in_array($type, ["offer", "out-of-stock", "contact-page"]) ? "d-none" : "";
$randNum = isset($args['random']) ? $args['random'] : '';
?>
<form class="d-flex flex-column row-gap-2 needs-validation" onsubmit="return false;" method="post"
    action="<?php echo get_template_directory_uri(); ?>/inc/form-action.php">
    <?php
    if (is_search() || is_404() || is_archive()) { ?>
    <input type="hidden" name="lookingfor" value="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    <input type="hidden" name="pagetitle" value="<?php if (is_search()) {
      echo "Search: " . get_search_query();
    } elseif (is_archive()) {
      echo wp_strip_all_tags(get_the_archive_title());
    } ?>">
    <?php } else { ?>
    <input type="hidden" name="lookingfor" value="<?php the_permalink(); ?>">
    <input type="hidden" name="pagetitle" value="<?php the_title(); ?>">
    <?php } if (is_singular('product')) {
        $product = wc_get_product(get_the_ID()); ?>
    <input type="hidden" name="product_code" value="<?php echo $product->get_sku(); ?>">
    <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
    <?php 
        if ($product->get_stock_quantity() < 1) { $source = "Out of Stock"; }
    } ?>
    <input type="hidden" name="currency" class="formcurrency">
    <input type="hidden" name="source" value="<?php echo $source; ?>">
    <input type="hidden" name="captcha_res" class="captcha_res">
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="formFirstName<?php echo $randNum; ?>">First Name</label>
        <input type="text" class="form-control" required placeholder="Your First Name *"
            id="formFirstName<?php echo $randNum; ?>" name="first_name">
    </div>
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="formLastName<?php echo $randNum; ?>">Last Name</label>
        <input type="text" class="form-control" required placeholder="Your Last Name *"
            id="formLastName<?php echo $randNum; ?>" name="last_name">
    </div>
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="formEmail<?php echo $randNum; ?>">Email address</label>
        <input type="email" class="form-control" required placeholder="Provide Email Address *"
            id="formEmail<?php echo $randNum; ?>" name="email_id">
    </div>
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="formPhoneNumber<?php echo $randNum; ?>">Phone Number</label>
        <input type="text" class="form-control" placeholder="Your Phone Number"
            id="formPhoneNumber<?php echo $randNum; ?>" name="contact_no">
    </div>
    <?php if ($type === 'offer') { ?>
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="offerPrice">Offer Price</label>
        <input type="number" placeholder="Your offer price *" required class="form-control" id="offerPrice"
            name="offer_price">
    </div>
    <?php } if ($type === 'ship') { ?>
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="formAddress">Street Address</label>
        <input id="formAddress" type="text" name="street" required placeholder="Street Address *" class="form-control">
    </div>
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="formCity">City</label>
        <input id="formCity" type="text" name="city" required placeholder="City *" class="form-control">
    </div>
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="formState">State/Region/Province</label>
        <input id="formState" type="text" name="state" placeholder="State/Region/Province" class="form-control">
    </div>
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="formPostal">Postal / Zip Code</label>
        <input id="formPostal" type="text" required name="zipcode" placeholder="Postal / Zip Code *"
            class="form-control">
    </div>
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="formCountry">Country</label>
        <select id="formCountry" class="form-select" name="country">
            <option selected value="Canada">Canada</option>
            <option value="USA">USA</option>
            <option value="Mexico">Mexico</option>
        </select>
    </div>
    <?php } ?>
    <div class="fw-medium d-flex flex-column row-gap-1">
        <label class="<?php echo $labelClass; ?>" for="formMessage<?php echo $randNum; ?>">Message</label>
        <textarea class="form-control" <?php echo in_array($type, ["offer", "ship"]) ? "" : "required" ?>
            placeholder="Your message goes here <?php echo in_array($type, ["offer", "ship"]) ? "" : "*" ?> ..."
            id="formMessage<?php echo $randNum; ?>"
            <?php echo $type !== 'offer' && $type !== 'ship' ? 'required' : ''; ?> name="message" rows="3"></textarea>
    </div>
    <div>
        <input name="opt_in" class="form-check-input" value="" type="checkbox"
               id="optInCheckBox<?php echo $randNum; ?>" checked>
        <label class="fw-normal" for="optInCheckBox<?php echo $randNum; ?>">
            Opt in for text Replies/Images
        </label>
        <?php $smsPolicy = get_page_by_path('coast-machinery-sms-privacy-policy'); ?>
        <small class="form-text d-block mt-1">By checking this box, I agree to receive SMS messages about reminders from Coast Machinery Group at the phone number provided above. The SMS frequency may vary. Data rates may apply. Text HELP for assistance. Reply STOP to opt out of receiving SMS messages Here is our <a target="_blank" href="<?php echo get_permalink($smsPolicy); ?>" class="btn p-0 small fw-normal text-black">Privacy policy</a></small>
    </div>
    <div id="emailHelp" class="form-text <?php echo $labelClass; ?>">We'll never share your information with anyone
        else.</div>
    <div class="error_ele d-none">
        <div class="error_form fs-6 fw-medium d-inline-flex h5 m-0 py-1 px-2 rounded-2 text-danger bg-danger-subtle">
        </div>
    </div>
</form>