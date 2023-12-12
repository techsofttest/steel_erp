-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 05:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `steel`
--

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_account_type`
--

CREATE TABLE `steel_accounts_account_type` (
  `at_id` int(11) NOT NULL,
  `at_name` varchar(255) NOT NULL,
  `at_added_by` varchar(255) DEFAULT NULL,
  `at_added_date` date NOT NULL,
  `at_modify_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_account_type`
--

INSERT INTO `steel_accounts_account_type` (`at_id`, `at_name`, `at_added_by`, `at_added_date`, `at_modify_date`) VALUES
(2, 'Accounts Receivable', '', '0000-00-00', '0000-00-00'),
(3, 'Cash', '', '0000-00-00', '0000-00-00'),
(4, 'test name', '', '0000-00-00', '0000-00-00'),
(6, 'test name2', '0', '2023-12-11', '0000-00-00'),
(7, 'dsfsdfsd', '0', '2023-12-12', '0000-00-00'),
(8, 'sadasdas', '0', '2023-12-12', '0000-00-00'),
(9, 'dfsdfs', '0', '2023-12-12', '0000-00-00'),
(10, 'sadasd', '0', '2023-12-12', '0000-00-00'),
(11, 'aaaa', '0', '2023-12-12', '0000-00-00'),
(12, 'bbbb', '0', '2023-12-12', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_charts_accounts`
--

