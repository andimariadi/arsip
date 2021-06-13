-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2021 at 12:27 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip_desa`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `path` varchar(250) NOT NULL,
  `number` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `archive_public`
--

CREATE TABLE `archive_public` (
  `id` bigint(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `path` varchar(250) NOT NULL,
  `number` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `expired_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` text NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `description_subcategory`
--

CREATE TABLE `description_subcategory` (
  `id` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `subcategory_id` int(10) NOT NULL,
  `remark` text NOT NULL,
  `area` varchar(250) NOT NULL,
  `user` int(10) NOT NULL,
  `time_minutes` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disposition`
--

CREATE TABLE `disposition` (
  `id` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `date` date NOT NULL,
  `code` varchar(25) NOT NULL,
  `subcategory_id` int(10) NOT NULL,
  `institute_id` int(10) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `file_number` varchar(50) NOT NULL,
  `reference_number` varchar(50) NOT NULL,
  `type` varchar(250) NOT NULL,
  `date_recieved` date NOT NULL,
  `about` text NOT NULL,
  `purpose` text NOT NULL,
  `remark` text NOT NULL,
  `path` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guest_book`
--

CREATE TABLE `guest_book` (
  `id` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `nik` varchar(50) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `utility` int(10) NOT NULL,
  `date` date NOT NULL,
  `institute_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `id` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_inbox`
--

CREATE TABLE `mail_inbox` (
  `id` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(25) NOT NULL,
  `number` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `category_id` int(10) NOT NULL,
  `about` text NOT NULL,
  `type` varchar(250) NOT NULL,
  `institute_id` int(10) NOT NULL,
  `document` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_outbox`
--

CREATE TABLE `mail_outbox` (
  `id` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(25) NOT NULL,
  `number` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `category_id` int(10) NOT NULL,
  `about` text NOT NULL,
  `type` varchar(250) NOT NULL,
  `institute_id` int(10) NOT NULL,
  `document` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` bigint(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `category_id` int(25) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` text NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_inbox`
--

CREATE TABLE `type_inbox` (
  `id` bigint(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` text NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `level` varchar(20) NOT NULL,
  `data_create` varchar(10) NOT NULL,
  `data_read` varchar(10) NOT NULL,
  `data_update` varchar(10) NOT NULL,
  `data_delete` varchar(10) NOT NULL,
  `data_export` varchar(10) NOT NULL,
  `restrict` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `deleted_at`, `username`, `password`, `full_name`, `level`, `data_create`, `data_read`, `data_update`, `data_delete`, `data_export`, `restrict`) VALUES
(1, '2021-06-10 09:00:35', '2021-06-10 09:57:25', NULL, 'admin', '$2y$10$H3ao.GXNqHYQL79nZ0p9LuGUb9euaQ6AYlCZyxgeVG7fDYzZN/R1K', 'ADMINISTRATOR', 'administrator', 'true', 'true', 'true', 'true', 'true', ''),
(2, '2021-06-10 09:00:35', '2021-06-13 12:19:01', NULL, 'user', '$2y$10$csXV8PQ2p/FaYcqtLWCcTuzh26ADzBDX5cJLtpj9gFqJiRH5VNSt2', 'USER DEMO', 'user', 'false', 'true', 'true', 'false', 'false', 'description_category,archive,guest_book,disposition,users');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `id` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `nik` int(25) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive_public`
--
ALTER TABLE `archive_public`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `description_subcategory`
--
ALTER TABLE `description_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disposition`
--
ALTER TABLE `disposition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_book`
--
ALTER TABLE `guest_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_inbox`
--
ALTER TABLE `mail_inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_outbox`
--
ALTER TABLE `mail_outbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_inbox`
--
ALTER TABLE `type_inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archive_public`
--
ALTER TABLE `archive_public`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `description_subcategory`
--
ALTER TABLE `description_subcategory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disposition`
--
ALTER TABLE `disposition`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest_book`
--
ALTER TABLE `guest_book`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_inbox`
--
ALTER TABLE `mail_inbox`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_outbox`
--
ALTER TABLE `mail_outbox`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_inbox`
--
ALTER TABLE `type_inbox`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
