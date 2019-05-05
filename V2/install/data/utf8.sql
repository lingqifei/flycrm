DROP TABLE IF EXISTS `cst_chance`;

CREATE TABLE `cst_chance` (
  `chance_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(16) NOT NULL,
  `linkman_id` varchar(256) NOT NULL,
  `find_date` date NOT NULL COMMENT '发现时间',
  `bill_date` date NOT NULL COMMENT '预计签单时间',
  `salestage` int(4) NOT NULL COMMENT '谈判状态',
  `money` int(11) NOT NULL COMMENT '预计金额',
  `success_rate` int(2) NOT NULL COMMENT '预计可能性成功率',
  `userID` int(16) NOT NULL,
  `name` varchar(256) NOT NULL COMMENT '主题',
  `intro` varchar(256) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `create_user_id` int(16) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`chance_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='销售机会';

DROP TABLE IF EXISTS `cst_customer`;

CREATE TABLE `cst_customer` (
  `customer_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT '客户名称',
  `customer_no` varchar(64) NOT NULL COMMENT '客户编号',
  `area_id` int(16) NOT NULL COMMENT '所在地区',
  `source` int(16) NOT NULL COMMENT '客户来源',
  `ecotype` int(16) NOT NULL COMMENT '经济类型',
  `level` int(16) NOT NULL COMMENT '客户等级',
  `trade` int(16) NOT NULL COMMENT '客户行业',
  `satisfy` smallint(6) NOT NULL DEFAULT '3' COMMENT '满意度（1-5），默认为3',
  `credit` smallint(2) NOT NULL DEFAULT '3' COMMENT '信用度（1-5），默认为3',
  `address` varchar(256) NOT NULL COMMENT '联系地址',
  `website` varchar(256) NOT NULL COMMENT '网址',
  `zipcode` varchar(64) NOT NULL COMMENT '邮编',
  `linkman` varchar(64) NOT NULL COMMENT '联系人',
  `mobile` varchar(64) NOT NULL COMMENT '手机',
  `tel` varchar(256) NOT NULL COMMENT '座机',
  `fax` varchar(256) NOT NULL COMMENT '传真',
  `email` varchar(256) NOT NULL COMMENT '邮箱',
  `main_product` varchar(1024) NOT NULL COMMENT '主营产品',
  `talk` varchar(1024) NOT NULL COMMENT '沟通情况',
  `status` varchar(256) NOT NULL,
  `intro` text NOT NULL COMMENT '介绍',
  `create_user_id` int(16) NOT NULL COMMENT '创建人员',
  `owner_user_id` int(16) NOT NULL COMMENT '归属人员',
  `create_time` datetime NOT NULL,
  `next_time` datetime NOT NULL COMMENT '下次沟通时间',
  `conn_time` datetime NOT NULL COMMENT '最近联系时间',
  `conn_body` varchar(1024) NOT NULL COMMENT '最近沟通内容',
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客户信息表';

DROP TABLE IF EXISTS `cst_dict`;

CREATE TABLE `cst_dict` (
  `dict_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL COMMENT '名字',
  `typetag` varchar(256) NOT NULL COMMENT '分类标识',
  `sort` smallint(8) NOT NULL,
  `visible` smallint(2) NOT NULL,
  PRIMARY KEY (`dict_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='字典表';

DROP TABLE IF EXISTS `cst_dict_type`;

CREATE TABLE `cst_dict_type` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `typename` varchar(256) NOT NULL COMMENT '分类名称',
  `typedir` varchar(256) NOT NULL COMMENT '分类目录',
  `typetag` text NOT NULL COMMENT '分类标识',
  `sort` int(11) NOT NULL COMMENT '排序',
  `visible` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `intro` varchar(1024) DEFAULT NULL,
  `seotitle` varchar(256) NOT NULL,
  `keywords` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='字典分类';

DROP TABLE IF EXISTS `cst_field_ext`;

CREATE TABLE `cst_field_ext` (
  `field_ext_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `main_table` varchar(50) NOT NULL COMMENT '关联主表',
  `ext_table` varchar(50) NOT NULL COMMENT '扩展表名',
  `show_name` varchar(256) NOT NULL COMMENT '表单名称',
  `field_name` varchar(256) NOT NULL COMMENT '字段名称',
  `field_type` varchar(50) NOT NULL COMMENT '单文本=varchar,文本=text,多行文本=textarea,整数=int,小数=float,图片=img,下拉=option,单选=radio,复选=checkbox',
  `default` varchar(256) NOT NULL COMMENT '字段默认值',
  `maxlength` varchar(256) NOT NULL COMMENT '最大值',
  `desc` varchar(256) NOT NULL COMMENT '表单说明',
  `visible` smallint(1) NOT NULL DEFAULT '1' COMMENT '是否使用',
  `create_user_id` int(16) NOT NULL DEFAULT '0',
  `sort` int(16) NOT NULL DEFAULT '0' COMMENT '显示排序',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`field_ext_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客户字段扩展表';

DROP TABLE IF EXISTS `cst_filing`;

CREATE TABLE `cst_filing` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `cusID` int(16) NOT NULL,
  `linkmanID` int(16) NOT NULL,
  `chanceID` int(16) NOT NULL,
  `userID` int(16) NOT NULL,
  `applicant_userID` int(16) NOT NULL,
  `audit_userID` int(16) NOT NULL,
  `audit_dt` datetime DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `support` text NOT NULL COMMENT '所需支持',
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1=未审核2=同意3=否决',
  `create_userID` int(16) NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='项目报备';

DROP TABLE IF EXISTS `cst_linkman`;

CREATE TABLE `cst_linkman` (
  `linkman_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(16) NOT NULL,
  `name` varchar(256) NOT NULL,
  `gender` smallint(1) NOT NULL COMMENT '姓别',
  `postion` varchar(256) NOT NULL COMMENT '职位、',
  `tel` varchar(256) NOT NULL,
  `mobile` varchar(256) NOT NULL,
  `qicq` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `zipcode` varchar(256) NOT NULL,
  `address` varchar(1024) NOT NULL,
  `intro` text NOT NULL,
  `create_user_id` int(16) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`linkman_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客户联系人';

DROP TABLE IF EXISTS `cst_quoted`;

CREATE TABLE `cst_quoted` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
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
  `audit_dt` datetime DEFAULT NULL,
  `transport_intro` text NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1=未审核2=同意3=否决',
  `create_userID` int(16) NOT NULL,
  `adt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='报价表';

DROP TABLE IF EXISTS `cst_quoted_detail`;

CREATE TABLE `cst_quoted_detail` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='报价明细';

DROP TABLE IF EXISTS `cst_service`;

CREATE TABLE `cst_service` (
  `service_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(16) NOT NULL,
  `linkman_id` int(16) NOT NULL,
  `services` int(4) NOT NULL,
  `servicesmodel` int(4) NOT NULL,
  `price` int(11) NOT NULL,
  `status` smallint(1) NOT NULL COMMENT '1=无需处理，2未处理，3=处理中，4处理完成',
  `service_time` datetime NOT NULL,
  `tlen` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `intro` text NOT NULL,
  `create_user_id` int(16) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='服务记录';

DROP TABLE IF EXISTS `cst_talk`;

CREATE TABLE `cst_talk` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `cusID` int(16) NOT NULL,
  `name` varchar(1024) NOT NULL,
  `create_userID` int(16) NOT NULL DEFAULT '0',
  `adt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='打电话沟通记录';

DROP TABLE IF EXISTS `cst_trace`;

CREATE TABLE `cst_trace` (
  `trace_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(16) NOT NULL,
  `linkman_id` int(11) NOT NULL,
  `chance_id` int(11) NOT NULL,
  `conn_time` datetime NOT NULL,
  `salestage` int(4) NOT NULL COMMENT '沟通阶段',
  `salemode` int(4) NOT NULL COMMENT '销售方式',
  `name` varchar(256) NOT NULL COMMENT '主题名称',
  `intro` text NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `next_time` datetime NOT NULL COMMENT '下次联系时间',
  `nexttitle` varchar(256) NOT NULL COMMENT '下次沟通主题',
  `create_user_id` int(16) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`trace_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='跟踪记录';

DROP TABLE IF EXISTS `cst_website`;

CREATE TABLE `cst_website` (
  `website_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(16) NOT NULL,
  `name` varchar(256) NOT NULL,
  `url` varchar(1024) NOT NULL COMMENT '网址',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `ftp` varchar(256) NOT NULL,
  `ftp_ip` varchar(256) NOT NULL COMMENT 'FTP ip',
  `ftp_account` varchar(256) NOT NULL COMMENT 'FTP 帐号',
  `ftp_pwd` varchar(256) NOT NULL COMMENT 'FTP 密码',
  `icp` varchar(256) NOT NULL,
  `icp_account` varchar(256) NOT NULL,
  `icp_pwd` varchar(256) NOT NULL,
  `icp_num` varchar(256) NOT NULL,
  `address` varchar(1024) NOT NULL,
  `intro` text NOT NULL,
  `create_user_id` int(16) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '网站状态1=新增，2=续费，3=流失',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`website_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站业务';

DROP TABLE IF EXISTS `email_from`;

CREATE TABLE `email_from` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `server` varchar(32) CHARACTER SET utf8 NOT NULL,
  `port` varchar(50) NOT NULL,
  `account` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `visible` tinyint(2) NOT NULL DEFAULT '1',
  `cnt` int(11) NOT NULL DEFAULT '1',
  `groupID` int(11) NOT NULL DEFAULT '1',
  `intro` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COMMENT='发送邮件列表';

DROP TABLE IF EXISTS `email_from_group`;

CREATE TABLE `email_from_group` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='发送邮件分组';

DROP TABLE IF EXISTS `email_mb`;

CREATE TABLE `email_mb` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `content` text,
  `cnt` int(11) DEFAULT '1',
  `editor` varchar(32) DEFAULT NULL,
  `adddatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邮箱模板';

DROP TABLE IF EXISTS `email_receiver`;

CREATE TABLE `email_receiver` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `visible` tinyint(2) NOT NULL DEFAULT '1',
  `cnt` int(11) NOT NULL DEFAULT '1',
  `groupID` int(11) NOT NULL DEFAULT '1',
  `intro` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COMMENT='邮件接收人';

DROP TABLE IF EXISTS `email_receiver_group`;

CREATE TABLE `email_receiver_group` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邮件接收人员分组';

DROP TABLE IF EXISTS `email_scheme`;

CREATE TABLE `email_scheme` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `fromID` int(11) DEFAULT NULL,
  `receiverID` int(11) DEFAULT NULL,
  `contentID` varchar(50) DEFAULT NULL,
  `intro` varchar(1024) DEFAULT NULL,
  `adddatetime` datetime NOT NULL,
  `uptime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='群发方案';

DROP TABLE IF EXISTS `email_scheme_log`;

CREATE TABLE `email_scheme_log` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `schemeID` varchar(256) NOT NULL,
  `sendfrom` varchar(256) DEFAULT NULL,
  `receiver` varchar(256) DEFAULT NULL,
  `subject` varchar(256) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `adddatetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邮件方案执行日志\r\n';

DROP TABLE IF EXISTS `fin_bank_account`;

CREATE TABLE `fin_bank_account` (
  `bank_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL COMMENT '开户银行名称',
  `card` varchar(256) NOT NULL COMMENT '帐号号',
  `address` varchar(256) NOT NULL COMMENT '开户地址',
  `holders` varchar(256) NOT NULL COMMENT '开户人',
  `sort` smallint(2) NOT NULL,
  `visible` smallint(2) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='银行帐户';

DROP TABLE IF EXISTS `fin_capital_record`;

CREATE TABLE `fin_capital_record` (
  `record_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(16) NOT NULL DEFAULT '1' COMMENT '费用类别，1=注入，-1=抽取',
  `create_user_id` int(16) NOT NULL,
  `bank_id` int(16) NOT NULL,
  `money` int(16) NOT NULL,
  `intro` text NOT NULL,
  `create_time` datetime NOT NULL,
  `happen_date` date NOT NULL COMMENT '产生日期',
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='资金注入抽取';

DROP TABLE IF EXISTS `fin_expenses_record`;

CREATE TABLE `fin_expenses_record` (
  `record_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(16) NOT NULL COMMENT '费用类别',
  `create_user_id` int(16) NOT NULL,
  `bank_id` int(16) NOT NULL,
  `money` int(16) NOT NULL,
  `intro` text NOT NULL,
  `create_time` datetime NOT NULL,
  `happen_date` date NOT NULL COMMENT '产生日期',
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='其它支出记录';

DROP TABLE IF EXISTS `fin_expenses_type`;

CREATE TABLE `fin_expenses_type` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `parentID` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visible` tinyint(2) NOT NULL DEFAULT '1',
  `intro` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COMMENT='其它支出类型';

DROP TABLE IF EXISTS `fin_flow_record`;

CREATE TABLE `fin_flow_record` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `balance` float NOT NULL COMMENT '余额',
  `pay_money` float NOT NULL COMMENT '支出',
  `rece_money` float NOT NULL COMMENT '收入',
  `bank_id` int(16) NOT NULL,
  `bus_id` int(16) NOT NULL COMMENT '关联单号=业务单号',
  `bus_type` varchar(128) NOT NULL COMMENT '单号类型=财务类型',
  `intro` text NOT NULL,
  `create_time` datetime NOT NULL,
  `create_user_id` int(16) NOT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='财务流水';

DROP TABLE IF EXISTS `fin_income_record`;

CREATE TABLE `fin_income_record` (
  `record_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(16) NOT NULL COMMENT '费用类别',
  `bank_id` int(16) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `intro` text NOT NULL,
  `happen_date` date NOT NULL COMMENT '产生日期',
  `create_user_id` int(16) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='其它收入记录';

DROP TABLE IF EXISTS `fin_income_type`;

CREATE TABLE `fin_income_type` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `parentID` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visible` tinyint(2) NOT NULL DEFAULT '1',
  `intro` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COMMENT='其它收入类型';

DROP TABLE IF EXISTS `fin_invoice_pay`;

CREATE TABLE `fin_invoice_pay` (
  `record_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `contract_id` int(16) NOT NULL COMMENT '合同订单号',
  `contract_name` varchar(256) NOT NULL,
  `customer_id` int(16) NOT NULL COMMENT '客户号',
  `customer_name` varchar(256) NOT NULL,
  `money` int(16) NOT NULL,
  `pay_date` date NOT NULL COMMENT '开票时间',
  `stages` int(11) NOT NULL,
  `invoice_no` varchar(256) NOT NULL DEFAULT '0',
  `name` varchar(256) NOT NULL DEFAULT '0',
  `bus_type` varchar(256) NOT NULL DEFAULT '0' COMMENT '订单类型',
  `intro` text NOT NULL,
  `create_time` datetime NOT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='开票记录、';

DROP TABLE IF EXISTS `fin_invoice_rece`;

CREATE TABLE `fin_invoice_rece` (
  `record_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `contract_id` int(16) NOT NULL COMMENT '关联采购号',
  `supplier_id` int(16) NOT NULL COMMENT '供应商号',
  `contract_name` varchar(256) NOT NULL,
  `supplier_name` varchar(256) NOT NULL,
  `money` int(16) NOT NULL,
  `rece_date` date NOT NULL COMMENT '收票时间',
  `stages` int(11) NOT NULL,
  `name` varchar(256) NOT NULL COMMENT '发票内容',
  `invoice_no` varchar(256) NOT NULL DEFAULT '0' COMMENT '发票编号',
  `intro` text NOT NULL,
  `create_time` datetime NOT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收票记录';

DROP TABLE IF EXISTS `fin_pay_plan`;

CREATE TABLE `fin_pay_plan` (
  `plan_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `contract_id` int(16) NOT NULL COMMENT '采购订单号',
  `contract_name` int(16) NOT NULL COMMENT '采购合同名称',
  `supplier_id` int(16) NOT NULL COMMENT '供应商号',
  `supplier_name` varchar(256) NOT NULL COMMENT '供应商名称',
  `bank_id` int(16) NOT NULL COMMENT '关联银行帐号',
  `money` int(16) NOT NULL COMMENT '金额',
  `plan_date` date NOT NULL COMMENT '计划付款时间',
  `stages` int(11) NOT NULL COMMENT '其次',
  `ifpay` varchar(50) NOT NULL DEFAULT '-1',
  `intro` text NOT NULL,
  `create_user_id` int(16) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='付款计划表';

DROP TABLE IF EXISTS `fin_pay_record`;

CREATE TABLE `fin_pay_record` (
  `record_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '关联付款记划',
  `contract_id` int(16) NOT NULL COMMENT '采购订单号',
  `contract_name` varchar(256) NOT NULL,
  `supplier_id` int(16) NOT NULL COMMENT '供应商号',
  `supplier_name` varchar(256) NOT NULL,
  `bank_id` int(16) NOT NULL COMMENT '关联帐号',
  `pay_date` date NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `zero_money` decimal(10,2) NOT NULL,
  `stages` int(11) NOT NULL,
  `intro` text NOT NULL,
  `create_time` datetime NOT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='付款记录';

DROP TABLE IF EXISTS `fin_rece_plan`;

CREATE TABLE `fin_rece_plan` (
  `plan_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `contract_id` int(16) NOT NULL COMMENT '合同订单号',
  `contract_name` varchar(256) NOT NULL COMMENT '合同名称',
  `customer_id` int(16) NOT NULL COMMENT '客户号',
  `customer_name` varchar(256) NOT NULL COMMENT '客户名称',
  `bank_id` int(16) NOT NULL COMMENT '关联帐号',
  `money` int(16) NOT NULL,
  `plan_date` date NOT NULL COMMENT '计划回款时间',
  `stages` int(11) NOT NULL,
  `create_user_id` int(11) NOT NULL,
  `ifpay` varchar(50) NOT NULL DEFAULT '-1' COMMENT 'NO=未付 YES=已经付',
  `intro` text NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='计划回款表';

DROP TABLE IF EXISTS `fin_rece_record`;

CREATE TABLE `fin_rece_record` (
  `record_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `contract_id` int(16) NOT NULL COMMENT '合同订单号',
  `contract_name` varchar(256) NOT NULL,
  `plan_id` int(16) NOT NULL DEFAULT '0',
  `customer_id` int(16) NOT NULL COMMENT '客户号',
  `customer_name` varchar(256) NOT NULL,
  `bank_id` int(16) NOT NULL COMMENT '关联帐号',
  `money` decimal(10,2) NOT NULL COMMENT '金额',
  `zero_money` decimal(10,2) NOT NULL COMMENT '去零金额',
  `back_date` date NOT NULL COMMENT '计划回款时间',
  `stages` int(11) NOT NULL COMMENT '期次',
  `bus_type` varchar(128) NOT NULL DEFAULT '0' COMMENT '关联业务类型',
  `intro` text NOT NULL,
  `create_time` datetime NOT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='回款记录';

DROP TABLE IF EXISTS `fly_goods`;

CREATE TABLE `fly_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id(SKU)',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `shop_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '店铺id',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类id',
  `category_id_1` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '一级分类id',
  `category_id_2` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二级分类id',
  `category_id_3` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '三级分类id',
  `brand_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '品牌id',
  `group_id_array` varchar(255) NOT NULL DEFAULT '' COMMENT '店铺分类id 首尾用,隔开',
  `promotion_type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '促销类型 0无促销，1团购，2限时折扣',
  `goods_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '实物或虚拟商品标志 1实物商品 0 虚拟商品 2 F码商品',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `sale_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售价格',
  `cost_price` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '成本价',
  `price` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '商品原价格',
  `promotion_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品促销价格',
  `give_point` int(11) NOT NULL DEFAULT '0' COMMENT '购买商品赠送积分',
  `is_member_discount` int(1) NOT NULL DEFAULT '0' COMMENT '参与会员折扣',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '运费 0为免运费',
  `shipping_fee_id` int(11) NOT NULL DEFAULT '0' COMMENT '售卖区域id 物流模板id  ns_order_shipping_fee 表id',
  `stock` int(10) NOT NULL DEFAULT '0' COMMENT '商品库存',
  `max_buy` int(11) NOT NULL DEFAULT '0' COMMENT '限购 0 不限购',
  `clicks` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品点击数量',
  `min_stock_alarm` int(11) NOT NULL DEFAULT '0' COMMENT '库存预警值',
  `sales` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '销售数量',
  `collects` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数量',
  `star` tinyint(3) unsigned NOT NULL DEFAULT '5' COMMENT '好评星级',
  `evaluates` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评价数',
  `shares` int(11) NOT NULL DEFAULT '0' COMMENT '分享数',
  `province_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '一级地区id',
  `city_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二级地区id',
  `defaultpic` varchar(255) NOT NULL DEFAULT '0' COMMENT '商品主图',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '商品关键词',
  `introduction` varchar(255) NOT NULL DEFAULT '' COMMENT '商品简介，促销语',
  `description` text NOT NULL COMMENT '商品详情',
  `content` text NOT NULL COMMENT '商品详细内容',
  `code` varchar(50) NOT NULL DEFAULT '' COMMENT '商家编号',
  `is_hot` int(1) NOT NULL DEFAULT '0' COMMENT '是否热销商品',
  `is_recommend` int(1) NOT NULL DEFAULT '0' COMMENT '是否推荐0=不推荐，1=推荐',
  `is_new` int(1) NOT NULL DEFAULT '0' COMMENT '是否新品',
  `is_bill` int(1) NOT NULL DEFAULT '0' COMMENT '是否开具增值税发票 1是，0否',
  `state` tinyint(3) NOT NULL DEFAULT '1' COMMENT '商品状态 0下架，1正常，10违规（禁售）',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `img_id_array` varchar(1000) DEFAULT NULL COMMENT '商品图片序列',
  `sku_img_array` varchar(1000) DEFAULT NULL COMMENT '商品sku应用图片列表  属性,属性值，图片ID',
  `match_point` float(10,2) DEFAULT NULL COMMENT '实物与描述相符（根据评价计算）',
  `match_ratio` float(10,2) DEFAULT NULL COMMENT '实物与描述相符（根据评价计算）百分比',
  `real_sales` int(10) NOT NULL DEFAULT '0' COMMENT '实际销量',
  `goods_attribute_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品类型',
  `goods_spec_format` text NOT NULL COMMENT '商品规格',
  `goods_weight` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '商品重量',
  `goods_volume` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '商品体积',
  `shipping_fee_type` int(11) NOT NULL DEFAULT '1' COMMENT '计价方式1.重量2.体积3.计件',
  `extend_category_id` varchar(255) DEFAULT NULL,
  `extend_category_id_1` varchar(255) DEFAULT NULL,
  `extend_category_id_2` varchar(255) DEFAULT NULL,
  `extend_category_id_3` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL DEFAULT '0' COMMENT '供货商id',
  `sale_date` datetime NOT NULL COMMENT '上下架时间',
  `create_time` datetime NOT NULL COMMENT '商品添加时间',
  `update_time` datetime NOT NULL COMMENT '商品编辑时间',
  `min_buy` int(11) NOT NULL DEFAULT '0' COMMENT '最少买几件',
  `virtual_goods_type_id` int(11) DEFAULT '0' COMMENT '虚拟商品类型id',
  `production_date` int(11) NOT NULL DEFAULT '0' COMMENT '生产日期',
  `shelf_life` varchar(50) NOT NULL DEFAULT '' COMMENT '保质期',
  `goods_video_address` varchar(455) DEFAULT '' COMMENT '商品视频地址，不为空时前台显示视频',
  `pc_custom_template` varchar(255) NOT NULL DEFAULT '' COMMENT 'pc端商品自定义模板',
  `wap_custom_template` varchar(255) NOT NULL DEFAULT '' COMMENT 'wap端商品自定义模板',
  `max_use_point` int(11) NOT NULL DEFAULT '0' COMMENT '积分抵现最大可用积分数 0为不可使用',
  `is_open_presell` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否支持预售',
  `presell_time` int(11) NOT NULL DEFAULT '0' COMMENT '预售发货时间',
  `presell_day` int(11) NOT NULL DEFAULT '0' COMMENT '预售发货天数',
  `presell_delivery_type` int(11) NOT NULL DEFAULT '1' COMMENT '预售发货方式1. 按照预售发货时间 2.按照预售发货天数',
  `presell_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '预售金额',
  `goods_unit` varchar(20) NOT NULL DEFAULT '' COMMENT '商品单位',
  PRIMARY KEY (`goods_id`),
  KEY `UK_fly_goods_brand_id` (`brand_id`),
  KEY `UK_fly_goods_category_id` (`category_id`),
  KEY `UK_fly_goods_category_id_1` (`category_id_1`),
  KEY `UK_fly_goods_category_id_2` (`category_id_2`),
  KEY `UK_fly_goods_category_id_3` (`category_id_3`),
  KEY `UK_fly_goods_extend_category_id` (`extend_category_id`),
  KEY `UK_fly_goods_extend_category_id_1` (`extend_category_id_1`),
  KEY `UK_fly_goods_extend_category_id_2` (`extend_category_id_2`),
  KEY `UK_fly_goods_extend_category_id_3` (`extend_category_id_3`),
  KEY `UK_fly_goods_goods_attribute_id` (`goods_attribute_id`),
  KEY `UK_fly_goods_group_id_array` (`group_id_array`),
  KEY `UK_fly_goods_promotion_price` (`promotion_price`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16554 COMMENT='商品表';

DROP TABLE IF EXISTS `fly_goods_attr`;

CREATE TABLE `fly_goods_attr` (
  `attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品属性ID',
  `attr_name` varchar(255) NOT NULL DEFAULT '' COMMENT '属性名称',
  `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否使用',
  `spec_id_array` varchar(255) NOT NULL DEFAULT '' COMMENT '关联规格',
  `sort` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `modify_time` int(11) DEFAULT '0' COMMENT '修改时间',
  `brand_id_array` varchar(255) NOT NULL DEFAULT '' COMMENT '关联品牌',
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 COMMENT='商品相关属性';

DROP TABLE IF EXISTS `fly_goods_attr_relation`;

CREATE TABLE `fly_goods_attr_relation` (
  `attr_relation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `attr_id` int(10) unsigned NOT NULL COMMENT '属性编号',
  `attr_name` varchar(255) NOT NULL DEFAULT '' COMMENT '属性名称',
  `attr_value_id` int(11) NOT NULL COMMENT '属性值id',
  `attr_value_name` varchar(255) NOT NULL DEFAULT '' COMMENT '属性值的名称',
  `attr_value_data` varchar(255) NOT NULL DEFAULT '' COMMENT '属性值名称对应最终数据',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`attr_relation_id`),
  KEY `UK_fly_goods_attribute_attr_value_id` (`attr_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=315 COMMENT='商品和属性关联表\r\n';

DROP TABLE IF EXISTS `fly_goods_attr_value`;

CREATE TABLE `fly_goods_attr_value` (
  `attr_value_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性值ID',
  `attr_id` int(11) NOT NULL COMMENT '属性ID',
  `attr_value_name` varchar(50) NOT NULL DEFAULT '' COMMENT '属性值名称',
  `attr_value_data` varchar(1000) NOT NULL DEFAULT '' COMMENT '属性对应相关数据',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '属性对应输入类型1.直接2.单选3.多选',
  `sort` int(11) NOT NULL DEFAULT '1999' COMMENT '排序号',
  `is_search` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否使用',
  PRIMARY KEY (`attr_value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=4096 COMMENT='商品属性值';

DROP TABLE IF EXISTS `fly_goods_brand`;

CREATE TABLE `fly_goods_brand` (
  `brand_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '索引ID',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `brand_name` varchar(100) NOT NULL COMMENT '品牌名称',
  `brand_initial` varchar(1) NOT NULL COMMENT '品牌首字母',
  `brand_pic` varchar(100) NOT NULL DEFAULT '' COMMENT '图片',
  `brand_recommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '推荐，0为否，1为是，默认为0',
  `sort` int(11) DEFAULT NULL,
  `brand_category_name` varchar(50) NOT NULL DEFAULT '' COMMENT '类别名称',
  `category_id_array` varchar(1000) NOT NULL DEFAULT '' COMMENT '所属分类id组',
  `brand_ads` varchar(255) NOT NULL DEFAULT '' COMMENT '品牌推荐广告',
  `category_name` varchar(50) NOT NULL DEFAULT '' COMMENT '品牌所属分类名称',
  `category_id_1` int(11) NOT NULL DEFAULT '0' COMMENT '一级分类ID',
  `category_id_2` int(11) NOT NULL DEFAULT '0' COMMENT '二级分类ID',
  `category_id_3` int(11) NOT NULL DEFAULT '0' COMMENT '三级分类ID',
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1024 COMMENT='品牌表';

DROP TABLE IF EXISTS `fly_goods_category`;

CREATE TABLE `fly_goods_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL DEFAULT '',
  `short_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品分类简称 ',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `visible` int(11) NOT NULL DEFAULT '1' COMMENT '是否显示  1 显示 0 不显示',
  `attr_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联商品类型ID',
  `attr_name` varchar(255) NOT NULL DEFAULT '' COMMENT '关联类型名称',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '分类关键字用于seo',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '分类描述用于seo',
  `sort` int(11) DEFAULT NULL,
  `category_pic` varchar(255) NOT NULL DEFAULT '' COMMENT '商品分类图片',
  `pc_custom_template` varchar(255) NOT NULL DEFAULT '' COMMENT 'pc端商品分类自定义模板',
  `wap_custom_template` varchar(255) NOT NULL DEFAULT '' COMMENT 'wap端商品分类自定义模板',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=244 COMMENT='商品分类表';

DROP TABLE IF EXISTS `fly_goods_img`;

CREATE TABLE `fly_goods_img` (
  `img_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `img_path` varchar(256) NOT NULL DEFAULT '' COMMENT '图片路径',
  PRIMARY KEY (`img_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=16384 COMMENT='商品图片';

DROP TABLE IF EXISTS `fly_goods_sku`;

CREATE TABLE `fly_goods_sku` (
  `sku_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表序号',
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品编号',
  `goods_name` varchar(500) NOT NULL DEFAULT '' COMMENT '商品名称',
  `sku_name` varchar(500) NOT NULL DEFAULT '' COMMENT 'SKU名称',
  `sku_value_items` varchar(255) NOT NULL DEFAULT '' COMMENT '属性和属性值 id串 attribute + attribute value 表ID分号分隔',
  `sku_value_items_format` varchar(500) NOT NULL DEFAULT '' COMMENT '属性和属性值id串组合json格式',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `sale_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售价格',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `promote_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价格',
  `cost_price` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '成本价',
  `total_cost_money` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '成本总金额',
  `total_sale_money` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '销售总金额',
  `total_profit_money` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '利润总金额',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `picture` int(11) NOT NULL DEFAULT '0' COMMENT '如果是第一个sku编码, 可以加图片',
  `code` varchar(255) NOT NULL DEFAULT '' COMMENT '商家编码',
  `QRcode` varchar(255) NOT NULL DEFAULT '' COMMENT '商品二维码',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`sku_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=481 COMMENT='商品skui规格价格库存信息表';

DROP TABLE IF EXISTS `fly_goods_spec`;

CREATE TABLE `fly_goods_spec` (
  `spec_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `shop_id` int(11) NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `spec_name` varchar(255) NOT NULL DEFAULT '' COMMENT '属性名称',
  `visible` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否可视',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `show_type` int(11) NOT NULL DEFAULT '1' COMMENT '展示方式 1 文字 2 颜色 3 图片',
  `create_time` datetime DEFAULT NULL COMMENT '创建日期',
  `is_screen` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否参与筛选 0 不参与 1 参与',
  `spec_des` varchar(255) NOT NULL DEFAULT '' COMMENT '属性说明',
  `goods_id` int(11) DEFAULT '0' COMMENT '商品关联id',
  PRIMARY KEY (`spec_id`),
  KEY `IDX_category_props_categoryId` (`shop_id`),
  KEY `IDX_category_props_orders` (`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=3276 COMMENT='商品属性（规格）表';

DROP TABLE IF EXISTS `fly_goods_spec_value`;

CREATE TABLE `fly_goods_spec_value` (
  `spec_value_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品属性值ID',
  `spec_id` int(11) NOT NULL COMMENT '商品属性ID',
  `spec_value_name` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性值名称',
  `spec_value_data` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性值数据',
  `is_visible` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否可视',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` datetime DEFAULT NULL,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  PRIMARY KEY (`spec_value_id`),
  KEY `IDX_category_propvalues_c_pId` (`spec_id`),
  KEY `IDX_category_propvalues_orders` (`sort`),
  KEY `IDX_category_propvalues_value` (`spec_value_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1092 COMMENT='商品规格值模版表';

DROP TABLE IF EXISTS `fly_sys_area`;

CREATE TABLE `fly_sys_area` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `parentID` int(4) NOT NULL,
  `sort` int(4) NOT NULL,
  `name` varchar(12) NOT NULL,
  `type` int(1) NOT NULL,
  `visible` int(1) NOT NULL,
  `intro` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='地区表';

DROP TABLE IF EXISTS `fly_sys_config`;

CREATE TABLE `fly_sys_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `varname` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(50) NOT NULL COMMENT '字段类型',
  `groupid` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统配置表';

DROP TABLE IF EXISTS `fly_sys_dept`;

CREATE TABLE `fly_sys_dept` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `parentID` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visible` tinyint(2) NOT NULL DEFAULT '1',
  `tel` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(32) CHARACTER SET utf8 NOT NULL,
  `intro` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COMMENT='部门表';

DROP TABLE IF EXISTS `fly_sys_log`;

CREATE TABLE `fly_sys_log` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `ipaddr` varchar(16) NOT NULL,
  `content` text,
  `create_user_id` varchar(32) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统日志表';

DROP TABLE IF EXISTS `fly_sys_menu`;

CREATE TABLE `fly_sys_menu` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `name_en` varchar(64) NOT NULL,
  `url` varchar(128) NOT NULL,
  `parentID` int(4) NOT NULL,
  `sort` int(4) NOT NULL,
  `visible` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统菜单栏目';

DROP TABLE IF EXISTS `fly_sys_message`;

CREATE TABLE `fly_sys_message` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `msg_type` varchar(256) NOT NULL COMMENT '消息类型',
  `msg_title` varchar(256) NOT NULL COMMENT '消息主题',
  `flag` tinyint(4) NOT NULL DEFAULT '-1' COMMENT '-1=未查看，1=查看',
  `url_type` varchar(50) NOT NULL,
  `url_id` int(11) NOT NULL DEFAULT '0',
  `owner_user_id` int(2) NOT NULL DEFAULT '0' COMMENT '所属用户编号',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `remind_time` datetime NOT NULL COMMENT '提醒时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='消息信息';

DROP TABLE IF EXISTS `fly_sys_method`;

CREATE TABLE `fly_sys_method` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `menuID` int(4) NOT NULL,
  `name` varchar(64) NOT NULL,
  `value` varchar(64) NOT NULL,
  `sort` int(4) NOT NULL,
  `visible` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统方法';

DROP TABLE IF EXISTS `fly_sys_position`;

CREATE TABLE `fly_sys_position` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `parentID` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visible` tinyint(2) NOT NULL DEFAULT '1',
  `intro` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COMMENT='职位表';

DROP TABLE IF EXISTS `fly_sys_power`;

CREATE TABLE `fly_sys_power` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `master` varchar(64) NOT NULL COMMENT '权限类型，如role,user',
  `master_value` varchar(64) NOT NULL COMMENT '权限类型值',
  `access` varchar(64) NOT NULL COMMENT '权限属性名称 meun method',
  `access_value` text NOT NULL COMMENT '权限属性名称值',
  `operation` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限功能关联表';

DROP TABLE IF EXISTS `fly_sys_role`;

CREATE TABLE `fly_sys_role` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `sort` int(16) NOT NULL DEFAULT '0',
  `visible` int(2) NOT NULL DEFAULT '0',
  `parentID` int(16) NOT NULL DEFAULT '0',
  `name` varchar(32) DEFAULT NULL,
  `intro` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限列表';

DROP TABLE IF EXISTS `fly_sys_user`;

CREATE TABLE `fly_sys_user` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `account` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `tel` varchar(32) DEFAULT NULL,
  `mobile` varchar(32) DEFAULT NULL,
  `qicq` varchar(32) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `zipcode` varchar(256) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `roleID` varchar(50) NOT NULL,
  `deptID` int(16) NOT NULL,
  `positionID` int(16) NOT NULL,
  `intro` varchar(1024) NOT NULL,
  `adt` datetime DEFAULT NULL,
  `identity` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统用户表';

DROP TABLE IF EXISTS `fly_sys_user_notice`;

CREATE TABLE `fly_sys_user_notice` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '通知内容',
  `status` int(2) NOT NULL DEFAULT '-1' COMMENT '-1=未查看，1=查看',
  `owner_user_id` int(2) NOT NULL DEFAULT '0' COMMENT '接收人员编号',
  `create_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '发布人员的编号',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统员工通知信息';

DROP TABLE IF EXISTS `fly_sys_user_role`;

CREATE TABLE `fly_sys_user_role` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `role_id` int(16) NOT NULL DEFAULT '0',
  `user_id` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户权限关联列表';

DROP TABLE IF EXISTS `pos_contract`;

CREATE TABLE `pos_contract` (
  `contract_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `contract_no` varchar(50) NOT NULL COMMENT '合同编号',
  `supplier_id` int(16) NOT NULL,
  `linkman_id` int(16) NOT NULL,
  `chance_id` int(16) NOT NULL,
  `website_id` int(16) NOT NULL COMMENT '关联网站',
  `start_date` date NOT NULL COMMENT '采购时间',
  `end_date` date NOT NULL COMMENT '预订到货时间',
  `our_user_id` int(16) NOT NULL COMMENT '我方联系人',
  `money` decimal(10,2) NOT NULL COMMENT '合同金额',
  `goods_money` decimal(10,2) NOT NULL COMMENT '商品金额',
  `zero_money` decimal(10,2) NOT NULL COMMENT '去零金额',
  `back_money` decimal(10,2) NOT NULL COMMENT '回款金额',
  `owe_money` decimal(10,2) NOT NULL COMMENT '欠款金额',
  `pay_money` decimal(10,2) NOT NULL COMMENT '支付金额',
  `invoice_money` decimal(10,2) NOT NULL COMMENT '开票金额',
  `title` varchar(256) NOT NULL COMMENT '订单主题',
  `intro` text NOT NULL COMMENT '订单介绍',
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1=临时单，2=执行，3=完成，4=撤消',
  `back_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '回款状态，1=未付，2=部分，3=全部',
  `pay_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '支付状态，1=未付，2=部分，3=全部',
  `deliver_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '交付状态',
  `invoice_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '开票状态 0=不需要，1=需要，2=部分，3=全部',
  `rece_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '收货状态，1=需要，2=录入明细，3=待入库，4=部分，5=全部',
  `create_user_id` int(16) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`contract_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='采购合同';

DROP TABLE IF EXISTS `pos_contract_list`;

CREATE TABLE `pos_contract_list` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单项ID',
  `contract_id` int(11) NOT NULL COMMENT '合同ID',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `sku_id` int(11) NOT NULL COMMENT 'skuID',
  `sku_name` varchar(50) NOT NULL COMMENT 'sku名称',
  `sale_price` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `cost_price` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '商品成本价',
  `num` varchar(255) NOT NULL DEFAULT '0' COMMENT '购买数量',
  `into_num` varchar(255) NOT NULL DEFAULT '0' COMMENT '入库数据',
  `owe_num` varchar(255) NOT NULL DEFAULT '0' COMMENT '未入库数量',
  `owe_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '未入库金额',
  `adjust_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '调整金额',
  `goods_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品总价',
  `goods_picture` int(11) NOT NULL DEFAULT '0' COMMENT '商品图片',
  `remarks` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `create_user_id` int(11) DEFAULT '0',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`list_id`),
  KEY `UK_ns_order_goods_goods_id` (`goods_id`),
  KEY `UK_ns_order_goods_order_id` (`contract_id`),
  KEY `UK_ns_order_goods_sku_id` (`sku_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=289 COMMENT='采购订单商品表';

DROP TABLE IF EXISTS `sal_contract`;

CREATE TABLE `sal_contract` (
  `contract_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `contract_no` varchar(50) NOT NULL COMMENT '合同编号',
  `customer_id` int(16) NOT NULL,
  `linkman_id` int(16) NOT NULL,
  `chance_id` int(16) NOT NULL,
  `website_id` int(16) NOT NULL COMMENT '关联网站',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `our_user_id` int(16) NOT NULL COMMENT '我方联系人',
  `money` decimal(10,2) NOT NULL COMMENT '合同金额',
  `goods_money` decimal(10,2) NOT NULL COMMENT '商品金额',
  `zero_money` decimal(10,2) NOT NULL COMMENT '去零金额',
  `back_money` decimal(10,2) NOT NULL COMMENT '回款金额',
  `owe_money` decimal(10,2) NOT NULL COMMENT '欠款金额',
  `deliver_money` decimal(10,2) NOT NULL COMMENT '支付金额',
  `invoice_money` decimal(10,2) NOT NULL COMMENT '开票金额',
  `title` varchar(256) NOT NULL COMMENT '订单主题',
  `intro` text NOT NULL COMMENT '订单介绍',
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '1=临时单，2=执行，3=完成，4=撤消',
  `back_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '回款状态，1=未付，2=部分，3=全部',
  `deliver_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '交付状态，1=需要，2=录入明细，3=待入库，4=部分，5=全部',
  `invoice_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '开票状态 0=不需要，1=需要，2=部分，3=全部',
  `renew_status` smallint(1) NOT NULL DEFAULT '1' COMMENT '订单类型，1=新增加，2=续费',
  `create_user_id` int(16) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`contract_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='销售合同';

DROP TABLE IF EXISTS `sal_contract_list`;

CREATE TABLE `sal_contract_list` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单项ID',
  `contract_id` int(11) NOT NULL COMMENT '合同ID',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `sku_id` int(11) NOT NULL COMMENT 'skuID',
  `sku_name` varchar(50) NOT NULL COMMENT 'sku名称',
  `sale_price` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `cost_price` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '商品成本价',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '购买数量',
  `out_num` int(11) NOT NULL DEFAULT '0' COMMENT '出库数量',
  `owe_num` int(11) NOT NULL DEFAULT '0' COMMENT '未出库数量',
  `owe_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '未出库金额',
  `adjust_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '调整金额',
  `goods_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品总价',
  `goods_picture` int(11) NOT NULL DEFAULT '0' COMMENT '商品图片',
  `remarks` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `create_user_id` int(11) DEFAULT '0',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`list_id`),
  KEY `UK_ns_order_goods_goods_id` (`goods_id`),
  KEY `UK_ns_order_goods_order_id` (`contract_id`),
  KEY `UK_ns_order_goods_sku_id` (`sku_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=289 COMMENT='销售合同明细表';

DROP TABLE IF EXISTS `stock_goods_sku`;

CREATE TABLE `stock_goods_sku` (
  `stock_goods_sku_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表序号',
  `sku_id` int(11) NOT NULL DEFAULT '0' COMMENT 'skuID',
  `store_id` int(11) NOT NULL DEFAULT '0' COMMENT '仓库编号',
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品编号',
  `goods_name` varchar(500) NOT NULL DEFAULT '' COMMENT '商品名称',
  `sku_name` varchar(500) NOT NULL DEFAULT '' COMMENT 'SKU名称',
  `sale_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售价格',
  `cost_price` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '成本价',
  `total_cost_money` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '成本总金额',
  `total_sale_money` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '销售总金额',
  `total_profit_money` decimal(19,2) NOT NULL DEFAULT '0.00' COMMENT '利润总金额',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `code` varchar(255) NOT NULL DEFAULT '' COMMENT '商家编码',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`stock_goods_sku_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=481 COMMENT='库存清单';

DROP TABLE IF EXISTS `stock_into`;

CREATE TABLE `stock_into` (
  `into_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '仓库编号',
  `contract_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '采购合同编号',
  `title` varchar(256) NOT NULL COMMENT '订单主题',
  `money` decimal(10,2) NOT NULL COMMENT '金额',
  `number` int(16) NOT NULL COMMENT '数量',
  `intro` text NOT NULL COMMENT '订单介绍',
  `status` smallint(1) NOT NULL DEFAULT '-1' COMMENT '1=已经入库，-1=未入库',
  `into_user_id` int(16) NOT NULL COMMENT '入库管理员',
  `into_time` datetime NOT NULL COMMENT '入库时间',
  `into_type` varchar(50) NOT NULL COMMENT '入库类型',
  `create_user_id` int(16) NOT NULL COMMENT '创建人',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`into_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='入库单';

DROP TABLE IF EXISTS `stock_into_list`;

CREATE TABLE `stock_into_list` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单项ID',
  `into_id` int(11) NOT NULL COMMENT '入库单编号 ',
  `contract_id` int(11) NOT NULL COMMENT '合同ID',
  `contract_list_id` int(11) NOT NULL COMMENT '合同明细ID',
  `store_id` int(11) NOT NULL COMMENT '库存编号',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `sku_id` int(11) NOT NULL COMMENT 'skuID',
  `sku_name` varchar(50) NOT NULL COMMENT 'sku名称',
  `number` varchar(255) NOT NULL DEFAULT '0' COMMENT '购买数量',
  `price` decimal(10,2) NOT NULL COMMENT '采购价格',
  `money` decimal(10,2) NOT NULL COMMENT '总金额',
  `remarks` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `create_user_id` int(11) DEFAULT '0',
  `create_time` datetime NOT NULL,
  `into_user_id` int(11) DEFAULT '0' COMMENT '入库人员',
  `into_time` datetime NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`list_id`),
  KEY `UK_ns_order_goods_goods_id` (`goods_id`),
  KEY `UK_ns_order_goods_order_id` (`contract_id`),
  KEY `UK_ns_order_goods_sku_id` (`sku_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=289 COMMENT='入库单明细表';

DROP TABLE IF EXISTS `stock_out`;

CREATE TABLE `stock_out` (
  `out_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '仓库编号',
  `contract_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '销售合同编号',
  `title` varchar(256) NOT NULL COMMENT '订单主题',
  `money` decimal(10,2) NOT NULL COMMENT '金额',
  `number` int(16) NOT NULL COMMENT '数量',
  `intro` text NOT NULL COMMENT '订单介绍',
  `status` smallint(1) NOT NULL DEFAULT '-1' COMMENT '1=已经出库，-1=未出库',
  `out_user_id` int(16) NOT NULL COMMENT '出库管理员',
  `out_time` datetime NOT NULL COMMENT '出库时间',
  `out_type` varchar(50) NOT NULL COMMENT '出库类型',
  `create_user_id` int(16) NOT NULL COMMENT '创建人',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`out_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='入库单';

DROP TABLE IF EXISTS `stock_out_list`;

CREATE TABLE `stock_out_list` (
  `list_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单项ID',
  `out_id` int(11) NOT NULL COMMENT '出库单编号 ',
  `contract_id` int(11) NOT NULL COMMENT '合同ID',
  `contract_list_id` int(11) NOT NULL COMMENT '合同明细ID',
  `store_id` int(11) NOT NULL COMMENT '库存编号',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `sku_id` int(11) NOT NULL COMMENT 'skuID',
  `sku_name` varchar(50) NOT NULL COMMENT 'sku名称',
  `number` varchar(255) NOT NULL DEFAULT '0' COMMENT '购买数量',
  `price` decimal(10,2) NOT NULL COMMENT '出库价格',
  `money` decimal(10,2) NOT NULL COMMENT '总金额',
  `remarks` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `create_user_id` int(11) DEFAULT '0',
  `create_time` datetime NOT NULL,
  `out_user_id` int(11) DEFAULT '0' COMMENT '入库人员',
  `out_time` datetime NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`list_id`),
  KEY `UK_ns_order_goods_goods_id` (`goods_id`),
  KEY `UK_ns_order_goods_order_id` (`contract_id`),
  KEY `UK_ns_order_goods_sku_id` (`sku_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=289 COMMENT='入库单明细表';

DROP TABLE IF EXISTS `stock_store`;

CREATE TABLE `stock_store` (
  `store_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL COMMENT '名称',
  `create_user_id` int(11) NOT NULL COMMENT '创建人员',
  `own_user_id` varchar(256) NOT NULL COMMENT '管理人员',
  `sort` smallint(2) NOT NULL,
  `visible` smallint(2) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='仓库管理';

DROP TABLE IF EXISTS `sup_linkman`;

CREATE TABLE `sup_linkman` (
  `linkman_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(16) NOT NULL,
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
  `create_time` datetime NOT NULL,
  `create_user_id` int(16) NOT NULL,
  PRIMARY KEY (`linkman_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='供应商联系人';

DROP TABLE IF EXISTS `sup_supplier`;

CREATE TABLE `sup_supplier` (
  `supplier_id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `area_id` int(16) NOT NULL COMMENT '所在地区',
  `create_user_id` int(16) NOT NULL,
  `level` int(16) NOT NULL COMMENT '客户等级',
  `ecotype` int(16) NOT NULL COMMENT '经济类型',
  `trade` int(16) NOT NULL COMMENT '行业',
  `satisfy` smallint(6) NOT NULL DEFAULT '3' COMMENT '满意度（1-5），默认为3',
  `credit` smallint(2) NOT NULL DEFAULT '3' COMMENT '信用度（1-5），默认为3',
  `address` varchar(256) NOT NULL,
  `linkman` varchar(256) NOT NULL,
  `website` varchar(256) NOT NULL,
  `zipcode` varchar(64) NOT NULL,
  `tel` varchar(256) NOT NULL,
  `fax` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `intro` text NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='供应商';

