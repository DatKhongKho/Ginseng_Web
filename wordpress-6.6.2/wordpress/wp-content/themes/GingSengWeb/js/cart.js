jQuery(document).ready(function ($) {
  $(".btn-add-to-cart").on("click", function (e) {
    e.preventDefault();
    var productId = $(this).data("product-id");

    $.ajax({
      url: woocommerce_params.ajax_url,
      type: "POST",
      data: {
        action: "add_to_cart",
        product_id: productId,
      },
      success: function (response) {
        if (response.success) {
          // Gọi hàm cập nhật số lượng sản phẩm trong giỏ hàng
          updateCartCount();
        } else {
          console.error("Failed to add product to cart.");
        }
      },
      error: function (error) {
        console.error("AJAX Error:", error);
      },
    });
  });

  function updateCartCount() {
    $.ajax({
      url: woocommerce_params.ajax_url,
      type: "POST",
      data: {
        action: "get_cart_count",
      },
      success: function (response) {
        if (response.success) {
          // Thay đổi nội dung hiển thị số lượng sản phẩm
          $("#cart-count").text(response.data.cart_count);
        }
      },
      error: function (error) {
        console.error("Cart Count AJAX Error:", error);
      },
    });
  }
});
