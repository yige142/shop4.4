-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-12-09 07:59:36
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `shop_address`
--

CREATE TABLE IF NOT EXISTS `shop_address` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `name` char(8) NOT NULL,
  `phone` char(15) NOT NULL,
  `address` char(200) NOT NULL,
  `create_time` datetime NOT NULL,
  `tab` char(4) NOT NULL DEFAULT '非默认' COMMENT '默认地址标记',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `shop_address`
--

INSERT INTO `shop_address` (`id`, `uid`, `name`, `phone`, `address`, `create_time`, `tab`) VALUES
(2, 13, '谢小毛', '13129529646', '河南街道', '2017-10-31 13:53:28', '默认'),
(3, 13, '谢菲菲', '1424244564654', 'fdfdf', '2017-10-31 15:08:22', '非默认'),
(4, 4, '王某某', '13566785454', '浣花路', '2017-10-31 15:26:29', '默认'),
(5, 13, '李菲', '135478787845', '似懂非懂', '2017-11-01 10:46:34', '非默认'),
(6, 13, 'fdsfds', '123123123123', 'fdfd', '0000-00-00 00:00:00', '非默认'),
(11, 13, 'sdfdsf', '123213213213', 'dfsdfdsf', '0000-00-00 00:00:00', '非默认'),
(12, 2, '655456', '654564654654', '54654', '0000-00-00 00:00:00', '非默认'),
(13, 14, '谢小毛', '13154547878', 'xx区xx县xx街道', '0000-00-00 00:00:00', '非默认'),
(14, 13, 'dfsdf', '123123123123123', '213123', '0000-00-00 00:00:00', '非默认'),
(16, 13, '123', '123', '333', '0000-00-00 00:00:00', '非默认'),
(17, 2, 'fd', '123123123123', 'dfsdf', '0000-00-00 00:00:00', '非默认');

-- --------------------------------------------------------

--
-- 表的结构 `shop_auth_group`
--

CREATE TABLE IF NOT EXISTS `shop_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `shop_auth_group`
--

INSERT INTO `shop_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '超级管理员', 1, '1,2,3,4,5'),
(2, '普通账户', 1, '4');

-- --------------------------------------------------------

--
-- 表的结构 `shop_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `shop_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop_auth_group_access`
--

INSERT INTO `shop_auth_group_access` (`uid`, `group_id`) VALUES
(2, 1),
(4, 2),
(5, 2);

-- --------------------------------------------------------

--
-- 表的结构 `shop_auth_rule`
--

CREATE TABLE IF NOT EXISTS `shop_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `shop_auth_rule`
--

INSERT INTO `shop_auth_rule` (`id`, `name`, `title`, `type`, `status`, `condition`) VALUES
(1, 'Admin/System/', '系统管理', 1, 1, ''),
(2, 'Admin/AuthController/', '权限控制', 1, 1, ''),
(3, 'Admin/Manage/', '管理员管理', 1, 1, ''),
(4, 'User/index', '员工账号', 1, 1, ''),
(5, 'delete', '删除', 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `shop_base_info`
--

CREATE TABLE IF NOT EXISTS `shop_base_info` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) NOT NULL,
  `sex` char(3) NOT NULL,
  `birthday` date NOT NULL,
  `phone` char(18) NOT NULL,
  `email` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `shop_base_info`
--

