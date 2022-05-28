-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table 6111011940001_db.categorys_ingredients
CREATE TABLE IF NOT EXISTS `categorys_ingredients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.categorys_ingredients: ~1 rows (approximately)
/*!40000 ALTER TABLE `categorys_ingredients` DISABLE KEYS */;
INSERT INTO `categorys_ingredients` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'วัตถุดิบ', 'วัตถุดิบ', '2022-02-27 12:56:28', '2022-02-27 12:56:28');
/*!40000 ALTER TABLE `categorys_ingredients` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.categorys_packagings
CREATE TABLE IF NOT EXISTS `categorys_packagings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.categorys_packagings: ~1 rows (approximately)
/*!40000 ALTER TABLE `categorys_packagings` DISABLE KEYS */;
INSERT INTO `categorys_packagings` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'บรรจุภัณฑ์', 'บรรจุภัณฑ์', '2022-02-27 12:56:28', '2022-02-27 12:56:28');
/*!40000 ALTER TABLE `categorys_packagings` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.categorys_products
CREATE TABLE IF NOT EXISTS `categorys_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.categorys_products: ~1 rows (approximately)
/*!40000 ALTER TABLE `categorys_products` DISABLE KEYS */;
INSERT INTO `categorys_products` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'ผลิตภัณฑ์', 'ผลิตภัณฑ์', '2022-02-27 12:56:28', '2022-02-27 12:56:28');
/*!40000 ALTER TABLE `categorys_products` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.export_ingredients_items
CREATE TABLE IF NOT EXISTS `export_ingredients_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idrm` int(10) unsigned NOT NULL,
  `UID` int(10) unsigned NOT NULL,
  `PID` int(10) unsigned NOT NULL,
  `rc_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LOT_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `export_at` date NOT NULL,
  `invoice_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty_charge` double(15,5) NOT NULL,
  `qty_balance` double(15,5) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_product` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.export_ingredients_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `export_ingredients_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `export_ingredients_items` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.export_packagings_items
CREATE TABLE IF NOT EXISTS `export_packagings_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpack` int(10) unsigned NOT NULL,
  `UID` int(10) unsigned NOT NULL,
  `PID` int(10) unsigned NOT NULL,
  `rc_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LOT_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `export_at` date NOT NULL,
  `invoice_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty_charge` double(15,5) NOT NULL,
  `qty_balance` double(15,5) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_product` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.export_packagings_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `export_packagings_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `export_packagings_items` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.export_product_items
CREATE TABLE IF NOT EXISTS `export_product_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproduct` int(10) unsigned NOT NULL,
  `UID` int(10) unsigned NOT NULL,
  `PID` int(10) unsigned NOT NULL,
  `export_at` date NOT NULL,
  `order_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty_charge` double(15,2) NOT NULL,
  `qty_balance` double(15,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.export_product_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `export_product_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `export_product_items` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.import_ingredients_items
CREATE TABLE IF NOT EXISTS `import_ingredients_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idrm` int(10) unsigned NOT NULL,
  `UID` int(10) unsigned NOT NULL,
  `PID` int(10) unsigned NOT NULL,
  `rc_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LOT_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `import_at` date NOT NULL,
  `MFG` date NOT NULL,
  `EXP` date NOT NULL,
  `invoice_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty_charge` double(15,2) NOT NULL,
  `qty_balance` double(15,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storageID` int(10) unsigned NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.import_ingredients_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `import_ingredients_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `import_ingredients_items` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.import_packagings_items
CREATE TABLE IF NOT EXISTS `import_packagings_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpack` int(10) unsigned NOT NULL,
  `UID` int(10) unsigned NOT NULL,
  `PID` int(10) unsigned NOT NULL,
  `rc_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LOT_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `import_at` date NOT NULL,
  `MFG` date NOT NULL,
  `EXP` date NOT NULL,
  `invoice_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty_charge` double(15,2) NOT NULL,
  `qty_balance` double(15,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storageID` int(10) unsigned NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.import_packagings_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `import_packagings_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `import_packagings_items` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.import_product_items
CREATE TABLE IF NOT EXISTS `import_product_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproduct` int(10) unsigned NOT NULL,
  `UID` int(10) unsigned NOT NULL,
  `PID` int(10) unsigned NOT NULL,
  `Batch_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `import_at` date NOT NULL,
  `MFG` date NOT NULL,
  `EXP` date NOT NULL,
  `qty_charge` double(15,2) NOT NULL,
  `qty_balance` double(15,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storageID` int(10) unsigned NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.import_product_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `import_product_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `import_product_items` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.item_ingredients
CREATE TABLE IF NOT EXISTS `item_ingredients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CID` int(10) unsigned NOT NULL,
  `itemname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(15,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ingredients-demo.png',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.item_ingredients: ~0 rows (approximately)
/*!40000 ALTER TABLE `item_ingredients` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_ingredients` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.item_packagings
CREATE TABLE IF NOT EXISTS `item_packagings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CID` int(10) unsigned NOT NULL,
  `itemname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(15,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'packagings-demo.png',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.item_packagings: ~0 rows (approximately)
/*!40000 ALTER TABLE `item_packagings` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_packagings` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.item_products
CREATE TABLE IF NOT EXISTS `item_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CID` int(10) unsigned NOT NULL,
  `itemname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double(15,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product-demo.png',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.item_products: ~0 rows (approximately)
/*!40000 ALTER TABLE `item_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_products` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.migrations: ~17 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(120, '2014_10_12_000000_create_users_table', 1),
	(121, '2021_12_15_021508_create_usertypes_table', 1),
	(122, '2021_12_15_021801_create_peoples_table', 1),
	(123, '2021_12_15_021938_create_people_groups_table', 1),
	(124, '2021_12_15_022050_create_storages_table', 1),
	(125, '2021_12_15_195421_create_item_products_table', 1),
	(126, '2021_12_15_195610_create_item_ingredients_table', 1),
	(127, '2021_12_15_195659_create_import_product_items_table', 1),
	(128, '2021_12_15_195720_create_import_ingredients_items_table', 1),
	(129, '2021_12_15_195750_create_export_ingredients_items_table', 1),
	(130, '2021_12_15_195804_create_export_product_items_table', 1),
	(131, '2021_12_16_074437_create_categorys_ingredients_table', 1),
	(132, '2021_12_16_074514_create_categorys_products_table', 1),
	(133, '2022_02_14_105742_create_item_packagings_table', 1),
	(134, '2022_02_14_110822_create_categorys_packagings_table', 1),
	(135, '2022_02_14_110953_create_import_packagings_items_table', 1),
	(136, '2022_02_14_111008_create_export_packagings_items_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.peoples
CREATE TABLE IF NOT EXISTS `peoples` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `GID` int(10) unsigned NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.peoples: ~1 rows (approximately)
/*!40000 ALTER TABLE `peoples` DISABLE KEYS */;
INSERT INTO `peoples` (`id`, `GID`, `firstname`, `lastname`, `image`, `description`, `created_at`, `updated_at`) VALUES
	(1, 1, 'แอดมิน', 'administrator', 'avatar.png', NULL, '2022-02-27 12:56:28', '2022-02-27 12:56:28');
