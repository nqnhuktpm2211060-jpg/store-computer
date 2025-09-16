-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 10:48 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store_computer`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `short_content` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `sub_categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `short_content`, `content`, `sub_categories`, `image`, `user_id`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Bài viết', 'Nội dung ngắn', '<p>Nội dung d&agrave;i</p>', '[\"Danh m\\u1ee5c 1\",\"Danh m\\u1ee5c 2\",\"Danh m\\u1ee5c 3\"]', '/uploads/blogs/1743662915_sofa-da-bo-3.webp', 1, 'bai-viet', '2025-04-02 23:48:35', '2025-04-02 23:48:35'),
(2, NULL, NULL, NULL, NULL, '/uploads/blogs/1745239731_image.png', 1, NULL, '2025-04-21 05:48:51', '2025-04-21 05:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `language_code` varchar(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_content` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `sub_categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sub_categories`)),
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_translations`
--

INSERT INTO `blog_translations` (`id`, `blog_id`, `language_code`, `title`, `short_content`, `content`, `sub_categories`, `slug`, `created_at`, `updated_at`) VALUES
(1, 2, 'en', 'Title 2', 'short content', '<p>main content</p>', '[\"category\",\"category 2\"]', 'title-2', '2025-04-21 05:48:51', '2025-04-21 18:22:51'),
(2, 2, 'vi', 'Tiêu đề', 'Nội dung ngắn', '<p>Nội dung chính</p>', '[\"Danh m\\u1ee5c\",\"Danh m\\u1ee5c 2\"]', 'tieu-de', '2025-04-21 18:22:30', '2025-04-21 18:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `level`, `parent_id`, `icon`, `created_at`, `updated_at`) VALUES
(6, 'Thực Thậm Đông Lạnh', 1, 0, 'https://static.vecteezy.com/system/resources/previews/010/451/460/non_2x/tv-monitor-icon-isolated-on-white-background-free-vector.jpg', '2025-04-03 01:25:42', '2025-06-18 00:11:39'),
(7, 'Bánh Quy & Đồ Ăn Nhẹ', 1, 0, 'https://static.vecteezy.com/system/resources/previews/043/320/435/non_2x/keyboard-and-mouse-glyph-icon-vector.jpg', '2025-04-03 01:26:18', '2025-06-18 00:10:23'),
(8, 'Tạp Hóa & Hàng Thiết Yếu', 1, 0, 'https://static.vecteezy.com/system/resources/previews/035/402/108/non_2x/electronic-chip-icon-isolated-on-white-background-computer-chip-icon-cpu-microprocessor-chip-icon-vector.jpg', '2025-04-03 01:26:58', '2025-06-18 00:09:30'),
(9, 'Rượu Vang & Đồ Uống Có Cồn', 1, 0, 'https://img.freepik.com/premium-vector/computer-pc-icon-logo-design_775854-1632.jpg', '2025-04-03 01:28:39', '2025-06-18 00:08:57'),
(10, 'Sữa & Sản Phẩm Từ Sữa', 1, 0, 'https://static-00.iconduck.com/assets.00/apple-emoji-1702x2048-iu22576y.png', '2025-04-03 01:29:10', '2025-06-18 00:08:20'),
(11, 'Thức Ăn Cho Thú Cưng', 1, 0, 'https://cdn-icons-png.flaticon.com/256/607/607256.png', '2025-04-03 01:29:42', '2025-06-18 00:07:46'),
(23, 'Bánh Kẹo', 2, 8, NULL, '2025-04-03 02:38:57', '2025-04-03 02:38:57'),
(24, NULL, 1, 0, 'https://cdn-icons-png.flaticon.com/512/59/59505.png', '2025-04-21 00:06:55', '2025-06-18 00:06:25'),
(25, NULL, 2, 24, NULL, '2025-06-18 00:29:34', '2025-06-18 00:29:34'),
(26, NULL, 2, 24, NULL, '2025-06-18 00:30:02', '2025-06-18 00:30:02'),
(27, NULL, 2, 24, NULL, '2025-06-18 00:30:27', '2025-06-18 00:30:27'),
(28, NULL, 2, 10, NULL, '2025-06-18 00:30:57', '2025-06-18 00:30:57'),
(29, NULL, 2, 10, NULL, '2025-06-18 00:31:35', '2025-06-18 00:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `language_code` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_translations`
--

INSERT INTO `category_translations` (`id`, `category_id`, `language_code`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'en', 'name', '2025-04-21 04:37:00', '2025-04-21 04:37:00'),
(2, 24, 'en', 'name', '2025-04-21 00:06:55', '2025-04-21 00:06:55'),
(3, 24, 'vi', 'Laptop & Linh Phụ Kiện', '2025-06-17 23:58:37', '2025-06-17 23:58:37'),
(4, 11, 'vi', 'Điện Thoại, Tablet & Phụ Kiện', '2025-06-17 23:59:52', '2025-06-17 23:59:52'),
(5, 10, 'vi', 'Sản Phẩm Apple', '2025-06-18 00:00:23', '2025-06-18 00:00:23'),
(6, 9, 'vi', 'PC Gaming, Đồ Họa, Học Tập', '2025-06-18 00:01:02', '2025-06-18 00:01:02'),
(7, 8, 'vi', 'Linh Kiện Máy Tính', '2025-06-18 00:01:28', '2025-06-18 00:01:28'),
(8, 7, 'vi', 'Bàn Phím, Chuột, Gaming Gear', '2025-06-18 00:02:12', '2025-06-18 00:02:12'),
(9, 6, 'vi', 'Màn Hình Máy Tính, Giá Treo', '2025-06-18 00:03:10', '2025-06-18 00:03:10'),
(10, 23, 'vi', 'Ram & Ổ cứng', '2025-06-18 00:23:16', '2025-06-18 00:23:16'),
(11, 25, 'vi', 'Laptop Acer', '2025-06-18 00:29:34', '2025-06-18 00:29:34'),
(12, 26, 'vi', 'Laptop Apple', '2025-06-18 00:30:02', '2025-06-18 00:30:02'),
(13, 27, 'vi', 'Laptop Dell', '2025-06-18 00:30:27', '2025-06-18 00:30:27'),
(14, 28, 'vi', 'Iphone 15', '2025-06-18 00:30:57', '2025-06-18 00:30:57'),
(15, 29, 'vi', 'Macbook Pro', '2025-06-18 00:31:35', '2025-06-18 00:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Binhf luaanj', '2025-04-03 00:12:13', '2025-04-03 00:12:13');

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
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(3, 3, '/uploads/products/1743561633-banner-discount.jpg', '2025-04-01 19:40:33', '2025-04-01 19:40:33'),
(19, 4, '/uploads/products/1750231178-59361_laptop_msi_gaming_katana_15_b13udxk_8.jpg', '2025-06-18 00:19:38', '2025-06-18 00:19:38'),
(20, 12, '/uploads/products/1750232139-56355_laptop_acer_predator_helios_neo_16_6.jpg', '2025-06-18 00:35:39', '2025-06-18 00:35:39'),
(21, 11, '/uploads/products/1750232448-57279_laptop_dell_inspiron_3530_p16wd1_7.jpg', '2025-06-18 00:40:48', '2025-06-18 00:40:48'),
(22, 10, '/uploads/products/1750232646-57584_88469_laptop_apple_macbook_air_mc7w4sa_a_apple_m2_8c_cpu_8c_gpu_16gb_ram_256gb_ssd_13_6_mac_os_starlight_20241.jpg', '2025-06-18 00:44:06', '2025-06-18 00:44:06'),
(23, 9, '/uploads/products/1750232948-54727_ram_kingston_fury_beast_16gb_2.jpg', '2025-06-18 00:49:08', '2025-06-18 00:49:08'),
(24, 8, '/uploads/products/1750233156-59092_laptop_acer_aspire_gaming_7_a715_59g_73lb_6.jpg', '2025-06-18 00:52:36', '2025-06-18 00:52:36'),
(25, 7, '/uploads/products/1750233396-57542_laptop_apple_macbook_pro_m4_pro_5.jpg', '2025-06-18 00:56:36', '2025-06-18 00:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `icon`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'vi', 'Tiếng việt', '/assets/images/country/viet-nam.webp', 0, '2025-04-17 08:42:21', '2025-04-17 08:42:21'),
(2, 'en', 'English', '/assets/images/country/united-kingdom.png', 0, '2025-04-17 08:42:47', '2025-04-17 08:42:47');

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
(14, '0001_01_01_000000_create_users_table', 1),
(15, '0001_01_01_000001_create_cache_table', 1),
(16, '0001_01_01_000002_create_jobs_table', 1),
(17, '2024_10_14_084829_create_categories_table', 1),
(18, '2024_10_14_084845_create_products_table', 1),
(19, '2024_10_14_084858_create_images_table', 1),
(20, '2024_10_14_084924_create_reviews_table', 1),
(21, '2024_10_15_031624_create_personal_access_tokens_table', 1),
(24, '2024_10_22_085935_create_orders_table', 1),
(25, '2024_10_22_090034_create_order_items_table', 1),
(26, '2025_03_31_015551_create_product_characteristics_table', 1),
(27, '2025_04_03_042918_create_product_views_table', 2),
(28, '2024_10_18_015855_create_blogs_table', 3),
(29, '2024_10_18_021744_create_comments_table', 3),
(30, '2025_04_09_073613_create_roles_table', 4),
(32, '2025_04_17_081125_create_product_translations_table', 5),
(33, '2025_04_17_081136_create_category_translations_table', 5),
(34, '2025_04_17_081143_create_blog_translations_table', 5),
(35, '2025_04_17_081149_create_product_characteristic_translations_table', 6),
(36, '2025_04_17_075947_create_languages_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `total` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `full_name`, `email`, `phone_number`, `address`, `payment_method`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dau Van Nam', 'monster2k28@gmail.com', '0976823924', 'Tỉnh: Tỉnh Bắc Ninh, Huyện: Huyện Gia Bình, Xã: Xã Đông Cứu, Địa chỉ cụ thể: Le loi', NULL, 220000, 2, '2025-04-01 21:15:25', '2025-04-01 21:23:07'),
(2, 'Dau Van Nam', 'monster2k28@gmail.com', '0976823924', 'Tỉnh: Thành phố Hà Nội, Huyện: Quận Nam Từ Liêm, Xã: Phường Cầu Diễn, Địa chỉ cụ thể: Le loi', 'cash', 46800, 1, '2025-04-08 02:36:32', '2025-04-08 02:36:32'),
(3, 'Dau Van Nam', 'monster2k28@gmail.com', '0976823924', 'Tỉnh: Tỉnh Quảng Ninh, Huyện: Huyện Đầm Hà, Xã: Xã Tân Bình, Địa chỉ cụ thể: Le loi', 'vnpay', 52520, 1, '2025-04-09 00:13:26', '2025-04-09 00:13:26'),
(4, 'Dau Van Nam', 'monster2k28@gmail.com', '0976823924', 'Tỉnh: Tỉnh Phú Thọ, Huyện: Huyện Tam Nông, Xã: Xã Quang Húc, Địa chỉ cụ thể: Le loi', 'vnpay', 52520, 1, '2025-04-09 00:18:55', '2025-04-09 00:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, 120000, '2025-04-01 21:15:25', '2025-04-01 21:15:25'),
(2, 1, 2, 2, 100000, '2025-04-01 21:15:25', '2025-04-01 21:15:25'),
(3, 2, 5, 1, 25900, '2025-04-08 02:36:32', '2025-04-08 02:36:32'),
(4, 2, 6, 1, 20900, '2025-04-08 02:36:32', '2025-04-08 02:36:32'),
(5, 3, 11, 2, 52520, '2025-04-09 00:13:26', '2025-04-09 00:13:26'),
(6, 4, 11, 2, 52520, '2025-04-09 00:18:55', '2025-04-09 00:18:55');

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
  `name` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `total_purchases` int(11) NOT NULL DEFAULT 0,
  `is_on_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `view_count` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `short_description`, `description`, `price`, `stock_quantity`, `category_id`, `total_purchases`, `is_on_featured`, `sale_price`, `view_count`, `created_at`, `updated_at`) VALUES
(4, 'Cải Xoăn Kale Túi 200G (ea)', 'Cải xoăn kale là một loại cải thuộc họ thân thảo, xoăn ở phần rìa, có màu xanh hoặc tím.', '<ul>\r\n<li><strong>Cải xoăn kale</strong>&nbsp;l&agrave; một loại cải thuộc họ th&acirc;n thảo, xoăn ở phần r&igrave;a, c&oacute; m&agrave;u xanh hoặc t&iacute;m. Cải kale c&oacute; vị đắng v&agrave; được cho l&agrave; c&oacute; họ h&agrave;ng gần với c&aacute;c loại rau như bắp cải, bruxen, s&uacute;p lơ xanh. Loại cải n&agrave;y xuất hiện ng&agrave;y c&agrave;ng nhiều trong c&aacute;c bữa ăn gia đ&igrave;nh nhờ v&agrave;o độ tươi ngon v&agrave; cực kỳ bổ dưỡng cho sức khỏe.</li>\r\n<li>Th&agrave;nh phần dinh dưỡng của cải kale l&agrave; sự t&iacute;ch hợp của nhiều nh&oacute;m vitamin như vitamin A, vitamin K, vitamin B6, canxi, sắt, phốt pho,... hỗ trợ tăng cường sức khỏe v&agrave; gi&uacute;p con người ph&ograve;ng ngừa nhiều chứng bệnh như tiểu đường, bệnh tim, ung thư, ti&ecirc;u h&oacute;a,...</li>\r\n<li>Được trồng theo quy tr&igrave;nh đạt ti&ecirc;u chuẩn GlobalGap tại c&aacute;c n&ocirc;ng trại lớn v&agrave; được chăm s&oacute;c tỉ mỉ để thu được những sản phẩm chất lượng nhất.</li>\r\n</ul>', '21990000.00', 90, 23, 0, 0, '0.00', 7, '2025-04-03 02:26:14', '2025-06-18 00:21:41'),
(7, 'Ba Chỉ Bò Nhập Khẩu Úc FRESHFOCO 500G', 'Ba chỉ bò nhập khẩu Úc là phần thịt nằm ở phần bụng của con bò. Các sớ thịt và mỡ đan xen nhau rất mềm và thơm béo.', '<ul>\r\n<li>\r\n<p><strong>Ba chỉ b&ograve; nhập khẩu</strong>&nbsp;<strong>&Uacute;c&nbsp;</strong>l&agrave; phần thịt nằm ở phần bụng của con b&ograve;. C&aacute;c sớ thịt v&agrave; mỡ đan xen nhau rất mềm v&agrave; thơm b&eacute;o.</p>\r\n</li>\r\n<li>\r\n<p>Với hương vị thơm ngon v&agrave; gi&agrave;u dinh dưỡng, thịt b&ograve; ăn ngũ cốc đang trở th&agrave;nh một lựa chọn ưa th&iacute;ch cho những nguoiwf quan t&acirc;m đến sức khỏe.</p>\r\n</li>\r\n<li>\r\n<p>Phần nạc của thịt ngọt, đậm đ&agrave;, c&ograve;n phần mỡ b&eacute;o mềm, thơm ngậy m&ugrave;i bơ nhưng khi ăn lại kh&ocirc;ng hề tạo n&ecirc;n cảm gi&aacute;c ng&aacute;n.</p>\r\n</li>\r\n<li>\r\n<p>B&ograve; được nu&ocirc;i ngũ cốc 100 ng&agrave;y đầu n&ecirc;n thịt thơm ngon v&agrave; chất lượng.&nbsp;</p>\r\n</li>\r\n</ul>', '48590000.00', 90, 29, 0, 0, '42149000.00', 12, '2025-04-03 02:31:05', '2025-06-18 00:59:11'),
(8, 'Bắp Hoa Bò Canada Meaty Chopshop 250G (ea)', 'Bắp Hoa Bò Canada là phần cơ nhỏ nằm ở bắp chân trước con bò. Nổi bật là chúng không hề có một chút mỡ nào mà chỉ nguyên phần cơ nạc màu đỏ đậm đan xen với lớp m', '<div class=\"mb-3\">\r\n<div class=\"col-12 col-lg-8 mx-auto\">\r\n<div id=\"desc\" class=\"pro-tab-content mb-4\">\r\n<p><strong>Bắp Hoa B&ograve; Canada</strong>&nbsp;l&agrave; phần cơ nhỏ nằm ở bắp ch&acirc;n trước con b&ograve;. Nổi bật l&agrave; ch&uacute;ng kh&ocirc;ng hề c&oacute; một ch&uacute;t mỡ n&agrave;o m&agrave; chỉ nguy&ecirc;n phần cơ nạc m&agrave;u đỏ đậm đan xen với lớp m&agrave;ng g&acirc;n b&ecirc;n ngo&agrave;i. Bắp hoa b&ograve; c&oacute; vị ngọt đậm đ&agrave;, vị gi&ograve;n gi&ograve;n bởi những m&ocirc; nối đan xen tạo n&ecirc;n c&aacute;c đường v&acirc;n như c&aacute;nh hoa khi cắt l&aacute;t miếng thịt. Thịt b&ograve; Canada gi&agrave;u dinh dưỡng với 14 nh&oacute;m dưỡng chất thiết yếu, l&agrave; nguồn năng lượng dồi d&agrave;o.</p>\r\n<ul>\r\n<li>Thịt b&ograve; Canada c&oacute; chứa nhiều protein l&agrave; lựa chọn số một cho những ai cần tăng cơ, duy tr&igrave; v&agrave; ph&aacute;t triển c&acirc;n nặng. H&agrave;m lượng sắt, kẽm, vitamin B,&hellip; c&oacute; trong thịt b&ograve; rất tốt cho những người thiếu m&aacute;u, hệ ti&ecirc;u h&oacute;a v&agrave; sự ph&aacute;t triển của n&atilde;o bộ. H&agrave;m lượng cholesterol thấp, thịt b&ograve; c&ograve;n tốt cho hệ tim mạch.&nbsp;</li>\r\n</ul>\r\n<p><img src=\"https://cdn.lottemart.vn/media/description/product/cache/8936207131709-DT-2.jpg.webp\" alt=\"\" width=\"600\"></p>\r\n<p><img src=\"https://cdn.lottemart.vn/media/description/product/cache/8936207131709-DT-1.jpeg.webp\" alt=\"\" width=\"600\"></p>\r\n<p><img src=\"https://cdn.lottemart.vn/media/description/product/cache/8936207131709-DT-3.jpg.webp\" alt=\"\" width=\"600\"></p>\r\n<p><img src=\"https://cdn.lottemart.vn/media/description/product/cache/8936207131709-DT-4.webp.webp\" alt=\"\" width=\"600\"></p>\r\n<p><strong>C&aacute;c m&oacute;n ngon gợi &yacute;:</strong></p>\r\n<ul>\r\n<li>Bắp hoa b&ograve; nướng BBQ, lẩu bắp hoa b&ograve;, bắp hoa b&ograve; x&agrave;o cần t&acirc;y,...</li>\r\n</ul>\r\n<p><strong>Hướng dẩn sử dụng:</strong></p>\r\n<ul>\r\n<li>R&atilde; đ&ocirc;ng sản phẩm sau đ&oacute; rửa sạch rồi chế biến th&agrave;nh c&aacute;c m&oacute;n ngon y&ecirc;u th&iacute;ch.</li>\r\n</ul>\r\n<p><strong>Hướng dẫn bảo quản:</strong></p>\r\n<ul>\r\n<li>Bảo quản trong ngăn đ&ocirc;ng tủ lạnh.</li>\r\n</ul>\r\n<p><strong>Xuất xứ:</strong> Canada&nbsp;</p>\r\n</div>\r\n</div>\r\n</div>', '22790000.00', 60, 25, 0, 0, '20099000.00', 9, '2025-04-03 02:32:53', '2025-06-18 00:58:58'),
(9, 'Dẻ sườn bò Canada Meaty ChopShop 300g (ea)', 'Dẻ sườn bò là phần thịt được lọc ra từ xương sườn của con bò, không có xương, thịt mềm, có các vân nạc và mỡ xen kẽ đều nhau phân bổ dọc theo miếng thịt, nên thịt ăn rất ngon, có vị béo không bị ngán hoặc bị khô và có mùi thơm đặc trưng.', '<p>Dẻ sườn b&ograve; l&agrave; phần thịt được lọc ra từ xương sườn của con b&ograve;, kh&ocirc;ng c&oacute; xương, thịt mềm, c&oacute; c&aacute;c v&acirc;n nạc v&agrave; mỡ xen kẽ đều nhau ph&acirc;n bổ dọc theo miếng thịt, n&ecirc;n thịt ăn rất ngon, c&oacute; vị b&eacute;o kh&ocirc;ng bị ng&aacute;n hoặc bị kh&ocirc; v&agrave; c&oacute; m&ugrave;i thơm đặc trưng.</p>\r\n<p>Khi ăn phần dẻ sườn sẽ rất gi&ograve;n, v&agrave; ngọt thịt kh&ocirc;ng bị m&agrave;ng g&acirc;n dai (Dẻ sườn của b&ograve; gi&agrave; rất dễ bị c&oacute; m&agrave;ng g&acirc;n dai). Thịt b&ograve; n&oacute;i chung, thịt dẻ sườn b&ograve; n&oacute;i ri&ecirc;ng c&oacute; rất nhiều gi&aacute; trị dinh dưỡng tốt cho sức khỏe của người d&ugrave;ng.</p>\r\n<p>Những m&oacute;n ăn được chế biến từ dẻ sườn b&ograve; cung cấp cho cơ thể nhiều chất dinh dưỡng cần thiết g&oacute;p phần n&acirc;ng cao hệ miễn dịch như photpho, sắt, axit amin v&agrave; đặc biệt l&agrave; c&aacute;c loại vitamin nh&oacute;m B rất kh&oacute; t&igrave;m thấy trong c&aacute;c loại thực phẩm kh&aacute;c.&nbsp;</p>\r\n<p><strong><img src=\"https://i.imgur.com/igVSMKq.png\" alt=\"\" width=\"800\"></strong></p>\r\n<p><strong>Hướng dẫn sử dụng:</strong></p>\r\n<ul>\r\n<li>Khi chế biến: C&aacute;ch r&atilde; đ&ocirc;ng tốt nhất l&agrave; cho thịt v&agrave;o ngăn m&aacute;t tủ lạnh từ 1 đến 2 ng&agrave;y, thịt sẽ r&atilde; đ&ocirc;ng từ từ v&agrave; chất lượng ho&agrave;n hảo nhất.</li>\r\n<li>Nếu cần chế biến gấp, bạn c&oacute; thể r&atilde; đ&ocirc;ng bằng nước hoặc l&ograve; vi s&oacute;ng. Tuy nhi&ecirc;n, d&ugrave;ng l&ograve; vi s&oacute;ng c&oacute; thể l&agrave;m cho 1 phần thịt bị ch&iacute;n. Sau khi r&atilde; đ&ocirc;ng tiến h&agrave;nh ướp gia vị ph&ugrave; hợp v&agrave; tiến h&agrave;nh chế biến.</li>\r\n</ul>\r\n<p><strong><img src=\"https://i.imgur.com/RMQWZPZ.png\" alt=\"\" width=\"600\" height=\"400\"></strong></p>\r\n<p><strong>Hướng dẫn bảo quản:</strong></p>\r\n<ul>\r\n<li>Khi chưa sử dụng đến: Bảo quản trong ngăn đ&aacute; tủ lạnh với nhiệt độ -18 độ C. Thịt được bảo quản ở nhiệt độ -18 độ C n&ecirc;n c&oacute; m&agrave;u đỏ sậm. Khi tiến h&agrave;nh r&atilde; đ&ocirc;ng ở nhiệt độ thường, thịt sẽ từ từ chuyển sang m&agrave;u đỏ tươi. Sau khi đ&atilde; r&atilde; đ&ocirc;ng phải tiến h&agrave;nh chế biến v&agrave; sử dụng ngay. Kh&ocirc;ng được t&aacute;i cấp đ&ocirc;ng v&igrave; sẽ dễ g&acirc;y nhiễm khuẩn.</li>\r\n</ul>', '1439000.00', 50, 23, 0, 0, '0.00', 0, '2025-04-03 02:34:47', '2025-06-18 00:49:08'),
(10, 'Bánh Nutella Socola Hạt Phỉ 132G', 'Bánh Nutella Socola Hạt Phỉ 132G là sự kết hợp tuyệt vời giữa bánh xốp giòn và nhân ngập sốt socola mịn màng bên trong, vừa thơm ngon lại béo ngậy đến tan chảy. Đặc biệt trong nhân sốt có trộn lẫn thêm hạt phỉ giòn xay nhuyễn, bùi bùi càng làm kích thích vị giác.', '<p><strong>Đặc điểm của sản phẩm</strong></p>\r\n<ul>\r\n<li><strong>B&aacute;nh Nutella Socola Hạt Phỉ 132G</strong>&nbsp;l&agrave; sự kết hợp tuyệt vời giữa b&aacute;nh xốp gi&ograve;n v&agrave; nh&acirc;n ngập sốt&nbsp;socola mịn m&agrave;ng b&ecirc;n trong, vừa thơm ngon lại b&eacute;o ngậy đến tan chảy. Đặc biệt trong nh&acirc;n sốt c&oacute; trộn lẫn th&ecirc;m hạt phỉ gi&ograve;n xay nhuyễn, b&ugrave;i b&ugrave;i c&agrave;ng l&agrave;m k&iacute;ch th&iacute;ch vị gi&aacute;c.</li>\r\n<li>Sản phẩm được sản xuất bởi Tập đo&agrave;n b&aacute;nh kẹo nổi tiếng thế giới -&nbsp;Ferrro v&agrave; cực kỳ được ưa chuộng tại thị trường Mỹ v&agrave; Ch&acirc;u &Acirc;u,&nbsp;sản xuất theo quy tr&igrave;nh c&ocirc;ng nghệ hiện đại, nguy&ecirc;n liệu chất lượng, đảm bảo an to&agrave;n cho người d&ugrave;ng.</li>\r\n<li>Đ&acirc;y l&agrave; m&oacute;n b&aacute;nh nhỏ gọn, tiện lợi để mang đi l&agrave;m qu&agrave; hoặc để thưởng thức trong những buổi tr&agrave; chiều hay khi cần một &iacute;t ngọt để giải tỏa cơn đ&oacute;i bụng.</li>\r\n</ul>\r\n<p><strong>Th&agrave;nh phần của sản phẩm</strong></p>\r\n<ul>\r\n<li>HAZELNUT Spread with Cocoa 81.5% (Sugar, Palm Oil, HAZELNUTS (13%), Fat-Reduced Cocoa (7.4%), Skimmed MILK Powder (6.6%), Whey Powder (MILK), Emulsifier: Lecithin (SOYA), Vanillin), WHEAT Flour, Baker&rsquo;s Yeast, Powdered BARLEY&rsquo;s Malt Extract, Salt, Skimmed MILK Powder, Emulsifier: Lecithin (SOYA), WHEAT Proteins, Whey Proteins (MILK).</li>\r\n</ul>\r\n<p><strong>Hướng dẫn sử dụng</strong></p>\r\n<ul>\r\n<li>D&ugrave;ng trực tiếp sau khi mở bao b&igrave;.</li>\r\n</ul>\r\n<p><strong>Hướng dẫn bảo quản</strong></p>\r\n<ul>\r\n<li>Bảo quản nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t. Tr&aacute;nh &aacute;nh nắng trực tiếp.</li>\r\n</ul>', '21090000.00', 90, 29, 0, 0, '0.00', 0, '2025-04-03 02:37:33', '2025-06-18 00:44:33'),
(11, 'Bánh Quế Cal Cheese Cheese Roll Kem Phô Mai Hộp 186G', 'Bánh Quế Cal Cheese Cheese Roll Kem Phô Mai là món ăn vặt thơm ngon với lớp bánh xốp giòn nhẹ nhàng và lớp phô mai beo béo bên trong. Với thiết kế bao bì nhỏ gọn, bánh quế rất tiện lợi để mang theo, thưởng thức mọi lúc mọi nơi', '<p><strong>Đặc điểm sản phẩm</strong></p>\r\n<ul>\r\n<li><strong>B&aacute;nh Quế Cal Cheese Cheese Roll Kem Ph&ocirc; Mai</strong>&nbsp;l&agrave; m&oacute;n ăn vặt thơm ngon với lớp b&aacute;nh xốp gi&ograve;n nhẹ nh&agrave;ng v&agrave; lớp ph&ocirc; mai beo b&eacute;o b&ecirc;n trong. Với thiết kế bao b&igrave; nhỏ gọn, b&aacute;nh quế rất tiện lợi để mang theo, thưởng thức mọi l&uacute;c mọi nơi.</li>\r\n<li>Sản ph&acirc;̉m được sản xuất theo c&ocirc;ng nghệ hiện đại, mọi kh&acirc;u từ tuyển chọn nguy&ecirc;n liệu tới chế biến, đ&oacute;ng g&oacute;i đều diễn ra kh&eacute;p k&iacute;n dưới sự gi&aacute;m s&aacute;t v&agrave; kiểm tra nghi&ecirc;m ngặt, đảm bảo an to&agrave;n cho sức khỏe người ti&ecirc;u d&ugrave;ng.</li>\r\n<li>B&aacute;nh Quế Cal Cheese l&agrave; lựa chọn tuyệt vời cho những buổi tụ tập bạn b&egrave; hay thưởng thức trong những giờ nghỉ giải lao.</li>\r\n</ul>\r\n<p><strong>Th&agrave;nh phần:</strong></p>\r\n<ul>\r\n<li>Bột m&igrave;, đường, dầu thực vật (chứa chất chống oxy h&oacute;a BHA), kem kh&ocirc;ng sữa, bột whey, maltodextrin, bột sữa, bột ph&ocirc; mai, muối, calcium cacbornat, soy lecithin (Elmusifier), hương ph&ocirc; mai, bột nổi, men, m&agrave;u thực phẩm (Sun set yellow FCF CI 15985 , Tartrazine CI 19140), Vitamins (A, B1, B6, B12).</li>\r\n</ul>\r\n<p><strong>Gi&aacute; trị dinh dưỡng:&nbsp;</strong>Ph&ugrave; hợp bổ sung canxi, Vitamin A, B1, B6, B12 hỗ trợ ph&aacute;t triển chiều cao.</p>\r\n<p><strong>Hướng dẫn sử dụng:&nbsp;</strong>D&ugrave;ng trực tiếp sau khi mở bao b&igrave;.</p>\r\n<p><strong>Hướng dẫn bảo quản:&nbsp;</strong>Bảo quản nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng trực tiếp.</p>', '20390000.00', 86, 27, 4, 0, '0.00', 0, '2025-04-03 02:41:18', '2025-06-18 00:40:48'),
(12, 'Kẹo Dẻo Top Fruit Vị Trái Cây Hỗn Hợp Gói 320G', 'Kẹo Dẻo Top Fruit Vị Trái Cây Hỗn Hợp là sản phẩm khá được ưa chuộng hiện nay từ trẻ nhỏ đến người lớn. Những viên kẹo dẻo ngọt thơm lừng hương trái cây tự nhiên mà khi cắn vào ta sẽ thấy vị trái cây chân thật.', '<ul>\r\n<li><strong>Kẹo Dẻo Top Fruit Vị Tr&aacute;i C&acirc;y Hỗn Hợp</strong>&nbsp;l&agrave; sản phẩm kh&aacute; được ưa chuộng hiện nay từ trẻ nhỏ đến người lớn.&nbsp;Những vi&ecirc;n kẹo dẻo ngọt thơm lừng hương tr&aacute;i c&acirc;y tự nhi&ecirc;n m&agrave; khi cắn v&agrave;o ta sẽ thấy vị tr&aacute;i c&acirc;y ch&acirc;n thật.</li>\r\n<li>Kẹo dẻo được sản xuất từ những loại tr&aacute;i c&acirc;y tươi ngon nhất, qua c&ocirc;ng nghệ chế biến ti&ecirc;n tiến gi&uacute;p giữ được vị ngọt nhẹ, thơm nồng n&agrave;n v&agrave; tươi m&aacute;t từ tr&aacute;i c&acirc;y, an to&agrave;n cho sức khỏe người d&ugrave;ng.</li>\r\n<li>Kẹo dẻo được đ&oacute;ng g&oacute;i th&agrave;nh từng vi&ecirc;n, giữ được hương vị thơm ngon, thuận tiện cho việc bảo quản v&agrave; mang đi bất kỳ đ&acirc;u.</li>\r\n<li>Kẹo dẻo với thiết kế bao b&igrave; đẹp mắt, sang trọng c&oacute; thể d&ugrave;ng để mời bạn b&egrave;, tiếp kh&aacute;ch hoặc l&agrave;m qu&agrave; tặng cho người th&acirc;n, bạn b&egrave;. &nbsp;</li>\r\n</ul>\r\n<p><img src=\"https://cdn.lottemart.vn/media/description/product/cache/6959210717489-DT-1.jpg.webp\" alt=\"\" width=\"800\"></p>\r\n<p><strong>Th&agrave;nh phần:</strong></p>\r\n<ul>\r\n<li>Mạch nha, đường k&iacute;nh, nước, nước &eacute;p tr&aacute;i c&acirc;y c&ocirc; đặc 7% (d&acirc;u t&acirc;y, nho, xo&agrave;i), chất l&agrave;m d&agrave;y: carrageenan (INS 407), chất điều chỉnh độ acid (INS 330, INS 33liii), hương thực phẩm tổng hợp (d&acirc;u t&acirc;y, nho, xo&agrave;i), m&agrave;u thực phẩm tổng hợp (INS 129, INS 133, INS 102, INS 110, INS 171)</li>\r\n</ul>\r\n<p><strong>Hướng dẫn sử dụng:</strong>&nbsp;D&ugrave;ng trực tiếp hoặc th&ecirc;m v&agrave;o c&aacute;c m&oacute;n tr&aacute;ng miệng như kem.</p>\r\n<p><strong>Hướng dẫn bảo quản:</strong>&nbsp;Bảo quản nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t. Tr&aacute;nh &aacute;nh nắng trực tiếp</p>\r\n<p><strong>Lưu &yacute;:</strong> Trẻ em khi ăn cần c&oacute; sự gi&aacute;m s&aacute;t của người lớn.</p>', '46790000.00', 60, 25, 0, 0, '39999900.00', 52, '2025-04-03 02:43:02', '2025-06-18 00:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_characteristics`
--

CREATE TABLE `product_characteristics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_characteristics`
--

INSERT INTO `product_characteristics` (`id`, `product_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(3, 3, 'Ngon', 'ngon vl', '2025-04-01 19:40:33', '2025-04-01 19:40:33'),
(4, 4, 'Country of Manufacture', 'Vietnam', '2025-04-03 02:26:14', '2025-04-03 02:26:14'),
(5, 4, 'Manufacturer Text', 'Bảo quản tốt nhất ở nhiệt độ 5 - 10 độ C.', '2025-04-03 02:26:14', '2025-04-03 02:26:14'),
(10, 7, 'Country of Manufacture', 'Australia', '2025-04-03 02:31:05', '2025-04-03 02:31:05'),
(11, 7, 'Storage category', 'Bảo quản ở nhiệt độ 0 - 5 độ C hoặc trong ngăn đông tủ lạnh', '2025-04-03 02:31:05', '2025-04-03 02:31:05'),
(12, 8, 'Country of Manufacture', 'Canada', '2025-04-03 02:32:53', '2025-04-03 02:32:53'),
(13, 8, 'Manufacturer Text', 'Không sử dụng sản phẩm khi có hiện tượng hư hỏng, mốc.', '2025-04-03 02:32:53', '2025-04-03 02:32:53'),
(14, 9, 'Country of Manufacture', 'Canada', '2025-04-03 02:34:47', '2025-04-03 02:34:47'),
(15, 9, 'Manufacturer Text', 'Không sử dụng sản phẩm khi có hiện tượng hư hỏng, mốc.', '2025-04-03 02:34:47', '2025-04-03 02:34:47'),
(16, 10, 'Special care instructions', 'Bảo quản nơi sạch sẽ, khô ráo thoáng mát. Tránh ánh nắng mặt trời.', '2025-04-03 02:37:33', '2025-04-03 02:37:33'),
(17, 10, 'Hướng dẫn sử dụng', 'Dùng trực tiếp sau khi mở bao bì.', '2025-04-03 02:37:33', '2025-04-03 02:37:33'),
(18, 11, 'Nhãn hiệu', 'Cal Cheese', '2025-04-03 02:41:18', '2025-04-03 02:41:18'),
(19, 11, 'Country of Manufacture', 'Indonesia', '2025-04-03 02:41:18', '2025-04-03 02:41:18'),
(20, 11, 'Special care instructions', 'Bảo quản nơi khô mát, tránh ánh nắng trực tiếp.', '2025-04-03 02:41:18', '2025-04-03 02:41:18'),
(21, 12, 'Nhãn hiệu', 'Top Fruit', '2025-04-03 02:43:02', '2025-04-03 02:43:02'),
(22, 12, 'Nhãn hiệu	Top Fruit Country of Manufacture', 'China', '2025-04-03 02:43:02', '2025-04-03 02:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_characteristic_translations`
--

CREATE TABLE `product_characteristic_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `language_code` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_characteristic_translations`
--

INSERT INTO `product_characteristic_translations` (`id`, `product_id`, `language_code`, `name`, `description`, `created_at`, `updated_at`) VALUES
(11, 12, 'en', 'name', 'des', '2025-04-21 05:03:14', '2025-04-21 05:03:14'),
(18, 4, 'vi', 'Bộ VXL', 'Core i5 13420H 2.1GHz', '2025-06-18 00:19:38', '2025-06-18 00:19:38'),
(19, 4, 'vi', 'Bộ nhớ RAM', '16Gb DDR5 5200', '2025-06-18 00:19:38', '2025-06-18 00:19:38'),
(20, 4, 'vi', 'Ổ cứng', '512Gb SSD', '2025-06-18 00:19:38', '2025-06-18 00:19:38'),
(21, 4, 'vi', 'Card màn hình', 'VGA Nvidia - Nvidia GeForce RTX 3050 6Gb GDDR6', '2025-06-18 00:19:38', '2025-06-18 00:19:38'),
(22, 4, 'vi', 'Kích thước màn hình', '15.6inch Full HD', '2025-06-18 00:19:38', '2025-06-18 00:19:38'),
(23, 4, 'vi', 'Hệ điều hành', 'Windows 11 Home', '2025-06-18 00:19:38', '2025-06-18 00:19:38'),
(36, 11, 'vi', 'Bộ VXL', 'Core i7 1355U 1.7GHz', '2025-06-18 00:40:48', '2025-06-18 00:40:48'),
(37, 11, 'vi', 'Bộ nhớ RAM', '16Gb (2x8Gb) DDR4 3200', '2025-06-18 00:40:48', '2025-06-18 00:40:48'),
(38, 11, 'vi', 'Ổ cứng', '512Gb SSD', '2025-06-18 00:40:48', '2025-06-18 00:40:48'),
(39, 11, 'vi', 'Card màn hình', 'VGA Intel Iris - Intel Iris Xe Graphics', '2025-06-18 00:40:48', '2025-06-18 00:40:48'),
(40, 11, 'vi', 'Kích thước màn hình', '15.6inch Full HD', '2025-06-18 00:40:48', '2025-06-18 00:40:48'),
(41, 11, 'vi', 'Hệ điều hành', 'Windows 11 home + Office Home and Student 2024', '2025-06-18 00:40:48', '2025-06-18 00:40:48'),
(48, 10, 'vi', 'Bộ VXL', 'Apple M2 8-core CPU', '2025-06-18 00:44:34', '2025-06-18 00:44:34'),
(49, 10, 'vi', 'Bộ nhớ RAM', '16GB', '2025-06-18 00:44:34', '2025-06-18 00:44:34'),
(50, 10, 'vi', 'Ổ cứng', '256GB', '2025-06-18 00:44:34', '2025-06-18 00:44:34'),
(51, 10, 'vi', 'Card màn hình', 'VGA Apple - 8 core GPU', '2025-06-18 00:44:34', '2025-06-18 00:44:34'),
(52, 10, 'vi', 'Kích thước màn hình', '13.6Inch', '2025-06-18 00:44:34', '2025-06-18 00:44:34'),
(53, 10, 'vi', 'Hệ điều hành', 'Mac OS', '2025-06-18 00:44:34', '2025-06-18 00:44:34'),
(54, 9, 'vi', 'Loại RAM', 'DDR5', '2025-06-18 00:49:08', '2025-06-18 00:49:08'),
(55, 9, 'vi', 'Dung lượng RAM', '16GB', '2025-06-18 00:49:08', '2025-06-18 00:49:08'),
(56, 9, 'vi', 'Bus ram', '5600 Mhz', '2025-06-18 00:49:08', '2025-06-18 00:49:08'),
(57, 9, 'vi', 'Đèn Led', 'Không LED', '2025-06-18 00:49:08', '2025-06-18 00:49:08'),
(58, 9, 'vi', 'Tản nhiệt', 'Có', '2025-06-18 00:49:08', '2025-06-18 00:49:08'),
(59, 9, 'vi', 'Tự động sửa lỗi', 'Non-ECC', '2025-06-18 00:49:08', '2025-06-18 00:49:08'),
(60, 9, 'vi', 'Hiệu điện thế', '1.25V', '2025-06-18 00:49:08', '2025-06-18 00:49:08'),
(61, 9, 'vi', 'Độ trễ', 'CL40', '2025-06-18 00:49:08', '2025-06-18 00:49:08'),
(74, 12, 'vi', 'Bộ VXL', 'Core i7-14650HX 3.7GHz', '2025-06-18 00:58:23', '2025-06-18 00:58:23'),
(75, 12, 'vi', 'Bộ nhớ RAM', '16Gb (2x8Gb) DDR5 4800', '2025-06-18 00:58:23', '2025-06-18 00:58:23'),
(76, 12, 'vi', 'Ổ cứng', '1TB SSD', '2025-06-18 00:58:23', '2025-06-18 00:58:23'),
(77, 12, 'vi', 'Card màn hình', 'VGA Nvidia - Nvidia GeForce RTX 4060 8GB GDDR6', '2025-06-18 00:58:23', '2025-06-18 00:58:23'),
(78, 12, 'vi', 'Kích thước màn hình', '16.0inch 2K', '2025-06-18 00:58:23', '2025-06-18 00:58:23'),
(79, 12, 'vi', 'Hệ điều hành', 'Windows 11 Home', '2025-06-18 00:58:23', '2025-06-18 00:58:23'),
(80, 8, 'vi', 'Bộ VXL', 'Core i7 12650H 3.5GHz', '2025-06-18 00:58:58', '2025-06-18 00:58:58'),
(81, 8, 'vi', 'Bộ nhớ RAM', '16Gb DDR4 3200', '2025-06-18 00:58:58', '2025-06-18 00:58:58'),
(82, 8, 'vi', 'Ổ cứng', '512Gb SSD', '2025-06-18 00:58:58', '2025-06-18 00:58:58'),
(83, 8, 'vi', 'Card màn hình', 'VGA Nvidia - Nvidia GeForce RTX 3050 6Gb GDDR6', '2025-06-18 00:58:58', '2025-06-18 00:58:58'),
(84, 8, 'vi', 'Kích thước màn hình', '15.6inch Full HD', '2025-06-18 00:58:58', '2025-06-18 00:58:58'),
(85, 8, 'vi', 'Hệ điều hành', 'Windows 11 Home', '2025-06-18 00:58:58', '2025-06-18 00:58:58'),
(86, 7, 'vi', 'Bộ VXL', 'Apple M4 Pro 12 Core CPU', '2025-06-18 00:59:11', '2025-06-18 00:59:11'),
(87, 7, 'vi', 'Bộ nhớ RAM', '24Gb', '2025-06-18 00:59:11', '2025-06-18 00:59:11'),
(88, 7, 'vi', 'Ổ cứng', '512GB', '2025-06-18 00:59:11', '2025-06-18 00:59:11'),
(89, 7, 'vi', 'Card màn hình', 'VGA Apple - 16 core GPU', '2025-06-18 00:59:11', '2025-06-18 00:59:11'),
(90, 7, 'vi', 'Kích thước màn hình', '14.2Inch', '2025-06-18 00:59:11', '2025-06-18 00:59:11'),
(91, 7, 'vi', 'Hệ điều hành', 'Mac OS', '2025-06-18 00:59:11', '2025-06-18 00:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_translations`
--

CREATE TABLE `product_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `language_code` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_translations`
--

INSERT INTO `product_translations` (`id`, `product_id`, `language_code`, `name`, `short_description`, `description`, `created_at`, `updated_at`) VALUES
(1, 12, 'en', 'tiếng anh', 'tiếng anh', '<p><img src=\"/uploads/products/descriptions/1745236980_image.png\">tiếng anh</p>', '2025-04-17 09:58:46', '2025-04-21 05:03:14'),
(8, 4, 'vi', 'Laptop MSI Gaming Katana 15 B13UDXK-2410VN (i5 13420H/ 16GB/ 512GB SSD/ RTX 3050 6Gb/ 15.6 inch FHD/ 144Hz/ Win11/ Black/ Balo)', 'Bảo hành: 24 Tháng. Tại hãng (Pin, Sạc 12 tháng). Đổi mới 30 ngày', NULL, '2025-06-17 23:53:26', '2025-06-18 00:19:38'),
(9, 12, 'vi', 'Máy tính xách tay gaming Acer PREDATOR Helios Neo 16 PHN16-72-78DQ (i7 14650HX/ 16GB/ 1TB SSD/ RTX 4060 8GB/ 16 inch 2K/ 240Hz/ Win11/ Black/ Vỏ nhôm/ 2Y)', 'Học sinh, sinh viên giảm tới 300.000 ₫ (Chi tiết)\r\nBảo hành: 24 Tháng. Tại hãng (Pin 12 tháng). Bảo hành 3S1. Đổi mới 30 ngày', '<p><br></p>', '2025-06-18 00:35:39', '2025-06-18 00:58:23'),
(10, 11, 'vi', 'Laptop Dell Inspiron 3530 71053721 (i7 1355U/ 16GB/ 512GB SSD/ 15.6 inch FHD/ Win 11/ Office/ Silver/ 1Y)', 'Học sinh, sinh viên giảm tới 300.000 ₫ (Chi tiết)\r\nBảo hành: 12 Tháng. Tại hãng. Đổi mới 30 ngày', '<h2 class=\"ql-align-justify\">Laptop Dell Inspiron 3530 71053721</h2><p class=\"ql-align-center\"><strong><img src=\"https://phucanhcdn.com/media/lib/10-02-2025/dell-inspiron-3520.jpeg\" alt=\"Laptop Dell Inspiron 3530 71053721\" height=\"869\" width=\"1200\"></strong></p><h2 class=\"ql-align-justify\">Thiết kế thanh lịch</h2><p class=\"ql-align-justify\"><a href=\"https://www.phucanh.vn/laptop-dell-inspiron-3530-71053721.html\" target=\"_blank\" style=\"color: rgb(0, 0, 255);\"><strong>Dell Inspiron 3530 71053721</strong></a><strong style=\"color: rgb(0, 0, 255);\">&nbsp;</strong>sở hữu vẻ ngoài tinh tế với tông màu bạc (Silver) lịch lãm, các góc bo tròn mềm mại và viền màn hình mỏng. Máy có trọng lượng nhẹ, thuận tiện để mang theo mọi nơi mà không gây bất tiện.</p><p class=\"ql-align-center\"><strong><img src=\"https://phucanhcdn.com/media/lib/10-02-2025/dell-inspiron-3520-2.jpeg\" alt=\"Laptop Dell Inspiron 3530 71053721\" height=\"859\" width=\"1200\"></strong></p><h2 class=\"ql-align-justify\"><strong>Màn&nbsp;hình FHD 120Hz sắc nét</strong></h2><p class=\"ql-align-justify\">Dell Inspiron 3530 71053721 trang bị màn hình 15.6 inch độ phân giải Full HD (1920x1080), Inspiron 15 3530 mang lại hình ảnh sống động, sắc nét. Lớp phủ chống chói giúp bảo vệ mắt và cải thiện hiển thị ngay cả trong môi trường sáng mạnh. Tần số quét 120Hz không chỉ mang đến trải nghiệm mượt mà mà còn phù hợp cho các tác vụ giải trí như xem phim hay chơi game.</p><p class=\"ql-align-center\"><strong><img src=\"https://phucanhcdn.com/media/lib/10-02-2025/dell-inspiron-3520-1.jpeg\" alt=\"Laptop Dell Inspiron 3530 71053721\" height=\"808\" width=\"1200\"></strong></p><h2 class=\"ql-align-justify\">Bàn phím full size, độ nảy tốt</h2><p class=\"ql-align-justify\">Bàn phím trên Dell Inspiron 3530 71053721 là dạng phím Fullsize với dãy phím số riêng biệt hỗ trợ tối ưu công việc nhập liệu. Các phím có độ nảy tốt, kích thước lớn, và khoảng cách hợp lý, mang lại cảm giác thoải mái khi thao tác. Touchpad rộng rãi, hỗ trợ thao tác nhanh nhạy và chính xác.</p><p class=\"ql-align-center\"><strong><img src=\"https://phucanhcdn.com/media/lib/10-02-2025/dell-inspiron-3520-3.jpeg\" alt=\"Laptop Dell Inspiron 3530 71053721\" height=\"900\" width=\"1200\"></strong></p><p class=\"ql-align-justify\"><strong><em>Lưu ý: bàn phím không hỗ trợ đèn nền.</em></strong></p><h3 class=\"ql-align-justify\"><strong>Kết&nbsp;nối đa dạng</strong></h3><p class=\"ql-align-justify\">Dell Inspiron 3530 71053721&nbsp;trang bị đầy đủ các cổng kết nối như:</p><p class=\"ql-align-justify\">1 x USB 3.2 Gen1 Type-A</p><p class=\"ql-align-justify\">1 x USB 3.2 Type-C</p><p class=\"ql-align-justify\">1 x USB 2.0 Kết nối HDMI/VGA</p><p class=\"ql-align-justify\">1 x&nbsp;HDMI 1.4 port Tai nghe</p><p class=\"ql-align-justify\">1 x Audio jack 3.5mm.</p><p class=\"ql-align-center\"><strong><img src=\"https://phucanhcdn.com/media/lib/10-02-2025/dell-inspiron-3520-4.jpeg\" alt=\"Laptop Dell Inspiron 3530 71053721\" height=\"885\" width=\"1200\"></strong></p><p class=\"ql-align-justify\"><strong><em>Lưu ý: cổng kết nối trên máy có sự thay đổi theo cấu hình và chất liệu vỏ máy.</em></strong></p><h3 class=\"ql-align-justify\"><strong>Thời lượng PIN ấn tượng</strong></h3><p class=\"ql-align-justify\">Viên pin 4 cell dung lượng 54Whr đảm bảo thời gian sử dụng từ 3 - 4 tiếng cho các tác vụ cơ bản. Bộ sạc đi kèm hỗ trợ sạc nhanh, sẵn sàng đồng hành cùng bạn mọi lúc, mọi nơi</p><p class=\"ql-align-center\"><strong><img src=\"https://phucanhcdn.com/media/lib/22-01-2025/z6253264468782_d1d07a09eac2b501d3cfad7134239bdb.jpg\" alt=\"Laptop Dell Inspiron 3530 71053721\" height=\"256\" width=\"930\"></strong></p><h3 class=\"ql-align-justify\">Hiệu năng mạnh mẽ</h3><p class=\"ql-align-justify\">Sở hữu vi xử lý Intel® Core™ i7-1355U với 10 nhân 12 luồng, xung nhịp tối đa 4.70GHz và 12MB Smart Cache, Dell Inspiron 15 3530 mang lại khả năng xử lý mượt mà các ứng dụng văn phòng như Word, Excel hay các phần mềm đồ họa như Photoshop, Illustrator. Card đồ họa Intel Iris Xe Graphics đảm bảo hiệu năng ổn định cho các tác vụ thiết kế 2D và chơi game nhẹ như LOL, FIFA.</p><p class=\"ql-align-center\"><strong><img src=\"https://phucanhcdn.com/media/lib/22-01-2025/2101_reviewdellinspiron353071053721-pa29.png\" alt=\"Laptop Dell Inspiron 3530 71053721\" height=\"524\" width=\"485\"><img src=\"https://phucanhcdn.com/media/lib/22-01-2025/2101_reviewdellinspiron353071053721-pa30.png\" alt=\"Laptop Dell Inspiron 3530 71053721\" height=\"371\" width=\"1084\"></strong></p><p><br></p>', '2025-06-18 00:40:48', '2025-06-18 00:40:48'),
(11, 10, 'vi', 'Laptop Apple Macbook Air M2 MC7W4SA/A (8 core CPU/ 8 core GPU/ 16GB/ 256GB/ 13.6Inch/ Mac OS/ Starlight)', 'Bảo hành: 12 Tháng. Tại trung tâm bảo hành chính hãng Apple Việt Nam.', NULL, '2025-06-18 00:44:06', '2025-06-18 00:44:34'),
(12, 9, 'vi', 'Ram desktop Kingston Fury Beast 16GB DDR5 5600MHz (KF556C40BB-16)', 'Bảo hành: 36 Tháng. Hàng chính hãng, bảo hành tại Phúc Anh. Đổi mới 30 ngày', '<p class=\"ql-align-justify\">Tới&nbsp;<strong style=\"color: red;\">PHÚC ANH</strong>&nbsp;an tâm mua sắm những sản phẩm&nbsp;<strong>CHÍNH HÃNG – GIAO HÀNG TẬN NƠI</strong></p><h2 class=\"ql-align-justify\">Ram Kingston Fury Beast 16GB (1x16GB) DDR5 5600MHz (KF556C40BB-16)</h2><p class=\"ql-align-justify\"><a href=\"https://www.phucanh.vn/bo-nho-trong-linh-kien-pc.html\" target=\"_blank\" style=\"color: rgb(51, 102, 255);\"><strong>RAM</strong></a>&nbsp;Kingston Fury Beast 16GB (KF556C40BB-16) là một trong những&nbsp;<a href=\"https://www.phucanh.vn/linh-kien-pc-lap-rap.html\" target=\"_blank\" style=\"color: rgb(51, 102, 255);\"><strong>linh kiện PC</strong></a>&nbsp;đột phá của thương hiệu Kingston, mang đến hiệu năng vượt trội cùng độ tin cậy cao cho người dùng. Với dung lượng 16GB và tốc độ bus lên đến 5600MHz, sản phẩm này là lựa chọn lý tưởng cho các hệ thống máy tính hiện đại, đáp ứng nhu cầu xử lý dữ liệu nhanh chóng và mượt mà. Đây là dòng RAM DDR5 mới nhất, được thiết kế dành riêng cho những người dùng muốn nâng cấp máy tính để đạt hiệu suất tối ưu trong các tác vụ đa nhiệm và gaming.</p><p class=\"ql-align-justify\">&nbsp;<img src=\"https://phucanhcdn.com/media/product/54727_ram_kingston_fury_beast_16gb_2.jpg\" alt=\"Ram Kingston Fury Beast 16GB (1x16GB) DDR5 5600MHz (KF556C40BB-16)\" height=\"600\" width=\"600\"></p><h3 class=\"ql-align-justify\">Tăng tốc hiệu năng với công nghệ DDR5 tiên tiến</h3><p class=\"ql-align-justify\">RAM Kingston Fury Beast sử dụng công nghệ DDR5 tiên tiến, giúp nâng cao tốc độ và khả năng xử lý dữ liệu vượt trội so với các dòng DDR4 trước đó. Với tốc độ bus 5600MHz, sản phẩm mang lại tốc độ truyền tải dữ liệu nhanh gấp đôi, cho phép người dùng xử lý các tác vụ phức tạp, từ chỉnh sửa video, đồ họa đến các game nặng mà không gặp phải hiện tượng giật lag. Sự cải tiến này giúp các hệ thống máy tính đạt hiệu suất tối đa, đồng thời tiết kiệm thời gian cho người dùng trong việc xử lý các tác vụ hàng ngày.</p><p class=\"ql-align-justify\">&nbsp;<img src=\"https://phucanhcdn.com/media/product/54727_ram_kingston_fury_beast_16gb_1.jpg\" alt=\"Ram Kingston Fury Beast 16GB (1x16GB) DDR5 5600MHz (KF556C40BB-16)\" height=\"600\" width=\"600\"></p><h3 class=\"ql-align-justify\">Dung lượng RAM lớn 16GB đáp ứng mọi nhu cầu sử dụng</h3><p class=\"ql-align-justify\">Dung lượng 16GB của RAM Kingston Fury Beast là một điểm cộng lớn, đủ để đáp ứng các nhu cầu sử dụng từ cơ bản đến nâng cao. Đây là dung lượng lý tưởng cho những người dùng thường xuyên làm việc với nhiều ứng dụng cùng lúc hoặc cần khả năng xử lý dữ liệu lớn trong các dự án sáng tạo và kỹ thuật. Ngoài ra, dung lượng 16GB cũng giúp hệ thống hoạt động mượt mà trong các trò chơi yêu cầu cấu hình cao, giúp người dùng trải nghiệm game một cách trọn vẹn và chân thực.</p><h3 class=\"ql-align-justify\">Thiết kế không LED - Tối ưu cho hiệu suất và sự ổn định</h3><p class=\"ql-align-justify\">RAM Kingston Fury Beast không tích hợp đèn LED, một lựa chọn lý tưởng cho những người dùng yêu thích sự tối giản và chú trọng vào hiệu suất. Không có LED giúp sản phẩm giảm thiểu tiêu thụ năng lượng không cần thiết, đồng thời giữ cho nhiệt độ ổn định hơn trong suốt quá trình hoạt động. Với thiết kế không LED, RAM Kingston Fury Beast hướng tới đối tượng người dùng chú trọng vào chất lượng và độ bền bỉ của sản phẩm, giúp máy tính hoạt động ổn định trong thời gian dài.</p><h3 class=\"ql-align-justify\">Điện áp thấp 1.1V – Tiết kiệm điện năng, tăng tuổi thọ thiết bị</h3><p class=\"ql-align-justify\">Điện áp hoạt động chỉ 1.1V là một trong những đặc điểm nổi bật của RAM Kingston Fury Beast. Mức điện áp này không chỉ giúp tiết kiệm điện năng mà còn làm giảm nhiệt độ của thiết bị, từ đó tăng cường độ bền và tuổi thọ cho linh kiện. Việc tiêu thụ ít điện năng hơn cũng giúp cho máy tính hoạt động ổn định hơn, đặc biệt trong những trường hợp sử dụng lâu dài. Điều này rất quan trọng đối với những người dùng cần một hệ thống đáng tin cậy cho công việc liên tục.</p><h3 class=\"ql-align-justify\">Độ trễ thấp CL40 – Cải thiện khả năng đáp ứng của hệ thống</h3><p class=\"ql-align-justify\">RAM Kingston Fury Beast có độ trễ CL40, giúp tối ưu hóa tốc độ truy xuất dữ liệu và tăng khả năng đáp ứng của hệ thống. Độ trễ thấp là một yếu tố quan trọng với các sản phẩm RAM cao cấp, cho phép hệ thống phản hồi nhanh hơn với các tác vụ nặng. Điều này đặc biệt hữu ích trong các trò chơi và ứng dụng yêu cầu tốc độ xử lý cao, giúp người dùng có trải nghiệm mượt mà và không bị gián đoạn trong quá trình làm việc hoặc giải trí.</p><h3 class=\"ql-align-justify\">Công nghệ Non-ECC – Phù hợp cho người dùng phổ thông và game thủ</h3><p class=\"ql-align-justify\">Sản phẩm được thiết kế với công nghệ Non-ECC (Non-Error Correcting Code), phù hợp cho các ứng dụng phổ thông và chơi game. Non-ECC là lựa chọn phổ biến cho các dòng RAM dùng trong máy tính cá nhân, cung cấp khả năng xử lý nhanh chóng mà không làm tăng chi phí hoặc phức tạp hóa thiết kế. Với Non-ECC, RAM Kingston Fury Beast đáp ứng tốt các yêu cầu của người dùng cá nhân, từ các tác vụ văn phòng đơn giản đến các trò chơi hiện đại, đảm bảo hiệu năng ổn định.</p><p class=\"ql-align-justify\">RAM Kingston Fury Beast 16GB DDR5 5600MHz (KF556C40BB-16) là lựa chọn lý tưởng cho người dùng cần nâng cấp hiệu năng cho máy tính cá nhân hoặc máy tính chuyên dụng cho gaming. Với dung lượng lớn, tốc độ vượt trội, thiết kế không LED cùng với điện áp thấp và độ trễ tối ưu, sản phẩm này mang đến trải nghiệm mượt mà và bền bỉ cho các tác vụ từ nhẹ đến nặng.</p><p><br></p>', '2025-06-18 00:49:08', '2025-06-18 00:49:08'),
(13, 8, 'vi', 'Laptop Acer Aspire Gaming 7 A715-59G-73LB', 'Học sinh, sinh viên giảm tới 300.000 ₫ (Chi tiết)\r\nBảo hành: 12 Tháng. Tại hãng. Đổi mới 30 ngày', NULL, '2025-06-18 00:52:36', '2025-06-18 00:58:58'),
(14, 7, 'vi', 'Laptop Apple Macbook Pro M4 pro MX2E3SA/A', 'Bảo hành: 12 Tháng. Tại trung tâm bảo hành chính hãng Apple Việt Nam.', NULL, '2025-06-18 00:56:36', '2025-06-18 00:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_views`
--

CREATE TABLE `product_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_views`
--

INSERT INTO `product_views` (`id`, `product_id`, `ip`, `viewed_at`) VALUES
(3, 12, NULL, '2025-04-09 02:23:32'),
(4, 8, NULL, '2025-04-15 07:02:14'),
(5, 8, NULL, '2025-04-15 07:04:08'),
(6, 8, NULL, '2025-04-15 07:04:20'),
(7, 8, NULL, '2025-04-15 07:04:32'),
(8, 8, NULL, '2025-04-15 07:04:36'),
(9, 8, NULL, '2025-04-15 07:04:45'),
(10, 8, NULL, '2025-04-15 07:04:51'),
(11, 8, NULL, '2025-04-15 07:05:00'),
(12, 12, NULL, '2025-04-15 09:24:53'),
(13, 12, NULL, '2025-04-15 09:27:13'),
(14, 12, NULL, '2025-04-15 09:27:43'),
(15, 12, NULL, '2025-04-15 09:38:08'),
(16, 12, NULL, '2025-04-15 09:46:09'),
(17, 12, NULL, '2025-04-15 09:47:04'),
(18, 12, NULL, '2025-04-15 09:50:44'),
(19, 12, NULL, '2025-04-15 09:51:41'),
(20, 12, NULL, '2025-04-15 09:51:55'),
(21, 12, NULL, '2025-04-15 09:52:04'),
(22, 12, NULL, '2025-04-15 09:52:28'),
(23, 12, NULL, '2025-04-15 09:52:34'),
(24, 12, NULL, '2025-04-15 09:54:37'),
(25, 12, NULL, '2025-04-15 09:56:57'),
(26, 12, NULL, '2025-04-15 09:57:44'),
(27, 12, NULL, '2025-04-15 09:58:19'),
(28, 12, NULL, '2025-04-15 09:59:41'),
(29, 12, NULL, '2025-04-15 10:01:03'),
(30, 12, NULL, '2025-04-15 10:01:21'),
(31, 12, NULL, '2025-04-15 10:01:51'),
(32, 12, NULL, '2025-04-15 10:02:29'),
(33, 12, NULL, '2025-04-15 10:03:05'),
(34, 12, NULL, '2025-04-15 10:03:19'),
(35, 12, NULL, '2025-04-15 10:03:23'),
(36, 7, NULL, '2025-04-16 01:25:25'),
(37, 7, NULL, '2025-04-16 01:26:37'),
(38, 7, NULL, '2025-04-16 01:29:27'),
(39, 7, NULL, '2025-04-16 01:29:32'),
(40, 7, NULL, '2025-04-16 01:30:39'),
(41, 7, NULL, '2025-04-16 01:30:49'),
(42, 7, NULL, '2025-04-16 01:31:01'),
(43, 7, NULL, '2025-04-16 01:31:46'),
(44, 7, NULL, '2025-04-16 01:31:51'),
(45, 7, NULL, '2025-04-16 01:32:39'),
(46, 7, NULL, '2025-04-16 01:32:49'),
(47, 7, NULL, '2025-04-16 01:32:52'),
(48, 12, NULL, '2025-04-16 01:39:24'),
(49, 12, NULL, '2025-04-16 01:40:05'),
(50, 12, NULL, '2025-04-16 01:40:13'),
(51, 12, NULL, '2025-04-16 01:42:07'),
(52, 12, NULL, '2025-04-16 01:42:39'),
(53, 12, NULL, '2025-04-16 01:43:23'),
(54, 12, NULL, '2025-04-16 01:43:36'),
(55, 12, NULL, '2025-04-16 01:44:56'),
(56, 12, NULL, '2025-04-16 01:48:24'),
(57, 12, NULL, '2025-04-16 01:50:01'),
(58, 12, NULL, '2025-04-16 01:51:00'),
(59, 12, NULL, '2025-04-16 01:51:28'),
(60, 12, NULL, '2025-04-17 09:57:13'),
(61, 12, NULL, '2025-04-17 09:58:12'),
(62, 12, NULL, '2025-04-17 09:59:21'),
(63, 12, NULL, '2025-04-17 09:59:36'),
(64, 12, NULL, '2025-04-17 10:00:20'),
(65, 12, NULL, '2025-04-17 10:01:34'),
(66, 12, NULL, '2025-04-17 10:02:16'),
(67, 12, NULL, '2025-04-17 10:02:32'),
(68, 12, NULL, '2025-04-21 01:41:17'),
(69, 12, NULL, '2025-04-21 01:41:51'),
(70, 12, NULL, '2025-04-21 01:42:52'),
(71, 12, NULL, '2025-04-21 01:43:03'),
(72, 12, NULL, '2025-04-21 01:57:00'),
(73, 12, NULL, '2025-04-21 02:05:10'),
(78, 12, NULL, '2025-06-17 08:54:36'),
(79, 4, NULL, '2025-06-18 07:12:39'),
(80, 4, NULL, '2025-06-18 07:14:19'),
(81, 4, NULL, '2025-06-18 07:16:51'),
(82, 8, NULL, '2025-06-18 07:17:45'),
(83, 4, NULL, '2025-06-18 07:18:10'),
(84, 4, NULL, '2025-06-18 07:19:42'),
(85, 4, NULL, '2025-06-18 07:21:25'),
(86, 4, NULL, '2025-06-18 07:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `rating` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `full_name`, `email`, `content`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 'nam', 'emalea', '123', 2, 0, '2025-04-16 08:51:08', '2025-04-16 08:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('WP1waVcq7bfWco9wPwOWKaRiN5lKOxq9Jk3bRKaQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQXN0dkp3SzB2TDc0ZW9pZm54SkRIY3ZGdFZtbTUwNDEydW5TNU5STSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9nZXQtY2FydHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1750233559);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'admin@gmail.com', NULL, '1', '$2y$12$IkRC5TEgDzNZhMr6thdQ9.915pn5N6901NbyTbY0C/v48LZJOXIBS', NULL, '2025-03-31 19:47:25', '2025-03-31 19:47:25'),
(3, 'hoten', 'monster2k28@gmail.com', NULL, '2', '$2y$12$oETF6Y8K7WJ75KlewIFRluRa9tJUe.pbl70.dzD2.BrpwkdFasDU6', NULL, '2025-04-09 01:00:35', '2025-04-09 01:00:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_translations_blog_id_language_code_unique` (`blog_id`,`language_code`),
  ADD UNIQUE KEY `blog_translations_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_translations_category_id_language_code_unique` (`category_id`,`language_code`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_characteristics`
--
ALTER TABLE `product_characteristics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_characteristic_translations`
--
ALTER TABLE `product_characteristic_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_translations_product_id_language_code_unique` (`product_id`,`language_code`);

--
-- Indexes for table `product_views`
--
ALTER TABLE `product_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_characteristics`
--
ALTER TABLE `product_characteristics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_characteristic_translations`
--
ALTER TABLE `product_characteristic_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `product_translations`
--
ALTER TABLE `product_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_views`
--
ALTER TABLE `product_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
