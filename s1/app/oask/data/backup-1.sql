
-- -----------------------------
-- Table structure for `#@__activity`
-- -----------------------------
DROP TABLE IF EXISTS `#@__activity`;
CREATE TABLE `#@__activity` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `body` text COMMENT '内容',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `target` varchar(256) NOT NULL DEFAULT '' COMMENT '目标',
  `result` varchar(256) NOT NULL DEFAULT '' COMMENT '结果',
  `begin_date` date DEFAULT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `budget` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '预算',
  `status` int(2) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]营销活动';

-- -----------------------------
-- Records of `lqf_activity`
-- -----------------------------
INSERT INTO `#@__activity` VALUES ('1', '零点乐队国庆活动', '还行吧<br />', '', '', '', '提高知名度', '完成', '2021-08-11', '2021-09-04', '1628757764', '1628758202', '1', '1', '10000.00', '2');
INSERT INTO `#@__activity` VALUES ('2', '零点乐队国庆活动002', '还行吧<br />', '', '', '', '提高知名度', '完成', '2021-08-11', '2021-09-04', '1628757764', '0', '1', '1', '10000.00', '3');
INSERT INTO `#@__activity` VALUES ('3', '零点乐队国庆活动003', '还行吧<br />', '', '', '', '提高知名度', '完成', '2021-08-11', '2021-09-04', '1628757764', '1628758255', '1', '1', '10000.00', '5');

-- -----------------------------
-- Table structure for `#@__activity_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__activity_reply`;
CREATE TABLE `#@__activity_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `activity_id` int(16) NOT NULL DEFAULT '0' COMMENT '活动编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]营销活动回复';

-- -----------------------------
-- Records of `lqf_activity_reply`
-- -----------------------------
INSERT INTO `#@__activity_reply` VALUES ('1', '哈哈这个活动很好哟', '', '', '0', '1628758976', '0', '1', '1', '', '');
INSERT INTO `#@__activity_reply` VALUES ('2', '这个活动不错的哟1991 年度预算\r\n\r\nthe 1991 budget;\r\n\r\n提出预算\r\n\r\nsubmit the budget; introduce the budget;\r\n\r\n平衡预算\r\n\r\nbalanced budget;\r\n\r\n控制在预算范围之内\r\n\r\nkeep within its budget;\r\n\r\n制定明年的预', '', '', '1', '1628759113', '1628759138', '1', '1', '', '');
INSERT INTO `#@__activity_reply` VALUES ('3', '还行吧怎么样的呀', '', '', '1', '1628759126', '1628759147', '1', '1', '', '');
INSERT INTO `#@__activity_reply` VALUES ('4', '好的', '', '', '3', '1628762048', '0', '1', '1', '', '');
INSERT INTO `#@__activity_reply` VALUES ('5', '你们说好就好的呢', '', '', '1', '1648608119', '0', '1', '1', '', '');
INSERT INTO `#@__activity_reply` VALUES ('6', '这个还可以吧，', '', '', '1', '1652585580', '0', '1', '1', '', '');
INSERT INTO `#@__activity_reply` VALUES ('7', '这是什么扣尼', '', '', '1', '1671781680', '0', '1', '1', '', '');

-- -----------------------------
-- Table structure for `#@__assets`
-- -----------------------------
DROP TABLE IF EXISTS `#@__assets`;
CREATE TABLE `#@__assets` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `type_id` int(16) DEFAULT '0' COMMENT '分类编号',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '资产名称',
  `assets_no` varchar(256) NOT NULL DEFAULT '' COMMENT '编号',
  `use_user_id` int(16) DEFAULT '0' COMMENT '使用人员',
  `address` varchar(256) NOT NULL DEFAULT '' COMMENT '存放地点',
  `begin_date` date DEFAULT NULL COMMENT '购买日期',
  `expire_date` date DEFAULT NULL COMMENT '到期日期',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `status` varchar(256) DEFAULT '' COMMENT '状态',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `mobile` varchar(256) NOT NULL DEFAULT '' COMMENT '联系电话',
  `email` varchar(256) NOT NULL DEFAULT '' COMMENT '联系邮箱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]资产管理列表';

-- -----------------------------
-- Records of `lqf_assets`
-- -----------------------------
INSERT INTO `#@__assets` VALUES ('1', '2', '1111', '1111', '1', '1111', '2021-08-18', '2021-09-04', '111', '24,31', '6', '报废', '1629265750', '1629512949', '1', '1', '', '');

