var config = {
    version: '1.0.2',
    cssAr: [
        'module/admin/plugin/daterangepicker/static/css/iconfont.css',
    ],
    jsAr: [
        'module/admin/js/plugins/suggest/bootstrap-suggest.js',
    ]
}
//外部css加载
function link(cssAr = config.cssAr, type) {
    for (var i = 0; i < cssAr.length; i++) {
        document.write('<link rel="stylesheet" href="' + static_root + cssAr[i] + '?version=' + config.version + '"/>');
    }
}
//外部JS加载
function script(jsAr = config.jsAr, type) {
    for (var i = 0; i < jsAr.length; i++) {
        document.write('<script src="' + static_root + jsAr[i] + '?version=' + config.version + ' type="text/javascript" charset="utf-8"><\/script>');
    }
}

link();
script();

//操作方法

/* 使用方法
标签中设置class属性：
（*）class=suggest-search-box：绑定事件元素
（*）class=customer-suggest：绑定的区域范围，名称
（*）searchFields：查询关键字名 如：searchFields="keywords"
（*）target-group：查询结果后输出的区域，对应”class=customer-suggest“区域中的input值
（*）target-name：查找后选择带回的字段，对应”class=customer-suggest“区域中的input 名称为
    如：target-name='{"customer_id":"id","customer_name":"name"}'
        customer_id  为页面input的名称
        id  为查询为数据返回的数据源字段

  （*）data-url：查找数据的地址

  关联查询，在查询时获取当前面页页字段为参数，查询时带参数
  属性标签：source-group="customer-suggest" source-name='{"customer_id":"客户"}'

     source-group="customer-suggest"  要查询参数的区域
     source-name='{"customer_id":"客户"}'  要查询参数的区域 input 的名称

  （-）data-calback：查找选择确定之后，回调执行的函数，此函数一般在模板中用户单独设置
  （-）data-calback-url：查找选择确定之后，回调执行的函数，调用的地址

模板中调用实例：

<div class="suggest-search-box">
    <div class="input-group customer-suggest">
        <input type="hidden" name="customer_id"  value="{$customer_id|default=''}">
        <input type="text" name="customer_name"  value="{$customer_name|default=''}" class="form-control suggest-input"  placeholder="请输入搜索名称"
               data-url="{:url('Comm/suggest_search',array('datatype'=>'customer'))}"
               searchFields="keywords" value="{$customer_name|default=''}"
               target-group="customer-suggest" target-name='{"customer_id":"id","customer_name":"name"}'>
        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu"></ul>
        </div>
    </div>
</div>

<label class="col-sm-2 control-label">客户联系人</label>
<div class="col-sm-4">
    <div class="suggest-search-box">
        <div class="input-group linkman-suggest">
            <input type="hidden" name="linkman_id" value="{$linkman_id|default=''}">
            <input type="text"  name="linkman_name" value="{$linkman_name|default=''}" class="form-control suggest-input" placeholder="请输入搜索名称"
                   data-url="{:url('Comm/suggest_search',array('datatype'=>'linkman'))}"
                   searchFields="keywords"
                   source-group="customer-suggest" source-name='{"customer_id":"客户"}'
                   target-group="linkman-suggest" target-name='{"linkman_id":"id","linkman_name":"name"}'>
            <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu"></ul>
            </div>
        </div>
    </div>
    <span class="help-block m-b-none"></span>
</div>

*
* */

$(document).ready(function () {
    //suggest-search,加载
    $('.suggest-search-box').each(function () {
        initSuggest($(this));
    });

    //独立点击清空
    $("body").on("click", ".suggest-search-box .clearable", function () {
        log('sgugest-input 点击清空返回值');
        var object=$(this).parents(".suggest-search-box");
        var suggestObj=object.find(".suggest-input");

        var targetGroup = suggestObj.attr('target-group');//返回字段值，组
        var targetNames = suggestObj.attr('target-name');//返回字段的对应的字段 如：'{"customer_id":"id","customer_name":"name"}'

        var names = JSON.parse(targetNames);
        $.each(names, function (key, item) {
            log(key + '==>' + item);
            object.find("." + targetGroup + " input[name='" + key + "']").val('');
        })
    });

});

