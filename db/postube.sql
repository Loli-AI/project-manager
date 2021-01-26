-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2021 at 04:34 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `postube`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text DEFAULT NULL,
  `is_done` int(11) NOT NULL DEFAULT 0,
  `id_comment` text NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `title`, `description`, `is_done`, `id_comment`, `id_user`, `date`) VALUES
(3, 'Coca-Cola', '', 0, '', 15, '2021-01-13 13:25:41'),
(4, 'Fanta', '', 0, '', 15, '2021-01-13 14:10:49'),
(11, 'Sprite', '', 0, '', 15, '2021-01-13 16:40:24'),
(21, 'Latte', '<p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">Caffe&nbsp;</span><span style=\"font-weight: bold; color: rgb(95, 99, 104); font-family: arial, sans-serif; font-size: 14px;\">latte</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">&nbsp;(or simply&nbsp;</span><span style=\"font-weight: bold; color: rgb(95, 99, 104); font-family: arial, sans-serif; font-size: 14px;\">latte</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">) (/ˈlɑːteɪ/ or /ˈlæteɪ/) is a coffee drink made with espresso and steamed milk. The word comes from the Italian caffè e&nbsp;</span><span style=\"font-weight: bold; color: rgb(95, 99, 104); font-family: arial, sans-serif; font-size: 14px;\">latte</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">&nbsp;[kafˌfɛ e lˈlatte], caffelatte [kaffeˈlatte] or caffellatte [kaffelˈlatte], which means \"coffee &amp; milk\".</span></p><p><img onclick=\"displayImgModal(event)\" class=\"img-fluid img-description hover-pointer rounded\" src=\"/project-manager/img-uploads/1611263872.jpg\"><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\"><br></span><br></p><p></p><p>These are the steps how to make a asimple latte coffee :&nbsp;<a href=\"https://www.wikihow.com/Make-a-Latte\" target=\"_blank\">How To Make A Latte</a></p>', 0, '25|26|', 15, '2021-01-15 04:55:46'),
(23, 'Avocado Juice', '', 0, '5|23|', 15, '2021-01-15 14:51:06'),
(27, 'Cappucino', '<p><br></p>', 1, '', 15, '2021-01-17 08:58:07'),
(28, 'Watermelon', 'Taste So Sweet', 0, '24|', 15, '2021-01-18 10:07:27'),
(29, 'Apple', '', 0, '', 15, '2021-01-18 11:09:28'),
(30, 'Denmark', '', 0, '', 15, '2021-01-18 11:12:40'),
(31, 'Starfruit', '<p><br></p>', 0, '', 15, '2021-01-21 03:33:44'),
(35, 'Watermelon', '<p><b>Watermelon</b></p><p></p><p><img src=\"/project-manager/img-uploads/1611365921.jpg\" class=\"img-fluid img-description hover-pointer rounded\" onclick=\"displayImgModal(event)\"><br></p><p><b>Facts about watermelon</b></p><p><img src=\"https://images.unsplash.com/photo-1589984662646-e7b2e4962f18?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8d2F0ZXJtZWxvbnxlbnwwfHwwfA%3D%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60\" style=\"width: 500px;\" class=\"img-fluid img-description hover-pointer rounded\" onclick=\"displayImgModal(event)\"><br></p><p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">Watermelon is a flowering plant species of the Cucurbitaceae family. A scrambling and trailing vine-like plant, it was originally domesticated in Africa. It is a highly cultivated fruit worldwide, with more than 1,000 varieties. Wild watermelon seeds have been found in the prehistoric Libyan site of Uan Muhuggiag</span><br></p>', 0, '28|', 15, '2021-01-23 00:43:34'),
(37, 'Tomato', '<p><img src=\"/project-manager/img-uploads/1611366211.jpg\" class=\"img-fluid img-description hover-pointer rounded\" onclick=\"displayImgModal(event)\"></p><p><img style=\"width: 500px;\" src=\"https://images.unsplash.com/photo-1561136594-7f68413baa99?ixid=MXwxMjA3fDB8MHxzZWFyY2h8M3x8dG9tYXRvfGVufDB8fDB8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60\" class=\"img-fluid img-description hover-pointer rounded\" onclick=\"displayImgModal(event)\"><br></p>', 0, '', 15, '2021-01-23 01:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `message`, `id_user`, `date`) VALUES
(5, 'Very Delicious', 15, '2021-01-15 13:10:22'),
(23, 'I Prefer Pizza', 18, '2021-01-16 13:15:03'),
(24, 'One Of Healthy Fruit', 15, '2021-01-18 10:09:18'),
(25, 'Best Coffee', 15, '2021-01-18 11:14:04'),
(26, 'Indeed', 18, '2021-01-18 11:15:27'),
(28, 'I Like Apples!!!', 15, '2021-01-22 16:27:10'),
(30, 'asd', 15, '2021-01-25 09:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `id_card` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `title`, `id_card`, `id_user`, `date`) VALUES
(64, 'Coffee', '27|21|', 15, '2021-01-13 05:39:24'),
(74, 'Juice', '23|', 15, '2021-01-13 16:42:30'),
(80, 'Soda', '11|4|3|', 15, '2021-01-14 13:23:00'),
(99, 'Red', '29|31|37|', 15, '2021-01-22 14:43:05'),
(100, 'Green', '35|', 15, '2021-01-23 00:41:09'),
(104, 'asd', '', 15, '2021-01-25 09:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1610107314),
('m130524_201442_init', 1610107317),
('m190124_110200_add_verification_token_column_to_user_table', 1610107317);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `relation` text DEFAULT NULL,
  `id_list` text DEFAULT NULL,
  `id_user` text DEFAULT NULL,
  `is_master` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `relation`, `id_list`, `id_user`, `is_master`, `date`) VALUES
(1, 'Drinks', '2|', '64|74|80|', '15|', 1, '2021-01-15 17:59:06'),
(2, 'Fruits', '', '99|100|104|', '', 0, '2021-01-15 17:59:58'),
(3, 'Countries', '', NULL, '', 0, '2021-01-16 15:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `role` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `role`, `created_at`, `updated_at`, `verification_token`) VALUES
(15, 'Pasta', 'nDXsrfBm1tg8ywIlhWXVwmoY2CmCzCfQ', '$2y$13$o3DIO.66FdQZOd4rzM.k5OASxkVhOosAm3Yzh4Xuc.qLn8c5cDhBi', NULL, 10, 0, 1610811948, 1610811948, 'rUyjBLlP5JqM1M7lnggdd9S-2iqC0MUE_1610811948'),
(18, 'Pizza', 'hK1d2Ju0Gw1MK22mP2n6zyvWQHoSxscg', '$2y$13$swdrAqau.r2axAybXxc7UOkkyBS7rQycZwStumVQlI.wT7Mq5ot4C', NULL, 10, 1, 1610774960, 1610774960, '8mOTXKDtkG77pdyoCh_5GC3v2F1u9vP4_1610774959');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`) USING HASH;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
