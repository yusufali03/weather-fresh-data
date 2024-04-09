-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 06:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weatherdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `weather_db`
--

CREATE TABLE `weather_db` (
  `city` text NOT NULL,
  `temp` varchar(30) NOT NULL,
  `weather_type` text NOT NULL,
  `weather_when` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weather_db`
--

INSERT INTO `weather_db` (`city`, `temp`, `weather_type`, `weather_when`) VALUES
('Delhi', '27.05', 'Haze', '2024-03-26 05:27:15'),
('Tashkent', '21.97', 'Clear', '2024-03-26 05:27:28'),
('Moscow', '0.89', 'Clouds', '2024-03-26 05:27:48'),
('Andijan', '23.61', 'Clouds', '2024-03-26 05:45:36'),
('', '', '', '2024-03-26 10:03:11'),
('Tashkent', '24.97', 'Clear', '2024-03-26 10:03:25'),
('Moscow', '5.11', 'Clouds', '2024-03-26 10:04:00'),
('Tashkent', '23.97', 'Clear', '2024-03-26 10:41:24'),
('London', '12.48', 'Clouds', '2024-03-26 10:41:55'),
('Angren', '22.14', 'Clouds', '2024-03-26 10:46:02'),
('Slough', '12.45', 'Clear', '2024-03-26 11:03:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
