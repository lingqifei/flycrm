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

//animation.css
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

//初始化一些效果
$(function () {

    //实现全选反选
    $(".checkboxCtrl").on('click', function () {
        $("tbody input[class='checkboxCtrlId']:checkbox").prop("checked", $(this).prop('checked'));
    });

    //全局返回
    $(".btn-history").on('click', function () {
        window.history.go(-1);
    });

    //刷新验证码
    $(".captcha_change").click(function () {
        var captcha_img_obj = $("#captcha_img");
        captcha_img_obj.attr("src", captcha_img_obj.attr("src") + "?" + Math.random());
    });

    //表格行超出之后隐藏
    $("body").on("click", ".overflow-td", function () {
        var that = $(this);
        var cont = $(this).html();
        //小tips
        layer.tips(cont, that, {
            tips: [4, '#3595CC'],
            time: 9000
        });
    });

    //菜单授权全选择
    $('.auth-box .rules_all').click(function () {
        $(this).parent().parent().next('.ibox-content').find("input").prop("checked", $(this).prop('checked'));
    });

    //树形目录展开，折叠
    $(".treeClassBody lable").click(function () {
        var UL = $(this).parent().siblings("ul");
        $(this).html('');
        if (UL.css("display") == "none") {
            UL.css("display", "block");
            $(this).html(' - ');
        } else {
            UL.css("display", "none");
            $(this).html(' + ');
        }
    });

    $("body").on("click", ".collapse-link", function () {
        $(this).find('i').toggleClass("fa-chevron-up");
        $(this).find('i').toggleClass("fa-chevron-down");
    });

    //设置有搜索列表页中，点击加回车提交搜索
    $("body").keydown(function (e) {
        var e = event || window.event;
        if (e.keyCode == 13) {
            $("form.searchForm .btn-primary.ajaxSearchForm").click();
        }
    });

});


//分页插件********************************************************************
var orderField = ''; //排序字字段
var orderDirection = '';//升序、降序
var pageSize = '';//每页条数
var pageNum = '';//第几页
var ajaxSearchFormData = '';//表单查询参数

//数据排序、样式操作
$("body").on("click", ".ajax-list-table .sort-filed", function () {
    $(this).toggleClass(function () {
        orderField = $(this).attr('orderField');
        if ($(this).hasClass('asc')) {
            $(this).removeClass('asc');
            orderDirection = 'desc';
            turnPage(1);
            return 'desc';
        } else {
            $(this).removeClass('desc');
            orderDirection = 'asc';
            turnPage(1);
            return 'asc';
        }
    })
});

//查询数据，刷新
$('.ajaxSearchForm').click(function () {
    $(this).children("input").prop("checked", true);
    var searchform = $(this).parents("form");

    //是否重置搜索条件
    if ($(this).hasClass('resetForm')) {
        searchform[0].reset();
        // searchform.find('input[type=text],select,input[type=hidden]').each(function() {
        //     $(this).val('');
        //  });

    }

    ajaxSearchFormData = searchform.serialize();
    turnPage(1);
});

//查询条件下拉时搜索
$("body").on("change", ".searchForm select", function () {
    var searchform = $(this).parents("form");
    var searchform = $(this);
    ajaxSearchFormData = searchform.serialize();
    turnPage(1);
})


//设置分页每页条数及跳转页数
$("body").on("change", ".tfootPageBar", function () {

    var ajaxListTable = $('.ajax-list-table');

    pageNum = ajaxListTable.find("tfoot td input[name='pageNum']").val();

    if (pageNum == null) pageNum = '';

    ajaxSearchFormData = $("form").serialize();

    turnPage(pageNum, ajaxListTable);
});

//输入页数跳转到批定页
$("body").on("click", ".tfootClickPageNum", function () {
    var ajaxListTable = $('.ajax-list-table');
    pageNum = $(this).attr('data-id')
    ajaxSearchFormData = $("form").serialize();
    turnPage(pageNum, ajaxListTable);
});