-- -----------------------------
-- Table structure for `#@__assets_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__assets_reply`;
CREATE TABLE `#@__assets_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `assets_id` int(16) NOT NULL DEFAULT '0' COMMENT '资产编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]资产管理回复';

-- -----------------------------
-- Records of `lqf_assets_reply`
-- -----------------------------
INSERT INTO `#@__assets_reply` VALUES ('1', '1121212', '', '', '1', '1629266935', '0', '1', '1', '', '');
INSERT INTO `#@__assets_reply` VALUES ('2', '333333333222', '', '', '1', '1629266942', '1629266948', '1', '1', '', '');

-- -----------------------------
-- Table structure for `#@__assets_type`
-- -----------------------------
DROP TABLE IF EXISTS `#@__assets_type`;
CREATE TABLE `#@__assets_type` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(16) NOT NULL DEFAULT '0' COMMENT '上级id',
  `sort` int(16) NOT NULL DEFAULT '0' COMMENT '排序',
  `visible` int(16) NOT NULL DEFAULT '0' COMMENT '禁用',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]资产分类';

-- -----------------------------
-- Records of `lqf_assets_type`
-- -----------------------------
INSERT INTO `#@__assets_type` VALUES ('1', '办公资产', '0', '100', '1', '', '1629254674', '1629271183', '1', '0');
INSERT INTO `#@__assets_type` VALUES ('2', '设备资产', '0', '100', '1', '', '1629254682', '1629270696', '1', '0');

-- -----------------------------
-- Table structure for `#@__attendance`
-- -----------------------------
DROP TABLE IF EXISTS `#@__attendance`;
CREATE TABLE `#@__attendance` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `staff_id` int(16) DEFAULT '0' COMMENT '员工档案编号',
  `type_id` int(16) DEFAULT '0' COMMENT '考勤类型',
  `begin_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `time_len` varchar(256) NOT NULL DEFAULT '' COMMENT '时长（小时）',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `status` varchar(256) DEFAULT '' COMMENT '状态',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]员工考勤管理';

-- -----------------------------
-- Records of `lqf_attendance`
-- -----------------------------
INSERT INTO `#@__attendance` VALUES ('1', '164', '1', '2021-08-24 09:55:51', '2021-08-24 10:15:41', '5', '', '', '', '', '1629683948', '1629685125', '1', '1');
INSERT INTO `#@__attendance` VALUES ('2', '164', '1', '2021-08-24 09:55:51', '2021-08-25 14:50:18', '5', '', '', '', '', '1629683973', '1629684741', '1', '1');
INSERT INTO `#@__attendance` VALUES ('3', '169', '4', '2021-08-23 14:50:57', '2021-08-23 14:30:10', '5', '', '', '', '', '1629684492', '1629684734', '1', '1');
INSERT INTO `#@__attendance` VALUES ('4', '167', '4', '2023-01-30 21:58:00', '2023-01-30 21:58:05', '1', '', '', '', '', '1675083492', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__attendance_type`
-- -----------------------------
DROP TABLE IF EXISTS `#@__attendance_type`;
CREATE TABLE `#@__attendance_type` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(16) NOT NULL DEFAULT '0' COMMENT '上级id',
  `sort` int(16) NOT NULL DEFAULT '0' COMMENT '排序',
  `visible` int(16) NOT NULL DEFAULT '0' COMMENT '禁用',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]通信录分类';

-- -----------------------------
-- Records of `lqf_attendance_type`
-- -----------------------------
INSERT INTO `#@__attendance_type` VALUES ('1', '迟到', '0', '1', '1', '', '1629682961', '1629684080', '1', '0');
INSERT INTO `#@__attendance_type` VALUES ('2', '旷工', '0', '3', '1', '', '1629682982', '1629684082', '1', '0');
INSERT INTO `#@__attendance_type` VALUES ('3', '请假', '0', '4', '1', '', '1629682994', '1629684083', '1', '0');
INSERT INTO `#@__attendance_type` VALUES ('4', '早退', '0', '2', '1', '', '1629684071', '1629684081', '1', '0');

-- -----------------------------
-- Table structure for `#@__company_album`
-- -----------------------------
DROP TABLE IF EXISTS `#@__company_album`;
CREATE TABLE `#@__company_album` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]门店相册';

-- -----------------------------
-- Records of `lqf_company_album`
-- -----------------------------
INSERT INTO `#@__company_album` VALUES ('1', '公司2021年会', '年会一些照片信息', '31,32', '', '1629100476', '1654097932', '1', '1');

