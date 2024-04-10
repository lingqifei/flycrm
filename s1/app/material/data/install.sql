-- -----------------------------
-- Table structure for `#@__material_borad`
-- -----------------------------
DROP TABLE IF EXISTS `#@__material_borad`;
CREATE TABLE `#@__material_borad` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名字',
  `model_code` varchar(256) NOT NULL DEFAULT '' COMMENT '型号',
  `colour_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '颜色id',
  `colour_name` varchar(256) NOT NULL DEFAULT '' COMMENT '颜色名称',
  `quality_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '材质id',
  `quality_name` varchar(256) NOT NULL DEFAULT '' COMMENT '材质名称',
  `brand_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '品牌id',
  `brand_name` varchar(256) NOT NULL DEFAULT '' COMMENT '品牌名称',
  `shelves_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '货架id',
  `shelves_name` varchar(256) NOT NULL DEFAULT '' COMMENT '货架名称',
  `shelves_cell_code` varchar(256) NOT NULL DEFAULT '' COMMENT '所在格子编号',
  `litpic` varchar(256) NOT NULL DEFAULT '' COMMENT '缩略图',
  `leng` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '长',
  `width` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '宽',
  `area` float unsigned NOT NULL DEFAULT '0' COMMENT '面积',
  `use_status` smallint(2) NOT NULL DEFAULT '1' COMMENT '使用状态，1=未用，2=锁定，3=使用，4=报废',
  `sort` smallint(2) NOT NULL DEFAULT '100' COMMENT '排序',
  `visible` smallint(2) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `create_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建人员',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '企业id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='[material]板子管理';

-- -----------------------------
-- Records of `material_borad`
-- -----------------------------
INSERT INTO `#@__material_borad` VALUES ('1', '上面阳光', 'TWER582', '4', '白色', '4', '多层实木', '0', '', '3', 'A3205', 'ABC00001', '0', '2850', '1853', '5.28105', '3', '10', '1', '0', '1680614795', '1680658175', '1');
INSERT INTO `#@__material_borad` VALUES ('2', '上面阳光', 'TWER582', '4', '白色', '0', '', '0', '', '3', 'A3205', 'ABC00001', '0', '2850', '1853', '5.28105', '3', '10', '1', '0', '1680653978', '1680658175', '1');
INSERT INTO `#@__material_borad` VALUES ('3', '上面阳光', 'TWER582', '4', '白色', '0', '', '0', '', '3', 'A3205', 'ABC00001', '0', '2850', '1853', '5.28105', '3', '10', '1', '0', '1680654027', '1680658175', '1');
INSERT INTO `#@__material_borad` VALUES ('4', '上面阳光', 'TWER582', '4', '白色', '4', '多层实木', '0', '', '3', 'A3205', 'ABC00001', '0', '2850', '1853', '5.28105', '3', '10', '1', '0', '1680654042', '1680658175', '1');
INSERT INTO `#@__material_borad` VALUES ('5', '天河区', '23424', '4', '白色', '4', '多层实木', '0', '', '3', 'A3205', 'ABC00001', '0', '5000', '1000', '5', '3', '10', '1', '0', '1680657816', '1680658175', '1');
INSERT INTO `#@__material_borad` VALUES ('6', '小区', '', '4', '白色', '4', '多层实木', '0', '', '3', 'A3205', 'ABC00002', '0', '200', '4000', '0.8', '3', '10', '1', '0', '1680657852', '1680658175', '1');
INSERT INTO `#@__material_borad` VALUES ('7', '阳光小区', 'R234', '4', '白色', '4', '多层实木', '0', '', '3', 'A3205', 'ABC00001', '0', '234', '342', '0.080028', '1', '10', '1', '0', '1680658282', '0', '1');
INSERT INTO `#@__material_borad` VALUES ('8', '阳光小区', 'R234', '4', '白色', '4', '多层实木', '0', '', '3', 'A3205', 'ABC00002', '0', '234', '342', '0.080028', '1', '10', '1', '0', '1680658288', '0', '1');
INSERT INTO `#@__material_borad` VALUES ('9', '阳光小区', 'R234', '4', '白色', '4', '多层实木', '0', '', '3', 'A3205', 'ABC00004', '0', '234', '342', '0.080028', '1', '10', '1', '0', '1680658293', '0', '1');

