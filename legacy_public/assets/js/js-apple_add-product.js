document.addEventListener("DOMContentLoaded", function () {
    const imageUrlInput = document.getElementById("image_url");
    const previewContainer = document.getElementById("image-preview-container");
    const previewImage = document.getElementById("image-preview");

    function updatePreview() {
        const url = imageUrlInput.value.trim();
        if (url) {
            previewImage.src = url;
            previewContainer.style.display = "block";
            
            previewImage.onerror = function() {
                previewContainer.style.display = "none";
            };
        } else {
            previewContainer.style.display = "none";
        }
    }

    // Lắng nghe sự kiện nhập liệu
    if (imageUrlInput) {
        imageUrlInput.addEventListener("input", updatePreview);
        // Kiểm tra ngay khi tải trang (trong trường hợp sửa sản phẩm có sẵn URL)
        updatePreview();
    }
});