//获取分页数据及模板
function turnPage(pageNum, ajaxListTable = '') {

    //查询表单
    var searchForm = $('.searchForm');

    //如果没有传入对像默认为
    if (ajaxListTable == '') {
        var ajaxListTable = $('.ajax-list-table');
    }

    var ajaxUrl = ajaxListTable.attr("data-url");

    //获取查询表单数据
    //ajaxSearchFormData = searchForm.serialize();
    var searchItemData = localStorage.getItem(ajaxUrl);

    pageSize = ajaxListTable.find("tfoot td input[name='pageSize']").val();

    if (pageSize == null) pageSize = '';

    // 为在保存搜索条件离开返回不失效
    if (pageSize == '' && ajaxSearchFormData == '') {

        log("第一步：进入pagesize=0,ajaxsearch=''：");

        if (searchItemData != null && searchItemData != 'null') {

            log("第二步：判断是否之前点击查询过，searchItemData：" + searchItemData);

            //searchForm.setForm(JSON.parse(url2json('?'+searchItemData)));

            ajaxSearchFormData = searchItemData;

        } else {
            log("第二步：还没有点击查询，直接获取表单数据：");
            ajaxSearchFormData = $("form").serialize();
        }

    } else {

        ajaxSearchFormData = $("form").serialize();
        log("第一步：点击查询了：ajaxSearchFormData:" + ajaxSearchFormData);

    }

    //存储上次查询条件
    localStorage.setItem(ajaxUrl, decodeURIComponent(ajaxSearchFormData));

    //ajax 请求数据
    ajaxSearchFormData = $("form").serialize();
    ajaxPostJsonData = ajaxSearchFormData + "&pageNum=" + pageNum + "&pageSize=" + pageSize + "&orderField=" + orderField + "&orderDirection=" + orderDirection;

    // log(ajaxPostJsonData);
    $.ajax({
        type: 'POST',
        url: ajaxUrl,     //这里是请求的后台地址，自己定义
        //data: {'pageNum':page,'orderField':orderField,'orderDirection':orderDirection,'textData':textData},
        data: ajaxPostJsonData,
        dataType: 'json',
        beforeSend: function () {
            layer.msg('加载数据',
                {
                    time: 1000,
                    icon: 16,
                    shade: 0.01
                }
            );
        },
        success: function (returnJsonData) {
            if (returnJsonData.code == 0) {
                toast.error(returnJsonData.msg);
            }
            //移除原来的文档
            ajaxListTable.find("tbody").empty();
            totalCount = returnJsonData.total;
            pageSize = returnJsonData.per_page;
            pageNum = returnJsonData.current_page;
            //returnJsonData=null2str(returnJsonData);
            //模板引擎使用
            var tpl = baidu.template;
            var html = tpl('tableListTpl', returnJsonData);
            ajaxListTable.find("tbody").html(html);
        },
        complete: function () {

            //1、添加分页按钮栏
            getPageBar(ajaxListTable, pageNum, pageSize, totalCount);

            //2、判断表格是否设置显示列
            if ($('a').is('.btn-field-set')) {
                initTableCell();
            }

        },
        error: function () {
            layer.msg('数据加载失败', {
                icon: 5,
                shade: 0.01
            });
        }
    });
}

