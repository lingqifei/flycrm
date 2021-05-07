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
 * 数据库备份控制器
 */
class Database extends AdminBase
{
    
    /**
     * 优化表
     */
    public function optimize()
    {
        
        $this->jump($this->logicDatabase->optimize());
    }
    
    /**
     * 修复表
     */
    public function repair()
    {
        
        $this->jump($this->logicDatabase->optimize(false));
    }
    
    /**
     * 数据备份
     */
    public function dataBackup()
    {
        
        IS_POST && $this->jump($this->logicDatabase->dataBackup($this->param));
        
        IS_GET  && isset($this->param['id']) && isset($this->param['start']) && $this->logicDatabase->dataBackupStep2($this->param);
        
        $this->assign('list', $this->logicDatabase->getTableList());
        
        return $this->fetch('data_backup');
    }
    
    /**
     * 数据还原
     */
    public function dataRestore()
    {

        $this->assign('list', $this->logicDatabase->getBackupList());
        
        return $this->fetch('data_restore');
    }
    
    /**
     * 数据还原处理
     */
    public function dataRestoreHandle()
    {

       $this->jump($this->logicDatabase->dataRestore($this->param));
    }
    
    /**
     * 备份删除
     */
    public function backupDel($time = 0)
    {

        $this->jump($this->logicDatabase->backupDel($time));
    }
}
