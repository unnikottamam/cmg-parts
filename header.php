<?php
/**
 * The header for our theme
 * @package cmg-web
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon.png?v=00aAk5QMWA">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=00aAk5QMWA">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=00aAk5QMWA">
    <link rel="manifest" href="/site.webmanifest?v=00aAk5QMWA">
    <link rel="mask-icon" href="/safari-pinned-tab.svg?v=00aAk5QMWA" color="#00548c">
    <link rel="shortcut icon" href="/favicon.ico?v=00aAk5QMWA">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/public/css/app.min.css"/>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php if (is_page_template('template-parts/template-sms-campaign.php')) {
    echo 'style="padding: 0 !important;"';
} ?>>
<?php wp_body_open(); ?>
<header class="position-sticky z-3 border-bottom top-0 shadow-sm">
    <div class="py-2 bg-white">
        <div class="container">
            <div class="row align-items-center gx-lg-2 gx-0">
                <a class="col-lg-2 col-md-6 col-5 navbar-brand" href="<?php echo home_url(); ?>">
                    <img width="190" height="38" src="<?php echo get_template_directory_uri(); ?>/src/img/logo.png"
                         alt="CMG Website">
                </a>
                <div class="col-lg-3 d-none d-lg-block">
                    <?php get_search_form(); ?>
                </div>
                <div
                        class="col-lg-7 col-md-6 col-7 d-flex column-gap-2 fw-bold justify-content-end align-items-center">
                    <button id="headerContact" class="btn btn-success d-flex column-gap-1" data-bs-toggle="modal"
                            data-bs-target="#formModal">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                    d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
                            <path
                                    d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5"/>
                        </svg>
                        CONTACT
                    </button>
                    <a class="d-none d-lg-block pe-2 border-end" href="tel:+1 (604) 556-2225">
                        <div class="small d-flex align-items-center column-gap-1">
                            <svg width="16" height="16" viewBox="0 0 16 16">
                                <path
                                        d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                            </svg>
                            CANADA
                        </div>
                        (604) 556-2225
                    </a>
                    <a class="d-none d-lg-block" href="tel:+1 (866) 306-3330">
                        <div class="small d-flex align-items-center column-gap-1">
                            <svg width="16" height="16" viewBox="0 0 16 16">
                                <path
                                        d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                            </svg>
                            INTERNATIONAL
                        </div>
                        +1 (866) 306-3330
                    </a>
                    <div class="d-inline-block d-lg-none">
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#webMenu" aria-controls="webMenu" aria-label="Toggle navigation">
                            <svg width="32" height="32" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="webMenu" aria-labelledby="webMenuLabel">
                <div class="offcanvas-header column-gap-2 py-2">
                    <div class="input-group">
                        <?php get_search_form(); ?>
                    </div>
                    <button type="button" class="btn px-2 btn-outline-danger d-flex column-gap-1"
                            data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path
                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                        </svg>
                        Close
                    </button>
                </div>
                <div class="offcanvas-body justify-content-between align-items-lg-center bg-primary">
                    <ul class="navbar-nav px-2 px-lg-0 fw-medium">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center column-gap-1 ps-0" href="#"
                               data-bs-toggle="modal" data-bs-target="#categoryModal">
                                All Categories
                                <span class="btn p-0 btn-primary border-0">
                                        <svg width="16" height="16"
                                             viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                                        </svg>
                                    </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               target="_blank"
                               href="https://www.coastmachinery.com/sell-your-machines-with-coast-machinery-group/">
                                Sell Your Machines
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="https://www.coastmachinery.com/">
                                Used Machines
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="<?php echo home_url(); ?>/about-quality-used-machinery-dealer/">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="<?php echo home_url(); ?>/contact-used-machinery-dealer/">Contact</a>
                        </li>
                        <li class="nav-item d-none">
                            <a class="nav-link" href="<?php echo home_url(); ?>/used-machinery-vendor/">Vendor
                                Dashboard</a>
                        </li>
                    </ul>
                    <div class="d-flex column-gap-2 px-2 px-lg-0 py-2 py-lg-0">
                        <a class="btn btn-outline-white btn-sm p-1" href="<?php echo home_url(); ?>/cart/">
                            <svg width="16" height="16" viewBox="0 0 16 16">
                                <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                            </svg>
                        </a>
                        <?php echo do_shortcode('[woo_multi_currency]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>