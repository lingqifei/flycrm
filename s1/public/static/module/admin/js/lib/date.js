/**
 * 获取本周、本季度、本月、上月的开始日期、结束日期
 */
var now = new Date(); //当前日期
var nowDayOfWeek = now.getDay(); //今天本周的第几天
var nowDay = now.getDate(); //当前日
var nowMonth = now.getMonth(); //当前月
var nowYear = now.getYear(); //当前年
nowYear += (nowYear < 2000) ? 1900 : 0; //

var lastMonthDate = new Date(); //上月日期
lastMonthDate.setDate(1);
lastMonthDate.setMonth(lastMonthDate.getMonth() - 1);
var lastYear = lastMonthDate.getYear();
var lastMonth = lastMonthDate.getMonth();

// 初始化时间插件格式
$(document).ready(function () {
    // //日期选择插件yyyy-mm-dd
    $(".datepicker").datepicker({
        language: "zh-CN",
        minView: 'year',
        todayHighlight: true,
        autoclose: true,//选中之后自动隐藏日期选择框
        clearBtn: true,//清除按钮
        todayBtn: "linked",//今日按钮
        minView: 'day',
        maxView: 2,
        format: "yyyy-mm-dd"
    });

    // //日期时间选择插件 yyyy-mm-dd H:i:s
    $(".datetimepicker").datetimepicker({
        language: "zh-CN",
        autoclose: true,//选中之后自动隐藏日期选择框
        clearBtn: true,//清除按钮
        todayBtn: true,//今日按钮
        format: "yyyy-mm-dd hh:ii:ss",
    });

    // //日期时间选择插件 yyyy-mm-dd H:i:s
    $(".datetimepicker-clock").datetimepicker({
        language: "zh-CN",
        startView: 'day',
        //minView : 'day',
        //maxView:2,
        autoclose: true,//选中之后自动隐藏日期选择框
        clearBtn: true,//清除按钮
        todayBtn: true,//今日按钮
        format: "hh:ii",
    });

    // //日期时间选择插件 yyyy-mm-dd H:i:s
    $(".datetimepicker-now").datetimepicker({
        language: "zh-CN",
        autoclose: true,//选中之后自动隐藏日期选择框
        clearBtn: true,//清除按钮
        todayBtn: true,//今日按钮
        format: "yyyy-mm-dd hh:ii:ss",
        initialDate: new Date(),
    });

    //设置当前时间
    $(".datetimepicker-now").datetimepicker("setDate", new Date())

    //只选择月份
    $('.datepicker-month').datepicker({
        format: 'yyyy-mm',
        language: "zh-CN",
        autoclose: true,
        startView: 1,
        minViewMode: 1,
        maxViewMode: 1
    });

    //只选择月份
    $(".datetimepicker-year").datetimepicker({
        language: 'ch',
        format: 'yyyy',
        autoclose: true,
        todayBtn: true,
        startView: 'decade',
        minView: 'decade',
        maxView: 'decade',
    });

    // //日期时间选择插件 yyyy-mm-dd H:i:s
    $('.clockpicker').clockpicker();

    //根据开始时间 计算出结束时间
    $("body").on("click", ".date-add-interval", function () {
        var gid = $(this).attr('data-gid');
        var number = $(this).attr('data-val');
        var interval = $(this).attr('data-type');
        var format = $(this).attr('data-fmt');

        var gdate = $(this).parents('form').find("input[name='" + gid + "']").val();

        var newdate = DateAdd(interval, number, gdate)
        var sdate = newdate.Format(format);

        var sid = $(this).attr('data-sid');
        $(this).parents('form').find("input[name='" + sid + "']").val(sdate);
    });

    //根据工作报告类型得到时间
    $('.work_type_time').each(function () {
        var value = $(this).val();
        var sid = $(this).attr("data-sid");
        var eid = $(this).attr("data-eid");
        var sdate = $(this).parents('form').find("input[name='" + sid + "']").val();
    });

    //选择工作报告类型
    $("body").on("change", ".work_type_time", function () {
        var value = $(this).val();
        var sid = $(this).attr("data-sid");
        var eid = $(this).attr("data-eid");
        var sdate = $(this).parents('form').find("input[name='" + sid + "']").val();
        if (value == 0) {
            $(this).parents('form').find("input[name='" + sid + "']").val(formatDate(now));
            $(this).parents('form').find("input[name='" + eid + "']").val(formatDate(now));
        } else if (value == 1) {
            $(this).parents('form').find("input[name='" + sid + "']").val(getWeekStartDate());
            $(this).parents('form').find("input[name='" + eid + "']").val(getWeekEndDate());
        } else if (value == 2) {
            $(this).parents('form').find("input[name='" + sid + "']").val(getMonthStartDate());
            $(this).parents('form').find("input[name='" + eid + "']").val(getMonthEndDate());
        }
    });

});

