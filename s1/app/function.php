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

// 扩展函数文件，系统研发过程中需要的函数建议放在此处，与框架相关函数分离

// +---------------------------------------------------------------------+
// | 时间相关函数
// +---------------------------------------------------------------------+

/**
 * 时间计算函数
 * @param int $time
 * @param int $caclVal 增加、减少的值
 * @param int $type 计算时间类型
 * @return string 完整的时间显示
 */
function date_calc($time = null, $caclVal = "0", $type = "day", $format = 'Y-m-d')
{
    if (null === $time) {
        $time = format_time();
    }
    return date($format, strtotime(" $caclVal $type", strtotime($time)));

}

/**
 * 获取两个日期之间所有日期
 * @param int $startDate 开始时间
 * @param int $endDate 结束时间
 * @return string 完整的时间显示
 */
function getDatesBetweenTwoDays($startDate, $endDate)
{
    $dates = [];
    if (strtotime($startDate) > strtotime($endDate)) {
        //如果开始日期大于结束日期，直接return 防止下面的循环出现死循环
        return $dates;
    } elseif ($startDate == $endDate) {
        //开始日期与结束日期是同一天时
        array_push($dates, $startDate);
        return $dates;
    } else {
        array_push($dates, $startDate);
        $currentDate = $startDate;
        do {
            $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 days'));
            array_push($dates, $nextDate);
            $currentDate = $nextDate;
        } while ($endDate != $currentDate);
        return $dates;
    }
}

/**
 * 时间计算函数
 * @param int $time
 * @param int $caclVal 增加、减少的值
 * @param int $type 计算时间类型
 * @return string 完整的时间显示
 */
function date_to_day($dates = [])
{
    $days = [];
    foreach ($dates as $date) {
        $days[] = date("d", strtotime($date));
    }

    return $days;
}

/**
 * [time_friend 时间美化函数v2.0]
 */
function time_friend($time)
{
    $todayLast = strtotime(date('Y-m-d') . ' 23:59:59');
    $agoTimeTrue = time() - $time;
    $agoTime = $todayLast - $time;
    $agoDay = floor($agoTime / 86400);
    $res = '';
    if ($agoTimeTrue < 60) {
        $res = '刚刚';
    } elseif ($agoTimeTrue < 3600) {
        $res = (ceil($agoTimeTrue / 60)) . '分钟前';
    } elseif ($agoTimeTrue < (3600 * 12)) {
        $res = (ceil($agoTimeTrue / 3600)) . '小时前';
    } elseif ($agoDay == 0) {
        $res = '今天 ' . date('H:i', $time);
    } elseif ($agoDay == 1) {
        $res = '昨天 ' . date('H:i', $time);
    } elseif ($agoDay == 2) {
        $res = '前天 ' . date('H:i', $time);
    } elseif (($agoDay > 2) && ($agoDay < 16)) {
        $res = $agoDay . '天前' . date('H:i', $time);
    } else {
        $res = date('Y-m-d H:i:s', $time);
    }

    return $res;
}

/**
 * 友好的时间显示 3.0
 *
 * @param int $sTime 待显示的时间
 * @param string $type 类型. normal | mohu | full | ymd | other
 * @param string $alt 已失效
 * @return string
 */
function time_friend3($sTime, $type = 'normal', $alt = 'false')
{
    if (!$sTime) return '';

    //判断是为时间格式
    if (strtotime($sTime) !== false) {
        $sTime = strtotime($sTime);
    }

    //sTime=源时间，cTime=当前时间，dTime=时间差

    $cTime = time();
    $dTime = $cTime - $sTime;
    $dDay = intval(date("z", $cTime)) - intval(date("z", $sTime));
    $dMon = intval(date("n", $cTime)) - intval(date("n", $sTime));
    //$dDay     =   intval($dTime/3600/24);
    $dYear = intval(date("Y", $cTime)) - intval(date("Y", $sTime));
    //normal：n秒前，n分钟前，n小时前，日期
    if ($type == 'normal') {

        //延后时间
        if ($dTime < 0 && $dTime > -3600) {
            return abs(intval($dTime / 60)) . "分钟后";
        } elseif ($dTime < -3600 && $dDay == 0) {
            return abs(intval($dTime / 3600)) . "小时后";
        } elseif ($dDay < 0 && $dDay >= -7) {
            return abs(intval($dDay)) . "天后";
        } elseif ($dDay < -7 && $dDay >= -30) {
            return abs(intval($dDay / 7)) . '周后';
        } elseif ($dDay < -30 && $dDay > -100) {
            return abs(intval($dDay / 30)) . '月后';
        }
        //前面时间
        if ($dTime < 60 && $dTime >= 0) {
            if ($dTime < 10) {
                return '刚刚';    //by yangjs
            } else {
                return intval(floor($dTime / 10) * 10) . "秒前";
            }
        } elseif ($dTime < 3600 && $dTime >= 0) {
            return intval($dTime / 60) . "分钟前";
            //今天的数据.年份相同.日期相同.
        } elseif ($dTime >= 3600 && $dDay == 0) {
            return intval($dTime / 3600) . "小时前";
        } elseif ($dDay > 0 && $dDay <= 7) {
            return intval($dDay) . "天前";
        } elseif ($dDay > 7 && $dDay <= 30) {
            return intval($dDay / 7) . '周前';
        } elseif ($dDay > 30 && $dDay <= 9 && $dYear == 0) {
            return intval($dDay / 30) . '个月前';
        } else {
            return date("Y-m-d H:i", $sTime);
        }
    } elseif ($type == 'mohu') {
        if ($dTime < 60) {
            return $dTime . "秒前";
        } elseif ($dTime < 3600) {
            return intval($dTime / 60) . "分钟前";
        } elseif ($dTime >= 3600 && $dDay == 0) {
            return intval($dTime / 3600) . "小时前";
        } elseif ($dDay > 0 && $dDay <= 7) {
            return intval($dDay) . "天前";
        } elseif ($dDay > 7 && $dDay <= 30) {
            return intval($dDay / 7) . '周前';
        } elseif ($dDay > 30) {
            return intval($dDay / 30) . '个月前';
        }
        //full: Y-m-d , H:i:s
    } elseif ($type == 'next') {
        return date("Y-m-d , H:i:s", $sTime);
    } elseif ($type == 'ymd') {
        return date("Y-m-d", $sTime);
    } else {
        if ($dTime < 60) {
            return $dTime . "秒前";
        } elseif ($dTime < 3600) {
            return intval($dTime / 60) . "分钟前";
        } elseif ($dTime >= 3600 && $dDay == 0) {
            return intval($dTime / 3600) . "小时前";
        } elseif ($dYear == 0) {
            return date("Y-m-d H:i:s", $sTime);
        } else {
            return date("Y-m-d H:i:s", $sTime);
        }
    }
}

