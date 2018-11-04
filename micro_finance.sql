/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.30-MariaDB : Database - micro_finance
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`micro_finance` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `micro_finance`;

/*Table structure for table `arealist` */

DROP TABLE IF EXISTS `arealist`;

CREATE TABLE `arealist` (
  `id_areaList` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active 0=removed',
  PRIMARY KEY (`id_areaList`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `arealist` */

insert  into `arealist`(`id_areaList`,`name`,`description`,`status`) values (1,'colombo','main site',1),(2,'Horana','site3',1);

/*Table structure for table `asset` */

DROP TABLE IF EXISTS `asset`;

CREATE TABLE `asset` (
  `id_asset` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `id_assetsTypelist` int(11) NOT NULL,
  `loan` int(11) NOT NULL,
  `assest_no` varchar(100) NOT NULL,
  `worth` decimal(10,0) NOT NULL,
  `id_borrower` int(10) NOT NULL,
  `duplicate_asset_id` int(10) DEFAULT NULL,
  `note` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_asset`),
  KEY `id_assetsTypelist` (`id_assetsTypelist`),
  CONSTRAINT `asset_ibfk_1` FOREIGN KEY (`id_assetsTypelist`) REFERENCES `assetslist` (`id_assetsList`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `asset` */

/*Table structure for table `assetslist` */

DROP TABLE IF EXISTS `assetslist`;

CREATE TABLE `assetslist` (
  `id_assetsList` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active 0=removed',
  PRIMARY KEY (`id_assetsList`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `assetslist` */

insert  into `assetslist`(`id_assetsList`,`name`,`description`,`status`) values (9,'Phone','Galaxy s8',1),(10,'car','ss',1),(11,'van','',0);

/*Table structure for table `borrower` */

DROP TABLE IF EXISTS `borrower`;

CREATE TABLE `borrower` (
  `id_borrower` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) NOT NULL,
  `name` varchar(400) NOT NULL,
  `joined_date` date NOT NULL,
  `nic` varchar(20) NOT NULL,
  `branch` int(11) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `contact_no_2` varchar(20) NOT NULL,
  `job` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `distance` varchar(20) NOT NULL,
  `id_areaList` int(11) NOT NULL,
  `id_marketing_officer` int(11) NOT NULL,
  `relative_type` int(11) DEFAULT NULL,
  `communication_address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_in_blacklist` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = not blacklisted ,  1= blacklisted',
  `borrower_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_borrower`),
  KEY `id_areaList` (`id_areaList`),
  KEY `id_marketing_officer` (`id_marketing_officer`)
) ENGINE=InnoDB AUTO_INCREMENT=1242 DEFAULT CHARSET=latin1;

/*Data for the table `borrower` */

insert  into `borrower`(`id_borrower`,`title`,`name`,`joined_date`,`nic`,`branch`,`contact_no`,`contact_no_2`,`job`,`address`,`gender`,`distance`,`id_areaList`,`id_marketing_officer`,`relative_type`,`communication_address`,`status`,`is_in_blacklist`,`borrower_photo`) values (1239,'Mr.','yujith2','2018-08-15','912589369V',0,'0778956234','','','colombo 4','Male','',1,43,NULL,'',0,0,'http://localhost/micro_finance/uploads/a045c51332a264c0aa3ff14b8450647797c69069.jpg'),(1240,'Mr.','Nimal Perera','2018-06-13','925681259V',0,'0772356987','','','colombo6','Male','',1,43,NULL,'',0,0,'http://localhost/micro_finance/uploads/87022912e49343831b740edd87b0b7579c198717.png'),(1241,'Mr.','kamal','2018-06-15','623598741V',0,'0772359874','','','458A,colombo4','Male','',1,43,NULL,'',1,0,'http://localhost/micro_finance/uploads/0fd90ca1e41de451f584902c462f2535d0e424b9.jpg');

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `comName` varchar(1000) NOT NULL,
  `legalName` varchar(1000) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `fax` varchar(45) NOT NULL,
  `email` varchar(500) NOT NULL,
  `web` varchar(500) NOT NULL,
  `month` varchar(45) NOT NULL,
  `vatNo` varchar(255) NOT NULL,
  `svatNo` varchar(255) NOT NULL,
  `country` varchar(45) DEFAULT NULL,
  `currency` varchar(45) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `tinNo` varchar(45) DEFAULT NULL,
  `brNo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `company` */

insert  into `company`(`id`,`comName`,`legalName`,`address`,`phone`,`fax`,`email`,`web`,`month`,`vatNo`,`svatNo`,`country`,`currency`,`logo`,`tinNo`,`brNo`) values (1,'Prasath Investment (Pvt) Ltd','Prasath Investment (Pvt) Ltd','53/B,\r\nPrasath Investment (Pvt) Ltd,\r\nPadukka Road,\r\nIngiriya.                                                    \r\n                                                                                                      \r\n                                                                                                      \r\n                                                                                                      \r\n                                                                                                      \r\n                                                                                                      \r\n                                                                                                      \r\n                                                                                                      \r\n                                                                                                      \r\n                                                    ','03457008008','0345700800','prasathInvestment@gmail.com','prasath.com','','002','003','Sri Lanka','','C:\\fakepath\\Pi (3).jpg','001','004');

/*Table structure for table `guarantor` */

DROP TABLE IF EXISTS `guarantor`;

CREATE TABLE `guarantor` (
  `guarantor_id` int(11) NOT NULL AUTO_INCREMENT,
  `created_date` date DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `guarantor_name` varchar(255) DEFAULT NULL,
  `nic` varchar(255) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `contact_no1` varchar(255) DEFAULT NULL,
  `contact_no2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `guarantor_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`guarantor_id`),
  KEY `area_id` (`area_id`),
  CONSTRAINT `guarantor_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `arealist` (`id_areaList`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `guarantor` */

insert  into `guarantor`(`guarantor_id`,`created_date`,`title`,`guarantor_name`,`nic`,`area_id`,`dob`,`contact_no1`,`contact_no2`,`email`,`gender`,`job`,`address`,`guarantor_photo`) values (3,'2018-06-15','Mr.','kasun','912870025V',1,'2018-06-19','','','','Male','','','http://www.rmasurveying.com/wp-content/themes/slick/images/employee_default.png'),(4,'2018-06-15','Mr.','nimal','258915236V',1,'2018-06-20','','','','Male','','','http://www.rmasurveying.com/wp-content/themes/slick/images/employee_default.png');

/*Table structure for table `loan_collateral` */

DROP TABLE IF EXISTS `loan_collateral`;

CREATE TABLE `loan_collateral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_id` int(11) DEFAULT NULL,
  `collateral_type` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `value` double DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `model_name` varchar(255) DEFAULT NULL,
  `colour` varchar(255) DEFAULT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `manufact_date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `current_status_date` date DEFAULT NULL,
  `current_status` varchar(255) DEFAULT NULL,
  `vehicle_registration_no` varchar(255) DEFAULT NULL,
  `mileage` varchar(255) DEFAULT NULL,
  `engin_no` varchar(255) DEFAULT NULL,
  `collateral_photo` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `h_id` (`h_id`),
  KEY `collateral_type` (`collateral_type`),
  CONSTRAINT `loan_collateral_ibfk_1` FOREIGN KEY (`h_id`) REFERENCES `loan_tbl` (`loan_id`),
  CONSTRAINT `loan_collateral_ibfk_2` FOREIGN KEY (`collateral_type`) REFERENCES `assetslist` (`id_assetsList`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `loan_collateral` */

insert  into `loan_collateral`(`id`,`h_id`,`collateral_type`,`product_name`,`register_date`,`value`,`serial_no`,`model_name`,`colour`,`condition`,`manufact_date`,`description`,`current_status_date`,`current_status`,`vehicle_registration_no`,`mileage`,`engin_no`,`collateral_photo`) values (1,8,9,'htc m9','2018-06-20',20000,'0115586666','m8','black','Excellent','2000-06-20','good','2018-06-26','Deposited into Branch','','','','http://localhost/micro_finance/uploads/collateral_photos/bdd69d1d84b026add94a567f9d7642b038dd5db2.jpg'),(2,8,9,'Apple 8+','2018-06-22',80000,'0558888888','8+','Black','Excellent','2016-12-28','new','2018-06-13','Collateral with Borrower','','','','http://localhost/micro_finance/uploads/collateral_photos/dc71f08519d5e8be7912c69d2cf64a3fc22a60b8.jpg');

/*Table structure for table `loan_guarantor` */

DROP TABLE IF EXISTS `loan_guarantor`;

CREATE TABLE `loan_guarantor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_id` int(11) DEFAULT NULL,
  `guarantor` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file_path` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `h_id` (`h_id`),
  CONSTRAINT `loan_guarantor_ibfk_1` FOREIGN KEY (`h_id`) REFERENCES `loan_tbl` (`loan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `loan_guarantor` */

insert  into `loan_guarantor`(`id`,`h_id`,`guarantor`,`description`,`file_path`) values (9,7,3,'a','G0'),(10,7,4,'d','G1'),(11,9,3,'des','G0');

/*Table structure for table `loan_product` */

DROP TABLE IF EXISTS `loan_product`;

CREATE TABLE `loan_product` (
  `id_loan_product` int(11) NOT NULL AUTO_INCREMENT,
  `loan_product_name` varchar(255) DEFAULT NULL,
  `disbursed_by` varchar(100) DEFAULT NULL,
  `min_principle_ammount` double DEFAULT NULL,
  `max_principle_ammount` double DEFAULT NULL,
  `dif_principle_ammount` double DEFAULT NULL,
  `interest_method` varchar(255) DEFAULT NULL,
  `interest_charged` varchar(255) DEFAULT NULL,
  `interest_type` varchar(255) DEFAULT NULL,
  `interest_period` varchar(100) DEFAULT NULL,
  `min_interest` double DEFAULT NULL,
  `max_interest` double DEFAULT NULL,
  `dif_interest` double DEFAULT NULL,
  `duration_period` varchar(100) DEFAULT NULL,
  `min_duration` int(11) DEFAULT NULL,
  `max_duration` int(11) DEFAULT NULL,
  `dif_duration` int(11) DEFAULT NULL,
  `repayment_cycle` varchar(100) DEFAULT NULL,
  `min_repayment` int(11) DEFAULT NULL,
  `max_repayment` int(11) DEFAULT NULL,
  `dif_repayment` int(11) DEFAULT NULL,
  `repayment_order` varchar(255) DEFAULT NULL,
  `cal_penalty_on` int(11) DEFAULT NULL,
  `panalty_rate` double DEFAULT NULL,
  `grace_period` int(11) DEFAULT NULL,
  `recurring_period` varchar(100) DEFAULT NULL,
  `recurring_on` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_loan_product`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `loan_product` */

insert  into `loan_product`(`id_loan_product`,`loan_product_name`,`disbursed_by`,`min_principle_ammount`,`max_principle_ammount`,`dif_principle_ammount`,`interest_method`,`interest_charged`,`interest_type`,`interest_period`,`min_interest`,`max_interest`,`dif_interest`,`duration_period`,`min_duration`,`max_duration`,`dif_duration`,`repayment_cycle`,`min_repayment`,`max_repayment`,`dif_repayment`,`repayment_order`,`cal_penalty_on`,`panalty_rate`,`grace_period`,`recurring_period`,`recurring_on`) values (6,'Personal Loan','Cash',100000,5000000,200000,'Flat Rate','Charge All Interest on the Released Date','percentage','Year',12,16,15,'Months',3,36,6,'Monthly',1,100,2,'Penalty,Principal,Fees,Interest,',NULL,NULL,NULL,NULL,NULL),(7,'Business Loan2','Cheque',500,5,1,'Flat Rate','Include interest normally as per Interest Method','percentage','Month',10,15,12,'Months',12,30,15,'Monthly',1,4,2,'Penalty,Fees,Principal,Interest,',2,30,10,'2','Months'),(8,'Housing loan','Cash',200000,5000000,400000,'Flat Rate','Include interest normally as per Interest Method','percentage','Week',2,12,5,'Months',18,100,20,'Monthly',58,110,85,'Principal,Penalty,Fees,Interest,',1,25,5,'1','Months');

/*Table structure for table `loan_schedule` */

DROP TABLE IF EXISTS `loan_schedule`;

CREATE TABLE `loan_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) DEFAULT NULL,
  `repayment_date` date DEFAULT NULL,
  `principal_amount` double DEFAULT NULL,
  `loan_interest` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `pending_due` double DEFAULT NULL,
  `total_due` double DEFAULT NULL,
  `principal_balance` double DEFAULT NULL,
  `opening_balance` double DEFAULT NULL,
  `is_paid` int(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `loan_id` (`loan_id`),
  CONSTRAINT `loan_schedule_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `loan_tbl` (`loan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

/*Data for the table `loan_schedule` */

insert  into `loan_schedule`(`id`,`loan_id`,`repayment_date`,`principal_amount`,`loan_interest`,`due_amount`,`pending_due`,`total_due`,`principal_balance`,`opening_balance`,`is_paid`) values (40,8,'2018-06-20',13888.89,1666.67,15555.56,15555.56,15555.56,486111.11,0,0),(41,8,'2018-07-20',13888.89,1666.67,15555.56,31111.12,31111.12,472222.22,0,0),(42,8,'2018-08-20',13888.89,1666.67,15555.56,46666.68,46666.68,458333.33,0,0),(43,8,'2018-09-20',13888.89,1666.67,15555.56,62222.24,62222.24,444444.44,0,0),(44,8,'2018-10-20',13888.89,1666.67,15555.56,77777.8,77777.8,430555.55,0,0),(45,8,'2018-11-20',13888.89,1666.67,15555.56,93333.36,93333.36,416666.66,0,0),(46,8,'2018-12-20',13888.89,1666.67,15555.56,108888.92,108888.92,402777.77,0,0),(47,8,'2019-01-20',13888.89,1666.67,15555.56,124444.48,124444.48,388888.88,0,0),(48,8,'2019-02-20',13888.89,1666.67,15555.56,140000.04,140000.04,374999.99,0,0),(49,8,'2019-03-20',13888.89,1666.67,15555.56,155555.6,155555.6,361111.1,0,0),(50,8,'2019-04-20',13888.89,1666.67,15555.56,171111.16,171111.16,347222.21,0,0),(51,8,'2019-05-20',13888.89,1666.67,15555.56,186666.72,186666.72,333333.32,0,0),(52,8,'2019-06-20',13888.89,1666.67,15555.56,202222.28,202222.28,319444.43,0,0),(53,8,'2019-07-20',13888.89,1666.67,15555.56,217777.84,217777.84,305555.54,0,0),(54,8,'2019-08-20',13888.89,1666.67,15555.56,233333.4,233333.4,291666.65,0,0),(55,8,'2019-09-20',13888.89,1666.67,15555.56,248888.96,248888.96,277777.76,0,0),(56,8,'2019-10-20',13888.89,1666.67,15555.56,264444.52,264444.52,263888.87,0,0),(57,8,'2019-11-20',13888.89,1666.67,15555.56,280000.08,280000.08,249999.98,0,0),(58,8,'2019-12-20',13888.89,1666.67,15555.56,295555.64,295555.64,236111.09,0,0),(59,8,'2020-01-20',13888.89,1666.67,15555.56,311111.2,311111.2,222222.2,0,0),(60,8,'2020-02-20',13888.89,1666.67,15555.56,326666.76,326666.76,208333.31,0,0),(61,8,'2020-03-20',13888.89,1666.67,15555.56,342222.32,342222.32,194444.42,0,0),(62,8,'2020-04-20',13888.89,1666.67,15555.56,357777.88,357777.88,180555.53,0,0),(63,8,'2020-05-20',13888.89,1666.67,15555.56,373333.44,373333.44,166666.64,0,0),(64,8,'2020-06-20',13888.89,1666.67,15555.56,388889,388889,152777.75,0,0),(65,8,'2020-07-20',13888.89,1666.67,15555.56,404444.56,404444.56,138888.86,0,0),(66,8,'2020-08-20',13888.89,1666.67,15555.56,420000.12,420000.12,124999.97,0,0),(67,8,'2020-09-20',13888.89,1666.67,15555.56,435555.68,435555.68,111111.08,0,0),(68,8,'2020-10-20',13888.89,1666.67,15555.56,451111.24,451111.24,97222.19,0,0),(69,8,'2020-11-20',13888.89,1666.67,15555.56,466666.8,466666.8,83333.3,0,0),(70,8,'2020-12-20',13888.89,1666.67,15555.56,482222.36,482222.36,69444.41,0,0),(71,8,'2021-01-20',13888.89,1666.67,15555.56,497777.92,497777.92,55555.52,0,0),(72,8,'2021-02-20',13888.89,1666.67,15555.56,513333.48,513333.48,41666.63,0,0),(73,8,'2021-03-20',13888.89,1666.67,15555.56,528889.04,528889.04,27777.74,0,0),(74,8,'2021-04-20',13888.89,1666.67,15555.56,544444.6,544444.6,13888.85,0,0),(75,8,'2021-05-20',13888.85,1666.67,15555.56,560000.16,560000.16,0,0,0),(76,8,'2018-06-20',13888.89,1666.67,15555.56,15555.56,15555.56,486111.11,0,0),(77,8,'2018-07-20',13888.89,1666.67,15555.56,31111.12,31111.12,472222.22,0,0),(78,8,'2018-08-20',13888.89,1666.67,15555.56,46666.68,46666.68,458333.33,0,0),(79,8,'2018-09-20',13888.89,1666.67,15555.56,62222.24,62222.24,444444.44,0,0),(80,8,'2018-10-20',13888.89,1666.67,15555.56,77777.8,77777.8,430555.55,0,0),(81,8,'2018-11-20',13888.89,1666.67,15555.56,93333.36,93333.36,416666.66,0,0),(82,8,'2018-12-20',13888.89,1666.67,15555.56,108888.92,108888.92,402777.77,0,0),(83,8,'2019-01-20',13888.89,1666.67,15555.56,124444.48,124444.48,388888.88,0,0),(84,8,'2019-02-20',13888.89,1666.67,15555.56,140000.04,140000.04,374999.99,0,0),(85,8,'2019-03-20',13888.89,1666.67,15555.56,155555.6,155555.6,361111.1,0,0),(86,8,'2019-04-20',13888.89,1666.67,15555.56,171111.16,171111.16,347222.21,0,0),(87,8,'2019-05-20',13888.89,1666.67,15555.56,186666.72,186666.72,333333.32,0,0),(88,8,'2019-06-20',13888.89,1666.67,15555.56,202222.28,202222.28,319444.43,0,0),(89,8,'2019-07-20',13888.89,1666.67,15555.56,217777.84,217777.84,305555.54,0,0),(90,8,'2019-08-20',13888.89,1666.67,15555.56,233333.4,233333.4,291666.65,0,0),(91,8,'2019-09-20',13888.89,1666.67,15555.56,248888.96,248888.96,277777.76,0,0),(92,8,'2019-10-20',13888.89,1666.67,15555.56,264444.52,264444.52,263888.87,0,0),(93,8,'2019-11-20',13888.89,1666.67,15555.56,280000.08,280000.08,249999.98,0,0),(94,8,'2019-12-20',13888.89,1666.67,15555.56,295555.64,295555.64,236111.09,0,0),(95,8,'2020-01-20',13888.89,1666.67,15555.56,311111.2,311111.2,222222.2,0,0),(96,8,'2020-02-20',13888.89,1666.67,15555.56,326666.76,326666.76,208333.31,0,0),(97,8,'2020-03-20',13888.89,1666.67,15555.56,342222.32,342222.32,194444.42,0,0),(98,8,'2020-04-20',13888.89,1666.67,15555.56,357777.88,357777.88,180555.53,0,0),(99,8,'2020-05-20',13888.89,1666.67,15555.56,373333.44,373333.44,166666.64,0,0),(100,8,'2020-06-20',13888.89,1666.67,15555.56,388889,388889,152777.75,0,0),(101,8,'2020-07-20',13888.89,1666.67,15555.56,404444.56,404444.56,138888.86,0,0),(102,8,'2020-08-20',13888.89,1666.67,15555.56,420000.12,420000.12,124999.97,0,0),(103,8,'2020-09-20',13888.89,1666.67,15555.56,435555.68,435555.68,111111.08,0,0),(104,8,'2020-10-20',13888.89,1666.67,15555.56,451111.24,451111.24,97222.19,0,0),(105,8,'2020-11-20',13888.89,1666.67,15555.56,466666.8,466666.8,83333.3,0,0),(106,8,'2020-12-20',13888.89,1666.67,15555.56,482222.36,482222.36,69444.41,0,0),(107,8,'2021-01-20',13888.89,1666.67,15555.56,497777.92,497777.92,55555.52,0,0),(108,8,'2021-02-20',13888.89,1666.67,15555.56,513333.48,513333.48,41666.63,0,0),(109,8,'2021-03-20',13888.89,1666.67,15555.56,528889.04,528889.04,27777.74,0,0),(110,8,'2021-04-20',13888.89,1666.67,15555.56,544444.6,544444.6,13888.85,0,0),(111,8,'2021-05-20',13888.85,1666.67,15555.56,560000.16,560000.16,0,0,0),(112,7,'2018-06-15',100000,0,100000,100000,100000,100000,0,0),(113,7,'2018-07-15',100000,0,100000,200000,200000,0,0,0),(114,8,'2018-06-20',13888.89,1666.67,15555.56,15555.56,15555.56,486111.11,0,0),(115,8,'2018-07-20',13888.89,1666.67,15555.56,31111.12,31111.12,472222.22,0,0),(116,8,'2018-08-20',13888.89,1666.67,15555.56,46666.68,46666.68,458333.33,0,0),(117,8,'2018-09-20',13888.89,1666.67,15555.56,62222.24,62222.24,444444.44,0,0),(118,8,'2018-10-20',13888.89,1666.67,15555.56,77777.8,77777.8,430555.55,0,0),(119,8,'2018-11-20',13888.89,1666.67,15555.56,93333.36,93333.36,416666.66,0,0),(120,8,'2018-12-20',13888.89,1666.67,15555.56,108888.92,108888.92,402777.77,0,0),(121,8,'2019-01-20',13888.89,1666.67,15555.56,124444.48,124444.48,388888.88,0,0),(122,8,'2019-02-20',13888.89,1666.67,15555.56,140000.04,140000.04,374999.99,0,0),(123,8,'2019-03-20',13888.89,1666.67,15555.56,155555.6,155555.6,361111.1,0,0),(124,8,'2019-04-20',13888.89,1666.67,15555.56,171111.16,171111.16,347222.21,0,0),(125,8,'2019-05-20',13888.89,1666.67,15555.56,186666.72,186666.72,333333.32,0,0),(126,8,'2019-06-20',13888.89,1666.67,15555.56,202222.28,202222.28,319444.43,0,0),(127,8,'2019-07-20',13888.89,1666.67,15555.56,217777.84,217777.84,305555.54,0,0),(128,8,'2019-08-20',13888.89,1666.67,15555.56,233333.4,233333.4,291666.65,0,0),(129,8,'2019-09-20',13888.89,1666.67,15555.56,248888.96,248888.96,277777.76,0,0),(130,8,'2019-10-20',13888.89,1666.67,15555.56,264444.52,264444.52,263888.87,0,0),(131,8,'2019-11-20',13888.89,1666.67,15555.56,280000.08,280000.08,249999.98,0,0),(132,8,'2019-12-20',13888.89,1666.67,15555.56,295555.64,295555.64,236111.09,0,0),(133,8,'2020-01-20',13888.89,1666.67,15555.56,311111.2,311111.2,222222.2,0,0),(134,8,'2020-02-20',13888.89,1666.67,15555.56,326666.76,326666.76,208333.31,0,0),(135,8,'2020-03-20',13888.89,1666.67,15555.56,342222.32,342222.32,194444.42,0,0),(136,8,'2020-04-20',13888.89,1666.67,15555.56,357777.88,357777.88,180555.53,0,0),(137,8,'2020-05-20',13888.89,1666.67,15555.56,373333.44,373333.44,166666.64,0,0),(138,8,'2020-06-20',13888.89,1666.67,15555.56,388889,388889,152777.75,0,0),(139,8,'2020-07-20',13888.89,1666.67,15555.56,404444.56,404444.56,138888.86,0,0),(140,8,'2020-08-20',13888.89,1666.67,15555.56,420000.12,420000.12,124999.97,0,0),(141,8,'2020-09-20',13888.89,1666.67,15555.56,435555.68,435555.68,111111.08,0,0),(142,8,'2020-10-20',13888.89,1666.67,15555.56,451111.24,451111.24,97222.19,0,0),(143,8,'2020-11-20',13888.89,1666.67,15555.56,466666.8,466666.8,83333.3,0,0),(144,8,'2020-12-20',13888.89,1666.67,15555.56,482222.36,482222.36,69444.41,0,0),(145,8,'2021-01-20',13888.89,1666.67,15555.56,497777.92,497777.92,55555.52,0,0),(146,8,'2021-02-20',13888.89,1666.67,15555.56,513333.48,513333.48,41666.63,0,0),(147,8,'2021-03-20',13888.89,1666.67,15555.56,528889.04,528889.04,27777.74,0,0),(148,8,'2021-04-20',13888.89,1666.67,15555.56,544444.6,544444.6,13888.85,0,0),(149,8,'2021-05-20',13888.85,1666.67,15555.56,560000.16,560000.16,0,0,0);

/*Table structure for table `loan_serial` */

DROP TABLE IF EXISTS `loan_serial`;

CREATE TABLE `loan_serial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form` varchar(255) DEFAULT NULL,
  `num` int(5) unsigned zerofill DEFAULT '00001',
  `start` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `loan_serial` */

insert  into `loan_serial`(`id`,`form`,`num`,`start`,`comment`) values (1,'Loan',00006,'LN - ','loanSerial');

/*Table structure for table `loan_tbl` */

DROP TABLE IF EXISTS `loan_tbl`;

CREATE TABLE `loan_tbl` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `serialNo` varchar(255) DEFAULT NULL,
  `id_loan_product` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `borrower_id` int(11) DEFAULT NULL,
  `disbursed_by` varchar(100) DEFAULT NULL,
  `principle_ammount` double DEFAULT NULL,
  `interest_method` varchar(255) DEFAULT NULL,
  `interest_charged` varchar(255) DEFAULT NULL,
  `interest_type` varchar(255) DEFAULT NULL,
  `interest_period` varchar(100) DEFAULT NULL,
  `loan_interest` double DEFAULT NULL,
  `duration_period` varchar(100) DEFAULT NULL,
  `loan_duration` int(11) DEFAULT NULL,
  `repayment_cycle` varchar(100) DEFAULT NULL,
  `no_of_repayment` int(11) DEFAULT NULL,
  `approved` varchar(50) DEFAULT 'P',
  `opening_balance` double DEFAULT '0',
  PRIMARY KEY (`loan_id`),
  KEY `id_loan_product` (`id_loan_product`),
  KEY `borrower_id` (`borrower_id`),
  CONSTRAINT `loan_tbl_ibfk_1` FOREIGN KEY (`id_loan_product`) REFERENCES `loan_product` (`id_loan_product`),
  CONSTRAINT `loan_tbl_ibfk_2` FOREIGN KEY (`borrower_id`) REFERENCES `borrower` (`id_borrower`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `loan_tbl` */

insert  into `loan_tbl`(`loan_id`,`serialNo`,`id_loan_product`,`created_date`,`release_date`,`borrower_id`,`disbursed_by`,`principle_ammount`,`interest_method`,`interest_charged`,`interest_type`,`interest_period`,`loan_interest`,`duration_period`,`loan_duration`,`repayment_cycle`,`no_of_repayment`,`approved`,`opening_balance`) values (7,'LN - 00001',6,'2018-06-15 00:00:00','2018-06-15',1239,'Cash',200000,'Flat Rate','Charge All Interest on the Released Date','fixed','Week',15,'Months',6,'Monthly',2,'P',0),(8,'LN - 00002',6,'2018-06-17 00:00:00','2018-06-20',1240,'Cash',500000,'Flat Rate','Charge All Interest on the Released Date','percentage','Year',12,'Months',12,'Monthly',36,'A',0),(9,'LN - 00003',6,'2018-06-20 00:00:00','2018-06-20',1241,'Cash',300000,'Flat Rate','Charge All Interest on the Released Date','percentage','Year',15,'Months',12,'Monthly',70,'R',0),(10,'LN - 00004',6,'2018-06-20 00:00:00','2018-06-20',1241,'Cash',200000,'Flat Rate','Charge All Interest on the Released Date','percentage','Year',15,'Months',6,'Monthly',2,'P',0),(11,'LN - 00005',6,'2018-07-15 00:00:00','2018-07-03',1239,'Cash',300,'Flat Rate','Charge All Interest on the Released Date','percentage','Year',15,'Months',1,'Monthly',36,'P',0);

/*Table structure for table `login_log` */

DROP TABLE IF EXISTS `login_log`;

CREATE TABLE `login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `user_agent` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2888 DEFAULT CHARSET=latin1;

/*Data for the table `login_log` */

insert  into `login_log`(`id`,`user`,`time`,`ip`,`user_agent`) values (2731,'super admin','2018-02-26 03:49:14','112.134.130.130','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2732,'super admin','2018-02-26 03:56:47','112.134.130.130','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2733,'super admin','2018-02-26 03:57:08','112.134.130.130','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2734,'super admin','2018-02-26 03:58:57','112.134.130.130','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2735,'super admin','2018-02-26 04:35:51','112.134.130.130','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2736,'super admin','2018-02-26 04:36:39','112.134.130.130','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2737,'super admin','2018-02-26 04:46:20','112.134.130.130','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2738,'super admin','2018-02-26 04:47:31','112.134.130.130','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2739,'super admin','2018-02-26 04:48:46','112.134.130.130','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2740,'super admin','2018-02-26 05:01:50','112.134.130.130','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2741,'super admin','2018-03-02 03:18:04','112.134.213.203','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2742,'super admin','2018-03-02 03:21:02','112.134.213.203','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),(2743,'super admin','2018-03-02 09:17:52','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2744,'super admin','2018-03-02 09:40:09','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2745,'super admin','2018-03-02 09:40:49','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2746,'super admin','2018-03-02 09:46:15','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2747,'super admin','2018-03-02 09:54:18','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2748,'super admin','2018-03-02 09:54:48','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2749,'super admin','2018-03-02 10:00:17','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2750,'super admin','2018-03-02 10:03:22','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2751,'super admin','2018-03-02 10:03:49','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2752,'super admin','2018-03-02 10:50:14','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2753,'super admin','2018-03-02 10:51:10','112.134.195.4','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2754,'super admin','2018-03-02 12:50:32','112.134.195.4','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),(2755,'super admin','2018-03-03 03:20:10','124.43.123.34','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2756,'super admin','2018-03-05 03:08:50','112.134.215.236','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2757,'super admin','2018-03-05 09:59:05','112.134.215.236','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),(2758,'super admin','2018-03-05 10:24:19','112.134.215.236','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2759,'super admin','2018-03-05 10:37:21','112.134.215.236','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),(2760,'super admin','2018-03-05 13:17:07','124.43.105.39','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),(2761,'super admin','2018-03-06 05:04:06','112.134.166.184','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'),(2762,'super admin','2018-03-17 07:22:00','112.134.155.125','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2763,'super admin','2018-03-19 09:51:16','112.134.194.105','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2764,'super admin','2018-04-02 04:08:51','112.134.180.232','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2765,'super admin','2018-04-04 11:37:42','112.134.182.175','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2766,'super admin','2018-04-04 11:38:13','112.134.182.175','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2767,'Super admin','2018-04-07 04:46:43','112.134.251.146','Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2768,'super admin','2018-04-08 15:55:33','112.135.11.73','Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2769,'super admin','2018-04-08 15:55:53','112.135.11.73','Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2770,'super admin','2018-04-08 23:40:21','112.135.11.10','Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2771,'Super admin','2018-04-09 03:51:24','112.134.252.165','Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2772,'super admin','2018-04-10 10:41:18','112.134.253.76','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2773,'super admin','2018-04-20 04:39:35','112.134.219.207','Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2774,'super admin','2018-04-24 11:46:13','112.134.253.181','Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2775,'super admin','2018-05-04 18:21:53','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2776,'super admin','2018-05-04 18:24:12','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36'),(2777,'super admin','2018-05-04 18:31:05','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2778,'super admin','2018-05-04 18:46:12','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2779,'super admin','2018-05-04 19:21:40','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2780,'super admin','2018-05-05 04:55:54','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2781,'super admin','2018-05-05 06:03:54','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2782,'super admin','2018-05-05 06:55:05','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2783,'super admin','2018-05-05 06:58:46','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2784,'super admin','2018-05-05 07:00:31','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2785,'super admin','2018-05-05 07:06:49','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2786,'super admin','2018-05-05 07:07:16','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2787,'super admin','2018-05-05 07:07:49','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2788,'super admin','2018-05-05 07:10:07','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2789,'super admin','2018-05-05 07:10:36','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2790,'super admin','2018-05-05 07:14:31','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2791,'super admin','2018-05-05 07:36:24','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2792,'super admin','2018-05-05 09:54:32','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2793,'super admin','2018-05-05 18:39:07','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2794,'super admin','2018-05-11 17:52:37','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2795,'super admin','2018-05-11 18:50:18','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2796,'super admin','2018-05-12 12:16:53','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2797,'super admin','2018-05-12 13:39:38','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2798,'super admin','2018-05-12 13:42:01','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2799,'super admin','2018-05-12 13:42:27','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2800,'super admin','2018-05-14 18:57:35','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2801,'super admin','2018-05-23 18:03:42','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2802,'super admin','2018-05-24 17:32:13','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2803,'super admin','2018-05-25 17:51:37','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2804,'super admin','2018-05-25 19:12:05','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2805,'super admin','2018-05-25 19:34:31','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36'),(2806,'super admin','2018-05-25 19:42:20','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2807,'super admin','2018-05-27 04:31:00','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'),(2808,'super admin','2018-05-27 19:13:07','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2809,'super admin','2018-05-28 19:35:17','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2810,'super admin','2018-05-28 19:35:48','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2811,'super admin','2018-05-29 04:09:30','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2812,'super admin','2018-05-30 17:34:10','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2813,'super admin','2018-05-31 17:19:26','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2814,'super admin','2018-05-31 18:12:56','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2815,'super admin','2018-05-31 18:46:16','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2816,'super admin','2018-05-31 19:12:13','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36'),(2817,'super admin','2018-06-03 05:03:44','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2818,'super admin','2018-06-03 05:10:30','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2819,'super admin','2018-06-03 05:38:16','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2820,'super admin','2018-06-03 05:40:56','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2821,'super admin','2018-06-03 06:37:34','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2822,'super admin','2018-06-05 17:16:25','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2823,'super admin','2018-06-06 17:18:55','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2824,'super admin','2018-06-07 17:35:55','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2825,'super admin','2018-06-08 17:46:25','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2826,'super admin','2018-06-09 16:37:42','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2827,'super admin','2018-06-10 03:19:44','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2828,'super admin','2018-06-11 10:38:26','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2829,'super admin','2018-06-13 17:42:04','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2830,'super admin','2018-06-14 17:42:25','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2831,'super admin','2018-06-15 17:19:01','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2832,'super admin','2018-06-15 18:18:06','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2833,'super admin','2018-06-17 03:44:11','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2834,'super admin','2018-06-17 06:42:01','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2835,'super admin','2018-06-18 17:36:22','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2836,'super admin','2018-06-19 17:13:52','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2837,'super admin','2018-06-20 17:15:06','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2838,'super admin','2018-06-20 17:27:32','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2839,'super admin','2018-06-21 18:09:28','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2840,'super admin','2018-06-22 17:26:26','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2841,'super admin','2018-06-22 17:27:21','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2842,'super admin','2018-06-23 11:07:55','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2843,'super admin','2018-06-23 19:15:54','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2844,'super admin','2018-06-23 19:19:41','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2845,'super admin','2018-06-25 17:58:56','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2846,'super admin','2018-06-27 04:43:47','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2847,'super admin','2018-07-01 07:07:52','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2848,'super admin','2018-07-01 10:23:13','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2849,'super admin','2018-07-01 10:35:14','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2850,'super admin','2018-07-03 17:13:52','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2851,'super admin','2018-07-06 18:11:43','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2852,'super admin','2018-07-08 09:06:42','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2853,'super admin','2018-07-13 18:03:48','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2854,'super admin','2018-07-15 03:18:51','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2855,'super admin','2018-07-15 08:36:40','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2856,'super admin','2018-07-27 07:14:09','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2857,'super admin','2018-08-02 03:41:43','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2858,'super admin','2018-08-02 06:04:46','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2859,'super admin','2018-08-02 06:14:14','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2860,'super admin','2018-08-02 07:35:30','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2861,'Yujith','2018-08-02 10:36:39','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2862,'super admin','2018-08-02 13:46:47','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:60.0) Gecko/20100101 Firefox/60.0'),(2863,'super admin','2018-08-03 05:42:50','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2864,'Yujith','2018-08-03 06:23:51','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2865,'super admin','2018-08-03 07:49:24','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2866,'super admin','2018-08-03 07:49:43','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2867,'super admin','2018-08-03 07:54:43','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2868,'Yujith','2018-08-03 07:55:14','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2869,'super admin','2018-08-03 07:58:06','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2870,'super admin','2018-08-04 06:07:01','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2871,'super admin','2018-08-04 19:36:24','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2872,'super admin','2018-08-09 08:09:34','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2873,'super admin','2018-08-15 08:42:33','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2874,'super admin','2018-08-24 07:01:13','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0'),(2875,'super admin','2018-09-14 06:25:18','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2876,'super admin','2018-10-14 07:26:29','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2877,'super admin','2018-10-14 12:30:42','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2878,'super admin','2018-10-14 17:20:29','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2879,'super admin','2018-10-14 17:55:29','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2880,'super admin','2018-10-14 17:57:04','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2881,'super admin','2018-10-15 19:21:40','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2882,'super admin','2018-10-15 20:34:39','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2883,'super admin','2018-10-18 17:48:30','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2884,'super admin','2018-10-20 05:34:40','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2885,'super admin','2018-10-20 15:20:46','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2886,'super admin','2018-10-20 18:49:47','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0'),(2887,'super admin','2018-10-24 04:04:35','::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:62.0) Gecko/20100101 Firefox/62.0');

/*Table structure for table `marketing_officer` */

DROP TABLE IF EXISTS `marketing_officer`;

CREATE TABLE `marketing_officer` (
  `id_marketing_officer` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) NOT NULL,
  `name` varchar(400) NOT NULL,
  `joined_date` date NOT NULL,
  `nic` varchar(20) NOT NULL,
  `branch` int(11) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `fax_no` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_marketing_officer`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `marketing_officer` */

insert  into `marketing_officer`(`id_marketing_officer`,`title`,`name`,`joined_date`,`nic`,`branch`,`contact_no`,`address`,`status`,`fax_no`) values (42,'Mr.','yujith','0000-00-00','',0,'','',0,''),(43,'Mr.','lakmal','0000-00-00','923582369V',0,'0112700800','',1,'');

/*Table structure for table `repayment_detail` */

DROP TABLE IF EXISTS `repayment_detail`;

CREATE TABLE `repayment_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_id` int(11) DEFAULT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `collection_date` date DEFAULT NULL,
  `loan_serial` varchar(255) DEFAULT NULL,
  `paid_principal` double DEFAULT NULL,
  `paid_intarest` double DEFAULT NULL,
  `paid_penalty` double DEFAULT NULL,
  `paid_fees` double DEFAULT NULL,
  `due_principal` double DEFAULT NULL,
  `due_intarest` double DEFAULT NULL,
  `due_penalty` double DEFAULT NULL,
  `due_fees` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `repayment_detail` */

/*Table structure for table `repayment_headar` */

DROP TABLE IF EXISTS `repayment_headar`;

CREATE TABLE `repayment_headar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) DEFAULT NULL,
  `borrower` int(11) DEFAULT NULL,
  `repayment_amount` double DEFAULT NULL,
  `deposit_to` varchar(100) DEFAULT NULL,
  `repayment_method` varchar(100) DEFAULT NULL,
  `collection_date` date DEFAULT NULL,
  `collected_by` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `opening_balance` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `repayment_headar` */

/*Table structure for table `user_permission_delete` */

DROP TABLE IF EXISTS `user_permission_delete`;

CREATE TABLE `user_permission_delete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) DEFAULT NULL,
  `dashboard` int(11) DEFAULT '0',
  `appLoanApplication` int(11) DEFAULT '0',
  `myCompany` int(11) DEFAULT '0',
  `borrowerlist` int(11) DEFAULT '0',
  `loanofficerlist` int(11) DEFAULT '0',
  `arealist` int(11) DEFAULT '0',
  `collateraltypelist` int(11) DEFAULT '0',
  `loanproductlist` int(11) DEFAULT '0',
  `guaranterlist` int(11) DEFAULT '0',
  `loancollaterallist` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `user_permission_delete` */

insert  into `user_permission_delete`(`id`,`userName`,`dashboard`,`appLoanApplication`,`myCompany`,`borrowerlist`,`loanofficerlist`,`arealist`,`collateraltypelist`,`loanproductlist`,`guaranterlist`,`loancollaterallist`) values (5,'super admin',1,1,1,1,1,1,1,1,1,1),(8,'Yujith',0,0,0,NULL,1,1,1,1,1,1);

/*Table structure for table `user_permission_edit` */

DROP TABLE IF EXISTS `user_permission_edit`;

CREATE TABLE `user_permission_edit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) DEFAULT NULL,
  `dashboard` int(11) DEFAULT '0',
  `appLoanApplication` int(11) DEFAULT '0',
  `myCompany` int(11) DEFAULT '0',
  `borrowerlist` int(11) DEFAULT '0',
  `loanofficerlist` int(11) DEFAULT '0',
  `arealist` int(11) DEFAULT '0',
  `collateraltypelist` int(11) DEFAULT '0',
  `loanproductlist` int(11) DEFAULT '0',
  `guaranterlist` int(11) DEFAULT '0',
  `loancollaterallist` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `user_permission_edit` */

insert  into `user_permission_edit`(`id`,`userName`,`dashboard`,`appLoanApplication`,`myCompany`,`borrowerlist`,`loanofficerlist`,`arealist`,`collateraltypelist`,`loanproductlist`,`guaranterlist`,`loancollaterallist`) values (5,'super admin',1,1,1,1,1,1,1,1,1,1),(8,'Yujith',0,0,0,NULL,1,1,1,1,1,1);

/*Table structure for table `user_permission_save` */

DROP TABLE IF EXISTS `user_permission_save`;

CREATE TABLE `user_permission_save` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) DEFAULT NULL,
  `dashboard` int(11) DEFAULT '0',
  `appLoanApplication` int(11) DEFAULT '0',
  `myCompany` int(11) DEFAULT '0',
  `borrowerlist` int(11) DEFAULT '0',
  `loanofficerlist` int(11) DEFAULT '0',
  `arealist` int(11) DEFAULT '0',
  `collateraltypelist` int(11) DEFAULT '0',
  `loanproductlist` int(11) DEFAULT '0',
  `guaranterlist` int(11) DEFAULT '0',
  `loancollaterallist` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_permission_save` */

insert  into `user_permission_save`(`id`,`userName`,`dashboard`,`appLoanApplication`,`myCompany`,`borrowerlist`,`loanofficerlist`,`arealist`,`collateraltypelist`,`loanproductlist`,`guaranterlist`,`loancollaterallist`) values (2,'super admin',1,1,1,1,1,1,1,1,1,1),(4,'Yujith',1,1,1,NULL,1,1,1,1,1,1);

/*Table structure for table `user_permission_view` */

DROP TABLE IF EXISTS `user_permission_view`;

CREATE TABLE `user_permission_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) DEFAULT NULL,
  `dashboard` int(11) DEFAULT '0',
  `appLoanApplication` int(11) DEFAULT '0',
  `myCompany` int(11) DEFAULT '0',
  `borrowerlist` int(11) DEFAULT '0',
  `loanofficerlist` int(11) DEFAULT '0',
  `arealist` int(11) DEFAULT '0',
  `collateraltypelist` int(11) DEFAULT '0',
  `loanproductlist` int(11) DEFAULT '0',
  `guaranterlist` int(11) DEFAULT '0',
  `loancollaterallist` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `user_permission_view` */

insert  into `user_permission_view`(`id`,`userName`,`dashboard`,`appLoanApplication`,`myCompany`,`borrowerlist`,`loanofficerlist`,`arealist`,`collateraltypelist`,`loanproductlist`,`guaranterlist`,`loancollaterallist`) values (5,'super admin',1,1,1,1,1,1,1,1,1,1),(8,'Yujith',0,0,0,NULL,1,1,1,1,1,1);

/*Table structure for table `useracc` */

DROP TABLE IF EXISTS `useracc`;

CREATE TABLE `useracc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_ip` varchar(255) DEFAULT NULL,
  `login_time` varchar(255) DEFAULT NULL,
  `logged` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `useracc` */

insert  into `useracc`(`id`,`userName`,`password`,`status`,`last_activity`,`last_ip`,`login_time`,`logged`) values (1,'super admin','202cb962ac59075b964b07152d234b70','Admin','2018-10-24 06:24:43','::1','2018-10-24 04:04:35',1),(4,'Yujith','202cb962ac59075b964b07152d234b70','Admin','2018-08-03 07:57:11','::1','2018-08-03 07:55:14',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
