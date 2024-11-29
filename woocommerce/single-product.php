<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

get_header();
do_action('woocommerce_before_main_content');
?>
<section id="product_<?php the_ID(); ?>" <?php post_class('pt-2 pb-3 pt-md-3 pb-md-4'); ?>>
    <?php while (have_posts()) {
      the_post();
      $quantity = $product->get_stock_quantity();
      $btnClass = $quantity ? "rounded-end-pill" : "rounded-pill";
      ?>
    <div id="productInn" class="container">
        <?php do_action('woocommerce_before_single_product'); ?>
        <div class="row align-items-start justify-content-center justify-content-md-end position-relative">
            <div class="machinery__right order-0 order-md-2">
                <div class="text-center text-md-start d-flex flex-column">
                    <div>
                        <div
                            class="d-flex gap-2 align-items-center pb-1 justify-content-center justify-content-md-start">
                            <span
                                class="border border-2 border-secondary bg-secondary-subtle bg-gradient d-inline-flex h6 text-danger py-1 px-3 rounded-pill shadow m-0">
                                SKU: <?php echo $product->get_sku(); ?>
                            </span>
                            <?php
                            if ($quantity && $product->get_price_html())  {
                                echo $product->get_price_html();
                            } ?>
                        </div>
                        <?php
                        woocommerce_template_single_title();
                        if (!$quantity) { ?>
                        <p class="col-12 mb-1">
                            <span class="opacity-75 fw-medium border-bottom me-1">Out of Stock</span>
                            But wait, we have similar products
                        </p>
                        <?php } ?>
                    </div>
                    <div class="d-flex justify-content-center justify-content-md-start flex-wrap">
                        <?php echo $quantity ? woocommerce_template_single_add_to_cart() : ""; ?>
                        <button
                            class="btn btn-success column-gap-1 d-inline-flex <?php echo $btnClass ?> text-uppercase shadow"
                            data-bs-toggle="modal" data-bs-target="#formModal">
                            Contact Us
                            <svg width="16" height="16" viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="machinery__imgs pt-3 pt-md-0 pb-md-3 order-1 h-100">
                <?php do_action('woocommerce_before_single_product_summary'); ?>
            </div>
            <div class="machinery__right order-3">
                <?php echo woocommerce_output_product_data_tabs(); ?>
            </div>
        </div>
        <?php
        do_action('woocommerce_after_single_product');
        echo woocommerce_output_related_products();
        ?>
    </div>
    <?php } ?>
</section>
<?php
do_action('woocommerce_after_main_content');
get_footer();
?>
<script>
const tabs = document.querySelectorAll('.tab-btn');
const tabContents = document.querySelectorAll('.tab-content');
const activeClassList = ['border-secondary', 'bg-secondary-subtle', 'fw-bold', 'text-primary', 'bg-gradient'];
tabs.forEach(btn => {
    btn.addEventListener('click', () => {
        const label = btn.dataset.tab;
        const shouldHide = label.includes('similar');
        document.querySelector("#prodMain").classList.toggle('d-none', shouldHide);
        tabs.forEach(tab => {
            tab.classList.remove(...activeClassList);
        });
        btn.classList.add(...activeClassList);
        tabContents.forEach(content => {
            content.classList.add('d-none');
        });
        document.getElementById(label).classList.remove('d-none');
    });
});

const zoomContainer = document.getElementById('zoom-container');
const zoomImage = document.getElementById('zoom-image');
if (zoomContainer && zoomImage) {
    const zoomImageSrc = zoomImage.src;
    const zoomImageSrcAttr = zoomContainer.getAttribute('data-zoom');
    zoomContainer.addEventListener('mousemove', zoomIn);
    zoomContainer.addEventListener('mouseleave', zoomOut);

    function zoomIn(event) {
        if (zoomImage.src !== zoomImageSrcAttr) {
            zoomImage.src = zoomImageSrcAttr;
        }
        const containerRect = zoomContainer.getBoundingClientRect();
        const imageRect = zoomImage.getBoundingClientRect();
        const ratioX = imageRect.width / containerRect.width;
        const ratioY = imageRect.height / containerRect.height;
        const mouseX = event.clientX - containerRect.left;
        const mouseY = event.clientY - containerRect.top;
        const translateX = containerRect.width / 2 - mouseX;
        const translateY = containerRect.height / 2 - mouseY;
        zoomImage.style.transform = `translate(${translateX}px, ${translateY}px) scale(2)`;
    }

    function zoomOut() {
        zoomImage.style.transform = 'none';
        zoomImage.src = zoomImageSrc;
    }
}

const similarBtn = document.querySelector('#similarProducts');
if (similarBtn) {
    similarBtn.addEventListener('click', () => {
        document.querySelector(`button[data-tab="tab-similar"]`).click();
    });
}

window.addEventListener('DOMContentLoaded', (event) => {
    let head = document.getElementsByTagName('body')[0];
    let link = document.createElement('link');
    link.id = "photoswipe-css";
    link.rel = 'stylesheet';
    link.href = 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe.min.css';
    head.appendChild(link);
    let defstyle = document.createElement('link');
    defstyle.id = "photoswipe-css";
    defstyle.rel = 'stylesheet';
    defstyle.href = 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/default-skin/default-skin.min.css';
    head.appendChild(
        defstyle);
    let script = document.createElement("script");
    script.id = "photoswipe-script";
    script.type = "text/javascript";
    script.src =
        "https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe.min.js";
    head.appendChild(script);
    let defscript = document.createElement("script");
    defscript.id = "photoswipe-script";
    defscript.type = "text/javascript";
    defscript.src =
        "https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe-ui-default.min.js";
    head.appendChild(defscript);

    let pswpElement = document.querySelectorAll('.pswp')[0];
    let items = [];
    let options = {
        index: 0
    };
    let initVal = false;
    let gallery;
    let galElems = document.querySelectorAll(".gallery-item");
    galElems.forEach(function(elem) {
        elem.addEventListener("click", function(e) {
            e.preventDefault();
            document.querySelector("#pswpGallery").classList.remove('d-none');
            if (!initVal) {
                galleryInitial();
            }
            options.index = parseInt(elem.dataset.index, 10);
            gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
            initVal = true;
        });
    });

    function galleryInitial() {
        <?php $prodImg = wp_get_attachment_image_src($product->get_image_id(),'full'); ?>
        item = {
            src: "<?php echo $prodImg[0]; ?>",
            w: <?php echo $prodImg[1]; ?>,
            h: <?php echo $prodImg[2]; ?>
        };
        items.push(item);
        <?php
        $images = $product->get_gallery_image_ids();
        foreach ($images as $image) { ?>
        item = {
            src: "<?php echo wp_get_attachment_image_src($image, 'full' )[0]; ?>",
            w: <?php echo wp_get_attachment_image_src($image, 'full')[1]; ?>,
            h: <?php echo wp_get_attachment_image_src($image, 'full')[2]; ?>
        };
        items.push(item);
        <?php } ?>
    }
});
</script>