-- -----------------------------
-- Table structure for `#@__contacts`
-- -----------------------------
DROP TABLE IF EXISTS `#@__contacts`;
CREATE TABLE `#@__contacts` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `type_id` int(16) DEFAULT '0' COMMENT '分类编号id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '姓名',
  `mobile` varchar(256) NOT NULL DEFAULT '' COMMENT '联系电话',
  `email` varchar(256) NOT NULL DEFAULT '' COMMENT '联系邮箱',
  `address` varchar(256) NOT NULL DEFAULT '' COMMENT '联系地址',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]通信录管理';

-- -----------------------------
-- Records of `lqf_contacts`
-- -----------------------------
INSERT INTO `#@__contacts` VALUES ('1', '1', '张哥', '1897878655', 'admin@admin.com', '一环路100号', '', '', '1629517628', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__contacts_type`
-- -----------------------------
DROP TABLE IF EXISTS `#@__contacts_type`;
CREATE TABLE `#@__contacts_type` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(16) NOT NULL DEFAULT '0' COMMENT '上级id',
  `sort` int(16) NOT NULL DEFAULT '0' COMMENT '排序',
  `visible` int(16) NOT NULL DEFAULT '0' COMMENT '禁用',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]通信录分类';

-- -----------------------------
-- Records of `lqf_contacts_type`
-- -----------------------------
INSERT INTO `#@__contacts_type` VALUES ('1', '公司内部员工', '0', '100', '1', '', '1629517060', '0', '1', '0');
INSERT INTO `#@__contacts_type` VALUES ('2', '供货方', '0', '100', '1', '', '1629517074', '0', '1', '0');

-- -----------------------------
-- Table structure for `#@__contract`
-- -----------------------------
DROP TABLE IF EXISTS `#@__contract`;
CREATE TABLE `#@__contract` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `customer_id` int(16) DEFAULT '0' COMMENT '客户编号id',
  `contract_no` varchar(256) NOT NULL DEFAULT '' COMMENT '合同编号',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `begin_date` date DEFAULT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `money` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '合同金额',
  `status` int(2) DEFAULT '1' COMMENT '状态',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `typename` varchar(256) NOT NULL DEFAULT '' COMMENT '合同类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]行政合同';

-- -----------------------------
-- Records of `lqf_contract`
-- -----------------------------
INSERT INTO `#@__contract` VALUES ('1', '0', 'DF4164131', '租房合同', '2021-08-16', '2021-08-16', '三个月的合同的哟', '24,31', '', '5000.00', '1', '1629103966', '1629104086', '1', '1', '');

-- -----------------------------
-- Table structure for `#@__contract_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__contract_reply`;
CREATE TABLE `#@__contract_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `contract_id` int(16) NOT NULL DEFAULT '0' COMMENT '合同编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]行政合同回复';

-- -----------------------------
-- Records of `lqf_contract_reply`
-- -----------------------------
INSERT INTO `#@__contract_reply` VALUES ('1', '这个合同明年要去处理的哟', '', '', '0', '1629104686', '0', '1', '1', '', '');
INSERT INTO `#@__contract_reply` VALUES ('2', '两人或几人之间、两方或多方当事人之间在办理某事时,为了确定各自的权利和义务而订立的各自遵守的条文', '', '', '1', '1629104717', '0', '1', '1', '', '');
INSERT INTO `#@__contract_reply` VALUES ('3', '好的', '', '', '1', '1630922957', '0', '1', '1', '', '');

-- -----------------------------
-- Table structure for `#@__cst_contract`
-- -----------------------------
DROP TABLE IF EXISTS `#@__cst_contract`;
CREATE TABLE `#@__cst_contract` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `customer_id` int(16) DEFAULT '0' COMMENT '客户编号id',
  `contract_no` varchar(256) NOT NULL DEFAULT '' COMMENT '合同编号',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `begin_date` date DEFAULT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `status` int(2) DEFAULT '1' COMMENT '状态',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `money` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '合同金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]销售合同';

-- -----------------------------
-- Records of `lqf_cst_contract`
-- -----------------------------
INSERT INTO `#@__cst_contract` VALUES ('1', '13385', 'X163131', '123123', '2021-08-11', '2021-09-01', 'avb r', '24,31', '5', '1', '1628840183', '1628840452', '1', '1', '12.00');

