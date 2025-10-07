<?php
$image = get_field('image');
$text = get_field('text');
$cta = get_field('cta');
?>

<section id="text-image">
    <div class="">
        <div class="flex flex-wrap lg:flex-nowrap items-center h-full pt-16">
            <div class="w-full lg:w-1/2 lg:h-full">
                <figure class="lg:h-full">
                    <img loading="lazy" class="lg:h-full object-cover" src="<?php echo $image ?>">
                </figure>
            </div>
            <div class="w-full lg:w-1/2  py-[60px] lg:py-24 px-[30px] lg:px-16 [_&_h2]:text-[#0B141D] 
                 [_&_h2]:text-[30px] lg:[_&_h2]:text-4xl [_&_h2]:font-semibold [_&_h2]:leading-[38px] 
                [_&_h2]:tracking-[-0.72px] [_&_h2]:my-4 [_&_p]:text-gray-paragraph
                [_&_p]:text-[16px]  lg:[_&_p]:text-lg [_&_p]:font-normal [_&_p]:leading-7 [_&_li]:text-gray-paragraph
                [_&_li]:text-[16px]  lg:[_&_li]:text-lg [_&_li]:font-normal [_&_li]:leading-7 [_&_li]:mb-3">
                <?php echo $text ?>

                <?php if ($cta) : ?>
                <a href="<?php echo esc_url($cta['url']); ?>" class="btn-primary mt-[40px] lg:w-fit">
                    <?php echo esc_html($cta['title']); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>