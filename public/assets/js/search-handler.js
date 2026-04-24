document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".navbar");
    const searchIcon = document.querySelector(".search-icon");
    const searchCloseBtn = document.querySelector(".search-close-btn");
    const searchOverlay = document.querySelector(".search-overlay");
    const searchInput = document.getElementById("search-input");
    const searchResults = document.getElementById("search-results");
    const searchResultsTitle = document.getElementById("search-results-title");
    const quickLinks = document.querySelector(".quick-links");

    // =============================================
    // SEARCH - Mở / Đóng tìm kiếm
    // =============================================
    if (searchIcon) {
        searchIcon.addEventListener("click", function (e) {
            e.preventDefault();
            navbar.classList.add("search-active");
            document.body.style.overflow = "hidden"; // Prevent background scroll
            setTimeout(() => searchInput && searchInput.focus(), 300);
        });
    }

    function closeSearch() {
        if (navbar) navbar.classList.remove("search-active");
        document.body.style.overflow = ""; // Restore scroll
        if (searchInput) searchInput.value = "";
        if (searchResults) {
            searchResults.innerHTML = "";
            searchResults.style.display = "none";
        }
        if (searchResultsTitle) searchResultsTitle.style.display = "none";
        if (quickLinks) quickLinks.style.display = "block";
    }

    if (searchCloseBtn) searchCloseBtn.addEventListener("click", closeSearch);
    if (searchOverlay) searchOverlay.addEventListener("click", closeSearch);

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && navbar && navbar.classList.contains("search-active")) {
            closeSearch();
        }
    });

    // Xử lý tìm kiếm Real-time
    let debounceTimer;
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            clearTimeout(debounceTimer);
            let keyword = this.value.trim();

            if (keyword.length > 0) {
                if (quickLinks) quickLinks.style.display = "none";
                debounceTimer = setTimeout(() => {
                    fetch(`/api/search?query=${encodeURIComponent(keyword)}`)
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => { throw new Error(err.error || 'Lỗi máy chủ'); });
                            }
                            return response.json();
                        })
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

                                if (searchResults) {
                                    searchResults.innerHTML = resultHTML;
                                    searchResults.style.display = "block";
                                }
                                if (searchResultsTitle) searchResultsTitle.style.display = "block";

                                document.querySelectorAll(".search-item").forEach(item => {
                                    item.addEventListener("click", function () {
                                        let productId = this.getAttribute("data-id");
                                        window.location.href = `/order?id=${productId}`;
                                    });
                                });
                            } else {
                                if (searchResults) {
                                    searchResults.innerHTML = "<li class='py-2 text-muted'>Không tìm thấy sản phẩm nào khớp với từ khóa.</li>";
                                    searchResults.style.display = "block";
                                }
                                if (searchResultsTitle) searchResultsTitle.style.display = "block";
                            }
                        })
                        .catch(error => {
                            console.error("Search Error:", error);
                            if (searchResults) {
                                searchResults.innerHTML = `<li class='py-2 text-danger'>${error.message}</li>`;
                                searchResults.style.display = "block";
                            }
                        });
                }, 300);
            } else {
                if (quickLinks) quickLinks.style.display = "block";
                if (searchResults) {
                    searchResults.innerHTML = "";
                    searchResults.style.display = "none";
                }
                if (searchResultsTitle) searchResultsTitle.style.display = "none";
            }
        });
    }

    // =============================================
    // SUBMENU HOVER với delay - tránh submenu tắt đột ngột
    // =============================================
    const navItems = document.querySelectorAll(".navbar-nav .nav-item");

    navItems.forEach(function (navItem) {
        const submenuContainer = navItem.querySelector(".submenu-container");
        if (!submenuContainer) return; 

        let hideTimer = null;

        function showSubmenu() {
            // Hủy việc đóng các menu khác (nếu đang hover sang menu mới)
            navItems.forEach(item => {
                if (item !== navItem) item.classList.remove("submenu-open");
            });
            
            clearTimeout(hideTimer);
            navItem.classList.add("submenu-open");
        }

        function scheduleHide() {
            clearTimeout(hideTimer);
            // Tăng delay lên 200ms để người dùng thoải mái di chuyển chuột
            hideTimer = setTimeout(function () {
                navItem.classList.remove("submenu-open");
            }, 200);
        }

        // Mouseenter/leave trên toàn bộ nav-item (li)
        navItem.addEventListener("mouseenter", showSubmenu);
        navItem.addEventListener("mouseleave", scheduleHide);
        
        // Đảm bảo khi di chuột vào submenu-container nó không bị coi là "rời khỏi"
        submenuContainer.addEventListener("mouseenter", function() {
            clearTimeout(hideTimer);
            navItem.classList.add("submenu-open");
        });

        // Bổ sung sự kiện bắt buộc ẩn khi chuột trỏ ra khỏi submenu-container
        submenuContainer.addEventListener("mouseleave", scheduleHide);
    });
});