-- -----------------------------
-- Table structure for `#@__material_brand`
-- -----------------------------
DROP TABLE IF EXISTS `#@__material_brand`;
CREATE TABLE `#@__material_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级分类id',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '层级',
  `visible` int(11) NOT NULL DEFAULT '1' COMMENT '是否显示  1 显示 0 不显示',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '分类关键字用于seo',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '分类描述用于seo',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
  `litpic` varchar(255) NOT NULL DEFAULT '' COMMENT '商品分类图片',
  `sort` int(11) DEFAULT '1' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '企业会员',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1 COMMENT='[material]品牌表';

-- -----------------------------
-- Records of `material_brand`
-- -----------------------------
INSERT INTO `#@__material_brand` VALUES ('3', '零起飞', '0', '0', '1', '', '', '', '20230206/c34a9beade967cb9ef4a2c90d0b7daf1.jpg', '10', '1680578866', '1680579701', '1');

-- -----------------------------
-- Table structure for `#@__material_category`
-- -----------------------------
DROP TABLE IF EXISTS `#@__material_category`;
CREATE TABLE `#@__material_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `itsname` varchar(50) NOT NULL DEFAULT '' COMMENT '商品分类简称 ',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级分类id',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '层级',
  `visible` int(11) NOT NULL DEFAULT '1' COMMENT '是否显示  1 显示 0 不显示',
  `attr_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联商品类型ID',
  `attr_name` varchar(255) NOT NULL DEFAULT '' COMMENT '关联类型名称',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '分类关键字用于seo',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '分类描述用于seo',
  `intro` varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
  `litpic` varchar(255) NOT NULL DEFAULT '' COMMENT '商品分类图片',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `org_id` int(11) NOT NULL DEFAULT '0' COMMENT '企业会员',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1 COMMENT='[material]商品分类表';

-- -----------------------------
-- Records of `material_category`
-- -----------------------------
INSERT INTO `#@__material_category` VALUES ('3', '木材质', '', '0', '0', '1', '0', '', '', '', '这是大类的', '24', '100', '1680577276', '1680577309', '0');

-- -----------------------------
-- Table structure for `#@__material_colour`
-- -----------------------------
DROP TABLE IF EXISTS `#@__material_colour`;
CREATE TABLE `#@__material_colour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级分类id',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '层级',
  `visible` int(11) NOT NULL DEFAULT '1' COMMENT '是否显示  1 显示 0 不显示',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '分类关键字用于seo',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '分类描述用于seo',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
  `litpic` varchar(255) NOT NULL DEFAULT '' COMMENT '商品分类图片',
  `sort` int(11) DEFAULT '1' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '企业会员',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1 COMMENT='[material]颜色表';

-- -----------------------------
-- Records of `material_colour`
-- -----------------------------
INSERT INTO `#@__material_colour` VALUES ('4', '白色', '0', '0', '1', '', '', '', '20220222/71bf2b89189a8f2b5cce20b039f1e773.jpg', '10', '1680586577', '0', '1');

-- -----------------------------
-- Table structure for `#@__material_quality`
-- -----------------------------
DROP TABLE IF EXISTS `#@__material_quality`;
CREATE TABLE `#@__material_quality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级分类id',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '层级',
  `visible` int(11) NOT NULL DEFAULT '1' COMMENT '是否显示  1 显示 0 不显示',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '分类关键字用于seo',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '分类描述用于seo',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '介绍',
  `litpic` varchar(255) NOT NULL DEFAULT '' COMMENT '商品分类图片',
  `sort` int(11) DEFAULT '1' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '企业会员',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1 COMMENT='[material]材质表';

-- -----------------------------
-- Records of `material_quality`
-- -----------------------------
INSERT INTO `#@__material_quality` VALUES ('4', '多层实木', '0', '0', '1', '', '', '', '20230404/591677885f7b90f6656aac64c54d9700.jpg', '10', '1680586728', '0', '1');

-- -----------------------------
-- Table structure for `#@__material_shelves`
-- -----------------------------
DROP TABLE IF EXISTS `#@__material_shelves`;
CREATE TABLE `#@__material_shelves` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '仓库id',
  `store_name` varchar(256) NOT NULL DEFAULT '' COMMENT '仓库名称',
  `shelves_code` varchar(256) NOT NULL DEFAULT '' COMMENT '编码',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `manage_user_id` varchar(256) DEFAULT '' COMMENT '管理人员，可以设置多个1，2，3，4',
  `manage_user_name` varchar(512) DEFAULT '' COMMENT '管理员人名称多个：张帮，李四 ',
  `sort` smallint(2) NOT NULL DEFAULT '100' COMMENT '排序',
  `visible` smallint(2) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `create_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建人员',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '企业id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='[material]货架管理';

-- -----------------------------
-- Records of `material_shelves`
-- -----------------------------
INSERT INTO `#@__material_shelves` VALUES ('3', '3', '一号仓库', 'ABC', 'A3205', '', '', '10', '1', '0', '1680592109', '1680602438', '1');

