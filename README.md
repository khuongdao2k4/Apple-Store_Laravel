Phone Store - README
**Phone Store** là một dự án website bán điện thoại trực tuyến.  
Dự án được xây dựng bằng **PHP**, **MySQL**, **HTML/CSS/JavaScript** và chạy tốt trên các môi trường XAMPP, Laragon, OpenServer.

🎯 Giới thiệu
Website cho phép quản lý sản phẩm, hiển thị danh mục điện thoại, hỗ trợ người dùng đăng ký, đăng nhập, mua hàng và quản lý đơn hàng.  
Dành cho mục đích học tập và phát triển.

⚙️ Công nghệ sử dụng
- **Ngôn ngữ**: PHP 7.4+, HTML5, CSS3, JavaScript
- **Cơ sở dữ liệu**: MySQL/MariaDB
- **Máy chủ phát triển**: XAMPP / OpenServer / Laragon
- **Trình duyệt hỗ trợ**: Chrome, Edge, Firefox

🔑 Tính năng chính
- Hiển thị danh sách điện thoại
- Tìm kiếm, lọc sản phẩm
- Đăng ký & đăng nhập tài khoản
- Giỏ hàng và thanh toán
- Quản trị sản phẩm (thêm, sửa, xóa)
- Quản lý đơn hàng

📦 Cài đặt

### 1. Chuẩn bị môi trường
- Cài đặt **XAMPP** (hoặc OpenServer, Laragon)
- Bật **Apache** và **MySQL**

### 2. Tải và triển khai dự án
1. Clone hoặc tải project từ GitHub:
   git clone https://github.com/<tên-user>/<repo>.git
   hoặc giải nén vào:
   C:\xampp\htdocs\Phone_Store

2. Tạo database:
   CREATE DATABASE phone_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

3. Import file database.sql (nếu có):
   mysql -u root -p phone_store < database.sql

4. Chỉnh cấu hình kết nối DB trong file config.php (hoặc tương tự):
   $db_host = "localhost";
   $db_user = "root";
   $db_pass = "";
   $db_name = "phone_store";

▶️ Chạy dự án
1. Khởi động Apache & MySQL.
2. Mở trình duyệt và truy cập:
   http://localhost/Phone_Store
3. Đăng ký hoặc đăng nhập để sử dụng.

📂 Gợi ý cấu trúc thư mục
Phone_Store/
├── assets/        # CSS, JS, hình ảnh
├── database/      # File SQL
├── layout/        # Header, Footer
├── pages/         # Các trang giao diện
├── utils/         # Các hàm tiện ích
└── index.php      # Trang chính

📝 Ghi chú
- Sửa config.php nếu đổi thông tin kết nối DB.
- Kiểm tra quyền ghi thư mục nếu gặp lỗi upload.

📜 License
Dự án dùng cho học tập và thực hành cá nhân.
