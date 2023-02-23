
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
-- Records of `lqf_cst_trace`
-- -----------------------------
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

-- -----------------------------
-- Table structure for `#@__icence`
-- -----------------------------
DROP TABLE IF EXISTS `#@__icence`;
CREATE TABLE `#@__icence` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `expire_date` date DEFAULT NULL COMMENT '到期日期',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(256) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]证照管理';

-- -----------------------------
-- Records of `lqf_licence`
-- -----------------------------
INSERT INTO `#@__icence` VALUES ('1', '营业执照', '2021-08-16', '这个还行吧', '24', '', '1629102293', '1629102316', '1', '1');

-- -----------------------------
-- Table structure for `#@__icence_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__icence_reply`;
CREATE TABLE `#@__icence_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `licence_id` int(16) NOT NULL DEFAULT '0' COMMENT '证照编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]证照回复';

-- -----------------------------
-- Records of `lqf_licence_reply`
-- -----------------------------
INSERT INTO `#@__icence_reply` VALUES ('1', '昨天换了证件了的哟', '', '', '1', '1629102771', '0', '1', '1', '', '');
INSERT INTO `#@__icence_reply` VALUES ('2', '这个东西已经不在这里的哟', '', '', '1', '1629102788', '0', '1', '1', '', '');

-- -----------------------------
-- Table structure for `#@__meeting`
-- -----------------------------
DROP TABLE IF EXISTS `#@__meeting`;
CREATE TABLE `#@__meeting` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '会议主题',
  `host_user_id` int(16) DEFAULT '0' COMMENT '主持人员id',
  `part_user_id` varchar(256) NOT NULL DEFAULT '' COMMENT '参与人员编号',
  `part_user_name` varchar(256) NOT NULL DEFAULT '' COMMENT '参与人员名称',
  `begin_date` date DEFAULT NULL COMMENT '购买日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `status` varchar(256) DEFAULT '' COMMENT '状态',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `address` varchar(256) NOT NULL DEFAULT '' COMMENT '会议地址',
  `begin_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]会议管理列表';

-- -----------------------------
-- Records of `lqf_meeting`
-- -----------------------------
INSERT INTO `#@__meeting` VALUES ('1', '张三开会', '1', '', '', '2021-08-19', '2021-08-19', '好的,这个东西不是很发的哟', '', '6', '2', '1629341469', '1629342830', '1', '1', '会试二', '2021-08-19 14:50:42', '2021-08-19 14:50:42');

-- -----------------------------
-- Table structure for `#@__meeting_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__meeting_reply`;
CREATE TABLE `#@__meeting_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `meeting_id` int(16) NOT NULL DEFAULT '0' COMMENT '会议编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]会议回复';

-- -----------------------------
-- Records of `lqf_meeting_reply`
-- -----------------------------
INSERT INTO `#@__meeting_reply` VALUES ('1', '<p>\r\n	这是那方面的说的呢\r\n</p>\r\n<p>\r\n	还行的吧\r\n</p>', '', '', '1', '1629342612', '1629342794', '1', '1', '', '');
INSERT INTO `#@__meeting_reply` VALUES ('2', '<p>\r\n	好的来好的呢，来吧\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	这是什么东西的来的哟，还不清楚的吧\r\n</p>', '', '', '1', '1629342658', '1629342771', '1', '1', '', '');

-- -----------------------------
-- Table structure for `#@__myfile`
-- -----------------------------
DROP TABLE IF EXISTS `#@__myfile`;
CREATE TABLE `#@__myfile` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '文件名称',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '文件地址',
  `remark` varchar(512) NOT NULL DEFAULT '' COMMENT '备注说明',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]我的文件';

-- -----------------------------
-- Records of `lqf_myfile`
-- -----------------------------
INSERT INTO `#@__myfile` VALUES ('1', '这是2018年的合同吧', '5,6,7', '还是行吧', '1628590979', '1628591072', '1', '1');

-- -----------------------------
-- Table structure for `#@__notice`
-- -----------------------------
DROP TABLE IF EXISTS `#@__notice`;
CREATE TABLE `#@__notice` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]公告资讯';

-- -----------------------------
-- Records of `lqf_notice`
-- -----------------------------
INSERT INTO `#@__notice` VALUES ('1', '习近平同伊朗总统莱希就中伊建交50周年互致贺电', '<p style=\"color:#333333;font-family:\" font-size:16px;font-style:normal;font-weight:400;text-align:start;text-indent:0px;background-color:#ffffff;\"=\"\">\r\n	习近平在贺电中指出，建交半个世纪以来，中伊关系稳步发展，传统友谊历久弥坚。2016年两国建立全面战略伙伴关系后，双方政治互信日益巩固，各领域互利合作稳步推进。新冠肺炎疫情发生后，中伊同舟共济、守望相助，谱写了合作抗疫的佳话。我高度重视中伊关系发展，愿同莱希总统一道努力，以两国建交50周年为契机，深化传统友谊，推进各领域合作走深走实，不断充实中伊全面战略伙伴关系内涵，造福两国和两国人民。\r\n	</p>\r\n<p style=\"color:#333333;font-family:\" font-size:16px;font-style:normal;font-weight:400;text-align:start;text-indent:0px;background-color:#ffffff;\"=\"\">\r\n	&emsp;&emsp;莱希在贺电中表示，伊中都是文明古国，两国友谊犹如参天古树，从数千年的友好交往中汲取养分，为伊中全面战略伙伴关系日益发展扎下深厚根基。伊方致力于打造卓越伊中关系的意志坚定不移。在两国关系迈入第六个十年之际，伊方愿同中方继续提升战略合作水平，就拓展各领域务实合作加强沟通，不断深化伊中关系。\r\n</p>', '', '', '5', '1629097042', '1629098476', '1', '1');

