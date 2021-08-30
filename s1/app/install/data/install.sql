
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
) ENGINE=MyISAM AUTO_INCREMENT=404 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='[系统]日志表';

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='[系统]插件表';

-- -----------------------------
-- Records of `addon`
-- -----------------------------
INSERT INTO `#@__addon` VALUES ('5', 'Editor', '文本编辑器', '富文本编辑器', '', 'lingqifei', '1.0.1', '1', '0', '0', '1');
INSERT INTO `#@__addon` VALUES ('4', 'Icon', '图标选择', '图标选择插件', '', 'lingqifei', '1.0.1', '1', '0', '0', '1');
INSERT INTO `#@__addon` VALUES ('3', 'File', '文件上传', '文件上传插件', '', 'lingqifei', '1.0.1', '1', '0', '0', '1');
INSERT INTO `#@__addon` VALUES ('6', 'Region', '区域选择', '区域选择插件', '', 'lingqifei', '1.0.1', '1', '0', '0', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COMMENT='[系统]配置表';

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
INSERT INTO `#@__config` VALUES ('55', 'web_theme', '1', '前端主题', '1', '', '', '1504762360', '1627097504', '1', 'default', '80');
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='[系统]插件表';

-- -----------------------------
-- Records of `driver`
-- -----------------------------
INSERT INTO `#@__driver` VALUES ('1', 'Pay', 'Alipay', 'a:6:{s:14:\"alipay_account\";s:5:\"34345\";s:14:\"alipay_partner\";s:0:\"\";s:10:\"alipay_key\";s:0:\"\";s:12:\"alipay_appid\";s:0:\"\";s:20:\"alipay_rsaPrivateKey\";s:0:\"\";s:25:\"alipay_alipayrsaPublicKey\";s:0:\"\";}', '1', '1577678491', '1577678512');
INSERT INTO `#@__driver` VALUES ('2', 'Pay', 'Wxpay', 'a:4:{s:5:\"appid\";s:3:\"app\";s:9:\"appsecret\";s:0:\"\";s:9:\"partnerid\";s:0:\"\";s:10:\"partnerkey\";s:0:\"\";}', '1', '1585016761', '0');
INSERT INTO `#@__driver` VALUES ('4', 'Sms', 'Tencent', 'a:2:{s:6:\"app_id\";s:10:\"1400398383\";s:7:\"app_key\";s:32:\"2710810b835c5915a394f378801f8440\";}', '1', '1594522417', '1594524494');

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='图片表';

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
  `org_id` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='[系统]省市区行政表';


-- -----------------------------
-- Table structure for `#@__sequence`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sequence`;
CREATE TABLE `#@__sequence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '前缀',
  `current_date` varchar(255) NOT NULL DEFAULT '' COMMENT '当前日期',
  `current_value` int(11) DEFAULT '0' COMMENT '当前值',
  `increment` int(11) DEFAULT '1' COMMENT '增加值',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `org_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统]唯一序号生成表';

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
INSERT INTO `#@__sys_auth` VALUES ('1', '', '企业超级管理', '本权限为企业帐号注册初次的权限列表', '1', '1433,1437,1441,1440,1438,1439,1454,1460,1458,1459,1455,1436,1445,1444,1443,1442,1435,1448,1449,1447,1446,1434,1453,1452,1450,1451,1475,1472,1483,1478,1476,1477,1479,1480,1508,1484,1491,1492,1493,1494,1495,1496,1498,1485,1501,1502,1503,1504,1505,1506,1507,1486,1509,1510,1511,1512,1513,1514,1515,1473,1474,1482,1481,1497,1499,1500,1470,1471,1487,1516,1517,1518,1519,1520,1521,1488,1489,1490,1,333,334,324,536,525,691,690,692,693,694,695,526,698,697,699,700,701,702,532,533,704,703,705,706,707,708,534,710,709,711,712,713,714,535,716,715,717,718,719,720,537,538,722,721,723,724,725,726,539,728,727,729,730,731,732,1048,540,734,733,735,736,737,738,541,740,739,741,742,743,744,1045,542,746,745,747,748,749,750,751,753,752,754,755,756,757,543,759,758,760,761,762,763,523,524,765,764,766,767,770,771,1075,1076,527,772,773,528,531,775,774,776,777,778,779,1077,1078,530,781,780,782,783,784,785,1079,529,787,786,788,789,790,544,545,793,792,794,795,796,797,798,801,800,799,1080,1081,1082,1083,546,803,802,804,805,806,810,809,808,465,547,812,811,813,814,815,816,817,820,819,818,1084,1085,1086,1087,548,1088,476,828,821,829,822,823,824,825,826,827,477,831,830,832,833,834,835,1089,466,522,836,837,478,838,839,840,1046,479,842,841,843,844,845,846,1047,475,847,848,1049,474,850,849,851,852,853,854,1090,414,1050,416,856,855,857,858,859,860,1051,517,862,861,863,864,865,868,867,866,1052,512,870,869,871,872,873,877,876,875,874,1053,549,555,558,879,878,880,881,882,1054,557,884,883,885,886,887,1055,556,559,889,888,890,891,892,1056,560,1060,1061,1059,1058,1057,1062,552,553,1066,1067,1065,1064,1063,1068,554,899,898,900,901,902,1069,561,563,904,903,905,906,896,907,562,909,908,910,911,912,1070,550,914,913,915,916,917,1071,551,922,420,2,430,51,53,54,31,925,924,926,928,929,1072,25,34,35,36,37,38,932,933,26,305,17,18,19,425,943,937,938,385,298,945,1073,480,481,4,947,950,951,1074,421,952,953,954,23,303,304,20,21,960,966,484,969,970,971,153,689,972,973,974,975,976', '1', '0', '1609227440', '1569638911', '1');
INSERT INTO `#@__sys_auth` VALUES ('2', '', '基本信息配置管理员', '管理基本信息配置', '1', '1,324,20,27,47,48,49,50,28,39,40,41,42,29,43,44,45,46,30,51,52,53,54,31,55,56,57,58,32,59,60,61,62,33,63,64,65,66,67,80,81,82,83,68,84,85,86,87,69,88,89,90,91,70,92,93,94,95,71,96,97,98,99,72,100,101,102,103,73,104,105,106,107,74,108,109,110,111,75,112,113,114,115,76,116,117,118,119,77,120,121,122,123,78,124,125,126,127,79,128,129,130,131', '1', '1', '1576464669', '1570796576', '101');
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
-- Records of `sys_auth_access`
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
INSERT INTO `#@__sys_auth_access` VALUES ('83', '1', '1606272650', '1606272650', '1');
INSERT INTO `#@__sys_auth_access` VALUES ('83', '22', '1606272650', '1606272650', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='[系统]部门表';

-- -----------------------------
-- Records of `sys_dept`
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
) ENGINE=MyISAM AUTO_INCREMENT=1772 DEFAULT CHARSET=utf8 COMMENT='[系统]菜单表';

-- -----------------------------
-- Records of `sys_menu`
-- -----------------------------
INSERT INTO `#@__sys_menu` VALUES ('1585', '浏览', '1584', '1', 'admin', 'Region/show_json', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1584', '行政区域', '1542', '5', 'admin', 'Region/show', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1583', '设置负责人', '1576', '1', 'admin', 'SysArea/manage', '1', '0', '0', '', '1', '1620482818', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1582', '排序', '1576', '1', 'admin', 'SysArea/set_sort', '1', '0', '0', '', '1', '1620482819', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1581', '启用', '1576', '1', 'admin', 'SysArea/set_visible', '1', '0', '0', '', '1', '1620482819', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1580', '修改', '1576', '1', 'admin', 'SysArea/edit', '1', '0', '0', '', '1', '1620482820', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1579', '删除', '1576', '1', 'admin', 'SysArea/del', '1', '0', '0', '', '1', '1620482821', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1578', '添加', '1576', '1', 'admin', 'SysArea/add', '1', '0', '0', '', '1', '1620482822', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1577', '浏览', '1576', '1', 'admin', 'SysArea/show_json', '1', '0', '0', '', '1', '1620482822', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1576', '地区管理', '1542', '2', 'admin', 'SysArea/show', '1', '0', '1', '', '1', '1620482810', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1575', '行为日志', '1542', '4', 'admin', 'Log/show', '1', '0', '1', 'fa-street-view', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1574', '系统设置', '1542', '1', 'admin', 'config/setting', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1573', '添加', '1571', '81', 'admin', 'Config/configAdd', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1572', '编辑', '1571', '1', 'admin', 'Config/configEdit', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1571', '配置列表', '1542', '2', 'admin', 'config/configlist', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1570', '数据恢复', '1568', '2', 'admin', 'Database/dataRestore', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1569', '数据备份', '1568', '1', 'admin', 'Database/databackup', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1568', '数据库管理', '1542', '10', 'admin', 'Database/show', '1', '0', '1', 'fa-database', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1567', '系统菜单', '1542', '3', 'admin', 'SysMenu/show', '1', '0', '1', 'fa-user', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1566', '初始员工', '1562', '5', 'admin', 'SysOrg/create_user', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1565', '密码重置', '1562', '100', 'admin', 'SysOrg/reset_pwd', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1564', '企业修改', '1562', '100', 'admin', 'SysOrg/edit', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1563', '企业删除', '1562', '100', 'admin', 'SysOrg/del', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1562', '企业会员', '1543', '1', 'admin', 'SysOrg/show', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1561', '删除', '1557', '1', 'admin', 'SysDept/del', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1560', '修改', '1557', '1', 'admin', 'SysDept/edit', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1559', '添加', '1557', '1', 'admin', 'SysDept/add', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1558', '浏览', '1557', '1', 'admin', 'SysDept/show_json', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1557', '部门管理', '1543', '2', 'admin', 'SysDept/show', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1556', '菜单授权', '1550', '2', 'admin', 'SysUser/userRules', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1555', '用户浏览', '1550', '2', 'admin', 'SysUser/show_json', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1554', '用户授权', '1550', '1', 'admin', 'SysUser/userAuth', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1553', '用户修改', '1550', '10', 'admin', 'SysUser/edit', '1', '0', '0', 'fa-circle-o', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1552', '用户删除', '1550', '10', 'admin', 'SysUser/del', '1', '0', '0', 'fa-circle-o', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1551', '用户添加', '1550', '10', 'admin', 'SysUser/add', '1', '0', '0', 'fa-circle-o', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1550', '系统用户', '1543', '3', 'admin', 'SysUser/show', '1', '0', '1', 'fa-circle-o', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1549', '菜单授权', '1544', '2', 'admin', 'SysAuth/MenuAuth', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1548', '权限删除', '1544', '2', 'admin', 'SysAuth/del', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1547', '权限修改', '1544', '2', 'admin', 'SysAuth/edit', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1546', '权限添加', '1544', '2', 'admin', 'SysAuth/add', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1545', '权限浏览', '1544', '2', 'admin', 'SysAuth/show_json', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1544', '权限列表', '1543', '3', 'admin', 'SysAuth/show', '1', '0', '1', 'fa-circle-o', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1543', '组织结构', '1542', '9', 'admin', 'index/main', '1', '0', '1', 'fa-sitemap', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1542', '系统管理', '0', '1000', 'admin', 'system admin', '1', '0', '1', 'fa-wrench', '1', '1620444336', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1541', '会员中心', '1540', '1', 'admin', 'Store/user', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1540', '应用市场', '1535', '1', 'admin', 'Store/apps', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1536', '本地模块', '1535', '20', 'admin', 'SysModule/show', '1', '0', '1', 'fa-user-secret', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1537', '钩子列表', '1535', '100', 'admin', 'addon/hook_list', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1538', '插件列表', '1535', '91', 'admin', 'addon/addon_list', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1539', '框架升级', '1535', '5', 'admin', 'Upgrade/show', '1', '0', '1', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1534', '密码修改', '1532', '13', 'admin', 'SysUser/editPwd', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1535', '系统扩展', '0', '1100', 'admin', 'system extend', '1', '0', '1', 'fa-fire', '1', '1620444341', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1532', '系统首页', '0', '1', 'admin', 'index/main', '1', '0', '1', '', '1', '1619754197', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1533', '资料修改', '1532', '12', 'admin', 'SysUser/editInfo', '1', '0', '0', '', '1', '0', '1619269238', '1');
INSERT INTO `#@__sys_menu` VALUES ('1771', '禁用', '1764', '5', 'admin', 'SysPosition/set_visible', '1', '0', '0', '', '1', '1620481735', '1620480613', '1');
INSERT INTO `#@__sys_menu` VALUES ('1764', '职位管理', '1543', '4', 'admin', 'SysPosition/show', '1', '0', '1', '', '1', '1620480535', '1620480531', '1');
INSERT INTO `#@__sys_menu` VALUES ('1765', '数据浏览', '1764', '6', 'admin', 'SysPosition/show_json', '1', '0', '0', '', '1', '1620481740', '1620480613', '1');
INSERT INTO `#@__sys_menu` VALUES ('1766', '树形数据浏览', '1764', '7', 'admin', 'SysPosition/get_list_tree', '1', '0', '0', '', '1', '1620481744', '1620480613', '1');
INSERT INTO `#@__sys_menu` VALUES ('1767', '添加', '1764', '1', 'admin', 'SysPosition/add', '1', '0', '0', '', '1', '0', '1620480613', '1');
INSERT INTO `#@__sys_menu` VALUES ('1768', '修改', '1764', '2', 'admin', 'SysPosition/edit', '1', '0', '0', '', '1', '1620481729', '1620480613', '1');
INSERT INTO `#@__sys_menu` VALUES ('1769', '删除', '1764', '3', 'admin', 'SysPosition/del', '1', '0', '0', '', '1', '1620481731', '1620480613', '1');
INSERT INTO `#@__sys_menu` VALUES ('1770', '排序', '1764', '4', 'admin', 'SysPosition/set_sort', '1', '0', '0', '', '1', '1620481733', '1620480613', '1');
INSERT INTO `#@__sys_menu` VALUES ('7304', '服务管理', '1535', '50', 'admin', 'Service/serviceList', '1', '0', '1', '', '1', '1627107156', '1627107109', '1');
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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='[系统]模块';

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
-- Table structure for `#@__sys_position`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_position`;
CREATE TABLE `#@__sys_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '' COMMENT '职位名称',
  `pid` int(11) DEFAULT '0' COMMENT '上线编号',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `data_role` int(11) DEFAULT '1' COMMENT '数据权限',
  `visible` smallint(6) DEFAULT '1' COMMENT '1=显示，0=隐藏',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  `org_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='[系统]职位表';

-- -----------------------------
-- Records of `sys_position`
-- -----------------------------
INSERT INTO `#@__sys_position` VALUES ('6', '总经理', '0', '100', '1', '1601259971', '0', '1');
INSERT INTO `#@__sys_position` VALUES ('7', '组长', '6', '2', '1', '1601260007', '0', '1');
INSERT INTO `#@__sys_position` VALUES ('8', '组员', '7', '1', '1', '1601260021', '0', '1');

-- -----------------------------
-- Table structure for `#@__sys_user`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sys_user`;
CREATE TABLE `#@__sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `realname` varchar(64) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `gender` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别',
  `dept_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所在部门',
  `position_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '所在职位',
  `email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `qicq` varchar(64) NOT NULL DEFAULT '',
  `mobile` varchar(32) NOT NULL DEFAULT '' COMMENT '手机',
  `intro` varchar(256) NOT NULL DEFAULT '' COMMENT '介绍',
  `rules` text COMMENT '权限节点',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `visible` int(11) NOT NULL DEFAULT '1' COMMENT '1=显示、0=隐藏',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '组织结构',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COMMENT='[系统]用户表';

-- -----------------------------
-- Records of `sys_user`
-- -----------------------------
INSERT INTO `#@__sys_user` VALUES ('1', 'admin', 'c929dd40244b90f89ea78348bfdfcfb9', '零起飞', '1', '1', '6', 'test@test.com', '', '', '', '1,333,334,324,2,25,34,35,36,37,38,26,302,305,425,17,18,19,20,27,47,48,49,50,28,39,40,41,42,29,43,44,45,46,30,430,51,52,53,54,31,55,56,57,58,32,59,60,61,62,33,63,64,65,66,67,80,81,82,83,68,84,85,86,87,69,88,89,90,91,70,92,93,94,95,71,96,97,98,99,72,100,101,102,103,73,104,105,106,107,74,108,109,110,111,75,112,113,114,115,76,116,117,118,119,77,120,121,122,123,78,124,125,126,127,79,128,129,130,131,21,132,154,155,156,157,310,311,312,315,316,317,313,318,319,320,314,321,322,323,426,134,158,159,427,133,160,161,162,163,165,166,164,261,330,327,328,329,403,399,400,135,167,168,262,169,170,171,263,172,173,174,136,175,264,137,176,265,331,332,401,341,343,344,141,142,177,178,179,180,181,428,461,266,182,183,184,267,185,186,187,268,188,189,190,143,293,301,429,145,191,269,195,196,197,198,270,192,193,194,144,199,325,271,200,201,202,272,203,204,205,146,206,273,147,207,274,335,347,402,342,345,346,138,140,284,300,434,406,364,365,366,367,368,369,370,371,372,373,431,432,433,139,275,411,435,436,437,438,439,440,441,442,443,444,445,446,447,448,407,459,299,455,456,208,209,276,210,211,212,277,213,214,215,278,216,217,218,279,219,220,221,280,222,223,224,281,225,226,227,282,228,229,230,283,231,232,233,408,457,458,460,234,419,235,285,236,237,238,286,239,240,241,287,242,243,245,288,246,247,248,289,249,250,251,290,252,253,254,291,255,256,257,292,258,259,260,326,409,410,423,424,306,307,348,349,350,412,405,351,352,353,354,355,356,357,358,359,360,449,450,451,452,453,454,308,309,404,361,362,363,148,149,294,377,336,337,378,150,295,379,338,374,380,151,296,381,339,375,382,152,297,383,340,376,384,413,415,416,414,417,418,462,470,471,463,472,473,464,474,475,465,476,477,466,478,479,467,480,481,468,482,483,469,484,153,298,385', '0', '1620475317', '0', '1', '1');
INSERT INTO `#@__sys_user` VALUES ('83', '07fly', '4e6ee1b742f998507391910a6ae3f3b0', '零小二', '0', '5', '7', '', '', '07fly', '', '1433,1437,1441,1440,1438,1439,1454,1460,1458,1459,1455,1436,1445,1444,1443,1442,1435,1448,1449,1447,1446,1434,1453,1452,1450,1451', '1584695987', '1609227142', '0', '1', '122');
INSERT INTO `#@__sys_user` VALUES ('84', 'test', '4e6ee1b742f998507391910a6ae3f3b0', '李大哥', '1', '5', '8', '', '', '', '', '', '1602494198', '1603938418', '0', '1', '1');

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
INSERT INTO `#@__sys_area` VALUES ('1', '成都', 'http://www.07fly.com', '0', '1', '1', '1,84,1', '开发人生,开发人生', '1597672045', '1608727787', '1', '028-61833149', '李先生', '四川省成都市量力钢材城4-3-3', '', '', '028-61833149', '地铁4号线', 'goodmuzi@qq.com', '104.072642', '30.674467', '', '', '成都零起飞科技有限公司');

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
