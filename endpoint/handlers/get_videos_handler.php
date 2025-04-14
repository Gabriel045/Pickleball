<?php
// Handle the request to get videos
function get_videos_handler($request)
{
    $search = $request->get_param('search');
    $category = $request->get_param('category');

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        's' => $search,
    );

    if ($category && $category != 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }


    $query = new WP_Query($args);
    $query =  $query->posts;

    $result = array();

    foreach ($query as $post) {
        global $product;
        $product = wc_get_product($post->ID);
        $product_price = $product->get_price();
        $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];

        $result[] = array(
            'id' => $post->ID,
            'link' => get_permalink($post->ID),
            'thumbnail' =>  $product_image,
            'title' =>  $product->get_name(),
            'description' => $product->get_description(),
            'price' => $product_price,
        );
    };

    return  $result;
}