-- -----------------------------
-- Table structure for `#@__notice_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__notice_reply`;
CREATE TABLE `#@__notice_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `notice_id` int(16) NOT NULL DEFAULT '0' COMMENT '公告编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]公告资讯回复';

-- -----------------------------
-- Records of `lqf_notice_reply`
-- -----------------------------
INSERT INTO `#@__notice_reply` VALUES ('1', '1111', '', '', '0', '1629097747', '0', '1', '1', '', '');
INSERT INTO `#@__notice_reply` VALUES ('14', '2342342342323', '', '', '1', '1630922327', '0', '1', '1', '', '10,11,10,11,10');
INSERT INTO `#@__notice_reply` VALUES ('17', '24534234', '', '', '1', '1630922720', '0', '1', '1', '', '11');
INSERT INTO `#@__notice_reply` VALUES ('18', '好的', '', '', '1', '1630922767', '0', '1', '1', '', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='[系统]系统公告';


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
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='[系统]系统公告用户';


-- -----------------------------
-- Table structure for `#@__other_notes`
-- -----------------------------
DROP TABLE IF EXISTS `#@__other_notes`;
CREATE TABLE `#@__other_notes` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '标题名称',
  `body` text COMMENT '内容',
  `litpic` varchar(256) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `shop_id` int(16) DEFAULT '0' COMMENT '门店编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `linkman` varchar(256) NOT NULL DEFAULT '' COMMENT '对方联系人及电话',
  `update_user_id` int(16) DEFAULT '0' COMMENT '更新人员id',
  `owner_user_id` int(16) DEFAULT '0' COMMENT '负责人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]其它记录';

-- -----------------------------
-- Records of `lqf_other_notes`
-- -----------------------------
INSERT INTO `#@__other_notes` VALUES ('1', '科伦公司采购口罩', '1111\r\n<div class=\"index-module_textWrap_3ygOc\" style=\"text-align:start;\">\r\n	<p>\r\n		日前，“双减”政策正式落地，教培行业进入寒冬期，如何转型生存下来是头等大事。而此前被媒体报道在内部会议哭了的俞敏洪，似乎找到了新方向——既然国家不让鸡娃，那就鸡家长吧！\r\n	</p>\r\n</div>\r\n<div class=\"index-module_textWrap_3ygOc\" style=\"text-align:start;\">\r\n	<p>\r\n		据虎嗅援引第一财经报道，近日，新东方在北京杭州等地推出素质教育成长中心，其中包括“优质父母智慧馆”。素质教育之外，教培机构还盯上了成人教育、职业教育等。\r\n	</p>\r\n</div>\r\n<div class=\"index-module_textWrap_3ygOc\" style=\"text-align:start;\">\r\n	<p>\r\n		此消息一出，网友反应则是一片“哈哈哈哈哈”，“真·兵来将挡水来土掩”“还有什么是新东方不可以培训的？”“实在不行还能当厨师”。\r\n	</p>\r\n</div>', '', '6', '0', '1628753088', '1631679079', '1', '1', '张帮 1585464641', '1', '83');
INSERT INTO `#@__other_notes` VALUES ('2', '科伦公司采购口罩', '科伦公司采购口罩，需要采购一些一次性的', '', '', '0', '1631677386', '1631678149', '1', '1', '', '1', '85');
INSERT INTO `#@__other_notes` VALUES ('3', '科伦公司采购口罩', '科伦公司采购口罩，需要采购一些一次性的', '', '', '0', '1631677478', '1631677478', '1', '1', '张帮 1585464641', '0', '83');

-- -----------------------------
-- Table structure for `#@__other_notes_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__other_notes_reply`;
CREATE TABLE `#@__other_notes_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `other_notes_id` int(16) NOT NULL DEFAULT '0' COMMENT '记录编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]其它记录回复';

-- -----------------------------
-- Records of `lqf_other_notes_reply`
-- -----------------------------
INSERT INTO `#@__other_notes_reply` VALUES ('1', '这是什么的呢', '', '', '1', '1631685810', '0', '1', '1');
INSERT INTO `#@__other_notes_reply` VALUES ('2', '还行的吧', '', '10', '1', '1631685885', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__regulation`
-- -----------------------------
DROP TABLE IF EXISTS `#@__regulation`;
CREATE TABLE `#@__regulation` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `type_id` int(16) DEFAULT '0' COMMENT '分类编号',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '资产名称',
  `body` text COMMENT '内容',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]规章制度';

-- -----------------------------
-- Records of `lqf_regulation`
-- -----------------------------
INSERT INTO `#@__regulation` VALUES ('1', '1', '111111111', '<p style=\"color:#333333;font-family:-apple-system, BlinkMacSystemFont, &quot;font-size:17px;font-style:normal;font-weight:400;text-align:justify;text-indent:0px;background-color:#FFFFFF;\">\r\n	邛海，远望山光云影，一碧千倾，水质清澈透明。蔚蓝的湖水，深不可测。没有风时，天净水明，和蓝天融为一体。湖面像一面镜子，可以倒映出每一座山、每一朵云、每一棵树，清清楚楚。此时，正是枫叶红得最艳最灿烂，水中的倒影又是一副色彩斑斓的油画。波澜不惊，只见一群水鸟悠然飞过。如果这时倒映着白云，再来一丝微风，会出现这样一副奇特的画面：天空中的白云没有飘动，水中的白云悄悄挪起脚掌，慢慢的走着。微风停下时，天上的云朵发现水中的自己正在逃跑，很是恼火，又没有办法，最后灵机一动，请微风换一个方向吹拂，把逃跑的倒影抓了回来。\r\n</p>\r\n<p style=\"color:#333333;font-family:-apple-system, BlinkMacSystemFont, &quot;font-size:17px;font-style:normal;font-weight:400;text-indent:0px;background-color:#FFFFFF;text-align:center;\">\r\n	<br />\r\n</p>', '', '', '6', '1629268835', '1629269315', '1', '1');

-- -----------------------------
-- Table structure for `#@__regulation_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__regulation_reply`;
CREATE TABLE `#@__regulation_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `regulation_id` int(16) NOT NULL DEFAULT '0' COMMENT '制度编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]规章制度回复';

-- -----------------------------
-- Records of `lqf_regulation_reply`
-- -----------------------------
INSERT INTO `#@__regulation_reply` VALUES ('1', '11111111111111', '', '', '1', '1629269836', '0', '1', '1', '', '');
INSERT INTO `#@__regulation_reply` VALUES ('2', '这是一个好的东西的呢', '', '', '1', '1629269847', '0', '1', '1', '', '');

-- -----------------------------
-- Table structure for `#@__regulation_type`
-- -----------------------------
DROP TABLE IF EXISTS `#@__regulation_type`;
CREATE TABLE `#@__regulation_type` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]规章制度分类';

