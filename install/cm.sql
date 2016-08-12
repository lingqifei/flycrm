

DROP TABLE IF EXISTS `cst_chance`;
CREATE TABLE IF NOT EXISTS `cst_chance` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `cusID` int(16) NOT NULL,
  `linkmanID` varchar(256) NOT NULL,
  `finddt` datetime NOT NULL COMMENT '发现时间',
  `billdt` datetime NOT NULL COMMENT '预计签单时间',
  `salestage` int(4) NOT NULL,
  `money` int(11) NOT NULL,
  `chance` int(2) NOT NULL COMMENT '预计可能性',
  `userID` int(16) NOT NULL,
  `title` varchar(256) NOT NULL,
  `intro` varchar(256) NOT NULL,
  `status` smallint(1) NOT NULL default '1',
  `create_userID` int(16) NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.cst_customer 结构
DROP TABLE IF EXISTS `cst_customer`;
CREATE TABLE IF NOT EXISTS `cst_customer` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `cst_number` varchar(64) NOT NULL,
  `region` int(16) NOT NULL,
  `source` int(16) NOT NULL,
  `ecotype` int(16) NOT NULL,
  `level` int(16) NOT NULL,
  `trade` int(16) NOT NULL,
  `satisfy` smallint(6) NOT NULL default '3' COMMENT '满意度（1-5），默认为3',
  `credit` smallint(2) NOT NULL default '3' COMMENT '信用度（1-5），默认为3',
  `address` varchar(256) NOT NULL,
  `website` varchar(256) NOT NULL,
  `zipcode` varchar(64) NOT NULL,
  `tel` varchar(256) NOT NULL,
  `fax` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `create_userID` int(16) NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.cst_dict 结构