INSERT INTO `shop_base_info` (`id`, `uid`, `sex`, `birthday`, `phone`, `email`) VALUES
(1, 4, '男', '2017-10-30', '123456', '12323@qq.com'),
(3, 13, '男', '1990-01-01', '123123123123', '12afff5ff55'),
(4, 14, '男', '1990-01-01', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `shop_goods`
--

CREATE TABLE IF NOT EXISTS `shop_goods` (
  `goodsId` int(11) NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(50) NOT NULL,
  `img_path` varchar(150) NOT NULL,
  `thumb_path` varchar(150) NOT NULL,
  `goods_sn` varchar(20) NOT NULL,
  `carriage` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `shop_price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `goods_stock` int(11) NOT NULL,
  `goods_unit` char(10) NOT NULL,
  `goods_info` char(250) NOT NULL,
  `goods_classify` char(10) NOT NULL,
  `goods_status` char(4) NOT NULL,
  `goods_recommend` char(4) NOT NULL,
  `goods_competitive` char(4) NOT NULL,
  `new_product` char(4) NOT NULL,
  `hot_cakes` char(4) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`goodsId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `shop_goods`
--

INSERT INTO `shop_goods` (`goodsId`, `goods_name`, `img_path`, `thumb_path`, `goods_sn`, `carriage`, `shop_price`, `goods_stock`, `goods_unit`, `goods_info`, `goods_classify`, `goods_status`, `goods_recommend`, `goods_competitive`, `new_product`, `hot_cakes`, `create_time`) VALUES
(9, '车厘子', '20171117/5a0e6ccf95f71.jpg', 'Uploads/180_5a0e6ccf95f71.jpg', 'clz1', '5.00', '39.00', 58, '斤', '进口新鲜车厘子', '水果', '上架', '是', '是', '是', '是', '2017-11-17 13:01:06'),
(10, '哈密瓜', '20171117/5a0e6e333f6b5.jpg', 'Uploads/180_5a0e6e333f6b5.jpg', 'ham1', '10.00', '20.00', 50, '斤', '又香又甜的哈密瓜', '水果', '上架', '是', '是', '是', '是', '2017-11-17 13:07:06'),
(11, '香梨', '20171117/5a0e6eb978e0d.jpg', 'Uploads/180_5a0e6eb978e0d.jpg', 'xl1', '5.00', '12.00', 40, '斤', '水灵灵的香梨', '水果', '上架', '是', '是', '是', '是', '2017-11-17 13:09:48'),
(12, '蛇梨果', '20171117/5a0e6f7e5058d.jpg', 'Uploads/180_5a0e6f7e5058d.jpg', 'slg1', '10.00', '18.00', 120, '斤', '美国进口蛇梨果，好看好吃', '水果', '上架', '否', '是', '是', '是', '2017-11-17 13:14:22'),
(13, '蜜瓜', '20171117/5a0e703a293f1.jpg', 'Uploads/180_5a0e703a293f1.jpg', 'mg1', '6.00', '16.00', 70, '斤', '新疆密梨', '水果', '上架', '是', '是', '是', '是', '2017-11-17 13:15:41'),
(14, '密柚', '20171117/5a0e708a05b8d.jpg', 'Uploads/180_5a0e708a05b8d.jpg', 'my1', '12.00', '20.00', 30, '斤', '清甜蜜柚', '水果', '上架', '是', '是', '是', '是', '2017-11-17 13:18:00'),
(15, '苹果', '20171117/5a0e7115cd0a3.jpg', 'Uploads/180_5a0e7115cd0a3.jpg', 'pg1', '5.00', '10.00', 60, '斤', '日本进口红富士苹果', '水果', '上架', '是', '是', '是', '是', '2017-11-17 13:20:16'),
(16, '柠檬', '20171117/5a0e71a415382.jpg', 'Uploads/180_5a0e71a415382.jpg', 'ningm1', '6.00', '12.00', 30, '斤', '酸的掉牙的柠檬', '水果', '上架', '是', '是', '是', '是', '2017-11-17 13:21:55'),
(17, '青橘', '20171117/5a0e7207284af.jpg', 'Uploads/180_5a0e7207284af.jpg', 'qj1', '5.00', '15.00', 50, '斤', '新鲜青橘，又酸又甜', '水果', '上架', '是', '是', '是', '是', '2017-11-17 13:23:16'),
(18, '无花果', '20171117/5a0e7257bf733.jpg', 'Uploads/180_5a0e7257bf733.jpg', 'whg1', '20.00', '25.00', 66, '斤', '果园新摘无花果', '水果', '上架', '是', '是', '是', '是', '2017-11-17 13:24:37'),
(19, '椰青', '20171117/5a0e729aaa3b1.jpg', 'Uploads/180_5a0e729aaa3b1.jpg', 'yeq1', '20.00', '35.00', 200, '个', '新鲜椰青，还可定制专属字符', '水果', '上架', '是', '是', '是', '是', '2017-11-17 13:26:43'),
(20, '活胆鱼', '20171117/5a0e79f39a04b.jpg', 'Uploads/180_5a0e79f39a04b.jpg', 'hdy', '21.00', '35.00', 20, '条', '新鲜活胆鱼，补脑滋肺', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:29:53'),
(21, '鸡翅根', '20171117/5a0e7aa32dc6c.jpg', 'Uploads/180_5a0e7aa32dc6c.jpg', 'jc1', '10.00', '22.00', 50, '斤', '新鲜农家鸡翅，无添加剂', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:30:55'),
(22, '葵花籽油', '20171117/5a0e7416efd95.jpg', 'Uploads/180_5a0e7416efd95.jpg', 'khz', '5.00', '15.00', 60, '瓶', '农家葵花籽油，绝无化学添加剂', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:31:59'),
(23, '牛奶', '20171117/5a0e74580d970.jpg', 'Uploads/180_5a0e74580d970.jpg', 'nn1', '5.00', '15.00', 100, '瓶', '新鲜牛奶', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:32:45'),
(24, '螃蟹', '20171117/5a0e79d60e4e1.jpg', 'Uploads/180_5a0e79d60e4e1.jpg', 'px', '20.00', '50.00', 150, '只', '大螃蟹，肉多肥美', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:33:55'),
(25, '三文鱼刺身', '20171117/5a0e74cb311d3.jpg', 'Uploads/180_5a0e74cb311d3.jpg', 'swy1', '20.00', '45.00', 100, '斤', '新鲜三文鱼刺身', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:34:48'),
(26, '牛排', '20171117/5a0e7ade3bd7d.jpg', 'Uploads/180_5a0e7ade3bd7d.jpg', 'np1', '20.00', '40.00', 80, '斤', '澳洲大牛排，美滋滋', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:35:33'),
(27, '水饺', '20171117/5a0e7b6ddbd26.jpg', 'Uploads/180_5a0e7b6ddbd26.jpg', 'sj', '10.00', '20.00', 80, '斤', '新鲜手工水饺', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:36:35'),
(28, '虾仁', '20171117/5a0e7b2d44aa2.jpg', 'Uploads/180_5a0e7b2d44aa2.jpg', 'xr1', '12.00', '22.00', 200, '斤', '新鲜虾仁', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:37:21'),
(29, '鸡蛋', '20171117/5a0e7c0554a37.jpg', 'Uploads/180_5a0e7c0554a37.jpg', 'jd1', '15.00', '22.00', 60, '斤', '新鲜鸡蛋', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:38:21'),
(30, '小牛肉', '20171117/5a0e75d54b942.jpg', 'Uploads/180_5a0e75d54b942.jpg', 'xnr', '15.00', '35.00', 55, '斤', '新鲜小牛肉', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:39:04'),
(31, '羊牛肉', '20171117/5a0e75fd9f067.jpg', 'Uploads/180_5a0e75fd9f067.jpg', 'y', '15.00', '35.00', 78, '斤', '新鲜羊牛肉', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 13:39:50'),
(32, '烧鸭', '20171117/5a0e7af3e9696.jpg', 'Uploads/180_5a0e7af3e9696.jpg', 'sy', '30.00', '50.00', 100, '只', '北京烧鸭', '生鲜', '上架', '是', '是', '是', '是', '2017-11-17 14:00:55');

-- --------------------------------------------------------

--
-- 表的结构 `shop_goods_extend`
--

CREATE TABLE IF NOT EXISTS `shop_goods_extend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsId` int(11) NOT NULL,
  `goods_describe` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `shop_goods_extend`
--

INSERT INTO `shop_goods_extend` (`id`, `goodsId`, `goods_describe`) VALUES
(9, 9, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117071313_11282.jpg&quot; alt=&quot;&quot; /&gt;'),
(10, 10, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117060658_97366.jpg&quot; alt=&quot;&quot; /&gt;'),
(11, 11, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117060946_81647.jpg&quot; alt=&quot;&quot; /&gt;'),
(12, 12, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117061419_53472.jpg&quot; alt=&quot;&quot; /&gt;'),
(13, 13, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117061538_29327.jpg&quot; alt=&quot;&quot; /&gt;'),
(14, 14, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117061758_20379.jpg&quot; alt=&quot;&quot; /&gt;'),
(15, 15, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117062013_90488.jpg&quot; alt=&quot;&quot; /&gt;'),
(16, 16, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117062136_63256.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117062152_69147.jpg&quot; alt=&quot;&quot; /&gt;'),
(17, 17, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117062315_91156.jpg&quot; alt=&quot;&quot; /&gt;'),
(18, 18, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117062436_53036.jpg&quot; alt=&quot;&quot; /&gt;'),
(19, 19, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117062608_81570.jpg&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117062640_23521.jpg&quot; alt=&quot;&quot; /&gt;'),
(20, 20, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117062951_33106.jpg&quot; alt=&quot;&quot; /&gt;'),
(21, 21, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117065915_20074.jpg&quot; alt=&quot;&quot; /&gt;'),
(22, 22, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117063158_60078.jpg&quot; alt=&quot;&quot; /&gt;'),
(23, 23, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117063305_73522.jpg&quot; alt=&quot;&quot; /&gt;'),
(24, 24, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117063352_94158.jpg&quot; alt=&quot;&quot; /&gt;'),
(25, 25, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117063447_24474.jpg&quot; alt=&quot;&quot; /&gt;'),
(26, 26, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117063532_38188.jpg&quot; alt=&quot;&quot; /&gt;'),
(27, 27, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117063634_57823.jpg&quot; alt=&quot;&quot; /&gt;'),
(28, 28, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117063720_76041.jpg&quot; alt=&quot;&quot; /&gt;'),
(29, 29, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117070503_32802.jpg&quot; alt=&quot;&quot; /&gt;'),
(30, 30, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117063903_42835.jpg&quot; alt=&quot;&quot; /&gt;'),
(31, 31, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117063948_29995.jpg&quot; alt=&quot;&quot; /&gt;'),
(32, 32, '&lt;img src=&quot;/shop3.2/Public/kindeditor/attached/image/20171117/20171117070054_85874.jpg&quot; alt=&quot;&quot; /&gt;');

-- --------------------------------------------------------

--
-- 表的结构 `shop_order`
--

CREATE TABLE IF NOT EXISTS `shop_order` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `order_name` varchar(14) NOT NULL,
  `orderSn` char(12) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '用户表ID',
  `return_id` int(11) NOT NULL DEFAULT '0',
  `payment_type` char(8) NOT NULL,
  `create_time` datetime NOT NULL,
  `unit_price` decimal(11,2) NOT NULL COMMENT '单价',
  `number` int(5) NOT NULL COMMENT '数量',
  `total_price` decimal(11,2) NOT NULL COMMENT '商品总价',
  `pay_status` char(6) NOT NULL DEFAULT '未付款' COMMENT '支付状态',
  `order_status` char(4) NOT NULL DEFAULT '未受理',
  `order_cancel` char(2) NOT NULL DEFAULT '否',
  `remark` varchar(150) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

--
-- 转存表中的数据 `shop_order`
--

INSERT INTO `shop_order` (`orderId`, `order_name`, `orderSn`, `goods_id`, `address_id`, `user_id`, `return_id`, `payment_type`, `create_time`, `unit_price`, `number`, `total_price`, `pay_status`, `order_status`, `order_cancel`, `remark`) VALUES
(33, 'test的车厘子订单', 'B79A954679F', 9, 13, 14, 0, '货到付款', '2017-11-17 14:16:19', '39.00', 2, '78.00', '未付款', '未受理', '否', '尽快发货'),
(94, 'zxzx的蛇梨果订单', '5AB13281FDF', 12, 3, 13, 0, '支付宝沙箱支付', '2017-12-09 12:39:53', '18.00', 1, '28.00', '已付款', '退款中', '否', ''),
(95, 'admin的蛇梨果订单', '3BC3FF88F4A', 12, 12, 2, 0, '支付宝沙箱支付', '2017-12-09 13:32:01', '18.00', 1, '28.00', '未付款', '未受理', '否', ''),
(96, 'zxzx的车厘子订单', '0B6E01453D0', 9, 3, 13, 0, '支付宝沙箱支付', '2017-12-09 14:13:43', '39.00', 1, '44.00', '未付款', '未受理', '否', ''),
(97, 'zxzx的车厘子订单', '34A0F4E3590', 9, 3, 13, 0, '支付宝沙箱支付', '2017-12-09 14:38:22', '39.00', 1, '44.00', '未付款', '未受理', '否', '');

-- --------------------------------------------------------

--
-- 表的结构 `shop_product`
--

CREATE TABLE IF NOT EXISTS `shop_product` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `product_name` char(6) NOT NULL,
  `product_info` varchar(255) NOT NULL,
  `uid` mediumint(4) NOT NULL,
  `create_time` datetime NOT NULL,
  `savename` char(30) NOT NULL,
  `savepath` char(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `shop_product`
--

INSERT INTO `shop_product` (`id`, `product_name`, `product_info`, `uid`, `create_time`, `savename`, `savepath`) VALUES
(1, '工矿灯', 'HB', 2, '2017-03-03 14:39:38', '58b90dcc85ca0.JPG', '2017-03-03/');

-- --------------------------------------------------------

--
-- 表的结构 `shop_return`
--

CREATE TABLE IF NOT EXISTS `shop_return` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `return_goods_name` char(14) NOT NULL,
  `return_order_sn` char(12) NOT NULL,
  `return_money` decimal(11,2) unsigned zerofill NOT NULL,
  `return_reason` varchar(150) DEFAULT NULL,
  `createtime` date NOT NULL,
  PRIMARY KEY (`return_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `shop_return`
--

INSERT INTO `shop_return` (`return_id`, `user_id`, `goods_id`, `order_id`, `return_goods_name`, `return_order_sn`, `return_money`, `return_reason`, `createtime`) VALUES
(12, 13, 12, 94, 'zxzx的蛇梨果订单', '5AB13281FDF', '000000028.00', '5656', '2017-12-09');

-- --------------------------------------------------------

--
-- 表的结构 `shop_user`
--

CREATE TABLE IF NOT EXISTS `shop_user` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `accounts` char(20) NOT NULL,
  `password` char(40) NOT NULL,
  `last_login_time` datetime NOT NULL,
  `last_login_ip` char(15) NOT NULL,
  `state` char(2) NOT NULL,
  `create_time` datetime NOT NULL,
  `login_count` decimal(5,0) NOT NULL,
  `tel` char(15) NOT NULL,
  `tab` char(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `shop_user`
--

INSERT INTO `shop_user` (`id`, `accounts`, `password`, `last_login_time`, `last_login_ip`, `state`, `create_time`, `login_count`, `tel`, `tab`) VALUES
(2, 'admin', '601f1889667efaebb33b8c12572835da3f027f78', '2017-12-09 12:25:07', '127.0.0.1', '正常', '2017-09-09 14:04:42', '86', '', '超管'),
(4, 'bbb', '601f1889667efaebb33b8c12572835da3f027f78', '2017-11-14 22:08:09', '127.0.0.1', '正常', '2017-03-01 14:41:19', '45', '13157751212', NULL),
(5, 'fff', '601f1889667efaebb33b8c12572835da3f027f78', '2017-03-01 16:26:07', '127.0.0.1', '冻结', '2017-03-01 16:04:55', '1', '', NULL),
(6, 'ddd', '601f1889667efaebb33b8c12572835da3f027f78', '0000-00-00 00:00:00', '', '正常', '2017-03-01 16:36:25', '0', '', NULL),
(7, '123123', '601f1889667efaebb33b8c12572835da3f027f78', '2017-09-19 00:33:07', '0.0.0.0', '正常', '2017-09-19 00:31:08', '1', '', NULL),
(12, 'asd', '601f1889667efaebb33b8c12572835da3f027f78', '0000-00-00 00:00:00', '', '正常', '2017-10-30 15:53:42', '0', '', NULL),
(13, 'zxzx', '601f1889667efaebb33b8c12572835da3f027f78', '2017-12-09 12:24:38', '0.0.0.0', '正常', '2017-10-30 15:56:36', '48', '', NULL),
(14, 'test', '601f1889667efaebb33b8c12572835da3f027f78', '2017-11-17 14:06:23', '0.0.0.0', '正常', '2017-11-17 14:06:14', '1', '', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
