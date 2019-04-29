-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2019 at 09:16 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php1`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) NOT NULL,
  `smatric` varchar(500) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `response` varchar(500) NOT NULL DEFAULT 'pending',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(10) NOT NULL DEFAULT '0',
  `stname` varchar(500) NOT NULL DEFAULT 'pending',
  `sttime` varchar(500) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(10) NOT NULL,
  `matric` varchar(500) NOT NULL,
  `en` varchar(500) NOT NULL,
  `ea` varchar(500) NOT NULL,
  `eca` varchar(500) NOT NULL,
  `r` varchar(500) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `ean` varchar(500) NOT NULL,
  `aea` varchar(500) NOT NULL,
  `apn` varchar(500) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `s` int(10) NOT NULL DEFAULT '0',
  `ps` int(10) NOT NULL DEFAULT '0',
  `atime` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) NOT NULL,
  `name` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dp` varchar(100) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `username`, `phone`, `email`, `password`, `dp`) VALUES
(1, 'Administrator', 'admin', '+234', 'admin@itf.com', '1234', 'avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) NOT NULL,
  `name` varchar(500) NOT NULL,
  `matric` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL DEFAULT '',
  `phone` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '123456',
  `school` varchar(500) NOT NULL,
  `dept` varchar(500) NOT NULL,
  `level` varchar(500) NOT NULL,
  `dp` varchar(100) NOT NULL DEFAULT 'avatar.png',
  `nplace` varchar(500) NOT NULL DEFAULT 'pending',
  `ndept` varchar(500) NOT NULL DEFAULT 'pending',
  `nstart` varchar(500) NOT NULL DEFAULT 'pending',
  `nduration` varchar(500) NOT NULL DEFAULT 'pending',
  `bname` varchar(500) NOT NULL DEFAULT 'pending',
  `aname` varchar(500) NOT NULL DEFAULT 'pending',
  `atype` varchar(500) NOT NULL DEFAULT 'pending',
  `anumber` varchar(500) NOT NULL DEFAULT 'pending',
  `scode` varchar(500) NOT NULL DEFAULT 'pending',
  `ms` int(10) NOT NULL DEFAULT '0',
  `bs` int(10) NOT NULL DEFAULT '0',
  `ps` int(10) NOT NULL DEFAULT '0',
  `approve` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
