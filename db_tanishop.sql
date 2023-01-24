/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.24-MariaDB : Database - db_tanishop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_tanishop` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_tanishop`;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `category` */

insert  into `category`(`cat_id`,`cat_name`) values 
(4,'Sayur'),
(6,'Buah'),
(7,'Bumbu Dapur');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

insert  into `orders`(`order_id`,`user_id`,`prod_id`,`qty`) values 
(11,4,8,1),
(12,4,8,1),
(13,4,7,1),
(14,5,15,1);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(30) NOT NULL,
  `prod_desc` varchar(500) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `prod_img` varchar(255) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`prod_id`,`prod_name`,`prod_desc`,`prod_price`,`prod_img`,`sub_id`,`cat_id`) values 
(15,'Wortel','Wortel',10000,'Wortel.jpeg',4,4),
(17,'Timun','Timun',8000,'Timun.jpeg',4,4),
(18,'Melon','Melon',20000,'Melon.jpeg',6,6),
(19,'Jeruk','Jeruk',15000,'Jeruk.jpeg',6,6),
(20,'Bayam','Bayam',3000,'bayam.jpg',7,4),
(21,'Kol','Kol',12000,'kol.jpg',7,4),
(22,'Terong','Terong',15000,'terong.jpg',7,4),
(23,'Sawi','Sawi',3000,'sawi.jpg',7,4),
(24,'Buncis','Buncis',16000,'buncis.jpg',7,4),
(26,'Kunyit','Kunyit',12000,'kunyit.jpg',7,7),
(27,'Bawang Merah','Bawang Merah',32000,'bawangmerah.jpg',7,7),
(28,'Jahe','Jahe',9200,'jahe.jpg',7,7),
(30,'Alpukat','Alpukat',28000,'alpukat.jpg',6,6),
(33,'Kangkung','Kangkung',3000,'kangkung.jpg',4,4),
(35,'Kentang','Kentang',12000,'kentang.jpg',7,4),
(36,'Buah Naga','Buah Naga',16000,'buahnaga.jpg',6,6),
(38,'Apel','Apel',45000,'apel.jpg',6,6),
(39,'Anggur','Anggur',40000,'anggur.jpg',6,6),
(41,'Cabai Merah','Cabai Merah',55000,'cabaimerah.jpg',7,7),
(42,'Sereh','Sereh',5000,'sereh.jpg',7,7),
(43,'Lengkuas','Lengkuas',15000,'lengkuas.jpg',7,7),
(45,'Bawang Putih','Bawang Putih',20000,'bawangputih.jpg',7,7),
(46,'Kemiri','Kemiri',13000,'kemiri.jpg',7,7),
(47,'Merica','Merica',75000,'merica.jpg',7,7);

/*Table structure for table `sub_category` */

DROP TABLE IF EXISTS `sub_category`;

CREATE TABLE `sub_category` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(30) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `sub_category` */

insert  into `sub_category`(`sub_id`,`sub_name`,`cat_id`) values 
(7,'Sayur',4),
(8,'Buah',6),
(9,'Bumbu Dapur',7);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `address` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `gender` char(1) NOT NULL,
  `registered_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`email`,`password`,`role`,`address`,`phone`,`gender`,`registered_on`) values 
(1,'admin','admin','admin@admin.com','21232f297a57a5a743894a0e4a801fc3','admin','admin@admin@admin','1234567890','M','2022-11-27 14:52:00'),
(5,'admin','aja','adminsatu@gmail.com','3fc0a7acf087f549ac2b266baf94b8b1','admin','jl. dahlia vii','08125475546','M','2023-01-18 15:05:27'),
(8,'tes','aus','test@gmail.com','cc03e747a6afbbcbf8be7668acfebee5','user','jkalkslkdlak','098238','M','2023-01-20 19:25:37'),
(9,'tia','nandap','Tiananda@gamil.com','25d55ad283aa400af464c76d713c07ad','user','jalanjalan','085432146788','F','2023-01-24 13:21:59');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
