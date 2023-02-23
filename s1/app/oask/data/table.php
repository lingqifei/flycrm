<?php
// +----------------------------------------------------------------------
// | 07FLY系统 [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | 07FLY承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 开发人生 <574249366@qq.com>
// +----------------------------------------------------------------------
/**
 * 表结构基本信息
 */
/**
 * type 类型
 * length 类型长度
 * unsigned 是否无符号
 * autoincrement 是否自动增长
 * required  是否必填
 * default  默认值
 * comment  注释
 */
return [
	'tables' => [
		'weburl' => [
			//表名
			'table_name' => 'weburl',
			//表注释
			'comment' => '[oask]网址收藏',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '网站名称',],
				'url' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '网站网址',],
				'remark' => ['type' => 'varchar', 'length' => 512, 'required' => true, 'default' => '', 'comment' => '备注说明',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],
		'myfile' => [
			//表名
			'table_name' => 'myfile',
			//表注释
			'comment' => '[oask]我的文件',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '文件名称',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '文件地址',],
				'remark' => ['type' => 'varchar', 'length' => 512, 'required' => true, 'default' => '', 'comment' => '备注说明',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		'shop' => [
			//表名
			'table_name' => 'shop',
			//表注释
			'comment' => '[oask]门店列表',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '门店名称',],
				'linkman' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '联系人',],
				'mobile' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '联系手机',],
				'email' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '联系邮箱',],
				'address' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '联系地址',],
				'remark' => ['type' => 'varchar', 'length' => 512, 'required' => true, 'default' => '', 'comment' => '备注说明',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		'shop_notes' => [
			//表名
			'table_name' => 'shop_notes',
			//表注释
			'comment' => '[oask]门店日常记录',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '标题名称',],
				'body' => ['type' => 'text', 'required' => false, 'comment' => '内容',],
				'litpic' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'shop_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '门店编号id',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		'shop_licence' => [
			//表名 门店证照
			'table_name' => 'shop_licence',
			//表注释
			'comment' => '[oask]门店证照管理',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'expire_date' => ['type' => 'date', 'required' => false, 'comment' => '到期日期',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'shop_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '门店编号id',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		'shop_album' => [
			//表名 门店相册
			'table_name' => 'shop_album',
			//表注释
			'comment' => '[oask]门店相册',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'shop_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '门店编号id',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 公司内部文件
		'shop_file_inside' => [
			'table_name' => 'shop_file_inside',
			'comment' => '[oask]公司内部文件',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'body' => ['type' => 'text', 'required' => false, 'comment' => '内容',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'shop_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '门店编号id',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 公司内部文件评论回复
		'shop_file_inside_reply' => [
			'table_name' => 'shop_file_inside_reply',
			'comment' => '[oask]公司内部文件评论回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'file_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '文件编号id',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 监管部门文件
		'shop_file_dept' => [
			'table_name' => 'shop_file_dept',
			'comment' => '[oask]监管部门文件',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'body' => ['type' => 'text', 'required' => false, 'comment' => '内容',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'shop_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '门店编号id',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 监管部门文件评论回复
		'shop_file_dept_reply' => [
			'table_name' => 'shop_file_dept_reply',
			'comment' => '[oask]监管部门文件评论回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'file_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '文件编号id',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 其它记录
		'other_notes' => [

			'table_name' => 'other_notes',
			'comment' => '[oask]其它记录',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '标题名称',],
				'body' => ['type' => 'text', 'required' => false, 'comment' => '内容',],
				'litpic' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'linkman' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '对方联系人及电话',],

				'shop_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '门店编号id',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
				'update_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新人员id',],
				'owner_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '负责人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 公告资讯回复
		'other_notes_reply' => [
			'table_name' => 'other_notes_reply',
			'comment' => '[oask]其它记录回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'other_notes_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '记录编号id',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 共享文件
		'share_file' => [
			'table_name' => 'share_file',
			'comment' => '[oask]监管部门文件',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'body' => ['type' => 'text', 'required' => false, 'comment' => '内容',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'shop_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '门店编号id',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 营销活动
		'activity' => [
			'table_name' => 'activity',
			'comment' => '[oask]营销活动',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'body' => ['type' => 'text', 'required' => false, 'comment' => '内容',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'target' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '目标',],
				'result' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '结果',],

				'begin_date' => ['type' => 'date', 'required' => false, 'comment' => '开始日期',],
				'end_date' => ['type' => 'date', 'required' => false, 'comment' => '结束日期',],
				'budget' => ['type' => 'DECIMAL', 'length' => '20,2', 'required' => true, 'default' => '0', 'comment' => '预算',],

				'status' => ['type' => 'int', 'length' => 2, 'required' => false, 'default' => 1, 'comment' => '状态',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 营销活动回复
		'activity_reply' => [
			'table_name' => 'activity_reply',
			'comment' => '[oask]营销活动回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'activity_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '活动编号id',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 销售合同
		'cst_contract' => [
			'table_name' => 'cst_contract',
			'comment' => '[oask]销售合同',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'customer_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '客户编号id',],
				'contract_no' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '合同编号',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'begin_date' => ['type' => 'date', 'required' => false, 'comment' => '开始日期',],
				'end_date' => ['type' => 'date', 'required' => false, 'comment' => '结束日期',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'money' => ['type' => 'DECIMAL', 'length' => '20,2', 'required' => true, 'default' => '0', 'comment' => '合同金额',],

				'status' => ['type' => 'int', 'length' => 2, 'required' => false, 'default' => 1, 'comment' => '状态',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 销售记录
		'cst_sales' => [
			'table_name' => 'cst_sales',
			'comment' => '[oask]销售记录',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'customer_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '客户编号id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'sale_date' => ['type' => 'date', 'required' => false, 'comment' => '销售日期',],
				'money' => ['type' => 'DECIMAL', 'length' => '20,2', 'required' => true, 'default' => '0', 'comment' => '合同金额',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 客户表
		'cst_customer' => [
			'table_name' => 'cst_customer',
			'comment' => '[oask]客户信息',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'delegate' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '代表品种',],
				'channel' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '品牌渠道',],
				'agreement' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '是否协议',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		'cst_trace' => [
			'table_name' => 'cst_trace',
			'comment' => '[oask]客户跟进记录',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				
				'reply_body' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复内容',],
				'status' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '处理状态',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 供应商
		'sup_supplier' => [
			'table_name' => 'sup_supplier',
			'comment' => '[oask]供应商信息',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'delegate' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '代表品种',],
				'channel' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '品牌渠道',],
				'agreement' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '是否协议',],
				'firmcategory' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '厂家类别',],
				'qicq' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => 'QQ',],
				'weixin' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '微信',],
				'address_mail' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '邮寄地址',],
				'linkman_other' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '其它联系人',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 供应商跟进记录
		'sup_trace' => [
			'table_name' => 'sup_trace',
			'comment' => '[oask]供应商跟进记录',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'supplier_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '供应商编号id',],
				'linkman_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '联系人编号',],
				'linkman_name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '联系人名称',],
				'link_time' => ['type' => 'datetime', 'required' => false, 'comment' => '联系时间',],
				'link_body' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '联系内容',],
				'next_time' => ['type' => 'datetime', 'required' => false, 'comment' => '下次联系时间',],
				'next_body' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '下次联系内容',],
				'salestage' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '沟通阶段',],
				'salemode' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '沟通方式',],

				'reply_body' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复内容',],
				'status' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '处理状态',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 采购合同
		'sup_contract' => [
			'table_name' => 'sup_contract',
			'comment' => '[oask]采购合同',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'supplier_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '供应商编号id',],
				'contract_no' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '合同编号',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'begin_date' => ['type' => 'date', 'required' => false, 'comment' => '开始日期',],
				'end_date' => ['type' => 'date', 'required' => false, 'comment' => '结束日期',],
				'remind_date' => ['type' => 'date', 'required' => false, 'comment' => '提醒日期',],
				'body' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '合同内容',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'status' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '状态',],

				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'money' => ['type' => 'DECIMAL', 'length' => '20,2', 'required' => true, 'default' => '0', 'comment' => '合同金额',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 采购记录
		'sup_sales' => [
			'table_name' => 'sup_sales',
			'comment' => '[oask]销售记录',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'supplier_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '供应商编号id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'purchase_date' => ['type' => 'date', 'required' => false, 'comment' => '采购日期',],
				'money' => ['type' => 'DECIMAL', 'length' => '20,2', 'required' => true, 'default' => '0', 'comment' => '采购金额',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 公告资讯
		'notice' => [
			'table_name' => 'notice',
			'comment' => '[oask]公告资讯',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'body' => ['type' => 'text', 'required' => false, 'comment' => '内容',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 公告资讯回复
		'notice_reply' => [
			'table_name' => 'notice_reply',
			'comment' => '[oask]公告资讯回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'notice_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '公告编号id',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],


		//表名 公文管理
		'document' => [
			'table_name' => 'document',
			'comment' => '[oask]公文管理',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'body' => ['type' => 'text', 'required' => false, 'comment' => '内容',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 公文管理回复
		'document_reply' => [
			'table_name' => 'document_reply',
			'comment' => '[oask]公文管理回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'document_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '公文编号id',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],


		'company_album' => [
			//表名 公司相册
			'table_name' => 'company_album',
			//表注释
			'comment' => '[oask]门店相册',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		'licence' => [
			//表名 门店证照
			'table_name' => 'licence',
			//表注释
			'comment' => '[oask]证照管理',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'expire_date' => ['type' => 'date', 'required' => false, 'comment' => '到期日期',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 证照回复
		'licence_reply' => [
			'table_name' => 'licence_reply',
			'comment' => '[oask]证照回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'licence_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '证照编号id',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 销售合同
		'contract' => [
			'table_name' => 'contract',
			'comment' => '[oask]行政合同',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'customer_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '客户编号id',],
				'typename' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '合同类型',],
				'contract_no' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '合同编号',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'begin_date' => ['type' => 'date', 'required' => false, 'comment' => '开始日期',],
				'end_date' => ['type' => 'date', 'required' => false, 'comment' => '结束日期',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'money' => ['type' => 'DECIMAL', 'length' => '20,2', 'required' => true, 'default' => '0', 'comment' => '合同金额',],

				'status' => ['type' => 'int', 'length' => 2, 'required' => false, 'default' => 1, 'comment' => '状态',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 合同回复
		'contract_reply' => [
			'table_name' => 'contract_reply',
			'comment' => '[oask]行政合同回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'contract_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '合同编号id',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 人事合同
		'hrm_staff_contract' => [
			'table_name' => 'hrm_staff_contract',
			'comment' => '[oask]人事合同',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'staff_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '员工档案编号id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '合同名称',],
				'begin_date' => ['type' => 'date', 'required' => false, 'comment' => '开始日期',],
				'end_date' => ['type' => 'date', 'required' => false, 'comment' => '结束日期',],

				'contract_no' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '合同编号',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 人事员工证照
		'hrm_staff_licence' => [
			'table_name' => 'hrm_staff_licence',
			'comment' => '[oask]人事员工证照',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'staff_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '员工档案编号id',],
				'begin_date' => ['type' => 'date', 'required' => false, 'comment' => '开始日期',],
				'end_date' => ['type' => 'date', 'required' => false, 'comment' => '结束日期',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '合同名称',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 员工学习培训
		'hrm_staff_study' => [
			'table_name' => 'hrm_staff_study',
			'comment' => '[oask]员工学习培训',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'staff_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '员工档案编号id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '学习名称',],
				'begin_date' => ['type' => 'date', 'required' => false, 'comment' => '开始日期',],
				'end_date' => ['type' => 'date', 'required' => false, 'comment' => '结束日期',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 员工关怀
		'hrm_staff_care' => [
			'table_name' => 'hrm_staff_care',
			'comment' => '[oask]员工关怀',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'staff_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '员工档案编号id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '名称',],
				'curr_date' => ['type' => 'date', 'required' => false, 'comment' => '发生日期',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 员工奖罚
		'hrm_staff_reward' => [
			'table_name' => 'hrm_staff_reward',
			'comment' => '[oask]员工奖罚',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'staff_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '员工档案编号id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '事件名称',],
				'typename' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '事件类型/奖励、惩罚',],
				'curr_date' => ['type' => 'date', 'required' => false, 'comment' => '发生日期',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],


		//表名 资产分类
		'assets_type' => [
			'table_name' => 'assets_type',
			'comment' => '[oask]资产分类',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '分类名称',],
				'pid' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '上级id',],
				'sort' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '排序',],
				'visible' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '禁用',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 资产管理
		'assets' => [
			'table_name' => 'assets',
			'comment' => '[oask]资产管理列表',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'type_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '分类编号',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '资产名称',],
				'assets_no' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '编号',],
				'use_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '使用人员',],
				'address' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '存放地点',],
				'begin_date' => ['type' => 'date', 'required' => false, 'comment' => '购买日期',],
				'expire_date' => ['type' => 'date', 'required' => false, 'comment' => '到期日期',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],

				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'status' => ['type' => 'varchar', 'length' => 256, 'required' => false, 'default' => '', 'comment' => '状态',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 资产管理回复
		'assets_reply' => [
			'table_name' => 'assets_reply',
			'comment' => '[oask]资产管理回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'assets_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '资产编号id',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 规章制度分类
		'regulation_type' => [
			'table_name' => 'regulation_type',
			'comment' => '[oask]规章制度分类',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '分类名称',],
				'pid' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '上级id',],
				'sort' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '排序',],
				'visible' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '禁用',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 规章制度
		'regulation' => [
			'table_name' => 'regulation',
			'comment' => '[oask]规章制度',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'type_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '分类编号',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '资产名称',],
				'body' => ['type' => 'text', 'required' => false, 'comment' => '内容',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],

				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 规章制度回复
		'regulation_reply' => [
			'table_name' => 'regulation_reply',
			'comment' => '[oask]规章制度回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'regulation_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '制度编号id',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 资产管理
		'meeting' => [
			'table_name' => 'meeting',
			'comment' => '[oask]会议管理列表',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '会议主题',],
				'address' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '会议地址',],
				'host_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '主持人员id',],
				'part_user_id' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '参与人员编号',],
				'part_user_name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '参与人员名称',],

				'begin_time' => ['type' => 'datetime', 'required' => false, 'comment' => '开始时间',],
				'end_time' => ['type' => 'datetime', 'required' => false, 'comment' => '结束时间',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'status' => ['type' => 'varchar', 'length' => 256, 'required' => false, 'default' => '', 'comment' => '状态',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 会议回复
		'meeting_reply' => [
			'table_name' => 'meeting_reply',
			'comment' => '[oask]会议回复',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '回复说明',],
				'reply_litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '图片',],
				'reply_attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'meeting_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '会议编号id',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 通信录分类
		'contacts_type' => [
			'table_name' => 'contacts_type',
			'comment' => '[oask]通信录分类',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '分类名称',],
				'pid' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '上级id',],
				'sort' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '排序',],
				'visible' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '禁用',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 通信录管理
		'contacts' => [
			'table_name' => 'contacts',
			'comment' => '[oask]通信录管理',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'type_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '分类编号id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '姓名',],
				'mobile' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '联系电话',],
				'email' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '联系邮箱',],
				'address' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '联系地址',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 考勤类型分类
		'attendance_type' => [
			'table_name' => 'attendance_type',
			'comment' => '[oask]考勤分类',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '分类名称',],
				'pid' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '上级id',],
				'sort' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '排序',],
				'visible' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '禁用',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 考勤记录管理
		'attendance' => [
			'table_name' => 'attendance',
			'comment' => '[oask]员工考勤管理',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'staff_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '员工档案编号',],
				'type_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '考勤类型',],

				'begin_time' => ['type' => 'datetime', 'required' => false, 'comment' => '开始时间',],
				'end_time' => ['type' => 'datetime', 'required' => false, 'comment' => '结束时间',],
				'time_len' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '时长（小时）',],
				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'status' => ['type' => 'varchar', 'length' => 256, 'required' => false, 'default' => '', 'comment' => '状态',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 工作流程管理
		'workflow' => [
			'table_name' => 'workflow',
			'comment' => '[oask]员工考勤管理',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],

				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '工作名称',],
				'body' => ['type' => 'text', 'required' => false, 'comment' => '工作内容',],

				'remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'deal_user_id' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '处理审核人员',],
				'status' => ['type' => 'int', 'length' => 10, 'required' => true, 'default' => 0, 'comment' => '0=临时单，1=待审核，2=已通过，3=被否决，4=被驳回，5=已撤销',],

				'level' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '级别',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
				'create_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建人员id',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 工作流程管理
		//,1=通过，2=退回，3=转发，4=拒绝
		'workflow_deal' => [
			'table_name' => 'workflow_deal',
			'comment' => '[oask]工作流程处理管理',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'workflow_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '关联工作流程id',],
				'deal_user_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '处理人员id',],
				'deal_time' => ['type' => 'datetime', 'required' => false, 'comment' => '处理时间',],
				'deal_remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'deal_status' => ['type' => 'int', 'length' => 16, 'required' => 2, 'default' => 0, 'comment' => '0=待处理，1=通过，2=拒绝，3=转发',],

				'litpic' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '扫描图片',],
				'attachment' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '附件文档',],
				'status' => ['type' => 'int', 'length' => 16, 'required' => 2, 'default' => 0, 'comment' => '0=临时中，1=待处理，2=处理',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],


		//表名 系统消息
		'sys_msg' => [
			'table_name' => 'sys_msg',
			'comment' => '[oask]系统消息',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'bus_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '业务id',],
				'bus_name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '业务名称',],
				'bus_type' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '业务类型',],

				'deal_time' => ['type' => 'datetime', 'required' => false, 'comment' => '提醒处理时间',],
				'deal_remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'deal_status' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '0=待处理，1=已经处理',],
				'deal_user_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '提醒处理人员',],
				'status' => ['type' => 'int', 'length' => 16, 'required' => 2, 'default' => 0, 'comment' => '0=未提醒，1=提醒中，2=不提醒了',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

	],//end tables;

];