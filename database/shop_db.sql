-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 10:30 AM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'Admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`) VALUES
(6, 'Big Acrylic Lamp', 'Illuminate your space with a touch of elegance and sophistication with our Big Acrylic Lamp. Crafted with care from high-quality wood, this stunning lamp combines the warmth of wood with the modern appeal of acrylic. Its unique design allows it to seamlessly blend into any decor style, from rustic to contemporary.', 300, 'Big Acrylic.jpg', 'Big Acrylic.jpg', 'Big Acrylic.jpg'),
(7, 'Amplifier Stand', 'Introducing our Amplifier Stand – a sleek and sturdy solution to elevate your sound equipment. Crafted for both style and practicality, this stand provides the perfect platform for your amplifier, enhancing both your audio experience and your space&#39;s aesthetic. ', 200, 'Amplifier Stand.jpg', 'Amplifier Stand.jpg', 'Amplifier Stand.jpg'),
(8, 'Amplifier with Pen Stand', 'Discover the Amplifier with Pen Stand – a harmonious blend of functionality and style. Elevate your workspace with this innovative accessory that seamlessly combines an amplifier and a convenient pen stand, adding a touch of modern sophistication to your desk.', 200, 'Amplifier with Pen Stand.jpg', 'Amplifier with Pen Stand.jpg', 'Amplifier with Pen Stand.jpg'),
(9, 'Big Cross Lamp', 'Introducing the Big Cross Lamp – an embodiment of elegance and illumination. Crafted with precision, this unique lamp combines a bold cross design with soft lighting, creating a captivating focal point in any room. Elevate your decor with this striking blend of form and function.', 300, 'Big Cross.jpg', 'Big Cross.jpg', 'Big Cross.jpg'),
(10, 'Big Jigzaw Lamp', 'Experience the Big Jigsaw Lamp – a masterpiece of light and design. Crafted with precision, this intricate jigsaw-inspired lamp casts captivating patterns, creating an artistic ambiance in your space. Elevate your surroundings with this stunning blend of creativity and illumination.', 300, 'Big Jigzaw.jpg', 'Big Jigzaw.jpg', 'Big Jigzaw.jpg'),
(11, 'Cute Lamp with Clock', 'Introducing the Cute Lamp with Clock – a delightful fusion of light and time. This charming lamp features a built-in clock, adding a playful and functional touch to your space. Illuminate your surroundings while keeping track of time with this adorable and practical accessory.', 200, 'Cute lamp with clock.jpg', 'Cute lamp with clock.jpg', 'Cute lamp with clock.jpg'),
(12, 'Cute Lamp', 'Discover the charm of our Cute Lamp – a delightful addition to your space. With its whimsical design and soft glow, this lamp adds a touch of enchantment to any room. Elevate your decor with this adorable blend of light and style.', 200, 'Cute Lamp.jpg', 'Cute Lamp.jpg', 'Cute Lamp.jpg'),
(13, 'Lamp Cross', 'Experience the Lamp Cross – a symbol of illumination and elegance. With its captivating cross design and warm glow, this lamp adds a unique and spiritual touch to your space. Elevate your ambiance with this exquisite blend of light and symbolism.', 200, 'Lamp Cross.jpg', 'Lamp Cross.jpg', 'Lamp Cross.jpg'),
(14, 'Lamp with Phone Holder', 'Introducing the Lamp with Phone Holder – a modern solution for your lighting and charging needs. This versatile lamp features a built-in phone holder, allowing you to enjoy both illumination and easy device access. Elevate your convenience with this innovative and functional accessory.', 200, 'Lamp with Phone Holder.jpg', 'Lamp with Phone Holder.jpg', 'Lamp with Phone Holder.jpg'),
(15, 'Magnet Squares 7x7', 'Introducing the Magnet-Square 7x7 – a versatile and magnetic marvel. With its compact 7x7 size, this magnet offers a powerful grip, perfect for organizing notes, photos, and more. Elevate your organization with this sleek and practical magnetic solution.', 200, 'Magnet-Square 7x7.jpg', 'Magnet-Square 7x7.jpg', 'Magnet-Square 7x7.jpg'),
(16, 'Mini Acrylic Salisi Lamp', 'Discover the Mini Acrylic Salisi Lamp – a captivating blend of style and illumination. Crafted with care, this compact lamp features acrylic accents that cast a soft and inviting glow. Elevate your space with this charming and versatile lighting option.', 200, 'Mini Acrylic Salisi.jpg', 'Mini Acrylic Salisi.jpg', 'Mini Acrylic Salisi.jpg'),
(17, 'Mini Cross Lamp', 'Experience the Mini Cross Lamp – a symbol of simplicity and elegance. Crafted with care, this petite cross adds a touch of spirituality to your space. Elevate your decor with this subtle yet meaningful accent.', 200, 'Mini Cross.jpg', 'Mini Cross.jpg', 'Mini Cross.jpg'),
(18, 'Mini Jigzaw with Stick', 'Introducing the Mini Jigsaw with Stick – a playful blend of creativity and fun. Crafted with precision, this compact jigsaw puzzle comes with its own stick for easy assembly. Elevate your leisure time with this engaging and interactive mini masterpiece.', 200, 'Mini Jigzaw with stick.jpg', 'Mini Jigzaw with stick.jpg', 'Mini Jigzaw with stick.jpg'),
(19, 'Mini Jigzaw Lamp', 'Discover the Mini Jigsaw Lamp – a creative marvel that illuminates your imagination. Crafted with precision, this compact lamp features a jigsaw-inspired design that casts captivating patterns. Elevate your ambiance with this unique and artistic lighting solution.', 200, 'Mini Jigzaw.jpg', 'Mini Jigzaw.jpg', 'Mini Jigzaw.jpg'),
(20, 'Mini Orig Lamp', 'Introducing the Mini Orig Lamp – a testament to the art of illumination. Crafted with intricacy, this compact lamp showcases origami-inspired design, casting a gentle and enchanting glow. Elevate your space with this exquisite blend of light and creativity.', 200, 'Mini Orig.jpg', 'Mini Orig.jpg', 'Mini Orig.jpg'),
(21, 'Phone Stand', 'Meet the PhoneStand – a sleek and practical solution for your device. Crafted for convenience, this stand securely holds your phone, keeping it accessible and visible. Elevate your tech setup with this stylish and functional accessory.', 200, 'Phonestand.jpg', 'Phonestand.jpg', 'Phonestand.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(3, 'user', 'user@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(4, 'user2', 'user2@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
