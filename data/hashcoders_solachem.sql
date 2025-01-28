-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 11:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hashcoders_solachem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `image` varchar(18) NOT NULL COMMENT 'unique( ).ext , unique( ) exist 13 chars, ''.'' and extension of image file',
  `gender` char(1) NOT NULL COMMENT 'm for mail , f for femail,  o for others & n for not prefered to say',
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL COMMENT 'using hash bcrypt',
  `tele_number` varchar(10) NOT NULL,
  `role` varchar(50) NOT NULL,
  `registered_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_visited` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `image`, `gender`, `email`, `password`, `tele_number`, `role`, `registered_date`, `date_modified`, `last_visited`) VALUES
(1, 'Mithila', 'Prabashwara', '', '1', 'mithila@gmail.com', '$2y$10$IwdCX15BMVqv9A.fSkqGhOXjOdM9SUS81AlduejGjcUVTeTZX6nIi', '0777777777', 'Database Engineer', '2025-01-19 16:59:19', '2025-01-19 17:01:58', NULL),
(2, 'Thakshila', 'Dilshan', '', '1', 'thakshila@gmail.com', '$2y$10$OameerdV9q2GMyvnQXVJ/OzNZPpfmDXysHJrZxy2zd7Tb7argejsy', '0771111111', 'UI/ UX Engineer', '2025-01-19 17:01:06', '2025-01-19 17:01:36', NULL),
(3, 'Tharushika', 'Dilshan', '', '1', 'tharushika@gmail.com', '$2y$10$4u3MvjEL837Bex1TyOpOluZTkdP83w..iSQyVe7gz3fqTdpesW11e', '0772222222', 'Frontend Developer', '2025-01-19 17:01:55', '2025-01-19 17:03:06', NULL),
(4, 'Chamal', 'Jayawardhana', '', '1', 'chamal@gmail.com', '$2y$10$br/yWo7.xjRUFrAOOowB7uKgINmegfMb06GeszGQsTCl38MJB4XG', '0771212121', 'Business Analyst', '2025-01-19 17:04:01', '2025-01-19 17:04:24', NULL),
(5, 'Chamod', 'Abethunga', '', '1', 'chamod@gmail.com', '$2y$10$dvn0Snb.b.i6kbHvESFb4OO1HNH7UIBNcl8JWZaPSBrdqWUPSlj9a', '0711111111', 'Backend Developer', '2025-01-19 17:06:04', '2025-01-19 17:06:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `admin_id` int(11) UNSIGNED DEFAULT NULL,
  `image` varchar(18) NOT NULL COMMENT 'unique( ).ext , unique( ) exist 13 chars, ''.'' and extension of image file',
  `description` text DEFAULT NULL,
  `status` binary(1) NOT NULL DEFAULT '0' COMMENT 'To implement show/hide the article',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_published` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`admin_id`, `image`, `description`, `status`, `date_created`, `date_modified`, `date_published`) VALUES
(1, '678f984269b89.webp', 'example banner 1', 0x30, '2025-01-22 17:56:12', '2025-01-23 02:03:15', NULL),
(2, '', 'example banner 2', 0x30, '2025-01-22 17:56:30', '2025-01-22 17:56:30', NULL),
(3, '', 'example banner 2', 0x30, '2025-01-22 17:57:13', '2025-01-22 17:57:47', NULL),
(4, '', 'example banner 4', 0x30, '2025-01-22 17:58:03', '2025-01-22 17:58:03', NULL),
(NULL, '', 'example banner 6', 0x30, '2025-01-22 17:58:16', '2025-01-23 08:16:12', NULL),
(1, '678f984269b89.webp', 'example banner 1', 0x30, '2025-01-22 17:56:12', '2025-01-23 02:03:15', NULL),
(2, '', 'example banner 2', 0x30, '2025-01-22 17:56:30', '2025-01-22 17:56:30', NULL),
(3, '', 'example banner 2', 0x30, '2025-01-22 17:57:13', '2025-01-22 17:57:47', NULL),
(4, '', 'example banner 4', 0x30, '2025-01-22 17:58:03', '2025-01-22 17:58:03', NULL),
(NULL, '', 'example banner 6', 0x30, '2025-01-22 17:58:16', '2025-01-23 08:16:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `latitude` varchar(12) DEFAULT NULL,
  `longitude` varchar(12) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `admin_id` int(11) UNSIGNED DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `address1`, `address2`, `latitude`, `longitude`, `email`, `city_id`, `admin_id`, `date_created`) VALUES
(2, '576/2', 'Siyambalape Road', '6.9745769', '79.4002846', 'hei@sola.com', 501, 1, '2025-01-21 13:31:55'),
(3, '572', 'Dewala Rd', '6.8562662', '79.6224012', 'asw@sola.com', 786, 2, '2025-01-21 13:36:27'),
(4, '220', 'High Level Road', '6.8396646', '79.8497285', NULL, 346, 1, '2025-01-21 13:38:07'),
(5, 'XW3G+3RH', NULL, '6.9526674', '79.6388076', NULL, 558, 1, '2025-01-21 13:41:23'),
(6, '473d', 'Avissawella Road', '6.8562662', '79.6224012', NULL, 362, 4, '2025-01-21 13:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `branch_telephone`
--

CREATE TABLE `branch_telephone` (
  `branch_id` smallint(5) UNSIGNED DEFAULT NULL,
  `number1` varchar(10) NOT NULL DEFAULT '',
  `number2` varchar(10) DEFAULT ''
) ;

--
-- Dumping data for table `branch_telephone`
--

INSERT INTO `branch_telephone` (`branch_id`, `number1`, `number2`) VALUES
(2, '0112401709', ''),
(6, '0776049081', ''),
(5, '0776049085', ''),
(3, '0776123522', '0112401709'),
(4, '0776123525', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`) VALUES
(1, 1),
(2, 2),
(3, 4),
(4, 6),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_id` mediumint(9) UNSIGNED DEFAULT NULL,
  `quantity` smallint(5) UNSIGNED DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Triggers `cart_item`
--
DELIMITER $$
CREATE TRIGGER `cart_items_before_insert validity check` BEFORE INSERT ON `cart_item` FOR EACH ROW BEGIN
    IF NEW.quantity > (SELECT QoH FROM item WHERE id = NEW.item_id) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Not enough items available at this moment. Come back later.';
    ELSEIF NEW.quantity < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid input. Try again.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `data_created`) VALUES
(1, 'Household Cleaning ', '', '2025-01-21 14:19:50'),
(2, 'Industrial and Commercial ', '', '2025-01-21 14:20:10'),
(3, 'Specialty', '', '2025-01-21 14:20:21'),
(4, 'Liquid and Custom-Use', '', '2025-01-21 14:20:33'),
(5, 'Personal Care', '', '2025-01-21 14:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `name_en` varchar(45) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL
) ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `district_id`, `name_en`, `postcode`) VALUES
(1, 1, 'Akkaraipattu', '32400'),
(2, 1, 'Ambagahawatta', '90326'),
(3, 1, 'Ampara', '32000'),
(4, 1, 'Bakmitiyawa', '32024'),
(5, 1, 'Deegawapiya', '32006'),
(6, 1, 'Devalahinda', '32038'),
(7, 1, 'Digamadulla Weeragoda', '32008'),
(8, 1, 'Dorakumbura', '32104'),
(9, 1, 'Gonagolla', '32064'),
(10, 1, 'Hulannuge', '32514'),
(11, 1, 'Kalmunai', '32300'),
(12, 1, 'Kannakipuram', '32405'),
(13, 1, 'Karativu', '32250'),
(14, 1, 'Kekirihena', '32074'),
(15, 1, 'Koknahara', '32035'),
(16, 1, 'Kolamanthalawa', '32102'),
(17, 1, 'Komari', '32418'),
(18, 1, 'Lahugala', '32512'),
(19, 1, 'Irakkamam', '32450'),
(20, 1, 'Mahaoya', '32070'),
(21, 1, 'Marathamune', '32314'),
(22, 1, 'Namaloya', '32037'),
(23, 1, 'Navithanveli', '32308'),
(24, 1, 'Nintavur', '32340'),
(25, 1, 'Oluvil', '32360'),
(26, 1, 'Padiyatalawa', '32100'),
(27, 1, 'Pahalalanda', '32034'),
(28, 1, 'Panama', '32508'),
(29, 1, 'Pannalagama', '32022'),
(30, 1, 'Paragahakele', '32031'),
(31, 1, 'Periyaneelavanai', '32316'),
(32, 1, 'Polwaga Janapadaya', '32032'),
(33, 1, 'Pottuvil', '32500'),
(34, 1, 'Sainthamaruthu', '32280'),
(35, 1, 'Samanthurai', '32200'),
(36, 1, 'Serankada', '32101'),
(37, 1, 'Tempitiya', '32072'),
(38, 1, 'Thambiluvil', '32415'),
(39, 1, 'Tirukovil', '32420'),
(40, 1, 'Uhana', '32060'),
(41, 1, 'Wadinagala', '32039'),
(42, 1, 'Wanagamuwa', '32454'),
(43, 2, 'Angamuwa', '50248'),
(44, 2, 'Anuradhapura', '50000'),
(45, 2, 'Awukana', '50169'),
(46, 2, 'Bogahawewa', '50566'),
(47, 2, 'Dematawewa', '50356'),
(48, 2, 'Dimbulagala', '51031'),
(49, 2, 'Dutuwewa', '50393'),
(50, 2, 'Elayapattuwa', '50014'),
(51, 2, 'Ellewewa', '51034'),
(52, 2, 'Eppawala', '50260'),
(53, 2, 'Etawatunuwewa', '50584'),
(54, 2, 'Etaweeragollewa', '50518'),
(55, 2, 'Galapitagala', '32066'),
(56, 2, 'Galenbindunuwewa', '50390'),
(57, 2, 'Galkadawala', '50006'),
(58, 2, 'Galkiriyagama', '50120'),
(59, 2, 'Galkulama', '50064'),
(60, 2, 'Galnewa', '50170'),
(61, 2, 'Gambirigaswewa', '50057'),
(62, 2, 'Ganewalpola', '50142'),
(63, 2, 'Gemunupura', '50224'),
(64, 2, 'Getalawa', '50392'),
(65, 2, 'Gnanikulama', '50036'),
(66, 2, 'Gonahaddenawa', '50554'),
(67, 2, 'Habarana', '50150'),
(68, 2, 'Halmillawa Dambulla', '50124'),
(69, 2, 'Halmillawetiya', '50552'),
(70, 2, 'Hidogama', '50044'),
(71, 2, 'Horawpatana', '50350'),
(72, 2, 'Horiwila', '50222'),
(73, 2, 'Hurigaswewa', '50176'),
(74, 2, 'Hurulunikawewa', '50394'),
(75, 2, 'Ihala Puliyankulama', '61316'),
(76, 2, 'Kagama', '50282'),
(77, 2, 'Kahatagasdigiliya', '50320'),
(78, 2, 'Kahatagollewa', '50562'),
(79, 2, 'Kalakarambewa', '50288'),
(80, 2, 'Kalaoya', '50226'),
(81, 2, 'Kalawedi Ulpotha', '50556'),
(82, 2, 'Kallanchiya', '50454'),
(83, 2, 'Kalpitiya', '61360'),
(84, 2, 'Kalukele Badanagala', '51037'),
(85, 2, 'Kapugallawa', '50370'),
(86, 2, 'Karagahawewa', '50232'),
(87, 2, 'Kashyapapura', '51032'),
(88, 2, 'Kebithigollewa', '50500'),
(89, 2, 'Kekirawa', '50100'),
(90, 2, 'Kendewa', '50452'),
(91, 2, 'Kiralogama', '50259'),
(92, 2, 'Kirigalwewa', '50511'),
(93, 2, 'Kirimundalama', '61362'),
(94, 2, 'Kitulhitiyawa', '50132'),
(95, 2, 'Kurundankulama', '50062'),
(96, 2, 'Labunoruwa', '50088'),
(97, 2, 'Ihalagama', '50304'),
(98, 2, 'Ipologama', '50280'),
(99, 2, 'Madatugama', '50130'),
(100, 2, 'Maha Elagamuwa', '50126'),
(101, 2, 'Mahabulankulama', '50196'),
(102, 2, 'Mahailluppallama', '50270'),
(103, 2, 'Mahakanadarawa', '50306'),
(104, 2, 'Mahapothana', '50327'),
(105, 2, 'Mahasenpura', '50574'),
(106, 2, 'Mahawilachchiya', '50022'),
(107, 2, 'Mailagaswewa', '50384'),
(108, 2, 'Malwanagama', '50236'),
(109, 2, 'Maneruwa', '50182'),
(110, 2, 'Maradankadawala', '50080'),
(111, 2, 'Maradankalla', '50308'),
(112, 2, 'Medawachchiya', '50500'),
(113, 2, 'Megodawewa', '50334'),
(114, 2, 'Mihintale', '50300'),
(115, 2, 'Morakewa', '50349'),
(116, 2, 'Mulkiriyawa', '50324'),
(117, 2, 'Muriyakadawala', '50344'),
(118, 5, 'Colombo 15', '01500'),
(119, 2, 'Nachchaduwa', '50046'),
(120, 2, 'Namalpura', '50339'),
(121, 2, 'Negampaha', '50180'),
(122, 2, 'Nochchiyagama', '50200'),
(123, 2, 'Nuwaragala', '51039'),
(124, 2, 'Padavi Maithripura', '50572'),
(125, 2, 'Padavi Parakramapura', '50582'),
(126, 2, 'Padavi Sripura', '50587'),
(127, 2, 'Padavi Sritissapura', '50588'),
(128, 2, 'Padaviya', '50570'),
(129, 2, 'Padikaramaduwa', '50338'),
(130, 2, 'Pahala Halmillewa', '50206'),
(131, 2, 'Pahala Maragahawe', '50220'),
(132, 2, 'Pahalagama', '50244'),
(133, 2, 'Palugaswewa', '50144'),
(134, 2, 'Pandukabayapura', '50448'),
(135, 2, 'Pandulagama', '50029'),
(136, 2, 'Parakumpura', '50326'),
(137, 2, 'Parangiyawadiya', '50354'),
(138, 2, 'Parasangahawewa', '50055'),
(139, 2, 'Pelatiyawa', '51033'),
(140, 2, 'Pemaduwa', '50020'),
(141, 2, 'Perimiyankulama', '50004'),
(142, 2, 'Pihimbiyagolewa', '50512'),
(143, 2, 'Pubbogama', '50122'),
(144, 2, 'Punewa', '50506'),
(145, 2, 'Rajanganaya', '50246'),
(146, 2, 'Rambewa', '50450'),
(147, 2, 'Rampathwila', '50386'),
(148, 2, 'Rathmalgahawewa', '50514'),
(149, 2, 'Saliyapura', '50008'),
(150, 2, 'Seeppukulama', '50380'),
(151, 2, 'Senapura', '50284'),
(152, 2, 'Sivalakulama', '50068'),
(153, 2, 'Siyambalewa', '50184'),
(154, 2, 'Sravasthipura', '50042'),
(155, 2, 'Talawa', '50230'),
(156, 2, 'Tambuttegama', '50240'),
(157, 2, 'Tammennawa', '50104'),
(158, 2, 'Tantirimale', '50016'),
(159, 2, 'Telhiriyawa', '50242'),
(160, 2, 'Tirappane', '50072'),
(161, 2, 'Tittagonewa', '50558'),
(162, 2, 'Udunuwara Colony', '50207'),
(163, 2, 'Upuldeniya', '50382'),
(164, 2, 'Uttimaduwa', '50067'),
(165, 2, 'Vellamanal', '31053'),
(166, 2, 'Viharapalugama', '50012'),
(167, 2, 'Wahalkada', '50564'),
(168, 2, 'Wahamalgollewa', '50492'),
(169, 2, 'Walagambahuwa', '50086'),
(170, 2, 'Walahaviddawewa', '50516'),
(171, 2, 'Welimuwapotana', '50358'),
(172, 2, 'Welioya Project', '50586'),
(173, 3, 'Akkarasiyaya', '90166'),
(174, 3, 'Aluketiyawa', '90736'),
(175, 3, 'Aluttaramma', '90722'),
(176, 3, 'Ambadandegama', '90108'),
(177, 3, 'Ambagasdowa', '90300'),
(178, 3, 'Arawa', '90017'),
(179, 3, 'Arawakumbura', '90532'),
(180, 3, 'Arawatta', '90712'),
(181, 3, 'Atakiriya', '90542'),
(182, 3, 'Badulla', '90000'),
(183, 3, 'Baduluoya', '90019'),
(184, 3, 'Ballaketuwa', '90092'),
(185, 3, 'Bambarapana', '90322'),
(186, 3, 'Bandarawela', '90100'),
(187, 3, 'Beramada', '90066'),
(188, 3, 'Bibilegama', '90502'),
(189, 3, 'Boragas', '90362'),
(190, 3, 'Boralanda', '90170'),
(191, 3, 'Bowela', '90302'),
(192, 3, 'Central Camp', '32050'),
(193, 3, 'Damanewela', '32126'),
(194, 3, 'Dambana', '90714'),
(195, 3, 'Dehiattakandiya', '32150'),
(196, 3, 'Demodara', '90080'),
(197, 3, 'Diganatenna', '90132'),
(198, 3, 'Dikkapitiya', '90214'),
(199, 3, 'Dimbulana', '90324'),
(200, 3, 'Divulapelessa', '90726'),
(201, 3, 'Diyatalawa', '90150'),
(202, 3, 'Dulgolla', '90104'),
(203, 3, 'Ekiriyankumbura', '91502'),
(204, 3, 'Ella', '90090'),
(205, 3, 'Ettampitiya', '90140'),
(206, 3, 'Galauda', '90065'),
(207, 3, 'Galporuyaya', '90752'),
(208, 3, 'Gawarawela', '90082'),
(209, 3, 'Girandurukotte', '90750'),
(210, 3, 'Godunna', '90067'),
(211, 3, 'Gurutalawa', '90208'),
(212, 3, 'Haldummulla', '90180'),
(213, 3, 'Hali Ela', '90060'),
(214, 3, 'Hangunnawa', '90224'),
(215, 3, 'Haputale', '90160'),
(216, 3, 'Hebarawa', '90724'),
(217, 3, 'Heeloya', '90112'),
(218, 3, 'Helahalpe', '90122'),
(219, 3, 'Helapupula', '90094'),
(220, 3, 'Hopton', '90524'),
(221, 3, 'Idalgashinna', '96167'),
(222, 3, 'Kahataruppa', '90052'),
(223, 3, 'Kalugahakandura', '90546'),
(224, 3, 'Kalupahana', '90186'),
(225, 3, 'Kebillawela', '90102'),
(226, 3, 'Kendagolla', '90048'),
(227, 3, 'Keselpotha', '90738'),
(228, 3, 'Ketawatta', '90016'),
(229, 3, 'Kiriwanagama', '90184'),
(230, 3, 'Koslanda', '90190'),
(231, 3, 'Kuruwitenna', '90728'),
(232, 3, 'Kuttiyagolla', '90046'),
(233, 3, 'Landewela', '90068'),
(234, 3, 'Liyangahawela', '90106'),
(235, 3, 'Lunugala', '90530'),
(236, 3, 'Lunuwatta', '90310'),
(237, 3, 'Madulsima', '90535'),
(238, 3, 'Mahiyanganaya', '90700'),
(239, 3, 'Makulella', '90114'),
(240, 3, 'Malgoda', '90754'),
(241, 3, 'Mapakadawewa', '90730'),
(242, 3, 'Maspanna', '90328'),
(243, 3, 'Maussagolla', '90582'),
(244, 3, 'Mawanagama', '32158'),
(245, 3, 'Medawela Udukinda', '90218'),
(246, 3, 'Meegahakiula', '90015'),
(247, 3, 'Metigahatenna', '90540'),
(248, 3, 'Mirahawatta', '90134'),
(249, 3, 'Miriyabedda', '90504'),
(250, 3, 'Nawamedagama', '32120'),
(251, 3, 'Nelumgama', '90042'),
(252, 3, 'Nikapotha', '90165'),
(253, 3, 'Nugatalawa', '90216'),
(254, 3, 'Ohiya', '90168'),
(255, 3, 'Pahalarathkinda', '90756'),
(256, 3, 'Pallekiruwa', '90534'),
(257, 3, 'Passara', '90500'),
(258, 3, 'Pattiyagedara', '90138'),
(259, 3, 'Pelagahatenna', '90522'),
(260, 3, 'Perawella', '90222'),
(261, 3, 'Pitamaruwa', '90544'),
(262, 3, 'Pitapola', '90171'),
(263, 3, 'Puhulpola', '90212'),
(264, 3, 'Rajagalatenna', '32068'),
(265, 3, 'Rathkarawwa', '90164'),
(266, 3, 'Ridimaliyadda', '90704'),
(267, 3, 'Silmiyapura', '90364'),
(268, 3, 'Sirimalgoda', '90044'),
(269, 3, 'Siripura', '32155'),
(270, 3, 'Sorabora Colony', '90718'),
(271, 3, 'Soragune', '90183'),
(272, 3, 'Soranathota', '90008'),
(273, 3, 'Taldena', '90014'),
(274, 3, 'Timbirigaspitiya', '90012'),
(275, 3, 'Uduhawara', '90226'),
(276, 3, 'Uraniya', '90702'),
(277, 3, 'Uva Karandagolla', '90091'),
(278, 3, 'Uva Mawelagama', '90192'),
(279, 3, 'Uva Tenna', '90188'),
(280, 3, 'Uva Tissapura', '90734'),
(281, 3, 'Welimada', '90200'),
(282, 3, 'Weranketagoda', '32062'),
(283, 3, 'Wewatta', '90716'),
(284, 3, 'Wineethagama', '90034'),
(285, 3, 'Yalagamuwa', '90329'),
(286, 3, 'Yalwela', '90706'),
(287, 4, 'Addalaichenai', '32350'),
(288, 4, 'Ampilanthurai', '30162'),
(289, 4, 'Araipattai', '30150'),
(290, 4, 'Ayithiyamalai', '30362'),
(291, 4, 'Bakiella', '30206'),
(292, 4, 'Batticaloa', '30000'),
(293, 4, 'Cheddipalayam', '30194'),
(294, 4, 'Chenkaladi', '30350'),
(295, 4, 'Eravur', '30300'),
(296, 4, 'Kaluwanchikudi', '30200'),
(297, 4, 'Kaluwankemy', '30372'),
(298, 4, 'Kannankudah', '30016'),
(299, 4, 'Karadiyanaru', '30354'),
(300, 4, 'Kathiraveli', '30456'),
(301, 4, 'Kattankudi', '30100'),
(302, 4, 'Kiran', '30394'),
(303, 4, 'Kirankulam', '30159'),
(304, 4, 'Koddaikallar', '30249'),
(305, 4, 'Kokkaddicholai', '30160'),
(306, 4, 'Kurukkalmadam', '30192'),
(307, 4, 'Mandur', '30220'),
(308, 4, 'Miravodai', '30426'),
(309, 4, 'Murakottanchanai', '30392'),
(310, 4, 'Navagirinagar', '30238'),
(311, 4, 'Navatkadu', '30018'),
(312, 4, 'Oddamavadi', '30420'),
(313, 4, 'Palamunai', '32354'),
(314, 4, 'Pankudavely', '30352'),
(315, 4, 'Periyaporativu', '30230'),
(316, 4, 'Periyapullumalai', '30358'),
(317, 4, 'Pillaiyaradi', '30022'),
(318, 4, 'Punanai', '30428'),
(319, 4, 'Thannamunai', '30024'),
(320, 4, 'Thettativu', '30196'),
(321, 4, 'Thikkodai', '30236'),
(322, 4, 'Thirupalugamam', '30234'),
(323, 4, 'Unnichchai', '30364'),
(324, 4, 'Vakaneri', '30424'),
(325, 4, 'Vakarai', '30450'),
(326, 4, 'Valaichenai', '30400'),
(327, 4, 'Vantharumoolai', '30376'),
(328, 4, 'Vellavely', '30204'),
(329, 5, 'Akarawita', '10732'),
(330, 5, 'Ambalangoda', '80300'),
(331, 5, 'Athurugiriya', '10150'),
(332, 5, 'Avissawella', '10700'),
(333, 5, 'Batawala', '10513'),
(334, 5, 'Battaramulla', '10120'),
(335, 5, 'Biyagama', '11650'),
(336, 5, 'Bope', '10522'),
(337, 5, 'Boralesgamuwa', '10290'),
(338, 5, 'Colombo 8', '00800'),
(339, 5, 'Dedigamuwa', '10656'),
(340, 5, 'Dehiwala', '10350'),
(341, 5, 'Deltara', '10302'),
(342, 5, 'Habarakada', '10204'),
(343, 5, 'Hanwella', '10650'),
(344, 5, 'Hiripitya', '10232'),
(345, 5, 'Hokandara', '10118'),
(346, 5, 'Homagama', '10200'),
(347, 5, 'Horagala', '10502'),
(348, 5, 'Kaduwela', '10640'),
(349, 5, 'Kaluaggala', '11224'),
(350, 5, 'Kapugoda', '10662'),
(351, 5, 'Kehelwatta', '12550'),
(352, 5, 'Kiriwattuduwa', '10208'),
(353, 5, 'Kolonnawa', '10600'),
(354, 5, 'Kosgama', '10730'),
(355, 5, 'Madapatha', '10306'),
(356, 5, 'Maharagama', '10280'),
(357, 5, 'Malabe', '10115'),
(358, 5, 'Moratuwa', '10400'),
(359, 5, 'Mount Lavinia', '10370'),
(360, 5, 'Mullegama', '10202'),
(361, 5, 'Napawela', '10704'),
(362, 5, 'Nugegoda', '10250'),
(363, 5, 'Padukka', '10500'),
(364, 5, 'Pannipitiya', '10230'),
(365, 5, 'Piliyandala', '10300'),
(366, 5, 'Pitipana Homagama', '10206'),
(367, 5, 'Polgasowita', '10320'),
(368, 5, 'Pugoda', '10660'),
(369, 5, 'Ranala', '10654'),
(370, 5, 'Siddamulla', '10304'),
(371, 5, 'Siyambalagoda', '81462'),
(372, 5, 'Sri Jayawardenepura', '10100'),
(373, 5, 'Talawatugoda', '10116'),
(374, 5, 'Tummodara', '10682'),
(375, 5, 'Waga', '10680'),
(376, 5, 'Colombo 6', '00600'),
(377, 6, 'Agaliya', '80212'),
(378, 6, 'Ahangama', '80650'),
(379, 6, 'Ahungalla', '80562'),
(380, 6, 'Akmeemana', '80090'),
(381, 6, 'Alawatugoda', '20140'),
(382, 6, 'Aluthwala', '80332'),
(383, 6, 'Ampegama', '80204'),
(384, 6, 'Amugoda', '80422'),
(385, 6, 'Anangoda', '80044'),
(386, 6, 'Angulugaha', '80122'),
(387, 6, 'Ankokkawala', '80048'),
(388, 6, 'Aselapura', '51072'),
(389, 6, 'Baddegama', '80200'),
(390, 6, 'Balapitiya', '80550'),
(391, 6, 'Banagala', '80143'),
(392, 6, 'Batapola', '80320'),
(393, 6, 'Bentota', '80500'),
(394, 6, 'Boossa', '80270'),
(395, 6, 'Dellawa', '81477'),
(396, 6, 'Dikkumbura', '80654'),
(397, 6, 'Dodanduwa', '80250'),
(398, 6, 'Ella Tanabaddegama', '80402'),
(399, 6, 'Elpitiya', '80400'),
(400, 6, 'Galle', '80000'),
(401, 6, 'Ginimellagaha', '80220'),
(402, 6, 'Gintota', '80280'),
(403, 6, 'Godahena', '80302'),
(404, 6, 'Gonamulla Junction', '80054'),
(405, 6, 'Gonapinuwala', '80230'),
(406, 6, 'Habaraduwa', '80630'),
(407, 6, 'Haburugala', '80506'),
(408, 6, 'Hikkaduwa', '80240'),
(409, 6, 'Hiniduma', '80080'),
(410, 6, 'Hiyare', '80056'),
(411, 6, 'Kahaduwa', '80460'),
(412, 6, 'Kahawa', '80312'),
(413, 6, 'Karagoda', '80151'),
(414, 6, 'Karandeniya', '80360'),
(415, 6, 'Kosgoda', '80570'),
(416, 6, 'Kottawagama', '80062'),
(417, 6, 'Kottegoda', '81180'),
(418, 6, 'Kuleegoda', '80328'),
(419, 6, 'Magedara', '80152'),
(420, 6, 'Mahawela Sinhapura', '51076'),
(421, 6, 'Mapalagama', '80112'),
(422, 6, 'Mapalagama Central', '80116'),
(423, 6, 'Mattaka', '80424'),
(424, 6, 'Meda-Keembiya', '80092'),
(425, 6, 'Meetiyagoda', '80330'),
(426, 6, 'Nagoda', '80110'),
(427, 6, 'Nakiyadeniya', '80064'),
(428, 6, 'Nawandagala', '80416'),
(429, 6, 'Neluwa', '80082'),
(430, 6, 'Nindana', '80318'),
(431, 6, 'Pahala Millawa', '81472'),
(432, 6, 'Panangala', '80075'),
(433, 6, 'Pannimulla Panagoda', '80086'),
(434, 6, 'Parana Thanayamgoda', '80114'),
(435, 6, 'Patana', '22012'),
(436, 6, 'Pitigala', '80420'),
(437, 6, 'Poddala', '80170'),
(438, 6, 'Polgampola', '12136'),
(439, 6, 'Porawagama', '80408'),
(440, 6, 'Rantotuwila', '80354'),
(441, 6, 'Talagampola', '80058'),
(442, 6, 'Talgaspe', '80406'),
(443, 6, 'Talpe', '80615'),
(444, 6, 'Tawalama', '80148'),
(445, 6, 'Tiranagama', '80244'),
(446, 6, 'Udalamatta', '80108'),
(447, 6, 'Udugama', '80070'),
(448, 6, 'Uluvitike', '80168'),
(449, 6, 'Unawatuna', '80600'),
(450, 6, 'Unawitiya', '80214'),
(451, 6, 'Uragaha', '80352'),
(452, 6, 'Uragasmanhandiya', '80350'),
(453, 6, 'Wakwella', '80042'),
(454, 6, 'Walahanduwa', '80046'),
(455, 6, 'Wanchawela', '80120'),
(456, 6, 'Wanduramba', '80100'),
(457, 6, 'Warukandeniya', '80084'),
(458, 6, 'Watugedara', '80340'),
(459, 6, 'Weihena', '80216'),
(460, 6, 'Welikanda', '51070'),
(461, 6, 'Wilanagama', '20142'),
(462, 6, 'Yakkalamulla', '80150'),
(463, 6, 'Yatalamatta', '80107'),
(464, 7, 'Akaragama', '11536'),
(465, 7, 'Ambagaspitiya', '11052'),
(466, 7, 'Ambepussa', '11212'),
(467, 7, 'Andiambalama', '11558'),
(468, 7, 'Attanagalla', '11120'),
(469, 7, 'Badalgama', '11538'),
(470, 7, 'Banduragoda', '11244'),
(471, 7, 'Batuwatta', '11011'),
(472, 7, 'Bemmulla', '11040'),
(473, 7, 'Biyagama IPZ', '11672'),
(474, 7, 'Bokalagama', '11216'),
(475, 7, 'Bollete (WP)', '11024'),
(476, 7, 'Bopagama', '11134'),
(477, 7, 'Buthpitiya', '11720'),
(478, 7, 'Dagonna', '11524'),
(479, 7, 'Danowita', '11896'),
(480, 7, 'Debahera', '11889'),
(481, 7, 'Dekatana', '11690'),
(482, 7, 'Delgoda', '11700'),
(483, 7, 'Delwagura', '11228'),
(484, 7, 'Demalagama', '11692'),
(485, 7, 'Demanhandiya', '11270'),
(486, 7, 'Dewalapola', '11102'),
(487, 7, 'Divulapitiya', '11250'),
(488, 7, 'Divuldeniya', '11208'),
(489, 7, 'Dompe', '11680'),
(490, 7, 'Dunagaha', '11264'),
(491, 7, 'Ekala', '11380'),
(492, 7, 'Ellakkala', '11116'),
(493, 7, 'Essella', '11108'),
(494, 7, 'Galedanda', '90206'),
(495, 7, 'Gampaha', '11000'),
(496, 7, 'Ganemulla', '11020'),
(497, 7, 'Giriulla', '60140'),
(498, 7, 'Gonawala', '11630'),
(499, 7, 'Halpe', '70145'),
(500, 7, 'Hapugastenna', '70164'),
(501, 7, 'Heiyanthuduwa', '11618'),
(502, 7, 'Hinatiyana Madawala', '11568'),
(503, 7, 'Hiswella', '11734'),
(504, 7, 'Horampella', '11564'),
(505, 7, 'Hunumulla', '11262'),
(506, 7, 'Hunupola', '60582'),
(507, 7, 'Ihala Madampella', '11265'),
(508, 7, 'Imbulgoda', '11856'),
(509, 7, 'Ja-Ela', '11350'),
(510, 7, 'Kadawatha', '11850'),
(511, 7, 'Kahatowita', '11144'),
(512, 7, 'Kalagedihena', '11875'),
(513, 7, 'Kaleliya', '11160'),
(514, 7, 'Kandana', '11320'),
(515, 7, 'Katana', '11534'),
(516, 7, 'Katudeniya', '21016'),
(517, 7, 'Katunayake', '11450'),
(518, 7, 'Katunayake Air Force Camp', '11440'),
(519, 7, 'Katunayake(FTZ)', '11420'),
(520, 7, 'Katuwellegama', '11526'),
(521, 7, 'Kelaniya', '11600'),
(522, 7, 'Kimbulapitiya', '11522'),
(523, 7, 'Kirindiwela', '11730'),
(524, 7, 'Kitalawalana', '11206'),
(525, 7, 'Kochchikade', '11540'),
(526, 7, 'Kotadeniyawa', '11232'),
(527, 7, 'Kotugoda', '11390'),
(528, 7, 'Kumbaloluwa', '11105'),
(529, 7, 'Loluwagoda', '11204'),
(530, 7, 'Mabodale', '11114'),
(531, 7, 'Madelgamuwa', '11033'),
(532, 7, 'Makewita', '11358'),
(533, 7, 'Makola', '11640'),
(534, 7, 'Malwana', '11670'),
(535, 7, 'Mandawala', '11061'),
(536, 7, 'Marandagahamula', '11260'),
(537, 7, 'Mellawagedara', '11234'),
(538, 7, 'Minuwangoda', '11550'),
(539, 7, 'Mirigama', '11200'),
(540, 7, 'Miriswatta', '80508'),
(541, 7, 'Mithirigala', '11742'),
(542, 7, 'Muddaragama', '11112'),
(543, 7, 'Mudungoda', '11056'),
(544, 7, 'Mulleriyawa New Town', '10620'),
(545, 7, 'Naranwala', '11063'),
(546, 7, 'Nawana', '11222'),
(547, 7, 'Nedungamuwa', '11066'),
(548, 7, 'Negombo', '11500'),
(549, 7, 'Nikadalupotha', '60580'),
(550, 7, 'Nikahetikanda', '11128'),
(551, 7, 'Nittambuwa', '11880'),
(552, 7, 'Niwandama', '11354'),
(553, 7, 'Opatha', '80142'),
(554, 7, 'Pamunugama', '11370'),
(555, 7, 'Pamunuwatta', '11214'),
(556, 7, 'Panawala', '70612'),
(557, 7, 'Pasyala', '11890'),
(558, 7, 'Peliyagoda', '11830'),
(559, 7, 'Pepiliyawala', '11741'),
(560, 7, 'Pethiyagoda', '11043'),
(561, 7, 'Polpithimukulana', '11324'),
(562, 7, 'Puwakpitiya', '10712'),
(563, 7, 'Radawadunna', '11892'),
(564, 7, 'Radawana', '11725'),
(565, 7, 'Raddolugama', '11400'),
(566, 7, 'Ragama', '11010'),
(567, 7, 'Ruggahawila', '11142'),
(568, 7, 'Seeduwa', '11410'),
(569, 7, 'Siyambalape', '11607'),
(570, 7, 'Talahena', '11504'),
(571, 7, 'Thambagalla', '60584'),
(572, 7, 'Thimbirigaskatuwa', '11532'),
(573, 7, 'Tittapattara', '10664'),
(574, 7, 'Udathuthiripitiya', '11054'),
(575, 7, 'Udugampola', '11030'),
(576, 7, 'Uggalboda', '11034'),
(577, 7, 'Urapola', '11126'),
(578, 7, 'Uswetakeiyawa', '11328'),
(579, 7, 'Veyangoda', '11100'),
(580, 7, 'Walgammulla', '11146'),
(581, 7, 'Walpita', '11226'),
(582, 7, 'Walpola (WP)', '11012'),
(583, 7, 'Wathurugama', '11724'),
(584, 7, 'Watinapaha', '11104'),
(585, 7, 'Wattala', '11104'),
(586, 7, 'Weboda', '11858'),
(587, 7, 'Wegowwa', '11562'),
(588, 7, 'Weweldeniya', '11894'),
(589, 7, 'Yakkala', '11870'),
(590, 7, 'Yatiyana', '11566'),
(591, 8, 'Ambalantota', '82100'),
(592, 8, 'Angunakolapelessa', '82220'),
(593, 8, 'Angunakolawewa', '91302'),
(594, 8, 'Bandagiriya Colony', '82005'),
(595, 8, 'Barawakumbuka', '82110'),
(596, 8, 'Beliatta', '82400'),
(597, 8, 'Beragama', '82102'),
(598, 8, 'Beralihela', '82618'),
(599, 8, 'Bundala', '82002'),
(600, 8, 'Ellagala', '82619'),
(601, 8, 'Gangulandeniya', '82586'),
(602, 8, 'Getamanna', '82420'),
(603, 8, 'Goda Koggalla', '82401'),
(604, 8, 'Gonagamuwa Uduwila', '82602'),
(605, 8, 'Gonnoruwa', '82006'),
(606, 8, 'Hakuruwela', '82248'),
(607, 8, 'Hambantota', '82000'),
(608, 8, 'Handugala', '81326'),
(609, 8, 'Hungama', '82120'),
(610, 8, 'Ihala Beligalla', '82412'),
(611, 8, 'Iththa Demaliya', '82462'),
(612, 8, 'Julampitiya', '82252'),
(613, 8, 'Kahandamodara', '82126'),
(614, 8, 'Kariyamaditta', '82274'),
(615, 8, 'Katuwana', '82500'),
(616, 8, 'Kawantissapura', '82622'),
(617, 8, 'Kirama', '82550'),
(618, 8, 'Kirinda', '82614'),
(619, 8, 'Lunama', '82108'),
(620, 8, 'Lunugamwehera', '82634'),
(621, 8, 'Magama', '82608'),
(622, 8, 'Mahagalwewa', '82016'),
(623, 8, 'Mamadala', '82109'),
(624, 8, 'Medamulana', '82254'),
(625, 8, 'Middeniya', '82270'),
(626, 8, 'Meegahajandura', '82014'),
(627, 8, 'Modarawana', '82416'),
(628, 8, 'Mulkirigala', '82242'),
(629, 8, 'Nakulugamuwa', '82300'),
(630, 8, 'Netolpitiya', '82135'),
(631, 8, 'Nihiluwa', '82414'),
(632, 8, 'Padawkema', '82636'),
(633, 8, 'Pahala Andarawewa', '82008'),
(634, 8, 'Rammalawarapitiya', '82554'),
(635, 8, 'Ranakeliya', '82612'),
(636, 8, 'Ranmuduwewa', '82018'),
(637, 8, 'Ranna', '82125'),
(638, 8, 'Ratmalwala', '82276'),
(639, 8, 'Ruhunu Ridiyagama', '82106'),
(640, 8, 'Sooriyawewa Town', '82010'),
(641, 8, 'Tangalla', '82200'),
(642, 8, 'Tissamaharama', '82600'),
(643, 8, 'Uda Gomadiya', '82504'),
(644, 8, 'Udamattala', '82638'),
(645, 8, 'Uswewa', '82278'),
(646, 8, 'Vitharandeniya', '82232'),
(647, 8, 'Walasmulla', '82450'),
(648, 8, 'Weeraketiya', '82240'),
(649, 8, 'Weerawila', '82632'),
(650, 8, 'Weerawila NewTown', '82615'),
(651, 8, 'Wekandawela', '82246'),
(652, 8, 'Weligatta', '82004'),
(653, 8, 'Yatigala', '82418'),
(654, 9, 'Jaffna', '40000'),
(655, 10, 'Agalawatta', '12200'),
(656, 10, 'Alubomulla', '12524'),
(657, 10, 'Anguruwatota', '12320'),
(658, 10, 'Atale', '71363'),
(659, 10, 'Baduraliya', '12230'),
(660, 10, 'Bandaragama', '12530'),
(661, 10, 'Batugampola', '10526'),
(662, 10, 'Bellana', '12224'),
(663, 10, 'Beruwala', '12070'),
(664, 10, 'Bolossagama', '12008'),
(665, 10, 'Bombuwala', '12024'),
(666, 10, 'Boralugoda', '12142'),
(667, 10, 'Bulathsinhala', '12300'),
(668, 10, 'Danawala Thiniyawala', '12148'),
(669, 10, 'Delmella', '12304'),
(670, 10, 'Dharga Town', '12090'),
(671, 10, 'Diwalakada', '12308'),
(672, 10, 'Dodangoda', '12020'),
(673, 10, 'Dombagoda', '12416'),
(674, 10, 'Ethkandura', '80458'),
(675, 10, 'Galpatha', '12005'),
(676, 10, 'Gamagoda', '12016'),
(677, 10, 'Gonagalpura', '80502'),
(678, 10, 'Gonapola Junction', '12410'),
(679, 10, 'Govinna', '12310'),
(680, 10, 'Gurulubadda', '12236'),
(681, 10, 'Halkandawila', '12055'),
(682, 10, 'Haltota', '12538'),
(683, 10, 'Halvitigala Colony', '80146'),
(684, 10, 'Halwala', '12118'),
(685, 10, 'Halwatura', '12306'),
(686, 10, 'Handapangoda', '10524'),
(687, 10, 'Hedigalla Colony', '12234'),
(688, 10, 'Henegama', '11715'),
(689, 10, 'Hettimulla', '71210'),
(690, 10, 'Horana', '12400'),
(691, 10, 'Ittapana', '12116'),
(692, 10, 'Kahawala', '10508'),
(693, 10, 'Kalawila Kiranthidiya', '12078'),
(694, 10, 'Kalutara', '12000'),
(695, 10, 'Kananwila', '12418'),
(696, 10, 'Kandanagama', '12428'),
(697, 10, 'Kelinkanda', '12218'),
(698, 10, 'Kitulgoda', '12222'),
(699, 10, 'Koholana', '12007'),
(700, 10, 'Kuda Uduwa', '12426'),
(701, 10, 'Labbala', '60162'),
(702, 10, 'Ihalahewessa', '80432'),
(703, 10, 'Induruwa', '80510'),
(704, 10, 'Ingiriya', '12440'),
(705, 10, 'Maggona', '12060'),
(706, 10, 'Mahagama', '12210'),
(707, 10, 'Mahakalupahana', '12126'),
(708, 10, 'Maharangalla', '71211'),
(709, 10, 'Malgalla Talangalla', '80144'),
(710, 10, 'Matugama', '12100'),
(711, 10, 'Meegahatenna', '12130'),
(712, 10, 'Meegama', '12094'),
(713, 10, 'Meegoda', '10504'),
(714, 10, 'Millaniya', '12412'),
(715, 10, 'Millewa', '12422'),
(716, 10, 'Miwanapalana', '12424'),
(717, 10, 'Molkawa', '12216'),
(718, 10, 'Morapitiya', '12232'),
(719, 10, 'Morontuduwa', '12564'),
(720, 10, 'Nawattuduwa', '12106'),
(721, 10, 'Neboda', '12030'),
(722, 10, 'Padagoda', '12074'),
(723, 10, 'Pahalahewessa', '12144'),
(724, 10, 'Paiyagala', '12050'),
(725, 10, 'Panadura', '12500'),
(726, 10, 'Pannala', '60160'),
(727, 10, 'Paragastota', '12414'),
(728, 10, 'Paragoda', '12302'),
(729, 10, 'Paraigama', '12122'),
(730, 10, 'Pelanda', '12214'),
(731, 10, 'Pelawatta', '12138'),
(732, 10, 'Pimbura', '70472'),
(733, 10, 'Pitagaldeniya', '71360'),
(734, 10, 'Pokunuwita', '12404'),
(735, 10, 'Poruwedanda', '12432'),
(736, 10, 'Ratmale', '81030'),
(737, 10, 'Remunagoda', '12009'),
(738, 10, 'Talgaswela', '80470'),
(739, 10, 'Tebuwana', '12025'),
(740, 10, 'Uduwara', '12322'),
(741, 10, 'Utumgama', '12127'),
(742, 10, 'Veyangalla', '12204'),
(743, 10, 'Wadduwa', '12560'),
(744, 10, 'Walagedara', '12112'),
(745, 10, 'Walallawita', '12134'),
(746, 10, 'Waskaduwa', '12580'),
(747, 10, 'Welipenna', '12108'),
(748, 10, 'Weliveriya', '11710'),
(749, 10, 'Welmilla Junction', '12534'),
(750, 10, 'Weragala', '71622'),
(751, 10, 'Yagirala', '12124'),
(752, 10, 'Yatadolawatta', '12104'),
(753, 10, 'Yatawara Junction', '12006'),
(754, 11, 'Aludeniya', '20062'),
(755, 11, 'Ambagahapelessa', '20986'),
(756, 11, 'Ambagamuwa Udabulathgama', '20678'),
(757, 11, 'Ambatenna', '20136'),
(758, 11, 'Ampitiya', '20160'),
(759, 11, 'Ankumbura', '20150'),
(760, 11, 'Atabage', '20574'),
(761, 11, 'Balana', '20308'),
(762, 11, 'Bambaragahaela', '20644'),
(763, 11, 'Batagolladeniya', '20154'),
(764, 11, 'Batugoda', '20132'),
(765, 11, 'Batumulla', '20966'),
(766, 11, 'Bawlana', '20218'),
(767, 11, 'Bopana', '20932'),
(768, 11, 'Danture', '20465'),
(769, 11, 'Dedunupitiya', '20068'),
(770, 11, 'Dekinda', '20658'),
(771, 11, 'Deltota', '20430'),
(772, 11, 'Divulankadawala', '51428'),
(773, 11, 'Dolapihilla', '20126'),
(774, 11, 'Dolosbage', '20510'),
(775, 11, 'Dunuwila', '20824'),
(776, 11, 'Etulgama', '20202'),
(777, 11, 'Galaboda', '20664'),
(778, 11, 'Galagedara', '20100'),
(779, 11, 'Galaha', '20420'),
(780, 11, 'Galhinna', '20152'),
(781, 11, 'Gampola', '20500'),
(782, 11, 'Gelioya', '20620'),
(783, 11, 'Godamunna', '20214'),
(784, 11, 'Gomagoda', '20184'),
(785, 11, 'Gonagantenna', '20712'),
(786, 11, 'Gonawalapatana', '20656'),
(787, 11, 'Gunnepana', '20270'),
(788, 11, 'Gurudeniya', '20189'),
(789, 11, 'Hakmana', '81300'),
(790, 11, 'Handaganawa', '20984'),
(791, 11, 'Handawalapitiya', '20438'),
(792, 11, 'Handessa', '20480'),
(793, 20, 'Hanguranketha', '20710'),
(794, 11, 'Harangalagama', '20669'),
(795, 11, 'Hataraliyadda', '20060'),
(796, 11, 'Hindagala', '20414'),
(797, 11, 'Hondiyadeniya', '20524'),
(798, 11, 'Hunnasgiriya', '20948'),
(799, 11, 'Inguruwatta', '60064'),
(800, 11, 'Jambugahapitiya', '20822'),
(801, 11, 'Kadugannawa', '20300'),
(802, 11, 'Kahataliyadda', '20924'),
(803, 11, 'Kalugala', '20926'),
(804, 11, 'Kandy', '20000'),
(805, 11, 'Kapuliyadde', '20206'),
(806, 11, 'Katugastota', '20800'),
(807, 11, 'Katukitula', '20588'),
(808, 11, 'Kelanigama', '20688'),
(809, 11, 'Kengalla', '20186'),
(810, 11, 'Ketaboola', '20660'),
(811, 11, 'Ketakumbura', '20306'),
(812, 11, 'Kobonila', '20928'),
(813, 11, 'Kolabissa', '20212'),
(814, 11, 'Kolongoda', '20971'),
(815, 11, 'Kulugammana', '20048'),
(816, 11, 'Kumbukkandura', '20902'),
(817, 11, 'Kumburegama', '20086'),
(818, 11, 'Kundasale', '20168'),
(819, 11, 'Leemagahakotuwa', '20482'),
(820, 11, 'Ihala Kobbekaduwa', '20042'),
(821, 11, 'Lunugama', '11062'),
(822, 11, 'Lunuketiya Maditta', '20172'),
(823, 11, 'Madawala Bazaar', '20260'),
(824, 11, 'Madawalalanda', '32016'),
(825, 11, 'Madugalla', '20938'),
(826, 11, 'Madulkele', '20840'),
(827, 11, 'Mahadoraliyadda', '20945'),
(828, 11, 'Mahamedagama', '20216'),
(829, 11, 'Mahanagapura', '32018'),
(830, 11, 'Mailapitiya', '20702'),
(831, 11, 'Makkanigama', '20828'),
(832, 11, 'Makuldeniya', '20921'),
(833, 11, 'Mangalagama', '32069'),
(834, 11, 'Mapakanda', '20662'),
(835, 11, 'Marassana', '20210'),
(836, 20, 'Marymount Colony', '20714'),
(837, 11, 'Mawatura', '20564'),
(838, 11, 'Medamahanuwara', '20940'),
(839, 11, 'Medawala Harispattuwa', '20120'),
(840, 11, 'Meetalawa', '20512'),
(841, 11, 'Megoda Kalugamuwa', '20409'),
(842, 11, 'Menikdiwela', '20470'),
(843, 11, 'Menikhinna', '20170'),
(844, 11, 'Mimure', '20923'),
(845, 11, 'Minigamuwa', '20109'),
(846, 11, 'Minipe', '20983'),
(847, 11, 'Moragahapallama', '32012'),
(848, 11, 'Murutalawa', '20232'),
(849, 11, 'Muruthagahamulla', '20526'),
(850, 11, 'Nanuoya', '22150'),
(851, 11, 'Naranpanawa', '20176'),
(852, 11, 'Narawelpita', '81302'),
(853, 11, 'Nawalapitiya', '20650'),
(854, 11, 'Nawathispane', '20670'),
(855, 11, 'Nillambe', '20418'),
(856, 11, 'Nugaliyadda', '20204'),
(857, 11, 'Ovilikanda', '21020'),
(858, 11, 'Pallekotuwa', '20084'),
(859, 11, 'Panwilatenna', '20544'),
(860, 11, 'Paradeka', '20578'),
(861, 11, 'Pasbage', '20654'),
(862, 11, 'Pattitalawa', '20511'),
(863, 11, 'Peradeniya', '20400'),
(864, 11, 'Pilimatalawa', '20450'),
(865, 11, 'Poholiyadda', '20106'),
(866, 11, 'Pubbiliya', '21502'),
(867, 11, 'Pupuressa', '20546'),
(868, 11, 'Pussellawa', '20580'),
(869, 11, 'Putuhapuwa', '20906'),
(870, 11, 'Rajawella', '20180'),
(871, 11, 'Rambukpitiya', '20676'),
(872, 11, 'Rambukwella', '20128'),
(873, 11, 'Rangala', '20922'),
(874, 11, 'Rantembe', '20990'),
(875, 11, 'Sangarajapura', '20044'),
(876, 11, 'Senarathwela', '20904'),
(877, 11, 'Talatuoya', '20200'),
(878, 11, 'Teldeniya', '20900'),
(879, 11, 'Tennekumbura', '20166'),
(880, 11, 'Uda Peradeniya', '20404'),
(881, 11, 'Udahentenna', '20506'),
(882, 11, 'Udatalawinna', '20802'),
(883, 11, 'Udispattuwa', '20916'),
(884, 11, 'Ududumbara', '20950'),
(885, 11, 'Uduwahinna', '20934'),
(886, 11, 'Uduwela', '20164'),
(887, 11, 'Ulapane', '20562'),
(888, 11, 'Unuwinna', '20708'),
(889, 11, 'Velamboda', '20640'),
(890, 11, 'Watagoda', '22110'),
(891, 11, 'Watagoda Harispattuwa', '20134'),
(892, 11, 'Wattappola', '20454'),
(893, 11, 'Weligampola', '20666'),
(894, 11, 'Wendaruwa', '20914'),
(895, 11, 'Weragantota', '20982'),
(896, 11, 'Werapitya', '20908'),
(897, 11, 'Werellagama', '20080'),
(898, 11, 'Wettawa', '20108'),
(899, 11, 'Yahalatenna', '20234'),
(900, 11, 'Yatihalagala', '20034'),
(901, 12, 'Alawala', '11122'),
(902, 12, 'Alawatura', '71204'),
(903, 12, 'Alawwa', '60280'),
(904, 12, 'Algama', '71607'),
(905, 12, 'Alutnuwara', '71508'),
(906, 12, 'Ambalakanda', '71546'),
(907, 12, 'Ambulugala', '71503'),
(908, 12, 'Amitirigala', '71320'),
(909, 12, 'Ampagala', '71232'),
(910, 12, 'Anhandiya', '60074'),
(911, 12, 'Anhettigama', '71403'),
(912, 12, 'Aranayaka', '71540'),
(913, 12, 'Aruggammana', '71041'),
(914, 12, 'Batuwita', '71321'),
(915, 12, 'Beligala(Sab)', '71044'),
(916, 12, 'Belihuloya', '70140'),
(917, 12, 'Berannawa', '71706'),
(918, 12, 'Bopitiya', '60155'),
(919, 12, 'Bopitiya (SAB)', '71612'),
(920, 12, 'Boralankada', '71418'),
(921, 12, 'Bossella', '71208'),
(922, 12, 'Bulathkohupitiya', '71230'),
(923, 12, 'Damunupola', '71034'),
(924, 12, 'Debathgama', '71037'),
(925, 12, 'Dedugala', '71237'),
(926, 12, 'Deewala Pallegama', '71022'),
(927, 12, 'Dehiowita', '71400'),
(928, 12, 'Deldeniya', '71009'),
(929, 12, 'Deloluwa', '71401'),
(930, 12, 'Deraniyagala', '71430'),
(931, 12, 'Dewalegama', '71050'),
(932, 12, 'Dewanagala', '71527'),
(933, 12, 'Dombemada', '71115'),
(934, 12, 'Dorawaka', '71601'),
(935, 12, 'Dunumala', '71605'),
(936, 12, 'Galapitamada', '71603'),
(937, 12, 'Galatara', '71505'),
(938, 12, 'Galigamuwa Town', '71350'),
(939, 12, 'Gallella', '70062'),
(940, 12, 'Galpatha(Sab)', '71312'),
(941, 12, 'Gantuna', '71222'),
(942, 12, 'Getahetta', '70620'),
(943, 12, 'Godagampola', '70556'),
(944, 12, 'Gonagala', '71318'),
(945, 12, 'Hakahinna', '71352'),
(946, 12, 'Hakbellawaka', '71715'),
(947, 12, 'Halloluwa', '20032'),
(948, 12, 'Hedunuwewa', '22024'),
(949, 12, 'Hemmatagama', '71530'),
(950, 12, 'Hewadiwela', '71108'),
(951, 12, 'Hingula', '71520'),
(952, 12, 'Hinguralakanda', '71417'),
(953, 12, 'Hingurana', '32010'),
(954, 12, 'Hiriwadunna', '71014'),
(955, 12, 'Ihala Walpola', '80134'),
(956, 12, 'Ihalagama', '70144'),
(957, 12, 'Imbulana', '71313'),
(958, 12, 'Imbulgasdeniya', '71055'),
(959, 12, 'Kabagamuwa', '71202'),
(960, 12, 'Kahapathwala', '60062'),
(961, 12, 'Kandaketya', '90020'),
(962, 12, 'Kannattota', '71372'),
(963, 12, 'Karagahinna', '21014'),
(964, 12, 'Kegalle', '71000'),
(965, 12, 'Kehelpannala', '71533'),
(966, 12, 'Ketawala Leula', '20198'),
(967, 12, 'Kitulgala', '71720'),
(968, 12, 'Kondeniya', '71501'),
(969, 12, 'Kotiyakumbura', '71370'),
(970, 12, 'Lewangama', '71315'),
(971, 12, 'Mahabage', '71722'),
(972, 12, 'Makehelwala', '71507'),
(973, 12, 'Malalpola', '71704'),
(974, 12, 'Maldeniya', '22021'),
(975, 12, 'Maliboda', '71411'),
(976, 12, 'Maliyadda', '90022'),
(977, 12, 'Malmaduwa', '71325'),
(978, 12, 'Marapana', '70041'),
(979, 12, 'Mawanella', '71500'),
(980, 12, 'Meetanwala', '60066'),
(981, 12, 'Migastenna Sabara', '71716'),
(982, 12, 'Miyanawita', '71432'),
(983, 12, 'Molagoda', '71016'),
(984, 12, 'Morontota', '71220'),
(985, 12, 'Narangala', '90064'),
(986, 12, 'Narangoda', '60152'),
(987, 12, 'Nattarampotha', '20194'),
(988, 12, 'Nelundeniya', '71060'),
(989, 12, 'Niyadurupola', '71602'),
(990, 12, 'Noori', '71407'),
(991, 12, 'Pannila', '12114'),
(992, 12, 'Pattampitiya', '71130'),
(993, 12, 'Pilawala', '20196'),
(994, 12, 'Pothukoladeniya', '71039'),
(995, 12, 'Puswelitenna', '60072'),
(996, 12, 'Rambukkana', '71100'),
(997, 12, 'Rilpola', '90026'),
(998, 12, 'Rukmale', '11129'),
(999, 12, 'Ruwanwella', '71300'),
(1000, 12, 'Samanalawewa', '70142'),
(1001, 12, 'Seaforth Colony', '71708'),
(1002, 5, 'Colombo 2', '00200'),
(1003, 12, 'Spring Valley', '90028'),
(1004, 12, 'Talgaspitiya', '71541'),
(1005, 12, 'Teligama', '71724'),
(1006, 12, 'Tholangamuwa', '71619'),
(1007, 12, 'Thotawella', '71106'),
(1008, 12, 'Udaha Hawupe', '70154'),
(1009, 12, 'Udapotha', '71236'),
(1010, 12, 'Uduwa', '20052'),
(1011, 12, 'Undugoda', '71200'),
(1012, 12, 'Ussapitiya', '71510'),
(1013, 12, 'Wahakula', '71303'),
(1014, 12, 'Waharaka', '71304'),
(1015, 12, 'Wanaluwewa', '11068'),
(1016, 12, 'Warakapola', '71600'),
(1017, 12, 'Watura', '71035'),
(1018, 12, 'Weeoya', '71702'),
(1019, 12, 'Wegalla', '71234'),
(1020, 12, 'Weligalla', '20610'),
(1021, 12, 'Welihelatenna', '71712'),
(1022, 12, 'Wewelwatta', '70066'),
(1023, 12, 'Yatagama', '71116'),
(1024, 12, 'Yatapana', '71326'),
(1025, 12, 'Yatiyantota', '71700'),
(1026, 12, 'Yattogoda', '71029'),
(1027, 13, 'Kandavalai', '42508'),
(1028, 13, 'Karachchi', NULL),
(1029, 13, 'Kilinochchi', '42400'),
(1030, 13, 'Pachchilaipalli', '42550'),
(1031, 13, 'Poonakary', '42600'),
(1032, 11, 'Akurana', '20850'),
(1033, 14, 'Alahengama', '60416'),
(1034, 14, 'Alahitiyawa', '60182'),
(1035, 14, 'Ambakote', '60036'),
(1036, 14, 'Ambanpola', '60650'),
(1037, 14, 'Andiyagala', '50112'),
(1038, 14, 'Anukkane', '60214'),
(1039, 14, 'Aragoda', '60308'),
(1040, 14, 'Ataragalla', '60706'),
(1041, 14, 'Awulegama', '60462'),
(1042, 14, 'Balalla', '60604'),
(1043, 14, 'Bamunukotuwa', '60347'),
(1044, 14, 'Bandara Koswatta', '60424'),
(1045, 14, 'Bingiriya', '60450'),
(1046, 14, 'Bogamulla', '60107'),
(1047, 14, 'Boraluwewa', '60437'),
(1048, 14, 'Boyagane', '60027'),
(1049, 14, 'Bujjomuwa', '60291'),
(1050, 14, 'Buluwala', '60076'),
(1051, 14, 'Dadayamtalawa', '32046'),
(1052, 14, 'Dambadeniya', '60130'),
(1053, 14, 'Daraluwa', '60174'),
(1054, 14, 'Deegalla', '60228'),
(1055, 14, 'Demataluwa', '60024'),
(1056, 14, 'Demuwatha', '70332'),
(1057, 14, 'Diddeniya', '60544'),
(1058, 14, 'Digannewa', '60485'),
(1059, 14, 'Divullegoda', '60472'),
(1060, 14, 'Diyasenpura', '51504'),
(1061, 14, 'Dodangaslanda', '60530'),
(1062, 14, 'Doluwa', '20532'),
(1063, 14, 'Doragamuwa', '20816'),
(1064, 14, 'Doratiyawa', '60013'),
(1065, 14, 'Dunumadalawa', '50214'),
(1066, 14, 'Dunuwilapitiya', '21538'),
(1067, 14, 'Ehetuwewa', '60716'),
(1068, 14, 'Elibichchiya', '60156'),
(1069, 14, 'Embogama', '60718'),
(1070, 14, 'Etungahakotuwa', '60266'),
(1071, 14, 'Galadivulwewa', '50210'),
(1072, 14, 'Galgamuwa', '60700'),
(1073, 14, 'Gallellagama', '20095'),
(1074, 14, 'Gallewa', '60712'),
(1075, 14, 'Ganegoda', '80440'),
(1076, 14, 'Girathalana', '60752'),
(1077, 14, 'Gokaralla', '60522'),
(1078, 14, 'Gonawila', '60170'),
(1079, 14, 'Halmillawewa', '60441'),
(1080, 14, 'Handungamuwa', '21536'),
(1081, 14, 'Harankahawa', '20092'),
(1082, 14, 'Helamada', '71046'),
(1083, 14, 'Hengamuwa', '60414'),
(1084, 14, 'Hettipola', '60430'),
(1085, 14, 'Hewainna', '10714'),
(1086, 14, 'Hilogama', '60486'),
(1087, 14, 'Hindagolla', '60034'),
(1088, 14, 'Hiriyala Lenawa', '60546'),
(1089, 14, 'Hiruwalpola', '60458'),
(1090, 14, 'Horambawa', '60181'),
(1091, 14, 'Hulogedara', '60474'),
(1092, 14, 'Hulugalla', '60477'),
(1093, 14, 'Ihala Gomugomuwa', '60211'),
(1094, 14, 'Ihala Katugampala', '60135'),
(1095, 14, 'Indulgodakanda', '60016'),
(1096, 14, 'Ithanawatta', '60025'),
(1097, 14, 'Kadigawa', '60492'),
(1098, 14, 'Kalankuttiya', '50174'),
(1099, 14, 'Kalatuwawa', '10718'),
(1100, 14, 'Kalugamuwa', '60096'),
(1101, 14, 'Kanadeniyawala', '60054'),
(1102, 14, 'Kanattewewa', '60422'),
(1103, 14, 'Kandegedara', '90070'),
(1104, 14, 'Karagahagedara', '60106'),
(1105, 14, 'Karambe', '60602'),
(1106, 14, 'Katiyawa', '50261'),
(1107, 14, 'Katupota', '60350'),
(1108, 14, 'Kawudulla', '51414'),
(1109, 14, 'Kawuduluwewa Stagell', '51514'),
(1110, 14, 'Kekunagolla', '60183'),
(1111, 14, 'Keppitiwalana', '60288'),
(1112, 14, 'Kimbulwanaoya', '60548'),
(1113, 14, 'Kirimetiyawa', '60184'),
(1114, 14, 'Kirindawa', '60212'),
(1115, 14, 'Kirindigalla', '60502'),
(1116, 14, 'Kithalawa', '60188'),
(1117, 14, 'Kitulwala', '11242'),
(1118, 14, 'Kobeigane', '60410'),
(1119, 14, 'Kohilagedara', '60028'),
(1120, 14, 'Konwewa', '60630'),
(1121, 14, 'Kosdeniya', '60356'),
(1122, 14, 'Kosgolla', '60029'),
(1123, 14, 'Kotagala', '22080'),
(1124, 5, 'Colombo 13', '01300'),
(1125, 14, 'Kotawehera', '60483'),
(1126, 14, 'Kudagalgamuwa', '60003'),
(1127, 14, 'Kudakatnoruwa', '60754'),
(1128, 14, 'Kuliyapitiya', '60200'),
(1129, 14, 'Kumaragama', '51412'),
(1130, 14, 'Kumbukgeta', '60508'),
(1131, 14, 'Kumbukwewa', '60506'),
(1132, 14, 'Kuratihena', '60438'),
(1133, 14, 'Kurunegala', '60000'),
(1134, 14, 'Ibbagamuwa', '60500'),
(1135, 14, 'Ihala Kadigamuwa', '60238'),
(1136, 14, 'Lihiriyagama', '61138'),
(1137, 14, 'Illagolla', '20724'),
(1138, 14, 'Ilukhena', '60232'),
(1139, 14, 'Lonahettiya', '60108'),
(1140, 14, 'Madahapola', '60552'),
(1141, 14, 'Madakumburumulla', '60209'),
(1142, 14, 'Madalagama', '70158'),
(1143, 14, 'Madawala Ulpotha', '21074'),
(1144, 14, 'Maduragoda', '60532'),
(1145, 14, 'Maeliya', '60512'),
(1146, 14, 'Magulagama', '60221'),
(1147, 14, 'Maha Ambagaswewa', '51518'),
(1148, 14, 'Mahagalkadawala', '60731'),
(1149, 14, 'Mahagirilla', '60479'),
(1150, 14, 'Mahamukalanyaya', '60516'),
(1151, 14, 'Mahananneriya', '60724'),
(1152, 14, 'Mahapallegama', '71063'),
(1153, 14, 'Maharachchimulla', '60286'),
(1154, 14, 'Mahatalakolawewa', '51506'),
(1155, 14, 'Mahawewa', '61220'),
(1156, 14, 'Maho', '60600'),
(1157, 14, 'Makulewa', '60714'),
(1158, 14, 'Makulpotha', '60514'),
(1159, 14, 'Makulwewa', '60578'),
(1160, 14, 'Malagane', '60404'),
(1161, 14, 'Mandapola', '60434'),
(1162, 14, 'Maspotha', '60344'),
(1163, 14, 'Mawathagama', '60060'),
(1164, 14, 'Medirigiriya', '51500'),
(1165, 14, 'Medivawa', '60612'),
(1166, 14, 'Meegalawa', '60750'),
(1167, 14, 'Meegaswewa', '51508'),
(1168, 14, 'Meewellawa', '60484'),
(1169, 14, 'Melsiripura', '60540'),
(1170, 14, 'Metikumbura', '60304'),
(1171, 14, 'Metiyagane', '60121'),
(1172, 14, 'Minhettiya', '60004'),
(1173, 14, 'Minuwangete', '60406'),
(1174, 14, 'Mirihanagama', '60408'),
(1175, 14, 'Monnekulama', '60495'),
(1176, 14, 'Moragane', '60354'),
(1177, 14, 'Moragollagama', '60640'),
(1178, 14, 'Morathiha', '60038'),
(1179, 14, 'Munamaldeniya', '60218'),
(1180, 14, 'Muruthenge', '60122'),
(1181, 14, 'Mutugala', '51064'),
(1182, 14, 'Nabadewa', '60482'),
(1183, 14, 'Nagollagama', '60590'),
(1184, 14, 'Nagollagoda', '60226'),
(1185, 14, 'Nakkawatta', '60186'),
(1186, 14, 'Narammala', '60100'),
(1187, 14, 'Nawasenapura', '51066'),
(1188, 14, 'Nawatalwatta', '60292'),
(1189, 14, 'Nelliya', '60549'),
(1190, 14, 'Nikaweratiya', '60470'),
(1191, 14, 'Nugagolla', '21534'),
(1192, 14, 'Nugawela', '20072'),
(1193, 14, 'Padeniya', '60461'),
(1194, 14, 'Padiwela', '60236'),
(1195, 14, 'Pahalagiribawa', '60735'),
(1196, 14, 'Pahamune', '60112'),
(1197, 14, 'Palagala', '50111'),
(1198, 14, 'Palapathwela', '21070'),
(1199, 14, 'Palaviya', '61280'),
(1200, 14, 'Pallewela', '11150'),
(1201, 14, 'Palukadawala', '60704'),
(1202, 14, 'Panadaragama', '60348'),
(1203, 14, 'Panagamuwa', '60052'),
(1204, 14, 'Panaliya', '60312'),
(1205, 14, 'Panapitiya', '70152'),
(1206, 14, 'Panliyadda', '60558'),
(1207, 14, 'Pansiyagama', '60554'),
(1208, 14, 'Parape', '71105'),
(1209, 14, 'Pathanewatta', '90071'),
(1210, 14, 'Pattiya Watta', '20118'),
(1211, 14, 'Perakanatta', '21532'),
(1212, 14, 'Periyakadneluwa', '60518'),
(1213, 14, 'Pihimbiya Ratmale', '60439'),
(1214, 14, 'Pihimbuwa', '60053'),
(1215, 14, 'Pilessa', '60058'),
(1216, 14, 'Polgahawela', '60300'),
(1217, 14, 'Polgolla', '20250'),
(1218, 14, 'Polpithigama', '60620'),
(1219, 14, 'Pothuhera', '60330'),
(1220, 14, 'Pothupitiya', '70338'),
(1221, 14, 'Pujapitiya', '20112'),
(1222, 14, 'Rakwana', '70300'),
(1223, 14, 'Ranorawa', '50212'),
(1224, 14, 'Rathukohodigala', '20818'),
(1225, 14, 'Ridibendiella', '60606'),
(1226, 14, 'Ridigama', '60040'),
(1227, 14, 'Saliya Asokapura', '60736'),
(1228, 14, 'Sandalankawa', '60176'),
(1229, 14, 'Sevanapitiya', '51062'),
(1230, 14, 'Sirambiadiya', '61312'),
(1231, 14, 'Sirisetagama', '60478'),
(1232, 14, 'Siyambalangamuwa', '60646'),
(1233, 14, 'Siyambalawewa', '32048'),
(1234, 14, 'Solepura', '60737'),
(1235, 14, 'Solewewa', '60738'),
(1236, 14, 'Sunandapura', '60436'),
(1237, 14, 'Talawattegedara', '60306'),
(1238, 14, 'Tambutta', '60734'),
(1239, 14, 'Tennepanguwa', '90072'),
(1240, 14, 'Thalahitimulla', '60208'),
(1241, 14, 'Thalakolawewa', '60624'),
(1242, 14, 'Thalwita', '60572'),
(1243, 14, 'Tharana Udawela', '60227'),
(1244, 14, 'Thimbiriyawa', '60476'),
(1245, 14, 'Tisogama', '60453'),
(1246, 14, 'Thorayaya', '60499'),
(1247, 14, 'Tulhiriya', '71610'),
(1248, 14, 'Tuntota', '71062'),
(1249, 14, 'Tuttiripitigama', '60426'),
(1250, 14, 'Udagaldeniya', '71113'),
(1251, 14, 'Udahingulwala', '20094'),
(1252, 14, 'Udawatta', '20722'),
(1253, 14, 'Udubaddawa', '60250'),
(1254, 14, 'Udumulla', '71521'),
(1255, 14, 'Uhumiya', '60094'),
(1256, 14, 'Ulpotha Pallekele', '60622'),
(1257, 14, 'Ulpothagama', '20965'),
(1258, 14, 'Usgala Siyabmalangamuwa', '60732'),
(1259, 14, 'Vijithapura', '50110'),
(1260, 14, 'Wadakada', '60318'),
(1261, 14, 'Wadumunnegedara', '60204'),
(1262, 14, 'Walakumburumulla', '60198'),
(1263, 14, 'Wannigama', '60465'),
(1264, 14, 'Wannikudawewa', '60721'),
(1265, 14, 'Wannilhalagama', '60722'),
(1266, 14, 'Wannirasnayakapura', '60490'),
(1267, 14, 'Warawewa', '60739'),
(1268, 14, 'Wariyapola', '60400'),
(1269, 14, 'Watareka', '10511'),
(1270, 14, 'Wattegama', '20810'),
(1271, 14, 'Watuwatta', '60262'),
(1272, 14, 'Weerapokuna', '60454'),
(1273, 14, 'Welawa Juncton', '60464'),
(1274, 14, 'Welipennagahamulla', '60240'),
(1275, 14, 'Wellagala', '60402'),
(1276, 14, 'Wellarawa', '60456'),
(1277, 14, 'Wellawa', '60570'),
(1278, 14, 'Welpalla', '60206'),
(1279, 14, 'Wennoruwa', '60284'),
(1280, 14, 'Weuda', '60080'),
(1281, 14, 'Wewagama', '60195'),
(1282, 14, 'Wilgamuwa', '21530'),
(1283, 14, 'Yakwila', '60202'),
(1284, 14, 'Yatigaloluwa', '60314'),
(1285, 15, 'Mannar', '41000'),
(1286, 15, 'Puthukudiyiruppu', '30158'),
(1287, 16, 'Akuramboda', '21142'),
(1288, 16, 'Alawatuwala', '60047'),
(1289, 16, 'Alwatta', '21004'),
(1290, 16, 'Ambana', '21504'),
(1291, 16, 'Aralaganwila', '51100'),
(1292, 16, 'Ataragallewa', '21512'),
(1293, 16, 'Bambaragaswewa', '21212'),
(1294, 16, 'Barawardhana Oya', '20967'),
(1295, 16, 'Beligamuwa', '21214'),
(1296, 16, 'Damana', '32014'),
(1297, 16, 'Dambulla', '21100'),
(1298, 16, 'Damminna', '51106'),
(1299, 16, 'Dankanda', '21032'),
(1300, 16, 'Delwite', '60044'),
(1301, 16, 'Devagiriya', '21552'),
(1302, 16, 'Dewahuwa', '21206'),
(1303, 16, 'Divuldamana', '51104'),
(1304, 16, 'Dullewa', '21054'),
(1305, 16, 'Dunkolawatta', '21046'),
(1306, 16, 'Elkaduwa', '21012'),
(1307, 16, 'Erawula Junction', '21108'),
(1308, 16, 'Etanawala', '21402'),
(1309, 16, 'Galewela', '21200'),
(1310, 16, 'Galoya Junction', '51375'),
(1311, 16, 'Gammaduwa', '21068'),
(1312, 16, 'Gangala Puwakpitiya', '21404'),
(1313, 16, 'Hasalaka', '20960'),
(1314, 16, 'Hattota Amuna', '21514'),
(1315, 16, 'Imbulgolla', '21064'),
(1316, 16, 'Inamaluwa', '21124'),
(1317, 16, 'Iriyagolla', '60045'),
(1318, 16, 'Kaikawala', '21066'),
(1319, 16, 'Kalundawa', '21112'),
(1320, 16, 'Kandalama', '21106'),
(1321, 16, 'Kavudupelella', '21072'),
(1322, 16, 'Kibissa', '21122'),
(1323, 16, 'Kiwula', '21042'),
(1324, 16, 'Kongahawela', '21500'),
(1325, 16, 'Laggala Pallegama', '21520'),
(1326, 16, 'Leliambe', '21008'),
(1327, 16, 'Lenadora', '21094'),
(1328, 16, 'Ihala Halmillewa', '50262'),
(1329, 16, 'Illukkumbura', '21406'),
(1330, 16, 'Madipola', '51108'),
(1332, 16, 'Mahawela', '21140'),
(1333, 16, 'Mananwatta', '21144'),
(1334, 16, 'Maraka', '21554'),
(1335, 16, 'Matale', '21000'),
(1336, 16, 'Melipitiya', '21055'),
(1337, 16, 'Metihakka', '21062'),
(1338, 16, 'Millawana', '21154'),
(1339, 16, 'Muwandeniya', '21044'),
(1340, 16, 'Nalanda', '21082'),
(1341, 16, 'Naula', '21090'),
(1342, 16, 'Opalgala', '21076'),
(1343, 16, 'Pallepola', '21152'),
(1344, 16, 'Pimburattewa', '51102'),
(1345, 16, 'Pulastigama', '51050'),
(1346, 16, 'Ranamuregama', '21524'),
(1347, 16, 'Rattota', '21400'),
(1348, 16, 'Selagama', '21058'),
(1349, 16, 'Sigiriya', '21120'),
(1350, 16, 'Sinhagama', '51378'),
(1351, 16, 'Sungavila', '51052'),
(1352, 16, 'Talagoda Junction', '21506'),
(1353, 16, 'Talakiriyagama', '21116'),
(1354, 16, 'Tamankaduwa', '51089'),
(1355, 16, 'Udasgiriya', '21051'),
(1356, 16, 'Udatenna', '21006'),
(1357, 16, 'Ukuwela', '21300'),
(1358, 16, 'Wahacotte', '21160'),
(1359, 16, 'Walawela', '21048'),
(1360, 16, 'Wehigala', '21009'),
(1361, 16, 'Welangahawatte', '21408'),
(1362, 16, 'Wewalawewa', '21114'),
(1363, 16, 'Yatawatta', '21056'),
(1364, 17, 'Akuressa', '81400'),
(1365, 17, 'Alapaladeniya', '81475'),
(1366, 17, 'Aparekka', '81032'),
(1367, 17, 'Athuraliya', '81402'),
(1368, 17, 'Bengamuwa', '81614'),
(1369, 17, 'Bopagoda', '81412'),
(1370, 17, 'Dampahala', '81612'),
(1371, 17, 'Deegala Lenama', '81452'),
(1372, 17, 'Deiyandara', '81320'),
(1373, 17, 'Denagama', '81314'),
(1374, 17, 'Denipitiya', '81730'),
(1375, 17, 'Deniyaya', '81500'),
(1376, 17, 'Derangala', '81454'),
(1377, 17, 'Devinuwara (Dondra)', '81160'),
(1378, 17, 'Dikwella', '81200'),
(1379, 17, 'Diyagaha', '81038'),
(1380, 17, 'Diyalape', '81422'),
(1381, 17, 'Gandara', '81170'),
(1382, 17, 'Godapitiya', '81408'),
(1383, 17, 'Gomilamawarala', '81072'),
(1384, 17, 'Hawpe', '80132'),
(1385, 17, 'Horapawita', '81108'),
(1386, 17, 'Kalubowitiyana', '81478'),
(1387, 17, 'Kamburugamuwa', '81750'),
(1388, 17, 'Kamburupitiya', '81100'),
(1389, 17, 'Karagoda Uyangoda', '81082'),
(1390, 17, 'Karaputugala', '81106'),
(1391, 17, 'Karatota', '81318'),
(1392, 17, 'Kekanadura', '81020'),
(1393, 17, 'Kiriweldola', '81514'),
(1394, 17, 'Kiriwelkele', '81456'),
(1395, 17, 'Kolawenigama', '81522'),
(1396, 17, 'Kotapola', '81480'),
(1397, 17, 'Lankagama', '81526'),
(1398, 17, 'Makandura', '81070'),
(1399, 17, 'Maliduwa', '81424'),
(1400, 17, 'Maramba', '81416'),
(1401, 17, 'Matara', '81000'),
(1402, 17, 'Mediripitiya', '81524'),
(1403, 17, 'Miella', '81312'),
(1404, 17, 'Mirissa', '81740'),
(1405, 17, 'Morawaka', '81470'),
(1406, 17, 'Mulatiyana Junction', '81071'),
(1407, 17, 'Nadugala', '81092'),
(1408, 17, 'Naimana', '81017'),
(1409, 17, 'Palatuwa', '81050'),
(1410, 17, 'Parapamulla', '81322'),
(1411, 17, 'Pasgoda', '81615'),
(1412, 17, 'Penetiyana', '81722'),
(1413, 17, 'Pitabeddara', '81450'),
(1414, 17, 'Puhulwella', '81290'),
(1415, 17, 'Radawela', '81316'),
(1416, 17, 'Ransegoda', '81064'),
(1417, 17, 'Rotumba', '81074'),
(1418, 17, 'Sultanagoda', '81051'),
(1419, 17, 'Telijjawila', '81060'),
(1420, 17, 'Thihagoda', '81280'),
(1421, 17, 'Urubokka', '81600'),
(1422, 17, 'Urugamuwa', '81230'),
(1423, 17, 'Urumutta', '81414'),
(1424, 17, 'Viharahena', '81508'),
(1425, 17, 'Walakanda', '81294'),
(1426, 17, 'Walasgala', '81220'),
(1427, 17, 'Waralla', '81479'),
(1428, 17, 'Weligama', '81700'),
(1429, 17, 'Wilpita', '81404'),
(1430, 17, 'Yatiyana', '81034'),
(1431, 18, 'Ayiwela', '91516'),
(1432, 18, 'Badalkumbura', '91070'),
(1433, 18, 'Baduluwela', '91058'),
(1434, 18, 'Bakinigahawela', '91554'),
(1435, 18, 'Balaharuwa', '91295'),
(1436, 18, 'Bibile', '91500'),
(1437, 18, 'Buddama', '91038'),
(1438, 18, 'Buttala', '91100'),
(1439, 18, 'Dambagalla', '91050'),
(1440, 18, 'Diyakobala', '91514'),
(1441, 18, 'Dombagahawela', '91010'),
(1442, 18, 'Ethimalewewa', '91020'),
(1443, 18, 'Ettiliwewa', '91250'),
(1444, 18, 'Galabedda', '91008'),
(1445, 18, 'Gamewela', '90512'),
(1446, 18, 'Hambegamuwa', '91308'),
(1447, 18, 'Hingurukaduwa', '90508'),
(1448, 18, 'Hulandawa', '91004'),
(1449, 18, 'Inginiyagala', '91040'),
(1450, 18, 'Kandaudapanguwa', '91032'),
(1451, 18, 'Kandawinna', '91552'),
(1452, 18, 'Kataragama', '91400'),
(1453, 18, 'Kotagama', '91512'),
(1454, 18, 'Kotamuduna', '90506'),
(1455, 18, 'Kotawehera Mankada', '91312'),
(1456, 18, 'Kudawewa', '61226'),
(1457, 18, 'Kumbukkana', '91098'),
(1458, 18, 'Marawa', '91006'),
(1459, 18, 'Mariarawa', '91052'),
(1460, 18, 'Medagana', '91550'),
(1461, 18, 'Medawelagama', '90518'),
(1462, 18, 'Miyanakandura', '90584'),
(1463, 18, 'Monaragala', '91000'),
(1464, 18, 'Moretuwegama', '91108'),
(1465, 18, 'Nakkala', '91003'),
(1466, 18, 'Namunukula', '90580'),
(1467, 18, 'Nannapurawa', '91519'),
(1468, 18, 'Nelliyadda', '91042'),
(1469, 18, 'Nilgala', '91508'),
(1470, 18, 'Obbegoda', '91007'),
(1471, 18, 'Okkampitiya', '91060'),
(1472, 18, 'Pangura', '91002'),
(1473, 18, 'Pitakumbura', '91505'),
(1474, 18, 'Randeniya', '91204'),
(1475, 18, 'Ruwalwela', '91056'),
(1476, 18, 'Sella Kataragama', '91405'),
(1477, 18, 'Siyambalagune', '91202'),
(1478, 18, 'Siyambalanduwa', '91030'),
(1479, 18, 'Suriara', '91306'),
(1480, 18, 'Thanamalwila', '91300'),
(1481, 18, 'Uva Gangodagama', '91054'),
(1482, 18, 'Uva Kudaoya', '91298'),
(1483, 18, 'Uva Pelwatta', '91112'),
(1484, 18, 'Warunagama', '91198'),
(1485, 18, 'Wedikumbura', '91005'),
(1486, 18, 'Weherayaya Handapanagala', '91206'),
(1487, 18, 'Wellawaya', '91200'),
(1488, 18, 'Wilaoya', '91022'),
(1489, 18, 'Yudaganawa', '51424'),
(1490, 19, 'Mullativu', '42000'),
(1491, 20, 'Agarapathana', '22094'),
(1492, 20, 'Ambatalawa', '20686'),
(1493, 20, 'Ambewela', '22216'),
(1494, 20, 'Bogawantalawa', '22060'),
(1495, 20, 'Bopattalawa', '22095'),
(1496, 20, 'Dagampitiya', '20684'),
(1497, 20, 'Dayagama Bazaar', '22096'),
(1498, 20, 'Dikoya', '22050'),
(1499, 20, 'Doragala', '20567'),
(1500, 20, 'Dunukedeniya', '22002'),
(1501, 20, 'Egodawela', '90013'),
(1502, 20, 'Ekiriya', '20732'),
(1503, 20, 'Elamulla', '20742'),
(1504, 20, 'Ginigathena', '20680'),
(1505, 20, 'Gonakele', '22226'),
(1506, 20, 'Haggala', '22208'),
(1507, 20, 'Halgranoya', '22240'),
(1508, 20, 'Hangarapitiya', '22044'),
(1509, 20, 'Hapugasthalawa', '20668'),
(1510, 20, 'Harasbedda', '22262'),
(1511, 20, 'Hatton', '22000'),
(1512, 20, 'Hewaheta', '20440'),
(1513, 20, 'Hitigegama', '22046'),
(1514, 20, 'Jangulla', '90063'),
(1515, 20, 'Kalaganwatta', '22282'),
(1516, 20, 'Kandapola', '22220'),
(1517, 20, 'Karandagolla', '20738'),
(1518, 20, 'Keerthi Bandarapura', '22274'),
(1519, 20, 'Kiribathkumbura', '20442'),
(1520, 20, 'Kotiyagala', '91024'),
(1521, 20, 'Kotmale', '20560'),
(1522, 20, 'Kottellena', '22040'),
(1523, 20, 'Kumbalgamuwa', '22272'),
(1524, 20, 'Kumbukwela', '22246'),
(1525, 20, 'Kurupanawela', '22252'),
(1526, 20, 'Labukele', '20592'),
(1527, 20, 'Laxapana', '22034'),
(1528, 20, 'Lindula', '22090'),
(1529, 20, 'Madulla', '22256'),
(1530, 20, 'Mandaram Nuwara', '20744'),
(1531, 20, 'Maskeliya', '22070'),
(1532, 20, 'Maswela', '20566'),
(1533, 20, 'Maturata', '20748'),
(1534, 20, 'Mipanawa', '22254'),
(1535, 20, 'Mipilimana', '22214'),
(1536, 20, 'Morahenagama', '22036'),
(1537, 20, 'Munwatta', '20752'),
(1538, 20, 'Nayapana Janapadaya', '20568'),
(1539, 20, 'Nildandahinna', '22280'),
(1540, 20, 'Nissanka Uyana', '22075'),
(1541, 20, 'Norwood', '22058'),
(1542, 20, 'Nuwara Eliya', '22200'),
(1543, 20, 'Padiyapelella', '20750'),
(1544, 20, 'Pallebowala', '20734'),
(1545, 20, 'Panvila', '20830'),
(1546, 20, 'Pitawala', '20682'),
(1547, 20, 'Pundaluoya', '22120'),
(1548, 20, 'Ramboda', '20590'),
(1549, 20, 'Rikillagaskada', '20730'),
(1550, 20, 'Rozella', '22008'),
(1551, 20, 'Rupaha', '22245'),
(1552, 20, 'Ruwaneliya', '22212');
INSERT INTO `city` (`id`, `district_id`, `name_en`, `postcode`) VALUES
(1553, 20, 'Santhipura', '22202'),
(1554, 20, 'Talawakele', '22100'),
(1555, 20, 'Tawalantenna', '20838'),
(1556, 20, 'Teripeha', '22287'),
(1557, 20, 'Udamadura', '22285'),
(1558, 20, 'Udapussallawa', '22250'),
(1559, 20, 'Uva Deegalla', '90062'),
(1560, 20, 'Uva Uduwara', '90061'),
(1561, 20, 'Uvaparanagama', '90230'),
(1562, 20, 'Walapane', '22270'),
(1563, 20, 'Watawala', '22010'),
(1564, 20, 'Widulipura', '22032'),
(1565, 20, 'Wijebahukanda', '22018'),
(1566, 21, 'Attanakadawala', '51235'),
(1567, 21, 'Bakamuna', '51250'),
(1568, 21, 'Diyabeduma', '51225'),
(1569, 21, 'Elahera', '51258'),
(1570, 21, 'Giritale', '51026'),
(1571, 21, 'Hingurakdamana', '51408'),
(1572, 21, 'Hingurakgoda', '51400'),
(1573, 21, 'Jayanthipura', '51024'),
(1574, 21, 'Kalingaela', '51002'),
(1575, 21, 'Lakshauyana', '51006'),
(1576, 21, 'Mankemi', '30442'),
(1577, 21, 'Minneriya', '51410'),
(1578, 21, 'Onegama', '51004'),
(1579, 21, 'Orubendi Siyambalawa', '51256'),
(1580, 21, 'Palugasdamana', '51046'),
(1581, 21, 'Panichankemi', '30444'),
(1582, 21, 'Polonnaruwa', '51000'),
(1583, 21, 'Talpotha', '51044'),
(1584, 21, 'Tambala', '51049'),
(1585, 21, 'Unagalavehera', '51008'),
(1586, 21, 'Wijayabapura', '51042'),
(1587, 22, 'Adippala', '61012'),
(1588, 22, 'Alutgama', '12080'),
(1589, 22, 'Alutwewa', '51014'),
(1590, 22, 'Ambakandawila', '61024'),
(1591, 22, 'Anamaduwa', '61500'),
(1592, 22, 'Andigama', '61508'),
(1593, 22, 'Angunawila', '61264'),
(1594, 22, 'Attawilluwa', '61328'),
(1595, 22, 'Bangadeniya', '61238'),
(1596, 22, 'Baranankattuwa', '61262'),
(1597, 22, 'Battuluoya', '61246'),
(1598, 22, 'Bujjampola', '61136'),
(1599, 22, 'Chilaw', '61000'),
(1600, 22, 'Dalukana', '51092'),
(1601, 22, 'Dankotuwa', '61130'),
(1602, 22, 'Dewagala', '51094'),
(1603, 22, 'Dummalasuriya', '60260'),
(1604, 22, 'Dunkannawa', '61192'),
(1605, 22, 'Eluwankulama', '61308'),
(1606, 22, 'Ettale', '61343'),
(1607, 22, 'Galamuna', '51416'),
(1608, 22, 'Galmuruwa', '61233'),
(1609, 22, 'Hansayapalama', '51098'),
(1610, 22, 'Ihala Kottaramulla', '61154'),
(1611, 22, 'Ilippadeniya', '61018'),
(1612, 22, 'Inginimitiya', '61514'),
(1613, 22, 'Ismailpuram', '61302'),
(1614, 22, 'Jayasiripura', '51246'),
(1615, 22, 'Kakkapalliya', '61236'),
(1616, 22, 'Kalkudah', '30410'),
(1617, 22, 'Kalladiya', '61534'),
(1618, 22, 'Kandakuliya', '61358'),
(1619, 22, 'Karathivu', '61307'),
(1620, 22, 'Karawitagara', '61022'),
(1621, 22, 'Karuwalagaswewa', '61314'),
(1622, 22, 'Katuneriya', '61180'),
(1623, 22, 'Koswatta', '61158'),
(1624, 22, 'Kottantivu', '61252'),
(1625, 22, 'Kottapitiya', '51244'),
(1626, 22, 'Kottukachchiya', '61532'),
(1627, 22, 'Kumarakattuwa', '61032'),
(1628, 22, 'Kurinjanpitiya', '61356'),
(1629, 22, 'Kuruketiyawa', '61516'),
(1630, 22, 'Lunuwila', '61150'),
(1631, 22, 'Madampe', '61230'),
(1632, 22, 'Madurankuliya', '61270'),
(1633, 22, 'Mahakumbukkadawala', '61272'),
(1634, 22, 'Mahauswewa', '61512'),
(1635, 22, 'Mampitiya', '51090'),
(1636, 22, 'Mampuri', '61341'),
(1637, 22, 'Mangalaeliya', '61266'),
(1638, 22, 'Marawila', '61210'),
(1639, 22, 'Mudalakkuliya', '61506'),
(1640, 22, 'Mugunuwatawana', '61014'),
(1641, 22, 'Mukkutoduwawa', '61274'),
(1642, 22, 'Mundel', '61250'),
(1643, 22, 'Muttibendiwila', '61195'),
(1644, 22, 'Nainamadama', '61120'),
(1645, 22, 'Nalladarankattuwa', '61244'),
(1646, 22, 'Nattandiya', '61190'),
(1647, 22, 'Nawagattegama', '61520'),
(1648, 22, 'Nelumwewa', '51096'),
(1649, 22, 'Norachcholai', '61342'),
(1650, 22, 'Pallama', '61040'),
(1651, 22, 'Palliwasalturai', '61354'),
(1652, 22, 'Panirendawa', '61234'),
(1653, 22, 'Parakramasamudraya', '51016'),
(1654, 22, 'Pothuwatawana', '61162'),
(1655, 22, 'Puttalam', '61300'),
(1656, 22, 'Puttalam Cement Factory', '61326'),
(1657, 22, 'Rajakadaluwa', '61242'),
(1658, 22, 'Saliyawewa Junction', '61324'),
(1659, 22, 'Serukele', '61042'),
(1660, 22, 'Siyambalagashene', '61504'),
(1661, 22, 'Tabbowa', '61322'),
(1662, 22, 'Talawila Church', '61344'),
(1663, 22, 'Toduwawa', '61224'),
(1664, 22, 'Udappuwa', '61004'),
(1665, 22, 'Uridyawa', '61502'),
(1666, 22, 'Vanathawilluwa', '61306'),
(1667, 22, 'Waikkal', '61110'),
(1668, 22, 'Watugahamulla', '61198'),
(1669, 22, 'Wennappuwa', '61170'),
(1670, 22, 'Wijeyakatupotha', '61006'),
(1671, 22, 'Wilpotha', '61008'),
(1672, 22, 'Yodaela', '51422'),
(1673, 22, 'Yogiyana', '61144'),
(1674, 23, 'Akarella', '70082'),
(1675, 23, 'Amunumulla', '90204'),
(1676, 23, 'Atakalanpanna', '70294'),
(1677, 23, 'Ayagama', '70024'),
(1678, 23, 'Balangoda', '70100'),
(1679, 23, 'Batatota', '70504'),
(1680, 23, 'Beralapanathara', '81541'),
(1681, 23, 'Bogahakumbura', '90354'),
(1682, 23, 'Bolthumbe', '70131'),
(1683, 23, 'Bomluwageaina', '70344'),
(1684, 23, 'Bowalagama', '82458'),
(1685, 23, 'Bulutota', '70346'),
(1686, 23, 'Dambuluwana', '70019'),
(1687, 23, 'Daugala', '70455'),
(1688, 23, 'Dela', '70042'),
(1689, 23, 'Delwala', '70046'),
(1690, 23, 'Dodampe', '70017'),
(1691, 23, 'Doloswalakanda', '70404'),
(1692, 23, 'Dumbara Manana', '70495'),
(1693, 23, 'Eheliyagoda', '70600'),
(1694, 23, 'Ekamutugama', '70254'),
(1695, 23, 'Elapatha', '70032'),
(1696, 23, 'Ellagawa', '70492'),
(1697, 23, 'Ellaulla', '70552'),
(1698, 23, 'Ellawala', '70606'),
(1699, 23, 'Embilipitiya', '70200'),
(1700, 23, 'Eratna', '70506'),
(1701, 23, 'Erepola', '70602'),
(1702, 23, 'Gabbela', '70156'),
(1703, 23, 'Gangeyaya', '70195'),
(1704, 23, 'Gawaragiriya', '70026'),
(1705, 23, 'Gillimale', '70002'),
(1706, 23, 'Godakawela', '70160'),
(1707, 23, 'Gurubewilagama', '70136'),
(1708, 23, 'Halwinna', '70171'),
(1709, 23, 'Handagiriya', '70106'),
(1710, 23, 'Hatangala', '70105'),
(1711, 23, 'Hatarabage', '70108'),
(1712, 23, 'Hewanakumbura', '90358'),
(1713, 23, 'Hidellana', '70012'),
(1714, 23, 'Hiramadagama', '70296'),
(1715, 23, 'Horewelagoda', '82456'),
(1716, 23, 'Ittakanda', '70342'),
(1717, 23, 'Kahangama', '70016'),
(1718, 23, 'Kahawatta', '70150'),
(1719, 23, 'Kalawana', '70450'),
(1720, 23, 'Kaltota', '70122'),
(1721, 23, 'Kalubululanda', '90352'),
(1722, 23, 'Kananke Bazaar', '80136'),
(1723, 23, 'Kandepuhulpola', '90356'),
(1724, 23, 'Karandana', '70488'),
(1725, 23, 'Karangoda', '70018'),
(1726, 23, 'Kella Junction', '70352'),
(1727, 23, 'Keppetipola', '90350'),
(1728, 23, 'Kiriella', '70480'),
(1729, 23, 'Kiriibbanwewa', '70252'),
(1730, 23, 'Kolambage Ara', '70180'),
(1731, 23, 'Kolombugama', '70403'),
(1732, 23, 'Kolonna', '70350'),
(1733, 23, 'Kudawa', '70005'),
(1734, 23, 'Kuruwita', '70500'),
(1735, 23, 'Lellopitiya', '70056'),
(1736, 23, 'Imaduwa', '80130'),
(1737, 23, 'Imbulpe', '70134'),
(1738, 23, 'Mahagama Colony', '70256'),
(1739, 23, 'Mahawalatenna', '70112'),
(1740, 23, 'Makandura', '70298'),
(1741, 23, 'Malwala Junction', '70001'),
(1742, 23, 'Malwatta', '32198'),
(1743, 23, 'Matuwagalagama', '70482'),
(1744, 23, 'Medagalature', '70021'),
(1745, 23, 'Meddekanda', '70127'),
(1746, 23, 'Minipura Dumbara', '70494'),
(1747, 23, 'Mitipola', '70604'),
(1748, 23, 'Moragala Kirillapone', '81532'),
(1749, 23, 'Morahela', '70129'),
(1750, 23, 'Mulendiyawala', '70212'),
(1751, 23, 'Mulgama', '70117'),
(1752, 23, 'Nawalakanda', '70469'),
(1753, 23, 'Nawinnapinnakanda', '70165'),
(1754, 23, 'Niralagama', '70038'),
(1755, 23, 'Nivitigala', '70400'),
(1756, 23, 'Omalpe', '70215'),
(1757, 23, 'Opanayaka', '70080'),
(1758, 23, 'Padalangala', '70230'),
(1759, 23, 'Pallebedda', '70170'),
(1760, 23, 'Pallekanda', '82454'),
(1761, 23, 'Pambagolla', '70133'),
(1762, 23, 'Panamura', '70218'),
(1763, 23, 'Panapola', '70461'),
(1764, 23, 'Paragala', '81474'),
(1765, 23, 'Parakaduwa', '70550'),
(1766, 23, 'Pebotuwa', '70045'),
(1767, 23, 'Pelmadulla', '70070'),
(1768, 23, 'Pinnawala', '70130'),
(1769, 23, 'Pothdeniya', '81538'),
(1770, 23, 'Rajawaka', '70116'),
(1771, 23, 'Ranwala', '70162'),
(1772, 23, 'Rassagala', '70135'),
(1773, 23, 'Rathgama', '80260'),
(1774, 23, 'Ratna Hangamuwa', '70036'),
(1775, 23, 'Ratnapura', '70000'),
(1776, 23, 'Sewanagala', '70250'),
(1777, 23, 'Sri Palabaddala', '70004'),
(1778, 23, 'Sudagala', '70502'),
(1779, 23, 'Thalakolahinna', '70101'),
(1780, 23, 'Thanjantenna', '70118'),
(1781, 23, 'Theppanawa', '70512'),
(1782, 23, 'Thunkama', '70205'),
(1783, 23, 'Udakarawita', '70044'),
(1784, 23, 'Udaniriella', '70034'),
(1785, 23, 'Udawalawe', '70190'),
(1786, 23, 'Ullinduwawa', '70345'),
(1787, 23, 'Veddagala', '70459'),
(1788, 23, 'Vijeriya', '70348'),
(1789, 23, 'Waleboda', '70138'),
(1790, 23, 'Watapotha', '70408'),
(1791, 23, 'Waturawa', '70456'),
(1792, 23, 'Weligepola', '70104'),
(1793, 23, 'Welipathayaya', '70124'),
(1794, 23, 'Wikiliya', '70114'),
(1795, 24, 'Agbopura', '31304'),
(1796, 24, 'Buckmigama', '31028'),
(1797, 24, 'China Bay', '31050'),
(1798, 24, 'Dehiwatte', '31226'),
(1799, 24, 'Echchilampattai', '31236'),
(1800, 24, 'Galmetiyawa', '31318'),
(1801, 24, 'Gomarankadawala', '31026'),
(1802, 24, 'Kaddaiparichchan', '31212'),
(1803, 24, 'Kallar', '30250'),
(1804, 24, 'Kanniya', '31032'),
(1805, 24, 'Kantalai', '31300'),
(1806, 24, 'Kantalai Sugar Factory', '31306'),
(1807, 24, 'Kiliveddy', '31220'),
(1808, 24, 'Kinniya', '31100'),
(1809, 24, 'Kuchchaveli', '31014'),
(1810, 24, 'Kumburupiddy', '31012'),
(1811, 24, 'Kurinchakerny', '31112'),
(1812, 24, 'Lankapatuna', '31234'),
(1813, 24, 'Mahadivulwewa', '31036'),
(1814, 24, 'Maharugiramam', '31106'),
(1815, 24, 'Mallikativu', '31224'),
(1816, 24, 'Mawadichenai', '31238'),
(1817, 24, 'Mullipothana', '31312'),
(1818, 24, 'Mutur', '31200'),
(1819, 24, 'Neelapola', '31228'),
(1820, 24, 'Nilaveli', '31010'),
(1821, 24, 'Pankulam', '31034'),
(1822, 24, 'Pulmoddai', '50567'),
(1823, 24, 'Rottawewa', '31038'),
(1824, 24, 'Sampaltivu', '31006'),
(1825, 24, 'Sampoor', '31216'),
(1826, 24, 'Serunuwara', '31232'),
(1827, 24, 'Seruwila', '31260'),
(1828, 24, 'Sirajnagar', '31314'),
(1829, 24, 'Somapura', '31222'),
(1830, 24, 'Tampalakamam', '31046'),
(1831, 24, 'Thuraineelavanai', '30254'),
(1832, 24, 'Tiriyayi', '31016'),
(1833, 24, 'Toppur', '31250'),
(1834, 24, 'Trincomalee', '31000'),
(1835, 24, 'Wanela', '31308'),
(1836, 25, 'Vavuniya', '43000'),
(1837, 5, 'Colombo 1', '00100'),
(1838, 5, 'Colombo 3', '00300'),
(1839, 5, 'Colombo 4', '00400'),
(1840, 5, 'Colombo 5', '00500'),
(1841, 5, 'Colombo 7', '00700'),
(1842, 5, 'Colombo 9', '00900'),
(1843, 5, 'Colombo 10', '01000'),
(1844, 5, 'Colombo 11', '01100'),
(1845, 5, 'Colombo 12', '01200'),
(1846, 5, 'Colombo 14', '01400'),
(1847, 5, 'Colombo Secretariant', '00110'),
(1848, 5, 'Melle Street', '00276'),
(1849, 5, 'Rifel Street', '00279'),
(1850, 5, 'Gem & Jewelry', '00370'),
(1851, 5, 'Torington Square', '00376'),
(1852, 5, 'National Museum of Colombo', '00377'),
(1853, 5, 'Colombo Labour Sec', '00510'),
(1854, 5, 'Polhengoda', '00576'),
(1855, 5, 'Anderson Plats', '00577'),
(1856, 5, 'Keppetipola Mawatha', '00579'),
(1857, 5, 'Narahenpita', '00582'),
(1858, 5, 'Kirulapana', '00677'),
(1859, 5, 'University of Colombo', '00710'),
(1860, 5, 'Colombo General Hospital', '00779'),
(1861, 5, 'Gothami Road', '00876'),
(1862, 5, 'Wanathamulla', '00877'),
(1863, 5, 'Baseline Road', '00878'),
(1864, 5, 'Kopiyawatta', '00879'),
(1865, 5, 'Maligawatta', '01070'),
(1866, 5, 'Panchikawatte', '01078'),
(1867, 5, 'Sarasavipaya', '01079'),
(1868, 5, 'Maligakanda', '01081'),
(1869, 5, 'Wolfendal Street', '01178'),
(1870, 5, 'Pettah Bus Stand', '01179'),
(1871, 5, 'Colombo Kachcheri', '01181'),
(1872, 5, 'Armour Street', '01182'),
(1873, 5, 'St. Anthony\'s', '01183'),
(1874, 5, 'Miraniya Street', '01276'),
(1875, 5, 'Wasala Road', '01377'),
(1876, 5, 'Nagalagam Street', '01476'),
(1877, 5, 'Aluth Mawatha Road', '01478'),
(1878, 5, 'Mutwal South', '01479'),
(1879, 5, 'Beddagana', '10101'),
(1880, 5, 'Madiwela', '10102'),
(1881, 5, 'Sri Perakumpura', '10103'),
(1882, 5, 'Mirihana North', '10104'),
(1883, 5, 'Nawala-Koswatte', '10105'),
(1884, 5, 'Nawala', '10106'),
(1885, 5, 'Rajagiriya', '10107'),
(1886, 5, 'Parliament of Sri Lanka', '10110'),
(1887, 5, 'Obeysekarapura', '10111'),
(1888, 5, 'Kalapaluwawa', '10112'),
(1889, 5, 'Talangama North', '10113'),
(1890, 5, 'Talangama South', '10114'),
(1891, 5, 'Jayawardhenegama', '10117'),
(1892, 5, 'Isurupaya', '10130'),
(1893, 5, 'Sethsiripaya', '10140'),
(1894, 5, 'Malabe', '10155'),
(1895, 5, 'Oruwala', '10201'),
(1896, 5, 'Panagoda Army Camp', '10203'),
(1897, 5, 'Magammana-Dolekade', '10207'),
(1898, 5, 'Homagama Town', '10209'),
(1899, 5, 'Godagama Junction', '10211'),
(1900, 5, 'Panagoda', '10213'),
(1901, 5, 'Galawilawaththa', '10217'),
(1902, 5, 'Kottawa', '10220'),
(1903, 5, 'Pelenwatta', '10231'),
(1904, 5, 'Arawwala West', '10233'),
(1905, 5, 'Kottawa North', '10235'),
(1906, 5, 'Rukmale-Pannipitiya', '10237'),
(1907, 5, 'Malapalla', '10239'),
(1908, 5, 'Mattegoda', '10240'),
(1909, 5, 'Mirihana', '10251'),
(1910, 5, 'Udahamulla', '10252'),
(1911, 5, 'Kohuwala', '10255'),
(1912, 5, 'Pamunuwa-Patiragoda', '10281'),
(1913, 5, 'Sudanapura', '10282'),
(1914, 5, 'Nawinna', '10283'),
(1915, 5, 'Vidyodaya University', '10284'),
(1916, 5, 'Pepiliyana', '10291'),
(1917, 5, 'Katuwawala', '10292'),
(1918, 5, 'Suwarapola', '10301'),
(1919, 5, 'Gorakapitiya', '10303'),
(1920, 5, 'Makandana', '10305'),
(1921, 5, 'Kesbewa', '10307'),
(1922, 5, 'Bokundara', '10309'),
(1923, 5, 'Kahathuduwa', '10321'),
(1924, 5, 'Ratmalana North', '10372'),
(1925, 5, 'Sirimal Uyana', '10373'),
(1926, 5, 'Ratmalana', '10390'),
(1927, 5, 'Koralawella', '10401'),
(1928, 5, 'Egodauyana North', '10402'),
(1929, 5, 'Egodauyana South', '10403'),
(1930, 5, 'Indibedda', '10404'),
(1931, 5, 'Moratumulla', '10405'),
(1932, 5, 'Rawathawatta', '10406'),
(1933, 5, 'Willorawatta', '10407'),
(1934, 5, 'Lunawa', '10408'),
(1935, 5, 'Laksapatiya', '10409'),
(1936, 5, 'Angulana', '10411'),
(1937, 5, 'Kaldemulla', '10413'),
(1938, 5, 'Katubedda', '10414'),
(1939, 5, 'Liyanwala', '10501'),
(1940, 5, 'Poregedara', '10503'),
(1941, 5, 'Dampe', '10505'),
(1942, 5, 'Malagala', '10507'),
(1943, 5, 'Meepe Junction', '10509'),
(1944, 5, 'Pinnawala-Waga', '10515'),
(1945, 5, 'Angampitiya', '10517'),
(1946, 5, 'Arukwathupura', '10519'),
(1947, 5, 'Kandanapitiya', '10523'),
(1948, 5, 'Gurulana', '10527'),
(1949, 5, 'Udugamkanda', '10529'),
(1951, 7, 'Wattala', '11300'),
(1952, 2, 'Bulnewa', '50172'),
(1953, 2, 'Kebithigollewa', '50550'),
(1974, 16, 'Madipola', '21156'),
(1975, 17, 'Karatota', '81308'),
(1976, 8, 'Gangulandeniya', '82506'),
(1977, 3, 'Idalgashinna', '90167'),
(1978, 9, 'Allaipiddi', '40048'),
(1979, 9, 'Allaveddi', '40120'),
(1980, 9, 'Alvai', '40635'),
(1981, 9, 'Anaikoddai', '40198'),
(1982, 9, 'Analaitivu', '40280'),
(1983, 9, 'Araly', '40221'),
(1984, 9, 'Atchuveli', '40150'),
(1985, 9, 'Chankanai', '40212'),
(1986, 9, 'Chavakachcheri', '40500'),
(1987, 9, 'Chullipuram', '40230'),
(1988, 9, 'Chundikuli', '40020'),
(1989, 9, 'Chunnakam', '40075'),
(1990, 9, 'Delft West', '40378'),
(1991, 9, 'Delft', '40370'),
(1992, 9, 'Eluvaitivu', '40275'),
(1993, 9, 'Erialai', '40080'),
(1994, 9, 'Ilavalai', '40108'),
(1995, 9, 'Kankesanthurai', '40190'),
(1996, 9, 'Karainagar', '40250'),
(1997, 9, 'Karaveddi', '40520'),
(1998, 9, 'Kayts', '40270'),
(1999, 9, 'Kodikamam', '40700'),
(2000, 9, 'Kokuvil', '40060'),
(2001, 9, 'Kondavil', '40062'),
(2002, 9, 'Kopay', '40170'),
(2003, 9, 'Kudatanai', '40620'),
(2004, 9, 'Mallakam', '40142'),
(2005, 9, 'Mandaitivu', '40045'),
(2006, 9, 'Manipay', '40200'),
(2007, 9, 'Mathagal', '40110'),
(2008, 9, 'Meesalai', '40510'),
(2009, 9, 'Mahiyampathy', NULL),
(2010, 9, 'Mirusuvil', '40750'),
(2011, 9, 'Nagarkovil', '40630'),
(2012, 9, 'Nagendramadam', '40223'),
(2013, 9, 'Nainathivu', '40360'),
(2014, 9, 'Neervely', '40165'),
(2015, 9, 'Pandaterippu', '40100'),
(2016, 9, 'Point Pedro', '40600'),
(2017, 9, 'Puloly', '40615'),
(2018, 9, 'Pungudutivu', '40330'),
(2019, 9, 'Puttur', '40158'),
(2020, 9, 'Sandilipay', '40098'),
(2021, 9, 'Sangarathai', '40225'),
(2022, 9, 'Sithankerny', '40229'),
(2023, 9, 'Sivankovilady', '40227'),
(2024, 9, 'Thellippallai', '40130'),
(2025, 9, 'Thondamanaru', '40545'),
(2026, 9, 'Urumpirai', '40180'),
(2027, 9, 'Vaddukoddai', '40220'),
(2028, 9, 'Valvettithurai', '40540'),
(2029, 9, 'Varany', '40640'),
(2030, 9, 'Vasavilan', '40145'),
(2031, 9, 'Velanai', '40300'),
(2032, 9, 'Gurunagar', NULL),
(2033, 9, 'Kaitadi', NULL),
(2034, 9, 'Nallur', NULL),
(2035, 9, 'Thirunelvely', NULL),
(2036, 9, 'Vannarponnai', NULL),
(2037, 13, 'Akkarayankulam', '42640'),
(2038, 13, 'Aliyawalai', '42565'),
(2039, 13, 'Chempiyanpattu', '42560'),
(2040, 13, 'Elephant Pass', '42510'),
(2041, 13, 'Eluthumadduval', '42580'),
(2042, 13, 'Iranaitiv', '42630'),
(2043, 13, 'Iyyakachchi', '42520'),
(2044, 13, 'Kavutharimunai', '42608'),
(2045, 13, 'Konavil', '42645'),
(2046, 13, 'Mulliyan', '42570'),
(2047, 13, 'Murasumoddai', '42505'),
(2048, 13, 'Pallavarayankaddu', '42615'),
(2049, 13, 'Paranthan', '42500'),
(2050, 13, 'Puliyampokkanai', '42509'),
(2051, 13, 'Punakari-Nallur', '42606'),
(2052, 13, 'Ramanathapuram', '42408'),
(2053, 13, 'Sivapuram', '42618'),
(2054, 13, 'Skanthapuram', '42638'),
(2055, 13, 'Thalaiyadi', '42563'),
(2056, 13, 'Tharmapuram', '42512'),
(2057, 13, 'Uruthirapuram', '42502'),
(2058, 13, 'Vaddakachchi', '42405'),
(2059, 13, 'Vannerikkulam', '42635'),
(2060, 13, 'Veravil', '42620'),
(2061, 13, 'Vinayagapuram', '42625'),
(2063, 13, 'Ambalnagar', NULL),
(2064, 13, 'Cheddiyakurichchi', NULL),
(2065, 13, 'Chundikulam', NULL),
(2066, 13, 'Kalmadunagar', NULL),
(2067, 13, 'Karadipokku', NULL),
(2068, 13, 'Kilay', NULL),
(2069, 13, 'Kunchuparanthan', NULL),
(2070, 13, 'Muhamalai', NULL),
(2071, 13, 'Pallai', '42550'),
(2072, 13, 'Sivanagar', NULL),
(2073, 13, 'Soranpattu', NULL),
(2074, 13, 'Thirunagar', NULL),
(2075, 13, 'Thiruvaiaru', NULL),
(2076, 19, 'Alampil', '42005'),
(2077, 19, 'Karuppaddamurippu', '42220'),
(2078, 19, 'Mankulam', '42300'),
(2079, 19, 'Mullivaikkal', '42540'),
(2080, 19, 'Mulliyawalai', '42100'),
(2081, 19, 'Muththaiyankaddukulam', '42210'),
(2082, 19, 'Naddankandal', '42308'),
(2083, 19, 'Oddusudan', '42200'),
(2084, 19, 'Puthukkudiyiruppu', '42530'),
(2085, 19, 'Puthuvedduvan', '42330'),
(2086, 19, 'Thunukkai', '42320'),
(2087, 19, 'Udayarkaddu', '42518'),
(2088, 19, 'Vavunakkulam', '42305'),
(2089, 19, 'Visvamadukulam', '42515'),
(2090, 19, 'Yogapuram', '42315'),
(2091, 19, 'Ampalavanpokkanai', NULL),
(2092, 19, 'Ananthapuram', NULL),
(2093, 19, 'Ethawetunuwewa', '50584'),
(2094, 19, 'Kokkilai', NULL),
(2095, 19, 'Kokkuthuoduvai', NULL),
(2096, 19, 'Kumulamunai', NULL),
(2097, 19, 'Mullathivu', '42000'),
(2098, 19, 'Murukandy', NULL),
(2099, 19, 'Welioya', '50586'),
(2116, 25, 'Nedunkerny', '42250'),
(2117, 25, 'Neriyakulam', '43300'),
(2135, 25, 'Alagalla', NULL),
(2136, 25, 'Andiyapuliyankulam', NULL),
(2137, 25, 'Asikulam', NULL),
(2138, 25, 'Cheddikulam', NULL),
(2139, 25, 'Chemamadukulam', NULL),
(2140, 25, 'Iranai lluppaikulam', NULL),
(2141, 25, 'Kalmadhu', NULL),
(2142, 25, 'Iratta Periyakulama', NULL),
(2143, 25, 'Kanagarayankulam', NULL),
(2144, 25, 'Kannaddi', NULL),
(2145, 25, 'Kela Bogaswewa', NULL),
(2146, 25, 'Kovilkulam', NULL),
(2147, 25, 'Madukanda', NULL),
(2148, 25, 'Mahakachchakodiya', NULL),
(2149, 25, 'Mamaduwa', NULL),
(2150, 25, 'Maradammaduwa', NULL),
(2151, 25, 'Maraiyadithakulam', NULL),
(2152, 25, 'Maruthodai', NULL),
(2153, 25, 'Mathavuvaithakulam', NULL),
(2154, 25, 'Nainamadu', NULL),
(2155, 25, 'Nelukkulam', NULL),
(2156, 25, 'Nochchimoddai', NULL),
(2157, 25, 'Omanthai', NULL),
(2158, 25, 'Palamoddai', NULL),
(2159, 25, 'Pampaimadu', NULL),
(2160, 25, 'Pavakkulama Unit 1', NULL),
(2161, 25, 'Pavakkulama Unit 2', NULL),
(2162, 25, 'Periyathambanai', NULL),
(2163, 25, 'Periya Ulukkulama', NULL),
(2164, 25, 'Poovarasankulam', NULL),
(2165, 25, 'Puliyankulam', NULL),
(2166, 25, 'Sathirikulankulam', NULL),
(2167, 25, 'Sinnasippikulam', NULL),
(2168, 25, 'Thandikulam', NULL),
(2169, 25, 'Vaarikkuttiyoor', NULL),
(2172, 15, 'Aandankulam', NULL),
(2173, 15, 'Adampan', NULL),
(2174, 15, 'Arippu', NULL),
(2175, 15, 'Athimottai', NULL),
(2176, 15, 'Chilavathurai', NULL),
(2177, 15, 'Erukkalampiddy', NULL),
(2178, 15, 'Illuppaikadavai', NULL),
(2179, 15, 'Karisal', NULL),
(2180, 15, 'Kokkupadayan', NULL),
(2181, 15, 'Madhu Church', NULL),
(2182, 15, 'Madhu Road', NULL),
(2183, 15, 'Marichchikaddi', NULL),
(2184, 15, 'Mullikulam', NULL),
(2185, 15, 'Murunkan', NULL),
(2186, 15, 'Nanattan', NULL),
(2187, 15, 'Palampiddy', NULL),
(2188, 15, 'Pallimunai', NULL),
(2189, 15, 'Pandaraveli', NULL),
(2190, 15, 'Pappamoddai', NULL),
(2191, 15, 'Parappankandal', NULL),
(2192, 15, 'Parappukadanthan', NULL),
(2193, 15, 'Periyakunchikulam', NULL),
(2194, 15, 'Periyamadhu', NULL),
(2195, 15, 'Periyapandivirichchan', NULL),
(2196, 15, 'Pesalai', NULL),
(2197, 15, 'Potkerny', NULL),
(2198, 15, 'Puthuveli', NULL),
(2199, 15, 'Sooriyakaddaikadhu', NULL),
(2200, 15, 'Thalaimannar', NULL),
(2201, 15, 'Thalaimannar Pier', NULL),
(2202, 15, 'Thalaimannar West', NULL),
(2203, 15, 'Thalvupadu', NULL),
(2204, 15, 'Tharapuram', NULL),
(2205, 15, 'Thiruketheeswaram', NULL),
(2206, 15, 'Uyilankulam', NULL),
(2207, 15, 'Uyirtharasankulam', NULL),
(2208, 15, 'Vaddakandal', NULL),
(2209, 15, 'Vankalai', NULL),
(2210, 15, 'Vellankulam', NULL),
(2211, 15, 'Veppankulam', NULL),
(2212, 15, 'Vidataltivu', NULL),
(2213, 7, 'Mabola', '11104');

-- --------------------------------------------------------

--
-- Table structure for table `company_contact_info`
--

CREATE TABLE `company_contact_info` (
  `admin_id` int(11) UNSIGNED DEFAULT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook_url` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `daraz` text DEFAULT NULL,
  `whastapp` text DEFAULT NULL,
  `youtube` text DEFAULT NULL,
  `tele_number1` varchar(10) NOT NULL,
  `tele_number2` varchar(10) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `company_contact_info`
