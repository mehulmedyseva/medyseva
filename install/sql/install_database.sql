-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 11:36 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doxe_13`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_advises`
--

CREATE TABLE `additional_advises` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `advises`
--

CREATE TABLE `advises` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `advise_investigations`
--

CREATE TABLE `advise_investigations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `chamber_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL DEFAULT 0,
  `prescription_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `time` varchar(255) DEFAULT NULL,
  `meeting_notes` mediumtext DEFAULT NULL,
  `files` mediumtext DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `serial_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_start` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assaign_days`
--

CREATE TABLE `assaign_days` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `start` varchar(255) DEFAULT NULL,
  `end` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assign_time`
--

CREATE TABLE `assign_time` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `is_featured` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chamber`
--

CREATE TABLE `chamber` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `chamber_type` int(11) DEFAULT NULL,
  `appoinment_limit` int(11) DEFAULT 20,
  `logo` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_primary` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chamber_category`
--

CREATE TABLE `chamber_category` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chamber_category`
--

INSERT INTO `chamber_category` (`id`, `user_id`, `name`) VALUES
(1, 1, 'Cardiology'),
(2, 1, 'Chaplaincy'),
(3, 1, 'Coronary Care Unit'),
(4, 1, 'Gastroenterology'),
(5, 1, 'Gynecology'),
(6, 1, 'Haematology'),
(7, 1, 'Neurology'),
(8, 1, 'Nephrology'),
(9, 1, 'Oncology'),
(10, 1, 'Ophthalmology'),
(11, 1, 'Radiology');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` varchar(2) NOT NULL,
  `dial_code` varchar(5) NOT NULL,
  `currency_name` varchar(20) NOT NULL,
  `currency_symbol` varchar(20) NOT NULL,
  `currency_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `code`, `dial_code`, `currency_name`, `currency_symbol`, `currency_code`) VALUES
(1, 'Andorra', 'AD', '+376', 'Euro', '€', 'EUR'),
(2, 'United Arab Emirates', 'AE', '+971', 'United Arab Emirates', 'د.إ', 'AED'),
(3, 'Afghanistan', 'AF', '+93', 'Afghan afghani', '؋', 'AFN'),
(4, 'Antigua and Barbuda', 'AG', '+1268', 'East Caribbean dolla', '$', 'XCD'),
(5, 'Anguilla', 'AI', '+1264', 'East Caribbean dolla', '$', 'XCD'),
(6, 'Albania', 'AL', '+355', 'Albanian lek', 'L', 'ALL'),
(7, 'Armenia', 'AM', '+374', 'Armenian dram', '', 'AMD'),
(8, 'Angola', 'AO', '+244', 'Angolan kwanza', 'Kz', 'AOA'),
(9, 'Argentina', 'AR', '+54', 'Argentine peso', '$', 'ARS'),
(10, 'Austria', 'AT', '+43', 'Euro', '€', 'EUR'),
(11, 'Australia', 'AU', '+61', 'Australian dollar', '$', 'AUD'),
(12, 'Aruba', 'AW', '+297', 'Aruban florin', 'ƒ', 'AWG'),
(13, 'Azerbaijan', 'AZ', '+994', 'Azerbaijani manat', '', 'AZN'),
(14, 'Barbados', 'BB', '+1246', 'Barbadian dollar', '$', 'BBD'),
(15, 'Bangladesh', 'BD', '+880', 'Bangladeshi taka', '৳', 'BDT'),
(16, 'Belgium', 'BE', '+32', 'Euro', '€', 'EUR'),
(17, 'Burkina Faso', 'BF', '+226', 'West African CFA fra', 'Fr', 'XOF'),
(18, 'Bulgaria', 'BG', '+359', 'Bulgarian lev', 'лв', 'BGN'),
(19, 'Bahrain', 'BH', '+973', 'Bahraini dinar', '.د.ب', 'BHD'),
(20, 'Burundi', 'BI', '+257', 'Burundian franc', 'Fr', 'BIF'),
(21, 'Benin', 'BJ', '+229', 'West African CFA fra', 'Fr', 'XOF'),
(22, 'Bermuda', 'BM', '+1441', 'Bermudian dollar', '$', 'BMD'),
(23, 'Brazil', 'BR', '+55', 'Brazilian real', 'R$', 'BRL'),
(24, 'Bhutan', 'BT', '+975', 'Bhutanese ngultrum', 'Nu.', 'BTN'),
(25, 'Botswana', 'BW', '+267', 'Botswana pula', 'P', 'BWP'),
(26, 'Belarus', 'BY', '+375', 'Belarusian ruble', 'Br', 'BYR'),
(27, 'Belize', 'BZ', '+501', 'Belize dollar', '$', 'BZD'),
(28, 'Canada', 'CA', '+1', 'Canadian dollar', '$', 'CAD'),
(29, 'Switzerland', 'CH', '+41', 'Swiss franc', 'Fr', 'CHF'),
(30, 'Cote d\'Ivoire', 'CI', '+225', 'West African CFA fra', 'Fr', 'XOF'),
(31, 'Cook Islands', 'CK', '+682', 'New Zealand dollar', '$', 'NZD'),
(32, 'Chile', 'CL', '+56', 'Chilean peso', '$', 'CLP'),
(33, 'Cameroon', 'CM', '+237', 'Central African CFA ', 'Fr', 'XAF'),
(34, 'China', 'CN', '+86', 'Chinese yuan', '¥ or 元', 'CNY'),
(35, 'Colombia', 'CO', '+57', 'Colombian peso', '$', 'COP'),
(36, 'Costa Rica', 'CR', '+506', 'Costa Rican colón', '₡', 'CRC'),
(37, 'Cuba', 'CU', '+53', 'Cuban convertible pe', '$', 'CUC'),
(38, 'Cape Verde', 'CV', '+238', 'Cape Verdean escudo', 'Esc or $', 'CVE'),
(39, 'Cyprus', 'CY', '+357', 'Euro', '€', 'EUR'),
(40, 'Czech Republic', 'CZ', '+420', 'Czech koruna', 'Kč', 'CZK'),
(41, 'Germany', 'DE', '+49', 'Euro', '€', 'EUR'),
(42, 'Djibouti', 'DJ', '+253', 'Djiboutian franc', 'Fr', 'DJF'),
(43, 'Denmark', 'DK', '+45', 'Danish krone', 'kr', 'DKK'),
(44, 'Dominica', 'DM', '+1767', 'East Caribbean dolla', '$', 'XCD'),
(45, 'Dominican Republic', 'DO', '+1849', 'Dominican peso', '$', 'DOP'),
(46, 'Algeria', 'DZ', '+213', 'Algerian dinar', 'د.ج', 'DZD'),
(47, 'Ecuador', 'EC', '+593', 'United States dollar', '$', 'USD'),
(48, 'Estonia', 'EE', '+372', 'Euro', '€', 'EUR'),
(49, 'Egypt', 'EG', '+20', 'Egyptian pound', '£ or ج.م', 'EGP'),
(50, 'Eritrea', 'ER', '+291', 'Eritrean nakfa', 'Nfk', 'ERN'),
(51, 'Spain', 'ES', '+34', 'Euro', '€', 'EUR'),
(52, 'Ethiopia', 'ET', '+251', 'Ethiopian birr', 'Br', 'ETB'),
(53, 'Finland', 'FI', '+358', 'Euro', '€', 'EUR'),
(54, 'Fiji', 'FJ', '+679', 'Fijian dollar', '$', 'FJD'),
(55, 'Faroe Islands', 'FO', '+298', 'Danish krone', 'kr', 'DKK'),
(56, 'France', 'FR', '+33', 'Euro', '€', 'EUR'),
(57, 'Gabon', 'GA', '+241', 'Central African CFA ', 'Fr', 'XAF'),
(58, 'United Kingdom', 'GB', '+44', 'British pound', '£', 'GBP'),
(59, 'Grenada', 'GD', '+1473', 'East Caribbean dolla', '$', 'XCD'),
(60, 'Georgia', 'GE', '+995', 'Georgian lari', 'ლ', 'GEL'),
(61, 'Guernsey', 'GG', '+44', 'British pound', '£', 'GBP'),
(62, 'Ghana', 'GH', '+233', 'Ghana cedi', '₵', 'GHS'),
(63, 'Gibraltar', 'GI', '+350', 'Gibraltar pound', '£', 'GIP'),
(64, 'Guinea', 'GN', '+224', 'Guinean franc', 'Fr', 'GNF'),
(65, 'Equatorial Guinea', 'GQ', '+240', 'Central African CFA ', 'Fr', 'XAF'),
(66, 'Greece', 'GR', '+30', 'Euro', '€', 'EUR'),
(67, 'Guatemala', 'GT', '+502', 'Guatemalan quetzal', 'Q', 'GTQ'),
(68, 'Guinea-Bissau', 'GW', '+245', 'West African CFA fra', 'Fr', 'XOF'),
(69, 'Guyana', 'GY', '+595', 'Guyanese dollar', '$', 'GYD'),
(70, 'Hong Kong', 'HK', '+852', 'Hong Kong dollar', '$', 'HKD'),
(71, 'Honduras', 'HN', '+504', 'Honduran lempira', 'L', 'HNL'),
(72, 'Croatia', 'HR', '+385', 'Croatian kuna', 'kn', 'HRK'),
(73, 'Haiti', 'HT', '+509', 'Haitian gourde', 'G', 'HTG'),
(74, 'Hungary', 'HU', '+36', 'Hungarian forint', 'Ft', 'HUF'),
(75, 'Indonesia', 'ID', '+62', 'Indonesian rupiah', 'Rp', 'IDR'),
(76, 'Ireland', 'IE', '+353', 'Euro', '€', 'EUR'),
(77, 'Israel', 'IL', '+972', 'Israeli new shekel', '₪', 'ILS'),
(78, 'Isle of Man', 'IM', '+44', 'British pound', '£', 'GBP'),
(79, 'India', 'IN', '+91', 'Indian rupee', '₹', 'INR'),
(80, 'Iraq', 'IQ', '+964', 'Iraqi dinar', 'ع.د', 'IQD'),
(81, 'Iceland', 'IS', '+354', 'Icelandic króna', 'kr', 'ISK'),
(82, 'Italy', 'IT', '+39', 'Euro', '€', 'EUR'),
(83, 'Jersey', 'JE', '+44', 'British pound', '£', 'GBP'),
(84, 'Jamaica', 'JM', '+1876', 'Jamaican dollar', '$', 'JMD'),
(85, 'Jordan', 'JO', '+962', 'Jordanian dinar', 'د.ا', 'JOD'),
(86, 'Japan', 'JP', '+81', 'Japanese yen', '¥', 'JPY'),
(87, 'Kenya', 'KE', '+254', 'Kenyan shilling', 'Sh', 'KES'),
(88, 'Kyrgyzstan', 'KG', '+996', 'Kyrgyzstani som', 'лв', 'KGS'),
(89, 'Cambodia', 'KH', '+855', 'Cambodian riel', '៛', 'KHR'),
(90, 'Kiribati', 'KI', '+686', 'Australian dollar', '$', 'AUD'),
(91, 'Comoros', 'KM', '+269', 'Comorian franc', 'Fr', 'KMF'),
(92, 'Kuwait', 'KW', '+965', 'Kuwaiti dinar', 'د.ك', 'KWD'),
(93, 'Cayman Islands', 'KY', '+ 345', 'Cayman Islands dolla', '$', 'KYD'),
(94, 'Kazakhstan', 'KZ', '+7 7', 'Kazakhstani tenge', '', 'KZT'),
(95, 'Laos', 'LA', '+856', 'Lao kip', '₭', 'LAK'),
(96, 'Lebanon', 'LB', '+961', 'Lebanese pound', 'ل.ل', 'LBP'),
(97, 'Saint Lucia', 'LC', '+1758', 'East Caribbean dolla', '$', 'XCD'),
(98, 'Liechtenstein', 'LI', '+423', 'Swiss franc', 'Fr', 'CHF'),
(99, 'Sri Lanka', 'LK', '+94', 'Sri Lankan rupee', 'Rs or රු', 'LKR'),
(100, 'Liberia', 'LR', '+231', 'Liberian dollar', '$', 'LRD'),
(101, 'Lesotho', 'LS', '+266', 'Lesotho loti', 'L', 'LSL'),
(102, 'Lithuania', 'LT', '+370', 'Euro', '€', 'EUR'),
(103, 'Luxembourg', 'LU', '+352', 'Euro', '€', 'EUR'),
(104, 'Latvia', 'LV', '+371', 'Euro', '€', 'EUR'),
(105, 'Morocco', 'MA', '+212', 'Moroccan dirham', 'د.م.', 'MAD'),
(106, 'Monaco', 'MC', '+377', 'Euro', '€', 'EUR'),
(107, 'Moldova', 'MD', '+373', 'Moldovan leu', 'L', 'MDL'),
(108, 'Montenegro', 'ME', '+382', 'Euro', '€', 'EUR'),
(109, 'Madagascar', 'MG', '+261', 'Malagasy ariary', 'Ar', 'MGA'),
(110, 'Marshall Islands', 'MH', '+692', 'United States dollar', '$', 'USD'),
(111, 'Mali', 'ML', '+223', 'West African CFA fra', 'Fr', 'XOF'),
(112, 'Myanmar', 'MM', '+95', 'Burmese kyat', 'Ks', 'MMK'),
(113, 'Mongolia', 'MN', '+976', 'Mongolian tögrög', '₮', 'MNT'),
(114, 'Mauritania', 'MR', '+222', 'Mauritanian ouguiya', 'UM', 'MRO'),
(115, 'Montserrat', 'MS', '+1664', 'East Caribbean dolla', '$', 'XCD'),
(116, 'Malta', 'MT', '+356', 'Euro', '€', 'EUR'),
(117, 'Mauritius', 'MU', '+230', 'Mauritian rupee', '₨', 'MUR'),
(118, 'Maldives', 'MV', '+960', 'Maldivian rufiyaa', '.ރ', 'MVR'),
(119, 'Malawi', 'MW', '+265', 'Malawian kwacha', 'MK', 'MWK'),
(120, 'Mexico', 'MX', '+52', 'Mexican peso', '$', 'MXN'),
(121, 'Malaysia', 'MY', '+60', 'Malaysian ringgit', 'RM', 'MYR'),
(122, 'Mozambique', 'MZ', '+258', 'Mozambican metical', 'MT', 'MZN'),
(123, 'Namibia', 'NA', '+264', 'Namibian dollar', '$', 'NAD'),
(124, 'New Caledonia', 'NC', '+687', 'CFP franc', 'Fr', 'XPF'),
(125, 'Niger', 'NE', '+227', 'West African CFA fra', 'Fr', 'XOF'),
(126, 'Nigeria', 'NG', '+234', 'Nigerian naira', '₦', 'NGN'),
(127, 'Nicaragua', 'NI', '+505', 'Nicaraguan córdoba', 'C$', 'NIO'),
(128, 'Netherlands', 'NL', '+31', 'Euro', '€', 'EUR'),
(129, 'Norway', 'NO', '+47', 'Norwegian krone', 'kr', 'NOK'),
(130, 'Nepal', 'NP', '+977', 'Nepalese rupee', '₨', 'NPR'),
(131, 'Nauru', 'NR', '+674', 'Australian dollar', '$', 'AUD'),
(132, 'Niue', 'NU', '+683', 'New Zealand dollar', '$', 'NZD'),
(133, 'New Zealand', 'NZ', '+64', 'New Zealand dollar', '$', 'NZD'),
(134, 'Oman', 'OM', '+968', 'Omani rial', 'ر.ع.', 'OMR'),
(135, 'Panama', 'PA', '+507', 'Panamanian balboa', 'B/.', 'PAB'),
(136, 'Peru', 'PE', '+51', 'Peruvian nuevo sol', 'S/.', 'PEN'),
(137, 'French Polynesia', 'PF', '+689', 'CFP franc', 'Fr', 'XPF'),
(138, 'Papua New Guinea', 'PG', '+675', 'Papua New Guinean ki', 'K', 'PGK'),
(139, 'Philippines', 'PH', '+63', 'Philippine peso', '₱', 'PHP'),
(140, 'Pakistan', 'PK', '+92', 'Pakistani rupee', '₨', 'PKR'),
(141, 'Poland', 'PL', '+48', 'Polish z?oty', 'zł', 'PLN'),
(142, 'Portugal', 'PT', '+351', 'Euro', '€', 'EUR'),
(143, 'Palau', 'PW', '+680', 'Palauan dollar', '$', ''),
(144, 'Paraguay', 'PY', '+595', 'Paraguayan guaraní', '₲', 'PYG'),
(145, 'Qatar', 'QA', '+974', 'Qatari riyal', 'ر.ق', 'QAR'),
(146, 'Romania', 'RO', '+40', 'Romanian leu', 'lei', 'RON'),
(147, 'Serbia', 'RS', '+381', 'Serbian dinar', 'дин. or din.', 'RSD'),
(148, 'Russia', 'RU', '+7', 'Russian ruble', '', 'RUB'),
(149, 'Rwanda', 'RW', '+250', 'Rwandan franc', 'Fr', 'RWF'),
(150, 'Saudi Arabia', 'SA', '+966', 'Saudi riyal', 'ر.س', 'SAR'),
(151, 'Solomon Islands', 'SB', '+677', 'Solomon Islands doll', '$', 'SBD'),
(152, 'Seychelles', 'SC', '+248', 'Seychellois rupee', '₨', 'SCR'),
(153, 'Sudan', 'SD', '+249', 'Sudanese pound', 'ج.س.', 'SDG'),
(154, 'Sweden', 'SE', '+46', 'Swedish krona', 'kr', 'SEK'),
(155, 'Singapore', 'SG', '+65', 'Brunei dollar', '$', 'BND'),
(156, 'Slovenia', 'SI', '+386', 'Euro', '€', 'EUR'),
(157, 'Slovakia', 'SK', '+421', 'Euro', '€', 'EUR'),
(158, 'Sierra Leone', 'SL', '+232', 'Sierra Leonean leone', 'Le', 'SLL'),
(159, 'San Marino', 'SM', '+378', 'Euro', '€', 'EUR'),
(160, 'Senegal', 'SN', '+221', 'West African CFA fra', 'Fr', 'XOF'),
(161, 'Somalia', 'SO', '+252', 'Somali shilling', 'Sh', 'SOS'),
(162, 'Suriname', 'SR', '+597', 'Surinamese dollar', '$', 'SRD'),
(163, 'El Salvador', 'SV', '+503', 'United States dollar', '$', 'USD'),
(164, 'Swaziland', 'SZ', '+268', 'Swazi lilangeni', 'L', 'SZL'),
(165, 'Chad', 'TD', '+235', 'Central African CFA ', 'Fr', 'XAF'),
(166, 'Togo', 'TG', '+228', 'West African CFA fra', 'Fr', 'XOF'),
(167, 'Thailand', 'TH', '+66', 'Thai baht', '฿', 'THB'),
(168, 'Tajikistan', 'TJ', '+992', 'Tajikistani somoni', 'ЅМ', 'TJS'),
(169, 'Turkmenistan', 'TM', '+993', 'Turkmenistan manat', 'm', 'TMT'),
(170, 'Tunisia', 'TN', '+216', 'Tunisian dinar', 'د.ت', 'TND'),
(171, 'Tonga', 'TO', '+676', 'Tongan pa?anga', 'T$', 'TOP'),
(172, 'Turkey', 'TR', '+90', 'Turkish lira', '', 'TRY'),
(173, 'Trinidad and Tobago', 'TT', '+1868', 'Trinidad and Tobago ', '$', 'TTD'),
(174, 'Tuvalu', 'TV', '+688', 'Australian dollar', '$', 'AUD'),
(175, 'Taiwan', 'TW', '+886', 'New Taiwan dollar', '$', 'TWD'),
(176, 'Ukraine', 'UA', '+380', 'Ukrainian hryvnia', '₴', 'UAH'),
(177, 'Uganda', 'UG', '+256', 'Ugandan shilling', 'Sh', 'UGX'),
(178, 'United States', 'US', '+1', 'United States dollar', '$', 'USD'),
(179, 'Uruguay', 'UY', '+598', 'Uruguayan peso', '$', 'UYU'),
(180, 'Uzbekistan', 'UZ', '+998', 'Uzbekistani som', '', 'UZS'),
(181, 'Vietnam', 'VN', '+84', 'Vietnamese ??ng', '₫', 'VND'),
(182, 'Vanuatu', 'VU', '+678', 'Vanuatu vatu', 'Vt', 'VUV'),
(183, 'Wallis and Futuna', 'WF', '+681', 'CFP franc', 'Fr', 'XPF'),
(184, 'Samoa', 'WS', '+685', 'Samoan t?l?', 'T', 'WST'),
(185, 'Yemen', 'YE', '+967', 'Yemeni rial', '﷼', 'YER'),
(186, 'South Africa', 'ZA', '+27', 'South African rand', 'R', 'ZAR'),
(187, 'Zambia', 'ZM', '+260', 'Zambian kwacha', 'ZK', 'ZMW'),
(188, 'Zimbabwe', 'ZW', '+263', 'Botswana pula', 'P', 'BWP');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_reports`
--

