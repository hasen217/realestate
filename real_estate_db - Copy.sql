-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2026 at 12:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `area` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `type`, `status`, `price`, `area`, `description`, `city`, `address`, `bedrooms`, `bathrooms`, `amenities`, `images`, `created_at`) VALUES
(3, 'home rent', 'house', 'rent', 7000.00, 0, 'sir i give this home rent', 'ballari', 'cowl bazaar', 1, 0, '[\"parking\",\"pool\",\"gym\",\"security\",\"elevator\",\"garden\"]', '[\"uploads\\/1777101836_homerent2.jpg\"]', '2026-04-25 07:23:56'),
(4, 'plot', 'land', 'sale', 2200000.00, 4000, 'add this properties', 'kampli', 'bapuji nagar', 0, -1, '[\"parking\"]', '[\"uploads\\/1777101917_plot.jpg\"]', '2026-04-25 07:25:17'),
(5, 'Home Sale', 'house', 'sale', 5000000.00, 40000, 'add this properties sir in your websir', 'siruguppa', 'Deshnur Rood', 0, 0, '[]', '[\"uploads\\/1777106583_homesale.jpg\"]', '2026-04-25 08:43:03'),
(6, 'Plot Sale', 'land', 'sale', 200000.00, 2500, 'sir i intrest to sale my plot ', 'ballari near new bustand', 'near new bustand', NULL, NULL, NULL, '[\"uploads\\/1777197131_plot.jpg\"]', '2026-04-26 09:52:11'),
(7, 'home rent', 'house', 'rent', 10000.00, 0, 'sir this properties i can give to rent', 'siruguppa near new police statation', '', NULL, NULL, NULL, '[\"uploads\\/1777200847_homerent1.jpg\"]', '2026-04-26 10:54:07'),
(8, 'home rent', 'house', 'rent', 8000.00, 0, 'sir i give this properties rent plece halp me', 'sandur near ramesh hotel', 'sandur', NULL, NULL, NULL, '[\"uploads\\/1777202679_homerent2.jpg\"]', '2026-04-26 11:24:39'),
(10, 'home rent', 'house', 'rent', 7000.00, 0, 'sir this propertie i can give to rent help me', 'kurugodu', 'kurugodu near sunklamma temple', NULL, NULL, NULL, '[\"uploads\\/1777203256_homerent1.jpg\"]', '2026-04-26 11:34:16'),
(11, 'home rent', 'house', '', 10000.00, 0, 'sir add this propeteri', 'Ballari', 'Cowl Bazaar, near devane mastan dargah', NULL, NULL, NULL, '[\"uploads\\/1777204550_homerent2.jpg\"]', '2026-04-26 11:55:50'),
(12, 'plot', 'plot', '', 5000000.00, 0, 'sir add add this propertes', 'Ballari', 'Cowl Bazaar, near yasinsab masjid', NULL, NULL, NULL, '[\"uploads\\/1777204773_plot.jpg\"]', '2026-04-26 11:59:33'),
(13, 'home sale', 'house', 'sale', 4000000.00, 0, '..', 'Kurugodu', 'Kurugodu near balaji complex', NULL, NULL, NULL, '[\"uploads\\/1777207533_homesale.jpg\"]', '2026-04-26 12:45:33'),
(14, 'Home sale', 'house', 'sale', 5000000.00, 0, '..', 'Kurugodu near balaji complex', 'Kurugodu near balaji complex', NULL, NULL, NULL, '[\"uploads\\/1777208162_homesale.jpg\"]', '2026-04-26 12:56:02'),
(16, 'Home Rent', 'house', 'sale', 5000.00, 0, 'hi', 'Siruguppa', 'Deshnur Road, SSA  Function Hall', NULL, NULL, NULL, '[\"uploads\\/1777283737_homerent1.jpeg\"]', '2026-04-27 09:55:37'),
(18, 'Home Rent', 'house', 'sale', 10000.00, 0, 'sir add this properti', 'Ballari near cowlbaazar taha school', '', NULL, NULL, NULL, '[\"uploads\\/1777284607_homerent2.jpg\"]', '2026-04-27 10:10:07'),
(20, 'Home Sale', 'house', 'sale', 3000000.00, -1, 'sir i intrest to sale this home', 'siruguppa near bustan', 'sirguppa , near bustan', NULL, NULL, NULL, '[\"uploads\\/1777291398_homesale.jpg\"]', '2026-04-27 12:03:18'),
(22, 'Home Rent', 'house/home', 'sale', 12000.00, 0, 'this home are available for rent', 'Kurugodu', 'Badanahatti Road, near government high school', NULL, NULL, NULL, '[\"uploads\\/1777336953_homerent1.jpeg\"]', '2026-04-28 00:42:33'),
(24, 'Home Rent', 'house', 'sale', 9000.00, 0, 'hi', 'Kurugodu', 'Basapura Road, near gandi nagar', NULL, NULL, NULL, '[\"uploads\\/1777337669_homerent2.jpg\"]', '2026-04-28 00:54:29'),
(29, 'Home Rent', 'house', 'rent', 10000.00, 0, 'availabe', 'Kurugodu', 'Basapura Road, near urdu school ', NULL, NULL, NULL, '[\"uploads\\/1777339068_homesale.jpg\"]', '2026-04-28 01:17:48'),
(30, 'Home Rent', 'house', 'rent', 20000.00, 0, 'availabel', 'Kurugodu', 'Basapura Road, near kiran mechani shop', NULL, NULL, NULL, '[\"uploads\\/1777339518_homerent1.jpeg\"]', '2026-04-28 01:25:18'),
(31, 'Home sale', 'house', 'sale', 7000000.00, 20000, 'available', 'Ballari', 'Gandhi Nagar, near MG main road', NULL, NULL, NULL, '[\"uploads\\/1777339816_homesale.jpg\"]', '2026-04-28 01:30:16'),
(32, 'Home rent', 'house', 'rent', 10000.00, 0, 'available', 'Ballari', 'Gandhi Nagar, near nehru nagar', NULL, NULL, NULL, '[\"uploads\\/1777339993_homerent1.jpg\"]', '2026-04-28 01:33:13'),
(33, 'Home Rent', 'house', 'rent', 15000.00, 0, 'available', 'Ballari, Ballari, Gandhi Nagar, near sara ahmad manzil', '', NULL, NULL, NULL, '[\"uploads\\/1777340083_homerent2.jpg\"]', '2026-04-28 01:34:43'),
(34, 'Plot Sale', 'plot', 'sale', 4000000.00, 4000, 'available', 'Ballari, Ballari, Gandhi Nagar, near fatima noor hotel', '', NULL, NULL, NULL, '[\"uploads\\/1777340162_plot.jpg\"]', '2026-04-28 01:36:02'),
(35, 'Land Sale', 'plot', 'sale', 6000000.00, 10000, 'available', 'Ballari, Ballari, Gandhi Nagar, near arjun patel park', '', NULL, NULL, NULL, '[\"uploads\\/1777340256_land.jpg\"]', '2026-04-28 01:37:36'),
(36, 'Plot Sale', 'plot', 'sale', 5000000.00, 50000, 'best plot available', 'Ballari, Gandhi Nagar, near public park', '', NULL, NULL, NULL, '[\"uploads\\/1777367017_plot.jpg\"]', '2026-04-28 09:03:37'),
(37, 'Home Rent', 'house', 'rent', 20000.00, 0, 'best home for rent', 'Ballari,  Gandhi Nagar, near royal circle', '', NULL, NULL, NULL, '[\"uploads\\/1777367133_homerent2.jpg\"]', '2026-04-28 09:05:33'),
(38, 'Plot', 'plot', 'sale', 8000000.00, 10000, 'available plot', 'Ballari, Gandhi Nagar, near sungam circle SNL Mall', '', NULL, NULL, NULL, '[\"uploads\\/1777367965_plot.jpg\"]', '2026-04-28 09:19:25'),
(39, 'Home sale', 'house', 'sale', 3000000.00, 0, 'available properties', 'Ballari, Gandhi Nagar, near  govt hospital', '', NULL, NULL, NULL, '[\"uploads\\/1777368662_homesale.jpg\"]', '2026-04-28 09:31:02'),
(42, 'Home Rent', 'house', 'rent', 8000.00, 0, 'available properties', 'Ballari', 'Gandhi Nagar, near royal circle', NULL, NULL, NULL, '[\"uploads\\/1777371909_homerent1.jpg\"]', '2026-04-28 10:25:09'),
(43, 'Home Rent ', 'house', 'rent', 9000.00, 0, 'available properti', 'Ballari', 'Gandhi Nagar, near royal circle', NULL, NULL, NULL, '[\"uploads\\/1777372945_homerent2.jpg\"]', '2026-04-28 10:42:25'),
(44, 'Land sale', 'apartment', 'sale', 4000000.00, 0, 'available properties', 'Ballari', 'Gandhi Nagar, near nehru school', NULL, NULL, NULL, '[\"uploads\\/1777373184_land.jpg\"]', '2026-04-28 10:46:24'),
(45, 'Plot sale', 'plot', 'sale', 5000000.00, 4000, 'available', 'Ballari', 'Gandhi Nagar, near arjun medical store', NULL, NULL, NULL, '[\"uploads\\/1777373350_plot.jpg\"]', '2026-04-28 10:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `location_source` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `property` varchar(255) NOT NULL,
  `property_location` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `location_source`, `name`, `email`, `phone`, `address`, `property`, `property_location`, `source`, `message`, `created_at`) VALUES
