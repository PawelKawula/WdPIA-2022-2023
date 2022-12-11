/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100518 (10.5.18-MariaDB-0+deb11u1)
 Source Host           : localhost:3306
 Source Schema         : WdpiaShop

 Target Server Type    : MariaDB
 Target Server Version : 100518 (10.5.18-MariaDB-0+deb11u1)
 File Encoding         : 65001

 Date: 22/01/2023 14:31:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
USE WdpiaShop;

-- ----------------------------
-- Table structure for addresses
-- ----------------------------
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id_addresses` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `locality` varchar(255) NOT NULL,
  `postal_code` char(6) NOT NULL,
  `route` varchar(255) NOT NULL,
  `street_number` int(11) unsigned NOT NULL,
  `apartament_number` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_addresses`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of addresses
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id_categories` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_categories`),
  UNIQUE KEY `name_unique` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
BEGIN;
INSERT INTO `categories` (`id_categories`, `name`, `description`) VALUES (1, 'CPU', 'Central Processing Units');
INSERT INTO `categories` (`id_categories`, `name`, `description`) VALUES (2, 'GPU', 'Graphical Processing Unit');
INSERT INTO `categories` (`id_categories`, `name`, `description`) VALUES (3, 'Motherboard', NULL);
INSERT INTO `categories` (`id_categories`, `name`, `description`) VALUES (4, 'RAM', 'Random Access Memory');
INSERT INTO `categories` (`id_categories`, `name`, `description`) VALUES (5, 'Case', NULL);
INSERT INTO `categories` (`id_categories`, `name`, `description`) VALUES (6, 'Disk', NULL);
INSERT INTO `categories` (`id_categories`, `name`, `description`) VALUES (7, 'Controller', NULL);
COMMIT;

