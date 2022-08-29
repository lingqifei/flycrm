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
/**table_name 数据库表名（不带前缀）
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
		'sys_position' => [
			//表名
			'table_name' => 'sys_position',
			//表注释
			'comment' => '[系统]职位表',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'data_role' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 1, 'comment' => '职位数据权限',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [
				//'ind_name' => ['type' => "normal", 'columns' => ['test']],
				//'ind_age' => ['type' => "normal", 'columns' => ['test002']],
			],
		],
        'sys_user' => [
            //表名
            'table_name' => 'sys_user',
            //表注释
            'comment' => '[系统]系统用户',
            'engine' => 'InnoDB',
            'charset' => 'utf8mb4',
            'collate' => 'utf8mb4_general_ci',
            //字段信息
            'columns' => [
                'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
                'is_rank' => ['type' => 'int', 'length' => 2, 'required' => true, 'default' => 1, 'comment' => '是否参与排名',],
            ],
            //主键 多个主键['user_id','name']
            'primary' => ['id'],
            //索引
            'index' => [
                //'ind_name' => ['type' => "normal", 'columns' => ['test']],
                //'ind_age' => ['type' => "normal", 'columns' => ['test002']],
            ],
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
				'bus_type_name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '业务类型名称',],
				'uniquekey' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '业务提醒标识',],

				'remind_time' => ['type' => 'datetime', 'required' => false, 'comment' => '提醒处理时间',],

				'deal_time' => ['type' => 'datetime', 'required' => false, 'comment' => '业务处理时间',],
				'deal_remark' => ['type' => 'varchar', 'length' => 1024, 'required' => true, 'default' => '', 'comment' => '备注说明',],
				'deal_status' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '0=待处理，1=已经处理',],
				'deal_user_id' => ['type' => 'int', 'length' => 16, 'required' => true, 'default' => 0, 'comment' => '提醒处理人员',],

				'remind_status' => ['type' => 'int', 'length' => 16, 'required' => 2, 'default' => 1, 'comment' => '0=未提醒，1=提醒中，2=不提醒了',],
				'remind_sms' => ['type' => 'int', 'length' => 2, 'required' => true, 'default' => 0, 'comment' => '短信提醒 0=不开启，1=开启',],
				'remind_sys' => ['type' => 'int', 'length' => 2, 'required' => 2, 'default' => 0, 'comment' => '系统提醒 0=不开启，1=开启',],
				'remind_email' => ['type' => 'int', 'length' => 2, 'required' => 2, 'default' => 0, 'comment' => '邮箱提醒 0=不开启，1=开启',],
				'remind_weixin' => ['type' => 'int', 'length' => 2, 'required' => 2, 'default' => 0, 'comment' => '微信提醒 0=不开启，1=开启',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名 系统消息配置
		'sys_msg_type' => [
			'table_name' => 'sys_msg_type',
			'comment' => '[oask]系统消息配置',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '业务类型名称',],
				'type' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '业务类型标识',],
				'maintable' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '业务主要表',],
				'url' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '业务详细地址',],
				'remark' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '事件说明',],

				'hours' => ['type' => 'int', 'length' => 11, 'required' => true, 'default' => 0, 'comment' => '提前多小时提醒',],
				'remind_sms' => ['type' => 'int', 'length' => 2, 'required' => true, 'default' => 0, 'comment' => '短信提醒 0=不开启，1=开启',],
				'remind_sys' => ['type' => 'int', 'length' => 2, 'required' => 2, 'default' => 0, 'comment' => '系统提醒 0=不开启，1=开启',],
				'remind_email' => ['type' => 'int', 'length' => 2, 'required' => 2, 'default' => 0, 'comment' => '邮箱提醒 0=不开启，1=开启',],
				'remind_weixin' => ['type' => 'int', 'length' => 2, 'required' => 2, 'default' => 0, 'comment' => '微信提醒 0=不开启，1=开启',],

				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],

			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],


		//表名 公告
		'oa_notify' => [
			'table_name' => 'oa_notify',
			'comment' => '[系统]系统公告',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'name' => ['type' => 'varchar', 'length' => 256, 'required' => true, 'default' => '', 'comment' => '标题',],
				'content' => ['type' => 'varchar', 'length' => 2560, 'required' => true, 'default' => '', 'comment' => '内容',],
				'rece_type' => ['type' => 'int', 'length' => 2, 'required' => true, 'default' => 0, 'comment' => '接收类型0=全体人员，1=指定人员',],
				'rece_user_id' => ['type' => 'varchar', 'length' => 2560, 'required' => true, 'default' => '', 'comment' => '接收对象',],
				'rece_user_name' => ['type' => 'varchar', 'length' => 2560, 'required' => true, 'default' => '', 'comment' => '接收对象名称',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'create_user_id' => ['type' => 'int', 'length' => 11, 'required' => true, 'default' => 0, 'comment' => '创建人员id',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

		//表名公告映射用户
		'oa_notify_user' => [
			'table_name' => 'oa_notify_user',
			'comment' => '[系统]系统公告用户',
			'engine' => 'InnoDB',
			'charset' => 'utf8mb4',
			'collate' => 'utf8mb4_general_ci',
			//字段信息
			'columns' => [
				'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '主id',],
				'notify_id' => ['type' => 'int', 'length' => 11, 'required' => true, 'default' => 0, 'comment' => '公告id',],
				'owner_user_id' => ['type' => 'int', 'length' => 11, 'required' => true, 'default' => 0, 'comment' => '接收人员id',],
				'read_state' => ['type' => 'int', 'length' => 2, 'required' => true, 'default' => 0, 'comment' => '是否读过',],
				'read_time' => ['type' => 'datetime',  'required' => false,  'comment' => '查看时间',],
				'create_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '创建日期',],
				'update_time' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 0, 'comment' => '更新日期',],
				'org_id' => ['type' => 'int', 'length' => 16, 'required' => false, 'default' => 1, 'comment' => '企业编号',],
			],
			//主键 多个主键['user_id','name']
			'primary' => ['id'],
			//索引
			'index' => [],
		],

	]// end table

];