<?php

/**
 * Simple alternative shortcode to get price by offer ID
 */
function cuw_get_offer_price_shortcode($atts)
{

    if (!class_exists('\CUW\App\Models\Offer')) {
        return '';
    }

    $atts = shortcode_atts([
        'offer_id' => '',
    ], $atts);

    // If offer_id is not provided, try to get it from the URL
    if (empty($atts['offer_id'])) {
        $atts['offer_id'] = isset($_GET['cuw_ppu_offer']) ? sanitize_text_field($_GET['cuw_ppu_offer']) : '';
    }

    // If still no offer_id, return empty
    if (empty($atts['offer_id'])) {
        return '';
    }

    try {
        $offer = \CUW\App\Models\Offer::get($atts['offer_id']);
        if (!$offer) {
            return '';
        }

        // Get the product ID from the offer
        $product_id = isset($offer['product']['id']) ? $offer['product']['id'] : null;

        // Save product_id as a global variable
        $GLOBALS['cuw_offer_product_id'] = $product_id;

        if (!$product_id) {
            return '';
        }

        // Get discounted price
        $discounted_price = $offer['discount'];

        // Get the WooCommerce product
        $product = wc_get_product($product_id);

        if (!$product) {
            return '';
        }

        $sale_price = $product->get_sale_price();
        $sale_price_formated = wc_price($sale_price, ['currency' => 'USD']);

        if ($discounted_price["type"] == "percentage") {
            $discounted_price_value = $sale_price * (1 - ($discounted_price["value"] / 100));
            $discounted_price_value = wc_price($discounted_price_value, ['currency' => 'USD']);
            return "<h3 class='title-price'><s>" . $sale_price_formated . "</s><span class='offer-arrow'></span><span class='text-[#13A513]'>{$discounted_price['value']}%</span> OFF = JUST <span>" . $discounted_price_value . "</span></h3>";
        } else {
            $discounted_price_value = $sale_price - $discounted_price["value"];
            $discounted_price_value = wc_price($discounted_price_value, ['currency' => 'USD']);
            $discounted_price_formated = wc_price($discounted_price["value"], ['currency' => 'USD']);

            return "<h3 class='title-price'><s>" . $sale_price_formated . "</s><span class='offer-arrow'></span><span class='text-[#13A513]'>{$discounted_price_formated}</span> OFF = JUST <span>" . $discounted_price_value . "</span></h3>";
        }
    } catch (Exception $e) {
        return '';
    }
}
add_shortcode('cuw_offer_price', 'cuw_get_offer_price_shortcode');



function cuw_ppu_new_buttons_shortcode($atts)
{
    ob_start() ?>
    <div class="new-buttons">
        <a class="add btn-primary !w-[70%]">Yes, add to my order</a>
        <a class="no-thanks w-[70%] text-center text-[16px] underline cursor-pointer">No thanks, I don't need it</a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addButtons = document.querySelectorAll('.add');
            const noThanksButtons = document.querySelectorAll('.no-thanks');

            addButtons.forEach(function(btn) {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.querySelector('.cuw-ppu-accept-button')?.click();
                });
            });

            noThanksButtons.forEach(function(btn) {
                btn.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.querySelector('.cuw-ppu-decline-button')?.click();
                });
            });
        });
    </script>

<?php
    return ob_get_clean();
}
add_shortcode('cuw_ppu_new_buttons', 'cuw_ppu_new_buttons_shortcode');


function cuw_slider_shortcode()
{
    ob_start();
    get_template_part('template-parts/review-slider');
    return ob_get_clean();
}
add_shortcode('cuw_slider', 'cuw_slider_shortcode');


function cuw_logo_shortcode($atts)
{
    ob_start();

?>

    <figure>
    <img loading="lazy" class="w-[250px] pb-5 m-auto" src="<?php echo get_field('header_logo', 'option'); ?>">
    </figure>

<?php
    return ob_get_clean();
}
add_shortcode('cuw_logo', 'cuw_logo_shortcode');


function cuw_bullet_list_shortcode()
{

    $product_id = $GLOBALS['cuw_offer_product_id'];
    $content = get_field('text_image_2', $product_id);

    ob_start(); ?>

    <div class="bullet-container">
        <?php echo $content; ?>
        <!-- <ul>
            <?php
            // foreach ($bullet_list as $key => $item) : 
            ?>
                <li class="bullet-item">
                    <span class="bullet-icon"></span>
                    <span class="bullet-text"><?php
                                                //  echo esc_html($item['items']);
                                                ?></span>
                </li>
            <?php
            //  endforeach; 
            ?> -->
        </ul>
    </div>

<?php
    return ob_get_clean();
}
add_shortcode('cuw_bullet_list', 'cuw_bullet_list_shortcode');
