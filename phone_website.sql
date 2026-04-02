-- Tạo cơ sở dữ liệu nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS phone_website CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE phone_website;

-- Bảng users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    country VARCHAR(50) DEFAULT NULL,
    birthdate DATE DEFAULT NULL,
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    colors VARCHAR(255) DEFAULT NULL,
    price INT NOT NULL,
    quantity INT DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng orders
CREATE TABLE IF NOT EXISTS orders (
    id_order INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    product VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    storage VARCHAR(50) DEFAULT NULL,
    color VARCHAR(50) DEFAULT NULL,
    price INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Thêm một tài khoản admin mặc định (Mật khẩu: 123456)
INSERT INTO users (firstname, lastname, email, password, role) 
VALUES ('Admin', 'Apple', 'admin@apple.com', '$2y$10$wE0v0pU9TIfHn9z3K8FkYuR./bZqXYh5Y9mJ7S18c50r5JvU00RjK', 'admin');

-- Thêm một số sản phẩm mẫu
INSERT INTO products (name, image_url, colors, price, quantity) VALUES 
('iPhone 16 Pro', 'public/assets/img/hero_iphone16pro_avail__fnf0f9x70jiy_largetall.jpg', 'Titan tự nhiên, Titan xanh', 28990000, 50),
('iPhone 16', 'public/assets/img/hero_iphone16_avail__euwzls69btea_largetall.jpg', 'Hồng, Vàng, Xanh lá', 22990000, 100),
('MacBook Air M3', 'public/assets/img/promo_macbook_air_m3__e43jegok3wuq_large.jpg', 'Xám không gian, Bạc', 27990000, 30);
