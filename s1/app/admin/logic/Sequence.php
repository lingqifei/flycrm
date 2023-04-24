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

namespace app\admin\logic;

/**
 * 序列 逻辑
 */
class Sequence extends AdminBase
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