-- -----------------------------
-- Records of `lqf_regulation_type`
-- -----------------------------
INSERT INTO `#@__regulation_type` VALUES ('1', '公司章程', '0', '100', '1', '', '1629268194', '0', '1', '0');
INSERT INTO `#@__regulation_type` VALUES ('2', '公司制度', '0', '100', '1', '', '1629268202', '0', '1', '0');

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
-- Table structure for `#@__share_file`
-- -----------------------------
DROP TABLE IF EXISTS `#@__share_file`;
CREATE TABLE `#@__share_file` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `body` text COMMENT '内容',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `shop_id` int(16) DEFAULT '0' COMMENT '门店编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]监管部门文件';

-- -----------------------------
-- Records of `lqf_share_file`
-- -----------------------------
INSERT INTO `#@__share_file` VALUES ('1', '2021公司生产说明文件', '这是内容说明的呢<br />', '这是生产说明文件的呢', '', '6', '0', '1628754809', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__shop`
-- -----------------------------
DROP TABLE IF EXISTS `#@__shop`;
CREATE TABLE `#@__shop` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '门店名称',
  `linkman` varchar(256) NOT NULL DEFAULT '' COMMENT '联系人',
  `mobile` varchar(256) NOT NULL DEFAULT '' COMMENT '联系手机',
  `email` varchar(256) NOT NULL DEFAULT '' COMMENT '联系邮箱',
  `address` varchar(256) NOT NULL DEFAULT '' COMMENT '联系地址',
  `remark` varchar(512) NOT NULL DEFAULT '' COMMENT '备注说明',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]门店列表';

