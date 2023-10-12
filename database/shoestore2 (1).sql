-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2023 at 04:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'men'),
(2, 'women '),
(3, 'kids');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(6, 27, 'jhon', 'jhon@gmail.com', '1111111111', 'fcgvhbjk');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `payment` varchar(30) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `invoice_no` int(11) DEFAULT NULL,
  `cname` varchar(40) DEFAULT NULL,
  `cphone` int(11) DEFAULT NULL,
  `caddress` varchar(100) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `method` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `customer_id`, `quantity`, `payment`, `price`, `created_at`, `invoice_no`, `cname`, `cphone`, `caddress`, `email`, `method`) VALUES
(498, 90, 17, 1, 'pending', 1500, ' 2023-08-19 11:19:04', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(499, 90, 17, 1, 'pending', 1500, ' 2023-08-19 11:19:18', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(500, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:48:54', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(501, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:49:08', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(502, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:50:51', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(503, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:51:06', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(504, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:52:24', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(505, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:53:53', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(506, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:53:55', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(507, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:54:02', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(508, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:54:03', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(509, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:54:24', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(510, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:56:44', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(511, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:59:27', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(512, 90, 17, 1, 'pending', 1500, ' 2023-08-22 04:59:31', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(513, 90, 17, 1, 'pending', 1500, ' 2023-08-22 05:00:33', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(514, 90, 17, 1, 'pending', 1500, ' 2023-08-22 05:02:08', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(515, 90, 17, 1, 'pending', 1500, ' 2023-08-22 05:02:22', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(516, 89, 17, 1, 'pending', 3000, ' 2023-08-22 05:02:43', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'esewa'),
(517, 89, 17, 1, 'pending', 3000, ' 2023-08-22 05:03:03', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'esewa'),
(518, 89, 17, 1, 'pending', 3000, ' 2023-08-22 05:03:24', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'esewa'),
(519, 89, 17, 1, 'pending', 3000, ' 2023-08-22 05:03:48', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'esewa'),
(520, 89, 17, 1, 'pending', 3000, ' 2023-08-22 05:03:58', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'esewa'),
(521, 89, 17, 1, 'pending', 3000, ' 2023-08-22 05:04:21', 2147483647, 'jhon', 1233345678, 'ktm', 'abc@gmail.com', 'esewa'),
(522, 89, 17, 1, 'pending', 3000, ' 2023-08-22 05:05:26', 2147483647, NULL, NULL, NULL, NULL, NULL),
(523, 99, 17, 1, 'pending', 1700, ' 2023-08-22 05:07:05', 2147483647, 'kabita', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(524, 99, 17, 1, 'pending', 1700, ' 2023-08-22 05:07:12', 2147483647, 'kabita', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery'),
(525, 99, 17, 1, 'pending', 1700, ' 2023-08-22 05:07:26', 2147483647, 'kabita', 1233345678, 'ktm', 'abc@gmail.com', 'cash on delivery');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `category_id` int(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `image`, `price`, `description`, `category_id`, `quantity`) VALUES
(88, 'black boot girls', 'ladieswinter.jpg', 5000, 'asdfghjkm,', 2, NULL),
(89, 'white shoes for girls', 'ladieswinter3jpg.jpg', 3000, 'wertyuioasdfghj', 2, -6),
(90, 'men summer shoes', 'mensummer.jpeg', 1500, 'hgfytiumbht', 1, -15),
(91, 'kids short boot', 'kidswinter5.jpg', 2500, 'abcdefghij', 3, 0),
(92, 'women summer shoe', 'summerladies2.jpeg', 1700, 'light weight comfortable womens shoes  for summers', 2, 0),
(99, 'fghj', 'kidswinter.jpeg', 1700, 'cvghbnj', 1, -1),
(103, 'aa', 'Windows[1].json', -1700, 'dfvghj', 1, 3),
(111, 'aa', 'Windows[1].json', -1700, 'sd', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating_value` varchar(10) DEFAULT NULL,
  `review` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `product_id`, `user_id`, `rating_value`, `review`) VALUES
(1, 88, 17, NULL, 'assaaa'),
(3, 88, 27, NULL, 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `phone` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `userName`, `email`, `password`, `role`, `phone`) VALUES
(17, 'jhon', 'jhon@gmail.com', 'jhon123', 'user', 2147483647),
(25, 'safal', 'safal@gmail.com', 'safal0', 'user', 1234567890),
(26, 'Admin', 'Kabita@gmail.com', 'admin123', 'Admin', 2147483647),
(27, 'Akriti', 'akriti@gmail.com', 'akriti123', 'user', 2147483647),
(28, 'Ram', 'abc@gmail.com', '123456', 'user', 1234223344);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_cart_user` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_category_id` (`category_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `id` (`user_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `register` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `register` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
