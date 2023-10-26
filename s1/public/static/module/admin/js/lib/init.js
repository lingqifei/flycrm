//自定义js
//为true输出日志
var debug = true;

/**
 * 打印日志
 */
function log(data) {
    if (debug) {
        if (typeof (data) == "object") {
            console.log(JSON.stringify(data)); //console.log(JSON.stringify(data, null, 4));
        } else {
            console.log(data);
        }
    }
}

//animation.css  加载动画
function animationHover(element, animation) {
    element = $(element);
    element.hover(
        function () {
            element.addClass('animated ' + animation);
        },
        function () {
            //动画完成之前移除class
            window.setTimeout(function () {
                element.removeClass('animated ' + animation);
            }, 2000);
        });
}

//公共配置
$(document).ready(function () {
    //菜单点击
    //J_iframe

    //$(document).pjax('a.J_menuItem', '.J_mainContent');

    //点击左侧菜单栏目
    $(".J_menuItem").on('click', function () {
        var url = $(this).attr('href');
        $("#J_iframe").attr('src', url);
        return false;
    });

    //小提示
    $("[data-toggle='tooltip']").tooltip();

    // MetsiMenu
    $('#side-menu').metisMenu();

    // 打开右侧边栏
    $('.right-sidebar-toggle').click(function () {
        $('#right-sidebar').toggleClass('sidebar-open');
    });

    //固定菜单栏
    $(function () {
        $('.sidebar-collapse').slimScroll({
            height: '100%',
            railOpacity: 0.9,
            alwaysVisible: false
        });
    });

    // 左边菜单切换
    $('.navbar-minimalize').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });

    // 侧边栏高度
    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");
    }
    fix_height();

    $(window).bind("load resize click scroll", function () {
        if (!$("body").hasClass('body-small')) {
            fix_height();
        }
    });

    //侧边栏滚动
    $(window).scroll(function () {
        if ($(window).scrollTop() > 0 && !$('body').hasClass('fixed-nav')) {
            $('#right-sidebar').addClass('sidebar-top');
        } else {
            $('#right-sidebar').removeClass('sidebar-top');
        }
    });

    $('.full-height-scroll').slimScroll({
        height: '100%'
    });

    $('#side-menu>li').click(function () {
        if ($('body').hasClass('mini-navbar')) {
            NavToggle();
        }
    });
    $('#side-menu>li li a').click(function () {
        if ($(window).width() < 769) {
            NavToggle();
        }
    });

    $('.nav-close').click(NavToggle);

    //ios浏览器兼容性处理
    if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
        $('#content-main').css('overflow-y', 'auto');
    }

    //选择框效果
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    //bootstrap 下拉选择
    $('.chosen-select').chosen({search_contains: true});

    //默认关闭浏览自带提示
    $("input[type='text']").attr('autocomplete', 'off');

    //授权选择 菜单 checkbox选择
    $('.menu-tree-checkbox li.has_child > span').on('click', function (e) {
        var d = $(this).siblings('ul').is(":visible");
        $(this).siblings('ul').slideToggle('fast');//.siblings('dt').css('background-position','right -40px');
        if (d) {
            console.log($(this).find(">i"));
            //$(this).find(">i").addClass('icon-minus-sign').removeClass('icon-plus-sign');
            $(this).find(">i").addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            $(this).find('>i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
            //$(this).find(">i").addClass('icon-plus-sign').removeClass('icon-minus-sign');
        }
        e.stopPropagation();
    });

    $('.menu-tree-checkbox li input[type="checkbox"]').on('click', function (e) {
        var ischecked = $(this).prop('checked');
        $(this).nextAll("ul").find("li input[type='checkbox']").prop("checked", ischecked);
        $(this).parent().parents("li.has_child").find("input[type='checkbox']:first").prop("checked", true);//保证所有低级勾选上

    });

    //表格点击行之后选中+添加颜色

});


//判断窗口是否小于769
$(window).bind("load resize", function () {
    if ($(this).width() < 769) {
        $('body').addClass('mini-navbar');
        // $('.navbar-static-side').fadeIn();
    }
});

function NavToggle() {
    $('.navbar-minimalize').trigger('click');
}

function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 100);
    } else if ($('body').hasClass('fixed-sidebar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 300);
    } else {
        $('#side-menu').removeAttr('style');
    }
}

/**
  * 将form里面的内容序列化成json
  * 相同的checkbox用分号拼接起来
  * @param {dom} 指定的选择器
  * @param {obj} 需要拼接在后面的json对象
  * @method serializeJson
  * */
$.fn.serializeJson = function (otherString) {
    var serializeObj = {},
        array = this.serializeArray();
    $(array).each(function () {
        if (serializeObj[this.name]) {
            serializeObj[this.name] += ';' + this.value;
        } else {
            serializeObj[this.name] = this.value;
        }
    });

    if (otherString != undefined) {
        var otherArray = otherString.split(';');
        $(otherArray).each(function () {
            var otherSplitArray = this.split(':');
            serializeObj[otherSplitArray[0]] = otherSplitArray[1];
        });
    }
    return serializeObj;
};

/**
 * 将josn对象赋值给form
 * @param {dom} 指定的选择器
 * @param {obj} 需要给form赋值的json对象
 * @method serializeJson
 * */
