-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015 年 6 月 15 日 03:49
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sc_map`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `map_info`
--

CREATE TABLE IF NOT EXISTS `map_info` (
`id` int(11) NOT NULL,
  `lat` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lon` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `input_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `map_info`
--

INSERT INTO `map_info` (`id`, `lat`, `lon`, `img`, `input_date`) VALUES
(1, ' 35.667379', ' 139.706906', 'upload/01.jpg', '2015-06-01 01:00:10'),
(2, ' 35.665474', ' 139.7035', 'upload/02.jpg', '2015-06-01 02:01:20'),
(3, ' 35.656158', ' 139.701759', 'upload/03.jpg', '2015-06-01 09:02:30'),
(4, ' 35.675635', ' 139.737103', 'upload/04.jpg', '2015-06-01 10:04:40'),
(5, ' 35.662036', ' 139.698965', 'upload/05.jpg', '2015-06-01 11:05:50'),
(6, ' 35.650715', ' 139.705828', 'upload/06.jpg', '2015-06-01 13:06:00'),
(7, ' 35.673827', ' 139.737725', 'upload/07.jpg', '2015-06-01 15:07:10'),
(8, ' 35.660356', ' 139.724546', 'upload/08.jpg', '2015-06-01 20:08:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `map_info`
--
ALTER TABLE `map_info`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `map_info`
--
ALTER TABLE `map_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