-- -----------------------------
-- Records of `lqf_shop`
-- -----------------------------
INSERT INTO `#@__shop` VALUES ('1', '青天门店', '李四哥', '19023400234', '', '成都市天河路100号', '这是一个好的门店呢', '1628661653', '0', '1', '1');
INSERT INTO `#@__shop` VALUES ('2', '九里门店', '王青', '18956547474', '', '一环路九里100号', '', '1628668350', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__shop_album`
-- -----------------------------
DROP TABLE IF EXISTS `#@__shop_album`;
CREATE TABLE `#@__shop_album` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `shop_id` int(16) DEFAULT '0' COMMENT '门店编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]门店相册';

-- -----------------------------
-- Records of `lqf_shop_album`
-- -----------------------------
INSERT INTO `#@__shop_album` VALUES ('1', '10国庆活动', '这是国庆的活动图片哟', '25,26,27,28,29,30', '', '1', '1628673401', '1628673421', '1', '1');
INSERT INTO `#@__shop_album` VALUES ('2', 'iikl', '', '35', '', '1', '1673514226', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__shop_file_dept`
-- -----------------------------
DROP TABLE IF EXISTS `#@__shop_file_dept`;
CREATE TABLE `#@__shop_file_dept` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `body` text COMMENT '内容',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `shop_id` int(16) DEFAULT '0' COMMENT '门店编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]监管部门文件';

-- -----------------------------
-- Records of `lqf_shop_file_dept`
-- -----------------------------
INSERT INTO `#@__shop_file_dept` VALUES ('1', '这是香客文件2021发展报告', '这是内容呢，可以直接写到这里来哟<br />', '主要讲介绍了，这个是怎么行的呢', '', '5', '0', '1628736051', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__shop_file_dept_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__shop_file_dept_reply`;
CREATE TABLE `#@__shop_file_dept_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `file_id` int(16) NOT NULL DEFAULT '0' COMMENT '文件编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]监管部门文件评论回复';

-- -----------------------------
-- Records of `lqf_shop_file_dept_reply`
-- -----------------------------
INSERT INTO `#@__shop_file_dept_reply` VALUES ('1', '这个报告 还是要吧的', '', '', '1', '1628736064', '0', '1', '1', '', '');
INSERT INTO `#@__shop_file_dept_reply` VALUES ('2', '昨天我们来做了什么的呢', '', '', '1', '1628736080', '0', '1', '1', '', '');

-- -----------------------------
-- Table structure for `#@__shop_file_inside`
-- -----------------------------
DROP TABLE IF EXISTS `#@__shop_file_inside`;
CREATE TABLE `#@__shop_file_inside` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `shop_id` int(16) DEFAULT '0' COMMENT '门店编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `body` text COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]门店相册';

-- -----------------------------
-- Records of `lqf_shop_file_inside`
-- -----------------------------
INSERT INTO `#@__shop_file_inside` VALUES ('1', '这是好的东西哟', '这是什么文章的呢，还不', '', '5,6', '0', '1628675581', '1628675915', '1', '1', '好的<br />');

-- -----------------------------
-- Table structure for `#@__shop_file_inside_reply`
-- -----------------------------
DROP TABLE IF EXISTS `#@__shop_file_inside_reply`;
CREATE TABLE `#@__shop_file_inside_reply` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `file_id` int(16) NOT NULL DEFAULT '0' COMMENT '文件编号id',
  `reply_litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '图片',
  `reply_attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]公司内部文件评论回复';

-- -----------------------------
-- Records of `lqf_shop_file_inside_reply`
-- -----------------------------
INSERT INTO `#@__shop_file_inside_reply` VALUES ('1', '这还是不错的哟', '', '', '1628732300', '0', '1', '1', '1', '', '');
INSERT INTO `#@__shop_file_inside_reply` VALUES ('2', '这是什么东西，还好哟', '', '', '1628732527', '1628733824', '1', '1', '1', '', '');
INSERT INTO `#@__shop_file_inside_reply` VALUES ('4', '这还是不错的哟33', '', '', '1628732527', '0', '1', '1', '1', '', '');
INSERT INTO `#@__shop_file_inside_reply` VALUES ('5', '这还是不错的哟44', '', '', '1628732527', '0', '1', '1', '1', '', '');
INSERT INTO `#@__shop_file_inside_reply` VALUES ('6', '这还是不错的哟555', '', '', '1628732527', '0', '1', '1', '1', '', '');
INSERT INTO `#@__shop_file_inside_reply` VALUES ('7', '这还是不错的哟666', '', '', '1628732527', '0', '1', '1', '1', '', '');
INSERT INTO `#@__shop_file_inside_reply` VALUES ('8', '毁在', '', '', '1628734002', '0', '1', '1', '1', '', '');

-- -----------------------------
-- Table structure for `#@__shop_licence`
-- -----------------------------
DROP TABLE IF EXISTS `#@__shop_licence`;
CREATE TABLE `#@__shop_licence` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `expire_date` date DEFAULT NULL COMMENT '到期日期',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(256) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `shop_id` int(16) DEFAULT '0' COMMENT '门店编号id',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]门店日常记录';

-- -----------------------------
-- Records of `lqf_shop_licence`
-- -----------------------------
INSERT INTO `#@__shop_licence` VALUES ('1', '门店证照', '2021-08-31', '门店证照', '24', '', '1', '1628671700', '1630295027', '1', '1');
INSERT INTO `#@__shop_licence` VALUES ('2', '大冰龙店', '2021-08-11', '在', '', '', '1', '1628672530', '0', '1', '1');

-- -----------------------------
-- Table structure for `#@__shop_notes`
-- -----------------------------
DROP TABLE IF EXISTS `#@__shop_notes`;
CREATE TABLE `#@__shop_notes` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '标题名称',
  `body` text COMMENT '内容',
  `litpic` varchar(256) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `shop_id` int(16) DEFAULT '0' COMMENT '门店编号id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]门店日常记录';

-- -----------------------------
-- Records of `lqf_shop_notes`
-- -----------------------------
INSERT INTO `#@__shop_notes` VALUES ('1', '这是好', '<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	在不少旁观者的眼里，智能化几乎成了一种避之唯恐不及的“瘟疫”，开始攀附上大大小小、各式各样的工具和设备，从水杯、灯泡、体重秤这样的小物件，再到冰箱、洗衣机这些生活中的庞然大物。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	兜兜转转之后，这场“瘟疫”又找上了在生活中不那么起眼的自行车。然而，在搭上智能化的顺风车之前，你可知道自行车的历史？虽然，在乐视超级自行车的发布会上，它已经用了自行车史上有着重要地位的三个名字——斯塔利、西夫拉克、阿尔普迪埃——来命名自家的自行车，但那远远不够。Gizmodo 为我们梳理了自行车发展的关键节点。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	在开始之前，我们先来看看丹麦的设计师制作的动画，一分钟看完自行车近 200 年的演变。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	比较公认的说法是，第一辆自行车由法国手工艺人西夫拉克（Médé de Sivrac）设计，在两个轮子上安装了支架并配上马鞍，前进的话需要用脚蹬地提供动力。这还只是一个很简单的雏形，没有方向舵，转弯的时候需要骑行者下车抬起前轮，稳定性也不好。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	德国人杜莱斯（Karl Drais von Sauerbronn）制作了一辆和西夫拉克的设计相近的两轮车子，增加了车把，可以改变行进中的方向，速度可以达到 15km/h。不过，还是需要靠双脚蹬地提供动力。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	这时候第一辆真正意义上的自行车诞生了，是由苏格兰铁匠麦克米伦（Kirkpatrik Macmillan）设计的，它还有一个专门的名字——Velocipede。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	在不少旁观者的眼里，智能化几乎成了一种避之唯恐不及的“瘟疫”，开始攀附上大大小小、各式各样的工具和设备，从水杯、灯泡、体重秤这样的小物件，再到冰箱、洗衣机这些生活中的庞然大物。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	兜兜转转之后，这场“瘟疫”又找上了在生活中不那么起眼的自行车。然而，在搭上智能化的顺风车之前，你可知道自行车的历史？虽然，在乐视超级自行车的发布会上，它已经用了自行车史上有着重要地位的三个名字——斯塔利、西夫拉克、阿尔普迪埃——来命名自家的自行车，但那远远不够。Gizmodo 为我们梳理了自行车发展的关键节点。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	在开始之前，我们先来看看丹麦的设计师制作的动画，一分钟看完自行车近 200 年的演变。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	比较公认的说法是，第一辆自行车由法国手工艺人西夫拉克（Médé de Sivrac）设计，在两个轮子上安装了支架并配上马鞍，前进的话需要用脚蹬地提供动力。这还只是一个很简单的雏形，没有方向舵，转弯的时候需要骑行者下车抬起前轮，稳定性也不好。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	德国人杜莱斯（Karl Drais von Sauerbronn）制作了一辆和西夫拉克的设计相近的两轮车子，增加了车把，可以改变行进中的方向，速度可以达到 15km/h。不过，还是需要靠双脚蹬地提供动力。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	这时候第一辆真正意义上的自行车诞生了，是由苏格兰铁匠麦克米伦（Kirkpatrik Macmillan）设计的，它还有一个专门的名字——Velocipede。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	在不少旁观者的眼里，智能化几乎成了一种避之唯恐不及的“瘟疫”，开始攀附上大大小小、各式各样的工具和设备，从水杯、灯泡、体重秤这样的小物件，再到冰箱、洗衣机这些生活中的庞然大物。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	兜兜转转之后，这场“瘟疫”又找上了在生活中不那么起眼的自行车。然而，在搭上智能化的顺风车之前，你可知道自行车的历史？虽然，在乐视超级自行车的发布会上，它已经用了自行车史上有着重要地位的三个名字——斯塔利、西夫拉克、阿尔普迪埃——来命名自家的自行车，但那远远不够。Gizmodo 为我们梳理了自行车发展的关键节点。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	在开始之前，我们先来看看丹麦的设计师制作的动画，一分钟看完自行车近 200 年的演变。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	比较公认的说法是，第一辆自行车由法国手工艺人西夫拉克（Médé de Sivrac）设计，在两个轮子上安装了支架并配上马鞍，前进的话需要用脚蹬地提供动力。这还只是一个很简单的雏形，没有方向舵，转弯的时候需要骑行者下车抬起前轮，稳定性也不好。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	德国人杜莱斯（Karl Drais von Sauerbronn）制作了一辆和西夫拉克的设计相近的两轮车子，增加了车把，可以改变行进中的方向，速度可以达到 15km/h。不过，还是需要靠双脚蹬地提供动力。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	这时候第一辆真正意义上的自行车诞生了，是由苏格兰铁匠麦克米伦（Kirkpatrik Macmillan）设计的，它还有一个专门的名字——Velocipede。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	在不少旁观者的眼里，智能化几乎成了一种避之唯恐不及的“瘟疫”，开始攀附上大大小小、各式各样的工具和设备，从水杯、灯泡、体重秤这样的小物件，再到冰箱、洗衣机这些生活中的庞然大物。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	兜兜转转之后，这场“瘟疫”又找上了在生活中不那么起眼的自行车。然而，在搭上智能化的顺风车之前，你可知道自行车的历史？虽然，在乐视超级自行车的发布会上，它已经用了自行车史上有着重要地位的三个名字——斯塔利、西夫拉克、阿尔普迪埃——来命名自家的自行车，但那远远不够。Gizmodo 为我们梳理了自行车发展的关键节点。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	在开始之前，我们先来看看丹麦的设计师制作的动画，一分钟看完自行车近 200 年的演变。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	比较公认的说法是，第一辆自行车由法国手工艺人西夫拉克（Médé de Sivrac）设计，在两个轮子上安装了支架并配上马鞍，前进的话需要用脚蹬地提供动力。这还只是一个很简单的雏形，没有方向舵，转弯的时候需要骑行者下车抬起前轮，稳定性也不好。\r\n</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	德国人杜莱斯（Karl Drais von Sauerbronn）制作了一辆和西夫拉克的设计相近的两轮车子，增加了车把，可以改变行进中的方向，速度可以达到 15km/h。不过，还是需要靠双脚蹬地提供动力。\r\n	</p>\r\n<p style=\"font-size:15px;color:#676A6C;font-family:\" font-style:normal;font-weight:400;text-align:start;text-indent:0px;\"=\"\">\r\n	这时候第一辆真正意义上的自行车诞生了，是由苏格兰铁匠麦克米伦（Kirkpatrik Macmillan）设计的，它还有一个专门的名字——Velocipede。\r\n</p>\r\n<br class=\"Apple-interchange-newline\" />\r\n<br />\r\n<br />', '', '5,6', '1628665259', '1628667979', '1', '1', '1');
INSERT INTO `#@__shop_notes` VALUES ('2', '1111', '11111111111', '', '', '1628666010', '1628666021', '1', '1', '1');

-- -----------------------------
-- Table structure for `#@__shop_staff`
-- -----------------------------
DROP TABLE IF EXISTS `#@__shop_staff`;
CREATE TABLE `#@__shop_staff` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `staff_no` varchar(50) NOT NULL DEFAULT '' COMMENT '员工编号',
  `shop_id` varchar(256) NOT NULL DEFAULT '0' COMMENT '所在门店',
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
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=utf8 COMMENT='[hrm]员工档案';

-- -----------------------------
-- Records of `lqf_shop_staff`
-- -----------------------------
INSERT INTO `#@__shop_staff` VALUES ('164', 'XZ2543', '2', '张三', '1', '511929198005127894', '2021-05-27', '未婚', '团员', '本科', '电子商务', '计算机', '经理', '协会员', '18030402705', '1871720801', 'goodmuzi@qq.com', '', '成都市天河路', '这是一个好员工的呀', '2021-05-27', '2021-06-11', '2021-05-27', '1', '0', '0', '1624071305', '0');
INSERT INTO `#@__shop_staff` VALUES ('167', 'DSA215455', '2', '李四', '1', '511929198005127894', '2021-05-27', '未婚', '团员', '本科', '电子商务', '计算机', '经理', '协会员', '18030402705', '1871720801', 'goodmuzi@qq.com', '', '这是那时呀', '这是一个好员工的呀', '2021-05-27', '2021-08-19', '2021-06-10', '1', '0', '0', '1624073269', '0');
-- -----------------------------
-- Table structure for `#@__sup_contract`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sup_contract`;
CREATE TABLE `#@__sup_contract` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `supplier_id` int(16) DEFAULT '0' COMMENT '供应商编号id',
  `contract_no` varchar(256) NOT NULL DEFAULT '' COMMENT '合同编号',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `begin_date` date DEFAULT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `money` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '合同金额',
  `status` varchar(256) NOT NULL DEFAULT '' COMMENT '状态',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `remind_date` date DEFAULT NULL COMMENT '提醒日期',
  `body` varchar(1024) NOT NULL DEFAULT '' COMMENT '合同内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]采购合同';

-- -----------------------------
-- Table structure for `#@__sup_linkman`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sup_linkman`;
CREATE TABLE `#@__sup_linkman` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(16) NOT NULL COMMENT '供应商编号',
  `name` varchar(256) DEFAULT NULL COMMENT '联系人名称',
  `gender` smallint(1) DEFAULT NULL COMMENT '姓别1=男，0-女',
  `postion` varchar(256) DEFAULT NULL COMMENT '职位',
  `tel` varchar(256) DEFAULT NULL COMMENT '电话',
  `mobile` varchar(256) NOT NULL COMMENT '手机',
  `qicq` varchar(256) DEFAULT NULL COMMENT 'qq',
  `email` varchar(256) DEFAULT NULL COMMENT '邮箱',
  `zipcode` varchar(256) DEFAULT NULL COMMENT '邮编',
  `address` varchar(1024) DEFAULT NULL COMMENT '地址',
  `remark` text COMMENT '备注',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_user_id` int(16) NOT NULL DEFAULT '0' COMMENT '创建人',
  `org_id` int(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='供应商联系人';

-- -----------------------------
-- Records of `lqf_sup_linkman`
-- -----------------------------
INSERT INTO `#@__sup_linkman` VALUES ('1', '12', '枭哥', '1', '技术部', '02888641234', '13688868655', '1585925559', 'web@07fly.com', '610000', '成都市新路', '这个小伙子不错,一个很好的人的呀', '2013', '0', '0', '0');
INSERT INTO `#@__sup_linkman` VALUES ('2', '12', '二娃', '1', '1', '12345678', '12345678', '', '1@1.com', '', '', '', '2013', '0', '0', '0');


-- -----------------------------
-- Table structure for `#@__sup_sales`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sup_sales`;
CREATE TABLE `#@__sup_sales` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `supplier_id` int(16) DEFAULT '0' COMMENT '供应商编号id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `purchase_date` date DEFAULT NULL COMMENT '采购日期',
  `money` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '采购金额',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]销售记录';

