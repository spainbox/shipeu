-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: shipeu
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adjustments`
--

DROP TABLE IF EXISTS `adjustments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adjustments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjustments`
--

LOCK TABLES `adjustments` WRITE;
/*!40000 ALTER TABLE `adjustments` DISABLE KEYS */;
/*!40000 ALTER TABLE `adjustments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `date` date NOT NULL,
  `data` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES ('2015-10-08','&lt;p&gt;Evento&lt;&sol;p&gt;',5);
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `captcha`
--

DROP TABLE IF EXISTS `captcha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `word` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `captcha`
--

LOCK TABLES `captcha` WRITE;
/*!40000 ALTER TABLE `captcha` DISABLE KEYS */;
/*!40000 ALTER TABLE `captcha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `image` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'C1','Category 1',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `combo_items`
--

DROP TABLE IF EXISTS `combo_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `combo_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `quantity` decimal(12,4) NOT NULL,
  `unit_price` decimal(25,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `combo_items`
--

LOCK TABLES `combo_items` WRITE;
/*!40000 ALTER TABLE `combo_items` DISABLE KEYS */;
INSERT INTO `combo_items` VALUES (1,3,'ART1',2.0000,10.0000),(2,3,'bb',1.0000,1.0000);
/*!40000 ALTER TABLE `combo_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned DEFAULT NULL,
  `group_name` varchar(20) NOT NULL,
  `customer_group_id` int(11) DEFAULT NULL,
  `customer_group_name` varchar(100) DEFAULT NULL,
  `name` varchar(55) NOT NULL,
  `company` varchar(255) NOT NULL,
  `vat_no` varchar(100) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(55) DEFAULT NULL,
  `postal_code` varchar(8) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cf1` varchar(100) DEFAULT NULL,
  `cf2` varchar(100) DEFAULT NULL,
  `cf3` varchar(100) DEFAULT NULL,
  `cf4` varchar(100) DEFAULT NULL,
  `cf5` varchar(100) DEFAULT NULL,
  `cf6` varchar(100) DEFAULT NULL,
  `invoice_footer` text,
  `payment_term` int(11) DEFAULT '0',
  `logo` varchar(255) DEFAULT 'logo.png',
  `award_points` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `group_id_2` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,3,'customer',1,'General','Walk-in Customer','Walk-in Customer','','Customer Address','Petaling Jaya','Selangor','46000','Malaysia','0123456789','customer@tecdiary.com','','','','','','',NULL,0,'logo.png',0),(3,NULL,'biller',NULL,NULL,'Manuel Gallego','SpainBox','5555','Calle X Numero X','Cordoba','Cordoba','','Spain','012345678','manuel@spainbox.com','','','','','','',' Thank you for shopping with us. Please come again',0,'Shipeu-small.png',0),(5,3,'customer',1,'General','Cliente','Cliente Empresa','','123','123','','','','123','cliente@example.com','','','','','','',NULL,0,'logo.png',0),(6,NULL,'biller',NULL,NULL,'Igor Igorovich','Varsovia Inc','','Varsovia Street 100','Varsovia','Varsovia','','Poland','112223344','igor@example.com','','','','','','','',0,'varsovia.png',0),(7,4,'supplier',NULL,NULL,'Varsovia','Varsovia INC','','Varsovia','Varsovia','','','Poland','123123','igor+supplier@example.com','','','','','','',NULL,0,'logo.png',0);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `costing`
--

DROP TABLE IF EXISTS `costing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `costing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sale_item_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `purchase_item_id` int(11) DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `purchase_net_unit_cost` decimal(25,4) DEFAULT NULL,
  `purchase_unit_cost` decimal(25,4) DEFAULT NULL,
  `sale_net_unit_price` decimal(25,4) NOT NULL,
  `sale_unit_price` decimal(25,4) NOT NULL,
  `quantity_balance` decimal(15,4) DEFAULT NULL,
  `inventory` tinyint(1) DEFAULT '0',
  `overselling` tinyint(1) DEFAULT '0',
  `option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `costing`
--

LOCK TABLES `costing` WRITE;
/*!40000 ALTER TABLE `costing` DISABLE KEYS */;
/*!40000 ALTER TABLE `costing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name` varchar(55) NOT NULL,
  `rate` decimal(12,4) NOT NULL,
  `auto_update` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'USD','US Dollar',1.0000,0),(2,'ERU','EURO',0.7340,0);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_groups`
--

DROP TABLE IF EXISTS `customer_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `percent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_groups`
--

LOCK TABLES `customer_groups` WRITE;
/*!40000 ALTER TABLE `customer_groups` DISABLE KEYS */;
INSERT INTO `customer_groups` VALUES (1,'General',0),(2,'Reseller',-5),(3,'Distributor',-15),(4,'New Customer (+10)',10);
/*!40000 ALTER TABLE `customer_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `date_format`
--

DROP TABLE IF EXISTS `date_format`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `date_format` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `js` varchar(20) NOT NULL,
  `php` varchar(20) NOT NULL,
  `sql` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `date_format`
--

LOCK TABLES `date_format` WRITE;
/*!40000 ALTER TABLE `date_format` DISABLE KEYS */;
INSERT INTO `date_format` VALUES (1,'mm-dd-yyyy','m-d-Y','%m-%d-%Y'),(2,'mm/dd/yyyy','m/d/Y','%m/%d/%Y'),(3,'mm.dd.yyyy','m.d.Y','%m.%d.%Y'),(4,'dd-mm-yyyy','d-m-Y','%d-%m-%Y'),(5,'dd/mm/yyyy','d/m/Y','%d/%m/%Y'),(6,'dd.mm.yyyy','d.m.Y','%d.%m.%Y');
/*!40000 ALTER TABLE `date_format` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sale_id` int(11) NOT NULL,
  `do_reference_no` varchar(50) NOT NULL,
  `sale_reference_no` varchar(50) NOT NULL,
  `customer` varchar(55) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliveries`
--

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reference` varchar(50) NOT NULL,
  `amount` decimal(25,4) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,'2015-10-11 12:15:00','123132',100.0000,'','1',NULL);
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gift_cards`
--

DROP TABLE IF EXISTS `gift_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gift_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `card_no` varchar(20) NOT NULL,
  `value` decimal(25,4) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `balance` decimal(25,4) NOT NULL,
  `expiry` date DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_no` (`card_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gift_cards`
--

LOCK TABLES `gift_cards` WRITE;
/*!40000 ALTER TABLE `gift_cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `gift_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'owner','Owner'),(2,'admin','Administrator'),(3,'customer','Customer'),(4,'supplier','Supplier'),(5,'sales','Sales Staff');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (308);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from_date` datetime DEFAULT NULL,
  `till_date` datetime DEFAULT NULL,
  `scope` tinyint(1) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_ref`
--

DROP TABLE IF EXISTS `order_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_ref` (
  `ref_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `so` int(11) NOT NULL DEFAULT '1',
  `qu` int(11) NOT NULL DEFAULT '1',
  `po` int(11) NOT NULL DEFAULT '1',
  `to` int(11) NOT NULL DEFAULT '1',
  `pos` int(11) NOT NULL DEFAULT '1',
  `do` int(11) NOT NULL DEFAULT '1',
  `pay` int(11) NOT NULL DEFAULT '1',
  `re` int(11) NOT NULL DEFAULT '1',
  `ex` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_ref`
--

LOCK TABLES `order_ref` WRITE;
/*!40000 ALTER TABLE `order_ref` DISABLE KEYS */;
INSERT INTO `order_ref` VALUES (1,'2015-03-01',1,1,1,1,1,1,1,1,1);
/*!40000 ALTER TABLE `order_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sale_id` int(11) DEFAULT NULL,
  `return_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `reference_no` varchar(50) NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `paid_by` varchar(20) NOT NULL,
  `cheque_no` varchar(20) DEFAULT NULL,
  `cc_no` varchar(20) DEFAULT NULL,
  `cc_holder` varchar(25) DEFAULT NULL,
  `cc_month` varchar(2) DEFAULT NULL,
  `cc_year` varchar(4) DEFAULT NULL,
  `cc_type` varchar(20) DEFAULT NULL,
  `amount` decimal(25,4) NOT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `pos_paid` decimal(25,4) DEFAULT '0.0000',
  `pos_balance` decimal(25,4) DEFAULT '0.0000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paypal`
--

DROP TABLE IF EXISTS `paypal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paypal` (
  `id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `paypal_currency` varchar(3) NOT NULL DEFAULT 'USD',
  `fixed_charges` decimal(25,4) NOT NULL DEFAULT '2.0000',
  `extra_charges_my` decimal(25,4) NOT NULL DEFAULT '3.9000',
  `extra_charges_other` decimal(25,4) NOT NULL DEFAULT '4.4000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paypal`
--

LOCK TABLES `paypal` WRITE;
/*!40000 ALTER TABLE `paypal` DISABLE KEYS */;
INSERT INTO `paypal` VALUES (1,1,'mypaypal@paypal.com','USD',0.0000,0.0000,0.0000);
/*!40000 ALTER TABLE `paypal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `products-index` tinyint(1) DEFAULT '0',
  `products-add` tinyint(1) DEFAULT '0',
  `products-edit` tinyint(1) DEFAULT '0',
  `products-delete` tinyint(1) DEFAULT '0',
  `products-cost` tinyint(1) DEFAULT '0',
  `products-price` tinyint(1) DEFAULT '0',
  `quotes-index` tinyint(1) DEFAULT '0',
  `quotes-add` tinyint(1) DEFAULT '0',
  `quotes-edit` tinyint(1) DEFAULT '0',
  `quotes-pdf` tinyint(1) DEFAULT '0',
  `quotes-email` tinyint(1) DEFAULT '0',
  `quotes-delete` tinyint(1) DEFAULT '0',
  `sales-index` tinyint(1) DEFAULT '0',
  `sales-add` tinyint(1) DEFAULT '0',
  `sales-edit` tinyint(1) DEFAULT '0',
  `sales-pdf` tinyint(1) DEFAULT '0',
  `sales-email` tinyint(1) DEFAULT '0',
  `sales-delete` tinyint(1) DEFAULT '0',
  `purchases-index` tinyint(1) DEFAULT '0',
  `purchases-add` tinyint(1) DEFAULT '0',
  `purchases-edit` tinyint(1) DEFAULT '0',
  `purchases-pdf` tinyint(1) DEFAULT '0',
  `purchases-email` tinyint(1) DEFAULT '0',
  `purchases-delete` tinyint(1) DEFAULT '0',
  `transfers-index` tinyint(1) DEFAULT '0',
  `transfers-add` tinyint(1) DEFAULT '0',
  `transfers-edit` tinyint(1) DEFAULT '0',
  `transfers-pdf` tinyint(1) DEFAULT '0',
  `transfers-email` tinyint(1) DEFAULT '0',
  `transfers-delete` tinyint(1) DEFAULT '0',
  `customers-index` tinyint(1) DEFAULT '0',
  `customers-add` tinyint(1) DEFAULT '0',
  `customers-edit` tinyint(1) DEFAULT '0',
  `customers-delete` tinyint(1) DEFAULT '0',
  `suppliers-index` tinyint(1) DEFAULT '0',
  `suppliers-add` tinyint(1) DEFAULT '0',
  `suppliers-edit` tinyint(1) DEFAULT '0',
  `suppliers-delete` tinyint(1) DEFAULT '0',
  `sales-deliveries` tinyint(1) DEFAULT '0',
  `sales-add_delivery` tinyint(1) DEFAULT '0',
  `sales-edit_delivery` tinyint(1) DEFAULT '0',
  `sales-delete_delivery` tinyint(1) DEFAULT '0',
  `sales-email_delivery` tinyint(1) DEFAULT '0',
  `sales-pdf_delivery` tinyint(1) DEFAULT '0',
  `sales-gift_cards` tinyint(1) DEFAULT '0',
  `sales-add_gift_card` tinyint(1) DEFAULT '0',
  `sales-edit_gift_card` tinyint(1) DEFAULT '0',
  `sales-delete_gift_card` tinyint(1) DEFAULT '0',
  `pos-index` tinyint(1) DEFAULT '0',
  `sales-return_sales` tinyint(1) DEFAULT '0',
  `reports-index` tinyint(1) DEFAULT '0',
  `reports-warehouse_stock` tinyint(1) DEFAULT '0',
  `reports-quantity_alerts` tinyint(1) DEFAULT '0',
  `reports-expiry_alerts` tinyint(1) DEFAULT '0',
  `reports-products` tinyint(1) DEFAULT '0',
  `reports-daily_sales` tinyint(1) DEFAULT '0',
  `reports-monthly_sales` tinyint(1) DEFAULT '0',
  `reports-sales` tinyint(1) DEFAULT '0',
  `reports-payments` tinyint(1) DEFAULT '0',
  `reports-purchases` tinyint(1) DEFAULT '0',
  `reports-profit_loss` tinyint(1) DEFAULT '0',
  `reports-customers` tinyint(1) DEFAULT '0',
  `reports-suppliers` tinyint(1) DEFAULT '0',
  `reports-staff` tinyint(1) DEFAULT '0',
  `reports-register` tinyint(1) DEFAULT '0',
  `sales-payments` tinyint(1) DEFAULT '0',
  `purchases-payments` tinyint(1) DEFAULT '0',
  `purchases-expenses` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,5,1,0,0,0,0,0,1,1,1,1,1,0,1,1,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,1,1,1,0,0,1,1,1,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pos_register`
--

DROP TABLE IF EXISTS `pos_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pos_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `cash_in_hand` decimal(25,4) NOT NULL,
  `status` varchar(10) NOT NULL,
  `total_cash` decimal(25,4) DEFAULT NULL,
  `total_cheques` int(11) DEFAULT NULL,
  `total_cc_slips` int(11) DEFAULT NULL,
  `total_cash_submitted` decimal(25,4) NOT NULL,
  `total_cheques_submitted` int(11) NOT NULL,
  `total_cc_slips_submitted` int(11) NOT NULL,
  `note` text,
  `closed_at` timestamp NULL DEFAULT NULL,
  `transfer_opened_bills` varchar(50) DEFAULT NULL,
  `closed_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pos_register`
--

LOCK TABLES `pos_register` WRITE;
/*!40000 ALTER TABLE `pos_register` DISABLE KEYS */;
/*!40000 ALTER TABLE `pos_register` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pos_settings`
--

DROP TABLE IF EXISTS `pos_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pos_settings` (
  `pos_id` int(1) NOT NULL,
  `cat_limit` int(11) NOT NULL,
  `pro_limit` int(11) NOT NULL,
  `default_category` int(11) NOT NULL,
  `default_customer` int(11) NOT NULL,
  `default_biller` int(11) NOT NULL,
  `display_time` varchar(3) NOT NULL DEFAULT 'yes',
  `cf_title1` varchar(255) DEFAULT NULL,
  `cf_title2` varchar(255) DEFAULT NULL,
  `cf_value1` varchar(255) DEFAULT NULL,
  `cf_value2` varchar(255) DEFAULT NULL,
  `receipt_printer` varchar(55) DEFAULT NULL,
  `cash_drawer_codes` varchar(55) DEFAULT NULL,
  `focus_add_item` varchar(55) DEFAULT NULL,
  `add_manual_product` varchar(55) DEFAULT NULL,
  `customer_selection` varchar(55) DEFAULT NULL,
  `add_customer` varchar(55) DEFAULT NULL,
  `toggle_category_slider` varchar(55) DEFAULT NULL,
  `toggle_subcategory_slider` varchar(55) DEFAULT NULL,
  `cancel_sale` varchar(55) DEFAULT NULL,
  `suspend_sale` varchar(55) DEFAULT NULL,
  `print_items_list` varchar(55) DEFAULT NULL,
  `finalize_sale` varchar(55) DEFAULT NULL,
  `today_sale` varchar(55) DEFAULT NULL,
  `open_hold_bills` varchar(55) DEFAULT NULL,
  `close_register` varchar(55) DEFAULT NULL,
  `keyboard` tinyint(1) NOT NULL,
  `pos_printers` varchar(255) DEFAULT NULL,
  `java_applet` tinyint(1) NOT NULL,
  `product_button_color` varchar(20) NOT NULL DEFAULT 'default',
  `tooltips` tinyint(1) DEFAULT '1',
  `paypal_pro` tinyint(1) DEFAULT '0',
  `stripe` tinyint(1) DEFAULT '0',
  `rounding` tinyint(1) DEFAULT '0',
  `char_per_line` tinyint(4) DEFAULT '42',
  `pin_code` varchar(20) DEFAULT NULL,
  `purchase_code` varchar(100) DEFAULT 'purchase_code',
  `envato_username` varchar(50) DEFAULT 'envato_username',
  `version` varchar(10) DEFAULT '3.0.1.20',
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pos_settings`
--

LOCK TABLES `pos_settings` WRITE;
/*!40000 ALTER TABLE `pos_settings` DISABLE KEYS */;
INSERT INTO `pos_settings` VALUES (1,22,20,1,1,3,'1','GST Reg','VAT Reg','123456789','987654321','BIXOLON SRP-350II','x1C','Ctrl+F3','Ctrl+Shift+M','Ctrl+Shift+C','Ctrl+Shift+A','Ctrl+F11','Ctrl+F12','F4','F7','F9','F8','Ctrl+F1','Ctrl+F2','Ctrl+F10',1,'BIXOLON SRP-350II, BIXOLON SRP-350II',0,'default',1,0,0,0,42,NULL,'purchase_code','envato_username','3.0.1.20');
/*!40000 ALTER TABLE `pos_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_photos`
--

DROP TABLE IF EXISTS `product_photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_photos`
--

LOCK TABLES `product_photos` WRITE;
/*!40000 ALTER TABLE `product_photos` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `cost` decimal(25,4) DEFAULT NULL,
  `price` decimal(25,4) DEFAULT NULL,
  `quantity` decimal(15,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` char(255) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `cost` decimal(25,4) DEFAULT NULL,
  `price` decimal(25,4) NOT NULL,
  `alert_quantity` decimal(15,4) DEFAULT '20.0000',
  `image` varchar(255) DEFAULT 'no_image.png',
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `cf1` varchar(255) DEFAULT NULL,
  `cf2` varchar(255) DEFAULT NULL,
  `cf3` varchar(255) DEFAULT NULL,
  `cf4` varchar(255) DEFAULT NULL,
  `cf5` varchar(255) DEFAULT NULL,
  `cf6` varchar(255) DEFAULT NULL,
  `quantity` decimal(15,4) DEFAULT '0.0000',
  `tax_rate` int(11) DEFAULT NULL,
  `track_quantity` tinyint(1) DEFAULT '1',
  `details` varchar(1000) DEFAULT NULL,
  `warehouse` int(11) DEFAULT NULL,
  `barcode_symbology` varchar(55) NOT NULL DEFAULT 'code128',
  `file` varchar(100) DEFAULT NULL,
  `product_details` text,
  `tax_method` tinyint(1) DEFAULT '0',
  `type` varchar(55) NOT NULL DEFAULT 'standard',
  `supplier1` int(11) DEFAULT NULL,
  `supplier1price` decimal(25,4) DEFAULT NULL,
  `supplier2` int(11) DEFAULT NULL,
  `supplier2price` decimal(25,4) DEFAULT NULL,
  `supplier3` int(11) DEFAULT NULL,
  `supplier3price` decimal(25,4) DEFAULT NULL,
  `supplier4` int(11) DEFAULT NULL,
  `supplier4price` decimal(25,4) DEFAULT NULL,
  `supplier5` int(11) DEFAULT NULL,
  `supplier5price` decimal(25,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `category_id` (`category_id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `category_id_2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'bb','aaaa','1',1.0000,1.0000,10.0000,'no_image.png',1,0,'','','','','','',0.0000,1,1,'',NULL,'code128',NULL,'<p>This is the product</p>',0,'standard',0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'ART1','Articulo 1','unit',10.0000,10.0000,0.0000,'no_image.png',1,0,'','','','','','',NULL,1,1,'',NULL,'code128',NULL,'',0,'standard',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'cmb1','Combo 1','unit',NULL,21.0000,0.0000,'no_image.png',1,0,'','','','','','',0.0000,1,0,'',NULL,'code128',NULL,'',0,'combo',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_items`
--

DROP TABLE IF EXISTS `purchase_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) DEFAULT NULL,
  `transfer_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `option_id` int(11) DEFAULT NULL,
  `net_unit_cost` decimal(25,4) NOT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(20) DEFAULT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `expiry` date DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `quantity_balance` decimal(15,4) DEFAULT '0.0000',
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `unit_cost` decimal(25,4) DEFAULT NULL,
  `real_unit_cost` decimal(25,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_id` (`purchase_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_items`
--

LOCK TABLES `purchase_items` WRITE;
/*!40000 ALTER TABLE `purchase_items` DISABLE KEYS */;
INSERT INTO `purchase_items` VALUES (1,NULL,NULL,2,'ART1','Articulo 1',NULL,10.0000,0.0000,3,0.0000,1,'0.0000',NULL,NULL,NULL,0.0000,0.0000,'2015-10-14','received',10.0000,NULL);
/*!40000 ALTER TABLE `purchase_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `supplier_id` int(11) NOT NULL,
  `supplier` varchar(55) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `total` decimal(25,4) DEFAULT NULL,
  `product_discount` decimal(25,4) DEFAULT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `order_discount` decimal(25,4) DEFAULT NULL,
  `total_discount` decimal(25,4) DEFAULT NULL,
  `product_tax` decimal(25,4) DEFAULT NULL,
  `order_tax_id` int(11) DEFAULT NULL,
  `order_tax` decimal(25,4) DEFAULT NULL,
  `total_tax` decimal(25,4) DEFAULT '0.0000',
  `shipping` decimal(25,4) DEFAULT '0.0000',
  `grand_total` decimal(25,4) NOT NULL,
  `paid` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `status` varchar(55) DEFAULT '',
  `payment_status` varchar(20) DEFAULT 'pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_items`
--

DROP TABLE IF EXISTS `quote_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quote_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(20) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `net_unit_price` decimal(25,4) NOT NULL,
  `unit_price` decimal(25,4) DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `real_unit_price` decimal(25,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_id` (`quote_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_items`
--

LOCK TABLES `quote_items` WRITE;
/*!40000 ALTER TABLE `quote_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reference_no` varchar(55) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer` varchar(55) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `biller_id` int(11) NOT NULL,
  `biller` varchar(55) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `internal_note` varchar(1000) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `product_discount` decimal(25,4) DEFAULT '0.0000',
  `order_discount` decimal(25,4) DEFAULT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `total_discount` decimal(25,4) DEFAULT '0.0000',
  `product_tax` decimal(25,4) DEFAULT '0.0000',
  `order_tax_id` int(11) DEFAULT NULL,
  `order_tax` decimal(25,4) DEFAULT NULL,
  `total_tax` decimal(25,4) DEFAULT NULL,
  `shipping` decimal(25,4) DEFAULT '0.0000',
  `grand_total` decimal(25,4) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_items`
--

DROP TABLE IF EXISTS `return_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) unsigned NOT NULL,
  `return_id` int(11) unsigned NOT NULL,
  `sale_item_id` int(11) DEFAULT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(20) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `net_unit_price` decimal(25,4) NOT NULL,
  `quantity` decimal(15,4) DEFAULT '0.0000',
  `warehouse_id` int(11) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `real_unit_price` decimal(25,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_id` (`sale_id`),
  KEY `product_id` (`product_id`),
  KEY `product_id_2` (`product_id`,`sale_id`),
  KEY `sale_id_2` (`sale_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_items`
--

LOCK TABLES `return_items` WRITE;
/*!40000 ALTER TABLE `return_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `return_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_sales`
--

DROP TABLE IF EXISTS `return_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reference_no` varchar(55) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer` varchar(55) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `biller` varchar(55) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `product_discount` decimal(25,4) DEFAULT '0.0000',
  `order_discount_id` varchar(20) DEFAULT NULL,
  `total_discount` decimal(25,4) DEFAULT '0.0000',
  `order_discount` decimal(25,4) DEFAULT '0.0000',
  `product_tax` decimal(25,4) DEFAULT '0.0000',
  `order_tax_id` int(11) DEFAULT NULL,
  `order_tax` decimal(25,4) DEFAULT '0.0000',
  `total_tax` decimal(25,4) DEFAULT '0.0000',
  `surcharge` decimal(25,4) DEFAULT '0.0000',
  `grand_total` decimal(25,4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_sales`
--

LOCK TABLES `return_sales` WRITE;
/*!40000 ALTER TABLE `return_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `return_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_items`
--

DROP TABLE IF EXISTS `sale_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(20) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `net_unit_price` decimal(25,4) NOT NULL,
  `unit_price` decimal(25,4) DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `real_unit_price` decimal(25,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_id` (`sale_id`),
  KEY `product_id` (`product_id`),
  KEY `product_id_2` (`product_id`,`sale_id`),
  KEY `sale_id_2` (`sale_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_items`
--

LOCK TABLES `sale_items` WRITE;
/*!40000 ALTER TABLE `sale_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reference_no` varchar(55) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer` varchar(55) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `biller` varchar(55) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `staff_note` varchar(1000) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `product_discount` decimal(25,4) DEFAULT '0.0000',
  `order_discount_id` varchar(20) DEFAULT NULL,
  `total_discount` decimal(25,4) DEFAULT '0.0000',
  `order_discount` decimal(25,4) DEFAULT '0.0000',
  `product_tax` decimal(25,4) DEFAULT '0.0000',
  `order_tax_id` int(11) DEFAULT NULL,
  `order_tax` decimal(25,4) DEFAULT '0.0000',
  `total_tax` decimal(25,4) DEFAULT '0.0000',
  `shipping` decimal(25,4) DEFAULT '0.0000',
  `grand_total` decimal(25,4) NOT NULL,
  `sale_status` varchar(20) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `payment_term` tinyint(4) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_items` tinyint(4) DEFAULT NULL,
  `pos` tinyint(1) NOT NULL DEFAULT '0',
  `paid` decimal(25,4) DEFAULT '0.0000',
  `return_id` int(11) DEFAULT NULL,
  `surcharge` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `attachment` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('03c9369012ca25af20cfb087eaf7ed9fa7cc6e16','127.0.0.1',1444617405,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444617405;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444616532;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('06af431557e1514b8a35822817e29a1d2902aa03','127.0.0.1',1444614413,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444614120;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444612048;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('079168773cac20c0daceeaa2f6a4e33c1fe5728f','127.0.0.1',1444483010,'__ci_last_regenerate|i:1444483010;requested_page|s:0:\"\";'),('07ec09faed96cefb4d630c5d408e683fb9ddfb10','127.0.0.1',1444609933,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444609933;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('08dd955e1cef58d1374bb86611abb862a33bc5f0','127.0.0.1',1444651972,'__ci_last_regenerate|i:1444651798;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";csrfkey|s:8:\"2C7FVm5i\";__ci_vars|a:2:{s:7:\"csrfkey\";s:3:\"old\";s:9:\"csrfvalue\";s:3:\"old\";}csrfvalue|s:20:\"5VMklNztjecydT7EnW36\";'),('13cc2e1016af15a28f75a052264247f10342acdc','127.0.0.1',1444836589,'__ci_last_regenerate|i:1444836298;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444826509\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";user_csrf|s:20:\"K6rjpv0TB4XEyg7MhHzm\";'),('14d444fa0b4babbf0762a081b6c6d7c003cfde64','127.0.0.1',1444660042,'__ci_last_regenerate|i:1444660038;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444659254\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('14e003eddb2df61700dee3bbcee76be59a73ffc8','127.0.0.1',1444649170,'__ci_last_regenerate|i:1444648976;requested_page|s:29:\"system_settings/permissions/5\";identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444598465\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('16cece02aaf3f56c2c20830f0eb62c1f5653a5a1','127.0.0.1',1444831941,'__ci_last_regenerate|i:1444831909;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444826509\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('1a65e67d2e0290644fc5c9c4cd517406a048f7d6','127.0.0.1',1444655363,'__ci_last_regenerate|i:1444655363;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('1bcc9d52db83110998fa6c951191ad535614231f','127.0.0.1',1444826469,'__ci_last_regenerate|i:1444826469;requested_page|s:0:\"\";'),('1d1e6a8b60826a98b3b97acf8c0ce390355a6393','127.0.0.1',1444619921,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444619905;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444616532;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('205482bb8385ee0dcf31219bf1190f120898f962','127.0.0.1',1444609223,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444606431;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('22e75cceabe69db4716718d11d8d037abe2d4aa4','127.0.0.1',1444835124,'__ci_last_regenerate|i:1444834665;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444826509\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('26bd1eafdcab4644da515de3fbb80b7ebaf15c43','127.0.0.1',1444648634,'__ci_last_regenerate|i:1444648634;'),('2e18fcc937abff00a0af6e1375f90710cf655987','127.0.0.1',1444614465,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444614445;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444612048;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('2eb05a5e9a41efd20a68e5485c7b77fe616fb29a','127.0.0.1',1444652793,'__ci_last_regenerate|i:1444652657;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";error|s:31:\"setting updated timezone failed\";__ci_vars|a:1:{s:5:\"error\";s:3:\"old\";}'),('32e125ae3778f76d222a9536861b0ccddc782378','127.0.0.1',1444655292,'__ci_last_regenerate|i:1444655280;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('35a75a985650323cfa226f7b523b634a38821227','127.0.0.1',1444601935,'__ci_last_regenerate|i:1444601934;requested_page|s:0:\"\";'),('38970d6eb247cf74e00d01723f3d26a8441df10d','127.0.0.1',1444598486,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444598465;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('38a2d7dc9a95d2d499467d93ffc6b7ccdfdec267','127.0.0.1',1444826510,'__ci_last_regenerate|i:1444826500;requested_page|s:0:\"\";identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444759606\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";message|s:38:\"<p>You are successfully logged in.</p>\";__ci_vars|a:1:{s:7:\"message\";s:3:\"old\";}'),('416e3ff7281951f8a7cf52f72d8f7fc3fbce301a','127.0.0.1',1444830636,'__ci_last_regenerate|i:1444830636;requested_page|s:0:\"\";'),('43a38915635932c845072170e87d79bf010af8da','127.0.0.1',1444655383,'__ci_last_regenerate|i:1444655383;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('45e23f623482370ef4d507d561567553806f045d','127.0.0.1',1444613025,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444612954;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444612048;'),('4b7b616a155171381d33c6a4c7381a473d8d3a94','127.0.0.1',1444906933,'__ci_last_regenerate|i:1444906933;'),('4c30b2b4d4ff257a2f6b75c6fd78303da80c3acd','127.0.0.1',1444655333,'__ci_last_regenerate|i:1444655333;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('4cdbc83fe0e6d31399a514d5078b9fd4b88b4b44','127.0.0.1',1444603254,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444603253;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('4daae735feb054f27a290d3ba23b3993b83b48e0','127.0.0.1',1444613980,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444613570;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444612048;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('52bedba82906ed22d102ef3f4f57be6e57559bc5','127.0.0.1',1444598897,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444598802;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('5578f509bbc192f61357a77557a51252de7441ef','127.0.0.1',1444659193,'__ci_last_regenerate|i:1444658933;identity|s:16:\"igor@example.com\";username|s:4:\"igor\";email|s:16:\"igor@example.com\";user_id|s:1:\"6\";old_last_login|s:10:\"1444658927\";last_ip|N;avatar|N;gender|s:4:\"male\";group_id|s:1:\"5\";warehouse_id|s:1:\"1\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";error|s:126:\"Access Denied! You don\'t have right to access the requested page. If you think, it\'s by mistake, please contact administrator.\";__ci_vars|a:1:{s:5:\"error\";s:3:\"old\";}'),('55ccec636b8a36a13db71e200cf4e4ba8c74b7e6','127.0.0.1',1444848616,'__ci_last_regenerate|i:1444848611;requested_page|s:13:\"purchases/add\";identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444831921\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";message|s:38:\"<p>You are successfully logged in.</p>\";__ci_vars|a:1:{s:7:\"message\";s:3:\"old\";}user_csrf|s:20:\"CznpTYSVWNoA36K8rDLy\";'),('6107cd0e9c52c1722be83902f5a1363113f374be','127.0.0.1',1444655050,'__ci_last_regenerate|i:1444654970;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('61a6921d5e62e2a8b9603993666928f161f2fd29','127.0.0.1',1444655302,'__ci_last_regenerate|i:1444655302;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('663adce1e63acd28d5b776a69abeeb296cad5f44','127.0.0.1',1444601913,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444601796;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('681535e688d86e22120ca6ee5d7dc3e420c38bd5','127.0.0.1',1444652288,'__ci_last_regenerate|i:1444652156;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('6e325347cbad61fb433993633927b5714ff1025f','127.0.0.1',1444836265,'__ci_last_regenerate|i:1444835981;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444826509\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('71edeca0ec9a3cb09ffe14d3d666b2a9d65bcb3d','127.0.0.1',1444566249,'__ci_last_regenerate|i:1444566067;requested_page|s:19:\"products/import_csv\";identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565758\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('78e4dd08dbcbc53043a626941d4f3fa33309bf5f','127.0.0.1',1444656024,'__ci_last_regenerate|i:1444655775;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('7b1d806477f3c89d1684bb57cf242400dd5f4d33','127.0.0.1',1444830636,'__ci_last_regenerate|i:1444830636;requested_page|s:0:\"\";'),('7c06694de3901790b7563f25bd4519e33c99e6e9','127.0.0.1',1444653488,'__ci_last_regenerate|i:1444653488;'),('7f86ddda667985af899efa94a7a1fcd7e9b057c4','127.0.0.1',1444605726,'__ci_last_regenerate|i:1444605726;requested_page|s:0:\"\";'),('81fe3668238fd96a0db925d4993161416d3104af','127.0.0.1',1444655765,'__ci_last_regenerate|i:1444655459;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('821bce42988f18cd44c506faa33088de3348ec9b','127.0.0.1',1444482106,'__ci_last_regenerate|i:1444482060;requested_page|s:0:\"\";identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1426618492\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";message|s:38:\"<p>You are successfully logged in.</p>\";__ci_vars|a:1:{s:7:\"message\";s:3:\"old\";}'),('82ca90e697f03dcfbe2a2dd30f3963644fb0f09d','127.0.0.1',1444619158,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444619140;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444616532;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('8417b45f821c53a247f00c75c3b40e34f8a6c116','127.0.0.1',1444612933,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444612024;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444612048;'),('8bb2876832255bb9dab438911a8a60cbc5076d1d','127.0.0.1',1444615636,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444615636;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444612048;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('90ad53148a00221ba887887a36e1998ef17d66a0','127.0.0.1',1444618688,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444618688;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444616532;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('94b9ce6135db548b0e974a4c2439cdcc494e5c9f','127.0.0.1',1444659271,'__ci_last_regenerate|i:1444659242;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444656246\";last_ip|N;avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('9660dfe1d8bd6c6829d5b220132aafc0103f7ea8','127.0.0.1',1444858254,'__ci_last_regenerate|i:1444858197;requested_page|s:13:\"purchases/add\";identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444848615\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";message|s:38:\"<p>You are successfully logged in.</p>\";__ci_vars|a:1:{s:7:\"message\";s:3:\"old\";}user_csrf|s:20:\"wM4F8UzBvkAmiyeWpSOJ\";'),('9f0ef382b2dc0b2fcc38a40d9571ff546c2ac3b9','127.0.0.1',1444655331,'__ci_last_regenerate|i:1444655331;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('a1bde34bc9e9b9e90057d67cc0e197eb1f8c47a2','127.0.0.1',1444658538,'__ci_last_regenerate|i:1444658419;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";user_csrf|s:20:\"5WfjMqCwUupdnRmzN1rX\";'),('a21d6876bf75d3acad3c5b4194b14af0b1a6a8ec','127.0.0.1',1444653273,'__ci_last_regenerate|i:1444653036;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('a263a7a18da3595e11acef9980ae7563b1b6ef77','127.0.0.1',1444615186,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444614833;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444612048;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('a66fb9a8c204e5764d22f3c1f7d7a33bd6c1d127','127.0.0.1',1444660017,'__ci_last_regenerate|i:1444659708;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444659254\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('ad0198405ca7dff9db52ee4a34732474ed33efd5','127.0.0.1',1444656307,'__ci_last_regenerate|i:1444656127;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('b25119e6e4593a6cafceeb08dd368e689132a565','127.0.0.1',1444655379,'__ci_last_regenerate|i:1444655379;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('b605aa6e8f8b83c18530629bfb18e75d55611d42','127.0.0.1',1444654224,'__ci_last_regenerate|i:1444653946;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('b715162e9f48e5f8fc72dd9db1fdfe6b20ca5922','127.0.0.1',1444654834,'__ci_last_regenerate|i:1444654495;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('b79a991aff896d2ed317b674995222ad2b8694b0','127.0.0.1',1444605907,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444605743;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('bfd274f9f7ba2a2a95b3658748c2365fc8421f53','127.0.0.1',1444655098,'__ci_last_regenerate|i:1444655070;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('c0af0ad0090b2bde9ca2bc3147adf89a5549e9cf','127.0.0.1',1444655363,'__ci_last_regenerate|i:1444655363;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('c1a3e3b0e1da14a3f189c0b3069e7f82e53afb4c','127.0.0.1',1444661514,'__ci_last_regenerate|i:1444660987;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444659254\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('c23424e7b1cba13c8b5f14882076d0e2d42572b5','127.0.0.1',1444858185,'__ci_last_regenerate|i:1444858185;requested_page|s:0:\"\";'),('c700b3340875e2b2e74a1b815890ef93266feeac','127.0.0.1',1444615299,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444615294;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444612048;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('cc80b888285567c0fe627779514334268979315b','127.0.0.1',1444661967,'__ci_last_regenerate|i:1444661846;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444659254\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('d86ee5ab9ab1a387a5634dc3051b0407dd988d7b','127.0.0.1',1444655352,'__ci_last_regenerate|i:1444655352;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('d8f440e2dd884b63b3e5cc8973532ede2a674bf3','127.0.0.1',1444483015,'__ci_last_regenerate|i:1444483015;requested_page|s:0:\"\";'),('dcd204eb3963abf704ea9b9a4274ba89637227e9','127.0.0.1',1444662430,'__ci_last_regenerate|i:1444662355;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444659254\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('e115ad86be0fbbb6b2ebb5be4cdf67b5f5039c99','127.0.0.1',1444653439,'__ci_last_regenerate|i:1444653439;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('e3818b684785e0fda81ec1247725e1d32b571c58','127.0.0.1',1444759606,'__ci_last_regenerate|i:1444759598;requested_page|s:19:\"products/import_csv\";identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444659777\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";message|s:38:\"<p>You are successfully logged in.</p>\";__ci_vars|a:1:{s:7:\"message\";s:3:\"old\";}'),('e6263a3091fbf6f22df52fd5b27a35c0c4c6b772','127.0.0.1',1444650073,'__ci_last_regenerate|i:1444650052;requested_page|s:29:\"system_settings/permissions/5\";identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444598465\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('e696bdb18e946a54f3c97ccf9d2fc89ac8f0af3f','127.0.0.1',1444621232,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444621181;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444616532;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('f2ca098cf0bb4557069bd8e3f7f48640a63cef25','127.0.0.1',1444616540,'requested_page|s:11:\"billers/add\";__ci_last_regenerate|i:1444616381;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565761\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";last_activity|i:1444616532;user_csrf|s:20:\"3tLC2aM9SU7D1bPrzjvO\";'),('f38a86a3ef26d9e5fd695f0bfa0c57e4cf9085d3','127.0.0.1',1444566028,'__ci_last_regenerate|i:1444565758;requested_page|s:19:\"products/import_csv\";identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444565758\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('f59f54d55ad900ea90a1ab4badab631d29eeb31c','127.0.0.1',1444661764,'__ci_last_regenerate|i:1444661522;identity|s:27:\"leandro.anthonioz@gmail.com\";username|s:7:\"leandro\";email|s:27:\"leandro.anthonioz@gmail.com\";user_id|s:1:\"5\";old_last_login|s:10:\"1444659254\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|s:1:\"0\";biller_id|s:1:\"3\";company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('f9316e74e599fe3b1be75fc65cf2df11660c2fb2','127.0.0.1',1444650868,'__ci_last_regenerate|i:1444650684;requested_page|s:29:\"system_settings/permissions/5\";identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444598465\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('fa789e4c85ee1930295b5535369e57c958ec248d','127.0.0.1',1444655355,'__ci_last_regenerate|i:1444655355;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('fb4efe24bf081c2f8c80e362b5b7da80f9dbe725','127.0.0.1',1444655362,'__ci_last_regenerate|i:1444655362;identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444648979\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";'),('fbbd2118d2caf621d43dc613e4956c91793165ad','127.0.0.1',1444649588,'__ci_last_regenerate|i:1444649384;requested_page|s:29:\"system_settings/permissions/5\";identity|s:18:\"owner@tecdiary.com\";username|s:5:\"owner\";email|s:18:\"owner@tecdiary.com\";user_id|s:1:\"1\";old_last_login|s:10:\"1444598465\";last_ip|s:9:\"127.0.0.1\";avatar|N;gender|s:4:\"male\";group_id|s:1:\"1\";warehouse_id|N;biller_id|N;company_id|N;show_cost|s:1:\"0\";show_price|s:1:\"0\";');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `setting_id` int(1) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `logo2` varchar(255) NOT NULL,
  `site_name` varchar(55) NOT NULL,
  `language` varchar(20) NOT NULL,
  `default_warehouse` int(2) NOT NULL,
  `accounting_method` tinyint(4) NOT NULL DEFAULT '0',
  `default_currency` varchar(3) NOT NULL,
  `default_tax_rate` int(2) NOT NULL,
  `rows_per_page` int(2) NOT NULL,
  `version` varchar(10) NOT NULL DEFAULT '1.0',
  `default_tax_rate2` int(11) NOT NULL DEFAULT '0',
  `dateformat` int(11) NOT NULL,
  `sales_prefix` varchar(20) DEFAULT NULL,
  `quote_prefix` varchar(20) DEFAULT NULL,
  `purchase_prefix` varchar(20) DEFAULT NULL,
  `transfer_prefix` varchar(20) DEFAULT NULL,
  `delivery_prefix` varchar(20) DEFAULT NULL,
  `payment_prefix` varchar(20) DEFAULT NULL,
  `return_prefix` varchar(20) DEFAULT NULL,
  `expense_prefix` varchar(20) DEFAULT NULL,
  `item_addition` tinyint(1) NOT NULL DEFAULT '0',
  `theme` varchar(20) NOT NULL,
  `product_serial` tinyint(4) NOT NULL,
  `default_discount` int(11) NOT NULL,
  `product_discount` tinyint(1) NOT NULL DEFAULT '0',
  `discount_method` tinyint(4) NOT NULL,
  `tax1` tinyint(4) NOT NULL,
  `tax2` tinyint(4) NOT NULL,
  `overselling` tinyint(1) NOT NULL DEFAULT '0',
  `restrict_user` tinyint(4) NOT NULL DEFAULT '0',
  `restrict_calendar` tinyint(4) NOT NULL DEFAULT '0',
  `timezone` varchar(100) DEFAULT NULL,
  `iwidth` int(11) NOT NULL DEFAULT '0',
  `iheight` int(11) NOT NULL,
  `twidth` int(11) NOT NULL,
  `theight` int(11) NOT NULL,
  `watermark` tinyint(1) DEFAULT NULL,
  `reg_ver` tinyint(1) DEFAULT NULL,
  `allow_reg` tinyint(1) DEFAULT NULL,
  `reg_notification` tinyint(1) DEFAULT NULL,
  `auto_reg` tinyint(1) DEFAULT NULL,
  `protocol` varchar(20) NOT NULL DEFAULT 'mail',
  `mailpath` varchar(55) DEFAULT '/usr/sbin/sendmail',
  `smtp_host` varchar(100) DEFAULT NULL,
  `smtp_user` varchar(100) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(10) DEFAULT '25',
  `smtp_crypto` varchar(10) DEFAULT NULL,
  `corn` datetime DEFAULT NULL,
  `customer_group` int(11) NOT NULL,
  `default_email` varchar(100) NOT NULL,
  `mmode` tinyint(1) NOT NULL,
  `bc_fix` tinyint(4) NOT NULL DEFAULT '0',
  `auto_detect_barcode` tinyint(1) NOT NULL DEFAULT '0',
  `captcha` tinyint(1) NOT NULL DEFAULT '1',
  `reference_format` tinyint(1) NOT NULL DEFAULT '1',
  `racks` tinyint(1) DEFAULT '0',
  `attributes` tinyint(1) NOT NULL DEFAULT '0',
  `product_expiry` tinyint(1) NOT NULL DEFAULT '0',
  `decimals` tinyint(2) NOT NULL DEFAULT '2',
  `qty_decimals` tinyint(2) NOT NULL DEFAULT '2',
  `decimals_sep` varchar(2) NOT NULL DEFAULT '.',
  `thousands_sep` varchar(2) NOT NULL DEFAULT ',',
  `invoice_view` tinyint(1) DEFAULT '0',
  `default_biller` int(11) DEFAULT NULL,
  `envato_username` varchar(50) DEFAULT NULL,
  `purchase_code` varchar(100) DEFAULT NULL,
  `rtl` tinyint(1) DEFAULT '0',
  `each_spent` decimal(15,4) DEFAULT NULL,
  `ca_point` tinyint(4) DEFAULT NULL,
  `each_sale` decimal(15,4) DEFAULT NULL,
  `sa_point` tinyint(4) DEFAULT NULL,
  `update` tinyint(1) DEFAULT '0',
  `sac` tinyint(1) DEFAULT '0',
  `display_all_products` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'logo2.png','Shipeu-small.png','ShipEU *LOCAL*','english',3,0,'ERU',1,10,'3.0.1.20',1,5,'SALE','QUOTE','PO','TR','DO','IPAY','RETURNSL','',0,'default',1,1,1,1,1,1,0,1,0,'America/Argentina/Buenos_Aires',800,800,60,60,0,0,0,0,NULL,'smtp','/usr/sbin/sendmail','in-v3.mailjet.com','f409aa4a08778d9a46f5eab155925b4d','txruJRiWm48pJlbcq6athD0jrJo5YHzexRWXR+cDke6U+s2Ysrm6zS1mtUyV/l7z+qFOGiYzoFY2KqIzP1Y/1A==','465','ssl',NULL,1,'manuel@spainbox.com',0,4,1,0,3,1,1,0,2,2,',','.',0,3,'nokiafree','b6dc9661-215b-42d4-a11d-d5263266e857',0,NULL,NULL,NULL,NULL,0,0,1);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skrill`
--

DROP TABLE IF EXISTS `skrill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skrill` (
  `id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `account_email` varchar(255) NOT NULL DEFAULT 'testaccount2@moneybookers.com',
  `secret_word` varchar(20) NOT NULL DEFAULT 'mbtest',
  `skrill_currency` varchar(3) NOT NULL DEFAULT 'USD',
  `fixed_charges` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `extra_charges_my` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `extra_charges_other` decimal(25,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skrill`
--

LOCK TABLES `skrill` WRITE;
/*!40000 ALTER TABLE `skrill` DISABLE KEYS */;
INSERT INTO `skrill` VALUES (1,1,'testaccount2@moneybookers.com','mbtest','USD',0.0000,0.0000,0.0000);
/*!40000 ALTER TABLE `skrill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `image` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,1,'SUB1','SubCategoria',NULL);
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suspended_bills`
--

DROP TABLE IF EXISTS `suspended_bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suspended_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int(11) NOT NULL,
  `customer` varchar(55) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `order_tax_id` int(11) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `biller_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `suspend_note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suspended_bills`
--

LOCK TABLES `suspended_bills` WRITE;
/*!40000 ALTER TABLE `suspended_bills` DISABLE KEYS */;
/*!40000 ALTER TABLE `suspended_bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suspended_items`
--

DROP TABLE IF EXISTS `suspended_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suspended_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suspend_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `net_unit_price` decimal(25,4) NOT NULL,
  `unit_price` decimal(25,4) NOT NULL,
  `quantity` decimal(15,4) DEFAULT '0.0000',
  `warehouse_id` int(11) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `product_type` varchar(20) DEFAULT NULL,
  `real_unit_price` decimal(25,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suspended_items`
--

LOCK TABLES `suspended_items` WRITE;
/*!40000 ALTER TABLE `suspended_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `suspended_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_rates`
--

DROP TABLE IF EXISTS `tax_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `rate` decimal(12,4) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_rates`
--

LOCK TABLES `tax_rates` WRITE;
/*!40000 ALTER TABLE `tax_rates` DISABLE KEYS */;
INSERT INTO `tax_rates` VALUES (1,'No Tax','NT',0.0000,'2'),(2,'VAT @10%','VAT10',10.0000,'1'),(3,'GST @6%','GST',6.0000,'1'),(4,'VAT @20%','VT20',20.0000,'1');
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfer_items`
--

DROP TABLE IF EXISTS `transfer_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfer_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `option_id` int(11) DEFAULT NULL,
  `expiry` date DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `net_unit_cost` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) DEFAULT NULL,
  `quantity_balance` decimal(15,4) NOT NULL,
  `unit_cost` decimal(25,4) DEFAULT NULL,
  `real_unit_cost` decimal(25,4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transfer_id` (`transfer_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfer_items`
--

LOCK TABLES `transfer_items` WRITE;
/*!40000 ALTER TABLE `transfer_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfer_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_no` varchar(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from_warehouse_id` int(11) NOT NULL,
  `from_warehouse_code` varchar(55) NOT NULL,
  `from_warehouse_name` varchar(55) NOT NULL,
  `to_warehouse_id` int(11) NOT NULL,
  `to_warehouse_code` varchar(55) NOT NULL,
  `to_warehouse_name` varchar(55) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `total` decimal(25,4) DEFAULT NULL,
  `total_tax` decimal(25,4) DEFAULT NULL,
  `grand_total` decimal(25,4) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'pending',
  `shipping` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `attachment` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfers`
--

LOCK TABLES `transfers` WRITE;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_logins`
--

DROP TABLE IF EXISTS `user_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_logins`
--

LOCK TABLES `user_logins` WRITE;
/*!40000 ALTER TABLE `user_logins` DISABLE KEYS */;
INSERT INTO `user_logins` VALUES (1,1,NULL,'127.0.0.1','owner@tecdiary.com','2015-10-10 13:01:46'),(2,1,NULL,'127.0.0.1','owner@tecdiary.com','2015-10-11 12:16:01'),(3,1,NULL,'127.0.0.1','owner@tecdiary.com','2015-10-11 21:21:05'),(4,1,NULL,'127.0.0.1','owner@tecdiary.com','2015-10-12 11:22:59'),(5,1,NULL,'127.0.0.1','owner@tecdiary.com','2015-10-12 12:11:48'),(6,6,NULL,'127.0.0.1','igor@example.com','2015-10-12 14:09:03'),(7,5,NULL,'127.0.0.1','leandro.anthonioz@gmail.com','2015-10-12 14:14:14'),(8,6,NULL,'127.0.0.1','igor@example.com','2015-10-12 14:22:02'),(9,5,NULL,'127.0.0.1','leandro.anthonioz@gmail.com','2015-10-12 14:22:57'),(10,5,NULL,'127.0.0.1','leandro.anthonioz@gmail.com','2015-10-13 18:06:46'),(11,5,NULL,'127.0.0.1','leandro.anthonioz@gmail.com','2015-10-14 12:41:49'),(12,5,NULL,'127.0.0.1','leandro.anthonioz@gmail.com','2015-10-14 14:12:01'),(13,5,NULL,'127.0.0.1','leandro.anthonioz@gmail.com','2015-10-14 18:50:16'),(14,5,NULL,'127.0.0.1','leandro.anthonioz@gmail.com','2015-10-14 21:30:53');
/*!40000 ALTER TABLE `user_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `last_ip_address` varbinary(45) DEFAULT NULL,
  `ip_address` varbinary(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(55) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `warehouse_id` int(10) unsigned DEFAULT NULL,
  `biller_id` int(10) unsigned DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `show_cost` tinyint(1) DEFAULT '0',
  `show_price` tinyint(1) DEFAULT '0',
  `award_points` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`,`warehouse_id`,`biller_id`),
  KEY `group_id_2` (`group_id`,`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'127.0.0.1','\0\0','owner','2c8ab736b2ccab4f50e72d5fd7d21020cbb77ae7',NULL,'owner@tecdiary.com',NULL,NULL,NULL,'6e5e2f4c47ba10736e92891840965955f42f6f45',1351661704,1444651908,1,'Owner','Owner','Stock Manager','012345678',NULL,'male',1,NULL,NULL,NULL,0,0,0),(5,'127.0.0.1','127.0.0.1','leandro','72b740ad9fc1396afbf3fbb305de1c55cbac1c8e',NULL,'leandro.anthonioz@gmail.com',NULL,NULL,NULL,'6994d622419cf811cf02ed383519b3bc18a3e0aa',1444656246,1444858253,1,'Leandro','Anthonioz','SpainBox (Dev Team)','+54-011-6134-7617',NULL,'male',1,0,3,NULL,0,0,0),(6,'127.0.0.1','127.0.0.1','igor','a428fe1d81561e2cf89c6285d2d5d22883c0405f',NULL,'igor@example.com',NULL,NULL,NULL,NULL,1444658927,1444659722,1,'Igor','Igor','Varsovia Inc','11111111',NULL,'male',5,3,6,NULL,0,0,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variants`
--

DROP TABLE IF EXISTS `variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variants`
--

LOCK TABLES `variants` WRITE;
/*!40000 ALTER TABLE `variants` DISABLE KEYS */;
/*!40000 ALTER TABLE `variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `map` varchar(255) DEFAULT NULL,
  `phone` varchar(55) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
INSERT INTO `warehouses` VALUES (3,'001','SpainBox Main Warehouse','<p>Cordoba, Spain</p>',NULL,'','');
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouses_products`
--

DROP TABLE IF EXISTS `warehouses_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouses_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `rack` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `warehouse_id` (`warehouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses_products`
--

LOCK TABLES `warehouses_products` WRITE;
/*!40000 ALTER TABLE `warehouses_products` DISABLE KEYS */;
INSERT INTO `warehouses_products` VALUES (1,2,3,0.0000,'sdfa'),(2,3,3,0.0000,NULL);
/*!40000 ALTER TABLE `warehouses_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouses_products_variants`
--

DROP TABLE IF EXISTS `warehouses_products_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouses_products_variants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `rack` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_id` (`option_id`),
  KEY `product_id` (`product_id`),
  KEY `warehouse_id` (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses_products_variants`
--

LOCK TABLES `warehouses_products_variants` WRITE;
/*!40000 ALTER TABLE `warehouses_products_variants` DISABLE KEYS */;
/*!40000 ALTER TABLE `warehouses_products_variants` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-15 13:25:01
