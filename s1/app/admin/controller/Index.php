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
 * 首页控制器
 */
class Index extends AdminBase
{

    /**
     * 管理首页方法
     */
    public function index()
    {
        $this->view->engine->layout(false);
        //生成压缩文件
        //$this->getcss();
        //$this->getjs();

        return $this->fetch('index');
    }

    /**
     * 管理首页方法
     */
    public function main()
    {
        // 获取首页数据
        $index_data = $this->logicAdminBase->getIndexData();
        $this->assign('info', $index_data);
        return $this->fetch('main');
    }

    // 多语言支持
    public function language()
    {
        $lang = input('lang');
        switch ($lang) {
            case 'zh':
                cookie('think_var', 'zh-cn');
                break;
            case 'en':
                cookie('think_var', 'en-us');
                break;
            case 'brazil':
                cookie('think_var', 'pt-br');
                break;
            default:
                cookie('think_var', 'zh-cn');
                break;
        }
        $rtn = [RESULT_SUCCESS, lang('set success')];
        $this->jump($rtn);
    }

    public function getcss()
    {

        //用法是这样的：
        $static = PATH_PUBLIC . SYS_STATIC_DIR_NAME . DS;

        $files = array(
            $static . 'module/admin/css/bootstrap.min.css',
            $static . 'module/admin/css/font-awesome.css',
            $static . 'module/admin/css/plugins/iCheck/custom.css',
            $static . 'module/admin/css/plugins/chosen/chosen.css',
            $static . 'module/admin/css/plugins/datapicker/datepicker3.css',
            $static . 'module/admin/css/plugins/datapicker/datetimepicker.min.css',
            $static . 'module/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
//            $static . 'module/admin/css/animate.css',
            $static . 'module/admin/plugin/daterangepicker/static/css/iconfont.css',
            $static . 'module/admin/plugin/daterangepicker/static/css/daterangepicker.css',
            $static . 'module/admin/css/style.css',
            $static . 'module/admin/css/07fly.css',
        );

        $css = $this->combine_my_files($files, $static.'module/admin/mini/', md5("my_mini_file") . ".css");

        //echo $css;
        // d($rtn);
    }

    public function getjs()
    {

        //用法是这样的：
        $static = PATH_PUBLIC . SYS_STATIC_DIR_NAME . DS;
        // d($static);
        $files = array(
//            $static . 'module/admin/js/jquery.min.js',
//            $static . 'module/admin/js/bootstrap.min.js',
//            $static . 'module/admin/js/plugins/layer/layer.min.js',

            $static . 'module/admin/js/jquery.cookie.js',
            $static . 'module/admin/js/plugins/metisMenu/jquery.metisMenu.js',
            $static . 'module/admin/js/plugins/slimscroll/jquery.slimscroll.min.js',
            $static . 'module/admin/js/baiduTemplate.js',
//            $static . 'module/admin/js/jquery.pjax.js',
            $static . 'module/admin/js/jquery.jqprint-0.3.js',
            $static . 'module/admin/js/plugins/datapicker/bootstrap-datepicker.js',
            $static . 'module/admin/js/plugins/datapicker/bootstrap-datetimepicker.js',
            $static . 'module/admin/js/plugins/datapicker/bootstrap-datetimepicker.zh-CN.js',
            $static . 'module/admin/js/plugins/clockpicker/clockpicker.js',
            $static . 'module/admin/js/plugins/iCheck/icheck.min.js',
            $static . 'module/admin/js/plugins/chosen/chosen.jquery.js',
            $static . 'module/admin/js/plugins/suggest/bootstrap-suggest.js',
            $static . 'module/admin/js/plugins/bignumber/bignumber.min.js',
            $static . 'module/admin/js/plugins/suggest/bootstrap-suggest.js',
            $static . 'module/admin/plugin/daterangepicker/static/js/moment.js',
            $static . 'module/admin/plugin/daterangepicker/static/js/daterangepicker.js',
            $static . 'module/admin/js/lib/init.js',
            $static . 'module/admin/js/lib/showtable.js',
            $static . 'module/admin/js/lib/lookup.js',
            $static . 'module/admin/js/lib/daterange.js',
            $static . 'module/admin/js/lib/date.js',
            $static . 'module/admin/js/lib/suggest.js',
            $static . 'module/admin/js/lib/content.js',
        );
        $js = $this->combine_my_files($files, $static.'module/admin/mini/', md5("my_mini_file") . ".js", 'js');
    }

    //合并文件
    function combine_my_files($array_files, $destination_dir, $dest_file_name, $filetype = 'css')
    {

        !is_dir($destination_dir) && mkdir($destination_dir, 0755, true);

        $http = DOMAIN . dirname(URL_ROOT) . SYS_DS_PROS . SYS_STATIC_DIR_NAME . SYS_DS_PROS;

        if (!is_file($destination_dir . $dest_file_name)) { //continue only if file doesn't exist
            $content = "";
            foreach ($array_files as $file) { //loop through array list
                //d($file);
                $content .= file_get_contents($file); //read each file
            }
            //You can use some sort of minifier here
            //minify_my_js($content);
            $new_file = fopen($destination_dir . $dest_file_name, "w"); //open file for writing
            fwrite($new_file, $content); //write to destination
            fclose($new_file);

            if ($filetype == 'js') {
                $result = '<script src="' . $http . $dest_file_name . '" type="text/javascript"></script>'; //output combined file
            } else {
                $result = '<link href="' . $http . $dest_file_name . '"  rel="stylesheet" type="text/css">';
            }

        } else {
            //use stored file
            if ($filetype == 'js') {
                $result = '<script src="' . $http . $dest_file_name . '" type="text/javascript"></script>'; //output combined file
            } else {
                $result = '<link href="' . $http . $dest_file_name . '"  rel="stylesheet" type="text/css">';
            }
        }
        $html = "<!--\r\ndocument.write('{$result}');\r\n-->\r\n";
        return $html;
    }
}