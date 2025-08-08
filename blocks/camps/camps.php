<?php

$image   = get_field('image');
$text    = get_field('text');
$product_id = $_GET['id'] ?? null;

?>

<main>
    <section>
        <div class="block_content">
            <div class="flex flex-wrap lg:flex-nowrap">
                <div class="w-full lg:w-1/2">
                    <figure class="h-full">
                        <?php if (!empty($product_id)): ?>
                        <?php
                            $thumbnail_id = get_post_thumbnail_id($product_id);
                            if ($thumbnail_id) {
                                $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
                                echo '<img src="' . esc_url($thumbnail_url) . '" alt="Product Thumbnail" class="w-full h-auto object-cover">';
                            } ?>
                        <?php else: ?>
                        <img src="<?php echo esc_url($image); ?>" alt="Camps" class="w-full lg:h-full object-cover">
                        <?php endif; ?>
                    </figure>
                </div>
                <div class="w-full lg:w-1/2 py-[60px] lg:py-24 px-[30px] lg:px-16 flex flex-col">
                    <div class="[_&_p]:lg:text-[18px] [_&_h2]:text-[30px] [_&_h2]:lg:text-[36px]">
                        <?php if (!empty($product_id)): ?>
                        <h2 class="font-bold"><?php echo get_the_title($product_id); ?></h2>
                        <div class="flex items-center gap-[10px] my-4">
                            <span class="stars"></span>
                            <span class="text-[14px] text[rgba(71,84,103,0.60)] font-medium leading-[24px]">
                                5.0 based on 543 reviews
                            </span>
                        </div>
                        <?php else:
                            echo $text ?>
                        <?php endif; ?>
                    </div>
                    <div id="form" class="mt-8">
                        <?php if (is_page('camps')): ?>
                        <?php echo do_shortcode('[gravityform id="1" title="false" ajax="true"]')  ?>
                        <?php elseif (is_page('support')): ?>
                        <?php echo do_shortcode('[gravityform id="3" title="false" ajax="true"]')  ?>
                        <?php elseif (is_page('coming-soon')): ?>
                        <?php echo do_shortcode('[gravityform id="4" title="false" ajax="true"]')  ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>