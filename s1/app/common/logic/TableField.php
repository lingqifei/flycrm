<?php
// +----------------------------------------------------------------------
// | 07FLYCRM [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | Professional because of focus  Persevering because of happiness
// +----------------------------------------------------------------------
// | Author: 开发人生 <goodkfrs@qq.com>
// +----------------------------------------------------------------------


namespace app\common\logic;

use PDO;
use think\Model;
use think\Db;

/**
 *
 * 数据表字段处理
 */
class TableField extends LogicBase
{

    //增加字段
    public function add_field($table, $fieldname, $type, $maxlength, $default = NULL, $desc = NULL)
    {
        $field_exits = $this->check_field($table, $fieldname);
        if (!$field_exits) {
            if ($type == 'varchar') {
                empty($default) && $default = '';
                empty($maxlength) && $maxlength = '256';
                $sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` varchar($maxlength) DEFAULT '{$default}' COMMENT '$desc'";

            } elseif ($type == 'textarea') {

                empty($default) && $default = '';
                empty($maxlength) && $maxlength = '1024';
                $sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` varchar($maxlength) DEFAULT '{$default}' COMMENT '$desc'";

            } elseif ($type == 'htmltext') {

                $sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` text COMMENT '$desc'";

            } elseif ($type == 'int') {

                empty($default) && $default = '0';
                empty($maxlength) && $maxlength = '11';
                $sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` int($maxlength) default 0 COMMENT '$desc'";

            } elseif ($type == 'float') {

                empty($default) && $default = '0';
                $default = (float)$default;
                $sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` decimal(20,2)  default 0.00 COMMENT '$desc'";

            } elseif ($type == 'datetime') {

                $sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` datetime NULL COMMENT '$desc'";

            } elseif ($type == 'date') {

                $sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` date NULL COMMENT '$desc'";

            } else {

                empty($default) && $default = '';
                empty($maxlength) && $maxlength = '256';

                $sql = "ALTER TABLE `$table` ADD COLUMN `$fieldname` varchar($maxlength) COMMENT '$desc'";

            }
            Db::execute($sql);
            return [RESULT_SUCCESS, '添加成功'];
        } else {
            throw_response_error('数据字段已经存在');
        }
    }

    /**
     * 修改字段
     * @param $table  表名
     * @param $fieldname 字段名
     * @param $type  数据类型
     * @param $maxlength  最大值
     * @param $default 默认值
     * @param $desc 字段描述
     * @return array
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/4/8 8:27
     */
    public function modify_field($table, $fieldname, $type, $maxlength = '', $default = '', $desc = '')
    {
        //判断字段是否存在
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
            empty($default) && $default = '';

            $sql = "ALTER TABLE `$table` {$execaction} `$fieldname` varchar($maxlength)	 DEFAULT '{$default}' COMMENT '$desc'";

        } elseif ($type == 'textarea') {

            empty($default) && $default = '';
            empty($maxlength) && $maxlength = '1024';

            $sql = "ALTER TABLE `$table` {$execaction} `$fieldname` varchar($maxlength)  DEFAULT '{$default}' COMMENT '$desc'";

        } elseif ($type == 'htmltext') {

            $sql = "ALTER TABLE `$table` {$execaction} `$fieldname` text  DEFAULT NULL COMMENT '$desc'";

        } elseif ($type == 'int') {

            empty($default) && $default = '0';

            empty($maxlength) && $maxlength = '11';

            $sql = "ALTER TABLE `$table` {$execaction} `$fieldname` int($maxlength)  DEFAULT {$default} COMMENT '$desc'";

        } elseif ($type == 'float') {

            empty($default) && $default = '0';

            empty($maxlength) && $maxlength = '16';

            $sql = "ALTER TABLE `$table` {$execaction} `$fieldname` decimal(20,2)  DEFAULT {$default} COMMENT '$desc'";

        } elseif ($type == 'datetime') {

            $sql = "ALTER TABLE `$table` {$execaction} `$fieldname` datetime DEFAULT NULL COMMENT '$desc'";

        } elseif ($type == 'date') {

            $sql = "ALTER TABLE `$table` {$execaction} `$fieldname` date DEFAULT NULL COMMENT '$desc'";

        } else {

            empty($maxlength) && $maxlength = '256';

            $sql = "ALTER TABLE `$table` {$execaction} `$fieldname` varchar($maxlength) DEFAULT '{$default}' COMMENT '$desc'";

        }
        Db::execute($sql);
    }

    //删除字段
    public function del_field($table, $fieldname)
    {
        //检查表
        $result = $this->check_table($table);
        //检查字段
        $field_exits = $this->check_field($table, $fieldname);
        if ($result && $field_exits) {
            $sql = "ALTER TABLE `$table` DROP `$fieldname`";
            $result = Db::execute($sql);
            return $result ? [RESULT_SUCCESS, '添加成功'] : [RESULT_ERROR, '添加失败'];
        } else {
            return [RESULT_ERROR, '创建表' . $table . '成功'];
        }
    }

    //创建表
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

    //删除表
    public function drop_table($table)
    {
        $result = $this->check_table($table);
        if ($result) {
            $sql = "drop table `$table`;";
            $result = Db::execute($sql);
            return $result ? [RESULT_SUCCESS, '删除表' . $table . '成功'] : [RESULT_ERROR, '删除表' . $table . '失败'];
        }
    }

    //查询表
    public function check_table($table)
    {
        return Db::query('SHOW TABLES LIKE ' . "'" . $table . "'");

    }

    //检查表字段是否存在
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
     * 获得表字段信息
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
