-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2021 at 09:09 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_laraval8`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(20) NOT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Seller','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','AdminVerification','Active','Deactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `aadharnumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pannumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gstumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` int(11) DEFAULT NULL,
  `verification_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `seller_id`, `fname`, `lname`, `phone`, `company`, `email`, `password`, `role`, `status`, `aadharnumber`, `pannumber`, `gstumber`, `city`, `state`, `zip`, `address`, `is_verified`, `verification_id`, `website`, `created_at`, `updated_at`) VALUES
(1, '', 'Khan Rayees', '', 0, NULL, 'admin@gmail.com', '$2y$10$quwdni6IEpcQ8h3Fsy30felBJlO1Vw3kpUdvYBBhoFT1DMv.drLH6', 'admin', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2021-01-15 21:27:18', '2021-05-27 11:30:57'),
(4, 'SELLER 967175748', 'Rayees', 'khan', 9876543298, 'Software', 'rayeesinfotech@gmail.com', '$2y$10$rJ6rmfeGtc9UBu8cwWauA.agSIyb4EdYwm2kQWrWVZfrXk7XBgQbS', 'Seller', 'Active', '9876549867', '8977798789', '986754986745', 'Tulsipur', 'Up', '226026', 'Lucknow', 1, '', 'khanrayees.com', '2021-06-09 01:39:29', '2021-06-09 01:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_home` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `is_home`, `seller_id`, `created_at`, `updated_at`) VALUES
(1, 'Levis', '1622351755.jpg', 'Active', 1, 1, '2021-05-29 23:45:56', '2021-05-29 23:49:35'),
(2, 'Tommy Hilfiger', '1622351844.jpg', 'Active', 1, 1, '2021-05-29 23:47:24', '2021-05-29 23:47:24'),
(3, 'Killer', '1622351909.jpg', 'Active', 1, 1, '2021-05-29 23:48:29', '2021-05-29 23:48:29'),
(4, 'Wrangler', '1622351962.jpg', 'Active', 1, 1, '2021-05-29 23:49:22', '2021-05-29 23:49:22'),
(5, 'Ladies Common Brand', '1622352085.png', 'Active', 1, 1, '2021-05-29 23:51:25', '2021-05-29 23:51:25'),
(6, 'Testing2', '1623345696.jpg', 'Deactivate', 0, 4, '2021-06-10 11:51:36', '2021-06-10 11:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` enum('Reg','Not-Reg') NOT NULL,
  `qty` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `user_type`, `qty`, `product_id`, `product_attr_id`, `added_on`) VALUES
(11, 662282083, 'Not-Reg', 1, 4, 11, '2021-06-21 01:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category_id` int(11) NOT NULL DEFAULT 0,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_home` int(11) NOT NULL,
  `status` enum('Active','InActive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `parent_category_id`, `category_image`, `is_home`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Men Fashion', 'menfashion', 0, '1622366130.jpg', 1, 'Active', '2021-05-27 11:41:43', '2021-05-30 03:45:30'),
(2, 'Women Fashion', 'Womenfashion', 1, '1622135632.png', 1, 'Active', '2021-05-27 11:43:52', '2021-05-27 11:43:52'),
(3, 'Men Disigner', 'mendesc', 1, '1622367921.jpg', 1, 'Active', '2021-05-30 04:15:21', '2021-05-30 04:15:21'),
(4, 'Women Watch', 'womenwtch', 2, '1622368111.jpg', 1, 'Active', '2021-05-30 04:18:31', '2021-05-30 04:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Deactivate') COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `status`, `seller_id`, `created_at`, `updated_at`) VALUES
(1, 'Red', 'Active', 1, '2021-05-29 23:36:00', '2021-05-29 23:36:00'),
(2, 'Blue', 'Active', 1, '2021-05-29 23:37:44', '2021-05-29 23:37:44'),
(3, 'Green', 'Active', 1, '2021-05-29 23:37:51', '2021-05-29 23:37:51'),
(4, 'Orange', 'Active', 1, '2021-05-29 23:37:58', '2021-05-29 23:38:06'),
(5, 'Black', 'Active', 1, '2021-05-29 23:38:18', '2021-05-29 23:38:18'),
(7, 'silver', 'Active', 1, '2021-05-29 23:39:20', '2021-05-29 23:39:20'),
(8, 'Pink', 'Active', 1, '2021-05-29 23:40:20', '2021-05-29 23:40:20'),
(9, 'GreenBlue', 'Active', 4, '2021-06-10 12:02:53', '2021-06-10 12:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_type` enum('Value','Percentage') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Value',
  `min_order_amnt` bigint(100) NOT NULL DEFAULT 0,
  `is_one_time` int(11) NOT NULL,
  `status` enum('Active','Deactivate') COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expirydate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `code`, `value`, `coupon_type`, `min_order_amnt`, `is_one_time`, `status`, `seller_id`, `created_at`, `updated_at`, `expirydate`) VALUES
(1, 'First50', 'first50', '50', 'Percentage', 1000, 0, 'Active', 1, '2021-06-04 20:06:47', NULL, '2021-06-24'),
(2, 'Firstorder', 'Firstorde', '15', 'Percentage', 1200, 0, 'Active', 4, '2021-06-10 11:57:35', '2021-06-10 11:57:35', '2021-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` int(11) NOT NULL COMMENT '''1'' => ''Verified'', ''0''=> ''Not Verified''',
  `rand_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_forgot_password` int(11) DEFAULT NULL COMMENT '''0''=> Not req frg ''1'' => req frg',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gstin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','DeActivate') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `password`, `is_verified`, `rand_id`, `is_forgot_password`, `address`, `city`, `state`, `zip`, `company`, `gstin`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Khan Rayees', 'rayeesinfo@gmail.com', '9554540271', 'eyJpdiI6IkpMRWppdStaLy8zaTRQTFZCTE9sNFE9PSIsInZhbHVlIjoiRFArSTRZdjZvSk9BYXZLRWozY2JnQT09IiwibWFjIjoiYjk4ZmVkNjMwMzhlOWIyMmY1Yjg1N2M1NzVmOTJlNGRiNDZjNDJlMjQzYWFiYzY3MTYzOWQ3MTU3NThhMjlmZiJ9', 1, '', 0, 'Lucknow', 'Lucknow', 'UP', '226026', NULL, NULL, 'Active', '2021-05-29 22:17:41', '2021-05-29 22:17:41'),
(3, 'ddddd', 'khan@gmail.com', '434334', 'eyJpdiI6InVOVnpKWTFmMUMydXVjZFBWYjJYa2c9PSIsInZhbHVlIjoiMjB4Q0U4eGwrRHVSMURocG82UDV3dz09IiwibWFjIjoiY2Y2YjdiYzZjZjczNDc4YTU4MjJiZGZjNTJhMThlN2UzMzI4ZjFhNTU1ZWZjMmY5Mjk4ZDIwYzJhNWY4YzI3ZCJ9', 1, '301247', 0, 'sss', 'lucknoww', 'up', '226026', NULL, NULL, 'Active', '2021-06-05 23:59:48', '2021-06-05 23:59:48'),
(4, 'Rayeess', 'rayees@gmail.com', '4343349087', 'eyJpdiI6IjFWQkFLUUR5UDRJbUVnVTFoenQ0aEE9PSIsInZhbHVlIjoiQTBIQTczemR0S0Exc0MyR0p1ZWlJQT09IiwibWFjIjoiM2E1YTQ2ZGY5YmZiYTMxOGFmNzc1YWJkZTIxNDk4MGM3ZjEwZjQ2NGQ2YjFkNDQ2ZGI5MzlkZTZkZDNmODgyZiJ9', 1, '492578', 0, 'Lucknonw', 'lucknoww', 'up', '226026', NULL, NULL, 'Active', '2021-06-06 00:11:42', '2021-06-06 00:11:42'),
(5, 'Rayeess', 'rayeesinfotech@gmail.com', '4343349087', 'eyJpdiI6IjlJN3JIQm4yMW54VkZkR04rZzJOS1E9PSIsInZhbHVlIjoiNkt1ZzJMdkpKcSswb1dOKzdYaHREQT09IiwibWFjIjoiNDMyZjc5ZjgyMzUzNDQ3Y2RlMWU4NjUyMzBlY2I4MTkyMjRhOWRmMGNkZWQ1YjcwOTRjYjE5MTQ2M2RiNWZiOCJ9', 1, '292424', 0, 'Lucknonw', 'lucknoww', 'up', '226026', NULL, NULL, 'Active', '2021-06-06 00:18:51', '2021-06-06 00:18:51'),
(6, 'Aasif khan', 'aasif@gmail.com', '8976542398', 'eyJpdiI6InlOQ0sxWUIyUkF4TC94d1R1VVo5U1E9PSIsInZhbHVlIjoiQm5YZWRNa09sUm9BWjhraW80TVFyZz09IiwibWFjIjoiZjkyZjIxODQyYmMzYTU4ZWFkNjdiMGEyNTZjN2Q4MDZkNjhmOTgzMTI2NTVmMGNmYThlMWM3ZmQ1Y2UxNjhlMSJ9', 1, '479007', 0, 'Home town', 'Tulsipur', 'up', '226026', NULL, NULL, 'Active', '2021-06-16 04:46:30', '2021-06-16 04:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_txt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_disc` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_banners`
--

INSERT INTO `home_banners` (`id`, `image`, `btn_txt`, `btn_link`, `btn_title`, `btn_disc`, `status`, `created_at`, `updated_at`) VALUES
(1, '1622359011.jpg', 'Sale', 'khanrayees.000webhostapp.com', 'E-Commerce Provider', 'E-Commerce Provider Solution', 'Active', '2021-05-30 01:46:51', '2021-05-30 01:46:51'),
(2, '1622359879.jpg', 'Sale', 'khanrayees.000webhostapp.com', 'E-Commerce Provider', 'E-Commerce Provider Solution', 'Active', '2021-05-30 02:01:19', '2021-05-30 02:01:19'),
(4, '1622363174.jpg', 'Sale', 'khanrayees.000webhostapp.com', 'E-Commerce Provider', 'E-Commerce Provider Solution', 'Active', '2021-05-30 02:56:14', '2021-05-30 02:56:14'),
(5, '1622363209.jpg', 'Sale', 'khanrayees.000webhostapp.com', 'E-Commerce Provider', 'E-Commerce Provider Solution', 'Active', '2021-05-30 02:56:49', '2021-05-30 02:56:49'),
(6, '1622363228.jpg', 'Sale', 'khanrayees.000webhostapp.com', 'E-Commerce Provider', 'E-Commerce Provider Solution', 'Active', '2021-05-30 02:57:08', '2021-05-30 02:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_01_15_211334_create_admins_table', 1),
(4, '2021_01_15_215552_create_categories_table', 2),
(5, '2021_01_20_095632_create_coupons_table', 3),
(10, '2021_01_21_115714_create_ajaxes_table', 4),
(12, '2021_01_26_021550_create_sizes_table', 5),
(13, '2021_01_26_023140_create_colors_table', 6),
(14, '2021_01_28_104722_create_products_table', 7),
(15, '2021_02_03_114909_create_brands_table', 8),
(16, '2021_02_05_082218_create_taxes_table', 9),
(17, '2021_02_08_081113_create_customers_table', 10),
(18, '2021_02_17_200040_create_home_banners_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(100) DEFAULT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `coupon_value` varchar(100) NOT NULL DEFAULT '0',
  `order_status` enum('Pending','Shipped','On the way','Placed','Dispatched','Deliverd','Cancel') NOT NULL,
  `payment_type` enum('COD','Gateway') DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `total_amount` varchar(100) NOT NULL,
  `track_details` text DEFAULT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customers_id`, `order_id`, `name`, `email`, `mobile`, `address`, `city`, `state`, `pincode`, `coupon_code`, `coupon_value`, `order_status`, `payment_type`, `payment_status`, `payment_id`, `txn_id`, `total_amount`, `track_details`, `added_on`) VALUES
(1, 1, '1715163', 'Khan Rayees', 'rayeesinfotech@gmail.com', 9554540271, 'Lucknow', 'Lucknow', 'UP', '226026', NULL, '0', 'Pending', 'Gateway', 'Pending', '825e889c7be1421b875521f6ad7e0c0a', NULL, '1800', '', '2021-06-05'),
(2, 1, '1017958', 'Khan Rayees', 'rayeesinfotech@gmail.com', 9554540271, 'Lucknow', 'Lucknow', 'UP', '226026', NULL, '0', 'Cancel', 'Gateway', 'Pending', NULL, '3205c1923a51439482986423bb948c78', '1800', '', '2021-06-05'),
(3, 1, '1992674', 'Khan Rayees', 'rayeesinfotech@gmail.com', 9554540271, 'Lucknow', 'Lucknow', 'UP', '226026', 'first50', '900', 'Placed', 'Gateway', 'Success', 'MOJO1605305A98788328', 'f555d71f701946c48b3135d3084fd915', '1800', 'Your order has been placed Successfully', '2021-06-05'),
(4, 1, '1108733', 'Khan Rayees', 'rayeesinfotech@gmail.com', 9554540271, 'Lucknow', 'Lucknow', 'UP', '226026', NULL, '0', 'Cancel', 'Gateway', 'Success', 'MOJO1605N05A98788331', '245fe739afb24feab436d236bec021c8', '1800', '', '2021-06-05'),
(5, 1, '1376622', 'Khan Rayees', 'rayeesinfotech@gmail.com', 9554540271, 'Lucknow', 'Lucknow', 'UP', '226026', 'first50', '900', 'Pending', 'Gateway', 'Success', 'MOJO1605N05A98788335', '182853829ec947d39088aa171e8de959', '1800', '', '2021-06-05'),
(6, 3, '1032052', 'ddddd', 'rayeesinfotech2@gmail.com', 434334, 'sss', 'lucknoww', 'up', '226026', NULL, '0', 'Pending', 'COD', 'Pending', NULL, NULL, '1000', '', '2021-06-06'),
(7, 4, '2035553', 'Rayeess', 'rayeesinfotech@gmail.com', 4343349087, 'Lucknonw', 'lucknoww', 'up', '226026', NULL, '0', 'Pending', 'COD', 'Pending', NULL, NULL, '800', '', '2021-06-06'),
(8, 5, '1430811', 'Rayeess', 'rayeesinfotech@gmail.com', 4343349087, 'Lucknonw', 'lucknoww', 'up', '226026', NULL, '0', 'Pending', 'Gateway', 'Success', 'MOJO1606505A67701277', '3cc844e37e6648cbb6d5c9694816a2aa', '1800', '', '2021-06-06'),
(9, 1, '1249002', 'Khan Rayees', 'rayeesinfo@gmail.com', 9554540271, 'Lucknow', 'Lucknow', 'UP', '226026', NULL, '0', 'Shipped', 'COD', 'Success', NULL, NULL, '3000', 'Product Forwword to corier', '2021-06-10'),
(10, 1, '2131309', 'Khan Rayees', 'rayeesinfo@gmail.com', 9554540271, 'Lucknow', 'Lucknow', 'UP', '226026', NULL, '0', 'Deliverd', 'COD', 'Success', NULL, NULL, '3000', NULL, '2021-06-10'),
(11, 1, '1111303', 'Khan Rayees', 'rayeesinfo@gmail.com', 9554540271, 'Lucknow', 'Lucknow', 'UP', '226026', 'first50', '2600', 'Pending', 'Gateway', 'Pending', NULL, '28e9a68e4b104a75b7529d52dcf8610d', '5200', NULL, '2021-06-15'),
(12, 6, '1178793', 'Aasif khan', 'aasif@gmail.com', 8976542398, 'Home town', 'Tulsipur', 'up', '226026', 'first50', '1500', 'Placed', 'Gateway', 'Success', 'MOJO1616705A66942592', 'e22d41fe9cee4125990c09ff7e2e007e', '3000', 'On the way', '2021-06-16'),
(13, 1, '2160737', 'Khan Rayees', 'rayeesinfo@gmail.com', 9554540271, 'Lucknow', 'Lucknow', 'UP', '226026', NULL, '0', 'Placed', 'COD', 'Pending', NULL, NULL, '9000', NULL, '2021-06-19'),
(14, 1, '1498370', 'Khan Rayees', 'rayeesinfo@gmail.com', 9554540271, 'Lucknow', 'Lucknow', 'UP', '226026', NULL, '0', 'On the way', 'COD', 'Pending', NULL, NULL, '1000', NULL, '2021-06-19'),
(15, 1, '1853330', 'Khan Rayees', 'rayeesinfo@gmail.com', 9554540271, 'Lucknow India 2', 'Lucknow Alkapuri', 'UP', '226026', NULL, '0', 'Placed', 'COD', 'Pending', NULL, NULL, '1000', 'Shipped to Delivery boy', '2021-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE `orders_status` (
  `id` int(11) NOT NULL,
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_status`
--

INSERT INTO `orders_status` (`id`, `order_status`) VALUES
(1, 'Pending'),
(2, 'Shipped'),
(3, 'On the way'),
(4, 'Placed'),
(5, 'Dispatched'),
(6, 'Deliverd'),
(7, 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `ret_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `products_attr_id` int(11) NOT NULL,
  `price` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `ret_order_id`, `product_id`, `products_attr_id`, `price`, `qty`) VALUES
(1, '1989025', 1, 4, 11, '1000', 1),
(2, '1989025', 1, 3, 7, '800', 9),
(3, '1989025', 1, 4, 11, '1000', 1),
(4, '1989025', 1, 3, 7, '800', 1),
(5, '2023114', 2, 4, 11, '1000', 1),
(6, '2023114', 2, 3, 7, '800', 9),
(7, '2023114', 2, 4, 11, '1000', 1),
(8, '2023114', 2, 3, 7, '800', 1),
(9, '944151', 3, 4, 11, '1000', 1),
(10, '944151', 3, 3, 7, '800', 1),
(11, '1897059', 4, 4, 11, '1000', 1),
(12, '1897059', 4, 3, 7, '800', 1),
(13, '1859175', 5, 3, 7, '800', 1),
(14, '1859175', 5, 4, 11, '1000', 1),
(15, '1981014', 6, 4, 11, '1000', 1),
(16, '1981014', 6, 3, 7, '800', 1),
(17, '1029905', 7, 4, 11, '1000', 1),
(18, '1029905', 7, 3, 7, '800', 1),
(19, '2206916', 8, 4, 11, '1000', 1),
(20, '2206916', 8, 3, 7, '800', 1),
(21, '1712571', 9, 4, 11, '1000', 1),
(22, '1712571', 9, 3, 7, '800', 1),
(23, '1715163', 1, 4, 11, '1000', 1),
(24, '1715163', 1, 3, 7, '800', 1),
(25, '1017958', 2, 4, 11, '1000', 1),
(26, '1017958', 2, 3, 7, '800', 1),
(27, '1992674', 3, 4, 11, '1000', 1),
(28, '1992674', 3, 3, 7, '800', 1),
(29, '1108733', 4, 4, 11, '1000', 1),
(30, '1108733', 4, 3, 7, '800', 1),
(31, '1376622', 5, 4, 11, '1000', 1),
(32, '1376622', 5, 3, 7, '800', 1),
(33, '1032052', 6, 4, 11, '1000', 1),
(34, '2035553', 7, 3, 7, '800', 1),
(35, '1430811', 8, 4, 11, '1000', 1),
(36, '1430811', 8, 3, 7, '800', 1),
(37, '1249002', 9, 7, 21, '3000', 1),
(38, '2131309', 10, 7, 21, '3000', 1),
(39, '1111303', 11, 1, 1, '1400', 1),
(40, '1111303', 11, 3, 7, '800', 1),
(41, '1111303', 11, 7, 21, '3000', 1),
(42, '1178793', 12, 7, 21, '3000', 1),
(43, '2160737', 13, 7, 21, '3000', 3),
(44, '1498370', 14, 4, 11, '1000', 1),
(45, '1853330', 15, 4, 11, '1000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `technical_specification` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uses` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warrenty` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `descreption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_promo` int(11) NOT NULL,
  `is_feature` int(11) NOT NULL,
  `is_discounted` int(11) NOT NULL,
  `is_tranding` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `image`, `slug`, `brand`, `model`, `short_desc`, `desc`, `keywords`, `technical_specification`, `uses`, `warrenty`, `lead_time`, `tax_id`, `descreption`, `is_promo`, `is_feature`, `is_discounted`, `is_tranding`, `status`, `seller_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Levis Jeans', '1622364658.jpg', 'levisjns', '1', 'Levis', 'Good Products', NULL, '32ed', NULL, 'Clothing', '1', '2-3 days', 1, '<p>Buy&nbsp;<em>LEVIS</em>&nbsp;Mens Solid&nbsp;<em>Short</em>&nbsp;online from Shoppers Stop. * Free Shipping * Cash on Delivery * Easy Returns * Order Online Now!</p>', 1, 1, 0, 1, 'Active', 1, '2021-05-30 00:21:06', '2021-05-30 03:20:58'),
(2, 2, 'Levis Tshurt Jeans', '1622363817.jpg', 'levisjns2', '1', 'Levis', 'Ladies Tshurt', NULL, '32ed', NULL, 'Clothing', '1', '2-3 days', 1, '<p>Ladies Tshurt</p>', 0, 0, 1, 1, 'Active', 1, '2021-05-30 03:06:57', '2021-05-30 03:06:57'),
(3, 1, 'Men Tshurt Levis', '1622364367.jpg', 'menlevis1', '1', 'Levis', 'Men Levis Tshurt', NULL, '32e222', NULL, 'Clothing', '1', '3-4 days', 1, '<p>Men Levis Tshurt</p>', 1, 1, 0, 1, 'Active', 1, '2021-05-30 03:16:07', '2021-05-30 03:16:07'),
(4, 1, 'Tommy Hilfiger Tshurt', '1622365177.jpg', 'tommy1', '2', 'Tommy', 'Tommy Hilfiger Tshurt', NULL, '32e22222', NULL, 'Clothing', '1', '1-2 days', 1, '<p>Tommy Hilfiger Tshurt</p>', 1, 1, 1, 1, 'Active', 1, '2021-05-30 03:29:37', '2021-05-30 03:29:37'),
(5, 2, 'Ladies Swetter', '1622365951.jpg', 'ladiesswet3', '2', 'Tommy33', 'Ladies Swetter', NULL, '32e222222', NULL, 'Clothing', '1', '3-4 days', 1, '<p>Ladies Swetter</p>', 1, 1, 1, 1, 'Active', 1, '2021-05-30 03:42:31', '2021-05-30 03:42:31'),
(6, 3, 'Men Watch', '1622400268.jpg', 'menwatch', '3', 'Men Watch', 'Men Watch', NULL, '32ed23344s', NULL, 'Watches', '1', '2-3 days', 1, '<p>Men Watch</p>', 0, 0, 0, 0, 'Active', 1, '2021-05-30 13:14:29', '2021-05-30 13:17:14'),
(7, 2, 'Ladies Kurti', '1623347116.jpg', 'ldieskurti', '5', 'Ladies kurti', 'Good Products for women', NULL, 'gdrcc', NULL, 'Wear Clothing', '2', '2-3 days', 1, '<p>Good Products for women</p>', 0, 0, 0, 0, 'Active', 4, '2021-06-10 12:15:16', '2021-06-10 12:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `products_attr`
--

CREATE TABLE `products_attr` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `attr_image` varchar(255) DEFAULT NULL,
  `mrp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_attr`
--

INSERT INTO `products_attr` (`id`, `products_id`, `sku`, `attr_image`, `mrp`, `price`, `qty`, `size_id`, `color_id`) VALUES
(1, 1, 'lev', '877295523.jpg', 1800, 1400, 20, 2, 2),
(2, 1, 'lev2', '140593466.jpg', 1800, 1400, 20, 3, 7),
(3, 1, 'lev3', '587952901.jpg', 1800, 1400, 20, 4, 5),
(4, 2, 'lad1', '804172934.jpg', 800, 500, 20, 2, 1),
(5, 2, 'lad2', '824208926.jpg', 800, 500, 20, 3, 5),
(6, 2, 'lad3', '848117772.jpg', 800, 500, 20, 4, 7),
(7, 3, 'lev23', '867283627.jpg', 1200, 800, 35, 1, 1),
(8, 3, 'lev34', '693945048.jpg', 1300, 900, 30, 3, 5),
(9, 3, 'lev234', '140271363.jpg', 1400, 1000, 25, 4, 7),
(10, 3, 'lev3455', '945735555.jpg', 1500, 1100, 35, 4, 2),
(11, 4, 'Tommy1', '276237012.jpg', 1200, 1000, 2, 3, 1),
(12, 4, 'tommy2', '911363575.jpg', 1300, 1100, 1, 4, 5),
(13, 4, 'Toomys22', '675518915.jpg', 1400, 1200, 1, 4, 7),
(14, 4, 'Tom23', '733224039.jpg', 1500, 1300, 1, 2, 2),
(15, 5, 'sweter1', '683714934.jpg', 2000, 1800, 20, 2, 1),
(16, 5, 'sweter2', '464368105.jpg', 2200, 1900, 3000, 3, 4),
(17, 5, 'sweter3', '198695300.jpg', 2400, 2000, 20, 4, 5),
(18, 6, 'mens321', '498848385.jpg', 1800, 1400, 20, 1, 5),
(19, 6, 'mesn43w', '594583325.jpg', 2200, 1900, 35, 2, 7),
(20, 6, 'mens23w', '596801303.jpg', 2500, 2000, 20, 3, 2),
(21, 7, 'Ldoeskurti', '393581235.jpg', 3500, 3000, 20, 1, 2),
(22, 7, 'Ldoeskurti1', '354473661.jpg', 3000, 2500, 18, 2, 7),
(23, 7, 'Ldoeskurt2', '819062368.jpg', 2800, 2400, 12, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `products_id`, `images`) VALUES
(1, 1, '659634569.jpg'),
(2, 1, '776262872.jpg'),
(3, 1, '567080942.jpg'),
(4, 1, '978116675.jpg'),
(5, 2, '438485525.jpg'),
(6, 2, '385992871.jpg'),
(7, 2, '981028144.jpg'),
(8, 2, '568466540.jpg'),
(9, 3, '909897558.jpg'),
(10, 3, '813125507.jpg'),
(11, 3, '111958442.jpg'),
(12, 3, '927356821.jpg'),
(13, 4, '878001358.jpg'),
(14, 4, '950834549.jpg'),
(15, 4, '804974841.jpg'),
(16, 4, '713350225.jpg'),
(17, 5, '548278309.jpg'),
(18, 5, '162428984.jpg'),
(19, 5, '643606708.jpg'),
(20, 5, '651782245.jpg'),
(21, 6, '324842005.jpg'),
(22, 7, '477037558.jpg'),
(23, 7, '415244328.jpg'),
(24, 7, '283521002.jpg'),
(25, 7, '693339463.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `customer_id`, `product_id`, `rating`, `review`, `status`, `added_on`) VALUES
(1, 1, 4, 'Good', 'I like', 1, '2021-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Deactivate') COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `status`, `seller_id`, `created_at`, `updated_at`) VALUES
(1, 'XXL', 'Active', 0, '2021-01-25 20:56:46', '2021-05-29 23:31:23'),
(2, 'XL', 'Active', 0, '2021-02-24 00:58:04', '2021-02-24 00:58:04'),
(3, 'L', 'Active', 0, '2021-02-24 00:58:08', '2021-02-24 00:58:08'),
(4, 'M', 'Active', 0, '2021-02-24 00:58:13', '2021-02-24 00:58:13'),
(5, '36', 'Active', 4, '2021-06-10 12:00:33', '2021-06-10 12:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `tax_desc` varchar(255) NOT NULL,
  `tax_value` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `tax_desc`, `tax_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GST10.00%', '500', 'Active', '2021-05-30 05:33:04', '2021-05-30 00:03:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_attr`
--
ALTER TABLE `products_attr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `home_banners`
--
ALTER TABLE `home_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders_status`
--
ALTER TABLE `orders_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products_attr`
--
ALTER TABLE `products_attr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
