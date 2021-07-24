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

use app\common\controller\ControllerBase;

/**
 * 登录控制器
 */
class Login extends ControllerBase
{


	/**
	 * 构造方法
	 */
	public function __construct()
	{

		// 执行父类构造方法
		parent::__construct();

		$config=$this->logicLogin->getConfigData();
		$this->assign('info', $config);
		//d($x);
	}

    /**
     * 登录
     */
    public function login()
    {
        
        is_login() && $this->jump(RESULT_REDIRECT, '已登录则跳过登录页', url('admin/index/index'));

        IS_POST && $this->loginHandle($this->param['username'],$this->param['password'],$this->param['verify']);

        // 关闭布局
        $this->view->engine->layout(false);
        
        return $this->fetch('login');
    }
    
    /**
     * 登录处理
     */
    public function loginHandle($username = '', $password = '', $verify = '')
    {
        
        $this->jump($this->logicLogin->loginHandle($username, $password, $verify));
    }
    
    /**
     * 注销登录
     */
    public function logout()
    {
        
        $this->jump($this->logicLogin->logout());
    }
    
    /**
     * 清理缓存
     */
    public function clearCache()
    {
        
        $this->jump($this->logicLogin->clearCache());
    }
    
}
