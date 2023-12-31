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
