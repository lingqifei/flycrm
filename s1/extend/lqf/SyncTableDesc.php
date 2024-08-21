<?php
//根据配置信息生成数据库表结构
namespace lqf;
use think\Db;

//同步数据库表结构
class SyncTableDesc
{

    private $info;//配置信息
    private $prefix = '';//表前缀
    private $tableName = null;//表名(指定表名)

    public function __construct($info, $prefix = '', $tableName = null)
    {
        $this->info = $info;
        $this->prefix = $prefix;
        $this->tableName = $tableName == null ? null : explode(",", $tableName);
    }

    /**
     * 生成表的数据
     * @return bool
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/8/2 0002 18:28
     */
    public function generate()
    {
        $this->prefix;
        $tables = $this->info['tables'];
        if (!empty($tables)) {
            foreach ($tables as $tableName => $tableArr) {
                //d($tables);
                $tableName = $this->prefix . $tableArr['table_name'];//前缀+表名拼成完整表名
                //$tableName = $this->prefix.$tableName;
                if ($this->tableName != null && !in_array($tableName, $this->tableName)) {
                    continue;
                }

                $hasTable = Db::query("SHOW TABLES LIKE '{$tableName}'");//判断表是否存在
                if (count($hasTable) != 0) {
                    $this->upTableFields($tableArr);
                    //echo "table:$tableName---->update OK\n";
                    //return  true;
                } else {
                    $res = $this->assemblySql($tableArr);
                    if ($res < 0) {
                        throw new \LogicException($res . ":");
                    }
                    //echo "table:$tableName---->add OK\n";
                    //return true;
                }
            }
        }
        return true;
    }

    /**
     * 更新表的字段
     * @param $tableArr
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/8/2 0002 18:27
     */
    public function upTableFields($tableArr)
    {
        $tableName = $this->prefix . $tableArr['table_name'];
        $columns = $tableArr['columns'];
        $fieldSqlArr = [];
        foreach ($columns as $field => $info) {
            $resData = Db::query(" desc `{$tableName}` `{$field}`");//查询表现有的字段信息
            //当存在时
            if (count($resData) != 0) {

                $fieldObj = $resData[0];
                $fieldSql = $this->fieldInfo($field, $info, $tableArr, true);
                $fieldSqlArr[] = " change `{$field}` " . $fieldSql;

                if ($fieldObj['Key'] == "PRI" && $fieldObj['Extra'] == "auto_increment") {
                    $fieldSql = str_replace("AUTO_INCREMENT", "", $fieldSql);//删除自增及主键，方便面删除主键
                    Db::execute("alter table `{$tableName}` modify {$fieldSql}");
                }

            } else {
                //不存在的字段直接新增
                $addFieldSql = "alter table {$tableName} add  ";
                $fieldSql = $this->fieldInfo($field, $info, $tableArr, true);
                $addFieldSql .= " $fieldSql";
                $res = Db::execute($addFieldSql);
                if ($res < 0) {
                    throw new \LogicException("{$tableName}表下新增字段{$field}失败！:");
                }
            }
        }

        //更新主键=》删除主键
        $tabledesc = Db::query("desc {$tableName}");
        $keyArr = array_column($tabledesc, 'Key');
        if (in_array("PRI", $keyArr)) {
            $res = Db::execute("alter table `{$tableName}` drop primary key");
            //echo '<br>PRI'.$res;
            if ($res < 0) {
                throw new \LogicException("{$tableName}:主键删除失败:" . Db::error);
            }
        }
        //操作主键
        $primaryKeys = [];
        foreach ($tableArr['primary'] as $val) {
            $primaryKeys[] = "`" . $val . "`";
        }
        $primaryKeys = implode(",", $primaryKeys);
        $res = Db::execute("alter table `{$tableName}` add primary key($primaryKeys)");
        //echo '<br>pK'.$res;
        if ($res < 0) {
            throw new \LogicException("更新主键错误！");
        }

        //修改表字段
        if (count($fieldSqlArr) > 0) {
            $batchUpFieldSql = "alter table `{$tableName}` ";
            $batchUpFieldSql .= implode(",", $fieldSqlArr);
            $res = Db::execute($batchUpFieldSql);
            //echo '<br>Sql'.$res;
            if ($res < 0) {
                throw new \LogicException("修改表字段出现错误:");
            }
        }

        //更新索引
        $indexRes = Db::query("show index from `{$tableName}`");
        if (count($indexRes) > 0) {
            $indexRes = array2unique_bykey($indexRes, 'Key_name');
            foreach ($indexRes as $indexReKey => $indexReRow) {
                if ($indexReRow['Key_name'] != "PRIMARY") {
                    Db::execute("drop index {$indexReRow['Key_name']} on `{$tableName}`");
                }
            }
        }

        //索引
        foreach ($tableArr['index'] as $key => $value) {
            if (count($value) > 0) {
                $type = isset($value['type']) ? $value['type'] : "normal";
                $indexArr = [];
                foreach ($value['columns'] as $field) {
                    $indexArr[] = "`" . $field . "`";
                }
                $indexSt = implode(",", $indexArr);
                $indexType = $type == "unique" ? "UNIQUE" : "";

                $addIndexSql = "CREATE  {$indexType}  INDEX  {$key} ON  {$tableName}($indexSt)";
                $res = Db::execute($addIndexSql);
                //echo '<br>CIndex'.$res;
                if ($res < 0) {
                    throw new \LogicException("更新索引错误！");
                }
            }
        }

        //更新表搜索引擎
        if (isset($tableArr['engine']) && $tableArr['engine']) {
            $res = Db::execute("ALTER TABLE {$tableName} ENGINE={$tableArr['engine']}");
            //echo '<br>Eng'.$res;
            if ($res < 0) {
                throw new \LogicException("更新表搜索引擎错误！");
            }
        }
        //更新表编码
        if (isset($tableArr['charset']) && $tableArr['charset']) {
            $res = Db::execute(" alter table {$tableName} convert to character set {$tableArr['charset']}");
            //echo '<br>char'.$res;
            if ($res < 0) {
                throw new \LogicException("更新表编码错误！");
            }
        }

    }

