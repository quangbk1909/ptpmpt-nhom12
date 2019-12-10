-- phpMyAdmin SQL Dump
-- version 5.0.0-rc1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 08, 2019 lúc 04:53 PM
-- Phiên bản máy phục vụ: 8.0.18
-- Phiên bản PHP: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ptpmpt2019`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `action` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `logs`
--

INSERT INTO `logs` (`id`, `action`, `created_at`, `updated_at`) VALUES
(1, 'User id 2create new procedure', '2019-11-14 16:17:11', '2019-11-14 16:17:11'),
(2, 'User id 2 create new procedure', '2019-11-14 16:18:10', '2019-11-14 16:18:10'),
(3, 'User id 1 create new main task', '2019-11-28 04:41:03', '2019-11-28 04:41:03'),
(4, 'User id  update main task id-13', '2019-11-28 04:43:02', '2019-11-28 04:43:02'),
(5, 'User id 1252 create new procedure', '2019-11-28 05:03:06', '2019-11-28 05:03:06'),
(6, 'User id 1252 create new procedure', '2019-11-28 05:07:12', '2019-11-28 05:07:12'),
(7, 'User id 1252 create new procedure', '2019-11-28 05:18:43', '2019-11-28 05:18:43'),
(8, 'User id 1252 create new procedure', '2019-11-28 05:20:30', '2019-11-28 05:20:30'),
(9, 'User id 1252 create new procedure', '2019-11-28 05:20:49', '2019-11-28 05:20:49'),
(10, 'User id 1252 create new procedure', '2019-11-28 05:21:18', '2019-11-28 05:21:18'),
(11, 'User id 1252 create new procedure', '2019-11-28 05:21:46', '2019-11-28 05:21:46'),
(12, 'User id 1252 create new procedure', '2019-11-28 05:24:09', '2019-11-28 05:24:09'),
(13, 'User id  update  procedure id-21', '2019-11-28 05:25:21', '2019-11-28 05:25:21'),
(14, 'User id  update  procedure id-21', '2019-11-28 05:30:10', '2019-11-28 05:30:10'),
(15, 'User id 1 create new procedure', '2019-11-28 05:30:56', '2019-11-28 05:30:56'),
(16, 'User id  update  procedure id-22', '2019-11-28 05:31:33', '2019-11-28 05:31:33'),
(17, 'User id 1 create new procedure', '2019-11-28 05:34:11', '2019-11-28 05:34:11'),
(18, 'User id 2 delete  procedure id-23', '2019-11-28 05:34:34', '2019-11-28 05:34:34'),
(19, 'User id 2 create new main task', '2019-11-28 07:09:44', '2019-11-28 07:09:44'),
(20, 'User id  update main task id-14', '2019-11-28 07:11:10', '2019-11-28 07:11:10'),
(21, 'User id  update main task id-14', '2019-11-28 07:11:26', '2019-11-28 07:11:26'),
(22, 'User id 2 update main task id-14', '2019-11-28 07:12:02', '2019-11-28 07:12:02'),
(23, 'User id 2 update main task id-14', '2019-11-28 07:12:07', '2019-11-28 07:12:07'),
(24, 'User id 2 delete  main task id-14', '2019-11-28 07:12:42', '2019-11-28 07:12:42'),
(25, 'User id 2 delete  main task id-13', '2019-11-28 07:12:46', '2019-11-28 07:12:46'),
(26, 'User id  update progress of  procedure task id-1', '2019-11-29 03:33:22', '2019-11-29 03:33:22'),
(27, 'User id  update progress of  procedure task id-1', '2019-12-07 22:20:44', '2019-12-07 22:20:44'),
(28, 'User id  update progress of  procedure task id-1', '2019-12-07 22:25:24', '2019-12-07 22:25:24'),
(29, 'User id  update progress of  procedure task id-1', '2019-12-07 22:26:09', '2019-12-07 22:26:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `main_tasks`
--

CREATE TABLE `main_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `finished_at` timestamp NULL DEFAULT NULL,
  `procedure_id` bigint(20) UNSIGNED NOT NULL,
  `creator` bigint(20) NOT NULL,
  `responsible_person` bigint(20) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `main_tasks`
--