CREATE TABLE `diagnosis_reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `diagnosis_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `diagonosis`
--

CREATE TABLE `diagonosis` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `years` varchar(250) NOT NULL,
  `details` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `evisit_settings`
--

CREATE TABLE `evisit_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `zoom_meeting_id` varchar(255) NOT NULL,
  `zoom_meeting_password` varchar(255) DEFAULT NULL,
  `invitation_link` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `allow_user` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `years` varchar(250) NOT NULL,
  `details` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `is_limit` int(11) NOT NULL,
  `basic` int(11) DEFAULT NULL,
  `standared` int(11) DEFAULT NULL,
  `premium` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `slug`, `is_limit`, `basic`, `standared`, `premium`) VALUES
(1, 'Chambers', 'chambers', 1, 10, 2, -1),
(2, 'Staffs', 'staffs', 1, 10, 2, -1),
(3, 'Profile page', 'profile-page', 0, NULL, NULL, NULL),
(4, 'Appointments', 'appointments', 0, NULL, NULL, NULL),
(5, 'Prescription', 'prescription', 1, 10, 5, -1),
(6, 'Diagnosis', 'diagnosis', 0, NULL, NULL, NULL),
(7, 'Advise', 'advise', 0, NULL, NULL, NULL),
(8, 'Patients', 'patients', 1, 20, 2, -1),
(9, 'Online Consultation', 'online-consultation', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feature_assaign`
--

