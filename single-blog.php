<?php get_header(); ?>

<?php
$author_id = $post->post_author;
$author_name = get_the_author_meta('display_name', $author_id);
?>


<main id="shop">
    <section class="min-h-[360px]"
        style="background: linear-gradient(358deg, rgba(14, 55, 94, 0.50) 1.21%, rgba(11, 44, 74, 0.50) 98.39%), url('/wp-content/uploads/2025/04/7ac67b2fee68763562dbaaf5e43ec5bd.jpeg') no-repeat center center / cover;">
        <div class="block_content px-[100px] py-[100px] flex flex-col justify-center">
            <h1 class="text-[36px] text-white font-semibold tracking-tight">
                <?php the_title(); ?>
            </h1>
            <p class="my-[24px] text-[#FFFFFF99] text-[14px] font-normal leading-[30px]">
                <?php echo get_the_excerpt(); ?>
            </p>
            <p class="text-white font-inter text-[18px] font-semibold leading-[28px]">
                <?php echo $author_name ?> • <?php echo get_the_date('d M Y'); ?>
            </p>
        </div>
    </section>
    <section id="blog-background">
        <div class="block_content pt-[100px] pb-[180px] px-[60px]">
            <div class="max-w-[720px] m-auto">
                <div class="text-gray-paragrah text-[18px] leading-[28px] [_&_hr]:my-[24px]
                     [_&_ul]:my-[15px] [_&_ol]:my-[15px] [_&_ul]:list-decimal [_&_ul]:list-inside  
                     [_&_ol]:list-decimal [_&_ol]:list-inside
                   [_&_h4]:text-black [_&_h4]:text-[24px]  [_&_h4]:font-semibold  [_&_h4]:leading-[32px] [_&_h4]:my-[20px]
                   [_&_h3]:text-black [_&_h3]:text-[30px]  [_&_h3]:font-semibold  [_&_h3]:leading-[38px] [_&_h3]:my-[20px]
                   [_&_h2]:text-black [_&_h2]:text-[36px]  [_&_h2]:font-semibold  [_&_h2]:leading-[45px] [_&_h2]:my-[20px]
                     [_&_img]:rounded-[12px] [_&_img]:my-[40px]">
                    <?php the_content(); ?>
                </div>
                <div
                    class="conclution p-[32px] rounded-[32px] bg-[#FAFBFC] mt-12  text-[18px] text-gray-paragrah leading-[28px]">
                    <h3 class="text-black text-[30px]  font-semibold  leading-[38px] mb-[20px]">Conclusion</h3>
                    <?php echo get_field('conclusion'); ?>
                </div>
            </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>