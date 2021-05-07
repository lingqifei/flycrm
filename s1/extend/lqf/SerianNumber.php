<?php

namespace lqf;

use think\Db;

//数据导出模型
class SerianNumber
{
    private $filename; //文件名
    private $separate; //系统分隔符
    private $width; //自动增长部分的个数

    public function __construct($width, $filename, $separate)
    {
        $this->width = $width;
        $this->filename = $filename;
        $this->separate = $separate;
    }

    public function getOrUpdateNumber($current, $start)
    {
        $record = IOUtil::read_content($this->filename);
        $arr = explode($this->separate, $record);
        if ($current == $arr[0]) { //如果是同一天,则继续增长
            $arr[1]++;
            IOUtil::write_content("$arr[0],$arr[1]", $this->filename); //将新值存入文件中
            return "$arr[0]" . str_pad($arr[1], $this->width, 0, STR_PAD_LEFT);
        } else { //如果两个日期不一样则重新从起始值开始
            $arr[0] = $current;
            $arr[1] = $start;
            IOUtil::write_content("$arr[0],$arr[1]", $this->filename); //将新值存入文件中
            return "$arr[0]" . str_pad($arr[1], $this->width, 0, STR_PAD_LEFT);
        }
    }
}

class IOUtil
{
    public static function read_content($filename)
    {
        $path = "../data/";
        !is_dir($path) && mkdir($path, 0755, true);
        $filename = $path . $filename;

        $handle = fopen($filename, "r");
        $content = fread($handle, filesize($filename));
        return $content;
    }

    public static function write_content($content, $filename)
    {
        $handle = fopen($filename, "w");
        fseek($handle, 0);
        fwrite($handle, $content);
        return $content;
    }
}