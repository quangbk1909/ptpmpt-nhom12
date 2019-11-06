-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 06, 2019 lúc 02:49 PM
-- Phiên bản máy phục vụ: 5.7.19
-- Phiên bản PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ptpmpt`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `procedure_type_id` int(11) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attached_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `procedures`
--

INSERT INTO `procedures` (`id`, `title`, `procedure_type_id`, `content`, `attached_file`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'Thủ tục nhật xuất hàng tại kho', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id. Nulla fermentum, arcu ultrices pretium suscipit, mauris quam auctor mi, nec semper lorem erat nec lacus. Cras eget dui a massa rhoncus tristique sed vel risus. Suspendisse accumsan lectus purus, volutpat dapibus turpis bibendum ac. Vestibulum sed nunc suscipit, fringilla massa vestibulum, tempor lectus.', 'assets/file_1', 1, '2019-11-02 10:33:59', '2019-11-02 10:33:59'),
(2, 'Thủ tục kiểm kê kho', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tempus sodales volutpat. Nulla eget cursus nibh. Proin pharetra, ante convallis feugiat condimentum, ipsum enim consequat odio, et rhoncus purus turpis a turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse pharetra imperdiet pellentesque. Donec tincidunt tempus libero ut porttitor. Sed sapien neque, semper eu ipsum at, varius gravida leo. Proin feugiat dolor luctus dolor viverra, eget gravida nisl suscipit. Aliquam mattis condimentum dolor, in efficitur mauris dignissim ac. Ut ut pellentesque neque, eu finibus quam. Morbi consequat felis metus, eu molestie massa condimentum euismod. Etiam pretium fermentum dui ut egestas. Suspendisse eget laoreet tortor. Aenean eleifend egestas magna.', 'assets/file_2', 1, '2019-11-03 07:56:30', '2019-11-03 07:56:30'),
(3, 'Quy trình dự án thuốc an thần tự nhiên', 2, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 'assets/file_3', 1, '2019-11-03 08:58:44', '2019-11-03 08:58:44'),
(4, 'Quy trình dự án A', 2, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 'assets/file_4', 2, '2019-11-03 09:02:34', '2019-11-03 09:02:34'),
(5, 'Quy trình dự án B', 2, 'orem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rhoncus ex id sollicitudin iaculis. Nullam accumsan ornare augue, eu viverra metus suscipit at. Curabitur consequat magna justo, quis mollis lorem vehicula id.', 'assets/file_5', 1, '2019-11-04 00:17:16', '2019-11-04 00:41:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `procedure_tasks`
--

CREATE TABLE `procedure_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `amount_of_work` int(11) NOT NULL DEFAULT '0',
  `amount_of_accomplished_work` int(11) NOT NULL DEFAULT '0',
  `procedure_id` bigint(20) UNSIGNED NOT NULL,
  `creator` int(11) NOT NULL,
  `implementer` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `procedure_tasks`
--

INSERT INTO `procedure_tasks` (`id`, `name`, `content`, `deadline`, `status`, `amount_of_work`, `amount_of_accomplished_work`, `procedure_id`, `creator`, `implementer`, `created_at`, `updated_at`) VALUES
(1, 'Nhập hàng vào kho', 'Bốc rỡ hàng, đếm số lượng, kiểm tra đầy đủ và chính xác số lượng và sản phẩm.', '2019-12-04 17:00:00', 1, 40, 40, 1, 1, 2, '2019-11-05 02:35:42', '2019-11-06 06:48:35');

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
(1, 'Thủ tục/quy trình thường xuyên'),
(2, 'Thủ tục/quy trình theo dự án'),
(3, 'Thủ tục/quy trình riêng biệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

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
-- Chỉ mục cho bảng `procedure_tasks`
--
ALTER TABLE `procedure_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `procedure` (`procedure_id`);

--
-- Chỉ mục cho bảng `procedure_types`
--
ALTER TABLE `procedure_types`
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
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `procedures`
--
ALTER TABLE `procedures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `procedure_tasks`
--
ALTER TABLE `procedure_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `procedure_types`
--
ALTER TABLE `procedure_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `procedures`
--
ALTER TABLE `procedures`
  ADD CONSTRAINT `procedure_type` FOREIGN KEY (`procedure_type_id`) REFERENCES `procedure_types` (`id`);

--
-- Các ràng buộc cho bảng `procedure_tasks`
--
ALTER TABLE `procedure_tasks`
  ADD CONSTRAINT `procedure` FOREIGN KEY (`procedure_id`) REFERENCES `procedures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
