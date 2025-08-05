<?php
// Handle the request to get instructors
function get_instructors_handler($request)
{
    $search = $request->get_param('search');

    $args = array(
        'post_type' => 'instructor',
        'posts_per_page' => -1,
        's' => $search,
    );

    $query = new WP_Query($args);
    $query = $query->posts;

    $result = array();

    foreach ($query as $post) {
        $instructor_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];

        $result[] = array(
            'id' => $post->ID,
            'link' => get_permalink($post->ID),
            'thumbnail' => $instructor_image,
            'name' => get_the_title($post->ID),
            'role' => get_field('role', $post->ID),
        );
    };

    return $result;
}