--

INSERT INTO `company_contact_info` (`admin_id`, `address1`, `address2`, `city`, `email`, `facebook_url`, `instagram`, `daraz`, `whastapp`, `youtube`, `tele_number1`, `tele_number2`, `date_created`, `date_modified`) VALUES
(1, '572', 'Siyambalape Road', 'Heyiyanthuduwawa', 'contact@sola.com', 'https://web.facebook.com/SolaChemicalCompany/', 'https://www.instagram.com/solachemicals/', 'https://www.daraz.lk/shop/sola-chemicals/', '0776123525', 'https://www.youtube.com/@SolaChemicals-dz7fg', '0776123525', NULL, '2025-01-21 13:57:21', '2025-01-21 14:13:31'),
(1, '572', 'Siyambalape Road', 'Heyiyanthuduwawa', 'contact@sola.com', 'https://web.facebook.com/SolaChemicalCompany/', 'https://www.instagram.com/solachemicals/', 'https://www.daraz.lk/shop/sola-chemicals/', '0776123525', 'https://www.youtube.com/@SolaChemicals-dz7fg', '0776123525', NULL, '2025-01-21 13:57:21', '2025-01-21 14:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_method`
--

CREATE TABLE `delivery_method` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `days` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'the days spending for delivery',
  `fee` decimal(10,2) NOT NULL
) ;

