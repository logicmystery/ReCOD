-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 07, 2020 at 06:05 AM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-30+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recod`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_ID` bigint(20) UNSIGNED NOT NULL,
  `admin_login` varchar(60) NOT NULL DEFAULT '',
  `admin_pass` varchar(64) NOT NULL DEFAULT '',
  `admin_firstname` varchar(50) NOT NULL DEFAULT '',
  `admin_lastname` varchar(50) NOT NULL,
  `admin_email` varchar(100) NOT NULL DEFAULT '',
  `admin_status` int(11) NOT NULL DEFAULT '0',
  `admin_type_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_ID`, `admin_login`, `admin_pass`, `admin_firstname`, `admin_lastname`, `admin_email`, `admin_status`, `admin_type_id`) VALUES
(1, 'admin', 'admin123', 'System', 'Admin', 'simplebillings@logicmystery.com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_types`
--

CREATE TABLE `admin_types` (
  `admin_type_ID` int(11) NOT NULL,
  `admin_type_name` varchar(50) NOT NULL,
  `admin_type_super` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_types`
--

INSERT INTO `admin_types` (`admin_type_ID`, `admin_type_name`, `admin_type_super`) VALUES
(1, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cartridges`
--

CREATE TABLE `cartridges` (
  `cartridge_ID` int(10) NOT NULL,
  `cartridge_institute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cartridges`
--

INSERT INTO `cartridges` (`cartridge_ID`, `cartridge_institute`) VALUES
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('02671e28c9d57f4056c9695f3f7c9e76', '45.117.207.82', 'Mozilla/5.0 (Linux; Android 9; ASUS_X01BDA) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Mobile Safari/53', 1597473882, ''),
('0c55a315ca1b4289a3b2652348b503e5', '93.158.66.41', '0', 1597476629, ''),
('0c80642c951b4199883b845254459db9', '66.249.83.93', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36 Google (+https:', 1597315124, ''),
('15a9a02febbe597227cd9ffc9a6566f2', '18.157.163.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko; compatible; BW/1.1; bit.ly/2W6Px8S) Chr', 1597974189, ''),
('1b576c9450badaeef972666a5079ecc3', '167.172.231.95', 'Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)', 1599092916, ''),
('1b9842204d2677ebafedd49bdaae71b8', '47.11.140.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36', 1598270435, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('1e8e665e76c0301239fd83852d5da96a', '93.158.66.48', '0', 1597477381, ''),
('1f07e8de6bcf9ecfad1b8ab1127dfce0', '45.117.207.82', 'Mozilla/5.0 (Linux; Android 9; ASUS_X01BDA) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Mobile Safari/53', 1597333798, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('29efc69941ad340d22a1ddc9381ee816', '52.34.76.65', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:77.0) Gecko/20100101 Firefox/77.0', 1599452833, ''),
('32ef4af19819d3577efa34b6eeb7a18a', '66.249.83.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36 Google (+https:', 1597299698, ''),
('34931c3e68f490e49ad510f955f06196', '45.117.207.82', 'WhatsApp/2.20.196.16 A', 1597473902, ''),
('447581e730dea87b4e876dafaa128f3e', '137.59.1.49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36', 1599453500, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('4c65be61c403598a8968b9fcc5d5aebf', '157.46.123.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:79.0) Gecko/20100101 Firefox/79.0', 1598445161, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('4c69b4df82e03271fa198b44a4299afa', '66.249.83.92', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36 Google (+https:', 1597408904, ''),
('53dc3c07d0f48ea9fd01eadb444ae34e', '93.158.66.48', '0', 1597476630, ''),
('5559879518f67e189ec85f6121ddc8e3', '93.158.66.50', '0', 1597476609, ''),
('576ada594302bc43eadf9b36767c7eea', '45.117.207.82', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', 1598254959, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('5792f988470932848fa8eb3cf37fe1b9', '93.158.66.48', '0', 1597477380, ''),
('57d30aa7234061b3f0c9ef945e9bdfae', '157.50.74.92', 'Mozilla/5.0 (Linux; Android 8.1.0; Redmi 5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Mobile Safari/53', 1597480739, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('5b69b7c683618b0b6f87ce673bfabb40', '93.158.66.41', '0', 1597476631, ''),
('5b92fe59ede64d46fcb846750c3aa7da', '93.158.66.47', '0', 1597476610, ''),
('5eab08201ae5292c2406f29ba661ed1b', '93.158.66.41', '0', 1597476599, ''),
('6687e454f580f7ca7724bd7537d294e3', '157.50.94.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:80.0) Gecko/20100101 Firefox/80.0', 1599452868, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('6912e850b7edd6ab25d7648dfc195263', '45.117.207.82', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36', 1597332486, 'a:1:{s:9:\"user_data\";s:0:\"\";}'),
('6cc03bdffe3ff151d75023cfa04d3f49', '47.11.225.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', 1598427606, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('77ab48d1cca67f12e6965a6af09cef7f', '93.158.66.41', '0', 1597476630, ''),
('77f1983e87c92064ec7e9e2904d27d06', '93.158.66.48', '0', 1597477382, ''),
('786d5d8050a002d1a8ed3364eb787014', '65.155.30.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.71 Safari/537.36', 1598202908, ''),
('7938e7e80c42105fb7876a2037d1b985', '40.94.91.86', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 1599452934, ''),
('7cc09c55e8fd758c240dfb3e43b7518e', '45.117.207.82', 'Mozilla/5.0 (Linux; Android 9; ASUS_X01BDA) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.111 Mobile Safari/53', 1597307705, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('7dd3bf17bb4b8132ff6767a8cd657c7d', '47.11.219.121', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', 1598427606, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('885ce5d4f0032711bf6fbc6119f49f40', '18.157.163.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko; compatible; BW/1.1; bit.ly/2W6Px8S) Chr', 1597974189, ''),
('91c60efd29f7757f7cd81c826c8c11a9', '66.249.88.242', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36 Google (+https:', 1597307584, ''),
('93ce94e677f828f82be3307795cddc34', '93.158.66.50', '0', 1597476608, ''),
('97ab3939b1ab5dd3b08e1b8a0cef6fc5', '66.249.88.252', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36 Google (+https:', 1597411511, ''),
('a3633511b95db31ba26a54f808c45c62', '47.11.176.65', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36', 1597396986, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('a584ccb788626062e9f03adc031c637d', '52.114.6.38', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5', 1597332758, ''),
('a64843c0aefd528823221a9ca8e9f10d', '93.158.66.50', '0', 1597476598, ''),
('aa6a0166bf1bd662c9e90eeb4c17a1c0', '45.117.207.82', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36', 1597673480, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('bab1ba0221008ae914e40516532f2b56', '93.158.66.50', '0', 1597476600, ''),
('cc0cb41af13a5dd67d66a1a925273573', '157.43.217.118', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36', 1597400944, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('ce935638c2701c957d795164be3fee7f', '154.126.74.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.75 Safari/537.36', 1599453526, ''),
('daa869f898683063c7e651b4c0856253', '103.27.8.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', 1598084901, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}'),
('dc9ca7dacf1b4ed394d71004287f53af', '93.158.66.42', '0', 1597476609, ''),
('de0e854ef4bee20a76c6e8d1c9aa7409', '104.131.98.27', 'Mozilla/4.0 (compatible; Netcraft Web Server Survey)', 1598894819, ''),
('eb6e2f07ca5d033bda8c4f3fac28aab4', '93.158.66.45', '0', 1597477381, ''),
('f16e070983a485cd00f9dd9bd16b119e', '157.43.217.118', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36', 1597400944, ''),
('fb42ae0a506dd74d0b04164b57d8f01f', '93.158.66.41', '0', 1597476601, ''),
('fd8887f53bd56a479a790ef931cd0eca', '42.110.204.244', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36', 1597299996, 'a:2:{s:9:\"user_data\";s:0:\"\";s:21:\"current_admin_session\";a:11:{s:8:\"admin_ID\";s:1:\"1\";s:11:\"admin_login\";s:5:\"admin\";s:10:\"admin_pass\";s:8:\"admin123\";s:15:\"admin_firstname\";s:6:\"System\";s:14:\"admin_lastname\";s:5:\"Admin\";s:11:\"admin_email\";s:31:\"simplebillings@logicmystery.com\";s:12:\"admin_status\";s:1:\"1\";s:13:\"admin_type_id\";s:1:\"1\";s:13:\"admin_type_ID\";s:1:\"1\";s:15:\"admin_type_name\";s:5:\"admin\";s:16:\"admin_type_super\";s:1:\"1\";}}');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `device_ID` int(11) NOT NULL,
  `device_no` varchar(50) DEFAULT NULL,
  `device_lat` varchar(10) NOT NULL,
  `device_long` varchar(10) NOT NULL,
  `device_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`device_ID`, `device_no`, `device_lat`, `device_long`, `device_status`) VALUES
(1, '111010', '23.55', '44.22', 1),
(2, '55', '45.2151515', '33.5566665', 1);

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `institute_ID` int(11) NOT NULL,
  `institution_name` varchar(200) NOT NULL,
  `institution_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`institute_ID`, `institution_name`, `institution_status`) VALUES
(2, 'logicmystery', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_ID` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `menu_parent_id` int(11) NOT NULL,
  `menu_link` varchar(30) NOT NULL,
  `menu_icon_class` varchar(100) NOT NULL,
  `menu_admin_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_ID`, `menu_name`, `menu_parent_id`, `menu_link`, `menu_icon_class`, `menu_admin_type_id`) VALUES
(1, 'Management', 0, '', 'icon icon-black icon-briefcase', 2),
(2, 'admins', 1, 'admin', 'icon icon-black icon-user', 2),
(3, 'Uset Type', 1, 'admin_type', 'icon icon-black icon-users', 2);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_ID` int(11) NOT NULL,
  `option_key` varchar(45) DEFAULT NULL,
  `option_value` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_ID`, `option_key`, `option_value`) VALUES
(39, 'record_per_page', '20'),
(40, 'site_title', 'Console Panel'),
(41, 'site_description', 'Admin panel of the site'),
(42, 'site_logo', 'recodlogo.png');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `technician_ID` int(11) NOT NULL,
  `technician_name` varchar(50) NOT NULL,
  `technician_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`technician_ID`, `technician_name`, `technician_status`) VALUES
(1, 'test', 1),
(2, 'kallol', 0),
(3, 'sibaprasad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_ID` int(11) NOT NULL,
  `test_technician_id` int(11) NOT NULL,
  `test_unique_catrage_no` int(9) NOT NULL,
  `test_device_id` int(11) NOT NULL,
  `test_timestamp` datetime NOT NULL,
  `test_type` varchar(10) NOT NULL DEFAULT 'Diagnostic',
  `test_result` varchar(100) NOT NULL,
  `test_patient_name` varchar(200) NOT NULL,
  `test_patient_uid_number` varchar(50) NOT NULL,
  `test_patient_phone_number` varchar(10) NOT NULL,
  `test_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_ID`, `test_technician_id`, `test_unique_catrage_no`, `test_device_id`, `test_timestamp`, `test_type`, `test_result`, `test_patient_name`, `test_patient_uid_number`, `test_patient_phone_number`, `test_created_at`) VALUES
(4, 10000001, 121234445, 100000, '2020-08-14 00:00:00', 'Diagnostic', 'false', 'Santa Prasad', '123456789012', '9876543210', '2020-08-25 17:27:54'),
(5, 10000001, 121234446, 100000, '2020-08-14 00:00:00', 'Diagnostic', 'false', 'Santa Prasad', '123456789012', '9876543210', '2020-08-26 12:33:22'),
(6, 10000001, 121234447, 100000, '2020-08-26 00:00:00', 'Diagnostic', 'false', 'Ram prasad', '123456789016', '9876543220', '2020-08-26 13:09:17'),
(7, 10000001, 121234448, 100000, '2020-08-26 00:00:00', 'Diagnostic', 'false', 'Ram prasad', '123456789016', '9876543220', '2020-08-26 13:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `tests_`
--

CREATE TABLE `tests_` (
  `test_ID` int(11) NOT NULL,
  `test_user_id` int(11) NOT NULL,
  `test_technician_id` int(11) NOT NULL,
  `test_unique_catrage_no` int(9) NOT NULL,
  `test_device_id` int(11) NOT NULL,
  `test_time_stamp` datetime NOT NULL,
  `test_type` varchar(10) NOT NULL DEFAULT 'Diagnostic',
  `test_result` tinyint(1) NOT NULL,
  `test_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests_`
--

INSERT INTO `tests_` (`test_ID`, `test_user_id`, `test_technician_id`, `test_unique_catrage_no`, `test_device_id`, `test_time_stamp`, `test_type`, `test_result`, `test_status`) VALUES
(1, 1, 1, 0, 1, '2020-08-13 00:00:00', 'Diagnostic', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(200) DEFAULT NULL,
  `user_phone` varchar(10) DEFAULT NULL,
  `user_aadhar` varchar(12) DEFAULT NULL,
  `user_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `user_name`, `user_email`, `user_phone`, `user_aadhar`, `user_created_at`) VALUES
(1, 'pratik kalya', 'pratik@logicmystery.com', '7076266860', '123456789001', NULL),
(2, 'ram', '', '789456123', '254879', '2020-08-13 19:55:04'),
(11, 'all in one', '', '7029458072', 'Ttt', '2020-08-13 21:05:30'),
(12, 'Kallol', '', '9876543210', 'Shehje', '2020-08-13 21:06:40'),
(13, 'Rohan', '', '58745669', '123456', '2020-08-13 23:31:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_ID`),
  ADD KEY `admin_login_key` (`admin_login`);

--
-- Indexes for table `admin_types`
--
ALTER TABLE `admin_types`
  ADD PRIMARY KEY (`admin_type_ID`);

--
-- Indexes for table `cartridges`
--
ALTER TABLE `cartridges`
  ADD PRIMARY KEY (`cartridge_ID`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_ID`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`institute_ID`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_ID`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_ID`),
  ADD UNIQUE KEY `option_key_UNIQUE` (`option_key`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`technician_ID`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_ID`);

--
-- Indexes for table `tests_`
--
ALTER TABLE `tests_`
  ADD PRIMARY KEY (`test_ID`),
  ADD UNIQUE KEY `test_patient_uid` (`test_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_types`
--
ALTER TABLE `admin_types`
  MODIFY `admin_type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cartridges`
--
ALTER TABLE `cartridges`
  MODIFY `cartridge_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `device_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `institute_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `technician_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tests_`
--
ALTER TABLE `tests_`
  MODIFY `test_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
