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

namespace app\admin\logic;

/**
 * 菜单逻辑
 */
class SysMenu extends AdminBase
{

	// 面包屑
	public static $crumbs = [];

	// 菜单Select结构
	public static $menuSelect = [];

	/**
	 * 左侧菜单转视图
	 */
	public function menuToView($menu_list = [], $child = 'child', $level = 0)
	{

		$menu_view = '';

		//遍历菜单列表
		foreach ($menu_list as $menu_info) {

			if (!empty($menu_info[$child]) && $menu_info['visible'] == 1) {

				$icon = empty($menu_info['icon']) ? 'fa-dot-circle-o' : $menu_info['icon'];
				if ($level == 0) {
					$level_classname = "nav-second-level";
				} else if ($level == 1) {
					$level_classname = "nav-third-level";
				}
				$menu_view .= '
                                        <li> <a href="#"> <i class="fa ' . $icon . '"></i> <span class="nav-label">' . $menu_info['name'] . '</span> <span class="fa arrow"></span> </a>
                                            <ul class="nav ' . $level_classname . '">
                                               ' . $this->menuToView($menu_info[$child], $child, $level + 1) . '
                                            </ul>
                                        </li>';
			} else {

				$icon = empty($menu_info['icon']) ? 'fa-circle-o' : $menu_info['icon'];

				//defined('BIND_MODULE') && $menu_info['url'] =$menu_info['module'].'/'.$menu_info['url'];//解决模块间的地址

				$menu_info['url'] = $menu_info['module'] . '/' . $menu_info['url'];//解决模块间的地址

				$url = url($menu_info['url']);

				if ($menu_info['visible'] == 1) {
					//$menu_view .= "<li menu_id='".$menu_info['id']."'><a href='$url'><i class='fa $icon'></i> <span>".$menu_info['name']."</span></a></li>";
					$menu_view .= '<li> <a class="J_menuItem" href="' . $url . '"> <i class="fa ' . $icon . '"></i> <span class="nav-label">' . $menu_info['name'] . '</span> </a> </li>';
				}
			}
		}

		return $menu_view;
	}


	/**
	 * 菜单转Checkbox,用于菜单授权勾选
	 */
	public function menuToCheckboxView($menu_list = [], $child = 'child')
	{

		$menu_view = '';

		$id = input('id');

		$auth_group_info = $this->logicSysAuth->getAuthInfo(['id' => $id], 'rules');
		$rules_array = str2arr($auth_group_info['rules']);

		/*2019-12-11 新增加加用户单独权限设置
		*合并用户单独添加的权限列表
		*/
		$userinfo = $this->logicSysUser->getSysUserInfo(['id' => $id], 'rules');
		$user_rules_array = str2arr(trim($userinfo['rules']));

		$rules_array = array_merge($rules_array, $user_rules_array);
		//**************************************************合并单独权限结束

		//遍历菜单列表
		foreach ($menu_list as $menu_info) {

			//$icon = empty($menu_info['icon']) ? 'fa-dot-circle-o' : $menu_info['icon'];
			$icon = '';

			$checkbox_select = in_array($menu_info['id'], $rules_array) ? "checked='checked'" : '';

			if (!empty($menu_info[$child])) {

//				$menu_view .= "
//						<div class='auth-head '>
//						  <div class='ibox-head-child'>
//								<a> <input class='rules_all' type='checkbox' name='rules[]' value='" . $menu_info['id'] . "' $checkbox_select ><i class='fa $icon'></i> " . $menu_info['name'] . "&nbsp;</a>
//						   </div>
//							<div class='ibox-content'> " . $this->menuToCheckboxView($menu_info[$child], $child) . " </div>
//						</div>
//						";

				$menu_view .='<li class="has_child">';
				$menu_view .="<span><i class='icon-plus-sign'></i></span><input class='rules_all' type='checkbox' name='rules[]' value='" . $menu_info['id'] . "' $checkbox_select ><i class='fa $icon'></i> " . $menu_info['name'] . "";
				$menu_view .="<ul style='display: none;'>";
				$menu_view .=$this->menuToCheckboxView($menu_info[$child], $child);
				$menu_view .="</ul>";
				$menu_view .="</li>";

			} else {

				$menu_view .="<li>";
				$menu_view .="<span><i></i></span><input type='checkbox' name='rules[]' value='" . $menu_info['id'] . "'  $checkbox_select ><i class='fa $icon'></i> " . $menu_info['name'] . "";
				$menu_view .="</li>";

				//$menu_view .= "<a class='auth-head'><input type='checkbox' name='rules[]' value='" . $menu_info['id'] . "'  $checkbox_select ><i class='fa $icon'></i> " . $menu_info['name'] . "&nbsp;&nbsp;</a>";
			}
		}

		return $menu_view;
	}

