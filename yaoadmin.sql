-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2016 年 04 月 22 日 08:31
-- 服务器版本: 5.6.25
-- PHP 版本: 5.6.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yaoadmin`
--

-- --------------------------------------------------------

--
-- 表的结构 `ya_admin_action`
--

CREATE TABLE IF NOT EXISTS `ya_admin_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `icon` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(20) NOT NULL DEFAULT '',
  `target` varchar(50) NOT NULL DEFAULT '',
  `verify` varchar(30) NOT NULL DEFAULT '',
  `display` enum('yes','no') NOT NULL DEFAULT 'no',
  `orderby` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `verify` (`verify`),
  KEY `pid` (`pid`),
  KEY `orderby` (`orderby`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=249 ;

--
-- 转存表中的数据 `ya_admin_action`
--

INSERT INTO `ya_admin_action` (`id`, `pid`, `icon`, `title`, `target`, `verify`, `display`, `orderby`) VALUES
(1, 0, 'music', '操作集合', 'javascript:;', 'ACTION_ALL', 'yes', 12),
(2, 1, '0', '修改操作', '/admin/action/edit', 'ACTION_EDIT', 'no', 2),
(3, 1, '0', '添加操作', '/admin/action/add', 'ACTION_ADD', 'yes', 3),
(11, 0, 'cog', '角色管理', 'javascript:;', 'ROLE_ALL', 'yes', 11),
(12, 11, '0', '添加角色', '/admin/role/add', 'ROLE_ADD', 'yes', 2),
(13, 1, '0', '操作列表', '/admin/action/index', 'ACTION_LIST', 'yes', 1),
(14, 11, '0', '角色列表', '/admin/role/index', 'ROLE_LIST', 'yes', 1),
(15, 11, '0', '编辑角色', '/admin/role/edit', 'ROLE_EDIT', 'no', 3),
(16, 0, 'glass', '控制面板', '/admin/index', 'INDEX_ALL', 'yes', 20),
(17, 16, '0', '控制面板', '', 'ADMIN_INDEX', 'yes', 1),
(36, 1, '0', '删除操作', '/admin/action/delete', 'ACTION_DELETE', 'no', 5),
(39, 11, '0', '删除角色', '/admin/role/delete', 'ROLE_DELETE', 'no', 4),
(247, 0, 'th-list', '财务报表', 'javascript:;', 'MONEY_ALL', 'yes', -100),
(248, 247, '', '月度报表', '/money/month', 'MONEY_MONTH', 'yes', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ya_admin_role`
--

CREATE TABLE IF NOT EXISTS `ya_admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `act` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `ya_admin_role`
--

INSERT INTO `ya_admin_role` (`id`, `name`, `act`) VALUES
(1, '超级管理员', 'a:10:{i:0;s:3:"248";i:1;s:2:"14";i:2;s:2:"12";i:3;s:2:"15";i:4;s:2:"39";i:5;s:2:"13";i:6;s:1:"2";i:7;s:1:"3";i:8;s:2:"36";i:9;s:2:"17";}'),
(11, '财务总监', 'a:2:{i:0;s:3:"248";i:1;s:2:"17";}');

-- --------------------------------------------------------

--
-- 表的结构 `ya_admin_user`
--

CREATE TABLE IF NOT EXISTS `ya_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL DEFAULT '',
  `passwd` varchar(32) NOT NULL DEFAULT '',
  `avatar` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ya_admin_user`
--

INSERT INTO `ya_admin_user` (`id`, `rid`, `name`, `passwd`, `avatar`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
