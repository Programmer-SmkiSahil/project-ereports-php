-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 02:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-reports`
--

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(255) NOT NULL,
  `users_id` int(255) DEFAULT NULL,
  `guest_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `status` enum('sent','process','responded','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `users_id`, `guest_name`, `title`, `image`, `description`, `status`) VALUES
(8, NULL, 'Imad', 'Kebakaran', '68f1c58046d18-560748231_122150942882837657_6270544232929573847_n.jpg', 'asdsadasdasd', 'responded'),
(9, NULL, 'gapin', 'Kebakaran', '68f4eb8040fc9-560748231_122150942882837657_6270544232929573847_n.jpg', 'qweqweqqqqqqqqqq', 'responded'),
(10, NULL, 'Joniiii', 'Kebakaran', '68f6e0ad8497b-558337442_122170997966435357_398265613397134457_n.jpg', 'aaaaaaaaaaaaaaaaaa', 'responded'),
(11, 4, 'admin', 'Suripto', '68f6ebefb441d-565137376_799941965998265_2895708605890526914_n.jpg', 'aaaaaaaaaaaaaaaaaaaaaa', 'responded'),
(12, 4, 'admin', 'Ada Maling', '68f6ec18446bd-IMG_20251016_083845_288.jpg', 'aaaaaaaaaaaaaaaaaassssssssssssssssssssssssssssssss', 'responded'),
(13, 4, 'admin', 'Ada Udang', '68f875aa024f7-IMG_20251016_083845_288.jpg', 'l&lt;span class=&quot;badge &lt;?= $badge_class; ?&gt;&quot;&gt;&lt;?= $report[&#039;status&#039;]; ?&gt;&lt;/span&gt;&lt;span class=&quot;badge &lt;?= $badge_class; ?&gt;&quot;&gt;&lt;?= $report[&#039;status&#039;]; ?&gt;&lt;/span&gt;&lt;span class=&quot;badge &lt;?= $badge_class; ?&gt;&quot;&gt;&lt;?= $report[&#039;status&#039;]; ?&gt;&lt;/span&gt;&lt;span class=&quot;badge &lt;?= $badge_class; ?&gt;&quot;&gt;&lt;?= $report[&#039;status&#039;]; ?&gt;&lt;/span&gt;', 'responded'),
(14, 4, 'admin', 'Kebakaran', '68f89695165d3-560748231_122150942882837657_6270544232929573847_n.jpg', 'dasdasdsad', 'responded'),
(15, 4, 'admin', 'Suripto', '68f8975152f1a-IMG_20251016_083845_288.jpg', 'aaaaaaaaaaaaaaaaaaaaaaaaaa', 'sent'),
(16, 6, 'joni', 'Kebakaran', '68f8f5fc507e5-560748231_122150942882837657_6270544232929573847_n.jpg', 'Haehahehheahehhae', 'responded'),
(17, 6, 'joni', 'Ada Maling', '68facb243ae9b-IMG_20251016_083845_288.jpg', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'responded'),
(18, 6, 'joni', 'Tetangga Berisik', '68febe1d292b8-565137376_799941965998265_2895708605890526914_n.jpg', 'Tetangga di Blok D berisik bgt, saya sampe gabisa bobok', 'process'),
(19, NULL, 'Ujang', 'Lorem Ipsum', '68febe538d4e5-image (7).png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris luctus diam ligula, eget tristique lacus accumsan quis. Nullam lacinia pulvinar blandit. Maecenas id ipsum eleifend, rhoncus mi vel, posuere dolor. Mauris tincidunt, odio ut molestie pharetra, dolor arcu elementum nunc, sed fermentum metus sem vestibulum diam. Cras eget sapien vitae nibh pellentesque consectetur quis quis libero. Aliquam erat volutpat. In et sem viverra, vulputate dolor blandit, fermentum eros.', 'responded'),
(20, NULL, 'Hadum', 'Lorem Ipsum', '68febe9c0dd6b-558884105_819613630625408_7391993339075485977_n.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris luctus diam ligula, eget tristique lacus accumsan quis. Nullam lacinia pulvinar blandit. Maecenas id ipsum eleifend, rhoncus mi vel, posuere dolor. Mauris tincidunt, odio ut molestie pharetra, dolor arcu elementum nunc, sed fermentum metus sem vestibulum diam. Cras eget sapien vitae nibh pellentesque consectetur quis quis libero. Aliquam erat volutpat. In et sem viverra, vulputate dolor blandit, fermentum eros.', 'sent');

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `id` int(255) NOT NULL,
  `reports_id` int(255) NOT NULL,
  `response` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`id`, `reports_id`, `response`) VALUES
(1, 8, 'Yauda Sih'),
(2, 8, 'Gacor\r\n'),
(3, 13, 'Makanlah'),
(4, 9, 'Hehe'),
(5, 10, 'He'),
(6, 11, 'He\r\n'),
(7, 8, 'yauda siram air'),
(8, 12, 'hu'),
(9, 16, 'Apasih Ges'),
(10, 17, 'Yauda'),
(11, 17, 'WKWK'),
(12, 19, 'Lrem Juga'),
(13, 14, 'hhhh');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('users','admin','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(4, 'admin', 'imd@mail.com', '$2y$10$4ASQvOdDEIGfRWt9tGykVulfx2SYTtLwwq5EFe6vOjaAwaebe8wzK', 'admin'),
(6, 'joni', 'gap@gmail.com', '$2y$10$EjJpj1K5en/wVYGfkEe/ReYXdNXK3tUKIErdPnmx3VxAYVw8tu9/q', 'users');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_id` (`reports_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`reports_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
