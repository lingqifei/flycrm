<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Channelor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\common\logic;

use PDO;
use think\Model;
use think\Db;

/**
 * 模型管理逻辑
 */
class TableField extends LogicBase
{

	//增加字段
	public function add_field($table, $fieldname, $type, $maxlength, $default = NULL, $desc = NULL)
	{
		$field_exits = $this->check_field($table, $fieldname);
		if (!$field_exits) {
			if ($type == 'varchar') {
				$sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` varchar($maxlength) COMMENT '$desc'";
			} elseif ($type == 'textarea') {
				$sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` varchar($maxlength) COMMENT '$desc'";
			} elseif ($type == 'htmltext') {
				$sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` text COMMENT '$desc'";
			} elseif ($type == 'int') {
				$sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` int(11) default 0.00 COMMENT '$desc'";
			} elseif ($type == 'float') {
				$sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` decimal(10,2) default 0.00 COMMENT '$desc'";
			} elseif ($type == 'datetime') {
				$sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` datetime COMMENT '$desc'";
			} elseif ($type == 'date') {
				$sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` date COMMENT '$desc'";
			} else {
				$sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` varchar($maxlength) COMMENT '$desc'";
			}
			Db::execute($sql);
			return [RESULT_SUCCESS, '添加成功'];

		} else {
			return [RESULT_ERROR, '字段已经存在'];
		}
	}

	//修改字段
	public function modify_field($table, $fieldname, $type, $maxlength = '', $default = '', $desc = '')
	{
		$field_exits = $this->check_field($table, $fieldname);

		//判断是添加还是修改
		if ($field_exits) {
			$execaction = 'MODIFY';
		} else {
			$execaction = 'ADD COLUMN';
		}
		//字段类型
		if ($type == 'varchar') {

			empty($maxlength) && $maxlength = '256';
			$sql = "ALTER TABLE `$table` {$execaction} `$fieldname` varchar($maxlength)	NOT NULL DEFAULT '{$default}' COMMENT '$desc'";

		} elseif ($type == 'textarea') {

			empty($default) && $default = '';

			empty($maxlength) && $maxlength = '256';

			$sql = "ALTER TABLE `$table` {$execaction} `$fieldname` varchar($maxlength) NULL DEFAULT NULL COMMENT '$desc'";

		} elseif ($type == 'htmltext') {

			$sql = "ALTER TABLE `$table` {$execaction} `$fieldname` text NULL DEFAULT NULL COMMENT '$desc'";

		} elseif ($type == 'int') {

			empty($default) && $default = '0';
			empty($maxlength) && $maxlength='10';
			$sql = "ALTER TABLE `$table` {$execaction} `$fieldname` int($maxlength) default {$default} COMMENT '$desc'";

		} elseif ($type == 'float') {

			empty($default) && $default = '0';
			empty($maxlength) && $maxlength='16';
			$sql = "ALTER TABLE `$table` {$execaction} `$fieldname` decimal(20,2) default {$default} COMMENT '$desc'";

		} elseif ($type == 'datetime') {

			$sql = "ALTER TABLE `$table` {$execaction} `$fieldname` datetime NULL DEFAULT NULL COMMENT '$desc'";

		} elseif ($type == 'date') {

			$sql = "ALTER TABLE `$table` {$execaction} `$fieldname` date NULL DEFAULT NULL COMMENT '$desc'";

		} else {

			empty($maxlength) && $maxlength='256';

			$sql = "ALTER TABLE `$table` {$execaction} `$fieldname` varchar($maxlength) NOT NULL DEFAULT '{$default}' COMMENT '$desc'";

		}
		Db::execute($sql);
		return [RESULT_SUCCESS, '添加成功'];

	}

	//增加字段
	public function del_field($table, $fieldname)
	{
		$result = $this->check_table($table);
		$field_exits = $this->check_field($table, $fieldname);
		if ($result && $field_exits) {
			$sql = "ALTER TABLE `$table` DROP `$fieldname`";
			$result = Db::execute($sql);
			return $result ? [RESULT_SUCCESS, '添加成功'] : [RESULT_ERROR, '添加失败'];
		} else {
			return [RESULT_ERROR, '创建表' . $table . '成功'];
		}
	}

	public function add_table($table, $sql)
	{
		$result = $this->check_table($table);
		if ($result) {
			return [RESULT_ERROR, '创建表' . $table . '已经存'];
		} else {
			Db::execute($sql);
			return [RESULT_SUCCESS, '创建表' . $table . '成功'];
		}
	}

	public function drop_table($table)
	{
		$result = $this->check_table($table);
		if ($result) {
			$sql = "drop table `$table`;";
			$result = Db::execute($sql);
			return $result ? [RESULT_SUCCESS, '删除表' . $table . '成功'] : [RESULT_ERROR, '删除表' . $table . '失败'];
		}
	}

	public function check_table($table)
	{
		return Db::query('SHOW TABLES LIKE ' . "'" . $table . "'");

	}

	//检查表字段是否存在
	// return true/false
	public function check_field($table, $colField)
	{
		$fields = $this->get_field($table);
		if (in_array($colField, $fields)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @param $table
	 * @return array
	 * @throws \think\db\exception\BindParamException
	 * @throws \think\exception\PDOException
	 */
	final protected function get_field($table)
	{
		return Db::table($table)->getTableFields();
	}
}
