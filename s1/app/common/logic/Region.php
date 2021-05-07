<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Memberor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\common\logic;

use think\Db;

/**
 * 地区列表管理=》逻辑层
 */
class Region extends LogicBase
{

    /**
     * 地区列表管理
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getRegionList($where = [])
    {
        $cache_key = 'cache_region_' . md5(serialize($where));
        $cache_list = cache($cache_key);
        if (!empty($cache_list)) : return $cache_list; endif;
        $list = Db::name('region')->where($where)->field(true)->select();
        !empty($list) && cache($cache_key, $list);
        return $list;
    }

    /**
     * 地区列表管理=>id=key name=value
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return array
     */
    public function getRegionColumn($where = [],$field='shortname',$key='id')
    {
        $cache_key = 'cache_getRegionColumn_' . md5(serialize($where));
        $cache_list = cache($cache_key);
        if (!empty($cache_list)){
            $list=$cache_list;
        }else{
            $list = $this->modelRegion->getColumn($where,$field,$key);
            !empty($list) && cache($cache_key, $list);
        }
        return $list;
    }


    /**获得所有指定id所有父级
     * @param int $typeid
     * @param array $data
     * @return array
     */
    public function getRegionAllPid($typeid=0, $data=[])
    {
        $where['id']=['=',$typeid];
        $upid= $this->modelRegion->getValue($where,'upid');
        if(!empty($upid)){
            $data[]=$upid;
            return $this->getRegionAllPid($upid,$data);
        }
        return $data;
    }
    /**获得所有指定id所有子级
     * @param int $typeid
     * @param array $data
     * @return array
     */
    public function getRegionAllSon($typeid=0, $data=[])
    {
        $where['upid']=['=',$typeid];
        $sons = $this->modelRegion->getColumn($where,'id');
        foreach ($sons as $v) {
            $data[] = $v;
            $data = $this->getRegionAllSon($v, $data); //注意写$data 返回给上级
        }
        if (count($data) > 0) {
            return $data;
        } else {
            return false;
        }
        return $data;
    }

    /**获得所有指定id=>下级子级
     * @param int $typeid
     * @param array $data
     * @return array
     */
    public function getRegionSon($typeid=0, $data=[])
    {
        $where['upid']=['=',$typeid];
        $sons = $this->modelRegion->getColumn($where,'id');
        return $sons;
    }


    /**获得所有指定id =》所有同级
     * @param int $typeid
     * @param array $data
     * @return array
     */
    public function getRegionAllSelf($typeid=0, $data=[])
    {
        $pid = $this->modelRegion->getValue(['id'=>$typeid],'upid');
        $data = $this->modelRegion->getColumn(['upid'=>$pid],'id');
        return $data;
    }

    /**获得所有指定id 所有顶级
     * @return array
     */
    public function getRegionAllTop()
    {
        $data = $this->modelRegion->getColumn(['upid'=>'0'],'id');
        return $data;
    }


    /**获得所有指定id ,父级ID
     * @param int $typeid
     * @param array $data
     * @return array
     */
    public function getRegionSelfPid($typeid=0)
    {
        $pid=0;
        $where['id']=['=',$typeid];
        $typepid = $this->modelRegion->getValue($where,'upid');
        if($typepid>0){
            $pid=$typepid;
        }
        return $pid;
    }



}
