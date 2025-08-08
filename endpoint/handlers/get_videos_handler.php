<?php
// Handle the request to get videos
function get_videos_handler($request)
{
    $search = $request->get_param('search');
    $skill_level = $request->get_param('skill_level');
    $category = $request->get_param('category');

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        's' => $search,
    );

    if (!empty($skill_level) && $skill_level != 'all') {
        $args['meta_query'] = array(
            array(
                'key' => 'skill_level',
                'value' => $skill_level,
                'compare' => '=',
            ),
        );
    }

    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }


    $query = new WP_Query($args);
    $query =  $query->posts;

    $result = array();

    foreach ($query as $post) {
        global $product;
        $product = wc_get_product($post->ID);
        $regular_price = wc_price($product->get_regular_price());
        $sale_price = wc_price($product->get_sale_price());
        $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
        $coming_soon = get_field('coming_soon', $post->ID);

        $result[] = array(
            'id' => $post->ID,
            'link' => get_permalink($post->ID),
            'thumbnail' =>  $product_image,
            'title' =>  $product->get_name(),
            'description' => $product->get_short_description(),
            'regular_price' => $regular_price,
            'sale_price' => $sale_price,
            'coming_soon' => $coming_soon,

        );
    };

    return  $result;
}