-- ----------------------------
-- Table structure for order_items
-- ----------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id_order_items` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_id_products` int(11) unsigned NOT NULL,
  `fk_id_orders` int(11) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id_order_items`) USING BTREE,
  KEY `order_items_products` (`fk_id_products`),
  KEY `order_items_orders__FK` (`fk_id_orders`),
  CONSTRAINT `order_items_orders__FK` FOREIGN KEY (`fk_id_orders`) REFERENCES `orders` (`id_orders`),
  CONSTRAINT `order_items_products` FOREIGN KEY (`fk_id_products`) REFERENCES `products` (`id_products`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of order_items
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id_orders` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_id_users` int(11) unsigned NOT NULL,
  `fk_id_payments` int(11) unsigned NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_orders`),
  KEY `orders_payments__FK` (`fk_id_payments`),
  KEY `orders_users__FK` (`fk_id_users`),
  CONSTRAINT `orders_payments__FK` FOREIGN KEY (`fk_id_payments`) REFERENCES `payments` (`id_payments`),
  CONSTRAINT `orders_users__FK` FOREIGN KEY (`fk_id_users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id_payments` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_card_payments` int(16) unsigned DEFAULT NULL,
  `fk_blik_payments` int(16) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_payments`),
  KEY `payments_payments_card__FK` (`fk_card_payments`),
  KEY `payments_payment_blik__FK` (`fk_blik_payments`),
  CONSTRAINT `payments_payment_blik__FK` FOREIGN KEY (`fk_blik_payments`) REFERENCES `payments_bliks` (`id_payments_blik`),
  CONSTRAINT `payments_payments_card__FK` FOREIGN KEY (`fk_card_payments`) REFERENCES `payments_cards` (`id_card_payments`),
  CONSTRAINT `at_least_one_payment_method` CHECK (`fk_card_payments` is not null and `fk_blik_payments` is null or `fk_blik_payments` is not null and `fk_card_payments` is null)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of payments
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for payments_bliks
-- ----------------------------
DROP TABLE IF EXISTS `payments_bliks`;
CREATE TABLE `payments_bliks` (
  `id_payments_blik` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blik` decimal(6,0) NOT NULL,
  PRIMARY KEY (`id_payments_blik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of payments_bliks
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for payments_cards
-- ----------------------------
DROP TABLE IF EXISTS `payments_cards`;
CREATE TABLE `payments_cards` (
  `id_card_payments` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `card_number` varchar(16) NOT NULL,
  `expiration_date_month` tinyint(4) unsigned NOT NULL,
  `expiration_date_year` smallint(7) NOT NULL,
  `cvv` decimal(3,0) NOT NULL,
  PRIMARY KEY (`id_card_payments`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of payments_cards
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id_products` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_id_categories` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_products`),
  UNIQUE KEY `name_unique` (`name`) USING BTREE,
  KEY `products_categories__FK` (`fk_id_categories`),
  CONSTRAINT `products_categories__FK` FOREIGN KEY (`fk_id_categories`) REFERENCES `categories` (`id_categories`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
BEGIN;
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (1, 1, 'Xeon E3 1231-v3', NULL, 5, 899.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (2, 1, 'Core 2 Duo', NULL, 2, 499.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (3, 1, 'Ryzen Pro', NULL, 2, 1499.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (4, 1, 'Ryzen 4000', NULL, 2, 1299.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (5, 2, 'RTX 3070', NULL, 2, 3999.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (6, 2, 'Vega 2000', NULL, 3, 2199.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (7, 3, 'MSI B85 Pro Gaming', NULL, 2, 399.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (8, 3, 'AsRock Z370', NULL, 3, 499.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (9, 3, 'Gigabyte B660M DS3H DDR4 ', NULL, 2, 529.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (10, 3, 'Asus PRIME B660-PLUS D4', NULL, 4, 727.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (11, 3, 'Asus PRIME Z690-P D4', NULL, 9, 949.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (12, 3, 'Gigabyte H510M H', NULL, 4, 329.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (13, 3, 'Gigabyte H410M H V3', NULL, 12, 309.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (14, 3, 'Asus TUF GAMING B550-PLUS', NULL, 5, 749.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (15, 4, 'Kingston Fury Beast, DDR4, 16 GB, 3600MHz, CL17', NULL, 30, 285.39, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (16, 4, 'Lexar Thor, DDR4, 16 GB, 3200MHz, CL16', NULL, 12, 275.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (17, 4, 'Corsair Vengeance LPX, DDR4, 16 GB, 3200MHz, CL16', NULL, 25, 259.81, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (18, 4, 'Gigabyte AORUS RGB, DDR4, 16 GB, 3333MHz, CL18 ', NULL, 4, 319.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (19, 4, 'G.Skill Trident Z RGB, DDR4, 16 GB, 3200MHz, CL16', NULL, 12, 387.29, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (20, 4, 'Corsair Vengeance, DDR5, 32 GB, 5600MHz, CL36', NULL, 2, 999.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (21, 5, 'SilentiumPC Ventum VT2 EVO TG ARGB', NULL, 4, 309.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (22, 5, 'ENDORFY Signum 300 ARGB', NULL, 5, 369.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (23, 5, 'Genesis IRID 505 V2 MIDI TOWER', NULL, 7, 289.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (24, 5, 'be quiet! Silent Base 601', NULL, 1, 737.75, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (25, 5, 'Cooler Master MasterBox TD500 Mesh White', NULL, 4, 550.40, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (26, 5, 'Gigabyte C200 Glass', NULL, 6, 389.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (27, 5, 'SilentiumPC Armis AR1', NULL, 2, 149.90, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (28, 6, 'Lexar NM620 1 TB M.2 2280 PCI-E x4 Gen3 NVMe', NULL, 6, 355.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (29, 6, 'Samsung 980 1 TB M.2 2280 PCI-E x4 Gen3 NVMe', NULL, 2, 419.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (30, 6, 'Lexar NM610 PRO 2 TB M.2 2280 PCI-E x4 Gen3 NVMe', NULL, 4, 499.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (31, 6, 'MSI Spatium M390 1 TB M.2 2280 PCI-E x4 Gen3 NVMe', NULL, 2, 429.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (32, 6, 'Samsung 980 PRO 2 TB M.2 2280 PCI-E x4 Gen4 NVMe', NULL, 1, 1299.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (33, 6, 'Gigabyte Aorus Gen4 7000s 2 TB M.2 2280 PCI-E x4 Gen4', NULL, 2, 1089.31, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (34, 7, 'Asus PCIe 3.0 x16 - 4x M.2 M-key Hyper M.2 X16 Card V2', NULL, 8, 207.92, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (35, 7, 'Digitus PCIe - Firewire 1394a 3+1', NULL, 4, 105.00, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (36, 7, 'MicroConnect PCIe 2.0 x1 - 2x eSATA + 2x SATA III', NULL, 7, 116.81, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (37, 7, 'SilverStone PCIe 2.0 x1 - 2x USB 3.0 + 20pin USB 3.0', NULL, 5, 142.39, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (38, 7, 'Kontroler Icy Box PCIe 4.0 x4 - M.2 PCIe NVMe', NULL, 7, 89.39, NULL);
INSERT INTO `products` (`id_products`, `fk_id_categories`, `name`, `description`, `quantity`, `price`, `image`) VALUES (39, 7, 'Lanberg 4x USB 3.1 gen 1', NULL, 8, 61.99, NULL);
COMMIT;

-- ----------------------------
-- Table structure for user_addresses
-- ----------------------------
DROP TABLE IF EXISTS `user_addresses`;
CREATE TABLE `user_addresses` (
  `id_user_addresses` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_id_addresses` int(11) unsigned NOT NULL,
  `fk_id_users` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_user_addresses`),
  KEY `user_address_users__FK` (`fk_id_users`),
  KEY `user_address_addresses` (`fk_id_addresses`),
  CONSTRAINT `user_address_addresses` FOREIGN KEY (`fk_id_addresses`) REFERENCES `addresses` (`id_addresses`),
  CONSTRAINT `user_address_users__FK` FOREIGN KEY (`fk_id_users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of user_addresses
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_users` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id_users`),
  UNIQUE KEY `email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users_details
-- ----------------------------
DROP TABLE IF EXISTS `users_details`;
CREATE TABLE `users_details` (
  `fk_users` int(11) unsigned NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  KEY `users_details_users__FK` (`fk_users`),
  CONSTRAINT `users_details_users__FK` FOREIGN KEY (`fk_users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of users_details
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
