-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 07, 2016 at 10:27 AM
-- Server version: 5.1.47
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `andy_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `paypal` varchar(255) NOT NULL,
  `vat` int(11) DEFAULT '0',
  `admin_login_IP` varchar(255) NOT NULL,
  `admin_last_login_date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `paypal`, `vat`, `admin_login_IP`, `admin_last_login_date`) VALUES
(1, 'admin', 'admin', 'russel.crow100@gmail.com', 'russel.crow100@gmail.com', 0, '127.0.0.1', '20-05-2015');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `dfile` varchar(255) DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT '999',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `description`, `dfile`, `order_no`, `date`, `status`) VALUES
(1, 'banner1', '1447401599.jpg', 1, '2015-11-10 13:06:36', 'Y'),
(2, 'banner2', '1447401610.jpg', 1, '2015-11-10 13:06:48', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `call_back`
--

DROP TABLE IF EXISTS `call_back`;
CREATE TABLE IF NOT EXISTS `call_back` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `joblocation` text NOT NULL,
  `message` text NOT NULL,
  `clint_ip` varchar(255) DEFAULT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `call_back`
--

INSERT INTO `call_back` (`id`, `name`, `phone`, `email`, `joblocation`, `message`, `clint_ip`, `post_date`) VALUES
(2, 'john smith2', '8888888888', 'john@yahoo.com', '', 'Please contact us to arrange an appointment by phone', NULL, '2015-07-20 06:14:53'),
(3, 'neo smith', '8888844489', 'neo@gmail.com', '', 'Please consult me asap.', NULL, '2015-07-20 07:35:58'),
(4, 'test', '4444444444', 'raj@gmail.com', 'india', 'test', NULL, '2015-11-13 10:48:46'),
(5, 'admin', '222222222', 'ss@gmail.com', 'ddddddddd', 'ddddddd', NULL, '2015-11-13 10:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_title` varchar(255) NOT NULL,
  `order_no` int(11) NOT NULL,
  `dfile` varchar(255) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `gallery_title`, `order_no`, `dfile`, `status`) VALUES
(1, 'test card', 2, '1442235923.jpg', 'Y'),
(2, 'ffff', 1, '1442241552.jpg', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

DROP TABLE IF EXISTS `cms`;
CREATE TABLE IF NOT EXISTS `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text,
  `page_name` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `page_heading` varchar(255) DEFAULT NULL,
  `dfile` varchar(255) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `url_title` text,
  `order_id` int(255) DEFAULT '0',
  `link_as` int(11) DEFAULT '4',
  `page_under` varchar(255) DEFAULT NULL,
  `for_menu` enum('P','S','N','I','C') NOT NULL DEFAULT 'I' COMMENT 'P-primary,S-secondary,N-not menu,I-inner,C-content ',
  `is_category` enum('Y','N') DEFAULT 'N',
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `desc`, `page_name`, `meta_title`, `meta_description`, `page_heading`, `dfile`, `template`, `url_title`, `order_id`, `link_as`, `page_under`, `for_menu`, `is_category`, `status`) VALUES
(1, '<p><img alt="" class="img-left" src="http://192.168.1.12/teamD/rajiv/andy/admin/js/plugin/ckfinder/userfiles/images/img1.jpg" /></p>\r\n\r\n<p>Our rates are competitive across our whole spectrum of services and we will be happy to visit your home to give you a free no obligation quotation. No job is too small for us and regardless of the size of the job we will always offer you our best price.</p>', 'Home', 'Home', 'Home', NULL, NULL, 'about.php', 'home', NULL, NULL, NULL, 'P', 'N', 'Y'),
(2, '<div class="cont-sec-left inner">\r\n<p>We are a family run business based in Bolton (Greater Manchester) and have provided a consistently reliable and friendly service for 12 years. Although we are general builders, our specialist areas are roofing and pointing. We work throughout the north west and have carried out numerous jobs in Bolton, Manchester, Radcliffe, Bury, Wigan and Preston to name a few</p>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>\r\n\r\n<p><img alt="" class="img-centre" src="http://192.168.1.12/teamD/rajiv/andy/admin/js/plugin/ckfinder/userfiles/images/img2.jpg" /></p>\r\n\r\n<p>Tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ulla mco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n\r\n<hr />\r\n<h3>Why Us</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n\r\n<ul class="contentList">\r\n	<li>Amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</li>\r\n	<li>Dolore magna aliqua ut enim ad minim veniam, quis nostrud exercitation</li>\r\n	<li>Ullamco laboris nisi ut aliquip ex ea commodo consequat duis aute irure dolor</li>\r\n	<li>In reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatu</li>\r\n	<li>Magna aliqua ut enim ad minim veniam, quis nostrud exercitation</li>\r\n	<li>Laboris nisi ut aliquip ex ea commodo consequat duis aute irure dolor</li>\r\n	<li>Tempor incididunt ut labore et dolore magna aliqua enim ad</li>\r\n</ul>\r\n\r\n<hr />\r\n<h3>How we work</h3>\r\n\r\n<div class="weWorkBox">\r\n<div class="weWorkImg"><img alt="work-img1" src="images/work-img1.png" /></div>\r\n\r\n<div class="weWorkContent">\r\n<h6>Consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget.</h6>\r\n\r\n<p>Vivamus vel eros eget magna volutpat sagittis. Nulla faucibus nibh a magna tincidunt accumsan hendrerit nunc facilisis. Curabitur et libero sit amet ante hendrerit molestie. Cras a erat in leo</p>\r\n</div>\r\n</div>\r\n\r\n<div class="weWorkBox">\r\n<div class="weWorkImg"><img alt="work-img2" src="images/work-img2.png" /></div>\r\n\r\n<div class="weWorkContent">\r\n<h6>Consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget.</h6>\r\n\r\n<p>Vivamus vel eros eget magna volutpat sagittis. Nulla faucibus nibh a magna tincidunt accumsan hendrerit nunc facilisis. Curabitur et libero sit amet ante hendrerit molestie. Cras a erat in leo</p>\r\n</div>\r\n</div>\r\n\r\n<div class="weWorkBox">\r\n<div class="weWorkImg"><img alt="work-img3" src="images/work-img3.png" /></div>\r\n\r\n<div class="weWorkContent">\r\n<h6>Consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget.</h6>\r\n\r\n<p>Vivamus vel eros eget magna volutpat sagittis. Nulla faucibus nibh a magna tincidunt accumsan hendrerit nunc facilisis. Curabitur et libero sit amet ante hendrerit molestie. Cras a erat in leo</p>\r\n</div>\r\n</div>\r\n\r\n<div class="weWorkBox">\r\n<div class="weWorkImg"><img alt="work-img4" src="images/work-img4.png" /></div>\r\n\r\n<div class="weWorkContent">\r\n<h6>Consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget.</h6>\r\n\r\n<p>Vivamus vel eros eget magna volutpat sagittis. Nulla faucibus nibh a magna tincidunt accumsan hendrerit nunc facilisis. Curabitur et libero sit amet ante hendrerit molestie. Cras a erat in leo</p>\r\n</div>\r\n</div>\r\n</div>', 'about us', 'about-us', 'about-us', NULL, NULL, 'about.php', 'about-us', 2, NULL, NULL, 'P', 'N', 'Y'),
(3, '<p>roofing-services</p>', 'roofing services', 'roofing-services', 'roofing-services', 'roofing-services', NULL, 'roofing.php', 'roofing-services', 3, NULL, NULL, 'P', 'N', 'Y'),
(4, '<p>pointing-services</p>', 'pointing services', 'pointing-services', 'pointing-services', 'pointing-services', NULL, 'about.php', 'pointing-services', 1, NULL, NULL, 'P', 'N', 'Y'),
(5, '<p>happy-customeres</p>', 'happy customeres', 'happy-customeres', 'happy-customeres', 'happy-customeres', NULL, 'testimonials.php', 'happy-customeres', 5, NULL, NULL, 'P', 'N', 'Y'),
(6, '<p>contact us</p>', 'contact us', 'contact us', 'contact us', 'contact us', NULL, 'contactus.php', 'contact-us', 6, NULL, NULL, 'P', 'N', 'Y'),
(7, '<p>all-roofing-work-carried-out</p>', 'all roofing work carried out', 'all-roofing-work-carried-out', 'all-roofing-work-carried-out', 'all-roofing-work-carried-out', NULL, 'about.php', 'all-roofing-work-carried-out', 1, NULL, '3', 'S', 'N', 'Y'),
(8, '<p>slated-and-tiles-roofing-and-repairs</p>', 'slated and tiles roofing and repairs', 'slated-and-tiles-roofing-and-repairs', 'slated-and-tiles-roofing-and-repairs', 'slated-and-tiles-roofing-and-repairs', NULL, 'about.php', 'slated-and-tiles-roofing-and-repairs', 2, NULL, '3', 'S', 'N', 'Y'),
(9, '<p>all pointing work carried out</p>', 'all pointing work carried out', 'all pointing work carried out', 'all pointing work carried out', 'all pointing work carried out', NULL, 'about.php', 'all-pointing-work-carried-out', 1, NULL, '4', 'S', 'N', 'Y'),
(10, '<p>Our rates are competitive across our whole spectrum of services and we will be happy to visit your home to give you a free no obligation quotation. No job is too small for us and regardless of the size of the job we will always offer you our best price.</p>', 'Competitive rates', '', '', '', NULL, 'about.php', 'competitive-rate', 1, NULL, NULL, 'C', 'N', 'Y'),
(11, '<p><span>If the job involves roofing, pointing, guttering or fascias/cladding... we can do it. The services we offer include, but aren''t limitted to:</span></p>\r\n              <div class="services-left">\r\n                 <h3>Roofing services</h3>\r\n                 <ul>\r\n                    <li><a href="#"><i class="fa fa-check"></i> All roofing work carried out</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> Slated & tiles roofing & repairs</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> Pitch roofs & flat roofs</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> Chimney building/repair</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> New/replacement guttering</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> Fascias soffits & cladding replaced</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> All types of guttering</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> Leadwork, zinc & metal roofs</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> Roofs and guttering cleaning</a></li>\r\n                 </ul>\r\n              </div><!--services-left end here-->\r\n              \r\n              <div class="services-left odd">\r\n                 <h3>Pointing services</h3>\r\n                 <ul>\r\n                    <li><a href="#"><i class="fa fa-check"></i> All pointing work carried out</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> Full or part house pointing</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> Pitch roofs & flat roofs</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> Chimney pointing</a></li>\r\n                    <li><a href="#"><i class="fa fa-check"></i> Re-bedding of ridge tiles</a></li>\r\n                 </ul>\r\n              </div>', 'Our services', NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, NULL, 'C', 'N', 'Y'),
(12, '<p>We are a family run business based in Bolton (Greater Manchester) and have provided a consistently reliable and friendly service for 12 years. Although we are general builders, our specialist areas are roofing and pointing. We work throughout the north west and have carried out numerous jobs in Bolton, Manchester, Radcliffe, Bury, Wigan and Preston to name a few.</p>', 'heading', NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, NULL, 'C', 'N', 'Y'),
(13, '<p><a href="http://192.168.1.12/teamD/rajiv/andy/pointing-services#">Full or part house pointingFull or part house pointingFull or part house pointing</a></p>', 'Full or part house pointing', 'Full or part house pointing', 'Full or part house pointing', NULL, NULL, 'about.php', 'full-or-part-house-pointing', 2, NULL, '4', 'S', 'N', 'Y'),
(14, '<address>\r\n    36 The Trinity<br>\r\n    Bridgeman Street<br>\r\n    Bolton, Lancashire<br>\r\n    BL3 6RS<br>\r\n    <br>\r\n    <i class="fa fa-phone"></i>01204 391981<br>\r\n    <i class="fa fa-mobile"></i>07737 628453<br>\r\n    <br>\r\n    Email: info@roofingandpointing.co.uk\r\n    </address>', 'Our address', NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, NULL, 'C', 'N', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `joblocation` text NOT NULL,
  `message` text NOT NULL,
  `clint_ip` varchar(255) DEFAULT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `phone`, `email`, `joblocation`, `message`, `clint_ip`, `post_date`) VALUES
(2, 'john smith', '8888888888', 'john@yahoo.com', '', 'Please contact us to arrange an appointment by phone', NULL, '2015-07-20 06:14:53'),
(3, 'neo smith', '8888844489', 'neo@gmail.com', '', 'Please consult me asap.', NULL, '2015-07-20 07:35:58'),
(4, 'test', '4444444444', 'raj@gmail.com', 'india', 'test', NULL, '2015-11-13 10:48:46'),
(5, 'admin', '222222222', 'ss@gmail.com', 'ddddddddd', 'ddddddd', NULL, '2015-11-13 10:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `lead_in_description` varchar(255) NOT NULL,
  `dfile` varchar(255) NOT NULL,
  `url_title` varchar(255) NOT NULL,
  `posted_date` date NOT NULL,
  `event_time` time NOT NULL,
  `status` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `page_name`, `desc`, `meta_title`, `meta_description`, `lead_in_description`, `dfile`, `url_title`, `posted_date`, `event_time`, `status`) VALUES
(1, 'Hello test test', '<p>welcome to bolton cancer voices</p>', 'Hello test test', 'Hello test test', 'This is the third year weâ€™ve staged this popular concert, which just keeps getting better', '', 'hello-test-test', '2015-09-07', '05:00:00', 'Y'),
(2, 'test test', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'test test', 'test test', 'This is the third year weâ€™ve staged this popular concert, which just keeps getting better', '1441692838.jpg', 'test-test', '2015-08-18', '10:20:00', 'Y'),
(3, 'hello world2', '<p>This is the third year we&rsquo;ve staged this popular concert, which just keeps getting better</p>', 'hello world', 'hello world', 'This is the third year weâ€™ve staged this popular concert, which just keeps getting better THE', '1441626491.JPG', 'hello-world2', '2015-08-20', '15:50:00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `lead_in_description` varchar(255) NOT NULL,
  `dfile` varchar(255) DEFAULT NULL,
  `posted_by` varchar(255) NOT NULL,
  `url_title` varchar(255) NOT NULL,
  `posted_date` date NOT NULL,
  `status` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `page_name`, `desc`, `meta_title`, `meta_description`, `lead_in_description`, `dfile`, `posted_by`, `url_title`, `posted_date`, `status`) VALUES
(1, 'Hello test test', '<p>welcome to bolton cancer voices</p>', 'Hello test test', 'Hello test test', 'This is the third year weâ€™ve staged this popular concert, which just keeps getting better', '1442828113.jpg', 'admin', 'hello-test-test', '2015-09-03', 'Y'),
(2, 'test test', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'test test', 'test test', 'This is the third year weâ€™ve staged this popular concert, which just keeps getting better', '', 'Admin', 'test-test', '2015-09-08', 'Y'),
(7, 'testing news', '<p>testing newstesting newstesting newstesting newstesting newstesting news</p>', 'testing news', 'testing news', 'testing news', '1442828083.jpg', '', 'testing-news', '2015-09-18', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `roofing`
--

DROP TABLE IF EXISTS `roofing`;
CREATE TABLE IF NOT EXISTS `roofing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text,
  `dfile` varchar(255) DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT '999',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `roofing`
--

INSERT INTO `roofing` (`id`, `title`, `description`, `dfile`, `order_no`, `date`, `status`) VALUES
(5, 'All roofing work carried out', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia ut lorem non convallis. Vivamus consectetur, elit et pulvinar porttitor, mi lacus pellentesque tellus, at ornare eros ligula lobortis dui. Morbi non lectus tincidunt, sollicitudin lorem sed, sodales tortor. Phasellus suscipit mauris eget risus pretium, id consequat metus sodales. Nulla at ultrices metus. Phasellus lacinia quam ut ante vehicula consectetur. Sed luctus neque eu pellentesque consectetur. Vestibulum tincidunt ex sed magna accumsan mollis. Vivamus sodales est sed placerat volutpat. Vestibulum id bibendum justo, nec bibendum arcu.', '1447405049.jpg', 1, '2015-11-13 08:44:14', 'Y'),
(6, 'Slated & tiles roofing & repairs', 'Demo Description 2', '1448278121.jpg', 1, '2015-11-13 08:44:30', 'Y'),
(7, 'Title 3', 'Demo Description 3', '1447404999.jpg', 1, '2015-11-13 08:54:14', 'Y'),
(8, 'Title 4', 'Demo Description 4', '1447405017.jpg', 1, '2015-11-13 08:54:47', 'Y'),
(9, 'Title 5', 'Demo Description 5', '1447404901.jpg', 1, '2015-11-13 08:55:01', 'Y'),
(10, 'Title 6', 'Demo Description 6', '1447404933.jpg', 1, '2015-11-13 08:55:33', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

DROP TABLE IF EXISTS `social_media`;
CREATE TABLE IF NOT EXISTS `social_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `google` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `facebook`, `twitter`, `youtube`, `linkedin`, `google`, `pinterest`, `phone`, `mobile`, `email`) VALUES
(1, 'https://www.facebook.com/boltoncancervoices', 'https://twitter.com/boltoncancervoices', 'https://www.youtube.com/channel/UCpn0xsoyqBx0WcghvPnCNDw', '', '', '', '01204 391981', '07737 628453', 'info@roofingandpointing.co.uk');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

DROP TABLE IF EXISTS `testimonial`;
CREATE TABLE IF NOT EXISTS `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` text,
  `page_name` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `posted_date` varchar(255) DEFAULT NULL,
  `posted_by` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `lead_in_description` text,
  `dfile` varchar(255) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `url_title` text,
  `order_id` int(255) DEFAULT '0',
  `is_category` enum('Y','N') DEFAULT 'N',
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `desc`, `page_name`, `meta_title`, `meta_description`, `posted_date`, `posted_by`, `email`, `lead_in_description`, `dfile`, `template`, `url_title`, `order_id`, `is_category`, `status`) VALUES
(1, '<p>Aenean nonummy hendrerit mau phasellu porta. Fusce suscipit varius mi sed. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio morbi.</p>\r\n      <p>Ut viverra mauris justo, quis auctor nisi. Suspendisse sit amet diam diam, eget volutpat lacus. Vestibulum faucibus scelerisque nisl vitae scelerisque. Sed tristique metus eu quam viverra malesuada. Cras porta eros nec libero bibendum sed faucibus felis fringilla. Quisque sed odio neque. Mauris at nisl ac eros pretium hendrerit vitae et velit. Aliquam erat volutpat. Proin sit amet erat vel nisl consectetur auctor et at quam.</p>', 'TESTIMONIAL 1', NULL, NULL, '2015-07-30', 'John Smith - Bolton Cancer Voices', NULL, NULL, '1443593421.jpg', NULL, 'testimonial-1', 1, 'N', 'Y'),
(2, '<p>I am so pleased with how the website looks, you have done an AMAZING job. This has the wow factor. Thank you so very much, I am honestly really delighted with it. Looks super professional, engaging and I love it.</p>', 'TESTIMONIAL 2', NULL, NULL, '2015-07-30', 'Kay Smith - Bolton Communications', NULL, NULL, '1443593363.jpg', NULL, 'testimonial-2', 1, 'N', 'Y'),
(6, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fermentum cursus ligula, et commodo justo venenatis sed. Vestibulum tincidunt pharetra felis blandit dignissim. Pellentesque et felis ex. Nam malesuada commodo justo, in scelerisque augue. Praesent venenatis viverra blandit. Phasellus eu ornare enim, vel euismod arcu. Phasellus non scelerisque mauris, malesuada aliquam enim.</p>', 'TEST1', NULL, NULL, '2015-09-08', 'Admin', NULL, NULL, '1443593430.jpg', NULL, 'test1', 1, 'N', 'Y'),
(7, '<p>Come and join us: everyone is so kind and it will make you feel much better.</p>', 'test4', NULL, NULL, '2015-09-08', 'Admin', NULL, NULL, '1443593438.jpg', NULL, 'test4', 1, 'N', 'Y'),
(8, '<p>testinggggg</p>', 'sep last', NULL, NULL, '2015-09-30', 'Admin', NULL, NULL, '1443593446.jpg', NULL, 'sep-last', 1, 'N', 'Y');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
