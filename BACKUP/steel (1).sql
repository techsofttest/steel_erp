-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 05:55 AM
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
-- Table structure for table `steel_accounts_account_heads`
--

CREATE TABLE `steel_accounts_account_heads` (
  `ah_id` int(11) NOT NULL,
  `ah_account_name` varchar(255) NOT NULL,
  `ah_account_type` int(255) NOT NULL,
  `ah_added_by` varchar(255) NOT NULL,
  `ah_added_date` date NOT NULL,
  `ah_modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_account_heads`
--

INSERT INTO `steel_accounts_account_heads` (`ah_id`, `ah_account_name`, `ah_account_type`, `ah_added_by`, `ah_added_date`, `ah_modified_date`) VALUES
(14, 'test name', 2, '0', '2023-12-15', '0000-00-00'),
(15, 'test name1', 4, '0', '2023-12-15', '0000-00-00'),
(16, 'edit test', 8, '0', '2023-12-15', '0000-00-00'),
(17, 'final  data  test', 15, '0', '2023-12-15', '0000-00-00'),
(18, 'final data', 16, '0', '2023-12-15', '0000-00-00'),
(19, 'fibal test', 11, '0', '2023-12-15', '0000-00-00'),
(20, 'sdfsdf', 5, '0', '2023-12-15', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_account_types`
--

CREATE TABLE `steel_accounts_account_types` (
  `at_id` int(11) NOT NULL,
  `at_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_account_types`
--

INSERT INTO `steel_accounts_account_types` (`at_id`, `at_name`) VALUES
(1, 'Accounts Receivable'),
(2, 'Cash'),
(3, 'Cost of Sales'),
(4, 'Expenses'),
(5, 'Fixed Assets'),
(6, 'Inventory'),
(7, 'Other Assets'),
(8, 'Other Current Assets'),
(9, 'Accounts Payable'),
(10, 'Accumulated Depreciation'),
(11, 'Equity Doesn’t Close'),
(12, ' Equity Retained Earnings'),
(13, 'Income'),
(14, 'Long Term Liabilities'),
(15, 'Provisions & Accruals'),
(16, 'Other Current Liabilities');

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_charts_of_accounts`
--

CREATE TABLE `steel_accounts_charts_of_accounts` (
  `ca_id` int(11) NOT NULL,
  `ca_account_id` varchar(255) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `ca_account_type` int(255) NOT NULL,
  `ca_added_by` varchar(255) NOT NULL,
  `ca_added_date` date NOT NULL,
  `ca_modify_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_charts_of_accounts`
--

INSERT INTO `steel_accounts_charts_of_accounts` (`ca_id`, `ca_account_id`, `ca_name`, `ca_account_type`, `ca_added_by`, `ca_added_date`, `ca_modify_date`) VALUES
(7, '#qwre', 'test name', 12, '', '0000-00-00', '0000-00-00'),
(8, '#owq', 'test2', 3, '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_journal_voucher`
--

CREATE TABLE `steel_accounts_journal_voucher` (
  `jv_id` int(11) NOT NULL,
  `jv_voucher_no` varchar(255) DEFAULT NULL,
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

--
-- Dumping data for table `steel_accounts_journal_voucher`
--

INSERT INTO `steel_accounts_journal_voucher` (`jv_id`, `jv_voucher_no`, `jv_voucher_date`, `jv_sales_order_id`, `jv_account`, `jv_debit`, `jv_credit`, `jv_narration`, `jv_added_by`, `jv_added_date`, `jv_modify_date`) VALUES
(43, 'JV000043', '1997-02-20', 2, 141, 72, 78, 'Nostrum molestiae qu', '0', '2023-12-15', '0000-00-00'),
(44, 'JV000044', '2023-12-17', 1, 140, 789, 10111, 'test barration edit', '0', '2023-12-15', '2023-12-15'),
(45, 'JV000045', '2023-12-20', 2, 139, 555, 666, 'test narration data', '0', '2023-12-15', '0000-00-00');

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

--
-- Dumping data for table `steel_accounts_petty_cash_voucher`
--

INSERT INTO `steel_accounts_petty_cash_voucher` (`pcv_id`, `pcv_voucher_no`, `pcv_date`, `pcv_credit_acount_id`, `pcv_sale_order_id`, `pcv_debit_account`, `pcv_amount`, `pcv_narration`, `pcv_total`, `pcv_added_by`, `pcv_added_date`, `pcv_modify_date`) VALUES
(1, 0, '2023-12-01', 0, 0, 0, 50, 'test narration', 100, '0', '2023-12-15', '0000-00-00');

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
-- Table structure for table `steel_crm_contact_details`
--

CREATE TABLE `steel_crm_contact_details` (
  `contact_id` int(11) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_designation` varchar(255) NOT NULL,
  `contact_mobile` int(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_customer_creation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_contact_details`
--

INSERT INTO `steel_crm_contact_details` (`contact_id`, `contact_person`, `contact_designation`, `contact_mobile`, `contact_email`, `contact_customer_creation`) VALUES
(41, 'anu', 'anu designation', 1234567890, 'anu@gmail.com', 87),
(42, 'appu', 'appu designation', 2147483647, 'appu@gmail.com', 87),
(43, 'Nulla dolores repreh', 'Cum in delectus sap', 0, 'foru@mailinator.com', 88),
(44, 'anu', 'anu designation', 1234567890, 'anu@gmail.com', 89),
(45, 'appu', 'appu designation', 987654321, 'appu@gmail.com', 89),
(46, 'Sunt quasi sed sed ', 'Non consequuntur opt', 0, 'titu@mailinator.com', 90);

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_customer_creation`
--

CREATE TABLE `steel_crm_customer_creation` (
  `cc_id` int(11) NOT NULL,
  `cc_customer_name` varchar(255) NOT NULL,
  `cc_account_id` int(255) NOT NULL,
  `cc_post_box` varchar(255) NOT NULL,
  `cc_telephone` int(255) NOT NULL,
  `cc_fax` int(255) NOT NULL,
  `cc_email` varchar(255) NOT NULL,
  `cc_credit_term` varchar(255) NOT NULL,
  `cc_credit_period` int(255) NOT NULL,
  `cc_credit_limit` int(255) NOT NULL,
  `cc_account_type` int(255) NOT NULL,
  `cc_cr_number` int(255) NOT NULL,
  `cc_expiry_date` date NOT NULL,
  `cc_attach_cr` varchar(255) NOT NULL,
  `cc_est_card_no` varchar(255) NOT NULL,
  `cc_est_expiry_date` date NOT NULL,
  `cc_est_attach_card` varchar(255) NOT NULL,
  `cc_est_signatory_name` varchar(255) NOT NULL,
  `cc_card_number` int(255) NOT NULL,
  `cc_id_card_expiry_date` date NOT NULL,
  `cc_id_card` varchar(255) NOT NULL,
  `cc_added_by` varchar(255) NOT NULL,
  `cc_added_date` date NOT NULL,
  `cc_modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_customer_creation`
--

INSERT INTO `steel_crm_customer_creation` (`cc_id`, `cc_customer_name`, `cc_account_id`, `cc_post_box`, `cc_telephone`, `cc_fax`, `cc_email`, `cc_credit_term`, `cc_credit_period`, `cc_credit_limit`, `cc_account_type`, `cc_cr_number`, `cc_expiry_date`, `cc_attach_cr`, `cc_est_card_no`, `cc_est_expiry_date`, `cc_est_attach_card`, `cc_est_signatory_name`, `cc_card_number`, `cc_id_card_expiry_date`, `cc_id_card`, `cc_added_by`, `cc_added_date`, `cc_modified_date`) VALUES
(88, 'Darryl Garrett', 7, 'PO Box 30873', 1, 1, 'curodejuru@mailinator.com', 'Quasi magnam quam et', 0, 0, 9, 423, '2008-07-19', '1702976113_378f2772914143b5152f.jpg', 'Ex iste magna id eni', '2009-06-07', '1702976113_174de8f323cab65e26cc.jpg', 'Yeo Evans', 10, '2011-08-19', '1702976113_213ebf444c9cc25c230f.jpg', '0', '2023-12-19', '0000-00-00'),
(89, 'anagha ', 8, 'PO Box 2', 1234567890, 987654321, 'anagha@gmail.com', 'credit term', 0, 0, 15, 0, '2023-12-19', '1702977045_be5c0d07efa8015f3149.jpg', 'ds', '2023-12-14', '1702977045_0298fa887009801059f8.jpg', 'zxczx', 0, '2023-12-21', '1702977045_ee9702d158dfae0b6238.jpg', '0', '2023-12-19', '0000-00-00'),
(90, 'Gretchen Woodard', 7, 'PO Box 8', 1, 1, 'kytepyve@mailinator.com', 'Pariatur Eaque cupi', 0, 0, 3, 929, '1984-04-10', '1703155400_8634814e75f98ee631b7.jpg', 'Et qui qui est cumq', '1993-04-29', '1703155400_27b5672517d46b0cbeb5.jpg', 'Suki Mcbride', 937, '1990-02-17', '1703155400_0e8df065d47d62938c2f.jpg', '0', '2023-12-21', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_enquiry`
--

CREATE TABLE `steel_crm_enquiry` (
  `enquiry_id` int(11) NOT NULL,
  `enquiry_enq_number` varchar(255) NOT NULL,
  `enquiry_date` date NOT NULL,
  `enquiry_customer` int(255) NOT NULL,
  `enquiry_contact_person` int(255) NOT NULL,
  `enquiry_sales_executive` int(255) NOT NULL,
  `enquiry_validity` varchar(255) NOT NULL,
  `enquiry_project` varchar(255) NOT NULL,
  `enquiry_enq_referance` varchar(255) NOT NULL,
  `enquiry_employees` int(255) NOT NULL,
  `enquiry_added_by` varchar(255) NOT NULL,
  `enquiry_added_date` date NOT NULL,
  `enquiry_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_enquiry`
--

INSERT INTO `steel_crm_enquiry` (`enquiry_id`, `enquiry_enq_number`, `enquiry_date`, `enquiry_customer`, `enquiry_contact_person`, `enquiry_sales_executive`, `enquiry_validity`, `enquiry_project`, `enquiry_enq_referance`, `enquiry_employees`, `enquiry_added_by`, `enquiry_added_date`, `enquiry_modified`) VALUES
(12, '#111', '2023-12-19', 88, 43, 2, 'test validity', 'test project', 'test enquiry referance', 0, '0', '2023-12-20', '0000-00-00'),
(13, '714', '1993-08-20', 89, 44, 2, 'Quisquam enim atque ', 'Incidunt qui quisqu', 'Consectetur nostrum ', 0, '0', '2023-12-20', '0000-00-00'),
(14, 'ENQ0000014', '2023-12-13', 90, 46, 2, 'xsczxc', 'zxczx', 'zxczxc', 1, '0', '2023-12-22', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_products`
--

CREATE TABLE `steel_crm_products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_details` varchar(255) NOT NULL,
  `product_product_head` int(255) NOT NULL,
  `product_added_by` varchar(255) NOT NULL,
  `product_added_date` date NOT NULL,
  `product_modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_products`
--

INSERT INTO `steel_crm_products` (`product_id`, `product_code`, `product_details`, `product_product_head`, `product_added_by`, `product_added_date`, `product_modified_date`) VALUES
(1, 'test code', 'test product detail', 7, '0', '2023-12-16', '0000-00-00'),
(2, 'zxczxc', 'czxczx', 7, '0', '2023-12-16', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_product_detail`
--

CREATE TABLE `steel_crm_product_detail` (
  `pd_id` int(11) NOT NULL,
  `pd_serial_no` int(255) NOT NULL,
  `pd_product_detail` int(255) NOT NULL,
  `pd_unit` int(255) NOT NULL,
  `pd_quantity` int(255) NOT NULL,
  `pd_customer_details` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_product_detail`
--

INSERT INTO `steel_crm_product_detail` (`pd_id`, `pd_serial_no`, `pd_product_detail`, `pd_unit`, `pd_quantity`, `pd_customer_details`) VALUES
(10, 1, 2, 333, 444, 12),
(11, 2, 1, 555, 666, 12),
(12, 1, 2, 11, 22, 13),
(13, 2, 1, 33, 44, 13),
(14, 1, 1, 3242, 123, 14);

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_product_heads`
--

CREATE TABLE `steel_crm_product_heads` (
  `ph_id` int(11) NOT NULL,
  `ph_code` varchar(255) NOT NULL,
  `ph_product_head` varchar(255) NOT NULL,
  `ph_added_by` varchar(255) NOT NULL,
  `ph_added_date` date NOT NULL,
  `ph_modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_product_heads`
--

INSERT INTO `steel_crm_product_heads` (`ph_id`, `ph_code`, `ph_product_head`, `ph_added_by`, `ph_added_date`, `ph_modified_date`) VALUES
(7, '#123', 'test data', '0', '2023-12-16', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_quotation_details`
--

CREATE TABLE `steel_crm_quotation_details` (
  `qd_id` int(11) NOT NULL,
  `qd_quotation_number` varchar(255) NOT NULL,
  `qd_date` date NOT NULL,
  `qd_customer` int(255) NOT NULL,
  `qd_contact_person` int(255) NOT NULL,
  `qd_sales_executive` int(255) NOT NULL,
  `qd_payment_term` varchar(255) NOT NULL,
  `qd_delivery_term` int(255) NOT NULL,
  `qd_validity` varchar(255) NOT NULL,
  `qd_project` varchar(255) NOT NULL,
  `qd_enquiry_reference` varchar(255) NOT NULL,
  `qd_added_by` varchar(255) NOT NULL,
  `qd_added_date` date NOT NULL,
  `qd_modified_date` date NOT NULL,
  `qd_materials` varchar(255) DEFAULT NULL,
  `qd_qty` int(255) DEFAULT NULL,
  `qd_rate` int(255) DEFAULT NULL,
  `qd_amount` int(255) DEFAULT NULL,
  `qd_cost_of_sale` int(255) DEFAULT NULL,
  `qd_gross_profit` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_quotation_details`
--

INSERT INTO `steel_crm_quotation_details` (`qd_id`, `qd_quotation_number`, `qd_date`, `qd_customer`, `qd_contact_person`, `qd_sales_executive`, `qd_payment_term`, `qd_delivery_term`, `qd_validity`, `qd_project`, `qd_enquiry_reference`, `qd_added_by`, `qd_added_date`, `qd_modified_date`, `qd_materials`, `qd_qty`, `qd_rate`, `qd_amount`, `qd_cost_of_sale`, `qd_gross_profit`) VALUES
(11, '#123', '2023-12-06', 89, 44, 2, 'googlepay', 2, 'validity', 'project', 'enquiry reference', '0', '2023-12-21', '0000-00-00', 'materials', 1, 2, 3, 4, 5),
(12, 'SQ0000012', '2023-12-14', 89, 44, 2, 'zxczx', 2, 'zxczx', 'zxczx', 'zxczx', '0', '2023-12-21', '0000-00-00', 'sadas', 2, 3, 4, 5, 6),
(13, 'SQ0000013', '1984-05-20', 88, 43, 1, 'Quasi magnam quam et', 2, 'Tempor nobis porro p', 'Dolore perferendis u', 'Culpa quas in ad eaq', '0', '2023-12-21', '0000-00-00', 'dsfsdf', 1, 2, 3, 4, 5),
(14, 'SQ0000014', '2023-12-08', 89, 44, 2, 'credit term', 2, 'asdasda', 'Incidunt qui quisqu', 'Consectetur nostrum ', '0', '2023-12-21', '0000-00-00', 'sadasd', 3, 2, 3, 2, 3),
(15, 'SQ0000015', '2023-12-08', 89, 45, 2, 'credit term', 2, 'asdas', '', '', '0', '2023-12-21', '0000-00-00', '23423', 3, 12, 3, 4, 13),
(16, 'SQ0000016', '2023-12-09', 88, 43, 1, 'Quasi magnam quam et', 2, 'sadasd', 'test project', 'test enquiry referance', '0', '2023-12-22', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_quotation_product_details`
--

CREATE TABLE `steel_crm_quotation_product_details` (
  `qpd_id` int(11) NOT NULL,
  `qpd_serial_no` int(255) NOT NULL,
  `qpd_product_description` int(255) NOT NULL,
  `qpd_unit` int(255) NOT NULL,
  `qpd_quantity` int(255) NOT NULL,
  `qpd_rate` int(255) NOT NULL,
  `qpd_discount` int(255) NOT NULL,
  `qpd_amount` int(255) NOT NULL,
  `qpd_quotation_details` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_quotation_product_details`
--

INSERT INTO `steel_crm_quotation_product_details` (`qpd_id`, `qpd_serial_no`, `qpd_product_description`, `qpd_unit`, `qpd_quantity`, `qpd_rate`, `qpd_discount`, `qpd_amount`, `qpd_quotation_details`) VALUES
(17, 1, 2, 11, 22, 33, 44, 55, 11),
(18, 2, 1, 66, 77, 88, 99, 10, 11),
(19, 1, 2, 2, 3, 4, 5, 6, 12),
(20, 1, 1, 33, 44, 55, 66, 77, 13),
(21, 1, 2, 11, 22, 33, 4, 4, 14),
(22, 2, 1, 33, 434, 34, 232, 34, 15),
(23, 2, 1, 4, 2, 43, 54, 232, 16);

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_sales_orders`
--

CREATE TABLE `steel_crm_sales_orders` (
  `so_id` int(11) NOT NULL,
  `so_order_no` varchar(255) NOT NULL,
  `so_date` date NOT NULL,
  `so_customer` int(255) NOT NULL,
  `so_lpo` varchar(255) NOT NULL,
  `so_quotation_ref` int(255) NOT NULL,
  `so_contact_person` varchar(255) NOT NULL,
  `so_sales_executive` varchar(255) NOT NULL,
  `so_payment_term` varchar(255) NOT NULL,
  `so_delivery_term` varchar(255) NOT NULL,
  `so_project` varchar(255) NOT NULL,
  `so_lpo_and_drawing` varchar(255) NOT NULL,
  `so_scheduled_date_of_delivery` date NOT NULL,
  `so_added_by` varchar(255) DEFAULT NULL,
  `so_added_date` date NOT NULL,
  `so_modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_sales_orders`
--

INSERT INTO `steel_crm_sales_orders` (`so_id`, `so_order_no`, `so_date`, `so_customer`, `so_lpo`, `so_quotation_ref`, `so_contact_person`, `so_sales_executive`, `so_payment_term`, `so_delivery_term`, `so_project`, `so_lpo_and_drawing`, `so_scheduled_date_of_delivery`, `so_added_by`, `so_added_date`, `so_modified_date`) VALUES
(37, 'SO0000037', '2023-12-20', 89, 'fts', 14, 'anu', 'test2', 'credit term', '2', 'Incidunt qui quisqu', '1703157602_02b77f3382a9142134c9.jpg', '2023-12-19', '0', '2023-12-21', '0000-00-00'),
(38, 'SO0000038', '1984-03-01', 89, '859', 14, 'anu', 'test2', 'credit term', '2', 'Incidunt qui quisqu', '1703157652_39ee78a920cdd98badf5.jpg', '2023-12-26', '0', '2023-12-21', '0000-00-00'),
(39, 'SO0000039', '2023-12-26', 89, 'Z', 12, 'anu', 'test2', 'zxczx', '2', 'zxczx', '', '0000-00-00', '0', '2023-12-21', '0000-00-00'),
(40, 'SO0000040', '2023-12-07', 88, 'dsfsd', 13, 'Nulla dolores repreh', 'test1', 'Quasi magnam quam et', '2', 'Dolore perferendis u', '', '0000-00-00', '0', '2023-12-22', '0000-00-00'),
(41, 'SO0000041', '2023-12-12', 89, 'lpo referance', 14, 'anu', 'test2', 'credit term', '2', 'Incidunt qui quisqu', '', '0000-00-00', '0', '2023-12-22', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_sales_product_details`
--

CREATE TABLE `steel_crm_sales_product_details` (
  `spd_id` int(11) NOT NULL,
  `spd_serial_no` int(255) NOT NULL,
  `spd_product_details` varchar(255) NOT NULL,
  `spd_unit` int(255) NOT NULL,
  `spd_quantity` int(255) NOT NULL,
  `spd_rate` int(255) NOT NULL,
  `spd_discount` int(255) NOT NULL,
  `spd_amount` int(255) NOT NULL,
  `spd_amount_in_words` varchar(255) NOT NULL,
  `spd_sales_order` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_sales_product_details`
--

INSERT INTO `steel_crm_sales_product_details` (`spd_id`, `spd_serial_no`, `spd_product_details`, `spd_unit`, `spd_quantity`, `spd_rate`, `spd_discount`, `spd_amount`, `spd_amount_in_words`, `spd_sales_order`) VALUES
(23, 1, 'czxczx', 11, 22, 33, 4, 4, '', 37),
(24, 1, 'czxczx', 11, 22, 33, 4, 4, '', 38),
(25, 1, 'test product detail', 33, 44, 55, 66, 77, '', 40),
(26, 1, 'czxczx', 11, 22, 33, 4, 4, 'Four  ', 41);

-- --------------------------------------------------------

--
-- Table structure for table `steel_employees`
--

CREATE TABLE `steel_employees` (
  `employees_id` int(11) NOT NULL,
  `employees_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_employees`
--

INSERT INTO `steel_employees` (`employees_id`, `employees_name`) VALUES
(1, 'Lorem Ipsum'),
(2, 'simply dummy');

-- --------------------------------------------------------

--
-- Table structure for table `steel_executives_sales_executive`
--

CREATE TABLE `steel_executives_sales_executive` (
  `se_id` int(11) NOT NULL,
  `se_name` varchar(255) NOT NULL,
  `se_added_by` varchar(255) NOT NULL,
  `se_added_date` date DEFAULT NULL,
  `se_modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_executives_sales_executive`
--

INSERT INTO `steel_executives_sales_executive` (`se_id`, `se_name`, `se_added_by`, `se_added_date`, `se_modified_date`) VALUES
(1, 'test1', '', '0000-00-00', '0000-00-00'),
(2, 'test2', '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_master_delivery_term`
--

CREATE TABLE `steel_master_delivery_term` (
  `dt_id` int(11) NOT NULL,
  `dt_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_master_delivery_term`
--

INSERT INTO `steel_master_delivery_term` (`dt_id`, `dt_name`) VALUES
(1, '1'),
(2, '2');

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
-- Indexes for table `steel_accounts_account_heads`
--
ALTER TABLE `steel_accounts_account_heads`
  ADD PRIMARY KEY (`ah_id`);

--
-- Indexes for table `steel_accounts_account_types`
--
ALTER TABLE `steel_accounts_account_types`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `steel_accounts_charts_of_accounts`
--
ALTER TABLE `steel_accounts_charts_of_accounts`
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
-- Indexes for table `steel_crm_contact_details`
--
ALTER TABLE `steel_crm_contact_details`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `steel_crm_customer_creation`
--
ALTER TABLE `steel_crm_customer_creation`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `steel_crm_enquiry`
--
ALTER TABLE `steel_crm_enquiry`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indexes for table `steel_crm_products`
--
ALTER TABLE `steel_crm_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `steel_crm_product_detail`
--
ALTER TABLE `steel_crm_product_detail`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `steel_crm_product_heads`
--
ALTER TABLE `steel_crm_product_heads`
  ADD PRIMARY KEY (`ph_id`);

--
-- Indexes for table `steel_crm_quotation_details`
--
ALTER TABLE `steel_crm_quotation_details`
  ADD PRIMARY KEY (`qd_id`);

--
-- Indexes for table `steel_crm_quotation_product_details`
--
ALTER TABLE `steel_crm_quotation_product_details`
  ADD PRIMARY KEY (`qpd_id`);

--
-- Indexes for table `steel_crm_sales_orders`
--
ALTER TABLE `steel_crm_sales_orders`
  ADD PRIMARY KEY (`so_id`);

--
-- Indexes for table `steel_crm_sales_product_details`
--
ALTER TABLE `steel_crm_sales_product_details`
  ADD PRIMARY KEY (`spd_id`);

--
-- Indexes for table `steel_employees`
--
ALTER TABLE `steel_employees`
  ADD PRIMARY KEY (`employees_id`);

--
-- Indexes for table `steel_executives_sales_executive`
--
ALTER TABLE `steel_executives_sales_executive`
  ADD PRIMARY KEY (`se_id`);

--
-- Indexes for table `steel_master_delivery_term`
--
ALTER TABLE `steel_master_delivery_term`
  ADD PRIMARY KEY (`dt_id`);

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
-- AUTO_INCREMENT for table `steel_accounts_account_heads`
--
ALTER TABLE `steel_accounts_account_heads`
  MODIFY `ah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `steel_accounts_account_types`
--
ALTER TABLE `steel_accounts_account_types`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `steel_accounts_charts_of_accounts`
--
ALTER TABLE `steel_accounts_charts_of_accounts`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `steel_accounts_journal_voucher`
--
ALTER TABLE `steel_accounts_journal_voucher`
  MODIFY `jv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `steel_accounts_payment`
--
ALTER TABLE `steel_accounts_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_accounts_petty_cash_voucher`
--
ALTER TABLE `steel_accounts_petty_cash_voucher`
  MODIFY `pcv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `steel_accounts_receipt`
--
ALTER TABLE `steel_accounts_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_crm_contact_details`
--
ALTER TABLE `steel_crm_contact_details`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `steel_crm_customer_creation`
--
ALTER TABLE `steel_crm_customer_creation`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `steel_crm_enquiry`
--
ALTER TABLE `steel_crm_enquiry`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `steel_crm_products`
--
ALTER TABLE `steel_crm_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `steel_crm_product_detail`
--
ALTER TABLE `steel_crm_product_detail`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `steel_crm_product_heads`
--
ALTER TABLE `steel_crm_product_heads`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `steel_crm_quotation_details`
--
ALTER TABLE `steel_crm_quotation_details`
  MODIFY `qd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `steel_crm_quotation_product_details`
--
ALTER TABLE `steel_crm_quotation_product_details`
  MODIFY `qpd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `steel_crm_sales_orders`
--
ALTER TABLE `steel_crm_sales_orders`
  MODIFY `so_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `steel_crm_sales_product_details`
--
ALTER TABLE `steel_crm_sales_product_details`
  MODIFY `spd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `steel_employees`
--
ALTER TABLE `steel_employees`
  MODIFY `employees_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `steel_executives_sales_executive`
--
ALTER TABLE `steel_executives_sales_executive`
  MODIFY `se_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `steel_master_delivery_term`
--
ALTER TABLE `steel_master_delivery_term`
  MODIFY `dt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
