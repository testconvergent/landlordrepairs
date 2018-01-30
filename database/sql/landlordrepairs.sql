-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2017 at 07:00 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `landlordrepairs`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_type_id` int(11) DEFAULT NULL,
  `looking_for` varchar(255) DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `job_details` text,
  `lattitude` decimal(12,6) DEFAULT '0.000000',
  `longitude` decimal(12,6) DEFAULT '0.000000',
  `no_of_bids` int(3) DEFAULT '0',
  `avg_bid` decimal(12,2) DEFAULT '0.00',
  `exp_date` datetime DEFAULT NULL,
  `job_status` int(1) NOT NULL DEFAULT '0' COMMENT '0-Draft,1-Active,2-Inactive,3-Hired,4=>complete,5=>delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `user_id`, `job_type_id`, `looking_for`, `budget`, `deadline`, `city`, `zip_code`, `job_details`, `lattitude`, `longitude`, `no_of_bids`, `avg_bid`, `exp_date`, `job_status`) VALUES
(1, 6, 1, 'A Mechanic For Bathroom Shower', '120.00', '2018-01-26', 'Manchester Airport, Manchester, United Kingdom', '524523', 'A mechanic for bathroom shower who knows everything about that with 3 year of experience.', '53.358803', '-2.272730', 4, '289.00', '2018-01-26 00:00:00', 4),
(2, 6, 3, 'Good Electricians', '450.00', '2017-12-31', 'Manchester, United Kingdom', 'MU-12458', 'Electricians typically do the following: Read blueprints or technical diagrams. Install and maintain wiring, control, and lighting systems. Inspect electrical components, such as transformers and circuit breakers.', '53.480759', '-2.242631', 0, '0.00', '2018-01-25 00:00:00', 0),
(3, 6, 4, 'Best Service Provider', '100.00', '2018-01-02', 'Manchester Airport, Manchester, United Kingdom', 'MU-12458', 'Gas and oil engineer job description. As an oil or gas network engineer, you will install and maintain the pipelines that supply homes and businesses. Common job roles in oil and gas engineering include process engineer, structural engineer and safety engineer.', '53.358803', '-2.272730', 2, '289.50', '2018-01-10 00:00:00', 4),
(4, 0, 1, 'sdfsf', '2323.00', '2017-12-29', '33 Liverpool Street, London, United Kingdom', '1212', 'wee', '51.517015', '-0.081661', 0, '0.00', '2018-01-27 00:00:00', 0),
(5, 0, 1, 'A mechanic for bathroom shower', '123.00', '2018-02-15', '14 Oxford Street, London, United Kingdom', '12222', 'adadasd', '51.516556', '-0.131168', 0, '0.00', '2018-01-27 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE `job_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_status` int(1) NOT NULL DEFAULT '1' COMMENT '0=>Inactive,1=>Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Bathroom Fitters', 1),
(2, 'Bricklayers', 1),
(3, 'Carpenters & Joiners', 1),
(4, 'Carpet fitters', 1),
(5, 'Chimney & Fireplace Specialists', 1),
(6, 'Conservatory Installers', 1),
(7, 'Conversion Specialists', 1),
(8, 'Damp Proofing Specialists', 1),
(9, 'Demolition Contractors', 1),
(10, 'Window Fitters', 1),
(11, 'Driveway Pavers', 1),
(12, 'Electricians', 1),
(13, 'Extension Builders', 1),
(14, 'Fencers', 1),
(15, 'Flooring Fitters', 1),
(16, 'Tree Surgeons', 1),
(17, 'Gas Engineers', 1),
(18, 'Groundworkers', 1),
(19, 'Handymen', 1),
(20, 'Heating Engineers', 1),
(21, 'Insulation Installers', 1),
(22, 'Kitchen Fitters', 1),
(23, 'Landscape Gardeners', 1),
(24, 'Loft Conversion Specialists', 1),
(25, 'Painters & Decorators', 1),
(26, 'Plasterers', 1),
(27, 'Plumbers', 1),
(28, 'Roofers', 1),
(29, 'Security System Installers', 1),
(30, 'Stonemasons', 1),
(31, 'Tilers', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_invitation`
--

