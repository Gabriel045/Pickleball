// This script handles the functionality of adding a product to the side cart
// when the "Add to Cart" button is clicked. It uses jQuery to send an AJAX
// request to the WooCommerce server and updates the UI accordingly.
function addToSideCart() {
  "use strict";
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
      url: wc_add_to_cart_params.wc_ajax_url
        .toString()
        .replace("%%endpoint%%", "add_to_cart"),
      type: "POST",
      data: data,
      success: function (response) {
        if (!response) {
          console.log("No response from server");
          return;
        }
        if (response.error) {
          console.log(response);
          jQuery(".custom_add_to_cart").text("+ Add to Cart");
          return;
        }
        if (response) {
          console.log("product added to cart");
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
});
