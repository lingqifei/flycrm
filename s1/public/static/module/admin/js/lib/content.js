//初始化一些效果
$(function () {



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
    var ajaxListTableId = $(this).parents('.page-list').attr('data-list-table');
    if (ajaxListTableId == '') {
        pageNum = $('.ajax-list-table').find("tfoot td input[name='pageNum']").val();
    } else {
        pageNum = $('#' + ajaxListTableId).find(".tfootPageBar.pageNum").val();
    }
    log('设置分页每页条数及跳转页数：');
    log(pageNum);
    if (pageNum == null) pageNum = '';
    ajaxSearchFormData = $("form").serialize();
    turnPage(pageNum, ajaxListTableId);
});

//输入页数跳转到批定页
$("body").on("click", ".tfootClickPageNum", function () {
    var ajaxListTable = $(this).parents('.page-list').attr('data-list-table');
    log('点击页码获得ajaxListTableId：'+ajaxListTable);
    pageNum = $(this).attr('data-id')
    ajaxSearchFormData = $("form").serialize();
    turnPage(pageNum, ajaxListTable);
});

//获取分页数据及模板
function turnPage(pageNum, ajaxListTableId = '') {
    log('获取分页数据及模板：');
    log('当前pageNum=' + pageNum);

    //查询表单
    var searchForm = $('.searchForm');
    //如果没有传入对像默认为,表格参数,为最开始的写法
    if (ajaxListTableId == '') {
        var ajaxListTableObject = $('.ajax-list-table');
        var tableListTpl = 'tableListTpl';
        pageSize = ajaxListTableObject.find("tfoot td input[name='pageSize']").val();
    } else {
        //获取表格对象，默认为指定样式下面的，.ajax-list-table
        var ajaxListTableObject = $('#' + ajaxListTableId).find('.ajax-list-table');
        var tableListTpl = 'tableListTpl-' + ajaxListTableId;
        pageSize = $('#' + ajaxListTableId).find(".tfootPageBar.pageSize").val();
    }

    //这里主要是兼容之前的模板调用
    //当获取不到表格对象时，默认为ajax-list-table，模板默认为tableListTpl
    if (typeof (ajaxListTableObject) != "undefined" && ajaxListTableObject == '') {
        ajaxListTableObject = $('.ajax-list-table');
        tableListTpl = 'tableListTpl';
        pageSize = ajaxListTableObject.find("tfoot td input[name='pageSize']").val();
    }

    if (pageSize == null) pageSize = '';//每页条数


    log('请求ajaxListTableId：' + ajaxListTableId);
    log('请求tableListTpl：' + tableListTpl);

    var ajaxUrl = ajaxListTableObject.attr("data-url");
    log('请求地址：' + ajaxUrl);
    if (typeof (ajaxUrl) != "undefined" && ajaxUrl == '') {
        layer.msg('请求地址不存在');
        return false;
    }

    //ajax 请求数据
    var ajaxSearchFormData = searchForm.serialize();
    var ajaxPostJsonData = ajaxSearchFormData + "&pageNum=" + pageNum + "&pageSize=" + pageSize + "&orderField=" + orderField + "&orderDirection=" + orderDirection;
    log('请求参数：' + ajaxPostJsonData);
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
            ajaxListTableObject.find("tbody").empty();

            totalCount = returnJsonData.total;//总条数
            pageSize = returnJsonData.per_page;//每页条数
            pageNum = returnJsonData.current_page;//当前页

            //returnJsonData=null2str(returnJsonData);

            //模板引擎使用
            var tpl = baidu.template;
            var html = tpl('' + tableListTpl + '', returnJsonData);//调用模板
            ajaxListTableObject.find("tbody").html(html);

            //把表格列表数据保存localStorage，方便在查询条件返回
            var row_value = JSON.stringify(returnJsonData)
            localStorage.setItem('tableListTpl', row_value);

        },
        complete: function () {

            //1、添加分页按钮栏
            getPageBar(ajaxListTableId, pageNum, pageSize, totalCount);

            //2、判断表格是否设置显示列
            if ($('a').is('.btn-field-set')) {
                initTableCell();
            }

            //3、绑定设置超出部分隐藏
            bindClass();

            //3、判断是否有表格需要合并
            if (ajaxListTableObject.hasClass('merge-table-rowspan')) {
                mergeTableRowspan();
            }

            //4、设置数据区域高度
            var stickyTable = ajaxListTableObject.parents('.sticky-table');
            if (stickyTable.hasClass('sticky-table')) {

                //获取表格高度，设置表格高度
                setStickyTableHeight(stickyTable)

                //窗口大小改变的时候，重新设置高度
                $(window).resize(function () {
                    setStickyTableHeight(stickyTable);
                });

                //滚动条滚动的时候，判断是否需要添加固定列第一列，二列，固定样式
                $('.sticky-table').unbind("scroll").on("scroll", function (e) {
                    var sum = this.scrollHeight;
                    var $obj = $(this);
                    var left = $obj.scrollLeft();
                    if(left>10){
                        $obj.addClass("scroll-left");//表示开努左右滚动了，添加第一列，二列，固定样式
                    }else {
                        $obj.removeClass("scroll-left");
                    }
                });
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

//设置stickyTable的高度
function setStickyTableHeight(stickyTable) {
    log('需要重新设置高度：');
    var distanceFromTop=stickyTable.offset().top; // 获取元素相对于文档的位置
    //当前文档的高度
    var height = $(window).height();
    var width = $(window).width();

    var centerHight = height - distanceFromTop-60;//根据当前元素位置，浏览器高度计算，当前元素可用高度
    stickyTable.height(centerHight).css("overflow", "auto");
    stickyTable.css("background", "#fff");


    var stickyTableWidth=stickyTable.width();
    var sorttableWidth=stickyTable.find('table.sorttable').width();

    if(stickyTableWidth<sorttableWidth){
        stickyTable.find('table.sorttable').addClass('fixed-last-td');
    }else{
        stickyTable.find('table.sorttable').removeClass('fixed-last-td');
    }
    log('stickyTableWidth='+stickyTableWidth)
    log('sorttableWidth='+sorttableWidth)
}


//获取分页条（分页按钮栏的规则和样式根据自己的需要来设置）
function getPageBar(ajaxListTableId, pageNum, pageSize, totalCount) {
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
    pageBar = "<div class='page-list' data-list-table='" + ajaxListTableId + "'>";
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

    //如果没数据，则显示提示信息
    if (ajaxListTableId == '') {
        var object = $(".ajax-list-table");
    } else {
        var object = $("#" + ajaxListTableId);
    }
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

//ajax打开,普通打开
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

        //重定义打开宽度和高度
        var width = $(this).attr('width');
        var height = $(this).attr('height');
        if (typeof (width) != "undefined" && width != 0) {
            width = width;
        } else {
            width = "90%";
        }
        if (typeof (height) != "undefined" && height != 0) {
            height = height;
        } else {
            height = "90%";
        }

        //判断是否是手机页
        var wwithd = $(window).width();
        if (wwithd <= 750) {
            width = "90%";
            height = "90%";
        }
        layer.open({
            type: 2,
            title: false,
            shadeClose: false,
            //btn: ['关闭'],
            fixed: true, //不固定
            area: [width, height],
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
//可以选择多个checkbox值，同时传送参数 id=3,4,5
$("body").on("click", ".ajax-open-more", function () {

    var title = $(this).attr('data-title');//打开标题
    var ids = $(this).attr('data-ids');//判断是否有参数传
    var fun = $(this).attr('data-calback');//判断是否有回调函数
    var checkedVal = [];

    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        //多个选择的目标id
        $('.ajax-list-table tbody input[class="checkboxCtrlId"]:checked').each(function () {
            checkedVal.push($(this).val());
        });
        var cIds = checkedVal.join(',');
        if (cIds.length > 0) {
            var target = target + "?id=" + cIds;
        } else {
            layer.msg('请选择批量操作数据', {icon: 5});
            return false;
        }

        //是否设置了参数字段data-ids="{'name':'张三','sex':'女'}"
        // if (typeof (ids) != "undefined" && ids != 0) {
        //     var ids = ($.param(eval('(' + ids + ')'), true));
        //     var target = target + "?" + ids;
        // }

        log('打开地址：' + target);

        //重定义打开宽度和高度
        var width = $(this).attr('width');
        var height = $(this).attr('height');
        if (typeof (width) != "undefined" && width != 0) {
            width = width;
        } else {
            width = "90%";
        }
        if (typeof (height) != "undefined" && height != 0) {
            height = height;
        } else {
            height = "90%";
        }

        //判断是否是手机页
        var wwithd = $(window).width();
        if (wwithd <= 750) {
            width = "90%";
            height = "90%";
        }

        //打开窗口
        layer.open({
            type: 2,
            title: false,
            shadeClose: false,
            //btn: ['关闭'],
            fixed: true, //不固定
            area: [width, height],
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
    var target='';
    if(typeof($(this).attr('data-url'))!="undefined"){
        target=$(this).attr('data-url');
    }
    if(typeof($(this).attr('href'))!="undefined"){
        target=$(this).attr('href');
    }
    if(target==''){
        layer.msg('未找到执行地址~', {icon: 5});
        return false;
    }
    //是否设置了参数字段，执行回调函数
    var ids = $(this).attr('data-ids');
    var fun = $(this).attr('data-calback');
    if (typeof (ids) != "undefined" && ids != 0) {
        ids = ($.param(eval('(' + ids + ')'), true));
        target = target + "?" + ids;
    }
    log('删除执行地址：' + target);
    layer.confirm('您确定要删除吗?', {btn: ['确定', '取消'], icon: 3,title: "提示"}, function (index) {

        layer.close(index);//点击 =》确认框=》关闭

        if (target) {
            log('确定执行删除操作：');
            $.ajax({
                type: "POST",
                url: target,
                data: '',
                dataType: "json",
                beforeSend:function () {
                    layer.msg('数据处理中...', {icon: 16,time: 100000,shade : [0.5 , '#000' , true]});
                },
                success: function (result) {
                    if (result.code == '1') {
                        //操作成功提示
                        layer.msg(result.msg, {icon: 1});
                        if (fun != null) {
                            log(fun);
                            eval(fun);
                        } else {
                            setTimeout(function () {
                                turnPage(pageNum);
                            }, 1);
                        }
                    } else {
                        layer.msg(result.msg, {icon: 5});
                    }
                },
                complete: function () { //执行完之后执行

                },
            });//end ajax post
        }
    });
    return false;
});

//ajax get请求=》单个请求
$("body").on("click", ".ajax-get", function () {
    //提示操作
    if ($(this).hasClass('confirm')) {
        if (!confirm('确认要执行该操作吗?')) {
            return false;
        }
    }
    //是否有加载提示
    if ($(this).hasClass('ajaxload')) {
        //页面层-自定义
        var ajaxload=layer.msg('正在处理,请稍等...', {
            icon: 16,
            time: 100000,
            shade: [0.5, '#000', true]
        }); //0代表加载的风格，支持0-2
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

        //执行get请求
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
            layer.close(ajaxload)
        }, "json");
    }
    return false;
});

//ajax get -more 请求=》选择多个时使用
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
                        setTimeout(function () {
                            turnPage(pageNum);
                        }, 1500);
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

// 重写表单POST提交处理
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

        //防止重复提交
        var is_repeat_button = $(that).hasClass('no-repeat-button');
        if (is_repeat_button) {
            $(that).prop('disabled', true);
        }

        //ajax提交
        $.ajax({
            type: "POST",
            url: target,
            data: query,
            dataType: "json",
            beforeSend:function (){
                layer.msg('正在处理,请稍等...', {icon: 16,time: 100000,shade : [0.5 , '#333' , true]});
            },
            success: function (result) {
                if (result.code == '1') {
                    layer.msg(result.msg, {icon: 1, time: 500, shade: [0.5, '#000', true]}, function () {
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                    });
                } else {
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

//更改列表字段,
$("body").on("change", ".ajax-input", function () {
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
        $.post(target, {"id": $(this).attr('data-id'), "value": val}, function (data) {
            if (data.code) {
                parent.layer.msg(data.msg, {icon: 1});
            } else {
                parent.layer.msg(data.msg, {icon: 5});
            }

        }, "json");
    }
    return false;
});

//列表启用关闭
$("body").on("click", ".ajax-checkbox", function () {
    var target;
    var val = 0;
    var chk = $(this).prop('checked');
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

//列表排序处理
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

//排列表字段序，可以传多个参数
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