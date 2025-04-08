
// Thay đổi ảnh 
function changeImage(imgElement) {
    let mainImage = document.getElementById("mainImage");
    mainImage.src = imgElement.src;
}
 
// Thay đổi số lượng
function changeQuantity(change) {
    let quantityInput = document.getElementById('quantityInput');
    let currentQuantity = parseInt(quantityInput.value);

    let newQuantity = currentQuantity + change;
    if (newQuantity < 1) newQuantity = 1;

    // Cập nhật lại giá trị của input
    quantityInput.value = newQuantity;
    document.getElementById('quantityInputValue').value = newQuantity; // Cập nhật giá trị cho input hidden
}


// Kiểm tra giá trị nhập vào
function validateQuantity() {
    let quantityInput = document.getElementById('quantityInput');
    let currentQuantity = parseInt(quantityInput.value);

    if (isNaN(currentQuantity) || currentQuantity < 1) {
        quantityInput.value = 1;
    }

    document.getElementById('quantityInputValue').value = quantityInput.value; // Cập nhật giá trị cho input hidden
}

