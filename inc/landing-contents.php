<?php
/**
 * Functions for landing pages
 * @package Coast_Machinery
 */

if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('create-landing-pages', 'bulk_create_landing_pages');
}

function create_landing_page($city_name, $location_name)
{
    if (!$city_name || !$location_name) {
        return;
    }

    $args = [
        'post_type' => 'used-machine-parts',
        'posts_per_page' => -1,
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => 'city_name',
                'value' => $city_name,
                'compare' => '=',
            ],
            [
                'key' => 'select_location',
                'value' => $location_name,
                'compare' => '=',
            ],
        ],
    ];

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        return;
    }

    $exclude_terms = [
        15,
        6113,
        6114,
        6112,
        371,
        366,
        437,
        408,
        413,
        584,
        368,
        595,
        463,
        573,
        370,
        483,
        392,
        426,
        6117,
        382,
    ];
    $terms = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'exclude' => $exclude_terms,
    ]);

    if ($terms) {
        foreach ($terms as $term) {
            $exclude_terms[] = $term;
            $catsInn = get_terms([
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'exclude' => $exclude_terms,
            ]);
            shuffle($catsInn);
            $random_terms = array_slice($catsInn, 0, 5);
            array_pop($exclude_terms);
            $rand_list = "";
            if ($random_terms) {
                foreach ($random_terms as $rand) {
                    $rand_list .=
                        ", " .
                        strtolower(
                            str_replace(
                                " and ",
                                " & ",
                                get_field(
                                    'display_name',
                                    $rand->taxonomy . '_' . $rand->term_id
                                )
                            )
                        );
                }
            }

            $cat_display = get_field(
                'display_name',
                $term->taxonomy . '_' . $term->term_id
            );

            $choose_from = ["choose from", "select from", "find"];
            $variety = [
                "a wide variety",
                "a wide choice",
                "a huge collection",
                "a large collection",
                "a large range",
                "an extensive choice",
                "a broad variety",
                "a wide range",
                "a broad range",
                "a broad choice",
                "an array",
                "an assortment",
            ];
            $machines = ["machines", "machinery"];
            $grade = [
                "commercial grade",
                "industrial quality",
                "furniture grade",
                "heavy duty",
                "high end",
                "high quality",
            ];
            $looking = ["in the market", "looking", "searching", "shopping"];
            $wehave = ["Coast Machinery Group has", "we have"];
            $costeffective = [
                "a cost effective",
                "a money saving",
                "a lowered priced",
                "a cost efficient",
                "a money savvy",
                "an affordable",
            ];
            $option = ["solution", "option"];
            $cmg = ["CMG", "Coast Machinery Group"];
            $years = ["21 plus years", "over 21 years"];
            $industry = [
                "the industry",
                "the business",
                "the used machinery market",
                "this vertical market",
            ];
            $leading = ["top", "leading", "dominant", "prominent", "well-known"];
            $usedbroker = [
                "used machinery brokers",
                "used machine resellers",
                "used machinery agents",
                "used machinery dealers",
            ];
            $specializing = ["specializing", "focusing", "concentrating"];
            $maincats = ["metalworking", "woodworking", "stoneworking"];
            $mainprods = ["metal", "wood", "stone"];
            $regions = ["North American", "European"];
            $specialize = ["specialize in", "focus on", "concentrate in"];
            $quality_used = ["quality used", "quality pre-owned"];
            $used = ["used", "pre-owned"];
            $market = ["market", "business", "industry"];
            $contact = ["contact", "reach out to"];
            $find = ["find", "buy"];
            $need = ["need", "require", "must have"];
            $choose = [
                "choose from",
                "find",
                "select from",
                "purchase",
                "buy",
                "acquire",
                "locate",
            ];
            $browse = ["browse", "peruse", "search", "look"];
            $comm_quality = [
                "commercial quality",
                "industrial grade",
                "commercial grade",
                "production quality",
            ];
            $made = ["that is made", "fabricated", "constructed", "manufactured"];
            $trusted = [
                "trusted",
                "high end",
                "top end",
                "high quality",
                "top quality",
            ];
            $manufacture = ["manufacturers", "companies", "factories"];
            $manufacturing = ["manufacturing", "production", "business"];
            $canwork = ["can work with", "process", "undertake"];
            $needs = ["applications", "needs", "requirements", "demands"];
            $experience = ["experience"];
            $exphave = ["we have", "with over"];
            $expyear = ["21+ years", "21 years"];
            $expyear2 = ["Over 21 years", "With 21 years +"];
            $everymachine = ["All our machinery", "Every Machine"];
            $extended = ["an extended", "a limited running"];
            $tested = ["tested", "verified"];
            $withover = ["With over", "Having over"];
            $warehouse = ["storage", "warehouse"];
            $houses = ["houses", "has"];
            $hero_title = [
                "Quality used",
                "Quality pre-owned",
                "Tested pre-owned",
                "Used machinery brokers for",
                "Used and tested",
                "Used machinery dealers for",
            ];
            $lessprice = [
                "at affordable",
                "at budget geared",
                "at inexpensive",
                "for less",
            ];
            $complicated = [
                "complicated",
                "overwhelming",
                "daunting",
                "time consuming",
            ];
            $finding = ["finding", "searching for", "looking for"];
            $shop = ["shop", "business", "company", "operation"];
            $solutions = ["solutions", "options", "machines", "units"];
            $contactoffice = ["our office", "our office team", "us"];

            $pref_city = $city_name . ", " . $location_name;
            $pref_title = $cat_display . " - " . $city_name . " - " . $location_name;

            $hero1_opt1 =
                ucfirst($choose_from[array_rand($choose_from, 1)]) .
                " " .
                $variety[array_rand($variety, 1)] .
                " of " .
                $grade[array_rand($grade, 1)] .
                " " .
                $machines[array_rand($machines, 1)] .
                " in " .
                $pref_city .
                ". Whether you are " .
                $looking[array_rand($looking, 1)] .
                " for " .
                str_replace(" and ", " & ", $cat_display) .
                $rand_list .
                ", or any other " .
                $machines[array_rand($machines, 1)] .
                "; " .
                $wehave[array_rand($wehave, 1)] .
                " " .
                $costeffective[array_rand($costeffective, 1)] .
                " " .
                $option[array_rand($option, 1)] .
                " for you";

            $hero2_opt1 =
                "With " .
                $years[array_rand($years, 1)] .
                " of experience in " .
                $industry[array_rand($industry, 1)] .
                ", " .
                $cmg[array_rand($cmg, 1)] .
                " is one of North America's " .
                $leading[array_rand($leading, 1)] .
                " " .
                $usedbroker[array_rand($usedbroker, 1)] .
                " for " .
                $grade[array_rand($grade, 1)] .
                " european " .
                $machines[array_rand($machines, 1)] .
                ". " .
                ucfirst($specializing[array_rand($specializing, 1)]) .
                " in" .
                mainCatsList($maincats, "and") .
                ", they have " .
                $variety[array_rand($variety, 1)] .
                " to choose from";

            $hero1_opt2 =
                $cmg[array_rand($cmg, 1)] .
                " has the " .
                $machines[array_rand($machines, 1)] .
                " you " .
                $need[array_rand($need, 1)] .
                " to complete your shop for" .
                mainCatsList($maincats, "or") .
                "in " .
                $pref_city .
                ". " .
                ucfirst($choose[array_rand($choose, 1)]) .
                " " .
                $variety[array_rand($variety, 1)] .
                " of " .
                $quality_used[array_rand($quality_used, 1)] .
                " " .
                $machines[array_rand($machines, 1)] .
                " like " .
                str_replace(" and ", " & ", $cat_display) .
                $rand_list .
                ", or any other " .
                $machines[array_rand($machines, 1)] .
                ". Regardless of your budget, " .
                $cmg[array_rand($cmg, 1)] .
                " has " .
                $costeffective[array_rand($costeffective, 1)] .
                " " .
                $option[array_rand($option, 1)] .
                " for you";

            $hero2_opt2 =
                $cmg[array_rand($cmg, 1)] .
                " has " .
                $years[array_rand($years, 1)] .
                " experience in the " .
                $used[array_rand($used, 1)] .
                " " .
                $machines[array_rand($machines, 1)] .
                " " .
                $market[array_rand($market, 1)] .
                ". Being one of North America's " .
                $leading[array_rand($leading, 1)] .
                " " .
                $usedbroker[array_rand($usedbroker, 1)] .
                " for " .
                $grade[array_rand($grade, 1)] .
                " " .
                $machines[array_rand($machines, 1)] .
                ", they " .
                $specialize[array_rand($specialize, 1)] .
                mainCatsList($maincats, "and") .
                ". " .
                ucfirst($browse[array_rand($browse, 1)]) .
                " through " .
                $variety[array_rand($variety, 1)] .
                " of " .
                $machines[array_rand($machines, 1)] .
                " online";

            $hero1_opt3 =
                ucfirst($comm_quality[array_rand($comm_quality, 1)]) .
                " " .
                $machines[array_rand($machines, 1)] .
                " " .
                $made[array_rand($made, 1)] .
                " by " .
                $trusted[array_rand($trusted, 1)] .
                mainCatsList($regions, "or") .
                $manufacture[array_rand($manufacture, 1)] .
                ". Get " .
                $variety[array_rand($variety, 1)] .
                " of " .
                $machines[array_rand($machines, 1)] .
                " that " .
                $canwork[array_rand($canwork, 1)] .
                mainCatsList($mainprods, "or") .
                ". " .
                $cmg[array_rand($cmg, 1)] .
                " can find the right " .
                $machines[array_rand($machines, 1)] .
                " for your " .
                $needs[array_rand($needs, 1)];

            $hero2_opt3 =
                "One of North America's top " .
                $usedbroker[array_rand($usedbroker, 1)] .
                ", " .
                $cmg[array_rand($cmg, 1)] .
                " has " .
                $years[array_rand($years, 1)] .
                " of " .
                $experience[array_rand($experience, 1)] .
                " in " .
                $industry[array_rand($industry, 1)] .
                ". " .
                ucfirst($choose[array_rand($choose, 1)]) .
                " " .
                $variety[array_rand($variety, 1)] .
                " of" .
                mainCatsList($regions, "and") .
                "made specialized " .
                $machines[array_rand($machines, 1)] .
                " for " .
                mainCatsList($maincats, "and");

            $expertise__1 =
                ucfirst($exphave[array_rand($exphave, 1)]) .
                " " .
                $expyear[array_rand($expyear, 1)] .
                " of " .
                $experience[array_rand($experience, 1)] .
                " in " .
                $used[array_rand($used, 1)] .
                " " .
                $machines[array_rand($machines, 1)] .
                " sales to all " .
                $manufacturing[array_rand($manufacturing, 1)] .
                " sectors across North America.";
            $expertise__2 =
                $expyear2[array_rand($expyear2, 1)] .
                " " .
                $experience[array_rand($experience, 1)] .
                " in " .
                $quality_used[array_rand($quality_used, 1)] .
                " " .
                $machines[array_rand($machines, 1)] .
                " to " .
                $manufacturing[array_rand($manufacturing, 1)] .
                " sectors across North America";

            $info__2 =
                $everymachine[array_rand($everymachine, 1)] .
                " comes with " .
                $extended[array_rand($extended, 1)] .
                " warranty and is fully " .
                $tested[array_rand($tested, 1)] .
                " by our in house technicians.";
            $info__3 =
                $withover[array_rand($withover, 1)] .
                " 20,000 sq ft of " .
                $warehouse[array_rand($warehouse, 1)] .
                " space, CMG " .
                $houses[array_rand($houses, 1)] .
                " hundreds of " .
                $machines[array_rand($machines, 1)] .
                " ready to ship across North America and beyond.";

            $prod_cont1 =
                "Look to CMG as your " .
                $usedbroker[array_rand($usedbroker, 1)] .
                " of choice when you're " .
                $looking[array_rand($looking, 1)] .
                " for" .
                mainCatsList($maincats, "or") .
                ". Having 21 years " .
                $experience[array_rand($experience, 1)] .
                " in the " .
                $used[array_rand($used, 1)] .
                " " .
                $machines[array_rand($machines, 1)] .
                " " .
                $market[array_rand($market, 1)] .
                ", they can find you " .
                $comm_quality[array_rand($comm_quality, 1)] .
                " " .
                $machines[array_rand($machines, 1)] .
                " " .
                $lessprice[array_rand($lessprice, 1)] .
                " prices.";
            $prod_cont2 =
                "Let CMG simplify the " .
                $complicated[array_rand($complicated, 1)] .
                " process of " .
                $finding[array_rand($finding, 1)] .
                " quality " .
                $used[array_rand($used, 1)] .
                " " .
                $machines[array_rand($machines, 1)] .
                " for your " .
                $shop[array_rand($shop, 1)] .
                ". Find " .
                $solutions[array_rand($solutions, 1)] .
                " to help you increase productivity and quality when fabricating with" .
                mainCatsList($mainprods, "or") .
                ". " .
                ucfirst($browse[array_rand($browse, 1)]) .
                " through " .
                $variety[array_rand($variety, 1)] .
                " while relying  on 21 years' " .
                $experience[array_rand($experience, 1)] .
                ".";

            $contact_cont1 =
                ucfirst($contact[array_rand($contact, 1)]) .
                " to our knowledgeable staff for affordable turn key " .
                $solutions[array_rand($solutions, 1)] .
                " for" .
                mainCatsList($mainprods, "or") .
                $machines[array_rand($machines, 1)] .
                ". Whether you're starting a business, need to remove bottlenecks in your shop, or want to upgrade; " .
                $cmg[array_rand($cmg, 1)] .
                " can find an answer to your " .
                $needs[array_rand($needs, 1)] .
                ".";
            $contact_cont2 =
                "Call, text, or email our staff to find out what " .
                $cmg[array_rand($cmg, 1)] .
                " can do for you. We can match you with " .
                $machines[array_rand($machines, 1)] .
                " that will fulfill your fabrication needs, whether working in" .
                mainCatsList($mainprods, "or") .
                ". If you're just starting a company, need to improve your production line, or want a machine upgrade; " .
                $cmg[array_rand($cmg, 1)] .
                " can provide you with ready " .
                $solutions[array_rand($solutions, 1)] .
                " for your business.";

            $title__1 =
                ucfirst($hero_title[array_rand($hero_title, 1)]) .
                " " .
                $cat_display .
                " in " .
                $pref_city;
            $title__2 =
                ucfirst($find[array_rand($find, 1)]) .
                " " .
                $cat_display .
                " at Coast Machinery for your " .
                $shop[array_rand($shop, 1)];
            $title__3 = "Contact " . $contactoffice[array_rand($contactoffice, 1)];

            $seo_title =
                "Used " .
                $cat_display .
                " in " .
                $pref_city .
                " &ndash; Coast Machinery";
            $seo_desc =
                "We " .
                $specialize[array_rand($specialize, 1)] .
                " " .
                $quality_used[array_rand($quality_used, 1)] .
                mainCatsList($maincats, "&") .
                $machines[array_rand($machines, 1)] .
                ". " .
                ucfirst($contact[array_rand($contact, 1)]) .
                " us from " .
                $city_name .
                " to " .
                $find[array_rand($find, 1)] .
                " quality used " .
                $cat_display .
                " at CMG today.";

            $hero_1 = [$hero1_opt1, $hero1_opt2, $hero1_opt3];
            $hero_2 = [$hero2_opt1, $hero2_opt2, $hero2_opt3];
            $hero =
                "<p>" .
                $hero_1[array_rand($hero_1, 1)] .
                ".</p><p>" .
                $hero_2[array_rand($hero_2, 1)] .
                ".</p>";

            $info__1 = [$expertise__1, $expertise__2];
            $prod_content = [$prod_cont1, $prod_cont2];
            $cont_content = [$contact_cont1, $contact_cont2];

            $args = [
                'post_title' => $pref_title,
                'post_content' => "",
                'post_status' => 'publish',
                'post_type' => 'used-machine-parts',
                'meta_input' => [
                    '_yoast_wpseo_title' => $seo_title,
                    '_yoast_wpseo_focuskw' =>
                        'used ' .
                        strtolower($cat_display) .
                        ' in ' .
                        strtolower($city_name),
                    '_yoast_wpseo_metadesc' => $seo_desc,
                    'select_category' => $term,
                    'select_location' => $location_name,
                    'location_slug' => sanitize_title($location_name),
                    'city_name' => $city_name,
                    'city_slug' => sanitize_title($city_name),
                    'intro_title' => $title__1,
                    'hero_contents' => $hero,
                    'products_title' => $title__2,
                    'products_contents' => $prod_content[array_rand($prod_content, 1)],
                    'contact_title' => $title__3,
                    'contact_contents' => $cont_content[array_rand($cont_content, 1)],
                    'info_content_1' => $info__1[array_rand($info__1, 1)],
                    'info_content_2' => $info__2,
                    'info_content_3' => $info__3,
                ],
            ];
            $post_id = wp_insert_post($args);
        }
    }
}

function mainCatsList($cats_input, $separator): string
{
    $size = count($cats_input);
    $catListOutput = "";
    shuffle($cats_input);
    $count = 0;
    foreach ($cats_input as $cat_input) {
        $count++;
        $sep = ", ";
        if ($count === 1) {
            $sep = " ";
        } elseif ($count === $size) {
            $sep = ", " . $separator . " ";
        }
        $catListOutput .= $sep . str_replace(" and ", " & ", $cat_input);
    }
    return $catListOutput . " ";
}