-- -----------------------------
-- Records of `lqf_sup_sales`
-- -----------------------------
INSERT INTO `#@__sup_sales` VALUES ('1', '23', '五月份第一单采购', '2021-08-13', '5000.00', '这个月第一次采购', '', '', '1628846758', '1629713048', '1', '1');

-- -----------------------------
-- Table structure for `#@__sup_supplier`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sup_supplier`;
CREATE TABLE `#@__sup_supplier` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(64) NOT NULL COMMENT '供应商名称',
  `area_id` int(16) NOT NULL DEFAULT '0' COMMENT '所在地区',
  `level` varchar(50) NOT NULL DEFAULT '' COMMENT '客户等级',
  `ecotype` varchar(50) NOT NULL DEFAULT '' COMMENT '经济类型',
  `industry` varchar(50) NOT NULL DEFAULT '' COMMENT '行业',
  `satisfy` smallint(6) NOT NULL DEFAULT '3' COMMENT '满意度（1-5），默认为3',
  `credit` smallint(2) NOT NULL DEFAULT '3' COMMENT '信用度（1-5），默认为3',
  `address` varchar(256) DEFAULT NULL COMMENT '联系地址',
  `linkman` varchar(256) DEFAULT NULL COMMENT '首要联系人',
  `mobile` varchar(256) DEFAULT NULL COMMENT '手机',
  `website` varchar(256) DEFAULT NULL COMMENT '网址',
  `zipcode` varchar(64) DEFAULT NULL COMMENT '邮编',
  `tel` varchar(256) NOT NULL COMMENT '电话',
  `fax` varchar(256) DEFAULT NULL COMMENT '传真',
  `email` varchar(256) DEFAULT NULL COMMENT '邮箱',
  `remark` mediumtext COMMENT '备注',
  `create_user_id` int(16) NOT NULL DEFAULT '0' COMMENT '创建人员',
  `owner_user_id` int(16) NOT NULL DEFAULT '0' COMMENT '归属人员',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `delegate` varchar(256) NOT NULL DEFAULT '' COMMENT '代表品种',
  `channel` varchar(256) NOT NULL DEFAULT '' COMMENT '品牌渠道',
  `agreement` varchar(256) NOT NULL DEFAULT '' COMMENT '是否协议',
  `qicq` varchar(256) NOT NULL DEFAULT '' COMMENT 'QQ',
  `weixin` varchar(256) NOT NULL DEFAULT '' COMMENT '微信',
  `address_mail` varchar(256) NOT NULL DEFAULT '' COMMENT '邮寄地址',
  `linkman_other` varchar(256) NOT NULL DEFAULT '' COMMENT '其它联系人',
  `firmcategory` varchar(256) NOT NULL DEFAULT '' COMMENT '厂家类别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COMMENT='供应商';

