/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tplay

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-12 13:33:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tplay_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_admin`;
CREATE TABLE `tplay_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) DEFAULT NULL COMMENT '昵称',
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `thumb` int(11) NOT NULL DEFAULT '1' COMMENT '管理员头像',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(100) DEFAULT NULL COMMENT '最后登录ip',
  `admin_cate_id` int(2) NOT NULL DEFAULT '1' COMMENT '管理员分组',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `admin_cate_id` (`admin_cate_id`) USING BTREE,
  KEY `nickname` (`nickname`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_admin
-- ----------------------------
INSERT INTO `tplay_admin` VALUES ('1', 'Tplay', 'admin', '31c64b511d1e90fcda8519941c1bd660', '1', '1510885948', '1515046061', '1515734698', '127.0.0.1', '1');

-- ----------------------------
-- Table structure for `tplay_admin_cate`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_admin_cate`;
CREATE TABLE `tplay_admin_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `permissions` text COMMENT '权限菜单',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `desc` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_admin_cate
-- ----------------------------
INSERT INTO `tplay_admin_cate` VALUES ('1', '超级管理员', '57,58,60,61,68,82,83,84,30,29,73,74,37,38,40,41,85,86,63,64,33,34,70,71,49,50,51,53,54,77,78,80', '0', '1515044109', '超级管理员，拥有最高权限！');

-- ----------------------------
-- Table structure for `tplay_admin_log`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_admin_log`;
CREATE TABLE `tplay_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_menu_id` int(11) NOT NULL COMMENT '操作菜单id',
  `admin_id` int(11) NOT NULL COMMENT '操作者id',
  `ip` varchar(100) DEFAULT NULL COMMENT '操作ip',
  `operation_id` varchar(200) DEFAULT NULL COMMENT '操作关联id',
  `create_time` int(11) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_admin_log
-- ----------------------------

-- ----------------------------
-- Table structure for `tplay_admin_menu`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_admin_menu`;
CREATE TABLE `tplay_admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL COMMENT '模块',
  `controller` varchar(100) NOT NULL COMMENT '控制器',
  `function` varchar(100) NOT NULL COMMENT '方法',
  `parameter` varchar(50) DEFAULT NULL COMMENT '参数',
  `description` varchar(250) DEFAULT NULL COMMENT '描述',
  `is_display` int(1) NOT NULL DEFAULT '1' COMMENT '1显示在左侧菜单2只作为节点',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1权限节点2普通节点',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级菜单0为顶级菜单',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `icon` varchar(100) DEFAULT NULL COMMENT '图标',
  `is_open` int(1) NOT NULL DEFAULT '0' COMMENT '0默认闭合1默认展开',
  `orders` int(11) NOT NULL DEFAULT '0' COMMENT '排序值，越小越靠前',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `module` (`module`) USING BTREE,
  KEY `controller` (`controller`) USING BTREE,
  KEY `function` (`function`) USING BTREE,
  KEY `is_display` (`is_display`) USING BTREE,
  KEY `type` (`type`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_admin_menu
-- ----------------------------
INSERT INTO `tplay_admin_menu` VALUES ('1', '设置', 'admin', 'index', 'index', '', '管理软件的基础信息，包括个人的基本信息管理。', '1', '2', '0', '0', '1515131654', 'fa-cogs', '0', '1');
INSERT INTO `tplay_admin_menu` VALUES ('2', '个人信息', 'admin', 'admin', 'personal', '', '对个人的一些信息进行管理。', '1', '2', '1', '0', '1513402673', 'fa-cog', '0', '1');
INSERT INTO `tplay_admin_menu` VALUES ('4', '会员管理', 'admin', 'index', 'index', '', '后台管理员管理，包括后台权限组的管理。', '1', '2', '0', '1511015413', '1513558364', 'fa-user', '0', '2');
INSERT INTO `tplay_admin_menu` VALUES ('6', '角色分组', 'admin', 'admin', 'adminCate', '', '管理员角色分组管理。', '1', '2', '4', '1511083098', '1513412856', 'fa-group', '0', '2');
INSERT INTO `tplay_admin_menu` VALUES ('73', '添加/修改管理员', 'admin', 'admin', 'publish', '', '添加/修改管理员。', '2', '1', '72', '1513403009', '1513403009', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('74', '删除管理员', 'admin', 'admin', 'delete', '', '删除管理员。', '2', '1', '72', '1513403036', '1513403036', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('45', '日志管理', 'admin', 'index', 'index', '', '日志管理。', '1', '2', '0', '1511940197', '1513396527', 'fa-book', '0', '4');
INSERT INTO `tplay_admin_menu` VALUES ('77', '添加/修改菜单', 'admin', 'menu', 'publish', '', '添加/修改菜单。', '2', '1', '76', '1513403367', '1513403367', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('78', '删除菜单', 'admin', 'menu', 'delete', '', '删除菜单。', '2', '1', '76', '1513403393', '1513403393', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('30', '删除权限分组', 'admin', 'admin', 'adminCateDelete', '', '删除后台管理员权限分组。', '2', '1', '6', '1511227568', '1513396473', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('13', '修改密码', 'admin', 'admin', 'editPassword', '', '修改个人登录密码。', '1', '2', '1', '1511083565', '1513395989', 'fa-edit', '0', '2');
INSERT INTO `tplay_admin_menu` VALUES ('29', '添加/修改权限分组', 'admin', 'admin', 'adminCatePublish', '', '添加/修改管理员权限分组。', '2', '1', '6', '1511227503', '1513396481', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('79', '文件管理', 'admin', 'attachment', 'index', '', '文件管理。', '1', '2', '47', '1513403488', '1513404676', 'fa-file', '0', '1');
INSERT INTO `tplay_admin_menu` VALUES ('33', '文件审核', 'admin', 'attachment', 'audit', '', '对文件进行审核。', '2', '1', '79', '1511227899', '1513403526', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('34', '文件删除', 'admin', 'attachment', 'delete', '', '对文件进行删除操作。', '2', '1', '79', '1511227936', '1513403541', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('35', '门户管理', 'admin', 'index', 'index', '', '门户内容管理', '1', '2', '0', '1511320705', '1513408714', 'fa-th', '0', '6');
INSERT INTO `tplay_admin_menu` VALUES ('36', '分类管理', 'admin', 'articlecate', 'index', '', '分类列表管理。', '1', '2', '35', '1511320748', '1513402018', 'fa-tags', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('37', '添加/修改分类', 'admin', 'articlecate', 'publish', '', '添加/修改分类操作。', '2', '1', '36', '1511320794', '1513402031', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('38', '删除分类', 'admin', 'articlecate', 'delete', '', '删除分类操作。', '2', '1', '36', '1511320824', '1513402041', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('39', '文章管理', 'admin', 'article', 'index', '', '文章列表管理', '1', '2', '35', '1511320850', '1513402055', 'fa-file-text', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('40', '添加/修改文章', 'admin', 'article', 'publish', '', '添加/修改文章操作。', '2', '1', '39', '1511320883', '1513402066', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('41', '删除文章', 'admin', 'article', 'delete', '', '删除文章操作。', '2', '1', '39', '1511320907', '1513402079', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('46', '操作日志', 'admin', 'admin', 'log', '', '管理员操作日志。', '1', '2', '45', '1511940227', '1513396537', 'fa-book', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('47', '数据管理', 'admin', 'index', 'index', '', '数据相关的管理。', '1', '2', '0', '1511940263', '1513402145', 'fa-cubes', '0', '5');
INSERT INTO `tplay_admin_menu` VALUES ('48', '数据库', 'admin', 'databackup', 'index', '', '数据库管理', '1', '2', '47', '1511940334', '1513402218', 'fa-database', '0', '2');
INSERT INTO `tplay_admin_menu` VALUES ('49', '数据库备份', 'admin', 'databackup', 'export', '', '数据库备份。', '2', '1', '48', '1511940383', '1513402229', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('50', '数据库优化', 'admin', 'databackup', 'optimize', '', '数据库优化。', '2', '1', '48', '1511940422', '1513402239', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('51', '数据库修复', 'admin', 'databackup', 'repair', '', '数据库修复', '2', '1', '48', '1511940450', '1513402248', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('52', '备份管理', 'admin', 'databackup', 'importlist', '', '数据库备份文件管理。', '1', '2', '47', '1511940505', '1513402265', 'fa-bookmark', '0', '3');
INSERT INTO `tplay_admin_menu` VALUES ('53', '数据库备份还原', 'admin', 'databackup', 'import', '', '数据库还原。', '2', '1', '52', '1511940554', '1513402275', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('54', '数据库备份删除', 'admin', 'databackup', 'del', '', '数据库备份删除。', '2', '1', '52', '1511940587', '1513402284', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('75', '菜单管理', 'admin', 'index', 'index', '', '菜单管理。', '1', '2', '0', '1513403151', '1513403151', 'fa-sitemap', '0', '3');
INSERT INTO `tplay_admin_menu` VALUES ('56', '邮件配置', 'admin', 'emailconfig', 'index', '', '邮件配置。', '1', '2', '1', '1512811551', '1513402539', 'fa-envelope', '0', '4');
INSERT INTO `tplay_admin_menu` VALUES ('57', '修改邮件配置', 'admin', 'emailconfig', 'publish', '', '修改邮件配置。', '2', '1', '56', '1512811595', '1513402369', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('58', '发送测试邮件', 'admin', 'emailconfig', 'mailto', '', '发送测试邮件。', '2', '1', '56', '1512811635', '1513402381', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('59', '短信配置', 'admin', 'smsconfig', 'index', '', '短信配置。', '1', '2', '1', '1512977784', '1513402562', 'fa-comment', '0', '5');
INSERT INTO `tplay_admin_menu` VALUES ('60', '修改短信配置', 'admin', 'smsconfig', 'publish', '', '修改短信配置。', '2', '1', '59', '1512977821', '1513402412', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('61', '发送测试短信', 'admin', 'smsconfig', 'smsto', '', '发送测试短信。', '2', '1', '59', '1512977851', '1513402421', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('62', '留言管理', 'admin', 'tomessages', 'index', '', '留言管理。', '1', '2', '35', '1513047149', '1513402094', 'fa-comments', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('63', '标记留言', 'admin', 'tomessages', 'mark', '', '标记留言。', '2', '1', '62', '1513047177', '1513402105', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('64', '删除留言', 'admin', 'tomessages', 'delete', '', '删除留言。', '2', '1', '62', '1513047205', '1513402113', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('65', '添加留言', 'admin', 'tomessages', 'publish', '', '添加留言。', '2', '2', '62', '1513047239', '1513402120', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('66', '管理员登录', 'admin', 'common', 'login', '', '管理员登录。', '2', '2', '0', '1513061455', '1513402429', '', '0', '100');
INSERT INTO `tplay_admin_menu` VALUES ('67', '系统设置', 'admin', 'webconfig', 'index', '', '网站信息设置。', '1', '2', '1', '1513131135', '1515038283', 'fa-desktop', '0', '3');
INSERT INTO `tplay_admin_menu` VALUES ('68', '修改网站配置', 'admin', 'webconfig', 'publish', '', '修改网站配置信息。', '2', '1', '67', '1513131161', '1513408856', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('69', '上传文件', 'admin', 'common', 'upload', '', '上传文件。', '2', '2', '0', '1513155130', '1515036247', '', '0', '199');
INSERT INTO `tplay_admin_menu` VALUES ('70', '上传附件', 'admin', 'attachment', 'upload', '', '上传附件。', '2', '1', '79', '1513323699', '1513403557', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('71', '文件下载', 'admin', 'attachment', 'download', '', '文件下载。', '2', '1', '79', '1513325699', '1513403571', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('72', '管理员', 'admin', 'admin', 'index', '', '管理员列表。', '1', '2', '4', '1513402959', '1513402959', 'fa-user', '0', '1');
INSERT INTO `tplay_admin_menu` VALUES ('76', '后台菜单', 'admin', 'menu', 'index', '', '添加/修改菜单。', '1', '2', '75', '1513403248', '1513403248', 'fa-sliders', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('80', '菜单排序', 'admin', 'menu', 'orders', '', '后台菜单排序。', '2', '1', '76', '1513408418', '1513408418', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('81', 'URL美化', 'admin', 'urlsconfig', 'index', '', 'URL美化设置。', '1', '2', '1', '1513574783', '1513574783', 'fa-link', '0', '6');
INSERT INTO `tplay_admin_menu` VALUES ('82', '新增/修改url美化', 'admin', 'urlsconfig', 'publish', '', '新增/修改url美化规则。', '2', '1', '81', '1513574935', '1513574935', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('83', '启用/禁用url美化', 'admin', 'urlsconfig', 'status', '', '启用/禁用url美化规则。', '2', '1', '81', '1513574979', '1513575215', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('84', '删除url美化规则', 'admin', 'urlsconfig', 'delete', '', '删除url美化规则。', '2', '1', '81', '1513575009', '1513575009', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('85', '置顶/取消置顶', 'admin', 'article', 'is_top', '', '置顶或取消置顶文章操作。', '2', '1', '39', '1515043744', '1515043744', '', '0', '0');
INSERT INTO `tplay_admin_menu` VALUES ('86', '审核/下架文章', 'admin', 'article', 'status', '', '对文章进行审核或者下架操作。', '2', '1', '39', '1515043796', '1515043796', '', '0', '0');

-- ----------------------------
-- Table structure for `tplay_article`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_article`;
CREATE TABLE `tplay_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `article_cate_id` int(11) NOT NULL,
  `thumb` int(11) DEFAULT NULL,
  `content` text,
  `admin_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `edit_admin_id` int(11) NOT NULL COMMENT '最后修改人',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0待审核1已审核',
  `is_top` int(1) NOT NULL DEFAULT '0' COMMENT '1置顶0普通',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `is_top` (`is_top`) USING BTREE,
  KEY `article_cate_id` (`article_cate_id`) USING BTREE,
  KEY `admin_id` (`admin_id`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_article
-- ----------------------------

-- ----------------------------
-- Table structure for `tplay_article_cate`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_article_cate`;
CREATE TABLE `tplay_article_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tag` varchar(250) DEFAULT NULL COMMENT '关键词',
  `description` varchar(250) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_article_cate
-- ----------------------------

-- ----------------------------
-- Table structure for `tplay_attachment`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_attachment`;
CREATE TABLE `tplay_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` char(15) NOT NULL DEFAULT '' COMMENT '所属模块',
  `filename` char(50) NOT NULL DEFAULT '' COMMENT '文件名',
  `filepath` char(200) NOT NULL DEFAULT '' COMMENT '文件路径+文件名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `fileext` char(10) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `uploadip` char(15) NOT NULL DEFAULT '' COMMENT '上传IP',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未审核1已审核-1不通过',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL COMMENT '审核者id',
  `audit_time` int(11) NOT NULL COMMENT '审核时间',
  `use` varchar(200) DEFAULT NULL COMMENT '用处',
  `download` int(11) NOT NULL DEFAULT '0' COMMENT '下载量',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `filename` (`filename`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='附件表';

-- ----------------------------
-- Records of tplay_attachment
-- ----------------------------
INSERT INTO `tplay_attachment` VALUES ('1', 'admin', '79811855a6c06de53047471c4ff82a36.jpg', '\\uploads\\admin\\admin_thumb\\20180104\\79811855a6c06de53047471c4ff82a36.jpg', '13781', 'jpg', '1', '127.0.0.1', '1', '1515046060', '1', '1515046060', 'admin_thumb', '0');

-- ----------------------------
-- Table structure for `tplay_emailconfig`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_emailconfig`;
CREATE TABLE `tplay_emailconfig` (
  `email` varchar(5) NOT NULL COMMENT '邮箱配置标识',
  `from_email` varchar(50) NOT NULL COMMENT '邮件来源也就是邮件地址',
  `from_name` varchar(50) NOT NULL,
  `smtp` varchar(50) NOT NULL COMMENT '邮箱smtp服务器',
  `username` varchar(100) NOT NULL COMMENT '邮箱账号',
  `password` varchar(100) NOT NULL COMMENT '邮箱密码',
  `title` varchar(200) NOT NULL COMMENT '邮件标题',
  `content` text NOT NULL COMMENT '邮件模板',
  KEY `email` (`email`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_emailconfig
-- ----------------------------
INSERT INTO `tplay_emailconfig` VALUES ('email', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for `tplay_messages`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_messages`;
CREATE TABLE `tplay_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `is_look` int(1) NOT NULL DEFAULT '0' COMMENT '0未读1已读',
  `message` text NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `is_look` (`is_look`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_messages
-- ----------------------------

-- ----------------------------
-- Table structure for `tplay_smsconfig`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_smsconfig`;
CREATE TABLE `tplay_smsconfig` (
  `sms` varchar(10) NOT NULL DEFAULT 'sms' COMMENT '标识',
  `appkey` varchar(200) NOT NULL,
  `secretkey` varchar(200) NOT NULL,
  `type` varchar(100) DEFAULT 'normal' COMMENT '短信类型',
  `name` varchar(100) NOT NULL COMMENT '短信签名',
  `code` varchar(100) NOT NULL COMMENT '短信模板ID',
  `content` text NOT NULL COMMENT '短信默认模板',
  KEY `sms` (`sms`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_smsconfig
-- ----------------------------
INSERT INTO `tplay_smsconfig` VALUES ('sms', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for `tplay_urlconfig`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_urlconfig`;
CREATE TABLE `tplay_urlconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aliases` varchar(200) NOT NULL COMMENT '想要设置的别名',
  `url` varchar(200) NOT NULL COMMENT '原url结构',
  `desc` text COMMENT '备注',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0禁用1使用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_urlconfig
-- ----------------------------

-- ----------------------------
-- Table structure for `tplay_webconfig`
-- ----------------------------
DROP TABLE IF EXISTS `tplay_webconfig`;
CREATE TABLE `tplay_webconfig` (
  `web` varchar(20) NOT NULL COMMENT '网站配置标识',
  `name` varchar(200) NOT NULL COMMENT '网站名称',
  `keywords` text COMMENT '关键词',
  `desc` text COMMENT '描述',
  `is_log` int(1) NOT NULL DEFAULT '1' COMMENT '1开启日志0关闭',
  `file_type` varchar(200) DEFAULT NULL COMMENT '允许上传的类型',
  `file_size` bigint(20) DEFAULT NULL COMMENT '允许上传的最大值',
  `statistics` text COMMENT '统计代码',
  `black_ip` text COMMENT 'ip黑名单',
  `url_suffix` varchar(20) DEFAULT NULL COMMENT 'url伪静态后缀',
  KEY `web` (`web`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tplay_webconfig
-- ----------------------------
INSERT INTO `tplay_webconfig` VALUES ('web', 'Tplay后台管理框架', 'Tplay,后台管理,thinkphp5,layui', 'Tplay是一款基于ThinkPHP5.0.12 + layui2.2.45 + ECharts + Mysql开发的后台管理框架，集成了一般应用所必须的基础性功能，为开发者节省大量的时间。', '1', 'jpg,png,gif,mp4,zip,jpeg', '500', '', '', null);
