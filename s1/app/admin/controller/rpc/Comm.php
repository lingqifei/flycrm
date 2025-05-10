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

namespace app\admin\controller\rpc;

use app\common\controller\ControllerBase;

/**
 * 计划任务执行脚本
 */
class Comm extends ControllerBase
{
    /**
     * 获取列表字段
     * @return array
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2025/1/7 10:01
     */
    public function getTableColumn()
    {
        $filename = PATH_DATA . 'column.json';
        $tablename = $this->param['table'];
        $column = [];
        if (!empty($this->param['column'])) {
            $column = $this->param['column'];
        }
        // 检查文件是否存在
        if (!file_exists($filename)) {
            // 文件不存在，创建一个新的空数组并保存到文件
            $data = [];
        } else {
            // 文件存在，读取文件内容
            $content = file_get_contents($filename);
            $data = json_decode($content, true); // 将 JSON 字符串转换为关联数组
            if ($data === null) {
                // 如果文件内容不是有效的 JSON，初始化为空数组
                $data = [];
            }
        }
        //当有值传过来，保存更新数据
        if (!empty($column)) {
            $data[$tablename] = $column;
            // 将更新后的数据写回文件
            $newContent = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents($filename, $newContent);
            return ['code' => 1, 'msg' => 'Success', 'data' => $data[$tablename]];
        } else {
            // 检查是否存在指定的 tablename 数组
            if (!isset($data[$tablename])) {
                return ['code' => 1, 'msg' => 'No data found', 'data' => []];;
            } else {
                return ['code' => 1, 'msg' => 'Success', 'data' => $data[$tablename]];
            }
        }
    }
}