/**时间生成时间段，开始和结束时间
 * 今天，昨天，前天，本周，上周，上上周，本月，上月，上上月，本季度，上季度，上上季度，本年，上年，上上年
 * today 今天
 * yesterday 昨天
 * beforeyesterday 前天
 * thisweek 本周
 * lastweek 上周
 * beforelastweek 上上周
 * 。。。。。。。。。。
 * @return mixed
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/8/9 0009 10:07
 */
if (!function_exists('make_time')) {
    function make_time()
    {
        //获取今日开始时间戳和结束时间戳
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $times['today']['begin'] = $beginToday;
        $times['today']['end'] = $endToday;

        //获取昨日起始时间戳和结束时间戳
        $beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
        $endYesterday = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 1;
        $times['yesterday']['begin'] = $beginYesterday;
        $times['yesterday']['end'] = $endYesterday;

        //获取昨日起始时间戳和结束时间戳
        $beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 2, date('Y'));
        $endYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')) - 2;
        $times['beforeyesterday']['begin'] = $beginYesterday;
        $times['beforeyesterday']['end'] = $endYesterday;

        //获取本周起始时间戳和结束时间戳
        $beginWeek = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1 - 7, date('Y'));
        $endWeek = mktime(23, 59, 59, date('m'), date('d') - date('w') + 7 - 7, date('Y'));
        $times['thisweek']['begin'] = $beginWeek;
        $times['thisweek']['end'] = $endWeek;

        //获取上周起始时间戳和结束时间戳
        $beginLastweek = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1 - 14, date('Y'));
        $endLastweek = mktime(23, 59, 59, date('m'), date('d') - date('w') + 7 - 14, date('Y'));
        $times['lastweek']['begin'] = $beginLastweek;
        $times['lastweek']['end'] = $endLastweek;


        //获取上周起始时间戳和结束时间戳
        $beginLastweek = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1 - 21, date('Y'));
        $endLastweek = mktime(23, 59, 59, date('m'), date('d') - date('w') + 7 - 21, date('Y'));
        $times['beforelastweek']['begin'] = $beginLastweek;
        $times['beforelastweek']['end'] = $endLastweek;

        //获取本月起始时间戳和结束时间戳
        $beginThismonth = mktime(0, 0, 0, date('m'), 1, date('Y'));
        $endThismonth = mktime(23, 59, 59, date('m'), date('t'), date('Y'));
        $times['thismonth']['begin'] = $beginThismonth;
        $times['thismonth']['end'] = $endThismonth;

        //获取上月的起始时间戳和结束时间戳
        $beginLastmonth = mktime(0, 0, 0, date('m') - 1, 1, date('Y'));
        $endLastmonth = mktime(23, 59, 59, date('m'), 0, date('Y'));

        $times['lastmonth']['begin'] = $beginLastmonth;
        $times['lastmonth']['end'] = $endLastmonth;

        //获取上2月的起始时间戳和结束时间戳
        $beginLastmonth = mktime(0, 0, 0, date('m') - 2, 1, date('Y'));
        $endLastmonth = mktime(23, 59, 59, date('m') - 1, 0, date('Y'));
        $times['beforelastmonth']['begin'] = $beginLastmonth;
        $times['beforelastmonth']['end'] = $endLastmonth;

        //获取今年的起始时间和结束时间
        $beginThisyear = mktime(0, 0, 0, 1, 1, date('Y'));
        $endThisyear = mktime(23, 59, 59, 12, 31, date('Y'));
        $times['thisyear']['begin'] = $beginThisyear;
        $times['thisyear']['end'] = $endThisyear;

        //获取上年的起始时间和结束时间
        $beginLastyear = mktime(0, 0, 0, 1, 1, date('Y') - 1);
        $endLastyear = mktime(23, 59, 59, 12, 31, date('Y') - 1);
        $times['lastyear']['begin'] = $beginLastyear;
        $times['lastyear']['end'] = $endLastyear;

        //获取上2年的起始时间和结束时间
        $beginLastyear = mktime(0, 0, 0, 1, 1, date('Y') - 2);
        $endLastyear = mktime(23, 59, 59, 12, 31, date('Y') - 2);
        $times['beforelastyear']['begin'] = $beginLastyear;
        $times['beforelastyear']['end'] = $endLastyear;

        //获取本季度开始时间和结束时间
        $season = ceil((date('n')) / 3);//当月是第几季度
        $beginThisSeason = mktime(0, 0, 0, $season * 3 - 3 + 1, 1, date('Y'));
        $endThisSeason = mktime(23, 59, 59, $season * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date("Y"))), date('Y'));
        $times['thisseason']['begin'] = $beginThisSeason;
        $times['thisseason']['end'] = $endThisSeason;

        //获取上季度的起始时间和结束时间
        $beginLastSeason = mktime(0, 0, 0, ($season - 1) * 3 - 3 + 1, 1, date('Y'));
        $endLastSeason = mktime(23, 59, 59, ($season - 1) * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date("Y"))), date('Y'));
        $times['lastseason']['begin'] = $beginLastSeason;
        $times['lastseason']['end'] = $endLastSeason;

        //获取上季度的起始时间和结束时间
        $beginLastSeason = mktime(0, 0, 0, ($season - 2) * 3 - 3 + 1, 1, date('Y'));
        $endLastSeason = mktime(23, 59, 59, ($season - 2) * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date("Y"))), date('Y'));
        $times['beforelastseason']['begin'] = $beginLastSeason;
        $times['beforelastseason']['end'] = $endLastSeason;
        return $times;
    }
}