/*!40000 ALTER TABLE `peoples` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.people_groups
CREATE TABLE IF NOT EXISTS `people_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.people_groups: ~1 rows (approximately)
/*!40000 ALTER TABLE `people_groups` DISABLE KEYS */;
INSERT INTO `people_groups` (`id`, `role`, `description`) VALUES
	(1, 'ผู้เบิก', NULL);
/*!40000 ALTER TABLE `people_groups` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.storages
CREATE TABLE IF NOT EXISTS `storages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.storages: ~3 rows (approximately)
/*!40000 ALTER TABLE `storages` DISABLE KEYS */;
INSERT INTO `storages` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'คลังเก็บวัตถุดิบ', 'ที่เก็บวัตถุดิบ', '2022-02-27 12:56:28', '2022-02-27 12:56:28'),
	(2, 'คลังเก็บผลิตภัณฑ์', 'ที่เก็บผลิตภัณฑ์', '2022-02-27 12:56:28', '2022-02-27 12:56:28'),
	(3, 'คลังเก็บบรรจุภัณฑ์', 'ที่เก็บบรรจุภัณฑ์', '2022-02-27 12:56:28', '2022-02-27 12:56:28');
/*!40000 ALTER TABLE `storages` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `firstname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passwordResetCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `role_id`, `firstname`, `lastname`, `phone`, `email`, `password`, `image`, `api_token`, `remember_token`, `passwordResetCode`, `created_at`, `updated_at`) VALUES
	(1, 1, 'แอดมิน', 'administrator', '1290394024', 'administrator@gmail.com', '$2y$10$NJnY7c00PEQ6mLmOGEl8xu4BRhbtDQqZWmriXReb0N.KnEL59QB26', 'avatar.png', NULL, NULL, NULL, '2022-02-27 12:56:28', '2022-02-27 12:56:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table 6111011940001_db.usertypes
CREATE TABLE IF NOT EXISTS `usertypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 6111011940001_db.usertypes: ~1 rows (approximately)
/*!40000 ALTER TABLE `usertypes` DISABLE KEYS */;
INSERT INTO `usertypes` (`id`, `role`, `permission`, `description`) VALUES
	(1, 'ผู้ปฎิบัติงาน', NULL, NULL);
/*!40000 ALTER TABLE `usertypes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
