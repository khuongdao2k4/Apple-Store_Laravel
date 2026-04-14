document.addEventListener("DOMContentLoaded", function () {
    // Function to handle card selection
    function selectCard(cards, selectedClass) {
        cards.forEach(card => {
            card.addEventListener("click", function () {
                cards.forEach(c => c.classList.remove(selectedClass));
                this.classList.add(selectedClass);
                
                // Update buy button state if needed
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

    function updateBuyButtonState() {
        const buyButton = document.querySelector(".buy-button");
        let selectedModel = document.querySelector(".model-card.selected");
        let selectedStorage = document.querySelector(".storage-card.selected");
        let selectedColor = document.querySelector(".color-circle.selected");

        if (selectedModel && selectedStorage && selectedColor) {
            buyButton.style.backgroundColor = "#0071e3"; // Apple Blue
        } else {
            buyButton.style.backgroundColor = "#86868b"; // Grey
        }
    }

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

            // Extract data
            let productName = selectedModel.querySelector("strong").innerText;
            // Handle price extraction correctly
            let priceText = selectedModel.innerText;
            let productPrice = priceText.includes("From ") ? priceText.split("From ")[1].trim() : "0";
            
            let productStorage = selectedStorage.querySelector("strong").innerText;
            let productColor = selectedColor.style.backgroundColor;
            let imageUrl = document.querySelector(".rf-bfe-column-left img").src;

            // Use global variables defined in PHP
            console.log("Username:", typeof username !== 'undefined' ? username : 'Guest');
            
            // Create hidden form to submit
            let form = document.createElement("form");
            form.method = "POST";
            form.action = "process-order";

            form.innerHTML = `

                <input type="hidden" name="username" value="${typeof username !== 'undefined' ? username : ''}">
                <input type="hidden" name="email" value="${typeof email !== 'undefined' ? email : ''}">
                <input type="hidden" name="name" value="${productName}">
                <input type="hidden" name="price" value="${productPrice}">
                <input type="hidden" name="storage" value="${productStorage}">
                <input type="hidden" name="color" value="${productColor}">
                <input type="hidden" name="image_url" value="${imageUrl}">
            `;

            document.body.appendChild(form);
            form.submit();
        });
    }
});