/**
 * 获得指定年的，月的开始结束时间
 * @param string $date
 * @return mixed
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/8/9 0009 10:11
 */
if (!function_exists('getMonthStartEndTime')) {
    function getMonthStartEndTime($date = '')
    {
        if (empty($date)) {
            $times = time();
        } else {
            $times = strtotime($date);
        }

        //获取本月起始时间戳和结束时间戳
        $beginThismonth = mktime(0, 0, 0, date('m', $times), 1, date('Y', $times));
        $endThismonth = mktime(23, 59, 59, date('m', $times), date('t', $times), date('Y', $times));

        $rangeTime['begin'] = date("Y-m-d H:i:s", $beginThismonth);
        $rangeTime['end'] = date("Y-m-d H:i:s", $endThismonth);
        return $rangeTime;
    }
}
/**
 * 批定年月，年的起止时间
 * @param string $year
 * @return mixed
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/8/9 0009 10:13
 */
if (!function_exists('getYearStartEndTime')) {
    function getYearStartEndTime($year = '')
    {
        if (empty($year)) {
            $year = date("Y");
        }
        //获取年起始时间戳和结束时间戳
        $beginThisyear = mktime(0, 0, 0, 1, 1, $year);
        $endThisyear = mktime(23, 59, 59, 12, 31, $year);
        $rangeTime['begin'] = date("Y-m-d H:i:s", $beginThisyear);
        $rangeTime['end'] = date("Y-m-d H:i:s", $endThisyear);
        return $rangeTime;
    }
}

/**
 * 指定年月，所在季度开始，结束时间
 * @param string $date
 * @return mixed
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/8/9 0009 10:14
 */
if (!function_exists('getQuarterStartEndTime')) {
    function getQuarterStartEndTime($date = '')
    {
        if (empty($date)) {
            $times = time();
        } else {
            $times = strtotime($date);
        }
        $season = ceil((date('n', $times)) / 3);//当月是第几季度
        $rangeTime['begin'] = date('Y-m-d H:i:s', mktime(0, 0, 0, $season * 3 - 3 + 1, 1, date('Y', $times)));
        $rangeTime['end'] = date('Y-m-d H:i:s', mktime(23, 59, 59, $season * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date("Y", $times))), date('Y', $times)));
        return $rangeTime;
    }
}

/**
 * 指定日期的当天的开始时间和结束时间
 * @param string $data
 * @return mixed
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/10/29 0029 11:19
 */
if (!function_exists('getDayStartEndTime')) {
    function getDayStartEndTime($date = '')
    {
        if (empty($date)) {
            $times = strtotime(date("Y-m-d", time()));
        } else {
            $times = strtotime($date);
        }

        $start_time = strtotime(date("Y-m-d", $times));
        $end_time = $start_time + 60 * 60 * 24;

        $rangeTime['begin'] = date('Y-m-d H:i:s', $start_time);
        $rangeTime['end'] = date('Y-m-d H:i:s', $end_time);
        return $rangeTime;
    }
}

/**
 * 获取两个日期之间所有月份
 * @param string $start_time 2018-01-01
 * @param string $end_time 2019-01-01
 * @return array
 */
if (!function_exists('getDatesBetweenToMonths')) {
    function getDatesBetweenToMonths($start_time, $end_time)

    {
        $time1 = strtotime($start_time);
        $time2 = strtotime($end_time);

        $monthArray = [];
        $monthArray[] = date('Y-m', $time1); // 当前月;
        while (($time1 = strtotime('+1 month', $time1)) <= $time2) {
            $monthArray[] = date('Y-m', $time1);
        }
        return $monthArray;

    }
}

