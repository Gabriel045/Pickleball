// This script handles the functionality of adding a product to the side cart
// when the "Add to Cart" button is clicked. It uses jQuery to send an AJAX
// request to the WooCommerce server and updates the UI accordingly.
function addToSideCart() {
  "use strict";
  comingSoon();

  jQuery(".custom_add_to_cart").click(function (e) {
    e.preventDefault();
    var id = jQuery(this).next().next().attr("value");
    // Data to be sent to the server
    var data = {
      quantity: 1,
      product_id: id,
    };
    jQuery(this).text("Loading...");
    jQuery.ajax({
      url: wc_add_to_cart_params.wc_ajax_url.toString().replace("%%endpoint%%", "add_to_cart"),
      type: "POST",
      data: data,
      success: function (response) {
        if (!response) {
          console.log("No response from server");
          return;
        }
        if (response.error) {
          console.log(response);
          jQuery(".custom_add_to_cart")
            .filter(function () {
              return jQuery(this).text() === "Loading...";
            })
            .text("You can't add this product");
          return;
        }
        if (response) {
          console.log("product added to cart form main.js");
          console.log(response);
          const itemsContainer = document.querySelector("#items-container");
          itemsContainer.innerHTML = ""; // Clear existing items
          itemsContainer.insertAdjacentHTML("beforeend", response.fragments["div.widget_shopping_cart_content"]);

          jQuery("#slide-cart").addClass("active");
          jQuery(".custom_add_to_cart").text("+ Add to Cart");
        }
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
        console.error("Status:", status);
        console.error("Response:", xhr.responseText);
      },
    });
  });
}

jQuery(document).ready(function () {
  addToSideCart();

  document.querySelector("#nav-icon4").addEventListener("click", function () {
    this.classList.toggle("open");
    document.querySelector("#mobile-side-menu").classList.toggle("active");
    if (this.classList.contains("open")) {
      document.querySelector(".menu-text").innerHTML = "Close";
      document.body.style.overflow = "hidden";
    } else {
      document.querySelector(".menu-text").innerHTML = "Menu";
      document.body.style.overflow = "auto";
    }
  });
});

document.querySelector("#close").addEventListener("click", function () {
  document.querySelector("#slide-cart").classList.remove("active");
});

function comingSoon() {
  const articles = document.querySelectorAll("article[data-coming-soon='true']");
  articles.forEach((article) => {
    const id = article.getAttribute("data-id");
    const comingSoonText = document.createElement("div");
    comingSoonText.className = "coming-soon-container";
    comingSoonText.innerHTML = "<h3>Coming Soon</h3>";

    const anchor = article.querySelectorAll("a");
    anchor.forEach((a) => {
      a.setAttribute("href", "/coming-soon?id=" + id);
    });

    const button = article.querySelectorAll(".custom_add_to_cart");
    button.forEach((btn) => {
      btn.textContent = "Join the Waitlist";
    });

    const variationForm = article.querySelector(".woocommerce-variation-add-to-cart");
    if (variationForm) {
      variationForm.remove();
    }

    if (button) {
      // Create Link
      const link = document.createElement("a");
      link.href = "/coming-soon?id=" + id;
      link.classList.add("btn");
      link.classList.add("btn-waitlist");
      link.textContent = "Join the Waitlist";
      // Replace the button with the link
      if (window.location.pathname === "/checkout/" || article.id === "more-products-side-cart") {
        console.log(article.querySelector(".flex-col.justify-center"));
        article.querySelector(".flex-col.justify-center").appendChild(link);
      } else {
        article.appendChild(link);
      }
    }

    article.querySelector("figure").appendChild(comingSoonText);

    // hide price
    const prices = article.querySelectorAll(".price span");
    prices.forEach((price) => {
      price.style.color = "transparent";
    });
  });
}

window.onload = function () {
  if (window.location.href.includes("cuw_wp_template")) {
    document.querySelector("header").style.display = "none";
    document.querySelector("footer").style.display = "none";
  }
};
