<?php get_header(); ?>

<main class="search-results">
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">
            Search Results for: <?php echo get_search_query(); ?>
        </h1>

        <?php if (have_posts()) : ?>
        <ul class="search-list">
            <?php while (have_posts()) : the_post(); ?>
            <li class="mb-4">
                <a href="<?php the_permalink(); ?>" class="text-blue-500 hover:underline">
                    <?php the_title(); ?>
                </a>
                <p class="text-gray-600 text-sm"><?php the_excerpt(); ?></p>
            </li>
            <?php endwhile; ?>
        </ul>
        <?php else : ?>
        <p class="text-gray-700">No results found for "<?php echo get_search_query(); ?>".</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>