//获取分页条（分页按钮栏的规则和样式根据自己的需要来设置）
function getPageBar(object, pageNum, pageSize, totalCount) {

    var pageNum = parseInt(pageNum);
    var pageSize = parseInt(pageSize);
    var totalPage = Math.ceil(totalCount / pageSize);
    if (pageNum > totalPage) {
        pageNum = totalPage;
    }
    if (pageNum < 1) {
        pageNum = 1;
    }
    var pageBar;
    pageBar = "<div class='page-list'>";
    pageBar += "<div class=\"btn-group\"> <span class='btn btn-white'> 共 " + totalCount + "条 </span>";
    pageBar += "<span class='btn btn-white'> 每页 <input type='text' name='pageSize' class='tfootPageBar pageSize' style='width:50px;height:20px;border:solid #ccc 1px;' value='" + pageSize + "'> 条 </span>";
    //如果不是第一页
    pageBar += "<span class='btn btn-white tfootClickPageNum' data-id='0'><a>首页</a></span>";
    pageBar += "<span type=\"button\" class=\"btn btn-white tfootClickPageNum\" data-id='" + (pageNum - 1) + "'><a><< </a> </span>";

    //显示的页码按钮(5个)
    var start = 1,
        end = 0;
    if (totalPage <= 5) {
        start = 1;
        end = totalPage;
    } else {
        if (pageNum - 2 <= 0) {
            start = 1;
            end = 5;
        } else {
            if (totalPage - pageNum < 2) {
                start = totalPage - 4;
                end = totalPage;
            } else {
                start = pageNum - 2;
                end = pageNum + 2;
            }
        }
    }
    for (var i = start; i <= end; i++) {
        if (i == pageNum) {
            pageBar += "<span class='btn btn-white tfootClickPageNum active' data-id='" + i + "'><a>" + i + "</a></span>";
        } else {
            pageBar += "<span class='btn btn-white tfootClickPageNum'  data-id='" + i + "' ><a>" + i + "</a></span>";
        }
    }

    //如果不是最后页
    /*if (pageNum != totalPage) {
        pageBar += "<span class='btn btn-white' onlick='javascript:turnPage(" + (parseInt(pageNum) + 1) + ")'>>></span>";
        pageBar += "<span class='btn btn-white' onlick='javascript:turnPage(" + totalPage + ")'>尾页</span>";
    }*/
    pageBar += "<span class='btn btn-white tfootClickPageNum' data-id='" + (parseInt(pageNum) + 1) + "'><a> >> </a></span>";
    pageBar += "<span class='btn btn-white tfootClickPageNum' data-id='" + (parseInt(totalPage)) + "'><a>尾页</a></span>";
    pageBar += "<span class='btn btn-white'> 跳 <input type='text' name='pageNum' class='tfootPageBar pageNum' style='width:50px;height:20px;border:solid #ccc 1px;'> 页 <a>GO</a></span>";
    pageBar += "</div></div>";

    if (totalCount == 0) {
        object.find("tfoot td").html('噢噢噢，暂时没有查询到数据~~');
    } else {
        object.find("tfoot td").html(pageBar);
    }


}

//ajax打开,跳转到指定页面
$("body").on("click", ".ajax-goto", function () {

    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        var tit = $(this).attr('data-title');//打开标题

        //是否设置了参数字段
        // 参数格式：data-ids="{"name":'value}
        var ids = $(this).attr('data-ids');//判断是否有参数传
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }

        //是否设置导出标签
        //配套标签：target-from=''search from'
        if ($(this).hasClass('export')) {
            var target_form = $(this).attr('target-form');
            var form = $('.' + target_form);
            var query = form.serialize();
            var target = target + "?" + query;
        }
        log('执行地址：' + target);
        if ($(this).attr('target') == '_blank') {
            window.open(target)
        } else {
            window.location.href = target;
        }
    }
    return false;
});

//ajax打开
$("body").on("click", ".ajax-open", function () {

    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        var tit = $(this).attr('data-title');//打开标题
        var fun = $(this).attr('data-calback');//回调函数

        //是否带参数字段
        //参数传，支持多个参数传送 格式：data-ids="{'tid':'2',''name':'张三'}"
        var ids = $(this).attr('data-ids');
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }

        //是否设置了单个值
        var id = $(this).attr("data-id");
        if (typeof (id) != "undefined" && id != 0) {
            var target = target + "?id=" + id;
        }
        log('打开地址：' + target);
        layer.open({
            type: 2,
            title: false,
            shadeClose: false,
            //btn: ['关闭'],
            fixed: true, //不固定
            area: ['90%', '90%'],
            content: target,
            success: function (layero, index) {
                layer.iframeAuto(index);
            },
            end: function () {
                if (fun != null) {
                    eval(fun);
                    log('执行回调函数：' + fun);
                } else {
                    turnPage(pageNum);
                }
            }
        });
    }
    return false;
});