/**
 * 获取两个日期之间所有周
 * @param string $start_time 2018-01-01
 * @param string $end_time 2019-01-01
 * @return array
 */
if (!function_exists('getDatesBetweenToWeeks')) {
    function getDatesBetweenToWeeks($start_time, $end_time)

    {
        $time1 = strtotime($start_time);
        $time2 = strtotime($end_time);

        $monthArray = [];
        $monthArray[] = date('o-W', $time1); // 当前月;
        while (($time1 = strtotime('+1 week', $time1)) <= $time2) {
            $monthArray[] = date('o-W', $time1);
        }
        return $monthArray;
    }
}

/**
 * 时间段转为两个数组
 * @param $rangedate    格式为：2023/01/01 - 2023/08/08
 * @param $pirx         两个时间段分隔符号
 * @param $type         str:返回字符串，int：返回时间戳
 * @return void
 * @author: 开发人生 goodkfrs@qq.com
 * @Time: 2023/1/11 9:32
 */
if (!function_exists('rangedate2arr')) {
    function rangedate2arr($rangedate, $pirx = '-', $type = 'str')
    {
        $date_arr = str2arr($rangedate, $pirx);
        //判断是单个时间还是时间组
        if (empty($date_arr[1])) {
            $date_arr[1] = date('Y-m-d H:i:s', strtotime(" +86390 second", strtotime($date_arr[0])));
        } else {
            $date_arr[1] = date('Y-m-d H:i:s',strtotime(" +86390 second", strtotime($date_arr[1])));
        }
        $date_arr[0] = date('Y-m-d H:i:s',strtotime($date_arr[0]));
        //返回的格式，是时间戳，还是文本
        if ($type == 'int') {
            $date_arr[0] = strtotime($date_arr[0]);
            $date_arr[1] = strtotime($date_arr[1]);
        }
        return $date_arr;
    }
}

// +---------------------------------------------------------------------+
// | 字符处理相关函数
// +---------------------------------------------------------------------+

/**
 * 字符串截取，支持中文和其他编码
 *
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $suffix 截断显示字符
 * @param string $charset 编码格式
 * @return string
 */
if (!function_exists('msubstr')) {
    function msubstr($str = '', $start = 0, $length = NULL, $suffix = false, $charset = "utf-8")
    {
        if (function_exists("mb_substr"))
            $slice = mb_substr($str, $start, $length, $charset);
        elseif (function_exists('iconv_substr')) {
            $slice = iconv_substr($str, $start, $length, $charset);
            if (false === $slice) {
                $slice = '';
            }
        } else {
            $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("", array_slice($match[0], $start, $length));
        }

        $str_len = strlen($str); // 原字符串长度
        $slice_len = strlen($slice); // 截取字符串的长度
        if ($slice_len < $str_len) {
            $slice = $suffix ? $slice . '...' : $slice;
        }
        return $slice;
    }
}

/**
 * 截取内容清除html之后的字符串长度，支持中文和其他编码
 *
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $suffix 截断显示字符
 * @param string $charset 编码格式
 * @return string
 */
if (!function_exists('html_msubstr')) {
    function html_msubstr($str = '', $start = 0, $length = NULL, $suffix = false, $charset = "utf-8")
    {
        $str = htmlspecialchars_decode($str);
        $str = checkStrHtml($str);
        return msubstr($str, $start, $length, $suffix, $charset);
    }
}

/**
 * 针对多语言截取，其他语言的截取是中文语言的2倍长度
 *
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $suffix 截断显示字符
 * @param string $charset 编码格式
 * @return string
 */
if (!function_exists('text_msubstr')) {
    function text_msubstr($str = '', $start = 0, $length = NULL, $suffix = false, $charset = "utf-8")
    {
        return msubstr($str, $start, $length, $suffix, $charset);
    }
}

/**
 * 自定义只针对htmlspecialchars编码过的字符串进行解码
 *
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $suffix 截断显示字符
 * @param string $charset 编码格式
 * @return string
 */
if (!function_exists('htmlspecialchars_decode')) {
    function htmlspecialchars_decode($str = '')
    {
        if (is_string($str) && stripos($str, '&lt;') !== false && stripos($str, '&gt;') !== false) {
            $str = htmlspecialchars_decode($str);
        }
        return $str;
    }
}

/**
 * 过滤Html标签
 *
 * @param string $string 内容
 * @return    string
 */
