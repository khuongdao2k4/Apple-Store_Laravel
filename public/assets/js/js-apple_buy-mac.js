/* --- Apple Buy Mac Interactivity --- */

document.addEventListener("DOMContentLoaded", function () {
    const modelNavItems = document.querySelectorAll(".model-nav-item");
    const variantList = document.getElementById("variant-list");
    const colorList = document.getElementById("color-list");
    const displayName = document.getElementById("display-name");
    const mainImage = document.getElementById("main-product-image");
    const totalPriceEl = document.getElementById("total-price");
    const appleCareToggle = document.getElementById("applecare-toggle");

    let currentSeries = "";
    let selectedProduct = null;
    let appleCarePrice = 3990000; // Mockup AppleCare price for Mac

    // Mapping color names to hex codes for swatches
    const colorMap = {
        "Midnight": "#2e3641",
        "Starlight": "#f0eade",
        "Space Gray": "#535150",
        "Silver": "#e3e4e5",
        "Blue": "#8497ad",
        "Green": "#adb99b",
        "Pink": "#e6d0cd",
        "Yellow": "#f6e4a2",
        "Orange": "#e9a17f",
        "Purple": "#b0a5d2"
    };

    function formatPrice(amount) {
        return new Intl.NumberFormat('vi-VN').format(amount) + "đ";
    }

    function updatePrice() {
        if (!selectedProduct) return;
        let total = selectedProduct.price;
        if (appleCareToggle.checked) {
            total += appleCarePrice;
        }
        totalPriceEl.textContent = formatPrice(total);
    }

    function renderSeries(seriesKey) {
        currentSeries = seriesKey;
        const products = groupedProducts[seriesKey];
        if (!products || products.length === 0) return;

        // Render variants
        variantList.innerHTML = products.map((p, index) => `
            <div class="variant-card ${index === 0 ? 'active' : ''}" data-id="${p.id}">
                <div class="v-name">${p.name}</div>
                <div class="v-price">Từ ${formatPrice(p.price)}</div>
            </div>
        `).join("");

        // Set initial product
        selectProduct(products[0].id);

        // Add listeners to variant cards
        document.querySelectorAll(".variant-card").forEach(card => {
            card.addEventListener("click", function() {
                document.querySelectorAll(".variant-card").forEach(c => c.classList.remove("active"));
                this.classList.add("active");
                selectProduct(this.getAttribute("data-id"));
            });
        });
    }

    function selectProduct(productId) {
        const product = Object.values(groupedProducts).flat().find(p => p.id == productId);
        if (!product) return;

        selectedProduct = product;
        displayName.textContent = product.name;
        mainImage.src = product.image_url;
        
        // Render colors for this product
        const colors = product.colors.split(",").map(c => c.trim());
        colorList.innerHTML = colors.map((color, index) => `
            <div class="color-option ${index === 0 ? 'active' : ''}" title="${color}" data-color="${color}">
                <div class="color-circle" style="background-color: ${colorMap[color] || '#ccc'}"></div>
            </div>
        `).join("");

        // Add listeners to color options
        document.querySelectorAll(".color-option").forEach(opt => {
            opt.addEventListener("click", function() {
                document.querySelectorAll(".color-option").forEach(o => o.classList.remove("active"));
                this.classList.add("active");
                // In a real app, we might update the image based on color
            });
        });

        updatePrice();
    }

    // Initialize with first series
    const firstSeries = Object.keys(groupedProducts)[0];
    if (firstSeries) {
        renderSeries(firstSeries);
    }

    // Top Nav Click
    modelNavItems.forEach(item => {
        item.addEventListener("click", function() {
            modelNavItems.forEach(i => i.classList.remove("active"));
            this.classList.add("active");
            renderSeries(this.getAttribute("data-series"));
        });
    });

    // AppleCare Toggle
    appleCareToggle.addEventListener("change", updatePrice);

    // Add to Bag
    document.getElementById("add-to-bag").addEventListener("click", function() {
        if (!selectedProduct) return;
        
        const formData = new FormData();
        formData.append("product_id", selectedProduct.id);
        formData.append("quantity", 1);
        formData.append("applecare", appleCareToggle.checked ? 1 : 0);
        formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        fetch("/cart-add", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = "/bag";
            } else {
                alert(data.message || "Lỗi khi thêm vào giỏ hàng.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Lỗi kết nối máy chủ.");
        });
    });
});
