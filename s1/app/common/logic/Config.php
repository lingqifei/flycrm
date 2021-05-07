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

namespace app\common\logic;

/**
 * 配置逻辑
 */
class Config extends LogicBase
{
    
    /**
     * 获取配置列表
     */
    public function getConfigList($where = [], $field = true, $order = '', $paginate = DB_LIST_ROWS)
    {
        
        $list=$this->modelConfig->getList($where, $field, $order, $paginate)->toArray();
        if($paginate===false) $list['data']=$list;
        foreach ($list['data'] as &$row){
            $row['group_text']=$this->getConfigGroup($row['group']);
            $row['type_text']=$this->getConfigType($row['type']);
        }
        return $list;
    }

    /**
     * 获取配置列表
     */
    public function getConfigListAll($where = [], $field = true, $order = '', $paginate = DB_LIST_ROWS)
    {

        $list=$this->modelConfig->getList($where, $field, $order, $paginate)->toArray();
        return $list;
    }

    /**
     * 获取配置列表过滤
     */
    public function getConfigListFilter($param = [])
    {
        
        $where = [];
        
        $group = empty($param['group']) ? DATA_DISABLE : (int)$param['group'];
        
        !empty($group) && $where['group'] = $group;
        
        !empty($param['search_data']) && $where['name|title'] = ['like', '%'.(string)$param['search_data'].'%'];
        
        $sort = 'sort asc, create_time desc';
        
        if (!empty($param['order_field'])) {

            $sort = empty($param['order_val']) ? $param['order_field'] . ' asc' : $param['order_field'] . ' desc';
        }
        
        $data['list'] = $this->getConfigList($where, true, $sort);
        
        $data['group'] = $group;
        
        return $data;
    }
    
    /**
     * 获取配置信息
     */
    public function getConfigInfo($where = [], $field = true)
    {
        
        return $this->modelConfig->getInfo($where, $field);
    }
    
    /**
     * 系统设置
     */
    public function settingSave($data = [])
    {
        
        foreach ($data as $name => $value)
        {
            
            $where = array('name' => $name);
            
            $this->modelConfig->updateInfo($where, ['value' => $value]);
        }
        
        action_log('设置', '系统设置保存');
        
        return [RESULT_SUCCESS, '设置保存成功'];
    }
    
    /**
     * 配置添加
     */
    public function configAdd($data = [])
    {
        
        $validate_result = $this->validateConfig->scene('add')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $this->validateConfig->getError()];
        }

        $result = $this->modelConfig->setInfo($data);
        
        $result && action_log('新增', '新增配置，name：' . $data['name']);
        $url = url('configList', array('group' => $data['group'] ? $data['group'] : 0));
        return $result ? [RESULT_SUCCESS, '配置添加成功', $url] : [RESULT_ERROR, $this->modelConfig->getError()];
    }
    
    /**
     * 配置编辑
     */
    public function configEdit($data = [])
    {
        
        $validate_result = $this->validateConfig->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $this->validateConfig->getError()];
        }

        $result = $this->modelConfig->setInfo($data);
        
        $result && action_log('编辑', '编辑配置，name：' . $data['name']);
        $url = url('configList', array('group' => $data['group'] ? $data['group'] : 0));
        return $result ? [RESULT_SUCCESS, '配置编辑成功', $url] : [RESULT_ERROR, $this->modelConfig->getError()];
    }
    
    /**
     * 配置删除
     */
    public function configDel($where = [])
    {
        
        $result = $this->modelConfig->deleteInfo($where,true);
        
        $result && action_log('删除', '删除配置，where：' . http_build_query($where));
        
        return $result ? [RESULT_SUCCESS, '菜单删除成功'] : [RESULT_ERROR, $this->modelConfig->getError()];
    }

    public function getConfigGroup($key=null){

        $data = parse_config_array('config_group_list');
        return array_key_exists($key,$data)?$data[$key]:'';
    }

    public function getConfigType($key=null){
        $data = parse_config_array('config_type_list');
        return array_key_exists($key,$data)?$data[$key]:'';
    }


}