-- -----------------------------
-- Table structure for `#@__cst_customer`
-- -----------------------------
DROP TABLE IF EXISTS `#@__cst_customer`;
CREATE TABLE `#@__cst_customer` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '客户名称',
  `customer_no` varchar(64) NOT NULL DEFAULT '' COMMENT '客户编号',
  `create_user_id` int(16) NOT NULL DEFAULT '0' COMMENT '创建人员',
  `owner_user_id` int(16) NOT NULL DEFAULT '0' COMMENT '归属人员，0=为公海客户，-1=垃圾客户',
  `openstatus` int(11) DEFAULT '0' COMMENT '公开，-1=垃圾客户，0=公海，1=私用',
  `next_time` datetime DEFAULT NULL COMMENT '下次沟通时间',
  `link_time` datetime DEFAULT NULL COMMENT '最近联系时间',
  `link_body` varchar(1024) NOT NULL DEFAULT '' COMMENT '最近沟通内容',
  `source` varchar(250) NOT NULL DEFAULT '' COMMENT '客户来源',
  `level` varchar(250) NOT NULL DEFAULT '' COMMENT '客户等级',
  `industry` varchar(250) NOT NULL DEFAULT '' COMMENT '客户行业',
  `customerstatus` varchar(50) NOT NULL DEFAULT '' COMMENT '客户状态',
  `linkman` varchar(250) NOT NULL DEFAULT '' COMMENT '客户代表',
  `mobile` varchar(250) NOT NULL DEFAULT '' COMMENT '联系手机',
  `tel` varchar(250) NOT NULL DEFAULT '' COMMENT '联系电话',
  `qicq` varchar(250) NOT NULL DEFAULT '' COMMENT 'QQ',
  `weixin` varchar(250) NOT NULL DEFAULT '' COMMENT '微信号',
  `address` varchar(250) NOT NULL DEFAULT '' COMMENT '联系地址',
  `remark` varchar(250) NOT NULL DEFAULT '' COMMENT '客户介绍',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `share_user_id` varchar(256) DEFAULT '' COMMENT '共享人员ID',
  `delegate` varchar(256) NOT NULL DEFAULT '' COMMENT '代表品种',
  `channel` varchar(256) NOT NULL DEFAULT '' COMMENT '品牌渠道',
  `agreement` varchar(256) NOT NULL DEFAULT '' COMMENT '是否协议',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13388 DEFAULT CHARSET=utf8mb4 COMMENT='客户信息表';

-- -----------------------------
-- Records of `lqf_cst_customer`
-- -----------------------------
INSERT INTO `#@__cst_customer` VALUES ('13380', '公海测试哟', '', '1', '0', '0', '2021-08-06 14:02:54', '2021-08-03 14:02:54', '11111', '客户介绍', '白银客户', '工业品企业', '正式客户', '张哥', '183416416', '', '', '', '', '', '1627982872', '1627963869', '1', '', '', '', '');
INSERT INTO `#@__cst_customer` VALUES ('13385', '共享008', '', '1', '1', '1', '2021-09-10 10:43:19', '2021-09-08 10:43:17', '下周要要去谈事情的呢', '客户介绍', '钻石客户', '服务行业', '跟进客户', '李四', '1000000', '', '', '', '', '', '1631068997', '1627973668', '1', '84', '', '', '');
INSERT INTO `#@__cst_customer` VALUES ('13386', '天成税务', '', '1', '1', '1', '2021-08-05 16:17:47', '2021-08-05 16:17:47', '', '电话来访', '白银客户', '互联网企业', '跟进客户', '王老五1588', '1892584789898', '', '18020105898', '', '', '', '1630997340', '1628151467', '1', '', '好的', '北京', '有');
INSERT INTO `#@__cst_customer` VALUES ('13387', '1111', '', '1', '1', '1', '2021-09-09 14:58:20', '2021-09-07 14:59:39', '2423424', '电话来访', '白银客户', '工业品企业', '跟进客户', '1111', '1111', '', '', '', '', '', '1630997979', '1628476705', '1', '', '西药', '代理', '有');

