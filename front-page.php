<?php

get_header();

?>

<main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_content(); ?>
</main>

<?php
get_footer();