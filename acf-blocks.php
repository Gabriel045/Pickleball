<?php

//ACF Blocks
add_action('init', 'register_acf_blocks');

function register_acf_blocks()
{
    register_block_type(__DIR__ . '/blocks/home-hero');
    register_block_type(__DIR__ . '/blocks/product-slider');
    register_block_type(__DIR__ . '/blocks/text-image');
    register_block_type(__DIR__ . '/blocks/how-it-works-slider');
    register_block_type(__DIR__ . '/blocks/recent-blogs');
}