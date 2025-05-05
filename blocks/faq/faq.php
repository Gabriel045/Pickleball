<?php

$title    = get_field('title');
$faqs = !empty(get_field('faqs')) ? get_field('faqs') : $args['faqs'];

?>

<section id="faq">
    <div class="block_content py-[60px] lg:py-[100px] px-[30px] lg:px-[300px]">
        <h2 class="text-rich-black text-[20px] lg:text-[24px] font-semibold text-center">
            <?php echo !empty($title) ? $title : 'Frequently Asked Questions' ?></h2>
        <div class="pt-8 flex flex-col gap-6">
            <?php foreach ($faqs as $key => $card) : ?>
                <details class="pb-8 border-b border-[#E0E0E0] ">
                    <summary class="text-[18px] text-rich-black font-medium cursor-pointer"><?php echo $card["title"] ?>
                    </summary>
                    <div class="text-gray-paragrah mt-2"><?php echo $card["content"] ?></div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>