document.addEventListener("DOMContentLoaded", function () {
    // Function to handle card selection
    function selectCard(cards, selectedClass) {
        cards.forEach(card => {
            card.addEventListener("click", function () {
                cards.forEach(c => c.classList.remove(selectedClass));
                this.classList.add(selectedClass);
                
                // Update total price whenever a card is selected
                updatePrice();
                
                // Update buy button state
                updateBuyButtonState();
            });
        });
    }

    // Initialize selections
    selectCard(document.querySelectorAll(".model-card"), "selected");
    selectCard(document.querySelectorAll(".storage-card"), "selected");
    selectCard(document.querySelectorAll(".color-circle"), "selected");
    selectCard(document.querySelectorAll(".trade-card"), "selected");
    selectCard(document.querySelectorAll(".payment-card"), "selected");

    function updatePrice() {
        const selectedModel = document.querySelector(".model-card.selected");
        const selectedStorage = document.querySelector(".storage-card.selected");
        const mainPriceDisplay = document.getElementById("main-price-display");
        const buyButton = document.querySelector(".buy-button");

        if (selectedModel && selectedStorage) {
            const basePrice = parseFloat(selectedModel.getAttribute("data-price"));
            const offset = parseFloat(selectedStorage.getAttribute("data-price-offset"));
            const total = basePrice + offset;
            
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
            });

            const formattedTotal = formatter.format(total);
            const monthly = formatter.format(total / 24);

            // Update main display
            if (mainPriceDisplay) {
                mainPriceDisplay.innerText = `Total ${formattedTotal} or ${monthly}/mo. for 24 mo.*`;
            }

            // Update Buy button text
            if (buyButton) {
                buyButton.innerText = `Mua - ${formattedTotal}`;
            }
        }
    }

    // Handle Add to Bag Button Click
    const addToBagButton = document.querySelector(".add-to-bag-button");
    if (addToBagButton) {
        addToBagButton.addEventListener("click", async function () {
            let selectedModel = document.querySelector(".model-card.selected");
            let selectedStorage = document.querySelector(".storage-card.selected");
            let selectedColor = document.querySelector(".color-circle.selected");

            if (!selectedModel || !selectedStorage || !selectedColor) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Thông tin chưa đầy đủ',
                    text: 'Vui lòng chọn đầy đủ Model, Dung lượng và Màu sắc.'
                });
                return;
            }

            // Extract calculated price
            const basePrice = parseFloat(selectedModel.getAttribute("data-price"));
            const offset = parseFloat(selectedStorage.getAttribute("data-price-offset"));
            const total = basePrice + offset;
            
            const payload = {
                product_name: selectedModel.querySelector("strong").innerText,
                price: "$" + total,
                storage: selectedStorage.querySelector("strong").innerText,
                color: selectedColor.style.backgroundColor,
                image_url: document.querySelector(".rf-bfe-column-left img").src
            };

            // Assuming user is logged in (otherwise controller handles it)

            try {
                const response = await fetch('/cart-add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(payload)
                });

                if (response.status === 401) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Yêu cầu đăng nhập',
                        text: 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.',
                        showCancelButton: true,
                        confirmButtonText: 'Đăng nhập ngay',
                        cancelButtonText: 'Để sau'
                    }).then((result) => {
                        if (result.isConfirmed) window.location.href = '/login';
                    });
                    return;
                }

                const result = await response.json();
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã thêm vào túi hàng!',
                        text: result.message,
                        showCancelButton: true,
                        confirmButtonText: 'Xem giỏ hàng',
                        cancelButtonText: 'Tiếp tục mua sắm',
                        confirmButtonColor: '#0071e3'
                    }).then((res) => {
                        if (res.isConfirmed) window.location.href = '/bag';
                    });
                }
            } catch (error) {
                console.error("Error adding to cart:", error);
            }
        });
    }

    function updateBuyButtonState() {
        const buyButton = document.querySelector(".buy-button");
        const addToBagButton = document.querySelector(".add-to-bag-button");
        let selectedModel = document.querySelector(".model-card.selected");
        let selectedStorage = document.querySelector(".storage-card.selected");
        let selectedColor = document.querySelector(".color-circle.selected");

        if (selectedModel && selectedStorage && selectedColor) {
            buyButton.style.backgroundColor = "#0071e3";
            buyButton.style.color = "white";
            if (addToBagButton) {
                addToBagButton.style.borderColor = "#0071e3";
                addToBagButton.style.color = "#0071e3";
                addToBagButton.style.opacity = "1";
            }
        } else {
            buyButton.style.backgroundColor = "#86868b";
            if (addToBagButton) {
                addToBagButton.style.borderColor = "#86868b";
                addToBagButton.style.color = "#86868b";
                addToBagButton.style.opacity = "0.5";
            }
        }
    }

    // Initial price calculation
    updatePrice();

    // Handle Buy Button Click
    const buyButton = document.querySelector(".buy-button");
    if (buyButton) {
        buyButton.addEventListener("click", function () {
            let selectedModel = document.querySelector(".model-card.selected");
            let selectedStorage = document.querySelector(".storage-card.selected");
            let selectedColor = document.querySelector(".color-circle.selected");

            if (!selectedModel || !selectedStorage || !selectedColor) {
                alert("Vui lòng chọn đầy đủ thông tin sản phẩm trước khi mua.");
                return;
            }

            // Extract calculated price
            const basePrice = parseFloat(selectedModel.getAttribute("data-price"));
            const offset = parseFloat(selectedStorage.getAttribute("data-price-offset"));
            const total = basePrice + offset;
            
            const productName = selectedModel.querySelector("strong").innerText;
            const productStorage = selectedStorage.querySelector("strong").innerText;
            const productColor = selectedColor.style.backgroundColor;
            const imageUrl = document.querySelector(".rf-bfe-column-left img").src;

            // Create URL with query parameters for checkout
            let checkoutUrl = new URL(window.location.origin + '/checkout');
            checkoutUrl.searchParams.append('product', productName);
            checkoutUrl.searchParams.append('price', "$" + total);
            checkoutUrl.searchParams.append('storage', productStorage);
            checkoutUrl.searchParams.append('color', productColor);
            checkoutUrl.searchParams.append('image_url', imageUrl);

            window.location.href = checkoutUrl.toString();
        });
    }
});
