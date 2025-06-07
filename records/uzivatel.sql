-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 06:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance_uzivatele`
--

-- --------------------------------------------------------

--
-- Table structure for table `uzivatel`
--

CREATE TABLE `uzivatel` (
  `id` int(11) NOT NULL,
  `jmeno` text NOT NULL,
  `prijmeni` text NOT NULL,
  `heslo` text NOT NULL,
  `email` text NOT NULL,
  `datum` date DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzivatel`
--

INSERT INTO `uzivatel` (`id`, `jmeno`, `prijmeni`, `heslo`, `email`, `datum`, `role`, `group_id`) VALUES
(3, '7SvtrN9oldMTVHfLDB3eSA==', 'X5pSVGIP7aH6qh/u3hNzHA==', '$2y$10$PnB0BzdKGaiZjpGKMnRQVO2C.qg3eOFV2qg..xbODobMsXWVznz7K', '5Nx1w+AdTVm+xJKTTv72Atho15IV+frmDHVXJkmXPAM=', '2003-07-16', 'admin', 3),
(4, 'Z0yerOwH/nko1LLEc4rGow==', '16WV2YsUIYh4+f89zB0o0w==', '$2y$10$zj7x0aCnt/mwsMhRE6L83eT2IDE5HqZ4iADslhQw6127/WEr/5OnK', '5S4IiQLcYfbWqssfdVJB062dAuP0Eu8vC/FaZE7xeo8=', '0000-00-00', 'user', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
