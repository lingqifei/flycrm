
-- -----------------------------
-- Table structure for `#@__action_log`
-- -----------------------------
DROP TABLE IF EXISTS `#@__action_log`;
CREATE TABLE `#@__action_log` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `sys_user_id` int(10) unsigned DEFAULT '0' COMMENT '执行会员id',
  `username` char(30) DEFAULT '' COMMENT '用户名',
  `ip` char(30) NOT NULL DEFAULT '' COMMENT '执行行为者ip',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '行为名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `url` varchar(1024) NOT NULL DEFAULT '' COMMENT '执行的URL',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '组织',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=509 DEFAULT CHARSET=utf8mb4 COMMENT='[系统]日志表';


-- -----------------------------
-- Table structure for `#@__addon`
-- -----------------------------
DROP TABLE IF EXISTS `#@__addon`;
CREATE TABLE `#@__addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '插件描述',
  `config` text COMMENT '配置',
  `author` varchar(40) NOT NULL DEFAULT '' COMMENT '作者',
  `version` varchar(20) NOT NULL DEFAULT '' COMMENT '版本号',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `org_id` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='[系统]插件表';

-- -----------------------------
-- Records of `addon`
-- -----------------------------
INSERT INTO `#@__addon` VALUES ('3', 'File', '文件上传', '文件上传插件', '', 'leo', '1.0', '1', '0', '0', '1');
INSERT INTO `#@__addon` VALUES ('4', 'Icon', '图标选择', '图标选择插件', '', 'leo', '1.0', '1', '0', '0', '1');
INSERT INTO `#@__addon` VALUES ('5', 'Editor', '文本编辑器', '富文本编辑器', '', 'leo', '1.0', '1', '0', '0', '1');
INSERT INTO `#@__addon` VALUES ('8', 'Region', '区域选择', '区域选择插件', '', 'leo', '1.0', '1', '0', '0', '1');

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
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `value` text COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COMMENT='配置表';

