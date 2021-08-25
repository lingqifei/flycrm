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

namespace app\admin\controller;
use think\db;
/**
 * 模块控制器
 */
class SysModule extends AdminBase
{

    /**
     * 模块列表
     */
    public function show()
    {
        return  $this->fetch('show');
    }

    public function show_json()
    {
        $where = [];
        if(!empty($this->param['keywords'])){
           $where['name|title|intro|author']=['like','%'.$this->param['keywords'].'%'];
        }
       $list=$this->logicSysModule->getSysModuleList($where);
        return $list;
    }


    /**
     * 模块添加
     */
    public function add()
    {
        IS_POST && $this->jump($this->logicSysModule->sysModuleAdd($this->param));

        return $this->fetch('add');
    }
    
    /**
     * 模块编辑
     */
    public function edit()
    {
        
        IS_POST && $this->jump($this->logicSysModule->sysModuleEdit($this->param));

        $info = $this->logicSysModule->getSysModuleInfo(['id' => $this->param['id']]);

        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     *模块删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicSysModule->sysModuleDel($where));
    }

    /**
     * 模块备份下载
     */
    public function backup()
    {
        $this->jump($this->logicSysModule->sysModuleBackup($this->param));
    }

    /**
     * 模块下载
     */
    public function download()
    {
        $this->jump($this->logicSysModule->sysModuleDown($this->param));
    }

    /**
     * 模块上传
     */
    public function upload()
    {
        IS_POST &&   $this->jump($this->logicSysModule->sysModuleUpload($this->param));
        return $this->fetch('upload');
    }

    /**
     * 模块安装
     */
    public function install()
    {
        return   $this->jump($this->logicSysModule->sysModuleInstall($this->param));
    }

    /**
     * 模块卸载
     */
    public function uninstall()
    {
        return $this->jump($this->logicSysModule->sysModuleUninstall($this->param));
    }

    /**
     * 启用
     */
    public function set_visible()
    {
        $this->jump($this->logicAdminBase->setField('SysModule', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicAdminBase->setSort('SysModule', $this->param));
    }

    /**
     * 排序
     */
    public function comm_data()
    {
        $this->assign('modulename', MODULE_NAME);
    }

	/**
	 * 模块卸载
	 */
	public function createsys()
	{
		return $this->jump($this->logicSysModule->sysModuleCreateSys($this->param));
	}

	/**
	 * 模块卸载
	 */
	public function synctable()
	{

//		$x=$this->logicSysModule->sysModuleSyncTable($this->param);
//		d($x);exit;

		return $this->jump($this->logicSysModule->sysModuleSyncTable($this->param));

	}

}
