function fetchAndDisplayVideos(searchQuery = "", categoryValue = "all") {
  fetch("/wp-json/custom/v2/get_videos", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      search: searchQuery,
      category: categoryValue,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      const container = document.querySelector("#videos-container");
      container.innerHTML = ""; // Clear previous results
      data.forEach((element) => {
        print_products(element);
      });

      // console.log('Response from server:', data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Fetch videos on page load
document.addEventListener("DOMContentLoaded", function () {
  fetchAndDisplayVideos();
  // Adds an item to the side cart. located on /resources/js/main.js
  const observer = new MutationObserver((mutationsList, observer) => {
    const container = document.querySelector("#videos-container");
    if (container.children.length > 0) {
      addToSideCart();
      observer.disconnect(); // Stop observing once the condition is met
    }
  });

  const container = document.querySelector("#videos-container");
  observer.observe(container, {
    childList: true,
  });

  // Add event listener for opening and closing a modal or dropdown
  const openCloseButton = document.querySelector("#open-close");
  if (openCloseButton) {
    openCloseButton.addEventListener("click", function () {
      openCloseButton.classList.toggle("active");
      document.querySelector("#video-categories").classList.toggle("hidde");
    });
  }
});

// Fetch videos when the form is submitted
const form = document.querySelector(".search-videos");
form.addEventListener("submit", function (event) {
  event.preventDefault();
  const searchInput = form.querySelector('.search-videos input[type="text"]');
  fetchAndDisplayVideos(searchInput.value);
  // Adds an item to the side cart. located on /resources/js/main.js
  const observer = new MutationObserver((mutationsList, observer) => {
    const container = document.querySelector("#videos-container");
    if (container.children.length > 0) {
      addToSideCart();
      observer.disconnect(); // Stop observing once the condition is met
    }
  });

  const container = document.querySelector("#videos-container");
  observer.observe(container, {
    childList: true,
  });
});

const categories = document.querySelectorAll("#video-categories li a");
categories.forEach((category) => {
  category.addEventListener("click", function () {
    const categoryValue = this.getAttribute("value");
    fetchAndDisplayVideos("", categoryValue);
    // Adds an item to the side cart. located on /resources/js/main.js
    const observer = new MutationObserver((mutationsList, observer) => {
      const container = document.querySelector("#videos-container");
      if (container.children.length > 0) {
        addToSideCart();
        observer.disconnect(); // Stop observing once the condition is met
      }
    });

    const container = document.querySelector("#videos-container");
    observer.observe(container, {
      childList: true,
    });
  });
});

// Function to print products
function print_products(data) {
  const container = document.querySelector("#videos-container");
  const article = document.createElement("article");
  article.classList.add("w-full", "xl:w-[23.5%]", "lg:w-[49%]");
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
                <p class="text-rich-black text-[20px] font-semibold my-2 leading-[20px]">
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
