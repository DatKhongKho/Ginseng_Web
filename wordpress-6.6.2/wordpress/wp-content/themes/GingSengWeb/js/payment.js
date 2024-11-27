function showMoMoQRCode() {
  // Giả sử API MoMo trả về QR Code URL
  var momoQRCodeURL = "https://yourserver.com/get_momo_qr?order_id=" + orderID;

  // Hiển thị QR Code
  document.getElementById("momo-qrcode").style.display = "block";
  document.getElementById("momo-qr").src = momoQRCodeURL;
}
