-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2015 at 07:00 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crafts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `username` varchar(10) NOT NULL,
  `password` varchar(12) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_name` varchar(30) NOT NULL,
  `category_id` int(5) NOT NULL AUTO_INCREMENT,
  `category_description` text NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `catID` (`category_id`),
  KEY `category_id` (`category_id`),
  KEY `category_id_2` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_name`, `category_id`, `category_description`) VALUES
('Denim', 1, 'Stuff about denims'),
('Coats/Jackets', 2, 'About coats and jackets'),
('Dresses', 3, 'Gals look pretty on dress');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(3) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(35) NOT NULL,
  `page_description` text NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_name`, `page_description`) VALUES
(1, 'About', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n</p>'),
(2, 'Terms & Conditions', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>'),
(3, 'FAQ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget luctus nulla. Quisque pulvinar ex eu libero sollicitudin, vitae ornare tellus auctor. Nunc at urna egestas, aliquam sem vitae, semper sem. Sed iaculis nisl in felis pulvinar mattis. Donec at nunc sapien. Vivamus a orci mattis, ultricies lorem ac, mollis erat. Pellentesque sed quam velit. Praesent maximus, enim et feugiat efficitur, tortor est malesuada neque, a euismod justo eros quis eros. Duis euismod nulla nunc, eu posuere justo aliquet sed.\r\n</p>\r\n<p>\r\nNulla id libero sed felis mollis cursus ut vel ante. Integer feugiat, orci id volutpat facilisis, elit leo volutpat sapien, eget eleifend velit tellus a sapien. Sed non sem sit amet turpis dignissim auctor. Integer vitae ligula porttitor dui finibus consequat. Curabitur faucibus mollis enim at euismod. Phasellus congue erat dolor, id pharetra dui ullamcorper nec. Praesent urna ex, facilisis ultricies augue eget, pellentesque laoreet nisl.\r\n</p>\r\n<p>\r\nSuspendisse potenti. Sed at porta enim. Sed cursus justo et erat sagittis, at auctor dolor blandit. Nam enim dolor, suscipit id leo a, elementum luctus dui. Aliquam posuere ipsum gravida dolor efficitur maximus. Integer non felis placerat, porta elit a, blandit nisi. Mauris venenatis urna nisi, eget vehicula nisi malesuada et. Etiam elementum vitae nisl at pellentesque. Aliquam in magna purus.\r\n</p>\r\n<p>\r\nInteger aliquet arcu quis ligula maximus ultrices. Donec enim arcu, scelerisque vel magna id, tincidunt pharetra odio. Donec at enim faucibus, aliquam justo varius, convallis sapien. Duis ut nisl nisl. Duis et arcu nulla. Mauris congue arcu id lorem consectetur, eget porttitor dui sodales. Cras euismod orci sed velit finibus, sed maximus felis efficitur. Nulla porta tellus non odio tristique congue. Nullam pretium, libero vel iaculis dignissim, dolor risus ullamcorper eros, ac efficitur sem urna eget nisi. Donec imperdiet faucibus eleifend. Morbi mattis risus a ornare maximus. Nunc pellentesque eros quam, vitae luctus dui ullamcorper nec.\r\n</p>\r\n<p>\r\nSed tincidunt tempus placerat. Donec in elementum erat. Pellentesque accumsan quis ipsum quis ullamcorper. Fusce eget rhoncus nibh. Sed fringilla justo turpis, non varius tellus sodales a. Nulla iaculis bibendum metus, id laoreet massa. Nullam id ultricies neque, ut bibendum augue. Pellentesque at leo nisl. Donec a urna mollis, suscipit diam id, pulvinar ex. Nunc lorem felis, blandit condimentum eros vel, sodales vulputate massa. Sed mauris leo, suscipit in finibus sed, pretium ut nibh. Suspendisse lacinia tempor est non efficitur. Morbi faucibus consectetur neque vel imperdiet. Nunc felis nunc, ullamcorper a metus et, euismod efficitur lectus. \r\n</p>');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(60) NOT NULL,
  `product_description` text NOT NULL,
  `price` double NOT NULL,
  `category_id` int(5) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `ItemID` (`product_id`),
  KEY `product_id` (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `price`, `category_id`) VALUES
(1, 'Utility Jacket', 'Easy to layer and loaded with utility chic this extremely versatile jacket is cut from hardwearing cotton lycra. Designed with an array of pockets, front zip closure and drawstring ties for a refine fit. The deep burgundy shade gives a modern update to an off duty look.', 380, 2),
(6, 'Lookast Moto Jacket', 'Easy to layer and loaded with utility chic this extremely versatile jacket is cut from hardwearing cotton lycra. Designed with an array of pockets, front zip closure and drawstring ties for a refine fit. The deep burgundy shade gives a modern update to an off duty look.', 550, 2),
(7, 'Onyx Trench Vest', 'Keep deconstructed cool in this rain resistant wax coated, black trench vest. Exclusive to Primary this season, it is the perfect outerwear for layering or wearing on its own.', 390, 2),
(8, 'Lookast Boyy Blazer', 'Taking a cue from menswear, the Boyy Blazer is perfect for the office or evening. Cut in a relaxed fit with a smart and tailored finish. Fully lined and featuring double breast front button closure, gold hardware with 2 side front pockets.', 195, 2),
(9, 'HUDSON Jude Jeans', 'Founded in 2002 by Peter Kim, California based and made denim brand Hudson Jeans are best known for their sleek fit, comfortable soft premium denim, sourced from Europe and Japan and signature back pocket flaps. Synonymous with edgy advertising campaigns and designs, the mission is to create fashion-forward denim that reflects their ethos “London edge meets L.A. glam.”\r\n\r\nBoyfriend style, Jude slouch skinny crop is cut from soft medium weight denim with a paint splatter detail to create a vintage worn feel. Featuring a relaxed fit from waist to knee with a skinnier, slim fit below the knee ending with a cuffed bottom hem for an effortless look.', 209, 1),
(10, 'HUDSON Krista Crop Jeans', 'Founded in 2002 by Peter Kim, California based and made denim brand Hudson Jeans are best known for their sleek fit, comfortable soft premium denim, sourced from Europe and Japan and signature back pocket flaps. Synonymous with edgy advertising campaigns and designs, the mission is to create fashion-forward denim that reflects their ethos “London edge meets L.A. glam.”\r\n\r\nCut from a super soft vintage indigo wash denim for an effortless everyday look. Designed with a skinny fit, flattering regular rise, 5 pocket detail, front zip closure and raw crop hem. Wear yours with a white tee or silk cami.', 198, 1),
(11, 'HUDSON Krista Crop Jeans', 'Founded in 2002 by Peter Kim, California based and made denim brand Hudson Jeans are best known for their sleek fit, comfortable soft premium denim, sourced from Europe and Japan and signature back pocket flaps. Synonymous with edgy advertising campaigns and designs, the mission is to create fashion-forward denim that reflects their ethos “London edge meets L.A. glam.”\r\n\r\nA staple skinny crop denim jeans, cut from newly engineered Elysian fabric for a super soft finish. Designed with a close but non-restricting fit, featuring whisker effect and well worn fade detail, 5 pocket, front zip closure and regular rise. Enhance the raw hem crop length with thick slides.', 209, 1),
(12, 'Cooper Shirt Dress', 'Inspired by the classic dress, crafted in LA using soft tencel for a slouchy drape. Designed with front button closure, drawstring waist for a flattering silhouette and finished with front patch pocket, rounded hem and ¾ length sleeves. For an effortless off-duty look, style with flats or ankle boots as the temperature drops.', 112, 1),
(13, 'Primary Reptile Zipper Dress', 'Our tank dress in a gorgeous reptile print, has zippers up the entire sides of garment for adjustable fit.\r\n\r\nDETAILS //\r\n\r\n    Color: Black // reptile jaquard\r\n    Content: 92% polyester, 8% elastic \r\n    Unlined \r\n    23" zipper on both side of dress\r\n    Racer back\r\n    Side seam pockets\r\n    Small front patch pocket\r\n    Silk belt\r\n    Made in New York\r\n    Dry clean only', 188, 3),
(14, 'Twisted Knot Dress', 'Founded by Micah Cohen in 2009 originally as a menswear line that would bridge the gap between fashion forward concept and versatile wearability. Shades of grey then launched their women’s line in fall/winter 2013, delivering a collection of quality made pieces that are both accessible and progressive in style. Stocked in over 150 worldwide, their philosophy is a perfect balance of tradition and the unfamiliar.\r\n\r\nAn elegant classic shift dress designed with a twisted knot front to flatter and define your waist and hips. Cut from a lightweight soft jersey fabric featuring asymmetrical hem and simple round neck-line. Complete this effortless look with ankle boots and clutch.', 139, 3),
(15, 'Lea Tank Dress', 'This light-weight tank dress is designed with a sheer front overlay and draped jersey back. Fully lined and cut with a relaxed shape, finished with capped sleeves, round neck-line and side split makes this an all year off duty staple.', 58, 3),
(16, 'Alice Shift Dress', 'An understated classic little black dress, cut from textured fabric in a mini length. Designed with a flattering straight silhouette, featuring a V-neck, fully lined and finished with exposed back zip closure. Wear with heels, a simple clutch and gold accessories.', 98, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(10) NOT NULL,
  `password` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`user_name`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`) VALUES
(1, 'test', 'ccc', 'test@test.com'),
(2, 'raju', '123', 'squizeers@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
