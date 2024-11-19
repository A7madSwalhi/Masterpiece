-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 12:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ec_masterpiece`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$tw5gtM82tjmS2eQAqdymAO2i5DrlV7oU2.rOxmG9RMt0OcGRtP00i', 'fqIGWafRck4DcVobwkdew5Po7lEb2fmLsikNlh2S5EfgPqdiE3jmkgT8yZJm', 'active', '2024-10-06 19:52:17', '2024-10-06 19:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','draft','inactive') NOT NULL DEFAULT 'active',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(64, 'canon', 'canon', 'brands/31dIvLOjF8A1a4Lw9KX2NddBesgH35Rmtxpt5A1M.png', 'active', 1, '2024-11-17 01:09:46', '2024-11-17 01:09:46'),
(65, 'dji', 'dji', 'brands/s9dlNz9v7oBvUfPBbfg0btS5PjFiQEFAPdwYSkny.png', 'active', 1, '2024-11-17 01:10:04', '2024-11-17 01:10:04'),
(66, 'gopro', 'gopro', 'brands/L60PxKpuz5K7kHvjXPhRwjwZgwmhqzWMcgMOQ7uf.png', 'active', 1, '2024-11-17 01:10:24', '2024-11-17 01:10:24'),
(67, 'lenovo', 'lenovo', 'brands/y701RRP65u1dWRZ8It5EG3JaWH4SYLSeHNHAMqQK.png', 'inactive', 1, '2024-11-17 01:10:46', '2024-11-17 06:56:43'),
(68, 'msi', 'msi', 'brands/5N9HC2MdSmgyCtpZ2coCtmgSGA3ZMsCiYJ2sPJbP.jpg', 'active', 1, '2024-11-17 01:11:02', '2024-11-17 01:11:02'),
(69, 'asus', 'asus', 'brands/3Kez7CUz2Xf9yG2x0Qfw2E6nOXdIofC5gB6MzAKW.png', 'active', 1, '2024-11-17 01:11:21', '2024-11-17 01:11:21'),
(70, 'H&M', 'hm', 'brands/owHsCaS6CLrj1PiYvzJn1l0fGEVpQuh5zP0K54VJ.png', 'active', 1, '2024-11-17 01:11:43', '2024-11-17 01:11:43'),
(71, 'zara', 'zara', 'brands/1v5LdqeeCIRymlLYe6tzeflnXiuVH0iChI0zrl2w.png', 'active', 1, '2024-11-17 01:12:01', '2024-11-17 01:12:01'),
(72, 'Rolex', 'rolex', 'brands/4qor0urOYQJjTVd8twxdFzIpjoY6nY2FAWHHFWXK.png', 'active', 1, '2024-11-17 01:29:03', '2024-11-17 01:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` char(36) NOT NULL,
  `cookie_id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `description`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(16, NULL, 'Electronics', NULL, 'electronics', NULL, 'active', '2024-11-17 01:13:05', '2024-11-17 01:13:05'),
(17, NULL, 'Fasion', NULL, 'fasion', NULL, 'active', '2024-11-17 01:14:33', '2024-11-17 01:14:33'),
(18, NULL, 'Home & Furniture', NULL, 'home-furniture', NULL, 'active', '2024-11-17 01:16:30', '2024-11-17 01:16:30'),
(19, NULL, 'Health & Beauty', NULL, 'health-beauty', NULL, 'active', '2024-11-17 01:16:58', '2024-11-17 01:16:58'),
(20, NULL, 'Books & Media', NULL, 'books-media', NULL, 'active', '2024-11-17 01:17:15', '2024-11-17 01:17:15'),
(21, NULL, 'Sports & Outdoors', NULL, 'sports-outdoors', NULL, 'active', '2024-11-17 01:17:45', '2024-11-17 01:17:45'),
(22, NULL, 'Toys & Games', NULL, 'toys-games', NULL, 'active', '2024-11-17 01:18:03', '2024-11-17 01:18:03'),
(23, NULL, 'Jewelry & Watches', NULL, 'jewelry-watches', NULL, 'active', '2024-11-17 01:18:27', '2024-11-17 01:18:27'),
(24, 16, 'Phones', NULL, 'phones', NULL, 'active', '2024-11-17 01:18:51', '2024-11-17 01:18:51'),
(25, 16, 'Laptops', NULL, 'laptops', NULL, 'active', '2024-11-17 01:19:07', '2024-11-17 01:19:31'),
(26, 16, 'Computers', NULL, 'computers', NULL, 'active', '2024-11-17 01:19:39', '2024-11-17 01:19:39'),
(27, 16, 'Tablets', NULL, 'tablets', NULL, 'active', '2024-11-17 01:19:55', '2024-11-17 01:19:55'),
(28, 16, 'Televisions', NULL, 'televisions', NULL, 'active', '2024-11-17 01:20:21', '2024-11-17 01:20:21'),
(29, 16, 'Cameras', NULL, 'cameras', NULL, 'active', '2024-11-17 01:20:37', '2024-11-17 01:20:37'),
(30, 16, 'Gaming Consoles', NULL, 'gaming-consoles', NULL, 'active', '2024-11-17 01:21:06', '2024-11-17 01:21:06'),
(31, 16, 'Headphones', NULL, 'headphones', NULL, 'active', '2024-11-17 01:21:19', '2024-11-17 01:21:19'),
(32, 17, 'Men’s Clothing', NULL, 'mens-clothing', NULL, 'active', '2024-11-17 01:21:47', '2024-11-17 01:21:47'),
(33, 17, 'Women’s Clothing', NULL, 'womens-clothing', NULL, 'active', '2024-11-17 01:22:01', '2024-11-17 01:22:01'),
(34, 17, 'Shoes', NULL, 'shoes', NULL, 'active', '2024-11-17 01:22:19', '2024-11-17 01:22:19'),
(35, 18, 'Furniture', NULL, 'furniture', NULL, 'active', '2024-11-17 01:23:19', '2024-11-17 01:23:19'),
(36, 18, 'Tables', NULL, 'tables', NULL, 'active', '2024-11-17 01:23:49', '2024-11-17 01:23:49'),
(37, 18, 'Sofas', NULL, 'sofas', NULL, 'active', '2024-11-17 01:24:03', '2024-11-17 01:24:03'),
(38, 19, 'Skincare', NULL, 'skincare', NULL, 'active', '2024-11-17 01:24:29', '2024-11-17 01:24:29'),
(39, 19, 'Makeup', NULL, 'makeup', NULL, 'inactive', '2024-11-17 01:24:52', '2024-11-17 01:24:52'),
(40, 21, 'Balls', NULL, 'balls', NULL, 'inactive', '2024-11-17 01:25:36', '2024-11-17 01:25:36'),
(41, 21, 'Bicycles', NULL, 'bicycles', NULL, 'inactive', '2024-11-17 01:26:03', '2024-11-17 01:26:03'),
(42, 23, 'Watches', NULL, 'watches', NULL, 'active', '2024-11-17 01:28:09', '2024-11-17 01:28:09'),
(43, 23, 'Rings', NULL, 'rings', NULL, 'active', '2024-11-17 01:28:37', '2024-11-17 01:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount` double(8,2) NOT NULL,
  `validity` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `discount`, `validity`, `status`, `created_at`, `updated_at`) VALUES