CREATE TABLE `steel_accounts_charts_accounts` (
  `ca_id` int(11) NOT NULL,
  `ca_account_id` int(255) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `ca_account_type` int(255) NOT NULL,
  `ca_added_by` varchar(255) NOT NULL,
  `ca_added_date` date NOT NULL,
  `ca_modify_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_journal_voucher`
--

CREATE TABLE `steel_accounts_journal_voucher` (
  `jv_id` int(11) NOT NULL,
  `jv_voucher_no` int(255) NOT NULL,
  `jv_voucher_date` date NOT NULL,
  `jv_sales_order_id` int(255) NOT NULL,
  `jv_account` int(255) NOT NULL,
  `jv_debit` int(255) NOT NULL,
  `jv_credit` int(255) NOT NULL,
  `jv_narration` text NOT NULL,
  `jv_added_by` varchar(255) NOT NULL,
  `jv_added_date` date NOT NULL,
  `jv_modify_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_payment`
--

CREATE TABLE `steel_accounts_payment` (
  `payment_id` int(11) NOT NULL,
  `payment_reff_no` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_credit_account` varchar(255) NOT NULL,
  `payment_method` int(255) NOT NULL,
  `payment_cheque_no` varchar(255) DEFAULT NULL,
  `payment_cheque_date` date NOT NULL,
  `payment_bank` int(255) NOT NULL,
  `payment_debit_account` int(255) NOT NULL,
  `payment_amount` int(255) NOT NULL,
  `payment_invoice` varchar(255) NOT NULL,
  `payment_narration` text NOT NULL,
  `payment_total` int(255) NOT NULL,
  `payment_amount_word` varchar(255) NOT NULL,
  `payment_print_cheque` varchar(255) NOT NULL,
  `payment_cheque_copy` varchar(255) NOT NULL,
  `payment_added_by` varchar(255) NOT NULL,
  `payment_added_date` date NOT NULL,
  `payment_modify_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_petty_cash_voucher`
--

CREATE TABLE `steel_accounts_petty_cash_voucher` (
  `pcv_id` int(11) NOT NULL,
  `pcv_voucher_no` int(255) NOT NULL,
  `pcv_date` date NOT NULL,
  `pcv_credit_acount_id` int(255) NOT NULL,
  `pcv_sale_order_id` int(255) NOT NULL,
  `pcv_debit_account` int(255) NOT NULL,
  `pcv_amount` int(255) NOT NULL,
  `pcv_narration` text NOT NULL,
  `pcv_total` int(255) NOT NULL,
  `pcv_added_by` varchar(255) NOT NULL,
  `pcv_added_date` date NOT NULL,
  `pcv_modify_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_receipt`
--

CREATE TABLE `steel_accounts_receipt` (
  `receipt_id` int(11) NOT NULL,
  `receipt_reff_no` int(255) NOT NULL,
  `receipt_date` date NOT NULL,
  `receipt_debit_account` varchar(255) NOT NULL,
  `receipt_number` int(255) NOT NULL,
  `receipt_method` int(255) NOT NULL,
  `receipt_cheque_no` varchar(255) DEFAULT NULL,
  `receipt_cheque_date` date NOT NULL,
  `receipt_bank` int(255) NOT NULL,
  `receipt_collected_by` int(255) NOT NULL,
  `receipt_credit_account` int(255) NOT NULL,
  `receipt_amount` int(255) NOT NULL,
  `receipt_invoice` varchar(255) NOT NULL,
  `receipt_narration` text NOT NULL,
  `receipt_total` int(255) NOT NULL,
  `receipt_amount_words` varchar(255) NOT NULL,
  `receipt_check_copy` varchar(255) NOT NULL,
  `receipt_added_by` varchar(255) NOT NULL,
  `receipt_added_date` date NOT NULL,
  `receipt_modify_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `steel_master_payment_method`
--

CREATE TABLE `steel_master_payment_method` (
  `pm_id` int(11) NOT NULL,
  `pm_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `steel_master_receipt_method`
--

CREATE TABLE `steel_master_receipt_method` (
  `rm_id` int(11) NOT NULL,
  `rm_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `steel_modules`
--

CREATE TABLE `steel_modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `steel_modules_sub`
--

CREATE TABLE `steel_modules_sub` (
  `sub_module_id` int(11) NOT NULL,
  `sub_module_name` varchar(500) NOT NULL,
  `main_module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `steel_users`
--

CREATE TABLE `steel_users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `user_name` varchar(500) NOT NULL,
  `user_email` varchar(500) NOT NULL,
  `user_password` varchar(1500) NOT NULL,
  `user_role` tinyint(4) NOT NULL COMMENT '1=Super Admin,2=Sub Admin,3 = Employee',
  `user_company` int(11) NOT NULL,
  `user_last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_users`
--

INSERT INTO `steel_users` (`user_id`, `first_name`, `last_name`, `user_name`, `user_email`, `user_password`, `user_role`, `user_company`, `user_last_login`) VALUES
(1, '', 'asda', 'super_admin', '', 'f865b53623b121fd34ee5426c792e5c33af8c227', 1, 0, NULL),
(2, '', '', 'sub_admin', '', 'c1eda39141a3f1a8a41f3a2769f33be50db6e89b', 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `steel_user_roles`
--

CREATE TABLE `steel_user_roles` (
  `role_id` int(11) NOT NULL,
  `role_title` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_user_roles`
--

INSERT INTO `steel_user_roles` (`role_id`, `role_title`) VALUES
(1, 'Super Admin'),
(2, 'Sub Admin'),
(3, 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `steel_accounts_account_type`
--
ALTER TABLE `steel_accounts_account_type`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `steel_accounts_charts_accounts`
--
ALTER TABLE `steel_accounts_charts_accounts`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `steel_accounts_journal_voucher`
--
ALTER TABLE `steel_accounts_journal_voucher`
  ADD PRIMARY KEY (`jv_id`);

--
-- Indexes for table `steel_accounts_payment`
--
ALTER TABLE `steel_accounts_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `steel_accounts_petty_cash_voucher`
--
ALTER TABLE `steel_accounts_petty_cash_voucher`
  ADD PRIMARY KEY (`pcv_id`);

--
-- Indexes for table `steel_accounts_receipt`
--
ALTER TABLE `steel_accounts_receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `steel_master_payment_method`
--
ALTER TABLE `steel_master_payment_method`
  ADD PRIMARY KEY (`pm_id`);

--
-- Indexes for table `steel_master_receipt_method`
--
ALTER TABLE `steel_master_receipt_method`
  ADD PRIMARY KEY (`rm_id`);

--
-- Indexes for table `steel_modules`
--
ALTER TABLE `steel_modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `steel_modules_sub`
--
ALTER TABLE `steel_modules_sub`
  ADD PRIMARY KEY (`sub_module_id`);

--
-- Indexes for table `steel_users`
--
ALTER TABLE `steel_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `steel_user_roles`
--
ALTER TABLE `steel_user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `steel_accounts_account_type`
--
ALTER TABLE `steel_accounts_account_type`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `steel_accounts_charts_accounts`
--
ALTER TABLE `steel_accounts_charts_accounts`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_accounts_journal_voucher`
--
ALTER TABLE `steel_accounts_journal_voucher`
  MODIFY `jv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_accounts_payment`
--
ALTER TABLE `steel_accounts_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_accounts_petty_cash_voucher`
--
ALTER TABLE `steel_accounts_petty_cash_voucher`
  MODIFY `pcv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_accounts_receipt`
--
ALTER TABLE `steel_accounts_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_master_payment_method`
--
ALTER TABLE `steel_master_payment_method`
  MODIFY `pm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_master_receipt_method`
--
ALTER TABLE `steel_master_receipt_method`
  MODIFY `rm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_modules`
--
ALTER TABLE `steel_modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_modules_sub`
--
ALTER TABLE `steel_modules_sub`
  MODIFY `sub_module_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_users`
--
ALTER TABLE `steel_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `steel_user_roles`
--
ALTER TABLE `steel_user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
