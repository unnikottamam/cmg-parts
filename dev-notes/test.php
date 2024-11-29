<ol class="list-group list-group-numbered bg-white shadow">
    <?php
    $woodCats = get_terms(array(
        'taxonomy' => 'product_cat',
        'parent'   => 361,
    ));
    foreach ($woodCats as $woodCat) { ?>
    <li class="list-group-item">
        <a href="<?php echo get_term_link($woodCat); ?>"><?php echo $woodCat->name; ?></a>
        <?php
        $woodCatSubs = get_terms(array(
            'taxonomy' => 'product_cat',
            'parent'   => $woodCat->term_id,
        ));
        if ($woodCatSubs) {
            echo '<ul>';
            foreach ($woodCatSubs as $woodCatSub) { ?>
    <li>
        <a class="pt-1 d-flex" href="<?php echo get_term_link($woodCatSub); ?>"><?php echo $woodCatSub->name; ?></a>
    </li>
    <?php }
            echo '</ul>';
        } ?>
    </li>
    <?php } ?>
</ol>

<div class="modal fade" id="noticeModal1" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h3 class="modal-title fs-5" id="noticeModalLabel">
                    <span
                        class="fs-6 bg-success-subtle rounded-2 px-2 text-dark d-inline-block border border-success">Unwrap
                        Savings</span><br>
                    Holiday Extravaganza on Quality Used Machines!
                </h3>
            </div>
            <div class="modal-body fw-semibold">
                <p>🚀 Explore our holiday catalog online or visit our showroom today! Whether you're a small business
                    looking
                    for cost-effective solutions or an industrial powerhouse seeking to expand, Coast Machinery Group
                    has the
                    perfect machine for you.</p>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn rounded-pill btn-outline-danger shadow-lg d-flex column-gap-1"
                    data-bs-dismiss="modal" aria-label="Close">
                    Cancel
                    <svg width="14" height="14" viewBox="0 0 16 16">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<section class="bg-success my-3 my-md-4 py-3 py-md-4 border-top border-bottom border-dark-subtle"
    style="--bs-bg-opacity: .1;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 fw-semibold">
                <h2 class="fs-3 text-dark">Quality Used Production Machinery</h2>
                <p>Since opening its doors over <?php echo date('Y') - 2000; ?> years ago, Coast Machinery Group has become a Canadian leader in used
                    asset sales, selling machinery equipment to all manufacturing sectors across North America.</p>
                <ul class="mb-0">
                    <li>30 Years Experience In Selling CNC Machinery</li>
                    <li>Machinery Tested By Experienced Technicians</li>
                    <li>Over 20,000 Contacts Worldwide Within The Manufacturing Industry</li>
                    <li>Free Consultation And Appraisals Offered</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<script>
const headerContact = document.getElementById('headerContact')

function triggerClick() {
    headerContact.click();
}
//setTimeout(triggerClick, 3000);
</script>