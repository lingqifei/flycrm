<?php
/*
* [modulename].logic  逻辑层
*
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @Copyright Copyright (C) 2017-2022 07FLY Network Technology Co,LTD.
* @License For licensing, see LICENSE.html
* @Author ：kfrs <goodkfrs@QQ.com> 574249366
* @Version ：1.1.0
* @Link ：http://www.07fly.xyz
* @Date:[datetime]
*/
namespace app\[spacename]\logic;

/**
* 逻辑层
*/
class Index extends [ModuleBase] {

   /**
    * 添加
    */
   public function indexAdd($data = [])
   {
      $validate_result = $this->validateIndex->scene('add')->check($data);
      if (!$validate_result) {
         return [RESULT_ERROR, $this->validateIndex->getError()];
      }
      $result = $this->modelIndex->setInfo($data);
      $result && action_log('新增', '新增信息，name：' . $data['name']);
      $url = url('show');
      return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelIndex->getError()];
   }
   /**
   * 编辑
   */
   public function indexEdit($data = [])
   {
      $validate_result = $this->validateIndex->scene('add')->check($data);
      if (!$validate_result) {
         return [RESULT_ERROR, $this->validateIndex->getError()];
      }
      $where = ['id' => $data['id']];
      $result = $this->modelIndex->updateInfo($where,$data);
      $result && action_log('修改', '修改信息，name：' . $data['name']);
      $url = url('show');
      return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelIndex->getError()];
   }

   /**
    * 删除
   */
   public function indexDel($data = [])
   {
      if (empty($data['id'])) {
         throw_response_error('选择执行的参数');
      }
      $where['id'] = ['in', $data['id']];
      $result = $this->modelIndex->deleteInfo($where, true);
      $result && action_log('删除', '删除用户，where：' . http_build_query($where));
      $url = url('show');
      return $result ? [RESULT_SUCCESS, '删除成功', $url] : [RESULT_ERROR, $this->modelIndex->getError()];
   }
   public function getSysUserInfo($where = [], $field = true)
   {
      return $this->modelIndex->getInfo($where, $field);
   }
}
?>