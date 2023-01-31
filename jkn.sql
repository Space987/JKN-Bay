-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 05:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jkn`
--
CREATE DATABASE IF NOT EXISTS `jkn` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jkn`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `nicename` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `nicename`) VALUES
(1, 'CLOTHES', 'Clothes'),
(2, 'SHOES', 'Shoes'),
(3, 'TECH', 'Technology'),
(4, 'BOOK', 'Book');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `code` varchar(72) NOT NULL,
  `status` enum('created','applied') NOT NULL DEFAULT 'created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `profile_id`, `message_id`, `code`, `status`) VALUES
(59, 141, 193, '$2y$10$Uiy2iPtQDV048fOPnqh8teA6HGxqr9vjT2gTrcG5YXyDeTA5CFZKC', 'created');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `flag` enum('none','discount') NOT NULL DEFAULT 'none',
  `message` varchar(200) NOT NULL,
  `reply_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `product_id`, `sender_id`, `receiver_id`, `date_time`, `flag`, `message`, `reply_to`) VALUES
(193, NULL, NULL, 141, '2022-12-08 09:37:36', 'discount', 'Welcome to JKN Bay, here is your discount code: 3ZD9X', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `status` enum('cart','paid','shipped') NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `profile_id`, `status`, `date`, `total`) VALUES
(184, 140, 'paid', '2022-12-08', 3114),
(185, 140, 'paid', '2022-12-08', 339),
(186, 140, 'paid', '2022-12-08', 24),
(187, 140, 'cart', '2022-12-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(6,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(464, 184, 79, 1, '1999'),
(465, 184, 85, 1, '15'),
(466, 184, 84, 1, '1100'),
(467, 185, 82, 1, '100'),
(468, 185, 83, 1, '239'),
(469, 186, 86, 2, '12');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `state` enum('used','new') NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(20) NOT NULL,
  `status` enum('selling','sold') NOT NULL DEFAULT 'selling',
  `rating` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `profile_id`, `name`, `description`, `price`, `quantity`, `state`, `category_id`, `image`, `status`, `rating`) VALUES
(79, 139, 'Dell Inspire Pro', 'Stay connected wherever you go with Inspiron\'s easy-to-use PCs. With lightweight designs and long-battery life, our laptops and 2-in-1s keep you moving.', 1999, 4, 'new', 3, '6391f89a62f77.png', 'selling', 0),
(80, 139, 'Air Force One', 'Air Force 1 black trainers: iconic design with a fresh spin. Discover sleek basketball-inspired shoes in a must-have colour.', 145, 12, 'new', 2, '6391f9385b207.png', 'selling', 0),
(81, 139, 'Harry Potter', 'Harry Potter is a series of seven fantasy novels written by British author J. K. Rowling.', 5, 7, 'used', 4, '6391f9d7b6caa.png', 'selling', 0),
(82, 139, 'Nike Tech Fleece', 'Elevate Your Look While Staying Warm, Dry And Comfortable With Nike Tech Fleece. Nike Products Designed For Performance And Every Day Wear. Gear Up At Nike.', 100, 0, 'used', 1, '6391fa7017b94.png', 'sold', 0),
(83, 142, 'Kyrie 5TB', 'The Nike Men\'s Kyrie 5 TB Basketball Shoe gives his fast, all-angle attack a new cushioning technology that aligns with the curved shape of the outsole.', 239, 5, 'new', 2, '6391fb43ac1f6.png', 'selling', 0),
(84, 142, 'Samsung Galaxy S22', 'Welcome to the epic new standard. Introducing Galaxy S22 Ultra 5G, with a built-in S Pen, Nightography camera and a battery that goes beyond all day.', 1100, 2, 'used', 3, '6391fc065edec.png', 'selling', 4),
(85, 142, 'Snapback Hat', 'Why are snapback hats so popular? They\'re famous for their casual ease, their breathability, and just how awesome they look on everyone!', 15, 19, 'new', 1, '6391fc9bbc8ce.png', 'selling', 12),
(86, 142, 'The Bible', 'The Bible is a collection of religious texts or scriptures that are held to be sacred in Christianity, Judaism, Samaritanism, and many other religions.', 12, 48, 'used', 4, '6391fcf0577ee.png', 'selling', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `city` varchar(15) NOT NULL,
  `password_hash` varchar(72) NOT NULL,
  `role` enum('buyer','seller') NOT NULL DEFAULT 'seller',
  `image` varchar(50) NOT NULL,
  `ratingSeller` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `username`, `first_name`, `last_name`, `postal_code`, `city`, `password_hash`, `role`, `image`, `ratingSeller`) VALUES
(139, 'Natan', 'Natan', 'Lellouche', 'H7Y2C4', 'Laval', '$2y$10$aaTx4jDTQyFp.h4pVYOpTOIfklxPywanToEcCktXD16FRwdNtDmHy', 'seller', '6391f61c98761.jpg', 0),
(140, 'Kyle', 'Kyle', 'Husbands', 'H7Y2C4', 'Laval', '$2y$10$g/wdeWfHB2XEju2WZKD2g.1F3/5ixaZuC0FEFZXya8h2zPRM1/FF6', 'buyer', '6391f666c6b77.jpg', 0),
(141, 'Julien', 'Julien', 'Bernardo', 'H7Y2C4', 'Laval', '$2y$10$k4FovbS3GZTvsWTPpQuTve./gSyOl/v7Pgr4RC23jvVsNVdi0aYiq', 'buyer', '6391f6b009e79.jpg', 0),
(142, 'Michel', 'Michel', 'Paquette', 'H7Y2C4', 'Laval', '$2y$10$xR6C3H3MMjJJYnNsyxotm.sHzgv7c2BlNGImQ9/O0daxa1fomEQ0i', 'seller', '6391f757897ed.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating` (
  `r_product_id` int(11) NOT NULL,
  `r_profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`r_product_id`, `r_profile_id`) VALUES
(84, 140);

-- --------------------------------------------------------

--
-- Table structure for table `ratingseller`
--

DROP TABLE IF EXISTS `ratingseller`;
CREATE TABLE `ratingseller` (
  `rate_seller_id` int(10) NOT NULL,
  `rate_profile_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratingseller`
--

INSERT INTO `ratingseller` (`rate_seller_id`, `rate_profile_id`) VALUES
(142, 140);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`),
  ADD KEY `discount_to_profile` (`profile_id`),
  ADD KEY `discount_to_message` (`message_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `message_to_product` (`product_id`),
  ADD KEY `reciever_to_profile` (`receiver_id`),
  ADD KEY `sender_to_profile` (`sender_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_to_profile` (`profile_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD UNIQUE KEY `order_id` (`order_id`,`product_id`),
  ADD KEY `order_detail_to_detail` (`order_id`),
  ADD KEY `order_detail_to_product` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_to_profile` (`profile_id`),
  ADD KEY `product_to_category` (`category_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`r_product_id`,`r_profile_id`);

--
-- Indexes for table `ratingseller`
--
ALTER TABLE `ratingseller`
  ADD PRIMARY KEY (`rate_seller_id`,`rate_profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=472;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_to_message` FOREIGN KEY (`message_id`) REFERENCES `message` (`message_id`),
  ADD CONSTRAINT `discount_to_profile` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_to_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `reciever_to_profile` FOREIGN KEY (`receiver_id`) REFERENCES `profile` (`profile_id`),
  ADD CONSTRAINT `sender_to_profile` FOREIGN KEY (`sender_id`) REFERENCES `profile` (`profile_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_to_profile` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_to_detail` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `order_detail_to_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_to_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `product_to_profile` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
