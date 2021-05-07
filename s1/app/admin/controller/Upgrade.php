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

/**
 * 升级控制器
 */
class Upgrade extends AdminBase
{

    /**
     * 显示备份例表
     */
    public function show()
    {
        $signal=$this->logicUpgrade->upgrade_signal_check();//检查通信

        $this->assign('authorize', $this->logicUpgrade->upgrade_auth_check());//检查是否授权

        $this->assign('ver', $this->logicUpgrade->getVersionInfo());//检查版本

        $this->assign('signal', $signal);

        return $this->fetch('show');
    }

    /**
     * 注册信息
     */
    public function reg()
    {
        $this->jump($this->logicUpgrade->upgrade_auth_reg($this->param));
    }

    /**
     * 显示升级例表
     */
    public function lists()
    {
        $list=$this->logicUpgrade->getUpgradeList();
        $this->assign('list', $list);
        return $this->fetch('lists');
    }

    /**
     * 显示升级包信息
     */
    public function info()
    {

    	$info =$this->logicUpgrade->getUpgradeVersionInfo($this->param['version']);

        $this->assign('info',$info );
        return $this->fetch('info');
    }

    /**
     * 下载升级包信息
     */
    public function down()
    {
        $this->jump($this->logicUpgrade->getUpgradePack($this->param['version']));
    }

    /**
     * 升级执行
     */
    public function execute()
    {
        if(empty($this->param['version']) || empty($this->param['step'])){
            $rtn=['code'=>0,'msg'=>'选择需要升级的参数'];
        }else{
            switch ($this->param['step']){
                case '1':
                    $res= $this->logicUpgrade->getUpgradeBack();
                    if($res[0]==RESULT_SUCCESS){
                        $rtn['code']='1';
                        $rtn['step']='2';
                        $rtn['msg']='执行第一步：备份程序成功，备份文件为：'.$res[1];
                        $rtn['title']='数据升级，开始执行升级程序，请不要关闭浏览器...';
                    }else{
                        $rtn=['code'=>0,'msg'=>$res[1]];
                    }
                    break;
                case '2':
                    $res= $this->logicUpgrade->getUpgradeExecute($this->param);
                    if($res[0]==RESULT_SUCCESS){
                        $rtn['code']='1';
                        $rtn['step']='3';
                        $rtn['msg']='执行第二步：解压程序成功，程序已经覆盖完成！';
                        $rtn['title']='开始执行升级数据库，请不要关闭浏览器...';
                    }else{
                        $rtn=['code'=>0,'msg'=>$res[1]];
                    }
                    break;
                case '3':
                    $res= $this->logicUpgrade->getUpgradeExecuteSql($this->param);
                    if($res[0]==RESULT_SUCCESS){
                        $rtn['code']='1';
                        $rtn['step']='4';
                        $rtn['msg']='执行第三步：数据库升级完成！'.$res[1];
                        $rtn['title']='开始清除缓存数据，请不要关闭浏览器...';
                    }else{
                        $rtn=['code'=>0,'msg'=>$res[1]];
                    }
                    break;
                case '4':
                    $res= $this->logicUpgrade->getUpgradeDel($this->param);
                    if($res[0]==RESULT_SUCCESS){
                        $rtn['code']='1';
                        $rtn['step']='-1';
                        $rtn['msg']='执行第四步：缓存数据清除完成，升级完成！'.$res[1];
                        $rtn['title']='请不要关闭浏览器...';
                    }else{
                        $rtn=['code'=>0,'msg'=>$res[1]];
                    }
                    break;

            }
            $rtn['url']=url('upgrade/execute');
            $rtn['version']=$this->param['version'];
        }
        return $rtn;
    }
}
