-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 21, 2021 at 02:37 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moduleconnexion`
--

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `prenom`, `nom`, `password`) VALUES
(4, 'JeanJean', 'Jean', 'Jean', 'aze'),
(5, 'JeanRubenTheone', 'Jean', 'Ruben', '$2y$10$aAIVI82/Q808hNhUCS8Fb.CKhluodqLN6BUbPJUJ18eM8EjC.JlIa'),
(6, 'JeanPascalOne', 'Jean', 'Pascal', '$2y$10$IPkElqQuObGZ0r4bxqtJ1./MbtndJvZdV/iKq6qdLQTdx7upcE4nS'),
(7, 'JeanRoxan', 'Jean', 'Roxan', '$2y$10$i8bkE6Lw/Y3HdZbR60wHnONJ.xZH8KOIlpSXd7Q89VXbjPZwbYQIu'),
(8, 'JeanRemy', 'Jean', 'Remy', '$2y$10$ztE5GDrksxG8xQFvnDovVud7/sqOmmSBsWorjSDOQrRL06guucatq'),
(9, 'ADMIN', 'ADMIN', 'ADMIN', '$2y$10$E20WH8qnzd5I.TKx61sWB.5yi..Y7TtJh2xcbIl48JMiq46UeEfI.'),
(10, 'JeanTerry', 'Jean', 'Terry', '$2y$10$ssbz8uXH1UxrRWUU59CH4esNUtJ5iZuCT.8uQZxBWUczwLXio8umO'),
(11, 'JeanNico', 'Jean', 'Nico', '$2y$10$GWVxKdL73rcdsIoBgF.gzu.EvSsX9B2N/yxGcLcsJkMU/M3kgqyCm'),
(19, 'JeanAureli', 'Jean', 'Aureli', '$2y$10$4f1DJS5PwBZMo8gmI9bpR.rEimHJzSsh7qyU9rF7KvkENrPm./oEm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
