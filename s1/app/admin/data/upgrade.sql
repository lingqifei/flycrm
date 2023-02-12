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
REPLACE INTO `#@__sys_msg_type` VALUES ('8', '销售订单到期', 'sal_order_expire', '', '10', '有销售订单即将到期需要跟进时提醒操作人员', '721', '1', '1', '0', '0', '1635313894', '1635412897', '1');
REPLACE INTO `#@__sys_msg_type` VALUES ('9', '网站到期提醒', 'cst_website_expire', '', '10', '有网站维护服务即将到期需要跟进时提醒操作人员', '721', '1', '1', '0', '0', '1635313894', '1635412897', '1');

-- -----------------------------
-- Records of 修改菜单标签、解决增加菜单无法合入问题
-- -----------------------------
UPDATE `#@__sys_menu` SET url='organization' WHERE NAME='组织结构' AND url='index/main';
UPDATE `#@__sys_menu` SET url='database manage' WHERE NAME='数据库管理' AND url='Database/show';
UPDATE `#@__sys_menu` SET url='system oa' WHERE NAME='我的办公' AND url='oa/index';

-- ----------------------------end tiem by 2021-10-30 ------------------------------