    /**
     * 生成创建表的SQL
     * @param $tableArr
     * @return int
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/8/2 0002 18:27
     */
    private function assemblySql($tableArr)
    {
        $sql = "CREATE TABLE ";
        $sql .= $this->prefix . $tableArr['table_name'] . " ";

        //组装字段，
        //组装前：'id' => ['type' => 'int', 'length' => 16, 'unsigned' => false, 'autoincrement' => true, 'comment' => '关键id',],
        //组装后：id int(16) unsigned NOT NULL AUTO_INCREMENT COMMENT '关键id',
        $fieldArr = [];
        foreach ($tableArr['columns'] as $KeyFieldName => $fieldNameAttr) {
            $fieldArr[] = $this->fieldInfo($KeyFieldName, $fieldNameAttr, $tableArr, true);
        }
        //组装字段后面加主键字段
        //PRIMARY KEY (`id`)
        $primaryKeys = [];
        foreach ($tableArr['primary'] as $val) {
            $primaryKeys[] = "`" . $val . "`";
        }
        $primaryKeys = implode(",", $primaryKeys);
        $fieldArr[] = "PRIMARY KEY ($primaryKeys)";

        //组装字段后面,增加索引
        foreach ($tableArr['index'] as $key => $value) {
            if (count($value) > 0) {
                $type = isset($value['type']) ? $value['type'] : "";
                $indexArr = [];
                foreach ($value['columns'] as $field) {
                    $indexArr[] = "`" . $field . "`";
                }
                $indexSt = implode(",", $indexArr);
                $indexType = $type == "unique" ? "UNIQUE" : "";
                $fieldArr[] = "{$indexType} KEY `{$key}` ({$indexSt})";
            }
        }

        //把数组字段转成字符串
        $fieldSql = implode(" , ", $fieldArr);
        $sql .= "(" . $fieldSql . ")";

        //引擎编码转换
        $sql .= $this->charsetInfo($tableArr);

        //表注释
        if (!empty($tableArr['comment'])) {
            $sql .= " COMMENT='{$tableArr['comment']}'";
        }
        return Db::execute($sql);
    }

    /**
     * 表字段字段转为字符串
     * @param $field
     * @param $fieldInfo
     * @param $tableArr
     * @param bool $isChange
     * @return string
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/8/2 0002 18:26
     */
    private function fieldInfo($field, $fieldInfo, $tableArr, $isChange = false)
    {
        $infoArr[] = "`" . $field . "`";

//		$fieldInfo['type'] ?: "varchar";
//		if (array_key_exists($fieldInfo['type'], $this->info['diy_field_type'])) {
//			$fieldInfo['type'] = $this->info['diy_field_type'][$fieldInfo['type']];
//		}

        if (array_key_exists("length", $fieldInfo)) {
            $infoArr[] = $fieldInfo['type'] . "(" . $fieldInfo['length'] . ")";
        } else {
            $infoArr[] = $fieldInfo['type'];
        }
        if (array_key_exists("unsigned", $fieldInfo) && $fieldInfo['unsigned'] === true) {
            $infoArr[] = 'UNSIGNED';
        }
        if (array_key_exists("autoincrement", $fieldInfo) && $fieldInfo['autoincrement'] === true) {
            $infoArr[] = 'AUTO_INCREMENT';
        }
        if (in_array($field, $tableArr['primary']) && !$isChange) {
            $infoArr[] = 'PRIMARY KEY';
        }
        if (array_key_exists("required", $fieldInfo) && $fieldInfo['required'] === true) {
            $infoArr[] = 'NOT NULL';
        }
        if (array_key_exists("default", $fieldInfo)) {
            $infoArr[] = "DEFAULT '" . $fieldInfo['default'] . "'";
        }
        if (array_key_exists("comment", $fieldInfo)) {
            $infoArr[] = "COMMENT '" . $fieldInfo['comment'] . "'";
        }
        return implode(" ", $infoArr);
    }

    /**
     * 编码转换成字符串
     * @param $tableArr
     * @return string
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/8/2 0002 18:24
     */
    private function charsetInfo($tableArr)
    {
        $engine = isset($tableArr['engine']) ? $tableArr['engine'] : "InnoDB";
        $charset = isset($tableArr['charset']) ? $tableArr['charset'] : "utf8mb4";
        $collate = isset($tableArr['collate']) ? $tableArr['collate'] : "utf8mb4_general_ci";
        $charsetSt = " ENGINE={$engine} CHARSET={$charset} COLLATE={$collate}";
        return $charsetSt;
    }
}