if (!function_exists('checkStrHtml')) {
    function checkStrHtml($string)
    {
        $string = trim_space($string);

        if (is_numeric($string)) return $string;
        if (!isset($string) or empty($string)) return '';

        $string = preg_replace('/[\\x00-\\x08\\x0B\\x0C\\x0E-\\x1F]/', '', $string);
        $string = ($string);

        $string = strip_tags($string, ""); //清除HTML如<br />等代码
        // $string = str_replace("\n", "", str_replace(" ", "", $string));//去掉空格和换行
        $string = str_replace("\n", "", $string);//去掉空格和换行
        $string = str_replace("\t", "", $string); //去掉制表符号
        $string = str_replace(PHP_EOL, "", $string); //去掉回车换行符号
        $string = str_replace("\r", "", $string); //去掉回车
        $string = str_replace("'", "‘", $string); //替换单引号
        $string = str_replace("&amp;", "&", $string);
        $string = str_replace("=★", "", $string);
        $string = str_replace("★=", "", $string);
        $string = str_replace("★", "", $string);
        $string = str_replace("☆", "", $string);
        $string = str_replace("√", "", $string);
        $string = str_replace("±", "", $string);
        $string = str_replace("‖", "", $string);
        $string = str_replace("×", "", $string);
        $string = str_replace("∏", "", $string);
        $string = str_replace("∷", "", $string);
        $string = str_replace("⊥", "", $string);
        $string = str_replace("∠", "", $string);
        $string = str_replace("⊙", "", $string);
        $string = str_replace("≈", "", $string);
        $string = str_replace("≤", "", $string);
        $string = str_replace("≥", "", $string);
        $string = str_replace("∞", "", $string);
        $string = str_replace("∵", "", $string);
        $string = str_replace("♂", "", $string);
        $string = str_replace("♀", "", $string);
        $string = str_replace("°", "", $string);
        $string = str_replace("¤", "", $string);
        $string = str_replace("◎", "", $string);
        $string = str_replace("◇", "", $string);
        $string = str_replace("◆", "", $string);
        $string = str_replace("→", "", $string);
        $string = str_replace("←", "", $string);
        $string = str_replace("↑", "", $string);
        $string = str_replace("↓", "", $string);
        $string = str_replace("▲", "", $string);
        $string = str_replace("▼", "", $string);

        // --过滤微信表情
        $string = preg_replace_callback('/[\xf0-\xf7].{3}/', function ($r) {
            return '';
        }, $string);

        return $string;
    }
}

/**
 * 过滤前后空格等多种字符
 *
 * @param string $str 字符串
 * @param array $arr 特殊字符的数组集合
 * @return string
 */
if (!function_exists('trim_space')) {
    function trim_space($str, $arr = array())
    {
        if (empty($arr)) {
            $arr = array(' ', '　');
        }
        foreach ($arr as $key => $val) {
            $str = preg_replace('/(^' . $val . ')|(' . $val . '$)/', '', $str);
        }

        return $str;
    }
}

/**
 * 替换指定的符号
 *
 * @param array $arr 特殊字符的数组集合
 * @param string $replacement 符号
 * @param string $str 字符串
 * @return string
 */
if (!function_exists('func_preg_replace')) {
    function func_preg_replace($arr = array(), $replacement = ',', $str = '')
    {
        if (empty($arr)) {
            $arr = array('，');
        }
        foreach ($arr as $key => $val) {
            $str = preg_replace('/(' . $val . ')/', $replacement, $str);
        }

        return $str;
    }
}

/**字符串按符号截取
 * $str='123/456/789/abc';
 * 示例：
 * echo cut_str($str,'/',0); //输出 123
 * echo cut_str($str,'/',2); //输出 789
 * echo cut_str($str,'/',-1);//输出 abc
 * echo cut_str($str,'/',-3);//输出 456
 * @param $str
 * @param $sign
 * @param $number
 * @return string
 *
 * Author: lingqifei created by at 2020/2/29 0029
 */
if (!function_exists('cut_str')) {
    function cut_str($str, $sign, $number)
    {
        $array = explode($sign, $str);
        $length = count($array);
        if ($number < 0) {
            $new_array = array_reverse($array);
            $abs_number = abs($number);
            if ($abs_number > $length) {
                return 'error';
            } else {
                return $new_array[$abs_number - 1];
            }
        } else {
            if ($number >= $length) {
                return 'error';
            } else {
                return $array[$number];
            }
        }
    }
}

/**
 * 文件下载函数
 * Author: lingqifei created by at 2020/6/4 0004
 */
if (!function_exists('download')) {
    function download($filepath, $filename = 'downfile.zip')
    {
        // 检查文件是否存在
        if (!file_exists($filepath)) {
            $this->error('文件未找到');
        } else {
            // 打开文件
            $file1 = fopen($filepath, "r");
            // 输入文件标签
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length:" . filesize($filepath));
            Header("Content-Disposition: attachment;filename=" . $filename);
            ob_clean();     // 重点！！！
            flush();        // 重点！！！！可以清除文件中多余的路径名以及解决乱码的问题：
            //输出文件内容
            //读取文件内容并直接输出到浏览器
            echo fread($file1, filesize($filepath));
            fclose($file1);
            exit();
        }
    }
}

/**
 * 服务器文件下载输出，支持断点输出
 * @param string $file 文件路径为本地绝对路径
 *
 * @return 文件
 */
