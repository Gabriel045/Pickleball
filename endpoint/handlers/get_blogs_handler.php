<?php
// Handle the request to get videos
function get_blogs_handler($request)
{
    $search = sanitize_text_field($request->get_param('search'));
    $args = array(
        'post_type' => 'blog',
        'posts_per_page' => -1,
        's' => $search,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $query = new WP_Query($args);
    $query = $query->posts;

    if (empty($search)) {
        $query = array_slice($query, 3);
    }

    $result = array();

    foreach ($query as $post) {
        $blog_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];

        $result[] = array(
            'id' => $post->ID,
            'link' => get_permalink($post->ID),
            'thumbnail' => $blog_image,
            'title' => get_the_title($post->ID),
            'excerpt' => get_the_excerpt($post->ID),
            'author' => get_the_author_meta('display_name', $post->post_author),
            'date' => get_the_date('j M Y', $post->ID),
            'readTime' => get_field('read_time', $post->ID)
        );
    }

    return  $result;
}
