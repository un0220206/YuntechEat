-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 
-- 伺服器版本: 10.1.10-MariaDB
-- PHP 版本： 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `yuntecheat`
--
CREATE DATABASE IF NOT EXISTS `yuntecheat` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `yuntecheat`;

-- --------------------------------------------------------

--
-- 資料表結構 `deliverystaff`
--

DROP TABLE IF EXISTS `deliverystaff`;
CREATE TABLE `deliverystaff` (
  `deliveryStaffID` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `deliverystaff`
--

INSERT INTO `deliverystaff` (`deliveryStaffID`, `name`, `tel`) VALUES
(1, 'staff1', '0912345678'),
(2, 'staff2', '0987654321'),
(3, 'staff3', '0999888777'),
(4, 'staff4', '0966555444');

-- --------------------------------------------------------

--
-- 資料表結構 `food`
--

DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `restaurantID` int(11) NOT NULL,
  `foodID` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `imageURL` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `food`
--

INSERT INTO `food` (`restaurantID`, `foodID`, `name`, `price`, `imageURL`, `description`) VALUES
(1, 1, 'drink1', 20, 'drink1.jpg', 'nice drink!'),
(2, 1, 'ice1', 35, 'ice1.jpg', 'nice ice!'),
(3, 1, 'rice1', 60, 'rice1.jpg', 'nice rice!'),
(4, 1, 'noodle1', 60, 'noodle1.jpg', 'nice noodle!'),
(1, 2, 'drink3', 30, 'drink2.jpg', 'nice drink!'),
(2, 2, 'ice2', 35, 'ice2.jpg', 'nice ice!'),
(3, 2, 'rice2', 65, 'rice2.jpg', 'nice rice!'),
(4, 2, 'noodle2', 65, 'noodle2.jpg', 'nice noodle!'),
(3, 3, 'rice3', 70, 'rice3.jpg', 'nice rice!'),
(4, 3, 'noodle3', 70, 'noodle3.jpg', 'nice noodle!');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `memberID` int(11) NOT NULL,
  `account` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `member`
--

INSERT INTO `member` (`memberID`, `account`, `password`, `name`, `gender`, `birthday`, `email`) VALUES
(1, 'yuntech01', 'pwd01', 'member01', 1, '1998-03-08', 'yuntech01@gmail.com'),
(2, 'yuntech02', 'pwd02', 'member02', 0, '1999-10-30', 'yuntech02@gmail.com'),
(3, 'yuntech03', 'pwd03', 'member03', 1, '1998-01-07', 'yuntech03@gmail.com'),
(4, 'yuntech04', 'pwd04', 'member04', 0, '1998-05-18', 'yuntech04@gmail.com'),
(5, 'yuntech05', 'pwd05', 'member05', 1, '1997-08-22', 'yuntech05@gmail.com'),
(6, 'yuntech06', 'pwd06', 'member06', 0, '1997-04-20', 'yuntech06@gmail.com'),
(7, 'yuntech07', 'pwd07', 'member07', 1, '1998-07-03', 'yuntech07@gmail.com'),
(8, 'yuntech08', 'pwd08', 'member08', 0, '1999-01-01', 'yuntech08@gmail.com'),
(9, 'yuntech09', 'pwd09', 'member09', 1, '1997-12-31', 'yuntech09@gmail.com'),
(10, 'yuntech10', 'pwd10', 'member10', 0, '1997-05-19', 'yuntech10@gmail.com');

-- --------------------------------------------------------

--
-- 資料表結構 `orderdetail`
--

DROP TABLE IF EXISTS `orderdetail`;
CREATE TABLE `orderdetail` (
  `orderID` int(11) NOT NULL,
  `restaurantID` int(11) NOT NULL,
  `foodID` int(11) NOT NULL,
  `foodCount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `orderdetail`
--

INSERT INTO `orderdetail` (`orderID`, `restaurantID`, `foodID`, `foodCount`) VALUES
(1, 1, 1, 5),
(1, 1, 2, 2),
(1, 2, 1, 1),
(2, 2, 2, 2),
(2, 3, 1, 10),
(2, 3, 2, 1),
(3, 3, 3, 6),
(3, 4, 1, 4),
(3, 4, 2, 1),
(4, 1, 1, 4),
(4, 1, 2, 1),
(4, 4, 3, 1),
(5, 2, 1, 5),
(6, 2, 2, 3),
(7, 3, 1, 3),
(8, 3, 2, 1),
(9, 3, 3, 5),
(10, 4, 1, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `orderhistory`
--

DROP TABLE IF EXISTS `orderhistory`;
CREATE TABLE `orderhistory` (
  `orderID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `deliveryStaffID` int(11) NOT NULL,
  `creationDatetime` datetime NOT NULL,
  `arrived` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `orderhistory`
--

INSERT INTO `orderhistory` (`orderID`, `memberID`, `deliveryStaffID`, `creationDatetime`, `arrived`) VALUES
(1, 1, 1, '2019-11-22 12:00:00', 1),
(2, 2, 2, '2019-11-22 13:00:00', 1),
(3, 3, 3, '2019-11-22 14:00:00', 1),
(4, 4, 4, '2019-11-22 15:00:00', 1),
(5, 5, 1, '2019-11-22 16:00:00', 1),
(6, 6, 2, '2019-11-22 17:00:00', 1),
(7, 7, 3, '2019-11-22 18:00:00', 1),
(8, 8, 4, '2019-11-22 19:00:00', 1),
(9, 9, 1, '2019-11-22 20:00:00', 1),
(10, 10, 2, '2019-11-22 21:00:00', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE `restaurant` (
  `restaurantID` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `restaurant`
--

INSERT INTO `restaurant` (`restaurantID`, `name`, `tel`, `address`) VALUES
(1, 'rest1', '055349999', 'No.1, Sec. 3, Unversity Road, Douliu City, Yunlin Conty'),
(2, 'rest2', '055348888', 'No.2, Sec. 3, Unversity Road, Douliu City, Yunlin Conty'),
(3, 'rest3', '055347777', 'No.3, Sec. 3, Unversity Road, Douliu City, Yunlin Conty'),
(4, 'rest4', '055346666', 'No.4, Sec. 3, Unversity Road, Douliu City, Yunlin Conty');

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `restaurantreportview`
--
DROP VIEW IF EXISTS `restaurantreportview`;
CREATE TABLE `restaurantreportview` (
`餐廳` varchar(10)
,`餐點` varchar(20)
,`總被購買數量` decimal(32,0)
,`銷售總額` decimal(42,0)
);

-- --------------------------------------------------------

--
-- 檢視表結構 `restaurantreportview`
--
DROP TABLE IF EXISTS `restaurantreportview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`B10623024`@`%` SQL SECURITY DEFINER VIEW `restaurantreportview`  AS  select `r`.`name` AS `餐廳`,`f`.`name` AS `餐點`,sum(`o`.`foodCount`) AS `總被購買數量`,sum((`f`.`price` * `o`.`foodCount`)) AS `銷售總額` from ((`orderdetail` `o` join `restaurant` `r`) join `food` `f`) where ((`o`.`restaurantID` = `f`.`restaurantID`) and (`o`.`foodID` = `f`.`foodID`) and (`f`.`restaurantID` = `r`.`restaurantID`)) group by `r`.`restaurantID`,`f`.`foodID` ;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `deliverystaff`
--
ALTER TABLE `deliverystaff`
  ADD PRIMARY KEY (`deliveryStaffID`);

--
-- 資料表索引 `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`foodID`,`restaurantID`),
  ADD KEY `FOREIGN` (`restaurantID`) USING BTREE;

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`);

--
-- 資料表索引 `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`orderID`,`restaurantID`,`foodID`),
  ADD KEY `restaurantID` (`restaurantID`),
  ADD KEY `foodID` (`foodID`),
  ADD KEY `orderID` (`orderID`);

--
-- 資料表索引 `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD PRIMARY KEY (`orderID`) USING BTREE,
  ADD KEY `memberID` (`memberID`),
  ADD KEY `deliveryStaffID` (`deliveryStaffID`);

--
-- 資料表索引 `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurantID`);

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `restaurant` (`restaurantID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `food` (`restaurantID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`foodID`) REFERENCES `food` (`foodID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetail_ibfk_3` FOREIGN KEY (`orderID`) REFERENCES `orderhistory` (`orderID`);

--
-- 資料表的 Constraints `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD CONSTRAINT `orderhistory_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderhistory_ibfk_2` FOREIGN KEY (`deliveryStaffID`) REFERENCES `deliverystaff` (`deliveryStaffID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
