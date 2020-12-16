-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2020 at 07:14 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `possys`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `saleable`
-- (See below for the actual view)
--
CREATE TABLE `saleable` (
`order_log_id` int(11)
,`name` varchar(40)
,`SKU` varchar(40)
,`qty` int(11)
,`price` int(11)
,`total` bigint(21)
,`payment_type` varchar(40)
,`date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `Order_log_id` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Qty` int(11) DEFAULT NULL,
  `price` int(6) DEFAULT NULL,
  `Subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cheque`
--

CREATE TABLE `tbl_cheque` (
  `Cheque_ID` int(11) NOT NULL,
  `cheque_no` int(11) NOT NULL,
  `Bank` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `Customer_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `Customer_ID` int(6) NOT NULL,
  `Name` varchar(40) DEFAULT NULL,
  `Phone` int(6) DEFAULT NULL,
  `Address` varchar(40) DEFAULT NULL,
  `Ordertype_ID` int(6) NOT NULL,
  `Customertype_ID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`Customer_ID`, `Name`, `Phone`, `Address`, `Ordertype_ID`, `Customertype_ID`) VALUES
(1, 'Diana', 2147483647, 'Davao Or.', 202, 302);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customertype`
--

CREATE TABLE `tbl_customertype` (
  `customertype_id` int(11) NOT NULL,
  `type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customertype`
--

INSERT INTO `tbl_customertype` (`customertype_id`, `type_name`) VALUES
(301, 'Senior_Citizen'),
(302, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `User_ID` int(6) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `sec_answer` varchar(11) DEFAULT NULL,
  `Question_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`User_ID`, `Username`, `Password`, `sec_answer`, `Question_id`) VALUES
(1, 'Admin', 'admin', 'SMC', 102);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetails`
--

CREATE TABLE `tbl_orderdetails` (
  `Order_Log_ID` int(6) NOT NULL,
  `Total` int(6) DEFAULT NULL,
  `Payment_ID` int(6) DEFAULT NULL,
  `Customer_ID` int(6) NOT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orderdetails`
--

