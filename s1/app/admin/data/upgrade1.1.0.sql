-- 安装1.1.0后的版本不需要
-- -----------------------------
-- Records of `config`
-- -----------------------------
-- REPLACE INTO `#@__config` VALUES ('1', 'seo_title', '1', '系统标题', '1', '', '系统标题为登录页和管理中心浏览器标题显示内容~', '1378898976', '1627106145', '1', '零起飞企业管理系统~软件集ERP、CRM、OA在线办公等主要功能，PC和手机端一体化管理', '20');
-- REPLACE INTO `#@__config` VALUES ('2', 'seo_description', '1', '系统描述', '1', '', '系统搜索引擎描述，优先级低于SEO模块', '1378898976', '1627106146', '1', '零起飞企业管理系统针对企业不同阶段提供不同的客户管理功能，以实现企业对客户管理的需要，网络中只需一台电脑安装本客户管理CRM系统，其它电脑均可通过浏览器使用。', '21');
-- REPLACE INTO `#@__config` VALUES ('3', 'seo_keywords', '1', '系统关键字', '1', '', '网站搜索引擎关键字，优先级低于SEO模块', '1378898976', '1627106147', '1', '07fly', '22');
-- REPLACE INTO `#@__config` VALUES ('9', 'config_type_list', '3', '配置类型列表', '3', '', '主要用于数据解析和页面表单的生成', '1378898976', '1581073821', '1', '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举\r\n5:图片\r\n6:文件\r\n7:富文本\r\n8:单选\r\n9:多选\r\n10:日期\r\n11:时间\r\n12:颜色', '100');
-- REPLACE INTO `#@__config` VALUES ('20', 'config_group_list', '3', '配置分组', '3', '', '配置分组', '1379228036', '1581073821', '1', '1:基础\r\n2:数据\r\n3:系统\r\n4:API', '100');
-- REPLACE INTO `#@__config` VALUES ('25', 'list_rows', '0', '每页数据记录数', '2', '', '数据每页显示记录数', '1379503896', '1611307743', '1', '10', '10');
-- REPLACE INTO `#@__config` VALUES ('29', 'data_backup_part_size', '0', '数据库备份卷大小', '2', '', '该值用于限制压缩后的分卷最大长度。单位：B', '1381482488', '1611307743', '1', '10240000', '7');
-- REPLACE INTO `#@__config` VALUES ('30', 'data_backup_compress', '4', '数据库备份文件是否启用压缩', '2', '0:不压缩\r\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '1381713345', '1611307743', '1', '1', '9');
-- REPLACE INTO `#@__config` VALUES ('31', 'data_backup_compress_level', '4', '数据库备份文件压缩级别', '2', '1:普通\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '1381713408', '1611307743', '1', '9', '10');
-- REPLACE INTO `#@__config` VALUES ('33', 'allow_url', '3', '不受权限验证的url', '3', '', '', '1386644047', '1581073821', '1', '0:file/pictureupload\r\n1:addon/execute\r\n2:admin/index/index\r\n3:admin/index/main', '100');
-- REPLACE INTO `#@__config` VALUES ('43', 'empty_list_describe', '1', '数据列表为空时的描述信息', '2', '', '', '1492278127', '1611307743', '1', 'aOh! 暂时还没有数据~', '0');
-- REPLACE INTO `#@__config` VALUES ('44', 'trash_config', '3', '回收站配置', '3', '', 'key为模型名称，值为显示列。', '1492312698', '1581073821', '1', 'Config:name\r\nAuthGroup:name\r\nMember:nickname\r\nMenu:name\r\nArticle:name\r\nArticleCategory:name\r\nAddon:name\r\nPicture:name\r\nFile:name\r\nActionLog:describe\r\nApi:name\r\nApiGroup:name\r\nBlogroll:name\r\nExeLog:exe_url\r\nSeo:name', '0');
-- REPLACE INTO `#@__config` VALUES ('49', 'static_domain', '1', '静态资源域名', '1', '', '若静态资源为本地资源则此项为空，若为外部资源则为存放静态资源的域名', '1502430387', '1627097504', '1', '', '100');
-- REPLACE INTO `#@__config` VALUES ('52', 'team_developer', '3', '研发团队人员', '4', '', '', '1504236453', '1582430537', '1', '0:零起飞\r\n1:开发人生', '0');
-- REPLACE INTO `#@__config` VALUES ('53', 'api_status_option', '3', 'API接口状态', '4', '', '', '1504242433', '1582430537', '1', '0:待研发\r\n1:研发中\r\n2:测试中\r\n3:已完成', '0');
-- REPLACE INTO `#@__config` VALUES ('54', 'api_data_type_option', '0', 'API数据类型', '4', '', '', '1504328208', '1582430704', '1', '0:字符\r\n1:文本\r\n2:数组\r\n3:文件', '0');
-- REPLACE INTO `#@__config` VALUES ('55', 'web_theme', '1', '前端主题', '1', '', '', '1504762360', '1627097504', '1', 'default', '80');
-- REPLACE INTO `#@__config` VALUES ('56', 'api_domain', '1', 'API部署域名', '4', '', '', '1504779094', '1582430537', '1', 'https://demo.07fly.org', '0');
-- REPLACE INTO `#@__config` VALUES ('57', 'api_key', '0', 'API加密KEY', '4', '', '泄露后API将存在安全隐患', '1505302112', '1582430779', '1', 'l2V|gfZp{8`;jzR~6Y1_', '0');
-- REPLACE INTO `#@__config` VALUES ('58', 'loading_icon', '4', '页面Loading图标设置', '1', '1:图标1\r\n2:图标2\r\n3:图标3\r\n4:图标4\r\n5:图标5\r\n6:图标6\r\n7:图标7', '页面Loading图标支持7种图标切换', '1505377202', '1627097504', '1', '7', '80');
-- REPLACE INTO `#@__config` VALUES ('59', 'sys_file_field', '3', '文件字段配置', '3', '', 'key为模型名，值为文件列名。', '1505799386', '1581073821', '1', '0_article:file_id', '0');
-- REPLACE INTO `#@__config` VALUES ('60', 'sys_picture_field', '0', '图片字段配置', '3', '', 'key为模型名，值为图片列名。', '1506315422', '1582430790', '1', '0_article:cover_id\r\n1_article:img_ids', '0');
-- REPLACE INTO `#@__config` VALUES ('61', 'jwt_key', '0', 'JWT加密KEY', '4', '', '', '1506748805', '1594603727', '1', 'l2V|DSFXXXgfZp{8`;FjzR~6Y1_', '0');
-- REPLACE INTO `#@__config` VALUES ('64', 'is_write_exe_log', '4', '是否写入执行记录', '3', '0:否\r\n1:是', '', '1510544340', '1581073821', '1', '1', '101');
-- REPLACE INTO `#@__config` VALUES ('65', 'admin_allow_ip', '2', '超级管理员登录IP', '3', '', '后台超级管理员登录IP限制，其他角色不受限。', '1510995580', '1582430869', '1', '0:27.22.112.250', '0');
-- REPLACE INTO `#@__config` VALUES ('66', 'pjax_mode', '8', 'PJAX模式', '3', '0:否\r\n1:是', '若为PJAX模式则浏览器不会刷新，若为常规模式则为AJAX+刷新', '1512370397', '1512982406', '1', '1', '120');
-- REPLACE INTO `#@__config` VALUES ('67', 'is_auto_cache', '4', '系统缓存', '2', '0:否\r\n1:是', '', '1611307711', '1611307743', '1', '0', '0');
-- REPLACE INTO `#@__config` VALUES ('68', 'login_title', '1', '登录界面名称', '1', '', '', '1627094196', '1627097504', '1', '零起飞企业管理系统', '10');
-- REPLACE INTO `#@__config` VALUES ('69', 'login_desc', '1', '登录界面描述', '1', '', '', '1627094283', '1627097504', '1', '软件集ERP、CRM、OA在线办公等主要功能，PC和手机端一体化管理', '11');
-- REPLACE INTO `#@__config` VALUES ('70', 'login_demo', '1', '登录演示帐号', '1', '', '', '1627094351', '1627097504', '1', '<font color=\'red\'>演示帐号/密码：admin/123456</font>', '12');
-- REPLACE INTO `#@__config` VALUES ('71', 'login_copyright', '1', '登录界面版权', '1', '', '登录界面输入框下面技术支持', '1627095435', '1627097504', '1', '<a href=‘http://www.07fly.xyz’>技术支持:成都零起飞科技</a>', '13');
-- REPLACE INTO `#@__config` VALUES ('72', 'main_title', '1', '管理中心名称', '1', '', '后台管理中心左上角名称信息', '1627106086', '1627106532', '1', '零起飞网络中心', '1');
-- REPLACE INTO `#@__config` VALUES ('73', 'main_weburl', '1', '官网地址', '1', '', '系统主页右上角官网链接地址', '1627106086', '1627106532', '1', 'http://www.07fly.xyz', '1');

-- -----------------------------
-- Records of `增加服务列表`
-- -----------------------------
-- REPLACE INTO `#@__sys_menu` VALUES ('7304', '服务管理', '1535', '50', 'admin', 'Service/serviceList', '1', '0', '1', '', '1', '1627107156', '1627107109', '1');


-- ----------------------------start tiem by 2021-10-30 ------------------------------

-- -----------------------------
-- Records of `sys_msg_type` 增加提醒配置的参数
-- -----------------------------
REPLACE INTO `#@__sys_msg_type` VALUES ('1', '线索跟进', 'cst_clue', '', '10', '有新的线索需要跟进时提醒操作人员', '24', '1', '1', '0', '0', '1635313485', '1635412895', '1');
REPLACE INTO `#@__sys_msg_type` VALUES ('2', '客户跟进', 'cst_customer', '', '10', '有新的客户需要跟进时提醒操作人员', '24', '1', '1', '0', '0', '1635313894', '1635412903', '1');
REPLACE INTO `#@__sys_msg_type` VALUES ('3', '商机跟进', 'cst_chance', '', '10', '有新的销售机会（商机）需要跟进时提醒操作人员', '24', '1', '1', '0', '0', '1635313894', '1635412901', '1');
REPLACE INTO `#@__sys_msg_type` VALUES ('4', '销售合同', 'sal_contract', '', '10', '有新的销售合同需要跟进时提醒操作人员', '24', '1', '1', '0', '0', '1635313894', '1635412900', '1');
REPLACE INTO `#@__sys_msg_type` VALUES ('5', '销售订单', 'sal_order', '', '10', '有新的销售订单需要跟进时提醒操作人员', '24', '1', '1', '0', '0', '1635313894', '1635412899', '1');
REPLACE INTO `#@__sys_msg_type` VALUES ('6', '销售合同到期', 'sal_contract_expire', '', '10', '有销售合同即将到期需要跟进时提醒操作人员', '721', '1', '1', '0', '0', '1635313894', '1635412897', '1');
REPLACE INTO `#@__sys_msg_type` VALUES ('7', '日程开始提醒', 'oa_schedule', '', '10', '日程开始时间提醒负责人员', '24', '1', '1', '0', '0', '1635313894', '1635412897', '1');

-- -----------------------------
-- Records of 修改菜单标签、解决增加菜单无法合入问题
-- -----------------------------
UPDATE `#@__sys_menu` SET url='organization' WHERE NAME='组织结构' AND url='index/main';
UPDATE `#@__sys_menu` SET url='database manage' WHERE NAME='数据库管理' AND url='Database/show';
UPDATE `#@__sys_menu` SET url='system oa' WHERE NAME='我的办公' AND url='oa/index';

-- ----------------------------end tiem by 2021-10-30 ------------------------------
