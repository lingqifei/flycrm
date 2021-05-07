
-- -----------------------------
-- Table structure for `#@__action_log`
-- -----------------------------
DROP TABLE IF EXISTS `#@__action_log`;
CREATE TABLE `#@__action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sys_user_id` int(10) unsigned DEFAULT '0' COMMENT '执行会员id',
  `username` char(30) DEFAULT '' COMMENT '用户名',
  `ip` char(30) NOT NULL DEFAULT '' COMMENT '执行行为者ip',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '行为名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '执行的URL',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '组织',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=663 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='[系统]行为日志表';

-- -----------------------------
-- Table structure for `#@__addon`
-- -----------------------------
DROP TABLE IF EXISTS `#@__addon`;
CREATE TABLE `#@__addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '插件描述',
  `config` text NOT NULL COMMENT '配置',
  `author` varchar(40) NOT NULL DEFAULT '' COMMENT '作者',
  `version` varchar(20) NOT NULL DEFAULT '' COMMENT '版本号',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `org_id` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='[系统]插件表';

-- -----------------------------
-- Records of `#@__addon`
-- -----------------------------
INSERT INTO `#@__addon` VALUES ('5', 'Editor', '文本编辑器', '富文本编辑器', '', 'Bigotry', '1.0', '1', '0', '0', '1');
INSERT INTO `#@__addon` VALUES ('4', 'Icon', '图标选择', '图标选择插件', '', 'Bigotry', '1.0', '1', '0', '0', '1');
INSERT INTO `#@__addon` VALUES ('3', 'File', '文件上传', '文件上传插件', '', 'Jack', '1.0', '1', '0', '0', '1');
INSERT INTO `#@__addon` VALUES ('6', 'Region', '区域选择', '区域选择插件', '', 'Bigotry', '1.0', '1', '0', '0', '1');

