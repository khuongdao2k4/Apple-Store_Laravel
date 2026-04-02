    <footer
        style="text-align: left;padding-bottom:30px; padding-left: 300px; padding-right: 250px; background-color:rgb(227, 227, 237);">
        <br>
        <p style="color:rgb(106, 106, 108);">* Nay có hai phiên bản: AirPods 4 và AirPods 4 với Chủ Động Khử Tiếng Ồn.
            <br>
            Phiên bản beta của Apple Intelligence khả dụng trên tất cả các phiên bản iPhone 16, iPhone 15 Pro, iPhone 15
            Pro Max, iPad mini (A17 Pro), iPad và Mac với M1 trở lên, với Siri<br>
            và ngôn ngữ thiết bị được thiết lập là tiếng Anh (Úc, Canada, Ireland, New Zealand, Nam Phi, Vương quốc Anh
            hoặc Mỹ), trên một bản cập nhật phần mềm iOS 18, iPadOS 18 và <br>
            macOS Sequoia. Một số tính năng bổ sung và hỗ trợ ngôn ngữ tiếng Trung (Giản thể), tiếng Anh (Ấn Độ,
            Singapore), tiếng Pháp, tiếng Đức, tiếng Ý, tiếng Nhật, tiếng Hàn, tiếng <br>
            Bồ Đào Nha (Brazil), tiếng Tây Ban Nha sẽ ra mắt vào đầu tháng 4, và nhiều ngôn ngữ khác, bao gồm cả tiếng
            Việt sẽ ra mắt trong năm nay. Một số tính năng không khả dụng ở <br>
            một số khu vực hoặc ngôn ngữ. <br>
            Apple TV+ yêu cầu đăng ký thuê bao.<br>
            Một số tính năng có thể thay đổi. Một số tính năng, ứng dụng và dịch vụ chỉ khả dụng ở một số khu vực hoặc
            ngôn ngữ.</p>
        <hr>
        <p>Xem thêm cách để mua hàng: <a href="">Tìm cửa hàng bán lẻ gần bạn</a> . Hoặc gọi <u>1800 1192</u> .</p>
        <hr>
        <p>Bản quyền © Apple Inc. 2025 Bảo lưu mọi quyền.</p>
        <p><a href="">Chính Sách Quyền Riêng Tư</a> | <a href="">Điều Khoản Sử Dụng</a> | <a href="">Bán Hàng Và Hoàn
                Tiền</a> | <a href="">Pháp Lý</a> | <a href="">Bản Đồ Trang Web</a></p>
        <p style="color:rgb(159, 159, 160);">ĐKKD số 0313510827, do Sở KH&ĐT thành phố Hồ Chí Minh cấp ngày 28 tháng 10
            năm 2015 <br>
            Giấy phép kinh doanh số 0313510827/KD-0137 do Sở Công Thương thành phố Hồ Chí Minh cấp ngày 23 tháng 5 năm
            2018 <br>
            Địa chỉ: Phòng 901, Ngôi Nhà Đức Tại Tp. Hồ Chí Minh, số 33, đường Lê Duẩn, Phường Bến Nghé, Quận 1, thành
            phố Hồ Chí Minh, Việt Nam <br>
            Điện thoại: 1800 1192</p>
        <img src="https://www.apple.com/vn/home/globalfooter/logo-local-compliance.png"
            style="width: 125px; height: 40px;" alt="">
    </footer>
    <script>
        document.querySelector(".search-icon").addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(".search-box").classList.toggle("active");
        });

        document.getElementById("search-input").addEventListener("input", function () {
            let keyword = this.value.trim();
            let resultsContainer = document.getElementById("search-results");

            if (keyword.length > 1) {
                fetch(`search?query=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            let resultHTML = data.map(p => `
                        <li class="search-item" data-id="${p.id}" style="">
                            <img src="${p.image_url}" alt="${p.name}" class="search-image" style="">
                            <div class="search-info">
                                <span class="search-name">${p.name}</span>
                                <span class="search-price">${p.price}đ</span>
                            </div>
                        </li>
                    `).join("");

                            resultsContainer.innerHTML = resultHTML;
                            resultsContainer.style.display = "block";

                            // Thêm sự kiện click vào mỗi item để điều hướng
                            document.querySelectorAll(".search-item").forEach(item => {
                                item.addEventListener("click", function () {
                                    let productId = this.getAttribute("data-id");
                                    window.location.href = `order-test?id=${productId}`;
                                });
                            });

                        } else {
                            resultsContainer.innerHTML = "<li>Không tìm thấy sản phẩm</li>";
                            resultsContainer.style.display = "block";
                        }
                    })
                    .catch(error => {
                        console.error("Lỗi:", error);
                        resultsContainer.innerHTML = "<li>Có lỗi xảy ra!</li>";
                        resultsContainer.style.display = "block";
                    });
            } else {
                resultsContainer.innerHTML = "";
                resultsContainer.style.display = "none";
            }
        });
    </script>
</body>

</html>