-- -----------------------------
-- Records of `lqf_sup_supplier`
-- -----------------------------
INSERT INTO `#@__sup_supplier` VALUES ('13', '成都零起飞网络', '0', '0', '28', '24', '3', '3', '', '李先生', '', 'http://www.07fly.com', '', '18030402705', '', '', '这个公司还是不错哟', '1', '1', '0', '2016', '0', '', '', '', '', '', '', '', '');
INSERT INTO `#@__sup_supplier` VALUES ('16', '成都百度科技', '0', '0', '25', '24', '3', '3', '成都市大天路', '李大哥', '', '', '', '02832145678', '024854', 'goodmuzi@qq.com', '', '1', '1', '0', '2018', '0', '', '', '', '', '', '', '', '');

-- -----------------------------
-- Table structure for `#@__sup_trace`
-- -----------------------------
DROP TABLE IF EXISTS `#@__sup_trace`;
CREATE TABLE `#@__sup_trace` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `supplier_id` int(16) NOT NULL DEFAULT '0' COMMENT '供应商编号id',
  `linkman_id` int(16) NOT NULL DEFAULT '0' COMMENT '联系人编号',
  `linkman_name` varchar(256) NOT NULL DEFAULT '' COMMENT '联系人名称',
  `link_time` datetime DEFAULT NULL COMMENT '联系时间',
  `link_body` varchar(1024) NOT NULL DEFAULT '' COMMENT '联系内容',
  `next_time` datetime DEFAULT NULL COMMENT '下次联系时间',
  `next_body` varchar(1024) NOT NULL DEFAULT '' COMMENT '下次联系内容',
  `salestage` varchar(256) NOT NULL DEFAULT '' COMMENT '沟通阶段',
  `salemode` varchar(256) NOT NULL DEFAULT '' COMMENT '沟通方式',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `reply_body` varchar(1024) NOT NULL DEFAULT '' COMMENT '回复内容',
  `status` varchar(256) NOT NULL DEFAULT '' COMMENT '处理状态',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='[oask]供应商跟进记录';


