document.addEventListener("DOMContentLoaded", function () {
    console.log("Script đã tải thành công!"); // Kiểm tra script đã chạy

    let menuItems = document.querySelectorAll(".toggle-menu");

    menuItems.forEach(item => {
        let icon = document.createElement("i");
        icon.classList.add("fas", "fa-chevron-right", "menu-arrow");
        item.appendChild(icon);

        item.addEventListener("click", function (e) {
            e.preventDefault(); // Ngăn load lại trang

            let submenu = this.nextElementSibling; // Lấy menu con kế tiếp
            let arrow = this.querySelector(".menu-arrow");

            let isActive = submenu.classList.contains("show");
            document.querySelectorAll(".submenu").forEach(sub => sub.classList.remove("show"));
            document.querySelectorAll(".menu-arrow").forEach(arw => arw.classList.remove("fa-chevron-down"));
            document.querySelectorAll(".menu-arrow").forEach(arw => arw.classList.add("fa-chevron-right"));

            if (!isActive) {
                submenu.classList.add("show"); // Hiển thị menu con
                arrow.classList.add("fa-chevron-down");
                arrow.classList.remove("fa-chevron-right");
            }
        });
    });

    document.addEventListener("click", function (e) {
        if (!e.target.closest(".toggle-menu") && !e.target.closest(".submenu")) {
            document.querySelectorAll(".submenu").forEach(sub => sub.classList.remove("show"));
            document.querySelectorAll(".menu-arrow").forEach(arw => arw.classList.remove("fa-chevron-down"));
            document.querySelectorAll(".menu-arrow").forEach(arw => arw.classList.add("fa-chevron-right"));
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Preview ảnh đại diện
    const avatarUpload = document.getElementById("avatar-upload");
    const avatarPreview = document.getElementById("avatar-preview");
    if (avatarUpload && avatarPreview) {
        avatarUpload.addEventListener("change", function () {
            avatarPreview.innerHTML = ''; // Xóa preview cũ
            const file = this.files[0];
            if (file) {
                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                img.style.maxWidth = "100%";
                img.style.height = "auto";
                avatarPreview.appendChild(img);
            }
        });
    }

    // Preview ảnh sản phẩm
    const productUpload = document.getElementById("product-upload");
    const productPreview = document.getElementById("product-preview");
    if (productUpload && productPreview) {
        productUpload.addEventListener("change", function () {
            productPreview.innerHTML = ''; // Xóa preview cũ
            Array.from(this.files).forEach(file => {
                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                img.style.maxWidth = "100px"; // Kích thước nhỏ cho nhiều ảnh
                img.style.margin = "5px";
                productPreview.appendChild(img);
            });
        });
    }
});