(3, 'dis25', 0.25, '2025-01-01', 1, '2024-11-17 06:18:39', '2024-11-17 06:18:39'),
(4, 'RIO10', 0.10, '2025-02-02', 1, '2024-11-17 06:19:21', '2024-11-17 06:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_06_201125_create_admins_table', 1),
(6, '2024_10_06_201141_create_vendors_table', 1),
(7, '2024_10_07_165500_create_categories_table', 2),
(9, '2024_10_07_164703_create_brands_table', 3),
(10, '2024_10_07_165605_create_products_table', 4),
(11, '2024_10_09_200841_create_product_gallaries_table', 5),
(12, '2024_10_10_024435_create_tags_table', 6),
(13, '2024_10_10_024658_create_products_tag_table', 6),
(15, '2024_10_14_010014_create_profiles_table', 7),
(16, '2024_10_15_145547_create_product_reviews_table', 8),
(21, '2024_10_14_125258_create_coupons_table', 9),
(22, '2024_10_15_163328_create_carts_table', 10),
(23, '2024_10_23_215716_create_orders_table', 11),
(24, '2024_10_23_222740_create_order_items_table', 11),
(25, '2024_10_23_223647_create_order_addresses_table', 11),
(26, '2024_10_26_181434_create_payments_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` enum('pending','confirmed','processing','delivering','completed','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `shipping` double(8,2) NOT NULL DEFAULT 0.00,
  `tax` double(8,2) NOT NULL DEFAULT 0.00,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `total` double(8,2) NOT NULL DEFAULT 0.00,
  `curreny` varchar(3) NOT NULL DEFAULT 'jod',
  `coupon` varchar(255) DEFAULT NULL,
  `confirmed_date` timestamp NULL DEFAULT NULL,
  `processing_date` timestamp NULL DEFAULT NULL,
  `shipped_date` timestamp NULL DEFAULT NULL,
  `delivered_date` timestamp NULL DEFAULT NULL,
  `cancel_date` timestamp NULL DEFAULT NULL,
  `refunded_date` timestamp NULL DEFAULT NULL,
  `refunded_reason` text DEFAULT NULL,
  `refunded_status` enum('pending','rejected','accepted') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `invoice_no`, `payment_method`, `status`, `payment_status`, `shipping`, `tax`, `discount`, `total`, `curreny`, `coupon`, `confirmed_date`, `processing_date`, `shipped_date`, `delivered_date`, `cancel_date`, `refunded_date`, `refunded_reason`, `refunded_status`, `created_at`, `updated_at`) VALUES
