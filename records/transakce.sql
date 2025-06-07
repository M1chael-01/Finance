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
-- Database: `finance_transakce`
--

-- --------------------------------------------------------

--
-- Table structure for table `transakce`
--

CREATE TABLE `transakce` (
  `id` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  `aktivita` date DEFAULT NULL,
  `typ` varchar(20) NOT NULL,
  `castka` int(11) NOT NULL,
  `osoba` varchar(100) NOT NULL,
  `popis` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transakce`
--

INSERT INTO `transakce` (`id`, `datum`, `aktivita`, `typ`, `castka`, `osoba`, `popis`, `group_id`) VALUES
(2, '2025-04-14', '2025-04-13', 'Příjem', 200, 'Michael Tvrdík', 'Nějaký příjem', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transakce`
--
ALTER TABLE `transakce`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transakce`
--
ALTER TABLE `transakce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
