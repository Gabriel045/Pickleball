<?php

get_header();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        if ( is_single() ) {
            get_template_part( 'template-parts/single' );
        } else {
            get_template_part( 'template-parts/archive' );
        }
    }
} else {
    get_template_part( 'template-parts/no-content.php' );
}

get_footer();
