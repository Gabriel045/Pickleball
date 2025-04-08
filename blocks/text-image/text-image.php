<?php
$image = get_field('image');
$text = get_field('text');
?>

<section id="text-image">
    <div class="block_content">
        <div class="flex items-center h-full">
            <div class="w-1/2 h-full">
                <figure class="h-full">
                    <img class="h-full object-cover" src="<?php echo $image ?>">
                </figure>
            </div>
            <div class="py-24 w-1/2 px-16 [_&_h2]:text-[#0B141D] 
                [_&_h2]:text-4xl [_&_h2]:font-semibold [_&_h2]:leading-[38px] 
                [_&_h2]:tracking-[-0.72px] [_&_h2]:my-4 [_&_p]:text-gray-paragrah
                 [_&_p]:text-lg [_&_p]:font-normal [_&_p]:leading-7 [_&_li]:text-gray-paragrah
                 [_&_li]:text-lg [_&_li]:font-normal [_&_li]:leading-7 [_&_li]:mb-3">
                <?php echo $text ?>
                <a href="/" class="btn-primary mt-[40px] w-fit">Learn More</a>
            </div>
        </div>
    </div>
</section>