--
-- Dumping data for table `delivery_method`
--

INSERT INTO `delivery_method` (`id`, `name`, `days`, `fee`) VALUES
(1, 'sola courier', 5, 100.00),
(2, 'express courier', 1, 500.00),
(3, 'sola hotpress', 1, 600.00),
(4, 'saman courier', 3, 400.00),
(5, 'line courirer', 4, 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `province_id` int(11) DEFAULT NULL,
  `name_en` varchar(45) DEFAULT NULL
) ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `province_id`, `name_en`) VALUES
(1, 6, 'Ampara'),
(2, 8, 'Anuradhapura'),
(3, 7, 'Badulla'),
(4, 6, 'Batticaloa'),
(5, 1, 'Colombo'),
(6, 3, 'Galle'),
(7, 1, 'Gampaha'),
(8, 3, 'Hambantota'),
(9, 9, 'Jaffna'),
(10, 1, 'Kalutara'),
(11, 2, 'Kandy'),
(12, 5, 'Kegalle'),
(13, 9, 'Kilinochchi'),
(14, 4, 'Kurunegala'),
(15, 9, 'Mannar'),
(16, 2, 'Matale'),
(17, 3, 'Matara'),
(18, 7, 'Monaragala'),
(19, 9, 'Mullaitivu'),
(20, 2, 'Nuwara Eliya'),
(21, 8, 'Polonnaruwa'),
(22, 4, 'Puttalam'),
(23, 5, 'Ratnapura'),
(24, 6, 'Trincomalee'),
(25, 9, 'Vavuniya');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `asnwer` text NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `title`, `asnwer`, `admin_id`, `date_created`, `date_modified`) VALUES
(1, 'What products does your company offer', 'We provide a range of soap chemicals, including surfactants, fatty acids, essential oils, fragrances, and specialty additives for personal care, household, and industrial applications.', 1, '2025-01-21 14:27:00', '2025-01-21 14:27:00'),
(2, 'Do you offer custom formulations?', 'Yes, we offer custom formulations tailored to your specific requirements. Please contact our sales team for more details.', 2, '2025-01-21 14:27:32', '2025-01-21 14:28:52'),
(3, ' Are your products eco-friendly?', 'We provide a range of environmentally friendly and biodegradable products. Please refer to the product descriptions for detailed information.', 1, '2025-01-21 14:27:59', '2025-01-21 14:28:42'),
(4, 'How can I place an order?', 'You can place an order through our website by filling out the order form or contacting our sales team directly.\n\n', 1, '2025-01-21 14:28:15', '2025-01-21 14:28:43'),
(5, 'What is your minimum order quantity (MOQ)?', 'The MOQ varies depending on the product. Please check the product details or contact us for specific information.', 2, '2025-01-21 14:28:37', '2025-01-21 14:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `status` binary(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `comment`, `status`, `date_created`) VALUES
(1, 1, 'Great product! It worked exactly as described and arrived on time', 0x30, '2025-01-21 14:29:38'),
(2, 2, 'Amazing quality! Definitely will buy again.', 0x30, '2025-01-21 14:29:55'),
(3, 4, 'Amazing experience from start to finish. Thank you!', 0x30, '2025-01-21 14:30:13'),
(4, 2, 'Happy with my purchase! ItÃ¢â‚¬â„¢s exactly what I needed.', 0x30, '2025-01-21 14:30:36'),
(5, 4, 'Excellent product. It exceeded my expectations!', 0x30, '2025-01-21 14:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(18) NOT NULL DEFAULT '' COMMENT 'unique( ).ext , unique( ) exist 13 chars, ''.'' and extension of image file',
  `category_id` smallint(5) UNSIGNED DEFAULT NULL,
  `QoH` smallint(5) UNSIGNED NOT NULL COMMENT 'Available quantity amount',
  `UP` decimal(8,2) UNSIGNED NOT NULL COMMENT 'Price of the product',
  `discount_rate` decimal(5,2) UNSIGNED ZEROFILL DEFAULT NULL,
  `availability` binary(1) NOT NULL,
  `delivery_method_id` smallint(5) UNSIGNED DEFAULT NULL,
  `views` bigint(20) UNSIGNED DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `image`, `category_id`, `QoH`, `UP`, `discount_rate`, `availability`, `delivery_method_id`, `views`, `date_created`, `date_modified`) VALUES
(1, 'Orange Hand Wash 4L', '', 2, 2, 1600.00, NULL, 0x31, NULL, 0, '2025-01-21 14:46:38', '2025-01-22 17:51:57'),
(2, 'Mango Hand Wash', '', 2, 9, 1600.00, NULL, 0x31, NULL, 0, '2025-01-21 14:47:55', '2025-01-22 16:55:10'),
(3, 'Confident Hand Sanitizer', '', 2, 23, 3600.00, NULL, 0x31, NULL, 0, '2025-01-21 14:56:04', '2025-01-22 16:56:00'),
(4, 'Uphostery Carpet Cleaner 4L', '', 1, 0, 1600.00, NULL, 0x30, NULL, 0, '2025-01-21 14:56:30', '2025-01-21 14:57:20'),
(5, 'Carwash Shampoo', '', 1, 1, 980.00, NULL, 0x31, NULL, 0, '2025-01-21 14:57:59', '2025-01-22 16:55:25');

--
-- Triggers `item`
--
DELIMITER $$
CREATE TRIGGER `item_before_update update availability of items` BEFORE UPDATE ON `item` FOR EACH ROW BEGIN
    IF NEW.QoH < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'This is internal issue. Contact administrators via contacts';
    ELSEIF NEW.QoH > 0 THEN
        SET NEW.availability = 1;
    ELSE
        SET NEW.availability = 0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `news_and_events`
--

CREATE TABLE `news_and_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(18) DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `article_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `likes` binary(1) NOT NULL DEFAULT '0',
  `dislikes` binary(1) NOT NULL DEFAULT '0',
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status` binary(1) NOT NULL DEFAULT '0' COMMENT 'To implement show/hide the article',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `daet_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_published` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `news_and_events`
--

INSERT INTO `news_and_events` (`id`, `image`, `admin_id`, `article_title`, `content`, `likes`, `dislikes`, `views`, `status`, `date_created`, `daet_modified`, `date_published`) VALUES
(7, 'Yj3Kd9f7XqL5.jpg', 1, 'Benefits of Eco-Friendly Detergents', 'Learn why eco-friendly detergents are better for the environment and your health.', 0x30, 0x30, 0, 0x30, '2025-01-23 13:20:35', '2025-01-23 13:20:35', NULL),
(8, 'Hk9Lt3Xb7MnP.jpg', 2, 'The Science Behind Soaps', 'Explore how soaps work to remove grease and grime effectively.', 0x30, 0x30, 0, 0x30, '2025-01-23 13:20:35', '2025-01-23 13:20:35', NULL),
(9, 'Qw4Nr8Vg3XpK.jpg', 3, 'Choosing the Right Cleaning Products', 'Understand the differences between soaps, detergents, and disinfectants.', 0x30, 0x30, 0, 0x30, '2025-01-23 13:20:35', '2025-01-23 13:20:35', NULL),
(10, 'Ax3Lq9Tn6RpJ.jpg', 4, 'Top Detergents for Sensitive Skin', 'A review of detergents specially formulated for sensitive skin types.', 0x30, 0x30, 0, 0x30, '2025-01-23 13:20:35', '2025-01-23 13:20:35', NULL),
(11, 'Zp8Kv3Wr6XlN.jpg', 5, 'How Detergents Impact the Environment', 'A deep dive into the environmental effects of detergent usage.', 0x30, 0x30, 0, 0x30, '2025-01-23 13:20:35', '2025-01-23 13:20:35', NULL),
(12, 'Gr9Lp7Wn3XkQ.jpg', 2, 'Innovations in Soap Manufacturing', 'Discover the latest trends and innovations in soap production.', 0x30, 0x30, 0, 0x30, '2025-01-23 13:20:35', '2025-01-23 13:20:35', NULL);

--
-- Triggers `news_and_events`
--
DELIMITER $$
CREATE TRIGGER `news_and_events_before_insert` BEFORE INSERT ON `news_and_events` FOR EACH ROW BEGIN
	IF NEW.status = 1 THEN
		SET NEW.date_published = CURRENT_TIMESTAMP();
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'the workers''id who viewed the notification ',
  `order_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'when the notification is about order',
  `public_contact_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'when someone create a contact request via user site''s contact form',
  `message` text DEFAULT NULL,
  `status` binary(1) NOT NULL DEFAULT '0' COMMENT 'to know, did someone view this notification',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `accessed_date` timestamp NULL DEFAULT NULL COMMENT 'auto triggered to set timestamp when set the status as 1'
) ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `admin_id`, `order_id`, `public_contact_id`, `message`, `status`, `date_created`, `accessed_date`) VALUES
(1, NULL, 1, NULL, 'New order is placed.', 0x30, '2025-01-22 18:28:20', NULL),
(2, 4, 4, NULL, 'New order is placed', 0x31, '2025-01-22 18:29:44', NULL),
(3, NULL, NULL, 1, 'New feedback is added', 0x30, '2025-01-22 18:31:12', NULL),
(4, 1, 1, NULL, 'New order is placed.', 0x30, '2025-01-22 18:31:50', NULL),
(5, 5, 1, NULL, 'New order is placed.', 0x30, '2025-01-22 18:42:07', NULL);

--
-- Triggers `notification`
--
DELIMITER $$
CREATE TRIGGER `notification_before_insert updated update last accessed` BEFORE INSERT ON `notification` FOR EACH ROW BEGIN
IF NEW.status = 1 THEN
SET NEW.accessed_date = CURRENT_TIMESTAMP();
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL,
  `delivery_method_id` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'set the order_method_id if already assigned in the item table, if not order_method shouldn''t be empty.',
  `status` binary(1) NOT NULL DEFAULT '0' COMMENT 'set 1  for deliverd and otherwise 0',
  `total` decimal(8,2) NOT NULL DEFAULT 0.00 COMMENT 'total must calculate in server side to increase the availability of the database',
  `delivered_date` timestamp NULL DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `item_id`, `user_id`, `quantity`, `delivery_method_id`, `status`, `total`, `delivered_date`, `description`, `date_created`, `date_modified`) VALUES
(1, 5, 1, 12, 2, 0x30, 0.00, NULL, NULL, '2025-01-21 15:27:48', '2025-01-21 15:27:48'),
(4, 1, 4, 5, 1, 0x30, 0.00, NULL, NULL, '2025-01-21 16:43:20', '2025-01-21 16:43:20'),
(5, 2, 4, 1, 5, 0x30, 0.00, NULL, NULL, '2025-01-21 18:00:35', '2025-01-21 18:00:35'),
(6, 3, 1, 20, 4, 0x30, 0.00, NULL, NULL, '2025-01-22 16:56:00', '2025-01-22 16:56:00'),
(7, 1, 3, 5, 1, 0x30, 0.00, NULL, NULL, '2025-01-22 17:51:57', '2025-01-22 17:51:57');

--
-- Triggers `order`
--
DELIMITER $$
CREATE TRIGGER `order_after_insert update item stock` AFTER INSERT ON `order` FOR EACH ROW BEGIN
    DECLARE available_amount INT;
    SELECT item.QoH INTO available_amount
    FROM item
    WHERE item.id = NEW.item_id;
    IF NEW.quantity <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'System error. Contact your admin via contacts.';
    ELSEIF NEW.quantity > available_amount THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Not enough stock available for this item.';
    ELSE
        UPDATE item
        SET QoH = available_amount - NEW.quantity
        WHERE id = NEW.item_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `order_before_insert avalidity check` BEFORE INSERT ON `order` FOR EACH ROW BEGIN
    DECLARE availability BOOLEAN;
    DECLARE available_amount INT;
    
    SELECT item.availability, item.QoH INTO availability, available_amount
    FROM item
    WHERE item.id = NEW.item_id;
    IF availability = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'This item is currently unavailable.';
    ELSEIF NEW.quantity > available_amount THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Not enough stock available for this item.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `transaction` varchar(50) DEFAULT NULL,
  `Placed_date` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT NULL
) ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `payment_method`, `transaction`, `Placed_date`, `status`) VALUES
(1, 1, 'By Debit card', NULL, '2025-01-22 18:43:48', NULL),
(2, 4, 'Succcefful payment', NULL, '2025-01-22 18:44:21', NULL),
(3, 5, 'Succeddfull payment', NULL, '2025-01-22 18:45:36', NULL),
(4, 6, 'Payment is declined', NULL, '2025-01-22 18:47:30', NULL),
(5, 7, 'Unsucceddful payment.', NULL, '2025-01-22 18:48:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `name_en` varchar(45) NOT NULL
) ;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `name_en`) VALUES
(1, 'Western'),
(2, 'Central'),
(3, 'Southern'),
(4, 'North Western'),
(5, 'Sabaragamuwa'),
(6, 'Eastern'),
(7, 'Uva'),
(8, 'North Central'),
(9, 'Northern');

-- --------------------------------------------------------

--
-- Table structure for table `public_contact`
--

CREATE TABLE `public_contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` binary(1) NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `public_contact`
--

INSERT INTO `public_contact` (`id`, `name`, `email`, `message`, `date_created`, `status`) VALUES
(1, 'Renuka Shehan', 'renukashehan@gmail.com', 'Hi!', '2025-01-21 13:51:55', 0x30),
(2, 'Sasidu Gamage', 'sasaidu@nest.club', 'Hello!', '2025-01-21 13:52:28', 0x30),
(3, 'Renuka Shehan', 'renuka@gmail.com', 'Plz reply', '2025-01-21 13:53:03', 0x30),
(4, 'Kalana Tharusha', 'kalana@gmail.com', 'Best service!', '2025-01-21 13:54:01', 0x30),
(5, 'Pwan Madusanka', 'pawan@gmail.com', 'HeyÃ°Å¸ËœÂ!', '2025-01-21 13:54:44', 0x30);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `image` varchar(18) NOT NULL COMMENT 'add unique( ).ext , unique( ) exist 13 chars, ''.'' and extension of image file',
  `gender` char(1) NOT NULL COMMENT 'm for mail , f for femail,  o for others & n for not prefered to say',
  `birth_date` date NOT NULL COMMENT 'YYYY-MM-DD format',
  `password` varchar(60) NOT NULL COMMENT 'using hash bcrypt',
  `email` varchar(255) NOT NULL,
  `registered_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NULL DEFAULT current_timestamp(),
  `last_visited` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `image`, `gender`, `birth_date`, `password`, `email`, `registered_date`, `date_modified`, `last_visited`) VALUES
