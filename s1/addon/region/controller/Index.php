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
namespace addon\region\controller;

use app\common\controller\AddonBase;
use addon\region\logic\Index as LogicIndex;

/**
 * 区域选择控制器
 */
class Index extends AddonBase
{

    // 区域选择逻辑
    private static $regionIndexLogic = null;
    
    /**
     * 构造方法
     */
    public function _initialize()
    {
        
        parent::_initialize();
        
        self::$regionIndexLogic = get_sington_object('regionIndexLogic', LogicIndex::class);
    }
    
    /**
     * 获取选项信息
     */
    public function getOptions()
    {
        
        $where['upid']      = input('upid', DATA_DISABLE);
        $where['level']     = input('level', DATA_NORMAL);
        
        $select_id = input('select_id', DATA_DISABLE);
        
        $list = self::$regionIndexLogic->getList($where);
        
        switch ($where['level'])
        {
            case 1: $default_option_text = "---请选择省份---"; break;
            case 2: $default_option_text = "---请选择城市---"; break;
            case 3: $default_option_text = "---请选择区县---"; break;
            default: $this->error('省市县 level 不存在');
        }
        
        $data = self::$regionIndexLogic->combineOptions($select_id, $list, $default_option_text);
        
        return $this->result($data);
    }
    
}
