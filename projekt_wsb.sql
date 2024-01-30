-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 18, 2024 at 09:00 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt_wsb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `type` enum('badpassword','successlogin','passwordchg','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `who` enum('','admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `id_user`, `ip`, `type`, `created_at`, `who`) VALUES
(24, 1, '192.168.100.135', 'passwordchg', '2023-06-08 19:14:37', ''),
(25, 1, '::1', 'passwordchg', '2023-06-08 19:33:01', 'admin'),
(26, 1, '::1', 'passwordchg', '2023-06-08 19:33:28', 'user'),
(27, 0, '::1', 'badpassword', '2023-06-09 20:45:37', ''),
(28, 0, '::1', 'successlogin', '2023-06-09 20:45:55', ''),
(29, 0, '::1', 'badpassword', '2023-06-09 20:49:40', ''),
(30, 0, '::1', 'successlogin', '2023-06-09 20:49:44', ''),
(32, 2, '::1', 'badpassword', '2023-06-09 20:51:53', ''),
(33, 0, '::1', 'successlogin', '2023-06-09 20:55:02', ''),
(34, 2, '::1', 'successlogin', '2023-06-09 21:21:06', ''),
(35, 1, '::1', 'badpassword', '2023-06-09 21:21:17', ''),
(36, 1, '::1', 'badpassword', '2023-06-09 21:21:20', ''),
(37, 1, '::1', 'successlogin', '2023-06-09 21:21:24', ''),
(38, 2, '::1', 'successlogin', '2023-06-09 21:21:37', ''),
(39, 1, '::1', 'successlogin', '2023-06-09 21:24:56', ''),
(40, 0, '::1', 'successlogin', '2023-06-09 21:30:07', ''),
(41, 1, '::1', 'successlogin', '2023-06-09 21:37:32', ''),
(42, 2, '::1', 'successlogin', '2023-06-09 21:38:23', ''),
(43, 2, '::1', 'successlogin', '2023-06-09 21:38:40', ''),
(44, 1, '::1', 'successlogin', '2023-06-09 21:42:13', ''),
(45, 2, '::1', 'successlogin', '2023-06-09 21:43:40', ''),
(46, 1, '::1', 'successlogin', '2023-06-09 21:43:50', ''),
(47, 0, '::1', 'successlogin', '2023-06-09 21:44:48', ''),
(48, 1, '::1', 'successlogin', '2023-06-09 21:48:25', ''),
(49, 0, '::1', 'successlogin', '2023-06-09 21:51:31', ''),
(50, 0, '::1', 'successlogin', '2023-06-09 22:02:58', ''),
(51, 0, '::1', 'successlogin', '2023-06-11 17:09:20', ''),
(52, 1, '::1', 'passwordchg', '2023-06-11 18:06:30', 'admin'),
(53, 1, '::1', 'passwordchg', '2023-06-11 18:08:44', 'admin'),
(54, 1, '::1', 'successlogin', '2023-06-11 18:08:55', ''),
(55, 0, '::1', 'successlogin', '2023-06-11 18:09:10', ''),
(56, 0, '::1', 'successlogin', '2023-06-11 18:10:45', ''),
(57, 1, '::1', 'passwordchg', '2023-06-11 18:10:55', 'admin'),
(58, 1, '::1', 'successlogin', '2023-06-11 18:11:01', ''),
(59, 0, '::1', 'successlogin', '2023-06-11 18:12:48', ''),
(60, 1, '::1', 'passwordchg', '2023-06-11 18:12:57', 'admin'),
(61, 1, '::1', 'successlogin', '2023-06-11 18:13:36', ''),
(62, 1, '::1', 'passwordchg', '2023-06-11 18:13:46', 'user'),
(63, 0, '::1', 'successlogin', '2023-06-11 18:15:51', ''),
(64, 1, '::1', 'passwordchg', '2023-06-16 19:37:42', 'admin'),
(65, 0, '::1', 'successlogin', '2023-06-16 19:37:53', ''),
(66, 8, '::1', 'badpassword', '2023-06-16 19:38:43', ''),
(67, 8, '::1', 'successlogin', '2023-06-16 19:38:50', ''),
(68, 8, '::1', 'passwordchg', '2023-06-16 19:39:05', 'user'),
(69, 0, '::1', 'successlogin', '2023-06-16 19:40:43', ''),
(70, 0, '::1', 'badpassword', '2024-01-13 16:53:23', ''),
(71, 0, '::1', 'badpassword', '2024-01-13 16:53:28', ''),
(72, 0, '::1', 'badpassword', '2024-01-13 16:53:33', ''),
(73, 0, '::1', 'badpassword', '2024-01-13 16:53:42', ''),
(74, 0, '::1', 'badpassword', '2024-01-13 16:54:28', ''),
(75, 0, '::1', 'successlogin', '2024-01-13 16:54:33', ''),
(76, 2, '::1', 'badpassword', '2024-01-13 16:56:35', ''),
(77, 0, '::1', 'successlogin', '2024-01-13 16:56:46', ''),
(78, 6, '::1', 'passwordchg', '2024-01-13 17:13:25', 'admin'),
(79, 6, '::1', 'successlogin', '2024-01-13 17:13:48', ''),
(80, 0, '::1', 'badpassword', '2024-01-13 17:14:12', ''),
(81, 0, '::1', 'successlogin', '2024-01-13 17:14:17', ''),
(82, 6, '::1', 'successlogin', '2024-01-13 17:14:32', ''),
(83, 0, '::1', 'successlogin', '2024-01-13 17:23:48', ''),
(84, 2, '::1', 'badpassword', '2024-01-13 17:36:19', ''),
(85, 6, '::1', 'badpassword', '2024-01-13 17:36:29', ''),
(86, 6, '::1', 'successlogin', '2024-01-13 17:36:36', ''),
(87, 0, '::1', 'successlogin', '2024-01-17 18:28:48', ''),
(88, 2, '::1', 'badpassword', '2024-01-17 18:35:57', ''),
(89, 2, '::1', 'badpassword', '2024-01-17 18:36:01', ''),
(90, 2, '::1', 'badpassword', '2024-01-17 18:36:05', ''),
(91, 0, '::1', 'successlogin', '2024-01-17 18:36:10', ''),
(92, 2, '::1', 'passwordchg', '2024-01-17 18:36:37', 'admin'),
(93, 7, '::1', 'badpassword', '2024-01-17 18:36:51', ''),
(94, 7, '::1', 'badpassword', '2024-01-17 18:36:55', ''),
(95, 0, '::1', 'successlogin', '2024-01-17 18:37:02', ''),
(96, 7, '::1', 'passwordchg', '2024-01-17 18:37:26', 'admin'),
(97, 7, '::1', 'badpassword', '2024-01-17 18:37:39', ''),
(98, 7, '::1', 'successlogin', '2024-01-17 18:37:47', ''),
(99, 0, '::1', 'successlogin', '2024-01-17 18:38:34', ''),
(100, 7, '::1', 'badpassword', '2024-01-17 18:43:47', ''),
(101, 7, '::1', 'successlogin', '2024-01-17 18:43:51', ''),
(102, 2, '::1', 'badpassword', '2024-01-18 13:22:51', ''),
(103, 2, '::1', 'badpassword', '2024-01-18 13:23:03', ''),
(104, 2, '::1', 'badpassword', '2024-01-18 13:23:08', ''),
(105, 0, '::1', 'badpassword', '2024-01-18 13:26:32', ''),
(106, 2, '::1', 'badpassword', '2024-01-18 13:27:07', ''),
(107, 0, '::1', 'successlogin', '2024-01-18 13:31:21', ''),
(108, 1, '::1', 'successlogin', '2024-01-18 13:35:12', ''),
(109, 0, '::1', 'successlogin', '2024-01-18 13:35:52', ''),
(110, 2, '::1', 'badpassword', '2024-01-18 15:06:46', ''),
(111, 2, '::1', 'badpassword', '2024-01-18 15:06:52', ''),
(112, 1, '::1', 'successlogin', '2024-01-18 15:07:12', ''),
(113, 6, '::1', 'badpassword', '2024-01-18 15:08:51', ''),
(114, 0, '::1', 'successlogin', '2024-01-18 15:09:05', ''),
(115, 2, '::1', 'badpassword', '2024-01-18 15:09:15', ''),
(116, 2, '::1', 'badpassword', '2024-01-18 15:09:19', ''),
(117, 2, '::1', 'badpassword', '2024-01-18 15:09:22', ''),
(118, 2, '::1', 'badpassword', '2024-01-18 15:09:27', ''),
(119, 2, '::1', 'badpassword', '2024-01-18 15:09:33', ''),
(120, 0, '::1', 'badpassword', '2024-01-18 15:09:40', ''),
(121, 0, '::1', 'successlogin', '2024-01-18 15:09:44', ''),
(122, 2, '::1', 'passwordchg', '2024-01-18 15:09:56', 'admin'),
(123, 2, '::1', 'successlogin', '2024-01-18 15:10:04', ''),
(124, 0, '::1', 'successlogin', '2024-01-18 15:21:04', ''),
(125, 0, '::1', 'successlogin', '2024-01-18 15:22:50', ''),
(126, 1, '::1', 'successlogin', '2024-01-18 15:27:47', ''),
(127, 0, '::1', 'successlogin', '2024-01-18 15:27:56', ''),
(128, 1, '::1', 'badpassword', '2024-01-18 15:48:53', ''),
(129, 1, '::1', 'successlogin', '2024-01-18 15:48:57', ''),
(130, 2, '::1', 'successlogin', '2024-01-18 15:56:22', ''),
(131, 0, '::1', 'badpassword', '2024-01-18 15:57:28', ''),
(132, 0, '::1', 'successlogin', '2024-01-18 15:57:31', ''),
(133, 0, '::1', 'successlogin', '2024-01-18 19:18:20', ''),
(134, 2, '::1', 'successlogin', '2024-01-18 19:21:57', ''),
(135, 1, '::1', 'successlogin', '2024-01-18 19:24:23', ''),
(136, 0, '::1', 'badpassword', '2024-01-18 19:26:34', ''),
(137, 0, '::1', 'successlogin', '2024-01-18 19:26:37', ''),
(138, 1, '::1', 'successlogin', '2024-01-18 19:36:04', ''),
(139, 2, '::1', 'successlogin', '2024-01-18 19:39:35', ''),
(140, 0, '::1', 'successlogin', '2024-01-18 19:40:16', ''),
(141, 2, '::1', 'successlogin', '2024-01-18 19:42:36', ''),
(142, 0, '::1', 'successlogin', '2024-01-18 19:52:15', ''),
(143, 2, '::1', 'successlogin', '2024-01-18 19:55:02', ''),
(144, 0, '::1', 'successlogin', '2024-01-18 19:55:45', ''),
(145, 1, '::1', 'successlogin', '2024-01-18 19:55:55', ''),
(146, 0, '::1', 'successlogin', '2024-01-18 19:56:08', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` enum('admin','manager','user','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `birthday` date NOT NULL,
  `manager_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(250) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `name`, `surname`, `email`, `birthday`, `manager_id`, `created_at`, `password`, `role_id`) VALUES
