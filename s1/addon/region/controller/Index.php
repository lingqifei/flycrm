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
        $where['upid'] = input('upid', DATA_DISABLE);
        $where['level'] = input('level', DATA_NORMAL);

        $select_id = input('select_id', DATA_DISABLE);

        $list = self::$regionIndexLogic->getList($where);

        switch ($where['level']) {
            case 1:
                $default_option_text = "---请选择省份---";
                break;
            case 2:
                $default_option_text = "---请选择城市---";
                break;
            case 3:
                $default_option_text = "---请选择区县---";
                break;
            default:
                $this->error('省市县 level 不存在');
        }
        $data = self::$regionIndexLogic->combineOptions($select_id, $list, $default_option_text);
        return $this->result($data);
    }

}