(46, NULL, '20240001', 'cod', 'confirmed', 'pending', 0.00, 0.00, 24.90, 249.00, 'jod', 'RIO10', '2024-11-17 07:06:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-17 06:20:19', '2024-11-17 07:06:11'),
(47, 4, '20240002', 'cod', 'refunded', 'pending', 0.00, 0.00, 93.70, 937.00, 'jod', 'RIO10', NULL, NULL, NULL, NULL, '2024-11-17 07:15:15', '2024-11-17 07:15:55', 'shdbasd', NULL, '2024-11-17 06:50:18', '2024-11-17 07:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_addresses`
--

CREATE TABLE `order_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('billing','shipping') NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` char(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_addresses`
--

INSERT INTO `order_addresses` (`id`, `order_id`, `type`, `first_name`, `last_name`, `email`, `phone_number`, `street_address`, `apartment`, `city`, `postal_code`, `state`, `country`, `created_at`, `updated_at`) VALUES
(1, 46, 'billing', 'Ahmad', 'alsawalhi', 'noor@gmail.com', '0777958210', 'Queen Rania 127', 'B125', 'Amman', '196632', 'Tlaa Alali', 'JO', NULL, NULL),
(2, 46, 'shipping', 'Ahmad', 'alsawalhi', 'noor@gmail.com', '0777958210', 'Queen Rania 127', 'B125', 'Amman', '196632', 'Tlaa Alali', 'JO', NULL, NULL),
(3, 47, 'billing', 'ahmad', 'swalhi', 'asjdnbk@gma.com', '0788895911', 'street qarjat', 'c/176', 'alplqa', '19381', 'alpqaa', 'JO', NULL, NULL),
(4, 47, 'shipping', 'ahmad', 'swalhi', 'asjdnbk@gma.com', '0788895911', 'street qarjat', 'c/176', 'alplqa', '19381', 'alpqaa', 'JO', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `process_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `vendor_id`, `product_name`, `price`, `quantity`, `options`, `process_status`, `created_at`, `updated_at`) VALUES
(1, 46, 127, 10, 'Samsung Galaxy Watch 6', 249.00, 1, NULL, 0, NULL, NULL),
(2, 47, 131, 13, 'Dyson Supersonic Hair Dryer', 350.00, 1, NULL, 0, NULL, NULL),
(3, 47, 124, 11, 'Electronics Black Wrist Watch', 40.00, 1, NULL, 0, NULL, NULL),
(4, 47, 129, 11, 'Nike Air Zoom Running Shoes', 99.00, 2, NULL, 0, NULL, NULL),
(5, 47, 128, 10, 'Sony WH-1000XM5 Headphones', 349.00, 1, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `currency` char(3) NOT NULL DEFAULT 'JOD',
  `method` varchar(255) NOT NULL,
  `status` enum('pending','completed','failed','canceled') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `transaction_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`transaction_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `amount`, `currency`, `method`, `status`, `transaction_id`, `transaction_data`, `created_at`, `updated_at`) VALUES
(26, 46, 316.00, 'usd', 'stripe', 'pending', 'pi_3QM1r2BhY2hUBjcN0oTDUq7j', '{\"id\":\"pi_3QM1r2BhY2hUBjcN0oTDUq7j\",\"object\":\"payment_intent\",\"amount\":316,\"amount_capturable\":0,\"amount_details\":{\"tip\":[]},\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"automatic_payment_methods\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic_async\",\"client_secret\":\"pi_3QM1r2BhY2hUBjcN0oTDUq7j_secret_vKjISyrDGHYPfTSSzmfxsMcDq\",\"confirmation_method\":\"automatic\",\"created\":1731824464,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"latest_charge\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"mandate_options\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"processing\":null,\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', '2024-11-17 06:21:08', '2024-11-17 06:21:08'),
(27, 46, 316.00, 'usd', 'stripe', 'pending', 'pi_3QM1rZBhY2hUBjcN00teHbsX', '{\"id\":\"pi_3QM1rZBhY2hUBjcN00teHbsX\",\"object\":\"payment_intent\",\"amount\":316,\"amount_capturable\":0,\"amount_details\":{\"tip\":[]},\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"automatic_payment_methods\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic_async\",\"client_secret\":\"pi_3QM1rZBhY2hUBjcN00teHbsX_secret_T0qIxwitVZ03YTy7o2eaqGD6v\",\"confirmation_method\":\"automatic\",\"created\":1731824497,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"latest_charge\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"mandate_options\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"processing\":null,\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', '2024-11-17 06:21:37', '2024-11-17 06:21:37'),
(28, 47, 1189.00, 'usd', 'stripe', 'pending', 'pi_3QM2JNBhY2hUBjcN0M6TFKFQ', '{\"id\":\"pi_3QM2JNBhY2hUBjcN0M6TFKFQ\",\"object\":\"payment_intent\",\"amount\":1189,\"amount_capturable\":0,\"amount_details\":{\"tip\":[]},\"amount_received\":0,\"application\":null,\"application_fee_amount\":null,\"automatic_payment_methods\":null,\"canceled_at\":null,\"cancellation_reason\":null,\"capture_method\":\"automatic_async\",\"client_secret\":\"pi_3QM2JNBhY2hUBjcN0M6TFKFQ_secret_YpCJQuuSNFdABsobMOtlk6y7T\",\"confirmation_method\":\"automatic\",\"created\":1731826221,\"currency\":\"usd\",\"customer\":null,\"description\":null,\"invoice\":null,\"last_payment_error\":null,\"latest_charge\":null,\"livemode\":false,\"metadata\":[],\"next_action\":null,\"on_behalf_of\":null,\"payment_method\":null,\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"installments\":null,\"mandate_options\":null,\"network\":null,\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"processing\":null,\"receipt_email\":null,\"review\":null,\"setup_future_usage\":null,\"shipping\":null,\"source\":null,\"statement_descriptor\":null,\"statement_descriptor_suffix\":null,\"status\":\"requires_payment_method\",\"transfer_data\":null,\"transfer_group\":null}', '2024-11-17 06:50:22', '2024-11-17 06:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `catetgory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `SKU` varchar(255) NOT NULL,
  `long_description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `regular_price` double(8,2) NOT NULL,
  `discount_price` double(8,2) DEFAULT NULL,
  `quantitiy` smallint(6) NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','draft','inactive') NOT NULL DEFAULT 'active',
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `vendor_id`, `catetgory_id`, `slug`, `SKU`, `long_description`, `short_description`, `regular_price`, `discount_price`, `quantitiy`, `options`, `image`, `status`, `brand_id`, `featured`, `created_at`, `updated_at`) VALUES
(118, 'ASUS ROG Strix G15 (2022) Gaming Laptop, 15” 16:10 FHD 144Hz.', 10, 16, 'asus-rog-strix-g15-2022-gaming-laptop-15-1610-fhd-144hz', 'ASUSROG', 'The ASUS RO Newest Katana 15 Gaming Laptop features a 15.6\" 144 Hz IPS display for smooth visuals, powered by an Intel Core i7 12650H processor (up to 4.7 GHz) and GeForce RTX 4070 graphics for high-performance gaming. With 16GB of RAM, a 1TB SSD for fast storage, and Wi-Fi 6 for enhanced connectivity, this laptop is designed for gamers and creators. The 4-zone RGB gaming keyboard adds a stylish touch, and it comes pre-installed with Windows 11 Home for a modern experience.', 'About this item\r\nPOWER THROUGH ANYTHING​ – Powered by Windows 11, an AMD Ryzen 7 6800HS processor, and NVIDIA GeForce RTX 3050 Laptop GPU at 95W Max TGP, the G15 allows you to handle even the most demanding games with ease.\r\nBLAZING FAST MEMORY AND STORAGE – Multitask swiftly with 16GB of DDR5-4800MHz memory and speed up loading times with 512GB of PCIe 4x4.\r\nLIGHTNING FAST, CRYSTAL CLEAR DISPLAY – You can’t beat the enemy if you don’t see them coming. The G15 features a fast FHD 144Hz panel and Adaptive-Sync for a stellar gaming and viewing experience.\r\nROG INTELLIGENT COOLING – To put this amount of power in a gaming laptop, you need an even better cooling solution. The G15 features liquid metal on the CPU among other premium features, to allow for better sustained performance over long gaming sessions.\r\nMORE FPS WITH MUX SWITCH - A MUX Switch increases laptop gaming performance by routing frames directly to the display bypassing the iGPU.', 600.00, 580.00, 5, NULL, 'products/ubhzqp9pjsgQYllTu1oXW1gxpUIcyph8Zh064kNd.jpg', 'active', 69, 0, '2024-11-17 01:57:59', '2024-11-17 03:47:59'),
(119, 'MSI 2023 Newest Katana 15 Gaming Laptop.', 10, 25, 'msi-2023-newest-katana-15-gaming-laptop', 'aise8', '【 Operating System】 Experience the latest in operating systems with Windows 11 Home. Its user-friendly interface and enhanced features enhance your productivity and make navigating your tasks a breeze.', 'About this item\r\n【Graphics】 Immerse yourself in stunning visuals with the powerful NVIDIA GeForce RTX 4070 graphics card. Whether you\'re gaming, designing, or editing, this graphics card ensures smooth performance and breathtaking detail.\r\n【Processor】 Unleash unparalleled processing power with the 12th Generation Intel Core i7-12650H processor, clocked at 2.3GHz and capable of Turbo Boost speeds up to 4.7GHz. With 10 cores and 16 threads, accompanied by 24MB of cache, this processor intelligently allocates performance where it matters most. This optimization saves you valuable time and amplifies your capability to focus on the tasks that truly matter to you.\r\n【Upgraded】 Elevate your computing experience with up to 64GB of RAM, perfectly suited for both basic tasks and resource-intensive applications. The high-bandwidth DDR5 RAM ensures seamless multitasking, effortlessly handling numerous programs and files simultaneously. Store without limits. With storage capacities of up to 4TB, you\'ll never have to worry about running out of space. Safeguard all your files while enjoying the freedom to accumulate even more data.\r\n【Connectivity】 Stay connected at the forefront of technology with the Intel Wi-Fi 6 and Bluetooth 5.2 combo. Seamlessly integrate your devices through a variety of ports: 1 x USB 3.2 Gen 1 Type-C, 2 x USB 3.2 Gen 1 Type-A, 1 x USB 2.0, 1 x HDMI 2.1, 1 x RJ-45, and 1 x Headphone/Microphone Combo Jack.\r\n【 Operating System】 Experience the latest in operating systems with Windows 11 Home. Its user-friendly interface and enhanced features enhance your productivity and make navigating your tasks a breeze.', 900.00, 850.00, 10, NULL, 'products/ZrLsKd2qhknAJfgCstaf3LHX5QrfEcHjMiOdRNoi.jpg', 'active', 68, 0, '2024-11-17 02:01:40', '2024-11-17 03:49:52'),
(120, 'Beats Studio Pro -Black.', 10, 31, 'beats-studio-pro-black', 'asdq32', 'LOUD AND CLEAR - Voice-targeting mics precisely filter background noise for crisp, clear call performance', 'BEATS\' CUSTOM ACOUSTIC PLATFORM delivers rich, immersive sound whether you’re listening to music or taking calls.\r\nLOSSLESS AUDIO via USB-C plus three distinct built-in sound profiles to enhance your listening experience\r\nHEAR WHAT YOU WANT with two distinct listening modes: fully-adaptive Active Noise Cancelling (ANC) and Transparency mode\r\nENHANCED COMPATIBILITY with one-touch pairing and a robust set of native Apple and Android features\r\nPERSONALIZED SPATIAL AUDIO with dynamic head tracking place you at the center of an immersive 360-degree listening experience\r\nLONGER LISTENING - Up to 40 hours total battery life. A 10-minute Fast Fuel charge provides up to 4 hours of additional playback.\r\nLOUD AND CLEAR - Voice-targeting mics precisely filter background noise for crisp, clear call performance', 120.00, 110.00, 15, NULL, 'products/4c0UwxqauocGcBAjoDV2S0VVbNeKUierChLONXDV.jpg', 'active', NULL, 0, '2024-11-17 02:05:04', '2024-11-17 03:57:21'),
(121, 'Soundcore Anker Life Q20.', 10, 31, 'soundcore-anker-life-q20', 'aise82582', 'Hi-Res Audio: Custom oversized 40 mm dynamic drivers produce Hi-Res sound. Life Q20 active noise canceling headphones reproduce music with extended high frequencies that reach up to 40 kHz for extraordinary clarity and detail.', 'ncredible Sound Loved by 20 Million+ People\r\nHi-Res Audio: Custom oversized 40 mm dynamic drivers produce Hi-Res sound. Life Q20 active noise canceling headphones reproduce music with extended high frequencies that reach up to 40 kHz for extraordinary clarity and detail.\r\nReduce Ambient Noises By Up to 90%: Our team of engineers conducted more than 100,000 tests in real-life scenarios to fine-tune Life Q20’s 4 built-in ANC microphones and digital active noise cancellation algorithm. As a result, the hybrid active noise cancellation can detect and cancel out a wider range of low and mid-frequency noises such as cars and airplane engines.\r\n100% Stronger Bass: Our exclusive BassUp technology conducts real-time analysis of the low frequencies to instantly strengthen the bass output. Double press the play button when listening to bass-heavy genres like EDM and hip-hop for an amplified listening experience.\r\n60-Hour Playtime*: Up to 40 hours of non-stop playtime in wireless active noise cancellation mode (at 60% volume) is extended to an enormous 60 hours in standard music mode. A single charge gives you enough juice to listen to over 600 songs or soundtrack multiple long haul flights. And when you’re in a rush, charge Life Q20 active noise canceling headphones for 5 minutes and get 4 hours of listening.\r\nWhat\'s in the box: soundcore Life Q20 x1; USB-C Cable x1; AUX Cable x1; Travel Pouch x1.', 40.00, 0.00, 20, NULL, 'products/I3IB9WOIsnmqTVT8HjYE8nSVY7oB5TLGQNBC7XrL.jpg', 'active', NULL, 0, '2024-11-17 02:07:56', '2024-11-17 03:54:18'),
(122, 'Raycon Fitness Bluetooth (Blue)', 10, 31, 'raycon-fitness-bluetooth-blue', 'w332d', 'DURABLE: IPX7 Water resistance technology so that you don\'t have to worry about a thing. In the rain, sweat, shine, whatever weather life throws at us, it doesn\'t matter - you can enjoy it all! (Disclaimer: Please do not submerge in water)', '🙌 DURABLE: IPX7 Water resistance technology so that you don\'t have to worry about a thing. In the rain, sweat, shine, whatever weather life throws at us, it doesn\'t matter - you can enjoy it all! (Disclaimer: Please do not submerge in water)\r\n🙌 DAY & NIGHT: Fully charged, your earbuds will last you day in and day out, with 56 hours of battery total in the charging capsule. Your earbuds will last you to the very last rep, and motivate you while you silently work your way to the top.\r\n🙌 CLEAR VOICE: The earbuds have Active Noise Cancellation (ANC) and awareness modes so that you can talk to your friends, family and colleagues. Anywhere and everywhere, you can speak freely and be heard with our clear voice mode. Awareness mode so that you can hear what\'s going on around you while still enjoying the soundtrack of your life!\r\n🙌 TAILORED FIT: No more worrying that your earbuds will fall out! With four additional gel tips and ear stabilizers, you don\'t have to worry at all.These comfortable fitness earbuds will stay in your ear and with you through the hardest treks - climb toward success and progression with your Raycons! These are small, comfortable, cordless, and an essential to add to your daily routine.\r\n🙌 MULTIPOINT PAIRING | The Fitness Earbuds provide a significantly better overall sound quality and a better connection compared to our older models. Both earbuds can be used independently and they can be used together, thanks to its Bluetooth 5.3. You can even connect up to 2 devices at the same time.', 40.00, 0.00, 8, NULL, 'products/5FjfqIueyuGeI5vf8eEPynJLfA6PePWs2pfdtRUR.jpg', 'active', NULL, 1, '2024-11-17 02:10:08', '2024-11-17 03:55:03'),
(123, 'Apple AirPods Max Wireless Over– Silver', 10, 31, 'apple-airpods-max-wireless-over-silver', '3w2e', 'BREATHTAKING AUDIO QUALITY — Apple-designed dynamic driver provides high-fidelity audio. Computational audio combines custom acoustic design with the Apple H1 chip and software for breakthrough listening experiences.', 'BREATHTAKING AUDIO QUALITY — Apple-designed dynamic driver provides high-fidelity audio. Computational audio combines custom acoustic design with the Apple H1 chip and software for breakthrough listening experiences.\r\nFOCUS ON WHAT’S PLAYING — Active Noise Cancellation blocks outside noise so you can immerse yourself in music.\r\nHEAR THE WORLD AROUND YOU — Transparency mode lets you hear and interact with the world around you.\r\nPERSONALIZED SPATIAL AUDIO — With sound that suits your unique ear shape along with dynamic head tracking, AirPods Max deliver an immersive listening experience that places sound all around you. You can also listen to select songs, shows, and movies in Dolby Atmos.\r\nACOUSTIC-FIRST DESIGN — Designed with a knit-mesh canopy and memory foam ear cushions for an exceptional over-ear fit that perfectly seals in sound.\r\nMAGICAL EXPERIENCE — Pair AirPods Max by simply placing them near your device and tapping Connect on your screen. AirPods Max pause audio when you take them off. And Automatic Switching makes listening between your iPhone, iPad, and Mac completely effortless.\r\nLONG BATTERY LIFE — Up to 20 hours of listening, movie watching, or talk time with Active Noise Cancellation and Personalized Spatial Audio enabled.', 250.00, 230.00, 5, NULL, 'products/hnD9guc3BRH7obXdlEoyxp0QprG6Fe4AJedFtikw.jpg', 'active', NULL, 1, '2024-11-17 02:12:03', '2024-11-17 03:56:03'),
(124, 'Electronics Black Wrist Watch', 11, 42, 'electronics-black-wrist-watch', 'aise8258', 'BREATHTAKING AUDIO QUALITY — Apple-designed dynamic driver provides high-fidelity audio. Computational audio combines custom acoustic design with the Apple H1 chip and software for breakthrough listening experiences.', 'BREATHTAKING AUDIO QUALITY — Apple-designed dynamic driver provides high-fidelity audio. Computational audio combines custom acoustic design with the Apple H1 chip and software for breakthrough listening experiences.\r\nFOCUS ON WHAT’S PLAYING — Active Noise Cancellation blocks outside noise so you can immerse yourself in music.\r\nHEAR THE WORLD AROUND YOU — Transparency mode lets you hear and interact with the world around you.\r\nPERSONALIZED SPATIAL AUDIO — With sound that suits your unique ear shape along with dynamic head tracking, AirPods Max deliver an immersive listening experience that places sound all around you. You can also listen to select songs, shows, and movies in Dolby Atmos.\r\nACOUSTIC-FIRST DESIGN — Designed with a knit-mesh canopy and memory foam ear cushions for an exceptional over-ear fit that perfectly seals in sound.\r\nMAGICAL EXPERIENCE — Pair AirPods Max by simply placing them near your device and tapping Connect on your screen. AirPods Max pause audio when you take them off. And Automatic Switching makes listening between your iPhone, iPad, and Mac completely effortless.\r\nLONG BATTERY LIFE — Up to 20 hours of listening, movie watching, or talk time with Active Noise Cancellation and Personalized Spatial Audio enabled.', 40.00, NULL, 20, NULL, 'products/xSyJJ1cvljnfTgL3njYQQFGdwkOI2rpEVBWdpbSa.jpg', 'active', NULL, 1, '2024-11-17 02:27:29', '2024-11-17 02:27:29'),
(125, 'UMIDIGI Rugged Unlocked Cell Phones.', 10, 24, 'umidigi-rugged-unlocked-cell-phones', 'dvsdf343', 'Extreme durability: Military standards MIL-STD-810G, the rugged smartphone unlocked can withstand extreme temperatures below 80℃, 1.8m fall, and 1.5 meters of water for 30 minutes.', 'Extreme durability: Military standards MIL-STD-810G, the rugged smartphone unlocked can withstand extreme temperatures below 80℃, 1.8m fall, and 1.5 meters of water for 30 minutes.\r\nMulti-functions for outdoor: wireless FM radio, customized water camera mode, barometer, Enhanced Antennas & Navigation System, various outdoor tools, all these function are packed in one phone. Gloves mode, you can wear the gloves to use the phone.\r\nNFC Google Pay& Android 11: NFC google pay& android 11, Noise canceling dual microphone, Rugged android phone unlocked bring you convenient and easy lifestyle.\r\nTwo customized programmed button: PTT/SOS, underwater camera. One step access to the program.\r\nDual 4G VoLTE &Unlocked: Unlocked android smartphone supports 30 global bands and Dual SIM 4G LTE. It is compatible with most of the GSM and CDMA carriers. If it is NOT compatible with your carrier , please click your order and send us a message.', 100.00, NULL, 12, NULL, 'products/j4I2WDFML1m4prZ0ca1rw64VGoceZLlWN3gldAdU.jpg', 'active', NULL, 0, '2024-11-17 02:36:20', '2024-11-17 03:56:29'),
(127, 'Samsung Galaxy Watch 6', 10, 16, 'samsung-galaxy-watch-6', 'ELEC-001', 'The latest Samsung Galaxy Watch 6 offers advanced health tracking, GPS, and a sleek design perfect for all-day wear. It’s equipped with powerful sensors to monitor your heart rate, steps, and sleep patterns.', 'Advanced smartwatch with health tracking.', 299.00, 249.00, 50, NULL, 'products/yWaWESONuUQLGuwSDx4SfIt7c11rRtgItSOMPRXS.jpg', 'active', NULL, 1, '2024-11-17 03:22:21', '2024-11-17 03:30:45'),
(128, 'Sony WH-1000XM5 Headphones', 10, 31, 'sony-wh-1000xm5-headphones', 'ELEC-002', 'Experience unmatched noise cancellation with Sony’s WH-1000XM5. These over-ear headphones offer up to 30 hours of battery life and superior sound quality with deep bass and clear highs.', 'Premium noise-canceling headphones.', 349.00, NULL, 30, NULL, 'products/PKoUUBHVvzOd285aKuZKFXiNQwd4fDx61dLo57cS.jpg', 'active', NULL, 0, '2024-11-17 03:22:21', '2024-11-17 03:32:44'),
(129, 'Nike Air Zoom Running Shoes', 11, 34, 'nike-air-zoom-running-shoes', 'FASH-001', 'Lightweight and durable, Nike Air Zoom shoes are perfect for running. With breathable mesh and cushioned soles, they provide comfort for long distances.', 'Breathable running shoes for athletes.', 120.00, 99.00, 40, '\"{\\n    \\\"colors\\\": [\\n        \\\"red\\\",\\n        \\\"black\\\",\\n        \\\"yello\\\"\\n    ],\\n    \\\"sizes\\\": [\\n        \\\"43\\\",\\n        \\\"44\\\",\\n        \\\"45\\\"\\n    ]\\n}\"', 'products/LJM1fc9PYvk8bS1s4MVNHeRGZOjn8SUT1ihQhKxe.jpg', 'active', NULL, 1, '2024-11-17 03:22:21', '2024-11-17 03:34:27'),
(130, 'Adidas Originals Hoodie', 11, 32, 'adidas-originals-hoodie', 'FASH-002', 'Comfortable and stylish, the Adidas Originals hoodie is made with soft fleece fabric to keep you warm during chilly days. Features the classic 3-stripe design.', 'Casual wear hoodie for comfort.', 75.00, NULL, 60, '\"{\\n    \\\"colors\\\": [\\n        \\\"black\\\",\\n        \\\"blue\\\",\\n        \\\"red\\\"\\n    ],\\n    \\\"sizes\\\": [\\n        \\\"X\\\",\\n        \\\"Xl\\\",\\n        \\\"Md\\\",\\n        \\\"Sm\\\"\\n    ]\\n}\"', 'products/C0a6rHlVcqWPRSWaf1AcDuxNbLyc5hXuEsJN3MCL.jpg', 'active', NULL, 0, '2024-11-17 03:22:21', '2024-11-17 03:36:00'),
(131, 'Dyson Supersonic Hair Dryer', 13, 19, 'dyson-supersonic-hair-dryer', 'BEAUTY-001', 'The Dyson Supersonic Hair Dryer is engineered to protect hair from extreme heat damage, with fast drying and controlled styling. Ideal for all hair types.', 'Powerful hair dryer with heat control.', 399.00, 350.00, 25, NULL, 'products/xVURUSE5PbRq14lOrr7qHSroCGEw8u8S9xLet0UG.jpg', 'active', NULL, 1, '2024-11-17 03:22:21', '2024-11-17 03:41:51'),
(132, 'Maybelline Waterproof Eyeliner', 13, 19, 'maybelline-waterproof-eyeliner', 'BEAUTY-002', 'Achieve bold and precise lines with Maybelline’s waterproof eyeliner. Long-lasting formula that won’t smudge or fade, perfect for all-day wear.', 'Long-lasting waterproof eyeliner.', 12.00, 10.00, 100, NULL, 'products/Dy9F1qmM37PUadhBfR6M6x2MaJByorLLyX7OAJg5.jpg', 'active', NULL, 0, '2024-11-17 03:22:21', '2024-11-17 03:44:19'),
(133, 'IKEA LACK Coffee Table', 12, 18, 'ikea-lack-coffee-table', 'HOME-001', 'The IKEA LACK coffee table is a modern and minimalist piece that fits any living room. It’s lightweight and easy to move, making it perfect for small spaces.', 'Minimalist coffee table.', 49.00, 45.00, 70, NULL, 'products/i3HOSW4IFIDqcg5RvMUMIcV1y15TvVeXF2XKJ1BL.jpg', 'active', NULL, 0, '2024-11-17 03:22:21', '2024-11-17 03:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `products_tag`
--

CREATE TABLE `products_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_tag`
--

INSERT INTO `products_tag` (`id`, `product_id`, `tag_id`) VALUES
(3, 118, 14),
(4, 119, 14),
(5, 120, 16),
(6, 121, 16),
(7, 122, 16),
(8, 123, 16),
(9, 124, 17),
(10, 125, 18),
(11, 127, 19),
(12, 128, 19),
(13, 129, 19),
(14, 130, 19),
(15, 131, 19),
(16, 132, 19),
(17, 133, 19);

-- --------------------------------------------------------

--
-- Table structure for table `product_gallaries`
--

CREATE TABLE `product_gallaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_gallaries`
--

INSERT INTO `product_gallaries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(2, 118, 'product_gallary/Nz7TTmtB17jlxZL7yj8G0RXsJFb3wrzqIRGfEw9P.png', '2024-11-17 01:57:59', '2024-11-17 07:01:41'),
(3, 118, 'product_gallary/kcf6IsdeUOobzZjPXE6zJjG17zerawg8ZYPyQoJ4.jpg', '2024-11-17 01:57:59', '2024-11-17 01:57:59'),
(4, 119, 'product_gallary/8Vqea75eB2SiOPoUpAzVYZJk2bb2D0LUdyt7wdus.jpg', '2024-11-17 02:01:40', '2024-11-17 02:01:40'),
(5, 119, 'product_gallary/0rGy8Ea3sCT8swzn41Ocw4bNGPvUCjtRcR33THg2.jpg', '2024-11-17 02:01:40', '2024-11-17 02:01:40'),
(6, 119, 'product_gallary/3ILaqY7Zw7Rlozi92rme627Qy98aLiSCBcHHN1xH.jpg', '2024-11-17 02:01:40', '2024-11-17 02:01:40'),
(7, 119, 'product_gallary/A944bBgK1aiEcVUE18l68WNy9QGzvBI7x3BZYQA6.jpg', '2024-11-17 02:01:40', '2024-11-17 02:01:40'),
(8, 119, 'product_gallary/B1S6WGByyrTLtg2w8ABF1kACERdGDaCnRT0AZTI2.jpg', '2024-11-17 02:01:40', '2024-11-17 02:01:40'),
(9, 120, 'product_gallary/KzPVR2dExkTvvKOoHK89znl34lCWtD4dOS8awi5h.jpg', '2024-11-17 02:05:04', '2024-11-17 02:05:04'),
(10, 120, 'product_gallary/rENeRXWBMvClEQf3i2Y5j1Eb68cLmeGtrpjJMXa7.jpg', '2024-11-17 02:05:04', '2024-11-17 02:05:04'),
(11, 120, 'product_gallary/YgYWzxGpEQtE9N8mtYzWKMTPVcaKzfx87KEZFhsS.jpg', '2024-11-17 02:05:04', '2024-11-17 02:05:04'),
(12, 121, 'product_gallary/urvlXNIEAQSbwKttT30lJoVvOaXgRmoVTOYWrHSP.jpg', '2024-11-17 02:07:56', '2024-11-17 02:07:56'),
(13, 121, 'product_gallary/8WQ3BwlPo7jXfTVuswFyua8TkAXZz1YRYSPd0zmP.jpg', '2024-11-17 02:07:56', '2024-11-17 02:07:56'),
(14, 121, 'product_gallary/Hb0sDuHsQ0Wpt3uxwm3C8IGFVLtGRjHBhCPZ9o9K.jpg', '2024-11-17 02:07:56', '2024-11-17 02:07:56'),
(15, 122, 'product_gallary/HTLXKPuM5Z0KFsjUMSxaL9NKG1T0y9iYIdFXXUci.jpg', '2024-11-17 02:10:08', '2024-11-17 02:10:08'),
(16, 122, 'product_gallary/8e94jqfNZCAAYx2L76T5hYjE43MUJz7YyqyivwHH.jpg', '2024-11-17 02:10:08', '2024-11-17 02:10:08'),
(17, 122, 'product_gallary/PPNlctYQsDzELzj9GvgaMoqPWCazbat4EPouoRH0.jpg', '2024-11-17 02:10:08', '2024-11-17 02:10:08'),
(18, 123, 'product_gallary/jdVhySZaaPJl2ziEsXZcGQffPfsDuRBdxOrx9Y7K.jpg', '2024-11-17 02:12:03', '2024-11-17 02:12:03'),
(19, 123, 'product_gallary/rrEYSZXsnjT3eDLkdZHbtj0HtOkQvq8kFdNyhrmB.jpg', '2024-11-17 02:12:03', '2024-11-17 02:12:03'),
(20, 123, 'product_gallary/Qtmgn6FhRUCbQTKwPqJF4R0qIKV91fxETU29wjcV.jpg', '2024-11-17 02:12:03', '2024-11-17 02:12:03'),
(21, 124, 'product_gallary/kiqWsVJcbCeXoy8qhtDAuUiErMLfwUgsfo0z3Z8s.jpg', '2024-11-17 02:27:29', '2024-11-17 02:27:29'),
(22, 124, 'product_gallary/iIysyleu4wBcESAkQWL1JEkPesdy5TmtYkGeYsRL.jpg', '2024-11-17 02:27:29', '2024-11-17 02:27:29'),
(23, 125, 'product_gallary/o7MrAujHpGGtsB7XZIQz8lZ5bsjHifHrnYWA3JXf.jpg', '2024-11-17 02:36:20', '2024-11-17 02:36:20'),
(24, 125, 'product_gallary/BHnq3zsEVRUHWltt651WGqzisSVvvNvY16dsq3kr.jpg', '2024-11-17 02:36:20', '2024-11-17 02:36:20'),
(25, 127, 'product_gallary/ZxOE0cON1FCYB2e3OMF8GIgUaGHIxKPsKT5YJKZz.jpg', '2024-11-17 03:31:02', '2024-11-17 03:31:02'),
(26, 127, 'product_gallary/fbWCExguJoHjmeccpGoWJ6eOpK9tg9WcDurRfCAq.jpg', '2024-11-17 03:31:02', '2024-11-17 03:31:02'),
(27, 128, 'product_gallary/UUY4dKUQ91ohrAP2O0SfSBcXprrELV44r9fWeWnk.jpg', '2024-11-17 03:32:44', '2024-11-17 03:32:44'),
(28, 128, 'product_gallary/6wxzU0gHW3QYndFOLIAUoVApHi02J4HBnshGAKyb.jpg', '2024-11-17 03:32:44', '2024-11-17 03:32:44'),
(29, 128, 'product_gallary/qJUdn7sBGvwEA372anwtpmXAIMG4M95s2IPg0PuF.jpg', '2024-11-17 03:32:44', '2024-11-17 03:32:44'),
(30, 129, 'product_gallary/Cz87QPzdNwbqsBJ7rp5IURBCvZmKRH6fJwZP5Tqe.jpg', '2024-11-17 03:34:28', '2024-11-17 03:34:28'),
(31, 129, 'product_gallary/9unCaMgG2B3yKz7nHf70jzyXlJtUl0Icp3DJXQNN.jpg', '2024-11-17 03:34:28', '2024-11-17 03:34:28'),
(32, 129, 'product_gallary/Q8knZJjM5r0d2obGYNwoYzU4ShVm05GZED2IuRNA.jpg', '2024-11-17 03:34:28', '2024-11-17 03:34:28'),
(33, 130, 'product_gallary/ZWiCZxdaTnFtGyWU7vc3XExt3LlKr6TkzGS4oHIp.jpg', '2024-11-17 03:36:00', '2024-11-17 03:36:00'),
(34, 130, 'product_gallary/PwsKAa0eboB0FnlmFz0VPlmul2X7p5LPgSU4va1r.jpg', '2024-11-17 03:36:00', '2024-11-17 03:36:00'),
(35, 130, 'product_gallary/3fbqYi5adNpO1AuBA9dXjGcDgp1W30cGLNqitXFW.jpg', '2024-11-17 03:36:00', '2024-11-17 03:36:00'),
(36, 131, 'product_gallary/x0qc2tqgibb3lCNb53j3ghSn88rmOWJ1tX9SuxV3.jpg', '2024-11-17 03:41:51', '2024-11-17 03:41:51'),
(37, 131, 'product_gallary/vY5E4y2eIdQ5gslVx4lQkqhN7llR4PJfdJUZYTIk.jpg', '2024-11-17 03:41:51', '2024-11-17 03:41:51'),
(38, 131, 'product_gallary/bFVUbH1x9UfSAMm9CnhzcNAsbzFWDN6gxlaSmwR2.jpg', '2024-11-17 03:41:51', '2024-11-17 03:41:51'),
(39, 132, 'product_gallary/ZMh8wLJbG0oyS3k5JfB7nGAU4oOmmRGepKRiMPlY.jpg', '2024-11-17 03:44:19', '2024-11-17 03:44:19'),
(40, 132, 'product_gallary/CUotNJphd9ROltIXH5dDxAf2dNA87mNmzQp6UnSa.jpg', '2024-11-17 03:44:19', '2024-11-17 03:44:19'),
(41, 132, 'product_gallary/KqxW9vvZJ7ct3xvKgVkOi3xPFo8KvAAVPZs5u4Ib.jpg', '2024-11-17 03:44:19', '2024-11-17 03:44:19'),
(42, 133, 'product_gallary/tlvvU7CbYQo3ArK6DikmRJHZiKVMBOigG7HIUUxc.jpg', '2024-11-17 03:47:13', '2024-11-17 03:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `review`, `rating`, `created_at`, `updated_at`) VALUES
(1, 4, 130, 'Good', 3, '2024-11-17 06:46:53', '2024-11-17 06:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profileable_type` varchar(255) NOT NULL,
  `profileable_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `locale` varchar(255) NOT NULL DEFAULT 'english',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `profileable_type`, `profileable_id`, `first_name`, `last_name`, `birthday`, `gender`, `phone`, `street_address`, `city`, `state`, `postal_code`, `country`, `locale`, `image`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Admin', 1, 'Main', 'Admin', '2001-03-10', 'male', '0788895911', 'qarajat', 'Albalqa', 'Ain Albasha', '193081', 'JO', 'ar', 'profile/JuqU1vsbLJCwuONQJrItX1QSdxbgY0v9xBiKypMh.jpg', '2024-11-17 01:02:03', '2024-11-17 01:02:03'),
(2, 'App\\Models\\User', 4, 'Ahmad', 'Alsawalhi', '2000-10-10', 'male', '0788895911', NULL, 'Karak', 'alquesmah', '158963', 'JO', 'ar', NULL, '2024-11-17 01:35:46', '2024-11-17 01:35:46'),
(3, 'App\\Models\\Vendor', 10, 'Ahmad', 'Alsawalhi', '2000-01-02', 'male', '0788895911', 'asdnb 265', 'Karak', 'alquesmah', '125899', 'JO', 'ar', NULL, '2024-11-17 01:46:01', '2024-11-17 01:46:01'),
(4, 'App\\Models\\User', 5, 'qusai', 'hello', '1999-01-01', 'male', '0788895911', 'asdnb 265', 'mhvnm', 'alquesmah', '125899', 'AX', 'af_ZA', NULL, '2024-11-17 02:22:00', '2024-11-17 02:22:00'),
(5, 'App\\Models\\Vendor', 11, 'Qusai', 'Hello', '1999-01-01', 'male', '0785378157', 'malika Rania', 'Amman', 'Yasmin', '158963', 'JO', 'ar', NULL, '2024-11-17 02:26:12', '2024-11-17 02:26:12'),
(6, 'App\\Models\\User', 6, 'Ibra', 'Albana', '1996-01-01', 'male', '0789633281', 'asdnb 265', 'Bqaa', 'Ain Albasha', '158963', 'JO', 'ar_YE', NULL, '2024-11-17 02:38:16', '2024-11-17 02:38:16'),
(7, 'App\\Models\\Vendor', 12, 'Ibra', 'Albana', '1996-01-01', 'female', '0789633281', 'asdnb 265', 'Bqaa', 'Ain Albasha', '125888', 'JO', 'en', NULL, '2024-11-17 02:42:18', '2024-11-17 02:42:18'),
(8, 'App\\Models\\User', 7, 'hadeel', 'Jamil', '2002-02-02', 'female', '0785378157', 'malika Rania', 'Karak', 'Yasmin', '1258', 'AX', 'af_NA', NULL, '2024-11-17 02:44:24', '2024-11-17 02:44:24'),
(9, 'App\\Models\\Vendor', 13, 'Hadeel', 'Jamil', '2000-02-02', 'female', '07853781896', 'asdnb 265', 'Amman', 'Ain Albasha', '125899', 'AL', 'ar', NULL, '2024-11-17 02:47:09', '2024-11-17 02:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(14, 'laptop', 'laptop', '2024-11-17 01:49:10', '2024-11-17 01:49:10'),
(15, 'gaming', 'gaming', '2024-11-17 01:49:10', '2024-11-17 01:49:10'),
(16, 'headset', 'headset', '2024-11-17 02:05:04', '2024-11-17 02:05:04'),
(17, 'watch', 'watch', '2024-11-17 02:27:29', '2024-11-17 02:27:29'),
(18, 'UMIDIGI', 'umidigi', '2024-11-17 02:36:20', '2024-11-17 02:36:20'),
(19, '', '', '2024-11-17 03:30:45', '2024-11-17 03:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(4, 'ahmad swalhi', 'ahmad@gmail.com', NULL, '$2y$10$5JXACE0zvv7hgDPSnLiAs.zXWxGUpx..1CM.rFvvqSPVDsgG2TQ8q', NULL, 'active', '2024-11-17 01:34:25', '2024-11-17 01:34:25'),
(5, 'Qusai', 'qusai@gmail.com', NULL, '$2y$10$wic3NvCTDaMDc8dLgigxeOs/p2t0Zk5uXL.njmB2E8/u37kThLAlK', NULL, 'active', '2024-11-17 02:16:15', '2024-11-17 02:16:15'),
(6, 'Ibrahim Albana', 'ibra@gmail.com', NULL, '$2y$10$Vbqm4w9pGU1muVWaGdGv8OGSIZvrisFvb50xNV65Ac2L.DEaQT4rm', NULL, 'active', '2024-11-17 02:37:14', '2024-11-17 02:37:14'),
(7, 'hadeel', 'hadeel@gmail.com', NULL, '$2y$10$htqL9yTLpyKDIP62hLsgD.W/ijQUxh3gJzTjH7dYRCCib/4enP5hC', NULL, 'active', '2024-11-17 02:43:44', '2024-11-17 02:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `shop_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `logo_image` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `shop_name`, `slug`, `logo_image`, `cover_image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Ahmad Alsawalhi', 'ahmad@gmail.com', NULL, '$2y$10$C.SO7ftew8f4fzuymYGBIutuYydBNPO5ulbyaLiguX3ogjyJRxDeS', NULL, 'ElectroMart', 'electromart', NULL, 'cover_images/n7xgY0O9L4QazWJuFb1tEeAgd3RSLHsKUTOK6zOG.jpg', 'TechZone is your ultimate destination for cutting-edge technology and the latest gadgets. Whether you’re looking for a new smartphone, laptop, or home electronics, TechZone offers a vast array of products from top brands at competitive prices. The store prides itself on providing not only the newest tech but also accessories and smart home devices that complement your lifestyle. With a focus on innovation, TechZone is a one-stop shop for all your digital needs.', 'active', '2024-11-17 01:46:01', '2024-11-17 01:46:01'),
(11, 'Qusai Hello', 'qusai@gmail.com', NULL, '$2y$10$8wHy1PAnyQSs2tGtqsk5W.BcLlsCtNwBBVt6eBHEAXO0UIqwvv2Ei', NULL, 'Vogue & Co', 'vogue-co', NULL, 'cover_images/vC6ywWNDlIZmV0t35N4MwNj7JXDAVR7DxpmpaDrU.jpg', 'Vogue & Co. is a luxurious boutique known for its high-end fashion collections. Offering premium clothing and accessories, this store caters to customers who appreciate elegance and sophistication. From designer dresses and suits to exquisite handbags and shoes, Vogue & Co. provides fashion items that exude class and quality. Whether you\'re preparing for a special occasion or simply treating yourself to a new wardrobe, Vogue & Co. ensures that you look and feel your best.', 'active', '2024-11-17 02:26:12', '2024-11-17 02:26:12'),
(12, 'Ibra Albana', 'ibra@gmail.com', NULL, '$2y$10$R6ll.5YZVkJPl4433wyZweRDtESpbcgOoCHfZlUdXbG64onvLpQwu', NULL, 'Modern Living', 'modern-living', NULL, 'cover_images/yIynZmJLd3qVefocITdLCosh6vqhPxRwZRIKTRHk.jpg', 'InStyle Boutique is a chic fashion destination that combines the best of modern trends with classic elegance. From casual wear to formal outfits, this boutique offers an array of clothing that ensures customers always look stylish. Whether you’re shopping for a special event or simply upgrading your daily wardrobe, InStyle Boutique offers pieces that are both versatile and fashionable, making it a go-to store for fashion-conscious individuals.', 'active', '2024-11-17 02:42:18', '2024-11-17 02:42:18'),
(13, 'Hadeel Jamil', 'hadeel@gmail.com', NULL, '$2y$10$66yRMiVgP2sjtixJcg/lkORQ.w4HP0VYQ48GTht961d5emOE.fApq', NULL, 'Beauty Bliss', 'beauty-bliss', NULL, 'cover_images/mCs953zNpko406Ky1QbJEBWdWYWX1tMmJdVYUqSC.jpg', 'InStyle Boutique is a chic fashion destination that combines the best of modern trends with classic elegance. From casual wear to formal outfits, this boutique offers an array of clothing that ensures customers always look stylish. Whether you’re shopping for a special event or simply upgrading your daily wardrobe, InStyle Boutique offers pieces that are both versatile and fashionable, making it a go-to store for fashion-conscious individuals.', 'active', '2024-11-17 02:47:09', '2024-11-17 02:47:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
  ADD UNIQUE KEY `orders_invoice_no_unique` (`invoice_no`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_addresses_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_items_order_id_product_id_unique` (`order_id`,`product_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`SKU`),
  ADD KEY `products_vendor_id_foreign` (`vendor_id`),
  ADD KEY `products_catetgory_id_foreign` (`catetgory_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `products_tag`
--
ALTER TABLE `products_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_tag_product_id_foreign` (`product_id`),
  ADD KEY `products_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `product_gallaries`
--
ALTER TABLE `product_gallaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_gallaries_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_profileable_type_profileable_id_index` (`profileable_type`,`profileable_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `order_addresses`
--
ALTER TABLE `order_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `products_tag`
--
ALTER TABLE `products_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_gallaries`
--
ALTER TABLE `product_gallaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_addresses`
--
ALTER TABLE `order_addresses`
  ADD CONSTRAINT `order_addresses_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_catetgory_id_foreign` FOREIGN KEY (`catetgory_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_tag`
--
ALTER TABLE `products_tag`
  ADD CONSTRAINT `products_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_gallaries`
--
ALTER TABLE `product_gallaries`
  ADD CONSTRAINT `product_gallaries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
