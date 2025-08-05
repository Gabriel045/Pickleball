<?php
$columns = get_field('columns');
?>

<section id="three-cols" class="">
    <div class="w-full pt-16">
        <div class="flex flex-wrap lg:flex-nowrap ">
            <?php foreach ($columns as $key => $col) : ?>
                <div class="w-full lg:w-1/3 py-[60px] lg:py-[80px] px-[30px] lg:px-[60px]  !bg-cover"
                    style="background:linear-gradient(0deg,rgba(5, 5, 5, 1) 0%, rgba(39, 39, 40, 0.79) 67%, rgba(116, 116, 120, 0.46) 90%), url(<?php echo $col["image"] ?>) lightgray -17.161px 0px / 229.539% 100% no-repeat;backdrop-filter: blur(2px);">
                    <div
                        class="text-white [_&_li]:flex [_&_li]:items-center [_&_li]:mb-[20px] [_&_p]:leading-[28px]  [_&_p]:text-[16px] [_&_h3]:text-[24px] lg:[_&_h3]:text-[30px] [_&_h3]:font-semibold">
                        <?php echo $col["text"] ?></div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>