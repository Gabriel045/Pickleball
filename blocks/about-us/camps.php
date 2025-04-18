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
                        <img src="/wp-content/uploads/2025/04/1d448b44e1669ce534a7a81d073248b2-1.jpeg" alt="Camps"
                            class="w-full h-full object-cover">
                    </figure>
                </div>
                <div class="w-full lg:w-1/2 py-[60px] lg:py-24 px-[30px] lg:px-16 flex flex-col justify-center">
                    <div class="[_&_p]:lg:text-[18px] [_&_h2]:text-[30px] [_&_h2]:lg:text-[36px]">
                        <?php echo $text ?>
                    </div>
                    <div id="form" class="mt-8">
                        <?php echo do_shortcode('[gravityform id="1" title="false" ajax="true"]')  ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>