CREATE TABLE `job_invitation` (
  `job_invitation_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL DEFAULT '0',
  `from_user_id` int(11) NOT NULL DEFAULT '0',
  `to_user_id` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `started_date` datetime DEFAULT NULL,
  `description` text,
  `attachment` varchar(255) DEFAULT NULL,
  `invitation_status` int(1) NOT NULL DEFAULT '0' COMMENT '0=>invitation sent,1=>Reply from builder,2=>hire_builder,3=>complete,4=>builder lost',
  `invitation_read` int(1) NOT NULL DEFAULT '0' COMMENT '0=>new, 1=>Read',
  `awarded_job_date` date DEFAULT NULL,
  `job_complete_date` datetime DEFAULT NULL,
  `invitation_date` datetime DEFAULT NULL,
  `is_review` int(1) NOT NULL DEFAULT '0' COMMENT '1=>review'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_invitation`
--

INSERT INTO `job_invitation` (`job_invitation_id`, `job_id`, `from_user_id`, `to_user_id`, `price`, `started_date`, `description`, `attachment`, `invitation_status`, `invitation_read`, `awarded_job_date`, `job_complete_date`, `invitation_date`, `is_review`) VALUES
(1, 1, 6, 163, '345.00', '2017-12-28 00:00:00', 'urgent Reply from sriram', '1514376973.jpg', 4, 1, NULL, NULL, '2017-12-27 12:14:54', 0),
(2, 1, 6, 93, '233.00', '2017-12-31 00:00:00', 'quote description from mills', '1514380358.docx', 3, 1, '2017-12-27', '2017-12-28 08:20:55', '2017-12-27 12:14:55', 0),
(5, 3, 6, 90, '0.00', NULL, NULL, NULL, 4, 0, NULL, NULL, '2017-12-27 12:15:04', 0),
(6, 3, 6, 91, '456.00', '2017-12-29 00:00:00', 'quote description from schiller', '1514380225.docx', 3, 1, '2017-12-28', '2017-12-28 07:48:36', '2017-12-27 12:15:05', 0),
(7, 3, 6, 88, '123.00', '2017-12-29 00:00:00', 'dfsdfsdfs', '1514446997.docx', 4, 1, NULL, NULL, '2017-12-27 12:15:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_to_attachment`
--

CREATE TABLE `job_to_attachment` (
  `attachment_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL DEFAULT '0',
  `attachment_name` varchar(255) DEFAULT NULL,
  `orginal_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_to_attachment`
--

INSERT INTO `job_to_attachment` (`attachment_id`, `job_id`, `attachment_name`, `orginal_name`) VALUES
(1, 1, '1514361331.txt', 'new 1dfgd.txt'),
(2, 2, '1514373215.pdf', 'Electrician.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `job_to_category`
--

CREATE TABLE `job_to_category` (
  `job_cat_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `job_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_to_category`
--

INSERT INTO `job_to_category` (`job_cat_id`, `category_id`, `job_id`) VALUES
(1, 1, 1),
(2, 12, 2),
(3, 17, 3),
(4, 2, 4),
(5, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `job_type_id` int(11) NOT NULL,
  `job_type_name` varchar(255) DEFAULT NULL,
  `job_type_status` int(1) DEFAULT '1' COMMENT '0=>Inactive,1=>Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`job_type_id`, `job_type_name`, `job_type_status`) VALUES
(1, 'Emergency job', 1),
(2, 'End of tenancy job', 1),
(3, 'Maintenance job', 1),
(4, 'Normal job', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `package_type` int(1) NOT NULL DEFAULT '0' COMMENT '1=>bronze,2=>silver,3=>gold',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `credit_point` decimal(10,2) NOT NULL DEFAULT '0.00',
  `package_description` text,
  `package_status` int(1) NOT NULL DEFAULT '0' COMMENT '1=>Active,0=>Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `package_type`, `cost`, `credit_point`, `package_description`, `package_status`) VALUES
(1, 1, '100.00', '30.00', 'Test Description', 1),
(2, 2, '200.00', '50.00', 'This is the test description', 1);

-- --------------------------------------------------------

--
-- Table structure for table `report_builder`
--

CREATE TABLE `report_builder` (
  `report_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL DEFAULT '0',
  `report_from_user_id` int(11) DEFAULT '0',
  `report_to_user_id` int(11) NOT NULL DEFAULT '0',
  `report_title` varchar(255) DEFAULT NULL,
  `report_description` text,
  `report_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `builder_id` int(11) NOT NULL DEFAULT '0',
  `job_id` int(11) NOT NULL DEFAULT '0',
  `quality` decimal(10,2) NOT NULL DEFAULT '0.00',
  `on_time` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `hire` decimal(10,2) NOT NULL DEFAULT '0.00',
  `review_title` varchar(255) DEFAULT NULL,
  `recomm` decimal(10,2) NOT NULL DEFAULT '0.00',
  `comments` text,
  `total_review` decimal(10,2) DEFAULT '0.00',
  `ave_review` decimal(10,2) NOT NULL DEFAULT '0.00',
  `review_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `static_page`
--

CREATE TABLE `static_page` (
  `page_id` int(11) NOT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_slug` varchar(255) DEFAULT NULL,
  `page_description` text,
  `page_meta_title` varchar(255) DEFAULT NULL,
  `page_meta_description` text,
  `page_status` int(1) NOT NULL DEFAULT '1' COMMENT '0=>Inactive,1=>Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `static_page`
--

INSERT INTO `static_page` (`page_id`, `page_title`, `page_slug`, `page_description`, `page_meta_title`, `page_meta_description`, `page_status`) VALUES
(1, 'About Us', 'about-us', '<h3>lorem ipsum dolor<span>&nbsp;sit amet</span></h3><h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h4><div class=\"col-sm-12 col-lg-12 col-md-12\"><p><br></p></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081808-33638.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081816-34070.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081823-98350.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>', 'About Us mate title', 'About Us mate description About Us mate description About Us mate description About Us mate description', 1),
(2, 'Post Job', 'post-job', '<h3>lorem ipsum dolor<span>&nbsp;sit amet</span></h3><h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h4><div class=\"col-sm-12 col-lg-12 col-md-12\"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081808-33638.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081816-34070.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081823-98350.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>', 'Post Job mate title', 'Post Job mate description About Us mate description About Us mate description About Us mate description', 1),
(3, 'Terms & Conditions', 'terms-and-conditions', '<h3>lorem ipsum dolor<span>&nbsp;sit amet</span></h3><h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h4><div class=\"col-sm-12 col-lg-12 col-md-12\"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081808-33638.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081816-34070.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081823-98350.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>', 'Post Job mate title', 'Post Job mate description About Us mate description About Us mate description About Us mate description', 1),
(4, 'Privacy Policy', 'privacy-policy', '<h3>lorem ipsum dolor<span>&nbsp;sit amet</span></h3><h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h4><div class=\"col-sm-12 col-lg-12 col-md-12\"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081808-33638.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081816-34070.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081823-98350.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>', 'Post Job mate title', 'Post Job mate description About Us mate description About Us mate description About Us mate description', 1),
(5, 'Builders FAQ', 'builders-faq', '<h3>lorem ipsum dolor<span>&nbsp;sit amet</span></h3><h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h4><div class=\"col-sm-12 col-lg-12 col-md-12\"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081808-33638.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081816-34070.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081823-98350.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>', 'Post Job mate title', 'Post Job mate description About Us mate description About Us mate description About Us mate description', 1),
(6, 'LandLords FAQ', 'landLords-faq', '<h3>LANDLORDS FAQ</h3><h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h4><div class=\"col-sm-12 col-lg-12 col-md-12\"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081808-33638.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081816-34070.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081823-98350.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>', 'Land Lord mate title', 'Land Lord mate description About Us mate description About Us mate description About Us mate description', 1),
(7, 'How it works', 'how-it-works', '<h3>lorem ipsum dolor<span>&nbsp;sit amet</span></h3><h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br>incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h4><div class=\"col-sm-12 col-lg-12 col-md-12\"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081808-33638.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081816-34070.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div><div class=\"col-sm-4 col-lg-4 col-md-4\"><h6>Lorem ipsum dolor sit amet</h6><div class=\"back_bg\"><img src=\"http://computer11-pc/landlordrepairs/text_editer/upload_image/20171222081823-98350.jpg\" style=\"width: 300px;\" class=\"fr-fil fr-dib\"></div><div class=\"clearfix\"><br></div><span class=\"dess11\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>', 'Post Job mate title', 'Post Job mate description About Us mate description About Us mate description About Us mate description', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_slug` varchar(255) DEFAULT NULL,
  `sur_name` int(1) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `business_role` int(11) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `primary_trade` int(11) DEFAULT NULL,
  `business_type` int(11) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `post_code` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `lattitude` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `longitude` decimal(12,6) NOT NULL DEFAULT '0.000000',
  `email_vcode` varchar(255) DEFAULT NULL,
  `phone_vcode` varchar(255) DEFAULT NULL,
  `prof_description` text,
  `is_email_verified` int(1) NOT NULL DEFAULT '0' COMMENT '1=>verified',
  `is_phone_verified` int(1) NOT NULL DEFAULT '0' COMMENT '1=>verified',
  `registration_date` datetime DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `tot_review` int(11) DEFAULT '0',
  `avg_review` decimal(4,2) DEFAULT '0.00',
  `ip` varchar(255) DEFAULT NULL,
  `user_type` int(1) NOT NULL COMMENT '1=>admin,2=>tradesman,3=>customer',
  `user_status` int(1) NOT NULL DEFAULT '0' COMMENT '0-Not verified,1-Active,2-Inactive',
  `prof_image` varchar(255) DEFAULT NULL,
  `insurance` int(1) NOT NULL DEFAULT '0' COMMENT '''0''=>No,''1''=>Yes',
  `qualification` varchar(255) DEFAULT NULL,
  `prof_title` varchar(255) DEFAULT NULL,
  `year_in_biz` varchar(255) DEFAULT NULL,
  `emergency_job` int(1) NOT NULL DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `working_hours` varchar(255) DEFAULT NULL,
  `team` varchar(255) DEFAULT NULL,
  `holiday_notification` int(1) DEFAULT '0' COMMENT '''Active''=>1,Inactive=>0',
  `job_win` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_slug`, `sur_name`, `email`, `password`, `business_role`, `company_name`, `primary_trade`, `business_type`, `mobile`, `post_code`, `address`, `lattitude`, `longitude`, `email_vcode`, `phone_vcode`, `prof_description`, `is_email_verified`, `is_phone_verified`, `registration_date`, `last_login_time`, `tot_review`, `avg_review`, `ip`, `user_type`, `user_status`, `prof_image`, `insurance`, `qualification`, `prof_title`, `year_in_biz`, `emergency_job`, `working_hours`, `team`, `holiday_notification`, `job_win`) VALUES
(1, 'Admin', NULL, NULL, 'info@landlordrepairs.uk', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, NULL, '', NULL, '0.000000', '0.000000', NULL, NULL, NULL, 0, 0, NULL, NULL, 0, '0.00', NULL, 1, 1, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 0, 0),
(6, 'Abhijit Nandi', NULL, NULL, 'customer@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL, NULL, NULL, '1234567', '', NULL, '0.000000', '0.000000', NULL, NULL, NULL, 1, 1, '2017-12-09 07:57:25', NULL, 0, '0.00', NULL, 3, 1, NULL, 0, NULL, NULL, NULL, 0, '1:00am-6:00am', NULL, 0, 0),
(88, 'Asha Schiller', 'tradesmen-dejon-morar', 3, 'tradesmen@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'Funk, Roberts and Koch', 17, 2, '0205882307', '05618', 'Manchester Arena, Hunts Bank, Manchester, United Kingdom', '53.488289', '-2.244002', NULL, NULL, 'Ducimus earum voluptas reprehenderit quod distinctio. Aut non atque eos tempore. Officia excepturi officiis nostrum accusantium est a voluptatem.', 1, 1, '2017-12-14 09:14:34', NULL, 0, '0.00', NULL, 2, 1, '1514373555.jpg', 0, 'Precision Instrument Repairer', 'Similique veritatis quia consequuntur cupiditate nemo aliquid. Facilis repellat non error et fuga ea. Quis praesentium est ut eum quasi.', '6', 1, '1:00am-2:00am', 'Potter', 0, 0),
(89, 'Marcella Stamm', 'tradesmen-darryl-osinski-dvm', 3, 'builder@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'Wunsch, Torp and Terry', 12, 2, '6862293370', '80427', 'Hanover Street, Manchester, United Kingdom', '53.486252', '-2.239238', NULL, NULL, 'Et aliquam unde est dolorem aut mollitia reiciendis. Quia eaque aut et blanditiis. Sunt tempora aut rerum eos unde molestias.', 1, 1, '2017-12-14 09:14:34', NULL, 0, '0.00', NULL, 2, 1, '1513862336.png', 0, 'Education Administrator', 'Qui excepturi incidunt similique. Sed ad rerum qui. Quia recusandae aut voluptatem consequuntur. Animi magni provident sit at nulla sed voluptate.', '6', 1, '12:30am-1:00am', 'Civil Engineering Technician', 0, 0),
(90, 'Abigail Beer', 'tradesmen-ms-josianne-johns', 3, 'grady.antonietta@hauck.org', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Hettinger-Spinka', 17, 3, '3389451021', '95794-2371', 'Manchester Airport, Manchester, United Kingdom', '53.358803', '-2.272730', NULL, NULL, 'Odit est quasi molestiae est blanditiis autem autem. Et ab aliquid blanditiis omnis magni. Tempore eveniet et ut aut autem.', 1, 1, '2017-12-14 09:14:34', NULL, 0, '0.00', NULL, 2, 1, '1514373978.jpg', 0, 'Government', 'Et enim debitis qui nam doloremque ipsum. Ad dolorem eos exercitationem expedita tenetur ut.', '6', 1, '12:30am-12:30am', 'Pharmaceutical Sales Representative', 0, 0),
(91, 'Earlene Schiller', 'tradesmen-wanda-denesik', 2, 'sourav@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'Bradtke Group', 17, 1, '4249692698', '47367', 'Hilton Street, Manchester, United Kingdom', '53.482200', '-2.233034', NULL, NULL, 'Cupiditate vero deserunt recusandae culpa. Et deleniti et aspernatur iure. Ut qui corrupti consectetur quisquam.', 1, 1, '2017-12-14 09:14:34', NULL, 0, '0.00', NULL, 2, 1, '1513778305.jpg', 0, 'Marine Architect', 'Quia qui consequatur vel quia. Et dolorum quisquam ut et consequuntur reiciendis. Esse magnam aut ducimus vel sequi quod. Officia et assumenda fuga iure minus minima quia.', '4', 1, '1:00am-1:30am', 'Director Religious Activities', 0, 1),
(92, 'Gino Anderson', 'tradesmen-tobin-monahan-sr', 2, 'builder1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'Feil-Dooley', 12, 2, '4187546901', '40287', 'Bradford Road, Manchester, United Kingdom', '53.487390', '-2.209880', NULL, NULL, 'Nulla explicabo id eligendi et omnis. Labore sunt est sit eum. Voluptatem porro voluptatibus sed quas. Cumque reiciendis labore blanditiis dolorem quis id necessitatibus accusamus.', 1, 1, '2017-12-14 09:14:34', NULL, 0, '0.00', NULL, 2, 1, NULL, 1, 'Ship Captain', 'Omnis temporibus ipsa consectetur omnis qui voluptatum. Nobis provident quasi ipsam voluptate. Earum adipisci dolores omnis quia dolor deleniti.', '8', 1, '', 'Radiologic Technician', 0, 0),
(93, 'Cleo Mills', 'tradesmen-prof-randi-corwin-phd', 1, 'heather70@walsh.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'Rath Ltd', 1, 1, '7787203285', '24904', 'Wythenshawe, United Kingdom', '53.401455', '-2.271286', NULL, NULL, 'Iure nostrum hic dolor accusamus et eaque. Voluptates sit consequatur consequatur ipsum aut cupiditate optio. Et voluptas quia esse. Libero aliquam sit iusto molestias doloremque unde.', 1, 1, '2017-12-14 09:14:34', NULL, 0, '0.00', NULL, 2, 1, '1514380308.jpg', 0, 'Transportation Attendant', 'Est totam error dolorem id in non aut aut. Totam commodi minima quia nobis earum at. Illo ullam tempore odit molestiae quas autem aut sint. Consequatur error nostrum id ducimus reiciendis ducimus.', '5', 1, '12:30am-1:00am', 'Telecommunications Line Installer', 0, 1),
(162, 'Luna Walsh Sr.', '', 1, 'customer1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL, NULL, 0, '614946072X', '35438-4381', NULL, '0.000000', '0.000000', NULL, NULL, NULL, 1, 1, '2017-12-14 09:15:39', NULL, 0, '0.00', NULL, 3, 1, NULL, 1, NULL, NULL, '3', 1, '', NULL, 0, 0),
(163, 'Sriram', 'tradesmen-sriram', 1, 'sriram@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Siram inc', 1, 1, '3434232323', '123445', 'Manchester Airport, Manchester, United Kingdom', '53.358803', '-2.272730', NULL, NULL, NULL, 1, 1, '2017-12-27 12:01:47', NULL, 0, '0.00', NULL, 2, 1, '1514376293.jpg', 0, 'Internation painter', NULL, '7', 1, '12:30am-12:30am', 'no team', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_to_logo`
--

CREATE TABLE `users_to_logo` (
  `logo_id` int(10) NOT NULL,
  `logo_image` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_to_logo`
--

INSERT INTO `users_to_logo` (`logo_id`, `logo_image`, `user_id`) VALUES
(1, '1513080252.jpg', 10),
(2, '1513080281.jpeg', 10),
(3, '1513081365.jpeg', 10),
(4, '1513082546.jpeg', 10),
(5, '1513086947.jpeg', 10),
(6, '1513141577.jpeg', 10),
(7, '1513148227.jpg', 10),
(8, '1513150061.png', 10),
(9, '1513153002.jpg', 10),
(10, '1513163942.png', 10),
(11, '1513174358.jpg', 10),
(12, '1513246191.png', 137),
(13, '1513600612.jpg', 88),
(14, '1514367504.png', 91);

-- --------------------------------------------------------

--
-- Table structure for table `users_to_portfolio`
--

CREATE TABLE `users_to_portfolio` (
  `portfolio_id` int(11) NOT NULL,
  `before_image` varchar(255) DEFAULT NULL,
  `after_image` varchar(255) DEFAULT NULL,
  `before_image_caption` varchar(255) DEFAULT NULL,
  `after_image_caption` varchar(255) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_to_portfolio`
--

INSERT INTO `users_to_portfolio` (`portfolio_id`, `before_image`, `after_image`, `before_image_caption`, `after_image_caption`, `user_id`) VALUES
(1, 'before_1513078164.jpeg', 'after_1513078164.jpeg', NULL, NULL, 10),
(2, 'before_1513078186.jpeg', 'after_1513078187.jpeg', 'before', 'after', 10),
(3, 'before_1513086962.jpg', 'after_1513086962.jpeg', 'AAAAA', 'sdsddsd', 10),
(4, 'before_1513145685.jpg', 'after_1513145685.jpg', 'Damm', 'Good', 10),
(5, 'before_1513146607.jpg', 'after_1513146607.jpg', 'sdfsdf', 'sdfsdf', 10),
(6, 'before_1513156199.jpg', 'after_1513156199.jpg', NULL, 'sdfsdfsdf', 10),
(7, 'before_1513160417.jpg', 'after_1513160417.png', NULL, 'after image', 10),
(8, 'before_1513169124.jpg', 'after_1513169124.png', NULL, 'sdfsdfsdf', 10),
(9, 'before_1513246183.jpg', 'after_1513246183.jpg', NULL, 'After image', 137),
(10, 'before_1513600587.jpg', 'after_1513600587.jpg', NULL, 'after uimage text', 88),
(11, 'before_1513601933.jpg', 'after_1513601933.jpg', NULL, 'after', 88),
(12, 'before_1513601955.jpg', 'after_1513601955.jpg', 'before', 'after', 88),
(13, 'before_1514367446.jpg', 'after_1514367446.jpg', 'Before caption', 'after caption', 91);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `job_category`
--
ALTER TABLE `job_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `job_invitation`
--
ALTER TABLE `job_invitation`
  ADD PRIMARY KEY (`job_invitation_id`);

--
-- Indexes for table `job_to_attachment`
--
ALTER TABLE `job_to_attachment`
  ADD PRIMARY KEY (`attachment_id`);

--
-- Indexes for table `job_to_category`
--
ALTER TABLE `job_to_category`
  ADD PRIMARY KEY (`job_cat_id`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`job_type_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `report_builder`
--
ALTER TABLE `report_builder`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `static_page`
--
ALTER TABLE `static_page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_to_logo`
--
ALTER TABLE `users_to_logo`
  ADD PRIMARY KEY (`logo_id`);

--
-- Indexes for table `users_to_portfolio`
--
ALTER TABLE `users_to_portfolio`
  ADD PRIMARY KEY (`portfolio_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `job_invitation`
--
ALTER TABLE `job_invitation`
  MODIFY `job_invitation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `job_to_attachment`
--
ALTER TABLE `job_to_attachment`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_to_category`
--
ALTER TABLE `job_to_category`
  MODIFY `job_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `job_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `report_builder`
--
ALTER TABLE `report_builder`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `static_page`
--
ALTER TABLE `static_page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `users_to_logo`
--
ALTER TABLE `users_to_logo`
  MODIFY `logo_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_to_portfolio`
--
ALTER TABLE `users_to_portfolio`
  MODIFY `portfolio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
