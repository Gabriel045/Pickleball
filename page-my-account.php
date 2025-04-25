<?php get_header() ?>

<main id="my-account">
    <section
        style="background: linear-gradient(358deg, #0E375E 1.21%, #0B2C4A 98.39%), linear-gradient(180deg, #060843 0%, #02031B 100%)">
        <div class="block_content px-[60px] lg:px-[100px] py-[64px]">
            <h1 class="text-[30px] lg:text-[36px] text-white font-semibold tracking-tight ">Account Dashboard</h1>
        </div>
    </section>
    <section>
        <div class="block_content">
            <?php the_content() ?>
        </div>
    </section>
</main>


<?php get_footer() ?>