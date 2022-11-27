<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */


namespace app\common\model;

use PDO;
use think\Model;
use think\Db;

/**
 * 模型基类
 */
class ModelBase extends Model
{

    /**
     * 连接查询
     */
    protected $join = [];

    // 保存自动完成列表
//    protected $auto = [
//        'org_id'=>SYS_ORG_ID,
//    ];
    /**
     * 状态获取器
     */
//    public function getStatusTextAttr()
//    {
//
//        $status = [DATA_DELETE => '删除', DATA_DISABLE => "<span class='badge bg-red'>禁用</span>", DATA_NORMAL => "<span class='badge bg-green'>启用</span>"];
//
//        return $status[$this->data[DATA_STATUS_NAME]];
//    }

    /**
     * 设置数据
     */
    final protected function setInfo($data = [], $where = [])
    {

        $this->updateCache($this);

        $pk = $this->getPk();

        if (empty($data[$pk])) {

            if (empty($where)) {

                empty($data[TIME_CT_NAME]) && $data[TIME_CT_NAME] = time();

                DATA_ORG_STATUS && empty($data[DATA_ORG_NAME]) && $data[DATA_ORG_NAME] = SYS_ORG_ID;

                return Db::name($this->name)->insertGetId($data);
            }
            return $this->updateInfo($where, $data);

        } else {

            is_object($data) && $data = $data->toArray();


            !empty($data[TIME_CT_NAME]) && is_string($data[TIME_CT_NAME]) && $data[TIME_CT_NAME] = strtotime($data[TIME_CT_NAME]);

            $default_where[$pk] = $data[$pk];

            return $this->updateInfo(array_merge($default_where, $where), $data);
        }
    }

    /**
     * 更新数据
     */
    final protected function updateInfo($where = [], $data = [])
    {

        $data[TIME_UT_NAME] = TIME_NOW;

        $this->updateCache($this);

        return $this->allowField(true)->save($data, $where);

    }

    /**
     * 统计数据
     */
    final protected function stat($where = [], $stat_type = 'count', $field = 'id')
    {

        return $this->where($where)->$stat_type($field);
    }

    /**
     * 设置数据列表
     */
    final protected function setList($data_list = [], $replace = false)
    {

        $return_data = $this->saveAll($data_list, $replace);

        $this->updateCache($this);

        return $return_data;
    }

    /**
     * 设置某个字段值
     */
    final protected function setFieldValue($where = [], $field = '', $value = '')
    {

        $this->updateCache($this);

        return $this->updateInfo($where, [$field => $value]);
    }

    /**
     * 设置某个字段值自增自减  2022-09-13
     */
    final protected function setCalc($where = [], $data_list = '')
    {
        $this->updateCache($this);
        foreach ($data_list as $keyFeild=>$row){
            if($row[0]=='inc'){
                Db::name($this->name)->where($where)->setInc($keyFeild, $row[1]);
            }elseif ($row[0]=='dec'){
                Db::name($this->name)->where($where)->setDec($keyFeild, $row[1]);
            }
        }
    }

    /**
     * 删除数据
     */
    final protected function deleteInfo($where = [], $is_true = false)
    {

        $this->updateCache($this);

        if ($is_true) {

            $return_data = $this->where($where)->delete();

        } else {

            $return_data = $this->setFieldValue($where, DATA_STATUS_NAME, DATA_DELETE);
        }

        return $return_data;
    }

    /**
     * 获取某个列的数组
     */
    final protected function getColumn($where = [], $field = '', $key = '')
    {

        return Db::name($this->name)->where($where)->column($field, $key);
    }

    /**
     * 获取某个字段的值
     */
    final protected function getValue($where = [], $field = '', $default = null, $force = false)
    {

        return Db::name($this->name)->where($where)->value($field, $default, $force);
    }