INSERT INTO `tbl_orderdetails` (`Order_Log_ID`, `Total`, `Payment_ID`, `Customer_ID`, `Date`) VALUES
(1, 3360, 402, 1, '2020-12-17 01:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderline`
--

CREATE TABLE `tbl_orderline` (
  `orderline_id` int(11) NOT NULL,
  `Order_log_id` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orderline`
--

INSERT INTO `tbl_orderline` (`orderline_id`, `Order_log_id`, `Product_ID`, `Qty`) VALUES
(3, 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ordertype`
--

CREATE TABLE `tbl_ordertype` (
  `Ordertype_ID` int(6) NOT NULL,
  `Customer_type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ordertype`
--

INSERT INTO `tbl_ordertype` (`Ordertype_ID`, `Customer_type`) VALUES
(201, 'Walk In'),
(202, 'Regular'),
(203, 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(6) NOT NULL,
  `payment_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `payment_type`) VALUES
(401, 'Cheque'),
(402, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pricing`
--

CREATE TABLE `tbl_pricing` (
  `Unit_ID` int(6) NOT NULL,
  `Unit_Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pricing`
--

INSERT INTO `tbl_pricing` (`Unit_ID`, `Unit_Type`) VALUES
(1, 'Set'),
(2, 'Piece'),
(3, 'Box'),
(4, 'Kg'),
(5, 'Liter'),
(6, 'Pack');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `Product_ID` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Stocks` int(6) NOT NULL,
  `Price` int(10) NOT NULL,
  `Price_type` int(6) NOT NULL,
  `SKU` varchar(40) NOT NULL,
  `Date_Added` datetime DEFAULT NULL,
  `Addedby_ID` int(6) DEFAULT NULL,
  `Supplier_ID` int(6) NOT NULL,
  `Status_ID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`Product_ID`, `Name`, `Description`, `Stocks`, `Price`, `Price_type`, `SKU`, `Date_Added`, `Addedby_ID`, `Supplier_ID`, `Status_ID`) VALUES
(1, 'Sofa', 'DEsc', 0, 1000, 1, 'Sofa-md-blue', '2020-12-01 01:22:12', 1, 1, 1),
(2, 'Chair', '', 0, 0, 1, 'chair-md-brown', NULL, 1, 1, 0),
(7, 'Matress', 'high-quality foam', 0, 3000, 1, 'sofa-bg-weird', '2020-12-03 12:08:18', 1, 1, 1),
(13, 'Bed', 'Leather Padded Headboard', 3, 6500, 1, 'bed-single-white', '2020-12-05 00:00:00', 1, 1, 0),
(14, 'TestProduct', 'Testdescription', 15, 3500, 2, 'test-sm-test', '2020-12-05 00:00:00', 1, 2, 1),
(15, 'test100', 'test10000description', 35, 30000, 4, 'md-test100-100', '2020-12-07 00:00:00', 1, 2, 1),
(16, 'Add2', 'DESCRIPTION', 50, 40001, 5, 'skue', '2020-12-07 00:00:00', 1, 9, 1),
(17, '', '', 0, 0, 1, '', '2020-12-14 00:00:00', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

CREATE TABLE `tbl_questions` (
  `Quest_ID` int(6) NOT NULL,
  `Question` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_questions`
--

INSERT INTO `tbl_questions` (`Quest_ID`, `Question`) VALUES
(101, 'What was the first company that you worked for?'),
(102, 'Where did you go to high school/college?'),
(103, 'What Is your favorite book?'),
(104, 'What city were you born in?'),
(105, 'Where is your favorite place to vacation?');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_returned`
--

CREATE TABLE `tbl_returned` (
  `Logreturn_No.` int(6) NOT NULL,
  `Returnedby_ID` int(6) NOT NULL,
  `Orderline_ID` int(6) NOT NULL,
  `Product_ID` int(6) NOT NULL,
  `Quantity` int(6) NOT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `Status_ID` int(6) NOT NULL,
  `Status_Name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`Status_ID`, `Status_Name`) VALUES
(0, 'Inactive'),
(1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `Supplier_ID` int(6) NOT NULL,
  `Company_name` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Phone` bigint(20) NOT NULL,
  `Address` varchar(40) DEFAULT NULL,
  `Status_ID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`Supplier_ID`, `Company_name`, `Email`, `Phone`, `Address`, `Status_ID`) VALUES
(1, 'sample', 'sample@gmail.com', 9218321121, 'Davao Oriental', 1),
(2, 'Murrillo Designer', 'Murrillo @gmail.com', 9218321121, 'Ceby City, Cebu', 1),
(8, 'test', 'test', 1, '029394155', 1),
(9, 'ddd', 'ddd', 1, 'ddd', 1),
(10, 'dwdwd', 'dwdwd', 1, '888888888', 1),
(11, 'Companytest', 'Companytest', 1, '999923999', 1),
(12, 'haks', 'haks', 1, '09', 1),
(13, 'wd', 'wd', 1, 'd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test`
--

CREATE TABLE `tbl_test` (
  `test_id` int(6) NOT NULL,
  `Message` varchar(255) DEFAULT NULL,
  `stocks` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_test`
--

INSERT INTO `tbl_test` (`test_id`, `Message`, `stocks`) VALUES
(1, 'dddddddddddddddddddd', 14),
(2, 'wwwwwwwwwwwwwwwwwwwwww', 11);

-- --------------------------------------------------------

--
-- Structure for view `saleable`
--
DROP TABLE IF EXISTS `saleable`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `saleable`  AS  select `ord`.`Order_Log_ID` AS `order_log_id`,`p`.`Name` AS `name`,`p`.`SKU` AS `SKU`,`ol`.`Qty` AS `qty`,`p`.`Price` AS `price`,`ol`.`Qty` * `p`.`Price` AS `total`,`pay`.`payment_type` AS `payment_type`,cast(`ord`.`Date` as date) AS `date` from (((`tbl_orderline` `ol` left join `tbl_product` `p` on(`ol`.`Product_ID` = `p`.`Product_ID`)) left join `tbl_orderdetails` `ord` on(`ol`.`Order_log_id` = `ord`.`Order_Log_ID`)) left join `tbl_payment` `pay` on(`ord`.`Payment_ID` = `pay`.`payment_id`)) where `ol`.`Qty` >= 1 except select `ord`.`Order_Log_ID` AS `order_log_id`,`p`.`Name` AS `name`,`p`.`SKU` AS `SKU`,`ol`.`Qty` AS `qty`,`p`.`Price` AS `price`,`ol`.`Qty` * `p`.`Price` AS `total`,`pay`.`payment_type` AS `payment_type`,cast(`ord`.`Date` as date) AS `date` from (((`tbl_orderline` `ol` left join `tbl_product` `p` on(`ol`.`Product_ID` = `p`.`Product_ID`)) left join `tbl_orderdetails` `ord` on(`ol`.`Order_log_id` = `ord`.`Order_Log_ID`)) left join `tbl_payment` `pay` on(`ord`.`Payment_ID` = `pay`.`payment_id`)) where `pay`.`payment_type` = 'cheque' and `ord`.`Date` > curdate() - 4 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD UNIQUE KEY `Product_ID` (`Product_ID`);

--
-- Indexes for table `tbl_cheque`
--
ALTER TABLE `tbl_cheque`
  ADD PRIMARY KEY (`Cheque_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`Customer_ID`),
  ADD KEY `Ordertype_ID` (`Ordertype_ID`,`Customertype_ID`),
  ADD KEY `Customertype_ID` (`Customertype_ID`);

--
-- Indexes for table `tbl_customertype`
--
ALTER TABLE `tbl_customertype`
  ADD PRIMARY KEY (`customertype_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `Question_id` (`Question_id`);

--
-- Indexes for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD PRIMARY KEY (`Order_Log_ID`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `Payment_ID` (`Payment_ID`);

--
-- Indexes for table `tbl_orderline`
--
ALTER TABLE `tbl_orderline`
  ADD PRIMARY KEY (`orderline_id`),
  ADD KEY `Product_ID` (`Product_ID`),
  ADD KEY `Order_log_id` (`Order_log_id`);

--
-- Indexes for table `tbl_ordertype`
--
ALTER TABLE `tbl_ordertype`
  ADD PRIMARY KEY (`Ordertype_ID`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_pricing`
--
ALTER TABLE `tbl_pricing`
  ADD PRIMARY KEY (`Unit_ID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `Supplier_ID` (`Supplier_ID`,`Status_ID`),
  ADD KEY `Status_ID` (`Status_ID`),
  ADD KEY `Price_type` (`Price_type`),
  ADD KEY `Addedby_ID` (`Addedby_ID`);

--
-- Indexes for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  ADD PRIMARY KEY (`Quest_ID`);

--
-- Indexes for table `tbl_returned`
--
ALTER TABLE `tbl_returned`
  ADD PRIMARY KEY (`Logreturn_No.`),
  ADD KEY `Returnedby_ID` (`Returnedby_ID`,`Product_ID`),
  ADD KEY `Product_ID` (`Product_ID`),
  ADD KEY `Orderline_ID` (`Orderline_ID`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`Status_ID`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`Supplier_ID`),
  ADD KEY `Status_ID` (`Status_ID`);

--
-- Indexes for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD PRIMARY KEY (`test_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cheque`
--
ALTER TABLE `tbl_cheque`
  MODIFY `Cheque_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `Customer_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `User_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  MODIFY `Order_Log_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_orderline`
--
ALTER TABLE `tbl_orderline`
  MODIFY `orderline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_ordertype`
--
ALTER TABLE `tbl_ordertype`
  MODIFY `Ordertype_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `tbl_pricing`
--
ALTER TABLE `tbl_pricing`
  MODIFY `Unit_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_returned`
--
ALTER TABLE `tbl_returned`
  MODIFY `Logreturn_No.` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `Supplier_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_test`
--
ALTER TABLE `tbl_test`
  MODIFY `test_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `tbl_product` (`Product_ID`);

--
-- Constraints for table `tbl_cheque`
--
ALTER TABLE `tbl_cheque`
  ADD CONSTRAINT `tbl_cheque_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `tbl_customer` (`Customer_ID`);

--
-- Constraints for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD CONSTRAINT `tbl_customer_ibfk_1` FOREIGN KEY (`Ordertype_ID`) REFERENCES `tbl_ordertype` (`Ordertype_ID`),
  ADD CONSTRAINT `tbl_customer_ibfk_2` FOREIGN KEY (`Customertype_ID`) REFERENCES `tbl_customertype` (`customertype_id`);

--
-- Constraints for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD CONSTRAINT `tbl_login_ibfk_1` FOREIGN KEY (`Question_id`) REFERENCES `tbl_questions` (`Quest_ID`);

--
-- Constraints for table `tbl_orderdetails`
--
ALTER TABLE `tbl_orderdetails`
  ADD CONSTRAINT `tbl_orderdetails_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `tbl_customer` (`Customer_ID`),
  ADD CONSTRAINT `tbl_orderdetails_ibfk_2` FOREIGN KEY (`Payment_ID`) REFERENCES `tbl_payment` (`payment_id`);

--
-- Constraints for table `tbl_orderline`
--
ALTER TABLE `tbl_orderline`
  ADD CONSTRAINT `tbl_orderline_ibfk_1` FOREIGN KEY (`Order_log_id`) REFERENCES `tbl_orderdetails` (`Order_Log_ID`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`Supplier_ID`) REFERENCES `tbl_supplier` (`Supplier_ID`),
  ADD CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`Status_ID`) REFERENCES `tbl_status` (`Status_ID`),
  ADD CONSTRAINT `tbl_product_ibfk_3` FOREIGN KEY (`Price_type`) REFERENCES `tbl_pricing` (`Unit_ID`),
  ADD CONSTRAINT `tbl_product_ibfk_4` FOREIGN KEY (`Addedby_ID`) REFERENCES `tbl_login` (`User_ID`);

--
-- Constraints for table `tbl_returned`
--
ALTER TABLE `tbl_returned`
  ADD CONSTRAINT `tbl_returned_ibfk_1` FOREIGN KEY (`Returnedby_ID`) REFERENCES `tbl_login` (`User_ID`),
  ADD CONSTRAINT `tbl_returned_ibfk_2` FOREIGN KEY (`Product_ID`) REFERENCES `tbl_product` (`Product_ID`),
  ADD CONSTRAINT `tbl_returned_ibfk_3` FOREIGN KEY (`Orderline_ID`) REFERENCES `tbl_orderdetails` (`Order_Log_ID`);

--
-- Constraints for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD CONSTRAINT `tbl_supplier_ibfk_1` FOREIGN KEY (`Status_ID`) REFERENCES `tbl_status` (`Status_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