-- -----------------------------
-- Table structure for `#@__material_shelves_cell`
-- -----------------------------
DROP TABLE IF EXISTS `#@__material_shelves_cell`;
CREATE TABLE `#@__material_shelves_cell` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `shelves_id` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '货架id',
  `shelves_name` varchar(256) NOT NULL DEFAULT '' COMMENT '货架名称',
  `shelves_code` varchar(256) NOT NULL DEFAULT '' COMMENT '货架编码',
  `start_num` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '开始编号',
  `end_num` int(16) unsigned NOT NULL DEFAULT '0' COMMENT '结束编号',
  `shelves_cell_code` varchar(256) NOT NULL DEFAULT '' COMMENT '编号',
  `use_status` smallint(2) NOT NULL DEFAULT '1' COMMENT '使用状态，0=未知，1=未用，2=使用',
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `sort` smallint(2) NOT NULL DEFAULT '100' COMMENT '排序',
  `visible` smallint(2) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `create_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建人员',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '企业id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='[material]货架格子管理';

-- -----------------------------
-- Records of `material_shelves_cell`
-- -----------------------------
INSERT INTO `#@__material_shelves_cell` VALUES ('31', '3', 'A3205', 'ABC', '1', '10', 'ABC00001', '2', '', '10', '1', '1', '1680600181', '1680658282', '1');
INSERT INTO `#@__material_shelves_cell` VALUES ('32', '3', 'A3205', 'ABC', '1', '10', 'ABC00002', '2', '', '10', '1', '1', '1680600181', '1680658288', '1');
INSERT INTO `#@__material_shelves_cell` VALUES ('33', '3', 'A3205', 'ABC', '1', '10', 'ABC00003', '1', '', '10', '1', '1', '1680600181', '0', '1');
INSERT INTO `#@__material_shelves_cell` VALUES ('34', '3', 'A3205', 'ABC', '1', '10', 'ABC00004', '2', '', '10', '1', '1', '1680600181', '1680658293', '1');
INSERT INTO `#@__material_shelves_cell` VALUES ('35', '3', 'A3205', 'ABC', '1', '10', 'ABC00005', '1', '', '10', '1', '1', '1680600181', '0', '1');
INSERT INTO `#@__material_shelves_cell` VALUES ('36', '3', 'A3205', 'ABC', '1', '10', 'ABC00006', '1', '', '10', '1', '1', '1680600181', '0', '1');
INSERT INTO `#@__material_shelves_cell` VALUES ('37', '3', 'A3205', 'ABC', '1', '10', 'ABC00007', '1', '', '10', '1', '1', '1680600181', '0', '1');
INSERT INTO `#@__material_shelves_cell` VALUES ('38', '3', 'A3205', 'ABC', '1', '10', 'ABC00008', '1', '', '10', '1', '1', '1680600181', '0', '1');
INSERT INTO `#@__material_shelves_cell` VALUES ('39', '3', 'A3205', 'ABC', '1', '10', 'ABC00009', '1', '', '10', '1', '1', '1680600181', '0', '1');
INSERT INTO `#@__material_shelves_cell` VALUES ('40', '3', 'A3205', 'ABC', '1', '10', 'ABC00010', '1', '', '10', '1', '1', '1680600181', '0', '1');

-- -----------------------------
-- Table structure for `#@__material_store`
-- -----------------------------
DROP TABLE IF EXISTS `#@__material_store`;
CREATE TABLE `#@__material_store` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '' COMMENT '名称',
  `manage_user_id` varchar(256) DEFAULT '' COMMENT '管理人员，可以设置多个1，2，3，4',
  `manage_user_name` varchar(512) DEFAULT '' COMMENT '管理员人名称多个：张帮，李四 ',
  `sort` smallint(2) NOT NULL DEFAULT '100' COMMENT '排序',
  `visible` smallint(2) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `create_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建人员',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `org_id` int(11) NOT NULL DEFAULT '1' COMMENT '企业id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='[material]仓库管理';

-- -----------------------------
-- Records of `material_store`
-- -----------------------------
INSERT INTO `#@__material_store` VALUES ('3', '一号仓库', '95,94,93,92,91,90,89,88,87,86', '李小5,李小4,李小3,李小2,李小1,xiao6,xiao5,xiao4,xiao3,xiao2', '10', '1', '0', '1680577167', '0', '1');
