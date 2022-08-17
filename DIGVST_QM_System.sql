-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2022 at 07:29 PM
-- Server version: 10.4.26-MariaDB-1:10.4.26+maria~deb10
-- PHP Version: 7.3.33-4+0~20220627.98+debian10~1.gbp40b3e4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DIGVST_QM_System`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_events`
--

CREATE TABLE `action_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_id` bigint(20) UNSIGNED NOT NULL,
  `target_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fields` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'running',
  `exception` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `original` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changes` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action_events`
--

INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(1, '92878279-461b-4215-9cc9-39c3d597388c', 1, 'Create', 'App\\Models\\Area', 1, 'App\\Models\\Area', 1, 'App\\Models\\Area', 1, '', 'finished', '', '2021-01-20 01:44:32', '2021-01-20 01:44:32', NULL, '{\"name\":\"Trinidad | North-West\",\"premium_amount\":0,\"id\":1}'),
(2, '9287829d-9954-43b1-bd13-fb3319d97b55', 1, 'Create', 'App\\Models\\Area', 2, 'App\\Models\\Area', 2, 'App\\Models\\Area', 2, '', 'finished', '', '2021-01-20 01:44:56', '2021-01-20 01:44:56', NULL, '{\"name\":\"Trinidad | East-West Corridor\",\"premium_amount\":0,\"id\":2}'),
(3, '928782ac-cd31-435b-a8d5-aabf843929bd', 1, 'Create', 'App\\Models\\Area', 3, 'App\\Models\\Area', 3, 'App\\Models\\Area', 3, '', 'finished', '', '2021-01-20 01:45:06', '2021-01-20 01:45:06', NULL, '{\"name\":\"Trinidad | Central\",\"premium_amount\":0,\"id\":3}'),
(4, '928782c7-c082-4791-8575-65348910b32c', 1, 'Create', 'App\\Models\\Area', 4, 'App\\Models\\Area', 4, 'App\\Models\\Area', 4, '', 'finished', '', '2021-01-20 01:45:23', '2021-01-20 01:45:23', NULL, '{\"name\":\"Trinidad | South-West\",\"premium_amount\":0,\"id\":4}'),
(5, '928782d3-41b2-4abe-b366-ba9a2e09fcca', 1, 'Create', 'App\\Models\\Area', 5, 'App\\Models\\Area', 5, 'App\\Models\\Area', 5, '', 'finished', '', '2021-01-20 01:45:31', '2021-01-20 01:45:31', NULL, '{\"name\":\"Trinidad | East\",\"premium_amount\":0,\"id\":5}'),
(6, '928782fe-bf57-4fa9-b659-865a05564f8b', 1, 'Create', 'App\\Models\\Area', 6, 'App\\Models\\Area', 6, 'App\\Models\\Area', 6, '', 'finished', '', '2021-01-20 01:45:59', '2021-01-20 01:45:59', NULL, '{\"name\":\"Trinidad | North Coast\",\"premium_amount\":0,\"id\":6}'),
(7, '9287830a-f39f-40e4-886c-d9e1e277c361', 1, 'Create', 'App\\Models\\Area', 7, 'App\\Models\\Area', 7, 'App\\Models\\Area', 7, '', 'finished', '', '2021-01-20 01:46:07', '2021-01-20 01:46:07', NULL, '{\"name\":\"Tobago\",\"premium_amount\":0,\"id\":7}'),
(8, '92878335-68b1-451a-88d8-256e30b86177', 1, 'Create', 'App\\Models\\Category', 1, 'App\\Models\\Category', 1, 'App\\Models\\Category', 1, '', 'finished', '', '2021-01-20 01:46:35', '2021-01-20 01:46:35', NULL, '{\"name\":\"Appliance | Large Appliances\",\"premium_amount\":0,\"id\":1}'),
(9, '9287833f-6483-4d41-af91-25e69d9f4f0f', 1, 'Create', 'App\\Models\\Category', 2, 'App\\Models\\Category', 2, 'App\\Models\\Category', 2, '', 'finished', '', '2021-01-20 01:46:42', '2021-01-20 01:46:42', NULL, '{\"name\":\"Appliance | Parts\",\"premium_amount\":0,\"id\":2}'),
(10, '9287834a-15b3-4592-bd83-5e2120e1c64e', 1, 'Create', 'App\\Models\\Category', 3, 'App\\Models\\Category', 3, 'App\\Models\\Category', 3, '', 'finished', '', '2021-01-20 01:46:49', '2021-01-20 01:46:49', NULL, '{\"name\":\"Appliance | Service & Repair\",\"premium_amount\":0,\"id\":3}'),
(11, '92878353-991e-49f4-a248-8e20defbd20c', 1, 'Create', 'App\\Models\\Category', 4, 'App\\Models\\Category', 4, 'App\\Models\\Category', 4, '', 'finished', '', '2021-01-20 01:46:55', '2021-01-20 01:46:55', NULL, '{\"name\":\"Appliance | Small Appliances\",\"premium_amount\":0,\"id\":4}'),
(12, '9287835e-6dcf-4539-a33c-a74d9a2f46c0', 1, 'Create', 'App\\Models\\Category', 5, 'App\\Models\\Category', 5, 'App\\Models\\Category', 5, '', 'finished', '', '2021-01-20 01:47:02', '2021-01-20 01:47:02', NULL, '{\"name\":\"Appliance | Used\",\"premium_amount\":0,\"id\":5}'),
(13, '92878368-7b91-4cf2-8a6b-623f69e81866', 1, 'Create', 'App\\Models\\Category', 6, 'App\\Models\\Category', 6, 'App\\Models\\Category', 6, '', 'finished', '', '2021-01-20 01:47:09', '2021-01-20 01:47:09', NULL, '{\"name\":\"Automotive | Air Conditioning\",\"premium_amount\":0,\"id\":6}'),
(14, '92878372-12b5-497c-a095-a19832c05068', 1, 'Create', 'App\\Models\\Category', 7, 'App\\Models\\Category', 7, 'App\\Models\\Category', 7, '', 'finished', '', '2021-01-20 01:47:15', '2021-01-20 01:47:15', NULL, '{\"name\":\"Automotive | Batteries\",\"premium_amount\":0,\"id\":7}'),
(15, '9287837d-91ce-4326-bb02-00274e80df5c', 1, 'Create', 'App\\Models\\Category', 8, 'App\\Models\\Category', 8, 'App\\Models\\Category', 8, '', 'finished', '', '2021-01-20 01:47:22', '2021-01-20 01:47:22', NULL, '{\"name\":\"Automotive | Body Repair & Painting\",\"premium_amount\":0,\"id\":8}'),
(16, '92878388-c508-4aba-b9f0-66581f574ee9', 1, 'Create', 'App\\Models\\Category', 9, 'App\\Models\\Category', 9, 'App\\Models\\Category', 9, '', 'finished', '', '2021-01-20 01:47:30', '2021-01-20 01:47:30', NULL, '{\"name\":\"Automotive | Cleaning & Detailing\",\"premium_amount\":0,\"id\":9}'),
(17, '92878394-b15c-4a81-a54e-9863e2b7fdc9', 1, 'Create', 'App\\Models\\Category', 10, 'App\\Models\\Category', 10, 'App\\Models\\Category', 10, '', 'finished', '', '2021-01-20 01:47:38', '2021-01-20 01:47:38', NULL, '{\"name\":\"Automotive | Foreign Used\",\"premium_amount\":0,\"id\":10}'),
(18, '9287839d-d092-4122-bcdf-2fc007e005dc', 1, 'Create', 'App\\Models\\Category', 11, 'App\\Models\\Category', 11, 'App\\Models\\Category', 11, '', 'finished', '', '2021-01-20 01:47:43', '2021-01-20 01:47:43', NULL, '{\"name\":\"Automotive | Insurance\",\"premium_amount\":0,\"id\":11}'),
(19, '928783a7-0408-4a14-a432-de9b9083209f', 1, 'Create', 'App\\Models\\Category', 12, 'App\\Models\\Category', 12, 'App\\Models\\Category', 12, '', 'finished', '', '2021-01-20 01:47:50', '2021-01-20 01:47:50', NULL, '{\"name\":\"Automotive | Mechanic\",\"premium_amount\":0,\"id\":12}'),
(20, '928783b4-110f-413d-adc0-9d9fe2f7dd8c', 1, 'Create', 'App\\Models\\Category', 13, 'App\\Models\\Category', 13, 'App\\Models\\Category', 13, '', 'finished', '', '2021-01-20 01:47:58', '2021-01-20 01:47:58', NULL, '{\"name\":\"Automotive | New Cars\",\"premium_amount\":0,\"id\":13}'),
(21, '928783d2-3684-4039-a5a0-5e3de3ee1ff6', 1, 'Create', 'App\\Models\\Category', 14, 'App\\Models\\Category', 14, 'App\\Models\\Category', 14, '', 'finished', '', '2021-01-20 01:48:18', '2021-01-20 01:48:18', NULL, '{\"name\":\"Automotive | New Parts | Audi\",\"premium_amount\":0,\"id\":14}'),
(22, '928783dd-5224-449d-978b-3542fdb77f4a', 1, 'Create', 'App\\Models\\Category', 15, 'App\\Models\\Category', 15, 'App\\Models\\Category', 15, '', 'finished', '', '2021-01-20 01:48:25', '2021-01-20 01:48:25', NULL, '{\"name\":\"Automotive | New Parts | BMW\",\"premium_amount\":0,\"id\":15}'),
(23, '928783e7-dabd-46ef-bacd-724704fcf8ea', 1, 'Create', 'App\\Models\\Category', 16, 'App\\Models\\Category', 16, 'App\\Models\\Category', 16, '', 'finished', '', '2021-01-20 01:48:32', '2021-01-20 01:48:32', NULL, '{\"name\":\"Automotive | New Parts | Chevy\",\"premium_amount\":0,\"id\":16}'),
(24, '928783f0-dc1f-4e6d-9924-5a6b5658deb6', 1, 'Create', 'App\\Models\\Category', 17, 'App\\Models\\Category', 17, 'App\\Models\\Category', 17, '', 'finished', '', '2021-01-20 01:48:38', '2021-01-20 01:48:38', NULL, '{\"name\":\"Automotive | New Parts | Ford\",\"premium_amount\":0,\"id\":17}'),
(25, '928783fc-1b34-49be-987f-7674ab27eb05', 1, 'Create', 'App\\Models\\Category', 18, 'App\\Models\\Category', 18, 'App\\Models\\Category', 18, '', 'finished', '', '2021-01-20 01:48:45', '2021-01-20 01:48:45', NULL, '{\"name\":\"Automotive | New Parts | Honda\",\"premium_amount\":0,\"id\":18}'),
(26, '92878406-8c53-4f00-add8-e8831b132940', 1, 'Create', 'App\\Models\\Category', 19, 'App\\Models\\Category', 19, 'App\\Models\\Category', 19, '', 'finished', '', '2021-01-20 01:48:52', '2021-01-20 01:48:52', NULL, '{\"name\":\"Automotive | New Parts | Hyundai\",\"premium_amount\":0,\"id\":19}'),
(27, '9287840f-978b-417c-b173-7b2938ca17f4', 1, 'Create', 'App\\Models\\Category', 20, 'App\\Models\\Category', 20, 'App\\Models\\Category', 20, '', 'finished', '', '2021-01-20 01:48:58', '2021-01-20 01:48:58', NULL, '{\"name\":\"Automotive | New Parts | Jeep\",\"premium_amount\":0,\"id\":20}'),
(28, '92878418-4838-4c62-852e-daa72a5b4a18', 1, 'Create', 'App\\Models\\Category', 21, 'App\\Models\\Category', 21, 'App\\Models\\Category', 21, '', 'finished', '', '2021-01-20 01:49:04', '2021-01-20 01:49:04', NULL, '{\"name\":\"Automotive | New Parts | Kia\",\"premium_amount\":0,\"id\":21}'),
(29, '92878421-a2e3-4fa6-99c1-9e0bf6eee173', 1, 'Create', 'App\\Models\\Category', 22, 'App\\Models\\Category', 22, 'App\\Models\\Category', 22, '', 'finished', '', '2021-01-20 01:49:10', '2021-01-20 01:49:10', NULL, '{\"name\":\"Automotive | New Parts | Mazda\",\"premium_amount\":0,\"id\":22}'),
(30, '9287842b-d9d1-4d4b-99d9-51147af8d651', 1, 'Create', 'App\\Models\\Category', 23, 'App\\Models\\Category', 23, 'App\\Models\\Category', 23, '', 'finished', '', '2021-01-20 01:49:17', '2021-01-20 01:49:17', NULL, '{\"name\":\"Automotive | New Parts | Mercedes\",\"premium_amount\":0,\"id\":23}'),
(31, '92878435-4690-4034-9cbc-c7e6651e1c3c', 1, 'Create', 'App\\Models\\Category', 24, 'App\\Models\\Category', 24, 'App\\Models\\Category', 24, '', 'finished', '', '2021-01-20 01:49:23', '2021-01-20 01:49:23', NULL, '{\"name\":\"Automotive | New Parts | Mitsubishi\",\"premium_amount\":0,\"id\":24}'),
(32, '92878440-2c26-4e06-8f22-5b79095266a2', 1, 'Create', 'App\\Models\\Category', 25, 'App\\Models\\Category', 25, 'App\\Models\\Category', 25, '', 'finished', '', '2021-01-20 01:49:30', '2021-01-20 01:49:30', NULL, '{\"name\":\"Automotive | New Parts | Nissan\",\"premium_amount\":0,\"id\":25}'),
(33, '92878448-cca1-449a-8733-f985c85e2dca', 1, 'Create', 'App\\Models\\Category', 26, 'App\\Models\\Category', 26, 'App\\Models\\Category', 26, '', 'finished', '', '2021-01-20 01:49:36', '2021-01-20 01:49:36', NULL, '{\"name\":\"Automotive | New Parts | Porsche\",\"premium_amount\":0,\"id\":26}'),
(34, '92878455-63f1-4ea5-87b4-12fb0ce4f331', 1, 'Create', 'App\\Models\\Category', 27, 'App\\Models\\Category', 27, 'App\\Models\\Category', 27, '', 'finished', '', '2021-01-20 01:49:44', '2021-01-20 01:49:44', NULL, '{\"name\":\"Automotive | New Parts | Subaru\",\"premium_amount\":0,\"id\":27}'),
(35, '9287845f-4b99-436f-9e59-03f170186621', 1, 'Create', 'App\\Models\\Category', 28, 'App\\Models\\Category', 28, 'App\\Models\\Category', 28, '', 'finished', '', '2021-01-20 01:49:50', '2021-01-20 01:49:50', NULL, '{\"name\":\"Automotive | New Parts | Suzuki\",\"premium_amount\":0,\"id\":28}'),
(36, '92878473-2279-4357-aa95-6a75b79d7eaf', 1, 'Create', 'App\\Models\\Category', 29, 'App\\Models\\Category', 29, 'App\\Models\\Category', 29, '', 'finished', '', '2021-01-20 01:50:03', '2021-01-20 01:50:03', NULL, '{\"name\":\"Automotive | New Parts | Toyota\",\"premium_amount\":0,\"id\":29}'),
(37, '92878488-1936-475a-bbf2-3567c80abd56', 1, 'Create', 'App\\Models\\Category', 30, 'App\\Models\\Category', 30, 'App\\Models\\Category', 30, '', 'finished', '', '2021-01-20 01:50:17', '2021-01-20 01:50:17', NULL, '{\"name\":\"Automotive | New Parts | Volvo\",\"premium_amount\":0,\"id\":30}'),
(38, '92878491-f4ba-4186-a408-a9659b8b62a8', 1, 'Create', 'App\\Models\\Category', 31, 'App\\Models\\Category', 31, 'App\\Models\\Category', 31, '', 'finished', '', '2021-01-20 01:50:23', '2021-01-20 01:50:23', NULL, '{\"name\":\"Automotive | New Parts | VW\",\"premium_amount\":0,\"id\":31}'),
(39, '9287849a-f084-43ce-b0fb-24af4723ce3b', 1, 'Create', 'App\\Models\\Category', 32, 'App\\Models\\Category', 32, 'App\\Models\\Category', 32, '', 'finished', '', '2021-01-20 01:50:29', '2021-01-20 01:50:29', NULL, '{\"name\":\"Automotive | New Parts | Mini\",\"premium_amount\":0,\"id\":32}'),
(40, '928784a3-2ad8-42ba-86c0-d165a820cc9f', 1, 'Create', 'App\\Models\\Category', 33, 'App\\Models\\Category', 33, 'App\\Models\\Category', 33, '', 'finished', '', '2021-01-20 01:50:35', '2021-01-20 01:50:35', NULL, '{\"name\":\"Automotive | New Parts | Isuzu\",\"premium_amount\":0,\"id\":33}'),
(41, '928784ad-7aa8-4f9f-a28c-9994d6fdedfe', 1, 'Create', 'App\\Models\\Category', 34, 'App\\Models\\Category', 34, 'App\\Models\\Category', 34, '', 'finished', '', '2021-01-20 01:50:42', '2021-01-20 01:50:42', NULL, '{\"name\":\"Automotive | New Parts | Jaguar\",\"premium_amount\":0,\"id\":34}'),
(42, '928784b6-5786-4cdc-82fe-ea5617327bc2', 1, 'Create', 'App\\Models\\Category', 35, 'App\\Models\\Category', 35, 'App\\Models\\Category', 35, '', 'finished', '', '2021-01-20 01:50:47', '2021-01-20 01:50:47', NULL, '{\"name\":\"Automotive | New Parts | Range Rover\",\"premium_amount\":0,\"id\":35}'),
(43, '928784c1-52f8-4f0e-8e9d-a0e8149182f0', 1, 'Create', 'App\\Models\\Category', 36, 'App\\Models\\Category', 36, 'App\\Models\\Category', 36, '', 'finished', '', '2021-01-20 01:50:55', '2021-01-20 01:50:55', NULL, '{\"name\":\"Automotive | New Parts | Other\",\"premium_amount\":0,\"id\":36}'),
(44, '928784ca-a986-4a34-a4d2-5f125807bb57', 1, 'Create', 'App\\Models\\Category', 37, 'App\\Models\\Category', 37, 'App\\Models\\Category', 37, '', 'finished', '', '2021-01-20 01:51:01', '2021-01-20 01:51:01', NULL, '{\"name\":\"Automotive | New Parts | Land Rover\",\"premium_amount\":0,\"id\":37}'),
(45, '928784d3-82ac-4e64-a63e-f15ed83f6568', 1, 'Create', 'App\\Models\\Category', 38, 'App\\Models\\Category', 38, 'App\\Models\\Category', 38, '', 'finished', '', '2021-01-20 01:51:06', '2021-01-20 01:51:06', NULL, '{\"name\":\"Automotive | Rentals\",\"premium_amount\":0,\"id\":38}'),
(46, '928784dc-2a94-4d5c-8cfc-9ee315af585b', 1, 'Create', 'App\\Models\\Category', 39, 'App\\Models\\Category', 39, 'App\\Models\\Category', 39, '', 'finished', '', '2021-01-20 01:51:12', '2021-01-20 01:51:12', NULL, '{\"name\":\"Automotive | Servicing\",\"premium_amount\":0,\"id\":39}'),
(47, '928784e5-91e2-4455-9ef9-0bd718036245', 1, 'Create', 'App\\Models\\Category', 40, 'App\\Models\\Category', 40, 'App\\Models\\Category', 40, '', 'finished', '', '2021-01-20 01:51:18', '2021-01-20 01:51:18', NULL, '{\"name\":\"Automotive | Tyres\",\"premium_amount\":0,\"id\":40}'),
(48, '928784f1-73b3-4496-9861-1d9428aab89b', 1, 'Create', 'App\\Models\\Category', 41, 'App\\Models\\Category', 41, 'App\\Models\\Category', 41, '', 'finished', '', '2021-01-20 01:51:26', '2021-01-20 01:51:26', NULL, '{\"name\":\"Automotive | Used Cars\",\"premium_amount\":0,\"id\":41}'),
(49, '928784fe-9ee0-4340-9019-77e04ed98abf', 1, 'Create', 'App\\Models\\Category', 42, 'App\\Models\\Category', 42, 'App\\Models\\Category', 42, '', 'finished', '', '2021-01-20 01:51:35', '2021-01-20 01:51:35', NULL, '{\"name\":\"Automotive | Used Parts\",\"premium_amount\":0,\"id\":42}'),
(50, '92878507-c45b-48a2-82b8-eedb7e7876cc', 1, 'Create', 'App\\Models\\Category', 43, 'App\\Models\\Category', 43, 'App\\Models\\Category', 43, '', 'finished', '', '2021-01-20 01:51:41', '2021-01-20 01:51:41', NULL, '{\"name\":\"Automotive | Wheels\",\"premium_amount\":0,\"id\":43}'),
(51, '92878533-d488-48ba-a295-d227af590542', 1, 'Create', 'App\\Models\\Category', 44, 'App\\Models\\Category', 44, 'App\\Models\\Category', 44, '', 'finished', '', '2021-01-20 01:52:10', '2021-01-20 01:52:10', NULL, '{\"name\":\"Furniture | Indoor\",\"premium_amount\":0,\"id\":44}'),
(52, '9287853c-1461-4f8c-86a2-167bc719453d', 1, 'Create', 'App\\Models\\Category', 45, 'App\\Models\\Category', 45, 'App\\Models\\Category', 45, '', 'finished', '', '2021-01-20 01:52:15', '2021-01-20 01:52:15', NULL, '{\"name\":\"Furniture | Outdoor\",\"premium_amount\":0,\"id\":45}'),
(53, '92878552-5a3a-45ea-a783-f3c8f009298c', 1, 'Create', 'App\\Models\\Category', 46, 'App\\Models\\Category', 46, 'App\\Models\\Category', 46, '', 'finished', '', '2021-01-20 01:52:30', '2021-01-20 01:52:30', NULL, '{\"name\":\"Furniture | Upholstery\",\"premium_amount\":0,\"id\":46}'),
(54, '9287855e-88c8-4c0b-85cf-d45c7c5c64f3', 1, 'Create', 'App\\Models\\Category', 47, 'App\\Models\\Category', 47, 'App\\Models\\Category', 47, '', 'finished', '', '2021-01-20 01:52:38', '2021-01-20 01:52:38', NULL, '{\"name\":\"Furniture | Upholstery Cleaning\",\"premium_amount\":0,\"id\":47}'),
(55, '9287859a-78d6-4272-9354-3c3a40f77568', 1, 'Create', 'App\\Models\\Category', 48, 'App\\Models\\Category', 48, 'App\\Models\\Category', 48, '', 'finished', '', '2021-01-20 01:53:17', '2021-01-20 01:53:17', NULL, '{\"name\":\"Building | Bathroom Fittings\",\"premium_amount\":0,\"id\":48}'),
(56, '928785a3-ed23-4598-b1c1-bc42cccaf7b3', 1, 'Create', 'App\\Models\\Category', 49, 'App\\Models\\Category', 49, 'App\\Models\\Category', 49, '', 'finished', '', '2021-01-20 01:53:23', '2021-01-20 01:53:23', NULL, '{\"name\":\"Building | General Contractor\",\"premium_amount\":0,\"id\":49}'),
(57, '928785ad-847a-452c-bdac-f93144cf984f', 1, 'Create', 'App\\Models\\Category', 50, 'App\\Models\\Category', 50, 'App\\Models\\Category', 50, '', 'finished', '', '2021-01-20 01:53:29', '2021-01-20 01:53:29', NULL, '{\"name\":\"Building | Hardware\",\"premium_amount\":0,\"id\":50}'),
(58, '928785b8-4265-4516-ae80-26981e44db87', 1, 'Create', 'App\\Models\\Category', 51, 'App\\Models\\Category', 51, 'App\\Models\\Category', 51, '', 'finished', '', '2021-01-20 01:53:36', '2021-01-20 01:53:36', NULL, '{\"name\":\"Building | Kitchen Fittings\",\"premium_amount\":0,\"id\":51}'),
(59, '928785c3-38f3-41b0-bf9b-43b49af6fc5b', 1, 'Create', 'App\\Models\\Category', 52, 'App\\Models\\Category', 52, 'App\\Models\\Category', 52, '', 'finished', '', '2021-01-20 01:53:44', '2021-01-20 01:53:44', NULL, '{\"name\":\"Building | Paint\",\"premium_amount\":0,\"id\":52}'),
(60, '928785ce-061b-42e3-b899-b23740256dda', 1, 'Create', 'App\\Models\\Category', 53, 'App\\Models\\Category', 53, 'App\\Models\\Category', 53, '', 'finished', '', '2021-01-20 01:53:51', '2021-01-20 01:53:51', NULL, '{\"name\":\"Building | Painting Contractor\",\"premium_amount\":0,\"id\":53}'),
(61, '928785d6-bb02-490c-91ba-847190489b38', 1, 'Create', 'App\\Models\\Category', 54, 'App\\Models\\Category', 54, 'App\\Models\\Category', 54, '', 'finished', '', '2021-01-20 01:53:56', '2021-01-20 01:53:56', NULL, '{\"name\":\"Building | Tiles\",\"premium_amount\":0,\"id\":54}'),
(62, '928785e1-793e-42e3-8af4-2fbf086f9809', 1, 'Create', 'App\\Models\\Category', 55, 'App\\Models\\Category', 55, 'App\\Models\\Category', 55, '', 'finished', '', '2021-01-20 01:54:03', '2021-01-20 01:54:03', NULL, '{\"name\":\"Building | Windows\",\"premium_amount\":0,\"id\":55}'),
(63, '928785ec-b984-4708-9c7a-388ba6ff4081', 1, 'Create', 'App\\Models\\Category', 56, 'App\\Models\\Category', 56, 'App\\Models\\Category', 56, '', 'finished', '', '2021-01-20 01:54:11', '2021-01-20 01:54:11', NULL, '{\"name\":\"Building | Doors\",\"premium_amount\":0,\"id\":56}'),
(64, '928886d3-d8ff-4e7a-8712-2c504e5e182a', 1, 'Create', 'App\\Models\\Category', 57, 'App\\Models\\Category', 57, 'App\\Models\\Category', 57, '', 'finished', '', '2021-01-20 13:52:32', '2021-01-20 13:52:32', NULL, '{\"name\":\"Test Category\",\"premium_amount\":0,\"id\":57}'),
(65, '92893fc6-e8d0-4f3f-bc93-4be32c871e7e', 1, 'Delete', 'App\\Models\\Supplier', 6, 'App\\Models\\Supplier', 6, 'App\\Models\\Supplier', 6, '', 'finished', '', '2021-01-20 22:29:41', '2021-01-20 22:29:41', NULL, NULL),
(66, '92894a0c-b4d3-4da3-a57a-11ed9e9317a4', 1, 'Create', 'App\\Models\\Category', 58, 'App\\Models\\Category', 58, 'App\\Models\\Category', 58, '', 'finished', '', '2021-01-20 22:58:25', '2021-01-20 22:58:25', NULL, '{\"name\":\"IT | WiFi\",\"premium_amount\":0,\"id\":58}'),
(67, '92894b67-4bf3-4cf1-90a4-82fb6a491bd4', 1, 'Create', 'App\\Models\\Category', 59, 'App\\Models\\Category', 59, 'App\\Models\\Category', 59, '', 'finished', '', '2021-01-20 23:02:12', '2021-01-20 23:02:12', NULL, '{\"name\":\"Beauty | Microblading\",\"premium_amount\":0,\"id\":59}'),
(68, '92894b80-6d43-4764-9483-a7a005cb89fb', 1, 'Create', 'App\\Models\\Category', 60, 'App\\Models\\Category', 60, 'App\\Models\\Category', 60, '', 'finished', '', '2021-01-20 23:02:28', '2021-01-20 23:02:28', NULL, '{\"name\":\"Business Services | Customer Service Training\",\"premium_amount\":0,\"id\":60}'),
(69, '92894cb4-5515-4a0d-a80c-b82e31b40307', 1, 'Create', 'App\\Models\\Category', 61, 'App\\Models\\Category', 61, 'App\\Models\\Category', 61, '', 'finished', '', '2021-01-20 23:05:50', '2021-01-20 23:05:50', NULL, '{\"name\":\"Events | Catering\",\"premium_amount\":0,\"id\":61}'),
(70, '92894cd6-e108-4b41-a474-6826b8ee7cea', 1, 'Create', 'App\\Models\\Category', 62, 'App\\Models\\Category', 62, 'App\\Models\\Category', 62, '', 'finished', '', '2021-01-20 23:06:13', '2021-01-20 23:06:13', NULL, '{\"name\":\"Events | Rentals\",\"premium_amount\":0,\"id\":62}'),
(71, '92894cde-7e29-4aa8-b044-90b52254120f', 1, 'Create', 'App\\Models\\Category', 63, 'App\\Models\\Category', 63, 'App\\Models\\Category', 63, '', 'finished', '', '2021-01-20 23:06:18', '2021-01-20 23:06:18', NULL, '{\"name\":\"Events | Bar Service\",\"premium_amount\":0,\"id\":63}'),
(72, '92894ce6-24c1-4540-8135-68f4f343c5be', 1, 'Create', 'App\\Models\\Category', 64, 'App\\Models\\Category', 64, 'App\\Models\\Category', 64, '', 'finished', '', '2021-01-20 23:06:23', '2021-01-20 23:06:23', NULL, '{\"name\":\"Events | Bar Supplies\",\"premium_amount\":0,\"id\":64}'),
(73, '92894ced-ae1a-4a93-ade5-0915ea9542cb', 1, 'Create', 'App\\Models\\Category', 65, 'App\\Models\\Category', 65, 'App\\Models\\Category', 65, '', 'finished', '', '2021-01-20 23:06:28', '2021-01-20 23:06:28', NULL, '{\"name\":\"Events | Chairs & Tables\",\"premium_amount\":0,\"id\":65}'),
(74, '92894cf5-1594-473c-b84f-7a41ff193367', 1, 'Create', 'App\\Models\\Category', 66, 'App\\Models\\Category', 66, 'App\\Models\\Category', 66, '', 'finished', '', '2021-01-20 23:06:33', '2021-01-20 23:06:33', NULL, '{\"name\":\"Events | DJs\",\"premium_amount\":0,\"id\":66}'),
(75, '92894cfc-7928-443e-b6e2-6c949ada1d4b', 1, 'Create', 'App\\Models\\Category', 67, 'App\\Models\\Category', 67, 'App\\Models\\Category', 67, '', 'finished', '', '2021-01-20 23:06:37', '2021-01-20 23:06:37', NULL, '{\"name\":\"Events | Fans & Cooling\",\"premium_amount\":0,\"id\":67}'),
(76, '92894d04-6eb3-44d1-92b5-ce5e04452464', 1, 'Create', 'App\\Models\\Category', 68, 'App\\Models\\Category', 68, 'App\\Models\\Category', 68, '', 'finished', '', '2021-01-20 23:06:43', '2021-01-20 23:06:43', NULL, '{\"name\":\"Events | Lights\",\"premium_amount\":0,\"id\":68}'),
(77, '92894d0c-3c1d-4970-a743-28b4dcc276b7', 1, 'Create', 'App\\Models\\Category', 69, 'App\\Models\\Category', 69, 'App\\Models\\Category', 69, '', 'finished', '', '2021-01-20 23:06:48', '2021-01-20 23:06:48', NULL, '{\"name\":\"Events | Photography\",\"premium_amount\":0,\"id\":69}'),
(78, '92894d14-85a1-4b97-b54f-70d82fc9b580', 1, 'Create', 'App\\Models\\Category', 70, 'App\\Models\\Category', 70, 'App\\Models\\Category', 70, '', 'finished', '', '2021-01-20 23:06:53', '2021-01-20 23:06:53', NULL, '{\"name\":\"Events | Planning & Management\",\"premium_amount\":0,\"id\":70}'),
(79, '92894d1d-950e-403c-9fe6-35cb1d328695', 1, 'Create', 'App\\Models\\Category', 71, 'App\\Models\\Category', 71, 'App\\Models\\Category', 71, '', 'finished', '', '2021-01-20 23:06:59', '2021-01-20 23:06:59', NULL, '{\"name\":\"Events | Tents\",\"premium_amount\":0,\"id\":71}'),
(80, '92894d2a-27e8-4aba-a15c-5b35f52bff4c', 1, 'Create', 'App\\Models\\Category', 72, 'App\\Models\\Category', 72, 'App\\Models\\Category', 72, '', 'finished', '', '2021-01-20 23:07:07', '2021-01-20 23:07:07', NULL, '{\"name\":\"Events | Venues\",\"premium_amount\":0,\"id\":72}'),
(81, '92894dcc-dbab-4435-a637-69d8699e7aba', 1, 'Update', 'App\\Models\\Supplier', 4, 'App\\Models\\Supplier', 4, 'App\\Models\\Supplier', 4, '', 'finished', '', '2021-01-20 23:08:54', '2021-01-20 23:08:54', '[]', '[]'),
(82, '92895250-98c7-4bfa-ada0-6b50b81ce908', 1, 'Create', 'App\\Models\\Category', 73, 'App\\Models\\Category', 73, 'App\\Models\\Category', 73, '', 'finished', '', '2021-01-20 23:21:31', '2021-01-20 23:21:31', NULL, '{\"name\":\"Lawyer\",\"premium_amount\":0,\"id\":73}'),
(83, '928974d2-e936-4ab1-9221-0b82ddabb889', 1, 'Update', 'App\\Models\\Message', 2, 'App\\Models\\Message', 2, 'App\\Models\\Message', 2, '', 'finished', '', '2021-01-21 00:58:01', '2021-01-21 00:58:01', '{\"text\":\"<strong>Hello, **SupplierName!<\\/strong><br><br> You\'ve got a new request:<br> **RequestDetailLink\"}', '{\"text\":\"<div><strong>Hello, **SupplierName!<\\/strong><br><br> You\'ve got a new request:<br> **RequestDetailLink<\\/div>\"}'),
(84, '9289993a-bd6c-4501-baf5-6a4c1484c687', 1, 'Reset User Password', 'App\\Models\\Supplier', 9, 'App\\Models\\Supplier', 9, 'App\\Models\\Supplier', 9, 'a:0:{}', 'finished', '', '2021-01-21 02:39:49', '2021-01-21 02:39:49', NULL, NULL),
(85, '92899b0b-2276-4781-82a7-35410cc5dba6', 1, 'Delete', 'App\\Models\\Request', 13, 'App\\Models\\Request', 13, 'App\\Models\\Request', 13, '', 'finished', '', '2021-01-21 02:44:53', '2021-01-21 02:44:53', NULL, NULL),
(86, '92899b12-d92f-49ed-91fe-4d6c076cb0ce', 1, 'Delete', 'App\\Models\\Request', 12, 'App\\Models\\Request', 12, 'App\\Models\\Request', 12, '', 'finished', '', '2021-01-21 02:44:58', '2021-01-21 02:44:58', NULL, NULL),
(87, '92899b1a-d79e-41ff-8c14-09b5f9047f8d', 1, 'Delete', 'App\\Models\\Request', 11, 'App\\Models\\Request', 11, 'App\\Models\\Request', 11, '', 'finished', '', '2021-01-21 02:45:04', '2021-01-21 02:45:04', NULL, NULL),
(88, '92899b24-239a-439d-b1f2-3e9e7a1358c0', 1, 'Delete', 'App\\Models\\Request', 10, 'App\\Models\\Request', 10, 'App\\Models\\Request', 10, '', 'finished', '', '2021-01-21 02:45:10', '2021-01-21 02:45:10', NULL, NULL),
(89, '92899b2a-b11b-4410-94c6-0ab70620d363', 1, 'Delete', 'App\\Models\\Request', 9, 'App\\Models\\Request', 9, 'App\\Models\\Request', 9, '', 'finished', '', '2021-01-21 02:45:14', '2021-01-21 02:45:14', NULL, NULL),
(90, '92899bbb-497e-4a13-ae02-2f40138c0a4d', 1, 'Update', 'App\\Models\\Supplier', 9, 'App\\Models\\Supplier', 9, 'App\\Models\\Supplier', 9, '', 'finished', '', '2021-01-21 02:46:49', '2021-01-21 02:46:49', '{\"password\":\"Shamrock6473\"}', '{\"password\":\"$2y$10$880c2ZC.XGirTCegf7uSWOekagDZJX1Wjdzu9vepE6xE.3PBpvEZ.\"}'),
(91, '92899dde-b1a4-4722-9a0e-037ecb23b1df', 1, 'Update', 'App\\Models\\Plan', 1, 'App\\Models\\Plan', 1, 'App\\Models\\Plan', 1, '', 'finished', '', '2021-01-21 02:52:47', '2021-01-21 02:52:47', '{\"name\":\"BurlyWood\",\"credits_amount\":492,\"price\":48}', '{\"name\":\"100 Pack\",\"credits_amount\":\"100\",\"price\":\"25.00\"}'),
(92, '92899e0d-f3a0-4ee0-843e-cdcd0971eefb', 1, 'Update', 'App\\Models\\Plan', 2, 'App\\Models\\Plan', 2, 'App\\Models\\Plan', 2, '', 'finished', '', '2021-01-21 02:53:18', '2021-01-21 02:53:18', '{\"name\":\"RoyalBlue\",\"credits_amount\":364,\"price\":75}', '{\"name\":\"250 Pack\",\"credits_amount\":\"250\",\"price\":\"60.00\"}'),
(93, '92899e31-c3a2-4c6e-87b6-0a883c6f00ba', 1, 'Update', 'App\\Models\\Plan', 3, 'App\\Models\\Plan', 3, 'App\\Models\\Plan', 3, '', 'finished', '', '2021-01-21 02:53:42', '2021-01-21 02:53:42', '{\"name\":\"BurlyWood\",\"credits_amount\":272,\"price\":39}', '{\"name\":\"500 Pack\",\"credits_amount\":\"500\",\"price\":\"110.00\"}'),
(94, '92899e58-82e9-4803-be74-ebc4234248ec', 1, 'Update', 'App\\Models\\Plan', 4, 'App\\Models\\Plan', 4, 'App\\Models\\Plan', 4, '', 'finished', '', '2021-01-21 02:54:07', '2021-01-21 02:54:07', '{\"name\":\"Olive\",\"credits_amount\":378,\"price\":94}', '{\"name\":\"1000 Pack\",\"credits_amount\":\"1000\",\"price\":\"200.00\"}'),
(95, '92899e7b-9c9b-4ad9-aa54-daa2678109c4', 1, 'Update', 'App\\Models\\Plan', 5, 'App\\Models\\Plan', 5, 'App\\Models\\Plan', 5, '', 'finished', '', '2021-01-21 02:54:30', '2021-01-21 02:54:30', '{\"name\":\"Aqua\",\"credits_amount\":217,\"price\":89}', '{\"name\":\"5000 Pack\",\"credits_amount\":\"5000\",\"price\":\"750.00\"}'),
(96, '928a5998-d600-43fc-b915-4f24912eb13c', 1, 'Delete', 'App\\Models\\Supplier', 10, 'App\\Models\\Supplier', 10, 'App\\Models\\Supplier', 10, '', 'finished', '', '2021-01-21 11:37:43', '2021-01-21 11:37:43', NULL, NULL),
(97, '928a59b4-2600-46f4-8d2d-0282f31bd1fb', 1, 'Delete', 'App\\Models\\Supplier', 5, 'App\\Models\\Supplier', 5, 'App\\Models\\Supplier', 5, '', 'finished', '', '2021-01-21 11:38:01', '2021-01-21 11:38:01', NULL, NULL),
(98, '928a59dc-bdc0-445c-9915-be4863bd5af8', 1, 'Delete', 'App\\Models\\Supplier', 4, 'App\\Models\\Supplier', 4, 'App\\Models\\Supplier', 4, '', 'finished', '', '2021-01-21 11:38:27', '2021-01-21 11:38:27', NULL, NULL),
(99, '928a5d47-ba41-49a1-a4f9-767d6dc8fa38', 1, 'Delete', 'App\\Models\\Supplier', 12, 'App\\Models\\Supplier', 12, 'App\\Models\\Supplier', 12, '', 'finished', '', '2021-01-21 11:48:01', '2021-01-21 11:48:01', NULL, NULL),
(100, '928af72f-292a-49a3-8ccc-e4fac7894ecc', 1, 'Create', 'App\\Models\\Category', 74, 'App\\Models\\Category', 74, 'App\\Models\\Category', 74, '', 'finished', '', '2021-01-21 18:58:22', '2021-01-21 18:58:22', NULL, '{\"name\":\"Food & Drink | Wine\",\"premium_amount\":0,\"id\":74}'),
(101, '928af740-4db9-4c6e-a847-55d9a78dc888', 1, 'Create', 'App\\Models\\Category', 75, 'App\\Models\\Category', 75, 'App\\Models\\Category', 75, '', 'finished', '', '2021-01-21 18:58:33', '2021-01-21 18:58:33', NULL, '{\"name\":\"Food & Drink | Spirits\",\"premium_amount\":0,\"id\":75}'),
(102, '928af74c-1d37-43b3-963e-23c5837e6ab3', 1, 'Create', 'App\\Models\\Category', 76, 'App\\Models\\Category', 76, 'App\\Models\\Category', 76, '', 'finished', '', '2021-01-21 18:58:41', '2021-01-21 18:58:41', NULL, '{\"name\":\"Food & Drink | Beer\",\"premium_amount\":0,\"id\":76}'),
(103, '928af75e-9196-41ac-88a3-8cdffd90670d', 1, 'Create', 'App\\Models\\Category', 77, 'App\\Models\\Category', 77, 'App\\Models\\Category', 77, '', 'finished', '', '2021-01-21 18:58:53', '2021-01-21 18:58:53', NULL, '{\"name\":\"Food & Drink | Mixers\",\"premium_amount\":0,\"id\":77}'),
(104, '928af7c4-3120-4eda-b903-bdb64afae68d', 1, 'Create', 'App\\Models\\Category', 78, 'App\\Models\\Category', 78, 'App\\Models\\Category', 78, '', 'finished', '', '2021-01-21 18:59:59', '2021-01-21 18:59:59', NULL, '{\"name\":\"Food & Drink | Gourmet Ingredients\",\"premium_amount\":0,\"id\":78}'),
(105, '928af83c-00bf-4352-8514-b41060570ea5', 1, 'Create', 'App\\Models\\Category', 79, 'App\\Models\\Category', 79, 'App\\Models\\Category', 79, '', 'finished', '', '2021-01-21 19:01:18', '2021-01-21 19:01:18', NULL, '{\"name\":\"Food & Drink | Steaks and Meat\",\"premium_amount\":0,\"id\":79}'),
(106, '928af868-16a4-4f69-9e77-a3ace7ca3481', 1, 'Create', 'App\\Models\\Category', 80, 'App\\Models\\Category', 80, 'App\\Models\\Category', 80, '', 'finished', '', '2021-01-21 19:01:47', '2021-01-21 19:01:47', NULL, '{\"name\":\"Food & Drink | Fish\",\"premium_amount\":0,\"id\":80}'),
(107, '928af887-a34b-4bf0-ac3f-56794af3e84e', 1, 'Create', 'App\\Models\\Category', 81, 'App\\Models\\Category', 81, 'App\\Models\\Category', 81, '', 'finished', '', '2021-01-21 19:02:07', '2021-01-21 19:02:07', NULL, '{\"name\":\"Food & Drink | Poultry\",\"premium_amount\":0,\"id\":81}'),
(108, '928d15d2-d733-42d0-b96d-57171d87d79f', 1, 'Delete', 'App\\Models\\Request', 17, 'App\\Models\\Request', 17, 'App\\Models\\Request', 17, '', 'finished', '', '2021-01-22 20:15:41', '2021-01-22 20:15:41', NULL, NULL),
(109, '928d15d9-1b2f-493f-92cd-05c5e7664d5c', 1, 'Delete', 'App\\Models\\Request', 15, 'App\\Models\\Request', 15, 'App\\Models\\Request', 15, '', 'finished', '', '2021-01-22 20:15:45', '2021-01-22 20:15:45', NULL, NULL),
(110, '928d15e1-7e6d-4dd1-b9a2-39ef34cf51af', 1, 'Delete', 'App\\Models\\Request', 14, 'App\\Models\\Request', 14, 'App\\Models\\Request', 14, '', 'finished', '', '2021-01-22 20:15:51', '2021-01-22 20:15:51', NULL, NULL),
(111, '92b03583-388d-4b66-a9cf-c568da2fec35', 1, 'Update', 'App\\Models\\Supplier', 14, 'App\\Models\\Supplier', 14, 'App\\Models\\Supplier', 14, '', 'finished', '', '2021-02-09 07:18:16', '2021-02-09 07:18:16', '[]', '[]'),
(112, '92b038af-8797-4286-9795-a4bd6dfdefc1', 1, 'Complimentary Credits', 'App\\Models\\Supplier', 7, 'App\\Models\\Supplier', 7, 'App\\Models\\Supplier', 7, 'a:1:{s:6:\"amount\";s:2:\"10\";}', 'finished', '', '2021-02-09 07:27:09', '2021-02-09 07:27:09', NULL, NULL),
(113, '92b03f6e-e8ef-4117-bb07-9191e3f798b8', 1, 'Delete', 'App\\Models\\Request', 22, 'App\\Models\\Request', 22, 'App\\Models\\Request', 22, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(114, '92b03f6e-f0d4-4fee-95a7-6c0dc009c33c', 1, 'Delete', 'App\\Models\\Request', 23, 'App\\Models\\Request', 23, 'App\\Models\\Request', 23, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(115, '92b03f6e-f5d2-4af7-b96d-6a5eb889d597', 1, 'Delete', 'App\\Models\\Request', 24, 'App\\Models\\Request', 24, 'App\\Models\\Request', 24, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(116, '92b03f6e-f9f2-4e0f-8671-a170639bc0ad', 1, 'Delete', 'App\\Models\\Request', 25, 'App\\Models\\Request', 25, 'App\\Models\\Request', 25, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(117, '92b03f6e-ff93-4348-854e-e7dbedfa7538', 1, 'Delete', 'App\\Models\\Request', 26, 'App\\Models\\Request', 26, 'App\\Models\\Request', 26, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(118, '92b03f6f-052d-49cd-9dd1-8bdae4c1aff1', 1, 'Delete', 'App\\Models\\Request', 27, 'App\\Models\\Request', 27, 'App\\Models\\Request', 27, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(119, '92b03f6f-0b5e-4c1b-b504-b734b23fc6d9', 1, 'Delete', 'App\\Models\\Request', 28, 'App\\Models\\Request', 28, 'App\\Models\\Request', 28, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(120, '92b03f6f-1076-4071-9c8a-3924bc6e875c', 1, 'Delete', 'App\\Models\\Request', 29, 'App\\Models\\Request', 29, 'App\\Models\\Request', 29, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(121, '92b03f6f-154c-4b42-9765-5f09b8b2f217', 1, 'Delete', 'App\\Models\\Request', 30, 'App\\Models\\Request', 30, 'App\\Models\\Request', 30, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(122, '92b03f6f-1fa1-44cc-8253-678e04f8dd06', 1, 'Delete', 'App\\Models\\Request', 31, 'App\\Models\\Request', 31, 'App\\Models\\Request', 31, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(123, '92b03f6f-2517-44b1-a4c2-02c44bea14e9', 1, 'Delete', 'App\\Models\\Request', 32, 'App\\Models\\Request', 32, 'App\\Models\\Request', 32, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(124, '92b03f6f-2ace-4794-84c1-b7e82d0795d5', 1, 'Delete', 'App\\Models\\Request', 33, 'App\\Models\\Request', 33, 'App\\Models\\Request', 33, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(125, '92b03f6f-2fb4-4611-acfc-503fd7c0c432', 1, 'Delete', 'App\\Models\\Request', 34, 'App\\Models\\Request', 34, 'App\\Models\\Request', 34, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(126, '92b03f6f-33d1-408e-ace8-d7ed0c1541f5', 1, 'Delete', 'App\\Models\\Request', 35, 'App\\Models\\Request', 35, 'App\\Models\\Request', 35, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(127, '92b03f6f-3c39-4400-a696-94e8e1c765c5', 1, 'Delete', 'App\\Models\\Request', 36, 'App\\Models\\Request', 36, 'App\\Models\\Request', 36, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(128, '92b03f6f-43f1-4ee3-a383-4b0184f6cf46', 1, 'Delete', 'App\\Models\\Request', 37, 'App\\Models\\Request', 37, 'App\\Models\\Request', 37, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(129, '92b03f6f-498d-45e1-a114-5ed29c1d2a5b', 1, 'Delete', 'App\\Models\\Request', 38, 'App\\Models\\Request', 38, 'App\\Models\\Request', 38, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(130, '92b03f6f-4e9a-4588-a315-2305dcf79a73', 1, 'Delete', 'App\\Models\\Request', 39, 'App\\Models\\Request', 39, 'App\\Models\\Request', 39, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(131, '92b03f6f-53f3-4ef9-bacb-da910afb25b8', 1, 'Delete', 'App\\Models\\Request', 40, 'App\\Models\\Request', 40, 'App\\Models\\Request', 40, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(132, '92b03f6f-5cad-46e6-84ea-9280a91c5d8e', 1, 'Delete', 'App\\Models\\Request', 41, 'App\\Models\\Request', 41, 'App\\Models\\Request', 41, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(133, '92b03f6f-61d5-4bf5-84fa-6ba2716f72a1', 1, 'Delete', 'App\\Models\\Request', 42, 'App\\Models\\Request', 42, 'App\\Models\\Request', 42, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(134, '92b03f6f-66fb-4d10-8962-3d86db73a63a', 1, 'Delete', 'App\\Models\\Request', 43, 'App\\Models\\Request', 43, 'App\\Models\\Request', 43, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(135, '92b03f6f-6c40-403a-a716-66870cadc0d5', 1, 'Delete', 'App\\Models\\Request', 44, 'App\\Models\\Request', 44, 'App\\Models\\Request', 44, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(136, '92b03f6f-716a-4856-808c-ef1c1c744348', 1, 'Delete', 'App\\Models\\Request', 45, 'App\\Models\\Request', 45, 'App\\Models\\Request', 45, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(137, '92b03f6f-7eca-4e54-a243-1c3c8212ac7d', 1, 'Delete', 'App\\Models\\Request', 46, 'App\\Models\\Request', 46, 'App\\Models\\Request', 46, '', 'finished', '', '2021-02-09 07:46:01', '2021-02-09 07:46:01', NULL, NULL),
(138, '92b03f88-c018-4741-80d8-d84226483fe3', 1, 'Delete', 'App\\Models\\Request', 19, 'App\\Models\\Request', 19, 'App\\Models\\Request', 19, '', 'finished', '', '2021-02-09 07:46:18', '2021-02-09 07:46:18', NULL, NULL),
(139, '92b03f88-cf72-4e58-a142-407073e111d0', 1, 'Delete', 'App\\Models\\Request', 20, 'App\\Models\\Request', 20, 'App\\Models\\Request', 20, '', 'finished', '', '2021-02-09 07:46:18', '2021-02-09 07:46:18', NULL, NULL),
(140, '92b03f88-d3ee-42de-98b5-044851408f92', 1, 'Delete', 'App\\Models\\Request', 21, 'App\\Models\\Request', 21, 'App\\Models\\Request', 21, '', 'finished', '', '2021-02-09 07:46:18', '2021-02-09 07:46:18', NULL, NULL),
(141, '92b0b0ab-4bea-467a-a24d-8a900e97d203', 1, 'Complimentary Credits', 'App\\Models\\Supplier', 7, 'App\\Models\\Supplier', 7, 'App\\Models\\Supplier', 7, 'a:1:{s:6:\"amount\";s:2:\"10\";}', 'finished', '', '2021-02-09 13:02:39', '2021-02-09 13:02:39', NULL, NULL),
(142, '92b0b2a4-0b34-47c8-b05b-ad68b5f49da6', 1, 'Update', 'App\\Models\\Supplier', 14, 'App\\Models\\Supplier', 14, 'App\\Models\\Supplier', 14, '', 'finished', '', '2021-02-09 13:08:09', '2021-02-09 13:08:09', '[]', '[]'),
(143, '92b40d9b-3198-407f-a226-d6044676c4c4', 1, 'Update', 'App\\Models\\Supplier', 14, 'App\\Models\\Supplier', 14, 'App\\Models\\Supplier', 14, '', 'finished', '', '2021-02-11 05:10:00', '2021-02-11 05:10:00', '{\"disabled\":false}', '{\"disabled\":true}'),
(144, '92b40f9b-8eef-4cc4-956d-53d56a26ee44', 1, 'Create', 'App\\Models\\Supplier', 15, 'App\\Models\\Supplier', 15, 'App\\Models\\Supplier', 15, '', 'finished', '', '2021-02-11 05:15:36', '2021-02-11 05:15:36', NULL, '{\"name\":\"Reliable Appliance Parts & Service Ltd\",\"email\":\"info@reliableappliances.net\",\"phone\":\"+18686221406\",\"updated_at\":\"2021-02-11T05:15:35.000000Z\",\"created_at\":\"2021-02-11T05:15:35.000000Z\",\"id\":15}'),
(145, '92b41020-6063-4527-8ca3-5ef2bce9a3b0', 1, 'Create', 'App\\Models\\Supplier', 16, 'App\\Models\\Supplier', 16, 'App\\Models\\Supplier', 16, '', 'finished', '', '2021-02-11 05:17:03', '2021-02-11 05:17:03', NULL, '{\"name\":\"General Appliance Parts & Service\",\"email\":\"gapsparts@hotmail.com\",\"phone\":\"+18686537877\",\"updated_at\":\"2021-02-11T05:17:02.000000Z\",\"created_at\":\"2021-02-11T05:17:02.000000Z\",\"id\":16}'),
(146, '92b41115-8a90-4b55-9ba7-8bff8c7f77cf', 1, 'Create', 'App\\Models\\Supplier', 17, 'App\\Models\\Supplier', 17, 'App\\Models\\Supplier', 17, '', 'finished', '', '2021-02-11 05:19:43', '2021-02-11 05:19:43', NULL, '{\"name\":\"Parts World Ltd\",\"email\":\"aedoo@partsworldltd.com\",\"phone\":\"+18686382570\",\"updated_at\":\"2021-02-11T05:19:43.000000Z\",\"created_at\":\"2021-02-11T05:19:43.000000Z\",\"id\":17}'),
(147, '92b411a3-5009-4159-9e52-ebfed153a355', 1, 'Create', 'App\\Models\\Supplier', 18, 'App\\Models\\Supplier', 18, 'App\\Models\\Supplier', 18, '', 'finished', '', '2021-02-11 05:21:16', '2021-02-11 05:21:16', NULL, '{\"name\":\"M & M Rampersad Ltd\",\"email\":\"mmrampersad_ltd@hotmail.com\",\"phone\":\"+18686570354\",\"updated_at\":\"2021-02-11T05:21:16.000000Z\",\"created_at\":\"2021-02-11T05:21:16.000000Z\",\"id\":18}'),
(148, '92b41289-c94e-489c-a908-d8e786eb8ea1', 1, 'Create', 'App\\Models\\Supplier', 19, 'App\\Models\\Supplier', 19, 'App\\Models\\Supplier', 19, '', 'finished', '', '2021-02-11 05:23:47', '2021-02-11 05:23:47', NULL, '{\"name\":\"Just Repair Appliance Parts & Services\",\"email\":\"jr_appliancerepair@hotmail.com\",\"phone\":\"+18683653277\",\"updated_at\":\"2021-02-11T05:23:47.000000Z\",\"created_at\":\"2021-02-11T05:23:47.000000Z\",\"id\":19}'),
(149, '92b41303-1af2-4b94-9414-ccbb32abfaab', 1, 'Create', 'App\\Models\\Supplier', 20, 'App\\Models\\Supplier', 20, 'App\\Models\\Supplier', 20, '', 'finished', '', '2021-02-11 05:25:07', '2021-02-11 05:25:07', NULL, '{\"name\":\"Hamlet Appliance Parts & Repair Services\",\"email\":\"hamletappliance@hotmail.com\",\"phone\":\"+18686747118\",\"updated_at\":\"2021-02-11T05:25:07.000000Z\",\"created_at\":\"2021-02-11T05:25:07.000000Z\",\"id\":20}'),
(150, '92b413a5-f03e-41bf-be28-11c7fd8cfc4f', 1, 'Create', 'App\\Models\\Supplier', 21, 'App\\Models\\Supplier', 21, 'App\\Models\\Supplier', 21, '', 'finished', '', '2021-02-11 05:26:54', '2021-02-11 05:26:54', NULL, '{\"name\":\"The Appliance Store BY FENS\",\"email\":\"info@fenstt.com\",\"phone\":\"+18686503367\",\"updated_at\":\"2021-02-11T05:26:53.000000Z\",\"created_at\":\"2021-02-11T05:26:53.000000Z\",\"id\":21}'),
(151, '92b414f6-19e9-4030-8b5c-10cb825166dd', 1, 'Create', 'App\\Models\\Supplier', 22, 'App\\Models\\Supplier', 22, 'App\\Models\\Supplier', 22, '', 'finished', '', '2021-02-11 05:30:34', '2021-02-11 05:30:34', NULL, '{\"name\":\"Aga Khan Intl. Ltd\",\"email\":\"agakhan.intl@gmail.com\",\"phone\":\"+18686257868\",\"updated_at\":\"2021-02-11T05:30:34.000000Z\",\"created_at\":\"2021-02-11T05:30:34.000000Z\",\"id\":22}'),
(152, '92b41657-b16c-4dd8-8b4c-3e2e63a9e0a9', 1, 'Create', 'App\\Models\\Supplier', 23, 'App\\Models\\Supplier', 23, 'App\\Models\\Supplier', 23, '', 'finished', '', '2021-02-11 05:34:26', '2021-02-11 05:34:26', NULL, '{\"name\":\"American Stores\",\"email\":\"customerservice@americanstores.tt\",\"phone\":\"+18686247732\",\"updated_at\":\"2021-02-11T05:34:25.000000Z\",\"created_at\":\"2021-02-11T05:34:25.000000Z\",\"id\":23}'),
(153, '92b41791-6c42-4566-9732-f10166029482', 1, 'Create', 'App\\Models\\Supplier', 24, 'App\\Models\\Supplier', 24, 'App\\Models\\Supplier', 24, '', 'finished', '', '2021-02-11 05:37:51', '2021-02-11 05:37:51', NULL, '{\"name\":\"Price Warehouse\",\"email\":\"pricewarehouse@yahoo.com\",\"phone\":\"+18682845344\",\"updated_at\":\"2021-02-11T05:37:51.000000Z\",\"created_at\":\"2021-02-11T05:37:51.000000Z\",\"id\":24}'),
(154, '92b41839-4b36-4392-b7f7-43865701f602', 1, 'Create', 'App\\Models\\Supplier', 25, 'App\\Models\\Supplier', 25, 'App\\Models\\Supplier', 25, '', 'finished', '', '2021-02-11 05:39:41', '2021-02-11 05:39:41', NULL, '{\"name\":\"Lewis Appliances\",\"email\":\"info@lewisappliances.com\",\"phone\":\"+18686230386\",\"updated_at\":\"2021-02-11T05:39:41.000000Z\",\"created_at\":\"2021-02-11T05:39:41.000000Z\",\"id\":25}'),
(155, '92b41933-bcf4-41b3-9b26-dfe6d889fd84', 1, 'Create', 'App\\Models\\Supplier', 26, 'App\\Models\\Supplier', 26, 'App\\Models\\Supplier', 26, '', 'finished', '', '2021-02-11 05:42:25', '2021-02-11 05:42:25', NULL, '{\"name\":\"The Red Store\",\"email\":\"redstorett@gmail.com\",\"phone\":\"+18682651631\",\"updated_at\":\"2021-02-11T05:42:25.000000Z\",\"created_at\":\"2021-02-11T05:42:25.000000Z\",\"id\":26}'),
(156, '92b41965-074d-4bcb-b89b-b5c029f6b3eb', 1, 'Update', 'App\\Models\\Supplier', 21, 'App\\Models\\Supplier', 21, 'App\\Models\\Supplier', 21, '', 'finished', '', '2021-02-11 05:42:58', '2021-02-11 05:42:58', '[]', '[]'),
(157, '92b4198d-e982-4e24-a7db-fd7c8d051e17', 1, 'Delete', 'App\\Models\\Request', 47, 'App\\Models\\Request', 47, 'App\\Models\\Request', 47, '', 'finished', '', '2021-02-11 05:43:24', '2021-02-11 05:43:24', NULL, NULL),
(158, '92b41a75-2dee-458f-b0ae-af72317dfa80', 1, 'Create', 'App\\Models\\Category', 82, 'App\\Models\\Category', 82, 'App\\Models\\Category', 82, '', 'finished', '', '2021-02-11 05:45:56', '2021-02-11 05:45:56', NULL, '{\"name\":\"Home Goods\",\"premium_amount\":0,\"id\":82}'),
(159, '92c9871c-cc94-4b5d-a63e-a1ede32ded8d', 1, 'Complimentary Credits', 'App\\Models\\Supplier', 27, 'App\\Models\\Supplier', 27, 'App\\Models\\Supplier', 27, 'a:1:{s:6:\"amount\";s:2:\"10\";}', 'finished', '', '2021-02-21 21:22:08', '2021-02-21 21:22:08', NULL, NULL),
(160, '92ca0456-94ab-49c0-9c12-3c0a68e8b62a', 1, 'Complimentary Credits', 'App\\Models\\Supplier', 28, 'App\\Models\\Supplier', 28, 'App\\Models\\Supplier', 28, 'a:1:{s:6:\"amount\";s:2:\"10\";}', 'finished', '', '2021-02-22 03:12:18', '2021-02-22 03:12:18', NULL, NULL),
(161, '92cb9219-3e41-4439-ba9f-6f5a1fe23b21', 1, 'Complimentary Credits', 'App\\Models\\Supplier', 29, 'App\\Models\\Supplier', 29, 'App\\Models\\Supplier', 29, 'a:1:{s:6:\"amount\";s:2:\"10\";}', 'finished', '', '2021-02-22 21:44:31', '2021-02-22 21:44:31', NULL, NULL),
(162, '92cf2440-7eb3-4a1a-a87f-f8ea61383d3c', 1, 'Create', 'App\\Models\\Category', 83, 'App\\Models\\Category', 83, 'App\\Models\\Category', 83, '', 'finished', '', '2021-02-24 16:20:40', '2021-02-24 16:20:40', NULL, '{\"name\":\"Home | Air Conditioning\",\"premium_amount\":0,\"id\":83}'),
(163, '92cf2458-f288-4c9f-a58d-ca0bd564c298', 1, 'Create', 'App\\Models\\Category', 84, 'App\\Models\\Category', 84, 'App\\Models\\Category', 84, '', 'finished', '', '2021-02-24 16:20:56', '2021-02-24 16:20:56', NULL, '{\"name\":\"Home | Air Conditioning Service\",\"premium_amount\":0,\"id\":84}'),
(164, '92cf248e-2507-46f7-97f9-21cf1802ab50', 1, 'Create', 'App\\Models\\Category', 85, 'App\\Models\\Category', 85, 'App\\Models\\Category', 85, '', 'finished', '', '2021-02-24 16:21:31', '2021-02-24 16:21:31', NULL, '{\"name\":\"Home | Pressure Washing Service\",\"premium_amount\":0,\"id\":85}'),
(165, '92cf24d9-a4bb-4bf5-956f-efc457a46f0f', 1, 'Update', 'App\\Models\\Category', 85, 'App\\Models\\Category', 85, 'App\\Models\\Category', 85, '', 'finished', '', '2021-02-24 16:22:21', '2021-02-24 16:22:21', '{\"name\":\"Home | Pressure Washing Service\"}', '{\"name\":\"Pressure Washing Service\"}'),
(166, '92cf24ef-f0f3-4521-a1d9-e223cc171298', 1, 'Update', 'App\\Models\\Category', 84, 'App\\Models\\Category', 84, 'App\\Models\\Category', 84, '', 'finished', '', '2021-02-24 16:22:35', '2021-02-24 16:22:35', '{\"name\":\"Home | Air Conditioning Service\"}', '{\"name\":\"Air Conditioning Service\"}'),
(167, '92cf250c-1b32-49c9-9867-2dbc862e5667', 1, 'Update', 'App\\Models\\Category', 83, 'App\\Models\\Category', 83, 'App\\Models\\Category', 83, '', 'finished', '', '2021-02-24 16:22:54', '2021-02-24 16:22:54', '{\"name\":\"Home | Air Conditioning\"}', '{\"name\":\"Air Conditioning\"}'),
(168, '92cf2521-aa87-4939-90fd-4c485e72ca79', 1, 'Create', 'App\\Models\\Category', 86, 'App\\Models\\Category', 86, 'App\\Models\\Category', 86, '', 'finished', '', '2021-02-24 16:23:08', '2021-02-24 16:23:08', NULL, '{\"name\":\"Plumber\",\"premium_amount\":0,\"id\":86}'),
(169, '92cf252a-74eb-445b-a62a-7ad24e04b2ee', 1, 'Create', 'App\\Models\\Category', 87, 'App\\Models\\Category', 87, 'App\\Models\\Category', 87, '', 'finished', '', '2021-02-24 16:23:14', '2021-02-24 16:23:14', NULL, '{\"name\":\"Welder\",\"premium_amount\":0,\"id\":87}'),
(170, '92cf2532-98f6-4b8e-bc89-be470d881348', 1, 'Create', 'App\\Models\\Category', 88, 'App\\Models\\Category', 88, 'App\\Models\\Category', 88, '', 'finished', '', '2021-02-24 16:23:19', '2021-02-24 16:23:19', NULL, '{\"name\":\"Carpenter\",\"premium_amount\":0,\"id\":88}'),
(171, '92cf253e-0af1-4ac9-9e48-dc08658dd947', 1, 'Create', 'App\\Models\\Category', 89, 'App\\Models\\Category', 89, 'App\\Models\\Category', 89, '', 'finished', '', '2021-02-24 16:23:27', '2021-02-24 16:23:27', NULL, '{\"name\":\"Electrician\",\"premium_amount\":0,\"id\":89}'),
(172, '92cf2558-f5c7-4722-9f98-deac9c560b04', 1, 'Create', 'App\\Models\\Category', 90, 'App\\Models\\Category', 90, 'App\\Models\\Category', 90, '', 'finished', '', '2021-02-24 16:23:44', '2021-02-24 16:23:44', NULL, '{\"name\":\"Pool Cleaning\",\"premium_amount\":0,\"id\":90}'),
(173, '92d91c32-cf66-4f06-9fbf-846fec32c0b0', 1, 'Complimentary Credits', 'App\\Models\\Supplier', 30, 'App\\Models\\Supplier', 30, 'App\\Models\\Supplier', 30, 'a:1:{s:6:\"amount\";s:2:\"10\";}', 'finished', '', '2021-03-01 15:16:26', '2021-03-01 15:16:26', NULL, NULL),
(174, '92d91c40-5e7a-4988-8390-40df179b2f6e', 1, 'Complimentary Credits', 'App\\Models\\Supplier', 31, 'App\\Models\\Supplier', 31, 'App\\Models\\Supplier', 31, 'a:1:{s:6:\"amount\";s:2:\"10\";}', 'finished', '', '2021-03-01 15:16:35', '2021-03-01 15:16:35', NULL, NULL),
(175, '92d91c48-e2a1-4869-b1a3-acd52f0eecad', 1, 'Complimentary Credits', 'App\\Models\\Supplier', 32, 'App\\Models\\Supplier', 32, 'App\\Models\\Supplier', 32, 'a:1:{s:6:\"amount\";s:2:\"10\";}', 'finished', '', '2021-03-01 15:16:40', '2021-03-01 15:16:40', NULL, NULL),
(176, '92d91c52-5a19-4ff3-b72e-7b0fb7a7d990', 1, 'Complimentary Credits', 'App\\Models\\Supplier', 33, 'App\\Models\\Supplier', 33, 'App\\Models\\Supplier', 33, 'a:1:{s:6:\"amount\";s:2:\"10\";}', 'finished', '', '2021-03-01 15:16:47', '2021-03-01 15:16:47', NULL, NULL);
INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(177, '92d91d70-d9d1-4aca-9bae-aeafc60c339f', 1, 'Update', 'App\\Models\\Message', 2, 'App\\Models\\Message', 2, 'App\\Models\\Message', 2, '', 'finished', '', '2021-03-01 15:19:54', '2021-03-01 15:19:54', '{\"text\":\"<div><strong>Hello, **SupplierName!<\\/strong><br><br> You\'ve got a new request:<br> **RequestDetailLink<\\/div>\"}', '{\"text\":\"<div><strong>Hello, **SupplierName!<\\/strong><br><br> You\'ve got a new request for **RequestCategory :<br><br>**RequestDescription<br><br>Respond to it using your QuoteMe Dashboard :&nbsp; **RequestDetailLink<\\/div>\"}'),
(178, '92d91d96-61c3-49b5-a0f2-5220aa533146', 1, 'Update', 'App\\Models\\Message', 5, 'App\\Models\\Message', 5, 'App\\Models\\Message', 5, '', 'finished', '', '2021-03-01 15:20:19', '2021-03-01 15:20:19', '{\"text\":\"Hello, **SupplierName! You\'ve got the new request: **RequestDetailLink\"}', '{\"text\":\"<div>Hello, **SupplierName! You\'ve got the new **RequestCategory request: **RequestDetailLink<\\/div>\"}'),
(179, '92d91db0-bd8b-40be-aca9-05038e262d6f', 1, 'Update', 'App\\Models\\Message', 5, 'App\\Models\\Message', 5, 'App\\Models\\Message', 5, '', 'finished', '', '2021-03-01 15:20:36', '2021-03-01 15:20:36', '{\"text\":\"<div>Hello, **SupplierName! You\'ve got the new **RequestCategory request: **RequestDetailLink<\\/div>\"}', '{\"text\":\"<div>Hello, **SupplierName! You\'ve got a new **RequestCategory request: **RequestDetailLink<\\/div>\"}'),
(180, '92de1707-0cf0-4353-990d-1215ffd7d5f4', 1, 'Update', 'App\\Models\\Category', 36, 'App\\Models\\Category', 36, 'App\\Models\\Category', 36, '', 'finished', '', '2021-03-04 02:41:07', '2021-03-04 02:41:07', '{\"name\":\"Automotive | New Parts | Other\"}', '{\"name\":\"Automotive | New Parts\"}'),
(181, '92de1748-a717-4471-852f-dc9a09b4a9c1', 1, 'Update', 'App\\Models\\Supplier', 33, 'App\\Models\\Supplier', 33, 'App\\Models\\Supplier', 33, '', 'finished', '', '2021-03-04 02:41:50', '2021-03-04 02:41:50', '[]', '[]'),
(182, '92de1777-b20b-4689-8a00-128a72dd4cb3', 1, 'Update', 'App\\Models\\Supplier', 32, 'App\\Models\\Supplier', 32, 'App\\Models\\Supplier', 32, '', 'finished', '', '2021-03-04 02:42:21', '2021-03-04 02:42:21', '[]', '[]'),
(183, '92de17bb-ab13-4072-b672-9160a139bfde', 1, 'Update', 'App\\Models\\Supplier', 29, 'App\\Models\\Supplier', 29, 'App\\Models\\Supplier', 29, '', 'finished', '', '2021-03-04 02:43:05', '2021-03-04 02:43:05', '[]', '[]'),
(184, '92de17f1-12cb-4e9d-87e7-56e8ad86bec0', 1, 'Update', 'App\\Models\\Supplier', 27, 'App\\Models\\Supplier', 27, 'App\\Models\\Supplier', 27, '', 'finished', '', '2021-03-04 02:43:40', '2021-03-04 02:43:40', '[]', '[]'),
(185, '92de183f-cef1-4750-860c-fff11c5b9b8f', 1, 'Delete', 'App\\Models\\Category', 28, 'App\\Models\\Category', 28, 'App\\Models\\Category', 28, '', 'finished', '', '2021-03-04 02:44:32', '2021-03-04 02:44:32', NULL, NULL),
(186, '92de183f-d686-4f55-afec-41b51b126e64', 1, 'Delete', 'App\\Models\\Category', 29, 'App\\Models\\Category', 29, 'App\\Models\\Category', 29, '', 'finished', '', '2021-03-04 02:44:32', '2021-03-04 02:44:32', NULL, NULL),
(187, '92de183f-dcac-4409-8f62-9b8293195751', 1, 'Delete', 'App\\Models\\Category', 30, 'App\\Models\\Category', 30, 'App\\Models\\Category', 30, '', 'finished', '', '2021-03-04 02:44:32', '2021-03-04 02:44:32', NULL, NULL),
(188, '92de183f-e309-4f6a-8c19-7148aef59f3f', 1, 'Delete', 'App\\Models\\Category', 34, 'App\\Models\\Category', 34, 'App\\Models\\Category', 34, '', 'finished', '', '2021-03-04 02:44:32', '2021-03-04 02:44:32', NULL, NULL),
(189, '92de184f-4142-4204-a829-79efea6b69aa', 1, 'Delete', 'App\\Models\\Category', 24, 'App\\Models\\Category', 24, 'App\\Models\\Category', 24, '', 'finished', '', '2021-03-04 02:44:42', '2021-03-04 02:44:42', NULL, NULL),
(190, '92de188c-2a9a-403b-939a-148dc4cbbb7b', 1, 'Delete', 'App\\Models\\Category', 14, 'App\\Models\\Category', 14, 'App\\Models\\Category', 14, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(191, '92de188c-345c-4421-89d9-750acc070015', 1, 'Delete', 'App\\Models\\Category', 15, 'App\\Models\\Category', 15, 'App\\Models\\Category', 15, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(192, '92de188c-3bff-4cc6-b5b7-421ec3db9d01', 1, 'Delete', 'App\\Models\\Category', 16, 'App\\Models\\Category', 16, 'App\\Models\\Category', 16, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(193, '92de188c-44fa-4ca3-82b1-84805483f47a', 1, 'Delete', 'App\\Models\\Category', 17, 'App\\Models\\Category', 17, 'App\\Models\\Category', 17, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(194, '92de188c-4b2c-4b2d-b872-57fc0968aa98', 1, 'Delete', 'App\\Models\\Category', 18, 'App\\Models\\Category', 18, 'App\\Models\\Category', 18, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(195, '92de188c-51d0-495e-ab64-43b646562d72', 1, 'Delete', 'App\\Models\\Category', 19, 'App\\Models\\Category', 19, 'App\\Models\\Category', 19, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(196, '92de188c-57cc-4453-b00d-b6349ec394eb', 1, 'Delete', 'App\\Models\\Category', 20, 'App\\Models\\Category', 20, 'App\\Models\\Category', 20, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(197, '92de188c-5f0c-481a-8c3e-992ceb4ec400', 1, 'Delete', 'App\\Models\\Category', 21, 'App\\Models\\Category', 21, 'App\\Models\\Category', 21, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(198, '92de188c-63c9-44df-919c-75c0beb59de9', 1, 'Delete', 'App\\Models\\Category', 22, 'App\\Models\\Category', 22, 'App\\Models\\Category', 22, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(199, '92de188c-68f0-4509-a6f7-0dbafeaee7d8', 1, 'Delete', 'App\\Models\\Category', 23, 'App\\Models\\Category', 23, 'App\\Models\\Category', 23, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(200, '92de188c-7077-41cd-8842-205d6a25bee3', 1, 'Delete', 'App\\Models\\Category', 25, 'App\\Models\\Category', 25, 'App\\Models\\Category', 25, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(201, '92de188c-7777-445a-a2a5-5f140a2b6c97', 1, 'Delete', 'App\\Models\\Category', 26, 'App\\Models\\Category', 26, 'App\\Models\\Category', 26, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(202, '92de188c-7e32-4c43-927a-a2e12e67b382', 1, 'Delete', 'App\\Models\\Category', 27, 'App\\Models\\Category', 27, 'App\\Models\\Category', 27, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(203, '92de188c-8837-4fa8-93ae-6e3c5e862c9a', 1, 'Delete', 'App\\Models\\Category', 31, 'App\\Models\\Category', 31, 'App\\Models\\Category', 31, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(204, '92de188c-956b-4c0e-9fca-2d293ebcbbd6', 1, 'Delete', 'App\\Models\\Category', 32, 'App\\Models\\Category', 32, 'App\\Models\\Category', 32, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(205, '92de188c-a133-4554-9ee6-2f73d9244309', 1, 'Delete', 'App\\Models\\Category', 33, 'App\\Models\\Category', 33, 'App\\Models\\Category', 33, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(206, '92de188c-aa73-4e0b-8cea-5506e36e2b22', 1, 'Delete', 'App\\Models\\Category', 35, 'App\\Models\\Category', 35, 'App\\Models\\Category', 35, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(207, '92de188c-b96c-4506-ada8-0efadbe4af74', 1, 'Delete', 'App\\Models\\Category', 37, 'App\\Models\\Category', 37, 'App\\Models\\Category', 37, '', 'finished', '', '2021-03-04 02:45:22', '2021-03-04 02:45:22', NULL, NULL),
(208, '92df05c3-2895-4b3f-bfaa-cdcefa38ce0b', 1, 'Delete', 'App\\Models\\Request', 49, 'App\\Models\\Request', 49, 'App\\Models\\Request', 49, '', 'finished', '', '2021-03-04 13:48:40', '2021-03-04 13:48:40', NULL, NULL),
(209, '9321961f-9f96-47a3-9276-70393a9786f1', 1, 'Delete', 'App\\Models\\Supplier', 37, 'App\\Models\\Supplier', 37, 'App\\Models\\Supplier', 37, '', 'finished', '', '2021-04-06 15:56:58', '2021-04-06 15:56:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `premium_amount` decimal(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `premium_amount`, `deleted_at`) VALUES
(1, 'Trinidad | North-West', '0.00', NULL),
(2, 'Trinidad | East-West Corridor', '0.00', NULL),
(3, 'Trinidad | Central', '0.00', NULL),
(4, 'Trinidad | South-West', '0.00', NULL),
(5, 'Trinidad | East', '0.00', NULL),
(6, 'Trinidad | North Coast', '0.00', NULL),
(7, 'Tobago', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `premium_amount` decimal(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `premium_amount`, `deleted_at`) VALUES
(1, 'Appliance | Large Appliances', '0.00', NULL),
(2, 'Appliance | Parts', '0.00', NULL),
(3, 'Appliance | Service & Repair', '0.00', NULL),
(4, 'Appliance | Small Appliances', '0.00', NULL),
(5, 'Appliance | Used', '0.00', NULL),
(6, 'Automotive | Air Conditioning', '0.00', NULL),
(7, 'Automotive | Batteries', '0.00', NULL),
(8, 'Automotive | Body Repair & Painting', '0.00', NULL),
(9, 'Automotive | Cleaning & Detailing', '0.00', NULL),
(10, 'Automotive | Foreign Used', '0.00', NULL),
(11, 'Automotive | Insurance', '0.00', NULL),
(12, 'Automotive | Mechanic', '0.00', NULL),
(13, 'Automotive | New Cars', '0.00', NULL),
(14, 'Automotive | New Parts | Audi', '0.00', '2021-03-04 02:45:22'),
(15, 'Automotive | New Parts | BMW', '0.00', '2021-03-04 02:45:22'),
(16, 'Automotive | New Parts | Chevy', '0.00', '2021-03-04 02:45:22'),
(17, 'Automotive | New Parts | Ford', '0.00', '2021-03-04 02:45:22'),
(18, 'Automotive | New Parts | Honda', '0.00', '2021-03-04 02:45:22'),
(19, 'Automotive | New Parts | Hyundai', '0.00', '2021-03-04 02:45:22'),
(20, 'Automotive | New Parts | Jeep', '0.00', '2021-03-04 02:45:22'),
(21, 'Automotive | New Parts | Kia', '0.00', '2021-03-04 02:45:22'),
(22, 'Automotive | New Parts | Mazda', '0.00', '2021-03-04 02:45:22'),
(23, 'Automotive | New Parts | Mercedes', '0.00', '2021-03-04 02:45:22'),
(24, 'Automotive | New Parts | Mitsubishi', '0.00', '2021-03-04 02:44:42'),
(25, 'Automotive | New Parts | Nissan', '0.00', '2021-03-04 02:45:22'),
(26, 'Automotive | New Parts | Porsche', '0.00', '2021-03-04 02:45:22'),
(27, 'Automotive | New Parts | Subaru', '0.00', '2021-03-04 02:45:22'),
(28, 'Automotive | New Parts | Suzuki', '0.00', '2021-03-04 02:44:32'),
(29, 'Automotive | New Parts | Toyota', '0.00', '2021-03-04 02:44:32'),
(30, 'Automotive | New Parts | Volvo', '0.00', '2021-03-04 02:44:32'),
(31, 'Automotive | New Parts | VW', '0.00', '2021-03-04 02:45:22'),
(32, 'Automotive | New Parts | Mini', '0.00', '2021-03-04 02:45:22'),
(33, 'Automotive | New Parts | Isuzu', '0.00', '2021-03-04 02:45:22'),
(34, 'Automotive | New Parts | Jaguar', '0.00', '2021-03-04 02:44:32'),
(35, 'Automotive | New Parts | Range Rover', '0.00', '2021-03-04 02:45:22'),
(36, 'Automotive | New Parts', '0.00', NULL),
(37, 'Automotive | New Parts | Land Rover', '0.00', '2021-03-04 02:45:22'),
(38, 'Automotive | Rentals', '0.00', NULL),
(39, 'Automotive | Servicing', '0.00', NULL),
(40, 'Automotive | Tyres', '0.00', NULL),
(41, 'Automotive | Used Cars', '0.00', NULL),
(42, 'Automotive | Used Parts', '0.00', NULL),
(43, 'Automotive | Wheels', '0.00', NULL),
(44, 'Furniture | Indoor', '0.00', NULL),
(45, 'Furniture | Outdoor', '0.00', NULL),
(46, 'Furniture | Upholstery', '0.00', NULL),
(47, 'Furniture | Upholstery Cleaning', '0.00', NULL),
(48, 'Building | Bathroom Fittings', '0.00', NULL),
(49, 'Building | General Contractor', '0.00', NULL),
(50, 'Building | Hardware', '0.00', NULL),
(51, 'Building | Kitchen Fittings', '0.00', NULL),
(52, 'Building | Paint', '0.00', NULL),
(53, 'Building | Painting Contractor', '0.00', NULL),
(54, 'Building | Tiles', '0.00', NULL),
(55, 'Building | Windows', '0.00', NULL),
(56, 'Building | Doors', '0.00', NULL),
(57, 'Test Category', '0.00', NULL),
(58, 'IT | WiFi', '0.00', NULL),
(59, 'Beauty | Microblading', '0.00', NULL),
(60, 'Business Services | Customer Service Training', '0.00', NULL),
(61, 'Events | Catering', '0.00', NULL),
(62, 'Events | Rentals', '0.00', NULL),
(63, 'Events | Bar Service', '0.00', NULL),
(64, 'Events | Bar Supplies', '0.00', NULL),
(65, 'Events | Chairs & Tables', '0.00', NULL),
(66, 'Events | DJs', '0.00', NULL),
(67, 'Events | Fans & Cooling', '0.00', NULL),
(68, 'Events | Lights', '0.00', NULL),
(69, 'Events | Photography', '0.00', NULL),
(70, 'Events | Planning & Management', '0.00', NULL),
(71, 'Events | Tents', '0.00', NULL),
(72, 'Events | Venues', '0.00', NULL),
(73, 'Lawyer', '0.00', NULL),
(74, 'Food & Drink | Wine', '0.00', NULL),
(75, 'Food & Drink | Spirits', '0.00', NULL),
(76, 'Food & Drink | Beer', '0.00', NULL),
(77, 'Food & Drink | Mixers', '0.00', NULL),
(78, 'Food & Drink | Gourmet Ingredients', '0.00', NULL),
(79, 'Food & Drink | Steaks and Meat', '0.00', NULL),
(80, 'Food & Drink | Fish', '0.00', NULL),
(81, 'Food & Drink | Poultry', '0.00', NULL),
(82, 'Home Goods', '0.00', NULL),
(83, 'Air Conditioning', '0.00', NULL),
(84, 'Air Conditioning Service', '0.00', NULL),
(85, 'Pressure Washing Service', '0.00', NULL),
(86, 'Plumber', '0.00', NULL),
(87, 'Welder', '0.00', NULL),
(88, 'Carpenter', '0.00', NULL),
(89, 'Electrician', '0.00', NULL),
(90, 'Pool Cleaning', '0.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `credit_transactions`
--

CREATE TABLE `credit_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `successful` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_transactions`
--

INSERT INTO `credit_transactions` (`id`, `user_id`, `model_id`, `model_type`, `amount`, `description`, `successful`, `created_at`, `updated_at`) VALUES
(4, 9, 8, 'App\\Models\\Request', -1, 'Quick Notify', 0, '2021-01-21 00:38:24', '2021-01-21 00:38:24'),
(5, 7, 4, 'App\\Models\\Response', 0, 'Normal Reply', 1, '2021-01-21 00:50:08', '2021-01-21 00:50:08'),
(6, 7, 5, 'App\\Models\\Response', 0, 'Normal Reply', 1, '2021-01-21 01:01:02', '2021-01-21 01:01:02'),
(7, 7, 6, 'App\\Models\\Response', 0, 'Normal Reply', 1, '2021-01-21 01:06:25', '2021-01-21 01:06:25'),
(8, 7, 12, 'App\\Models\\Request', -1, 'Quick Notify', 0, '2021-01-21 01:09:46', '2021-01-21 01:09:46'),
(9, 7, 13, 'App\\Models\\Request', -1, 'Quick Notify', 0, '2021-01-21 01:31:55', '2021-01-21 01:31:55'),
(10, 7, 14, 'App\\Models\\Request', -1, 'Quick Notify', 0, '2021-01-21 02:49:41', '2021-01-21 02:49:41'),
(11, 9, 7, 'App\\Models\\Response', 0, 'Normal Reply', 1, '2021-01-21 04:23:42', '2021-01-21 04:23:42'),
(12, 7, 8, 'App\\Models\\Response', 0, 'Normal Reply', 1, '2021-01-21 19:47:31', '2021-01-21 19:47:31'),
(13, 7, NULL, NULL, 250, 'Buy Credits', 0, '2021-01-28 15:52:43', '2021-01-28 15:52:43'),
(14, 7, NULL, NULL, 250, 'Buy Credits', 0, '2021-01-28 15:53:29', '2021-01-28 15:53:29'),
(15, 14, 20, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-01 15:43:06', '2021-02-01 15:43:06'),
(16, 7, 21, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:07:04', '2021-02-09 01:07:04'),
(17, 7, 22, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:07:15', '2021-02-09 01:07:15'),
(18, 7, 23, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:07:19', '2021-02-09 01:07:19'),
(19, 7, 24, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:07:23', '2021-02-09 01:07:23'),
(20, 14, 25, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:08:48', '2021-02-09 01:08:48'),
(21, 14, 26, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:09:19', '2021-02-09 01:09:19'),
(22, 7, 27, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:10:46', '2021-02-09 01:10:46'),
(23, 7, 28, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:18:48', '2021-02-09 01:18:48'),
(24, 7, 29, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:18:52', '2021-02-09 01:18:52'),
(25, 7, 30, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:18:55', '2021-02-09 01:18:55'),
(26, 7, 31, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:19:01', '2021-02-09 01:19:01'),
(27, 7, 32, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 01:19:06', '2021-02-09 01:19:06'),
(28, 7, 33, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 05:01:20', '2021-02-09 05:01:20'),
(29, 7, 34, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 05:03:59', '2021-02-09 05:03:59'),
(30, 7, 35, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 05:35:02', '2021-02-09 05:35:02'),
(31, 7, 36, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:12:03', '2021-02-09 07:12:03'),
(32, 7, 37, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:23:21', '2021-02-09 07:23:21'),
(33, 14, 37, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:23:21', '2021-02-09 07:23:21'),
(34, 7, NULL, NULL, 10, 'Complimentary credits', 1, '2021-02-09 07:27:09', '2021-02-09 07:27:09'),
(35, 7, 38, 'App\\Models\\Request', -1, 'Quick Notify', 1, '2021-02-09 07:28:26', '2021-02-09 07:28:26'),
(36, 14, 38, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:28:26', '2021-02-09 07:28:26'),
(37, 7, 39, 'App\\Models\\Request', -1, 'Quick Notify', 1, '2021-02-09 07:28:49', '2021-02-09 07:28:49'),
(38, 14, 39, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:28:49', '2021-02-09 07:28:49'),
(39, 7, 40, 'App\\Models\\Request', -1, 'Quick Notify', 1, '2021-02-09 07:28:53', '2021-02-09 07:28:53'),
(40, 14, 40, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:28:53', '2021-02-09 07:28:53'),
(41, 7, 41, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:29:22', '2021-02-09 07:29:22'),
(42, 14, 41, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:29:22', '2021-02-09 07:29:22'),
(43, 7, 42, 'App\\Models\\Request', -1, 'Quick Notify', 1, '2021-02-09 07:29:47', '2021-02-09 07:29:47'),
(44, 14, 42, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:29:47', '2021-02-09 07:29:47'),
(45, 7, 43, 'App\\Models\\Request', -1, 'Quick Notify', 1, '2021-02-09 07:31:52', '2021-02-09 07:31:52'),
(46, 14, 43, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:31:52', '2021-02-09 07:31:52'),
(47, 7, 44, 'App\\Models\\Request', -1, 'Quick Notify', 1, '2021-02-09 07:34:48', '2021-02-09 07:34:48'),
(48, 14, 44, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:34:48', '2021-02-09 07:34:48'),
(49, 7, 45, 'App\\Models\\Request', -1, 'Quick Notify', 1, '2021-02-09 07:38:17', '2021-02-09 07:38:17'),
(50, 14, 45, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:38:17', '2021-02-09 07:38:17'),
(51, 7, 46, 'App\\Models\\Request', -1, 'Quick Notify', 1, '2021-02-09 07:39:33', '2021-02-09 07:39:33'),
(52, 14, 46, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 07:39:33', '2021-02-09 07:39:33'),
(53, 7, NULL, NULL, 10, 'Complimentary credits', 1, '2021-02-09 13:02:39', '2021-02-09 13:02:39'),
(54, 7, 47, 'App\\Models\\Request', -1, 'Quick Notify', 1, '2021-02-09 13:03:34', '2021-02-09 13:03:34'),
(55, 14, 47, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-09 13:03:34', '2021-02-09 13:03:34'),
(56, 7, 1, 'App\\Models\\QuickContact', -4, 'Quick Contact', 1, '2021-02-09 13:05:55', '2021-02-09 13:05:55'),
(57, 27, 48, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-02-21 05:00:37', '2021-02-21 05:00:37'),
(58, 27, 9, 'App\\Models\\Response', 0, 'Normal Reply', 1, '2021-02-21 05:03:38', '2021-02-21 05:03:38'),
(59, 27, NULL, NULL, 10, 'Complimentary credits', 1, '2021-02-21 21:22:08', '2021-02-21 21:22:08'),
(60, 28, NULL, NULL, 10, 'Complimentary credits', 1, '2021-02-22 03:12:18', '2021-02-22 03:12:18'),
(61, 29, NULL, NULL, 10, 'Complimentary credits', 1, '2021-02-22 21:44:31', '2021-02-22 21:44:31'),
(62, 30, NULL, NULL, 10, 'Complimentary credits', 1, '2021-03-01 15:16:26', '2021-03-01 15:16:26'),
(63, 31, NULL, NULL, 10, 'Complimentary credits', 1, '2021-03-01 15:16:35', '2021-03-01 15:16:35'),
(64, 32, NULL, NULL, 10, 'Complimentary credits', 1, '2021-03-01 15:16:40', '2021-03-01 15:16:40'),
(65, 33, NULL, NULL, 10, 'Complimentary credits', 1, '2021-03-01 15:16:47', '2021-03-01 15:16:47'),
(80, 29, 52, 'App\\Models\\Request', 0, 'Normal Request Receipt', 1, '2021-09-17 21:46:33', '2021-09-17 21:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '7ed78310-896e-4ab4-b016-d50567154141', 'redis', 'default', '{\"uuid\":\"7ed78310-896e-4ab4-b016-d50567154141\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":10:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:10:\\\"connection\\\";s:5:\\\"redis\\\";s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"oKkbqRCgvlYguh3wCgiPFMPhidBby6kr\",\"attempts\":0}', 'ErrorException: Undefined index: id in /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Support/Collection.php:96\nStack trace:\n#0 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Support/Collection.php(96): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Undefined index...\', \'/home/DIGVST/we...\', 96, Array)\n#1 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(383): TeamTNT\\TNTSearch\\Support\\Collection->get(\'id\')\n#2 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(398): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->processDocument(Object(TeamTNT\\TNTSearch\\Support\\Collection))\n#3 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(406): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->insert(Array)\n#4 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/laravel-scout-tntsearch-driver/src/Engines/TNTSearchEngine.php(66): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->update(2, Array)\n#5 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Collections/Traits/EnumeratesValues.php(234): TeamTNT\\Scout\\Engines\\TNTSearchEngine->TeamTNT\\Scout\\Engines\\{closure}(Object(App\\Models\\Message), 0)\n#6 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/laravel-scout-tntsearch-driver/src/Engines/TNTSearchEngine.php(70): Illuminate\\Support\\Collection->each(Object(Closure))\n#7 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/scout/src/Jobs/MakeSearchable.php(42): TeamTNT\\Scout\\Engines\\TNTSearchEngine->update(Object(Illuminate\\Database\\Eloquent\\Collection))\n#8 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Scout\\Jobs\\MakeSearchable->handle()\n#9 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#10 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#11 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#12 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Container.php(610): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#13 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#14 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#15 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#16 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#17 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(118): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Laravel\\Scout\\Jobs\\MakeSearchable), false)\n#18 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#19 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#20 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#21 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#22 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\RedisJob), Array)\n#23 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(406): Illuminate\\Queue\\Jobs\\Job->fire()\n#24 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Worker->process(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Illuminate\\Queue\\WorkerOptions))\n#25 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(158): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\RedisJob), \'redis\', Object(Illuminate\\Queue\\WorkerOptions))\n#26 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(116): Illuminate\\Queue\\Worker->daemon(\'redis\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#27 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(100): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'redis\', \'default\')\n#28 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#29 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#30 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#31 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#32 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Container.php(610): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#33 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call(Array)\n#34 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#35 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#36 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(971): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#37 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(290): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#38 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(166): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#39 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/DIGVST/web/quoteme.co.tt/public_html/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 {main}', '2021-01-21 02:05:17'),
(2, '0e64e337-64a3-4271-b99e-46dac89fceb9', 'redis', 'default', '{\"uuid\":\"0e64e337-64a3-4271-b99e-46dac89fceb9\",\"timeout\":null,\"id\":\"qMjuM8KqxcTW190HCK5AxPliaMULr0n1\",\"backoff\":null,\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"maxTries\":null,\"maxExceptions\":null,\"retryUntil\":null,\"data\":{\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":10:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Admin\\\";s:2:\\\"id\\\";a:1:{i:0;i:1;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:10:\\\"connection\\\";s:5:\\\"redis\\\";s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\",\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\"},\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"attempts\":1}', 'Illuminate\\Queue\\MaxAttemptsExceededException: Laravel\\Scout\\Jobs\\MakeSearchable has been attempted too many times or run too long. The job may have previously timed out. in /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:713\nStack trace:\n#0 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(482): Illuminate\\Queue\\Worker->maxAttemptsExceededException(Object(Illuminate\\Queue\\Jobs\\RedisJob))\n#1 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(396): Illuminate\\Queue\\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), 1)\n#2 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Worker->process(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Illuminate\\Queue\\WorkerOptions))\n#3 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(158): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\RedisJob), \'redis\', Object(Illuminate\\Queue\\WorkerOptions))\n#4 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(116): Illuminate\\Queue\\Worker->daemon(\'redis\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#5 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(100): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'redis\', \'default\')\n#6 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#7 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#8 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#9 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#10 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Container.php(610): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#11 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call(Array)\n#12 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Command/Command.php(255): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#13 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#14 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(971): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#15 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(290): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#16 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(166): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#17 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#18 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#19 /home/DIGVST/web/quoteme.co.tt/public_html/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#20 {main}', '2021-01-21 02:09:03'),
(3, 'a64f8fca-2e46-4e06-b690-5e579e291d1f', 'redis', 'default', '{\"uuid\":\"a64f8fca-2e46-4e06-b690-5e579e291d1f\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":10:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:10:\\\"connection\\\";s:5:\\\"redis\\\";s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"JabPVOyMGE0hY3h3UUaJbSO3WZomT5Hg\",\"attempts\":0}', 'ErrorException: Undefined index: id in /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Support/Collection.php:96\nStack trace:\n#0 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Support/Collection.php(96): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Undefined index...\', \'/home/DIGVST/we...\', 96, Array)\n#1 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(383): TeamTNT\\TNTSearch\\Support\\Collection->get(\'id\')\n#2 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(398): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->processDocument(Object(TeamTNT\\TNTSearch\\Support\\Collection))\n#3 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(406): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->insert(Array)\n#4 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/laravel-scout-tntsearch-driver/src/Engines/TNTSearchEngine.php(66): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->update(2, Array)\n#5 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Collections/Traits/EnumeratesValues.php(234): TeamTNT\\Scout\\Engines\\TNTSearchEngine->TeamTNT\\Scout\\Engines\\{closure}(Object(App\\Models\\Message), 0)\n#6 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/laravel-scout-tntsearch-driver/src/Engines/TNTSearchEngine.php(70): Illuminate\\Support\\Collection->each(Object(Closure))\n#7 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/scout/src/Jobs/MakeSearchable.php(42): TeamTNT\\Scout\\Engines\\TNTSearchEngine->update(Object(Illuminate\\Database\\Eloquent\\Collection))\n#8 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Scout\\Jobs\\MakeSearchable->handle()\n#9 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#10 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#11 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#12 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Container.php(610): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#13 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#14 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#15 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#16 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#17 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(118): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Laravel\\Scout\\Jobs\\MakeSearchable), false)\n#18 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#19 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#20 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#21 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#22 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\RedisJob), Array)\n#23 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(406): Illuminate\\Queue\\Jobs\\Job->fire()\n#24 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Worker->process(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Illuminate\\Queue\\WorkerOptions))\n#25 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(158): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\RedisJob), \'redis\', Object(Illuminate\\Queue\\WorkerOptions))\n#26 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(116): Illuminate\\Queue\\Worker->daemon(\'redis\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#27 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(100): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'redis\', \'default\')\n#28 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#29 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#30 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#31 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#32 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Container.php(610): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#33 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call(Array)\n#34 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Command/Command.php(256): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#35 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#36 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(971): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#37 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(290): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#38 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(166): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#39 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/DIGVST/web/quoteme.co.tt/public_html/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 {main}', '2021-03-01 15:20:03'),
(4, '72e9e30e-fd3f-4e73-a77c-b39ae5ab1a2c', 'redis', 'default', '{\"uuid\":\"72e9e30e-fd3f-4e73-a77c-b39ae5ab1a2c\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":10:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";a:1:{i:0;i:5;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:10:\\\"connection\\\";s:5:\\\"redis\\\";s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"j4fqwfMONFCw6C8436oGAKwFzS6oQqTy\",\"attempts\":0}', 'ErrorException: Undefined index: id in /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Support/Collection.php:96\nStack trace:\n#0 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Support/Collection.php(96): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Undefined index...\', \'/home/DIGVST/we...\', 96, Array)\n#1 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(383): TeamTNT\\TNTSearch\\Support\\Collection->get(\'id\')\n#2 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(398): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->processDocument(Object(TeamTNT\\TNTSearch\\Support\\Collection))\n#3 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(406): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->insert(Array)\n#4 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/laravel-scout-tntsearch-driver/src/Engines/TNTSearchEngine.php(66): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->update(5, Array)\n#5 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Collections/Traits/EnumeratesValues.php(234): TeamTNT\\Scout\\Engines\\TNTSearchEngine->TeamTNT\\Scout\\Engines\\{closure}(Object(App\\Models\\Message), 0)\n#6 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/laravel-scout-tntsearch-driver/src/Engines/TNTSearchEngine.php(70): Illuminate\\Support\\Collection->each(Object(Closure))\n#7 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/scout/src/Jobs/MakeSearchable.php(42): TeamTNT\\Scout\\Engines\\TNTSearchEngine->update(Object(Illuminate\\Database\\Eloquent\\Collection))\n#8 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Scout\\Jobs\\MakeSearchable->handle()\n#9 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#10 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#11 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#12 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Container.php(610): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#13 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#14 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#15 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#16 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#17 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(118): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Laravel\\Scout\\Jobs\\MakeSearchable), false)\n#18 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#19 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#20 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#21 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#22 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\RedisJob), Array)\n#23 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(406): Illuminate\\Queue\\Jobs\\Job->fire()\n#24 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Worker->process(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Illuminate\\Queue\\WorkerOptions))\n#25 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(158): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\RedisJob), \'redis\', Object(Illuminate\\Queue\\WorkerOptions))\n#26 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(116): Illuminate\\Queue\\Worker->daemon(\'redis\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#27 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(100): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'redis\', \'default\')\n#28 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#29 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#30 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#31 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#32 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Container.php(610): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#33 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call(Array)\n#34 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Command/Command.php(256): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#35 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#36 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(971): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#37 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(290): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#38 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(166): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#39 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/DIGVST/web/quoteme.co.tt/public_html/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 {main}', '2021-03-01 15:21:01'),
(5, '6151d799-2115-4299-bffa-700de2f3f72c', 'redis', 'default', '{\"uuid\":\"6151d799-2115-4299-bffa-700de2f3f72c\",\"displayName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\",\"command\":\"O:33:\\\"Laravel\\\\Scout\\\\Jobs\\\\MakeSearchable\\\":10:{s:6:\\\"models\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";a:1:{i:0;i:5;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:10:\\\"connection\\\";s:5:\\\"redis\\\";s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"id\":\"Zw9Qu7nN3QcP7UnVqbH8rPQX4IEGmrNZ\",\"attempts\":0}', 'ErrorException: Undefined index: id in /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Support/Collection.php:96\nStack trace:\n#0 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Support/Collection.php(96): Illuminate\\Foundation\\Bootstrap\\HandleExceptions->handleError(8, \'Undefined index...\', \'/home/DIGVST/we...\', 96, Array)\n#1 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(383): TeamTNT\\TNTSearch\\Support\\Collection->get(\'id\')\n#2 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(398): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->processDocument(Object(TeamTNT\\TNTSearch\\Support\\Collection))\n#3 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/tntsearch/src/Indexer/TNTIndexer.php(406): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->insert(Array)\n#4 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/laravel-scout-tntsearch-driver/src/Engines/TNTSearchEngine.php(66): TeamTNT\\TNTSearch\\Indexer\\TNTIndexer->update(5, Array)\n#5 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Collections/Traits/EnumeratesValues.php(234): TeamTNT\\Scout\\Engines\\TNTSearchEngine->TeamTNT\\Scout\\Engines\\{closure}(Object(App\\Models\\Message), 0)\n#6 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/teamtnt/laravel-scout-tntsearch-driver/src/Engines/TNTSearchEngine.php(70): Illuminate\\Support\\Collection->each(Object(Closure))\n#7 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/scout/src/Jobs/MakeSearchable.php(42): TeamTNT\\Scout\\Engines\\TNTSearchEngine->update(Object(Illuminate\\Database\\Eloquent\\Collection))\n#8 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Laravel\\Scout\\Jobs\\MakeSearchable->handle()\n#9 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#10 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#11 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#12 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Container.php(610): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#13 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#14 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#15 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#16 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#17 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(118): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(Laravel\\Scout\\Jobs\\MakeSearchable), false)\n#18 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#19 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#20 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(120): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#21 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Laravel\\Scout\\Jobs\\MakeSearchable))\n#22 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\RedisJob), Array)\n#23 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(406): Illuminate\\Queue\\Jobs\\Job->fire()\n#24 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(356): Illuminate\\Queue\\Worker->process(\'redis\', Object(Illuminate\\Queue\\Jobs\\RedisJob), Object(Illuminate\\Queue\\WorkerOptions))\n#25 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(158): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\RedisJob), \'redis\', Object(Illuminate\\Queue\\WorkerOptions))\n#26 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(116): Illuminate\\Queue\\Worker->daemon(\'redis\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#27 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(100): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'redis\', \'default\')\n#28 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#29 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#30 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#31 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#32 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Container/Container.php(610): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#33 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call(Array)\n#34 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Command/Command.php(256): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#35 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#36 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(971): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#37 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(290): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#38 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/symfony/console/Application.php(166): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#39 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Console/Application.php(93): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#40 /home/DIGVST/web/quoteme.co.tt/public_html/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#41 /home/DIGVST/web/quoteme.co.tt/public_html/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#42 {main}', '2021-03-01 15:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Request', 5, 'c49bdeab-a088-4437-93a1-dc26d9e29557', 'photo', 'image', 'image.jpg', 'image/jpeg', 'media', 'media', 2279730, '[]', '{\"generated_conversions\":{\"thumb\":true,\"card\":true}}', '[]', 1, '2021-01-20 22:27:08', '2021-01-21 02:05:14'),
(2, 'App\\Models\\Request', 8, '4e368ff8-a118-4c73-825b-ee754cca88e1', 'photo', 'image', 'image.jpg', 'image/jpeg', 'media', 'media', 1536473, '[]', '{\"generated_conversions\":{\"thumb\":true,\"card\":true}}', '[]', 2, '2021-01-21 00:38:24', '2021-01-21 02:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms` tinyint(1) NOT NULL DEFAULT 0,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `slug`, `name`, `sms`, `subject`, `text`) VALUES
(1, 'CUSTOMER_RELOAD_EMAIL', 'Customer Reload Email', 0, 'QuoteMe Authentication', '<strong>Hello, **CustomerName!</strong><br><br>Please follow the link to authenticate on QuoteMe:<br>**CustomerReloadLink'),
(2, 'NORMAL_REQUEST_EMAIL', 'Normal Request Notification', 0, 'You\'ve got a new request', '<div><strong>Hello, **SupplierName!</strong><br><br> You\'ve got a new request for **RequestCategory :<br><br>**RequestDescription<br><br>Respond to it using your QuoteMe Dashboard :&nbsp; **RequestDetailLink</div>'),
(3, 'NORMAL_REPLY_EMAIL', 'Normal Reply Notification', 0, 'You\'ve received a reply', '<strong>Hello, **CustomerName!</strong><br><br> You\'ve got a reply for your request. The **SupplierName responded:<br> **ResponseNote.<br><br> You can check it right now on QuoteMe by using the following link:<br> **ResponseDetailLink'),
(4, 'QUICK_REPLY_SMS', 'Quick Reply', 1, NULL, 'Hello, **CustomerName! You\'ve got the reply for your request. You can check it right now on QuoteMe.'),
(5, 'QUICK_NOTIFY_SMS', 'QuickNotify', 1, NULL, '<div>Hello, **SupplierName! You\'ve got a new **RequestCategory request: **RequestDetailLink</div>'),
(6, 'SUPPLIER_WELCOME_EMAIL', 'Supplier Welcome', 0, 'Welcome to QuoteMe!', '<strong>Hello, **SupplierName!</strong><br><br> You\'ve been successfully registered on QuoteMe'),
(7, 'SUPPLIER_LOW_CREDIT_EMAIL', 'Supplier Low Credit Notification', 0, 'Your QuoteMe credit balance is getting low', '<div><strong>Hello, **SupplierName!</strong><br><br> Your QuoteMe credits are low.</div>'),
(8, 'ADMIN_PURCHASE_EMAIL', 'Admin Purchase Notification', 0, 'Credits purchase on QuoteMe', '**SupplierName just purchased some credits'),
(9, 'ADMIN_SMS_LOW_EMAIL', 'SMS Low', 0, NULL, 'Your Twilio balance is getting low');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_01_000000_create_action_events_table', 1),
(4, '2018_08_08_100000_create_telescope_entries_table', 1),
(5, '2019_05_10_000000_add_fields_to_action_events_table', 1),
(6, '2019_08_13_000000_create_nova_settings_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2020_10_15_042535_create_users_meta_table', 1),
(9, '2020_10_15_043640_create_permission_tables', 1),
(10, '2020_10_16_064542_create_categories_table', 1),
(11, '2020_10_16_064554_create_areas_table', 1),
(12, '2020_10_16_064707_create_suppliers_categories_table', 1),
(13, '2020_10_16_064715_create_suppliers_areas_table', 1),
(14, '2020_10_19_092912_create_requests_table', 1),
(15, '2020_10_19_103904_create_responses_table', 1),
(16, '2020_10_23_102655_create_media_table', 1),
(17, '2020_10_26_024722_create_plans_table', 1),
(18, '2020_10_29_075430_add_quick_contact_and_quick_reply_fields_to_requests_table', 1),
(19, '2020_10_29_093936_create_credit_transactions_table', 1),
(20, '2020_10_29_123710_add_description_field_to_credit_transactions_table', 1),
(21, '2020_10_30_043743_alter_plans_table_make_name_column_nullable', 1),
(22, '2020_10_30_074954_alter_credit_transactions_table_make_polymorphic_fields_nullable', 1),
(23, '2020_11_03_043458_create_quick_contacts_table', 1),
(24, '2020_11_03_113454_alter_table_users_remove_password_reset_required_column', 1),
(25, '2020_11_05_130050_alter_responses_table_set_price_column_nullable', 1),
(26, '2020_11_06_070521_alter_table_credit_transactions_change_amount_column', 1),
(27, '2020_11_10_090615_alter_users_table_add_auth_token_column', 1),
(28, '2020_11_12_114534_alter_table_requests_add_published_column', 1),
(29, '2020_11_30_040117_alter_table_responses_add_quick_column', 1),
(30, '2020_12_08_091515_add_messages_table', 1),
(31, '2020_12_16_164558_alter_users_table_add_phone_verified_at_column', 1),
(32, '2020_12_24_100309_alter_areas_table_add_soft_deletes', 1),
(33, '2020_12_24_100344_alter_table_categories_add_soft_deletes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 14),
(3, 'App\\Models\\User', 15),
(3, 'App\\Models\\User', 16),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 18),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 23),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 28),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 31),
(3, 'App\\Models\\User', 32),
(3, 'App\\Models\\User', 33),
(3, 'App\\Models\\User', 36),
(3, 'App\\Models\\User', 37),
(3, 'App\\Models\\User', 38),
(3, 'App\\Models\\User', 39),
(4, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 7),
(4, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 27),
(4, 'App\\Models\\User', 34),
(4, 'App\\Models\\User', 35),
(4, 'App\\Models\\User', 36);

-- --------------------------------------------------------

--
-- Table structure for table `nova_settings`
--

CREATE TABLE `nova_settings` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(8192) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nova_settings`
--

INSERT INTO `nova_settings` (`key`, `value`) VALUES
('head_start', '5'),
('head_start_enabled', '1'),
('low_credit_threshold', '0'),
('normal_reply', '0'),
('normal_request_receipt', '0'),
('quick_contact', '4'),
('quick_contact_enabled', '1'),
('quick_notify', '1'),
('quick_notify_enabled', '1'),
('quick_reply', '2'),
('quick_reply_enabled', '1'),
('sms_low_threshold', '5'),
('supplier_email_verification_enabled', '0'),
('supplier_phone_verification_enabled', '0');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('jamie@wifiventures.co.tt', '$2y$10$huEUPlG7FghY25xnkniWyewmH/IPMR1WIP1faXuTy.BME59btr.VK', '2021-01-21 02:36:07'),
('vincentcharles@mac.com', '$2y$10$lMI0CtxbaEnz6XTyeE.fDe4oioCTSat9ycGaUOgJDXiT2.1TyqYZG', '2021-01-21 02:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'nova.access', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48'),
(2, 'nova.resources.users.access', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48'),
(3, 'nova.tools.settings.access', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48'),
(4, 'user.meta.credit_notification.read', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48'),
(5, 'user.meta.sms_low.read', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48'),
(6, 'user.meta.quick_notify.read', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48'),
(7, 'user.meta.quick_contact.read', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48'),
(8, 'user.meta.quick_reply.read', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credits_amount` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `credits_amount`, `price`) VALUES
(1, '100 Pack', 100, '25.00'),
(2, '250 Pack', 250, '60.00'),
(3, '500 Pack', 500, '110.00'),
(4, '1000 Pack', 1000, '200.00'),
(5, '5000 Pack', 5000, '750.00');

-- --------------------------------------------------------

--
-- Table structure for table `quick_contacts`
--

CREATE TABLE `quick_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Customer who posted the request',
  `category_id` smallint(5) UNSIGNED NOT NULL,
  `area_id` smallint(5) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(2083) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quick_contact` tinyint(1) NOT NULL DEFAULT 0,
  `quick_reply` tinyint(1) NOT NULL DEFAULT 0,
  `cancelled` tinyint(1) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `category_id`, `area_id`, `text`, `url`, `quick_contact`, `quick_reply`, `cancelled`, `published`, `created_at`, `updated_at`) VALUES
(6, 8, 58, 1, 'iPad repairs', NULL, 0, 0, 0, 1, '2021-01-20 23:59:08', '2021-01-20 23:59:08'),
(7, 8, 58, 1, 'iPad repairs', NULL, 0, 1, 0, 1, '2021-01-21 00:00:09', '2021-01-21 00:00:09'),
(16, 11, 58, 1, 'A tool to measure length and girth', NULL, 0, 1, 0, 1, '2021-01-21 10:23:54', '2021-01-21 10:23:54'),
(18, 13, 58, 2, 'A dog muzzle for a large dog.', 'https://www.amazon.com/gp/aw/d/B075ZTBW6G/?_encoding=UTF8&pd_rd_plhdr=t&aaxitk=TKYmzg6dplYa3Ctdrj9O1Q&hsa_cr_id=6165077110601&ref_=sbx_be_s_sparkle_scm_asin_1_img&pd_rd_w=kM3SJ&pf_rd_p=75532ed1-af3f-4574-ad4f-acd8e0e7d89a&pd_rd_wg=Iu1Aq&pf_rd_r=DKQMFQFKXQRKGP2MWCSR&pd_rd_r=2aab206c-96c9-4c7d-aec2-77696ffeffc6', 1, 1, 0, 1, '2021-01-21 19:43:36', '2021-01-21 19:43:36'),
(48, 27, 29, 5, 'all parts and services', NULL, 1, 1, 0, 1, '2021-02-21 05:00:37', '2021-02-21 05:00:37'),
(50, 35, 44, 1, 'sofa sets', NULL, 0, 0, 0, 1, '2021-03-03 14:45:28', '2021-03-03 14:45:28'),
(51, 36, 2, 1, 'Looking for Whirlpool Crisper Drawer Part number WP2188656', 'https://www.partselect.com/PS11739119-Whirlpool-WP2188656-Refrigerator-Crisper-Drawer-with-Humidity-Control.htm?SourceCode=20&SearchTerm=WRS325FDAW01&ModelNum=WRS325FDAW01&ModelID=1908331', 0, 1, 0, 1, '2021-03-04 14:00:11', '2021-03-04 14:00:11'),
(52, 36, 7, 3, 'I want a battery for my Kia Sportage', NULL, 1, 1, 0, 1, '2021-09-17 21:46:33', '2021-09-17 21:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Supplier who answered the request',
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quick` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `listed_at` timestamp NULL DEFAULT NULL,
  `viewed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `user_id`, `request_id`, `price`, `text`, `quick`, `created_at`, `updated_at`, `listed_at`, `viewed_at`) VALUES
(4, 7, 7, '0.00', 'Sorry we only do WiFi', 0, '2021-01-21 00:50:08', '2021-01-21 00:50:08', NULL, NULL),
(8, 7, 18, '0.00', 'Sorry we only do WiFi', 0, '2021-01-21 19:47:30', '2021-01-21 19:47:30', NULL, NULL),
(9, 27, 48, '0.00', 'ok', 0, '2021-02-21 05:03:38', '2021-02-21 05:04:16', NULL, '2021-02-21 05:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48'),
(2, 'admin', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48'),
(3, 'supplier', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48'),
(4, 'customer', 'web', '2021-01-19 03:03:48', '2021-01-19 03:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 3),
(7, 1),
(7, 4),
(8, 1),
(8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_areas`
--

CREATE TABLE `suppliers_areas` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers_areas`
--

INSERT INTO `suppliers_areas` (`user_id`, `area_id`) VALUES
(7, 1),
(7, 3),
(7, 5),
(7, 2),
(7, 6),
(7, 4),
(7, 7),
(9, 1),
(14, 1),
(14, 3),
(14, 5),
(14, 2),
(14, 6),
(14, 4),
(27, 5),
(28, 3),
(29, 3),
(30, 2),
(31, 3),
(32, 3),
(33, 1),
(36, 1),
(38, 1),
(39, 2);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_categories`
--

CREATE TABLE `suppliers_categories` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers_categories`
--

INSERT INTO `suppliers_categories` (`user_id`, `category_id`) VALUES
(7, 58),
(9, 73),
(14, 58),
(28, 6),
(29, 7),
(29, 8),
(29, 42),
(29, 12),
(30, 58),
(30, 82),
(31, 12),
(33, 36),
(32, 36),
(29, 36),
(27, 36),
(36, 59),
(38, 59),
(39, 60);

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries`
--

CREATE TABLE `telescope_entries` (
  `sequence` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries_tags`
--

CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_monitoring`
--

CREATE TABLE `telescope_monitoring` (
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_logged_in` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `phone_verified_at`, `password`, `name`, `phone`, `disabled`, `remember_token`, `auth_token`, `created_at`, `updated_at`, `last_logged_in`) VALUES
(1, 'info@quoteme.co.tt', '2021-01-19 03:03:48', NULL, '$2y$10$gETT8IcNEhFMcVCXrvrxYOaxOOaUp.1D9lMPjoCMeYphKRpHq1/HK', 'QuoteMe Admin', NULL, 0, 'JeXjxTti5D0zCqQjdKcxLXsg6zaoKikPNjBhF9370JjtBn6oUP4hKp75RJ37', NULL, '2021-01-19 03:03:48', '2021-03-12 22:36:50', '2021-03-12 22:36:50'),
(2, 'supplier@quoteme.com', '2021-01-19 03:03:49', NULL, '$2y$10$dy.pt4kYmZNFTbDQmGYmIuPZkNbg7DG80nEweVQFZD0wwTAv7tvqW', 'QuoteMe Supplier', NULL, 0, 'KObvUZjzww', NULL, '2021-01-19 03:03:49', '2021-01-19 03:03:49', NULL),
(3, 'customer@quoteme.com', '2021-01-19 03:03:50', NULL, '$2y$10$02WPt0akh.kCqZ5x5rMlYeV2vjl4/acndT5ct1nW52Kfeyxf/4D0W', 'QuoteMe Customer', NULL, 0, 'qyMKN8xvwv', NULL, '2021-01-19 03:03:50', '2021-01-19 03:03:50', NULL),
(7, 'jamie@wifiventures.co.tt', '2021-01-21 00:50:52', '2021-01-21 00:54:52', '$2y$10$/fLdy89tgMxHO8tFhqp.zePrqZN7o64GXXfM0amSZlmE31IN6a3Si', 'WifiVentures', '+18687419550', 0, '51kdycvIy5aXXi932Po2sgOLtF7jfucRewOTw9eJ8sh7IgWl8PdSguMLqNSn', NULL, '2021-01-20 23:00:20', '2021-03-04 13:59:05', '2021-02-09 01:10:19'),
(8, 'gilesleung1@gmail.com', NULL, NULL, '$2y$10$kekfjislb.VGr.LIO.ADmeQ8uYrxY.hJfJdG/sQxYVUu0/PrKTPJG', 'Giles', '+18686891562', 0, NULL, NULL, '2021-01-20 23:59:08', '2021-01-21 00:00:09', '2021-01-20 23:59:08'),
(9, 'vincentcharles@mac.com', NULL, '2021-01-21 00:07:50', '$2y$10$880c2ZC.XGirTCegf7uSWOekagDZJX1Wjdzu9vepE6xE.3PBpvEZ.', 'Robert V. Charles', '+18687357950', 0, 'F1x9V0T6AsgwCMoetHIAX7c0EtDq98P06YchvwHmCgrVfUQkIECkhyu0lj2K', NULL, '2021-01-21 00:07:24', '2021-01-21 04:22:08', '2021-01-21 04:22:08'),
(11, 'boldeagleltd@gmail.com', NULL, NULL, '$2y$10$/UpfHJ6.NeGdXR04T8ZN8eHiloOVwj1jZ4ppXCL2liX9ebVWbLZwq', 'Roast Fowl', '+18686205666', 0, NULL, NULL, '2021-01-21 10:23:54', '2021-01-21 10:23:54', '2021-01-21 10:23:54'),
(13, 'Suzanne.lau@hotmail.com', NULL, NULL, '$2y$10$KtQK0qeVeCeVTWhu0y4s.ecxVFGN4sDj24gNRnMc0fKCSeeNA8Qy2', 'Suzanne Lau', '+18683501234', 0, NULL, NULL, '2021-01-21 19:43:36', '2021-01-21 19:43:36', '2021-01-21 19:43:36'),
(14, 'jamie@stuckbendix.com', NULL, NULL, '$2y$10$lpAiVAB6bohG6qHXRSriWuv/bQYuBX9jID91rpwHliLYdk5qll2Aa', 'Test Supplier', '+18687419550', 1, NULL, NULL, '2021-01-25 15:28:17', '2021-02-11 05:10:00', '2021-02-09 07:20:11'),
(27, 'markkong38@gmail.com', '2021-02-21 04:59:12', '2021-02-21 04:57:03', '$2y$10$Fv0ZDPGPmxYtzTntcpyA3OyoQvXwvrbQmV5TPqe491pWKb4O/57/6', 'Mark Kong', '+18683039605', 0, NULL, NULL, '2021-02-21 04:54:50', '2021-02-21 04:59:12', '2021-02-21 04:54:51'),
(28, 'khanairsystems@yahoo.com', NULL, NULL, '$2y$10$.NCkRr882HgE3p485/NsR.mVcxrNer4/is7PMx2KNkwmmImYKWGrO', 'Rushford Khan', '+18687889788', 0, NULL, NULL, '2021-02-22 01:55:09', '2021-02-22 01:55:10', '2021-02-22 01:55:10'),
(29, 'malibumarketingltd@yahoo.com', NULL, NULL, '$2y$10$oUqQXIcBJo2p6jntLSvEoeOeSL4ktga9X6wtlzMV6QbmIkgGTovxq', 'Kumar Maharaj', '+18686784845', 0, 'aXIKzQpKrfskwsezTPSN7wjsnE27mOxTATZke8Zdstb2Sa3caul0LcgrMup4', NULL, '2021-02-22 17:04:35', '2021-02-22 20:55:53', '2021-02-22 20:55:53'),
(30, 'allanadimoolah@gmail.com', NULL, NULL, '$2y$10$UXRu8aAD4Leh3Qtie6DcJe1mNv8dLc9akWb1rOUXPkaNgQziNte/e', 'Allan Adimoolah', '+18687535945', 0, NULL, NULL, '2021-02-22 22:00:21', '2021-02-22 22:00:21', '2021-02-22 22:00:21'),
(31, 'hendrixkalloo@gmail.com', NULL, NULL, '$2y$10$s4A4yKeKtwAr2IUDysXs5.5NG9X9I2Zt25IbfFQzrdvkLkPAjEGn2', 'Hendrix', '+18687733732', 0, NULL, NULL, '2021-02-24 12:04:47', '2021-02-24 12:04:48', '2021-02-24 12:04:48'),
(32, 'lennoxhabib1@outlook.com', NULL, NULL, '$2y$10$cKO.Jmf31yPwuRLvnggVIeCS.9FexspUiwYvDDl571wYEb83lSx0S', 'lennox habib', '+18687391765', 0, NULL, NULL, '2021-02-24 23:17:20', '2021-02-24 23:17:20', '2021-02-24 23:17:20'),
(33, 'accurateautott@gmail.com', NULL, NULL, '$2y$10$V9PlU/57p5X9VjuggL0ZbODEi0qxBC5WTPe/EOT7QIfuoj.0OmV9y', 'Accurate Auto Parts Ltd', '+18686826546', 0, NULL, NULL, '2021-02-26 01:56:32', '2021-02-26 01:56:33', '2021-02-26 01:56:33'),
(34, 'rudydonald67@gmail.com', NULL, NULL, '$2y$10$W4EVf6Q7fbfxvOJxp82n.ur.jGU/5v3BADURHnHi9c1bObs89trsi', 'lover boy', '+18683396926', 0, NULL, NULL, '2021-03-03 12:41:59', '2021-03-03 12:41:59', '2021-03-03 12:41:59'),
(35, 'reid_catherine10@hotmail.com', NULL, NULL, '$2y$10$BS9zBOjrcAtvXrrDD9iQyeA9lOYjFuEfknLdIJgJAu8PhcaWvvkQS', 'Catherine', NULL, 0, NULL, NULL, '2021-03-03 14:45:28', '2021-03-03 14:45:28', '2021-03-03 14:45:28'),
(36, 'jamie@newburyhill.com', NULL, NULL, '$2y$10$1AdXEx4Lhn2I4RKAI9/yb.L7IMOc/8Ue.tbm.5.8x/0QWDGZfR58W', 'Jamie McLachlan', '+18687419550', 0, NULL, 'prxeogqzFvjcBncgo70L', '2021-03-04 14:00:11', '2021-09-17 21:45:33', '2021-09-17 21:45:33'),
(38, 'Natasha@Tashink.com', NULL, NULL, '$2y$10$jrvL26AKYfGie1mXjHpvReoQSAnJE/BosEf8D9k.FHmIXz0R/sg/C', 'Natasha McLachlan', '+18686825588', 0, NULL, NULL, '2021-04-06 16:00:45', '2021-04-06 16:00:45', '2021-04-06 16:00:45'),
(39, 'info@upotive.com', NULL, NULL, '$2y$10$60GRcwlYJkS63n7udN2U/eqHWyaI5CvPcvHRe8gCw2dNWVXQeOKum', 'Christopher Russell', '+18687923430', 0, NULL, NULL, '2021-12-05 01:44:15', '2021-12-05 01:44:16', '2021-12-05 01:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `users_meta`
--

CREATE TABLE `users_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_meta`
--

INSERT INTO `users_meta` (`id`, `user_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'credit_notification', '0', '2021-01-20 01:38:12', '2021-01-20 01:38:12'),
(2, 1, 'sms_low', '0', '2021-01-20 01:38:12', '2021-01-20 01:38:12'),
(4, 7, 'quick_notify', '1', '2021-01-20 23:00:20', '2021-02-09 07:29:43'),
(5, 9, 'quick_notify', '1', '2021-01-21 00:07:24', '2021-01-21 02:46:49'),
(9, 14, 'quick_notify', '0', '2021-01-28 01:59:07', '2021-02-11 05:10:00'),
(22, 27, 'quick_notify', '1', '2021-02-21 04:54:51', '2021-03-04 02:43:40'),
(23, 28, 'quick_notify', '1', '2021-02-22 01:55:10', '2021-02-22 01:55:50'),
(24, 29, 'quick_notify', '0', '2021-02-22 17:04:36', '2021-03-04 02:43:05'),
(25, 30, 'quick_notify', '0', '2021-02-22 22:00:21', '2021-02-22 22:02:09'),
(26, 31, 'quick_notify', '1', '2021-02-24 12:04:48', '2021-02-24 12:05:44'),
(27, 32, 'quick_notify', '1', '2021-02-24 23:17:20', '2021-03-04 02:42:21'),
(28, 33, 'quick_notify', '0', '2021-02-26 01:56:33', '2021-03-04 02:41:50'),
(29, 36, 'quick_notify', '0', '2021-04-06 15:54:28', '2021-04-06 15:54:28'),
(31, 38, 'quick_notify', '0', '2021-04-06 16:00:45', '2021-04-06 16:03:29'),
(32, 39, 'quick_notify', '1', '2021-12-05 01:44:16', '2021-12-05 01:44:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_events`
--
ALTER TABLE `action_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_events_actionable_type_actionable_id_index` (`actionable_type`,`actionable_id`),
  ADD KEY `action_events_batch_id_model_type_model_id_index` (`batch_id`,`model_type`,`model_id`),
  ADD KEY `action_events_user_id_index` (`user_id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `areas_name_unique` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `credit_transactions`
--
ALTER TABLE `credit_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_slug_index` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `nova_settings`
--
ALTER TABLE `nova_settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quick_contacts`
--
ALTER TABLE `quick_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quick_contacts_request_id_foreign` (`request_id`),
  ADD KEY `quick_contacts_supplier_id_index` (`supplier_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_user_id_foreign` (`user_id`),
  ADD KEY `requests_category_id_foreign` (`category_id`),
  ADD KEY `requests_area_id_foreign` (`area_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responses_user_id_foreign` (`user_id`),
  ADD KEY `responses_request_id_foreign` (`request_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_name_index` (`name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `suppliers_areas`
--
ALTER TABLE `suppliers_areas`
  ADD KEY `suppliers_areas_user_id_foreign` (`user_id`),
  ADD KEY `suppliers_areas_area_id_foreign` (`area_id`);

--
-- Indexes for table `suppliers_categories`
--
ALTER TABLE `suppliers_categories`
  ADD KEY `suppliers_categories_user_id_foreign` (`user_id`),
  ADD KEY `suppliers_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  ADD PRIMARY KEY (`sequence`),
  ADD UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  ADD KEY `telescope_entries_batch_id_index` (`batch_id`),
  ADD KEY `telescope_entries_family_hash_index` (`family_hash`),
  ADD KEY `telescope_entries_created_at_index` (`created_at`),
  ADD KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`);

--
-- Indexes for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  ADD KEY `telescope_entries_tags_tag_index` (`tag`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_meta`
--
ALTER TABLE `users_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx__users_meta__user_id__key` (`user_id`,`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_events`
--
ALTER TABLE `action_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `credit_transactions`
--
ALTER TABLE `credit_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quick_contacts`
--
ALTER TABLE `quick_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  MODIFY `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users_meta`
--
ALTER TABLE `users_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credit_transactions`
--
ALTER TABLE `credit_transactions`
  ADD CONSTRAINT `credit_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quick_contacts`
--
ALTER TABLE `quick_contacts`
  ADD CONSTRAINT `quick_contacts_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quick_contacts_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suppliers_areas`
--
ALTER TABLE `suppliers_areas`
  ADD CONSTRAINT `suppliers_areas_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `suppliers_areas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suppliers_categories`
--
ALTER TABLE `suppliers_categories`
  ADD CONSTRAINT `suppliers_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `suppliers_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE;

--
-- Constraints for table `users_meta`
--
ALTER TABLE `users_meta`
  ADD CONSTRAINT `users_meta_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
