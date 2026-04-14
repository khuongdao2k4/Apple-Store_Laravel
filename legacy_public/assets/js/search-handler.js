document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".navbar");
    const searchIcon = document.querySelector(".search-icon");
    const searchCloseBtn = document.querySelector(".search-close-btn");
    const searchOverlay = document.querySelector(".search-overlay");
    const searchInput = document.getElementById("search-input");
    const searchResults = document.getElementById("search-results");
    const searchResultsTitle = document.getElementById("search-results-title");
    const quickLinks = document.querySelector(".quick-links");

    // Mở tìm kiếm
    searchIcon.addEventListener("click", function (e) {
        e.preventDefault();
        navbar.classList.add("search-active");
        setTimeout(() => searchInput.focus(), 300);
    });

    // Đóng tìm kiếm
    function closeSearch() {
        navbar.classList.remove("search-active");
        searchInput.value = "";
        searchResults.innerHTML = "";
        searchResults.style.display = "none";
        searchResultsTitle.style.display = "none";
        quickLinks.style.display = "block";
    }

    searchCloseBtn.addEventListener("click", closeSearch);
    searchOverlay.addEventListener("click", closeSearch);

    // ESC to close
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && navbar.classList.contains("search-active")) {
            closeSearch();
        }
    });

    // Xử lý tìm kiếm Real-time
    let debounceTimer;
    searchInput.addEventListener("input", function () {
        clearTimeout(debounceTimer);
        let keyword = this.value.trim();

        if (keyword.length > 0) {
            quickLinks.style.display = "none";
            debounceTimer = setTimeout(() => {
                fetch(`apple_search.php?query=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            let resultHTML = data.map(p => `
                                <li class="search-item" data-id="${p.id}">
                                    <img src="${p.image_url}" alt="${p.name}" class="search-image">
                                    <div class="search-info">
                                        <span class="search-name">${p.name}</span>
                                        <span class="search-price">${new Intl.NumberFormat('vi-VN').format(p.price)}đ</span>
                                    </div>
                                </li>
                            `).join("");

                            searchResults.innerHTML = resultHTML;
                            searchResults.style.display = "block";
                            searchResultsTitle.style.display = "block";

                            // Sự kiện click vào kết quả
                            document.querySelectorAll(".search-item").forEach(item => {
                                item.addEventListener("click", function () {
                                    let productId = this.getAttribute("data-id");
                                    // Tùy chỉnh URL chi tiết sản phẩm nếu cần
                                    window.location.href = `index.php?url=order-test&id=${productId}`;
                                });
                            });
                        } else {
                            searchResults.innerHTML = "<li class='py-2 text-muted'>Không tìm thấy sản phẩm nào khớp với từ khóa.</li>";
                            searchResults.style.display = "block";
                            searchResultsTitle.style.display = "block";
                        }
                    })
                    .catch(error => {
                        console.error("Search Error:", error);
                        searchResults.innerHTML = "<li class='py-2 text-danger'>Lỗi kết nối máy chủ.</li>";
                        searchResults.style.display = "block";
                    });
            }, 300);
        } else {
            quickLinks.style.display = "block";
            searchResults.innerHTML = "";
            searchResults.style.display = "none";
            searchResultsTitle.style.display = "none";
        }
    });
});