    /**
     * 获取单条数据
     */
    final protected function getInfo($where = [], $field = true)
    {

        $query = !empty($this->join) ? $this->join($this->join) : $this;

        $lqf_auto_cache_key = $this->getCacheKey($this, $query, $where, $field);

        $is_update_cache = $this->checkCacheVersion($this, $query);

        if (!empty($lqf_auto_cache_key) && !$is_update_cache && !empty($cache_data = cache($lqf_auto_cache_key))) {

            return $cache_data;
        }

        $info = $query->where($where)->field($field)->find();

        $this->setCache($this, $info, $lqf_auto_cache_key);

        $this->join = [];

        return $info;
    }

    /**
     * 获取列表数据
     * 若不需要分页 $paginate 设置为 false
     */
    final protected function getList($where = [], $field = true, $order = '', $paginate = 0)
    {
        list($query, $where_temp) = $this->getListQuery($this, $where);

        $lqf_auto_cache_key = $this->getCacheKey($this, $query, $where_temp, $field, $order, $paginate);

        $is_update_cache = $this->checkCacheVersion($this, $query);

        if (!empty($lqf_auto_cache_key) && !$is_update_cache && !empty($cache_data = cache($lqf_auto_cache_key))) {

            return $cache_data;
        }

        $query_temp = $query->where($where_temp)->order($order)->field($field);

        !empty($this->limit) && $query_temp->limit($this->limit);
        !empty($this->group) && $query_temp->group($this->group);

        if (false === $paginate) {

            $list = $query_temp->select();

        } else {
            $pagesize= request()->param("pageSize");
            $pagesize && $paginate=$pagesize;
            $list = $query_temp->paginate(input('list_rows', empty($paginate) ? DB_LIST_ROWS : $paginate), false, ['query' => request()->param()]);
        }

        $this->join = [];
        $this->limit = [];
        $this->group = [];

        $this->setCache($this, $list, $lqf_auto_cache_key);

        return $list;
    }

    /**
     * 获取列表查询query对象，增加共用字段
     * query 為對像
     * where 為條件
     */
    final protected function getListQuery($obj = null, $where = [])
    {

        if (empty($obj->join)) {

            //非超管受限制
            DATA_ORG_STATUS && !IS_ROOT  && !isset($where[DATA_ORG_NAME]) && $where[DATA_ORG_NAME] = ['eq', SYS_ORG_ID];

            $query = $obj;

        } else {

            //非超管受限制
            DATA_ORG_STATUS && !IS_ROOT &&  !isset($where['a.'.DATA_ORG_NAME]) && $where['a.'.DATA_ORG_NAME] = ['eq', SYS_ORG_ID];

            $query = $obj->join($obj->join);
        }

        return [$query, $where];
    }

    /**
     * 原生查询
     */
    final protected function query($sql = '')
    {

        return Db::query($sql);
    }

    /**
     * 原生执行
     */
    final protected function execute($sql = '')
    {

        return Db::execute($sql);
    }

    /**
     * 更新缓存
     */
    final protected function updateCache($obj = null)
    {

        config('is_auto_cache') && !isset($obj->is_update_cache_version) && update_cache_version($obj);
    }

    /**
     * 清除多表缓存
     */
    final protected function clearTablesCache($tables = [])
    {

        $lqf_auto_cache_keys = cache('lqf_auto_cache_keys');

        foreach ($lqf_auto_cache_keys as $k => $v) {

            foreach ($tables as $vv) {

                $pos = strpos($v, $vv);

                if ($pos !== false) {

                    cache($v, null);

                    unset($lqf_auto_cache_keys[$k]);
                }
            }
        }

        cache('lqf_auto_cache_keys', array_values($lqf_auto_cache_keys));
    }

    /**
     * 写入缓存
     */
    final protected function setCache($obj = null, $data = [], $lqf_auto_cache_key = '')
    {

        if (config('is_auto_cache') && !isset($obj->no_auto_cache) && !empty($lqf_auto_cache_key)) {

            !empty($data) && cache($lqf_auto_cache_key, $data, config('auto_cache_time'));
        }
    }