(1, 'Mithila', 'Prabashwara', '', '1', '2001-10-07', '$2y$10$esz4viBudShpLzERyDjqLu/ZL/pRa0pWxtkIxAdxxpnMjwY6DY1Jm', 'mithila@135', '2025-01-19 17:09:30', '2025-01-19 17:09:30', '2025-01-26 21:17:06'),
(2, 'Chathun', 'Mihiranga', '', '1', '2002-01-19', '$2y$10$cKiG/kGumcaqQa0DThsdx.Sm3WsIiJ3NC/vFLJGcVYectAcczVa5u', 'mihiranga@gmail.com', '2025-01-19 17:10:33', '2025-01-19 17:11:22', '2025-01-26 20:50:20'),
(3, 'Chamal', 'Jayasuria', '', '1', '2002-01-19', '$2y$10$yBAyoUhMR9QMV.0Ri3owq.v2lnyHKb9/lzwkfo.g9zHhzvj8juFva', 'chamal@gmail.com', '2025-01-19 17:11:03', '2025-01-19 17:11:32', '2025-01-26 20:50:20'),
(4, 'Chamod', 'Abethunga', '', '1', '1999-02-19', '$2y$10$HmImc1fzOJbsfQCzAs3BGuhsUXhUm3YjoEAFOvo9oJojNmfdPOkKK', 'chamod@gmail.com', '2025-01-19 17:12:58', '2025-01-19 17:12:58', '2025-01-26 20:50:20'),
(5, 'Tharushika', 'Dilshan', '', '1', '2001-04-01', '$2y$10$qmlsxB8uFEVhL5XgQ/XM4uHqRN2GIYzzeDjn1qeePzaETQx.WWf3u', 'tharukshila@gmail.com', '2025-01-19 17:14:22', '2025-01-19 17:15:55', '2025-01-26 20:50:21'),
(6, 'Thakshila', 'Dilshan', '', '1', '0000-00-00', '$2y$10$f55q/.CEMfn6YCts7nEF5.hzzrupLzM2c.EuKeqBRcbaQhpcKmJeC', 'thakshila@135', '2025-01-19 17:15:32', '2025-01-19 17:15:32', '2025-01-26 20:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `postal_code` varchar(5) NOT NULL,
  `city_id` int(11) DEFAULT NULL
) ;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_id`, `address1`, `address2`, `postal_code`, `city_id`) VALUES
(1, 'No: 195/2', 'Akkara 7, 41 Halpe', '11200', 539),
(2, 'No:19/A', 'Mihidu Mawatha', '11230', 694),
(6, 'ANo:12/A', 'Palapitigama', '11212', 539),
(3, 'No:12/2', 'Police Hostel', '11111', 362),
(4, 'No:134/B', 'Maligathanna', '11212', 742),
(1, 'No: 195/2', 'Akkara 7, 41 Halpe', '11200', 539),
(2, 'No:19/A', 'Mihidu Mawatha', '11230', 694),
(6, 'ANo:12/A', 'Palapitigama', '11212', 539),
(3, 'No:12/2', 'Police Hostel', '11111', 362),
(4, 'No:134/B', 'Maligathanna', '11212', 742);

-- --------------------------------------------------------

--
-- Table structure for table `user_telephone`
--

CREATE TABLE `user_telephone` (
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `telephone1` varchar(10) NOT NULL,
  `telephone2` varchar(10) DEFAULT NULL
) ;

--
-- Dumping data for table `user_telephone`
--

INSERT INTO `user_telephone` (`user_id`, `telephone1`, `telephone2`) VALUES
(1, '0771111111', NULL),
(6, '0785874395', '0778451203'),
(3, '0748512045', NULL),
(4, '0774852457', NULL),
(5, '0712458963', NULL),
(1, '0771111111', NULL),
(6, '0785874395', '0778451203'),
(3, '0748512045', NULL),
(4, '0774852457', NULL),
(5, '0712458963', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tele_number` (`tele_number`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD KEY `FK_banner_admin` (`admin_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_branch_city` (`city_id`),
  ADD KEY `FK_branch_admin` (`admin_id`);

--
-- Indexes for table `branch_telephone`
--
ALTER TABLE `branch_telephone`
  ADD UNIQUE KEY `number1` (`number1`),
  ADD KEY `FK__branch` (`branch_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_cart_user` (`user_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_cart_items_cart` (`cart_id`),
  ADD KEY `FK_cart_items_item` (`item_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_city_district` (`district_id`);

--
-- Indexes for table `company_contact_info`
--
ALTER TABLE `company_contact_info`
  ADD KEY `FK_company_contact_info_admin` (`admin_id`);

--
-- Indexes for table `delivery_method`
--
ALTER TABLE `delivery_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinces_id` (`province_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_faq_admin` (`admin_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_feedback_user` (`user_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `FK_item_category` (`category_id`),
  ADD KEY `FK_item_order_method` (`delivery_method_id`);

--
-- Indexes for table `news_and_events`
--
ALTER TABLE `news_and_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_news_&_events_admin` (`admin_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_notification_admin` (`admin_id`),
  ADD KEY `FK_notification_order` (`order_id`),
  ADD KEY `FK_notification_public_contact` (`public_contact_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_order_item` (`item_id`),
  ADD KEY `FK_order_user` (`user_id`),
  ADD KEY `FK_order_delivery_method` (`delivery_method_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_payment_order` (`order_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_contact`
--
ALTER TABLE `public_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD KEY `FK_address_user` (`user_id`),
  ADD KEY `FK_address_city` (`city_id`);

--
-- Indexes for table `user_telephone`
--
ALTER TABLE `user_telephone`
  ADD KEY `FK_user_telephone_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_method`
--
ALTER TABLE `delivery_method`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_and_events`
--
ALTER TABLE `news_and_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `public_contact`
--
ALTER TABLE `public_contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `FK_banner_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `FK_branch_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_branch_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `branch_telephone`
--
ALTER TABLE `branch_telephone`
  ADD CONSTRAINT `FK__branch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_cart_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `FK_cart_items_cart` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_cart_items_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `FK_city_district` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `company_contact_info`
--
ALTER TABLE `company_contact_info`
  ADD CONSTRAINT `FK_company_contact_info_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `fk_districts_provinces1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`);

--
-- Constraints for table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `FK_faq_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `FK_feedback_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_item_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_item_order_method` FOREIGN KEY (`delivery_method_id`) REFERENCES `delivery_method` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news_and_events`
--
ALTER TABLE `news_and_events`
  ADD CONSTRAINT `FK_news_&_events_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_notification_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_notification_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_notification_public_contact` FOREIGN KEY (`public_contact_id`) REFERENCES `public_contact` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_order_delivery_method` FOREIGN KEY (`delivery_method_id`) REFERENCES `delivery_method` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_order_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_payment_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `FK_address_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_address_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_telephone`
--
ALTER TABLE `user_telephone`
  ADD CONSTRAINT `FK_user_telephone_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
