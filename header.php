<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Title Theme</title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="relative overflow-x-clip">
        <div class=" bg-black lg:px-[167px] py-[10px]">
            <p class="text-white text-[12px] font-semibold text-center">24/7 support Lorem ipsum dolor sit amet</p>
        </div>
        <div class="block_content m-auto flex justify-between w-full px-[30px] lg:px-[60px] py-[20px]">
            <div class="flex gap-10 w-2/3">
                <div class="text-berkley-blue font-bold text-[30px] tracking-[-0.6px] leading-[30px] flex items-center">
                    <a href="/">PickleballHub</a>
                </div>
                <form role="search" method="get" class="hidden lg:flex search-form  max-w-[460px] w-full relative"
                    action="<?php echo home_url('/'); ?>">
                    <input type="search"
                        class="search-field w-full border-[1px] border-[#D0D5DD] rounded-lg pl-[50px] px-[14px] py-[5px] text-[16px] text-[#667085]"
                        placeholder="Search" value="<?php echo get_search_query(); ?>" name="s">
                    <button type="submit" class="search-submit absolute top-[10px] left-3" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path
                                d="M17.5 17.5L14.5834 14.5833M16.6667 9.58333C16.6667 13.4954 13.4954 16.6667 9.58333 16.6667C5.67132 16.6667 2.5 13.4954 2.5 9.58333C2.5 5.67132 5.67132 2.5 9.58333 2.5C13.4954 2.5 16.6667 5.67132 16.6667 9.58333Z"
                                stroke="#667085" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>
            </div>
            <!-- Desktop -->
            <div class="hidden lg:flex gap-10 items-center lg:w-full lg:justify-end">
                <a href="/my-account">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                        <path
                            d="M4.38234 18.4384C4.99066 17.0052 6.41096 16 8.06604 16H14.066C15.7211 16 17.1414 17.0052 17.7497 18.4384M15.066 8.5C15.066 10.7091 13.2752 12.5 11.066 12.5C8.8569 12.5 7.06604 10.7091 7.06604 8.5C7.06604 6.29086 8.8569 4.5 11.066 4.5C13.2752 4.5 15.066 6.29086 15.066 8.5ZM21.066 11C21.066 16.5228 16.5889 21 11.066 21C5.54319 21 1.06604 16.5228 1.06604 11C1.06604 5.47715 5.54319 1 11.066 1C16.5889 1 21.066 5.47715 21.066 11Z"
                            stroke="#0B141D" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
                <a href="/cart" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <path
                            d="M4.06618 13H17.2019C18.2147 13 18.7211 13 19.1243 12.8112C19.4794 12.6448 19.7778 12.3777 19.9824 12.0432C20.2146 11.6633 20.2705 11.16 20.3823 10.1534L20.9673 4.88835C21.0015 4.58088 21.0186 4.42715 20.9691 4.30816C20.9257 4.20366 20.8481 4.11697 20.7491 4.06228C20.6363 4 20.4816 4 20.1722 4H3.56618M1.06604 1H2.31448C2.5791 1 2.71141 1 2.81493 1.05032C2.90606 1.09463 2.98158 1.16557 3.03148 1.25376C3.08816 1.35394 3.09641 1.48599 3.11292 1.7501L4.01916 16.2499C4.03567 16.514 4.04392 16.6461 4.1006 16.7462C4.1505 16.8344 4.22602 16.9054 4.31715 16.9497C4.42067 17 4.55298 17 4.8176 17H18.066M6.56604 20.5H6.57604M15.566 20.5H15.576M7.06604 20.5C7.06604 20.7761 6.84218 21 6.56604 21C6.2899 21 6.06604 20.7761 6.06604 20.5C6.06604 20.2239 6.2899 20 6.56604 20C6.84218 20 7.06604 20.2239 7.06604 20.5ZM16.066 20.5C16.066 20.7761 15.8422 21 15.566 21C15.2899 21 15.066 20.7761 15.066 20.5C15.066 20.2239 15.2899 20 15.566 20C15.8422 20 16.066 20.2239 16.066 20.5Z"
                            stroke="#0B141D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>View Cart</span>
                </a>
            </div>
            <!-- Mobile -->
            <div class="flex gap-3 items-center">
                <span class="block lg:hidden menu-text text-gray-paragrah text-opacity-60 font-semibold">Menu</span>
                <span class="z-[99] relative nline-block lg:hidden cursor-pointer menu-mobile">
                    <div class="" id="nav-icon4">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </span>
            </div>
        </div>
        <div class="hidden lg:block" style=" background: linear-gradient(0deg, #FAFBFC 0%, #FAFBFC 100%), #FFF;">
            <div class=" px-[60px]">
                <?php
                wp_nav_menu(array(
                    'menu'   => 'Header menu',
                    'menu_class' => 'menu_header flex gap-[10px] block_content m-auto',
                    'container' => false,
                ));
                ?>
            </div>
        </div>
        <?php get_template_part('template-parts/mobile-menu'); ?>
        <?php get_template_part('template-parts/slide-cart'); ?>
    </header>