//ajax打开
//可以选择多个checkbox值r同时传送参数
$("body").on("click", ".ajax-open-more", function () {

    var title = $(this).attr('data-title');//打开标题
    var ids = $(this).attr('data-ids');//判断是否有参数传
    var fun = $(this).attr('data-calback');//判断是否有回调函数
    var checkedVal = [];

    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        $('.ajax-list-table tbody input[type="checkbox"]:checked').each(function () {
            checkedVal.push($(this).val());
        });
        cIds = checkedVal.join(',');
        if (cIds.length > 0) {
            var target = target + "?id=" + cIds;
        } else {
            layer.msg('请选择批量操作数据', {icon: 5});
            return false;
        }
        //是否设置了参数字段
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }

        log('打开地址：' + target);

        layer.open({
            type: 2,
            title: false,
            shadeClose: false,
            //btn: ['关闭'],
            fixed: true, //不固定
            area: ['90%', '90%'],
            content: target,
            success: function (layero, index) {
                layer.iframeAuto(index);
            },
            end: function () {
                log(fun);
                if (fun != null) {
                    eval(fun);
                } else {
                    turnPage(pageNum);
                }
            }
        });

    }
    return false;
});

// ajax删除
$("body").on("click", ".ajax-del", function () {

    var target;

    if ($(this).hasClass('confirm')) {
        if (!confirm('确认要执行该操作吗?')) {
            return false;
        }
    }

    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        var ids = $(this).attr('data-ids');
        var fun = $(this).attr('data-calback');

        //是否设置了参数字段
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }
        log('执行地址：' + target);

        if ($(this).attr('is-jump') == 'true') {

            $.pjax({url: target, container: '.content'});

        } else {
            $.get(target).success(function (data) {
                if (data.code) {
                    parent.layer.msg(data.msg, {icon: 1});
                    if (fun != null) {
                        log(fun);
                        eval(fun);
                    } else {
                        setTimeout(function () {
                            turnPage(pageNum);
                        }, 1500);
                    }
                } else {
                    parent.layer.msg(data.msg, {icon: 5});
                }
            }, "json");
        }
    }
    return false;
});

//ajax get请求
$("body").on("click", ".ajax-get", function () {


    if ($(this).hasClass('confirm')) {
        if (!confirm('确认要执行该操作吗?')) {
            return false;
        }
    }

    var target;
    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        var ids = $(this).attr('data-ids');//判断是否有参数传
        var fun = $(this).attr('data-calback');//判断是否有回调函数
        //是否设置了参数字段
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }

        $.get(target).success(function (data) {
            if (data.code) {
                parent.layer.msg(data.msg, {icon: 1});
                if (fun != null) {
                    eval(fun);
                } else {
                    setTimeout(function () {
                        turnPage(pageNum);
                    }, 1500);
                }
            } else {
                parent.layer.msg(data.msg, {icon: 5});
            }
            //如果传了地址表示跳转
            // if (data.url) {
            //     setTimeout(function () {
            //         location.href = data.url;
            //     }, 1500);
            // }
            // lqfalert(data);
        }, "json");
    }
    return false;
});

