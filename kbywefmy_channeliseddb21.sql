-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 23, 2021 at 01:09 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kbywefmy_channeliseddb21`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesstypes`
--

DROP TABLE IF EXISTS `businesstypes`;
CREATE TABLE IF NOT EXISTS `businesstypes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `businesstypes`
--

INSERT INTO `businesstypes` (`id`, `name`) VALUES
(1, 'Cross industry'),
(2, 'Agriculture Forestry, Fishing'),
(3, 'Accommodation and Food Services'),
(4, 'Administrative and Support Services'),
(5, 'Arts and Recreation Services'),
(6, 'Construction'),
(7, 'Education and Training'),
(8, 'Electricity, Gas, Water, Waste Services'),
(9, 'Financial and Insurance Services'),
(10, 'Health Care and Social Assistance'),
(11, 'Information Media and Telecommunications'),
(12, 'Manufacturing'),
(13, 'Mining'),
(14, 'Professional, Scientific, Technical Services'),
(15, 'Public Administration and Safety'),
(16, 'Rental, Hiring and Real Estate Services'),
(17, 'Retail Trade'),
(18, 'Transport, Postal and Warehousing'),
(19, 'Whosale Trade');

-- --------------------------------------------------------

--
-- Table structure for table `capability_primaries`
--

DROP TABLE IF EXISTS `capability_primaries`;
CREATE TABLE IF NOT EXISTS `capability_primaries` (
  `cpid` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`cpid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `capability_primaries`
--

INSERT INTO `capability_primaries` (`cpid`, `type`) VALUES
(1, 'Business Applications'),
(2, 'Application Development'),
(3, 'Cloud'),
(4, 'Data'),
(5, 'DevOps'),
(6, 'Infrastructure'),
(7, 'Security'),
(8, 'Services');

-- --------------------------------------------------------

--
-- Table structure for table `capability_secondaries`
--

