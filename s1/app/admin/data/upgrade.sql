-- -----------------------------
-- Records of `#@__sys_msg_type` 增加提醒配置的参数
-- -----------------------------
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (1, '线索跟进', 'cst_clue', '', '10', '有新的线索需要跟进时提醒操作人员', 24, 1, 1, 0, 0, 3, 0, 1635313485, 1635412895, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (2, '客户跟进', 'cst_customer', '', '10', '有新的客户需要跟进时提醒操作人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412903, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (3, '商机跟进', 'cst_chance', '', '10', '有新的销售机会（商机）需要跟进时提醒操作人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412901, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (4, '销售合同', 'sal_contract', '', '10', '有新的销售合同需要跟进时提醒操作人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412900, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (5, '销售订单', 'sal_order', '', '10', '有新的销售订单需要跟进时提醒操作人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412899, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (6, '销售合同到期', 'sal_contract_expire', '', '10', '有销售合同即将到期需要跟进时提醒操作人员', 721, 1, 1, 0, 0, 3, 0, 1635313894, 1635412897, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (7, '日程开始提醒', 'oa_schedule', '', '10', '日程开始时间提醒负责人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412897, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (8, '销售订单到期', 'sal_order_expire', '', '10', '有销售订单即将到期需要跟进时提醒操作人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412897, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (9, '网站到期提醒', 'cst_website_expire', '', '10', '有网站维护服务即将到期需要跟进时提醒操作人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412897, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (10, '任务提醒', 'oa_task', '', '10', '有新的任务提醒负责人、协助人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412897, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (11, '工作报告提醒', 'oa_work_report', '', '10', '有新的工作报告提醒批阅人、抄送人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412897, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (12, '工单提醒', 'oa_service', '', '10', '有新的工单提醒负责人、通知人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412897, 1);
REPLACE INTO `#@__sys_msg_type` (`id`, `name`, `type`, `maintable`, `url`, `remark`, `hours`, `remind_sms`, `remind_sys`, `remind_email`, `remind_weixin`, `remind_nums`, `remind_interval`, `create_time`, `update_time`, `org_id`) VALUES (13, '审批提醒', 'workflow_business_history', '', '10', '有新的审批任务时提醒审批人员审批、通知人员', 24, 1, 1, 0, 0, 3, 0, 1635313894, 1635412897, 1);


-- -----------------------------
-- Records of 修改菜单标签、解决增加菜单无法合入问题
-- -----------------------------
UPDATE `#@__sys_menu` SET url='organization' WHERE NAME='组织结构' AND url='index/main';
UPDATE `#@__sys_menu` SET url='database manage' WHERE NAME='数据库管理' AND url='Database/show';
UPDATE `#@__sys_menu` SET url='system oa' WHERE NAME='我的办公' AND url='oa/index';
UPDATE `#@__sys_menu` SET name='无效客户' WHERE NAME='垃圾客户' AND url='CstCustomer/show_rubbish';
UPDATE `#@__sys_menu` SET pid='0',sort='99' WHERE NAME='组织结构' AND url='organization';
UPDATE `#@__sys_menu` SET visible='0' WHERE NAME='企业会员' AND url='SysOrg/show';
DELETE FROM `#@__sys_menu` WHERE url='addon/addon_list';
DELETE FROM `#@__sys_menu` WHERE url='addon/hook_list';
-- ----------------------------end tiem by 2021-10-30 ------------------------------

