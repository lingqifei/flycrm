<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.top
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */
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
        
        foreach ($list as $vo)
        {
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
        
        $cache_key = 'cache_region_' . md5(serialize($where));
        
        $cache_list = cache($cache_key);
        
        if (!empty($cache_list)) : return $cache_list; endif;
        
        $list = Db::name('region')->where($where)->field(true)->select();
        !empty($list) && cache($cache_key, $list);
        
        return $list;
    }
}