if (!function_exists('downFileOutput')) {
    function downFileOutput($file)
    {

        str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $file);
        //检查文件是否存在
        if (empty($file) or !is_file($file)) {
            die('文件不存在');
        }
        $fileName = basename($file);
        //以只读和二进制模式打开文件
        $fp = @fopen($file, 'rb');
        if ($fp) {
            // 获取文件大小
            $file_size = filesize($file);
            //告诉浏览器这是一个文件流格式的文件
            header('content-type:application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $fileName);
            // 断点续传
            $range = null;
            if (!empty($_SERVER['HTTP_RANGE'])) {
                $range = $_SERVER['HTTP_RANGE'];
                $range = preg_replace('/[\s|,].*/', '', $range);
                $range = explode('-', substr($range, 6));
                if (count($range) < 2) {
                    $range[1] = $file_size;
                }
                $range = array_combine(array('start', 'end'), $range);
                if (empty($range['start'])) {
                    $range['start'] = 0;
                }
                if (empty($range['end'])) {
                    $range['end'] = $file_size;
                }
            }
            // 使用续传
            if ($range != null) {
                header('HTTP/1.1 206 Partial Content');
                header('Accept-Ranges:bytes');
                // 计算剩余长度
                header(sprintf('content-length:%u', $range['end'] - $range['start']));
                header(sprintf('content-range:bytes %s-%s/%s', $range['start'], $range['end'], $file_size));
                // fp指针跳到断点位置
                fseek($fp, sprintf('%u', $range['start']));
            } else {
                header('HTTP/1.1 200 OK');
                header('Accept-Ranges:bytes');
                header('content-length:' . $file_size);
            }
            while (!feof($fp)) {
                echo fread($fp, 4096);
                ob_flush();
            }
            fclose($fp);
        } else {
            die('File loading failed');
        }
    }
}

/**
 * 判断文件是否存在，支持本地及远程文件
 * @param String $file 文件路径
 * @return Boolean
 */
if (!function_exists('check_file_exists')) {
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
}

/**
 *检测网址是否能正常打开
 *
 * @param $url
 * @return mixed
 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/12/25 0025
 */
if (!function_exists('httpcode')) {
    function httpcode($url)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $timeout = 5; // 设置超时的时间[单位：秒]
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        curl_exec($ch); // $resp = curl_exec($ch);
        $curl_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $curl_code;
//        if ($curl_code == 200 || $curl_code == 302) {
//            echo '连接成功，状态码：' . $curl_code;
//        } else {
//            echo '连接失败，状态码：' . $curl_code;
//        }

    }
}

/**
 * curl。post获取数据
 * @param $url
 * @param $arr_data
 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/12/25 0025
 */
if (!function_exists('curl_post')) {
    function curl_post($url, $post_data, $contentType = 'post')
    {
        //$post_data = http_build_query($post_data);

        // 请求参数类型
        $post_data = $contentType == 'json' ? urldecode(json_encode($post_data)) : http_build_query($post_data);
        //$post_data = http_build_query($post_data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:')); //设置header
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);

        $errno = curl_errno($ch);
        $info = curl_getinfo($ch);
        $error = curl_error($ch);
//		var_dump($response);
//		var_dump($error);
        curl_close($ch);//关闭
        return $response;
    }
}

/**
 * 只保留字符串首尾字符，隐藏中间用*代替（两个字符时只显示第一个）
 * @param string $user_name 姓名
 * @return string 格式化后的姓名
 */
if (!function_exists('hide_name')) {
    function hiddle_name($user_name)
    {
        $strlen = mb_strlen($user_name, 'utf-8');
        $firstStr = mb_substr($user_name, 0, 1, 'utf-8');
        $lastStr = mb_substr($user_name, -1, 1, 'utf-8');

        if ($strlen > 2) {
            return $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
        } else if ($strlen == 2) {
            return $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1);
        } else {
            return $user_name;
        }
    }
}

/**
 * 定义函数手机号隐藏中间四位
 * @param string $str 手机号
 * @return string 格式化后手机号
 */
if (!function_exists('hide_mobile')) {
    function hiddle_mobile($str)
    {
        $str = $str;
        $resstr = substr_replace($str, '****', 3, 4);
        return $resstr;
    }
}

// +---------------------------------------------------------------------+
// | 数组处理相关函数
// +---------------------------------------------------------------------+

/**
 *  生成一个随机字符
 *
 * @access    public
 * @param string $ddnum
 * @return    string
 */
if (!function_exists('dd2char')) {
    function dd2char($ddnum)
    {
        $ddnum = strval($ddnum);
        $slen = strlen($ddnum);
        $okdd = '';
        $nn = '';
        for ($i = 0; $i < $slen; $i++) {
            if (isset($ddnum[$i + 1])) {
                $n = $ddnum[$i] . $ddnum[$i + 1];
                if (($n > 96 && $n < 123) || ($n > 64 && $n < 91)) {
                    $okdd .= chr($n);
                    $i++;
                } else {
                    $okdd .= $ddnum[$i];
                }
            } else {
                $okdd .= $ddnum[$i];
            }
        }
        return $okdd;
    }
}

/**
 * 统计二数字串个数，支持按分隔符号统计
 * @param $array
 * @param $column
 * @return float|int
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/5/31 0031 15:14
 */
if (!function_exists('get_str_sum')) {
    function get_str_sum($str, $glue = '')
    {
        if ($glue) {
            $cnt = count(explode($glue, $str));
        } else {
            $cnt = mb_strlen($str);
        }
        return $cnt;
    }
}

/**
 *  PHP stdClass Object转array
 *
 * @access    public
 * @param string $ddnum
 * @return    string
 */
if (!function_exists('obj2arr')) {
    function obj2arr($array)
    {
        if (is_object($array)) {
            $array = (array)$array;
        }
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $array[$key] = obj2arr($value);
            }
        }
        return $array;
    }
}