//计算时间函数
//interval 增加时间类型 y m h    number=增加的值  gdate=当前时间
function DateAdd(interval, number, gdate) {
    if (gdate == '' || gdate == null) {
        var date = new Date();
    } else {
        var date = new Date(gdate);
    }

    var number = parseFloat(number);
    switch (interval) {
        case "y": {
            date.setFullYear(date.getFullYear() + number);
            return date;
            break;
        }
        case "q": {
            date.setMonth(date.getMonth() + number * 3);
            return date;
            break;
        }
        case "m": {
            date.setMonth(date.getMonth() + number);
            return date;
            break;
        }
        case "w": {
            date.setDate(date.getDate() + number * 7);
            return date;
            break;
        }
        case "d": {
            date.setDate(date.getDate() + number);
            return date;
            break;
        }
        case "h": {
            date.setHours(date.getHours() + number);
            return date;
            break;
        }
        case "m": {
            date.setMinutes(date.getMinutes() + number);
            return date;
            break;
        }
        case "s": {
            date.setSeconds(date.getSeconds() + number);
            return date;
            break;
        }
        default: {
            date.setDate(d.getDate() + number);
            return date;
            break;
        }
    }
}

//格式化日期：yyyy-MM-dd
function formatDate(date) {
    var myyear = date.getFullYear();
    var mymonth = date.getMonth() + 1;
    var myweekday = date.getDate();

    if (mymonth < 10) {
        mymonth = "0" + mymonth;
    }
    if (myweekday < 10) {
        myweekday = "0" + myweekday;
    }
    return (myyear + "-" + mymonth + "-" + myweekday);
}

//获得某月的天数
function getMonthDays(myMonth) {
    var monthStartDate = new Date(nowYear, myMonth, 1);
    var monthEndDate = new Date(nowYear, myMonth + 1, 1);
    var days = (monthEndDate - monthStartDate) / (1000 * 60 * 60 * 24);
    return days;
}

//获得本季度的开始月份
function getQuarterStartMonth() {
    var quarterStartMonth = 0;
    if (nowMonth < 3) {
        quarterStartMonth = 0;
    }
    if (2 < nowMonth && nowMonth < 6) {
        quarterStartMonth = 3;
    }
    if (5 < nowMonth && nowMonth < 9) {
        quarterStartMonth = 6;
    }
    if (nowMonth > 8) {
        quarterStartMonth = 9;
    }
    return quarterStartMonth;
}

//获得本周的开始日期
function getWeekStartDate() {
    var weekStartDate = new Date(nowYear, nowMonth, nowDay - nowDayOfWeek + 1);
    return formatDate(weekStartDate);
}

//获得本周的结束日期
function getWeekEndDate() {
    var weekEndDate = new Date(nowYear, nowMonth, nowDay + (6 - nowDayOfWeek) + 1);
    return formatDate(weekEndDate);
}

//获得本月的开始日期
function getMonthStartDate() {
    var monthStartDate = new Date(nowYear, nowMonth, 1);
    return formatDate(monthStartDate);
}

//获得本月的结束日期
function getMonthEndDate() {
    var monthEndDate = new Date(nowYear, nowMonth, getMonthDays(nowMonth));
    return formatDate(monthEndDate);
}

//获得上月开始时间
function getLastMonthStartDate() {
    var lastMonthStartDate = new Date(nowYear, lastMonth, 1);
    return formatDate(lastMonthStartDate);
}

//获得上月结束时间
function getLastMonthEndDate() {
    var lastMonthEndDate = new Date(nowYear, lastMonth, getMonthDays(lastMonth));
    return formatDate(lastMonthEndDate);
}

//获得本季度的开始日期
function getQuarterStartDate() {

    var quarterStartDate = new Date(nowYear, getQuarterStartMonth(), 1);
    return formatDate(quarterStartDate);
}

