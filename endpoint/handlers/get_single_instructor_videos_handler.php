<?php
// Handle the request to get videos
function get_single_instructor_videos_handler($request)
{
    $id = intval($request->get_param('id'));
    $search = sanitize_text_field($request->get_param('search'));
    $category = sanitize_text_field($request->get_param('category'));


    $courses = get_field('courses', $id);


    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post__in' => $courses,
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
        $regular_price = wc_price($product->get_regular_price());
        $sale_price = wc_price($product->get_sale_price());
        $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
        $coming_soon = get_field('coming_soon', $post->ID);


        $result[] = array(
            'id' => $post->ID,
            'link' => get_permalink($post->ID),
            'thumbnail' =>  $product_image,
            'title' =>  $product->get_name(),
            'description' => wp_trim_words($product->get_description(), 12, '...'),
            'regular_price' => $regular_price,
            'sale_price' => $sale_price,
            'coming_soon' => $coming_soon,
        );
    };

    return  $result;
}
