-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 01, 2024 at 12:37 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `montant` varchar(50) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `users_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_users` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_elements`
--

DROP TABLE IF EXISTS `invoice_elements`;
CREATE TABLE IF NOT EXISTS `invoice_elements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL,
  `stocks_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_element_invoice` (`invoice_id`),
  KEY `fk_invoice_element_stocks` (`stocks_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` int NOT NULL,
  `supplier_id` int NOT NULL,
  `warehouse_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_supplier` (`supplier_id`),
  KEY `fk_products_warehouse` (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'Admin', ''),
(2, 'Agent', ''),
(3, 'Customer', '');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `expire_date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_products`
--

DROP TABLE IF EXISTS `stock_products`;
CREATE TABLE IF NOT EXISTS `stock_products` (
  `stock_id` int NOT NULL,
  `product_id` int NOT NULL,
  KEY `fk_stock_id` (`stock_id`),
  KEY `fk_product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `adress` varchar(125) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `postal_code` varchar(100) DEFAULT NULL,
  `phone` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `adress` varchar(100) DEFAULT NULL,
  `city` varchar(150) CHARACTER SET utf8 COLLATE utf8 DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `postal_code` varchar(6) CHARACTER SET utf8 COLLATE utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8 DEFAULT NULL,
  `email` varchar(125) CHARACTER SET utf8 COLLATE utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8 NOT NULL,
  `actif` int NOT NULL DEFAULT '1',
  `image` varchar(150) NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `designation`, `adress`, `city`, `province`, `country`, `postal_code`, `phone`, `email`, `password`, `actif`, `image`, `role_id`) VALUES
(2, 'Abdoulaye', 'Mohamed', 'Developer', '357 pascal avenue', 'Moncton', 'New Brunswick', 'country', '', '5068506548', 'admin@gmail.com', '$2y$10$mxu4KE3tqTdy8s34o1eTgu/pDFDcIptUbVh2MkC97XK24HRu02MKC', 1, 'agro piece.png', 1),
(3, 'Ali', 'Sani', '', '', '', '', 'country', '', '', 'm2atodev@gmail.com', '$2y$10$ZkWc4jbbtcp8KRB8424IkenOiahdqGHtYsAV.4qVTP7tGTSo6Pg5O', 1, '', 2),
(4, 'Fati', 'Amadou', 'Secretaire', '45 rue govin', 'Bathurst', 'New Brunswick', 'CA', 'E1A2C6', '5068598659', 'fati@gmail.com', '$2y$10$UfyW7UaIuxfnEuiMZS17JObEjaUvutOPHbDqp6DvFSr3dGdvNyClK', 1, '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_invoice_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice_elements`
--
ALTER TABLE `invoice_elements`
  ADD CONSTRAINT `fk_invoice_element_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `fk_invoice_element_stocks` FOREIGN KEY (`stocks_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `fk_products_warehouse` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`);

--
-- Constraints for table `stock_products`
--
ALTER TABLE `stock_products`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_stock_id` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