//初始化
function initSuggest(object) {

    //实例对像
    var suggestObj = object.find('.suggest-input')
    var searchUrl = suggestObj.attr('data-url');
    var searchFields = suggestObj.attr('searchFields');
    var targetGroup = suggestObj.attr('target-group');//返回字段值，组
    var targetNames = suggestObj.attr('target-name');//返回字段的对应的字段 如：'{"customer_id":"id","customer_name":"name"}'

    //需要联动的参数
    var sourceGroup = suggestObj.attr('source-group');//联动关联字段，组
    var sourceNames = suggestObj.attr('source-name');//联动关联字段名字  '{"customer_id":"id","customer_name":"name"}'

    //加载后需要返回的参数
    var calbackGroup = suggestObj.attr('calback-group');//返回加载区域
    var calbackNames = suggestObj.attr('calback-name');//返回加载区域名字  '{"customer_id":"id","customer_name":"name"}'
    var calbackUrl = suggestObj.attr('calback-url');//回调的地址

    //判断是否有关联数据
    var relation='';

    suggestObj.bsSuggest({
        url: searchUrl,                 //*优先从url ajax 请求 json 帮助数据，注意最后一个参数为关键字请求参数*/
        jsonp: null,                    //设置此参数名，将开启jsonp功能，否则使用json数据结构
        data: {
            value: []
        },                              //提示所用的数据，注意格式
        indexId: 0,                     //每组数据的第几个数据，作为input输入框的 data-id，设为 -1 且 idField 为空则不设置此值
        indexKey: 0,                    //每组数据的第几个数据，作为input输入框的内容
        idField: 'id',                    //每组数据的哪个字段作为 data-id，优先级高于 indexId 设置（推荐）
        keyField: 'name',                   //每组数据的哪个字段作为输入框内容，优先级高于 indexKey 设置（推荐）

        /* 搜索相关 */
        autoSelect: true,               // 键盘向上/下方向键时，是否自动选择值
        allowNoKeyword: true,           // 是否允许无关键字时请求数据
        getDataMethod: 'url',           // 获取数据的方式，url：一直从url请求；data：从 options.data 获取；firstByUrl：第一次从Url获取全部数据，之后从options.data获取
        delayUntilKeyup: false,         // 获取数据的方式 为 firstByUrl 时，是否延迟到有输入时才请求数据
        ignorecase: false,              // 前端搜索匹配时，是否忽略大小写
        effectiveFields: ["id", "name"],            // 有效显示于列表中的字段，非有效字段都会过滤，默认全部有效。
        effectiveFieldsAlias: {id: "编号", name: "名称"},       // 有效字段的别名对象，用于 header 的显示
        searchFields: ["keywords"],               // 有效搜索字段，从前端搜索过滤数据时使用，但不一定显示在列表中。effectiveFields 配置字段也会用于搜索过滤
        twoWayMatch: true,              // 是否双向匹配搜索。为 true 即输入关键字包含或包含于匹配字段均认为匹配成功，为 false 则输入关键字包含于匹配字段认为匹配成功
        multiWord: false,               // 以分隔符号分割的多关键字支持
        separator: ',',                 // 多关键字支持时的分隔符，默认为半角逗号
        delay: 300,                     // 搜索触发的延时时间间隔，单位毫秒
        emptyTip: '未搜索到数据',                   // 查询为空时显示的内容，可为 html
        searchingTip: '搜索中...',       // ajax 搜索时显示的提示内容，当搜索时间较长时给出正在搜索的提示
        hideOnSelect: true,            // 鼠标从列表单击选择了值时，是否隐藏选择列表

        /* UI */
        autoDropup: true,              //选择菜单是否自动判断向上展开。设为 true，则当下拉菜单高度超过窗体，且向上方向不会被窗体覆盖，则选择菜单向上弹出
        autoMinWidth: false,            //是否自动最小宽度，设为 false 则最小宽度不小于输入框宽度
        showHeader: true,              //是否显示选择列表的 header。为 true 时，有效字段大于一列则显示表头
        showBtn: true,                  //是否显示下拉按钮
        inputBgColor: '',               //输入框背景色，当与容器背景色不同时，可能需要该项的配置
        inputWarnColor: 'rgba(255,0,0,.1)', //输入框内容不是下拉列表选择时的警告色
        listStyle: {
            'padding-top': 0,
            'max-height': '375px',
            'max-width': '800px',
            'overflow': 'auto',
            'width': 'auto',
            'transition': '0.3s',
            '-webkit-transition': '0.3s',
            '-moz-transition': '0.3s',
            '-o-transition': '0.3s'
        },                              //列表的样式控制
        listAlign: 'left',              //提示列表对齐位置，left/right/auto
        listHoverStyle: 'background: #07d; color:#fff', //提示框列表鼠标悬浮的样式
        listHoverCSS: 'jhover',         //提示框列表鼠标悬浮的样式名称
        clearable: true,               // 是否可清除已输入的内容


        /* key */
        keyLeft: 37,                    //向左方向键，不同的操作系统可能会有差别，则自行定义
        keyUp: 38,                      //向上方向键
        keyRight: 39,                   //向右方向键
        keyDown: 40,                    //向下方向键
        keyEnter: 13,                   //回车键

        //调整 ajax 请求参数方法，用于更多的请求配置需求。如对请求关键字作进一步处理、修改超时时间等
        /* methods */
        /*
        fnProcessData: processData,     //格式化数据的方法，返回数据格式参考 data 参数
        fnGetData: getData,             //获取数据的方法，无特殊需求一般不作设置
        fnAdjustAjaxParam: null,        //调整 ajax 请求参数方法，用于更多的请求配置需求。如对请求关键字作进一步处理、修改超时时间等
        fnPreprocessKeyword: null       //搜索过滤数据前，对输入关键字作进一步处理方法。注意，应返回字符
        */
        fnAdjustAjaxParam: function (keyword, opts) {
            log('ajax 请求参数调整：', keyword, opts);
            log(sourceGroup);
            //扩展参数=》需要关联上一级参数
            var rtnData = {keywords: keyword};
            if (typeof (sourceGroup) !== 'undefined') {
                var names = JSON.parse(sourceNames);
                log('关联参数')
                log(names)
                $.each(names, function (key, item) {
                    var itemVal = $("." + sourceGroup + " input[name='" + key + "']").val();

                    log('查找查参数：');
                    log(itemVal);

                    if (itemVal == null || itemVal == '' || typeof (itemVal) == 'undefined') {
                        layer.msg('选择' + item + '数据');
                        itemVal = '还没有选择' + item;
                        relation =itemVal;
                    }
                    rtnData[key] = itemVal;
                })
            }
            return {
                data: rtnData
            };
        },

    }).on('onDataRequestSuccess', function (e, result) {
        // 当 AJAX 请求数据成功时触发，并传回结果到第二个参数

        log('请求数据成功: ', result);
        if (result.value.length <= 0) {
            layer.msg('没有搜索到数据', {icon: 5});
        }

    }).on('onSetSelectValue', function (e, keyword, selectData) {
        //当从下拉菜单选取值时触发，并传回设置的数据到第二个参数

        log("选中值");
        //返回字段
        var names = JSON.parse(targetNames);
        $.each(names, function (key, item) {
            log(key + '==>' + item);
            object.find("." + targetGroup + " input[name='" + key + "']").val(selectData[item]);
        });

        //选择中后回调
        if (typeof (calbackGroup) !== 'undefined') {
            $.ajax({
                type: "POST",
                url: calbackUrl,
                data: selectData,
                dataType: "json",
                async: false,
                success: function (resJsonData) {
                    log(resJsonData);

                    //返回字段
                    var names = JSON.parse(calbackNames);
                    $.each(names, function (key, item) {
                        log(key + '==>' + item + '=' + resJsonData[item]);
                        $("." + calbackGroup + " input[name='" + key + "']").val(resJsonData[item]);
                    });

                    // $(".form-horizontal input[name='contract_money']").val(data.money);
                    // $(".form-horizontal input[name='contract_zero_money']").val(data.zero_money);
                    // $(".form-horizontal input[name='contract_pay_money']").val(data.pay_money);
                    // $(".form-horizontal input[name='contract_owe_money']").val(data.owe_money);
                    // $(".form-horizontal input[name='contract_invoice_money']").val(data.invoice_money);
                    //
                    // //合同金额-支付金额-去零金额
                    // var owe_money = BigNumber(data.money).minus(data.pay_money).minus(data.zero_money).toNumber();
                    // $(".form-horizontal input[name='contract_owe_money']").val(owe_money);
                    // $(".form-horizontal input[name='pay_money']").val(owe_money);
                    // $(".form-horizontal input[name='owe_money']").val(0);

                },
                complete: function () {

                }
            });
        }

    }).on('onUnsetSelectValue', function () {
        //当设置了 idField，且自由输入内容时触发（与背景警告色显示同步）

        log("输入");

        // if (relation.length > 0) {
        //     layer.msg(relation, {icon: 5});
        // }

        //清空
        // var names = JSON.parse(targetNames);
        // $.each(names, function (key, item) {
        //     log(key + '==>' + item);
        //     object.find("." + targetGroup + " input[name='" + key + "']").val('');
        // })
    });
}