DROP TABLE IF EXISTS `cst_dict`;
CREATE TABLE IF NOT EXISTS `cst_dict` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `type` varchar(256) NOT NULL,
  `sort` smallint(8) NOT NULL,
  `visible` smallint(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.cst_dict_type 结构
DROP TABLE IF EXISTS `cst_dict_type`;
CREATE TABLE IF NOT EXISTS `cst_dict_type` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `name` varchar(256) character set utf8 default NULL COMMENT '字典名称',
  `value` varchar(32) character set utf8 default NULL COMMENT '字典标签',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.cst_filing 结构
DROP TABLE IF EXISTS `cst_filing`;
CREATE TABLE IF NOT EXISTS `cst_filing` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `cusID` int(16) NOT NULL,
  `linkmanID` int(16) NOT NULL,
  `chanceID` int(16) NOT NULL,
  `userID` int(16) NOT NULL,
  `applicant_userID` int(16) NOT NULL,
  `audit_userID` int(16) NOT NULL,
  `audit_dt` datetime default NULL,
  `title` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `support` text NOT NULL COMMENT '所需支持',
  `status` smallint(1) NOT NULL default '1' COMMENT '1=未审核2=同意3=否决',
  `create_userID` int(16) NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.cst_linkman 结构
DROP TABLE IF EXISTS `cst_linkman`;
CREATE TABLE IF NOT EXISTS `cst_linkman` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `cusID` int(16) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` smallint(1) NOT NULL,
  `postion` varchar(256) NOT NULL,
  `tel` varchar(256) NOT NULL,
  `mobile` varchar(256) NOT NULL,
  `qicq` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `zipcode` varchar(256) NOT NULL,
  `address` varchar(1024) NOT NULL,
  `intro` text NOT NULL,
  `create_userID` int(16) NOT NULL default '0',
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.cst_quoted 结构
DROP TABLE IF EXISTS `cst_quoted`;
CREATE TABLE IF NOT EXISTS `cst_quoted` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `cusID` int(16) NOT NULL,
  `linkmanID` int(16) NOT NULL,
  `chanceID` int(16) NOT NULL,
  `userID` int(16) NOT NULL,
  `quoted_userID` int(16) NOT NULL,
  `audit_userID` int(16) NOT NULL,
  `title` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `delivery_intro` text NOT NULL,
  `payment_intro` text NOT NULL,
  `audit_dt` datetime default NULL,
  `transport_intro` text NOT NULL,
  `status` smallint(1) NOT NULL default '1' COMMENT '1=未审核2=同意3=否决',
  `create_userID` int(16) NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.cst_quoted_detail 结构
DROP TABLE IF EXISTS `cst_quoted_detail`;
CREATE TABLE IF NOT EXISTS `cst_quoted_detail` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `quotedID` int(16) NOT NULL,
  `pro_number` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `model` varchar(64) NOT NULL,
  `norm` varchar(64) NOT NULL,
  `price` int(16) NOT NULL,
  `rebate` int(16) NOT NULL,
  `number` int(16) NOT NULL,
  `money` int(16) NOT NULL,
  `intro` text NOT NULL,
  `userID` int(16) NOT NULL COMMENT '归属人员',
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.cst_service 结构
DROP TABLE IF EXISTS `cst_service`;
CREATE TABLE IF NOT EXISTS `cst_service` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `cusID` int(16) NOT NULL,
  `linkmanID` int(16) NOT NULL,
  `services` int(4) NOT NULL,
  `servicesmodel` int(4) NOT NULL,
  `price` int(11) NOT NULL,
  `status` smallint(1) NOT NULL COMMENT '1=无需处理，2未处理，3=处理中，4处理完成',
  `bdt` datetime NOT NULL,
  `tlen` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `intro` text NOT NULL,
  `create_userID` int(16) NOT NULL default '0',
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.cst_trace 结构
DROP TABLE IF EXISTS `cst_trace`;
CREATE TABLE IF NOT EXISTS `cst_trace` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `cusID` int(16) NOT NULL,
  `linkmanID` int(11) NOT NULL,
  `chanceID` int(11) NOT NULL,
  `bdt` datetime NOT NULL,
  `salestage` int(4) NOT NULL,
  `salemode` int(4) NOT NULL,
  `title` varchar(256) NOT NULL,
  `intro` varchar(256) NOT NULL,
  `status` smallint(1) NOT NULL default '1',
  `create_userID` int(16) NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.email_from 结构
DROP TABLE IF EXISTS `email_from`;
CREATE TABLE IF NOT EXISTS `email_from` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `server` varchar(32) character set utf8 NOT NULL,
  `port` varchar(50) NOT NULL,
  `account` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `visible` tinyint(2) NOT NULL default '1',
  `cnt` int(11) NOT NULL default '1',
  `groupID` int(11) NOT NULL default '1',
  `intro` varchar(1024) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.email_from_group 结构
DROP TABLE IF EXISTS `email_from_group`;
CREATE TABLE IF NOT EXISTS `email_from_group` (
  `id` int(16) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.email_mb 结构
DROP TABLE IF EXISTS `email_mb`;
CREATE TABLE IF NOT EXISTS `email_mb` (
  `id` int(16) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `content` text,
  `cnt` int(11) default '1',
  `editor` varchar(32) default NULL,
  `adddatetime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.email_receiver 结构
DROP TABLE IF EXISTS `email_receiver`;
CREATE TABLE IF NOT EXISTS `email_receiver` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `account` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `visible` tinyint(2) NOT NULL default '1',
  `cnt` int(11) NOT NULL default '1',
  `groupID` int(11) NOT NULL default '1',
  `intro` varchar(1024) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.email_receiver_group 结构
DROP TABLE IF EXISTS `email_receiver_group`;
CREATE TABLE IF NOT EXISTS `email_receiver_group` (
  `id` int(16) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.email_scheme 结构
DROP TABLE IF EXISTS `email_scheme`;
CREATE TABLE IF NOT EXISTS `email_scheme` (
  `id` int(16) NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `fromID` int(11) default NULL,
  `receiverID` int(11) default NULL,
  `contentID` varchar(50) default NULL,
  `intro` varchar(1024) default NULL,
  `adddatetime` datetime NOT NULL,
  `uptime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.email_scheme_log 结构
DROP TABLE IF EXISTS `email_scheme_log`;
CREATE TABLE IF NOT EXISTS `email_scheme_log` (
  `id` int(16) NOT NULL auto_increment,
  `schemeID` varchar(256) NOT NULL,
  `sendfrom` varchar(256) default NULL,
  `receiver` varchar(256) default NULL,
  `subject` varchar(256) default NULL,
  `status` varchar(50) default NULL,
  `adddatetime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_bank_account 结构
DROP TABLE IF EXISTS `fin_bank_account`;
CREATE TABLE IF NOT EXISTS `fin_bank_account` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `card` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `holders` varchar(256) NOT NULL,
  `sort` smallint(2) NOT NULL,
  `visible` smallint(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_expenses_record 结构
DROP TABLE IF EXISTS `fin_expenses_record`;
CREATE TABLE IF NOT EXISTS `fin_expenses_record` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `typeID` int(16) NOT NULL COMMENT '费用类别',
  `create_userID` int(16) NOT NULL,
  `blankID` int(16) NOT NULL,
  `money` int(16) NOT NULL,
  `intro` text NOT NULL,
  `adt` datetime NOT NULL,
  `crt_date` date NOT NULL COMMENT '产生日期',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_expenses_type 结构
DROP TABLE IF EXISTS `fin_expenses_type`;
CREATE TABLE IF NOT EXISTS `fin_expenses_type` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(32) character set utf8 NOT NULL,
  `parentID` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visible` tinyint(2) NOT NULL default '1',
  `intro` varchar(1024) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_flow_record 结构
DROP TABLE IF EXISTS `fin_flow_record`;
CREATE TABLE IF NOT EXISTS `fin_flow_record` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `balance` int(16) NOT NULL COMMENT '费用类别',
  `paymoney` int(16) NOT NULL,
  `recemoney` int(16) NOT NULL,
  `blankID` int(16) NOT NULL,
  `intro` text NOT NULL,
  `adt` datetime NOT NULL,
  `create_userID` int(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_income_record 结构
DROP TABLE IF EXISTS `fin_income_record`;
CREATE TABLE IF NOT EXISTS `fin_income_record` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `typeID` int(16) NOT NULL COMMENT '费用类别',
  `create_userID` int(16) NOT NULL,
  `blankID` int(16) NOT NULL,
  `money` int(16) NOT NULL,
  `intro` text NOT NULL,
  `adt` datetime NOT NULL,
  `crt_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_income_type 结构
DROP TABLE IF EXISTS `fin_income_type`;
CREATE TABLE IF NOT EXISTS `fin_income_type` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(32) character set utf8 NOT NULL,
  `parentID` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visible` tinyint(2) NOT NULL default '1',
  `intro` varchar(1024) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_invoice_pay 结构
DROP TABLE IF EXISTS `fin_invoice_pay`;
CREATE TABLE IF NOT EXISTS `fin_invoice_pay` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `salID` int(16) NOT NULL COMMENT '合同订单号',
  `cusID` int(16) NOT NULL COMMENT '客户号',
  `money` int(16) NOT NULL,
  `paydate` datetime NOT NULL COMMENT '开票时间',
  `stages` int(11) NOT NULL,
  `invo_number` varchar(256) NOT NULL default '0',
  `name` varchar(256) NOT NULL default '0',
  `intro` text NOT NULL,
  `adt` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_invoice_rece 结构
DROP TABLE IF EXISTS `fin_invoice_rece`;
CREATE TABLE IF NOT EXISTS `fin_invoice_rece` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `posID` int(16) NOT NULL COMMENT '合同订单号',
  `supID` int(16) NOT NULL COMMENT '客户号',
  `money` int(16) NOT NULL,
  `recedate` date NOT NULL COMMENT '收票时间',
  `stages` int(11) NOT NULL,
  `create_userID` int(11) NOT NULL,
  `invo_number` varchar(256) NOT NULL default '0',
  `name` varchar(256) NOT NULL default '0',
  `intro` text NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_pay_plan 结构
DROP TABLE IF EXISTS `fin_pay_plan`;
CREATE TABLE IF NOT EXISTS `fin_pay_plan` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `posID` int(16) NOT NULL COMMENT '采购订单号',
  `supID` int(16) NOT NULL COMMENT '供应商号',
  `blankID` int(16) NOT NULL COMMENT '关联帐号',
  `money` int(16) NOT NULL,
  `plandate` date NOT NULL COMMENT '计划付款时间',
  `stages` int(11) NOT NULL,
  `ifpay` varchar(50) NOT NULL default 'NO' COMMENT 'NO/YES',
  `intro` text NOT NULL,
  `create_userID` int(16) NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_pay_record 结构
DROP TABLE IF EXISTS `fin_pay_record`;
CREATE TABLE IF NOT EXISTS `fin_pay_record` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `planID` int(16) unsigned NOT NULL default '0' COMMENT '关联付款记划',
  `posID` int(16) NOT NULL COMMENT '采购订单号',
  `supID` int(16) NOT NULL COMMENT '供应商号',
  `blankID` int(16) NOT NULL COMMENT '关联帐号',
  `paydate` date NOT NULL,
  `money` int(16) NOT NULL,
  `stages` int(11) NOT NULL,
  `ifpay` smallint(6) NOT NULL default '0' COMMENT '0=未付 1=已经付',
  `intro` text NOT NULL,
  `adt` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_rece_plan 结构
DROP TABLE IF EXISTS `fin_rece_plan`;
CREATE TABLE IF NOT EXISTS `fin_rece_plan` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `receID` int(16) unsigned NOT NULL default '0' COMMENT '关联回款计划',
  `salID` int(16) NOT NULL COMMENT '合同订单号',
  `cusID` int(16) NOT NULL COMMENT '客户号',
  `blankID` int(16) NOT NULL COMMENT '关联帐号',
  `money` int(16) NOT NULL,
  `plandate` datetime NOT NULL COMMENT '计划回款时间',
  `stages` int(11) NOT NULL,
  `create_userID` int(11) NOT NULL,
  `ifpay` varchar(50) NOT NULL default 'NO' COMMENT 'NO=未付 YES=已经付',
  `intro` text NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fin_rece_record 结构
DROP TABLE IF EXISTS `fin_rece_record`;
CREATE TABLE IF NOT EXISTS `fin_rece_record` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `salID` int(16) NOT NULL COMMENT '合同订单号',
  `planID` int(16) NOT NULL default '0',
  `cusID` int(16) NOT NULL COMMENT '客户号',
  `blankID` int(16) NOT NULL COMMENT '关联帐号',
  `money` int(16) NOT NULL,
  `paydate` datetime NOT NULL COMMENT '计划回款时间',
  `stages` int(11) NOT NULL,
  `ifpay` smallint(6) NOT NULL default '0' COMMENT '0=未付 1=已经付',
  `intro` text NOT NULL,
  `adt` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fly_sys_config 结构
DROP TABLE IF EXISTS `fly_sys_config`;
CREATE TABLE IF NOT EXISTS `fly_sys_config` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(128) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fly_sys_dept 结构
DROP TABLE IF EXISTS `fly_sys_dept`;
CREATE TABLE IF NOT EXISTS `fly_sys_dept` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(32) character set utf8 NOT NULL,
  `parentID` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visible` tinyint(2) NOT NULL default '1',
  `tel` varchar(32) character set utf8 default NULL,
  `fax` varchar(32) character set utf8 NOT NULL,
  `intro` varchar(1024) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fly_sys_log 结构
DROP TABLE IF EXISTS `fly_sys_log`;
CREATE TABLE IF NOT EXISTS `fly_sys_log` (
  `id` int(16) NOT NULL auto_increment,
  `ipaddr` varchar(16) NOT NULL,
  `content` text,
  `editor` varchar(32) default NULL,
  `adddatetime` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fly_sys_menu 结构
DROP TABLE IF EXISTS `fly_sys_menu`;
CREATE TABLE IF NOT EXISTS `fly_sys_menu` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `name_en` varchar(64) NOT NULL,
  `url` varchar(128) NOT NULL,
  `parentID` int(4) NOT NULL,
  `sort` int(4) NOT NULL,
  `visible` int(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fly_sys_method 结构
DROP TABLE IF EXISTS `fly_sys_method`;
CREATE TABLE IF NOT EXISTS `fly_sys_method` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `menuID` int(4) NOT NULL,
  `name` varchar(64) NOT NULL,
  `value` varchar(64) NOT NULL,
  `sort` int(4) NOT NULL,
  `visible` int(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fly_sys_position 结构
DROP TABLE IF EXISTS `fly_sys_position`;
CREATE TABLE IF NOT EXISTS `fly_sys_position` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(32) character set utf8 NOT NULL,
  `parentID` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visible` tinyint(2) NOT NULL default '1',
  `intro` varchar(1024) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fly_sys_power 结构
DROP TABLE IF EXISTS `fly_sys_power`;
CREATE TABLE IF NOT EXISTS `fly_sys_power` (
  `id` int(16) NOT NULL auto_increment,
  `master` varchar(64) NOT NULL,
  `master_value` varchar(64) NOT NULL,
  `access` varchar(64) NOT NULL,
  `access_value` text NOT NULL,
  `operation` varchar(64) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fly_sys_region 结构
DROP TABLE IF EXISTS `fly_sys_region`;
CREATE TABLE IF NOT EXISTS `fly_sys_region` (
  `id` int(4) NOT NULL auto_increment,
  `parentID` int(4) NOT NULL,
  `name` varchar(12) NOT NULL,
  `type` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='地区表';

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fly_sys_role 结构
DROP TABLE IF EXISTS `fly_sys_role`;
CREATE TABLE IF NOT EXISTS `fly_sys_role` (
  `id` int(16) NOT NULL auto_increment,
  `sort` int(16) NOT NULL default '0',
  `name` varchar(32) default NULL,
  `intro` varchar(1024) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.fly_sys_user 结构
DROP TABLE IF EXISTS `fly_sys_user`;
CREATE TABLE IF NOT EXISTS `fly_sys_user` (
  `id` int(16) NOT NULL auto_increment,
  `account` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(32) default NULL,
  `gender` varchar(2) default NULL,
  `tel` varchar(32) default NULL,
  `mobile` varchar(32) default NULL,
  `qicq` varchar(32) default NULL,
  `address` varchar(256) default NULL,
  `zipcode` varchar(256) default NULL,
  `email` varchar(128) default NULL,
  `roleID` int(16) NOT NULL,
  `deptID` int(16) NOT NULL,
  `positionID` int(16) NOT NULL,
  `intro` varchar(1024) NOT NULL,
  `adt` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.pos_order 结构
DROP TABLE IF EXISTS `pos_order`;
CREATE TABLE IF NOT EXISTS `pos_order` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `pos_number` varchar(50) NOT NULL COMMENT '采购编号',
  `supID` int(16) NOT NULL,
  `linkmanID` int(16) NOT NULL,
  `chanceID` int(16) NOT NULL,
  `bdt` date NOT NULL,
  `edt` date NOT NULL,
  `our_userID` int(16) NOT NULL COMMENT '我方联系人',
  `money` int(16) NOT NULL,
  `zero_money` int(16) NOT NULL COMMENT '去零金额',
  `back_money` int(16) NOT NULL,
  `pay_money` int(16) NOT NULL,
  `into_money` int(16) NOT NULL,
  `bill_money` int(16) NOT NULL,
  `title` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `status` smallint(1) NOT NULL default '1' COMMENT '1=未审核2=同意3=否决',
  `pay_status` smallint(1) NOT NULL default '1',
  `into_status` smallint(1) NOT NULL default '1',
  `bill_status` smallint(1) NOT NULL default '1',
  `create_userID` int(11) NOT NULL COMMENT '创建用户',
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.pos_order_detail 结构
DROP TABLE IF EXISTS `pos_order_detail`;
CREATE TABLE IF NOT EXISTS `pos_order_detail` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `posID` int(16) unsigned NOT NULL default '0',
  `pro_number` varchar(64) NOT NULL,
  `pos_number` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `model` varchar(64) NOT NULL,
  `norm` varchar(64) NOT NULL,
  `price` int(16) NOT NULL,
  `rebate` int(16) NOT NULL,
  `number` int(16) NOT NULL,
  `money` int(16) NOT NULL,
  `intro` text NOT NULL,
  `create_userID` int(16) NOT NULL COMMENT '归属人员',
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.pro_dict 结构
DROP TABLE IF EXISTS `pro_dict`;
CREATE TABLE IF NOT EXISTS `pro_dict` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `type` varchar(256) NOT NULL,
  `sort` smallint(8) NOT NULL,
  `visible` smallint(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.pro_dict_type 结构
DROP TABLE IF EXISTS `pro_dict_type`;
CREATE TABLE IF NOT EXISTS `pro_dict_type` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `name` varchar(256) character set utf8 default NULL COMMENT '字典名称',
  `value` varchar(32) character set utf8 default NULL COMMENT '字典标签',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.pro_product 结构
DROP TABLE IF EXISTS `pro_product`;
CREATE TABLE IF NOT EXISTS `pro_product` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(256) NOT NULL,
  `pro_number` varchar(256) NOT NULL,
  `typeID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `model` varchar(256) NOT NULL,
  `norm` varchar(256) NOT NULL,
  `supID` int(16) NOT NULL,
  `image` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `sort` int(11) NOT NULL,
  `visible` tinyint(2) NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产中列表\r\n';

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.pro_type 结构
DROP TABLE IF EXISTS `pro_type`;
CREATE TABLE IF NOT EXISTS `pro_type` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(32) character set utf8 NOT NULL,
  `parentID` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visible` tinyint(2) NOT NULL default '1',
  `intro` varchar(1024) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.sal_contract 结构
DROP TABLE IF EXISTS `sal_contract`;
CREATE TABLE IF NOT EXISTS `sal_contract` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `con_number` varchar(50) NOT NULL COMMENT '合同编号',
  `cusID` int(16) NOT NULL,
  `linkmanID` int(16) NOT NULL,
  `chanceID` int(16) NOT NULL,
  `bdt` date NOT NULL,
  `edt` date NOT NULL,
  `our_userID` int(16) NOT NULL COMMENT '我方联系人',
  `money` int(16) NOT NULL,
  `zero_money` int(16) NOT NULL COMMENT '去零金额',
  `back_money` int(16) NOT NULL,
  `pay_money` int(16) NOT NULL,
  `bill_money` int(16) NOT NULL,
  `title` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `status` smallint(1) NOT NULL default '1' COMMENT '1=未审核2=同意3=否决',
  `pay_status` smallint(1) NOT NULL default '1',
  `deliver_status` smallint(1) NOT NULL default '1',
  `bill_status` smallint(1) NOT NULL default '1',
  `create_userID` int(16) NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.sal_order 结构
DROP TABLE IF EXISTS `sal_order`;
CREATE TABLE IF NOT EXISTS `sal_order` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `ord_number` varchar(50) NOT NULL COMMENT '合同编号',
  `cusID` int(16) NOT NULL,
  `linkmanID` int(16) NOT NULL,
  `chanceID` int(16) NOT NULL,
  `bdt` datetime NOT NULL,
  `edt` datetime NOT NULL,
  `our_userID` int(16) NOT NULL COMMENT '我方联系人',
  `money` int(16) NOT NULL,
  `zero_money` int(16) NOT NULL COMMENT '去零金额',
  `back_money` int(16) NOT NULL,
  `pay_money` int(16) NOT NULL,
  `bill_money` int(16) NOT NULL,
  `title` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `status` smallint(1) NOT NULL default '1' COMMENT '1=未审核2=同意3=否决',
  `pay_status` smallint(1) NOT NULL default '1',
  `deliver_status` smallint(1) NOT NULL default '1',
  `bill_status` smallint(1) NOT NULL default '1',
  `create_userID` int(11) NOT NULL COMMENT '创建用户',
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.sal_order_detail 结构
DROP TABLE IF EXISTS `sal_order_detail`;
CREATE TABLE IF NOT EXISTS `sal_order_detail` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `orderID` int(16) unsigned NOT NULL default '0',
  `pro_number` varchar(64) NOT NULL,
  `ord_number` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `model` varchar(64) NOT NULL,
  `norm` varchar(64) NOT NULL,
  `price` int(16) NOT NULL,
  `rebate` int(16) NOT NULL,
  `number` int(16) NOT NULL,
  `money` int(16) NOT NULL,
  `intro` text NOT NULL,
  `create_userID` int(16) NOT NULL COMMENT '归属人员',
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.sup_linkman 结构
DROP TABLE IF EXISTS `sup_linkman`;
CREATE TABLE IF NOT EXISTS `sup_linkman` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `supID` int(16) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` smallint(1) NOT NULL,
  `postion` varchar(256) NOT NULL,
  `tel` varchar(256) NOT NULL,
  `mobile` varchar(256) NOT NULL,
  `qicq` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `zipcode` varchar(256) NOT NULL,
  `address` varchar(1024) NOT NULL,
  `intro` text NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 lqf_crm.sup_supplier 结构
DROP TABLE IF EXISTS `sup_supplier`;
CREATE TABLE IF NOT EXISTS `sup_supplier` (
  `id` int(16) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `region` int(16) NOT NULL,
  `userID` int(16) NOT NULL,
  `level` int(16) NOT NULL,
  `ecotype` int(16) NOT NULL,
  `trade` int(16) NOT NULL,
  `satisfy` smallint(6) NOT NULL default '3' COMMENT '满意度（1-5），默认为3',
  `credit` smallint(2) NOT NULL default '3' COMMENT '信用度（1-5），默认为3',
  `address` varchar(256) NOT NULL,
  `linkman` varchar(256) NOT NULL,
  `website` varchar(256) NOT NULL,
  `zipcode` varchar(64) NOT NULL,
  `tel` varchar(256) NOT NULL,
  `fax` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