-- -----------------------------
-- Table structure for `#@__weburl`
-- -----------------------------
DROP TABLE IF EXISTS `#@__weburl`;
CREATE TABLE `#@__weburl` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '网站名称',
  `url` varchar(256) NOT NULL DEFAULT '' COMMENT '网站网址',
  `remark` varchar(512) NOT NULL DEFAULT '' COMMENT '备注说明',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]网址收藏';

-- -----------------------------
-- Records of `lqf_weburl`
-- -----------------------------
INSERT INTO `#@__weburl` VALUES ('1', '百度网站', 'http://www.baidu.com', '这是一个好的网址呢', '1628586212', '1628586358', '1', '1');
INSERT INTO `#@__weburl` VALUES ('2', '百度网站', 'http://www.baidu.com', '还行吧，还可以的哟', '1628586217', '1628586367', '1', '1');

-- -----------------------------
-- Table structure for `#@__workflow`
-- -----------------------------
DROP TABLE IF EXISTS `#@__workflow`;
CREATE TABLE `#@__workflow` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '工作名称',
  `body` text COMMENT '工作内容',
  `remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `deal_user_id` varchar(256) NOT NULL DEFAULT '' COMMENT '处理审核人员',
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '0=临时单，1=待审核，2=已通过，3=被否决，4=被驳回，5=已撤销',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  `create_user_id` int(16) DEFAULT '0' COMMENT '创建人员id',
  `level` int(16) DEFAULT '0' COMMENT '级别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]员工考勤管理';

-- -----------------------------
-- Records of `lqf_workflow`
-- -----------------------------
INSERT INTO `#@__workflow` VALUES ('1', '关于招聘内容的查看哟', '这是一个好的内容东西扣<br />', '', '', '5', '83,1,84', '1', '1629784854', '1629796857', '1', '1', '1');
INSERT INTO `#@__workflow` VALUES ('2', '这是一个测试工作内容 的', '好的<br />', '', '', '6', '1', '2', '1629787827', '1629796995', '1', '1', '1');
INSERT INTO `#@__workflow` VALUES ('4', '这是一个测试工作内容 的', '这是一个测试工作内容 的', '', '', '', '1,83,84', '1', '1629787959', '1629794725', '1', '1', '1');
INSERT INTO `#@__workflow` VALUES ('5', '新品种沟通', '新品种沟通，要口罩的哟<br />', '', '', '', '85,86', '1', '1631668333', '1631686753', '1', '1', '2');
INSERT INTO `#@__workflow` VALUES ('6', '这是请示公司', '这是请示公司', '', '', '', '1,86', '1', '1631686710', '1668767500', '1', '1', '3');