INSERT INTO `main_tasks` (`id`, `name`, `description`, `deadline`, `status`, `finished_at`, `procedure_id`, `creator`, `responsible_person`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Xuất kho lô thuốc 1', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-11-29 17:00:00', 1, '2019-11-28 00:00:00', 1, 4661776629104640, 4727110530760704, '5deb08110351e97280dd2984', '2019-11-11 14:28:05', '2019-11-11 14:28:05'),
(2, 'Kiểm kê kho Hà Nội 1', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-11-25 17:00:00', 1, '2019-11-24 17:00:00', 2, 4670476018253824, 4768497976475648, '5deb08110351e97280dd2984', '2019-11-11 03:14:08', '2019-11-14 03:14:08'),
(3, 'Sản xuất men tiêu hóa tự nhiên', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-11-29 00:00:00', 0, NULL, 3, 4661776629104640, 4862508166807552, '5deb08110351e97280dd2984', '2019-11-14 03:15:28', '2019-11-14 03:15:28'),
(4, 'Khảo sát dầu gội thảo dược ', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-12-18 17:00:00', 0, NULL, 4, 4670476018253824, 4727110530760704, '5deb088c0351e97280dd2986', '2019-12-01 03:18:16', '2019-12-01 03:18:16'),
(5, 'Bán lẻ tại cửa hàng đại diện Hà Nội', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-12-13 17:00:00', 0, NULL, 5, 4661776629104640, 4768497976475648, '5deb08c60351e97280dd2987', '2019-12-01 03:22:50', '2019-12-01 03:22:50'),
(6, 'Bán theo lô tới các bệnh viện lớn tại Hà Nội', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-12-20 17:00:00', 0, NULL, 6, 4670476018253824, 4862508166807552, '5deb08c60351e97280dd2987', '2019-12-01 03:21:24', '2019-12-01 03:21:24'),
(7, 'Quảng cáo sản phẩm thuốc canxi cho người già', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-12-24 17:00:00', 0, NULL, 7, 4661776629104640, 4727110530760704, '5deb08c60351e97280dd2987', '2019-12-01 03:22:50', '2019-12-01 03:22:50'),
(8, 'Kiểm kê kho Hà Nội 2', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-12-25 17:00:00', 0, NULL, 2, 4670476018253824, 4768497976475648, '5deb08110351e97280dd2984', '2019-12-01 03:22:50', '2019-12-01 03:22:50'),
(9, 'Kiểm kê kho Hà Nội 3', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-12-26 17:00:00', 0, NULL, 2, 4661776629104640, 4862508166807552, '5deb08110351e97280dd2984', '2019-12-01 03:22:50', '2019-12-01 03:22:50'),
(10, 'Nhập lô thuốc ngoại', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-12-20 17:00:00', 0, NULL, 1, 4670476018253824, 4727110530760704, '5deb08110351e97280dd2984', '2019-12-01 03:22:50', '2019-12-01 03:22:50'),
(11, 'Xuất khẩu sản phẩm', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', '2019-12-18 17:00:00', 0, NULL, 1, 4661776629104640, 4768497976475648, '5deb08c60351e97280dd2987', '2019-12-01 03:22:50', '2019-12-01 03:22:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_10_23_043359_create_procedures_table', 1),
(5, '2019_10_23_043455_create_procedure_tasks_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `procedures`
--

CREATE TABLE `procedures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `procedure_type_id` int(11) UNSIGNED NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `procedures`
--

INSERT INTO `procedures` (`id`, `title`, `procedure_type_id`, `content`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'Thủ tục nhập xuất hàng tại kho', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id. Nulla fermentum, arcu ultrices pretium suscipit, mauris quam auctor mi, nec semper lorem erat nec lacus. Cras eget dui a massa rhoncus tristique sed vel risus. Suspendisse accumsan lectus purus, volutpat dapibus turpis bibendum ac. Vestibulum sed nunc suscipit, fringilla massa vestibulum, tempor lectus.', 4614718215946240, '2019-11-02 10:33:59', '2019-11-02 10:33:59'),
(2, 'Thủ tục kiểm kê kho', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tempus sodales volutpat. Nulla eget cursus nibh. Proin pharetra, ante convallis feugiat condimentum, ipsum enim consequat odio, et rhoncus purus turpis a turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse pharetra imperdiet pellentesque. Donec tincidunt tempus libero ut porttitor. Sed sapien neque, semper eu ipsum at, varius gravida leo. Proin feugiat dolor luctus dolor viverra, eget gravida nisl suscipit. Aliquam mattis condimentum dolor, in efficitur mauris dignissim ac. Ut ut pellentesque neque, eu finibus quam. Morbi consequat felis metus, eu molestie massa condimentum euismod. Etiam pretium fermentum dui ut egestas. Suspendisse eget laoreet tortor. Aenean eleifend egestas magna.', 4614718215946240, '2019-11-03 07:56:30', '2019-11-03 07:56:30'),
(3, 'Quy trình sản xuất thuốc mới', 2, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 4614718215946240, '2019-11-03 08:58:44', '2019-11-03 08:58:44'),
(4, 'Quy trình hoàn thiện sản phẩm ', 3, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 4614718215946240, '2019-11-03 09:02:34', '2019-11-03 09:02:34'),
(5, 'Quy trình bán lẻ', 1, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 4614718215946240, '2019-11-04 00:17:16', '2019-11-04 00:41:43'),
(6, 'Quy trình bán buôn', 1, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 4614718215946240, '2019-11-14 03:06:57', '2019-11-14 03:06:57'),
(7, 'Quy trình quảng cáo sản phẩm mới', 1, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 4614718215946240, '2019-11-14 03:07:46', '2019-11-14 03:07:46'),
(8, 'Thủ tục đăng ký bảo hiểm', 3, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 4614718215946240, '2019-11-14 03:09:20', '2019-11-14 03:09:20'),
(9, 'Thủ tục xét duyệt lương thưởng', 3, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 4614718215946240, '2019-11-14 03:09:52', '2019-11-14 03:09:52'),
(10, 'Quy trình kiểm kê cửa hàng', 1, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 4614718215946240, '2019-11-14 03:11:41', '2019-11-14 03:11:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `procedure_steps`
--

CREATE TABLE `procedure_steps` (
  `id` bigint(20) NOT NULL,
  `step` int(11) NOT NULL,
  `content` text NOT NULL,
  `procedure_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `procedure_steps`
--

INSERT INTO `procedure_steps` (`id`, `step`, `content`, `procedure_id`) VALUES
(1, 1, 'Bốc rỡ hàng', 1),
(2, 2, 'Kiểm hàng', 1),
(3, 3, 'Nhập/xuất kho', 1),
(4, 4, 'Lưu thông tin nhập xuất', 1),
(5, 5, 'Xuất hóa đơn ', 1),
(6, 6, 'Lập báo cáo', 1),
(7, 1, 'Kiểm tra giấy tờ', 2),
(8, 2, 'Kiểm tra đầu mục', 2),
(9, 3, 'Kiểm tra số lượng sản phẩm', 2),
(10, 4, 'Lập thống kê kiểm kê', 2),
(11, 5, 'Lập phiếu đánh giá', 2),
(12, 6, 'Lập báo cáo kết thúc', 2),
(13, 1, 'Sản xuất thuốc mới bước 1', 3),
(14, 2, 'Sản xuất thuốc mới bước 2', 3),
(15, 3, 'Sản xuất thuốc mới bước 3', 3),
(16, 4, 'Sản xuất thuốc mới bước 4', 3),
(17, 5, 'Sản xuất thuốc mới bước 5', 3),
(18, 6, 'Sản xuất thuốc mới bước 6', 3),
(19, 7, 'Sản xuất thuốc mới bước 7', 3),
(20, 8, 'Sản xuất thuốc mới bước 8', 3),
(21, 1, 'Hoàn thiện sản phẩm bước 1', 4),
(22, 2, 'Hoàn thiện sản phẩm bước 2', 4),
(23, 3, 'Hoàn thiện sản phẩm bước 3', 4),
(24, 4, 'Hoàn thiện sản phẩm bước 4', 4),
(25, 5, 'Hoàn thiện sản phẩm bước 5', 4),
(26, 6, 'Hoàn thiện sản phẩm bước 6', 4),
(27, 7, 'Hoàn thiện sản phẩm bước 7', 4),
(28, 1, 'Bán lẻ bước 1', 5),
(29, 2, 'Bán lẻ bước 2', 5),
(30, 3, 'Bán lẻ bước 3', 5),
(31, 4, 'Bán lẻ bước 4', 5),
(32, 5, 'Bán lẻ bước 5', 5),
(33, 6, 'Bán lẻ bước 6', 5),
(34, 7, 'Bán lẻ bước 7', 5),
(35, 1, 'Bán buôn bước 1', 6),
(36, 2, 'Bán buôn bước 2', 6),
(37, 3, 'Bán buôn bước 3', 6),
(38, 4, 'Bán buôn bước 4', 6),
(39, 5, 'Bán buôn bước 5', 6),
(40, 1, 'Quảng cáo sản phẩm bước 1', 7),
(41, 2, 'Quảng cáo sản phẩm bước 2', 7),
(42, 3, 'Quảng cáo sản phẩm bước 3', 7),
(43, 4, 'Quảng cáo sản phẩm bước 4', 7),
(44, 5, 'Quảng cáo sản phẩm bước 5', 7),
(45, 6, 'Quảng cáo sản phẩm bước 6', 7),
(46, 1, 'Đăng ký bảo hiểm bước 1', 8),
(47, 2, 'Đăng ký bảo hiểm bước 2', 8),
(48, 3, 'Đăng ký bảo hiểm bước 3', 8),
(49, 4, 'Đăng ký bảo hiểm bước 4', 8),
(50, 5, 'Đăng ký bảo hiểm bước 5', 8),
(51, 1, 'Xét duyệt lương thưởng bước 1', 9),
(52, 2, 'Xét duyệt lương thưởng bước 2', 9),
(53, 3, 'Xét duyệt lương thưởng bước 3', 9),
(54, 4, 'Xét duyệt lương thưởng bước 4', 9),
(55, 5, 'Xét duyệt lương thưởng bước 5', 9),
(56, 6, 'Xét duyệt lương thưởng bước 6', 9),
(57, 7, 'Xét duyệt lương thưởng bước 7', 9),
(58, 1, 'Kiểm kê cửa hàng bước 1', 10),
(59, 2, 'Kiểm kê cửa hàng bước 2', 10),
(60, 3, 'Kiểm kê cửa hàng bước 3', 10),
(61, 4, 'Kiểm kê cửa hàng bước 4', 10),
(62, 5, 'Kiểm kê cửa hàng bước 5', 10),
(63, 6, 'Kiểm kê cửa hàng bước 6', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `procedure_tasks`
--

CREATE TABLE `procedure_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `finished_at` timestamp NULL DEFAULT NULL,
  `amount_of_work` int(11) NOT NULL DEFAULT '0',
  `amount_of_accomplished_work` int(11) NOT NULL DEFAULT '0',
  `main_task_id` bigint(20) UNSIGNED NOT NULL,
  `creator` bigint(20) NOT NULL,
  `implementer` bigint(20) DEFAULT NULL,
  `procedure_step_id` bigint(20) NOT NULL,
  `step` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `procedure_tasks`
--

INSERT INTO `procedure_tasks` (`id`, `name`, `content`, `deadline`, `started_at`, `status`, `finished_at`, `amount_of_work`, `amount_of_accomplished_work`, `main_task_id`, `creator`, `implementer`, `procedure_step_id`, `step`, `created_at`, `updated_at`) VALUES
(1, 'Xuất kho lô thuốc 1 task 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-14 17:00:00', '2019-11-11 17:00:00', 1, '2019-11-14 00:00:00', 40, 40, 1, 4727110530760704, 4867848019116032, 1, 1, '2019-11-05 02:35:42', '2019-12-07 22:26:09'),
(2, 'Xuất kho lô thuốc 1 task 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-14 17:00:00', '2019-11-11 17:00:00', 1, '2019-11-14 17:00:00', 30, 30, 1, 4727110530760704, 4869265962303488, 1, 1, '2019-11-13 17:00:00', '2019-11-14 11:07:50'),
(3, 'Xuât kho lô thuốc 1 task 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-17 17:00:00', '2019-11-14 17:00:00', 1, '2019-11-17 00:00:00', 10, 10, 1, 4727110530760704, 4909235464830976, 2, 2, '2019-11-14 03:39:42', '2019-11-14 11:07:50'),
(4, 'Xuất kho lô thuốc 1 task 4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-17 17:00:00', '2019-11-14 17:00:00', 1, '2019-11-17 17:00:00', 20, 20, 1, 4727110530760704, 4867848019116032, 2, 2, '2019-12-07 15:23:16', '2019-12-07 15:23:16'),
(5, 'Xuất kho lô thuốc 1 task 5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-17 17:00:00', '2019-11-14 17:00:00', 1, '2019-11-17 17:00:00', 20, 20, 1, 4727110530760704, 4869265962303488, 2, 2, '2019-12-07 15:23:36', '2019-12-07 15:23:36'),
(6, 'Xuất kho lô thuốc 1 task 6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-20 00:00:00', '2019-11-17 17:00:00', 1, '2019-11-20 00:00:00', 20, 20, 1, 4727110530760704, 4909235464830976, 3, 3, '2019-12-07 15:23:40', '2019-12-07 15:23:40'),
(7, 'Xuất kho lô thuốc 1 task 7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-22 00:00:00', '2019-11-20 00:00:00', 1, '2019-11-22 00:00:00', 30, 30, 1, 4727110530760704, 4867848019116032, 4, 4, '2019-12-07 15:29:49', '2019-12-07 15:29:49'),
(8, 'Xuất kho lô thuốc 1 task 8', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-24 00:00:00', '2019-11-22 00:00:00', 1, '2019-11-24 00:00:00', 30, 30, 1, 4727110530760704, 4869265962303488, 5, 5, '2019-12-07 15:30:06', '2019-12-07 15:30:06'),
(9, 'Xuất kho lô thuốc 1 task 9', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-28 00:00:00', '2019-11-24 00:00:00', 1, '2019-11-28 00:00:00', 30, 30, 1, 4727110530760704, 4909235464830976, 6, 6, '2019-12-07 15:30:15', '2019-12-07 15:30:15'),
(10, 'Kiểm kê kho Hà Nội 1 task 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-13 00:00:00', '2019-11-11 00:00:00', 1, '2019-11-13 00:00:00', 30, 30, 2, 4768497976475648, 4965780789657600, 7, 1, '2019-12-07 15:30:19', '2019-12-07 15:30:19'),
(11, 'Kiểm kê kho Hà Nội 1 task 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-13 00:00:00', '2019-11-11 00:00:00', 1, '2019-11-13 00:00:00', 30, 30, 2, 4768497976475648, 4976846571569152, 7, 1, '2019-12-07 15:30:24', '2019-12-07 15:30:24'),
(12, 'Kiểm kê kho Hà Nội 1 task 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-13 00:00:00', '2019-11-11 00:00:00', 1, '2019-11-13 00:00:00', 30, 30, 2, 4768497976475648, 4983315060752384, 7, 1, '2019-12-07 15:30:27', '2019-12-07 15:30:27'),
(13, 'Kiểm kê kho Hà Nội 1 task 4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-15 00:00:00', '2019-11-13 00:00:00', 1, '2019-11-15 00:00:00', 30, 30, 2, 4768497976475648, 4965780789657600, 8, 2, '2019-12-07 15:30:45', '2019-12-07 15:30:45'),
(14, 'Kiểm kê kho Hà Nội 1 task 5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-18 00:00:00', '2019-11-15 00:00:00', 1, '2019-11-18 00:00:00', 30, 30, 2, 4768497976475648, 4976846571569152, 9, 3, '2019-12-07 15:30:50', '2019-12-07 15:30:50'),
(15, 'Kiểm kê kho Hà Nội 1 task 6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-18 00:00:00', '2019-11-15 00:00:00', 1, '2019-11-18 00:00:00', 30, 30, 2, 4768497976475648, 4983315060752384, 9, 3, '2019-12-07 15:30:52', '2019-12-07 15:30:52'),
(16, 'Kiểm kê kho Hà Nội 1 task 7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-18 00:00:00', '2019-11-15 00:00:00', 1, '2019-11-18 00:00:00', 30, 30, 2, 4768497976475648, 4965780789657600, 9, 3, '2019-12-07 15:37:06', '2019-12-07 15:37:06'),
(17, 'Kiểm kê kho Hà Nội 1 task 8', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-20 00:00:00', '2019-11-18 00:00:00', 1, '2019-11-20 00:00:00', 30, 30, 2, 4768497976475648, 4976846571569152, 10, 4, '2019-12-07 15:37:14', '2019-12-07 15:37:14'),
(18, 'Kiểm kê kho Hà Nội 1 task 9', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-20 00:00:00', '2019-11-18 00:00:00', 1, '2019-11-20 00:00:00', 30, 30, 2, 4768497976475648, 4983315060752384, 10, 4, '2019-12-07 15:37:18', '2019-12-07 15:37:18'),
(19, 'Kiểm kê kho Hà Nội 1 task 10', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-22 00:00:00', '2019-11-20 00:00:00', 1, '2019-11-22 00:00:00', 30, 30, 2, 4768497976475648, 4965780789657600, 11, 5, '2019-12-07 15:37:21', '2019-12-07 15:37:21'),
(20, 'Kiểm kê kho Hà Nội 1 task 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-25 00:00:00', '2019-11-22 00:00:00', 1, '2019-11-24 00:00:00', 30, 30, 2, 4768497976475648, 4976846571569152, 12, 6, '2019-12-07 15:53:09', '2019-12-07 15:53:09'),
(21, 'sản xuất men tiêu hóa tự nhiên task 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-15 00:00:00', '2019-11-14 00:00:00', 1, '2019-11-15 00:00:00', 30, 30, 3, 4862508166807552, 5002943732383744, 13, 1, '2019-12-08 01:45:38', '2019-12-08 01:45:38'),
(22, 'sản xuất men tiêu hóa tự nhiên task 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-17 00:00:00', '2019-11-15 00:00:00', 1, '2019-11-17 00:00:00', 30, 30, 3, 4862508166807552, 5083798974758912, 14, 2, '2019-12-08 01:46:24', '2019-12-08 01:46:24'),
(23, 'sản xuất men tiêu hóa tự nhiên task 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-17 00:00:00', '2019-11-15 00:00:00', 1, '2019-11-17 00:00:00', 30, 30, 3, 4862508166807552, 5097363353894912, 14, 2, '2019-12-08 01:46:44', '2019-12-08 01:46:44'),
(24, 'sản xuất men tiêu hóa tự nhiên task 4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-20 00:00:00', '2019-11-17 00:00:00', 1, '2019-11-20 00:00:00', 30, 30, 3, 4862508166807552, 5002943732383744, 15, 3, '2019-12-08 01:47:08', '2019-12-08 01:47:08'),
(25, 'sản xuất men tiêu hóa tự nhiên task 5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-22 00:00:00', '2019-11-20 00:00:00', 1, '2019-11-22 00:00:00', 30, 30, 3, 4862508166807552, 5083798974758912, 15, 3, '2019-12-08 01:47:30', '2019-12-08 01:47:30'),
(26, 'sản xuất men tiêu hóa tự nhiên task 6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-24 00:00:00', '2019-11-22 00:00:00', 1, '2019-11-24 00:00:00', 30, 30, 3, 4862508166807552, 5083798974758912, 16, 4, '2019-12-08 01:52:13', '2019-12-08 01:52:13'),
(27, 'sản xuất men tiêu hóa tự nhiên task 7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-11-27 00:00:00', '2019-11-24 00:00:00', 1, '2019-11-27 00:00:00', 40, 40, 3, 4862508166807552, 5097363353894912, 17, 5, '2019-12-08 01:54:30', '2019-12-08 01:54:30'),
(28, 'sản xuất men tiêu hóa tự nhiên task 8', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-29 00:00:00', '2019-11-27 00:00:00', 0, NULL, 50, 30, 3, 4862508166807552, 5002943732383744, 18, 6, '2019-12-08 01:55:34', '2019-12-08 01:55:34'),
(29, 'Khảo sát dầu gọi thảo dược task 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-02 00:00:00', '2019-12-01 00:00:00', 1, '2019-12-02 00:00:00', 30, 30, 4, 4727110530760704, 5097662860754944, 21, 1, '2019-12-08 02:05:24', '2019-12-08 02:05:24'),
(30, 'Khảo sát dầu gọi thảo dược task 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-04 00:00:00', '2019-12-02 00:00:00', 1, '2019-12-04 00:00:00', 30, 30, 4, 4727110530760704, 5120251570159616, 22, 2, '2019-12-08 02:06:34', '2019-12-08 02:06:34'),
(31, 'Khảo sát dầu gọi thảo dược task 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-05 00:00:00', '2019-12-04 00:00:00', 1, '2019-12-05 00:00:00', 30, 30, 4, 4727110530760704, 5134733327466496, 22, 2, '2019-12-08 02:06:34', '2019-12-08 02:06:34'),
(32, 'Khảo sát dầu gọi thảo dược task 4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-06 00:00:00', '2019-12-05 00:00:00', 1, '2019-12-06 00:00:00', 30, 30, 4, 4727110530760704, 5097662860754944, 22, 2, '2019-12-08 02:06:34', '2019-12-08 02:06:34'),
(33, 'Khảo sát dầu gọi thảo dược task 5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-07 00:00:00', '2019-12-06 00:00:00', 1, '2019-12-07 00:00:00', 30, 30, 4, 4727110530760704, 5120251570159616, 23, 3, '2019-12-08 02:07:16', '2019-12-08 02:07:16'),
(34, 'Khảo sát dầu gọi thảo dược task 6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-08 00:00:00', '2019-12-07 00:00:00', 1, '2019-12-08 00:00:00', 30, 30, 4, 4727110530760704, 5134733327466496, 23, 3, '2019-12-08 02:07:17', '2019-12-08 02:07:17'),
(35, 'Khảo sát dầu gọi thảo dược task 7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-10 00:00:00', '2019-12-08 00:00:00', 1, '2019-12-10 00:00:00', 30, 30, 4, 4727110530760704, 5097662860754944, 24, 4, '2019-12-08 02:08:15', '2019-12-08 02:08:15'),
(36, 'Khảo sát dầu gọi thảo dược task 8', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-12 00:00:00', '2019-12-10 00:00:00', 1, '2019-12-12 00:00:00', 30, 30, 4, 4727110530760704, 5120251570159616, 24, 4, '2019-12-08 02:08:16', '2019-12-08 02:08:16'),
(37, 'Khảo sát dầu gọi thảo dược task 9', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-13 00:00:00', '2019-12-12 00:00:00', 1, '2019-12-13 00:00:00', 30, 30, 4, 4727110530760704, 5134733327466496, 24, 4, '2019-12-08 02:08:16', '2019-12-08 02:08:16'),
(38, 'Khảo sát dầu gọi thảo dược task 10', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2019-12-15 00:00:00', '2019-12-13 00:00:00', 1, '2019-12-15 00:00:00', 30, 30, 4, 4727110530760704, 5097662860754944, 25, 5, '2019-12-08 02:08:37', '2019-12-08 02:08:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `procedure_types`
--

CREATE TABLE `procedure_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `procedure_types`
--

INSERT INTO `procedure_types` (`id`, `name`) VALUES
(1, 'Thủ tục/quy trình nghiệp vụ thường xuyên '),
(2, 'Thủ tục/quy trình theo dự án'),
(3, 'Thủ tục/quy trình đặc biệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fields` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `templates`
--

INSERT INTO `templates` (`id`, `name`, `fields`) VALUES
(1, 'Bao cao recurrent task rut gon abc', '{\"fields\": [\"name\", \"description\", \"doer\", \"coDoer\", \"reviewer\", \"creator\", \"implemmenter\", \"department\"]}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `main_tasks`
--
ALTER TABLE `main_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_procedure` (`procedure_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `procedure_type` (`procedure_type_id`);

--
-- Chỉ mục cho bảng `procedure_steps`
--
ALTER TABLE `procedure_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_procedure_proceduresteps` (`procedure_id`);

--
-- Chỉ mục cho bảng `procedure_tasks`
--
ALTER TABLE `procedure_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_main_task` (`main_task_id`),
  ADD KEY `fk_procedure_step` (`procedure_step_id`);

--
-- Chỉ mục cho bảng `procedure_types`
--
ALTER TABLE `procedure_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `main_tasks`
--
ALTER TABLE `main_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `procedures`
--
ALTER TABLE `procedures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `procedure_steps`
--
ALTER TABLE `procedure_steps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `procedure_tasks`
--
ALTER TABLE `procedure_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `procedure_types`
--
ALTER TABLE `procedure_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `main_tasks`
--
ALTER TABLE `main_tasks`
  ADD CONSTRAINT `fk_procedure` FOREIGN KEY (`procedure_id`) REFERENCES `procedures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `procedures`
--
ALTER TABLE `procedures`
  ADD CONSTRAINT `procedure_type` FOREIGN KEY (`procedure_type_id`) REFERENCES `procedure_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `procedure_steps`
--
ALTER TABLE `procedure_steps`
  ADD CONSTRAINT `fk_procedure_proceduresteps` FOREIGN KEY (`procedure_id`) REFERENCES `procedures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `procedure_tasks`
--
ALTER TABLE `procedure_tasks`
  ADD CONSTRAINT `fk_main_task` FOREIGN KEY (`main_task_id`) REFERENCES `main_tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_procedure_step` FOREIGN KEY (`procedure_step_id`) REFERENCES `procedure_steps` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

