-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 08:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
  `ah_added_date` date DEFAULT NULL,
  `ah_modified_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_account_heads`
--

INSERT INTO `steel_accounts_account_heads` (`ah_id`, `ah_account_name`, `ah_account_type`, `ah_added_by`, `ah_added_date`, `ah_modified_date`) VALUES
(36, 'Capital', 13, '0', '2023-12-22', '2023-12-23'),
(37, 'Sales Revenue', 13, '0', '2023-12-23', '0000-00-00'),
(38, 'Rent Income', 13, '0', '2023-12-23', '0000-00-00'),
(39, 'Interest Income', 13, '0', '2023-12-23', '0000-00-00'),
(40, 'Salary Expense', 4, '0', '2023-12-23', '0000-00-00'),
(41, 'Repairs And Maintenance', 4, '0', '2023-12-23', '0000-00-00'),
(42, 'Inventory Stock', 6, '0', '2023-12-23', '0000-00-00'),
(43, 'Building', 5, '0', '2023-12-23', '0000-00-00');

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
  `ca_added_date` date DEFAULT NULL,
  `ca_modify_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_charts_of_accounts`
--

INSERT INTO `steel_accounts_charts_of_accounts` (`ca_id`, `ca_account_id`, `ca_name`, `ca_account_type`, `ca_added_by`, `ca_added_date`, `ca_modify_date`) VALUES
(1, '100', 'Property Plant', 43, '', '0000-00-00', '0000-00-00'),
(2, '101', 'Sales', 37, '', '0000-00-00', '0000-00-00'),
(3, '103', 'Consumables', 41, '', '0000-00-00', '0000-00-00'),
(4, '104', 'Products', 42, '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_journal_invoices`
--

CREATE TABLE `steel_accounts_journal_invoices` (
  `ji_id` int(11) NOT NULL,
  `ji_voucher_id` int(11) NOT NULL,
  `ji_sales_order_id` int(11) NOT NULL,
  `ji_account` int(11) NOT NULL,
  `ji_debit` int(11) NOT NULL,
  `ji_credit` int(11) NOT NULL,
  `ji_narration` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_journal_invoices`
--

INSERT INTO `steel_accounts_journal_invoices` (`ji_id`, `ji_voucher_id`, `ji_sales_order_id`, `ji_account`, `ji_debit`, `ji_credit`, `ji_narration`) VALUES
(1, 1, 2, 2, 1000, 0, 'Test'),
(2, 1, 1, 3, 0, 5000, ''),
(3, 2, 2, 1, 1000, 0, 'ttt'),
(4, 2, 1, 3, 0, 1000, 'tt');

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
  `jv_modify_date` date DEFAULT NULL
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
-- Table structure for table `steel_accounts_journal_vouchers`
--

CREATE TABLE `steel_accounts_journal_vouchers` (
  `jv_id` int(11) NOT NULL,
  `jv_voucher_no` varchar(255) DEFAULT NULL,
  `jv_date` date NOT NULL,
  `jv_total` int(11) NOT NULL,
  `jv_added_by` int(255) NOT NULL,
  `jv_added_date` date NOT NULL,
  `jv_modify_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_journal_vouchers`
--

INSERT INTO `steel_accounts_journal_vouchers` (`jv_id`, `jv_voucher_no`, `jv_date`, `jv_total`, `jv_added_by`, `jv_added_date`, `jv_modify_date`) VALUES
(1, 'JV0000001', '2023-12-23', 1000, 0, '2023-12-22', '0000-00-00'),
(2, 'JV0000002', '2023-12-24', 1000, 0, '2023-12-22', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_payments`
--

CREATE TABLE `steel_accounts_payments` (
  `pay_id` int(11) NOT NULL,
  `pay_ref_no` varchar(255) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_credit_account` int(255) NOT NULL,
  `pay_method` int(255) NOT NULL,
  `pay_cheque_no` varchar(255) DEFAULT NULL,
  `pay_cheque_date` date DEFAULT NULL,
  `pay_bank` int(255) NOT NULL,
  `pay_debit_account` int(255) NOT NULL,
  `pay_amount` int(255) NOT NULL,
  `pay_invoice` varchar(255) NOT NULL,
  `pay_narration` text NOT NULL,
  `pay_total` int(255) NOT NULL,
  `pay_amount_word` varchar(255) NOT NULL,
  `pay_print_cheque` varchar(255) NOT NULL,
  `pay_cheque_copy` varchar(255) NOT NULL,
  `pay_added_by` varchar(255) NOT NULL,
  `pay_added_date` date NOT NULL,
  `pay_modify_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_payments`
--

INSERT INTO `steel_accounts_payments` (`pay_id`, `pay_ref_no`, `pay_date`, `pay_credit_account`, `pay_method`, `pay_cheque_no`, `pay_cheque_date`, `pay_bank`, `pay_debit_account`, `pay_amount`, `pay_invoice`, `pay_narration`, `pay_total`, `pay_amount_word`, `pay_print_cheque`, `pay_cheque_copy`, `pay_added_by`, `pay_added_date`, `pay_modify_date`) VALUES
(10, 'PAY0000010', '2023-12-01', 1, 2, NULL, NULL, 1, 0, 2700, '', '', 2700, '', '', '', '1', '2023-12-27', NULL),
(11, 'PAY0000011', '2023-12-15', 1, 2, NULL, NULL, 1, 0, 1200, '', '', 1200, '', '', '', '1', '2023-12-27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_payment_invoices`
--

CREATE TABLE `steel_accounts_payment_invoices` (
  `pi_id` int(11) NOT NULL,
  `pi_payment` int(11) NOT NULL,
  `pi_invoice` int(11) NOT NULL,
  `pi_remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_payment_invoices`
--

INSERT INTO `steel_accounts_payment_invoices` (`pi_id`, `pi_payment`, `pi_invoice`, `pi_remarks`) VALUES
(1, 10, 42, 'By Cash'),
(2, 10, 43, 'By Cash'),
(3, 11, 43, 'No');

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
  `pcv_modify_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_petty_cash_voucher`
--

INSERT INTO `steel_accounts_petty_cash_voucher` (`pcv_id`, `pcv_voucher_no`, `pcv_date`, `pcv_credit_acount_id`, `pcv_sale_order_id`, `pcv_debit_account`, `pcv_amount`, `pcv_narration`, `pcv_total`, `pcv_added_by`, `pcv_added_date`, `pcv_modify_date`) VALUES
(1, 0, '2023-12-01', 0, 0, 0, 50, 'test narration', 100, '0', '2023-12-15', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_receipts`
--

CREATE TABLE `steel_accounts_receipts` (
  `r_id` int(11) NOT NULL,
  `r_ref_no` varchar(255) DEFAULT NULL,
  `r_date` date NOT NULL,
  `r_debit_account` varchar(255) NOT NULL,
  `r_number` varchar(255) NOT NULL,
  `r_method` int(255) NOT NULL,
  `r_cheque_no` varchar(255) DEFAULT NULL,
  `r_cheque_date` date NOT NULL,
  `r_bank` int(255) NOT NULL,
  `r_collected_by` int(255) NOT NULL,
  `r_credit_account` int(255) NOT NULL,
  `r_amount` int(255) NOT NULL,
  `r_invoice` varchar(255) NOT NULL,
  `r_narration` text NOT NULL,
  `r_total` int(255) NOT NULL,
  `r_amount_words` varchar(255) NOT NULL,
  `r_check_copy` varchar(255) NOT NULL,
  `r_added_by` varchar(255) NOT NULL,
  `r_added_date` date NOT NULL,
  `r_modify_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_receipts`
--

INSERT INTO `steel_accounts_receipts` (`r_id`, `r_ref_no`, `r_date`, `r_debit_account`, `r_number`, `r_method`, `r_cheque_no`, `r_cheque_date`, `r_bank`, `r_collected_by`, `r_credit_account`, `r_amount`, `r_invoice`, `r_narration`, `r_total`, `r_amount_words`, `r_check_copy`, `r_added_by`, `r_added_date`, `r_modify_date`) VALUES
(12, 'REC0000012', '2023-11-11', '0', 'REC123', 2, NULL, '0000-00-00', 1, 1, 1, 2700, '', '', 0, '', '', '1', '2023-12-27', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_accounts_receipt_invoices`
--

CREATE TABLE `steel_accounts_receipt_invoices` (
  `ri_id` int(11) NOT NULL,
  `ri_receipt` int(11) NOT NULL,
  `ri_invoice` int(11) NOT NULL,
  `ri_remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_accounts_receipt_invoices`
--

INSERT INTO `steel_accounts_receipt_invoices` (`ri_id`, `ri_receipt`, `ri_invoice`, `ri_remarks`) VALUES
(1, 7, 43, 'Pay before 2029'),
(2, 9, 42, 'Shaj'),
(3, 10, 43, 'Full Paid In Advance'),
(4, 11, 42, 'q'),
(5, 11, 43, 'w'),
(6, 12, 42, 'REC123'),
(7, 12, 43, 'REC123');

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
(46, 'Sunt quasi sed sed ', 'Non consequuntur opt', 0, 'titu@mailinator.com', 90),
(47, 'Pixel Trading', 'Lorem Ipsum is simply dummy', 974, 'pixeltrading@gmail.com', 91),
(48, 'Energy & Industrial Solutions Wll', 'Lorem Ipsum is simply ', 974, 'pixeltrading@gmail.com', 92),
(49, 'Est cum est eiusmod', 'Aperiam dolore cillu', 91, 'voqujig@mailinator.com', 93),
(50, 'Quis et in dolores d', 'Ut et adipisicing te', 11, 'fugajiru@mailinator.com', 93);

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
  `cc_cr_number` varchar(255) NOT NULL,
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
  `cc_modified_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_customer_creation`
--

INSERT INTO `steel_crm_customer_creation` (`cc_id`, `cc_customer_name`, `cc_account_id`, `cc_post_box`, `cc_telephone`, `cc_fax`, `cc_email`, `cc_credit_term`, `cc_credit_period`, `cc_credit_limit`, `cc_account_type`, `cc_cr_number`, `cc_expiry_date`, `cc_attach_cr`, `cc_est_card_no`, `cc_est_expiry_date`, `cc_est_attach_card`, `cc_est_signatory_name`, `cc_card_number`, `cc_id_card_expiry_date`, `cc_id_card`, `cc_added_by`, `cc_added_date`, `cc_modified_date`) VALUES
(92, 'Pixel Trading', 1, '123456', 2147483647, 2147483647, ' pixeltrading@gmail.com', 'Net 30 EOM', 14, 20000, 13, '#123', '2023-12-13', '1703226677_5a6aee923eb1ca987eb5.jpg', '123456', '2023-12-26', '1703226677_cd62258a3db160e108bb.jpeg', 'industry\'s standard dummy', 20, '2023-12-19', '1703226677_a61d45abf384e7462b33.jpg', '0', '2023-12-22', '0000-00-00');

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
(15, 'ENQ0000015', '2023-12-13', 92, 48, 1, '3 days', 'Lorem Ipsum is simply dummy', '#4567', 1, '0', '2023-12-22', '0000-00-00');

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
(1, '4103', 'Alfuzail Steel Bars', 1, '0', '2023-12-27', '0000-00-00'),
(2, '4015', 'Alfuzail Forged Steel', 2, '0', '2023-12-27', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_product_detail`
--

CREATE TABLE `steel_crm_product_detail` (
  `pd_id` int(11) NOT NULL,
  `pd_serial_no` int(255) NOT NULL,
  `pd_product_detail` int(255) NOT NULL,
  `pd_unit` varchar(255) NOT NULL,
  `pd_quantity` int(255) NOT NULL,
  `pd_customer_details` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '4100', 'Steel Bars', '0', '2023-12-27', '0000-00-00'),
(2, '4101', 'Forged Steel', '0', '2023-12-27', '0000-00-00');

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
(17, 'SQ0000017', '2023-12-13', 92, 48, 2, 'Net 30 EOM', 0, 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', '#4567', '0', '2023-12-22', '0000-00-00', 'Lorem Ipsum is simply dummy text', 2, 230, 450, 120, 4);

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_quotation_product_details`
--

CREATE TABLE `steel_crm_quotation_product_details` (
  `qpd_id` int(11) NOT NULL,
  `qpd_serial_no` int(255) NOT NULL,
  `qpd_product_description` int(255) NOT NULL,
  `qpd_unit` varchar(255) NOT NULL,
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
(24, 1, 5, 'Nos', 2, 230, 4, 1200, 17);

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
  `so_total` int(11) NOT NULL,
  `so_added_by` varchar(255) DEFAULT NULL,
  `so_added_date` date NOT NULL,
  `so_modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_crm_sales_orders`
--

INSERT INTO `steel_crm_sales_orders` (`so_id`, `so_order_no`, `so_date`, `so_customer`, `so_lpo`, `so_quotation_ref`, `so_contact_person`, `so_sales_executive`, `so_payment_term`, `so_delivery_term`, `so_project`, `so_lpo_and_drawing`, `so_scheduled_date_of_delivery`, `so_total`, `so_added_by`, `so_added_date`, `so_modified_date`) VALUES
(42, 'SO0000042', '2023-12-05', 92, 'Lorem Ipsum', 17, 'Energy & Industrial Solutions Wll', 'simply dummy text', 'Net 30 EOM', 'dummy text', 'Lorem Ipsum is simply dummy', '1703229371_6eea9fc499dee669c8a3.jpg', '2023-12-19', 1500, '0', '2023-12-22', '0000-00-00'),
(43, 'SO0000043', '2023-12-05', 92, 'Lorem Ipsum', 17, 'Energy & Industrial Solutions Wll', 'simply dummy text', 'Net 30 EOM', 'dummy text', 'Lorem Ipsum is simply dummy', '1703229371_6eea9fc499dee669c8a3.jpg', '2023-12-19', 1200, '0', '2023-12-22', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_crm_sales_product_details`
--

CREATE TABLE `steel_crm_sales_product_details` (
  `spd_id` int(11) NOT NULL,
  `spd_serial_no` int(255) NOT NULL,
  `spd_product_details` varchar(255) NOT NULL,
  `spd_unit` varchar(255) NOT NULL,
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
(0, 1, '', 'Nos', 2, 230, 4, 1200, 'One Thousand Two Hundred ', 0),
(27, 1, 'Supplied aluminium plate, 300 X 100mm X 1.5mm', 'Nos', 2, 230, 4, 1200, 'One Thousand Two Hundred ', 42);

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
(1, 'Elby Varghese'),
(2, 'Shon Mathew');

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
(1, 'Raju Varghese', '', '0000-00-00', '0000-00-00'),
(2, 'Mathew Thomas', '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `steel_master_banks`
--

CREATE TABLE `steel_master_banks` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_master_banks`
--

INSERT INTO `steel_master_banks` (`bank_id`, `bank_name`) VALUES
(1, 'Commercial Bank of Qatar'),
(2, 'Private Bank Of Qatar');

-- --------------------------------------------------------

--
-- Table structure for table `steel_master_collectors`
--

CREATE TABLE `steel_master_collectors` (
  `col_id` int(11) NOT NULL,
  `col_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steel_master_collectors`
--

INSERT INTO `steel_master_collectors` (`col_id`, `col_name`) VALUES
(1, 'Faisel Puthiya Purayil');

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
(1, 'Lorem Ipsum'),
(2, 'dummy text'),
(1, 'Lorem Ipsum'),
(2, 'dummy text'),
(1, 'Lorem Ipsum'),
(2, 'dummy text');

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

--
-- Dumping data for table `steel_master_receipt_method`
--

INSERT INTO `steel_master_receipt_method` (`rm_id`, `rm_name`) VALUES
(1, 'Cheque'),
(2, 'Cash'),
(3, 'Transfer'),
(4, 'L/C');

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
-- Indexes for table `steel_accounts_journal_invoices`
--
ALTER TABLE `steel_accounts_journal_invoices`
  ADD PRIMARY KEY (`ji_id`);

--
-- Indexes for table `steel_accounts_journal_vouchers`
--
ALTER TABLE `steel_accounts_journal_vouchers`
  ADD PRIMARY KEY (`jv_id`);

--
-- Indexes for table `steel_accounts_payments`
--
ALTER TABLE `steel_accounts_payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `steel_accounts_payment_invoices`
--
ALTER TABLE `steel_accounts_payment_invoices`
  ADD PRIMARY KEY (`pi_id`);

--
-- Indexes for table `steel_accounts_receipts`
--
ALTER TABLE `steel_accounts_receipts`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `steel_accounts_receipt_invoices`
--
ALTER TABLE `steel_accounts_receipt_invoices`
  ADD PRIMARY KEY (`ri_id`);

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
-- Indexes for table `steel_master_banks`
--
ALTER TABLE `steel_master_banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `steel_master_collectors`
--
ALTER TABLE `steel_master_collectors`
  ADD PRIMARY KEY (`col_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `steel_accounts_account_heads`
--
ALTER TABLE `steel_accounts_account_heads`
  MODIFY `ah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `steel_accounts_account_types`
--
ALTER TABLE `steel_accounts_account_types`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `steel_accounts_charts_of_accounts`
--
ALTER TABLE `steel_accounts_charts_of_accounts`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `steel_accounts_journal_invoices`
--
ALTER TABLE `steel_accounts_journal_invoices`
  MODIFY `ji_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `steel_accounts_journal_vouchers`
--
ALTER TABLE `steel_accounts_journal_vouchers`
  MODIFY `jv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `steel_accounts_payments`
--
ALTER TABLE `steel_accounts_payments`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `steel_accounts_payment_invoices`
--
ALTER TABLE `steel_accounts_payment_invoices`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `steel_accounts_receipts`
--
ALTER TABLE `steel_accounts_receipts`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `steel_accounts_receipt_invoices`
--
ALTER TABLE `steel_accounts_receipt_invoices`
  MODIFY `ri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `steel_crm_contact_details`
--
ALTER TABLE `steel_crm_contact_details`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `steel_crm_customer_creation`
--
ALTER TABLE `steel_crm_customer_creation`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `steel_crm_enquiry`
--
ALTER TABLE `steel_crm_enquiry`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `steel_crm_products`
--
ALTER TABLE `steel_crm_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `steel_crm_product_detail`
--
ALTER TABLE `steel_crm_product_detail`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `steel_crm_product_heads`
--
ALTER TABLE `steel_crm_product_heads`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
