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
    let selectedOptions = {}; // { attribute_id: { label, priceOffset } }
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
        "Purple": "#b0a5d2",
        "Titan Đen": "#464644",
        "Titan Trắng": "#f9f6ef",
        "Titan Xanh": "#2e3641",
        "Titan Tự Nhiên": "#8f8a84"
    };

    function formatPrice(amount) {
        return new Intl.NumberFormat('vi-VN').format(amount) + "đ";
    }

    function updatePrice() {
        if (!selectedProduct) return;
        
        let totalOffset = 0;
        Object.values(selectedOptions).forEach(opt => {
            totalOffset += parseFloat(opt.priceOffset || 0);
        });

        let total = parseFloat(selectedProduct.numeric_price) + totalOffset;
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
                <div class="v-price">Từ ${formatPrice(p.numeric_price)}</div>
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
        const colors = product.colors ? product.colors.split(",").map(c => c.trim()) : [];
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
            });
        });

        // Group and render dynamic options
        selectedOptions = {};
        const container = document.getElementById('dynamic-options-container');
        container.innerHTML = '';

        if (product.options && product.options.length > 0) {
            const grouped = {};
            product.options.forEach(opt => {
                const attrId = opt.attribute_id;
                const attrName = opt.attribute ? opt.attribute.name : 'Tùy chọn';
                if (!grouped[attrId]) grouped[attrId] = { name: attrName, items: [] };
                grouped[attrId].items.push(opt);
            });

            Object.entries(grouped).forEach(([attrId, group]) => {
                const groupDiv = document.createElement('div');
                groupDiv.className = 'option-section mt-5';
                groupDiv.innerHTML = `<h6 class="option-title">${group.name}.</h6>`;
                
                const grid = document.createElement('div');
                grid.className = 'spec-grid';
                grid.style.display = 'grid';
                grid.style.gridTemplateColumns = 'repeat(1, 1fr)';
                grid.style.gap = '10px';

                group.items.forEach(opt => {
                    const card = document.createElement('div');
                    card.className = 'spec-card' + (opt.is_default ? ' active' : '');
                    card.style.display = 'flex';
                    card.style.justifyContent = 'space-between';
                    card.style.padding = '15px';
                    card.style.border = '1px solid #d2d2d7';
                    card.style.borderRadius = '10px';
                    card.style.cursor = 'pointer';

                    const totalPrice = parseFloat(selectedProduct.numeric_price) + parseFloat(opt.price_offset);
                    const monthlyPrice = Math.round(totalPrice / 24);

                    card.innerHTML = `
                        <div style="text-align: left;"><strong>${opt.label}</strong></div>
                        <div style="text-align: right;">
                            <p style="text-align: right; margin: 0; font-size: 12px; line-height: 1.4;">
                                ${formatPrice(totalPrice)}<br>
                                hoặc<br>
                                ${formatPrice(monthlyPrice)}/tháng<br>
                                trong 24 tháng
                            </p>
                        </div>
                    `;

                    card.onclick = () => {
                        grid.querySelectorAll('.spec-card').forEach(c => c.classList.remove('active'));
                        card.classList.add('active');
                        selectedOptions[attrId] = { label: opt.label, priceOffset: opt.price_offset };
                        updatePrice();
                    };

                    grid.appendChild(card);
                    if (opt.is_default) {
                        selectedOptions[attrId] = { label: opt.label, priceOffset: opt.price_offset };
                    }
                });

                groupDiv.appendChild(grid);
                container.appendChild(groupDiv);

                // Default selection if none marked
                if (!selectedOptions[attrId] && group.items.length > 0) {
                    const first = group.items[0];
                    selectedOptions[attrId] = { label: first.label, priceOffset: first.price_offset };
                    grid.querySelector('.spec-card').classList.add('active');
                }
            });
        }

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
        
        let totalOffset = 0;
        let optionLabels = [];
        Object.values(selectedOptions).forEach(opt => {
            totalOffset += parseFloat(opt.priceOffset || 0);
            optionLabels.push(opt.label);
        });

        const finalPrice = parseFloat(selectedProduct.numeric_price) + totalOffset + (appleCareToggle.checked ? appleCarePrice : 0);
        const optionsText = optionLabels.join(', ');
        const activeColor = document.querySelector('.color-option.active');
        const colorName = activeColor ? activeColor.getAttribute('data-color') : 'Mặc định';

        const data = {
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            product_name: selectedProduct.name,
            price: finalPrice,
            storage: optionsText,
            color: colorName,
            applecare: appleCareToggle.checked ? '1' : '0',
            image_url: selectedProduct.image_url
        };

        fetch("/cart-add", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
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
