-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 26, 2025 lúc 06:41 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `coffee_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_types`
--

CREATE TABLE `account_types` (
  `AccountTypeID` int(11) NOT NULL,
  `TypeName` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account_types`
--

INSERT INTO `account_types` (`AccountTypeID`, `TypeName`) VALUES
(1, 'Admin'),
(2, 'Nhân viên'),
(3, 'Khách hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Cà phê truyền thống'),
(2, 'Latte & Đặc biệt'),
(3, 'Matcha & Trà');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `Username` varchar(64) DEFAULT NULL,
  `OrderDate` datetime DEFAULT current_timestamp(),
  `TotalAmount` int(11) DEFAULT NULL,
  `Status` varchar(32) DEFAULT 'Chờ xác nhận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `OrderDetailID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(128) NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` int(11) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Description`, `Price`, `Image`, `CategoryID`, `Status`) VALUES
(1, 'Cà phê đen', 'Đen đá không đường', 27000, '/assets/img/cfden1.jpg', 1, 1),
(2, 'Cà phê sữa', 'Một chút ngọt ngào buổi sáng', 29000, '/assets/img/cfsua2.jpg', 1, 1),
(3, 'Bạc xỉu', 'Ngọt lịm đầu môi', 34000, '/assets/img/cfbacxiu1.jpg', 1, 1),
(4, 'Cà phê muối', 'Mặn, phải thử mới hiểu', 40000, '/assets/img/cfmuoi1.jpg', 1, 1),
(5, 'Latte socola Marou', 'Ngọt ngào và thơm lừng', 42000, '/assets/img/socola3.jpg', 2, 1),
(6, 'Americano', 'Không đường, mặn mà', 32000, '/assets/img/americano3.jpg', 1, 1),
(7, 'Latte Matcha', 'Xanh dịu dàng, thơm mịn', 55000, '/assets/img/matcha3.jpg', 3, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `Username` varchar(64) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Fullname` varchar(64) DEFAULT NULL,
  `Phone` varchar(11) DEFAULT NULL,
  `Email` varchar(64) DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT '/assets/img/default-avatar.png',
  `Money` int(11) DEFAULT 0,
  `Status` tinyint(4) DEFAULT 1,
  `CreatedAt` datetime(3) DEFAULT current_timestamp(3),
  `AccountTypeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`Username`, `Password`, `Fullname`, `Phone`, `Email`, `Avatar`, `Money`, `Status`, `CreatedAt`, `AccountTypeID`) VALUES
('admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Lý Quốc Hưng', '0123456789', 'admin@gmail.com', '/assets/img/default-avatar.png', 0, 1, '2025-07-26 22:40:59.066', 1),
('nv1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Nhân viên A', '0999999999', 'nv1@gmail.com', '/assets/img/default-avatar.png', 0, 1, '2025-07-26 22:40:59.066', 2),
('user1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Nguyễn Văn A', '0888888888', 'user1@gmail.com', '/assets/img/default-avatar.png', 0, 1, '2025-07-26 22:40:59.066', 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`AccountTypeID`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `Username` (`Username`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`OrderDetailID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `AccountTypeID` (`AccountTypeID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account_types`
--
ALTER TABLE `account_types`
  MODIFY `AccountTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`AccountTypeID`) REFERENCES `account_types` (`AccountTypeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
