<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * RegulationTypeor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;


/**
 * 规章制度分类分类管理=》逻辑层
 */
class RegulationType extends OaskBase
{
    /**
     * 规章制度分类分类列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getRegulationTypeList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        return $this->modelRegulationType->getList($where, $field, $order, $paginate)->toArray();
    }

    /**
     * 规章制度分类分类添加
     * @param array $data
     * @return array
     */
    public function regulationTypeAdd($data = [])
    {

        $validate_result = $this->validateRegulationType->scene('add')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateRegulationType->getError()];
        }
        $result = $this->modelRegulationType->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增规章制度分类分类：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelRegulationType->getError()];
    }

    /**
     * 规章制度分类分类编辑
     * @param array $data
     * @return array
     */
    public function regulationTypeEdit($data = [])
    {

        $validate_result = $this->validateRegulationType->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateRegulationType->getError()];
        }

        $url = url('show');

        $result = $this->modelRegulationType->setInfo($data);

        $result && action_log('编辑', '编辑规章制度分类分类，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelRegulationType->getError()];
    }

    /**
     * 规章制度分类分类删除
     * @param array $where
     * @return array
     */
    public function regulationTypeDel($where = [])
    {

        $result = $this->modelRegulationType->deleteInfo($where,true);

        $result && action_log('删除', '删除规章制度分类分类，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelRegulationType->getError()];
    }

    /**规章制度分类分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getRegulationTypeInfo($where = [], $field = true)
    {
        return $this->modelRegulationType->getInfo($where, $field);
    }

    /**
     * 规章制度分类分类列表=》树形结构
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getRegulationTypeListTree($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false)
    {
        $list=$this->modelRegulationType->getList($where, $field, $order, $paginate)->toArray();
        $data=list2tree($list);
        return $data;
    }

    /**
     * 规章制度分类分类列表=》树形下拉
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getRegulationTypeTreeSelect($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false)
    {
        $list=$this->modelRegulationType->getList($where, $field, $order, $paginate)->toArray();
        $data=list2select($list);
        return $data;
    }

	/**获得所有指定id所有子级
	 * @param int $deptid
	 * @param array $data
	 * @return array
	 */
	public function getRegulationTypeAllSon($deptid=0, $data=[])
	{
		$where['pid']=['=',$deptid];
		$sons = $this->modelRegulationType->getList($where,true,'sort asc',false);
		if (count($sons) > 0) {
			foreach ($sons as $v) {
				$data[] = $v['id'];
				$data = $this->getRegulationTypeAllSon($v['id'], $data); //注意写$data 返回给上级
			}
		}
		if (count($data) > 0) {
			return $data;
		} else {
			return false;
		}
		return $data;
	}


	/**指定id下级所有id及自己
	 * @param $id
	 * @return array
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/6/3 0003 17:06
	 */
	public function getRegulationTypeSelfSon($id){
		$ids=$this->getRegulationTypeAllSon($id);
		$ids[]=$id;
		return $ids;
	}

}