-- -----------------------------
-- Table structure for `#@__workflow_deal`
-- -----------------------------
DROP TABLE IF EXISTS `#@__workflow_deal`;
CREATE TABLE `#@__workflow_deal` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主id',
  `deal_user_id` int(16) DEFAULT '0' COMMENT '处理人员id',
  `workflow_id` int(16) DEFAULT '0' COMMENT '关联工作流程id',
  `sort` int(16) DEFAULT '1',
  `deal_time` datetime DEFAULT NULL COMMENT '处理时间',
  `deal_remark` varchar(1024) NOT NULL DEFAULT '' COMMENT '备注说明',
  `deal_status` int(16) DEFAULT '0' COMMENT '0=待处理，1=通过，2=拒绝，3=转发',
  `litpic` varchar(1024) NOT NULL DEFAULT '' COMMENT '扫描图片',
  `attachment` varchar(256) NOT NULL DEFAULT '' COMMENT '附件文档',
  `status` int(16) DEFAULT '0' COMMENT '0=临时中，1=待处理，2=处理',
  `create_time` int(16) DEFAULT '0' COMMENT '创建日期',
  `update_time` int(16) DEFAULT '0' COMMENT '更新日期',
  `org_id` int(16) DEFAULT '1' COMMENT '企业编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COMMENT='[oask]工作流程处理管理';