CREATE TABLE `feature_assaign` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feature_assaign`
--

INSERT INTO `feature_assaign` (`id`, `package_id`, `feature_id`) VALUES
(197, 3, 8),
(198, 3, 7),
(199, 3, 6),
(200, 3, 5),
(201, 3, 4),
(202, 3, 3),
(203, 3, 2),
(204, 3, 1),
(251, 2, 8),
(252, 2, 7),
(253, 2, 6),
(254, 2, 5),
(255, 2, 4),
(256, 2, 3),
(257, 2, 2),
(258, 2, 1),
(259, 1, 9),
(260, 1, 8),
(261, 1, 7),
(262, 1, 6),
(263, 1, 5),
(264, 1, 4),
(265, 1, 3),
(266, 1, 2),
(267, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `text_direction` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `slug`, `short_name`, `code`, `text_direction`, `status`) VALUES
(1, 'English', 'english', 'en', '', 'ltr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lang_values`
--

CREATE TABLE `lang_values` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `label` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `english` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lang_values`
--

INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES
(1, 'admin', 'Language', 'language', 'Language'),
(2, 'admin', 'Edit frontend values', 'edit-frontend-values', 'Frontend values'),
(3, 'admin', 'Edit admin values', 'edit-admin-values', 'Admin values'),
(4, 'admin', 'Edit user values', 'edit-user-values', 'User values'),
(5, 'admin', 'Update language for', 'update-language-for', 'Update language for'),
(6, 'admin', 'Frontend', 'frontend', 'Frontend'),
(7, 'admin', 'Admin', 'admin', 'Admin'),
(8, 'admin', 'User', 'user', 'User'),
(9, 'admin', 'Add New Language ', 'add-new-language', 'Add New Language '),
(10, 'admin', 'Manage Language', 'manage-language', 'Manage Language'),
(11, 'admin', 'Update values', 'update-values', 'Update values'),
(12, 'admin', 'Your Password has been changed Successfully', 'password-reset-success-msg', 'Your Password has been changed Successfully'),
(13, 'admin', 'Oops', 'oops', 'Oops'),
(14, 'admin', 'Your Confirm Password doesn\'t Match', 'confirm-pass-not-match-msg', 'Your Confirm Password doesn\'t Match'),
(15, 'admin', 'Your Old Password doesn\'t Match', 'old-password-doesnt-match', 'Your Old Password doesn\'t Match'),
(16, 'admin', 'Sorry', 'sorry', 'Sorry!'),
(17, 'admin', 'Something wrong', 'something-wrong', 'Something wrong'),
(18, 'admin', 'Success', 'success', 'Success!'),
(19, 'admin', 'Setup successfully', 'setup-successfully', 'Setup successfully'),
(20, 'admin', 'Send successfully', 'send-successfully', 'Send successfully'),
(21, 'admin', 'Are you sure', 'are-you-sure', 'Are you sure?'),
(22, 'admin', 'Converted successfully', 'converted-successfully', 'Converted successfully'),
(23, 'admin', 'Data limit has been over', 'data-limit-over', 'Data limit has been over'),
(24, 'admin', 'Sending failed', 'sending-failed', 'Sending failed'),
(25, 'admin', 'Approved Successfully', 'approved-successfully', 'Approved Successfully'),
(26, 'admin', 'You will not be able to recover this file', 'not-recover-file', 'You will not be able to recover this file'),
(27, 'admin', 'Deleted successfully', 'deleted-successfully', 'Deleted successfully'),
(28, 'admin', 'Approve this invoice', 'approve-this-invoice', 'Approve this invoice'),
(29, 'admin', 'Set as your primary chamber', 'set-as-your-primary-chamber', 'Set as your primary chamber'),
(30, 'admin', 'Want to set', 'want-to-set', 'Want to set'),
(31, 'admin', 'You have made some changes and it\'s not saved?', 'made-changes-not-saved', 'You have made some changes and it\'s not saved?'),
(32, 'admin', 'Your account has been suspended', 'account-suspend-msg', 'Your account has been suspended!'),
(33, 'front', 'This email already exist, try another one', 'email-exist', 'This email already exist, try another one'),
(34, 'front', 'Your account is not active', 'account-not-active', 'Your account is not active'),
(35, 'front', 'Sorry your username or password is not correct!', 'wrong-username-password', 'Sorry your username or password is not correct!'),
(36, 'front', 'Your email is not verified, Please verify your email', 'email-not-verified', 'Your email is not verified, Please verify your email'),
(37, 'front', 'We\'ve sent a password to your email address. Please check your inbox', 'password-sent-to-email', 'We\'ve sent a password to your email address. Please check your inbox'),
(38, 'front', 'Password Reset Successfully !', 'password-reset-successfully', 'Password Reset Successfully !'),
(39, 'front', 'You are not a valid user', 'not-a-valid-user', 'You are not a valid user'),
(40, 'admin', 'Set default language', 'set-default-language', 'Set default language'),
(41, 'admin', 'Short Form', 'short-form', 'Short Form'),
(42, 'admin', 'Text direction', 'text-direction', 'Text direction'),
(43, 'user', 'Add new item', 'add-new-item', 'Add new item'),
(44, 'admin', 'Set Trial Days', 'set-trial-days', 'Set trial days'),
(45, 'front', 'Start', 'start', 'Start'),
(46, 'front', 'days trial', 'days-trial', 'days trial'),
(47, 'admin', 'Delete', 'delete', 'Delete'),
(48, 'admin', 'Activate', 'activate', 'Activate'),
(49, 'admin', 'Deactivate', 'deactivate', 'Deactivate'),
(50, 'admin', 'Dashboard', 'dashboard', 'Dashboard'),
(51, 'admin', 'Save', 'save', 'Save'),
(52, 'front', 'Home', 'home', 'Home'),
(53, 'front', 'Pricing', 'pricing', 'Pricing'),
(54, 'front', 'Blogs', 'blogs', 'Blogs'),
(55, 'front', 'Faqs', 'faqs', 'FAQs'),
(56, 'front', 'Contact', 'contact', 'Contact'),
(57, 'front', 'Pages', 'pages', 'Pages'),
(58, 'front', 'Sign In', 'sign-in', 'Sign In'),
(59, 'front', 'Sign Out', 'sign-out', 'Sign Out'),
(60, 'front', 'Get Started', 'get-started', 'Get Started'),
(61, 'front', 'Workflow', 'workflow', 'Workflow'),
(62, 'front', 'Look at a glance how our system works', 'workflow-title', 'Look at a glance how our system works'),
(63, 'front', 'Choose Plan', 'choose-plan', 'Choose Plan'),
(64, 'front', 'Choose your confortable plan', 'choose-your-confortable-plan', 'Choose your confortable plan'),
(65, 'front', 'Get Paid', 'get-paid', 'Get Paid'),
(66, 'front', 'Get Paid title', 'get-paid-title', 'Paid via paypal/stripe payment method'),
(67, 'front', 'Start Working', 'start-working', 'Start Working'),
(68, 'front', 'Start Working title', 'start-working-title', 'Start Using and explore the featuers'),
(69, 'front', 'Start using', 'start-using', 'Start using'),
(70, 'front', 'account', 'account', 'account'),
(71, 'front', 'Our online registration process makes it easy for you to sign up for an free or pro account.', 'home-intro-desc', 'Our online registration process makes it easy for you to sign up for an free or pro account.'),
(72, 'front', 'Services', 'services', 'Services'),
(73, 'front', 'All rights reserved', 'all-rights-reserved', 'All rights reserved'),
(74, 'front', 'Small Business — friendly Pricing', 'pricing-title', 'Small Business — friendly Pricing'),
(75, 'front', 'We\'re offering a generous Free Plan and affordable Standard & Premium pricing plans that will help you to grow with', 'pricing-desc', 'We\'re offering a generous Free Plan and affordable Standard & Premium pricing plans that will help you to grow with'),
(76, 'front', 'Monthly', 'monthly', 'Monthly'),
(77, 'front', 'Yearly', 'yearly', 'Yearly'),
(78, 'front', 'Per Year', 'per-year', 'Per Year'),
(79, 'front', 'Per Month', 'per-month', 'Per Month'),
(80, 'front', 'Select Plan', 'select-plan', 'Select Plan'),
(81, 'front', 'Experts', 'experts', 'Experts'),
(82, 'front', 'Meet our experienced experts and book your appoinment in online.', 'expert-title', 'Meet our experienced experts and book your appoinment in online.'),
(83, 'front', 'Select Departments', 'select-departments', 'Select Departments'),
(84, 'front', 'Select Experiences', 'select-experiences', 'Select Experiences'),
(85, 'front', 'Search by name', 'search-by-name', 'Search by name'),
(86, 'front', 'Book Appointment', 'book-appointment', 'Book Appointment'),
(87, 'front', 'No data found!', 'no-data-found', 'No data found!'),
(88, 'front', 'Blog & News', 'blog-news', 'Blog & News'),
(89, 'front', 'Learn More & Empower Yourself', 'learn-more-empower-yourself', 'Learn More & Empower Yourself'),
(90, 'front', 'Search blog posts', 'search-blog-posts', 'Search blog posts'),
(91, 'front', 'Tags', 'tags', 'Tags'),
(92, 'front', 'Leave a reply', 'leave-a-reply', 'Leave a reply'),
(93, 'front', 'Name', 'name', 'Name'),
(94, 'front', 'Address', 'address', 'Address'),
(95, 'front', 'Comment', 'comment', 'Comment'),
(96, 'front', 'Submit', 'submit', 'Submit'),
(97, 'front', 'Frequently Asked Questions', 'frequently-asked-questions', 'Frequently Asked Questions'),
(98, 'front', 'Get In Touch', 'get-in-touch', 'Get In Touch'),
(99, 'front', 'Message', 'message', 'Message'),
(100, 'front', 'Sign in to your', 'sign-in-to-your', 'Sign in to your'),
(101, 'front', 'Username', 'username', 'Username'),
(102, 'front', 'Password', 'password', 'Password'),
(103, 'front', 'Forgot password?', 'forgot-password', 'Forgot password?'),
(104, 'front', 'Don\'t have an account yet?', 'an-account-yet', 'Don\'t have an account yet?'),
(105, 'front', 'Select Your Role', 'select-your-role', 'Select Your Role'),
(106, 'front', 'Enter your email', 'enter-your-email', 'Enter your email'),
(107, 'front', ' Back', 'back', ' Back'),
(108, 'front', 'Email', 'email', 'Email'),
(109, 'front', 'Your full name', 'your-full-name', 'Your full name'),
(110, 'front', 'Your email address', 'your-email-address', 'Your email address'),
(111, 'front', 'Your password', 'your-password', 'Your password'),
(112, 'front', 'I have read and understood the', 'i-have-read-and-understood-the', 'I have read and understood the'),
(113, 'front', 'Terms and Conditions', 'terms-and-conditions', 'Terms and Conditions'),
(114, 'front', 'Privacy Policy', 'privacy-policy', 'Privacy Policy'),
(115, 'front', 'and', 'and', 'and'),
(116, 'front', 'of this site', 'of-this-site', 'of this site'),
(117, 'front', 'Already have an account?', 'already-have-an-account', 'Already have an account?'),
(118, 'front', 'Register', 'register', 'Register'),
(119, 'front', 'Privacy', 'privacy', 'Privacy'),
(120, 'front', 'Terms', 'terms', 'Terms'),
(121, 'front', 'Error', 'error', 'Error'),
(122, 'front', 'Warning', 'warning', 'Warning'),
(123, 'front', 'Appointment type is required', 'appointment-type-is-required', 'Appointment type is required'),
(124, 'front', 'Booking date is required', 'booking-date-is-required', 'Booking date is required'),
(125, 'front', 'Booking time is required', 'booking-time-is-required', 'Booking time is required'),
(126, 'front', 'Processing', 'processing', 'Processing'),
(127, 'front', 'Appointment booked successfully', 'appointment-booked-successfully', 'Appointment booked successfully'),
(128, 'front', 'Incorrect username or password', 'incorrect-username-or-password', 'Incorrect username or password'),
(129, 'front', 'Please enter a valid date', 'please-enter-a-valid-date', 'Please enter a valid date'),
(130, 'front', 'Recaptcha is required', 'recaptcha-is-required', 'Recaptcha is required'),
(131, 'front', 'Signing In', 'signing-in', 'Signing In'),
(132, 'front', 'Your account is not active', 'your-account-is-not-active', 'Your account is not active'),
(133, 'front', 'Your account has been suspended', 'your-account-has-been-suspended', 'Your account has been suspended'),
(134, 'front', 'Your email is not verified, Please verify your email', 'your-email-is-not-verified-please-verify-your-email', 'Your email is not verified, Please verify your email'),
(135, 'front', 'Registared successfully!', 'registared-successfully', 'Registered successfully!'),
(136, 'front', 'Please wait we are preparing environment for you...', 'preparing-environment', 'Please wait we are preparing environment for you...'),
(137, 'front', 'This email already used, please try another one', 'email-exitsts', 'This email already used, please try another one'),
(138, 'front', 'Something wrong !, Failed to send code in your email.', 'something-wrong', 'Something wrong !, Failed to send code in your email.'),
(139, 'front', 'We\'ve sent a password to your email address. Please check your inbox', 'email-send-notify', 'We\'ve sent a password to your email address. Please check your inbox'),
(140, 'front', 'You are not a valid user', 'you-are-not-a-valid-user', 'You are not a valid user'),
(141, 'front', 'Try Again', 'try-again', 'Try Again'),
(142, 'front', 'Your account verified successfully!', 'your-account-verified-successfully', 'Your account verified successfully!'),
(143, 'front', 'Verify code is not matched', 'verify-code-is-not-matched', 'Verify code is not matched'),
(144, 'front', 'Experience Years', 'experience-years', 'Experience Years'),
(145, 'front', 'Patients', 'patients', 'Patients'),
(146, 'front', 'Visited Patient\'s', 'visited-patients', 'Visited Patient\'s'),
(147, 'front', 'Before booked an appointment check the availability', 'booking-availability', 'Before booked an appointment check the availability'),
(148, 'front', 'Appointment Type', 'appointment-type', 'Appointment Type'),
(149, 'front', 'Select Type', 'select-type', 'Select Type'),
(150, 'front', 'Date ', 'date', 'Date '),
(151, 'front', 'Time', 'time', 'Time'),
(152, 'front', 'Consultation Fee', 'consultation-fee', 'Consultation Fee'),
(153, 'front', 'Continue', 'continue', 'Continue'),
(154, 'front', ' New Registration', 'new-registration', ' New Registration'),
(155, 'front', ' Already have account?', 'already-have-account', ' Already have account?'),
(156, 'front', 'Close', 'close', 'Close'),
(157, 'front', 'Powered by', 'powered-by', 'Powered by'),
(158, 'admin', 'Settings', 'settings', 'Settings'),
(159, 'admin', 'Payment Settings', 'payment-settings', 'Payment Settings'),
(160, 'admin', 'Plans', 'plans', 'Plans'),
(161, 'admin', 'Departments', 'departments', 'Departments'),
(162, 'admin', 'Add Category', 'add-category', 'Add Category'),
(163, 'admin', 'Blog Posts', 'blog-posts', 'Blog Posts'),
(164, 'admin', 'Change Password', 'change-password', 'Change Password'),
(165, 'admin', 'Logout', 'logout', 'Logout'),
(166, 'admin', 'Verified', 'verified', 'Verified'),
(167, 'admin', 'Pending', 'pending', 'Pending'),
(168, 'admin', 'Expired', 'expired', 'Expired'),
(169, 'admin', 'Last 12 months Income', 'last-12-months-income', 'Last 12 months Income'),
(170, 'admin', 'Income', 'income', 'Income'),
(171, 'admin', 'Recently joined Users', 'recently-joined-users', 'Recently joined Users'),
(172, 'admin', 'a week ago', 'a-week-ago', 'a week ago'),
(173, 'admin', '>Net Income', 'net-income', 'Net Income'),
(174, 'admin', 'Fiscal year', 'fiscal-year', 'Fiscal year'),
(175, 'admin', 'Fiscal year start is January 01', 'fiscal-year-title', 'Fiscal year start is January 01'),
(176, 'admin', 'Version', 'version', 'Version'),
(177, 'admin', 'Plans by user', 'plans-by-user', 'Plans by user'),
(178, 'admin', 'Manage Settings', 'manage-settings', 'Manage Settings'),
(179, 'admin', ' Website Settings', 'website-settings', ' Website Settings'),
(180, 'admin', 'Upload Favicon', 'upload-favicon', 'Upload Favicon'),
(181, 'admin', 'Upload Logo', 'upload-logo', 'Upload Logo'),
(182, 'admin', 'Upload home image', 'upload-home-image', 'Upload home image'),
(183, 'admin', 'Application Name', 'application-name', 'Application Name'),
(184, 'admin', 'Application Title', 'application-title', 'Application Title'),
(185, 'admin', 'Keywords', 'keywords', 'Keywords'),
(186, 'admin', 'Description', 'description', 'Description'),
(187, 'admin', 'Footer About', 'footer-about', 'Footer About'),
(188, 'admin', 'Admin Email', 'admin-email', 'Admin Email'),
(189, 'admin', 'Copyright', 'copyright', 'Copyright'),
(190, 'admin', 'This email will used for your site from mail', 'settings-email-info', 'This email will used for your site from mail'),
(191, 'admin', 'Zoom Settings', 'zoom-settings', 'Zoom Settings'),
(192, 'admin', 'Preferences', 'preferences', 'Preferences'),
(193, 'admin', 'Registration System', 'registration-system', 'Registration System'),
(194, 'admin', 'Enable to allow sign up users to your site.', 'registration-title', 'Enable to allow sign up users to your site.'),
(195, 'admin', 'Enable reCaptcha for all open froms (Sign up, contact, comments)', 'recaptcha-title', 'Enable reCaptcha for all open froms (Sign up, contact, comments)'),
(196, 'admin', 'Email Verification', 'email-verification', 'Email Verification'),
(197, 'admin', 'Enable to allow email verification for registered users.', 'email-verify-title', 'Enable to allow email verification for registered users.'),
(198, 'admin', 'Enable to show users option in frontend', 'users-title', 'Enable to show users option in frontend'),
(199, 'admin', 'Enable to show blog option in frontend', 'blogs-title', 'Enable to show blog option in frontend'),
(200, 'admin', 'Enable to show faqs option in frontend', 'faq-title', 'Enable to show faqs option in frontend'),
(201, 'admin', 'Enable to show home page workflow section in frontend', 'workflow-enable', 'Enable to show home page workflow section in frontend'),
(202, 'admin', 'Email Settings', 'email-settings', 'Email Settings'),
(203, 'admin', 'If you are using gmail smtp please make sure you have set below settings before sending mail', 'mail-info-title', 'If you are using gmail smtp please make sure you have set below settings before sending mail'),
(204, 'admin', 'Two factor authentication off', 'two-factor-off', 'Two factor authentication off'),
(205, 'admin', 'Less secure app on', 'less-secure-app-on', 'Less secure app on'),
(206, 'admin', 'Mail Type', 'mail-type', 'Mail Type'),
(207, 'admin', 'Mail Title', 'mail-title', 'Mail Title'),
(208, 'admin', 'Mail Host', 'mail-host', 'Mail Host'),
(209, 'admin', 'Mail Port', 'mail-port', 'Mail Port'),
(210, 'admin', 'Mail Username', 'mail-username', 'Mail Username'),
(211, 'admin', 'Mail Password', 'mail-password', 'Mail Password'),
(212, 'admin', 'Mail Encryption', 'mail-encryption', 'Mail Encryption'),
(213, 'admin', '  SSL is used for port 465/25, TLS is used for port 587', 'mail-port-help', '  SSL is used for port 465/25, TLS is used for port 587'),
(214, 'admin', 'Send Test Mail', 'send-test-mail', 'Send Test Mail'),
(215, 'admin', 'Social Settings', 'social-settings', 'Social Settings'),
(216, 'admin', 'Set default', 'set-default', 'Set default'),
(217, 'admin', 'Update', 'update', 'Update'),
(218, 'admin', 'Direction', 'direction', 'Direction'),
(219, 'admin', 'Status', 'status', 'Status'),
(220, 'admin', 'Action', 'action', 'Action'),
(221, 'admin', 'Currency', 'currency', 'Currency'),
(222, 'admin', 'Paypal mode', 'paypal-mode', 'Paypal mode'),
(223, 'admin', 'Paypal Account', 'paypal-account', 'Paypal Account'),
(224, 'admin', 'Publish key', 'publish-key', 'Publish key'),
(225, 'admin', 'Secret key', 'secret-key', 'Secret key'),
(226, 'admin', 'Add Offline Payment', 'add-offline-payment', 'Add Offline Payment'),
(227, 'admin', 'Select User', 'select-user', 'Select User'),
(228, 'admin', 'Subscription type', 'subscription-type', 'Subscription type'),
(229, 'admin', 'Payment Status', 'payment-status', 'Payment Status'),
(230, 'admin', 'Manage Plans', 'manage-plans', 'Manage Plans'),
(231, 'admin', 'Show', 'show', 'Show'),
(232, 'admin', 'Hide', 'hide', 'Hide'),
(233, 'admin', 'Disable to hide this plan', 'disable-to-hide-this-plan', 'Disable to hide this plan'),
(234, 'admin', 'Active', 'active', 'Active'),
(235, 'admin', 'Edit Plan', 'edit-plan', 'Edit Plan'),
(236, 'admin', 'Update plan', 'update-plan', 'Update plan'),
(237, 'admin', 'Manage your plan settings here', 'manage-your-plan', 'Manage your plan settings here'),
(238, 'admin', 'Plan Settings', 'plan-settings', 'Plan Settings'),
(239, 'admin', 'Plan', 'plan', 'Plan'),
(240, 'admin', 'Choose which features you want to add in this plan', 'choose-which-features', 'Choose which features you want to add in this plan'),
(241, 'admin', 'Plan Name', 'plan-name', 'Plan Name'),
(242, 'admin', 'Monthly Price', 'monthly-price', 'Monthly Price'),
(243, 'admin', 'Yearly Price', 'yearly-price', 'Yearly Price'),
(244, 'admin', 'Set 0 price for free package', 'set-0-price-for-free-package', 'Set 0 price for free package'),
(245, 'admin', 'Online Consultation & get payments', 'online-consultation-get-payments', 'Online Consultation & get payments'),
(260, 'admin', 'Set limit -1 for unlimited', 'set-limit-1-for-unlimited', 'Set limit -1 for unlimited'),
(261, 'admin', 'Add New Department', 'add-new-department', 'Add New Department'),
(262, 'admin', 'All Users', 'all-users', 'All Users'),
(263, 'admin', 'Sort by Packages', 'sort-by-packages', 'Sort by Packages'),
(264, 'admin', 'Sort by Status', 'sort-by-status', 'Sort by Status'),
(265, 'admin', 'Avatar', 'avatar', 'Avatar'),
(266, 'admin', 'Account Status', 'account-status', 'Account Status'),
(267, 'admin', 'Joined', 'joined', 'Joined'),
(268, 'admin', 'All category', 'all-category', 'All category'),
(269, 'admin', ' Add new Category', 'add-new-category', ' Add new Category'),
(270, 'admin', 'Category Name', 'category-name', 'Category Name'),
(271, 'admin', 'Edit', 'edit', 'Edit'),
(272, 'admin', 'All Blog posts', 'all-blog-posts', 'All Blog posts'),
(273, 'admin', 'Thumb', 'thumb', 'Thumb'),
(274, 'admin', 'Title', 'title', 'Title'),
(275, 'admin', 'Details', 'details', 'Details'),
(276, 'admin', 'Add new blog', 'add-new-blog', 'Add new blog'),
(277, 'admin', 'Category ', 'category', 'Category '),
(278, 'admin', 'Slug', 'slug', 'Slug'),
(279, 'admin', 'Inactive', 'inactive', 'Inactive'),
(280, 'admin', 'All Services', 'all-services', 'All Services'),
(281, 'admin', 'Add new Services', 'add-new-services', 'Add new Services'),
(282, 'admin', 'Upload Image', 'upload-image', 'Upload Image'),
(283, 'admin', 'Order', 'order', 'Order'),
(284, 'admin', 'Add New service', 'add-new-service', 'Add New service'),
(285, 'admin', 'Add new page', 'add-new-page', 'Add new page'),
(286, 'admin', 'Page title', 'page-title', 'Page title'),
(287, 'admin', 'Page slug', 'page-slug', 'Page slug'),
(288, 'admin', 'Page description', 'page-description', 'Page description'),
(289, 'admin', 'All Faqs', 'all-faqs', 'All Faqs'),
(290, 'admin', 'Add New FAQ', 'add-new-faq', 'Add New FAQ'),
(291, 'admin', 'Old Password', 'old-password', 'Old Password'),
(292, 'admin', 'New Password', 'new-password', 'New Password'),
(293, 'admin', 'Confirm New Password', 'confirm-new-password', 'Confirm New Password'),
(294, 'front', 'Resources', 'resources', 'Resources'),
(295, 'front', 'Users', 'users', 'Users'),
(296, 'front', 'The better way to manage your chambers, prescriptions, appointments & patients', 'feature-home-title', 'The better way to manage your chambers, prescriptions, appointments & patients'),
(297, 'front', 'account you can easily manage chamber wise prescriptions, patients, appointments and many more features.', 'feature-home-desc', 'account you can easily manage chamber wise prescriptions, patients, appointments and many more features.'),
(298, 'front', 'Using', 'using', 'Using'),
(299, 'front', 'Features not selected !', 'features-not-selected', 'Features not selected !'),
(300, 'front', 'years experience', 'years-experience', 'years experience'),
(301, 'front', 'View Profile', 'view-profile', 'View Profile'),
(302, 'front', 'Explore our features', 'explore-our-features', 'Explore our features'),
(303, 'front', 'Read More', 'read-more', 'Read More'),
(304, 'front', 'Appointment schedule is not setted.', 'schedule-is-not-setted', 'Appointment schedule is not setted.'),
(305, 'front', 'Online Consultation', 'online-consultation', 'Online Consultation'),
(306, 'front', 'Offline', 'offline', 'Offline'),
(307, 'front', 'Email or Mobile', 'email-or-mobile', 'Email or Mobile'),
(308, 'front', 'Phone', 'phone', 'Phone'),
(309, 'front', 'Educations', 'educations', 'Educations'),
(310, 'front', 'Experiences', 'experiences', 'Experiences'),
(311, 'front', 'This profile is currently not available', 'profile-not-available', 'This profile is currently not available'),
(312, 'front', 'Upgrade your plan', 'upgrade-your-plan', 'Upgrade your plan'),
(313, 'front', 'Back to Home', 'back-to-home', 'Back to Home'),
(314, 'front', 'The resource requested could not be found on this site!', 'error-404', 'The resource requested could not be found on this site!'),
(315, 'front', 'Verify Account', 'verify-account', 'Verify Account'),
(316, 'front', 'We have sent a link to your registered email address, please click this link to verify your account', 'verify-email-sent-link', 'We have sent a link to your registered email address, please click this link to verify your account'),
(317, 'front', 'Email verification failed!', 'email-verification-failed', 'Email verification failed!'),
(318, 'front', 'Congratulation\'s', 'congratulations', 'Congratulation\'s'),
(319, 'front', 'Your account successfully verified', 'your-account-successfully-verified', 'Your account successfully verified'),
(320, 'front', 'Logout Successfully !', 'logout-successfully-', 'Logout Successfully !'),
(321, 'front', 'Recover password', 'recover-password', 'Recover password'),
(322, 'front', 'Admin/Doctors', 'admindoctors', 'Admin/Doctors'),
(323, 'front', 'Staff', 'staff', 'Staff'),
(324, 'front', 'Patient', 'patient', 'Patient'),
(325, 'front', 'Enter username', 'enter-username', 'Enter username'),
(326, 'front', 'Enter password', 'enter-password', 'Enter password'),
(327, 'front', 'Registration system is disabled !', 'registration-system-is-disabled-', 'Registration system is disabled !'),
(328, 'front', 'Contact Admin', 'contact-admin', 'Contact Admin'),
(329, 'front', 'Get started with a', 'get-started-with-a', 'Get started with a'),
(330, 'admin', 'Subscription', 'subscription', 'Subscription'),
(331, 'admin', 'Consultation Settings', 'consultation-settings', 'Consultation Settings'),
(332, 'admin', 'Live Consultations', 'live-consultations', 'Live Consultations'),
(333, 'admin', 'Prescription', 'prescription', 'Prescription'),
(334, 'admin', 'Prescriptions', 'prescriptions', 'Prescriptions'),
(335, 'admin', 'Create New', 'create-new', 'Create New'),
(336, 'admin', 'Lists', 'lists', 'Lists'),
(337, 'admin', 'Set Schedule', 'set-schedule', 'Set Schedule'),
(338, 'admin', 'Drugs', 'drugs', 'Drugs'),
(339, 'admin', 'Personal Info', 'personal-info', 'Personal Info'),
(340, 'admin', 'Manage Education', 'manage-education', 'Manage Education'),
(341, 'admin', 'Manage Experiences', 'manage-experiences', 'Manage Experiences'),
(342, 'admin', 'Profile', 'profile', 'Profile'),
(343, 'admin', 'Blog', 'blog', 'Blog'),
(344, 'admin', 'Today\'s Appointment', 'todays-appointment', 'Today\'s Appointment'),
(345, 'admin', 'Serial No', 'serial-no', 'Serial No'),
(346, 'admin', 'Upcoming Appointment\'s', 'upcoming-appointments', 'Upcoming Appointment\'s'),
(347, 'admin', 'Mr. No', 'mr.-no', 'Mr. No'),
(348, 'admin', 'Doctor Info', 'doctor-info', 'Doctor Info'),
(349, 'admin', 'Schedule Info', 'schedule-info', 'Schedule Info'),
(350, 'admin', 'Consultation type', 'consultation-type', 'Consultation type'),
(351, 'admin', 'Online', 'online', 'Online'),
(352, 'admin', 'Offline (Chamber)', 'offline-chamber', 'Offline (Chamber)'),
(353, 'admin', 'See all Users', 'see-all-users', 'See all Users'),
(354, 'admin', 'Save Changes', 'save-changes', 'Save Changes'),
(355, 'admin', 'mode', 'mode', 'mode'),
(356, 'admin', 'Add Payment', 'add-payment', 'Add Payment'),
(357, 'admin', 'Select Plans', 'select-plans', 'Select Plans'),
(358, 'admin', 'Enable to active this plan', 'enable-to-active-this-plan', 'Enable to active this plan'),
(359, 'admin', 'Hidden', 'hidden', 'Hidden'),
(360, 'admin', 'Enable access to', 'enable-access-to', 'Enable access to'),
(361, 'admin', 'feature in this plan', 'feature-in-this-plan', 'feature in this plan'),
(362, 'admin', 'Chambers', 'chambers', 'Chambers'),
(363, 'admin', 'Package', 'package', 'Package'),
(364, 'admin', 'Days left', 'days-left', 'Days left'),
(365, 'admin', 'Disabled', 'disabled', 'Disabled'),
(366, 'admin', 'All Categories', 'all-categories', 'All Categories'),
(367, 'admin', 'Add New Post', 'add-new-post', 'Add New Post'),
(368, 'admin', 'Enter your tags', 'enter-your-tags', 'Enter your tags'),
(369, 'admin', 'Accounts', 'accounts', 'Accounts'),
(370, 'user', 'Staffs', 'staffs', 'Staffs'),
(371, 'user', 'Appointments', 'appointments', 'Appointments'),
(372, 'user', 'Your ', 'your', 'Your '),
(373, 'user', 'Manage Chambers', 'manage-chambers', 'Manage Chambers'),
(374, 'user', 'Manage Profile', 'manage-profile', 'Manage Profile'),
(375, 'user', 'Update Profile', 'update-profile', 'Update Profile'),
(376, 'user', 'Price', 'price', 'Price'),
(377, 'user', 'Billing Cycle', 'billing-cycle', 'Billing Cycle'),
(378, 'user', 'Payment method', 'payment-method', 'Payment method'),
(379, 'user', 'Last billing', 'last-billing', 'Last billing'),
(380, 'user', 'Expire', 'expire', 'Expire'),
(381, 'user', 'Your Selected Plan', 'your-selected-plan', 'Your Selected Plan'),
(382, 'user', 'Select', 'select', 'Select'),
(383, 'user', 'Add new chamber', 'add-new-chamber', 'Add new chamber'),
(384, 'user', 'All Chambers', 'all-chambers', 'All Chambers'),
(385, 'user', 'Appointment Limit', 'appointment-limit', 'Appointment Limit'),
(386, 'user', 'Information\'s', 'informations', 'Information\'s'),
(387, 'user', 'Consultations', 'consultations', 'Consultations'),
(388, 'user', 'Meeting Id', 'meeting-id', 'Meeting Id'),
(389, 'user', 'Meeting Password', 'meeting-password', 'Meeting Password'),
(390, 'user', 'Consultation Fees', 'consultation-fees', 'Consultation Fees'),
(391, 'user', 'Enable to allow patients for online consultation', 'enable-to-allow-consultation', 'Enable to allow patients for online consultation'),
(392, 'user', 'Live Consultation', 'live-consultation', 'Live Consultation'),
(393, 'user', 'Data not found !', 'data-not-found', 'Data not found !'),
(394, 'user', 'Patient Info', 'patient-info', 'Patient Info'),
(395, 'user', 'Record Payment', 'record-payment', 'Record Payment'),
(396, 'user', 'Not Visited', 'not-visited', 'Not Visited'),
(397, 'user', 'Visited', 'visited', 'Visited'),
(398, 'user', 'Cancel Meeting', 'cancel-meeting', 'Cancel Meeting'),
(399, 'user', 'Send notify mail to user for joining meeting', 'send-notify-mail-for-joining-meeting', 'Send notify mail to user for joining meeting'),
(400, 'user', 'Create Prescription for', 'create-prescription-for', 'Create Prescription for'),
(401, 'user', 'Record Payment for patient', 'record-payment-for-patient', 'Record Payment for patient'),
(402, 'user', 'Add new staff', 'add-new-staff', 'Add new staff'),
(403, 'user', 'All staffs', 'all-staffs', 'All staffs'),
(404, 'user', 'All Chamber', 'all-chamber', 'All Chamber'),
(405, 'user', 'Designation', 'designation', 'Designation'),
(406, 'user', 'Add New Diagnosis', 'add-new-diagnosis', 'Add New Diagnosis'),
(407, 'user', 'All Diagnosis', 'all-diagnosis', 'All Diagnosis'),
(408, 'user', ' All Diagnosis Tests', 'all-diagnosis-tests', ' All Diagnosis Tests'),
(409, 'user', 'Add New Test', 'add-new-test', 'Add New Test'),
(410, 'user', 'All Additional Advises', 'all-additional-advises', 'All Additional Advises'),
(411, 'user', 'All Advises', 'all-advises', 'All Advises'),
(412, 'user', 'Create New Prescription', 'create-new-prescription', 'Create New Prescription'),
(413, 'user', 'Clinical Diagnosis', 'clinical-diagnosis', 'Clinical Diagnosis'),
(414, 'user', 'Additional Advices', 'additional-advices', 'Additional Advices'),
(415, 'user', 'Advice', 'advice', 'Advice'),
(416, 'user', 'Diagnosis Tests', 'diagnosis-tests', 'Diagnosis Tests'),
(417, 'user', 'Next Follow Up', 'next-follow-up', 'Next Follow Up'),
(418, 'user', 'Select time', 'select-time', 'Select time'),
(419, 'user', ' Patient is required', 'patient-is-required', ' Patient is required'),
(420, 'user', 'Add New Patient', 'add-new-patient', 'Add New Patient'),
(421, 'user', 'Add New Drug', 'add-new-drug', 'Add New Drug'),
(422, 'user', 'Drug is required', 'drug-is-required', 'Drug is required'),
(423, 'user', 'Days', 'days', 'Days'),
(424, 'user', 'Months', 'months', 'Months'),
(425, 'user', 'Years', 'years', 'Years'),
(426, 'user', 'Before/After Meals', 'beforeafter-meals', 'Before/After Meals'),
(427, 'user', 'After Meal', 'after-meal', 'After Meal'),
(428, 'user', 'Before Meal', 'before-meal', 'Before Meal'),
(429, 'user', 'Preview', 'preview', 'Preview'),
(430, 'user', 'Add Patient', 'add-patient', 'Add Patient'),
(431, 'user', 'Age', 'age', 'Age'),
(432, 'user', 'Weight', 'weight', 'Weight'),
(433, 'user', 'Gender', 'gender', 'Gender'),
(434, 'user', 'Male', 'male', 'Male'),
(435, 'user', 'Female', 'female', 'Female'),
(436, 'user', 'Add Drug', 'add-drug', 'Add Drug'),
(437, 'user', 'Patient Name', 'patient-name', 'Patient Name'),
(438, 'user', 'Select Patient', 'select-patient', 'Select Patient'),
(439, 'user', 'Select Drug', 'select-drug', 'Select Drug'),
(440, 'user', 'Remove Group', 'remove-group', 'Remove Group'),
(441, 'user', 'Select days', 'select-days', 'Select days'),
(442, 'user', 'Lab Reports', 'lab-reports', 'Lab Reports'),
(443, 'user', 'Feedback', 'feedback', 'Feedback'),
(444, 'user', 'View Feedback', 'view-feedback', 'View Feedback'),
(445, 'user', 'Write', 'write', 'Write'),
(446, 'user', 'Pay Now', 'pay-now', 'Pay Now'),
(447, 'user', 'Print', 'print', 'Print'),
(448, 'user', 'Upload Report', 'upload-report', 'Upload Report'),
(449, 'user', 'Create as New', 'create-as-new', 'Create as New'),
(450, 'user', 'All Prescriptions', 'all-prescriptions', 'All Prescriptions'),
(451, 'user', 'Upload Test Report', 'upload-test-report', 'Upload Test Report'),
(452, 'user', 'Test Reports', 'test-reports', 'Test Reports'),
(453, 'user', 'Submit Report Feedback', 'submit-report-feedback', 'Submit Report Feedback'),
(454, 'user', 'Created', 'created', 'Created'),
(455, 'user', 'Feedback - Available', 'feedback-available', 'Feedback - Available'),
(456, 'user', 'Report Submitted', 'report-submitted', 'Report Submitted'),
(457, 'user', 'Feedback - Pending', 'feedback-pending', 'Feedback - Pending'),
(458, 'user', 'View Prescription', 'view-prescription', 'View Prescription'),
(459, 'user', 'Edit Prescription', 'edit-prescription', 'Edit Prescription'),
(460, 'user', 'All Patients', 'all-patients', 'All Patients'),
(461, 'user', 'Present Address', 'present-address', 'Present Address'),
(462, 'user', 'Permanent Address', 'permanent-address', 'Permanent Address'),
(463, 'user', 'Add new Patients', 'add-new-patients', 'Add new Patients'),
(464, 'user', 'Add Appointment', 'add-appointment', 'Add Appointment'),
(465, 'user', 'Old Patient', 'old-patient', 'Old Patient'),
(466, 'user', 'New Patient', 'new-patient', 'New Patient'),
(467, 'user', 'Add Serial', 'add-serial', 'Add Serial'),
(468, 'user', 'List by date', 'list-by-date', 'List by date'),
(469, 'user', 'Appointments list by date', 'appointments-list-by-date', 'Appointments list by date'),
(470, 'user', 'See List', 'see-list', 'See List'),
(471, 'user', 'Patients Serial List', 'patients-serial-list', 'Patients Serial List'),
(472, 'user', 'Remove this patient', 'remove-this-patient', 'Remove this patient'),
(473, 'user', 'Fee', 'fee', 'Fee'),
(474, 'user', 'Set Appointments Schedule', 'set-appointments-schedule', 'Set Appointments Schedule'),
(475, 'user', 'Start time', 'start-time', 'Start time'),
(476, 'user', 'End time', 'end-time', 'End time'),
(477, 'user', 'Update Info', 'update-info', 'Update Info'),
(478, 'user', 'Specialist', 'specialist', 'Specialist'),
(479, 'user', 'Degree', 'degree', 'Degree'),
(480, 'user', 'About me', 'about-me', 'About me'),
(481, 'user', 'Change Avatar', 'change-avatar', 'Change Avatar'),
(482, 'user', 'Year to years', 'year-to-years', 'Year to years'),
(483, 'user', 'Label', 'label', 'Label'),
(484, 'user', 'Keyword', 'keyword', 'Keyword'),
(485, 'user', 'Value', 'value', 'Value'),
(486, 'admin', 'Insert your translate value here', 'insert-your-translate-value-here', 'Insert your translate value here'),
(487, 'front', 'Email resend successfully', 'email-resend-successfully', 'Email resend successfully'),
(488, 'user', 'Yes', 'yes', 'Yes'),
(489, 'user', 'Added Successfully', 'added-successfully', 'Added Successfully'),
(490, 'front', 'Verify Code', 'verify-code', 'Verify Code'),
(491, 'admin', 'Prescription created successfully', 'prescription-created-successfully', 'Prescription created successfully'),
(492, 'admin', 'You are ready to start a live consultation with your patient', 'ready-to-start-a-live', 'You are ready to start a live consultation with your patient'),
(493, 'admin', 'Yes, Start It', 'yes-start', 'Yes, Start It'),
(494, 'admin', 'Set this chamber as a default', 'set-this-chamber-default', 'Set this chamber as a default'),
(495, 'admin', 'Cancel this user serial', 'cancel-this-user-serial', 'Cancel this user serial'),
(496, 'admin', 'Serial cancel successfully', 'serial-cancel-success', 'Serial cancel successfully'),
(497, 'user', 'Enter Note', 'enter-note', 'Enter Note'),
(498, 'admin', 'Inserted Successfully !', 'inserted-successfully', 'Inserted Successfully !'),
(499, 'admin', 'Updated Successfully !', 'updated-successfully', 'Updated Successfully !'),
(500, 'user', 'Patient already registered', 'patient-already-registered', 'Patient already registered'),
(501, 'user', 'Please select a valid date', 'please-select-a-valid-date', 'Please select a valid date'),
(502, 'user', 'Appointment schedule assigned successfully', 'schedule-assigned-successfully', 'Appointment schedule assigned successfully'),
(503, 'user', 'You have reached the maximum limit! Please upgrade your plan.', 'reached-maximum-limit', 'You have reached the maximum limit! Please upgrade your plan.'),
(504, 'user', 'Activate Successfully', 'activate-successfully', 'Activate Successfully'),
(505, 'user', 'Deactivate Successfully', 'deactivate-successfully', 'Deactivate Successfully'),
(506, 'user', 'Meeting canceled successfully', 'meeting-canceled-successfully', 'Meeting canceled successfully'),
(507, 'user', 'Feedback Summited Successfully', 'summited-successfully', 'Feedback Summited Successfully'),
(508, 'user', 'Message send successfully', 'message-send-successfully', 'Message send successfully'),
(509, 'front', 'days free trial', 'days-free-trial', 'days free trial'),
(510, 'admin', 'Multilingual System', 'multilingual-system', 'Multilingual System'),
(511, 'admin', 'Enable to allow multilingual system', 'enable-multilingual', 'Enable to allow multilingual system'),
(512, 'user', 'Join', 'join', 'Join'),
(513, 'user', 'Doctors', 'doctors', 'Doctors'),
(514, 'user', 'Reviews', 'reviews', 'Reviews'),
(515, 'user', 'Average Rating', 'average-rating', 'Average Rating'),
(516, 'user', 'Ratings by users', 'ratings-by-users', 'Ratings by user'),
(517, 'user', 'Rating & Reviews', 'rating-reviews', 'Rating & Reviews'),
(518, 'user', 'Ratings', 'ratings', 'Ratings'),
(519, 'user', 'Rating & Review System', 'rating-review-system', 'Rating & Review System'),
(520, 'user', 'Enable', 'enable', 'Enable'),
(521, 'user', 'Disable', 'disable', 'Disable'),
(522, 'user', 'rating in frontend', 'rating-in-frontend', 'rating in frontend'),
(523, 'user', 'Provide your feedback', 'provide-your-feedback', 'Provide your feedback'),
(524, 'user', 'Your Feedback', 'your-feedback', 'Your Feedback'),
(525, 'user', 'Drug', 'drug', 'Drug'),
(526, 'user', 'Appointment', 'appointment', 'Appointment'),
(527, 'admin', 'Set 0 to hide trial option', 'set-trial-info', 'Set 0 to disable trial option'),
(528, 'user', 'Invitation link', 'invitation-link', 'Invitation link'),
(529, 'admin', 'Advise', 'advise', 'Advise'),
(530, 'admin', 'Diagnosis', 'diagnosis', 'Diagnosis'),
(531, 'admin', 'Profile page', 'profile-page', 'Profile page'),
(532, 'admin', 'Sunday', 'Sunday', 'Sunday'),
(533, 'admin', 'Monday', 'Monday', 'Monday'),
(534, 'admin', 'Tuesday', 'Tuesday', 'Tuesday'),
(535, 'admin', 'Wednesday', 'Wednesday', 'Wednesday'),
(536, 'admin', 'Thursday', 'Thursday', 'Thursday'),
(537, 'admin', 'Friday', 'Friday', 'Friday'),
(538, 'admin', 'Saturday', 'Saturday', 'Saturday'),
(539, 'front', 'We have send a verification code in your email.', 'send-verification-code', 'We have send a verification code in your email.'),
(540, 'front', 'Verify Code', 'verify-code', 'Verify Code'),
(541, 'front', 'Still don\'t received the code?', 'dont-received-code', 'Still don\'t received the code?'),
(542, 'front', 'Resend', 'Resend', 'Resend'),
(543, 'front', 'Sending', 'sending', 'Sending'),
(544, 'front', 'Payment - Upgrade Plan', 'payment-upgrade-plan', 'Payment - Upgrade Plan'),
(545, 'front', 'Pay Now', 'pay-now', 'Pay Now'),
(546, 'front', 'Payment Details ', 'payment-details', 'Payment Details '),
(547, 'front', 'Name on card', 'name-card', 'Name on card'),
(548, 'front', 'Card Number', 'card-number', 'Card Number'),
(549, 'front', 'Expiration month', 'expiration-month', 'Expiration month'),
(550, 'front', 'Expiration year', 'expiration-year', 'Expiration year'),
(551, 'admin', 'Item', 'item', 'Item'),
(552, 'admin', 'Price', 'price', 'Price'),
(553, 'admin', 'Total', 'total', 'Total'),
(554, 'admin', 'Sub Total', 'sub-total', 'Sub Total'),
(555, 'admin', 'Print', 'print', 'Print'),
(556, 'admin', 'Invoice', 'invoice', 'Invoice'),
(557, 'admin', 'Transaction', 'transaction', 'Transaction'),
(558, 'admin', 'Payments', 'payments', 'Payments'),
(559, 'admin', 'Invoices', 'invoices', 'Invoices'),
(560, 'admin', 'Transactions', 'transactions', 'Transactions'),
(561, 'user', 'Before start live consultation please make sure you have started the meeting manually from your zoom app', 'zoom-start-info', 'Before start live consultation please make sure you have started the meeting manually from your zoom app'),
(562, 'admin', 'Created', 'created', 'Created'),
(563, 'admin', 'Not Created', 'not-created', 'Not Created'),
(564, 'admin', 'Prescription is not created yet', 'prescription-not-created-yet', 'Prescription is not created yet'),
(565, 'front', 'Open', 'open', 'Open'),
(566, 'admin', 'Appearance', 'appearance', 'Appearance'),
(567, 'admin', 'Set Theme', 'set-theme', 'Set Theme');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `monthly_price` decimal(10,2) DEFAULT NULL,
  `bill_type` varchar(255) DEFAULT NULL,
  `is_special` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `slug`, `price`, `monthly_price`, `bill_type`, `is_special`, `status`) VALUES
(1, 'Free', 'basic', '0.00', '0.00', 'year', 0, 1),
(2, 'Standard', 'standared', '35.00', '14.00', 'year', 1, 1),
(3, 'Premium', 'premium', '1000.00', '30.00', 'year', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `details`, `status`, `created_at`) VALUES
(1, 'Terms and Conditions', 'terms-of-service', 'Terms and Conditions', NULL, '0000-00-00 00:00:00'),
(2, 'Privacy Policy', 'privacy-policy', 'Privacy Policy', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patientses`
--