/**
 * 统计二维数组一列后，再求和
 * @param $array
 * @param $column
 * @return float|int
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/5/31 0031 15:14
 */
if (!function_exists('get_2arr_sum')) {
    function get_2arr_sum($array, $column)
    {
        $total = array_sum(array_column($array, $column));
        $total = round($total, 2);
        return $total;
    }
}

/**
 * 删除数组中指定元素值
 * @param $array
 * @param $value
 * @return float|int
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/5/31 0031 15:14
 */
if (!function_exists('arr_del_val')) {
    //foreach遍历后unset删除,这种方法也是最容易想到的方法
    function arr_del_val($arr, $value)
    {
        if (!is_array($arr)) {
            return $arr;
        }
        foreach ($arr as $k => $v) {
            if ($v == $value) {
                unset($arr[$k]);
            }
        }
        return $arr;
    }
}

/**
 * 二维数组去重（保留各个键值的同时去除重复的项）
 * @param $arr
 * @param $key
 * @return mixed
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/8/2 0002 17:41
 */
if (!function_exists('array2unique_bykey')) {
    function array2unique_bykey($arr, $key)
    {
        $tmp_arr = array();
        foreach ($arr as $k => $v) {
            if (in_array($v[$key], $tmp_arr))   //搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
            {
                unset($arr[$k]); //销毁一个变量  如果$tmp_arr中已存在相同的值就删除该值
            } else {
                $tmp_arr[$k] = $v[$key];  //将不同的值放在该数组中保存
            }
        }
//ksort($arr); //ksort函数对数组进行排序(保留原键值key)  sort为不保留key值
        return $arr;
    }
}

/**
 * 二维数组按照指定的键来进行排序
 *
 * @param $array  二维数组
 * @param $keys  根据用来排序的键名
 * @param $sort asc升序 desc 倒序
 * @return array
 * @author: 开发人生 goodkfrs@qq.com
 * @Time: 2023/1/3 15:28
 */
if (!function_exists('array2Sort')) {
    function array2Sort($array, $keys, $sort = 'asc')
    {
        $newArr = $valArr = array();
        foreach ($array as $key => $value) {
            $valArr[$key] = $value[$keys];
        }
        ($sort == 'asc') ? asort($valArr) : arsort($valArr);
        reset($valArr);
        foreach ($valArr as $key => $value) {
            $newArr[$key] = $array[$key];
        }
        return $newArr;
    }
}

//php字符串转换表达式,php处理字符串格式的计算表达式
if (!function_exists('rowlist2arr')) {
    function rowlist2arr($datalist)
    {
        $originalArray = $datalist;
        $keys = array_keys($originalArray);
        // 初始化新数组,
        $newArray = [];
        // 遍历原数组的长度，构建新的二维数组
        foreach ($originalArray[$keys[0]] as $index => $value) {
            $newArray[] = [];
            foreach ($keys as $key) {
                $newArray[$index][$key] = empty($originalArray[$key][$index]) ? '' : $originalArray[$key][$index];
            }
        }
        return $newArray;
    }
}


/**
 * 清除html文件的空格注释信息
 * @param $uncompress_html_source
 * @return string
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2022/3/23 0023 9:33
 */
function compress_html($uncompress_html_source)
{
    $chunks = preg_split('/(<pre.*?\/pre>)/ms', $uncompress_html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
    $uncompress_html_source = '';//修改压缩html : 清除换行符,清除制表符,去掉注释标记
    foreach ($chunks as $c) {
        if (strpos($c, '<pre') !== 0) {
            //remove new lines & tabs
            $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
            // remove extra whitespace
            $c = preg_replace('/\\s{2,}/', ' ', $c);
            // remove inter-tag whitespace
            $c = preg_replace('/>\\s</', '><', $c);
            // remove CSS & JS comments
            $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
        }
        $uncompress_html_source .= $c;
    }
    return $uncompress_html_source;
}

/**合并压缩css
 * 多个CSS文件压缩为一个CSS文件
 * @param $urls
 * @return mixed|string
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2022/3/23 0023 9:34
 */
function parse_css($urls)
{
    $url = md5(implode(',', $urls));
    $path = FCPATH . 'static/parse/';
    $css_url = $path . $url . '.css';
    if (!file_exists($css_url)) {
        if (!file_exists($path))
            mkdir($path, 0777);
        $css_content = '';
        foreach ($urls as $url) {
            $css_content .= file_get_contents($url);
        }
        $css_content = str_replace("\r\n", '', $css_content); //清除换行符
        $css_content = str_replace("\n", '', $css_content); //清除换行符
        $css_content = str_replace("\t", '', $css_content); //清除制表符
        @file_put_contents($css_url, $css_content);
    }
    $css_url = str_replace(FCPATH, '', $css_url);
    return $css_url;

}

// +---------------------------------------------------------------------+
// | 判断相关函数
// +---------------------------------------------------------------------+

/**
 * 判断是否为微信打开
 * @return bool
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/12/24 0024 14:09
 */
if (!function_exists('is_weixin')) {
    function is_weixin()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        }
        return false;
    }
}

/**
 * 判断url是否完整的链接
 *
 * @param string $url 网址
 * @return boolean
 */
