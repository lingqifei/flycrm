<?php
/*
*
* meeting.controller  控制器
*
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright Copyright (C) 2017-2025 07FLY Network Technology Co,LTD.
* @license For licensing, see LICENSE.html or http://www.07fly.xyz/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.1.0
* @link ：http://www.07fly.xyz
* @Date:2022-12-20 09:50:11
*/

namespace app\meeting\controller;

use app\common\controller\ControllerBase;

/**
 * 模块基类
 */
class MetSummary extends MeetingBase
{
    public function __construct()
    {
        // 执行父类构造方法
        parent::__construct();
        $room_list = $this->logicMetRoom->getMetRoomList([], true, true, false);
        $this->assign('room_list', $room_list);
    }

    /**
     * 会议室纪要列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        return $this->fetch('show');
    }

    /**
     * 会议室纪要列表-》json数据
     * @return
     */
    public function show_json()
    {
        $where = $this->logicMetSummary->getWhere($this->param);
        $orderby = $this->logicMetSummary->getOrderby($this->param);
        $list = $this->logicMetSummary->getMetSummaryList($where, true, $orderby);
        return $list;
    }


    /**
     * 会议室纪要添加
     * @return mixed|string
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicMetSummary->metSummaryAdd($this->param));

        return $this->fetch('add');
    }

    /**
     * 会议室纪要编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicMetSummary->metSummaryEdit($this->param));

        $info = $this->logicMetSummary->getMetSummaryInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 会议室纪要删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicMetSummary->metSummaryDel($where));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicMeetingBase->setField('MetSummary', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicMeetingBase->setSort('MetSummary', $this->param));
    }
}

?>