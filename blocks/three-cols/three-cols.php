<?php
$columns = get_field('columns');
?>

<section id="three-cols" class="">
    <div class="w-full">
        <div class="flex flex-wrap lg:flex-nowrap ">
            <?php foreach ($columns as $key => $col) : ?>
                <div class="w-full lg:w-1/3 py-[60px] lg:py-[80px] px-[30px] lg:px-[60px]  !bg-cover"
                    style="background: linear-gradient(91deg, rgba(6, 46, 45, 0.74) 0.69%, rgba(12, 94, 93, 0.74) 99.32%), url(<?php echo $col["image"] ?>) lightgray -17.161px 0px / 229.539% 100% no-repeat;backdrop-filter: blur(2px);">
                    <div
                        class="text-white [_&_li]:flex [_&_li]:items-center [_&_li]:mb-[20px] [_&_p]:leading-[28px]  [_&_p]:text-[16px] [_&_h3]:text-[24px] lg:[_&_h3]:text-[30px] [_&_h3]:font-semibold">
                        <?php echo $col["text"] ?></div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>