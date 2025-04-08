<?php
$text_blue_section = get_field('text', 'option');
$logos = get_field('logos', 'option');
?>

<footer>
    <section
        style="background: linear-gradient(179deg, #0E375E 1.53%, #082541 98.27%), linear-gradient(358deg, #060843 1.21%, #02031B 98.39%), #060843;">
        <div class="block_content py-[80px] px-16">
            <div class="flex gap-[32px]">
                <div class="w-3/5 text-white [_&_h3]:mb-2  [_&_h3]:text-3xl [_&_h3]:font-semibold [_&_p]:text-[16px]">
                    <?php echo $text_blue_section ?>
                </div>
                <div class="w-2/5">
                    <form class="flex gap-4" action="#" method="">
                        <input
                            class="
                        rounded-lg bg-white/20 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none px-4 py-2 text-white placeholder-gray-400"
                            type="email" name="email" placeholder="Enter your email" required>
                        <button
                            class="rounded-lg border border-[#060843] bg-white shadow-sm px-4 py-2 text-[#060843] font-medium hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-rich-black">
        <div class="block_content py-[60px] px-16">
            <div class="flex">
                <div class="w-1/4 flex flex-col justify-between gap-14 mr-[65px]">
                    <h3 class="text-white text-3xl font-bold leading-[72px] tracking-[-0.6px]">PickleBallPros</h3>
                    <form class="opt-in-form">
                        <label for="email" class="form-label text-white text-[16px] font-medium mb-2 block">Opt-in to
                            our emails</label>
                        <input id="email" type="email" name="email" placeholder="Enter Email Address"
                            class="form-input w-full bg-transparent border-b border-gray-500 text-white placeholder-gray-500 focus:outline-none focus:border-white py-2 mb-4"
                            required>
                        <button type="submit"
                            class="form-button text-white font-semibold text-[16px] hover:underline focus:outline-none">
                            Subscribe
                        </button>
                    </form>
                    <div class="flex gap-[14px]">
                        <?php foreach ($logos as $key => $logo) : ?>
                        <figure>
                            <img class="w-[72px]" src="<?php echo $logo["image"] ?>">
                        </figure>
                        <?php endforeach; ?>

                    </div>

                </div>
                <div class="w-3/4 pl-[36px] border-l border-white/30 flex flex-col justify-between">
                    <div class="flex">
                        <div class="w-1/4">
                            <?php
                            wp_nav_menu(array(
                                'menu'   => 'Shop',
                                'menu_class' => 'text-white flex flex-col gap-[10px]',
                                'container' => false,
                            ));
                            ?>
                        </div>
                        <div class="w-1/4">
                            <?php
                            wp_nav_menu(array(
                                'menu'   => 'Learn',
                                'menu_class' => 'text-white flex flex-col gap-[10px]',
                                'container' => false,
                            ));
                            ?>
                        </div>
                        <div class="w-1/4">
                            <?php
                            wp_nav_menu(array(
                                'menu'   => 'Help',
                                'menu_class' => 'text-white flex flex-col gap-[10px]',
                                'container' => false,
                            ));
                            ?>
                        </div>
                        <div class="w-1/4">
                            <?php
                            wp_nav_menu(array(
                                'menu'   => 'Follow',
                                'menu_class' => 'text-white flex flex-col gap-[10px]',
                                'container' => false,
                            ));
                            ?>
                        </div>
                    </div>
                    <div>
                        <p class="text-[#D0D5DD] text-[16px] mt-14 mb-1">Copyright © 2025 PBP. All Rights Reserved.
                        </p>
                        <div class="">
                            <?php
                            wp_nav_menu(array(
                                'menu'   => 'Policiy',
                                'menu_class' => 'text-[#D0D5DD] flex gap-[28px]',
                                'container' => false,
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>

<?php wp_footer(); ?>
</body>

</html>