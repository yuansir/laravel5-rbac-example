SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbac`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_password_resets`
--

CREATE TABLE IF NOT EXISTS `admin_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_super` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否超级管理员',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `is_super`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$GBKiY/ngDVpe1iHwlTem3e0fbNrnv1sRLGcj4wT1isK0gbzY4oQoC', 1, 'aot2y8pFRyurjUWQs2JiH3QWZJcSTepfsgB1qXPwtXST8inqnjdTwilMSaa4', '2016-02-23 02:44:26', '2016-02-23 02:44:26');

-- --------------------------------------------------------

--
-- 表的结构 `admin_user_role`
--

CREATE TABLE IF NOT EXISTS `admin_user_role` (
  `admin_user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admin_user_role`
--

INSERT INTO `admin_user_role` (`admin_user_id`, `role_id`) VALUES
(1, 10);

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
('2016_01_18_071439_create_admin_users', 1),
('2016_01_18_071720_create_admin_password_resets_table', 1),
('2016_01_23_031442_entrust_base', 1),
('2016_01_23_031518_entrust_pivot_admin_user_role', 1);

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL,
  `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单父ID',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标class',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_menu` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否作为菜单显示,[1|0]',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `permissions`
--

INSERT INTO `permissions` (`id`, `fid`, `icon`, `name`, `display_name`, `description`, `is_menu`, `sort`, `created_at`, `updated_at`) VALUES
(20, 0, 'edit', '#-1456129983', '系统设置', '', 1, 100, '2016-02-22 08:33:03', '2016-02-22 08:33:03'),
(21, 20, '', 'admin.admin_user.index', '用户权限', '查看后台用户列表', 1, 0, '2016-02-18 07:56:26', '2016-02-18 07:56:26'),
(22, 20, '', 'admin.admin_user.create', '创建后台用户', '页面', 0, 0, '2016-02-23 03:48:18', '2016-02-23 03:48:18'),
(35, 0, 'home', 'admin.home', 'Dashboard', '后台首页', 1, 0, '2016-02-22 08:32:40', '2016-02-22 08:32:40'),
(36, 0, ' fa-laptop', '#-1456132007', '博客管理', '', 1, 0, '2016-02-22 09:06:47', '2016-02-22 09:06:47'),
(37, 36, '', 'admin.blog.index', '博客列表', '', 1, 0, '2016-02-22 09:15:48', '2016-02-22 09:15:48'),
(38, 20, '', 'admin.admin_user.store', '保存新建后台用户', '操作', 0, 0, '2016-02-23 03:48:52', '2016-02-23 03:48:52'),
(39, 20, '', 'admin.admin_user.destroy', '删除后台用户', '操作', 0, 0, '2016-02-23 03:49:09', '2016-02-23 03:49:09'),
(40, 20, '', 'admin.admin_user.destory.all', '批量后台用户删除', '操作', 0, 0, '2016-02-23 04:01:01', '2016-02-23 04:01:01'),
(42, 20, '', 'admin.admin_user.edit', '编辑后台用户', '页面', 0, 0, '2016-02-23 03:48:35', '2016-02-23 03:48:35'),
(43, 20, '', 'admin.admin_user.update', '保存编辑后台用户', '操作', 0, 0, '2016-02-23 03:50:12', '2016-02-23 03:50:12'),
(44, 20, '', 'admin.permission.index', '权限管理', '页面', 0, 0, '2016-02-23 03:51:36', '2016-02-23 03:51:36'),
(45, 20, '', 'admin.permission.create', '新建权限', '页面', 0, 0, '2016-02-23 03:52:16', '2016-02-23 03:52:16'),
(46, 20, '', 'admin.permission.store', '保存新建权限', '操作', 0, 0, '2016-02-23 03:52:38', '2016-02-23 03:52:38'),
(47, 20, '', 'admin.permission.edit', '编辑权限', '页面', 0, 0, '2016-02-23 03:53:29', '2016-02-23 03:53:29'),
(48, 20, '', 'admin.permission.update', '保存编辑权限', '操作', 0, 0, '2016-02-23 03:53:56', '2016-02-23 03:53:56'),
(49, 20, '', 'admin.permission.destroy', '删除权限', '操作', 0, 0, '2016-02-23 03:54:27', '2016-02-23 03:54:27'),
(50, 20, '', 'admin.permission.destory.all', '批量删除权限', '操作', 0, 0, '2016-02-23 03:55:17', '2016-02-23 03:55:17'),
(51, 20, '', 'admin.role.index', '角色管理', '页面', 0, 0, '2016-02-23 03:56:07', '2016-02-23 03:56:07'),
(52, 20, '', 'admin.role.create', '新建角色', '页面', 0, 0, '2016-02-23 03:56:33', '2016-02-23 03:56:33'),
(53, 20, '', 'admin.role.store', '保存新建角色', '操作', 0, 0, '2016-02-23 03:57:26', '2016-02-23 03:57:26'),
(54, 20, '', 'admin.role.edit', '编辑角色', '页面', 0, 0, '2016-02-23 03:58:25', '2016-02-23 03:58:25'),
(55, 20, '', 'admin.role.update', '保存编辑角色', '操作', 0, 0, '2016-02-23 03:58:50', '2016-02-23 03:58:50'),
(56, 20, '', 'admin.role.permissions', '角色权限设置', '', 0, 0, '2016-02-23 03:59:26', '2016-02-23 03:59:26'),
(57, 20, '', 'admin.role.destroy', '角色删除', '操作', 0, 0, '2016-02-23 03:59:49', '2016-02-23 03:59:49'),
(58, 20, '', 'admin.role.destory.all', '批量删除角色', '', 0, 0, '2016-02-23 04:01:58', '2016-02-23 04:01:58');

-- --------------------------------------------------------

--
-- 表的结构 `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(20, 10),
(21, 10),
(22, 10),
(35, 10),
(36, 10),
(37, 10),
(38, 10),
(39, 10),
(40, 10),
(42, 10),
(43, 10),
(44, 10),
(45, 10),
(46, 10),
(47, 10),
(48, 10),
(49, 10),
(50, 10),
(51, 10),
(52, 10),
(53, 10),
(54, 10),
(55, 10),
(56, 10),
(57, 10),
(58, 10),
(20, 12),
(21, 12),
(22, 12),
(35, 12),
(36, 12),
(37, 12);

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(10, 'administrator', '系统管理员', '', '2016-02-19 09:59:52', '2016-02-19 09:59:52'),
(12, 'test', '测试狗', '', '2016-02-19 10:00:43', '2016-02-19 10:00:43');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`),
  ADD KEY `admin_password_resets_token_index` (`token`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- Indexes for table `admin_user_role`
--
ALTER TABLE `admin_user_role`
  ADD PRIMARY KEY (`admin_user_id`,`role_id`),
  ADD KEY `admin_user_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 限制导出的表
--

--
-- 限制表 `admin_user_role`
--
ALTER TABLE `admin_user_role`
  ADD CONSTRAINT `admin_user_roles_admin_user_id_foreign` FOREIGN KEY (`admin_user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
