<?php
/**
 * Template Name: User Pages
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
  wp_redirect(wc_get_page_permalink("myaccount"));
  die();
}
get_header();

while (have_posts()) {
  the_post(); ?>
<section <?php post_class('pt-2 pb-3 pt-md-3 pb-md-4'); ?>>
    <div class="container commcont">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 pe-md-5">
                <h2 class="fs-3 mb-1">Vendor Login</h2>
                <?php echo do_shortcode('[web_login_form]'); ?>
            </div>
            <div class="col-12 col-md-7">
                <h1 class="fs-3 mb-1">Vendor Registration</h1>
                <p>Please provide your contact information to create a vendor profile.</p>
                <form novalidate id="signupform" class="needs-validation" method="post"
                    action="<?php echo get_template_directory_uri(); ?>/inc/form-signup.php">
                    <input type="hidden" name="captcha_res" class="captcha_res">
                    <div class="contactform__output d-none"></div>
                    <div class="row row-gap-2">
                        <div class="col-12">
                            <h5 class="mb-0">1. Basic Information</h5>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="first_name">First Name *</label>
                            <input type="text" required name="first_name" id="first_name" placeholder="Eg. John"
                                class="form-control">
                            <div class="invalid-feedback">
                                Please provide your first name.
                            </div>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="last_name">Last Name *</label>
                            <input type="text" required name="last_name" id="last_name" placeholder="Eg. Adams"
                                class="form-control">
                            <div class="invalid-feedback">
                                Please provide your last name.
                            </div>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="shop_name">Shop / Vendor Name *</label>
                            <input type="text" required name="shop_name" id="shop_name"
                                placeholder="Eg. Coast Machinery" class="form-control">
                            <div class="invalid-feedback">
                                Please provide your business / vendor name.
                            </div>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="email_id">Email Address *</label>
                            <input type="email" required name="email_id" id="email_id" placeholder="Eg. john@email.com"
                                class="form-control">
                            <div class="invalid-feedback">
                                Please provide a valid email address
                            </div>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="username2">Username *</label>
                            <input type="text" required name="username" id="username2" placeholder="Eg. johnadams"
                                class="form-control">
                            <div class="invalid-feedback">
                                Please provide a valid username
                            </div>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="password2">Password *</label>
                            <input type="password" minlength="5" required name="password" id="password2"
                                placeholder="Eg. CkzMH8bb" class="form-control">
                            <div class="invalid-feedback">
                                Please provide a valid password (Atleast 5 character length)
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <h5 class="mb-0">2. Contact Details</h5>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="cellnumber">Cell Number *</label>
                            <input type="tel" required name="cellnumber" id="cellnumber" placeholder="Eg. 6045562225"
                                class="form-control">
                            <div class="invalid-feedback">
                                Please provide your cell number
                            </div>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="country">Country *</label>
                            <select class="form-select" name="country" id="country" required>
                                <option selected value="CA">Canada</option>
                                <option value="US">USA</option>
                            </select>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label>State/Province *</label>
                            <select required class="form-select" id="state" name="state">
                                <option value="AB">Alberta</option>
                                <option value="BC">British Columbia</option>
                                <option value="MB">Manitoba</option>
                                <option value="NB">New Brunswick</option>
                                <option value="NL">Newfoundland and Labrador</option>
                                <option value="NT">Northwest Territories</option>
                                <option value="NS">Nova Scotia</option>
                                <option value="NU">Nunavut</option>
                                <option value="ON">Ontario</option>
                                <option value="PE">Prince Edward Island</option>
                                <option value="QC">Quebec</option>
                                <option value="SK">Saskatchewan</option>
                                <option value="YT">Yukon Territory</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide your state / province
                            </div>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="street">Street Address</label>
                            <input type="text" name="street" id="street" placeholder="Eg. 31789 King Rd"
                                class="form-control">
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" placeholder="Eg. Abbotsford" class="form-control">
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-sm-6">
                            <label for="zip">Postal / Zip Code *</label>
                            <input type="text" required name="zipcode" id="zip" placeholder="Eg. V2T 5Z2"
                                class="form-control">
                            <div class="invalid-feedback">
                                Please provide your postal / zip code
                            </div>
                        </div>
                        <div class="fw-medium d-flex flex-column row-gap-1 col-12">
                            <div class="form-check">
                                <input id="terms" type="checkbox" class="form-check-input" name="payment_method"
                                    value="yes" checked="checked" required>
                                <label class="fw-normal" for="terms">
                                    I Agree to <a data-bs-toggle="collapse" href="#agreement" role="button"
                                        aria-expanded="false" aria-controls="collapseExample" class="vendorterms">Terms
                                        & conditions</a>
                                </label>
                            </div>
                            <div id="agreement" class="collapse d-none vendoragreement">
                                <p>This is a Consignment Agreement Between: (Consignor) and CoastMachinery
                                    Group Inc. (Consignee) for the inventory items listed, but not limited to, in
                                    Attachment "A" and hereinafter referred to as Inventory.</p>
                                <ol>
                                    <li>Items to be liquidated are quoted as Consignors onsite sale in
                                        Canadian funds.</li>
                                    <li>Costs to relocate the equipment to the Consignee's premises
                                        is to be charged to the Consignor account, any costs charged, billed to or
                                        incurred by the Consignee for relocating the equipment will be deducted from
                                        sales proceeds. Upon delivery, the equipment shall be inventoried (SKU"d),
                                        cleaned, identified and catalogued (Attachment A) by the Consignee. Our initial
                                        list only recognizes items we have viewed and will be updated with additional
                                        items once a detailed inventory is taken. All values will also be updated.</li>
                                    <li>Consignee shall take the necessary steps to offer all inventory
                                        items for sale to the best qualified buyers and to obtain the greatest amount of
                                        revenue possible relating to market and machine conditions.</li>
                                    <li>All advertising and promotion expenses of the sale shall be the
                                        responsibility of the Consignee. No private sales by the Consignor are allowed,
                                        unless otherwise agreed upon. Any item removed by the Consignor may be subject
                                        to commission fees based on appraised value and payable
                                        to the Consignee.</li>
                                    <li>The Consignee shall insure the inventory for the appraised value
                                        in the event of loss or damage.</li>
                                    <li>When a Consignee agrees to consign machinery from their location,
                                        CMG will not be responsible for any Equipment issues raised by the buyer. Added
                                        costs may be subtracted from the 80% of the sale amount in case the machine
                                        needs to be serviced or repaired at the seller's location.</li>
                                    <li>The Consignor agrees to the Consignee retaining 20% of the sale
                                        amount payment, exclusive of any tax, as payment for services. In addition all
                                        removal and repair costs if incurred shall be deducted from the sales proceeds.
                                    </li>
                                    <li>Should a sale be effectuated, the Consignee shall forward payment
                                        in the amount of the full purchase price less the aforementioned 20% commission,
                                        repair costs, to the Consignor, plus tax if applicable (invoice required).</li>
                                    <li>The Consignor guarantees the Consignee that all listed goods on
                                        attachment "A" are the sole property of the Consignor, are free and
                                        clear of liens and encumbrances and have full rights to sell. The Consignor
                                        consents to release any and all information regarding liens and encumbrances and
                                        agrees that lien holders be paid out, in full, prior to the sale of the
                                        equipment.</li>
                                    <li>The Consignor shall make the Consignee aware of all known
                                        problems, issues and or failures inherent to each individual inventory item.
                                    </li>
                                    <li>Consignor shall supply to the Consignee all manuals, tools,
                                        software, and relevant components of the unit, missing items may result in
                                        additional costs to the equipment.</li>
                                    <li>The period of consignment shall be for 12 months beginning from
                                        the signature date below. The Consignor agrees that after 2 months of storage on
                                        the Consignee's premises, warehouse fees may be applicable at 2.50/sq ft
                                    </li>
                                    <li>At the end of the consignment, the contract may be renewed or the
                                        Consignor may pick up the equipment once all fees have been paid. The cost for
                                        the return of any item shall be the cost of transportation and any additional
                                        expenses of repair, inspections, storage or any outstanding debt. Any item left
                                        longer than 1 month after contract completion may become the property of the
                                        Consignee.</li>
                                    <li>The Consignee agrees to permit the Consignor to enter the
                                        premises at reasonable times to examine and inspect the goods.</li>
                                    <li>The acknowledgement copy of this Consignment Agreement shall be
                                        executed on behalf of the Consignee and returned to the Consignor as approval of
                                        the terms and conditions set forth above.</li>
                                    <li>Consignee may drop the asking price by 10% following a 6 month
                                        sales effort.</li>
                                    <li>Any additional costs relating to the item or items shall be passed onto the
                                        asset sold.</li>
                                </ol>
                                <p>Clicking the "I Agree To Terms & Conditions" button is acceptance and understanding
                                    of the items above and gives CMG-Coast Machinery Group the permission to sell the
                                    items on hand as they deem right and fair market for the Seller.</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success text-uppercase d-flex column-gap-1">
                                Register
                                <svg width="16" height="16" viewBox="0 0 16 16">
                                    <path
                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                    <path
                                        d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
}

get_footer();
?>
<style>
.contactform__output.warning {
    background-color: #ffb9b9;
    box-shadow: none;
}

.vendoragreement {
    padding: 12px 15px;
    border: 1px solid #cbcbcb;
    margin: 8px 0;
    font-size: 15px;
    overflow-y: auto;
    height: 150px;
    min-height: 100px;
    background: #fcfcfc;
    display: none;
    resize: vertical;
}

.vendoragreement.show {
    display: block !important;
}

.vendoragreement :last-child {
    margin-bottom: 0;
}

.vendoragreement p,
.vendoragreement ol {
    margin-bottom: 8px;
}
</style>
<script>
let canada = [{
        "name": "Alberta",
        "value": "AB"
    },
    {
        "name": "British Columbia",
        "value": "BC"
    },
    {
        "name": "Manitoba",
        "value": "MB"
    },
    {
        "name": "New Brunswick",
        "value": "NB"
    },
    {
        "name": "Newfoundland and Labrador",
        "value": "NL"
    },
    {
        "name": "Northwest Territories",
        "value": "NT"
    },
    {
        "name": "Nova Scotia",
        "value": "NS"
    },
    {
        "name": "Nunavut",
        "value": "NU"
    },
    {
        "name": "Ontario",
        "value": "ON"
    },
    {
        "name": "Prince Edward Island",
        "value": "PE"
    },
    {
        "name": "Quebec",
        "value": "QC"
    },
    {
        "name": "Saskatchewan",
        "value": "SK"
    },
    {
        "name": "Yukon Territory",
        "value": "YT"
    }
];
let usa = [{
        "value": "AL",
        "name": "Alabama"
    },
    {
        "value": "AK",
        "name": "Alaska"
    },
    {
        "value": "AZ",
        "name": "Arizona"
    },
    {
        "value": "AR",
        "name": "Arkansas"
    },
    {
        "value": "CA",
        "name": "California"
    },
    {
        "value": "CO",
        "name": "Colorado"
    },
    {
        "value": "CT",
        "name": "Connecticut"
    },
    {
        "value": "DE",
        "name": "Delaware"
    },
    {
        "value": "DC",
        "name": "District Of Columbia"
    },
    {
        "value": "FL",
        "name": "Florida"
    },
    {
        "value": "GA",
        "name": "Georgia"
    },
    {
        "value": "HI",
        "name": "Hawaii"
    },
    {
        "value": "ID",
        "name": "Idaho"
    },
    {
        "value": "IL",
        "name": "Illinois"
    },
    {
        "value": "IN",
        "name": "Indiana"
    },
    {
        "value": "IA",
        "name": "Iowa"
    },
    {
        "value": "KS",
        "name": "Kansas"
    },
    {
        "value": "KY",
        "name": "Kentucky"
    },
    {
        "value": "LA",
        "name": "Louisiana"
    },
    {
        "value": "ME",
        "name": "Maine"
    },
    {
        "value": "MD",
        "name": "Maryland"
    },
    {
        "value": "MA",
        "name": "Massachusetts"
    },
    {
        "value": "MI",
        "name": "Michigan"
    },
    {
        "value": "MN",
        "name": "Minnesota"
    },
    {
        "value": "MS",
        "name": "Mississippi"
    },
    {
        "value": "MO",
        "name": "Missouri"
    },
    {
        "value": "MT",
        "name": "Montana"
    },
    {
        "value": "NE",
        "name": "Nebraska"
    },
    {
        "value": "NV",
        "name": "Nevada"
    },
    {
        "value": "NH",
        "name": "New Hampshire"
    },
    {
        "value": "NJ",
        "name": "New Jersey"
    },
    {
        "value": "NM",
        "name": "New Mexico"
    },
    {
        "value": "NY",
        "name": "New York"
    },
    {
        "value": "NC",
        "name": "North Carolina"
    },
    {
        "value": "ND",
        "name": "North Dakota"
    },
    {
        "value": "OH",
        "name": "Ohio"
    },
    {
        "value": "OK",
        "name": "Oklahoma"
    },
    {
        "value": "OR",
        "name": "Oregon"
    },
    {
        "value": "PA",
        "name": "Pennsylvania"
    },
    {
        "value": "RI",
        "name": "Rhode Island"
    },
    {
        "value": "SC",
        "name": "South Carolina"
    },
    {
        "value": "SD",
        "name": "South Dakota"
    },
    {
        "value": "TN",
        "name": "Tennessee"
    },
    {
        "value": "TX",
        "name": "Texas"
    },
    {
        "value": "UT",
        "name": "Utah"
    },
    {
        "value": "VT",
        "name": "Vermont"
    },
    {
        "value": "VA",
        "name": "Virginia"
    },
    {
        "value": "WA",
        "name": "Washington"
    },
    {
        "value": "WV",
        "name": "West Virginia"
    },
    {
        "value": "WI",
        "name": "Wisconsin"
    },
    {
        "value": "WY",
        "name": "Wyoming"
    },
];
$("#country").change(function() {
    switch ($(this).val()) {
        case "US":
            var html = "";
            usa.forEach(state => {
                html += `<option value="${state["value"]}">${state["name"]}</option>`;
            });
            $("#state").html(html);
            break;
        case "CA":
            var html = "";
            canada.forEach(state => {
                html += `<option value="${state["value"]}">${state["name"]}</option>`;
            });
            $("#state").html(html);
            break;
    }
});
$("a.vendorterms").click(function(e) {
    e.preventDefault();
    $(".vendoragreement").toggleClass("active");
});
</script>