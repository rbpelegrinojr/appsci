-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2026 at 10:48 PM
-- Server version: 10.6.22-MariaDB
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capsupon_appsci`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(10) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `account_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `username`, `password`, `account_status`) VALUES
(1, 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `answers_tbl`
--

CREATE TABLE `answers_tbl` (
  `answer_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_text` text NOT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `answers_tbl`
--

INSERT INTO `answers_tbl` (`answer_id`, `member_id`, `question_id`, `answer_text`, `is_correct`, `submitted_at`) VALUES
(4, 8, 2, 'd. vegetable salad with dressing', 0, '2025-12-10 02:54:45'),
(5, 8, 2, 'c. 3 in 1 coffee dissolved in hot water', 0, '2025-12-10 05:40:36'),
(6, 9, 2, 'd. vegetable salad with dressing', 0, '2025-12-11 05:59:16'),
(7, 10, 5, 'c. The components of mixtures form a two-layer liquid', 0, '2026-01-11 04:07:34'),
(8, 10, 6, 'b.	Composition of mixtures are visible', 0, '2026-01-11 04:07:34'),
(9, 10, 7, 'c. 3 in 1 coffee dissolved in hot water', 0, '2026-01-11 04:07:34'),
(10, 10, 8, 'd. It is a homogeneous mixture because it is not uniform', 0, '2026-01-11 04:07:34'),
(11, 10, 9, 'c. the mixture appears one or uniform', 0, '2026-01-11 04:07:34'),
(12, 58, 81, 'a. colloid', 0, '2026-05-08 05:38:36'),
(13, 58, 82, 'b.	water', 1, '2026-05-08 05:38:37'),
(14, 58, 83, 'b.	Suspensions are particles that settle out when left undisturbed.', 0, '2026-05-08 05:38:37'),
(15, 58, 84, 'c.	sand and water', 0, '2026-05-08 05:38:37'),
(16, 58, 85, 'b.	It appears cloudy.', 0, '2026-05-08 05:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tbl`
--

CREATE TABLE `feedback_tbl` (
  `feedback_id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `feedback_text` text NOT NULL,
  `submitted_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members_tbl`
--

CREATE TABLE `members_tbl` (
  `member_id` int(10) NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `grade` text NOT NULL,
  `section` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members_tbl`
--

INSERT INTO `members_tbl` (`member_id`, `fname`, `mname`, `lname`, `grade`, `section`, `username`, `password`) VALUES
(1, 'Jesa ', 'Morano', 'De la Cruz ', '6', 'Hope', 'jesadelacruz62@gmail.com', 'jesadeacruz'),
(2, 'Jesa ', 'Morano', 'De la Cruz ', '6', 'Hope', 'jesadelacruz62@gmail.com', 'Jesa1234.'),
(4, 'Geraldine ', 'Delos Reyes', 'Parcon', '6', 'Hope', 'geraldineparcon1', 'parcon'),
(5, 'Paken', 'James', 'Hason', '4', 'Star', 'Paken', 'hason'),
(6, 'Carla', 'Andrade ', 'Aldea', '6', 'B', 'Laylay', '123456'),
(8, 'norielyn', 'delosreyes', 'magoleno', 'VI', 'hope', 'norielyn', 'norielyn123'),
(9, 'rhazel', 'a', 'azucena', 'VI', 'hope', 'rhazel', 'rhazel123'),
(10, 'norielyn', '', 'm', 'VI', 'hope', 'norielyn', 'norielyn'),
(11, 'John Clide', 'C.', 'Barang', 'VI', 'Charity', 'johncarl', '1234'),
(12, 'John Hino', 'D.', 'Batan', 'VI', 'Charity', 'johnhino', 'hino123'),
(13, 'Redjan', 'D.', 'Billosan', 'VI', 'Charity', 'redjan', 'jan123'),
(14, 'Rey', '', 'Encronal', 'VI', 'Charity', 'rey', 'rey12'),
(15, 'Reyldon', 'B.', 'Encronal', 'VI', 'Charity', 'reyldon', 'don1234'),
(16, 'Eran', 'A.', 'Krismar', 'VI', 'Charity', 'krismar', 'krismar123'),
(17, 'Noriel', 'B.', 'Eran', 'VI', 'Charity', 'noriel256', '123456'),
(18, 'Yohan Jade', 'E.', 'Gepoleo', 'VI', 'Charity', 'yohanjade', 'yohan12'),
(19, 'Troy ', 'D.', 'Liboon', 'VI', 'Charity', 'troy11', 'troy11'),
(20, 'Chris Robert', 'D.', 'Magwate', 'VI', 'Charity', 'robert', 'chris123'),
(21, 'Efraine', 'D.', 'Mon Diego', 'VI', 'Charity', 'efraine', 'efraine123'),
(22, 'Jacob', '', 'Pasamba', 'VI', 'Charity', 'jacob', 'jacob965'),
(23, 'Larry', '', 'Patigas', 'VI', 'Charity', 'larry', 'larry123'),
(24, 'john francis', '', 'sioco', 'VI', 'Charity', 'sioco', 'sioco8910'),
(25, 'christian', '', 'villanueva', 'VI', 'Charity', 'villanueva', 'villanueva123'),
(26, 'anjanet', '', 'baÃ±ares', 'VI', 'Charity', 'baÃ±ares', 'baÃ±ares45'),
(27, 'sy ann', '', 'baÃ±ares', 'VI', 'Charity', 'sy ann', 'sy ann1'),
(28, 'cherry ann', '', 'bayot', 'VI', 'Charity', 'bayot', 'bayot3'),
(29, 'Joyce', '', 'Incronal', 'VI', 'Charity', 'Incronal', 'Joyce89'),
(30, 'Geraldine', '', 'Managaytay', 'VI', 'Charity', 'Managaytay', 'Managaytay1'),
(31, 'Athena', '', 'Padilla', 'VI', 'Charity', 'Padilla', 'Athena1'),
(32, 'Jennelyn', '', 'Patigas', 'VI', 'Charity', 'Patigas', 'Patigas1'),
(33, 'Kc', 'B.', 'Sanchez', 'VI', 'Charity', 'Sanchez', 'Kc'),
(34, 'James Andrew', 'D.', 'Besonia', 'VI', 'Hope', 'besonia', 'besonia12'),
(35, 'King Loyd', 'C.', 'Compania', 'VI', 'Hope', 'compania', 'compania'),
(36, 'Zairel', 'A.', 'Catalan', 'VI', 'Hope', 'catalan', 'catalan123'),
(37, 'John Cris', '', 'Dinaya', 'VI', 'Hope', 'dinaya', 'dinaya123'),
(38, 'Marjun', '', 'Erenea', 'VI', 'Hope', 'erenea', 'erenea123'),
(39, 'Dincel', '', 'Estayan', 'VI', 'Hope', 'estayan', 'estayan123'),
(40, 'Japheth Art', '', 'Oroceo', 'VI', 'Hope', 'oroceo', 'oreceo45'),
(41, 'Jaymar', '', 'Palomar', 'VI', 'Hope', 'palomar', 'palomar96'),
(42, 'Kian', '', 'Pancho', 'VI', 'Hope', 'pancho', 'pancho1'),
(43, 'Prince Daniel', '', 'Sanchez', 'VI', 'Hope', 'prince', 'prince123'),
(44, 'Mark', '', 'Tuma-ob', 'VI', 'Hope', 'mark', 'mark89'),
(45, 'Hannah Frencel', 'B.', 'Bucayan', 'VI', 'Hope', 'bucayan', 'bucayan44'),
(46, 'Joylyn', 'B.', 'Deanon', 'VI', 'Hope', 'deanon', 'deanon11'),
(47, 'Clearalen', 'M.', 'De Tomas', 'VI', 'Hope', 'detomas', 'detomas55'),
(48, 'Brianna', '', 'Delos Reyes', 'VI', 'Hope', 'delosreyes', 'delosreyes00'),
(49, 'Jovie Joy', '', 'Espinosa', 'VI', 'Hope', 'espinosajovie', 'espinosa77'),
(50, 'Mirathea', '', 'Galvez', 'VI', 'Hope', 'galvezmirathea', 'galvez445'),
(51, 'Marry Jean', '', 'Hemoya', 'VI', 'Hope', 'hemoyamarry', 'jean12'),
(52, 'Ellyza', '', 'Licoan', 'VI', 'Hope', 'licoanellyza', 'ellyza65'),
(53, 'Lara  Grace', 'E.', 'Martineto', 'VI', 'Hope', 'martinetolara', 'grace567'),
(54, 'Jellian', '', 'Morales', 'VI', 'Hope', 'moralesjellian', 'jellian345'),
(55, 'Michelle Marie', '', 'Mosqueda', 'VI', 'Hope', 'mosquedamarie', 'marie125'),
(56, 'Jolly', '', 'Pongaan', 'VI', 'Hope', 'pongaanjolly', 'jolly009'),
(57, 'Michaella Leonell Angellee', '', 'Santiago', 'VI', 'Hope', 'santiagomichaella', 'leonellangellee'),
(58, 'Roden', 'Roden', 'Roden', 'VI', 'A', 'roden', 'roden');

-- --------------------------------------------------------

--
-- Table structure for table `modules_tbl`
--

CREATE TABLE `modules_tbl` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `quarter` enum('1st','2nd','3rd','4th') NOT NULL,
  `module_file_url` text NOT NULL,
  `school_year` text NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `modules_tbl`
--

INSERT INTO `modules_tbl` (`module_id`, `module_name`, `quarter`, `module_file_url`, `school_year`, `uploaded_at`) VALUES
(8, 'Separating-mixtures-through-evaporation', '1st', 'https://appsci.site/uploads/modules/1768104174_science6_q1_mod2les2_separating-mixtures-through-evaporation_final.docx', '2024-2025', '2026-01-11 04:02:54'),
(9, 'Describing Mixtures', '1st', 'https://appsci.site/uploads/modules/1768105039_science6_q1_mod1les1_describing-mixtures_FINAL08032020.docx', '2024-2025', '2026-01-11 04:17:19'),
(10, 'Separating-mixtures-through-filtering-and-sieving', '1st', 'https://appsci.site/uploads/modules/1768105629_science6_q1_mod2les1_separating-mixtures-through-filtering-and-sieving_final.docx', '2024-2025', '2026-01-11 04:27:09'),
(11, 'Differentiating-a-solute-from-a-solvent', '1st', 'https://appsci.site/uploads/modules/1768109681_science6_q1_mod1les2_differentiating-a-solute-from-a-solvent_FINAL08032020.docx', '2024-2025', '2026-01-11 05:34:41'),
(12, 'Separating_mixtures_through_decantation', '1st', 'https://appsci.site/uploads/modules/1768110954_science6_q1_mod2les3_separating_mixtures_through_decantation_FINAL.docx', '20204-2025', '2026-01-11 05:55:54'),
(13, 'Solutions-and-their-characteristic', '1st', 'https://appsci.site/uploads/modules/1768111658_science6_q1_mod1les4_solutions-and-their-characteristics_FINAL08032020.docx', '2024-2025', '2026-01-11 06:07:38'),
(14, 'Colloids and Their Characteristics', '1st', 'https://appsci.site/uploads/modules/1768116783_science6_q1_mod1les5_colloids and their characteristics_FINAL08032020.docx', '2024-2025', '2026-01-11 07:33:03'),
(15, 'Separating_mixtures_using_magnets', '1st', 'https://appsci.site/uploads/modules/1768117713_science6_q1_mod2les4_separating_mixtures_using_magnets_FINAL08032020-2.docx', '2023-2025', '2026-01-11 07:48:33'),
(16, 'Factors-affecting-solubility', '1st', 'https://appsci.site/uploads/modules/1768118814_science6_q1_mod1les3_factors-affecting-solubility_FINAL08032020.docx', '2024-2025', '2026-01-11 08:06:54'),
(17, 'Suspensions and Their Characteristics', '1st', 'https://appsci.site/uploads/modules/1768119632_science6_q1_mod1les6_suspensions and their characteristics_FINAL08032020.docx', '2024-2025', '2026-01-11 08:20:32'),
(18, 'The Human Body System', '2nd', 'https://appsci.site/uploads/modules/1768141029_Science6_Q2_Mod1_TheHumanBodySystems_V4.pdf', '2024-2025', '2026-01-11 14:17:09'),
(19, 'The Human Body Systems Module2', '2nd', 'https://appsci.site/uploads/modules/1768142272_Science6_Q2_Mod2_TheHumanBodySystems.pdf', '2024-2025', '2026-01-11 14:37:52'),
(21, 'Explain How the Different Organ  System Works Together', '2nd', 'https://appsci.site/uploads/modules/1768143044_Science6_Q2_Mod3_ExplainHowTheDifferentOrganSystemWorksTogether_V4.pdf', '2024-2025', '2026-01-11 14:50:44'),
(22, 'Animals: Characteristics of  Vertebrates', '2nd', 'https://appsci.site/uploads/modules/1768149815_Science6_Q2_Mod4_AnimalsCharacteristicsofVertabrates_V4.pdf', '2024-2025', '2026-01-11 16:43:35'),
(23, 'Animals: Characteristics of  Invertebrates', '2nd', 'https://appsci.site/uploads/modules/1768150380_Science6_Q2_Mod5_AnimalsCharacteristicsofInvertabrates_V4.pdf', '2024-2025', '2026-01-11 16:53:00'),
(24, 'Ecosystem: Tropical Rainforests, Coral Reefs and Mangrove Swamps', '2nd', 'https://appsci.site/uploads/modules/1768151041_Science6_Q2_Mod6_EcosystemTropicalRainforestsCoralsReefsandMangroveSwamps_V4.pdf', '2024-2025', '2026-01-11 17:04:01'),
(25, 'Protection and Conservation of Ecosystem', '2nd', 'https://appsci.site/uploads/modules/1768154144_Science6_Q2_Mod7_ProtectionandConservationofEcosystem_V4.pdf', '2024-2025', '2026-01-11 17:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `questions_tbl`
--

CREATE TABLE `questions_tbl` (
  `question_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `question_type` enum('multiple_choice','identification') NOT NULL,
  `options` text DEFAULT NULL,
  `correct_answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `questions_tbl`
--

INSERT INTO `questions_tbl` (`question_id`, `module_id`, `question_text`, `question_type`, `options`, `correct_answer`) VALUES
(10, 8, 'What method is used to obtain salt from sea water?', 'multiple_choice', 'a. decantation, b. sedimentation, c. evaporation, d. filtering', 'c'),
(11, 8, 'Which of the following examples undergo evaporation process?', 'multiple_choice', 'a. a pail of water under the heat of the sun, b. brushing your teeth after meal, c. ironing clothes every weekend, d. listening to the radio', 'a. a pail of water under the heat of the sun'),
(12, 8, 'It is the main factor that causes evaporation process in separating  \r\n    mixtures.\r\n', 'multiple_choice', 'a. water,	b. heat,	c. smoke, d. light', 'b. heat'),
(13, 8, 'Princess accidentally spill a glass of water in the salt container and she is  \r\n    thinking with of a solution on how sheâ€™s going to recover salt from water.  \r\n    What will Princess do to return the salt to its original phase?\r\n', 'multiple_choice', 'a. She will wrap it with newspaper tightly, b. She will throw it away in the waste can,	c. She will hide it in a dark corner, d. She will boil the solution', 'd. She will boil the solution'),
(14, 8, 'While boiling water in a kettle, Gwayne noticed that there are smoke  \r\n    coming from the spout of a kettle. He asked his mother, â€œWhy did the   \r\n    smoke rise upwardâ€? What do you think will be the motherâ€™s answer?\r\n', 'multiple_choice', 'a. because the water reached its cooling point,  b. because the water reached its boiling point,  c. because the water is heated and became water vapor,  d. because the water is freezing', 'c. because the water is heated and became water vapor'),
(15, 8, 'Which of these examples show evaporation process as technique of  \r\n     separating mixtures?\r\n', 'multiple_choice', 'a. drying of water on the table, 	b. flooding of water in the river, c. cooling of water in the refrigerator, d. freezing of water in the ocean', 'a. drying of water on the table'),
(16, 9, 'Which of the following mixtures is heterogeneous?', 'multiple_choice', 'a. salt and sugar dissolved in water, b. powdered detergent in a pail of water, c. 3 in 1 coffee dissolved in hot water, d. vegetable salad with dressing', 'd. vegetable salad with dressing'),
(17, 9, 'Your mother prepared pinakbet for lunch. How will you describe its  \r\n    ingredients?\r\n', 'multiple_choice', 'a. It is a homogeneous mixture because it was evenly mixed, b. It is a heterogeneous mixture because its components are   visible, 	c. It is a heterogeneous mixture because of its uniformity, 	d. It is a homogeneous mixture because it is not uniform', 'b. It is a heterogeneous mixture because its components are   visible'),
(18, 9, 'A vinegar mixed with soy sauce is a homogeneous mixture   \r\n    because:\r\n', 'multiple_choice', 'a. you can easily identify its components, b. you can only see the dark color of soy sauce, c. the mixture appears one or uniform, d. the mixtures did not mix well', 'c. the mixture appears one or uniform'),
(19, 9, 'Which is true about heterogeneous mixtures?', 'multiple_choice', 'a. Composition of mixtures are the same all throughout, b.	Composition of mixtures are visible,  c. Composition of mixtures can be easily identified, d.	Both B and C', 'd. Both B and C'),
(20, 10, 'What method is used to separate solid impurities from water using    \r\n    filter in the faucets?\r\n', 'multiple_choice', 'a. sieving, b. magnetism, c. filtering, d. distillation', 'c. filtering'),
(21, 10, 'Which material will you use if youâ€™re going to make coffee out of    \r\n   grind coffee for your visitors?\r\n', 'multiple_choice', 'a. filter paper, b. colander, c. mesh wire,	d. strainer', 'a. filter paper'),
(22, 10, 'This kind of technique in separating mixtures is used in separating \r\n    fine sand from rocks in the mixtures of sand and gravel.\r\n', 'multiple_choice', 'a. picking, b. sieving,	c. filtering, d. evaporation', 'b. sieving'),
(23, 10, 'Divine wants to separate mixtures of cornstarch from small stones \r\nthat she will be using in making maja blanca. What kind of material  \r\n    will she use to separate it?\r\n', 'multiple_choice', 'a. filter cloth,   b. towel	, c. filter paper, d. strainer with small holes', 'd. strainer with small holes'),
(24, 10, 'What separating technique will you use if you want to separate     \r\n    mongo seeds which mixed up with salt?\r\n', 'multiple_choice', ' a. filtering,   b. picking, c. sieving, d. magnetism', ' a. filtering'),
(25, 10, 'Flour from small pebbles ', 'identification', '', 'Sieving'),
(26, 10, 'Mongo from baby powder ', 'identification', '', 'Sieving'),
(27, 10, 'Milk from grated coconut ', 'identification', '', 'Filtering'),
(28, 11, 'Which of the following materials can be dissolved?', 'multiple_choice', 'a. Stone, b. leaf, c. salt, d. cloth', 'c. salt'),
(29, 11, 'If you are going to mix hot water and coffee powder what will happen?', 'multiple_choice', 'a. The coffee powder will not dissolve in water, b. The coffee powder will dissolve in water thoroughly, c.	The coffee powder will dissolve in water partially, d. None of the above', ' b. The coffee powder will dissolve in water thoroughly'),
(30, 11, 'This is formed when one substance is dissolved in another substance.', 'multiple_choice', 'a. solute, b. solution, c.	sols, d. aerosol', 'b. solution'),
(31, 11, 'Which of the following materials is a solvent?', 'multiple_choice', 'a. flour, b. water, c. sugar, d. both a and b', 'b. water'),
(32, 11, 'It dissolves more substances than any other?', 'multiple_choice', 'a. sugar, b. salt, c.	water, d.	pebble', ' c. water'),
(33, 11, 'Which happens if you mix juice powder with water?', 'multiple_choice', 'a. The juice powder will dissolve in water, b. The juice powder will form a layer, c. The juice powder will not dissolve in water, d.	The juice powder will settle at the bottom of the water', 'a. The juice powder will dissolve in wate'),
(34, 11, 'What substance dissolves most substance?', 'multiple_choice', 'a. water, b. oil, c. paint, d. sugar', 'a. water'),
(35, 11, 'What will happen if we add leaves to water? ', 'multiple_choice', 'a. The leaves will dissolve in water, b. The leaves will not dissolve in water, c.	The leaves will partially dissolve in water, d.	Both A and B', 'b. The leaves will not dissolve in water'),
(36, 11, 'Which of the following substances is an example of a solute?', 'multiple_choice', 'a. pepper, b.	water, c.	vinegar,	d. soy sauce', 'd. soy sauce'),
(37, 11, 'Which of the following substances does not dissolve in water?', 'multiple_choice', 'a. sugar, b. pepper, c. oil, d.	milk powder', 'a. sugar'),
(38, 11, 'What do you call the substance that can be dissolved in the given solvent?', 'multiple_choice', 'a. soluble, b.	insoluble, c. sol, d.	emulsion', 'c. sol'),
(39, 11, 'If you mix hot water and milk powder, what will happen?', 'multiple_choice', 'a. The milk powder will dissolve in water, b. The milk powder will form a layer, c. The milk powder will not dissolve in hot water, d. None of the above', 'c. The milk powder will not dissolve in hot water'),
(40, 11, 'In a solution, what do you call the substance in a larger amount?', 'multiple_choice', 'a. solute, b. solvent, c.	sols, d. none of the above', 'b. solvent'),
(41, 12, 'Which of the following mixtures can be separated using decantation method?', 'multiple_choice', 'a. sugar and milk,	b. water in oil, c. mixed nuts, d. vegetable salad with dressing', 'b. water in oil'),
(42, 12, 'Your mother asked you to cook dried fish for lunch and you accidentally mixed the oil with water. What method will you use to separate the mixture?\r\n', 'multiple_choice', 'a. decantation method, b. magnetism, c. evaporation, d. filtering', 'a. decantation method'),
(43, 12, 'Which one of the following techniques would best be used to  separate soil and water?\r\n', 'multiple_choice', 'a. filtration, b. distillation, c. decanting, d. chromatography 	', ' b. distillation'),
(44, 12, 'This method is a technique used in separating a less-dense substance from a denser one.\r\n', 'multiple_choice', 'a. evaporation, b. decantation, c. picking, d. all of the above', 'b. decantation'),
(45, 12, 'What will happen to the less-dense substance of mixtures if you   separate them using decantation method?', 'multiple_choice', 'a. it will evaporate, b. it will float up,	c. remains the same, d. it will become solid', 'b. it will float up'),
(46, 13, 'What is the universal solvent?', 'multiple_choice', 'a. water,	b. vinegar, c. acetone, d. soy sauce', 'a. water'),
(47, 13, 'What is a solution?', 'multiple_choice', 'a. It is a homogeneous mixture in which particles are evenly distributed., b. It is a heterogeneous mixture in which particles are evenly distributed, c. It has a larger particle that is visible to the naked eyes.,  d. It has a particle that settle out when left undisturbed ', 'a. It is a homogeneous mixture in which particles are evenly distributed'),
(48, 13, 'What is being dissolved in a solution?', 'multiple_choice', 'a. solute, b. solvent, c. precipitate, c. water', 'a. solute'),
(49, 13, 'The ___________ is the one doing the dissolving.', 'multiple_choice', 'a. solute, b. solvent,  c. precipitate, c. water', 'b. solvent'),
(50, 13, 'The amount of solute that can be dissolved by the solvent is defined as __________.', 'multiple_choice', '   a. solubility, b. saturated,  c. unsaturated, d. supersaturated', ' a. solubility'),
(51, 13, 'What type of mixture is a solution?', 'multiple_choice', 'a. Heterogeneous,  b. Homogeneous, c. Immiscible, d. Miscible', ' b. Homogeneous'),
(52, 13, 'Which of the following is not a characteristic of a solution?', 'multiple_choice', 'a. It is a uniform mixture,  b. It will scatter a beam of light, c. It is stable over time, d. The solute and solvent cannot be distinguished by the naked eye', '  b. It will scatter a beam of light'),
(53, 14, 'Which of the following is an example of a colloid?', 'multiple_choice', 'a. mayonnaise, b. cooking oil, c. soft drinks, d. bubbles in water ', 'a. mayonnaise'),
(54, 14, 'What phenomenon occur when dispersed colloid particles scatter light?', 'multiple_choice', 'a. Tyndall effect, b. shaft effect, c. miscible, d. immiscible', 'a. Tyndall effect'),
(55, 14, 'What example of colloid has dispersed solid particles in gas?', 'multiple_choice', 'a. milk, b. smoke, c. gelatin, d. blood', 'b. smoke'),
(56, 14, 'What is the most abundant particle in a colloid?', 'multiple_choice', 'a. dispersing mediums, b. dispersing phases, c. miscible, d. immiscible', 'a. dispersing mediums'),
(57, 14, 'Why is milk categorized as emulsion?', 'multiple_choice', 'a. because settling cannot separate the components of homogenized milk., b. because settling can separate the components of homogenized milk, c. The colloid\'s particles of milk are larger., d. The colloid\'s particles are smaller.', 'a. because settling cannot separate the components of homogenized milk'),
(58, 14, 'Soda pop, whipped cream, and beaten egg whites are examples of what	 type of colloids?', 'multiple_choice', 'a. foam,	b. Emulsion, c. Sol, d. Aerosol', 'a. foam'),
(59, 14, 'How would you differentiate a colloid mixture from a solution?\r\na. The colloid\'s particles are larger.	\r\n', 'multiple_choice', 'a. The colloid\'s particles are larger.,	 b. The colloid\'s particles are smaller., c. A colloid has a positive charge., d. A colloid has a negative charge.', 'a. The colloid\'s particles are larger.'),
(60, 14, 'A colloid is a stable combination of particles of one substance that are dissolved or suspended in a second substance.', 'multiple_choice', 'a. True, c. Maybe, b. False, d. None of these', 'a. True'),
(61, 15, 'Metal and non-metal objects can be separated by using a __________.', 'multiple_choice', 'a. filter, b. magnet, c. sieve, d. water', ' b. magnet'),
(62, 15, 'How will you separate mixture of metal and nonmetal objects?', 'multiple_choice', 'a. by decantation,	 b. by winnowing, c. by using a magnet, d. by evaporation', 'c. by using a magnet'),
(63, 15, 'Needle in sawdust can be separated by means of ______________.', 'multiple_choice', 'a. decantation, b.	magnetic separation, c. filtration, d. sifting', 'b. magnetic separation'),
(64, 15, 'How will you separate mixture of staple wire and chalk powder?', 'multiple_choice', 'a. by decantation,	 b. by winnowing, c. by using a magnet, d. by evaporation', 'c. by using a magnet'),
(65, 15, 'Mrs. Cruzâ€™s needle was mixed with bits of paper. How will she separate the needle safely from the bits of paper?', 'multiple_choice', 'a. by decantation,	 b. by winnowing, c. by using a magnet, d. by evaporation', 'c. by using a magnet'),
(66, 15, 'How will you separate paper clips and thumbtacks from flour?', 'multiple_choice', 'a. by using magnet, b.	by using a sieve, c. by using a filter paper, d. by using filter paper', 'a. by using magnet'),
(67, 15, 'Which of the following best describes a magnet when used to separate mixtures?', 'multiple_choice', 'a. It can separate metals from nonmetals, b. It can separate nonmetals objects, c.	It can separate larger particles, d. It can separate smaller particles', 'a. It can separate metals from nonmetals'),
(68, 15, '__________ when mixed with non-metals, could be separated by magnet.', 'multiple_choice', 'a. rubber, b.	plastic, c. water, d. metals', 'd. metals'),
(69, 15, 'Metals which are made up of ______________ are easily attracted to the magnet.', 'multiple_choice', 'a. alloy, nickel or cobalt, b. paint, water or powder, c. salt, rubber or plastic, d.	gold, ruby, diamond', 'a. alloy, nickel or cobal'),
(70, 15, 'There is no ______________________ involved in the separation of components in magnetism.', 'multiple_choice', 'a. physical reaction, b.	mechanical reaction, c. chemical reaction, d.	acid reaction', ' c. chemical reaction'),
(71, 16, 'Which of the following describes solubility?\r\n', 'multiple_choice', 'a. The ability of liquid to change color, b.	The ability of something to dissolve in a liquid, c. The time it takes for something to settle at the bottom of a liquid, d. The speed of pouring a liquid out of a container', 'b.	The ability of something to dissolve in a liquid'),
(72, 16, 'A greater amount of sugar will dissolve in warm water than in cold water. What factor affects the sugarâ€™s solubility?', 'multiple_choice', 'a. Temperature of solvent, b. Amount of solute, c. Nature of solute, d. Manner of stirring', 'a. Temperature of solvent'),
(73, 16, 'Which of the following does not affect the solubility of solid solutes?', 'multiple_choice', 'a. Volume of solvent, b. Stirring, c. Temperature, d. Amount of solvent', 'd. Amount of solvent'),
(74, 16, 'A gram of salt can be dissolved in 100 ml of water. What factors affect the solubility?', 'multiple_choice', 'a. Amount of solute, b.	Amount of solvent, c. Size of solute, d. Manner of stirring', 'b. Amount of solvent'),
(75, 16, 'Choose the correct statement.', 'multiple_choice', 'a. A 100 ml water can dissolve a 1 tablespoon of sugar, b.	Any quantity of sugar can be dissolved in a given volume of water, c. A given volume of solvent dissolves any quantity of solute, d. None of these', 'a. A 100 ml water can dissolve a 1 tablespoon of sugar'),
(76, 16, 'It tells about whether the solvent is in liquid, solid or in gas form.', 'identification', '', 'Nature of Solvent'),
(77, 16, 'It depends on how fast or slow mixture was stirred.', 'identification', '', 'Manner of Stiming'),
(78, 16, 'It tells whether the solute is soft or hard, powder or a whole piece', 'identification', '', 'Nature of Solute'),
(79, 16, 'It tells how hot or cold is the solvent mixed in a mixture.', 'identification', '', 'Tempreature'),
(80, 16, 'It tells how much solvent is mixed in a mixture.', 'identification', '', 'Amount of Solvent'),
(81, 17, 'What kind of mixture is formed when larger particles settle out when left undisturbed?', 'multiple_choice', 'a. colloid, b. suspension, c.	solution, d.solvent', 'b. suspension'),
(82, 17, 'What kind of mixture is formed when oil is mixed with water?', 'multiple_choice', 'a.	solution, b.	water, c.	colloids, d.	suspension', ' b.	water'),
(83, 17, 'Which of the following statements do not describe a suspension?', 'multiple_choice', 'a. Suspensions are larger particles is visible to the naked eyes., b.	Suspensions are particles that settle out when left undisturbed., c.	Mixture of soil and water is an example of suspension., d.	Suspensions are homogeneous mixture and invisible to the naked eye.  â€ƒ', 'a. Suspensions are larger particles is visible to the naked eyes.'),
(84, 17, 'Which of the following mixtures is not an example of a suspension? ', 'multiple_choice', 'a. salt and water, b. oil and water, c.	sand and water, d.	chalk and water', 'a. salt and water'),
(85, 17, 'How does suspension appear?', 'multiple_choice', 'a.	It appears clear., b.	It appears cloudy., c.	It appears messy., d.	none of the above', 'd.	none of the above'),
(86, 18, 'The following are the functions of the skeletal system, except', 'multiple_choice', 'a.It gives shape to the body, b. It serves as the framework of the body, c. It protects the internal organ of the body, d. It circulates oxygen and removes carbon dioxide.', 'd. It circulates oxygen and removes carbon dioxide.'),
(87, 18, 'Why is bone marrow important to the body?', 'multiple_choice', 'a. It stores much fat, b. It makes the bone strong, c. It produces red blood cell, d. It produces new bone cell.', 'c. It produces red blood cell'),
(88, 18, 'It manufactures the blood cells in the body.\r\n', 'multiple_choice', 'a. bone marrow, b. blood, c. blood cell, d. hinge joints', 'a. bone marrow'),
(89, 18, 'Which body system that protects the organs of the body such as the heart, lungs, and brain?\r\n', 'multiple_choice', 'a. skeletal system, b. circulatory system, c. muscular system, d. digestive system', 'a. skeletal system'),
(90, 18, 'The skin is the largest organ in your body. Which of the following describe the function of the skin?\r\nI. Protects the body from physical and chemical injuries\r\nII. Makes the skin darker\r\nIII. Acts as sensory response\r\nIV. Helps in the formation of Vitamin D\r\nV. Regulates body temperature\r\nCarries the body wastes', 'multiple_choice', 'a. I, III, V, VI, VI, b. I, II, III, IV, V, c.  II, III, IV, VI, VI, d.  I, II, III, V, VI', 'a. I, III, V, VI, VI'),
(91, 18, 'What is the integumentary system made of Teeth\r\nII. Skin\r\nIII. Bones\r\nIV. Nails\r\nV. Hair\r\nVI. Eyes\r\nVII. Sweat Glands', 'multiple_choice', 'a. II, III, IV, V, b. II, IV, V, VII, c. III, IV, V, VI, d. I, IV, V, VII', 'b. II, IV, V, VII'),
(92, 18, 'What is the skinâ€™s natural oil?\r\n', 'multiple_choice', 'a. Sweat, b. Sebum, c. Melanin, d. Vegetable oil', 'c. Melanin'),
(93, 18, 'What system is composed of the mouth, esophagus, stomach, \r\nsmall intestine, and large intestine?\r\n', 'multiple_choice', 'a. Digestive System, b. Respiratory System, c. Circulatory System, d. Excretory System', 'a. Digestive System'),
(94, 18, 'Where does digestion begin?\r\n', 'multiple_choice', 'a. nose, b. esophagus, c. mouth, d. rectum', 'c. mouth'),
(95, 18, 'Where does final digestion take place?\r\n', 'multiple_choice', 'a. small intestine, b. large intestine, c. esophagus, d. mouth', 'a. small intestine'),
(96, 19, 'Which part of the respiratory system where air, water, and food pass \r\nthrough?\r\n', 'multiple_choice', 'a. larynx, b. trachea, c. pharynx, d. epiglottis', 'c. pharynx'),
(97, 19, 'What is the main organ of the respiratory system?\r\n', 'multiple_choice', 'a. alveoli, b. bronchi, c. diaphragm, d. lungs', 'd. lungs'),
(98, 19, 'These are small pouches or sacs in the lungs where exchange of carbon \r\ndioxide and oxygen takes place.\r\n', 'multiple_choice', 'a. bronchial tube, b. nostrils, c. alveoli, d. nasal cavity', 'c. alveoli'),
(99, 19, 'Which part of the circulatory system carries blood throughout the \r\nbody?\r\n', 'multiple_choice', 'a. blood vessels, b. heart, c. blood, d. veins', 'a. blood vessels'),
(100, 19, 'It is the pumping organ of the circulatory system. \r\n', 'multiple_choice', 'a. heart, b. blood, c. blood vessels, d. veins', 'a. heart'),
(101, 19, ' It is referred to as the river of life.\r\n', 'multiple_choice', 'a. blood vessels, b. heart, c. blood, d. capillaries ', 'c. blood'),
(102, 19, 'It is considered as the functional unit of the nervous system.\r\n', 'multiple_choice', 'a. brain, b. neurons, c. muscles, d. bones', 'b. neurons'),
(103, 19, 'It controls and coordinates the activities of the whole nervous system.\r\n', 'multiple_choice', 'a. central nervous system, b. sympathetic nervous system, c. nervous system, d. brain', 'a. central nervous system'),
(104, 19, 'It is a system that controls other parts of the body.\r\n', 'multiple_choice', 'a. nervous system, b. circulatory system, c. digestive system, d. respiratory system', 'a. nervous system'),
(105, 19, 'It is the primary organ of the central nervous system contained within \r\nthe skull.\r\n', 'multiple_choice', 'a. brain, b. axon, c. dendrites, d. cell body', 'a. brain'),
(106, 21, 'Which of the following is the function of integumentary system? \r\n', 'multiple_choice', 'a. It serves as a body covering, b. It serves as the pathway of the blood, c.  It serves as a sense of touch, d. both a and c ', 'd. both a and c '),
(107, 21, 'How does musculo-skeletal system work together? \r\n', 'multiple_choice', 'a. Muscles are attached to the bones and produce movement by contracting and relaxing, b. Muscles are attached to the skin and produce movement by  the help of the epidermis,  c.  Muscles are attached to the ribs and spinal column; thus,  they produce movement,  d. Muscles are attached to the cartilage, thus producing  movement.', 'a. Muscles are attached to the bones and produce movement by contracting and relaxing'),
(108, 21, 'The following are the works of circulatory system except __________. \r\n', 'multiple_choice', 'a. carrying nutrients to the cells, b. carrying oxygen to the different parts of the body, c. carrying message to the brain, d. carrying waste product of the cells', 'c. carrying message to the brain'),
(109, 21, 'How does circulatory system work together with respiratory system? \r\n', 'multiple_choice', 'a. Circulatory system breaks down food to be absorbed by the  respiratory system as it provides oxygen to the cells, b. Circulatory system carries nutrients to the respiratory system as it provides oxygen to the circulatory system, c. Circulatory system carries message to the respiratory system as it provides oxygen to the circulatory system, d. Circulatory system carries oxygen to the cells of respiratory system as it provides nutrients to the circulatory system. ', 'b. Circulatory system carries nutrients to the respiratory system as it provides oxygen to the circulatory system'),
(110, 21, 'How does digestive system work together with respiratory and \r\ncirculatory systems? \r\n', 'multiple_choice', 'a. Digestive system digests food to be carried out by the circulatory system to the respiratory system as it provides oxygen to the digestive system, b. Digestive system digests food to be carried out by the respiratory system to the circulatory system as it provides oxygen to the digestive system, c. Digestive system carries nutrients to the circulatory system, while circulatory system digests food for the digestive system as it provides oxygen, d. Digestive system provides food and oxygen to the circulatory and  respiratory system.', 'a. Digestive system digests food to be carried out by the circulatory system to the respiratory system as it provides oxygen to the digestive system'),
(111, 22, 'To what group of animals does the illustration belong?  \r\n', 'multiple_choice', 'A. vertebrates, B. arthropods, C. invertebrates, D. insects', 'C. invertebrates'),
(112, 22, 'Which is the distinguishing characteristic of invertebrates? \r\n', 'multiple_choice', 'A. They have backbones, B. They have spinal cord, C. They have no backbones, D. They have brain.', 'C. They have no backbones'),
(113, 22, '7. Goats, cats, dogs, and rabbits are mammals have characteristics that differ from other vertebrates. Which of the following features does not describe a mammal? \r\n', 'multiple_choice', 'A. Mammals have mammary glands, B. Mammals have scales and feathers, C. Mammals have fur or hair, D. Mammals are warm-blooded animals. ', 'B. Mammals have scales and feathers'),
(114, 22, 'In what way do amphibians differ from reptiles? \r\n', 'multiple_choice', 'A. Amphibians have backbones, B. Amphibians can live both on land and in water, C. Amphibians can crawl, D. Amphibians are oviparous.', 'B. Amphibians can live both on land and in water'),
(115, 22, 'Ostriches are classified as birds but cannot fly. Why? \r\n', 'multiple_choice', 'A. They have thick feathers, B. They have heavy weight, C. They are afraid of heights, D. They prefer to be in land.', 'B. They have heavy weight'),
(116, 23, 'Which of these groups of animals is invertebrate? \r\n', 'multiple_choice', 'A. nematodes, annelids, and Platyhelminthes, B. crustaceans, amphibians, and mollusks, C. mollusks, insects, and mammals, D. reptiles, fishes, and birds', 'A. nematodes, annelids, and Platyhelminthes'),
(117, 23, 'Which group of invertebrates is divided into segments with a ringed appearance? \r\n', 'multiple_choice', 'A. Sponges, B. Echinoderms, C. Cnidarians, D. Annelids', 'D. Annelids'),
(118, 23, 'To what subgroup of arthropods do invertebrates with four pairs of legs belong? \r\n', 'multiple_choice', 'A. echinoderms, B. crustaceans, C. arachnids, D. nematodes ', 'C. arachnids'),
(119, 23, 'Which group of animals is invertebrate? \r\n', 'multiple_choice', 'A. butterfly, mosquito, fly, grasshopper, B. bird, dog, chicken, cat, ant, C. fish, spider, snake, butterfly, D. all of the above', 'A. butterfly, mosquito, fly, grasshopper'),
(120, 23, 'Animals like clams, jellyfish, butterfly and grasshopper are examples of _________. \r\n', 'multiple_choice', 'A. invertebrates, C. mammals, B. vertebrates, D. amphibians ', 'A. invertebrates'),
(121, 23, 'Mollusks, sponges, echinoderms, and nematodes are classified as__________. \r\n', 'multiple_choice', 'A. invertebrates, B. vertebrates, C. mammals, D. amphibians ', 'A. invertebrates'),
(122, 23, 'Which group of animals is invertebrate? \r\n', 'multiple_choice', 'A. frog, mosquito, cat, grasshopper, B. bird, dog, chicken, cat, ant, C. fish, spider, snake, dog, D. earthworm, snail, bee, bug', 'D. earthworm, snail, bee, bug'),
(123, 23, 'What do we call the animals which do not have bone structure or backbone? \r\n', 'multiple_choice', 'A. vertebrates, B. invertebrates, C. poriferans, D. cnidarians', 'B. invertebrates'),
(124, 23, 'Snail, butterfly, bee, and clam are examples of invertebrates. This means that these animals possess this distinguishing characteristic. \r\n', 'multiple_choice', 'A. presence of backbone, B. absence of backbone, C. lack of cranium, D. presence of cranium', 'B. absence of backbone'),
(125, 23, 'What are the distinguishing characteristics of invertebrates that differ from vertebrates aside from the absence of backbone? \r\n', 'multiple_choice', 'A. Invertebrates are mostly stronger and bigger than vertebrates, B. Invertebrates are mostly smaller and weaker than vertebrates, C. Invertebrates are complex compared to those vertebrates, D. Invertebrates do not have segmented bodies.', 'B. Invertebrates are mostly smaller and weaker than vertebrates'),
(126, 24, 'Which group of organisms can be found in the mangrove ecosystem? \r\n', 'multiple_choice', 'A. mussels, fish, corals, B. worm, rat, fish, C. butterfly, snake, bird, D. mangrove trees, fiddler crab, fish', 'D. mangrove trees, fiddler crab, fish'),
(127, 24, 'What are the things needed by plants to make their own food? \r\n', 'multiple_choice', 'A. water, chemicals and oxygen, B. oxygen and carbon dioxide, C. oxygen and chemicals, D. carbon dioxide, soil and sunlight', 'D. carbon dioxide, soil and sunlight'),
(128, 24, 'Which of the following describes a canopy of the rainforest? \r\n', 'multiple_choice', 'A. composed of trees that are 130 to 180 feet tall, B. about 59 feet and consists of trunk of canopy, shrubs, small plants and trees, C. consists mostly of fungi, insects, worms and litter from taller trees, D. has slender trees from a dense platform of vegetation with 60 to 129  feet. ', 'D. has slender trees from a dense platform of vegetation with 60 to 129  feet. '),
(129, 24, 'What kind of interaction is shown when one organism kills another organism for food? \r\n', 'multiple_choice', 'A. mutualism, B. commensalism, C. parasitism, D. predation', 'D. predation'),
(130, 24, 'It is an environment where both living and non-living things exist and interact with one another. \r\n', 'multiple_choice', 'A. ecology, B. ecosystem, C. community, D. population', 'B. ecosystem'),
(131, 24, 'One example of competition in tropical rainforest is when the shrubs and trees are growing together in one area. What do they compete for? \r\n', 'multiple_choice', 'A. sunlight and soil nutrients, B. oxygen and carbon dioxide, C. chemicals and oxygen, D. water and chemicals. ', 'A. sunlight and soil nutrients'),
(132, 24, '___________________results from the interconnected food chains. \r\n', 'multiple_choice', 'A. consumer, B. producer, C. food web, D. biotic component ', 'C. food web'),
(133, 24, 'Why is the relationship between the corals and the algae in the coral reefs \r\nconsidered mutualistic? \r\n', 'multiple_choice', 'A. The corals benefit in the interaction and not the algae, B. The corals receive oxygen from algae, the algae get protection from  corals, C. The corals receive oxygen from algae while the algae are harmed, D. The corals and algae live together without harming each other. ', 'B. The corals receive oxygen from algae, the algae get protection from  corals'),
(134, 24, 'What kind of interaction is shown when animals like crabs and mollusks help break down plant litter in a mangrove ecosystem through grazing? \r\n', 'multiple_choice', 'A. competition, B. commensalism, C. parasitism, D. mutualism', 'D. mutualism'),
(135, 24, 'Why is producer important in an ecosystem? \r\n', 'multiple_choice', 'A. It is the source of food to the consumers, B. It is an organism that eats plants, C. It breaks down organism into smaller particles, D. It is a series of feeding relationship. ', 'A. It is the source of food to the consumers');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `answers_tbl`
--
ALTER TABLE `answers_tbl`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `members_tbl`
--
ALTER TABLE `members_tbl`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `modules_tbl`
--
ALTER TABLE `modules_tbl`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `questions_tbl`
--
ALTER TABLE `questions_tbl`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `module_id` (`module_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers_tbl`
--
ALTER TABLE `answers_tbl`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  MODIFY `feedback_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members_tbl`
--
ALTER TABLE `members_tbl`
  MODIFY `member_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `modules_tbl`
--
ALTER TABLE `modules_tbl`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `questions_tbl`
--
ALTER TABLE `questions_tbl`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions_tbl`
--
ALTER TABLE `questions_tbl`
  ADD CONSTRAINT `questions_tbl_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules_tbl` (`module_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