-- -----------------------------
-- Table structure for `#@__config`
-- -----------------------------
DROP TABLE IF EXISTS `#@__config`;
CREATE TABLE `#@__config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置标题',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置选项',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COMMENT='[系统]配置表';

-- -----------------------------
-- Records of `#@__config`
-- -----------------------------
INSERT INTO `#@__config` VALUES ('1', 'title', '1', '系统标题', '1', '', '网站标题前台显示标题，优先级低于SEO模块', '1378898976', '1608711855', '1', '零起飞网络', '1');
INSERT INTO `#@__config` VALUES ('2', 'description', '2', '系统描述', '1', '', '网站搜索引擎描述，优先级低于SEO模块', '1378898976', '1608711818', '1', '07fly', '4');
INSERT INTO `#@__config` VALUES ('3', 'keywords', '2', '系统关键字', '1', '', '网站搜索引擎关键字，优先级低于SEO模块', '1378898976', '1608711855', '1', '07fly', '3');
INSERT INTO `#@__config` VALUES ('9', 'config_type_list', '3', '配置类型列表', '3', '', '主要用于数据解析和页面表单的生成', '1378898976', '1587614212', '1', '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举\r\n5:图片\r\n6:文件\r\n7:富文本\r\n8:单选\r\n9:多选\r\n10:日期\r\n11:时间\r\n12:颜色', '100');
INSERT INTO `#@__config` VALUES ('20', 'config_group_list', '3', '配置分组', '3', '', '配置分组', '1379228036', '1587614212', '1', '1:基础\r\n2:数据\r\n3:系统\r\n4:API', '100');
INSERT INTO `#@__config` VALUES ('25', 'list_rows', '0', '每页数据记录数', '2', '', '数据每页显示记录数', '1379503896', '1610687630', '1', '20', '10');
INSERT INTO `#@__config` VALUES ('29', 'data_backup_part_size', '0', '数据库备份卷大小', '2', '', '该值用于限制压缩后的分卷最大长度。单位：B', '1381482488', '1610687630', '1', '52428800', '7');
INSERT INTO `#@__config` VALUES ('30', 'data_backup_compress', '4', '数据库备份文件是否启用压缩', '2', '0:不压缩\r\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '1381713345', '1610687630', '1', '1', '9');
INSERT INTO `#@__config` VALUES ('31', 'data_backup_compress_level', '4', '数据库备份文件压缩级别', '2', '1:普通\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '1381713408', '1610687630', '1', '9', '10');
INSERT INTO `#@__config` VALUES ('33', 'allow_url', '3', '不受权限验证的url', '3', '', '', '1386644047', '1587614212', '1', '0:file/pictureupload\r\n1:addon/execute\r\n2:admin/index/index\r\n3:admin/index/main\r\n4:index/main', '100');
INSERT INTO `#@__config` VALUES ('43', 'empty_list_describe', '1', '数据列表为空时的描述信息', '2', '', '', '1492278127', '1610687630', '1', 'aOh! 暂时还没有数据~', '0');
INSERT INTO `#@__config` VALUES ('44', 'trash_config', '3', '回收站配置', '3', '', 'key为模型名称，值为显示列。', '1492312698', '1587614212', '1', 'Config:name\r\nAuthGroup:name\r\nMember:nickname\r\nMenu:name\r\nArticle:name\r\nArticleCategory:name\r\nAddon:name\r\nPicture:name\r\nFile:name\r\nActionLog:describe\r\nApi:name\r\nApiGroup:name\r\nBlogroll:name\r\nExeLog:exe_url\r\nSeo:name', '0');
INSERT INTO `#@__config` VALUES ('49', 'static_domain', '1', '静态资源域名', '1', '', '若静态资源为本地资源则此项为空，若为外部资源则为存放静态资源的域名', '1502430387', '1608711855', '1', '', '12');
INSERT INTO `#@__config` VALUES ('52', 'team_developer', '3', '研发团队人员', '4', '', '', '1504236453', '1618042741', '1', '0:零起飞\r\n1:开发人生', '0');
INSERT INTO `#@__config` VALUES ('53', 'api_status_option', '3', 'API接口状态', '4', '', '', '1504242433', '1618042741', '1', '0:待研发\r\n1:研发中\r\n2:测试中\r\n3:已完成', '0');
INSERT INTO `#@__config` VALUES ('54', 'api_data_type_option', '0', 'API数据类型', '4', '', '', '1504328208', '1618042741', '1', '0:字符1:文本2:数组3:文件', '0');
INSERT INTO `#@__config` VALUES ('55', 'web_theme', '1', '前端主题', '1', '', '', '1504762360', '1608711855', '1', 'default', '10');
INSERT INTO `#@__config` VALUES ('56', 'api_domain', '1', 'API部署域名', '4', '', '', '1504779094', '1618042741', '1', 'https://api.07fly.xyz', '0');
INSERT INTO `#@__config` VALUES ('57', 'api_key', '0', 'API加密KEY', '4', '', '泄露后API将存在安全隐患', '1505302112', '1618042741', '1', 'l2V|gfZp{8`;jzR~6Y1_', '0');
INSERT INTO `#@__config` VALUES ('58', 'loading_icon', '4', '页面Loading图标设置', '1', '1:图标1\r\n2:图标2\r\n3:图标3\r\n4:图标4\r\n5:图标5\r\n6:图标6\r\n7:图标7', '页面Loading图标支持7种图标切换', '1505377202', '1608711855', '1', '7', '11');
INSERT INTO `#@__config` VALUES ('59', 'sys_file_field', '3', '文件字段配置', '3', '', 'key为模型名，值为文件列名。', '1505799386', '1587614212', '1', '0_article:file_id', '0');
INSERT INTO `#@__config` VALUES ('60', 'sys_picture_field', '0', '图片字段配置', '3', '', 'key为模型名，值为图片列名。', '1506315422', '1587614212', '1', '0_article:cover_id1_article:img_ids', '0');
INSERT INTO `#@__config` VALUES ('61', 'jwt_key', '0', 'JWT加密KEY', '4', '', '', '1506748805', '1618042806', '1', 'l2V|DSFXXXgfZp{8`;FjzR~6Y1_', '0');
INSERT INTO `#@__config` VALUES ('64', 'is_write_exe_log', '4', '是否写入执行记录', '3', '0:否\r\n1:是', '', '1510544340', '1587614212', '1', '1', '101');
INSERT INTO `#@__config` VALUES ('65', 'admin_allow_ip', '2', '超级管理员登录IP', '3', '', '后台超级管理员登录IP限制，其他角色不受限。', '1510995580', '1587614212', '1', '0:27.22.112.250', '0');
INSERT INTO `#@__config` VALUES ('66', 'pjax_mode', '8', 'PJAX模式', '3', '0:否\r\n1:是', '若为PJAX模式则浏览器不会刷新，若为常规模式则为AJAX+刷新', '1512370397', '1512982406', '1', '1', '120');
INSERT INTO `#@__config` VALUES ('69', '121212', '3', '1212', '0', '', '', '1587720082', '0', '1', '', '0');
INSERT INTO `#@__config` VALUES ('70', 'system_name', '1', '后台名称', '1', '', '后台管理界面名称', '1608711806', '0', '1', '', '2');

-- -----------------------------
-- Table structure for `#@__driver`
-- -----------------------------
DROP TABLE IF EXISTS `#@__driver`;
CREATE TABLE `#@__driver` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `service_name` varchar(40) NOT NULL DEFAULT '' COMMENT '服务标识',
  `driver_name` varchar(20) NOT NULL DEFAULT '' COMMENT '驱动标识',
  `config` text NOT NULL COMMENT '配置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='[系统]插件表';

-- -----------------------------
-- Records of `#@__driver`
-- -----------------------------
INSERT INTO `#@__driver` VALUES ('1', 'Pay', 'Alipay', 'a:6:{s:14:\"alipay_account\";s:5:\"34345\";s:14:\"alipay_partner\";s:0:\"\";s:10:\"alipay_key\";s:0:\"\";s:12:\"alipay_appid\";s:0:\"\";s:20:\"alipay_rsaPrivateKey\";s:0:\"\";s:25:\"alipay_alipayrsaPublicKey\";s:0:\"\";}', '1', '1577678491', '1577678512');
INSERT INTO `#@__driver` VALUES ('2', 'Pay', 'Wxpay', 'a:4:{s:5:\"appid\";s:3:\"app\";s:9:\"appsecret\";s:0:\"\";s:9:\"partnerid\";s:0:\"\";s:10:\"partnerkey\";s:0:\"\";}', '1', '1585016761', '0');
INSERT INTO `#@__driver` VALUES ('4', 'Sms', 'Tencent', 'a:2:{s:6:\"app_id\";s:10:\"1400398383\";s:7:\"app_key\";s:32:\"2710810b835c5915a394f378801f8440\";}', '1', '1594522417', '1594546315');

-- -----------------------------
-- Table structure for `#@__hook`
-- -----------------------------
DROP TABLE IF EXISTS `#@__hook`;
CREATE TABLE `#@__hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `describe` varchar(255) NOT NULL COMMENT '描述',
  `addon_list` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '创建时间',
  `org_id` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '组织机构',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='[系统]钩子表';

-- -----------------------------
-- Records of `#@__hook`
-- -----------------------------
INSERT INTO `#@__hook` VALUES ('36', 'File', '文件上传钩子', 'File', '1', '0', '0', '1');
INSERT INTO `#@__hook` VALUES ('37', 'Icon', '图标选择钩子', 'Icon', '1', '0', '0', '1');
INSERT INTO `#@__hook` VALUES ('38', 'ArticleEditor', '富文本编辑器', 'Editor', '1', '0', '0', '1');
INSERT INTO `#@__hook` VALUES ('39', 'RegionSelect', '区域选择', 'Region', '1', '0', '0', '1');
INSERT INTO `#@__hook` VALUES ('41', 'MarkdownEditor', 'Markdown编辑器', 'Editor', '1', '0', '0', '1');

-- -----------------------------
-- Table structure for `#@__picture`
-- -----------------------------
DROP TABLE IF EXISTS `#@__picture`;
CREATE TABLE `#@__picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '图片名称',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='[系统]图片表';

-- -----------------------------
-- Table structure for `#@__region`
-- -----------------------------
DROP TABLE IF EXISTS `#@__region`;
CREATE TABLE `#@__region` (
  `id` int(7) NOT NULL COMMENT '主键',
  `name` varchar(40) DEFAULT NULL COMMENT '省市区名称',
  `upid` int(7) DEFAULT NULL COMMENT '上级ID',
  `shortname` varchar(40) DEFAULT NULL COMMENT '简称',
  `level` tinyint(2) DEFAULT NULL COMMENT '级别:0,中国；1，省分；2，市；3，区、县',
  `citycode` varchar(7) DEFAULT NULL COMMENT '城市代码',
  `zipcode` varchar(7) DEFAULT NULL COMMENT '邮编',
  `lng` varchar(20) DEFAULT NULL COMMENT '经度',
  `lat` varchar(20) DEFAULT NULL COMMENT '纬度',
  `pinyin` varchar(40) DEFAULT NULL COMMENT '拼音',
  `visible` enum('0','1') DEFAULT '1' COMMENT '是否启用',
  `sort` int(7) DEFAULT '500' COMMENT '排序',
  `ishot` enum('0','1') DEFAULT '0' COMMENT '是否热点',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='[系统]省市区行政表';

-- -----------------------------
-- Table structure for `#@__sequence`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sequence`;
CREATE TABLE `#@__sequence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '前缀',
  `current_date` varchar(255) NOT NULL DEFAULT '' COMMENT '当前日期',
  `current_value` int(11) DEFAULT NULL COMMENT '当前值',
  `increment` int(11) DEFAULT '1' COMMENT '增加值',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `org_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统]唯一序号生成表';

-- -----------------------------
-- Table structure for `#@__sys_auth`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_auth`;
CREATE TABLE `#@__sys_auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL DEFAULT '' COMMENT '用户组所属模块',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `intro` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` text NOT NULL COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `sys_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '100',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `org_id` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='[系统]权限组表';

-- -----------------------------
-- Records of `#@__sys_auth`
-- -----------------------------
INSERT INTO `#@__sys_auth` VALUES ('1', '', '企业超级管理', '本权限为企业帐号注册初次的权限列表', '1', '1,333,334,466,522,478,472,463,473,464,562,563,479,417,418,462,470,471,576,577,578,579,580,581,475,488,487,494,489,490,521,493,492,491,474,496,497,498,495,499,504,503,500,501,502,564,565,566,567,568,569,570,571,572,573,574,575,414,520,508,507,506,505,416,511,510,509,512,516,515,514,513,517,519,518', '1', '0', '1608776722', '1569638911', '1');

-- -----------------------------
-- Table structure for `#@__sys_auth_access`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_auth_access`;
CREATE TABLE `#@__sys_auth_access` (
  `sys_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `sys_auth_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户组id',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `org_id` int(10) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='[系统]用户组授权表';

-- -----------------------------
-- Records of `#@__sys_auth_access`
-- -----------------------------
INSERT INTO `#@__sys_auth_access` VALUES ('65', '2', '1581077567', '1581077567', '1');
INSERT INTO `#@__sys_auth_access` VALUES ('68', '1', '0', '1581077577', '109');
INSERT INTO `#@__sys_auth_access` VALUES ('69', '1', '0', '1581131238', '110');
INSERT INTO `#@__sys_auth_access` VALUES ('70', '1', '0', '1581131308', '111');
INSERT INTO `#@__sys_auth_access` VALUES ('71', '1', '0', '1581131388', '112');
INSERT INTO `#@__sys_auth_access` VALUES ('72', '1', '0', '1581131430', '113');
INSERT INTO `#@__sys_auth_access` VALUES ('73', '1', '0', '1581131480', '114');
INSERT INTO `#@__sys_auth_access` VALUES ('74', '1', '0', '1581131530', '115');
INSERT INTO `#@__sys_auth_access` VALUES ('75', '1', '0', '1581131563', '116');
INSERT INTO `#@__sys_auth_access` VALUES ('76', '1', '0', '1581131602', '117');
INSERT INTO `#@__sys_auth_access` VALUES ('77', '1', '0', '1581131686', '118');
INSERT INTO `#@__sys_auth_access` VALUES ('78', '1', '0', '1581131705', '119');
INSERT INTO `#@__sys_auth_access` VALUES ('79', '1', '0', '1581131755', '120');
INSERT INTO `#@__sys_auth_access` VALUES ('80', '27', '1581135438', '1581135438', '1');
INSERT INTO `#@__sys_auth_access` VALUES ('81', '1', '0', '1583806365', '121');
INSERT INTO `#@__sys_auth_access` VALUES ('82', '1', '0', '1583806401', '122');
INSERT INTO `#@__sys_auth_access` VALUES ('83', '1', '0', '1584695987', '122');
INSERT INTO `#@__sys_auth_access` VALUES ('84', '1', '1587610611', '1587610611', '1');

-- -----------------------------
-- Table structure for `#@__sys_dept`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_dept`;
CREATE TABLE `#@__sys_dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL COMMENT '部门名称',
  `pid` int(11) DEFAULT '0' COMMENT '上线编号',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `visible` smallint(6) DEFAULT '1' COMMENT '1=显示，0=隐藏',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `org_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='[系统]部门表';

-- -----------------------------
-- Records of `#@__sys_dept`
-- -----------------------------
INSERT INTO `#@__sys_dept` VALUES ('1', '商务部', '0', '6', '1', '0', '1584764548', '1');
INSERT INTO `#@__sys_dept` VALUES ('2', '技术部', '0', '5', '1', '0', '1584695438', '1');
INSERT INTO `#@__sys_dept` VALUES ('3', '人事事', '0', '3', '1', '0', '1586417709', '1');
INSERT INTO `#@__sys_dept` VALUES ('4', '财务部', '0', '4', '1', '0', '1586417712', '1');
INSERT INTO `#@__sys_dept` VALUES ('5', '销售部01', '1', '2', '1', '0', '1584771236', '1');

-- -----------------------------
-- Table structure for `#@__sys_menu`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_menu`;
CREATE TABLE `#@__sys_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `module` char(20) NOT NULL DEFAULT '' COMMENT '模块',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `is_shortcut` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否快捷操作',
  `is_menu` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0=不是，1=是，在菜单中显示',
  `icon` char(30) NOT NULL DEFAULT '' COMMENT '图标',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '组织',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2346 DEFAULT CHARSET=utf8 COMMENT='[系统]菜单表';

-- -----------------------------
-- Records of `#@__sys_menu`
-- -----------------------------
INSERT INTO `#@__sys_menu` VALUES ('1', '系统首页', '0', '10', 'admin', 'index/main', '1', '0', '1', '', '1', '1617951112', '0', '1');
INSERT INTO `#@__sys_menu` VALUES ('2', '组织结构', '420', '9', 'admin', 'index/main', '1', '0', '1', 'fa-sitemap', '1', '1608727422', '0', '1');
INSERT INTO `#@__sys_menu` VALUES ('4', '系统菜单', '420', '3', 'admin', 'SysMenu/show', '1', '0', '1', 'fa-user', '-1', '1581134855', '0', '1');
INSERT INTO `#@__sys_menu` VALUES ('17', '用户添加', '26', '10', 'admin', 'SysUser/add', '1', '0', '0', 'fa-circle-o', '1', '1581133424', '1570758733', '1');
INSERT INTO `#@__sys_menu` VALUES ('18', '用户删除', '26', '10', 'admin', 'SysUser/del', '1', '0', '0', 'fa-circle-o', '1', '1581133427', '1570758899', '1');
INSERT INTO `#@__sys_menu` VALUES ('19', '用户修改', '26', '10', 'admin', 'SysUser/edit', '1', '0', '0', 'fa-circle-o', '1', '1581133431', '1570758908', '1');
INSERT INTO `#@__sys_menu` VALUES ('20', '系统扩展', '0', '110', 'admin', 'extend', '1', '0', '1', 'fa-fire', '1', '1611558980', '1570759051', '1');
INSERT INTO `#@__sys_menu` VALUES ('21', '本地模块', '20', '20', 'admin', 'SysModule/show', '1', '0', '1', 'fa-user-secret', '1', '1591278940', '1570759147', '1');
INSERT INTO `#@__sys_menu` VALUES ('23', '数据库管理', '420', '10', 'admin', 'Database/show', '1', '0', '1', 'fa-database', '1', '1581134863', '1570775822', '1');
INSERT INTO `#@__sys_menu` VALUES ('25', '权限列表', '2', '3', 'admin', 'SysAuth/show', '1', '0', '1', 'fa-circle-o', '1', '1581133532', '1570776665', '1');
INSERT INTO `#@__sys_menu` VALUES ('26', '系统用户', '2', '3', 'admin', 'SysUser/show', '1', '0', '1', 'fa-circle-o', '1', '1581133408', '1571797945', '1');
INSERT INTO `#@__sys_menu` VALUES ('31', '部门管理', '2', '2', 'admin', 'SysDept/show', '1', '0', '1', '', '1', '1587109972', '1572012939', '1');
INSERT INTO `#@__sys_menu` VALUES ('34', '权限浏览', '25', '2', 'admin', 'SysAuth/show_json', '1', '0', '0', '', '1', '1581133440', '1572093484', '1');
INSERT INTO `#@__sys_menu` VALUES ('35', '权限添加', '25', '2', 'admin', 'SysAuth/add', '1', '0', '0', '', '1', '1581133436', '1572093484', '1');
INSERT INTO `#@__sys_menu` VALUES ('36', '权限修改', '25', '2', 'admin', 'SysAuth/edit', '1', '0', '0', '', '1', '1581133449', '1572093484', '1');
INSERT INTO `#@__sys_menu` VALUES ('37', '权限删除', '25', '2', 'admin', 'SysAuth/del', '1', '0', '0', '', '1', '1581133446', '1572093484', '1');
INSERT INTO `#@__sys_menu` VALUES ('38', '菜单授权', '25', '2', 'admin', 'SysAuth/MenuAuth', '1', '0', '0', '', '1', '1581133443', '1572093484', '1');
INSERT INTO `#@__sys_menu` VALUES ('51', '企业删除', '422', '100', 'admin', 'SysOrg/del', '1', '0', '0', '', '1', '1581135264', '1572139508', '1');
INSERT INTO `#@__sys_menu` VALUES ('53', '企业修改', '422', '100', 'admin', 'SysOrg/edit', '1', '0', '0', '', '1', '1581135198', '1572139508', '1');
INSERT INTO `#@__sys_menu` VALUES ('54', '密码重置', '422', '100', 'admin', 'SysOrg/reset_pwd', '1', '0', '0', '', '1', '1581135233', '1572139508', '1');
INSERT INTO `#@__sys_menu` VALUES ('153', '钩子列表', '20', '100', 'admin', 'addon/hook_list', '1', '0', '1', '', '1', '1582082103', '1573803178', '1');
INSERT INTO `#@__sys_menu` VALUES ('298', '配置列表', '420', '2', 'admin', 'config/configlist', '1', '0', '1', '', '1', '1581134852', '1573894702', '1');
INSERT INTO `#@__sys_menu` VALUES ('302', '用户授权', '26', '1', 'admin', 'SysUser/userAuth', '1', '0', '0', '', '1', '1581133413', '1573909630', '1');
INSERT INTO `#@__sys_menu` VALUES ('303', '数据备份', '23', '1', 'admin', 'Database/databackup', '1', '0', '1', '', '1', '1581134868', '1573995669', '1');
INSERT INTO `#@__sys_menu` VALUES ('304', '数据恢复', '23', '2', 'admin', 'Database/dataRestore', '1', '0', '1', '', '1', '1581134872', '1573995695', '1');
INSERT INTO `#@__sys_menu` VALUES ('305', '用户浏览', '26', '2', 'admin', 'SysUser/show_json', '1', '0', '0', '', '1', '1581133417', '1574148728', '1');
INSERT INTO `#@__sys_menu` VALUES ('333', '资料修改', '1', '12', 'admin', 'SysUser/editInfo', '1', '0', '0', '', '1', '1587614396', '1574651722', '1');
INSERT INTO `#@__sys_menu` VALUES ('334', '密码修改', '1', '13', 'admin', 'SysUser/editPwd', '1', '0', '0', '', '1', '1587614403', '1574651738', '1');
INSERT INTO `#@__sys_menu` VALUES ('546', '网站管理', '544', '2', 'crm', 'CstWebsite/show', '1', '0', '1', '', '1', '0', '1586435348', '1');
INSERT INTO `#@__sys_menu` VALUES ('545', '销售合同', '544', '1', 'crm', 'SalContract/show', '1', '0', '1', '', '1', '0', '1586428151', '1');
INSERT INTO `#@__sys_menu` VALUES ('543', '仓库管理', '324', '6', 'crm', 'StockStore/show', '1', '0', '1', '', '1', '1586506313', '1586427428', '1');
INSERT INTO `#@__sys_menu` VALUES ('542', '商品规格', '537', '5', 'crm', 'GoodsSpec/show', '1', '0', '1', '', '1', '1586427161', '1586427159', '1');
INSERT INTO `#@__sys_menu` VALUES ('541', '商品分类', '537', '4', 'crm', 'GoodsCategory/show', '1', '0', '1', '', '1', '0', '1586427103', '1');
INSERT INTO `#@__sys_menu` VALUES ('540', '商品品牌', '537', '3', 'crm', 'GoodsBrand/show', '1', '0', '1', '', '1', '0', '1586427075', '1');
INSERT INTO `#@__sys_menu` VALUES ('539', '商品清单', '537', '2', 'crm', 'GoodsSku/show', '1', '0', '1', '', '1', '1586427699', '1586427047', '1');
INSERT INTO `#@__sys_menu` VALUES ('536', '字典管理', '324', '1', 'crm', 'dict-mange', '1', '0', '1', '', '1', '0', '1586426762', '1');
INSERT INTO `#@__sys_menu` VALUES ('537', '商品管理', '324', '5', 'crm', 'goods', '1', '0', '1', '', '1', '1586426922', '1586426910', '1');
INSERT INTO `#@__sys_menu` VALUES ('538', '商品目录', '537', '1', 'crm', 'Goods/show', '1', '0', '1', '', '1', '1586427706', '1586427014', '1');
INSERT INTO `#@__sys_menu` VALUES ('385', '系统设置', '420', '1', 'admin', 'config/setting', '1', '0', '1', '', '1', '1581134842', '1575123431', '1');
INSERT INTO `#@__sys_menu` VALUES ('535', '银行帐号管理', '532', '3', 'crm', 'FinBankAccount/show', '1', '0', '1', '', '1', '0', '1586426696', '1');
INSERT INTO `#@__sys_menu` VALUES ('534', '费用开支类型', '532', '2', 'crm', 'FinExpensesType/show', '1', '0', '1', '', '1', '0', '1586426661', '1');
INSERT INTO `#@__sys_menu` VALUES ('532', '财务类型', '324', '3', 'crm', 'finace-type', '1', '0', '1', 'fa-won', '1', '0', '1586426303', '1');
INSERT INTO `#@__sys_menu` VALUES ('533', '费用收入类型', '532', '1', 'crm', 'FinIncomeType/show', '1', '0', '1', '', '1', '0', '1586426552', '1');
INSERT INTO `#@__sys_menu` VALUES ('531', '销售机会', '523', '5', 'crm', 'CstChance/show', '1', '0', '1', '', '1', '1585228757', '1585041236', '1');
INSERT INTO `#@__sys_menu` VALUES ('530', '客户联系人', '523', '7', 'crm', 'CstLinkman/show', '1', '0', '1', '', '1', '1586423509', '1585041236', '1');
INSERT INTO `#@__sys_menu` VALUES ('527', '公海客户', '523', '4', 'crm', 'CstCustomer/show_public', '1', '0', '1', '', '1', '1585054914', '1585041236', '1');
INSERT INTO `#@__sys_menu` VALUES ('528', '垃圾客户', '523', '6', 'crm', 'CstCustomer/show_rubbish', '1', '0', '1', '', '1', '1586423507', '1585041236', '1');
INSERT INTO `#@__sys_menu` VALUES ('529', '跟进记录', '523', '8', 'crm', 'CstTrace/show', '1', '0', '1', '', '1', '1586423511', '1585041236', '1');
INSERT INTO `#@__sys_menu` VALUES ('524', '客户列表', '523', '3', 'crm', 'CstCustomer/show', '1', '0', '1', '', '1', '1585054911', '1584771464', '1');
INSERT INTO `#@__sys_menu` VALUES ('525', '字典分类', '536', '1', 'crm', 'CstDictType/show', '1', '0', '1', '', '1', '1586426780', '1584772551', '1');
INSERT INTO `#@__sys_menu` VALUES ('526', '字典管理', '536', '2', 'crm', 'CstDict/show', '1', '0', '1', '', '1', '1586426773', '1584774176', '1');
INSERT INTO `#@__sys_menu` VALUES ('414', '友情链接', '466', '50', 'cms', 'Friendlink/show', '1', '0', '1', '', '1', '1582431187', '1575615775', '1');
INSERT INTO `#@__sys_menu` VALUES ('416', '留言表单', '466', '50', 'cms', 'guestbook/show', '1', '0', '1', '', '1', '1583115853', '1575615870', '1');
INSERT INTO `#@__sys_menu` VALUES ('417', '封面编辑', '479', '1', 'cms', 'Arctype/edit_content', '1', '0', '0', '', '1', '1582096410', '1575615930', '1');
INSERT INTO `#@__sys_menu` VALUES ('418', '内容删除', '479', '2', 'cms', 'Archives/del', '1', '0', '0', '', '1', '1582096359', '1575615951', '1');
INSERT INTO `#@__sys_menu` VALUES ('420', '系统管理', '0', '100', 'admin', 'admin', '1', '0', '1', 'fa-wrench', '1', '1611558977', '1575805253', '1');
INSERT INTO `#@__sys_menu` VALUES ('421', '行为日志', '420', '4', 'admin', 'Log/show', '1', '0', '1', 'fa-street-view', '1', '1581134860', '1575805707', '1');
INSERT INTO `#@__sys_menu` VALUES ('422', '企业会员', '2', '1', 'admin', 'SysOrg/show', '1', '0', '1', '', '1', '1581133400', '1575809624', '1');
INSERT INTO `#@__sys_menu` VALUES ('425', '菜单授权', '26', '2', 'admin', 'SysUser/userRules', '1', '0', '0', '', '1', '1581133421', '1576031324', '1');
INSERT INTO `#@__sys_menu` VALUES ('522', '网站配置', '466', '1', 'cms', 'website/setting', '1', '0', '1', '', '1', '0', '1583831718', '1');
INSERT INTO `#@__sys_menu` VALUES ('521', '图片浏览', '490', '6', 'cms', 'AdsList/show_json', '1', '0', '0', '', '1', '0', '1583807552', '1');
INSERT INTO `#@__sys_menu` VALUES ('520', '启用', '414', '1', 'cms', 'Friendlink/set_visible', '1', '0', '0', '', '1', '0', '1583808247', '1');
INSERT INTO `#@__sys_menu` VALUES ('519', '删除', '517', '1', 'cms', 'Guestbook/ext_del', '1', '0', '0', '', '1', '0', '1583808623', '1');
INSERT INTO `#@__sys_menu` VALUES ('430', '初始员工', '422', '5', 'admin', 'SysOrg/create_user', '1', '0', '0', '', '1', '1584771274', '1576816195', '1');
INSERT INTO `#@__sys_menu` VALUES ('518', '回复', '517', '1', 'cms', 'Guestbook/ext_reply', '1', '0', '0', '', '1', '0', '1583808623', '1');
INSERT INTO `#@__sys_menu` VALUES ('517', '留言管理', '416', '3', 'cms', 'Guestbook/ext_list', '1', '0', '0', '', '1', '0', '1583808580', '1');
INSERT INTO `#@__sys_menu` VALUES ('516', '修改', '512', '1', 'cms', 'GuestbookField/edit', '1', '0', '0', '', '1', '0', '1583808475', '1');
INSERT INTO `#@__sys_menu` VALUES ('515', '删除', '512', '1', 'cms', 'GuestbookField/del', '1', '0', '0', '', '1', '0', '1583808475', '1');
INSERT INTO `#@__sys_menu` VALUES ('514', '添加', '512', '1', 'cms', 'GuestbookField/add', '1', '0', '0', '', '1', '0', '1583808475', '1');
INSERT INTO `#@__sys_menu` VALUES ('513', '浏览', '512', '1', 'cms', 'GuestbookField/show_json', '1', '0', '0', '', '1', '0', '1583808475', '1');
INSERT INTO `#@__sys_menu` VALUES ('512', '留言字段', '416', '2', 'cms', 'GuestbookField/show', '1', '0', '0', '', '1', '0', '1583808430', '1');
INSERT INTO `#@__sys_menu` VALUES ('511', '表单修改', '416', '1', 'cms', 'Guestbook/edit', '1', '0', '0', '', '1', '0', '1583808354', '1');
INSERT INTO `#@__sys_menu` VALUES ('510', '表单删除', '416', '1', 'cms', 'Guestbook/del', '1', '0', '0', '', '1', '0', '1583808354', '1');
INSERT INTO `#@__sys_menu` VALUES ('509', '表单添加', '416', '1', 'cms', 'Guestbook/add', '1', '0', '0', '', '1', '0', '1583808354', '1');
INSERT INTO `#@__sys_menu` VALUES ('508', '修改', '414', '1', 'cms', 'Friendlink/edit', '1', '0', '0', '', '1', '0', '1583808247', '1');
INSERT INTO `#@__sys_menu` VALUES ('507', '删除', '414', '1', 'cms', 'Friendlink/del', '1', '0', '0', '', '1', '0', '1583808247', '1');
INSERT INTO `#@__sys_menu` VALUES ('506', '添加', '414', '1', 'cms', 'Friendlink/add', '1', '0', '0', '', '1', '0', '1583808247', '1');
INSERT INTO `#@__sys_menu` VALUES ('505', '浏览', '414', '1', 'cms', 'Friendlink/show_json', '1', '0', '0', '', '1', '0', '1583808247', '1');
INSERT INTO `#@__sys_menu` VALUES ('504', '模型字段启用', '499', '5', 'cms', 'ChannelField/set_visible', '1', '0', '0', '', '1', '0', '1583808057', '1');
INSERT INTO `#@__sys_menu` VALUES ('503', '模型字段修改', '499', '5', 'cms', 'ChannelField/edit', '1', '0', '0', '', '1', '0', '1583808057', '1');
INSERT INTO `#@__sys_menu` VALUES ('496', '模型添加', '474', '1', 'cms', 'Channel/add', '1', '0', '0', '', '1', '0', '1583807936', '1');
INSERT INTO `#@__sys_menu` VALUES ('497', '模型删除', '474', '1', 'cms', 'Channel/del', '1', '0', '0', '', '1', '0', '1583807936', '1');
INSERT INTO `#@__sys_menu` VALUES ('498', '模型修改', '474', '1', 'cms', 'Channel/edit', '1', '0', '0', '', '1', '0', '1583807936', '1');
INSERT INTO `#@__sys_menu` VALUES ('499', '模型字段列表', '474', '5', 'cms', 'ChannelField/show', '1', '0', '0', '', '1', '0', '1583808057', '1');
INSERT INTO `#@__sys_menu` VALUES ('500', '模型字段浏览', '499', '5', 'cms', 'ChannelField/show_json', '1', '0', '0', '', '1', '0', '1583808057', '1');
INSERT INTO `#@__sys_menu` VALUES ('501', '模型字段添加', '499', '5', 'cms', 'ChannelField/add', '1', '0', '0', '', '1', '0', '1583808057', '1');
INSERT INTO `#@__sys_menu` VALUES ('502', '模型字段删除', '499', '5', 'cms', 'ChannelField/del', '1', '0', '0', '', '1', '0', '1583808057', '1');
INSERT INTO `#@__sys_menu` VALUES ('495', '模型浏览', '474', '1', 'cms', 'Channel/show_json', '1', '0', '0', '', '1', '0', '1583807936', '1');
INSERT INTO `#@__sys_menu` VALUES ('494', '浏览', '475', '4', 'cms', 'Ads/show_json', '1', '0', '0', '', '1', '0', '1583807490', '1');
INSERT INTO `#@__sys_menu` VALUES ('493', '图片删除', '490', '7', 'cms', 'AdsList/del', '1', '0', '0', '', '1', '0', '1583807593', '1');
INSERT INTO `#@__sys_menu` VALUES ('492', '图片修改', '490', '7', 'cms', 'AdsList/edit', '1', '0', '0', '', '1', '0', '1583807593', '1');
INSERT INTO `#@__sys_menu` VALUES ('491', '图片添加', '490', '7', 'cms', 'AdsList/add', '1', '0', '0', '', '1', '0', '1583807593', '1');
INSERT INTO `#@__sys_menu` VALUES ('490', '图片管理', '475', '6', 'cms', 'AdsList/show', '1', '0', '0', '', '1', '0', '1583807552', '1');
INSERT INTO `#@__sys_menu` VALUES ('489', '删除', '475', '4', 'cms', 'Ads/del', '1', '0', '0', '', '1', '0', '1583807490', '1');
INSERT INTO `#@__sys_menu` VALUES ('462', '内容编辑', '479', '60', 'cms', 'Archives/edit', '1', '0', '0', '', '1', '1582096336', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('463', '栏目删除', '478', '62', 'cms', 'Arctype/del', '1', '0', '0', '', '1', '1608728164', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('464', '栏目添加', '478', '64', 'cms', 'Arctype/add', '1', '0', '0', '', '1', '1608728171', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('466', '内容系统', '0', '20', 'cms', 'cms', '1', '0', '1', '', '1', '1611558866', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('488', '修改', '475', '3', 'cms', 'Ads/edit', '1', '0', '0', '', '1', '0', '1583807457', '1');
INSERT INTO `#@__sys_menu` VALUES ('470', '数据浏览', '479', '60', 'cms', 'Archives/show_json', '1', '0', '0', '', '1', '1582096279', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('471', '内容添加', '479', '60', 'cms', 'Archives/add', '1', '0', '0', '', '1', '1582096500', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('472', '数据浏览', '478', '61', 'cms', 'Arctype/show_json', '1', '0', '0', '', '1', '1582082255', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('473', '栏目修改', '478', '63', 'cms', 'Arctype/edit', '1', '0', '0', '', '1', '1608728167', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('474', '模型管理', '466', '10', 'cms', 'Channel/show', '1', '0', '1', '', '1', '1581676000', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('475', '广告管理', '466', '4', 'cms', 'Ads/show', '1', '0', '1', '', '1', '1582362318', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('476', '文档管理', '465', '71', 'cms', 'Statistics/tm_travel_down', '1', '0', '1', '', '1', '1581670138', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('477', '分类管理', '465', '71', 'cms', 'Statistics/tm_travel_json', '1', '0', '1', '', '1', '1581670134', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('478', '栏目管理', '466', '2', 'cms', 'Arctype/show', '1', '0', '1', '', '1', '1581824277', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('479', '内容管理', '466', '3', 'cms', 'Archives/show', '1', '0', '1', '', '1', '1581943891', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('480', '编辑', '298', '1', 'admin', 'Config/configEdit', '1', '0', '0', '', '1', '1581134983', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('481', '添加', '298', '81', 'admin', 'Config/configAdd', '1', '0', '0', '', '1', '1581135029', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('487', '添加', '475', '3', 'cms', 'Ads/add', '1', '0', '0', '', '1', '0', '1583807424', '1');
INSERT INTO `#@__sys_menu` VALUES ('484', '插件列表', '20', '91', 'admin', 'addon/addon_list', '1', '0', '1', '', '1', '1582082099', '1577352700', '1');
INSERT INTO `#@__sys_menu` VALUES ('547', '授权管理', '0', '500', 'authorize', 'authorize', '1', '0', '1', '', '1', '1611558983', '1591580693', '1');
INSERT INTO `#@__sys_menu` VALUES ('548', '授权域名', '547', '0', 'authorize', 'admin.AuthDomain/show', '1', '0', '1', '', '1', '1608857602', '1591580693', '1');
INSERT INTO `#@__sys_menu` VALUES ('549', '授权版本', '547', '2', 'authorize', 'admin.AuthVersion/show', '1', '0', '1', '', '1', '1608857611', '1591783210', '1');
INSERT INTO `#@__sys_menu` VALUES ('550', '浏览', '31', '1', 'admin', 'SysDept/show_json', '1', '0', '0', '', '1', '0', '1608711142', '1');
INSERT INTO `#@__sys_menu` VALUES ('551', '添加', '31', '1', 'admin', 'SysDept/add', '1', '0', '0', '', '1', '0', '1608711142', '1');
INSERT INTO `#@__sys_menu` VALUES ('552', '修改', '31', '1', 'admin', 'SysDept/edit', '1', '0', '0', '', '1', '0', '1608711142', '1');
INSERT INTO `#@__sys_menu` VALUES ('553', '删除', '31', '1', 'admin', 'SysDept/del', '1', '0', '0', '', '1', '0', '1608711142', '1');
INSERT INTO `#@__sys_menu` VALUES ('554', '地区管理', '420', '2', 'admin', 'SysArea/show', '1', '0', '1', '', '1', '1608727430', '1608727390', '1');
INSERT INTO `#@__sys_menu` VALUES ('555', '浏览', '554', '1', 'admin', 'SysArea/show_json', '1', '0', '0', '', '1', '0', '1608727930', '1');
INSERT INTO `#@__sys_menu` VALUES ('556', '添加', '554', '1', 'admin', 'SysArea/add', '1', '0', '0', '', '1', '0', '1608727930', '1');
INSERT INTO `#@__sys_menu` VALUES ('557', '删除', '554', '1', 'admin', 'SysArea/del', '1', '0', '0', '', '1', '0', '1608727930', '1');
INSERT INTO `#@__sys_menu` VALUES ('558', '修改', '554', '1', 'admin', 'SysArea/edit', '1', '0', '0', '', '1', '0', '1608727930', '1');
INSERT INTO `#@__sys_menu` VALUES ('559', '启用', '554', '1', 'admin', 'SysArea/set_visible', '1', '0', '0', '', '1', '0', '1608727930', '1');
INSERT INTO `#@__sys_menu` VALUES ('560', '排序', '554', '1', 'admin', 'SysArea/set_sort', '1', '0', '0', '', '1', '0', '1608727930', '1');
INSERT INTO `#@__sys_menu` VALUES ('561', '设置负责人', '554', '1', 'admin', 'SysArea/manage', '1', '0', '0', '', '1', '0', '1608727930', '1');
INSERT INTO `#@__sys_menu` VALUES ('562', '栏目启用', '478', '72', 'cms', 'Arctype/set_visible', '1', '0', '0', '', '1', '1608728125', '1608728116', '1');
INSERT INTO `#@__sys_menu` VALUES ('563', '栏目排序', '478', '72', 'cms', 'Arctype/set_sort', '1', '0', '0', '', '1', '1608728125', '1608728116', '1');
INSERT INTO `#@__sys_menu` VALUES ('564', '模块扩展表', '474', '5', 'cms', 'Arcext/show', '1', '0', '0', '', '1', '1609836363', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('565', '扩展表浏览', '564', '5', 'cms', 'Arcext/show_json', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('566', '扩展表添加', '564', '5', 'cms', 'Arcext/add', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('567', '扩展表修改', '564', '5', 'cms', 'Arcext/edit', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('568', '扩展表删除', '564', '5', 'cms', 'Arcext/del', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('569', '扩展表字段', '564', '5', 'cms', 'ArcextField/show', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('570', '字段浏览', '569', '5', 'cms', 'ArcextField/show_json', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('571', '字段添加', '569', '5', 'cms', 'ArcextField/add', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('572', '字段删除', '569', '5', 'cms', 'ArcextField/del', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('573', '字段修改', '569', '5', 'cms', 'ArcextField/edit', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('574', '字段启用', '569', '5', 'cms', 'ArcextField/set_visible', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('575', '字段排序', '569', '5', 'cms', 'ArcextField/set_sort', '1', '0', '0', '', '1', '0', '1608774854', '1');
INSERT INTO `#@__sys_menu` VALUES ('576', '移动栏目', '479', '70', 'cms', 'Archives/move', '1', '0', '0', '', '1', '1608776035', '1608776029', '1');
INSERT INTO `#@__sys_menu` VALUES ('577', '扩展内容', '479', '80', 'cms', 'ArcextInfo/show', '1', '0', '0', '', '1', '1608776612', '1608776150', '1');
INSERT INTO `#@__sys_menu` VALUES ('578', '扩展内容浏览', '577', '80', 'cms', 'ArcextInfo/show_json', '1', '0', '0', '', '1', '0', '1608776150', '1');
INSERT INTO `#@__sys_menu` VALUES ('579', '扩展内容添加', '577', '80', 'cms', 'ArcextInfo/add', '1', '0', '0', '', '1', '0', '1608776150', '1');
INSERT INTO `#@__sys_menu` VALUES ('580', '扩展内容修改', '577', '80', 'cms', 'ArcextInfo/edit', '1', '0', '0', '', '1', '0', '1608776150', '1');
INSERT INTO `#@__sys_menu` VALUES ('581', '扩展内容删除', '577', '80', 'cms', 'ArcextInfo/del', '1', '0', '0', '', '1', '0', '1608776150', '1');
INSERT INTO `#@__sys_menu` VALUES ('582', '框架升级', '20', '5', 'admin', 'Upgrade/show', '1', '0', '1', '', '1', '1608865870', '1608865832', '1');
INSERT INTO `#@__sys_menu` VALUES ('583', '会员模块', '0', '30', 'member', 'member', '1', '0', '1', 'fa-users', '1', '1611558870', '1609836918', '1');
INSERT INTO `#@__sys_menu` VALUES ('584', '会员列表', '583', '1', 'member', 'admin.Member/show', '1', '0', '1', '', '1', '1618536807', '1609837035', '1');
INSERT INTO `#@__sys_menu` VALUES ('585', '会员等级', '583', '2', 'member', 'admin.MemberLevel/show', '1', '0', '1', '', '1', '0', '1609851837', '1');
INSERT INTO `#@__sys_menu` VALUES ('586', '会员产品', '583', '3', 'member', 'admin.MemberProductLevel/show', '1', '0', '1', '', '1', '0', '1609852257', '1');
INSERT INTO `#@__sys_menu` VALUES ('587', '积分产品', '583', '3', 'member', 'admin.MemberProductIntegral/show', '1', '0', '1', '', '1', '0', '1609852257', '1');
INSERT INTO `#@__sys_menu` VALUES ('588', '会员订单', '583', '3', 'member', 'admin.MemberOrder/show', '1', '0', '1', '', '1', '0', '1609852257', '1');
INSERT INTO `#@__sys_menu` VALUES ('589', '实名审核', '583', '2', 'member', 'admin.MemberRealname/show', '1', '0', '1', '', '1', '1609915478', '1609903611', '1');
INSERT INTO `#@__sys_menu` VALUES ('590', '图片审核', '583', '2', 'member', 'admin.MemberPicture/show', '1', '0', '1', '', '1', '1609915478', '1609903611', '1');
INSERT INTO `#@__sys_menu` VALUES ('591', '分类信息', '0', '40', 'cms', 'infomation', '1', '0', '1', '', '1', '0', '1611559077', '1');
INSERT INTO `#@__sys_menu` VALUES ('592', '信息管理', '591', '1', 'cms', 'info.Info/show', '1', '0', '1', '', '1', '0', '1611559118', '1');
INSERT INTO `#@__sys_menu` VALUES ('593', '浏览', '592', '1', 'cms', 'info.Info/show_json', '1', '0', '0', '', '1', '1611559372', '1611559118', '1');
INSERT INTO `#@__sys_menu` VALUES ('594', '添加', '592', '1', 'cms', 'info.Info/add', '1', '0', '0', '', '1', '0', '1611559118', '1');
INSERT INTO `#@__sys_menu` VALUES ('595', '修改', '592', '1', 'cms', 'info.Info/edit', '1', '0', '0', '', '1', '0', '1611559118', '1');
INSERT INTO `#@__sys_menu` VALUES ('596', '删除', '592', '1', 'cms', 'info.Info/del', '1', '0', '0', '', '1', '0', '1611559118', '1');
INSERT INTO `#@__sys_menu` VALUES ('597', '分类管理', '591', '2', 'cms', 'info.InfoType/show', '1', '0', '1', '', '1', '0', '1611559363', '1');
INSERT INTO `#@__sys_menu` VALUES ('598', '浏览', '597', '1', 'cms', 'info.InfoType/show_json', '1', '0', '0', '', '1', '0', '1611559418', '1');
INSERT INTO `#@__sys_menu` VALUES ('599', '添加', '597', '1', 'cms', 'info.InfoType/add', '1', '0', '0', '', '1', '0', '1611559418', '1');
INSERT INTO `#@__sys_menu` VALUES ('600', '修改', '597', '1', 'cms', 'info.InfoType/edit', '1', '0', '0', '', '1', '0', '1611559418', '1');
INSERT INTO `#@__sys_menu` VALUES ('601', '删除', '597', '1', 'cms', 'info.InfoType/del', '1', '0', '0', '', '1', '0', '1611559418', '1');
INSERT INTO `#@__sys_menu` VALUES ('602', '数据浏览', '584', '2', 'member', 'admin.Member/show_json', '1', '0', '0', '', '1', '1612670731', '1612669795', '1');
INSERT INTO `#@__sys_menu` VALUES ('603', '添加', '584', '1', 'member', 'admin.Member/add', '1', '0', '0', '', '1', '0', '1612669795', '1');
INSERT INTO `#@__sys_menu` VALUES ('604', '修改', '584', '1', 'member', 'admin.Member/edit', '1', '0', '0', '', '1', '0', '1612669795', '1');
INSERT INTO `#@__sys_menu` VALUES ('605', '删除', '584', '1', 'member', 'admin.Member/del', '1', '0', '0', '', '1', '0', '1612669795', '1');
INSERT INTO `#@__sys_menu` VALUES ('606', '数据浏览', '585', '2', 'member', 'admin.MemberLevel/show_json', '1', '0', '0', '', '1', '0', '1612670781', '1');
INSERT INTO `#@__sys_menu` VALUES ('607', '添加', '585', '2', 'member', 'admin.MemberLevel/add', '1', '0', '0', '', '1', '0', '1612670781', '1');
INSERT INTO `#@__sys_menu` VALUES ('608', '修改', '585', '2', 'member', 'admin.MemberLevel/edit', '1', '0', '0', '', '1', '0', '1612670781', '1');
INSERT INTO `#@__sys_menu` VALUES ('609', '删除', '585', '2', 'member', 'admin.MemberLevel/del', '1', '0', '0', '', '1', '0', '1612670781', '1');
INSERT INTO `#@__sys_menu` VALUES ('610', '行政区域', '420', '5', 'admin', 'Region/show', '1', '0', '1', '', '1', '0', '1614481890', '1');
INSERT INTO `#@__sys_menu` VALUES ('611', '浏览', '610', '1', 'admin', 'Region/show_json', '1', '0', '0', '', '1', '0', '1614481914', '1');
INSERT INTO `#@__sys_menu` VALUES ('2345', '数据浏览', '2341', '1', 'store', 'StoreFaq/show_json', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('626', '应用市场', '20', '1', 'admin', 'Store/apps', '1', '0', '1', '', '1', '1618106669', '1618050783', '1');
INSERT INTO `#@__sys_menu` VALUES ('627', '会员中心', '626', '1', 'admin', 'Store/user', '1', '0', '0', '', '1', '0', '1618113518', '1');
INSERT INTO `#@__sys_menu` VALUES ('2343', '修改', '2341', '1', 'store', 'StoreFaq/edit', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2344', '添加', '2341', '1', 'store', 'StoreFaq/add', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2341', '常见问题', '2317', '1', 'store', 'StoreFaq/show', '1', '0', '1', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2342', '删除', '2341', '1', 'store', 'StoreFaq/del', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2339', '添加', '2333', '3', 'store', 'StoreType/add', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2340', '数据浏览', '2333', '2', 'store', 'StoreType/show_json', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2338', '修改', '2333', '4', 'store', 'StoreType/edit', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2337', '删除', '2333', '5', 'store', 'StoreType/del', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2335', '排序', '2333', '7', 'store', 'StoreType/set_sort', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2336', '禁用', '2333', '6', 'store', 'StoreType/set_visible', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2334', '树形数据', '2333', '1', 'store', 'StoreType/get_list_tree', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2329', '销售订单', '2317', '1', 'store', 'StoreOrder/show', '1', '0', '1', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2330', '删除', '2329', '1', 'store', 'StoreOrder/del', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2331', '修改', '2329', '1', 'store', 'StoreOrder/edit', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2332', '数据浏览', '2329', '1', 'store', 'StoreOrder/show_json', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2333', '应用分类', '2317', '1', 'store', 'StoreType/show', '1', '0', '1', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2327', '添加', '2318', '2', 'store', 'Store/add', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2328', '数据浏览', '2318', '5', 'store', 'Store/show_json', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2326', '删除', '2318', '4', 'store', 'Store/edit', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2324', '查看详细', '2318', '1', 'store', 'Store/detail', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2325', '修改', '2318', '3', 'store', 'Store/del', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2320', '删除', '2319', '1', 'store', 'StoreVersion/del', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2321', '修改', '2319', '1', 'store', 'StoreVersion/edit', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2322', '添加', '2319', '1', 'store', 'StoreVersion/add', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2323', '数据浏览', '2319', '1', 'store', 'StoreVersion/show_json', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2319', '插件版本', '2318', '6', 'store', 'StoreVersion/show', '1', '0', '0', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2317', '应用商城', '0', '50', 'store', 'store', '1', '0', '1', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2318', '应用插件', '2317', '1', 'store', 'Store/show', '1', '0', '1', '', '1', '0', '1619149547', '1');
INSERT INTO `#@__sys_menu` VALUES ('2292', '删除', '2289', '1', 'book', 'BookChap/del', '1', '0', '0', '', '1', '0', '1618489555', '1');
INSERT INTO `#@__sys_menu` VALUES ('2291', '修改', '2289', '1', 'book', 'BookChap/edit', '1', '0', '0', '', '1', '0', '1618489555', '1');
INSERT INTO `#@__sys_menu` VALUES ('2289', '章节管理', '2284', '1', 'book', 'Book/chap', '1', '0', '0', '', '1', '0', '1618489555', '1');
INSERT INTO `#@__sys_menu` VALUES ('2290', '添加', '2289', '1', 'book', 'BookChap/add', '1', '0', '0', '', '1', '0', '1618489555', '1');
INSERT INTO `#@__sys_menu` VALUES ('2288', '删除', '2284', '1', 'book', 'Book/del', '1', '0', '0', '', '1', '0', '1618489555', '1');
INSERT INTO `#@__sys_menu` VALUES ('2287', '修改', '2284', '1', 'book', 'Book/edit', '1', '0', '0', '', '1', '0', '1618489555', '1');
INSERT INTO `#@__sys_menu` VALUES ('2285', '数据浏览', '2284', '1', 'book', 'Book/show_json', '1', '0', '0', '', '1', '0', '1618489555', '1');
INSERT INTO `#@__sys_menu` VALUES ('2286', '添加', '2284', '1', 'book', 'Book/add', '1', '0', '0', '', '1', '0', '1618489555', '1');
INSERT INTO `#@__sys_menu` VALUES ('2284', '文档管理', '0', '50', 'book', 'Book/show', '1', '0', '1', '', '1', '0', '1618489555', '1');

-- -----------------------------
-- Table structure for `#@__sys_module`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_module`;
CREATE TABLE `#@__sys_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统模块',
  `name` varchar(50) NOT NULL COMMENT '模块名(英文)',
  `identifier` varchar(100) NOT NULL COMMENT '模块标识(模块名(字母).开发者标识.module)',
  `title` varchar(50) NOT NULL COMMENT '模块标题',
  `intro` varchar(255) NOT NULL COMMENT '模块简介',
  `author` varchar(100) NOT NULL COMMENT '作者',
  `icon` varchar(80) NOT NULL DEFAULT 'aicon ai-mokuaiguanli' COMMENT '图标',
  `version` varchar(20) NOT NULL COMMENT '版本号',
  `author_url` varchar(255) NOT NULL COMMENT '链接',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `visible` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '是否启用',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未安装，1已经安装',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '默认模块(只能有一个)',
  `config` text COMMENT '配置',
  `app_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '应用市场ID(0本地)',
  `app_keys` varchar(200) DEFAULT '' COMMENT '应用秘钥',
  `tables` varchar(1024) DEFAULT '' COMMENT '模块关联数据表名',
  `theme` varchar(50) NOT NULL DEFAULT 'default' COMMENT '主题模板',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `org_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='[系统] 模块';

-- -----------------------------
-- Table structure for `#@__sys_org`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_org`;
CREATE TABLE `#@__sys_org` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) DEFAULT NULL COMMENT '用户名',
  `password` varchar(64) DEFAULT NULL COMMENT '密码',
  `company` varchar(64) DEFAULT NULL COMMENT '名称',
  `logo` varchar(64) DEFAULT NULL COMMENT 'logo',
  `start_date` date DEFAULT NULL COMMENT '开始日期',
  `stop_date` date DEFAULT NULL COMMENT '结束日期',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `visible` smallint(6) DEFAULT '1' COMMENT '是否隐藏 1=隐，0=正常',
  `linkman` varchar(32) DEFAULT NULL COMMENT '联系人',
  `mobile` varchar(32) DEFAULT NULL COMMENT '联系人手机号',
  `remark` varchar(256) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `org_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COMMENT='[系统]系统组织表';

-- -----------------------------
-- Records of `#@__sys_org`
-- -----------------------------
INSERT INTO `#@__sys_org` VALUES ('1', 'admin', 'c929dd40244b90f89ea78348bfdfcfb9', '零起飞网络中心', '', '2020-03-10', '2020-04-10', '0', '1', '李大哥', 'admin', '', '1583806365', '1591607760', '1');

-- -----------------------------
-- Table structure for `#@#_sys_postion`
-- -----------------------------
DROP TABLE IF EXISTS `#@#_sys_postion`;
CREATE TABLE `#@#_sys_postion` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL COMMENT '职位名称',
  `pid` int(11) DEFAULT NULL COMMENT '上线编号',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `visible` smallint(6) DEFAULT '1' COMMENT '1=显示，0=隐藏',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `org_id` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='[系统]系统职位表';