-- -----------------------------
-- Records of `config`
-- -----------------------------
INSERT INTO `#@__config` VALUES ('1', 'seo_title', '1', '系统标题', '1', '', '系统标题为登录页和管理中心浏览器标题显示内容~', '1378898976', '1627106145', '1', '零起飞企业管理系统~软件集ERP、CRM、OA在线办公等主要功能，PC和手机端一体化管理', '20');
INSERT INTO `#@__config` VALUES ('2', 'seo_description', '1', '系统描述', '1', '', '系统搜索引擎描述，优先级低于SEO模块', '1378898976', '1627106146', '1', '零起飞企业管理系统针对企业不同阶段提供不同的客户管理功能，以实现企业对客户管理的需要，网络中只需一台电脑安装本客户管理CRM系统，其它电脑均可通过浏览器使用。', '21');
INSERT INTO `#@__config` VALUES ('3', 'seo_keywords', '1', '系统关键字', '1', '', '网站搜索引擎关键字，优先级低于SEO模块', '1378898976', '1627106147', '1', '07fly', '22');
INSERT INTO `#@__config` VALUES ('9', 'config_type_list', '3', '配置类型列表', '3', '', '主要用于数据解析和页面表单的生成', '1378898976', '1581073821', '1', '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举\r\n5:图片\r\n6:文件\r\n7:富文本\r\n8:单选\r\n9:多选\r\n10:日期\r\n11:时间\r\n12:颜色', '100');
INSERT INTO `#@__config` VALUES ('20', 'config_group_list', '3', '配置分组', '3', '', '配置分组', '1379228036', '1581073821', '1', '1:基础\r\n2:数据\r\n3:系统\r\n4:API', '100');
INSERT INTO `#@__config` VALUES ('25', 'list_rows', '0', '每页数据记录数', '2', '', '数据每页显示记录数', '1379503896', '1611307743', '1', '10', '10');
INSERT INTO `#@__config` VALUES ('29', 'data_backup_part_size', '0', '数据库备份卷大小', '2', '', '该值用于限制压缩后的分卷最大长度。单位：B', '1381482488', '1611307743', '1', '10240000', '7');
INSERT INTO `#@__config` VALUES ('30', 'data_backup_compress', '4', '数据库备份文件是否启用压缩', '2', '0:不压缩\r\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '1381713345', '1611307743', '1', '1', '9');
INSERT INTO `#@__config` VALUES ('31', 'data_backup_compress_level', '4', '数据库备份文件压缩级别', '2', '1:普通\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '1381713408', '1611307743', '1', '9', '10');
INSERT INTO `#@__config` VALUES ('33', 'allow_url', '3', '不受权限验证的url', '3', '', '', '1386644047', '1581073821', '1', '0:file/pictureupload\r\n1:addon/execute\r\n2:admin/index/index\r\n3:admin/index/main', '100');
INSERT INTO `#@__config` VALUES ('43', 'empty_list_describe', '1', '数据列表为空时的描述信息', '2', '', '', '1492278127', '1611307743', '1', 'aOh! 暂时还没有数据~', '0');
INSERT INTO `#@__config` VALUES ('44', 'trash_config', '3', '回收站配置', '3', '', 'key为模型名称，值为显示列。', '1492312698', '1581073821', '1', 'Config:name\r\nAuthGroup:name\r\nMember:nickname\r\nMenu:name\r\nArticle:name\r\nArticleCategory:name\r\nAddon:name\r\nPicture:name\r\nFile:name\r\nActionLog:describe\r\nApi:name\r\nApiGroup:name\r\nBlogroll:name\r\nExeLog:exe_url\r\nSeo:name', '0');
INSERT INTO `#@__config` VALUES ('49', 'static_domain', '1', '静态资源域名', '1', '', '若静态资源为本地资源则此项为空，若为外部资源则为存放静态资源的域名', '1502430387', '1627097504', '1', '', '100');
INSERT INTO `#@__config` VALUES ('52', 'team_developer', '3', '研发团队人员', '4', '', '', '1504236453', '1582430537', '1', '0:零起飞\r\n1:开发人生', '0');
INSERT INTO `#@__config` VALUES ('53', 'api_status_option', '3', 'API接口状态', '4', '', '', '1504242433', '1582430537', '1', '0:待研发\r\n1:研发中\r\n2:测试中\r\n3:已完成', '0');
INSERT INTO `#@__config` VALUES ('54', 'api_data_type_option', '0', 'API数据类型', '4', '', '', '1504328208', '1582430704', '1', '0:字符\r\n1:文本\r\n2:数组\r\n3:文件', '0');
INSERT INTO `#@__config` VALUES ('55', 'web_theme', '1', '前端主题', '1', '', '', '1504762360', '1635488561', '1', 'default', '90');
INSERT INTO `#@__config` VALUES ('56', 'api_domain', '1', 'API部署域名', '4', '', '', '1504779094', '1582430537', '1', 'https://demo.07fly.org', '0');
INSERT INTO `#@__config` VALUES ('57', 'api_key', '0', 'API加密KEY', '4', '', '泄露后API将存在安全隐患', '1505302112', '1582430779', '1', 'l2V|gfZp{8`;jzR~6Y1_', '0');
INSERT INTO `#@__config` VALUES ('58', 'loading_icon', '4', '页面Loading图标设置', '1', '1:图标1\r\n2:图标2\r\n3:图标3\r\n4:图标4\r\n5:图标5\r\n6:图标6\r\n7:图标7', '页面Loading图标支持7种图标切换', '1505377202', '1627097504', '1', '7', '80');
INSERT INTO `#@__config` VALUES ('59', 'sys_file_field', '3', '文件字段配置', '3', '', 'key为模型名，值为文件列名。', '1505799386', '1581073821', '1', '0_article:file_id', '0');
INSERT INTO `#@__config` VALUES ('60', 'sys_picture_field', '0', '图片字段配置', '3', '', 'key为模型名，值为图片列名。', '1506315422', '1582430790', '1', '0_article:cover_id\r\n1_article:img_ids', '0');
INSERT INTO `#@__config` VALUES ('61', 'jwt_key', '0', 'JWT加密KEY', '4', '', '', '1506748805', '1594603727', '1', 'l2V|DSFXXXgfZp{8`;FjzR~6Y1_', '0');
INSERT INTO `#@__config` VALUES ('64', 'is_write_exe_log', '4', '是否写入执行记录', '3', '0:否\r\n1:是', '', '1510544340', '1581073821', '1', '1', '101');
INSERT INTO `#@__config` VALUES ('65', 'admin_allow_ip', '2', '超级管理员登录IP', '3', '', '后台超级管理员登录IP限制，其他角色不受限。', '1510995580', '1582430869', '1', '0:27.22.112.250', '0');
INSERT INTO `#@__config` VALUES ('66', 'pjax_mode', '8', 'PJAX模式', '3', '0:否\r\n1:是', '若为PJAX模式则浏览器不会刷新，若为常规模式则为AJAX+刷新', '1512370397', '1512982406', '1', '1', '120');
INSERT INTO `#@__config` VALUES ('67', 'is_auto_cache', '4', '系统缓存', '2', '0:否\r\n1:是', '', '1611307711', '1611307743', '1', '0', '0');
INSERT INTO `#@__config` VALUES ('68', 'login_title', '1', '登录界面名称', '1', '', '', '1627094196', '1627097504', '1', '零起飞企业管理系统', '10');
INSERT INTO `#@__config` VALUES ('69', 'login_desc', '1', '登录界面描述', '1', '', '', '1627094283', '1627097504', '1', '软件集ERP、CRM、OA在线办公等主要功能，PC和手机端一体化管理', '11');
INSERT INTO `#@__config` VALUES ('70', 'login_demo', '1', '登录演示帐号', '1', '', '', '1627094351', '1627097504', '1', '<font color=\'red\'>演示帐号/密码：admin/123456</font>', '12');
INSERT INTO `#@__config` VALUES ('71', 'login_copyright', '1', '登录界面版权', '1', '', '登录界面输入框下面技术支持', '1627095435', '1627097504', '1', '<a href=‘http://www.07fly.xyz’>技术支持:成都零起飞科技</a>', '13');
INSERT INTO `#@__config` VALUES ('72', 'main_title', '1', '管理中心名称', '1', '', '后台管理中心左上角名称信息', '1627106086', '1627106532', '1', '零起飞网络中心', '1');
INSERT INTO `#@__config` VALUES ('73', 'main_weburl', '1', '官网地址', '1', '', '', '1635488412', '1635488563', '1', 'http://www.07fly.xyz', '70');

-- -----------------------------
-- Table structure for `#@__driver`
-- -----------------------------
DROP TABLE IF EXISTS `#@__driver`;
CREATE TABLE `#@__driver` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `service_name` varchar(40) NOT NULL DEFAULT '' COMMENT '服务标识',
  `driver_name` varchar(20) NOT NULL DEFAULT '' COMMENT '驱动标识',
  `config` text COMMENT '配置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='插件表';

-- -----------------------------
-- Table structure for `#@__hook`
-- -----------------------------
DROP TABLE IF EXISTS `#@__hook`;
CREATE TABLE `#@__hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `addon_list` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '创建时间',
  `org_id` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '组织机构',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='[系统]钩子表';

-- -----------------------------
-- Records of `hook`
-- -----------------------------
INSERT INTO `#@__hook` VALUES ('36', 'File', '文件上传钩子', 'File', '1', '0', '0', '1');
INSERT INTO `#@__hook` VALUES ('37', 'Icon', '图标选择钩子', 'Icon', '1', '0', '0', '1');
INSERT INTO `#@__hook` VALUES ('38', 'ArticleEditor', '富文本编辑器', 'Editor', '1', '0', '0', '1');
INSERT INTO `#@__hook` VALUES ('41', 'RegionSelect', '区域选择', 'Region', '1', '0', '0', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='图片表';

-- -----------------------------
-- Table structure for `#@__file`
-- -----------------------------
DROP TABLE IF EXISTS `#@__file`;
CREATE TABLE `#@__file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '保存名称',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '远程地址',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='[系统]文件表';

-- -----------------------------
-- Table structure for `#@__region`
-- -----------------------------
DROP TABLE IF EXISTS `#@__region`;
CREATE TABLE `#@__region` (
  `id` int(7) NOT NULL COMMENT '主键',
  `name` varchar(40) DEFAULT '' COMMENT '省市区名称',
  `upid` int(7) DEFAULT '0' COMMENT '上级ID',
  `shortname` varchar(40) DEFAULT '' COMMENT '简称',
  `level` tinyint(2) DEFAULT '0' COMMENT '级别:0,中国；1，省分；2，市；3，区、县',
  `citycode` varchar(7) DEFAULT '' COMMENT '城市代码',
  `zipcode` varchar(7) DEFAULT '' COMMENT '邮编',
  `lng` varchar(20) DEFAULT '' COMMENT '经度',
  `lat` varchar(20) DEFAULT '' COMMENT '纬度',
  `pinyin` varchar(40) DEFAULT '' COMMENT '拼音',
  `visible` enum('0','1') DEFAULT '1' COMMENT '是否启用',
  `sort` int(7) DEFAULT '500' COMMENT '排序',
  `ishot` enum('0','1') DEFAULT '0' COMMENT '是否热点',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `org_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
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
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='唯一序号生成表';

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
  `rules` text COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `sys_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '100',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `org_id` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='[系统]权限组表';

-- -----------------------------
-- Records of `sys_auth`
-- -----------------------------
INSERT INTO `#@__sys_auth` VALUES ('1', '', '企业超级管理', '本权限为企业帐号注册初次的权限列表', '1', '1532,7381,7382,7383,7384,7385,4785,4789,4788,4787,4786,1533,1534,7351,7649,6664,6665,6666,6670,6671,6672,6669,6668,6667,6673,6677,6679,6678,6676,6674,6675,6726,6741,6745,6744,6747,6746,6742,6743,6734,6735,6736,6739,6740,6738,6737,6727,6731,6733,6732,6730,6729,6728,7636,7637,7638,7642,7641,7640,7639,7643,7647,7646,7645,7644,6680,6712,6717,6718,6713,6714,6715,6716,6704,6709,6710,6707,6708,6706,6705,6711,6697,6701,6702,6703,6699,6700,6698,6689,6695,6690,6694,6693,6692,6691,6696,6681,6686,6688,6687,6685,6683,6684,6682,6719,6724,6723,6725,6722,6721,6720,6490,7308,6503,6508,6510,6506,6507,6505,6504,6509,6511,6499,6501,6500,7341,6502,6491,6496,6497,6495,6492,6493,6494,6498,7342,7616,7618,7617,7619,7620,6431,6434,6436,6435,6437,6438,6439,6440,6442,7623,6444,7337,7338,7339,7340,6441,6443,6432,6433,6470,6474,6476,6475,6473,6472,6471,6477,6478,6479,6483,6484,6482,6481,6480,6454,6462,6464,6463,6461,6459,6458,6460,6455,6457,6456,6465,6468,6467,6466,6469,6445,6451,6453,6452,6450,6449,6446,6448,6447,6485,6486,6487,6488,6489,6646,6647,6648,6650,6649,6651,6653,6652,7343,6655,6654,6656,6657,6660,6661,6658,6659,6662,6663,6512,6515,6521,6525,6522,6524,6523,6516,6517,6519,6520,6528,6518,6531,6527,6526,6530,6529,6513,6514,6532,6534,6538,6533,6537,6539,6540,6541,6536,6535,6542,6547,6546,6549,6543,6544,6545,6548,6550,6568,6570,6569,6604,6607,6606,6605,6608,6609,6614,6616,6613,6612,6611,6610,6615,6600,6601,6602,6603,6592,6597,6599,6596,6595,6594,6593,6598,6558,6559,6560,6566,6565,6564,6562,6563,6561,6567,6571,6578,6579,6576,6577,6575,6572,6573,6574,6580,6581,6589,6590,6587,6588,6585,6586,6583,6584,6582,6591,6551,6556,6557,6554,6555,6553,6552,6617,6639,6643,6644,6642,6641,6640,6645,6632,6636,6637,6634,6635,6633,6638,6625,6628,6626,6629,6630,6631,6627,6618,6622,6624,6620,6623,6621,6619,7283,7284,7285,7286,7287,7288,7289,7297,7298,7299,7301,7300,7302,7303,7290,7291,7292,7293,7294,7295,7296,1542,1574,1571,1572,1573,1567,7352,7353,7354,7355,7356,7621,4780,4782,4781,4783,4784,7380,7309,7365,7366,7367,7368,7369,7370,7371,7372,7373,7374,7375,1584,1585,7364,7363,7361,7362,7360,1576,1583,1582,1581,1580,1579,1578,1577,1575,7357,7358,7359,1543,1562,7376,7377,1564,1563,1565,1566,1557,1561,1560,1559,1558,1550,1553,1555,1552,1551,7332,1554,1556,1544,1549,1548,1547,1546,1545,1764,1767,1768,1769,1770,1771,1765,1766,1568,1569,1570,1535,1540,1541,1539,7577,7572,7573,7574,7575,7576,1536,7589,7588,7587,7586,7585,7584,7582,7583,7581,7580,7579,1538,1537,7304', '1', '0', '1645761138', '1569638911', '1');
INSERT INTO `#@__sys_auth` VALUES ('2', '', '基本信息配置管理员', '管理基本信息配置', '1', '1,324,20,27,47,48,49,50,28,39,40,41,42,29,43,44,45,46,30,51,52,53,54,31,55,56,57,58,32,59,60,61,62,33,63,64,65,66,67,80,81,82,83,68,84,85,86,87,69,88,89,90,91,70,92,93,94,95,71,96,97,98,99,72,100,101,102,103,73,104,105,106,107,74,108,109,110,111,75,112,113,114,115,76,116,117,118,119,77,120,121,122,123,78,124,125,126,127,79,128,129,130,131', '1', '1', '1576464669', '1570796576', '101');
INSERT INTO `#@__sys_auth` VALUES ('22', '', '高级管理员', '这个角色可以管理系统所有栏目及功能按钮', '1', '1433,1437,1441,1440,1438,1439,1454,1460,1458,1459,1455,1436,1445,1444,1443,1442,1435,1448,1449,1447,1446,1434,1453,1452,1450,1451,1475,1472,1483,1479,1480,1478,1476,1477,1473,1474,1482,1481,1470,1471,1,333,334,324,465,476,477,466,478,479,475,474,414,416,2,430,51,53,54,31,25,34,35,36,37,38,26,305,17,18,19,425,385,298,480,481,20,21,484,153', '35', '1', '1606289571', '1575169788', '101');
INSERT INTO `#@__sys_auth` VALUES ('27', '', '管理员组', '', '1', '1,333,334,324,2,25,34,35,36,37,38,26,302,305,425,17,18,19', '69', '0', '1581135400', '1581135380', '110');

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
-- Table structure for `#@__sys_dept`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_dept`;
CREATE TABLE `#@__sys_dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '' COMMENT '部门名称',
  `pid` int(11) DEFAULT '0' COMMENT '上线编号',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `visible` smallint(6) DEFAULT '1' COMMENT '1=显示，0=隐藏',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `org_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='[系统]部门表';

-- -----------------------------
-- Records of `sys_dept`
-- -----------------------------
INSERT INTO `#@__sys_dept` VALUES ('1', '商务部', '5', '6', '1', '0', '1627638023', '1');
INSERT INTO `#@__sys_dept` VALUES ('2', '技术部', '5', '5', '1', '0', '1627638004', '1');
INSERT INTO `#@__sys_dept` VALUES ('3', '人事事', '5', '3', '1', '0', '1627637983', '1');
INSERT INTO `#@__sys_dept` VALUES ('4', '财务部', '5', '4', '1', '0', '1627637992', '1');
INSERT INTO `#@__sys_dept` VALUES ('5', '公司总部', '0', '2', '1', '0', '1627637968', '1');
INSERT INTO `#@__sys_dept` VALUES ('6', '销售二部', '1', '2', '1', '1625122660', '0', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=7745 DEFAULT CHARSET=utf8 COMMENT='[系统]菜单表';

-- -----------------------------
-- Records of `sys_menu`
-- -----------------------------
INSERT INTO `#@__sys_menu` VALUES (1532, '系统首页', 0, 1, 'admin', 'index/main', 1, 0, 1, '', 1, 1635480985, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1533, '资料修改', 1532, 12, 'admin', 'SysUser/editInfo', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1534, '密码修改', 1532, 13, 'admin', 'SysUser/editPwd', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1535, '系统扩展', 0, 1100, 'admin', 'system extend', 1, 0, 1, 'fa-fire', 1, 1620444341, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1536, '本地模块', 1535, 20, 'admin', 'SysModule/show', 1, 0, 1, 'fa-user-secret', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1537, '钩子列表', 1535, 40, 'admin', 'addon/hook_list', 1, 0, 1, '', 1, 1627107141, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1538, '插件列表', 1535, 30, 'admin', 'addon/addon_list', 1, 0, 1, '', 1, 1627107139, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1539, '框架升级', 1535, 4, 'admin', 'Upgrade/show', 1, 0, 1, '', 1, 1627107162, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1540, '应用市场', 1535, 1, 'admin', 'Store/apps', 1, 0, 1, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1541, '会员中心', 1540, 1, 'admin', 'Store/user', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1542, '系统管理', 0, 1000, 'admin', 'system admin', 1, 0, 1, 'fa-wrench', 1, 1620444336, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1543, '组织结构', 1542, 100, 'admin', 'organization', 1, 0, 1, 'fa-sitemap', 1, 1635474789, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1544, '权限列表', 1543, 3, 'admin', 'SysAuth/show', 1, 0, 1, 'fa-circle-o', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1545, '权限浏览', 1544, 2, 'admin', 'SysAuth/show_json', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1546, '权限添加', 1544, 2, 'admin', 'SysAuth/add', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1547, '权限修改', 1544, 2, 'admin', 'SysAuth/edit', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1548, '权限删除', 1544, 2, 'admin', 'SysAuth/del', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1549, '菜单授权', 1544, 2, 'admin', 'SysAuth/MenuAuth', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1550, '系统用户', 1543, 3, 'admin', 'SysUser/show', 1, 0, 1, 'fa-circle-o', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1551, '用户添加', 1550, 3, 'admin', 'SysUser/add', 1, 0, 0, 'fa-circle-o', 1, 1631589111, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1552, '用户删除', 1550, 2, 'admin', 'SysUser/del', 1, 0, 0, 'fa-circle-o', 1, 1631589109, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1553, '用户修改', 1550, 1, 'admin', 'SysUser/edit', 1, 0, 0, 'fa-circle-o', 1, 1631589108, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1554, '用户授权', 1550, 5, 'admin', 'SysUser/userAuth', 1, 0, 0, '', 1, 1631589116, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1555, '用户浏览', 1550, 2, 'admin', 'SysUser/show_json', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1556, '菜单授权', 1550, 6, 'admin', 'SysUser/userRules', 1, 0, 0, '', 1, 1631589122, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1557, '部门管理', 1543, 2, 'admin', 'SysDept/show', 1, 0, 1, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1558, '浏览', 1557, 1, 'admin', 'SysDept/show_json', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1559, '添加', 1557, 1, 'admin', 'SysDept/add', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1560, '修改', 1557, 1, 'admin', 'SysDept/edit', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1561, '删除', 1557, 1, 'admin', 'SysDept/del', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1562, '企业会员', 1543, 1, 'admin', 'SysOrg/show', 1, 0, 1, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1563, '企业删除', 1562, 3, 'admin', 'SysOrg/del', 1, 0, 0, '', 1, 1635319015, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1564, '企业修改', 1562, 2, 'admin', 'SysOrg/edit', 1, 0, 0, '', 1, 1635319013, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1565, '密码重置', 1562, 4, 'admin', 'SysOrg/reset_pwd', 1, 0, 0, '', 1, 1635319018, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1566, '初始员工', 1562, 5, 'admin', 'SysOrg/create_user', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1567, '系统菜单', 1542, 3, 'admin', 'SysMenu/show', 1, 0, 1, 'fa-user', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1568, '数据库管理', 1542, 110, 'admin', 'database manage', 1, 0, 1, 'fa-database', 1, 1635474791, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1569, '数据备份', 1568, 1, 'admin', 'Database/databackup', 1, 0, 1, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1570, '数据恢复', 1568, 2, 'admin', 'Database/dataRestore', 1, 0, 1, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1571, '配置列表', 1542, 2, 'admin', 'config/configlist', 1, 0, 1, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1572, '编辑', 1571, 1, 'admin', 'Config/configEdit', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1573, '添加', 1571, 81, 'admin', 'Config/configAdd', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1574, '系统设置', 1542, 1, 'admin', 'config/setting', 1, 0, 1, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1575, '行为日志', 1542, 70, 'admin', 'Log/show', 1, 0, 1, 'fa-street-view', 1, 1635474740, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1576, '地区管理', 1542, 61, 'admin', 'SysArea/show', 1, 0, 1, '', 1, 1635474717, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1577, '浏览', 1576, 1, 'admin', 'SysArea/show_json', 1, 0, 0, '', 1, 1628152507, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1578, '添加', 1576, 1, 'admin', 'SysArea/add', 1, 0, 0, '', 1, 1628152505, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1579, '删除', 1576, 1, 'admin', 'SysArea/del', 1, 0, 0, '', 1, 1628152506, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1580, '修改', 1576, 1, 'admin', 'SysArea/edit', 1, 0, 0, '', 1, 1628152504, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1581, '启用', 1576, 1, 'admin', 'SysArea/set_visible', 1, 0, 0, '', 1, 1628152503, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1582, '排序', 1576, 1, 'admin', 'SysArea/set_sort', 1, 0, 0, '', 1, 1628152503, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1583, '设置负责人', 1576, 1, 'admin', 'SysArea/manage', 1, 0, 0, '', 1, 1628152502, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1584, '行政区域', 1542, 60, 'admin', 'Region/show', 1, 0, 1, '', 1, 1635474709, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1585, '浏览', 1584, 1, 'admin', 'Region/show_json', 1, 0, 0, '', 1, 0, 1619269238, 1);
INSERT INTO `#@__sys_menu` VALUES (1764, '职位管理', 1543, 4, 'admin', 'SysPosition/show', 1, 0, 1, '', 1, 1620480535, 1620480531, 1);
INSERT INTO `#@__sys_menu` VALUES (1765, '数据浏览', 1764, 6, 'admin', 'SysPosition/show_json', 1, 0, 0, '', 1, 1620481740, 1620480613, 1);
INSERT INTO `#@__sys_menu` VALUES (1766, '树形数据浏览', 1764, 7, 'admin', 'SysPosition/get_list_tree', 1, 0, 0, '', 1, 1620481744, 1620480613, 1);
INSERT INTO `#@__sys_menu` VALUES (1767, '添加', 1764, 1, 'admin', 'SysPosition/add', 1, 0, 0, '', 1, 0, 1620480613, 1);
INSERT INTO `#@__sys_menu` VALUES (1768, '修改', 1764, 2, 'admin', 'SysPosition/edit', 1, 0, 0, '', 1, 1620481729, 1620480613, 1);
INSERT INTO `#@__sys_menu` VALUES (1769, '删除', 1764, 3, 'admin', 'SysPosition/del', 1, 0, 0, '', 1, 1620481731, 1620480613, 1);
INSERT INTO `#@__sys_menu` VALUES (1770, '排序', 1764, 4, 'admin', 'SysPosition/set_sort', 1, 0, 0, '', 1, 1620481733, 1620480613, 1);
INSERT INTO `#@__sys_menu` VALUES (1771, '禁用', 1764, 5, 'admin', 'SysPosition/set_visible', 1, 0, 0, '', 1, 1620481735, 1620480613, 1);
INSERT INTO `#@__sys_menu` VALUES (4780, '系统公告', 1542, 20, 'admin', 'OaNotify/show', 1, 0, 1, '', 1, 1635475072, 1621217144, 1);
INSERT INTO `#@__sys_menu` VALUES (4781, '添加', 4780, 2, 'admin', 'OaNotify/add', 1, 0, 0, '', 1, 1635476695, 1621217144, 1);
INSERT INTO `#@__sys_menu` VALUES (4782, '浏览', 4780, 1, 'admin', 'OaNotify/show_json', 1, 0, 0, '', 1, 1635476695, 1621217144, 1);
INSERT INTO `#@__sys_menu` VALUES (4783, '修改', 4780, 3, 'admin', 'OaNotify/edit', 1, 0, 0, '', 1, 1635476694, 1621217144, 1);
INSERT INTO `#@__sys_menu` VALUES (4784, '删除', 4780, 4, 'admin', 'OaNotify/del', 1, 0, 0, '', 1, 1635476693, 1621217144, 1);
INSERT INTO `#@__sys_menu` VALUES (4785, '系统公告', 1532, 1, 'admin', 'OaNotifyUser/show', 1, 0, 1, '', 1, 1635493785, 1621217144, 1);
INSERT INTO `#@__sys_menu` VALUES (4786, '数据浏览', 4785, 2, 'admin', 'OaNotifyUser/show_json', 1, 0, 0, '', 1, 1635493672, 1621217144, 1);
INSERT INTO `#@__sys_menu` VALUES (4787, '标记已读', 4785, 2, 'admin', 'OaNotifyUser/read', 1, 0, 0, '', 1, 1635493673, 1621217144, 1);
INSERT INTO `#@__sys_menu` VALUES (4788, '删除', 4785, 2, 'admin', 'OaNotifyUser/del', 1, 0, 0, '', 1, 1635493675, 1621217144, 1);
INSERT INTO `#@__sys_menu` VALUES (4789, '查看详细', 4785, 2, 'admin', 'OaNotifyUser/detail', 1, 0, 0, '', 1, 1635493675, 1621217144, 1);
INSERT INTO `#@__sys_menu` VALUES (7304, '服务管理', 1535, 50, 'admin', 'Service/serviceList', 1, 0, 1, '', 1, 1627107156, 1627107109, 1);
INSERT INTO `#@__sys_menu` VALUES (7309, '系统消息', 1542, 21, 'admin', 'SysMsg/show', 1, 0, 1, '', 1, 1635474727, 1631268069, 1);
INSERT INTO `#@__sys_menu` VALUES (7332, '用户选择', 1550, 4, 'admin', 'SysUser/lookup', 1, 0, 0, '', 1, 1647071151, 1631589088, 1);
INSERT INTO `#@__sys_menu` VALUES (7352, '数据浏览', 1567, 1, 'admin', 'SysMenu/show_json', 1, 0, 0, '', 1, 0, 1635317210, 1);
INSERT INTO `#@__sys_menu` VALUES (7353, '添加', 1567, 2, 'admin', 'SysMenu/add', 1, 0, 0, '', 1, 0, 1635317210, 1);
INSERT INTO `#@__sys_menu` VALUES (7354, '修改', 1567, 3, 'admin', 'SysMenu/edit', 1, 0, 0, '', 1, 0, 1635317210, 1);
INSERT INTO `#@__sys_menu` VALUES (7355, '删除', 1567, 4, 'admin', 'SysMenu/del', 1, 0, 0, '', 1, 0, 1635317210, 1);
INSERT INTO `#@__sys_menu` VALUES (7356, '禁用', 1567, 5, 'admin', 'SysMenu/set_visible', 1, 0, 0, '', 1, 0, 1635317210, 1);
INSERT INTO `#@__sys_menu` VALUES (7357, '数据浏览', 1575, 1, 'admin', 'Log/show_json', 1, 0, 0, '', 1, 0, 1635317335, 1);
INSERT INTO `#@__sys_menu` VALUES (7358, '删除', 1575, 2, 'admin', 'Log/del', 1, 0, 0, '', 1, 0, 1635317335, 1);
INSERT INTO `#@__sys_menu` VALUES (7359, '清空全部', 1575, 3, 'admin', 'Log/clear', 1, 0, 0, '', 1, 0, 1635317335, 1);
INSERT INTO `#@__sys_menu` VALUES (7360, '添加', 1584, 2, 'admin', 'Region/add', 1, 0, 0, '', 1, 0, 1635317435, 1);
INSERT INTO `#@__sys_menu` VALUES (7361, '修改', 1584, 2, 'admin', 'Region/edit', 1, 0, 0, '', 1, 0, 1635317435, 1);
INSERT INTO `#@__sys_menu` VALUES (7362, '删除', 1584, 2, 'admin', 'Region/del', 1, 0, 0, '', 1, 0, 1635317435, 1);
INSERT INTO `#@__sys_menu` VALUES (7363, '禁用', 1584, 2, 'admin', 'Region/set_visible', 1, 0, 0, '', 1, 0, 1635317435, 1);
INSERT INTO `#@__sys_menu` VALUES (7364, '排序', 1584, 2, 'admin', 'Region/set_sort', 1, 0, 0, '', 1, 0, 1635317435, 1);
INSERT INTO `#@__sys_menu` VALUES (7365, '数据浏览', 7309, 1, 'admin', 'SysMsg/show_json', 1, 0, 0, '', 1, 0, 1635317532, 1);
INSERT INTO `#@__sys_menu` VALUES (7366, '添加', 7309, 2, 'admin', 'SysMsg/add', 1, 0, 0, '', 1, 0, 1635317532, 1);
INSERT INTO `#@__sys_menu` VALUES (7367, '修改', 7309, 3, 'admin', 'SysMsg/edit', 1, 0, 0, '', 1, 0, 1635317532, 1);
INSERT INTO `#@__sys_menu` VALUES (7368, '删除', 7309, 4, 'admin', 'SysMsg/del', 1, 0, 0, '', 1, 0, 1635317532, 1);
INSERT INTO `#@__sys_menu` VALUES (7369, '处理', 7309, 5, 'admin', 'SysMsg/set_visible', 1, 0, 0, '', 1, 0, 1635317532, 1);
INSERT INTO `#@__sys_menu` VALUES (7370, '提醒配置', 7309, 6, 'admin', 'SysMsgType/show', 1, 0, 0, '', 1, 0, 1635317532, 1);
INSERT INTO `#@__sys_menu` VALUES (7371, '数据浏览', 7370, 1, 'admin', 'SysMsgType/show_json', 1, 0, 0, '', 1, 0, 1635317694, 1);
INSERT INTO `#@__sys_menu` VALUES (7372, '添加', 7370, 2, 'admin', 'SysMsgType/add', 1, 0, 0, '', 1, 0, 1635317694, 1);
INSERT INTO `#@__sys_menu` VALUES (7373, '修改', 7370, 3, 'admin', 'SysMsgType/edit', 1, 0, 0, '', 1, 0, 1635317694, 1);
INSERT INTO `#@__sys_menu` VALUES (7374, '删除', 7370, 4, 'admin', 'SysMsgType/del', 1, 0, 0, '', 1, 0, 1635317694, 1);
INSERT INTO `#@__sys_menu` VALUES (7375, '提醒设置', 7370, 5, 'admin', 'SysMsgType/set_visible', 1, 0, 0, '', 1, 0, 1635317694, 1);
INSERT INTO `#@__sys_menu` VALUES (7376, '数据浏览', 1562, 1, 'admin', 'SysOrg/show_json', 1, 0, 0, '', 1, 0, 1635318939, 1);
INSERT INTO `#@__sys_menu` VALUES (7377, '添加', 1562, 1, 'admin', 'SysOrg/add', 1, 0, 0, '', 1, 0, 1635318939, 1);
INSERT INTO `#@__sys_menu` VALUES (7380, '详细', 4780, 5, 'admin', 'OaNotify/detail', 1, 0, 0, '', 1, 0, 1635476674, 1);
INSERT INTO `#@__sys_menu` VALUES (7381, '我的消息', 1532, 1, 'admin', 'SysMsg/show_my', 1, 0, 1, '', 1, 1635493808, 1635480949, 1);
INSERT INTO `#@__sys_menu` VALUES (7382, '数据浏览', 7381, 1, 'admin', 'SysMsg/show_json', 1, 0, 0, '', 1, 1635493881, 1635493869, 1);
INSERT INTO `#@__sys_menu` VALUES (7383, '单个处理', 7381, 2, 'admin', 'SysMsg/set_visible', 1, 0, 0, '', 1, 0, 1635496137, 1);
INSERT INTO `#@__sys_menu` VALUES (7384, '批量处理', 7381, 3, 'admin', 'SysMsg/set_deal', 1, 0, 0, '', 1, 0, 1635496177, 1);
INSERT INTO `#@__sys_menu` VALUES (7385, '消息删除', 7381, 4, 'admin', 'SysMsg/del', 1, 0, 0, '', 1, 0, 1635496346, 1);
INSERT INTO `#@__sys_menu` VALUES (7572, '软件注册', 1539, 2, 'admin', 'Upgrade/reg', 1, 0, 0, '', 1, 1636959500, 1636959304, 1);
INSERT INTO `#@__sys_menu` VALUES (7573, '升级包列表', 1539, 3, 'admin', 'Upgrade/lists', 1, 0, 0, '', 1, 1636959502, 1636959304, 1);
INSERT INTO `#@__sys_menu` VALUES (7574, '升级包详细', 1539, 4, 'admin', 'Upgrade/info', 1, 0, 0, '', 1, 1636959504, 1636959304, 1);
INSERT INTO `#@__sys_menu` VALUES (7575, '升级包下载', 1539, 5, 'admin', 'Upgrade/down', 1, 0, 0, '', 1, 1636959505, 1636959304, 1);
INSERT INTO `#@__sys_menu` VALUES (7576, '升级包删除', 1539, 6, 'admin', 'Upgrade/del', 1, 0, 0, '', 1, 1636959505, 1636959304, 1);
INSERT INTO `#@__sys_menu` VALUES (7577, '升级执行', 1539, 1, 'admin', 'Upgrade/execute', 1, 0, 0, '', 1, 1636959319, 1636959304, 1);
INSERT INTO `#@__sys_menu` VALUES (7579, '数据浏览', 1536, 1, 'admin', 'SysModule/show_json', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7580, '添加', 1536, 1, 'admin', 'SysModule/add', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7581, '修改', 1536, 1, 'admin', 'SysModule/edit', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7582, '删除', 1536, 1, 'admin', 'SysModule/del', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7583, '排序', 1536, 1, 'admin', 'SysModule/set_sort', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7584, '启用', 1536, 1, 'admin', 'SysModule/set_visible', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7585, '备份', 1536, 1, 'admin', 'SysModule/backup', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7586, '上传导入', 1536, 1, 'admin', 'SysModule/upload', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7587, '安装', 1536, 1, 'admin', 'SysModule/install', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7588, '卸载', 1536, 1, 'admin', 'SysModule/uninstall', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7589, '同步', 1536, 1, 'admin', 'SysModule/synctable', 1, 0, 0, '', 1, 0, 1641377069, 1);
INSERT INTO `#@__sys_menu` VALUES (7656, '移动', 1567, 7, 'admin', 'SysMenu/move', 1, 0, 0, '', 1, 1647055530, 1647055488, 1);
INSERT INTO `#@__sys_menu` VALUES (7657, '复制', 1567, 6, 'admin', 'SysMenu/copy', 1, 0, 0, '', 1, 0, 1647055488, 1);
INSERT INTO `#@__sys_menu` VALUES (7658, '安装设置', 7304, 1, 'admin', 'Service/driverInstall', 1, 0, 0, '', 1, 0, 1647056181, 1);


-- -----------------------------
-- Table structure for `#@__sys_module`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_module`;
CREATE TABLE `#@__sys_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统模块',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '模块名(英文)',
  `identifier` varchar(100) NOT NULL DEFAULT '' COMMENT '模块标识(模块名(字母).开发者标识.module)',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '模块标题',
  `intro` varchar(255) NOT NULL DEFAULT '' COMMENT '模块简介',
  `author` varchar(100) NOT NULL DEFAULT '' COMMENT '作者',
  `icon` varchar(80) NOT NULL DEFAULT 'aicon ai-mokuaiguanli' COMMENT '图标',
  `version` varchar(20) NOT NULL DEFAULT '' COMMENT '版本号',
  `author_url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `visible` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '是否启用',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未安装，1已经安装',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '默认模块(只能有一个)',
  `config` varchar(1024) NOT NULL DEFAULT '' COMMENT '配置',
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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='[系统] 模块';

-- -----------------------------
-- Table structure for `#@__sys_org`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_org`;
CREATE TABLE `#@__sys_org` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `company` varchar(64) NOT NULL DEFAULT '' COMMENT '名称',
  `start_date` date DEFAULT NULL COMMENT '开始日期',
  `stop_date` date DEFAULT NULL COMMENT '结束日期',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `visible` smallint(6) DEFAULT '1' COMMENT '是否隐藏 1=隐，0=正常',
  `linkman` varchar(32) DEFAULT '' COMMENT '联系人',
  `mobile` varchar(32) DEFAULT '' COMMENT '联系人手机号',
  `remark` varchar(256) DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `org_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COMMENT='[系统]企业组织';

-- -----------------------------
-- Records of `sys_org`
-- -----------------------------
INSERT INTO `#@__sys_org` VALUES ('1', 'admin', 'c929dd40244b90f89ea78348bfdfcfb9', '07FLY-ERP开发', '2020-03-10', '2020-04-10', '0', '1', '李大哥', 'admin', '', '1583806365', '1619682526', '1');
INSERT INTO `#@__sys_org` VALUES ('122', '07fly', '4e6ee1b742f998507391910a6ae3f3b0', '成都零起飞网络', '2020-03-10', '2020-04-10', '0', '1', '李大大', '07fly', '', '1583806401', '1586098750', '1');

-- -----------------------------
-- Table structure for `#@__sys_position`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_position`;
CREATE TABLE `#@__sys_position` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(64) DEFAULT '' COMMENT '职位名称',
  `pid` int(11) DEFAULT '0' COMMENT '上线编号',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `data_role` int(16) NOT NULL DEFAULT '1' COMMENT '职位数据权限',
  `visible` smallint(6) DEFAULT '1' COMMENT '1=显示，0=隐藏',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `org_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='[系统]职位表';

-- -----------------------------
-- Records of `sys_position`
-- -----------------------------
INSERT INTO `#@__sys_position` VALUES ('6', '总经理', '0', '100', '4', '1', '1601259971', '1627957633', '1');
INSERT INTO `#@__sys_position` VALUES ('7', '组长', '6', '2', '3', '1', '1601260007', '1627638498', '1');
INSERT INTO `#@__sys_position` VALUES ('8', '组员', '7', '1', '2', '1', '1601260021', '1627637111', '1');

-- -----------------------------
-- Table structure for `#@__sys_user`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_user`;
CREATE TABLE `#@__sys_user` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `realname` varchar(64) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `gender` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别',
  `dept_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所在部门',
  `position_id` int(2) NOT NULL DEFAULT '1' COMMENT '职位id号',
  `email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `qicq` varchar(64) NOT NULL DEFAULT '',
  `mobile` varchar(32) NOT NULL DEFAULT '' COMMENT '手机',
  `intro` varchar(256) NOT NULL DEFAULT '' COMMENT '介绍',
  `rules` mediumtext COMMENT '权限节点',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `visible` int(11) NOT NULL DEFAULT '1' COMMENT '1=显示、0=隐藏',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '组织结构',
  `is_rank` int(11) NOT NULL DEFAULT '1' COMMENT '是否参与排名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COMMENT='[系统]用户表';

-- -----------------------------
-- Records of `sys_user`
-- -----------------------------
INSERT INTO `#@__sys_user` VALUES ('1', 'admin', '4e6ee1b742f998507391910a6ae3f3b0', '零起飞', '1', '5', '6', 'test@test.com', '', '', '', '', '0', '1648005720', '0', '1', '1', '1');
-- -----------------------------
-- Table structure for `#@__sys_area`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_area`;
CREATE TABLE `#@__sys_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '' COMMENT '地区名称',
  `domain` varchar(128) NOT NULL DEFAULT '' COMMENT '绑定域名',
  `pid` int(11) DEFAULT '0' COMMENT '上级编号',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `visible` smallint(6) DEFAULT '1' COMMENT '1=显示，0=隐藏',
  `manager_user_id` varchar(256) DEFAULT '' COMMENT '管理人员',
  `manager_user_name` varchar(1024) DEFAULT '' COMMENT '管理人员名称',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `org_id` int(11) DEFAULT '1',
  `tel` varchar(50) DEFAULT '' COMMENT '联系电话',
  `linkman` varchar(50) DEFAULT '' COMMENT '联系人',
  `address` varchar(256) DEFAULT '' COMMENT '联系地址',
  `talk` varchar(1024) DEFAULT '' COMMENT '在线沟通',
  `weixin` varchar(1024) DEFAULT '' COMMENT '微信图片地址',
  `mobile` varchar(50) DEFAULT '' COMMENT '手机号码',
  `traffic` varchar(1024) DEFAULT '' COMMENT '交通线路',
  `email` varchar(128) DEFAULT '' COMMENT '电子邮箱',
  `map_x` varchar(64) DEFAULT '' COMMENT '地址X坐标',
  `map_y` varchar(64) DEFAULT '' COMMENT '地址Y坐标',
  `popup` varchar(1024) DEFAULT '' COMMENT '底部沟通',
  `beian` varchar(1024) DEFAULT '' COMMENT '底部备案',
  `fullname` varchar(1024) DEFAULT '' COMMENT '公司全称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='[系统]地区表';

-- -----------------------------
-- Records of `sys_area`
-- -----------------------------
INSERT INTO `#@__sys_area` VALUES ('1', '成都', 'http://www.07fly.com', '0', '1', '1', '1,84,1', '开发人生,匆道,开发人生', '1597672045', '1608727787', '1', '028-61833149', '李先生', '四川省成都市量力钢材城4-3-3', '', '', '028-61833149', '地铁4号线', 'goodmuzi@qq.com', '104.072642', '30.674467', '', '', '成都零起飞科技有限公司');

-- -----------------------------
-- Table structure for `#@__sys_area_user`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_area_user`;
CREATE TABLE `#@__sys_area_user` (
  `sys_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `sys_area_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '地区id',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `org_id` int(10) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='[系统]地区授权表';

-- -----------------------------
-- Records of `sys_area_user`
-- -----------------------------
INSERT INTO `#@__sys_area_user` VALUES ('1', '1', '0', '1608727787', '1');
INSERT INTO `#@__sys_area_user` VALUES ('84', '1', '0', '1608727787', '1');
INSERT INTO `#@__sys_area_user` VALUES ('1', '1', '0', '1608727787', '1');

-- -----------------------------
-- Table structure for `#@__sys_msg`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_msg`;
CREATE TABLE `#@__sys_msg` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `bus_type` varchar(256) NOT NULL DEFAULT '' COMMENT '业务类型',
  `bus_type_name` varchar(256) NOT NULL DEFAULT '' COMMENT '业务类型名称',
  `bus_id` int(16) DEFAULT '0' COMMENT '业务id',
  `bus_name` varchar(256) NOT NULL DEFAULT '' COMMENT '业务名称',
  `deal_time` datetime DEFAULT NULL COMMENT '业务处理时间',
  `deal_remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `deal_status` int(16) NOT NULL DEFAULT '0' COMMENT '0=待处理，1=已经处理',
  `deal_user_id` int(16) NOT NULL DEFAULT '0' COMMENT '提醒处理人员',
  `uniquekey` varchar(256) NOT NULL DEFAULT '' COMMENT '业务提醒标识',
  `remind_status` int(16) DEFAULT '1' COMMENT '0=未提醒，1=提醒中，2=不提醒了',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `remind_sms` int(2) NOT NULL DEFAULT '0' COMMENT '短信提醒 0=不开启，1=开启',
  `remind_sys` int(2) DEFAULT '0' COMMENT '系统提醒 0=不开启，1=开启',
  `remind_email` int(2) DEFAULT '0' COMMENT '邮箱提醒 0=不开启，1=开启',
  `remind_weixin` int(2) DEFAULT '0' COMMENT '微信提醒 0=不开启，1=开启',
  `bus_url` varchar(256) NOT NULL DEFAULT '' COMMENT '业务详细地址',
  `remind_time` datetime DEFAULT NULL COMMENT '提醒处理时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=353 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]系统消息';

-- -----------------------------
-- Table structure for `#@__sys_msg_type`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_msg_type`;
CREATE TABLE `#@__sys_msg_type` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '业务类型名称',
  `type` varchar(256) NOT NULL DEFAULT '' COMMENT '业务类型标识',
  `maintable` varchar(256) NOT NULL DEFAULT '' COMMENT '业务主要表',
  `url` varchar(256) NOT NULL DEFAULT '' COMMENT '业务详细地址',
  `remark` varchar(256) NOT NULL DEFAULT '' COMMENT '事件说明',
  `hours` int(11) NOT NULL DEFAULT '0' COMMENT '提前多小时提醒',
  `remind_sms` int(2) NOT NULL DEFAULT '0' COMMENT '短信提醒 0=不开启，1=开启',
  `remind_sys` int(2) DEFAULT '0' COMMENT '系统提醒 0=不开启，1=开启',
  `remind_email` int(2) DEFAULT '0' COMMENT '邮箱提醒 0=不开启，1=开启',
  `remind_weixin` int(2) DEFAULT '0' COMMENT '微信提醒 0=不开启，1=开启',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]系统消息配置';

-- -----------------------------
-- Records of `sys_msg_type`fff
-- -----------------------------
INSERT INTO `#@__sys_msg_type` VALUES ('1', '线索跟进', 'cst_clue', '', '10', '有新的线索需要跟进时提醒操作人员', '24', '1', '1', '0', '0', '1635313485', '1635412895', '1');
INSERT INTO `#@__sys_msg_type` VALUES ('2', '客户跟进', 'cst_customer', '', '10', '有新的客户需要跟进时提醒操作人员', '24', '1', '1', '0', '0', '1635313894', '1635412903', '1');
INSERT INTO `#@__sys_msg_type` VALUES ('3', '商机跟进', 'cst_chance', '', '10', '有新的销售机会（商机）需要跟进时提醒操作人员', '24', '1', '1', '0', '0', '1635313894', '1635412901', '1');
INSERT INTO `#@__sys_msg_type` VALUES ('4', '销售合同', 'sal_contract', '', '10', '有新的销售合同需要跟进时提醒操作人员', '24', '1', '1', '0', '0', '1635313894', '1635412900', '1');
INSERT INTO `#@__sys_msg_type` VALUES ('5', '销售订单', 'sal_order', '', '10', '有新的销售订单需要跟进时提醒操作人员', '24', '1', '1', '0', '0', '1635313894', '1635412899', '1');
INSERT INTO `#@__sys_msg_type` VALUES ('6', '销售合同到期', 'sal_contract_expire', '', '10', '有销售合同即将到期需要跟进时提醒操作人员', '721', '1', '1', '0', '0', '1635313894', '1635412897', '1');

-- -----------------------------
-- Table structure for `#@__oa_notify`
-- -----------------------------
DROP TABLE IF EXISTS `#@__oa_notify`;
CREATE TABLE `#@__oa_notify` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '标题',
  `content` varchar(2560) NOT NULL DEFAULT '' COMMENT '内容',
  `rece_type` int(2) NOT NULL DEFAULT '0' COMMENT '接收类型0=全体人员，1=指定人员',
  `rece_user_id` varchar(2560) NOT NULL DEFAULT '' COMMENT '接收对象',
  `rece_user_name` varchar(2560) NOT NULL DEFAULT '' COMMENT '接收对象名称',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `create_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建人员id',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='系统通知';


-- -----------------------------
-- Table structure for `#@__oa_notify_user`
-- -----------------------------
DROP TABLE IF EXISTS `#@__oa_notify_user`;
CREATE TABLE `#@__oa_notify_user` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `notify_id` int(11) NOT NULL DEFAULT '0' COMMENT '公告id',
  `owner_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '接收人员id',
  `read_state` int(2) NOT NULL DEFAULT '0' COMMENT '是否读过',
  `read_time` datetime DEFAULT NULL COMMENT '查看时间',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `create_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '发布人员',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='系统通知用户表';
