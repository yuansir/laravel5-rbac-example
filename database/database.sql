-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2015 年 04 月 08 日 11:09
-- 服务器版本: 5.6.19
-- PHP 版本: 5.5.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `laravel5`
--

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_03_25_101942_entrust_setup_tables', 1),
('2015_04_07_115208_import_data', 1);

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(7, 'admin.rbac.role.index', '角色组查看', '角色组查看页面', '2015-04-01 01:50:22', '2015-04-01 01:50:22'),
(8, 'admin.rbac.role.create', '角色组创建', '角色组创建页面', '2015-04-01 01:51:18', '2015-04-01 01:51:18'),
(9, 'admin.rbac.role.store', '角色组保存', '角色组保存操作', '2015-04-01 01:52:06', '2015-04-01 01:52:06'),
(10, 'admin.rbac.role.edit', '角色组编辑', '角色组编辑页面', '2015-04-01 01:53:09', '2015-04-01 01:53:09'),
(11, 'admin.rbac.role.update', '角色组修改', '角色组修改操作', '2015-04-01 01:53:46', '2015-04-01 01:53:46'),
(12, 'admin.rbac.role.destroy', '角色组删除', '角色组删除操作', '2015-04-01 01:55:33', '2015-04-01 01:55:33'),
(13, 'admin.rbac.role.permissions', '角色权限编辑', '角色权限编辑', '2015-04-06 21:30:06', '2015-04-06 21:33:19'),
(14, 'admin.rbac.user.index', '用户查看', '用户查看页面', '2015-04-06 21:35:05', '2015-04-06 21:35:05'),
(15, 'admin.rbac.user.create', '用户创建', '用户创建页面', '2015-04-06 21:36:02', '2015-04-06 21:36:02'),
(16, 'admin.rbac.user.store', '用户保存', '用户保持操作', '2015-04-06 21:36:43', '2015-04-06 21:36:43'),
(17, 'admin.rbac.user.edit', '用户编辑', '用户编辑页面', '2015-04-06 21:37:42', '2015-04-06 21:37:42'),
(18, 'admin.rbac.user.update', '用户修改', '用户修改操作', '2015-04-06 21:40:58', '2015-04-06 21:40:58'),
(19, 'admin.rbac.user.destroy', '用户删除', '用户删除操作', '2015-04-06 21:41:50', '2015-04-06 21:41:50'),
(20, 'admin.rbac.permission.index', '权限查看', '权限查看页面', '2015-04-06 21:44:43', '2015-04-06 21:44:43'),
(21, 'admin.rbac.permission.create', '权限创建', '权限创建页面', '2015-04-06 21:45:50', '2015-04-06 21:45:50'),
(22, 'admin.rbac.permission.store', '权限保存', '权限保存操作', '2015-04-06 21:46:42', '2015-04-06 21:46:42'),
(23, 'admin.rbac.permission.edit', '权限编辑', '权限编辑页面', '2015-04-06 21:48:01', '2015-04-06 21:48:01'),
(24, 'admin.rbac.permission.update', '权限修改', '权限修改操作', '2015-04-06 21:48:22', '2015-04-06 21:48:42'),
(25, 'admin.rbac.permission.destroy', '权限删除', '权限删除操作', '2015-04-06 21:53:33', '2015-04-06 21:53:33'),
(26, 'admin.blog.index', '博客查看', '博客查看页面', '2015-04-07 01:06:15', '2015-04-07 01:06:15'),
(27, 'admin.blog.create', '博客创建', '博客创建页面', '2015-04-07 01:06:41', '2015-04-07 01:06:41'),
(28, 'admin.blog.store', '博客保存', '博客保存操作', '2015-04-07 01:07:36', '2015-04-07 01:07:36'),
(29, 'admin.home', '后台首页', '后台首页', '2015-04-07 19:08:28', '2015-04-07 19:08:28');

-- --------------------------------------------------------

--
-- 表的结构 `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(26, 3),
(27, 3),
(28, 3),
(29, 3);

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'administration', '系统管理员', '系统管理员角色组', '2015-03-28 00:43:50', '2015-03-28 00:43:50'),
(3, 'tester', '测试组', '测试组', '2015-04-01 01:46:30', '2015-04-01 01:46:30');

-- --------------------------------------------------------

--
-- 表的结构 `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(25, 3);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$JV2RsYpgmYkrGBcpS9nxeOVFtFeCLrSHVOlU7JvWHrnbqrn/FVp9G', 'KpLvPoUhkqmpLJin74jttB2ejqc7v5b8vWsm0eZ7PEnzDkwmvVamZRjdP120', '2015-03-28 00:36:27', '2015-04-07 18:49:42'),
(25, 'test', 'test@test.com', '$2y$10$Nc9FJrZb.9iyb532JMcQJuM/CmBdbGztLX8SLA5EYnl9R.Ns1cHXW', 'Ec8OP9JBaSzU4a32nqUbC1iWLQIWCIgCFBSUrrtubnMpEJYdzJcRoDzXaiHw', '2015-03-31 22:11:21', '2015-04-07 19:08:03');

--
-- 限制导出的表
--

--
-- 限制表 `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