	/**
	 * 菜单选择i当前菜单
	 */
	public function selectMenu($menu_view = '')
	{

		$map['url'] = URL;
		$map['module'] = MODULE_NAME;

		$menu_info = $this->getSysMenuInfo($map);

		// 获取自己及父菜单列表
        !empty($menu_info['id']) && $this->getParentMenuList($menu_info['id']);

		// 选中面包屑中的菜单
		foreach (self::$crumbs as $menu_info) {

			$replace_data = "menu_id='" . $menu_info['id'] . "'";

			$menu_view = str_replace($replace_data, " class='active' ", $menu_view);
		}

		return $menu_view;
	}

	/**
	 * 获取自己及父菜单列表
	 */
	public function getParentMenuList($menu_id = 0)
	{

		$menu_info = $this->getSysMenuInfo(['id' => $menu_id]);

		!empty($menu_info['pid']) && $this->getParentMenuList($menu_info['pid']);

		self::$crumbs [] = $menu_info;
	}

	/**
	 * 获取面包屑
	 */
	public function getCrumbsView()
	{
		$map['url'] = URL;
		$map['module'] = MODULE_NAME;

		$menu_info = $this->getSysMenuInfo($map);

		// 获取自己及父菜单列表
		!empty($menu_info['id']) && $this->getParentMenuList($menu_info['id']);

		$crumbs_view = '<div class="row white-bg" style="padding: 10px 5px 10px 20px;font-size: 13px;"><div class="col-sm-12">';

		$crumbs_view .= "<ol class='breadcrumb'>";

		foreach (self::$crumbs as $menu_info) {

			$icon = empty($menu_info['icon']) ? 'fa-circle-o' : $menu_info['icon'];

			$crumbs_view .= "<li><a><i class='fa $icon'></i> " . $menu_info['name'] . "</a></li>";
		}

		$crumbs_view .= "</ol>";
		$crumbs_view .= "</div></div>";

		return $crumbs_view;
	}

	/**
	 * 获取菜单列表
	 */
	public function getSysMenuList($where = [], $field = true, $order = '', $paginate = false)
	{

		//判断模块是否启用
		$module=$this->modelSysModule->getColumn(['visible'=>1], 'name');
		$module[]='admin';//排除管理模块

		$where['module'] = ['in', $module];
		$where['org_id'] = ['>', 0];

		return $this->modelSysMenu->getList($where, $field, $order, $paginate);
	}

	//得到tree的数据
	public function getSysMenuListTree($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false)
	{
		$list = $this->getSysMenuList($where, $field, $order, $paginate)->toArray();
		$tree = list2tree($list);
		return $tree;
	}

	//得到tree的数据
	public function getSysDeptTreeSelect($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false)
	{
		$list = $this->getSysMenuList($where, $field, $order, $paginate)->toArray();
		$data = list2select($list);
		return $data;
	}

	/**
	 * 获取默认页面标题
	 */
	public function getDefaultTitle()
	{
		return $this->modelSysMenu->getValue(['module' => MODULE_NAME, 'url' => URL], 'name');
	}

	/**
	 * 获取菜单信息
	 */
	public function getSysMenuInfo($where = [], $field = true)
	{
		return $this->modelSysMenu->getInfo($where, $field);
	}

