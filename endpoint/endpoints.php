<?php

include_once "handlers/get_videos_handler.php";
include_once "handlers/get_instructors_handler.php";
include_once "handlers/get_single_instructor_videos_handler.php";
include_once "handlers/get_blogs_handler.php";

add_action('rest_api_init', function () {
    register_rest_route('custom/v2', '/get_videos', array(
        'methods' => 'POST',
        'callback' => 'get_videos_handler',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('custom/v2', '/get_single_instructor_videos', array(
        'methods' => 'POST',
        'callback' => 'get_single_instructor_videos_handler',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('custom/v2', '/get_instructors', array(
        'methods' => 'POST',
        'callback' => 'get_instructors_handler',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('custom/v2', '/get_blogs', array(
        'methods' => 'POST',
        'callback' => 'get_blogs_handler',
        'permission_callback' => '__return_true',
    ));
});