-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 15, 2018 lúc 07:54 PM
-- Phiên bản máy phục vụ: 10.1.31-MariaDB
-- Phiên bản PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ntt_bil`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `emp`
--

CREATE TABLE `emp` (
  `emp_id` int(8) NOT NULL,
  `emp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `emp`
--

INSERT INTO `emp` (`emp_id`, `emp_name`, `emp_user`, `emp_password`, `emp_email`, `emp_phone`) VALUES
(1, 'The Trung', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '01659966631'),
(2, 'Duc Nhat', 'nhat1379@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'nhat1379@gmail.com', '01659966632'),
(3, 'Admin', 'admin1@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin1@gmail.com', '01675371548');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(8) NOT NULL,
  `emp_id` int(8) NOT NULL,
  `orders_date` datetime NOT NULL,
  `orders_total` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orders_action` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`orders_id`, `emp_id`, `orders_date`, `orders_total`, `orders_action`) VALUES
(64, 1, '2018-07-14 20:41:53', '639.98', 'Array'),
(67, 1, '2018-07-14 20:55:39', '8669.67', 'Delivered'),
(68, 2, '2018-07-14 22:01:25', '549.98', 'Transporting'),
(69, 1, '2018-07-14 23:45:08', '1979.89', 'Processed'),
(70, 1, '2018-07-14 23:58:44', '328.43', 'Delivered'),
(71, 1, '2018-07-15 17:09:20', '2266.73', 'Processed');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_products`
--

CREATE TABLE `order_products` (
  `order_id` int(11) NOT NULL,
  `orders_id` int(8) NOT NULL,
  `id` int(11) NOT NULL,
  `order_price` float NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_products`
--

INSERT INTO `order_products` (`order_id`, `orders_id`, `id`, `order_price`, `order_quantity`, `order_total`) VALUES
(1, 64, 6, 199.99, 1, 199.99),
(2, 64, 4, 439.99, 1, 439.99),
(3, 67, 6, 199.99, 1, 199.99),
(4, 67, 4, 439.99, 15, 6599.85),
(5, 67, 7, 109.99, 17, 1869.83),
(6, 68, 7, 109.99, 1, 109.99),
(7, 68, 4, 439.99, 1, 439.99),
(8, 69, 2, 179.99, 11, 1979.89),
(9, 70, 8, 108.45, 1, 108.45),
(10, 70, 7, 109.99, 2, 219.98),
(11, 71, 6, 199.99, 1, 199.99),
(12, 71, 4, 439.99, 1, 439.99),
(13, 71, 8, 108.45, 15, 1626.75);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`) VALUES
(1, 'Intel Core i7-8700K Coffee Lake 6-Core 3.7 GHz', 'corei7.jpg', 414.99),
(2, 'Corsair Crystal 570X RGB ATX Mid Tower Case', 'corsair570xrgb.jpg', 179.99),
(3, 'Corsair Gaming Mouse SCIMITAR PRO RGB', 'Corsair-Gaming-SCIMITAR-PRO-RGB.jpg', 79.99),
(4, 'G.SKILL TridentZ RGB Series 32GB DDR4', 'gskill-tridentz-rgb.jpg', 439.99),
(5, 'AMD RYZEN 7 1700 8-Core 3.0 GHz Socket AM4 CPU', 'ryzen7.jpg', 299.99),
(6, 'NZXT H700i Mid Tower Chassis Tempered Glass Case', 'nzxth700i.jpg', 199.99),
(7, 'Razer Blackwidow Gaming  Mechanical Keyboard', 'razer-blackwidow.jpg', 109.99),
(8, 'Samsung 850EVO BULK Solid State Drive', 'samsung-850evo.jpg', 108.45);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`emp_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Chỉ mục cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `id` (`id`),
  ADD KEY `oders_id` (`orders_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `emp`
--
ALTER TABLE `emp`
  MODIFY `emp_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`emp_id`);

--
-- Các ràng buộc cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`orders_id`),
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