	/**
	 * 菜单添加
	 */
	public function sysMenuAdd($data = [])
	{

		$validate_result = $this->validateSysMenu->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateSysMenu->getError()];
		}

		$result = $this->modelSysMenu->setInfo($data);
		$result && action_log('新增', '新增菜单，name：' . $data['name']);
		$url = url('show', ['pid' => $data['pid'] ? $data['pid'] : 0]);
		return $result ? [RESULT_SUCCESS, '菜单添加成功', $url] : [RESULT_ERROR, $this->modelSysMenu->getError()];
	}

	/**
	 * 菜单编辑
	 */
	public function sysMenuEdit($data = [])
	{
		$validate_result = $this->validateSysMenu->scene('edit')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateSysMenu->getError()];
		}
		$url = url('show');
		$result = $this->modelSysMenu->setInfo($data);
		$result && action_log('编辑', '编辑菜单，name：' . $data['name']);
		return $result ? [RESULT_SUCCESS, '菜单编辑成功', $url] : [RESULT_ERROR, $this->modelSysMenu->getError()];
	}

	/**
	 * 菜单删除
	 */
	public function sysMenuDel($data = [])
	{
	    $result=true;
        $url = url('show');
        if(!empty($data['id'])){
	        $ids=str2arr($data['id']);
	        foreach ($ids as $id){
	            $son=$this->modelSysMenu->getValue(['pid'=>$id],'id');
	            //无下级删除
	            if(empty($son)){
                    $result = $this->modelSysMenu->deleteInfo(['id'=>$id], true);
                }else{
                    return [RESULT_ERROR, '勾选择菜单存在子菜单，请删除子菜单',$url];
                }
            }
        }
		$result && action_log('删除', '删除菜单，where：' . http_build_query($data));
	    return $result ? [RESULT_SUCCESS, '菜单删除成功',$url] : [RESULT_ERROR, $this->modelSysMenu->getError()];
	}


    /**
     * 菜单移动
     */
    public function sysMenuMove($data = [])
    {

        if(empty($data['id']) || empty($data['pid'])) {
            return [RESULT_ERROR, '参数不全'];
            exit;
        }else{
            $ids=str2arr($data['id']);
            if(in_array($data['pid'],$ids)){
                return [RESULT_ERROR, '不能移动到勾选栏目下面'];
            }
        }

        $where['id']=['in',$ids];
        $updata['pid']=$data['pid'];
        $result = $this->modelSysMenu->updateInfo($where,$updata);

        $result && action_log('编辑', '移动菜单，name：' . $data['id']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '菜单编辑成功', $url] : [RESULT_ERROR, $this->modelSysMenu->getError()];
    }


    /**菜单复制
     * @param array $data
     * @return array
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/3/12 0012 10:53
     */
    public function sysMenuCopy($data = [])
    {

        if(empty($data['id']) || empty($data['pid'])) {
            return [RESULT_ERROR, '参数不全'];
            exit;
        }else{
            $ids=str2arr($data['id']);
            if(in_array($data['pid'],$ids)){
                return [RESULT_ERROR, '不能复制到自己勾选栏目下面'];
            }
        }
        $where['id']=['in',$ids];
        $copylist=$this->modelSysMenu->getList($where, '', 'sort asc', false)->toArray();
        foreach ($copylist as $key=>&$row){
            $row['pid']=$data['pid'];
            unset($row['id']);
            unset($row['create_time']);
            unset($row['update_time']);
        }
        $result=$this->modelSysMenu->setList($copylist);
        $result && action_log('编辑', '复制菜单，name：' . $data['id']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->modelSysMenu->getError()];
    }

	/**
	 * 批量导入菜单
	 * @param array $data 菜单数据
	 * @param string $mod 模型名称或插件名称
	 * @param string $type [module,plugins]
	 * @param int $pid 父ID
	 * @return bool
	 * @author 开发人生 <574249366@qq.com>
	 */
	public function sysMenuImport($data = [], $mod = '', $type = 'module', $pid = 0)
	{
		if (empty($data)) {
			return true;
		}
		foreach ($data as $v) {
			if (!isset($v['pid'])) {
				$v['pid'] = $pid;
			}
			$childs = '';
			if (isset($v['nodes'])) {
				$childs = $v['nodes'];
				unset($v['nodes']);
			}
			$result = $this->modelSysMenu->setInfo($v);

			if (!$result) {
				return false;
			}
			if (!empty($childs)) {
				$this->sysMenuImport($childs, $mod, $type, $result);
			}
		}
		return true;
	}


	/**
	 * 批量导出菜单
	 * @param array $data 菜单数据
	 * @param string $mod 模型名称或插件名称
	 * @param string $type [module,plugins]
	 * @param int $pid 父ID
	 * @return bool
	 * @author 开发人生 <574249366@qq.com>
	 */
	public function sysMenuExport($mod = '', $type = 'module')
	{
		$where = [];
		if (!empty($mod)) {
			$where['module'] = ['=', $mod];
		}
		$list = $this->modelSysMenu->getList($where, '', '', false)->toArray();
		$tree = list2tree2menu($list);
		return $tree;
	}

}