//ajax get -more 请求 t选择多个时使用
$("body").on("click", ".ajax-get-more", function () {

    var target;
    var cIds = "";
    if (!confirm('确认要执行该操作吗?')) {
        return false;
    }
    var checkedArr = $('.ajax-list-table input[class="checkboxCtrlId"]:checked');

    checkedArr.each(function () {
        cIds += $(this).val() + ",";
    });

    if (cIds.length > 0) {
        cIds = cIds.substring(0, cIds.length - 1);
        if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {
            var ids = $(this).attr('data-ids');//判断是否有参数传
            var fun = $(this).attr('data-calback');//判断是否有回调函数

            //是否设置了参数字段
            if (typeof (ids) != "undefined" && ids != 0) {
                var ids = ($.param(eval('(' + ids + ')'), true));
                var target = target + "?" + ids;
            }

            $.post(target, {id: cIds}, function (data) {
                if (data.code) {
                    parent.layer.msg(data.msg, {icon: 1});
                    if (fun != null) {
                        eval(fun);
                    } else {
                        turnPage(pageNum);
                    }
                } else {
                    parent.layer.msg(data.msg, {icon: 5});
                }
            }, "json");

        }
    } else {
        parent.layer.msg('请选择批量操作数据', {icon: 5});
    }
    return false;
});