//或的本季度的结束日期
function getQuarterEndDate() {
    var quarterEndMonth = getQuarterStartMonth() + 2;
    var quarterStartDate = new Date(nowYear, quarterEndMonth, getMonthDays(quarterEndMonth));
    return formatDate(quarterStartDate);
}

//时间格式转换
jQuery.fn.extend(Date.prototype, {
    Format: function (fmt) {
        var o = {
            "M+": this.getMonth() + 1, //月份
            "d+": this.getDate(), //日
            "h+": this.getHours(), //小时
            "m+": this.getMinutes(), //分
            "s+": this.getSeconds(), //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds() //毫秒
        };
        if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        for (var k in o)
            if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        return fmt;
    },
    /* 给Date的原型添加年运算的方法
	* @param {Object} num  要加减的时间的数量,加时间填正整数，减时间填负整数
	*/
    opYear: function (num) {
        var d = this.getFullYear();
        this.setFullYear(d + num);
        return this;
    },
    /* 给Date的原型添加月运算的方法
    * @param {Object} num  要加减的时间的数量,加时间填正整数，减时间填负整数
    */
    opMonth: function (num) {
        var d = this.getMonth();
        this.setMonth(d + num);
        return this;
    },
    /* 给Date的原型添加天运算的方法
    * @param {Object} num  要加减的时间的数量,加时间填正整数，减时间填负整数
    */
    opDay: function (num) {
        var d = this.getDate();
        this.setDate(d + num);
        return this;
    },
    /* 给Date的原型添加分钟运算的方法
    * @param {Object} num  要加减的时间的数量,加时间填正整数，减时间填负整数
    */
    opMinutes: function (num) {
        var d = this.getMinutes();
        this.setMinutes(d + num);
        return this;
    },

    /***参数都是以周一为基准的***/
    //上周的开始时间
    //console.log(getTime(7));
    //上周的结束时间
    //console.log(getTime(1));
    //本周的开始时间
    //console.log(getTime(0));
    //本周的结束时间
    //console.log(getTime(-6));
    getWeekTime: function (n) {
        var year = this.getFullYear();
        //因为月份是从0开始的,所以获取这个月的月份数要加1才行
        var month = this.getMonth() + 1;
        var date = this.getDate();
        var day = this.getDay();
//		console.log(date);
        //判断是否为周日,如果不是的话,就让今天的day-1(例如星期二就是2-1)
        if (day !== 0) {
            n = n + (day - 1);
        } else {
            n = n + day;
        }
        if (day) {
            //这个判断是为了解决跨年的问题
            if (month > 1) {
                month = month;
            } else {
                //这个判断是为了解决跨年的问题,月份是从0开始的
                year = year - 1;
                month = 12;
            }
        }
        this.setDate(this.getDate() - n);
        year = this.getFullYear();
        month = this.getMonth() + 1;
        date = this.getDate();
//		console.log(year+"-"+(month<10?('0'+month):month)+"-"+(date<10?('0'+date):date));
        return year + "-" + (month < 10 ? ('0' + month) : month) + "-" + (date < 10 ? ('0' + date) : date);
    },
    pattern: function (fmt) {
        var o = {
            "M+": this.getMonth() + 1, //月份
            "d+": this.getDate(), //日
            "h+": this.getHours() % 24 == 0 ? 24 : this.getHours() % 24, //小时
            "H+": this.getHours(), //小时
            "m+": this.getMinutes(), //分
            "s+": this.getSeconds(), //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds() //毫秒
        };
        var week = {
            "0": "/u65e5",
            "1": "/u4e00",
            "2": "/u4e8c",
            "3": "/u4e09",
            "4": "/u56db",
            "5": "/u4e94",
            "6": "/u516d"
        };
        if (/(y+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        }
        if (/(E+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, ((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? "/u661f/u671f" : "/u5468") : "") + week[this.getDay() + ""]);
        }
        for (var k in o) {
            if (new RegExp("(" + k + ")").test(fmt)) {
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            }
        }
        return fmt;
    }
});
// 时间格式转换  =》 调用方法
// var date = new Date();
// console.log(date.pattern("yyyy-MM-dd hh:mm:ss E")); // 2022-09-22 16:30:00 周四
// console.log(date.pattern("yy-M-d h:m:s q")); // 22-9-22 4:30:00 3
// console.log(date.pattern("yyyy-MM-dd E")); // 2022-09-22 周四
