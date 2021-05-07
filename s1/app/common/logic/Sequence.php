<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Agencyor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\common\logic;

/**
 * 序列 逻辑
 */
class Sequence extends LogicBase
{
    
    /**
     * 返回项目序号
     * @param $device_name 前缀 + 日期
     * @@param  $len 长度
     * @param  $separate 分隔号
     * @return  string  TD20191204-0004
     */
    public function getUniqueNo($device_name ='T', $len = '4',$separate= '-',$date='')
    {
        $date=empty($date)?date('Ymd',time()):date('Ymd',strtotime($date));

        $where['name']=['=',$device_name];
        $where['current_date']=['=',$date];

        $curid= $this->modelSequence->stat($where, 'max','current_value');

        $add_id=$curid+1;
        if($curid==0){
            $up_data=[
                'name'=>$device_name,
                'current_date'=>$date,
                'current_value'=>$add_id,
                'org_id'=>SYS_ORG_ID
            ];
            $this->modelSequence->save($up_data);
        }else{
            $up_data=[
                'current_value'=>$add_id,
            ];
            $this->modelSequence->save($up_data,$where);
        }

        $strMaxId=$device_name.$date.$separate.str_pad($add_id,$len,'0',STR_PAD_LEFT );

        return $strMaxId;

    }

}