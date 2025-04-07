<div id="post-<?php the_ID(); ?>" class="container <?php post_class(); ?>">
    <div class="row">
        <div class="col-md-12">
            <h1> <?php the_title(); ?> </h1> 
        </div>
        <div class="col-md-12">
            <?php the_content(); ?> 
        </div>
    </div>
</div>