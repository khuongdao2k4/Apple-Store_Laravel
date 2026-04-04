document.addEventListener("DOMContentLoaded", function () {
    const imageUrlInput = document.getElementById("image_url");
    const previewContainer = document.getElementById("image-preview-container");
    const previewImage = document.getElementById("image-preview");

    function updatePreview() {
        if (!imageUrlInput) return;
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

    if (imageUrlInput) {
        imageUrlInput.addEventListener("input", updatePreview);
        updatePreview();
    }
});
