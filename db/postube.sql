-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2021 at 12:42 AM
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
  `id_comment` text NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `title`, `description`, `id_comment`, `id_user`, `date`) VALUES
(3, 'Coca-Cola', '', '', 15, '2021-01-13 13:25:41'),
(4, 'Fanta', '', '', 15, '2021-01-13 14:10:49'),
(11, 'Sprite', '', '', 15, '2021-01-13 16:40:24'),
(21, 'Latte', '<p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">Caffe&nbsp;</span><span style=\"font-weight: bold; color: rgb(95, 99, 104); font-family: arial, sans-serif; font-size: 14px;\">latte</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">&nbsp;(or simply&nbsp;</span><span style=\"font-weight: bold; color: rgb(95, 99, 104); font-family: arial, sans-serif; font-size: 14px;\">latte</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">) (/ˈlɑːteɪ/ or /ˈlæteɪ/) is a coffee drink made with espresso and steamed milk. The word comes from the Italian caffè e&nbsp;</span><span style=\"font-weight: bold; color: rgb(95, 99, 104); font-family: arial, sans-serif; font-size: 14px;\">latte</span><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">&nbsp;[kafˌfɛ e lˈlatte], caffelatte [kaffeˈlatte] or caffellatte [kaffelˈlatte], which means \"coffee &amp; milk\".</span></p><p><img onclick=\"displayImgModal(event)\" class=\"img-fluid img-description hover-pointer rounded\" src=\"/project-manager/img-uploads/1611263872.jpg\"><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\"><br></span><br></p><p></p><p>These are the steps how to make a asimple latte coffee :&nbsp;<a href=\"https://www.wikihow.com/Make-a-Latte\" target=\"_blank\">How To Make A Latte</a></p>', '25|26|', 15, '2021-01-15 04:55:46'),
(23, 'Avocado Juice', '', '5|23|', 15, '2021-01-15 14:51:06'),
(27, 'Cappucino', '<p><br></p>', '', 15, '2021-01-17 08:58:07'),
(28, 'Watermelon', 'Taste So Sweet', '24|', 15, '2021-01-18 10:07:27'),
(29, 'Apple', '', '', 15, '2021-01-18 11:09:28'),
(30, 'Denmark', '', '', 15, '2021-01-18 11:12:40'),
(31, 'Starfruit', '<p><br></p>', '', 15, '2021-01-21 03:33:44'),
(34, 'Apple', '<p><img onclick=\"displayImgModal(event)\" class=\"img-fluid img-description hover-pointer rounded\" src=\"/project-manager/img-uploads/1611332709.jpg\"></p><p style=\"margin: 0.5em 0px; color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">An&nbsp;<b>apple</b>&nbsp;is an edible&nbsp;<a href=\"https://en.wikipedia.org/wiki/Fruit\" title=\"Fruit\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">fruit</a>&nbsp;produced by an&nbsp;<b>apple tree</b>&nbsp;(<i><b>Malus domestica</b></i>). Apple&nbsp;<a href=\"https://en.wikipedia.org/wiki/Fruit_tree\" title=\"Fruit tree\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">trees</a>&nbsp;are&nbsp;<a href=\"https://en.wikipedia.org/wiki/Agriculture\" title=\"Agriculture\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">cultivated</a>&nbsp;worldwide and are the most widely grown species in the&nbsp;<a href=\"https://en.wikipedia.org/wiki/Genus\" title=\"Genus\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">genus</a>&nbsp;<i><a href=\"https://en.wikipedia.org/wiki/Malus\" title=\"Malus\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Malus</a></i>. The tree originated in&nbsp;<a href=\"https://en.wikipedia.org/wiki/Central_Asia\" title=\"Central Asia\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Central Asia</a>, where its wild ancestor,&nbsp;<i><a href=\"https://en.wikipedia.org/wiki/Malus_sieversii\" title=\"Malus sieversii\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Malus sieversii</a></i>, is still found today. Apples have been grown for thousands of years in&nbsp;<a href=\"https://en.wikipedia.org/wiki/Asia\" title=\"Asia\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Asia</a>&nbsp;and&nbsp;<a href=\"https://en.wikipedia.org/wiki/Europe\" title=\"Europe\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Europe</a>&nbsp;and were brought to North America by&nbsp;<a href=\"https://en.wikipedia.org/wiki/European_colonization_of_the_Americas\" title=\"European colonization of the Americas\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">European colonists</a>. Apples have&nbsp;<a href=\"https://en.wikipedia.org/wiki/Religion\" title=\"Religion\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">religious</a>&nbsp;and&nbsp;<a href=\"https://en.wikipedia.org/wiki/Mythology\" class=\"mw-redirect\" title=\"Mythology\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">mythological</a>&nbsp;significance in many cultures, including&nbsp;<a href=\"https://en.wikipedia.org/wiki/Norse_mythology\" title=\"Norse mythology\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Norse</a>,&nbsp;<a href=\"https://en.wikipedia.org/wiki/Greek_mythology\" title=\"Greek mythology\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Greek</a>, and&nbsp;<a href=\"https://en.wikipedia.org/wiki/Christianity_in_Europe\" title=\"Christianity in Europe\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">European Christian</a>&nbsp;tradition.</p><p style=\"margin: 0.5em 0px; color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">Apple trees are large if grown from seed. Generally, apple&nbsp;<a href=\"https://en.wikipedia.org/wiki/Cultivar\" title=\"Cultivar\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">cultivars</a>&nbsp;are propagated by&nbsp;<a href=\"https://en.wikipedia.org/wiki/Grafting\" title=\"Grafting\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">grafting</a>&nbsp;onto&nbsp;<a href=\"https://en.wikipedia.org/wiki/Rootstock\" title=\"Rootstock\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">rootstocks</a>, which control the size of the resulting tree. There are more than 7,500 known&nbsp;<a href=\"https://en.wikipedia.org/wiki/List_of_apple_cultivars\" title=\"List of apple cultivars\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">cultivars of apples</a>, resulting in a range of desired characteristics. Different cultivars are bred for various tastes and use, including&nbsp;<a href=\"https://en.wikipedia.org/wiki/Cooking_apple\" title=\"Cooking apple\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">cooking</a>, eating raw and&nbsp;<a href=\"https://en.wikipedia.org/wiki/Apple_cider\" title=\"Apple cider\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">cider</a>&nbsp;production. Trees and fruit are prone to a number of&nbsp;<a href=\"https://en.wikipedia.org/wiki/Fungus\" title=\"Fungus\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">fungal</a>, bacterial and pest problems, which can be controlled by a number of&nbsp;<a href=\"https://en.wikipedia.org/wiki/Organic_farming\" title=\"Organic farming\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">organic</a>&nbsp;and non-organic means. In 2010, the fruit\'s&nbsp;<a href=\"https://en.wikipedia.org/wiki/Genome\" title=\"Genome\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">genome</a>&nbsp;was&nbsp;<a href=\"https://en.wikipedia.org/wiki/DNA_sequencing\" title=\"DNA sequencing\" style=\"color: rgb(11, 0, 128); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">sequenced</a>&nbsp;as part of research on disease control and selective breeding in apple production.</p>', '28|', 15, '2021-01-22 16:26:42'),
(35, 'Watermelon', '<p><b>Watermelon</b></p><p></p><p><img src=\"/project-manager/img-uploads/1611365921.jpg\" class=\"img-fluid img-description hover-pointer rounded\" onclick=\"displayImgModal(event)\"><br></p><p><b>Facts about watermelon</b></p><p><img src=\"https://images.unsplash.com/photo-1589984662646-e7b2e4962f18?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mnx8d2F0ZXJtZWxvbnxlbnwwfHwwfA%3D%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60\" style=\"width: 500px;\" class=\"img-fluid img-description hover-pointer rounded\" onclick=\"displayImgModal(event)\"><br></p><p><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">Watermelon is a flowering plant species of the Cucurbitaceae family. A scrambling and trailing vine-like plant, it was originally domesticated in Africa. It is a highly cultivated fruit worldwide, with more than 1,000 varieties. Wild watermelon seeds have been found in the prehistoric Libyan site of Uan Muhuggiag</span><br></p>', '28|', 15, '2021-01-23 00:43:34'),
(37, 'Tomato', '<p><img src=\"/project-manager/img-uploads/1611366211.jpg\" class=\"img-fluid img-description hover-pointer rounded\" onclick=\"displayImgModal(event)\"></p><p><img style=\"width: 500px;\" src=\"https://images.unsplash.com/photo-1561136594-7f68413baa99?ixid=MXwxMjA3fDB8MHxzZWFyY2h8M3x8dG9tYXRvfGVufDB8fDB8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60\" class=\"img-fluid img-description hover-pointer rounded\" onclick=\"displayImgModal(event)\"><br></p>', '', 15, '2021-01-23 01:43:42');

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
(28, 'I Like Apples!!!', 15, '2021-01-22 16:27:10');

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
(99, 'Red', '34|37|', 15, '2021-01-22 14:43:05'),
(100, 'Green', '35|', 15, '2021-01-23 00:41:09');

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
(1, 'Drinks', '2|', '64|74|80|', '15|18|', 1, '2021-01-15 17:59:06'),
(2, 'Fruits', '', '99|100|', '', 0, '2021-01-15 17:59:58'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

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
