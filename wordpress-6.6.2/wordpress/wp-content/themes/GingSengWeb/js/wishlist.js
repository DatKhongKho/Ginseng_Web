jQuery(document).ready(function ($) {
  // Đảm bảo rằng các sản phẩm có class 'add-to-wishlist'
  $(".add-to-wishlist").on("click", function () {
    var product_id = $(this).data("product-id"); // Lấy ID sản phẩm từ data attribute

    $.ajax({
      url: ajaxurl, // WordPress AJAX URL
      method: "POST",
      data: {
        action: "add_to_wishlist", // Tên action sẽ được xử lý trong PHP
        product_id: product_id,
      },
      success: function (response) {
        if (response.success) {
          alert(response.data.message); // Hiển thị thông báo thành công
        } else {
          alert(response.data.message); // Hiển thị thông báo lỗi
          if (response.data.redirect_to) {
            window.location.href = response.data.redirect_to; // Điều hướng đến trang đăng nhập nếu chưa đăng nhập
          }
        }
      },
    });
  });
});
jQuery(document).ready(function ($) {
  // Xử lý sự kiện thêm sản phẩm vào danh sách yêu thích
  $(".add-to-wishlist").on("click", function () {
    var product_id = $(this).data("product-id");

    $.ajax({
      url: ajaxurl,
      method: "POST",
      data: {
        action: "add_to_wishlist",
        product_id: product_id,
      },
      success: function (response) {
        if (response.success) {
          alert(response.data.message);
        } else {
          alert(response.data.message);
          if (response.data.redirect_to) {
            window.location.href = response.data.redirect_to;
          }
        }
      },
    });
  });

  // Xử lý sự kiện xóa sản phẩm khỏi danh sách yêu thích
  $(".remove-from-wishlist").on("click", function () {
    var product_id = $(this).data("product-id");

    $.ajax({
      url: ajaxurl,
      method: "POST",
      data: {
        action: "remove_from_wishlist", // Gọi action xử lý xóa
        product_id: product_id,
      },
      success: function (response) {
        if (response.success) {
          // Cập nhật giao diện sau khi xóa thành công
          productElement.fadeOut(); // Ẩn phần tử sản phẩm
          alert("Sản phẩm đã được xóa khỏi danh sách yêu thích.");
        } else {
          alert(response.data.message);
        }
      },
    });
  });
});
