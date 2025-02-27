-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2025 at 06:29 PM
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
-- Database: `wrss`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_access`
--

CREATE TABLE `admin_access` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_access`
--

INSERT INTO `admin_access` (`id`, `user`, `password`) VALUES
(6, 'adminwrss', '$2y$10$fevRHwK3615FZGdfQ5mChuZtxKlGKz45fPIANcGEmz2HW0AmFCJDS');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_registered`
--

CREATE TABLE `buyer_registered` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer_registered`
--

INSERT INTO `buyer_registered` (`id`, `email`, `password`, `user`) VALUES
(16, 'joniel.gesta@gmail.com', '$2y$10$NL.Ar.UMJtFHxxY8sB6d3uZUGHfF2N1pVfoQviP5E8JpxgcuziBqa', 'jonielgesta'),
(17, 'james.gesta@gmail.com', '$2y$10$Jfs8hTmhEr3cRzGsUXVdlOCQ7smpDVpScbl2AMWeB3izdMUOjCEze', 'jamesgesta'),
(18, 'pogi@gmail.com', '$2y$10$mae1YJ9FuWPPso6CKFCjsOwJ4gLPNfNdlNEhY0M9/VarhOIrFseR2', 'pogi123'),
(19, 'aravila.amigable@gmail.com', '$2y$10$FF5mwAhbJzZnQXURGNE15u0RoFzRWRNjJR4hAArNW8W2OUufsk4G.', 'aravila');

-- --------------------------------------------------------

--
-- Table structure for table `pending_sellers`
--

CREATE TABLE `pending_sellers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_registered`
--

CREATE TABLE `seller_registered` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller_registered`
--

INSERT INTO `seller_registered` (`id`, `full_name`, `email`, `user`, `password`, `valid_id`, `document`, `date_registered`) VALUES
(4, 'Gesta, Joniel A', 'joniel.gesta@gmail.com', 'jonielgesta', '$2y$10$aOxou9vy5C128APE/jPQh.sjCBZfHI4MznWwLN2zN81nojFxWkJbm', 'uploads/WIN_20230705_22_32_48_Pro.jpg', 'uploads/WIN_20230706_23_16_12_Pro.jpg', '2025-02-04 17:10:46'),
(5, 'Gesta, James A', 'james.gesta@gmail.com', 'jamesgesta', '$2y$10$KRWsHrtJKwF3paXnH.iG8Or/WhMTYu56KXHlP.msTPgOvcCr3GYei', 'uploads/WIN_20231216_14_36_45_Pro.jpg', 'uploads/WIN_20231216_14_46_39_Pro.jpg', '2025-02-04 17:17:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_access`
--
ALTER TABLE `admin_access`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Indexes for table `buyer_registered`
--
ALTER TABLE `buyer_registered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pending_sellers`
--
ALTER TABLE `pending_sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`user`);

--
-- Indexes for table `seller_registered`
--
ALTER TABLE `seller_registered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_access`
--
ALTER TABLE `admin_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buyer_registered`
--
ALTER TABLE `buyer_registered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pending_sellers`
--
ALTER TABLE `pending_sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seller_registered`
--
ALTER TABLE `seller_registered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