CREATE TABLE `patientses` (
  `id` int(11) NOT NULL,
  `chamber_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mr_number` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `age` tinyint(2) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `sex` varchar(11) DEFAULT NULL,
  `mobile` varchar(13) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'patient',
  `verify_code` varchar(255) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `puid` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` varchar(255) DEFAULT NULL,
  `billing_type` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `expire_on` date DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `puid`, `user_id`, `package_id`, `billing_type`, `amount`, `status`, `created_at`, `expire_on`, `payment_method`) VALUES
(1, '54872', 1, '1', 'monthly', '0.00', 'pending', '2021-03-18', '2021-04-18', NULL),
(2, '83265', 1, '1', 'monthly', '0.00', 'pending', '2021-03-18', '2021-04-18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_user`
--

CREATE TABLE `payment_user` (
  `id` int(11) NOT NULL,
  `puid` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `chamber_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `next_visit` varchar(255) NOT NULL,
  `check_report` int(11) DEFAULT NULL,
  `feedback` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_items`
--

CREATE TABLE `prescription_items` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `time_periods` varchar(255) NOT NULL,
  `medicine_time` varchar(255) NOT NULL,
  `duration_text` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pre_advice`
--

CREATE TABLE `pre_advice` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `advice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pre_ad_advices`
--

CREATE TABLE `pre_ad_advices` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `ad_advices_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pre_diagonosis`
--

CREATE TABLE `pre_diagonosis` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `diagonosis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pre_investigation`
--

CREATE TABLE `pre_investigation` (
  `id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `investigation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_services`
--

CREATE TABLE `product_services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `orders` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `hero_img` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `footer_about` text DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `pagination_limit` int(11) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `google_analytics` longtext DEFAULT NULL,
  `site_color` varchar(255) DEFAULT NULL,
  `site_font` varchar(255) DEFAULT NULL,
  `layout` int(11) DEFAULT NULL,
  `about_info` mediumtext DEFAULT NULL,
  `ind_code` varchar(255) DEFAULT NULL,
  `purchase_code` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `enable_captcha` int(11) NOT NULL DEFAULT 0,
  `enable_workflow` int(11) NOT NULL DEFAULT 1,
  `enable_users` int(11) NOT NULL DEFAULT 1,
  `enable_blog` int(11) NOT NULL,
  `enable_faq` int(11) NOT NULL,
  `enable_registration` int(11) NOT NULL,
  `enable_payment` int(11) NOT NULL,
  `enable_paypal` int(11) NOT NULL DEFAULT 0,
  `enable_email_verify` int(11) NOT NULL,
  `enable_multilingual` int(11) DEFAULT 0,
  `captcha_type` int(11) DEFAULT NULL,
  `captcha_site_key` varchar(255) DEFAULT NULL,
  `captcha_secret_key` varchar(255) DEFAULT NULL,
  `paypal_email` varchar(255) DEFAULT NULL,
  `paypal_payment` int(11) DEFAULT 0,
  `stripe_payment` int(11) DEFAULT 0,
  `publish_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `paypal_mode` varchar(255) DEFAULT 'sandbox',
  `mail_protocol` varchar(255) DEFAULT NULL,
  `mail_title` varchar(255) DEFAULT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `mail_encryption` varchar(255) DEFAULT 'ssl',
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `country` int(11) NOT NULL DEFAULT 178,
  `site_info` int(11) DEFAULT NULL,
  `zoom_api_key` mediumtext DEFAULT NULL,
  `zoom_secret_key` mediumtext DEFAULT NULL,
  `lang` int(11) NOT NULL DEFAULT 1,
  `trial_days` int(11) DEFAULT 0,
  `theme` int(11) DEFAULT 1,
  `version` varchar(255) NOT NULL DEFAULT 'v1.1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_title`, `favicon`, `logo`, `hero_img`, `keywords`, `description`, `footer_about`, `admin_email`, `mobile`, `copyright`, `pagination_limit`, `facebook`, `instagram`, `twitter`, `linkedin`, `google_analytics`, `site_color`, `site_font`, `layout`, `about_info`, `ind_code`, `purchase_code`, `link`, `enable_captcha`, `enable_workflow`, `enable_users`, `enable_blog`, `enable_faq`, `enable_registration`, `enable_payment`, `enable_paypal`, `enable_email_verify`, `enable_multilingual`, `captcha_type`, `captcha_site_key`, `captcha_secret_key`, `paypal_email`, `paypal_payment`, `stripe_payment`, `publish_key`, `secret_key`, `paypal_mode`, `mail_protocol`, `mail_title`, `mail_host`, `mail_port`, `mail_encryption`, `mail_username`, `mail_password`, `country`, `site_info`, `zoom_api_key`, `zoom_secret_key`, `lang`, `trial_days`, `theme`, `version`) VALUES
(1, 'Doxe', 'SaaS Doctors appointment & prescription software', 'uploads/thumbnail/cloud_copy_thumb-60x60.png', 'uploads/medium/logo-final_medium-241x88.png', 'uploads/medium/online-doctor-concept-illustration_114360-1831_medium-626x626.jpg', 'saas,prescription,appointment,doctors', 'Simplifies prescription and appointments, helping you to manage patients & chambers in a smart way. Create your first prescription in less than 60 seconds.', 'Doxe is a complete SaaS-based doctors appointment & prescription Software that gives your customers the ability to create and manage staffs, prescriptions, patients, drugs, advises, investigations, appointments etc. Users also can create multiple chambers & assign staffs so they can easily keep track of their chambers, patients & appointments in one platform.', 'admin@gmail.com', '', '© 2021 All rights reserved.', 0, 'https://www.facebook.com/', 'facebook.com', '', 'linkedin', '', '#ddd', 'Alata', 0, 'SW52YWxpZCBMaWNlbnNlIEtleQ==', '', '', 'aHR0cHM6Ly9jZG5qcy5jbG91ZGZsYXJlLmNvbS9hamF4L2xpYnMv', 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, NULL, '', '', 'your_paypal@mail.com', 1, 1, 'pk_test_miL3pzy2WRveqVtkSvnAiyEk00TbcdiWmW', 'sk_test_zHkX8tpxqezUjxwKKrOENoKH00i4EnkxdN', 'sandbox', 'smtp', '', '', '', 'ssl', '', '', 178, 1, '', '', 1, 15, 2, '1.3');

-- --------------------------------------------------------

--
-- Table structure for table `site_contacts`
--

CREATE TABLE `site_contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chamber_id` int(11) NOT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag_slug` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bn_name` varchar(255) DEFAULT NULL,
  `degree` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT 'user',
  `account_type` varchar(255) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT 'registered',
  `trial_expire` date DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email_verified` int(11) DEFAULT 0,
  `verify_code` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `paypal_payment` int(11) DEFAULT 1,
  `stripe_payment` int(11) DEFAULT 1,
  `paypal_email` varchar(255) DEFAULT NULL,
  `publish_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `country` int(11) DEFAULT NULL,
  `currency` varchar(255) DEFAULT 'USD',
  `paypal_mode` varchar(255) DEFAULT 'live',
  `about_me` varchar(5000) DEFAULT NULL,
  `exp_years` int(11) DEFAULT NULL,
  `available_days` varchar(255) DEFAULT NULL,
  `google_analytics` text DEFAULT NULL,
  `enable_appointment` int(11) NOT NULL DEFAULT 1,
  `enable_rating` int(11) DEFAULT 1,
  `specialist` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_advises`
--
ALTER TABLE `additional_advises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advises`
--
ALTER TABLE `advises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advise_investigations`
--
ALTER TABLE `advise_investigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assaign_days`
--
ALTER TABLE `assaign_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_time`
--
ALTER TABLE `assign_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chamber`
--
ALTER TABLE `chamber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chamber_category`
--
ALTER TABLE `chamber_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `diagnosis_reports`
--
ALTER TABLE `diagnosis_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagonosis`
--
ALTER TABLE `diagonosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evisit_settings`
--
ALTER TABLE `evisit_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_assaign`
--
ALTER TABLE `feature_assaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang_values`
--
ALTER TABLE `lang_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patientses`
--
ALTER TABLE `patientses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_user`
--
ALTER TABLE `payment_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription_items`
--
ALTER TABLE `prescription_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_advice`
--
ALTER TABLE `pre_advice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_ad_advices`
--
ALTER TABLE `pre_ad_advices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_diagonosis`
--
ALTER TABLE `pre_diagonosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_investigation`
--
ALTER TABLE `pre_investigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_services`
--
ALTER TABLE `product_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_contacts`
--
ALTER TABLE `site_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_advises`
--
ALTER TABLE `additional_advises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advises`
--
ALTER TABLE `advises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advise_investigations`
--
ALTER TABLE `advise_investigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assaign_days`
--
ALTER TABLE `assaign_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_time`
--
ALTER TABLE `assign_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chamber`
--
ALTER TABLE `chamber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chamber_category`
--
ALTER TABLE `chamber_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `diagnosis_reports`
--
ALTER TABLE `diagnosis_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diagonosis`
--
ALTER TABLE `diagonosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evisit_settings`
--
ALTER TABLE `evisit_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feature_assaign`
--
ALTER TABLE `feature_assaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lang_values`
--
ALTER TABLE `lang_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=568;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patientses`
--
ALTER TABLE `patientses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_user`
--
ALTER TABLE `payment_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription_items`
--
ALTER TABLE `prescription_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_advice`
--
ALTER TABLE `pre_advice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_ad_advices`
--
ALTER TABLE `pre_ad_advices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_diagonosis`
--
ALTER TABLE `pre_diagonosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pre_investigation`
--
ALTER TABLE `pre_investigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_services`
--
ALTER TABLE `product_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_contacts`
--
ALTER TABLE `site_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