    /**
     * 获取缓存
     */
    final protected function getCacheKey($obj = null, $query = null, $where = [], $field = true, $order = null, $paginate = null)
    {

        if (!config('is_auto_cache') || isset($obj->no_auto_cache)) {
            return [];
        }

        //防止$where为非数组类型，报错 2021-07-30
        !is_array($where) && $where=[];

        $where['field'] = $field;

        isset($order) && $where['order'] = $order;
        isset($paginate) && $where['paginate'] = $paginate;

        $lqf_auto_cache = cache('lqf_auto_cache');

        $table_name = $query->getTable();

        unset($lqf_auto_cache[$table_name]['data_version']);

        $table_arr = $this->getTableArray($obj);

        $temp_str = arr22str($obj->join);

        $temp_str = $table_name . json_encode($obj) . json_encode($where) . json_encode($lqf_auto_cache[$table_name]);

        isset($order) && $temp_str .= json_encode(request()->param());

        $ck = arr2str($table_arr, '*') . '$' . md5($temp_str);

        $lqf_auto_cache_keys = cache('lqf_auto_cache_keys');

        //修改兼容非数组报错
        if (is_array($lqf_auto_cache_keys) && !in_array($ck, $lqf_auto_cache_keys)) {

            $lqf_auto_cache_keys[] = $ck;

            cache('lqf_auto_cache_keys', $lqf_auto_cache_keys);
        }

        return $ck;
    }

    /**
     * 获取表数组
     */
    final protected function getTableArray($obj = null)
    {

        $temp_str = arr22str($obj->join);

        $preg = SYS_DS_PROS . SYS_DB_PREFIX . '[\s\S]*? /i';

        $res_data = [];

        preg_match_all($preg, $temp_str, $res_data);

        $table_arr = [];

        foreach ($res_data[DATA_DISABLE] as $v) {

            $table_arr[] = sr($v, ' ');
        }

        return $table_arr;
    }

    /**
     * 检查缓存版本
     */
    final protected function checkCacheVersion($obj = null, $query = null)
    {

        if (!config('is_auto_cache') || isset($obj->no_auto_cache)) {
            return true;
        }

        $table_name = $query->getTable();

        $table_arr = $this->getTableArray($obj);

        $table_arr[] = $table_name;

        $lqf_auto_cache_data = cache('lqf_auto_cache');

        $is_update = false;

        foreach ($table_arr as $v) {

            if(!empty($lqf_auto_cache_data[$v]['version'])){
                if ($lqf_auto_cache_data[$v]['version'] != $lqf_auto_cache_data[$v]['data_version']) {

                    $is_update = true;

                    $lqf_auto_cache_data[$v]['data_version'] = $lqf_auto_cache_data[$v]['version'];
                }
            }
        }

        cache('lqf_auto_cache', $lqf_auto_cache_data);

        $is_update && $this->clearTablesCache($table_arr);

        return $is_update;
    }

    /**
     * 重写获取器 兼容 模型|逻辑|验证|服务 层实例获取
     */
    public function __get($name)
    {

        $layer = $this->getLayerPrefix($name);

        if (false === $layer) {

            return parent::__get($name);
        }

        $model = sr($name, $layer);

        return LAYER_VALIDATE_NAME == $layer ? validate($model) : model($model, $layer);
    }

    /**
     * 获取层前缀
     */
    public function getLayerPrefix($name)
    {

        $layer = false;

        $layer_array = [LAYER_MODEL_NAME, LAYER_LOGIC_NAME, LAYER_VALIDATE_NAME, LAYER_SERVICE_NAME];

        foreach ($layer_array as $v) {
            if (str_prefix($name, $v)) {

                $layer = $v;

                break;
            }
        }

        return $layer;
    }
}