(0, 'admin', 'admin', 'admin', 'admin@admin.com', '2023-05-23', 0, '2023-05-23 16:52:28', '$argon2id$v=19$m=16,t=2,p=1$YWNhM1BjRG9nQmwyeUJ1Wg$kFIHvr3vIhEApKsWPVOIFQ', 1),
(1, 'mmarecki', 'Marek', 'Marecki', 'marek.marecki@corp.com', '1993-03-02', 2, '2023-05-28 14:57:01', '$argon2id$v=19$m=65536,t=4,p=1$U01PTlV3MFNPRmRWWjgyYw$Mep4EcwjKIk5D+yc+XBKbd+yS/Sd3+G2S6W31yAXJv4', 3),
(2, 'jjanecki', 'Jan', 'Janecki', 'jan.janecki@corp.com', '1970-05-15', 0, '2023-05-28 15:08:31', '$argon2id$v=19$m=65536,t=4,p=1$Q0ZLL1g2L0JpYmZqTjQuZg$aQO2l1KNa1QyBCEtoriqiHISFsRd0XKlmmfnie7t3E4', 2),
(6, 'ppiotrowski', 'Piotr', 'Piotrowski', 'piotr.piotrowski@corp.com', '1996-05-15', 0, '2023-06-09 22:03:49', '$argon2id$v=19$m=65536,t=4,p=1$cGQ1enpLZFJCa2lwMkNtTw$OjBXBbAa1Exl9Sp5EkaoDzUBrhaJqLKF2SUnC9q50kQ', 2),
(7, 'jjanuszewski', 'Janusz', 'Januszewski', 'janusz.januszewski@corp.pl', '1984-02-12', 6, '2023-06-11 18:23:57', '$argon2id$v=19$m=65536,t=4,p=1$ZG1nR2U5b0dtUW84RDJ6eg$q3z3riLZLOjrBRmppGvG94dq5S0TFU0MPC6/vBEfiKQ', 3),
(8, 'aadamczak', 'Adam', 'Adamczak', 'adam.adamczak@corp.com', '1945-11-11', 0, '2023-06-16 19:38:34', '$argon2id$v=19$m=65536,t=4,p=1$RzlGQkwxYzdyS0tDTk5uWQ$9vY6MdS3dZjdxTDEcGhbZEV+dFqlq3SlLOruzwBk9ZM', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vacation`
--

CREATE TABLE `vacation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_accepted` int(11) NOT NULL DEFAULT 0,
  `message` varchar(250) NOT NULL,
  `accepted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vacation`
--

INSERT INTO `vacation` (`id`, `user_id`, `created_at`, `start_date`, `end_date`, `is_accepted`, `message`, `accepted_by`) VALUES
(2, 1, '2023-06-04 12:14:15', '2023-06-11', '2023-06-12', 1, '', 2),
(3, 2, '2023-06-04 15:23:57', '2023-06-04', '2023-06-05', 1, '', 0),
(4, 1, '2023-06-04 15:29:32', '2023-06-12', '2023-06-13', 1, 'test', 2),
(5, 1, '2023-06-08 12:15:29', '2023-06-28', '2023-06-29', 1, '', 2),
(6, 1, '2023-06-08 12:20:35', '2023-06-26', '2023-06-27', 1, '', 2),
(7, 1, '2023-06-09 21:21:31', '2023-06-28', '2023-06-30', 1, '', 2),
(8, 1, '2023-06-09 21:43:24', '2023-06-28', '2023-06-29', 1, '', 2),
(9, 1, '2023-06-09 21:43:29', '2023-06-26', '2023-06-27', 1, '', 0),
(10, 6, '2024-01-13 17:14:02', '2024-01-17', '2024-01-26', 1, '', 0),
(11, 2, '2024-01-18 19:22:39', '2024-01-22', '2024-01-26', 0, 'Plsss', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `workhours`
--

CREATE TABLE `workhours` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `is_accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workhours`
--

INSERT INTO `workhours` (`id`, `user_id`, `created_at`, `start_time`, `end_time`, `is_accepted`) VALUES
(8, 1, '2024-01-18 15:55:43', '2024-01-18 07:00:00', '2024-01-18 15:00:00', 1),
(9, 2, '2024-01-18 19:23:41', '2024-01-18 07:00:00', '2024-01-18 15:00:00', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indeksy dla tabeli `vacation`
--
ALTER TABLE `vacation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `accepted_by` (`accepted_by`);

--
-- Indeksy dla tabeli `workhours`
--
ALTER TABLE `workhours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vacation`
--
ALTER TABLE `vacation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `workhours`
--
ALTER TABLE `workhours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `vacation`
--
ALTER TABLE `vacation`
  ADD CONSTRAINT `vacation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `vacation_ibfk_2` FOREIGN KEY (`accepted_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `workhours`
--
ALTER TABLE `workhours`
  ADD CONSTRAINT `workhours_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