-- -----------------------------
-- Table structure for `#@__cst_dict`
-- -----------------------------
DROP TABLE IF EXISTS `#@__cst_dict`;
CREATE TABLE `#@__cst_dict` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名字',
  `typetag` varchar(256) NOT NULL DEFAULT '' COMMENT '分类标识',
  `sort` smallint(8) NOT NULL DEFAULT '100',
  `visible` smallint(2) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `org_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COMMENT='字典表';

-- -----------------------------
-- Records of `lqf_cst_dict`
-- -----------------------------
INSERT INTO `#@__cst_dict` VALUES ('1', 'C', 'level', '3', '1', '0', '1631234882', '0');
INSERT INTO `#@__cst_dict` VALUES ('23', '黑名单', 'level', '4', '1', '0', '1631234913', '0');
INSERT INTO `#@__cst_dict` VALUES ('24', '工业品企业', 'industry', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('25', '国有经济', 'ecotype', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('26', '集体经济', 'ecotype', '2', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('27', '私营经济', 'ecotype', '3', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('28', '个体经济', 'ecotype', '4', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('29', '联营经济', 'ecotype', '5', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('30', '股份制经济', 'ecotype', '6', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('31', '外商投资经济', 'ecotype', '7', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('32', '港澳台投资经济', 'ecotype', '8', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('33', '其它经济', 'ecotype', '9', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('34', '客户介绍', 'source', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('35', '电话来访', 'source', '2', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('36', '独立开发', 'source', '3', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('37', '电话', 'salemode', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('38', '初期沟通', 'salestage', '3', '0', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('39', '立项评估', 'salestage', '2', '0', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('40', '需求分析', 'salestage', '3', '0', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('41', '方案制定', 'salestage', '4', '0', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('42', '商务谈判', 'salestage', '5', '0', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('43', '合同签订', 'salestage', '6', '0', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('44', '失单', 'salestage', '7', '0', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('45', '投诉', 'services', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('46', '培训', 'services', '2', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('47', '升级', 'services', '3', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('48', '互联网企业', 'industry', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('49', '电话 ', 'servicesmodel', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('50', 'QQ', 'servicesmodel', '2', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('51', '服务行业', 'industry', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('52', '网络资源', 'source', '4', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('53', '上门', 'salemode', '2', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('54', '维护', 'services', '4', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('55', '现场', 'servicesmodel', '3', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('56', '微信', 'salemode', '3', '1', '0', '1590480274', '0');
INSERT INTO `#@__cst_dict` VALUES ('57', 'QQ', 'salemode', '4', '1', '0', '1590480283', '0');
INSERT INTO `#@__cst_dict` VALUES ('58', '网络', 'servicesmodel', '4', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('59', '消费品企业', 'industry', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('60', '原材料企业', 'industry', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('61', '农业企业', 'industry', '1', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('63', '不需要', 'talk', '2', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('64', '挂了', 'talk', '3', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('65', '空号', 'talk', '4', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('66', '加微信号', 'talk', '5', '1', '0', '0', '0');
INSERT INTO `#@__cst_dict` VALUES ('67', 'A', 'level', '0', '1', '0', '1631234824', '0');
INSERT INTO `#@__cst_dict` VALUES ('68', 'B', 'level', '0', '1', '0', '1631234831', '0');
INSERT INTO `#@__cst_dict` VALUES ('69', '科技行业', 'industry', '100', '1', '1584784813', '1584784861', '0');
INSERT INTO `#@__cst_dict` VALUES ('70', '正式客户', 'customerstatus', '100', '1', '1584784813', '1584784861', '0');
INSERT INTO `#@__cst_dict` VALUES ('71', '跟进客户', 'customerstatus', '100', '1', '1586829262', '1586829277', '0');
INSERT INTO `#@__cst_dict` VALUES ('72', '流失客户', 'customerstatus', '100', '1', '1586829273', '1586829277', '0');
INSERT INTO `#@__cst_dict` VALUES ('73', '厂家', 'firmcategory', '100', '1', '1631171445', '1631171457', '1');
INSERT INTO `#@__cst_dict` VALUES ('74', '代理', 'firmcategory', '100', '1', '1631171453', '1631171458', '1');
INSERT INTO `#@__cst_dict` VALUES ('75', '有', 'agreement', '100', '0', '1631171467', '0', '1');
INSERT INTO `#@__cst_dict` VALUES ('76', '无', 'agreement', '100', '0', '1631171475', '0', '1');
INSERT INTO `#@__cst_dict` VALUES ('77', '待处理', 'prostatus', '100', '0', '1631177115', '0', '1');
INSERT INTO `#@__cst_dict` VALUES ('78', '完结', 'prostatus', '100', '0', '1631177129', '0', '1');

-- -----------------------------
-- Table structure for `#@__cst_dict_type`
-- -----------------------------
DROP TABLE IF EXISTS `#@__cst_dict_type`;
CREATE TABLE `#@__cst_dict_type` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '分类名称',
  `typetag` varchar(50) NOT NULL DEFAULT '' COMMENT '分类标识',
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `visible` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `desc` varchar(1024) DEFAULT '',
  `org_id` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='字典分类';

-- -----------------------------
-- Records of `lqf_cst_dict_type`
-- -----------------------------
INSERT INTO `#@__cst_dict_type` VALUES ('2', '隶属行业', 'industry', '1', '1', '', '0', '0', '1619081607');
INSERT INTO `#@__cst_dict_type` VALUES ('4', '客户来源', 'source', '0', '1', '', '0', '0', '1619081602');
INSERT INTO `#@__cst_dict_type` VALUES ('5', '销售方式', 'salemode', '0', '1', '', '0', '0', '1619081603');
INSERT INTO `#@__cst_dict_type` VALUES ('6', '销售阶段', 'salestage', '0', '1', '', '0', '0', '1619081604');
INSERT INTO `#@__cst_dict_type` VALUES ('7', '服务类型', 'services', '0', '1', '', '0', '0', '1619081604');
INSERT INTO `#@__cst_dict_type` VALUES ('8', '客户服务方式', 'servicesmodel', '0', '1', '', '0', '0', '1619081605');
INSERT INTO `#@__cst_dict_type` VALUES ('9', '客户状态', 'customerstatus', '0', '1', '', '0', '0', '1619081606');
INSERT INTO `#@__cst_dict_type` VALUES ('1', '合作等级', 'level', '1', '1', '', '0', '0', '1631171338');
INSERT INTO `#@__cst_dict_type` VALUES ('10', '经济类型', 'ecotype', '0', '1', '', '0', '0', '1619081606');
INSERT INTO `#@__cst_dict_type` VALUES ('12', '合作协议', 'agreement', '11', '1', '', '0', '1631171256', '0');
INSERT INTO `#@__cst_dict_type` VALUES ('13', '厂商类别', 'firmcategory', '12', '1', '', '0', '1631171321', '0');
INSERT INTO `#@__cst_dict_type` VALUES ('14', '处理情况', 'prostatus', '13', '1', '', '0', '1631177104', '0');

-- -----------------------------
-- Table structure for `#@__cst_sales`
-- -----------------------------
DROP TABLE IF EXISTS `#@__cst_sales`;
CREATE TABLE `#@__cst_sales` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `customer_id` int(16) DEFAULT '0' COMMENT '客户编号id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `sale_date` date DEFAULT NULL COMMENT '销售日期',
  `money` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '合同金额',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]销售记录';

-- -----------------------------
-- Records of `lqf_cst_sales`
-- -----------------------------
INSERT INTO `#@__cst_sales` VALUES ('1', '13385', '好的乐府的', '2021-08-13', '5000.00', '这是三月份的东西的哟', '24,31', '6,5,5,7,8', '1628842679', '1629708518', '1', '1');
INSERT INTO `#@__cst_sales` VALUES ('2', '13385', '232232第三方地方', '2023-01-30', '22222.00', '的方式的方式', '', '', '1675082613', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__cst_trace`
-- -----------------------------
DROP TABLE IF EXISTS `#@__cst_trace`;
CREATE TABLE `#@__cst_trace` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `customer_id` int(16) NOT NULL DEFAULT '0' COMMENT '客户编号',
  `chance_id` int(11) NOT NULL DEFAULT '0' COMMENT '销售机会',
  `linkman_id` int(11) NOT NULL DEFAULT '0' COMMENT '联系人',
  `linkman_name` varchar(50) NOT NULL DEFAULT '' COMMENT '联系人名称',
  `link_time` datetime DEFAULT NULL COMMENT '联系时间',
  `link_body` varchar(256) NOT NULL DEFAULT '' COMMENT '主题名称',
  `salestage` varchar(50) NOT NULL DEFAULT '' COMMENT '沟通阶段',
  `salemode` varchar(50) NOT NULL DEFAULT '' COMMENT '销售方式',
  `next_time` datetime DEFAULT NULL COMMENT '下次联系时间',
  `next_body` varchar(256) DEFAULT '' COMMENT '下次沟通主题',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `status` varchar(256) NOT NULL DEFAULT '' COMMENT '处理状态',
  `reply_body` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复内容',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COMMENT='跟踪记录';


-- -----------------------------
-- Table structure for `#@__document`
-- -----------------------------
DROP TABLE IF EXISTS `#@__document`;
CREATE TABLE `#@__document` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `body` text COMMENT '内容',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]公文管理';

-- -----------------------------
-- Records of `lqf_document`
-- -----------------------------
INSERT INTO `#@__document` VALUES ('1', '2021新文件还行吧', '这是什么文件的呢，还可以吧<br />', '', '', '6', '1629098923', '1629696518', '1', '1');
INSERT INTO `#@__document` VALUES ('2', '重庆市医疗保障局 渝医保发〔2021〕50 号  关于做好 2021 年常用药品联盟带量采购和短缺药品联盟保供稳价带量采购中选结果执行工作的通知', '关于做好 2021 年常用药品联盟带量采购和短缺药品联盟保供稳价带量采购中选结果执行工作的通知', '', '', '', '1630308216', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__document_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__document_reply`;
CREATE TABLE `#@__document_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `document_id` int(16) NOT NULL DEFAULT '0' COMMENT '公文编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]公文管理回复';

-- -----------------------------
-- Records of `lqf_document_reply`
-- -----------------------------
INSERT INTO `#@__document_reply` VALUES ('1', '13123123', '', '', '0', '1629099201', '0', '1', '1', '', '');
INSERT INTO `#@__document_reply` VALUES ('2', '1212121', '', '', '1', '1629099224', '0', '1', '1', '', '');
INSERT INTO `#@__document_reply` VALUES ('3', '这是一个好的现象的哟', '', '', '1', '1629099237', '0', '1', '1', '', '');
INSERT INTO `#@__document_reply` VALUES ('4', '这是那里的呢', '', '', '1', '1629528244', '0', '1', '1', '', '');

-- -----------------------------
-- Table structure for `#@__hrm_staff`
-- -----------------------------
DROP TABLE IF EXISTS `#@__hrm_staff`;
CREATE TABLE `#@__hrm_staff` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `staff_no` varchar(50) NOT NULL DEFAULT '' COMMENT '员工编号',
  `bind_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '绑定的系统帐号id',
  `position_id` varchar(256) NOT NULL DEFAULT '0' COMMENT '职务',
  `dept_id` varchar(256) NOT NULL DEFAULT '0' COMMENT '部门',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '员工姓名',
  `gender` smallint(1) NOT NULL DEFAULT '1' COMMENT '姓别1=男，2=女，0=未知',
  `idcard` varchar(50) NOT NULL DEFAULT '' COMMENT '身份证号',
  `birthday` date DEFAULT NULL COMMENT '员工生日',
  `marriage` varchar(256) NOT NULL DEFAULT '' COMMENT '婚姻情况',
  `politics` varchar(256) NOT NULL DEFAULT '' COMMENT '政治面貌',
  `degree` varchar(256) NOT NULL DEFAULT '' COMMENT '最高学历',
  `major` varchar(256) NOT NULL DEFAULT '' COMMENT '就读专业',
  `qualification` varchar(256) NOT NULL DEFAULT '' COMMENT '职业资格',
  `position` varchar(256) NOT NULL DEFAULT '' COMMENT '工作职务',
  `social` varchar(256) NOT NULL DEFAULT '' COMMENT '社会职',
  `mobile` varchar(256) NOT NULL DEFAULT '' COMMENT '手机号码',
  `qicq` varchar(256) NOT NULL DEFAULT '' COMMENT 'QQ号码',
  `email` varchar(256) NOT NULL DEFAULT '' COMMENT '邮箱地址',
  `zipcode` varchar(256) NOT NULL DEFAULT '' COMMENT '邮政编码',
  `address` varchar(256) NOT NULL DEFAULT '' COMMENT '联系地址',
  `intro` varchar(256) NOT NULL DEFAULT '' COMMENT '介绍',
  `entry_date` date DEFAULT NULL COMMENT '入职日期',
  `quit_date` date DEFAULT NULL COMMENT '离职日期',
  `formal_date` date DEFAULT NULL COMMENT '转正日期',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '在职状态，1=在职，0=离职',
  `create_user_id` int(16) NOT NULL DEFAULT '0',
  `create_time` int(16) NOT NULL DEFAULT '0',
  `update_time` int(16) NOT NULL DEFAULT '0',
  `org_id` int(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=170 DEFAULT CHARSET=utf8 COMMENT='[hrm]员工档案';

-- -----------------------------
-- Records of `lqf_hrm_staff`
-- -----------------------------
INSERT INTO `#@__hrm_staff` VALUES ('164', 'XZ2543', '1', '4', '2', '张三', '1', '511929198005127894', '2021-05-27', '未婚', '团员', '本科', '电子商务', '计算机', '经理', '协会员', '18030402705', '1871720801', 'goodmuzi@qq.com', '', '成都市天河路', '这是一个好员工的呀', '2021-05-27', '2021-06-11', '2021-05-27', '1', '0', '0', '1669087869', '0');
INSERT INTO `#@__hrm_staff` VALUES ('167', 'DSA215455', '83', '4', '2', '李四', '1', '511929198005127894', '2021-05-27', '未婚', '团员', '本科', '电子商务', '计算机', '经理', '协会员', '18030402705', '1871720801', 'goodmuzi@qq.com', '', '这是那时呀', '这是一个好员工的呀', '2021-05-27', '2021-05-27', '2021-06-10', '1', '0', '0', '1668815796', '0');
INSERT INTO `#@__hrm_staff` VALUES ('169', '', '84', '0', '0', '王五来', '1', '516461313161X', '2021-06-19', '未', '团员', '研究生', '', '', '', '', '1854565465461', '', '', '', '', '', '2021-06-19', '2021-05-27', '2021-05-27', '1', '1', '1624069665', '1624073273', '0');

-- -----------------------------
-- Table structure for `#@__hrm_staff_care`
-- -----------------------------
DROP TABLE IF EXISTS `#@__hrm_staff_care`;
CREATE TABLE `#@__hrm_staff_care` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `staff_id` int(16) NOT NULL DEFAULT '0' COMMENT '员工档案编号id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `curr_date` date DEFAULT NULL COMMENT '发生日期',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]员工关怀';

-- -----------------------------
-- Records of `lqf_hrm_staff_care`
-- -----------------------------
INSERT INTO `#@__hrm_staff_care` VALUES ('1', '164', '生日问候', '2021-08-19', '好的哟', '', '', '1629171368', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__hrm_staff_contract`
-- -----------------------------
DROP TABLE IF EXISTS `#@__hrm_staff_contract`;
CREATE TABLE `#@__hrm_staff_contract` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `staff_id` int(16) NOT NULL DEFAULT '0' COMMENT '员工档案编号id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '合同名称',
  `begin_date` date DEFAULT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `contract_no` varchar(256) NOT NULL DEFAULT '' COMMENT '合同编号',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]人事合同';

-- -----------------------------
-- Records of `lqf_hrm_staff_contract`
-- -----------------------------
INSERT INTO `#@__hrm_staff_contract` VALUES ('1', '164', '张三劳动合同', '2021-08-17', '2021-09-02', 'XD564616', '好的呢', '24', '5', '1629166970', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__hrm_staff_licence`
-- -----------------------------
DROP TABLE IF EXISTS `#@__hrm_staff_licence`;
CREATE TABLE `#@__hrm_staff_licence` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `staff_id` int(16) NOT NULL DEFAULT '0' COMMENT '员工档案编号id',
  `begin_date` date DEFAULT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '合同名称',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]人事员工证照';

-- -----------------------------
-- Records of `lqf_hrm_staff_licence`
-- -----------------------------
INSERT INTO `#@__hrm_staff_licence` VALUES ('1', '167', '2021-08-17', '2021-08-26', '证书来', '好的', '24', '9', '1629170000', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__hrm_staff_reward`
-- -----------------------------
DROP TABLE IF EXISTS `#@__hrm_staff_reward`;
CREATE TABLE `#@__hrm_staff_reward` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `staff_id` int(16) NOT NULL DEFAULT '0' COMMENT '员工档案编号id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '事件名称',
  `typename` varchar(256) NOT NULL DEFAULT '' COMMENT '事件类型/奖励、惩罚',
  `curr_date` date DEFAULT NULL COMMENT '发生日期',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]员工奖罚';

-- -----------------------------
-- Records of `lqf_hrm_staff_reward`
-- -----------------------------
INSERT INTO `#@__hrm_staff_reward` VALUES ('1', '167', '优秀员工', '奖励', '2021-08-18', '好的', '', '', '1629172112', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__hrm_staff_study`
-- -----------------------------
DROP TABLE IF EXISTS `#@__hrm_staff_study`;
CREATE TABLE `#@__hrm_staff_study` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `staff_id` int(16) NOT NULL DEFAULT '0' COMMENT '员工档案编号id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '学习名称',
  `begin_date` date DEFAULT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]员工学习培训';

-- -----------------------------
-- Records of `lqf_hrm_staff_study`
-- -----------------------------
INSERT INTO `#@__hrm_staff_study` VALUES ('1', '164', '2021销售培训', '2021-08-17', '2021-09-03', '去总公司培训了的呢', '24', '5', '1629170688', '1629170797', '1', '1');
