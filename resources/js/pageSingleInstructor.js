function fetchAndDisplayVideos(searchQuery = "", categoryValue = "all", id = "") {
  fetch("/wp-json/custom/v2/get_single_instructor_videos", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      search: searchQuery,
      category: categoryValue,
      id: id,
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
  const id = document.querySelector(".search-videos input[type='hidden']").value;

  fetchAndDisplayVideos("", "all", id);
  const observer = new MutationObserver((mutationsList, observer) => {
    const container = document.querySelector("#videos-container");
    if (container.children.length > 0) {
      // Adds an item to the side cart. located on /resources/js/main.js
      addToSideCart();
      observer.disconnect(); // Stop observing once the condition is met
    }
  });

  const container = document.querySelector("#videos-container");
  observer.observe(container, {
    childList: true,
  });

  // Add event listener for opening and closing a modal or dropdown
  // const openCloseButton = document.querySelector("#open-close");
  // if (openCloseButton) {
  //   openCloseButton.addEventListener("click", function () {
  //     openCloseButton.classList.toggle("active");
  //     document.querySelector("#video-categories").classList.toggle("hidde");
  //   });
  // }
});

// Fetch videos when the form is submitted
const form = document.querySelector(".search-videos");
form.addEventListener("submit", function (event) {
  event.preventDefault();
  const searchInput = form.querySelector('.search-videos input[type="text"]');
  const id = document.querySelector(".search-videos input[type='hidden']").value;
  fetchAndDisplayVideos(searchInput.value, "all", id);
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

const categorySelect = document.querySelector("#video-categories");
if (categorySelect) {
  categorySelect.addEventListener("change", function () {
    const categoryValue = this.value;
    const id = document.querySelector(".search-videos input[type='hidden']").value;
    fetchAndDisplayVideos("", categoryValue, id);
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
}

// Function to print products
function print_products(data) {
  const container = document.querySelector("#videos-container");
  const article = document.createElement("article");
  article.classList.add("xl:w-[23.5%]", "md:w-[32%]", "w-[49%]", "flex", "flex-col", "gap-[10px]", "justify-between");
  article.innerHTML = `
      <figure>
          <a href="${data.link}">
              <img class="rounded-xl aspect-[0.8] object-cover" src="${data.thumbnail}" alt="">
          </a>
      </figure>
          <div class="flex items-center gap-[10px] flex-wrap ">
              <span class="stars"></span>
              <span class="text-[14px] text-[rgba(71,84,103,0.60)] font-medium leading-[24px]">5.0 (59 Reviews)</span>
          </div>
          <h3 class="text-rich-black text-[16px] lg:text-[20px] font-semibold leading-[20px]">
              <a href="${data.link}" class="text-rich-black hover:underline">
                  ${data.title}
              </a>
          </h3>
          <p class="text-gray-paragrah text-[14px] lg:text-[18px] leading-[20px]">
              ${data.description}
          </p>
          <div class="flex items-center">
              <span class="mr-2 lg:mr-4 text-[#8498AB] text-[18px] line-through">${data.regular_price}</span>
              <span class="text-[#13A513] text-[22px] lg:text-[28px] font-semibold leading-[32px]">${data.sale_price}</span>
          </div>
          <div class="woocommerce-variation-add-to-cart variations_button">
              <button type="submit" class="custom_add_to_cart btn !w-full single_add_to_cart_button button">+ Add to Cart</button>
              <input type="hidden" name="add-to-cart" value="${data.id}" />
              <input type="hidden" name="product_id" value="${data.id}" />
              <input type="hidden" name="variation_id" class="variation_id" value="0" />
          </div>`;
  container.appendChild(article);
}
