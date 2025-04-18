<?php

$background_image   = get_field('background_image');
$text               = get_field('text');
$repeater           = get_field('repeater');

?>

<section class=""
    style="background: linear-gradient(358deg, rgba(14, 55, 94, 0.50) 1.21%, rgba(11, 44, 74, 0.50) 98.39%), url(<?php echo $background_image ?>) lightgray 50% / cover no-repeat;">
    <div class="block_content max-[1024px]:px-[30px] max-[1024px]:py-[50px] lg:p-[100px]">
        <div class="max-w-[1080px] p-[30px] lg:p-[50px] rounded-[20px] bg-[#0B141D80] [_&_h2]:text-white [_&_h2]:text-[30px] lg:[_&_h2]:text-[60px] [_&_h2]:font-semibold [_&_h2]:leading-normal lg:[_&_h2]:leading-[72px]
            lg:[_&_p]:text-[20px] [_&_p]:text-[16px]  [_&_p]:text-[#FFFFFF99]">
            <?php echo $text ?>
            <a
                class="btn2 cursor-pointer text-white text-[18px] font-semibold leading-[28px] mt-[48px] w-full lg:w-fit flex px-7 py-4 justify-center items-center gap-3 rounded-lg bg-[rgba(255,255,255,0.33)] backdrop-blur-[6.65px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M9.5 8.96533C9.5 8.48805 9.5 8.24941 9.59974 8.11618C9.68666 8.00007 9.81971 7.92744 9.96438 7.9171C10.1304 7.90525 10.3311 8.03429 10.7326 8.29239L15.4532 11.3271C15.8016 11.551 15.9758 11.663 16.0359 11.8054C16.0885 11.9298 16.0885 12.0702 16.0359 12.1946C15.9758 12.337 15.8016 12.449 15.4532 12.6729L10.7326 15.7076C10.3311 15.9657 10.1304 16.0948 9.96438 16.0829C9.81971 16.0726 9.68666 15.9999 9.59974 15.8838C9.5 15.7506 9.5 15.512 9.5 15.0347V8.96533Z"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>All Videos</span>
            </a>
        </div>
    </div>
</section>

<section class="px-[30px] lg:px-[60px] py-[60px] lg:py-[80px] border-b border-[#0b14140d] ">
    <div class="block_content flex md:flex-nowrap flex-wrap justify-between gap-[32px]">
        <?php foreach ($repeater as $item) : ?>
        <article class="m-auto">
            <figure>
                <img class="w-auto lg:w-12 h-12 m-auto" src="<?php echo $item['icon'] ?>" alt="">
            </figure>
            <div
                class="mt-[15px] [_&_h4]:font-[600] [_&_h4]:text-[20px] [_&_p]:text-[16px] [_&_p]:lfont-regular [_&_p]:text-[#0B141D99]">
                <?php echo $item['text'] ?>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>