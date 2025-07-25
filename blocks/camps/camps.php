<?php

$image   = get_field('image');
$text    = get_field('text');

?>

<main>
    <section>
        <div class="block_content">
            <div class="flex flex-wrap lg:flex-nowrap">
                <div class="w-full lg:w-1/2">
                    <figure class="h-full">
                        <img src="<?php echo esc_url($image); ?>" alt="Camps" class="w-full h-full object-cover">
                    </figure>
                </div>
                <div class="w-full lg:w-1/2 py-[60px] lg:py-24 px-[30px] lg:px-16 flex flex-col justify-center">
                    <div class="[_&_p]:lg:text-[18px] [_&_h2]:text-[30px] [_&_h2]:lg:text-[36px]">
                        <?php echo $text ?>
                    </div>
                    <div id="form" class="mt-8">
                        <?php if (is_page('camps')): ?>
                            <?php echo do_shortcode('[gravityform id="1" title="false" ajax="true"]')  ?>
                        <?php elseif (is_page('support')): ?>
                            <?php echo do_shortcode('[gravityform id="3" title="false" ajax="true"]')  ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>