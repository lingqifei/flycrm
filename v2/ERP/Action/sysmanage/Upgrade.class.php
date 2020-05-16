<?php
/*
 *
 * sysmanage.SysLog  系统日志管理   
 *
 * =========================================================
 * 零起飞网络 - 专注于网站建设服务和行业系统开发
 * 以质量求生存，以服务谋发展，以信誉创品牌 !
 * ----------------------------------------------
 * @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
 * @license    For licensing, see LICENSE.html or http://www.07fly.top/crm/license
 * @author ：kfrs <goodkfrs@QQ.com> 574249366
 * @version ：1.0
 * @link ：http://www.07fly.top 
 */


class Upgrade extends Action
{
    private $cacheDir = '';//缓存目录
    private $version = '20200516';//当前版本

    public function __construct()
    {
        _instance('Action/sysmanage/Auth');
        $this->file = _instance('Extend/File');
        $this->zip = _instance('Extend/Zip');
    }

    public function serverip()
    {
        $server = "http://www.07fly.top/upgrade/v2";
        return $server;
    }

    public function version()
    {
        return $this->version;
        $versionfile = ROOT . S . 'version';
        $txt = $this->file->read_file($versionfile);
        if ($txt) {
            return $txt;
        } else {
            $this->file->write_file($versionfile, $this->version);
            return '20200101';
        }
    }

    //文件备份目录
    public function upgrade_backup_dir()
    {
        $path = "upload/upgrade_backup/";
        $this->file->create_dir($path);
        return $path;
    }

    //文件备份目录
    public function upgrade_down_dir()
    {
        $path = "upload/upgrade_down/";
        $this->file->create_dir($path);
        return $path;
    }

    /**检查是否下载了升级包
     * @param $version
     * @return mixed
     * Author: lingqifei created by at 2020/4/1 0001
     */
    public function check_down_verion($version)
    {
        $downpath = $this->upgrade_down_dir();
        $downfile = $downpath . $version . '.zip';
        $result = $this->file->exists_file($downfile);
        if ($result) {
            return $downfile;
        } else {
            return false;
        }
    }


    /**
     * 判断文件是否存在，支持本地及远程文件
     * @param String $file 文件路径
     * @return Boolean
     */
    function check_file_exists($file)
    {
        // 远程文件
        if (strtolower(substr($file, 0, 4)) == 'http') {
            $header = get_headers($file, true);
            return isset($header[0]) && (strpos($header[0], '200') || strpos($header[0], '304'));
            // 本地文件
        } else {
            return file_exists($file);
        }
    }

    /** 升级备份原程序
     * @return bool|string
     * Author: lingqifei created by at 2020/4/1 0001
     */
    public function upgrade_backup()
    {
        $source_path = $this->file->dir_replace(APP_ROOT);
        $backup_path = $this->upgrade_backup_dir() . date("YmdHis", time()) . "";
        $dirarr = array('Action', 'Extend', 'View');
        foreach ($dirarr as $dir) {
            $backup_dir = $backup_path . "/{$dir}/";
            $rtn[] = $this->file->create_dir($backup_dir);
            $rtn[] = $this->file->handle_dir($source_path . "/{$dir}", $backup_dir, 'copy', true);
        }
        if (in_array("0", $rtn, TRUE)) {
            return false;
        } else {
            $backup_file = $backup_path . '.zip';
            $rtn = $this->zip->zip($backup_file, $backup_path);
            if ($rtn) {
                $this->file->remove_dir($backup_dir . '/', true);
            }
            return $backup_file;
        }
    }

    /**下载升级文件
     * @param null $version
     * @return bool
     * Author: lingqifei created by at 2020/4/1 0001
     */
    public function upgrade_down($version = null)
    {
        $version = $this->_REQUEST("ver");
        $downpath = $this->upgrade_down_dir();
        $downpath = $this->file->dir_replace($downpath);

        $server = $this->serverip();    //获取网络信息
        $url = "$server/sysupgrade.php?ver=$version&act=down";
        $pakurl = $this->file->read_file($url);//得到服务器返回包的地址
        $result = $this->check_file_exists($pakurl);
        if ($result) {
            $finfo = $this->file->get_file_type("$pakurl");
            $result = $this->file->down_remote_file($pakurl, $downpath, $finfo['basename'], $type = 1);
            echo json_encode($result);
        } else {
            $rtn = array('error' => 1, 'message' => '下载升级文件不存在');
            echo json_encode($rtn);
        }
    }

    /**执行升级文件
     * @param null $version
     * @return bool
     * Author: lingqifei created by at 2020/4/1 0001
     */
    public function upgrade_exec($version = null)
    {
        $version = $this->_REQUEST("ver");
        $downfile = $this->check_down_verion($version);
        if ($downfile) {
            $downfile = $this->file->dir_replace(ROOT . S . $downfile);
            return $this->zip->unzip($downfile, ROOT);
        }
    }


}//end class
?>