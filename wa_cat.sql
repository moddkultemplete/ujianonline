-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 02:45 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wa_cat`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `nu_id` int(11) NOT NULL,
  `vc_name` varchar(128) NOT NULL,
  `vc_email` varchar(128) NOT NULL,
  `img_image` varchar(128) NOT NULL,
  `vc_password` varchar(256) NOT NULL,
  `nu_role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `dt_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`nu_id`, `vc_name`, `vc_email`, `img_image`, `vc_password`, `nu_role_id`, `is_active`, `dt_created`) VALUES
(5, 'admin1', 'admin1@gmail.com', 'default.jpg', '$2y$10$f9Iz7nf8spKGkv/m5F37wOHCNKONIHZj5UscTHBm9e6S3Xtp8LLwe', 2, 1, 1562918482),
(6, 'admin', 'admin@gmail.com', 'default.jpg', '$2y$10$/WLoWfMc3F.ECIJD0yqtOe4SwVwwQ0BETlHgx7Z3qsHQBSSP6Xuxy', 1, 1, 1562918682),
(7, 'asdasd', 'admin12@gmail.com', 'default.jpg', '1234', 2, 1, 1562918996),
(8, 'admin', 'fulladmin@gmail.com', 'default.jpg', '$2y$10$V1tBcC8/YzeVooC4Y5ReKOEK1lv7tPRPmhOlgfCG4q/kdjXnjxMem', 2, 1, 1562922351),
(9, 'user', 'user@gmail.com', 'default.jpg', '$2y$10$HIqJKEW9w8zwU1kwagUvxu8xCQVtzF6mbWkXdeXSzo2W7JCojlwAe', 2, 1, 1562983793);

-- --------------------------------------------------------

--
-- Table structure for table `mst_user_menu`
--

CREATE TABLE `mst_user_menu` (
  `nu_id` int(11) NOT NULL,
  `vc_menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user_menu`
--

INSERT INTO `mst_user_menu` (`nu_id`, `vc_menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Test'),
(5, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user_role`
--

CREATE TABLE `mst_user_role` (
  `nu_id` int(11) NOT NULL,
  `vc_role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mst_user_sub_menu`
--

CREATE TABLE `mst_user_sub_menu` (
  `nu_id` int(11) NOT NULL,
  `nu_id_user_menu` int(11) NOT NULL,
  `vc_title` varchar(128) NOT NULL,
  `vc_url` varchar(128) NOT NULL,
  `vc_icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user_sub_menu`
--

INSERT INTO `mst_user_sub_menu` (`nu_id`, `nu_id_user_menu`, `vc_title`, `vc_url`, `vc_icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My profile', 'user', 'fas fa-fw fa-user-alt', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'SubMenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(6, 1, 'coba', 'coba/coba', 'fab fa-fw fa-youtube', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tr_access_menu`
--

CREATE TABLE `tr_access_menu` (
  `nu_id` int(11) NOT NULL,
  `nu_role_id` int(11) NOT NULL,
  `nu_id_user_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_access_menu`
--

INSERT INTO `tr_access_menu` (`nu_id`, `nu_role_id`, `nu_id_user_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`nu_id`);

--
-- Indexes for table `mst_user_menu`
--
ALTER TABLE `mst_user_menu`
  ADD PRIMARY KEY (`nu_id`);

--
-- Indexes for table `mst_user_role`
--
ALTER TABLE `mst_user_role`
  ADD PRIMARY KEY (`nu_id`);

--
-- Indexes for table `mst_user_sub_menu`
--
ALTER TABLE `mst_user_sub_menu`
  ADD PRIMARY KEY (`nu_id`);

--
-- Indexes for table `tr_access_menu`
--
ALTER TABLE `tr_access_menu`
  ADD PRIMARY KEY (`nu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `nu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mst_user_menu`
--
ALTER TABLE `mst_user_menu`
  MODIFY `nu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_user_role`
--
ALTER TABLE `mst_user_role`
  MODIFY `nu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_user_sub_menu`
--
ALTER TABLE `mst_user_sub_menu`
  MODIFY `nu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tr_access_menu`
--
ALTER TABLE `tr_access_menu`
  MODIFY `nu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
