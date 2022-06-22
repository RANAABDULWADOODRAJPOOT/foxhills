-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 01:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `question_foxhills`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(10) UNSIGNED NOT NULL,
  `agentname` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Licence` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Desigination` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Language` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `agentname`, `Licence`, `picture`, `Desigination`, `created_at`, `updated_at`, `description`, `experience`, `Language`) VALUES
(3, 'Ahmed Taha', '256633', '1655228230-user_386849_350_ce1df19292c5c9d06fa4473be6b593086d714077.jpg', 'Associate Director', '2022-06-04 10:27:14', '2022-06-14 12:37:10', 'Aleksandra is a Senior Global Property Consultant at Luxhabitat Sotheby\'s International Realty. She has been working within the Dubai sales industry since 2011. Her previous accolades in real estate include Agent of the year with the highest single volume transaction. With strong leadership skills, Aleksandra quickly climbed the real estate ladder to attain a managerial position in 4 years. She has considerable experience in dealing with HNW clients and has successfully worked with various GCC HNWIs. Aleksandra loves travelling to exotic destinations and exploring culture and traditions. She is passionate about the environmental sustainability movement and development since 2004. Aleksandra specialises in the areas of EMAAR Beachfront, Palm Jumeirah, Dubai Marina, and JBR for residential apartments.', '16', 'Arabic'),
(5, 'Lena', '5333669', '1655228243-user_484342_350_2461c381aa842b19e6e4a20d3bc6b35f3e7114a6.jpg', 'Associate Director', '2022-06-14 11:54:58', '2022-06-14 12:37:23', 'Language', '14', 'English'),
(17, 'Ahmed Lababidi', '522233', '1655228260-user_487602_350_9f51722b984b1b331279723faa2776d6e5de06cf.jpg', 'Associate Director', '2022-06-14 12:09:08', '2022-06-14 12:37:40', 'Ahmed Lababidi is an Associate Director at Luxhabitat Sotheby\'s International Realty. Ahmed brings 12 years of experience in the real estate market, with a special focus on luxury property developments. Whether you are buying a dream home, selling a property or building a diverse investment portfolio, Ahmed has the knowledge and passion to help his clients achieve the results they seek. Ahmed is a trusted agent who goes above and beyond for all his clients providing them with excellent client service and a commitment to work hard, listen and follow through. He is known for his in-depth market knowledge and offering professional opinion by educating clients on where to invest capital to maximize their returns. Ahmed focuses on areas like Downtown Dubai, Palm Jumeirah, and Dubai Hills Estates Mansions, as well as prestigious developments across prime locations in Dubai. Ahmed started his real estate career in the Toronto market (Canada), where he quickly became a top producing broker then went on to over achiev', '12', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `available_properties`
--

CREATE TABLE `available_properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `productname` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Area` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Bedrooms` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Speciality` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `picture` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Category` int(11) NOT NULL,
  `Completion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bannerimage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '30.6333308',
  `lon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '72.8666632',
  `bathrooms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `available_properties`
--

INSERT INTO `available_properties` (`id`, `productname`, `city`, `Description`, `Price`, `Area`, `Bedrooms`, `length`, `Speciality`, `property_type_id`, `picture`, `Category`, `Completion`, `status`, `created_at`, `updated_at`, `agent`, `bannerimage`, `lat`, `lon`, `bathrooms`) VALUES
(1, 'Villa on Palm Jumeirah', 'dubai', 'This unique and contemporary villa has an Albertina floor plan that encompasses a light-flooded living room, dining room and family area, all of which are adorned by grand arches with a charming aesthetic. The kitchen is open plan with a centre island, Miele appliances, a breakfast bar and large windows that open onto the garden. Also on the ground floor is an entry hall, an interior patio with an olive tree, a guest powder room and an en-suite guest bedroom. Upstairs there are two bedrooms with en-suite bathrooms and a super spacious master bedroom suite with an en-suite bathroom, walk-in wardrobe and balcony. Outside, it is immediately obvious how perfect this luxury property is for those who love to entertain. The exterior features a vast landscaped garden with a gazebo, BBQ area and its own private swimming pool, all of which have stunning lake views.', '200000', 'dubai west', '6', '6000', 'available', 1, '1653856349-149d3e58b4426706ad93c1cf2b53400a0b24fbf54a84aa1e7a51176c4820091f.jpg', 1, '0', '1', '2022-05-23 15:29:12', '2022-06-22 06:12:47', '3', '2657013495648-five.jpg', '30.6333308', '72.8666632', '3'),
(2, 'Villa in Millennium Estates', 'dubai', 'Meydan Gated Community', '200000', 'dubai west', '6', '6000', 'available', 1, '1653856501-170e10837841482322222748d201c781aef10164c0e93fef863db6bc7b95b1de.jpg', 1, '0', '1', '2022-05-25 14:48:55', '2022-06-13 13:57:49', '2', '7993000841908-four.jpg', '30.6333308', '72.8666632', '0'),
(3, 'Palm Jumeirah', 'Spain', 'Brand New Designer Villa on Palm Jumeirah', '200000', 'spain center', '6', '89999', 'Avaliable', 2, '1653856515-c18e25d12045e4bc5011978819445aa1f005287a6d4e36094548eb4b1f3f5295.jpg', 1, '0', '1', '2022-05-25 16:30:12', '2022-06-13 13:58:10', '2', '5090156529496-one.jpg', '30.6333308', '72.8666632', '0'),
(4, 'LIV Marina', 'Spain', 'Located in Dubai Marina', '200000', 'spain center', '4', '89999', 'Avaliable', 2, '1653857699-343eb9c4564ce96e2d273bb9881927c9b39cb298679ca56d03f55697b28d43cf.jpg', 1, '0', '1', '2022-05-25 16:33:16', '2022-06-13 13:58:30', '2', '837293279627-five.jpg', '30.6333308', '72.8666632', '0'),
(5, 'Mr C Residences', 'Spain', 'Located in Jumeirah', '200000', 'spain center', '8', '899', 'Avaliable', 2, '1653857732-616787e923e2a051e949fcf403b20b84f566c9dc894ef805e86468da519711ea.jpg', 1, '0', '1', '2022-05-25 16:37:37', '2022-06-13 13:58:50', '2', '73289181871-two.jpg', '30.6333308', '72.8666632', '0'),
(6, 'Ritz Carlton Residences', 'Spain', 'Located in Creekside', '200000', 'spain center', '6', '899', 'Avaliable', 2, '1653857752-d2bd9a9e552c035d769a63ec59aa3bc5c37abc8aa613fc53ac24d53b77f5f6e6.jpg', 1, '0', '1', '2022-05-25 16:39:20', '2022-06-13 13:59:10', '2', '7076911585521-three.jpg', '30.6333308', '72.8666632', '0'),
(7, 'Ritz Carlton Residences', 'Spain', 'Located in Creekside', '200000', 'spain center', '6', '89999', 'Avaliable', 3, '1653857828-08dd96dca9ef6c755d2b0cf276c15d1e997d8aa4074e8b64775b98c554a4dfbf.jpg', 1, '0', '1', '2022-05-25 16:42:56', '2022-06-13 13:59:44', '2', '9682343214859-five.jpg', '30.6333308', '72.8666632', '0'),
(8, 'Six Senses Residences', 'Spain', 'Located in Palm Jumeirah', '200000', 'spain center', '6', '899', 'Avaliable', 3, '1653857861-db00ee4b2a8ddb5d9cc542ea9ef7bf37.jpg', 1, '0', '1', '2022-05-25 16:44:39', '2022-06-13 14:00:11', '2', '7160411964333-four.jpg', '30.6333308', '72.8666632', '0'),
(9, 'St Regis The Residences', 'Spain', 'Located in Downtown Dubai', '200000', 'spain center x-axis', '8', '899', 'Avaliable', 3, '1653857984-354337e4a03ac0a71024c6383dec09bb035750a5912511bbbb0f1c5912ebc280.jpg', 1, '0', '1', '2022-05-25 16:46:12', '2022-06-13 14:00:32', '2', '2969358496711-four.jpg', '30.6333308', '72.8666632', '0'),
(10, 'Six Senses Residences', 'Spain', 'Located in Palm Jumeirah', '200000', 'spain center', '6', '899', 'Avaliable', 1, '1653878037-616787e923e2a051e949fcf403b20b84f566c9dc894ef805e86468da519711ea.jpg', 2, '0', '1', '2022-05-25 17:02:26', '2022-06-13 14:00:59', '2', '4191469252839-one.jpg', '30.6333308', '72.8666632', '0'),
(11, 'Mr C Residences', 'Spain', 'Located in Jumeirah', '200000', 'spain center', '4', '899', 'Avaliable', 3, '1653878109-d2bd9a9e552c035d769a63ec59aa3bc5c37abc8aa613fc53ac24d53b77f5f6e6.jpg', 4, '0', '1', '2022-05-25 17:04:55', '2022-06-13 14:01:26', '2', '1634664685276-three.jpg', '30.6333308', '72.8666632', '0'),
(15, 'Palm Jumeirah', 'Spain', 'good', '200000', 'spain center', '6', '899', 'Avaliable', 1, '1653878037-616787e923e2a051e949fcf403b20b84f566c9dc894ef805e86468da519711ea.jpg', 6, '0', '1', '2022-05-25 18:03:34', '2022-05-25 18:03:34', NULL, NULL, '30.6333308', '72.8666632', '0'),
(16, 'Al Barari', 'Spain', 'good', '200000', 'spain center', '6', '899', 'Avaliable', 1, '1653878109-d2bd9a9e552c035d769a63ec59aa3bc5c37abc8aa613fc53ac24d53b77f5f6e6.jpg', 7, '0', '1', '2022-05-25 18:14:00', '2022-05-25 18:14:00', NULL, NULL, '30.6333308', '72.8666632', '0'),
(17, 'Neighborhood Guides', 'Spain', 'good', '200000', 'spain center', '6', '89999', 'Avaliable', 1, '1653878037-616787e923e2a051e949fcf403b20b84f566c9dc894ef805e86468da519711ea.jpg', 8, '0', '1', '2022-05-25 18:17:12', '2022-05-25 18:17:12', NULL, NULL, '30.6333308', '72.8666632', '0'),
(18, 'Downtown Dubai', 'Spain', 'good', '200000', 'spain center', '4', '899', 'Avaliable', 1, '1653878109-d2bd9a9e552c035d769a63ec59aa3bc5c37abc8aa613fc53ac24d53b77f5f6e6.jpg', 6, '0', '1', '2022-05-25 18:18:15', '2022-05-25 18:18:15', NULL, NULL, '30.6333308', '72.8666632', '0'),
(19, 'Villa on Palm Jumeirah stars', 'dubai', 'This is very good villai', '200000', 'dubai west', '6', '6000', 'available', 2, '1653877993-b847ecd2ea7bcf276dba1db804012c5d.jpeg', 2, '0', '1', '2022-05-25 21:22:55', '2022-06-13 14:02:21', '2', '8600570377933-four.jpg', '30.6333308', '72.8666632', '0'),
(20, 'KOhshan', 'Dubai', 'The ‘Street of Dreams’ is a coveted cul-de-sac in the Dubai Hills Grove sub-community of the Dubai Hills area. It hosts only 26 mansions and is one of the preferred addresses of the city’s wealthiest residents, where the villas are currently valued at AED 100 million plus. When initially released, the villas were bought shell and core for the owners to refurbish and make their own, giving rise to a range of architectural and interior styles. In recent times, LUXHABITAT Sotheby’s had also sold a mansion called ‘The Tree of Life’ in the same area last year for AED 103 million - at the time it was also the most expensive villa transaction in Dubai Hills.', '20000000', '2990 sqft', '3', '12345', 'okay', 1, '1653893063-EMAAR_BeachFrontPlot12_CGI10_02.jpg', 1, 'today', '1', '2022-05-30 06:44:23', '2022-06-13 14:02:39', '2', '5699982009475-four.jpg', '30.6333308', '72.8666632', '0'),
(28, 'New', 'Sahiwal', 'nEW', '458', 'dubai', '5', '5', '12', 1, '1655838393-0e83b194-6110-42db-ac1c-8f3095100b5c_1.8eec393a72d08a0c6b9c134f7d5e0052.jpeg', 2, '50', '1', '2022-06-21 14:06:33', '2022-06-21 14:10:38', '3', '7290916209024-1.PNG', '25.276987', '55.296249', '0');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_contents`
--

