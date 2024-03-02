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

namespace addon\region\logic;

use think\Db;

/**
 * 省市县三级联动插件逻辑
 */
class Index
{

    /**
     * 组合下拉框选项信息
     */
    public function combineOptions($id = 0, $list = [], $default_option_text = '')
    {
        $data = "<option value =''>$default_option_text</option>";
        foreach ($list as $vo) {
            $data .= "<option ";
            if ($id == $vo['id']) : $data .= " selected "; endif;
            $data .= " value ='" . $vo['id'] . "'>" . $vo['name'] . "</option>";
        }
        return $data;
    }

    /**
     * 获取区域列表
     */
    public function getList($where = [])
    {

//        $cache_key = 'cache_region_' . md5(serialize($where));
//
//        $cache_list = cache($cache_key);
//
//        if (!empty($cache_list)) : return $cache_list; endif;
dlog($where);
        $list = Db::name('region')->where($where)->field(true)->select();
//        !empty($list) && cache($cache_key, $list);

        return $list;
    }
}