if (!function_exists('is_http_url')) {
    function is_http_url($url)
    {
        // preg_match("/^(http:|https:|ftp:|svn:)?(\/\/).*$/", $url, $match);
        preg_match("/^((\w)*:)?(\/\/).*$/", $url, $match);
        if (empty($match)) {
            return false;
        } else {
            return true;
        }
    }
}

/**
 * 判断系统中数据库表是否存在
 * @param $table
 * @return bool
 * @throws \think\db\exception\BindParamException
 * @throws \think\exception\PDOException
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2021/10/28 0028 18:23
 */
if (!function_exists('tableExists')) {
    function tableExists($table)
    {
        $table = SYS_DB_PREFIX . $table;
        $isTable = db()->query('SHOW TABLES LIKE ' . "'" . $table . "'");
        if ($isTable) {
            return true;//表存在
        } else {
            return false;//表不存在
        }
    }
}

/**
 * 判断系统中模块是否存在
 * @param $table
 * @return bool
 * Author: 开发人生 goodkfrs@qq.com
 * Date: 2023/03/28 0028 18:23
 */
if (!function_exists('appExists')) {
    function appExists($appname)
    {
        $table = SYS_DB_PREFIX . 'sys_module';
        $isTable = db()->query("select id from {$table} where name='" . $appname . "' and visible='1'");
        if ($isTable) {
            return true;//模块存在
        } else {
            return false;//模块不存在
        }
    }
}

// +---------------------------------------------------------------------+
// | 模块编码相关函数
// +---------------------------------------------------------------------+

/**
 * 获取系统编码
 * $name=>模块名称
 */
if (!function_exists('get_sys_seqnum')) {
    function get_sys_seqnum($name, $isupdate = false)
    {
        $time = time();
        $re = '';
        $info = db('sys_seqnum')->where(['name' => $name])->find();

        //先判断是否存在，如果不存在，调用默认的配置
        if (empty($info['enable'])) {
            //默认
            $default = [
                'salcontract' => ['pre' => 'XSHD', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'salorder' => ['pre' => 'XSDD', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'sale' => ['pre' => 'XH', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'resale' => ['pre' => 'XHTH', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'quoted' => ['pre' => 'BJD', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'poscontract' => ['pre' => 'CGHD', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'stockinto' => ['pre' => 'DB', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'stockout' => ['pre' => 'CK', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'stockcheck' => ['pre' => 'PD', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'stockchange' => ['pre' => 'DB', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'stockassemble' => ['pre' => 'ZZ', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'finpayrecord' => ['pre' => 'FK', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'finrecerecord' => ['pre' => 'HK', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'fininvoicepay' => ['pre' => 'KP', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'fininvoicerece' => ['pre' => 'SP', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'finremiburs' => ['pre' => 'BX', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'exchange' => ['pre' => 'JFDH', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1],
                'sohoworker' => ['pre' => 'SOHO', 'y' => 0, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '3', 'enable' => 1],
                'eft' => ['pre' => 'ZZDB', 'y' => 1, 'm' => 0, 'd' => 0, 'h' => 0, 'i' => 0, 's' => 0, 'suffix' => '', 'nums' => '1', 'len' => '0', 'enable' => 1]
            ];
            //编号不可为空的模块
            if (isset($default[$name])) {
                $info = $default[$name];//替换默认
            }
        }
        //再次判断启用情况
        if (!empty($info['enable'])) {
            //字符前缀
            $re .= $info['pre'];

            //日期
            !empty($info['y']) && $re .= date('Y', $time);
            !empty($info['m']) && $re .= date('m', $time);
            !empty($info['d']) && $re .= date('d', $time);
            !empty($info['h']) && $re .= date('H', $time);
            !empty($info['i']) && $re .= date('i', $time);
            !empty($info['s']) && $re .= date('s', $time);

            //数字,是否启用数字
            if (!empty($info['nums'])) {

                //字符后缀
                !empty($info['suffix']) && $re .= $info['suffix'];

                //更新编码规则自增
                $isupdate && set_sequence_nums($name, $re, $info['nums']);

                //获取模块开始数字
                $nums = get_sequence_nums($name, $re);
                if (!empty($info['len'])) {
                    $re .= str_pad($nums, $info['len'], '0', STR_PAD_LEFT);
                } else {
                    $re .= $nums;
                }
            }
        }
        return $re;
    }
}

/**
 * 获取自增编码
 */
if (!function_exists('get_sequence_nums')) {
//获取自增编码
    function get_sequence_nums($name = '', $prekey = '', $value = 1)
    {
        $db = db('sequence');
        $info = $db->where(['name' => $name, 'current_date' => $prekey])->find();
        if (!empty($info['current_value'])) {
            $value = $info['current_value'];
        } else {
            $intodata = ['name' => $name, 'current_value' => $value, 'current_date' => $prekey];
            $db->insert($intodata);
        }
        return $value;
    }
}

//更新自增编码
if (!function_exists('set_sequence_nums')) {
    function set_sequence_nums($name = '', $prekey = '')
    {
        $db = db('sequence');
        $where = ['name' => $name, 'current_date' => $prekey];
        $info = $db->where($where)->find();
        if (!empty($info['current_value'])) {
            $db->where($where)->setInc('current_value');
        }
    }
}