// PJAX模式重写表单POST提交处理
$("body").on("click", ".ajax-post", function () {
    var target, query, form;
    var target_form = $(this).attr('target-form');
    var that = this;
    var nead_confirm = false;

    if (($(this).attr('type') == 'submit') || (target = $(this).attr('href')) || (target = $(this).attr('url'))) {

        form = $('.' + target_form);

        if ($(this).attr('hide-data') === 'true') {//无数据时也可以使用的功能

            form = $('.hide-data');
            query = form.serialize();

        } else if (form.get(0) == undefined) {

            return false;

        } else if (form.get(0).nodeName == 'FORM') {

            if ($(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }

            if ($(this).attr('url') !== undefined) {
                target = $(this).attr('url');
            } else {
                target = form.get(0).action;
            }
            query = form.serialize();

        } else if (form.get(0).nodeName == 'INPUT' || form.get(0).nodeName == 'SELECT' || form.get(0).nodeName == 'TEXTAREA') {

            form.each(function (k, v) {
                if (v.type == 'checkbox' && v.checked == true) {
                    nead_confirm = true;
                }
            })

            if (nead_confirm && $(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }

            query = form.serialize();
        } else {

            if ($(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }
            query = form.find('input,select,textarea').serialize();
        }

        var is_repeat_button = $(that).hasClass('no-repeat-button');

        if (is_repeat_button) {
            $(that).prop('disabled', true);
        }

        $.ajax({
            type: "POST",
            url: target,
            data: query,
            dataType: "json",
            success: function (result) {
                if (result.code == '1') {
                    layer.msg(result.msg, {icon: 1, time: 500, shade: [0.5, '#000', true]}, function () {
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                    });
                } else {
                    //toastr.error(result.msg);
                    layer.msg(result.msg, {icon: 5});
                }
            },
            complete: function () { //执行完之后执行
                if (is_repeat_button) {
                    $(that).prop('disabled', false);
                }
            },
        });//end ajax post

    }
    return false;
});


// 提交~针对本页
$("body").on("click", ".ajax-post-trace", function () {
    var target, query, form;
    var target_form = $(this).attr('target-form');
    var that = this;
    var nead_confirm = false;
    var fun = $(this).attr('data-calback');//判断是否有回调函数

    if (($(this).attr('type') == 'submit') || (target = $(this).attr('href')) || (target = $(this).attr('url'))) {
        form = $('.' + target_form);
        if ($(this).attr('hide-data') === 'true') {//无数据时也可以使用的功能
            form = $('.hide-data');
            query = form.serialize();
        } else if (form.get(0) == undefined) {

            return false;

        } else if (form.get(0).nodeName == 'FORM') {

            if ($(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }

            if ($(this).attr('url') !== undefined) {
                target = $(this).attr('url');
            } else {
                target = form.get(0).action;
            }
            query = form.serialize();

        } else if (form.get(0).nodeName == 'INPUT' || form.get(0).nodeName == 'SELECT' || form.get(0).nodeName == 'TEXTAREA') {

            form.each(function (k, v) {
                if (v.type == 'checkbox' && v.checked == true) {
                    nead_confirm = true;
                }
            })

            if (nead_confirm && $(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }

            query = form.serialize();
        } else {

            if ($(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }
            query = form.find('input,select,textarea').serialize();
        }

        var is_repeat_button = $(that).hasClass('no-repeat-button');

        if (is_repeat_button) {
            $(that).prop('disabled', true);
        }

        $.ajax({
            type: "POST",
            url: target,
            data: query,
            dataType: "json",
            success: function (result) {
                if (result.code == '1') {

                    form[0].reset();

                    layer.msg(result.msg, {icon: 1, time: 500, shade: [0.5, '#000', true]}, function () {
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);

                        if (fun != null) {
                            eval(fun);
                        }
                    });
                } else {
                    //toastr.error(result.msg);
                    layer.msg(result.msg, {icon: 5});
                }
            },
            complete: function () { //执行完之后执行
                if (is_repeat_button) {
                    $(that).prop('disabled', false);
                }
            },
        });//end ajax post

    }
    return false;
});


//更改字段
$("body").on("change", ".ajax-input", function () {
    var target;
    var val = $(this).val();
    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {
        $.post(target, {id: $(this).attr('data-id'), value: val}, function (data) {
            if (data.code) {
                parent.layer.msg(data.msg, {icon: 1});
            } else {
                parent.layer.msg(data.msg, {icon: 5});
            }

        }, "json");
    }
    return false;
});


//启用关闭
$("body").on("click", ".ajax-checkbox", function () {
    var target;
    var val = 0;
    var chk = $(this).prop('checked');
    log(chk);
    var id = $(this).attr('data-id');
    if (chk) {
        val = 1;
    }
    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {
        $.post(target, {id: id, value: val}, function (data) {
            if (data.code) {
                layer.msg(data.msg, {icon: 1});
            } else {
                layer.msg(data.msg, {icon: 5});
            }

        }, "json");
    }
});

//排序
$("body").on("change", ".ajax-sort", function () {
    var target;
    var val = $(this).val();
    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {
        if (!((/^(\+|-)?\d+$/.test(val)) && val >= 0)) {
            layer.msg('请输入正整数', {icon: 5});
            return false;
        }
        //是否设置了字段
        var ids = $(this).attr('data-ids');
        //是否设置了参数字段
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }
        $.post(target, {id: $(this).attr('data-id'), value: val}, function (data) {
            if (data.code) {
                layer.msg(data.msg, {icon: 1});
            } else {
                layer.msg(data.msg, {icon: 5});
            }
            //lqfalert(data);
        }, "json");
    }
    return false;
});

//排序
$("body").on("change", ".ajax-field", function () {
    var target;
    var val = $(this).val();
    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        //是否设置了字段
        var ids = $(this).attr('data-ids');
        //是否设置了参数字段
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }
        $.post(target, {id: $(this).attr('data-id'), value: val}, function (data) {
            if (data.code) {
                layer.msg(data.msg, {icon: 1});
            } else {
                layer.msg(data.msg, {icon: 5});
            }
            //lqfalert(data);
        }, "json");
    }
    return false;
});

/**
 * 提示或提示并跳转
 */
var lqfalert = function (data) {

    if (data.code) {
        // toast.success(data.msg);
        layer.msg(data.msg, {icon: 1});
    } else {
        if (typeof data.msg == "string") {
            //toast.error(data.msg);
            layer.msg(data.msg, {icon: 5});
        } else {
            var err_msg = '';
            for (var item in data.msg) {
                err_msg += "Θ " + data.msg[item] + "<br/>";
            }
            //toast.error(err_msg);
            layer.msg(data.msg, {icon: 5});
        }
    }

    if (data.url) {
        setTimeout(function () {
            location.href = data.url;
        }, 1500);
    }

    if (data.code && !data.url) {
        setTimeout(function () {
            location.reload();
        }, 1500);
    }
};