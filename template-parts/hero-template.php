<?php
/*
Template Name: Hero Template
*/
get_header();
?>

<main>
    <section class="bg-black">
        <div class="block_content px-[60px] lg:px-[100px] py-[64px]">
            <h1 class="text-[36px] text-white font-semibold tracking-tight"> <?php the_title(); ?></h1>
        </div>
    </section>

    <?php if (is_page('faq')) {
        the_content();
    } else { ?>
        <section>
            <div class="block_content py-[30px] px-[30px] lg:px-[90px]">
                <div class="text-gray-paragraph text-[16px] lg:text-[18px] leading-[28px] [_&_hr]:my-[24px]
                        [_&_ul]:my-[15px] [_&_ol]:my-[15px] [_&_ul]:list-decimal [_&_ul]:list-inside  
                        [_&_ol]:list-decimal [_&_ol]:list-inside
                    [_&_h4]:text-black [_&_h4]:text-[24px]  [_&_h4]:font-semibold  [_&_h4]:leading-[32px] [_&_h4]:my-[20px]
                    [_&_h3]:text-black [_&_h3]:text-[30px]  [_&_h3]:font-semibold  [_&_h3]:leading-[38px] [_&_h3]:my-[20px]
                    [_&_h2]:text-black [_&_h2]:text-[36px]  [_&_h2]:font-semibold  [_&_h2]:leading-[45px] [_&_h2]:my-[20px]
                        [_&_img]:rounded-[12px] [_&_img]:my-[40px]">
                    <?php the_content() ?>
                </div>
            </div>
        </section>
    <?php } ?>
</main>

<?php get_footer(); ?>