(1, 'Ballari', 'hasen', 'hasen@gamail.com', '0987654321', NULL, 'yes ', NULL, 'social media', 'hi', '2026-04-25 07:57:37'),
(2, 'Ballari', 'sankar', 'sankar@gmail.com', '0987654321', NULL, 'Home Rent', NULL, 'instagram reels', 'sir give me the introduction of this properties', '2026-04-25 08:02:17'),
(3, 'Ballari', 'ali', 'ali@gamil.com', '0987654321', NULL, 'Plot', NULL, 'social media', 'sir', '2026-04-25 08:05:27'),
(4, 'Kampli', 'ammar', 'ammar@gmail.com', '0987654321', NULL, 'Plot', NULL, 'instagram reels', 'hi', '2026-04-25 08:11:43'),
(5, 'Kurugodu', 'hasen', 'hasen@gamail.com', '2345678912', NULL, 'Home Rent', NULL, 'instagram reels', 'sir give information of this properit', '2026-04-25 08:21:51'),
(6, 'Sandur', 'hasen', 'hasen@gamail.com', '0987654321', NULL, 'Plot', NULL, 'social media', 'hi', '2026-04-25 08:26:56'),
(7, 'Siruguppa', 'ammar', 'ammar@gmail.com', '1234567891', NULL, 'Plot', NULL, 'social media', 'hi', '2026-04-25 08:32:40'),
(8, 'Siruguppa', 'shanth kumar', 'shanth@gmail.com', '0987654321', NULL, 'Home Sale', NULL, 'social media', 'sir i intrested this propertie', '2026-04-25 08:44:27'),
(9, 'Siruguppa', 'ali ', 'ali@gamil.com', '0987654321', NULL, 'Plot', NULL, 'instagram reels', 'sir give me the information of this properties', '2026-04-26 10:55:30'),
(10, 'Siruguppa', 'hasen', 'hasen@gamail.com', '0987654321', 'hi', 'Plot', 'Government Hospital near', 'instagram reels', 'hi', '2026-04-26 11:15:42'),
(11, 'Siruguppa', 'amam', 'amam@gami.com', '0987654321', 'sirguppa', 'Home Rent', 'Ladkhan Masjid near', 'friends send this information', 'sir give me the full information of this properties', '2026-04-26 11:20:33'),
(12, 'Siruguppa', 'hasen', 'hasen@gamail.com', '0987654321', 'sirguppa', 'Home Sale', 'Siruguppa, Deshnur Rood', 'social media', 'sir i intreste explain me sir', '2026-04-26 12:41:19'),
(13, 'Kurugodu', 'hasen', 'hasen@gamail.com', '0987654321', 'kampli', 'Home Rent', 'Kurugodu, kurugodu near basva bavana', 'friends send this information', 'sir i intrested this propertes', '2026-04-27 10:01:24'),
(14, 'Ballari', 'Ramesh', 'ramesh@gmail.com', '1234567891', 'ballari', 'Land Sale', 'Ballari, Ballari, Ballari, Gandhi Nagar, near arjun patel park', 'friends send this information', 'sir you can give me the information about this propreties', '2026-04-28 01:43:43'),
(15, 'Ballari', 'Hasen Bashree', 'hasenbashree@gamail.com', '8088275778', 'Siruguppa', 'Plot sale', 'Ballari, Gandhi Nagar, near arjun medical store, Ballari', 'friends send this information', 'Sir You can give full information of this plot', '2026-04-28 11:37:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
