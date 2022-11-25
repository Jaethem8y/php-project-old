-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 20-10-19 06:27
-- 서버 버전: 10.1.38-MariaDB
-- PHP 버전: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `test_jc`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `num` int(11) NOT NULL,
  `id` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `subject` varchar(20) NOT NULL,
  `content` varchar(100) NOT NULL,
  `regdate` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `is_html` tinyint(4) DEFAULT NULL,
  `filename_0` varchar(20) DEFAULT NULL,
  `filename_1` varchar(20) DEFAULT NULL,
  `filename_2` varchar(20) DEFAULT NULL,
  `filename_3` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`num`, `id`, `name`, `subject`, `content`, `regdate`, `hit`, `is_html`, `filename_0`, `filename_1`, `filename_2`, `filename_3`) VALUES
(1, 'jae', 'jaehyeok', 'í”„ë¡œë¯¸ìŠ¤ ë‚˜ì¸ ', '1000ì¼!', '2020-10-19 01:07:36', 2, NULL, 'fromis1.jpg', 'fromis2.jpg', 'fromis3.jpeg', NULL),
(2, 'jae', 'jaehyeok', 'ã…ë‹ˆã…ì–¼ë¯¸ë‚˜ì–', 'ã…ë‹ˆã…ì–¾ã„´ã…‡ã„¹', '2020-10-19 01:19:37', 1, NULL, '', '', '', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `download`
--

CREATE TABLE `download` (
  `num` int(11) NOT NULL,
  `id` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `subject` varchar(20) NOT NULL,
  `content` varchar(100) NOT NULL,
  `regdate` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `is_html` tinyint(4) DEFAULT NULL,
  `filename_0` varchar(20) DEFAULT NULL,
  `filename_1` varchar(20) DEFAULT NULL,
  `filename_2` varchar(20) DEFAULT NULL,
  `file_type0` varchar(20) DEFAULT NULL,
  `file_type1` varchar(20) DEFAULT NULL,
  `file_type2` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `download`
--

INSERT INTO `download` (`num`, `id`, `name`, `subject`, `content`, `regdate`, `hit`, `is_html`, `filename_0`, `filename_1`, `filename_2`, `file_type0`, `file_type1`, `file_type2`) VALUES
(1, 'jae', 'jaehyeok', 'ìžë£Œë“¤', 'ìžë£Œë“¤', '2020-10-19 01:09:59', 5, NULL, 'one.xlsx', 'two.pdf', '', '', 'application/vnd.open', 'application/pdf');

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `no` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `id` varchar(20) DEFAULT NULL,
  `pw` varchar(20) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`no`, `name`, `id`, `pw`, `tel`, `email`, `regdate`, `ip`) VALUES
(1, 'jaehyeok', 'jae', '1234', '010-7108-6548', 'jae@gmail.com', '2020-10-14 01:47:22', '127.0.0.1'),
(2, 'choi', 'choi', '1234', '010-7108-6548', 'choi@gmail.com', '2020-10-15 12:55:07', '127.0.0.1'),
(3, 'ê¹€ì •ì€', 'kim', '1234', '010-1111-1111', 'kim@gmail.com', '2020-10-19 01:10:47', '127.0.0.1'),
(4, 'ê¹€ì •ì¼', 'kim1', '1234', '010-222-2222', 'kim1@gmail.com', '2020-10-19 01:20:50', '127.0.0.1');

-- --------------------------------------------------------

--
-- 테이블 구조 `memo`
--

CREATE TABLE `memo` (
  `no` int(11) NOT NULL,
  `id` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `memo`
--

INSERT INTO `memo` (`no`, `id`, `name`, `content`, `regdate`) VALUES
(1, 'jae', 'jaehyeok', 'ì•ˆë…•í•˜ì„¸ìš”', '2020-10-14 02:41:22'),
(2, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:28'),
(3, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:31'),
(4, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:33'),
(5, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:35'),
(6, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:37'),
(7, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:38'),
(8, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:42'),
(9, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:44'),
(10, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:46'),
(11, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:48'),
(12, 'choi', 'choi', 'ë¼', '2020-10-15 01:34:53'),
(13, 'choi', 'choi', 'ë¼', '2020-10-15 01:37:25'),
(14, 'choi', 'choi', 'ë¼', '2020-10-15 01:38:40');

-- --------------------------------------------------------

--
-- 테이블 구조 `memo_reply`
--

CREATE TABLE `memo_reply` (
  `no` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `id` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`num`);

--
-- 테이블의 인덱스 `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`num`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`no`);

--
-- 테이블의 인덱스 `memo`
--
ALTER TABLE `memo`
  ADD PRIMARY KEY (`no`);

--
-- 테이블의 인덱스 `memo_reply`
--
ALTER TABLE `memo_reply`
  ADD PRIMARY KEY (`no`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `download`
--
ALTER TABLE `download`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `memo`
--
ALTER TABLE `memo`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 테이블의 AUTO_INCREMENT `memo_reply`
--
ALTER TABLE `memo_reply`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