$.fn.setForm = function (jsonValue) {
    var obj = this;
    $.each(jsonValue, function (name, ival) {
        var $oinput = obj.find("input[name=" + name + "]");
        if ($oinput.attr("type") == "checkbox") {
            if (ival !== null) {
                var checkboxObj = $("[name=" + name + "]");
                var checkArray = ival.split(";");
                for (var i = 0; i < checkboxObj.length; i++) {
                    for (var j = 0; j < checkArray.length; j++) {
                        if (checkboxObj[i].value == checkArray[j]) {
                            checkboxObj[i].click();
                        }
                    }
                }
            }
        } else if ($oinput.attr("type") == "radio") {
            $oinput.each(function () {
                var radioObj = $("[name=" + name + "]");
                for (var i = 0; i < radioObj.length; i++) {
                    if (radioObj[i].value == ival) {
                        radioObj[i].click();
                    }
                }
            });
        } else if ($oinput.attr("type") == "textarea") {
            obj.find("[name=" + name + "]").html(ival);
        } else {
            obj.find("[name=" + name + "]").val(ival);
        }
    })
}

/**
 * 操纵toastor的便捷类
 * @type {{success: success, error: error, info: info, warning: warning}}
 */
var toast = {
    /**
     * 成功提示
     * @param text 内容
     * @param title 标题
     */
    success: function (text, title) {

        $(".toast").remove();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.success(text, title);
    },
    /**
     * 失败提示
     * @param text 内容
     * @param title 标题
     */
    error: function (text, title) {

        $(".toast").remove();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.error(text, title);
    },
    /**
     * 信息提示
     * @param text 内容
     * @param title 标题
     */
    info: function (text, title) {

        $(".toast").remove();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.info(text, title);
    },
    /**
     * 警告提示
     * @param text 内容
     * @param title 标题
     */
    warning: function (text, title) {

        $(".toast").remove();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.warning(text, title);
    }
};

/**
 * 搜索表单url
 */
var searchFormUrl = function (obj) {

    var url = $(obj).attr('url');
    var query = $('.search-form').find('input,select').serialize();
    query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g, '');
    query = query.replace(/^&/g, '');
    if (url.indexOf('?') > 0) {
        url += '&' + query;
    } else {
        url += '?' + query;
    }

    return url;
};


//将url转化为json数据
function url2json(url) {
    let arr = []; //存储参数的数组
    let res = {}; //存储最终JSON结果对象
    arr = url.split("?")[1].split("&"); //arr=["a=1", "b=2", "c=test", "d"]

    for (let i = 0, len = arr.length; i < len; i++) {
        //如果有等号，则执行赋值操作
        if (arr[i].indexOf("=") != -1) {
            let str = arr[i].split("=");
            //str=[a,1];
            res[str[0]] = str[1];
        } else {//没有等号，则赋予空值
            res[arr[i]] = "";
        }
    }
    res = JSON.stringify(res);//转化为JSON字符串
    return res; //{"a": "1", "b": "2", "c": "test", "d": ""}
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


/**
 * null => ''
 * @param {*} data 要处理的数据
 */
function null2zero(data) {
    for (let x in data) {
        if (data[x] === null) { // 如果是null 把直接内容转为 ''
            data[x] = '0';
        } else {
            if (Array.isArray(data[x])) { // 是数组遍历数组 递归继续处理
                data[x] = data[x].map(z => {
                    return null2zero(z);
                });
            }
            if (typeof (data[x]) === 'object') { // 是json 递归继续处理
                data[x] = null2zero(data[x])
            }
        }
    }
    return data;
}


/*-----页面pannel内容区高度自适应 start-----*/
$(window).resize(function () {
    setCenterHeight();
});
function setCenterHeight() {
    var height = $(window).height();
    var centerHight = height - 40;
    $(".auto-height-box").height(centerHight).css("overflow", "auto");
    $(".auto-height-box").css("background", "#fff");
}
setCenterHeight();//自适应高度
/*-----页面pannel内容区高度自适应 end-----*/

//文字转为图片
function textToImg(str) {
    var name, fsize;
    if (str.length < 2) {
        name = str;
        fsize = 60
    } else {
        if (str.length == 2) {
            name = str.substring(0, str.length);
            fsize = 45
        } else {
            if (str.length == 3) {
                name = str.substring(0, str.length);
                fsize = 30
            } else {
                if (str.length == 4) {
                    name = str.substring(0, str.length);
                    fsize = 25
                } else {
                    if (str.length > 4) {
                        name = str.substring(0, 2);
                        fsize = 45
                    }
                }
            }
        }
    }
    var fontSize = 60;
    var fontWeight = "bold";
    var canvas = document.getElementById("head_canvas_default");
    var img1 = document.getElementById("head_canvas_default");
    canvas.width = 120;
    canvas.height = 120;
    var context = canvas.getContext("2d");
    context.fillStyle = getBG();
    context.fillRect(0, 0, canvas.width, canvas.height);
    context.fillStyle = "#FFF";
    context.font = fontWeight + " " + fsize + "px sans-serif";
    context.textAlign = "center";
    context.textBaseline = "middle";
    context.fillText(name, fontSize, fontSize);
    return canvas.toDataURL("image/png")
}
//随机颜色
function getBG() {
    var bgArray = ["#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e",
        "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50", "#f1c40f",
        "#e67e22", "#e74c3c", "#eca0f1", "#95a5a6", "#f39c12", "#d35400",
        "#c0392b", "#bdc3c7", "#7f8c8d"];
    var color = bgArray[Math.floor(Math.random() * bgArray.length)];
    return color
};
