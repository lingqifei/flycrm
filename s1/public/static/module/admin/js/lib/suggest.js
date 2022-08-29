var config = {
    version: '1.0.2',
    cssAr: [
        'module/admin/plugin/daterangepicker/static/css/iconfont.css',
    ],
    jsAr: [
        'module/admin/js/plugins/suggest/bootstrap-suggest.js',
    ]
}

function link(cssAr = config.cssAr, type) {
    for (var i = 0; i < cssAr.length; i++) {
        document.write('<link rel="stylesheet" href="' + static_root + cssAr[i] + '?version=' + config.version + '"/>');
    }
}

function script(jsAr = config.jsAr, type) {
    for (var i = 0; i < jsAr.length; i++) {
        document.write('<script src="' + static_root + jsAr[i] + '?version=' + config.version + ' type="text/javascript" charset="utf-8"><\/script>');
    }
}

//link();
script();

//操作方法
$(document).ready(function () {

    //suggest-search,加载
    $('.suggest-search-box').each(function () {
        initSuggest($(this));
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


        suggestObj.bsSuggest({
            searchFields: ["keywords"],
            showHeader: true,
            showBtn: true,     //不显示下拉按钮
            getDataMethod: "url",   //获取数据的方式，总是从 URL 获取
            idField: "id",
            keyField: "name",
            clearable: true,
            autoDropup: true, //自动判断菜单向上展开
            allowNoKeyword: true,           // 是否允许无关键字时请求数据
            effectiveFields: ["id", "name"],
            effectiveFieldsAlias: {id: "编号", name: "名称"},
            url: searchUrl,//*优先从url ajax 请求 json 帮助数据，注意最后一个参数为关键字请求参数*/
            //调整 ajax 请求参数方法，用于更多的请求配置需求。如对请求关键字作进一步处理、修改超时时间等
            fnAdjustAjaxParam: function (keyword, opts) {
                log('ajax 请求参数调整：', keyword, opts);
                log(sourceGroup);

                //扩展参数
                var rtnData = {keywords: keyword};
                if (typeof (sourceGroup) !== 'undefined') {
                    var names = JSON.parse(sourceNames);
                    log('关联参数')
                    log(names)
                    $.each(names, function (key, item) {
                        var itemVal = $("." + sourceGroup + " input[name='" + key + "']").val();
                        if (itemVal == null || itemVal == '' || typeof (itemVal) == 'undefined') {
                            layer.msg('选择' + item + '数据');
                            itemVal = '没有选择' + item;
                        }
                        rtnData[key] = itemVal;
                    })
                }
                return {
                    data: rtnData
                };
            },
            hideOnSelect: true,  // 鼠标从列表单击选择了值时，是否隐藏选择列表
            searchingTip: '搜索中...',       // ajax 搜索时显示的提示内容，当搜索时间较长时给出正在搜索的提示

        }).on('onDataRequestSuccess', function (e, result) {

            log('请求数据成功: ', result);
            if(result.value.length<=0){
                layer.msg('没有数据',{icon:5});
            }

        }).on('onSetSelectValue', function (e, keyword, selectData) {

            log("选择值");

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
                    data:selectData,
                    dataType:"json",
                    async:false,
                    success: function(resJsonData){
                        log(resJsonData);

                        //返回字段
                        var names = JSON.parse(calbackNames);
                        $.each(names, function (key, item) {
                            log(key + '==>' + item+'='+resJsonData[item]);
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
            log("清除值");
            //清空
            var names = JSON.parse(targetNames);
            $.each(names, function (key, item) {
                log(key + '==>' + item);
                object.find("." + targetGroup + " input[name='" + key + "']").val('');
            })

        });
    }
});



