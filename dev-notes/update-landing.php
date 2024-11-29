<?php
$current_user = wp_get_current_user();
if ($current_user->user_email == 'unnikottamam@gmail.com') {
    $args = [
        'post_type' => 'used-machine-parts',
        'posts_per_page' => 700,
        'post__in' => [],
    ];

    $datalist = [
        ["Band Saws", "Band Saw"],
        ["Bridge Saws", "Bridge Saw"],
        ["Cabinetry Clamps", "Cabinetry Clamp"],
        ["Chops Saws and Radial Arm Saws", "Chop Saw and Radial Arm Saw"],
        ["Combination Drills", "Combination Drill"],
        ["Compressor Air Dryers", "Compressor Air Dryer"],
        ["Conveyors", "Conveyor"],
        ["Dust Collectors", "Dust Collector"],
        ["Edgebanders", "Edgebander"],
        ["Finish Paint Lines", "Finish Paint Line"],
        ["Forklifts", "Forklift"],
        ["Glass Fabrication Machines", "Glass Fabrication Machine"],
        ["Grinders", "Grinder"],
        ["Hinge Drills", "Hinge Drill"],
        ["Horizontal Drills", "Horizontal Drill"],
        ["Jointers", "Jointer"],
        ["Metal Benders and Threaders", "Metal Bender and Threader"],
        ["Metal Brakes and Shears", "Metal Brake and Shear"],
        ["Metal CNCs", "Metal CNC"],
        ["Metal Lathes", "Metal Lathe"],
        ["Metal Presses", "Metal Press"],
        ["Metalworking Machines", "Metalworking Machine"],
        ["Milling and Drilling Machines", "Milling and Drilling Machine"],
        ["Mortisers and Tenoners", "Mortiser and Tenoner"],
        ["Paint Booths", "Paint Booth"],
        ["Pinch Rollers and Glue Spreaders", "Pinch Roller and Glue Spreader"],
        ["Piston Compressors", "Piston Compressor"],
        ["Planers", "Planer"],
        ["Power Feeders", "Power Feeder"],
        ["Rip Saws", "Rip Saw"],
        ["Scissor Lifts", "Scissor Lift"],
        ["Screw Compressors", "Screw Compressor"],
        ["Shapers", "Shaper"],
        ["Sliding Saws", "Sliding Saw"],
        ["Stone and Glass Machinery", "Stone and Glass Machinery"],
        ["Table Saws", "Table Saw"],
        ["Thickness Sanders for Wood", "Thickness Sander for Wood"],
        ["Vertical Drills", "Vertical Drill"],
        ["Welders", "Welder"],
        ["Wood Drilling Machines", "Wood Drilling Machine"],
        ["Wood Edge Sanders", "Wood Edge Sander"],
        ["Wood Laminating Machines", "Wood Laminating Machine"],
        ["Wood Lathes", "Wood Lathe"],
        ["Wood Moulders and Shapers", "Wood Moulder and Shaper"],
        ["Wood Veneer Guillotines", "Wood Veneer Guillotine"],
        ["Woodworking CNCs", "Woodworking CNC"],
        ["Woodworking Machinery", "Woodworking Machinery"],
    ];

    query_posts($args);
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $post = get_post(get_the_ID());
            $city_name = $post->city_name;
            $term = $post->select_category;
            $location_name = $post->select_location;
            $seo_desc = $post->_yoast_wpseo_metadesc;
            $cat_display = get_field(
                'display_name',
                $term->taxonomy . '_' . $term->term_id
            );

            foreach ($datalist as $data_item) {
                if (strpos($seo_desc, $data_item[0]) !== false) {
                    $seo_desc = str_replace(
                        $data_item[0],
                        $data_item[1],
                        $post->_yoast_wpseo_metadesc
                    );
                }
            }
            $seo_title =
                "Used " .
                $cat_display .
                " in " .
                $city_name .
                ", " .
                $location_name .
                " &ndash; Coast Machinery";
            $focus =
                'used ' . strtolower($cat_display) . ' in ' . strtolower($city_name);

            $pref_title = $cat_display . " - " . $city_name . " - " . $location_name;
            $permalink = sanitize_title($pref_title);

            $args = [
                'ID' => get_the_ID(),
                'post_title' => $pref_title,
                'post_type' => 'used-machine-parts',
                'post_name' => $permalink,
                'meta_input' => [
                    '_yoast_wpseo_title' => $seo_title,
                    '_yoast_wpseo_focuskw' => $focus,
                    '_yoast_wpseo_metadesc' => $seo_desc,
                ],
            ];
            $result_id = wp_update_post($args);
            if ($result_id) {
                echo "<div>" . get_the_ID() . " - " . $permalink . "</div>";
            }
        }
        wp_reset_query();
    }
}