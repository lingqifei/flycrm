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
 * 地区管理逻辑
 */
class SysAreaUser extends AdminBase
{

    /**
     *
     * @param $task_id
     * @param $sys_user_id
     * @param string $major
     * @return array
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/8/18 0018
     */
    public function sysAreaUserAdd($sys_area_id, $sys_user_id)
    {
        if(is_array($sys_user_id)){
            $sys_user_arr=$sys_user_id;
        }else{
            $sys_user_arr=explode(',',$sys_user_id);
        }
        $this->modelSysAreaUser->deleteInfo(['sys_area_id'=>$sys_area_id],true);
        $result=true;
        foreach ($sys_user_arr as $user_id){
            if(!empty($user_id)){
                $data_tmp=[
                    'sys_area_id'=>$sys_area_id,
                    'sys_user_id'=>$user_id,
                    'create_user_id'=>SYS_USER_ID,
                ];
                $result = $this->modelSysAreaUser->setInfo($data_tmp);
            }
        }
        //$result = $this->modelOaTaskStaff->setList($data_list);
        $url = url('show');
        $result && action_log('新增', '新增地区管理人员：人员编号' . http_build_query($sys_user_arr));
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSysAreaUser->getError()];
    }

}