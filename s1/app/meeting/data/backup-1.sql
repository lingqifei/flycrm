
-- -----------------------------
-- Table structure for `#@__met_room`
-- -----------------------------
DROP TABLE IF EXISTS `#@__met_room`;
CREATE TABLE `#@__met_room` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '会议室名称',
  `address` varchar(256) NOT NULL DEFAULT '' COMMENT '所在地点',
  `nums` int(11) NOT NULL DEFAULT '0' COMMENT '最大人数',
  `device` varchar(256) DEFAULT '' COMMENT '设备设施',
  `litpic` varchar(256) DEFAULT '' COMMENT '会议室图片',
  `remark` varchar(256) DEFAULT '' COMMENT '备注说明',
  `man_user_id` int(11) DEFAULT '0' COMMENT '会议室管理人员',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `visible` int(11) DEFAULT '0' COMMENT '启用',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '企业会员',
  `create_user_id` int(11) NOT NULL DEFAULT '1' COMMENT '创建人员',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `username` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='[meeting]会议室';

-- -----------------------------
-- Records of `met_room`
-- -----------------------------
INSERT INTO `#@__met_room` VALUES ('1', '大会议', '3楼', '30', '投影机，电脑', '30', '', '0', '11', '1', '1671525226', '1671525608', '1', '1');
INSERT INTO `#@__met_room` VALUES ('2', '大会议2号', '3楼', '30', '', '', '', '0', '11', '1', '1671525256', '1671608428', '1', '1');

-- -----------------------------
-- Table structure for `#@__met_summary`
-- -----------------------------
DROP TABLE IF EXISTS `#@__met_summary`;
CREATE TABLE `#@__met_summary` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` varchar(256) DEFAULT '' COMMENT '会议室id',
  `name` varchar(256) DEFAULT '' COMMENT '会议名称',
  `host_user_id` int(11) DEFAULT '0' COMMENT '主持人员',
  `host_user_name` varchar(256) DEFAULT '' COMMENT '主持人员名称',
  `join_user_name` varchar(256) DEFAULT '' COMMENT '参与人员名称',
  `join_user_id` varchar(256) DEFAULT '' COMMENT '参与人员',
  `content` varchar(2560) DEFAULT '' COMMENT '会议内容',
  `resolution` varchar(2560) DEFAULT '' COMMENT '会议决议',
  `trace_body` varchar(2560) DEFAULT '' COMMENT '跟进内容',
  `attachment` varchar(2560) DEFAULT '' COMMENT '附件内容',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_user_id` int(16) NOT NULL DEFAULT '0' COMMENT '创建人员',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '企业编号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[meeting]会议纪要';

-- -----------------------------
-- Records of `met_summary`
-- -----------------------------
INSERT INTO `#@__met_summary` VALUES ('1', '2', '开会好', '86', 'xiao2', '李小4,李小3,李小2,李小1', '94,93,92,91', '好你的', '不行的哟', '还行挹', '7', '2022-12-21 16:40:07', '2022-12-21 16:43:20', '1671612238', '1671671134', '0', '1');

-- -----------------------------
-- Table structure for `#@__met_reserve`
-- -----------------------------
DROP TABLE IF EXISTS `#@__met_reserve`;
CREATE TABLE `#@__met_reserve` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` varchar(256) DEFAULT '' COMMENT '会议室id',
  `name` varchar(256) DEFAULT '' COMMENT '会议名称',
  `remark` varchar(2560) DEFAULT '' COMMENT '备注说明',
  `ding_user_id` varchar(256) DEFAULT '' COMMENT '预订人员',
  `ding_user_name` varchar(256) DEFAULT '' COMMENT '预订人员名称',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `audit_status` tinyint(4) DEFAULT '1' COMMENT '0=未执行，1=待审核，2=通过，3=拒绝',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_user_id` int(16) NOT NULL DEFAULT '0' COMMENT '创建人员',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '企业编号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[meeting]会议室预订';

-- -----------------------------
-- Records of `met_reserve`
-- -----------------------------
INSERT INTO `#@__met_reserve` VALUES ('1', '1', '发布会', '', '1', '零起飞', '2022-12-21 15:30:59', '2022-12-21 16:10:59', '1', '1671607722', '1671608435', '0', '1');