CREATE TABLE `general_contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `productname` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Area` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Bedrooms` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Speciality` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `picture` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Category` int(11) NOT NULL,
  `Completion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '30.6333308',
  `lon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '72.8666632',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(10) UNSIGNED NOT NULL,
  `journal_type` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `journal_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Publish_date` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `journal_type`, `journal_title`, `picture`, `Publish_date`, `description`, `created_at`, `updated_at`) VALUES
(2, 'The Agents', 'In The Studio: Mike Arnold', '1653858942-78c2a90d2653cd09669d4adb676f1a56.jpg', '8 June2004', 'UAE-based artist Mike Arnold worked as an architect for over four decades contributing to some of the Emirates’ most notable structures before...', '2022-05-25 16:56:28', '2022-06-15 13:48:47'),
(3, 'The Market', 'Design House: Erika Doyle', '1653858962-b847ecd2ea7bcf276dba1db804012c5d.jpeg', '6 April 2003', 'In this edition of \'Design House\', the founder of Drink Dry takes us on a tour of her family home in Arabian Ranches designed by Gabby Garvey of...', '2022-05-25 16:59:55', '2022-06-04 10:26:14'),
(4, 'Press Release', 'DUBAI HILLS MANSION SELLS FOR AED 128 M', '1653892159-11119.jpg', '30 May 2022', 'LUXHABITAT Sotheby’s International Realty is proud to announce the private sale of a Dubai Hills Grove mansion on the ‘Street of Dreams’ at AED 128 million, making it the most expensive villa sold in Dubai Hills this year to date. With a built-up area of 34,113 sq ft sitting on a plot of 42,518 sq ft, the seven-bedroom mansion was sold brand new. Never being lived in and in pristine condition, the home has a modern meets classic design with full golf course, lakes, and Downtown views. Besides its seven ensuite bedrooms, the villa also has an entertainment/ games room, a gym, spa, cinema room, and pool in addition to a rooftop terrace. The villa was listed off-market and was sold within a month. Both buyer and seller chose to remain anonymous.   <br> The ‘Street of Dreams’ is a coveted cul-de-sac in the Dubai Hills Grove sub-community of the Dubai Hills area. It hosts only 26 mansions and is one of the preferred addresses of the city’s wealthiest residents, where the villas are currently valued at AED 100 million plus. When initially released, the villas were bought shell and core for the owners to refurbish and make their own, giving rise to a range of architectural and interior styles. In recent times, LUXHABITAT Sotheby’s had also sold a mansion called ‘The Tree of Life’ in the same area last year for AED 103 million - at the time it was also the most expensive villa transaction in Dubai Hills.', '2022-05-30 06:29:19', '2022-05-30 06:30:39'),
(25, 'The Market', 'Design Talk: Purity', '1655075574-e67f41526c2e61d3d3e54a134449f526.jpg', '6 April 2003', 'Jonathan: This Dubai Hills Villa was a developer shell and core structure of 3000m2 overlooking the eighteenth hole of the highly regarded golf course with a spectacular backdrop of Dubai’s signature skyline, purchased by a private client from Europe through LUXHABITAT. LUXHABITAT started to lead the design process and then reached out to Anarchitect on behalf of the client by following their request to architecturally transform the existing shell they had purchased into a new, permanent home for the successful young family to relocate and set up a new life in Dubai.\r\n\r\n<img style=\"margin-top:10px;margin-bottom:10px;\" class=\"w-100 my-4\" height=\"350px;\" src=\"http://127.0.0.1:8000/assets/allimages/662358479022-56f27037ded1627c0e09fda71c32a488.jpg\" >\r\n\r\nEditor\'s note: This interior design & architecture project was in collaboration with the LUXHABITAT design team. The LUXHABITAT design team was in charge of the interior design, FF&E project and procurement & Anarchitect fulfilled the interior architecture scope of the project.\r\n\r\n<img style=\"margin-top:10px;margin-bottom:10px;\" class=\"w-100 my-4\" height=\"350px;\" src=\"http://127.0.0.1:8000/assets/allimages/662358479022-56f27037ded1627c0e09fda71c32a488.jpg\" >', '2022-06-12 18:12:54', '2022-06-12 18:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_10_183728_create_property_types_table', 1),
(6, '2022_05_10_225222_create_available_properties_table', 1),
(7, '2022_05_12_192505_create_journals_table', 1),
(8, '2022_05_16_112002_create_user_requests_table', 1),
(9, '2022_05_17_185115_create_pages_table', 1),
(10, '2022_05_17_213305_create_general_contents_table', 1),
(12, '2022_06_04_141504_create_agents_table', 2),
(13, '2022_06_11_124708_create_multipictures_table', 3),
(14, '2022_06_12_195746_create_multipleimageblogs_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `multipictures`
--

CREATE TABLE `multipictures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multipictures`
--

INSERT INTO `multipictures` (`id`, `product_id`, `picture`, `created_at`, `updated_at`) VALUES
(24, '1', '3494658429408-or.jpg', '2022-06-12 18:08:00', '2022-06-12 18:08:00'),
(25, '1', '9813279509147-or1.jpg', '2022-06-12 18:08:00', '2022-06-12 18:08:00'),
(26, '5', '9986440311250-45646464564.png', '2022-06-20 05:25:24', '2022-06-20 05:25:24'),
(27, '5', '555154082254-buyuk-200.png', '2022-06-20 05:25:24', '2022-06-20 05:25:24'),
(28, '5', '8926531775200-1.PNG', '2022-06-20 05:26:20', '2022-06-20 05:26:20'),
(29, '5', '9379863424851-1_1OBwwxzJksMv0YDD-XmyBw.png', '2022-06-20 05:26:20', '2022-06-20 05:26:20'),
(30, '1', '8781328055558-1.PNG', '2022-06-20 07:23:15', '2022-06-20 07:23:15'),
(31, '1', '1496549083983-3 (1).PNG', '2022-06-20 07:23:15', '2022-06-20 07:23:15'),
(32, '1', '5414756768263-000000RTRT.png', '2022-06-20 07:56:20', '2022-06-20 07:56:20'),
(33, '1', '351764859638-0e83b194-6110-42db-ac1c-8f3095100b5c_1.8eec393a72d08a0c6b9c134f7d5e0052.jpeg', '2022-06-20 07:56:20', '2022-06-20 07:56:20'),
(34, '1', '5987651129525-000000RTRT.png', '2022-06-21 06:22:19', '2022-06-21 06:22:19'),
(35, '1', '8290044394037-0e83b194-6110-42db-ac1c-8f3095100b5c_1.8eec393a72d08a0c6b9c134f7d5e0052.jpeg', '2022-06-21 06:22:19', '2022-06-21 06:22:19'),
(36, '1', '5068049349078-1_1OBwwxzJksMv0YDD-XmyBw.png', '2022-06-21 06:22:46', '2022-06-21 06:22:46'),
(37, '1', '2731987773354-3 (1).PNG', '2022-06-21 06:22:46', '2022-06-21 06:22:46'),
(38, '1', '9804360762547-0e83b194-6110-42db-ac1c-8f3095100b5c_1.8eec393a72d08a0c6b9c134f7d5e0052.jpeg', '2022-06-21 06:27:22', '2022-06-21 06:27:22'),
(39, '1', '399484389864-1.PNG', '2022-06-21 06:27:22', '2022-06-21 06:27:22'),
(40, '1', '7111687041122-5a39dcae047338.33721377151374148601824164.png', '2022-06-21 06:31:03', '2022-06-21 06:31:03'),
(41, '1', '4342644339796-5a902dbf7f96951c82922875.png', '2022-06-21 06:31:03', '2022-06-21 06:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `multipleimageblogs`
--

CREATE TABLE `multipleimageblogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multipleimageblogs`
--

INSERT INTO `multipleimageblogs` (`id`, `picture`, `created_at`, `updated_at`) VALUES
(21, '3721197079455-one.jpg', '2022-06-12 15:39:41', '2022-06-12 15:39:41'),
(22, '1784009100640-or.jpg', '2022-06-12 15:39:41', '2022-06-12 15:39:41'),
(23, '35481956356-or1.jpg', '2022-06-12 15:39:41', '2022-06-12 15:39:41'),
(24, '4925350994120-one.jpg', '2022-06-12 15:40:51', '2022-06-12 15:40:51'),
(25, '9338514241714-or.jpg', '2022-06-12 15:40:51', '2022-06-12 15:40:51'),
(26, '2348526682923-or1.jpg', '2022-06-12 15:40:51', '2022-06-12 15:40:51'),
(27, '662358479022-56f27037ded1627c0e09fda71c32a488.jpg', '2022-06-12 16:26:00', '2022-06-12 16:26:00'),
(28, '3705193308308-e5b95d4c434d4efb9695bd961e878a75.jpg', '2022-06-12 16:26:00', '2022-06-12 16:26:00'),
(29, '1995055130946-45646464564.png', '2022-06-20 05:23:36', '2022-06-20 05:23:36'),
(30, '4792492936454-buyuk-200.png', '2022-06-20 05:23:36', '2022-06-20 05:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `heading`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Buy', '1', '2022-05-23 14:50:45', '2022-05-23 14:50:45'),
(2, 'Rent', '1', '2022-05-23 14:51:01', '2022-05-23 14:51:01'),
(3, 'Locations', '1', '2022-05-23 14:51:17', '2022-05-23 14:51:17'),
(4, 'Curated Projects', '1', '2022-05-23 14:51:27', '2022-05-23 14:51:27'),
(5, 'International', '1', '2022-05-23 14:51:43', '2022-05-23 14:51:43'),
(6, 'Browse homes in', '2', '2022-05-25 17:07:29', '2022-05-25 17:07:29'),
(7, 'Neighborhood guides', '2', '2022-05-25 17:08:27', '2022-05-25 17:08:27'),
(8, 'Explore  Read more', '2', '2022-05-25 17:12:07', '2022-05-25 17:13:38'),
(9, 'Company', '2', '2022-05-25 17:12:58', '2022-05-25 17:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ranaabdulwadoodrajpoot@gmail.com', '$2y$10$NjfSNbRDt633lUPGT0XIIexHrZ9D1eZS2P9TjcYTRzsRqjduqYKFC', '2022-06-20 05:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Villas', '2022-05-23 14:52:19', '2022-05-23 14:52:19'),
(2, 'Apartments', '2022-05-23 14:52:30', '2022-05-23 14:52:30'),
(3, 'New Developments', '2022-05-23 14:52:43', '2022-05-30 06:49:03'),
(4, 'Lofts&Duplexes', '2022-05-23 14:52:53', '2022-05-23 14:52:53'),
(5, 'Plots', '2022-05-23 14:53:01', '2022-05-23 14:53:01'),
(6, 'Exclusive Properties', '2022-05-23 14:53:09', '2022-05-23 14:53:09'),
(7, 'New To Market', '2022-05-23 14:53:17', '2022-05-23 14:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$JFi8SSxZade54.Fi0/.tf.OflT/1JAHG1IrdkiG4FjIOYZ.//vwtK', NULL, '2022-05-23 14:42:26', '2022-05-23 14:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_request_type` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_requests`
--

INSERT INTO `user_requests` (`id`, `name`, `email`, `phone`, `description`, `user_request_type`, `created_at`, `updated_at`) VALUES
(1, 'Awais Sheikh', 'awaissheikh480@gmail.com', '03218444938', 'dsdsfds', 'Buy', '2022-05-25 20:37:33', '2022-05-25 20:37:33'),
(2, 'KOhshan Tariq', 'kohshan_tariq@live.com', '03000111152', 'sdfsadfsdfasdfasdfasdfsadf', 'Buy', '2022-05-30 11:52:25', '2022-05-30 11:52:25'),
(3, 'Abdul', 'abc@gmail.com', '1234567890', 'More', 'Buy', '2022-06-15 16:23:58', '2022-06-15 16:23:58'),
(4, 'Abdul', 'abc@gmaul.com', '123456789', 'message here', '', '2022-06-20 05:56:40', '2022-06-20 05:56:40'),
(5, 'Abdbul', 'abc@gmail.com', '3165671665', 'I\'d like to have more information about the property ID #  4', 'Buy', '2022-06-21 13:39:19', '2022-06-21 13:39:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `available_properties`
--
ALTER TABLE `available_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_contents`
--
ALTER TABLE `general_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multipictures`
--
ALTER TABLE `multipictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multipleimageblogs`
--
ALTER TABLE `multipleimageblogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_requests`
--
ALTER TABLE `user_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `available_properties`
--
ALTER TABLE `available_properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_contents`
--
ALTER TABLE `general_contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `multipictures`
--
ALTER TABLE `multipictures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `multipleimageblogs`
--
ALTER TABLE `multipleimageblogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