DROP TABLE IF EXISTS `capability_secondaries`;
CREATE TABLE IF NOT EXISTS `capability_secondaries` (
  `csid` int(11) NOT NULL AUTO_INCREMENT,
  `cpid` int(10) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`csid`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `capability_secondaries`
--

INSERT INTO `capability_secondaries` (`csid`, `cpid`, `type`) VALUES
(1, 1, 'CRM'),
(2, 1, 'ERP'),
(3, 1, 'RPA'),
(4, 1, 'EMR'),
(5, 1, 'SaaS'),
(6, 1, 'BPM'),
(7, 1, 'Blockchain'),
(8, 1, 'Commerce'),
(9, 1, 'Portal'),
(10, 2, 'Web'),
(11, 2, 'Mobile'),
(12, 2, 'Integration'),
(13, 2, 'Work Flow'),
(14, 2, 'Middleware'),
(15, 2, 'Microservices'),
(16, 2, 'Message Queues'),
(17, 2, 'IoT'),
(18, 2, 'NLP'),
(19, 2, 'AI'),
(20, 3, 'Private'),
(21, 3, 'Public'),
(22, 3, 'Hybrid'),
(23, 3, 'Colo'),
(24, 3, 'Brokerage'),
(25, 3, 'Migration'),
(26, 3, 'IaaS'),
(27, 3, 'SaaS'),
(28, 3, 'PaaS'),
(29, 3, 'Infrastructure as Code'),
(30, 4, 'Analytics'),
(31, 4, 'Visualisation'),
(32, 4, 'Data Lake'),
(33, 4, 'Big Data'),
(34, 4, 'Data Base'),
(35, 4, 'Data Warehouse'),
(36, 4, 'Data Migration'),
(37, 4, 'ETL'),
(38, 4, 'AI/ML'),
(39, 4, 'IOT'),
(40, 5, 'ALM Tools'),
(41, 5, 'Orchestration'),
(42, 5, 'CI/CD'),
(43, 5, 'Infrastructure as Code'),
(44, 5, 'Config Management'),
(45, 5, 'Containerization'),
(46, 6, 'Compute'),
(47, 6, 'Storage/Management'),
(48, 6, 'Database'),
(49, 6, 'Network'),
(50, 6, 'Security'),
(51, 6, 'Server'),
(52, 6, 'Virtualization'),
(53, 6, 'Collaboration'),
(54, 6, 'IoT'),
(55, 7, 'Data'),
(56, 7, 'Applications'),
(57, 7, 'End Point'),
(58, 7, 'Network'),
(59, 7, 'Cloud'),
(60, 7, 'Identity'),
(61, 7, 'Access'),
(62, 7, 'Analytics'),
(63, 7, 'SIEM'),
(64, 8, 'Project Mgmt'),
(65, 8, 'Consulting'),
(66, 8, 'Managed Services'),
(67, 8, 'Help Desk'),
(68, 8, 'Staff Augmentation'),
(69, 8, 'Assessments'),
(70, 8, 'Marketing/Branding'),
(71, 8, 'Legal'),
(72, 8, 'Accounting');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Adelaide'),
(2, 'Adelaide River'),
(3, 'Albany'),
(4, 'Albury'),
(5, 'Alice Springs'),
(6, 'Andamooka'),
(7, 'Ararat'),
(8, 'Armidale'),
(9, 'Atherton'),
(10, 'Ayr'),
(11, 'Bairnsdale East'),
(12, 'Ballarat'),
(13, 'Ballina'),
(14, 'Barcaldine'),
(15, 'Batemans Bay'),
(16, 'Bathurst'),
(17, 'Bedourie'),
(18, 'Bendigo'),
(19, 'Berri'),
(20, 'Bicheno'),
(21, 'Biloela'),
(22, 'Birdsville'),
(23, 'Bongaree'),
(24, 'Bordertown'),
(25, 'Boulia'),
(26, 'Bourke'),
(27, 'Bowen'),
(28, 'Brisbane'),
(29, 'Broken Hill'),
(30, 'Broome'),
(31, 'Bunbury'),
(32, 'Bundaberg'),
(33, 'Burketown'),
(34, 'Burnie'),
(35, 'Busselton'),
(36, 'Byron Bay'),
(37, 'Caboolture'),
(38, 'Cairns'),
(39, 'Caloundra'),
(40, 'Camooweal'),
(41, 'Canberra'),
(42, 'Carnarvon'),
(43, 'Ceduna'),
(44, 'Central Coast'),
(45, 'Charleville'),
(46, 'Charters Towers'),
(47, 'Clare'),
(48, 'Cloncurry'),
(49, 'Cobram'),
(50, 'Coffs Harbour'),
(51, 'Colac'),
(52, 'Cooma'),
(53, 'Cowell'),
(54, 'Cowra'),
(55, 'Cranbourne'),
(56, 'Currie'),
(57, 'Dalby'),
(58, 'Darwin'),
(59, 'Deniliquin'),
(60, 'Devonport'),
(61, 'Dubbo'),
(62, 'East Maitland'),
(63, 'Echuca'),
(64, 'Eidsvold'),
(65, 'Emerald'),
(66, 'Esperance'),
(67, 'Exmouth'),
(68, 'Forbes'),
(69, 'Forster'),
(70, 'Gawler'),
(71, 'Geelong'),
(72, 'Georgetown'),
(73, 'Geraldton'),
(74, 'Gingin'),
(75, 'Gladstone'),
(76, 'Gold Coast'),
(77, 'Goondiwindi'),
(78, 'Goulburn'),
(79, 'Griffith'),
(80, 'Gunnedah'),
(81, 'Gympie South'),
(82, 'Halls Creek'),
(83, 'Hamilton'),
(84, 'Hervey Bay'),
(85, 'Hobart'),
(86, 'Horsham'),
(87, 'Hughenden'),
(88, 'Innisfail'),
(89, 'Inverell'),
(90, 'Ivanhoe'),
(91, 'Kalbarri'),
(92, 'Kalgoorlie'),
(93, 'Karratha'),
(94, 'Karumba'),
(95, 'Katanning'),
(96, 'Katherine'),
(97, 'Katoomba'),
(98, 'Kempsey'),
(99, 'Kiama'),
(100, 'Kimba'),
(101, 'Kingaroy'),
(102, 'Kingoonya'),
(103, 'Kingston Beach'),
(104, 'Kingston South East'),
(105, 'Kununurra'),
(106, 'Kwinana'),
(107, 'Launceston'),
(108, 'Laverton'),
(109, 'Leeton'),
(110, 'Leonora'),
(111, 'Lithgow'),
(112, 'Longreach'),
(113, 'Mandurah'),
(114, 'Manjimup'),
(115, 'Maryborough'),
(116, 'Maryborough'),
(117, 'McMinns Lagoon'),
(118, 'Meekatharra'),
(119, 'Melbourne'),
(120, 'Melton'),
(121, 'Meningie'),
(122, 'Merredin'),
(123, 'Mildura'),
(124, 'Moranbah'),
(125, 'Morawa'),
(126, 'Moree'),
(127, 'Mount Barker'),
(128, 'Mount Gambier'),
(129, 'Mount Isa'),
(130, 'Mount Magnet'),
(131, 'Mudgee'),
(132, 'Murray Bridge'),
(133, 'Muswellbrook'),
(134, 'Narrabri West'),
(135, 'Narrogin'),
(136, 'Newcastle'),
(137, 'Newman'),
(138, 'Norseman'),
(139, 'North Lismore'),
(140, 'North Mackay'),
(141, 'North Scottsdale'),
(142, 'Northam'),
(143, 'Nowra'),
(144, 'Oatlands'),
(145, 'Onslow'),
(146, 'Orange'),
(147, 'Ouyen'),
(148, 'Pambula'),
(149, 'Pannawonica'),
(150, 'Parkes'),
(151, 'Penola'),
(152, 'Perth'),
(153, 'Peterborough'),
(154, 'Pine Creek'),
(155, 'Port Augusta West'),
(156, 'Port Denison'),
(157, 'Port Douglas'),
(158, 'Port Hedland'),
(159, 'Port Lincoln'),
(160, 'Port Macquarie'),
(161, 'Port Pirie'),
(162, 'Portland'),
(163, 'Proserpine'),
(164, 'Queanbeyan'),
(165, 'Queenstown'),
(166, 'Quilpie'),
(167, 'Ravensthorpe'),
(168, 'Richmond'),
(169, 'Richmond North'),
(170, 'Rockhampton'),
(171, 'Roebourne'),
(172, 'Roma'),
(173, 'Sale'),
(174, 'Scone'),
(175, 'Seymour'),
(176, 'Shepparton'),
(177, 'Singleton'),
(178, 'Smithton'),
(179, 'South Grafton'),
(180, 'South Ingham'),
(181, 'South Melbourne'),
(182, 'Southern Cross'),
(183, 'Stawell'),
(184, 'Streaky Bay'),
(185, 'Sunbury'),
(186, 'Swan Hill'),
(187, 'Sydney'),
(188, 'Taree'),
(189, 'Thargomindah'),
(190, 'Theodore'),
(191, 'Three Springs'),
(192, 'Tom Price'),
(193, 'Toowoomba'),
(194, 'Townsville'),
(195, 'Traralgon'),
(196, 'Tumby Bay'),
(197, 'Tumut'),
(198, 'Tweed Heads'),
(199, 'Ulladulla'),
(200, 'Victor Harbor'),
(201, 'Wagga Wagga'),
(202, 'Wagin'),
(203, 'Wallaroo'),
(204, 'Wangaratta'),
(205, 'Warrnambool'),
(206, 'Warwick'),
(207, 'Weipa'),
(208, 'West Tamworth'),
(209, 'Whyalla'),
(210, 'Wilcannia'),
(211, 'Windorah'),
(212, 'Winton'),
(213, 'Wollongong'),
(214, 'Wonthaggi'),
(215, 'Woomera'),
(216, 'Yamba'),
(217, 'Yeppoon'),
(218, 'Young'),
(219, 'Yulara');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('event','incentive','promotion','reward_incentive','product_promotion_offer','technical_education') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'event',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_duration` time NOT NULL DEFAULT '00:00:00',
  `end_duration` time NOT NULL DEFAULT '00:00:00',
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organised_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_audiance` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solution_id` int(10) DEFAULT NULL,
  `industry_id` int(10) DEFAULT NULL,
  `type_of_event_id` int(10) DEFAULT NULL,
  `type_of_incentive_id` int(11) DEFAULT NULL,
  `type_of_offer_id` int(11) DEFAULT NULL,
  `type_of_technical_education_id` int(11) DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_type` enum('single','multiple') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `declared` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('approved','draft','in_review','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in_review',
  `is_scrap` tinyint(2) NOT NULL DEFAULT 0,
  `scrap_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `user_timezone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `solution_id` (`solution_id`),
  KEY `industry_id` (`industry_id`),
  KEY `type_of_event_id` (`type_of_event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `category`, `start_date`, `end_date`, `start_duration`, `end_duration`, `size`, `summary`, `short_summary`, `organised_by`, `registration_link`, `target_audiance`, `timezone`, `solution_id`, `industry_id`, `type_of_event_id`, `type_of_incentive_id`, `type_of_offer_id`, `type_of_technical_education_id`, `logo`, `banner`, `event_type`, `declared`, `status`, `is_scrap`, `scrap_link`, `added_by`, `user_timezone`, `is_deleted`, `created_at`, `updated_at`) VALUES
(28, 'FST Government New Zealand 2020', 'reward_incentive', '2020-10-15', '2020-10-16', '08:45:00', '13:00:00', NULL, 'e Mahere mō te Whakaurunga Matihiko, or the Digital Inclusion Blueprint, released in 2019, is a hallmark of NZ’s progressive technology agenda – a vision for an inclusive, citizen-centric public service that empowers engagement through technology.\r\n\r\nHowever, while digital technologies are seen as the critical artery of interaction between the government its citizenry, NZ’s public service has too often failed to establish a similar cooperative link between its own agencies. Hampered by a lack of collaboration and chronic data siloing between agencies, successive NZ governments have been stymied in their efforts to deliver a holistic, all-in-one service offering. The state’s Chief Digital Office has sought to rectify this, creating a “centrally-led and collaboratively-delivered” digital program that has sought to break down traditional barriers and establish a new framework for cooperative government services delivery.', NULL, 'Diligent', 'https://fst.net.au/event/fst-government-new-zealand-2020/', NULL, 'Australia/ACT', 9, 5, 0, NULL, NULL, NULL, '1604752513-logo.jpg', '1604752513-banner.jpg', NULL, 1, 'approved', 1, 'https://fst.net.au/events', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 07:46:13'),
(29, 'Future of Financial Services, Sydney 2020', 'reward_incentive', '2020-11-04', '2020-11-06', '09:00:00', '00:00:00', NULL, 'FST Mediaâ€™s flagship event and the largest of its kind in the Southern Hemisphere, the Future of Financial Services, Sydney has established itself as the most important tech-focused event on the industryâ€™s calendar, setting the digital agenda for 2021 and beyond.\r\nOver three half days, the Future of Financial Services, Sydney virtual conference facilitates necessary conversations and debate among 1,000 industry peers, connecting individuals and organisations with the latest insights and transformational trends in technology and innovation.\r\nOpen Banking, Customer Experience, AI & Machine Learning, Data Analytics, Digital Transformation, the emergence of Neobanks and many other topics are sitting high on the agenda in 2020.\r\nView the 2019 Agenda for your reference.', NULL, 'nutanix', 'https://fst.net.au/event/future-financial-services-sydney-2020/', NULL, 'Australia/Canberra', 8, 8, 0, NULL, NULL, NULL, '1604752791-logo.jpg', '1604752791-banner.jpg', NULL, 1, 'approved', 1, 'https://fst.net.au/events', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 07:46:26'),
(30, 'FST Government New South Wales 2020', 'reward_incentive', '2020-11-04', '2020-11-05', '09:00:00', '14:00:00', NULL, 'NSW boldly proclaims itself the ‘Premier State’ – as the country’s preeminent digital innovator, this foremost boast rings no truer.\r\n\r\nAmong the first states in Australia to embrace wholesale digital transformation, including the pioneering rollout of Service NSW – the state’s multi-channel government services access hub – NSW is often looked to as the country’s exemplar of e-Government.', NULL, 'service now', 'https://fst.net.au/event/fst-government-new-south-wales-2020/', NULL, 'Australia/West', 26, 4, 0, NULL, NULL, NULL, '1604753069-logo.jpg', '1604753069-banner.jpg', NULL, 1, 'approved', 1, 'https://fst.net.au/events', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 07:46:37'),
(31, 'FST Government Australia 2020', 'product_promotion_offer', '2020-11-18', '2020-11-19', '09:00:00', '14:00:00', NULL, 'Today, eGovernment is no mere afterthought; it is an expectation among Australiaâ€™s tech-savvy citizenry. This is no accident. It is testament to the statesâ€™ progressive adoption of digital infrastructure and e-services across the public sector â€“ an ambition readily embraced by the public. The Federal Government has been at the forefront of this push, becoming a champion â€“ indeed a beacon â€“ for digital transformation efforts across the country. Yet, as technological ambitions are ensnared in the grind of government machinery, efforts to modernise and digitise the Federal bureaucracy are often mired in cost, operational compatibility, and data security considerations. Delivering consistency and continuity within the public sectorâ€™s wholesale transformation program will present a major challenge for the Government, particularly as it pursues its long-anticipated digital social services platform, Services Australia.\nOur flagship conference, FST Government Australia 2020 will chart these critical developments and challenges, as well as transformational trends shaping eGovernment in Australia.\nJoin us in November 2020 to explore key trends in:\n\nData governance and adaptive cybersecurity\nWhole-of-government digital transformation\nArtificial Intelligence (AI) and Machine Learning (ML) and the new face of augmented government\nAnticipatory or predictive government\nAgile by design methodologies\nA cloud-backed environment and the inevitable shift from on-premise infrastructure\nRobotic process automation (RPA)\nOmnichannel services and platforms\nDigital identity\nFourth industry revolution (4IR) technologies and how they will shape citizen centric government\n\nATTENDANCE IS STRICTLY FOR PUBLIC SECTOR EMPLOYEES ONLY', NULL, NULL, 'https://fst.net.au/event/fst-government-australia-2020/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'approved', 1, 'https://fst.net.au/events', 4, NULL, 0, '2020-10-31 18:30:00', NULL),
(32, 'FST Government South Australia 2020', 'reward_incentive', '2020-12-03', '2020-12-04', '09:00:00', '13:00:00', NULL, 'FST Government South Australia 2020 returns as a special Digital Summit exclusively for our SA Public Sector audience on 3-4 December 2020.\r\n\r\nSouth Australia is fast shaping as the nation’s technology and innovation powerhouse. As the venerable heart of Australia’s agritech and the defence industries, and recently anointed hub of nation’s burgeoning aerospace industry, the desert state is witnessing a digital innovation bloom. Yet the road to eGovernment cannot be paved without the inevitable hurdle. With still much to deliver from the state’s 2018-2021 ICT Strategy, SA’s government has no room for complacency as it moves into the next phase of its digital transformation program.', NULL, 'servicenow', 'https://fst.net.au/event/fst-government-south-australia-2020/', NULL, 'Australia/Canberra', 14, 15, 0, NULL, NULL, NULL, '1604753424-logo.jpg', '1604753424-banner.jpg', NULL, 1, 'approved', 1, 'https://fst.net.au/events', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 07:48:17'),
(38, 'Technology in Government', 'reward_incentive', '2020-11-03', '2020-11-04', '09:00:00', '18:00:00', NULL, '\"The role of IT in government sector\"Tech in Gov is Australia\'s largest and longest-running annual ICT in government event. It combines a high-level conference with a large scale exhibition, bringing together senior public and private sector IT experts to learn, network and source ICT solutions for the ongoing digital transformation within government.', NULL, 'Terrapinn Australia Ltd.', 'https://10times.com/public-sector-summit', NULL, 'Australia/West', 12, 10, 0, NULL, NULL, NULL, '1604754231-logo.jpg', '1604754231-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 07:46:46'),
(39, 'The Future of Security in Financial Services', 'product_promotion_offer', '2020-11-05', '2020-11-06', '09:00:00', '18:00:00', NULL, 'Future of Security will include keynote presentations from industry leaders, insightful panel discussions, and interactive Think Tanks covering a range of the latest and most critical security topics, including access authentication technologies, data privacy and protection, defense mechanisms, breach detection, and recovery, and many more.', NULL, 'FST Media Pte Ltd', 'https://10times.com/future-security-in-financial-services-sydney', NULL, '0', 12, 7, 0, NULL, NULL, NULL, '1604754393-logo.jpg', '1604754393-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 08:09:51'),
(40, 'WorkTech Sydney', 'product_promotion_offer', '2020-12-11', '2020-12-11', '09:00:00', '17:30:00', NULL, 'WorkTech event will display products like Real estate, facilities, HR, technology, executive management architecture, design and professional advisors to listen to global thought leaders, further their knowledge and share best practise and expertise etc.', NULL, 'Unwired Ventures', 'https://10times.com/worktech-sydney', NULL, 'Australia/ACT', 18, 9, 0, NULL, NULL, NULL, '1604754530-logo.jpg', '1604754530-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 07:50:19'),
(43, 'Legal Innovation & Tech Fest', 'product_promotion_offer', '2020-11-19', '2020-11-24', '08:00:00', '17:00:00', NULL, 'The Legal Innovation & Tech Fest â€“ DIGITAL will happen in November. A huge 4 hours per day across 4 days, involving 60 speakers delivering 80+ hours of content. While the experience will be different via an already road-tested interactive event platform, we will uphold the brands brilliant reputation in bringing together 500+ Law Firm business leaders, Senior Corporate Lawyers and Legal Service Providers.', NULL, 'Hannover Fairs Australia', 'https://10times.com/legal-innovation-tech-fest', NULL, 'Australia/ACT', 13, 13, 0, NULL, NULL, NULL, '1604754723-logo.jpg', '1604754723-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 08:10:36'),
(48, 'YOW! Conference Melbourne (YOW! MEL)', 'product_promotion_offer', '2020-12-03', '2020-12-04', '08:00:00', '18:00:00', NULL, 'The Yow Conference Melbourne brings together leading industry practitioners and applied researchers working on data-driven technology and applications, providing in-depth coverage of current and emerging technologies in the areas of Big Data, Analytics and Machine Learning. Network, meet the experts and hone your skills all in one event.', NULL, 'Bedarra Research Labs', 'https://10times.com/yow-conference-melbourne', NULL, 'Australia/ACT', 14, 12, 0, NULL, NULL, NULL, '1604756565-logo.jpg', '1604756565-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 08:13:02'),
(53, 'HR Innovation & Tech Fest Australia', 'event', '2020-12-07', '2020-12-11', '09:00:00', '17:00:00', NULL, 'HR Innovation & Tech Fest â€“ DIGITAL 2020 will be delivered entirely virtually via an interactive event platform.Be part of the most exciting and progressive gathering of HR leaders, difference-makers and disruptors as they celebrate the talent, technology and ideas transforming the future of work. Five amazing days of learning and innovation on HR Tech, Learning, Digital Transformation, Talent, Workforce Analytics, Recruitment, Leadership, Diversity & Inclusion, Wellbeing and Employee Engagement. Weâ€™re on a mission to unlock and realise the potential of technology for the betterment of people, businesses, and the world.', NULL, 'Hannover Fairs Australia', 'https://10times.com/hr-innovation-tech-fest', NULL, 'Australia/ACT', 9, 8, 0, NULL, NULL, NULL, '1605770687-logo.png', '1605770687-banner.png', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-19 01:54:47'),
(54, 'Security & Government Expo (SAGE)', 'event', '2020-11-12', '2020-11-12', '09:00:00', '18:00:00', NULL, 'Security & Government Expo SAGE, giving government security managers and facilities managers, security installers and integrators, and security consultants, the perfect opportunity to get a look at the latest security technologies in the nationâ€™s capital. It is the perfect opportunity for SAGE attendees to continue networking with government security people in a relaxed and convivial atmosphere.', NULL, 'Security Electronics Magazine', 'https://10times.com/securityandgovernmentexpo', NULL, 'Australia/ACT', 12, 15, 0, NULL, NULL, NULL, '1605770601-logo.jpg', '1605770601-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-19 01:53:21'),
(56, 'Government Customer Service Summit', 'technical_education', '2020-11-17', '2020-11-20', '09:00:00', '18:00:00', NULL, 'Government Customer Service Summit will explore a key theme of service innovation, customer experience, frontline service delivery and public sector leadership, delivering you leading case studies and hands-on masterclasses that will empower you with the knowledge to become a leader of innovation.', NULL, 'KONNECT LEARNING', 'https://10times.com/government-customer-service-summit', NULL, '0', 7, 14, 7, NULL, NULL, NULL, '1604755434-logo.png', '1604755434-banner.png', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 07:53:54'),
(57, 'International Telecommunication ', 'event', '2020-11-25', '2020-11-27', '08:30:00', '17:00:00', NULL, '\"Leading Telecommunications Research\"With the increasing focus on modelling and simulation in the fields of telecommunications, cyber-networks, data mining, cyber security, distributed computing, mobile computing, cognitive computing, cloud computing, computing tools, applications, simulation tools, system performance and data and computer communications the demand for high quality research outcomes has never been greater. ITNAC has been the forum for researchers and engineers to present and discuss topics related to advanced computing and data communication network technologies, services and applications.', NULL, 'AAICT Inc.', 'https://10times.com/itnac-melbourne', NULL, 'Australia/West', 14, 6, 0, NULL, NULL, NULL, '1605774979-logo.jpg', '1605774979-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-19 03:06:19'),
(58, 'Mastering SAP EAM (Mastering_SAP_EAM)', 'technical_education', '2020-11-22', '2020-11-24', '08:00:00', '17:00:00', NULL, 'The world has changed. Businesses are demanding. New leadership styles, new technologies and global standards are emerging. And the big Asset Management shift is on. Maintenance and Reliability have moved beyond their operational role and are fast transforming into a core, focused, and disciplined strategic business function. Technologies like SAP EAM are the essential enablers of this transformation which is why the Mastering SAP Enterprise Asset Management program has evolved and progressed to be a celebration of the leadership, technology and innovations that are literally transforming Asset Management.', NULL, 'The Eventful Group', 'https://10times.com/mastering-sap-eam', NULL, 'Australia/ACT', 17, 13, 0, NULL, NULL, NULL, '1604755562-logo.jpg', '1604755562-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 07:56:18'),
(59, 'The MarTech Summit Sydney', 'event', '2020-11-25', '2020-11-26', '08:00:00', '17:00:00', NULL, '\"The most versatile marketing event\"\"Converging Marketing & Technology for a Winning Future\". The digital revolution has urged brands and advertisers to reshape the way they connect and engage with customers regionally and globally. At the same time, MarTech innovation through the likes of Data Analytics, AI, Machine Learning, Automation and the use of chatbots to enhance customer experience is growing at an unprecedentedly speed. At the summit you will find out: How will MarTech help your team tackle complexities in a digital world. What to consider when prioritizing new technologies & planning your MarTech roadmap. How do you guarantee seamless customer experience while leveraging your investment. Highlights 220+ attendees, 40+ speakers, 30+ case studies, 4 themed tracks, 80:20 ratio of industry participants.', NULL, 'beetc', 'https://10times.com/martech-summit', NULL, 'Australia/West', 15, 6, 0, NULL, NULL, NULL, '1605770650-logo.jfif', '1605770650-banner.jfif', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-19 01:54:10'),
(60, 'AgTech Summit', 'technical_education', '2020-11-30', '2020-12-01', '09:00:00', '18:00:00', NULL, 'AgTech Summit will be gathering the industries key stakeholders, the summit will draw on the key issues facing the sector and the growing demand for technological advancement in agriculture.', NULL, 'Informa Australia', 'https://10times.com/agtech-summit-sydney', NULL, 'Australia/West', 19, 12, 7, NULL, NULL, NULL, '1604755697-logo.jpg', '1604755697-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 07:58:17'),
(67, 'SYDNEY (Penrith) Technology Expo', 'technical_education', '2020-10-28', '2020-10-28', '09:00:00', '18:00:00', NULL, 'SYDNEY (WESTERN) (NSW): Technology Expo is a one-stop shop, featuring many companies showcasing their products or services related to the Instrumentation, Control, and Automation Industry, over a drink in a friendly and relaxed environment.', NULL, 'Institute Of Instrumentation Control and Automation', 'https://10times.com/sydney-penrith-technology-expo', NULL, 'Australia/Canberra', 17, 5, 7, NULL, NULL, NULL, '1604756014-logo.png', '1604756014-banner.png', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 08:03:34'),
(68, 'PMC Gold Coast', 'technical_education', '2020-11-01', '2020-11-02', '09:00:00', '18:00:00', NULL, 'PMC Gold Coast will provide the attendees with the opportunity to gain insights relating to Beyond Tomorrow: The human revolution, Ideas Worth Spreading: Where\'s our industry heading, Turning Rejection into Opportunity, Using Emotional Intelligence in Property Management, Technology Enabling Professionals, Property Manager to Team Leader, etc.', NULL, 'Ray White/Loan Market', 'https://10times.com/pmc-gold-coast', NULL, 'Australia/West', 14, 16, 8, NULL, NULL, NULL, '1604755857-logo.jpg', '1604755857-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 08:00:57'),
(69, 'FST Government New South Wales', 'event', '2020-11-04', '2020-11-04', '09:00:00', '18:00:00', NULL, 'The FST Government New South Wales is the state\'s premier government technology conference, offering privileged insight from technology leaders on the evolution of the government\'s ICT program, including Digital disruption in the public service, Cyber-security and citizen data protection, Blockchain in citizen services, Big data and analytics, Mobility, Cloud & virtualization, Artificial intelligence and robotics processing, Future workspaces, and much more.', NULL, 'FST', 'https://10times.com/fst-government-new-south-wales', NULL, 'Australia/Canberra', 16, 7, 10, NULL, NULL, NULL, '1604757172-logo.jpg', '1604757172-banner.jpg', NULL, 1, 'approved', 1, 'https://10times.com/australia/technology', 4, NULL, 0, '2020-10-31 18:30:00', '2020-11-07 08:22:52'),
(70, 'Serivce Now Knowledge Session Year - 2020', 'event', '2020-12-14', '2020-12-18', '09:00:00', '17:00:00', NULL, 'Take our learning plans and courses to set yourself up for development success on the Now Platform. Make sure to log in or create an account to track your learning progress against your goals.', NULL, 'nikhil sompura', 'https://developer.servicenow.com/dev.do', NULL, 'Australia/ACT', 1, 1, 1, NULL, NULL, NULL, '1605866628-logo.png', '1605866628-banner.png', 'single', 1, 'approved', 0, NULL, 10, 'Asia/Kolkata', 0, '2020-11-20 04:33:48', '2020-11-20 04:33:48'),
(71, 'social media', 'event', '2020-11-10', '2020-11-17', '01:00:00', '00:30:00', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type andLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type andLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and', NULL, 'nikhil sompura', 'https://www.google.com/', NULL, 'Australia/West', 2, 2, 0, NULL, NULL, NULL, '1605942583-logo.png', '1605942583-banner.png', 'single', 1, 'approved', 0, NULL, 10, 'Asia/Calcutta', 0, '2020-11-21 01:39:43', '2020-11-21 01:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `event_agendas`
--

DROP TABLE IF EXISTS `event_agendas`;
CREATE TABLE IF NOT EXISTS `event_agendas` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start` time NOT NULL DEFAULT '00:00:00',
  `end` time NOT NULL DEFAULT '00:00:00',
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speaker_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_agenda_event_id_index` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `event_agendas`
--

INSERT INTO `event_agendas` (`id`, `start`, `end`, `topic`, `speaker_name`, `event_id`, `created_at`, `updated_at`) VALUES
(113, '09:00:00', '13:00:00', 'Minister for Government Digital Services', 'The Hon Kris Faafoi', 28, '2020-11-07 07:46:13', '2020-11-07 07:46:13'),
(114, '14:00:00', '17:00:00', 'Global Affairs Director', 'Indrek Onnik', 28, '2020-11-07 07:46:13', '2020-11-07 07:46:13'),
(115, '09:30:00', '12:30:00', 'Digital and Client Data Workstream Lead', 'Pia Andrews', 28, '2020-11-07 07:46:13', '2020-11-07 07:46:13'),
(116, '09:00:00', '15:00:00', 'Liberal Senator for NSW', 'Senator Andrew Bragg', 29, '2020-11-07 07:46:26', '2020-11-07 07:46:26'),
(117, '21:00:00', '15:00:00', 'Executive General Manager', 'Paul Franklin', 29, '2020-11-07 07:46:26', '2020-11-07 07:46:26'),
(118, '09:00:00', '12:30:00', 'Moments of Life (MOL)', 'Dominic Chan', 30, '2020-11-07 07:46:37', '2020-11-07 07:46:37'),
(119, '14:00:00', '17:30:00', 'Chief of the Digital Services Division', 'Courtney Winship', 30, '2020-11-07 07:46:37', '2020-11-07 07:46:37'),
(120, '10:30:00', '14:00:00', 'Deputy Secretary - Corporate Services', 'John Hubby', 30, '2020-11-07 07:46:37', '2020-11-07 07:46:37'),
(121, '09:00:00', '18:00:00', 'Chief Information Officer (CIO) at University of Canberra', 'Maria Milosavljevic', 38, '2020-11-07 07:46:46', '2020-11-07 07:46:46'),
(122, '09:00:00', '18:00:00', 'First Assistant Secretary Research and Innovation', 'Gavin McCairns', 38, '2020-11-07 07:46:46', '2020-11-07 07:46:46'),
(123, '09:00:00', '14:30:00', 'Co-Founder and CEO', 'Dr Michelle Perugini', 32, '2020-11-07 07:48:17', '2020-11-07 07:48:17'),
(124, '10:30:00', '13:00:00', 'Department for Innovation and Skills', 'Paul Goiak', 32, '2020-11-07 07:48:17', '2020-11-07 07:48:17'),
(125, '09:00:00', '17:30:00', 'information Technology', 'Fahad irshad', 40, '2020-11-07 07:50:19', '2020-11-07 07:50:19'),
(126, '09:00:00', '18:00:00', 'Front Office Manager', 'Harriet Nanteza Babirye', 56, '2020-11-07 07:53:54', '2020-11-07 07:53:54'),
(128, '10:00:00', '17:00:00', 'Senior System Analyst', 'Noor', 58, '2020-11-07 07:56:18', '2020-11-07 07:56:18'),
(129, '10:30:00', '18:30:00', 'All Shoes', 'Sunny chauhan', 60, '2020-11-07 07:58:17', '2020-11-07 07:58:17'),
(130, '11:00:00', '17:30:00', 'Sales Director', 'Kelsey', 68, '2020-11-07 08:00:57', '2020-11-07 08:00:57'),
(131, '11:00:00', '16:30:00', 'Supervisor at FBC', 'alok', 67, '2020-11-07 08:03:34', '2020-11-07 08:03:34'),
(132, '09:00:00', '16:30:00', 'seo', 'ashok', 39, '2020-11-07 08:09:51', '2020-11-07 08:09:51'),
(133, '10:30:00', '17:30:00', 'website', 'coal', 43, '2020-11-07 08:10:36', '2020-11-07 08:10:36'),
(135, '10:30:00', '16:00:00', 'Reliable Software', 'Bartosz Milewski', 48, '2020-11-07 08:13:03', '2020-11-07 08:13:03'),
(140, '10:30:00', '16:30:00', 'natural', 'jeffery', 69, '2020-11-07 08:22:52', '2020-11-07 08:22:52'),
(142, '10:00:00', '18:00:00', 'laravel', 'dev', 54, '2020-11-19 01:53:21', '2020-11-19 01:53:21'),
(143, '09:30:00', '15:30:00', 'estate', 'heidi', 59, '2020-11-19 01:54:10', '2020-11-19 01:54:10'),
(144, '12:00:00', '17:30:00', 'Hannover Fairs Australia', 'metla', 53, '2020-11-19 01:54:47', '2020-11-19 01:54:47'),
(145, '11:00:00', '18:00:00', 'science', 'chief', 57, '2020-11-19 03:06:19', '2020-11-19 03:06:19'),
(146, '09:00:00', '10:00:00', 'Introduction', 'Joe James', 70, '2020-11-20 04:33:48', '2020-11-20 04:33:48'),
(147, '10:00:00', '12:00:00', 'Introduction to Serivce Now API', 'Braidley', 70, '2020-11-20 04:33:48', '2020-11-20 04:33:48'),
(148, '13:00:00', '17:00:00', 'Hacathon', 'Service Now', 70, '2020-11-20 04:33:48', '2020-11-20 04:33:48'),
(151, '01:00:00', '03:00:00', 'social', 'adobe', 71, '2020-11-21 01:41:48', '2020-11-21 01:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `event_locations`
--

DROP TABLE IF EXISTS `event_locations`;
CREATE TABLE IF NOT EXISTS `event_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(10) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `city_id` int(10) DEFAULT NULL,
  `state_id` int(10) DEFAULT NULL,
  `post_code` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_locations`
--

INSERT INTO `event_locations` (`id`, `event_id`, `location`, `city_id`, `state_id`, `post_code`, `created_at`, `updated_at`) VALUES
(76, 31, 'Virtual Conference', 0, NULL, NULL, NULL, NULL),
(137, 28, 'Virtual Conference', 4, 4, 36363, '2020-11-07 07:46:13', '2020-11-07 07:46:13'),
(138, 29, 'Virtual Conference', 5, 6, 36363, '2020-11-07 07:46:26', '2020-11-07 07:46:26'),
(139, 30, 'Virtual Conference', 64, 6, 36363, '2020-11-07 07:46:37', '2020-11-07 07:46:37'),
(140, 38, 'National Convention Centre Canberra', 41, 5, 78653, '2020-11-07 07:46:46', '2020-11-07 07:46:46'),
(141, 32, 'Virtual Conference', 11, 4, 36251, '2020-11-07 07:48:17', '2020-11-07 07:48:17'),
(142, 40, 'International Convention Centre Sydney (ICC Sydney)', 187, 7, 78878, '2020-11-07 07:50:19', '2020-11-07 07:50:19'),
(143, 56, 'Novotel Canberra', 41, 7, 45454, '2020-11-07 07:53:54', '2020-11-07 07:53:54'),
(145, 58, 'The Star Gold Coast', 76, 4, 36552, '2020-11-07 07:56:18', '2020-11-07 07:56:18'),
(146, 60, 'Rydges World Square', 187, 6, 3898, '2020-11-07 07:58:17', '2020-11-07 07:58:17'),
(147, 68, 'RACV Royal Pines Resort', 76, 5, 36858, '2020-11-07 08:00:57', '2020-11-07 08:00:57'),
(148, 67, 'Trade Show', 187, 7, 89653, '2020-11-07 08:03:34', '2020-11-07 08:03:34'),
(149, 39, 'International Convention Centre Sydney (ICC Sydney)', 187, 6, 98898, '2020-11-07 08:09:51', '2020-11-07 08:09:51'),
(150, 43, 'Conference', 187, 4, 45784, '2020-11-07 08:10:36', '2020-11-07 08:10:36'),
(152, 48, 'Melbourne Convention and Exhibition Centre', 119, 7, 34545, '2020-11-07 08:13:02', '2020-11-07 08:13:02'),
(157, 69, 'Hilton Sydney', 187, 6, 96535, '2020-11-07 08:22:52', '2020-11-07 08:22:52'),
(159, 54, 'cross', 41, 6, 85356, '2020-11-19 01:53:21', '2020-11-19 01:53:21'),
(160, 59, 'Conference', 187, 4, 93565, '2020-11-19 01:54:10', '2020-11-19 01:54:10'),
(161, 53, 'Conference', 187, 6, 986887, '2020-11-19 01:54:47', '2020-11-19 01:54:47'),
(162, 57, 'RMIT University', 119, 7, 934556, '2020-11-19 03:06:19', '2020-11-19 03:06:19'),
(163, 70, '100 Pitt Street, BADGERYS CREEK  NSW 2555', 1, 1, 2555, '2020-11-20 04:33:48', '2020-11-20 04:33:48'),
(166, 71, 'ahmedabad', 2, 1, 381000, '2020-11-21 01:41:48', '2020-11-21 01:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

DROP TABLE IF EXISTS `industries`;
CREATE TABLE IF NOT EXISTS `industries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industries`
--

INSERT INTO `industries` (`id`, `name`) VALUES
(1, 'Cross industry'),
(2, 'Agriculture Forestry, Fishing'),
(3, 'Accommodation and Food Services'),
(4, 'Administrative and Support Services'),
(5, 'Arts and Recreation Services'),
(6, 'Construction'),
(7, 'Education and Training'),
(8, 'Electricity, Gas, Water, Waste Services'),
(9, 'Financial and Insurance Services'),
(10, 'Health Care and Social Assistance'),
(11, 'Information Media and Telecommunications'),
(12, 'Manufacturing'),
(13, 'Mining'),
(14, 'Professional, Scientific, Technical Services'),
(15, 'Public Administration and Safety'),
(16, 'Rental, Hiring and Real Estate Services'),
(17, 'Retail Trade'),
(18, 'Transport, Postal and Warehousing'),
(19, 'Whosale Trade');

-- --------------------------------------------------------

--
-- Table structure for table `jobcategories`
--

DROP TABLE IF EXISTS `jobcategories`;
CREATE TABLE IF NOT EXISTS `jobcategories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobcategories`
--

INSERT INTO `jobcategories` (`id`, `name`, `role_id`) VALUES
(1, 'Sales', 2),
(2, 'Marketing', 2),
(3, 'Channel Manager', 3),
(4, 'Channel Marketing', 3),
(5, 'Pre-Sales (Technical)', 2),
(6, 'Post-Sales Delivery (Technical)', 2),
(7, 'Director/Owner/Founder', 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_03_03_133600_job_category', 1),
(4, '2020_03_04_051010_business_type', 1),
(5, '2020_03_04_091852_update_user_table', 2),
(6, '2020_03_07_054926_create_roles', 3),
(7, '2020_03_07_055123_create_role_user', 3),
(8, '2020_03_07_095609_create_events', 4),
(9, '2020_03_07_101315_create_event_agenda', 5),
(10, '2020_03_17_063343_create_partner_filters_table', 6),
(11, '2020_03_18_062800_create_partner_event_counts_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `opportunities`
--

DROP TABLE IF EXISTS `opportunities`;
CREATE TABLE IF NOT EXISTS `opportunities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `have_project` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=>yes,0=>no',
  `agreement` varchar(55) DEFAULT NULL,
  `project_about` varchar(255) DEFAULT NULL,
  `vendor` int(11) DEFAULT NULL,
  `solution_category` int(11) DEFAULT NULL,
  `certification` varchar(255) DEFAULT NULL,
  `project_time` varchar(255) DEFAULT NULL,
  `service_time` varchar(255) DEFAULT NULL,
  `budget` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `location` varchar(55) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opportunities`
--

INSERT INTO `opportunities` (`id`, `user_id`, `have_project`, `agreement`, `project_about`, `vendor`, `solution_category`, `certification`, `project_time`, `service_time`, `budget`, `amount`, `location`, `city`, `created_at`, `updated_at`) VALUES
(1, 36, 1, 'no', 'Project description - multi line text', 3, 3, 'specific criteria', '1 to 4 weeks', 'More than 2 weeks from now', 'I have a \"Day Rate\" budget in mind', NULL, 'no', NULL, '2020-11-03 06:06:44', '2020-11-03 06:06:44'),
(2, 37, 1, NULL, NULL, 1, 2, NULL, 'Less than 1 week', 'In 1-2 weeks', 'I have a fixed budget in mind', NULL, 'yes', 1, '2020-11-06 05:20:02', '2020-11-06 05:20:02'),
(3, 35, 1, 'yes', 'Project title - single line text', 1, NULL, 'None', 'Less than 1 week', 'ASAP', 'I have a fixed budget in mind', 30000, 'no', NULL, '2021-02-04 22:55:21', '2021-02-04 22:55:21'),
(4, 35, 1, 'yes', 'Project description - multi line text', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-05 00:13:02', '2021-02-05 00:13:02'),
(5, 35, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-05 00:13:44', '2021-02-05 00:13:44'),
(6, 35, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-05 00:13:50', '2021-02-05 00:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `partner_event_counts`
--

DROP TABLE IF EXISTS `partner_event_counts`;
CREATE TABLE IF NOT EXISTS `partner_event_counts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `read_more` int(11) NOT NULL DEFAULT 0,
  `short_list` int(11) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partner_event_counts`
--

INSERT INTO `partner_event_counts` (`id`, `user_ip`, `user_id`, `event_id`, `read_more`, `short_list`, `view`, `created_at`, `updated_at`) VALUES
(32, NULL, 19, 21, 1, 0, 1, '2020-05-08 11:46:13', '2020-05-08 11:46:21'),
(34, NULL, 1, 21, 0, 0, 0, '2020-05-09 13:57:04', '2020-05-11 06:04:40'),
(42, NULL, 27, 57, 1, 0, 0, '2020-09-14 04:30:27', '2020-09-14 04:30:27'),
(44, NULL, 34, 40, 0, 0, 1, '2020-09-16 05:12:41', '2020-09-16 05:12:41'),
(46, NULL, 34, 48, 1, 0, 0, '2020-09-16 05:13:08', '2020-09-16 05:13:08'),
(59, '192.168.0.1', 35, 39, 1, 0, 1, '2020-11-09 05:13:23', '2020-11-09 05:13:29'),
(60, NULL, 38, 30, 0, 0, 0, '2020-11-19 02:15:30', '2020-11-19 02:15:53'),
(61, '192.168.0.1', 0, 70, 1, 0, 1, '2020-11-20 04:37:48', '2021-02-04 23:33:17'),
(62, '192.168.0.1', 35, 69, 0, 0, 1, '2020-11-21 00:22:59', '2020-11-21 00:22:59'),
(63, '192.168.0.1', 0, 71, 1, 0, 1, '2020-11-21 01:42:07', '2020-12-08 18:03:03'),
(64, '192.168.0.1', 0, 31, 1, 0, 1, '2020-12-14 19:53:36', '2020-12-14 19:53:46'),
(65, '192.168.0.1', 35, 59, 0, 0, 1, '2021-02-04 21:52:16', '2021-02-04 21:52:16'),
(66, '192.168.0.1', 35, 53, 1, 0, 1, '2021-02-04 21:52:24', '2021-02-04 21:52:32'),
(67, '192.168.0.1', 35, 70, 1, 0, 0, '2021-02-04 23:32:35', '2021-02-04 23:32:35'),
(68, '192.168.0.1', 16, 71, 1, 0, 1, '2021-02-04 23:32:39', '2021-02-04 23:32:44'),
(69, '192.168.0.1', 35, 71, 0, 0, 1, '2021-02-04 23:32:44', '2021-02-04 23:32:44'),
(70, '110.150.138.178', 35, 54, 1, 0, 1, '2021-04-14 06:54:06', '2021-06-02 06:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `partner_filters`
--

DROP TABLE IF EXISTS `partner_filters`;
CREATE TABLE IF NOT EXISTS `partner_filters` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `from_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solution_id` int(11) DEFAULT NULL,
  `industry_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `type_of_event_id` int(11) DEFAULT NULL,
  `type_of_incentive_id` int(11) DEFAULT NULL,
  `type_of_offer_id` int(11) DEFAULT NULL,
  `type_of_technical_education_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `solution_id` (`solution_id`),
  KEY `industry_id` (`industry_id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `type_of_event_id` (`type_of_event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partner_filters`
--

INSERT INTO `partner_filters` (`id`, `user_id`, `category`, `city_id`, `state_id`, `from_month`, `to_month`, `solution_id`, `industry_id`, `vendor_id`, `type_of_event_id`, `type_of_incentive_id`, `type_of_offer_id`, `type_of_technical_education_id`, `created_at`, `updated_at`) VALUES
(3, 35, 'event', 0, 0, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, '2020-11-02 08:05:25', '2021-02-05 00:01:12'),
(4, 6, 'event', 1, 0, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, '2021-02-04 22:58:54', '2021-02-04 22:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('info@siyainfotech.net', '$2y$10$H1u5OqWCvXcf8lIAyBeHAeIoL.VamUDxRk9YBEbSuCnt2tANp1ZaW', '2020-04-21 00:24:33'),
('prashant.simejiya@siyainfo.com', '$2y$10$weWGysMsygZgX8fEL7KRNuagwHmZd7ob/o1JLlbWa7i3cpztd8Jaq', '2020-04-21 10:38:55'),
('prashant.trivedi@siyainfo.com', '$2y$10$X1AVmMiSdQiW718.MXH.wu5.67Vswk306zzGEJEbUvUqd6EsuT8Ii', '2020-05-09 09:15:02'),
('rajendra.makwana@siyainfo.com', '$2y$10$Ns/GQhx8PT0yTy4kobBnUOwVLAKT1RXKZOxl/80a6yp22J7f.Go5m', '2020-05-10 07:29:07'),
('zubin.bhavsar@siyainfo.com', '$2y$10$HVfrL80ZHVY4zn6YeWDV3e2VFoOsCUksn91FiTFChI3rJ.HfYhcVy', '2020-05-11 03:52:43'),
('pheini@measurableimpact.com.au', '$2y$10$OtqsSegLvFhg6AIN6BTWdeTHZD7kciq1LDt2J3lR42N5HQRWeFGe2', '2021-03-30 09:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-03-07 00:26:31', '2020-03-07 00:26:31'),
(2, 'partner', '2020-03-07 00:26:31', '2020-03-07 00:26:31'),
(3, 'vendor', '2020-03-07 00:26:31', '2020-03-07 00:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 3, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 2, 6, NULL, NULL),
(7, 2, 7, NULL, NULL),
(8, 2, 8, NULL, NULL),
(9, 3, 9, NULL, NULL),
(10, 3, 10, NULL, NULL),
(11, 2, 11, NULL, NULL),
(12, 3, 12, NULL, NULL),
(13, 2, 13, NULL, NULL),
(14, 3, 14, NULL, NULL),
(15, 3, 15, NULL, NULL),
(16, 1, 16, NULL, NULL),
(17, 3, 17, NULL, NULL),
(18, 2, 18, NULL, NULL),
(19, 2, 19, NULL, NULL),
(21, 3, 21, NULL, NULL),
(22, 2, 22, NULL, NULL),
(23, 3, 23, NULL, NULL),
(24, 3, 24, NULL, NULL),
(25, 2, 25, NULL, NULL),
(26, 3, 26, NULL, NULL),
(27, 2, 27, NULL, NULL),
(28, 2, 28, NULL, NULL),
(29, 2, 29, NULL, NULL),
(30, 3, 31, NULL, NULL),
(31, 2, 32, NULL, NULL),
(32, 2, 33, NULL, NULL),
(33, 2, 34, NULL, NULL),
(34, 2, 35, NULL, NULL),
(37, 2, 35, NULL, NULL),
(38, 2, 36, NULL, NULL),
(39, 2, 37, NULL, NULL),
(40, 2, 38, NULL, NULL),
(42, 3, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

DROP TABLE IF EXISTS `solutions`;
CREATE TABLE IF NOT EXISTS `solutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solutions`
--

INSERT INTO `solutions` (`id`, `name`) VALUES
(1, 'AI'),
(2, 'Analytics Platform'),
(3, 'Application Platform'),
(4, 'Business Analytics'),
(5, 'Cloud Services'),
(6, 'Cognitive Solutions'),
(7, 'Commerce'),
(8, 'Customer Engagement'),
(9, 'Data Science'),
(10, 'DevOps'),
(11, 'Enterprise Marketing'),
(12, 'Enterprise Servers'),
(13, 'Global Asset Recovery Solutions'),
(14, 'Internet of Things (IoT)'),
(15, 'IT Financing'),
(16, 'IT Infrastructure'),
(17, 'IT Security'),
(18, 'IT Service Management'),
(19, 'Kenexa Solutions'),
(20, 'Linux'),
(21, 'Machine Learning'),
(22, 'Resiliency Services'),
(23, 'Storage'),
(24, 'Supply Chain'),
(25, 'Systems Services'),
(26, 'Talent Management Solutions'),
(27, 'Technology Support Services'),
(28, 'Unified Governance and Integration');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'NSW (New South Wales)'),
(2, 'NT (Northern Territory)'),
(3, 'SA (South Australia)'),
(4, 'TAS (Tasmania)'),
(5, 'VIC (Victoria)'),
(6, 'WA (Western Australia)'),
(7, 'QLD (Queensland)');

-- --------------------------------------------------------

--
-- Table structure for table `syncevents`
--

DROP TABLE IF EXISTS `syncevents`;
CREATE TABLE IF NOT EXISTS `syncevents` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gsync` tinyint(4) NOT NULL DEFAULT 0,
  `isync` tinyint(4) NOT NULL DEFAULT 0,
  `osync` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_of_events`
--

DROP TABLE IF EXISTS `type_of_events`;
CREATE TABLE IF NOT EXISTS `type_of_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_of_events`
--

INSERT INTO `type_of_events` (`id`, `name`) VALUES
(1, 'A speaker session'),
(2, 'A seminar or half-day event'),
(3, 'Awards and competitions'),
(4, 'Conferences'),
(5, 'Festivals and parties'),
(6, 'Networking sessions'),
(7, 'Sponsorships'),
(8, 'Trade shows and expos'),
(9, 'VIP experiences'),
(10, 'Workshops and classes'),
(11, 'Webinars');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_incentives`
--

DROP TABLE IF EXISTS `type_of_incentives`;
CREATE TABLE IF NOT EXISTS `type_of_incentives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_of_incentives`
--

INSERT INTO `type_of_incentives` (`id`, `name`) VALUES
(1, 'lorem ipsum'),
(2, 'demo testing');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_offers`
--

DROP TABLE IF EXISTS `type_of_offers`;
CREATE TABLE IF NOT EXISTS `type_of_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_of_offers`
--

INSERT INTO `type_of_offers` (`id`, `name`) VALUES
(1, 'Lorem ipsaum'),
(2, 'Dummy lorem');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_technical_educations`
--

DROP TABLE IF EXISTS `type_of_technical_educations`;
CREATE TABLE IF NOT EXISTS `type_of_technical_educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_of_technical_educations`
--

INSERT INTO `type_of_technical_educations` (`id`, `name`) VALUES
(1, 'demo test'),
(2, 'demo test1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companyname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_category_id` int(11) NOT NULL DEFAULT 0,
  `business_type_id` int(11) NOT NULL DEFAULT 0,
  `business_type_other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capability_primary_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capability_secondary_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(10) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` int(11) DEFAULT NULL,
  `step` tinyint(2) NOT NULL DEFAULT 0,
  `status` enum('Beginner','Intermediate','Advanced') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Beginner',
  `is_active` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_category_id` (`job_category_id`),
  KEY `business_type_id` (`business_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `companyname`, `email`, `linkedin_id`, `job_title`, `job_category_id`, `business_type_id`, `business_type_other`, `capability_primary_id`, `capability_secondary_id`, `vendor_id`, `email_verified_at`, `password`, `address`, `city`, `state`, `post_code`, `step`, `status`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Daniel', 'Mason', 'Bush Martin Trading', 'prashant.simejiya10@siyainfo.com', NULL, 'Qui non sint dolore', 2, 0, 'Dynamic', '[\"2\"]', '[\"17\",\"18\"]', 10, '2020-03-10 13:00:00', '$2y$10$.0WUyD4Fw0/VEGJiQEgLA.IUCdPZ7clkvjfYeoXqLEWFUggTwMhnG', 'Voluptatem cupidatat', 'Voluptatem', 'Amet mollitia cumqu', 380001, 3, 'Advanced', 0, 'AIKVL2hQZET0MNxOTxt8wJVYexKlqd9pqjpU6dqW1tkvvF20xVpxyVlG8MtO', '2020-03-06 20:03:27', '2020-11-09 00:01:36'),
(2, 'Christian', 'Nicholson', 'Nixon Browning Inc', 'nitesh.mori.sit@gmail.com', NULL, 'Laboris ut incidunt', 4, 2, NULL, NULL, NULL, NULL, '2020-03-06 20:28:34', '$2y$10$QCaz0XyDQBor59uHBs6/7.EiDiXX8Ebsi1UZ1.hrySsIop7PdQmLS', 'Consequatur odit qui', 'Cupidatat expedita e', 'Et id earum consecte', 38000, 3, 'Beginner', 0, NULL, '2020-03-06 20:26:02', '2020-11-02 07:21:04'),
(3, 'Regina', 'Avery', 'Blackwell Levy LLC', 'ramesh.vasoya@siyainfo.com', NULL, 'Eius perspiciatis m', 2, 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$0bHZywub3egeaavNjmLkMuLF0ku4sUoqR69uU4H.in0MlYOj0TzL.', 'Quia quia labore ea', 'Deserunt quibusdam d', 'Nihil sit qui excep', 38000, 0, 'Beginner', 0, 'WgBnGWkq35CvbbQKvDazBDRTpuMYAH3KmnBp2vNHOliCSTjj4ioDaRJe8P6k', '2020-03-12 19:48:53', '2020-03-12 19:48:53'),
(4, 'Jael', 'Schultz', 'Morrow and Gregory Inc', 'tezocawo@mailinator.net', NULL, 'In possimus ratione', 5, 3, NULL, NULL, NULL, NULL, '2020-04-06 09:21:52', '$2y$10$x7QkyeUDJWemb71QWUx4TuXnK35onIblEexIe/kuYft.YGMxsUQpK', 'Commodi iusto dolore', 'Velit eos sint exce', 'Ex dignissimos quis', 380001, 0, 'Beginner', 0, 'VcL8aGX8FpqwH0iHcxEaDhUyWvnmUoaTyaAbIcHbLmTk544b2SKwIO0CfzNO', '2020-04-06 09:17:06', '2020-04-06 09:21:52'),
(5, 'Pheini', 'Hong', 'MI', 'pheinni@measurableimpact.com.au', NULL, 'GD', 2, 0, 'Hello', NULL, NULL, NULL, NULL, '$2y$10$qXGh17j.lLioJJygjRkrMetw5MRVL1Z1Wle6uMUniwNYHyOmYs1em', '2 York Street', 'Sydnay', 'NSW', 2000, 0, 'Beginner', 0, NULL, '2020-04-09 00:41:46', '2020-04-09 00:41:46'),
(6, 'Pheini', 'Hong', 'MI', 'pheini@measurableimpact.com.au', NULL, 'Graphic Designer', 2, 0, 'Graphic Designer', NULL, NULL, NULL, '2020-04-13 18:01:08', '$2y$10$0CgRSkoXyF8FwunTbTyTx.8wQpts9DFYxS4hhSlTyxqpq4hVMp37i', '2 York Street', 'Sydney', 'NSW', 2000, 1, 'Beginner', 0, 'LC9BqqQxKvg0m9LhO18BIENki2lXg32RCeUvb0oZkH4fUylOx9iO1xdHqkxv', '2020-04-13 17:59:21', '2021-02-04 21:41:59'),
(7, 'Ro', 'Wa', 'MI', 'roma@measurableimpact.com.au', NULL, 'ACC', 1, 2, NULL, NULL, NULL, NULL, '2020-04-14 00:43:11', '$2y$10$X/1QPnKAEpjNKLRTbBtKHOJour0p6P1N1Dk7Y9UU1hBTon1ytZxPa', '11/2 York St', 'Sydney', 'NSW', 2000, 0, 'Beginner', 0, NULL, '2020-04-14 00:42:15', '2020-04-14 00:43:11'),
(8, 'joe', 'doe', 'siyainfo', 'nikhil.sompura1@siyainfo.com', NULL, 'Developer', 6, 0, 'tesing', NULL, NULL, NULL, '2020-04-14 04:24:04', '$2y$10$4ifgvcmUKQCqAf4gggExquITItBu2r93b0eKWubuzWMrpWrzrByu6', 'ahmedabad', 'ahmedabad', 'gujarat', 380061, 0, 'Beginner', 0, NULL, '2020-04-14 04:22:06', '2020-04-14 04:24:04'),
(9, 'zubin', 'bhavsar', 'siya', 'zubin.bhavsar.old@siyainfo.com', NULL, 'designer', 3, 0, NULL, NULL, NULL, NULL, '2020-04-14 04:25:11', '$2y$10$Lb8IIO5n6GSyUxMMmVKi.eZRwK3fCERilvIM6Pzce1olVEcblCIKO', 'ahmedabad', 'ahmedabad', 'gujarat', 332200, 0, 'Beginner', 0, '5Vn1l2QGfoVNZ4g4ZqIsyPzBU0Xz9c3sEDee3oZUz9qpusXzGTOI7cVM8lMU', '2020-04-14 04:23:38', '2020-04-14 04:25:11'),
(10, 'nikhil', 'sompura', 'siyainfo', 'nikhil.sompura@siyainfo.com', NULL, 'dev', 4, 0, NULL, NULL, NULL, NULL, '2020-04-14 05:58:43', '$2y$10$Ka3dD0SHU/Kj4hNV58Noh.GQPmmUWlUdej/vxlUQqwuX2IQ4KlRba', 'gt', 'ad', 'gj', 3800456, 3, 'Beginner', 0, 'O45ZC8ui9FX8zjpT4uxwe6909qpCotrtHAAIWBaGVGs7isQy61OqzCYVFaWa', '2020-04-14 05:58:01', '2020-11-19 01:43:58'),
(11, 'Alea', 'Buck', 'Miller and Bishop Associates', 'wujidi@mailinator.com', NULL, 'Labore corrupti cup', 7, 3, NULL, NULL, NULL, NULL, '2020-04-14 08:02:55', '$2y$10$IDEh/EaJ8CmvMNH37A9Yt.or5pUV5rTrONT.rVeMsZGPOGTJoeXr.', 'Odit similique aliqu', 'Reiciendis totam ist', 'Tenetur eum atque mo', 1121, 0, 'Beginner', 0, NULL, '2020-04-14 07:59:34', '2020-04-14 08:02:55'),
(12, 'Virginia', 'Winters', 'Holmes Patel Associates', 'fujir@mailinator.com', NULL, 'Laborum quo ducimus', 4, 0, NULL, NULL, NULL, NULL, '2020-04-14 08:08:02', '$2y$10$ZKNYxOUazX5lokUCk4MLneaQxxyvlGa4xDqGcpTaWN5TKe6pj0g4i', 'Ut expedita in in en', 'Consequatur sed rem', 'Sit sint consequatu', 2222, 0, 'Beginner', 0, NULL, '2020-04-14 08:06:10', '2020-04-14 08:08:02'),
(13, 'Prashant', 'Trivedi', 'Siya', 'prashant.trivedi1@siyainfo.com', NULL, 'Software Engineer', 2, 2, NULL, NULL, NULL, NULL, '2020-04-15 00:43:00', '$2y$10$peV0jytVJjnK5/i5JM6mz.e3OOsjTC0NuANdEHQPcyQr3LgJ0E1bi', 'India', 'Ahmedabad', 'Gujarat', 380058, 0, 'Beginner', 0, NULL, '2020-04-15 00:41:52', '2020-04-15 00:43:00'),
(14, 'Prashant', 'Trivedi', 'Siya Infotech', 'info@siyainfotech.net', NULL, 'PM', 4, 0, NULL, NULL, NULL, NULL, '2020-04-15 00:53:55', '$2y$10$.0WUyD4Fw0/VEGJiQEgLA.IUCdPZ7clkvjfYeoXqLEWFUggTwMhnG', 'India', 'Ahmedabada', 'Gujarat', 380058, 0, 'Beginner', 0, NULL, '2020-04-15 00:52:52', '2020-04-15 00:53:55'),
(15, 'Hillary', 'Brewer', 'Rollins and Welch LLC', 'kuwa@mailinator.com', NULL, 'Accusantium Nam nost', 4, 0, NULL, NULL, NULL, NULL, '2020-04-16 09:43:02', '$2y$10$a2JEBmvShUAi/wVsR2exSuA1miDRkcFHPN3U7sGR/vwolwRHedMfC', 'Atque provident nos', 'Ea facere explicabo', 'Vel id molestiae ex', 3434, 0, 'Beginner', 0, NULL, '2020-04-16 09:42:00', '2020-04-16 09:43:02'),
(16, 'Christian', 'Nicholson', 'Nixon Browning Inc', 'prashant.simejiya1@siyainfo.com', NULL, 'Laboris ut incidunt', 4, 2, NULL, NULL, NULL, NULL, '2020-04-24 13:48:41', '$2y$10$ywVBSVToS62e/WLUg79SnO8rjMarr4UeW8TNgdBfPjC/kSy7tVwoW', 'Consequatur odit qui', 'Cupidatat expedita e', 'Et id earum consecte', 38000, 3, 'Beginner', 0, NULL, '2020-04-24 13:44:08', '2020-11-02 06:42:54'),
(17, 'Pheini', 'Hong', 'MI', 'info@measurableimpact.com.au', NULL, 'GD', 4, 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$dJ12vXP2HcoA170uKIspc.DUtf9nXNHMy7TzL74I6LxXHIN4UeCry', '2 York St', 'Sydney', 'NSW', 2000, 0, 'Beginner', 0, NULL, '2020-04-29 06:08:56', '2020-04-29 06:08:56'),
(19, 'zubin', 'Bhavsar', '............................................', 'zubin.bhavsar.old1@siyainfo.com', NULL, 'designer', 2, 2, NULL, NULL, NULL, NULL, '2020-05-08 10:07:17', '$2y$10$eT7U6L3OVGHoq72sRMuw2ey2ZKQK1aKDj9lZ752kQuTqbd/INPzF.', 'ahmedabad', '45545', '54545', 123456789, 0, 'Beginner', 0, 'mtwZuHMcWwpFH51y8htxjlDGE3GzUD7rdxjdsz1pikgxAeZ2hCrErFGUmkkv', '2020-05-08 10:04:33', '2020-05-08 10:08:03'),
(20, '............................................................', '..................................', '.......................', 'aaaaaassssa@siya.com', NULL, 'siohaioahs', 4, 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$OZD8WMPf9kRiZFYoqOedaOzpGclufCFEz1wJuL4GsG0BGHkB4OLrO', 'ahmedabad', '45454`', '54545454554545454545', 464646464, 0, 'Beginner', 0, NULL, '2020-05-08 11:15:43', '2020-05-08 11:15:43'),
(21, 'anil', 'vaza', 'siya', 'anil.vaza@siyainfo.com', NULL, 'dev', 3, 0, NULL, NULL, NULL, NULL, '2020-05-08 11:27:46', '$2y$10$LPhg3P7HH2zpV.ezG0Ey4u/6KSi6FzVQKS/PrPbdR5lLaBC6/gFyi', 'ahmedabad', 'ahm', 'guj', 78787878, 0, 'Beginner', 0, NULL, '2020-05-08 11:25:15', '2020-05-08 11:27:46'),
(22, 'Prashant', 'Tech Partner', 'Tech Partner', 'career@siyainfotech.net', NULL, 'PM', 1, 2, NULL, NULL, NULL, NULL, '2020-05-09 09:21:39', '$2y$10$Z4AMqN8948yGpYRXf8WYfe.MX3tdZ.fBbbO4P93P1IKedfOWVUxgS', 'Demo', 'ADI', 'GUJ', 380052, 0, 'Beginner', 0, '1toEAlgOJrRQIoRoeInFJfo4RkXh4dmUu7TfDSLWaRcJsVoxwLF0Na83awlR', '2020-05-09 09:17:55', '2020-05-10 08:41:55'),
(23, 'Rajendra', 'Tech Vendor', 'Tech Vendor', 'rajendra.makwana@siyainfo.com', NULL, 'PM', 3, 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$NCrJT/HCzjZzzuq2PyqpJefXf0PYc2Rj5DPRSNxb2VZ1Oqj7XJcbK', 'India', 'ADI', 'GUJ', 380058, 0, 'Beginner', 0, NULL, '2020-05-09 09:57:20', '2020-05-09 09:57:20'),
(24, 'Sales', 'Tech Vendor', 'Tech Vendor', 'sales@siyainfo.com', NULL, 'PM', 3, 0, NULL, NULL, NULL, NULL, '2020-05-10 08:30:38', '$2y$10$Il6DqIrAPPwwbyHqaEp9teTi86ftNaacmg3.Cl8vmgI9kYZDOi5Fe', 'India', 'ADI', 'GUJ', 380058, 0, 'Beginner', 0, NULL, '2020-05-10 08:21:37', '2020-05-10 08:30:38'),
(25, 'zubin', 'bhavsar', 'siya', 'zubin.bhavsar@siyainfo.com', NULL, 'd', 1, 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$ib7WhtOfFZsmjFJgIOuqQOJWCtYAtseByLwHmpZlCm6Mm.zsFlV4.', 'ahmedabad', 'h', 'gfr', 45455, 0, 'Beginner', 0, NULL, '2020-05-11 06:05:43', '2020-05-11 06:05:43'),
(26, 'Garth', 'Rush', 'Hubbard and Franco Inc', 'peguhozo@mailinator.com', NULL, 'Nihil quo provident', 3, 0, NULL, NULL, NULL, NULL, '2020-07-16 06:31:06', '$2y$10$CocW.dNR1xixf2la3PkkUesZaYftXDf9/rnPPQlhcwt0AWLNy00Xm', 'Ipsa fuga Ipsam no', 'Sit nisi excepteur i', 'Eu vitae animi laud', 123654, 0, 'Beginner', 0, NULL, '2020-07-16 06:19:22', '2020-07-16 06:31:06'),
(27, 'demo', 'siya', NULL, 'prashant.simejiya.sit@gmail.com', 'G9UI1FOO9C', NULL, 0, 0, NULL, NULL, NULL, NULL, '2020-09-14 03:56:09', NULL, NULL, NULL, NULL, NULL, 0, 'Beginner', 0, NULL, '2020-09-14 03:56:09', '2020-09-14 03:56:09'),
(28, 'Prashant', 'Trivedi', NULL, 'prashant.aspnet.2017@gmail.com', 'PyxSr0l3Fm', NULL, 0, 0, NULL, NULL, NULL, NULL, '2020-09-14 22:46:02', NULL, NULL, NULL, NULL, NULL, 0, 'Beginner', 0, NULL, '2020-09-14 22:46:02', '2020-09-14 22:46:02'),
(29, 'prashant', 'dev', 'demo company', 'admin7@mailinator.com', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '2020-09-15 05:33:00', '$2y$10$x9fFGcdwIhmySJKD0JKgZuG8tq3Nlk5vVFBD6O5n6v.BJ2XEhxBj6', 'spider cross road', 'ahmedabad', 'gujarat', 362000, 0, 'Beginner', 0, 'YkeEm9ZDrGszqcYJpc6CEjLWpHSdbVo5pXIaTxs6ZLBGnv6SIgG6DmF5EOaA', '2020-09-14 23:47:37', '2020-09-14 23:47:37'),
(31, 'dev', 'siya', 'Siya Infotech', 'prashant.trivedi222@siyainfo.com', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$DhyPgu9S28rkrV7YsniKpOH4TUCXOj0KF3rLIxQKAPozB.UXNsGrG', 'cross circle', 'ahmedabad', 'gujarat', 362000, 0, 'Beginner', 0, NULL, '2020-09-15 01:43:47', '2020-09-15 01:43:47'),
(32, 'Pavan', 'Sai Kumar', 'Outlook.com', 'pavan.saikumar@outlook.com', 'mPg7nJS09I', NULL, 0, 0, NULL, NULL, NULL, NULL, '2020-09-16 03:56:35', '$2y$10$yGkVX.f3he9cV0p4Z1huEOTjwrBaxdeog84dToogNjn7mnPZDC04O', '185 King Street', 'Sydney', 'NSW', 2250, 0, 'Beginner', 0, 'bpL75BqJ8sVrlevv7Y8olcumbjJ6PcsyaefuwkQLMAr7t1qlcL1TWi67yuP8', '2020-09-16 03:46:51', '2020-09-16 03:56:35'),
(33, 'Sandeep', 'Joshi', 'Measurable Impact', 'sandeep@measurableimpact.com.au', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, '$2y$10$5CFw/NqgzWSXb8W8ZqvjC.JgdQJTM9PT6XRowBemuxWa4dYF/9Bvu', 'Level 2 11 York Street', 'Sydney', 'NSW', 2000, 3, 'Beginner', 0, NULL, '2020-09-16 05:09:06', '2021-05-31 08:26:08'),
(34, 'Sandeep', 'Joshi', NULL, 'sandeepjoshi1@gmail.com', 'Z8JQWHpONM', NULL, 0, 0, NULL, NULL, NULL, NULL, '2020-09-16 05:09:53', NULL, NULL, NULL, NULL, NULL, 0, 'Beginner', 0, NULL, '2020-09-16 05:09:53', '2020-09-16 05:09:53'),
(35, 'pras', 'siya', 'Siya Infotech', 'prashant.simejiya@siyainfo.com', NULL, NULL, 0, 0, NULL, '[\"7\"]', '[\"56\",\"62\"]', 15, '2020-11-02 08:04:33', '$2y$10$s8.oj/vKXuGMeXctxQDF0uF0QRopQYl5GTZJFp9ZlQVnOY.lqAANy', NULL, NULL, NULL, NULL, 3, 'Beginner', 0, NULL, '2020-11-02 08:04:00', '2020-11-02 08:09:16'),
(36, 'Prashant', 'Trivedi', 'Siya Infotech', 'prashant.trivedi2525@siyainfo.com', NULL, 'Job Title 124', 1, 1, NULL, '[\"1\",\"3\"]', '[\"3\"]', 2, '2020-11-03 05:46:54', '$2y$10$8PM8q.21CHGa3b5ED.pxqOwqnJDYTbIvdV8d86.VFu6bRiZMILBza', NULL, NULL, NULL, NULL, 3, 'Advanced', 0, NULL, '2020-11-03 05:46:03', '2020-11-03 05:57:00'),
(37, 'Prashant', 'Trivedi', 'Siya Infotech', 'prashant.trivedi1252@siyainfo.com', NULL, 'IT', 2, 2, NULL, '[\"2\",\"3\"]', '[\"12\"]', 3, '2020-11-06 04:53:53', '$2y$10$C2yvHa/4sdsSmBz9xGcNRODSX6j3hUNCobu7cNmGQY4gNgO2WLVLi', NULL, NULL, NULL, NULL, 3, 'Advanced', 0, NULL, '2020-11-06 04:52:59', '2020-11-06 05:28:14'),
(38, 'Prashant', 'Trivedi', 'Siya Infotech', 'prashant.trivedi@siyainfo.com', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, '2020-11-19 00:43:43', '$2y$10$cLtriRheKnvRVWQFQ0fFx.5ACZDJO2SO6peqz3CT6U7/MZCrkCcFi', NULL, NULL, NULL, NULL, 3, 'Beginner', 0, NULL, '2020-11-19 00:42:40', '2020-11-20 04:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=871 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`) VALUES
(1, '1E'),
(2, '2C'),
(3, '2N'),
(4, '3CX'),
(5, '3Dconnexion'),
(6, '3M Australia'),
(7, '8ware'),
(8, '8x8'),
(9, 'A10 Networks'),
(10, 'A2iA'),
(11, 'Aavara'),
(12, 'Abbyy'),
(13, 'ACASE'),
(14, 'AcBel'),
(15, 'ACD Systems'),
(16, 'Acer'),
(17, 'Acronis ANZ'),
(18, 'Act-On'),
(19, 'ACTi'),
(20, 'Actiance'),
(21, 'Actifio'),
(22, 'ActiveImage'),
(23, 'ActivePDF'),
(24, 'Activision'),
(25, 'Acunetix'),
(26, 'Adaptec Australia'),
(27, 'Adata'),
(28, 'Adesso'),
(29, 'ADLINK'),
(30, 'Adobe Systems'),
(31, 'Adrem Software'),
(32, 'Advantech Australia'),
(33, 'AEG Power Solutions'),
(34, 'Aerocool'),
(35, 'Aerohive Networks'),
(36, 'Airlock Digital'),
(37, 'AirMagnet'),
(38, 'AirTight Networks'),
(39, 'Alcaltel'),
(40, 'Alcatel-Lucent Enterprise'),
(41, 'AlgoSec'),
(42, 'Allied Telesis'),
(43, 'Allot Communications'),
(44, 'Alloy'),
(45, 'Alloy Software'),
(46, 'Allround Automation'),
(47, 'Alogic'),
(48, 'Altec Lansing'),
(49, 'Altium'),
(50, 'Altova'),
(51, 'Altusen'),
(52, 'Amacrox'),
(53, 'Amazon Web Services'),
(54, 'AMD'),
(55, 'Amulet Hotkey'),
(56, 'Antec'),
(57, 'AOC'),
(58, 'AOpen'),
(59, 'APC by Schneider Electric'),
(60, 'Apple'),
(61, 'APS Enterprise'),
(62, 'Arbor Networks'),
(63, 'ARC Wireless'),
(64, 'Arcserve'),
(65, 'Arcsoft'),
(66, 'Arctic Silver'),
(67, 'Arista Networks'),
(68, 'Aritech'),
(69, 'Armaggeddon'),
(70, 'Aruba'),
(71, 'Aruba Wireless Networks'),
(72, 'Aryaka'),
(73, 'ASRock'),
(74, 'ASSA ABLOY Aust'),
(75, 'Astone'),
(76, 'Astro'),
(77, 'Astrotek'),
(78, 'ASUS'),
(79, 'ASUSTOR'),
(80, 'AT&T'),
(81, 'Atalasoft'),
(82, 'Atdec'),
(83, 'Atempo'),
(84, 'Aten'),
(85, 'ATrust'),
(86, 'ATTO'),
(87, 'AudioBox'),
(88, 'Audiocodes'),
(89, 'Audioengine'),
(90, 'Australian Monitor'),
(91, 'Autocue'),
(92, 'Autodesk Australia'),
(93, 'Avast'),
(94, 'Avaya'),
(95, 'Aver'),
(96, 'Aver Information'),
(97, 'Avermedia'),
(98, 'AVG (AU/NZ)'),
(99, 'Avigilon'),
(100, 'Avira'),
(101, 'Avision It'),
(102, 'Avocor'),
(103, 'Axis'),
(104, 'Axis Communications'),
(105, 'Axure Software'),
(106, 'Axxana'),
(107, 'Aywun'),
(108, 'B&B Electronics'),
(109, 'Ballistix'),
(110, 'Banff Cyber Technologies'),
(111, 'Barco'),
(112, 'Barix'),
(113, 'Barracuda Networks'),
(114, 'Beats by Dr. Dre'),
(115, 'Belkin Australia'),
(116, 'BenQ Australia'),
(117, 'BenQ IT & AV'),
(118, 'Beta Systems'),
(119, 'BeyondTrust'),
(120, 'BIAMP'),
(121, 'Big Switch Networks'),
(122, 'Billion'),
(123, 'Bit Titan'),
(124, 'Bitfenix'),
(125, 'Bitglass'),
(126, 'BlackBerry'),
(127, 'Bliss'),
(128, 'Blue Microphones'),
(129, 'BlueAnt'),
(130, 'BlueJeans'),
(131, 'Boris FX'),
(132, 'Brateck'),
(133, 'Bravia'),
(134, 'Bridgewave'),
(135, 'Brinno'),
(136, 'Brocade Communications'),
(137, 'Brother International (Aust)'),
(138, 'Bticino'),
(139, 'Buffalo Technology'),
(140, 'BullGuard Australia'),
(141, 'CA Technologies'),
(142, 'Cambium Networks'),
(143, 'Canon'),
(144, 'Carbon Black'),
(145, 'Carbonite'),
(146, 'Caringo'),
(147, 'Case-Mate'),
(148, 'Casecom'),
(149, 'Cato Networks'),
(150, 'Cavirin'),
(151, 'Celestix'),
(152, 'Centerm'),
(153, 'CenturyLink'),
(154, 'CH Products'),
(155, 'Check Note'),
(156, 'Check Point'),
(157, 'Check Point Software Technologies'),
(158, 'Chelsio'),
(159, 'Chenbro'),
(160, 'Cherry'),
(161, 'Cibecs'),
(162, 'CimCor'),
(163, 'CipherLab'),
(164, 'Cirrius'),
(165, 'Cisco'),
(166, 'Citrix Systems Asia Pacific'),
(167, 'ClearOne'),
(168, 'Cloudera'),
(169, 'Cloudian'),
(170, 'Cloudphysics'),
(171, 'Cognimatics'),
(172, 'Cohesity'),
(173, 'Colortrac'),
(174, 'Command Hub'),
(175, 'Commsoft'),
(176, 'Commvault'),
(177, 'Compulocks'),
(178, 'Compuverde'),
(179, 'Comsol'),
(180, 'Condusiv'),
(181, 'ConnectWise'),
(182, 'Contex'),
(183, 'Continuum'),
(184, 'Cooler Master'),
(185, 'CoolerMaster'),
(186, 'Corel'),
(187, 'Corero'),
(188, 'Corning'),
(189, 'Corsair'),
(190, 'Cososys'),
(191, 'Cradlepoint'),
(192, 'Creative'),
(193, 'Cristie Software'),
(194, 'Crucial'),
(195, 'Ctera'),
(196, 'Cumulus Networks'),
(197, 'Custom'),
(198, 'Cyber Risk Aware'),
(199, 'CyberArk'),
(200, 'Cyberdata'),
(201, 'Cybereason'),
(202, 'Cyberoam'),
(203, 'CyberPower Systems'),
(204, 'CYBONET'),
(205, 'Cylance'),
(206, 'CyTrack'),
(207, 'D-Link Australia'),
(208, 'D3 Security'),
(209, 'Dameware'),
(210, 'Darktrace'),
(211, 'DataCore'),
(212, 'Datadobi'),
(213, 'Dataflex'),
(214, 'Datalogic'),
(215, 'Datalogic Scanning'),
(216, 'Datawatch'),
(217, 'Davis Legend'),
(218, 'DBVisit'),
(219, 'Deep Instinct'),
(220, 'Deepcool'),
(221, 'Dell'),
(222, 'Dell EMC'),
(223, 'Dell SonicWALL'),
(224, 'Delta Electronics'),
(225, 'DencoHappel'),
(226, 'Denon'),
(227, 'Denso'),
(228, 'Device Authority'),
(229, 'Device42'),
(230, 'Devo'),
(231, 'Digi'),
(232, 'Digi International'),
(233, 'Digifort'),
(234, 'DigitalPersona'),
(235, 'Digium'),
(236, 'Dintek'),
(237, 'DisplayTEN'),
(238, 'Divoom'),
(239, 'DNH'),
(240, 'Doro'),
(241, 'DragonWar'),
(242, 'DrayTek'),
(243, 'DROBO'),
(244, 'DTEN'),
(245, 'Dymo'),
(246, 'East'),
(247, 'Eaton'),
(248, 'Edge-Core'),
(249, 'Edgenexus'),
(250, 'Edgewater Networks'),
(251, 'Edimax'),
(252, 'Ekahau'),
(253, 'Elatec'),
(254, 'Element'),
(255, 'Elgato'),
(256, 'Elite Screens'),
(257, 'Elo Touchsystems'),
(258, 'Elysium'),
(259, 'Embarcadero'),
(260, 'Embrava'),
(261, 'EMC'),
(262, 'Emtec'),
(263, 'Emulex'),
(264, 'Encapto WiFi'),
(265, 'Energizer Australia'),
(266, 'Enfocus'),
(267, 'Engage'),
(268, 'Entensys'),
(269, 'Entrust'),
(270, 'Epson'),
(271, 'Epygi'),
(272, 'Equinix (DC)'),
(273, 'Ergonomic Solutions'),
(274, 'Ergotron'),
(275, 'Ericom'),
(276, 'Eset'),
(277, 'Esker Australia'),
(278, 'Ethernet Direct'),
(279, 'Etherwan'),
(280, 'Everki'),
(281, 'EVGA'),
(282, 'Evocept'),
(283, 'EVOnet'),
(284, 'Evutec'),
(285, 'Exabeam'),
(286, 'ExaGrid Systems'),
(287, 'Exinda Networks'),
(288, 'Extensis'),
(289, 'ExtraHop'),
(290, 'Extreme Networks'),
(291, 'F-Secure'),
(292, 'F5 Networks'),
(293, 'FaceMe'),
(294, 'Falcom'),
(295, 'FarSite Communications'),
(296, 'FEC'),
(297, 'Fetch TV'),
(298, 'Fibaro'),
(299, 'Filemaker'),
(300, 'FinalCode'),
(301, 'FireEye'),
(302, 'Firemon'),
(303, 'FitBit'),
(304, 'Flashpoint'),
(305, 'Flexera'),
(306, 'Flir'),
(307, 'Flowmon'),
(308, 'Fluidmesh'),
(309, 'Forcepoint'),
(310, 'ForeScout'),
(311, 'Fortinet'),
(312, 'Foscam'),
(313, 'Foxit Software'),
(314, 'Fractal Design'),
(315, 'FRITZ!Box'),
(316, 'FSH'),
(317, 'FSP'),
(318, 'Fuji Xerox Australia'),
(319, 'Fuji Xerox Printers'),
(320, 'Fujifilm'),
(321, 'Fujitsu'),
(322, 'Fusion-io'),
(323, 'FUZE'),
(324, 'G DATA'),
(325, 'Galax'),
(326, 'Garrettcom'),
(327, 'GeForce'),
(328, 'GeIL'),
(329, 'Gemalto'),
(330, 'Gemini Data'),
(331, 'GEN Energy'),
(332, 'GenArts'),
(333, 'Genesys PureCloud'),
(334, 'Geovision'),
(335, 'Getac'),
(336, 'Gett'),
(337, 'GFI'),
(338, 'GFI Software'),
(339, 'Gigabyte'),
(340, 'Gigamon'),
(341, 'Gigaset'),
(342, 'Gigaset Pro'),
(343, 'Gilkon'),
(344, 'GitHub'),
(345, 'GlobalScape'),
(346, 'Glh'),
(347, 'Go Connect CRM'),
(348, 'Good 2 Go'),
(349, 'Google'),
(350, 'Grandstream'),
(351, 'Grandview'),
(352, 'Gskill'),
(353, 'Gumdrop'),
(354, 'GUNNAR'),
(355, 'Hana Wireless'),
(356, 'Hapara'),
(357, 'Hauppauge'),
(358, 'Havis'),
(359, 'Heckler Design'),
(360, 'Heimdal Security'),
(361, 'Helios Labs'),
(362, 'Herma'),
(363, 'Hewlett Packard Enterprise'),
(364, 'Hewlett Packard Inc'),
(365, 'Hewlett-Packard Australia'),
(366, 'HGST'),
(367, 'HID'),
(368, 'Hills'),
(369, 'Hitachi Australia'),
(370, 'Hitachi Vantara'),
(371, 'Honeywell'),
(372, 'HP'),
(373, 'HP Maintenance'),
(374, 'HTC'),
(375, 'Huawei'),
(376, 'Huddly'),
(377, 'Humanscale'),
(378, 'Huntkey'),
(379, 'Hyperjuice'),
(380, 'IBM Australia'),
(381, 'IBM Security'),
(382, 'Ideazon'),
(383, 'IFS'),
(384, 'IGEL Technology'),
(385, 'IgniteNet'),
(386, 'iGrip'),
(387, 'ikan'),
(388, 'iKey'),
(389, 'Image Access'),
(390, 'IMC Networks'),
(391, 'Impact Systems'),
(392, 'Imperva'),
(393, 'Impulse'),
(394, 'Infinidat'),
(395, 'Infoblox'),
(396, 'Infocase'),
(397, 'Infocus'),
(398, 'Informatica'),
(399, 'Information Builders'),
(400, 'Infortrend'),
(401, 'Innergie'),
(402, 'Inno3D'),
(403, 'Inovonics'),
(404, 'Intel'),
(405, 'Inteliserver'),
(406, 'Interactive'),
(407, 'Intergrated Supplies'),
(408, 'Interlogix'),
(409, 'Inwin'),
(410, 'IOgear'),
(411, 'ION'),
(412, 'ioSafe'),
(413, 'iPGard'),
(414, 'Ipswitch'),
(415, 'Ironkey'),
(416, 'iServ'),
(417, 'IT Glue'),
(418, 'Ivanti'),
(419, 'Ixia'),
(420, 'J5Create'),
(421, 'Jabra'),
(422, 'Jam Software'),
(423, 'Jamf'),
(424, 'Javelin'),
(425, 'Jetbrains'),
(426, 'JMR'),
(427, 'Juniper Networks'),
(428, 'Kaspersky'),
(429, 'KBC'),
(430, 'Keeper Security'),
(431, 'KEMP Technologies'),
(432, 'Kensington'),
(433, 'Kentico'),
(434, 'Kentik'),
(435, 'Kingston'),
(436, 'Kingston HyperX'),
(437, 'Kingston Technology'),
(438, 'Kobo'),
(439, 'Kocom'),
(440, 'Kodak'),
(441, 'Komprise'),
(442, 'Konference'),
(443, 'Konftel'),
(444, 'Konica Minolta'),
(445, 'Krusell'),
(446, 'KSI'),
(447, 'KStar'),
(448, 'Kuando BUSYLIGHT'),
(449, 'Kyocera'),
(450, 'Kyocera Document Solutions'),
(451, 'LaCie'),
(452, 'Laird Technologies'),
(453, 'Lanier Australia'),
(454, 'Lantronix'),
(455, 'Laser'),
(456, 'Leadtek'),
(457, 'LEDware'),
(458, 'Lenovo'),
(459, 'Leviton Security & Automation'),
(460, 'Lexar'),
(461, 'Lexmark'),
(462, 'LG'),
(463, 'Libelium'),
(464, 'Libra ESVA'),
(465, 'Lightspeed'),
(466, 'LinkBasic'),
(467, 'Linksys'),
(468, 'LiquidwareLabs'),
(469, 'Lite-on'),
(470, 'Livescribe'),
(471, 'Logitech'),
(472, 'LogMeIn'),
(473, 'LogRhythm'),
(474, 'LSI Logic'),
(475, 'M2 NET'),
(476, 'Maestro'),
(477, 'Magellan'),
(478, 'MagStor'),
(479, 'MakerBot'),
(480, 'Malwarebytes'),
(481, 'Managed Services Finance'),
(482, 'ManageEngine'),
(483, 'MapInfo'),
(484, 'MapR'),
(485, 'Marketo'),
(486, 'Matica'),
(487, 'Matrox'),
(488, 'Maxon'),
(489, 'Maxtor'),
(490, 'Mbeat'),
(491, 'McAfee'),
(492, 'McAfee Australia'),
(493, 'Mellanox Technologies'),
(494, 'Meraki Networks'),
(495, 'MessageMe'),
(496, 'Metrologic'),
(497, 'Micro Focus'),
(498, 'Micron'),
(499, 'Microsoft'),
(500, 'Microsoft Azure'),
(501, 'Microsoft Gold Partner'),
(502, 'Microsoft OEM'),
(503, 'Microtek'),
(504, 'MikroTik'),
(505, 'Milkshake'),
(506, 'Mimosa'),
(507, 'Mindscape'),
(508, 'Minitab'),
(509, 'Mionix'),
(510, 'Mist Technologies'),
(511, 'Mitel'),
(512, 'mLogic'),
(513, 'MobileIron'),
(514, 'Mobotix AG'),
(515, 'Moki'),
(516, 'Mophie'),
(517, 'Motorola'),
(518, 'MSI'),
(519, 'MYOB'),
(520, 'Nano Clean'),
(521, 'Naturalpoint'),
(522, 'Nautilus Infotech'),
(523, 'Navman'),
(524, 'NCP'),
(525, 'NCR Australia'),
(526, 'NEC'),
(527, 'Nero'),
(528, 'NetApp'),
(529, 'NetComm'),
(530, 'Netgear Australia'),
(531, 'NetManage'),
(532, 'NetMotion'),
(533, 'Netonix'),
(534, 'Netskope'),
(535, 'Netsparker'),
(536, 'Network Value'),
(537, 'Netwrix'),
(538, 'Neuxpower Solutions'),
(539, 'Neverfail'),
(540, 'NICE'),
(541, 'Nikon'),
(542, 'Nimble Storage'),
(543, 'NinjaMSP'),
(544, 'NitroPDF'),
(545, 'Noble Security'),
(546, 'Noctua'),
(547, 'Nokia'),
(548, 'Nomadesk'),
(549, 'Noontec'),
(550, 'NorthBridge Secure Systems'),
(551, 'Norton'),
(552, 'NovaStor'),
(553, 'Nuance'),
(554, 'Nutanix'),
(555, 'Nvidia'),
(556, 'nVidia Quadro'),
(557, 'NZXT'),
(558, 'Obihai'),
(559, 'OCZ'),
(560, 'OKI'),
(561, 'OKI Printing Solutions'),
(562, 'Olympus'),
(563, 'OmniMount'),
(564, 'OneAccess'),
(565, 'OneLogin'),
(566, 'Open Mesh'),
(567, 'OPSWAT'),
(568, 'Optex'),
(569, 'Optimum Path'),
(570, 'Optoma'),
(571, 'Oracle'),
(572, 'Orico'),
(573, 'Oricom'),
(574, 'Overland Storage'),
(575, 'OWL'),
(576, 'P2Ware'),
(577, 'PacketLight Networks'),
(578, 'Pacom'),
(579, 'Paessler'),
(580, 'Paessler AG'),
(581, 'PAG'),
(582, 'Palo Alto Networks'),
(583, 'Panasonic'),
(584, 'Panduit'),
(585, 'Parallels'),
(586, 'Parrot'),
(587, 'Partner Tech'),
(588, 'Pat Townsend'),
(589, 'Patriot Memory'),
(590, 'Patton'),
(591, 'Pelican'),
(592, 'Perle'),
(593, 'Perle Systems'),
(594, 'PexIP'),
(595, 'Philips'),
(596, 'Phoenix Audio'),
(597, 'Picus Security'),
(598, 'PineApp'),
(599, 'Pioneer'),
(600, 'Pitney Bowes'),
(601, 'Planet Technology'),
(602, 'Plantronics'),
(603, 'Plustek'),
(604, 'Poindus'),
(605, 'Poltys'),
(606, 'Polycom'),
(607, 'Pop360'),
(608, 'Posiflex'),
(609, 'Postium'),
(610, 'Power Logic'),
(611, 'Power Shield'),
(612, 'Premier Technologies'),
(613, 'Primera'),
(614, 'PrinterLogic'),
(615, 'Printix'),
(616, 'ProLabs'),
(617, 'Promethean'),
(618, 'Promise Technology'),
(619, 'Proofpoint'),
(620, 'Protech Systems'),
(621, 'Pulse Secure'),
(622, 'PulseOptics'),
(623, 'Pure Storage'),
(624, 'PureGear'),
(625, 'QLogic'),
(626, 'QNAP'),
(627, 'Quadro'),
(628, 'Qualstar'),
(629, 'Quantum'),
(630, 'Quell'),
(631, 'Quest Software'),
(632, 'Quicken'),
(633, 'Quicklaunch'),
(634, 'Rackspace'),
(635, 'Radiflow'),
(636, 'Radware'),
(637, 'Rapid7'),
(638, 'Rapoo'),
(639, 'Raritan'),
(640, 'Razer'),
(641, 'Red Giant'),
(642, 'Red Hat'),
(643, 'RedSeal'),
(644, 'Reekoh'),
(645, 'Replify'),
(646, 'RevoLabs'),
(647, 'RF Armor'),
(648, 'RF Elements'),
(649, 'Ricoh Australia'),
(650, 'Rimage'),
(651, 'RingCentral'),
(652, 'Riverbed'),
(653, 'Rosetta Stone'),
(654, 'Rover Instruments'),
(655, 'Roxio'),
(656, 'RSA'),
(657, 'RTX'),
(658, 'Rubrik'),
(659, 'Ruckus Wireless'),
(660, 'RVM'),
(661, 'Samsung'),
(662, 'Sandisk'),
(663, 'Sanyo'),
(664, 'SAP Australia'),
(665, 'SAP Concur'),
(666, 'Sapphire'),
(667, 'Sawmill'),
(668, 'Scosche'),
(669, 'Screen Technics'),
(670, 'Scythe'),
(671, 'Seagate'),
(672, 'Seagate Technology'),
(673, 'Seagull'),
(674, 'Seagull Scientific'),
(675, 'Seal Shield'),
(676, 'Seavus'),
(677, 'SecureSoft'),
(678, 'Sennheiser'),
(679, 'SentinelOne'),
(680, 'Serial-image'),
(681, 'Serveredge'),
(682, 'Sharp'),
(683, 'Shintaro'),
(684, 'Shireen'),
(685, 'Shoretel'),
(686, 'Shuttle'),
(687, 'Siemens'),
(688, 'Siemens Gigaset'),
(689, 'Siklu Communications'),
(690, 'Silex Technology'),
(691, 'SilexPro'),
(692, 'Silver Peak'),
(693, 'Silverstone'),
(694, 'Simble'),
(695, 'SimpliVity'),
(696, 'SIPcity'),
(697, 'Skybox Security'),
(698, 'Skykick'),
(699, 'Small Tree'),
(700, 'Smart'),
(701, 'Smart Print'),
(702, 'SmartAVI'),
(703, 'SmartDraw'),
(704, 'SmartOptics'),
(705, 'Smartsign'),
(706, 'Smspasscode'),
(707, 'Snom'),
(708, 'Soanar'),
(709, 'Socket'),
(710, 'Socomec'),
(711, 'Softlayer'),
(712, 'Solarflare Communications'),
(713, 'SolarWinds'),
(714, 'SolarWinds MSP'),
(715, 'Sonic Gear'),
(716, 'SonicWall'),
(717, 'Sonim'),
(718, 'Sonus'),
(719, 'Sony'),
(720, 'Sophos'),
(721, 'SoundSphere'),
(722, 'Sparx'),
(723, 'Spectralink'),
(724, 'Splunk'),
(725, 'SSH'),
(726, 'StarLeaf'),
(727, 'Starwind Software'),
(728, 'Steelseries'),
(729, 'STM'),
(730, 'StorageCraft'),
(731, 'Streamstar'),
(732, 'Striiv'),
(733, 'Strontium'),
(734, 'Studio Network Solutions'),
(735, 'Studio Proper'),
(736, 'Sumologic'),
(737, 'Sunix'),
(738, 'SuperMicro'),
(739, 'Suse'),
(740, 'wann Communications'),
(741, 'Symantec'),
(742, 'Symantec Cloud'),
(743, 'Synamic'),
(744, 'Syncro Soft'),
(745, 'ynology'),
(746, 'Tactical Technologies'),
(747, 'Takeway'),
(748, 'TalariaX'),
(749, 'Tandberg Data'),
(750, 'Targus'),
(751, 'Team Group'),
(752, 'TeamViewer'),
(753, 'Tech21'),
(754, 'TechSmith'),
(755, 'Telerik'),
(756, 'Telestream'),
(757, 'Telstra Corporation'),
(758, 'Temasoft'),
(759, 'Tenable Security'),
(760, 'Teradici'),
(761, 'Thales e-Security'),
(762, 'Thecus'),
(763, 'Thermaltake'),
(764, 'ThinPrint'),
(765, 'ThreatConnect'),
(766, 'ThreatTrack Security'),
(767, 'Thrustmaster'),
(768, 'Thule Organization Solution'),
(769, 'Thycotic'),
(770, 'TitanHQ'),
(771, 'Toffee'),
(772, 'TOM TOM Telematics'),
(773, 'TomTom'),
(774, 'Topaz Systems'),
(775, 'Toshiba'),
(776, 'Toshiba TEC'),
(777, 'Total Defense'),
(778, 'Touch IT'),
(779, 'Toughbook'),
(780, 'Townsend Security'),
(781, 'TP-Link'),
(782, 'Transcend'),
(783, 'Transtector'),
(784, 'TravelSIM'),
(785, 'Trend Micro'),
(786, 'Trend Micro Australia'),
(787, 'triCerat'),
(788, 'Trilio'),
(789, 'Tripwire'),
(790, 'Trolley Dollies'),
(791, 'Tronika'),
(792, 'Trustwave'),
(793, 'TSM Manager'),
(794, 'TTK'),
(795, 'Tufin'),
(796, 'Tyco'),
(797, 'Tycon Power'),
(798, 'TYLT'),
(799, 'U-BOARD'),
(800, 'U-Reach'),
(801, 'uberAgent'),
(802, 'Ubiquiti'),
(803, 'UBTECH'),
(804, 'Ultra Serve'),
(805, 'UniPrint'),
(806, 'Uniq'),
(807, 'Unitrends'),
(808, 'Uniview'),
(809, 'UpGuard'),
(810, 'UPS Power Solutions'),
(811, 'Upsonic Power'),
(812, 'V7'),
(813, 'vArmour'),
(814, 'Varonis'),
(815, 'Veeam'),
(816, 'Veeam Software'),
(817, 'Venom'),
(818, 'Veracity'),
(819, 'Veracode'),
(820, 'Verbatim'),
(821, 'Veritas'),
(822, 'Vertiv'),
(823, 'Vexata'),
(824, 'Vidyo'),
(825, 'Viewsonic'),
(826, 'Vigitron'),
(827, 'VIPRE'),
(828, 'Viptela'),
(829, 'Vircom'),
(830, 'Virtual Instruments'),
(831, 'Vision Audio Visual'),
(832, 'Vision Solutions'),
(833, 'Vivitek'),
(834, 'Vkernel'),
(835, 'VMRay'),
(836, 'VMware Australia'),
(837, 'Vodafone'),
(838, 'Volans'),
(839, 'Vonage Business'),
(840, 'VPOS'),
(841, 'VQ'),
(842, 'Vyopta'),
(843, 'Wacom'),
(844, 'Watchguard'),
(845, 'Wavlink'),
(846, 'Webroot'),
(847, 'Welland'),
(848, 'Western Digital'),
(849, 'WinRAR'),
(850, 'WinZip'),
(851, 'Withings'),
(852, 'WyreStorm'),
(853, 'Wyse'),
(854, 'Xtralis'),
(855, 'XYZ Printing'),
(856, 'Yamaha'),
(857, 'Yealink'),
(858, 'YourCloudTelco'),
(859, 'Yubico'),
(860, 'Yuneec'),
(861, 'Zebra'),
(862, 'Zebra Technologies'),
(863, 'Zellabox'),
(864, 'Zensorium'),
(865, 'Zepp'),
(866, 'ZeroWire'),
(867, 'Zimbra'),
(868, 'Zotac Graphics'),
(869, 'Zultys'),
(870, 'ZyXEL');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
