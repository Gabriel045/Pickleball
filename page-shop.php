<?php get_header(); ?>

<?php
$categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
));

// echo "<pre>";
// var_dump($categories);
// echo "</pre>";
?>


<main id="shop">
    <section
        style="background: linear-gradient(358deg, #0E375E 1.21%, #0B2C4A 98.39%), linear-gradient(180deg, #060843 0%, #02031B 100%)">
        <div class="block_content px-[100px] py-[64px]">
            <h1 class="text-[36px] text-white font-semibold tracking-tight ">All Videos</h1>
        </div>
    </section>
    <section>
        <div class="block_content">
            <div class="flex">
                <div class="w-1/4 bg-[#FAFBFC] py-[100px] px-[50px]">
                    <p class="text-caribbean-green  font-semibold mb-5">Categories</p>
                    <ul id="video-categories">
                        <?php foreach ($categories as $key => $cat) {
                            echo '<li class="py-[10px]"><a value="' . $cat->slug . '" class="cursor-pointer text-gray-paragrah font-semibold">' . $cat->name . '</a></li>';
                        } ?>
                    </ul>
                </div>
                <div class="w-3/4 py-[100px] px-[60px]">
                    <form id="search-videos" class="relative flex gap-4">
                        <input type="text"
                            class="w-full border border-[#D0D5DD] rounded-[8px] px-3 py-3 text-gray-paragrah"
                            placeholder="Search">
                        <button type="submit"
                            class="flex items-center gap-2 bg-[#0E375E] rounded-[8px] px-[18px] py-[10px] text-white font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18"
                                fill="none">
                                <path
                                    d="M16 16.5L13.0834 13.5833M15.1667 8.58333C15.1667 12.4954 11.9954 15.6667 8.08333 15.6667C4.17132 15.6667 1 12.4954 1 8.58333C1 4.67132 4.17132 1.5 8.08333 1.5C11.9954 1.5 15.1667 4.67132 15.1667 8.58333Z"
                                    stroke="white" stroke-width="1.66667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Search
                        </button>
                    </form>
                    <div class="mt-20">
                        <div id="videos-container" class="flex flex-wrap gap-[2%] gap-y-[80px]"></div>
                        <!-- print videos -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    function fetchAndDisplayVideos(searchQuery = '', categoryValue = 'all') {
        fetch('/wp-json/custom/v2/get_videos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    search: searchQuery,
                    category: categoryValue
                }),
            })
            .then(response => response.json())
            .then(data => {
                const container = document.querySelector('#videos-container');
                container.innerHTML = ''; // Clear previous results
                data.forEach(element => {
                    print_products(element);
                });

                // console.log('Response from server:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Fetch videos on page load
    document.addEventListener('DOMContentLoaded', function() {
        fetchAndDisplayVideos();
        // Adds an item to the side cart. located on /resources/js/main.js
        const observer = new MutationObserver((mutationsList, observer) => {
            const container = document.querySelector('#videos-container');
            if (container.children.length > 0) {
                addToSideCart();
                observer.disconnect(); // Stop observing once the condition is met
            }
        });

        const container = document.querySelector('#videos-container');
        observer.observe(container, {
            childList: true
        });

    });

    // Fetch videos when the form is submitted
    const form = document.querySelector('#search-videos')
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const searchInput = form.querySelector('#search-videos input[type="text"]');
        fetchAndDisplayVideos(searchInput.value);
        // Adds an item to the side cart. located on /resources/js/main.js
        const observer = new MutationObserver((mutationsList, observer) => {
            const container = document.querySelector('#videos-container');
            if (container.children.length > 0) {
                addToSideCart();
                observer.disconnect(); // Stop observing once the condition is met
            }
        });

        const container = document.querySelector('#videos-container');
        observer.observe(container, {
            childList: true
        });

    });


    const categories = document.querySelectorAll('#video-categories li a');
    categories.forEach(category => {
        category.addEventListener('click', function() {
            const categoryValue = this.getAttribute('value');
            fetchAndDisplayVideos('', categoryValue);
            // Adds an item to the side cart. located on /resources/js/main.js
            const observer = new MutationObserver((mutationsList, observer) => {
                const container = document.querySelector('#videos-container');
                if (container.children.length > 0) {
                    addToSideCart();
                    observer.disconnect(); // Stop observing once the condition is met
                }
            });

            const container = document.querySelector('#videos-container');
            observer.observe(container, {
                childList: true
            });

        });
    });


    // Function to print products
    function print_products(data) {
        const container = document.querySelector('#videos-container');
        const article = document.createElement('article');
        article.classList.add('w-[23.5%]');
        article.innerHTML = `
                <figure>
                    <a href="${data.link}">
                        <img class="rounded-xl" src="${data.thumbnail}" alt="">
                    </a>
                </figure>
                <div class="mt-[24px]">
                    <div class="flex items-center gap-[10px]">
                        <span class="stars"></span>
                        <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59 Reviews)</span>
                    </div>
                    <p class="text-rich-black text-[20px] font-semibold leading-normal">
                        <a href="${data.link}" class="text-rich-black hover:underline">
                            ${data.title}
                        </a>
                    </p>
                    <p class="text-gray-paragrah text-[16px] leading-normal">
                        ${data.description}
                    </p>
                    <div class="my-[15px] flex items-center">
                        <span class="mr-4 text-[#8498AB] text-[18px] line-through">$${data.price}</span>
                        <span class="text-[#13A513] text-[28px] font-semibold leading-[32px]">$${data.price}</span>
                    </div>
                    <div class="woocommerce-variation-add-to-cart variations_button">
                        <button type="submit" class="custom_add_to_cart btn !w-full single_add_to_cart_button button">+ Add to Cart</button>
                        <input type="hidden" name="add-to-cart" value="${data.id}" />
                        <input type="hidden" name="product_id" value="${data.id}" />
                        <input type="hidden" name="variation_id" class="variation_id" value="0" />
                    </div>
                </div>
            `;
        container.appendChild(article);

    }
</script>


<?php get_footer(); ?>