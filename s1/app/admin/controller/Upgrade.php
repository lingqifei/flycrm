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

namespace app\admin\controller;

/**
 * 升级控制器
 */
class Upgrade extends AdminBase
{
    /**
     * 升级页
     */
    public function show()
    {
        if (IS_AJAX) {
            if (!empty($this->param['action'])) {
                switch ($this->param['action']) {
                    case 'get':
                        $serReqKey = $this->logicUpgrade->getReqKey();
                        $this->jump($serReqKey);
                        break;
                    case 'del':
                        $serReqKey = $this->logicUpgrade->delReqKey();
                        $this->jump($serReqKey);
                        break;
                    case 'reg':
                        $serReqKey = $this->logicUpgrade->setReqKey();
                        break;
                }
            }
            return $serReqKey;
        }

        $signal = $this->logicUpgrade->upgrade_signal_check();//检查通信

        $this->assign('authorize', $this->logicUpgrade->chkAuthKey());//检查是否授权

        $this->assign('ver', $this->logicUpgrade->getVersionInfo());//检查版本

        $this->assign('signal', $signal);

        return $this->fetch('show');
    }

    /**
     * 注册信息
     */
    public function reg()
    {
        $this->jump($this->logicUpgrade->regAuthKey($this->param));
    }

    /**
     * 显示升级例表
     */
    public function lists()
    {
        if (!empty($this->param['action'])) {
            $list = $this->logicUpgrade->getUpgradeList();
            return $list;
        }
        return $this->fetch('lists');
    }

    /**
     * 显示升级包信息
     */
    public function info()
    {
        $info = $this->logicUpgrade->getUpgradeVersionInfo($this->param['version']);
        $this->assign('info', $info);
        return $this->fetch('info');
    }

    /**
     * 下载升级包信息
     */
    public function down()
    {
        $this->jump($this->logicUpgrade->getUpgradePack($this->param['version']));
    }

    /**删除
     * 升级包信息
     */
    public function del()
    {
        $this->jump($this->logicUpgrade->setUpgradeDel($this->param));
    }

    /**
     * 升级执行
     */
    public function execute()
    {
        if (empty($this->param['version']) || empty($this->param['step'])) {
            $rtn = ['code' => 0, 'msg' => '选择需要升级的参数'];
        } else {
            switch ($this->param['step']) {
                case '1':
                    $res = $this->logicUpgrade->getUpgradeBack();
                    if ($res[0] == RESULT_SUCCESS) {
                        $rtn['code'] = '1';
                        $rtn['step'] = '2';
                        $rtn['msg'] = '执行第一步：备份程序成功，备份文件为：' . $res[1];
                        $rtn['title'] = '数据升级，开始执行升级程序，请不要关闭浏览器...';
                    } else {
                        $rtn = ['code' => 0, 'msg' => $res[1]];
                    }
                    break;
                case '2':
                    $res = $this->logicUpgrade->getUpgradeExecute($this->param);
                    if ($res[0] == RESULT_SUCCESS) {
                        $rtn['code'] = '1';
                        $rtn['step'] = '3';
                        $rtn['msg'] = '执行第二步：解压程序成功，程序已经覆盖完成！';
                        $rtn['title'] = '开始执行升级数据库，请不要关闭浏览器...';
                    } else {
                        $rtn = ['code' => 0, 'msg' => $res[1]];
                    }
                    break;
                case '3':
                    $res = $this->logicUpgrade->getUpgradeExecuteSql($this->param);
                    if ($res[0] == RESULT_SUCCESS) {
                        $rtn['code'] = '1';
                        $rtn['step'] = '4';
                        $rtn['msg'] = '执行第三步：数据库升级完成！' . $res[1];
                        $rtn['title'] = '开始清除缓存数据，请不要关闭浏览器...';
                    } else {
                        $rtn = ['code' => 0, 'msg' => $res[1]];
                    }
                    break;
                case '4':
                    $res = $this->logicUpgrade->setUpgradeDel($this->param);
                    if ($res[0] == RESULT_SUCCESS) {
                        $rtn['code'] = '1';
                        $rtn['step'] = '-1';
                        $rtn['msg'] = '执行第四步：缓存数据清除完成，升级完成！' . $res[1];
                        $rtn['title'] = '请不要关闭浏览器...';
                    } else {
                        $rtn = ['code' => 0, 'msg' => $res[1]];
                    }
                    break;

            }
            $rtn['url'] = url('upgrade/execute');
            $rtn['version'] = $this->param['version'];
        }
        return $rtn;
    }

//    public function upgradeSql()
//    {
//
//        $res = $this->logicUpgrade->getUpgradeExecuteSql($this->param);
//
//        d($res);
//
//    }
}
