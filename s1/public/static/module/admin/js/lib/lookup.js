//查找带回组件
/* 使用方法
标签中设置class属性：
（*）lookup-input-select：绑定事件属性
（*）lookup-group：绑定的区域范围
（*）lookup-fields：查找后选择带回的字段，对应”lookup-group“区域中的input值
（*）lookup-fields-init：查找时初始已经存的的字段，对应”lookup-group“区域中的input值，在lookup列表页可以获取此字段的值，列表设置勾选中状态
（*）lookup-url：查找数据的地址
（-）data-calback：查找选择确定之后，回调执行的函数，此函数一般在模板中用户单独设置
（-）data-calback-url：查找选择确定之后，回调执行的函数，调用的地址

* 模板中调用实例
<div class="purchase_box">
    <input type="hidden" name="purchase_id">
    <input type="text" name="purchase_no" class="form-control" placeholder="选择关联采购申请单" readonly>
    <span class="input-group-btn">
        <button type="button" class="btn btn-default lookup-input-select"
                lookup-group='purchase_box'
                lookup-fields='{"purchase_id":"id","purchase_no":"purchase_no"}'
                lookup-url="{:url('OfsuPurchase/lookup')}"
                lookup-fields-init='purchase_id[]'
                data-calback="javascript:lookupAjaxListTable('purchase_box','purchase_id');"
                data-calback-url="{:url('OfsuPurchase/lookup',array('datatype'=>'info'))}"
        >选择
        </button>
    </span>
</div>
*/
var lookupGroupName = ''
var lookupGroupIndex = ''
var lookupGroupFun = ''
$("body").on("click", ".lookup-input-select", function () {
    lookupGroupName = $(this).attr('lookup-group');
    lookupGroupFun = $(this).attr('data-calback');
    log('查找回带区域：' + lookupGroupName);
    log('查找回带函数：' + lookupGroupFun);


    //存储初始化值到 localStorage
    var lookupFields = $(this).attr('lookup-fields');
    var lookupFieldsInit = $(this).attr('lookup-fields-init');
    log('查找回带字段：' + lookupFields);

    //存储默认字段的值 固定变量名=lookupInitFieldName  ，在lookup弹出页读取
    //对应”lookup-group“区域中的input值，在lookup列表页可以获取此字段的值，列表设置勾选中状态
    var lookupGroupObj = $("." + lookupGroupName + "");
    localStorage.setItem('lookupInitFieldName', lookupGroupObj.find("input[name='" + lookupFieldsInit + "']").val());
    var names = JSON.parse(lookupFields);
    $.each(names, function (key, item) {
        log(key + '==>' + item);
        var lookupFieldsValue = lookupGroupObj.find("input[name='" + key + "']").val();
        log('查找回带字段值：' + key + '=' + lookupFieldsValue);
        localStorage.setItem(key, lookupFieldsValue);
    });

    //判断设置的区域组是否存在
    if (typeof (lookupGroupName) == "undefined" || lookupGroupName == '') {
        layer.msg('参数有有错');
        return false;
    } else {
        localStorage.setItem('lookupGroupKey', lookupGroupName);//操作区域
    }

    //判断地址是否存
    if ((target = $(this).attr('lookup-url'))) {
        //是否带参数字段
        //参数传，支持多个参数传送 格式：lookup-fields="{'tid':'2',''name':'张三'}"
        var ids = $(this).attr('lookup-ids');
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
                localStorage.setItem('lookupGroupIndex', index);
            },
            end: function () {
                log('关闭弹窗口执行=》start~~~~：');
                if (lookupGroupFun != null) {
                    eval(lookupGroupFun);
                    log('执行回调函数=>end~~~');
                }
            }
        });
    }
    return false;
});

//选择确定=>回示列表=>单个选择
$("body").on("click", ".lookup-bring-select", function () {
    var lookupGroupName = localStorage.getItem('lookupGroupKey');//操作区域
    var lookupGroupObj = parent.$("." + lookupGroupName + "");
    var lookupInputObj = lookupGroupObj.find(".lookup-input-select");
    var lookupFields = lookupInputObj.attr('lookup-fields');

    log("lookupGroup区域：" + lookupGroupName);

    ////选择回显示字段
    var selectData = $(this).attr('lookup-bring-fields');
    var selectData = JSON.parse(selectData);

    //返回字段
    log("返回字段");
    log(lookupFields);
    var names = JSON.parse(lookupFields);
    $.each(names, function (key, item) {
        log(key + '==>' + item + '=' + selectData[item]);
        lookupGroupObj.find("input[name='" + key + "']").val(selectData[item]);
    });
    //关闭当前窗口
    var index = localStorage.getItem('lookupGroupIndex');
    // var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    parent.layer.close(index);

})


//选择确定=>回示列表=>多个选择
$("body").on("click", ".lookup-bring-select-all", function () {
    log('ddd');
    var lookupGroupName = localStorage.getItem('lookupGroupKey');//操作区域
    var lookupGroupObj = parent.$("." + lookupGroupName + "");
    var lookupInputObj = lookupGroupObj.find(".lookup-input-select");
    var lookupFields = lookupInputObj.attr('lookup-fields');

    log("lookupGroup区域：" + lookupGroupName);

    //多个选择的目标id
    var selectDataList = [];
    $('.ajax-list-table tbody input[class="checkboxCtrlId"]:checked').each(function () {
        var selectData = $(this).attr('lookup-bring-fields');
        var selectData = JSON.parse(selectData);
        selectDataList.push(selectData);
    });

    log("多选择的数据");
    log(selectDataList);

    //返回字段
    log("返回字段");
    log(lookupFields);
    var names = JSON.parse(lookupFields);
    $.each(names, function (key, item) {

        //这是把列表值按字段取出处理
        var items = [];
        $.each(selectDataList, function (k, row) {
            items.push(row[item]);
        });

        log(key + '==>' + item + '=' + items);
        lookupGroupObj.find("input[name='" + key + "']").val(items);
    });
    //关闭当前窗口
    var index = localStorage.getItem('lookupGroupIndex');
    // var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    parent.layer.close(index);

})

//独立点击清空=清空lookup-group中所有值
$("body").on("click", ".lookup-group-box .clearable", function () {
    log('lookgroup-input 点击清空返回值');
    var object = $(this).parents(".lookup-group-box");
    object.find("input").val('');
});


$(document).ready(function () {

    //销售客户模块部门

    //自动输出=>客户关联 列表数
    $('.chosen-select.customer').each(function () {
        var value = $(this).attr("data-val");
        var target = $(this).attr("data-url");
        findCustomerLinkSelect(value, target);
        $(this).val(value).trigger("chosen:updated");
    });

    //自动输出=>销售合同(未付款完)=》关联详细数据=>需要收款
    $('.chosen-select.unpaidsalcontract').each(function () {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        findSalContractInfo(value, target, bus_type);
        $(this).val(value).trigger("chosen:updated");
    });

    //自动输出=>销售合同(未开完票)=》关联详细数据=>需要收款
    $('.chosen-select.uninvoicesalcontract').each(function () {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        findSalContractInfo(value, target, bus_type);
        $(this).val(value).trigger("chosen:updated");
    });

    //选择用户=》客户关联（所有关联，联系人，销售合同，发票，） =>r列表数
    $('.chosen-select.customer').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        log(value);
        findCustomerLinkSelect(value, target)
    });

    //选择=>销售合同(所有合同)=》关联详细数据=>所有订单
    $('.chosen-select.salcontract').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(value);
        findSalContractInfo(value, target, bus_type);
    });

    //选择=>销售合同(未付款完)=》关联详细数据=>未付款
    $('.chosen-select.unpaidsalcontract').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(bus_type);
        findSalContractInfo(value, target, bus_type);
        //设置业务类型
        $(this).parents('form').find("input[name='bus_type']").val(bus_type);
    });

    //选择=>销售合同(未开完票)=》关联详细数据=>需要开票
    $('.chosen-select.uninvoicesalcontract').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(bus_type);
        findSalContractInfo(value, target, bus_type);
        //设置业务类型
        $(this).parents('form').find("input[name='bus_type']").val(bus_type);
    });

    //供应商部分******************************************************************

    //自动输出=》供应商关联=》数据处理
    $('.chosen-select.supplier').each(function () {
        var value = $(this).attr("data-val");
        var target = $(this).attr("data-url");
        log(value);
        findSupplierLinkSelect(value, target);
        $(this).val(value).trigger("chosen:updated");

    });

    //自动输出=>采购合同(未付款完)=》关联详细数据=》收票
    $('.chosen-select.unpaidposcontract').each(function () {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(value);
        findPosContractInfo(value, target, bus_type)
    });


    //自动输出=>采购合同(未开完票)=》关联详细数据=>需要收款
    $('.chosen-select.uninvoiceposcontract').each(function () {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        findPosContractInfo(value, target, bus_type);
        $(this).val(value).trigger("chosen:updated");
    });


    //选择供应商=》加载关联=》列表数据
    $('.chosen-select.supplier').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        log(value);
        findSupplierLinkSelect(value, target);
        $(this).val(value).trigger("chosen:updated");
    });

    //选择=>采购合同(未付款完)=》关联详细数据=>未付款
    $('.chosen-select.unpaidposcontract').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(value);
        findPosContractInfo(value, target, bus_type);
        //设置业务类型
        $(this).parents('form').find("input[name='bus_type']").val(bus_type);
    });

    //选择=>采购合同(未开票)=》关联详细数据=》收票
    $('.chosen-select.uninvoiceposcontract').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(value);
        findPosContractInfo(value, target, bus_type);
        //设置业务类型
        $(this).parents('form').find("input[name='bus_type']").val(bus_type);
    });

});

//选择客户=》回显示关联数据
function findCustomerLinkSelect(cid, target = null) {
    //回显=》联系人
    $('.chosen-select.linkman').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"customer_id": cid, "customer_type": 'linkman'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" >' + obj.name + '</option>';
                });
                that.append(html);
                //that.trigger('chosen:updated');
                log(val);
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

    //回显=》销售机会
    $('.chosen-select.chance').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"customer_id": cid, "customer_type": 'chance'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" >' + obj.name + '</option>';
                });
                //log(html);
                that.append(html);
                log(val);
                //that.trigger('chosen:updated');
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

    //回显=》未收款=》销售合同
    $('.chosen-select.unpaidsalcontract').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"customer_id": cid, "customer_type": 'unpaidsalcontract'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '"  data-type="' + obj.bus_type + '">' + obj.name + '</option>';
                });
                //log(html);
                that.append(html);
                log(val);
                //that.trigger('chosen:updated');
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

    //回显=》未开票=》销售合同
    $('.chosen-select.uninvoicesalcontract').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"customer_id": cid, "customer_type": 'uninvoicesalcontract'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" data-type="' + obj.bus_type + '">' + obj.name + '</option>';
                });
                //log(html);
                that.append(html);
                log(val);
                //that.trigger('chosen:updated');
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

}


//供应商选择=》回显示关联信息
function findSupplierLinkSelect(cid, target = null) {
    //回显供应商=》联系人明细
    $('.chosen-select.linkman').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"supplier_id": cid, "supplier_type": 'linkman'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" >' + obj.name + '</option>';
                });
                that.append(html);
                //that.trigger('chosen:updated');
                log(val);
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

    //回显示供应商=》未付完款的合同
    $('.chosen-select.unpaidposcontract').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"supplier_id": cid, "supplier_type": 'unpaidposcontract'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" data-type="' + obj.bus_type + '">' + obj.name + '</option>';
                });
                //log(html);
                that.append(html);
                log(val);
                //that.trigger('chosen:updated');
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

    //回显示供应商=》未付完款的合同
    $('.unpaidposcontract-more').each(function () {
        var that = $(this);
        $.ajax({
            type: "POST",
            url: target,
            data: {"supplier_id": cid, "supplier_type": 'unpaidposcontract'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.find('tbody').empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<tr>';
                    html += '<td><input name="id[]" class="checkboxCtrlId" value="' + obj.id + '" type="checkbox">';
                    html += '<input name="bus_id[]" value="' + obj.id + '" type="hidden">';
                    html += '<input name="bus_type[]" value="' + obj.bus_type + '" type="hidden">';
                    html += '<input name="bus_type_name[]" value="' + obj.bus_type_name + '" type="hidden">';
                    html += '<input name="zero_money[]" value="' + obj.zero_money + '" type="hidden">';
                    html += '<input name="bus_name[]" value="' + obj.name + '" type="hidden">';
                    html += '</td>';
                    html += '<td>' + obj.bus_date + '</td>';
                    html += '<td>' + obj.name + '</td>';
                    html += '<td>' + obj.bus_type_name + '</td>';
                    html += '<td><input name="money[]" value="' + obj.money + '" type="text" class="form-control" readonly></td>';
                    html += '<td><input name="pay_money[]" value="' + obj.pay_money + '" type="text" class="form-control" readonly></td>';
                    html += '<td><input name="invoice_money[]" value="' + obj.invoice_money + '" type="text" class="form-control" readonly></td>';
                    html += '</tr>';
                });
                log(html);
                that.find('tbody').append(html);
            },
            complete: function () {

            }
        });
    });

    //回显示供应商=》未开票完款的合同
    $('.chosen-select.uninvoiceposcontract').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"supplier_id": cid, "supplier_type": 'uninvoiceposcontract'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" data-type="' + obj.bus_type + '">' + obj.name + '</option>';
                });
                //log(html);
                that.append(html);
                log(val);
                //that.trigger('chosen:updated');
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

}

//采购合同》关联信息
function findPosContractInfo(cid, target = null, bus_type = null) {
    $.ajax({
        type: "POST",
        url: target,
        data: {"id": cid, "bus_type": bus_type},
        dataType: "json",
        async: false,
        success: function (data) {
            //log(data);
            $(".form-horizontal input[name='contract_money']").val(data.money);
            $(".form-horizontal input[name='contract_zero_money']").val(data.zero_money);
            $(".form-horizontal input[name='contract_pay_money']").val(data.pay_money);
            $(".form-horizontal input[name='contract_owe_money']").val(data.owe_money);
            $(".form-horizontal input[name='contract_invoice_money']").val(data.invoice_money);

            //合同金额-支付金额-去零金额
            var owe_money = BigNumber(data.money).minus(data.pay_money).minus(data.zero_money).toNumber();
            $(".form-horizontal input[name='contract_owe_money']").val(owe_money);
            $(".form-horizontal input[name='pay_money']").val(owe_money);
            $(".form-horizontal input[name='owe_money']").val(0);

        },
        complete: function () {

        }
    });
}

//付款添加=》采购合同金额=》计算器
$("body").on("keyup", ".paycalculate", function () {
    //查询本行的数据
    var contract_owe_money = $(".form-horizontal input[name='contract_owe_money']").val();
    var pay_money = $(".form-horizontal input[name='pay_money']").val();
    var zero_money = $(".form-horizontal input[name='zero_money']").val();

    //计算剩余金额
    var owe_money = BigNumber(contract_owe_money).minus(pay_money).minus(zero_money).toNumber();
    if (owe_money < 0) {
        layer.msg('本次付款的金额和去零金额不能超过 ' + contract_owe_money, {icon: 5});
    }
    $(".form-horizontal input[name='owe_money']").val(owe_money);
    console.log(owe_money);
});


//销售合同》关联信息
function findSalContractInfo(cid, target = null, bus_type = null) {
    $.ajax({
        type: "POST",
        url: target,
        data: {"id": cid, "bus_type": bus_type},
        dataType: "json",
        async: false,
        success: function (data) {
            log(data);
            $(".form-horizontal input[name='contract_money']").val(data.money);
            $(".form-horizontal input[name='contract_zero_money']").val(data.zero_money);
            $(".form-horizontal input[name='contract_back_money']").val(data.back_money);
            $(".form-horizontal input[name='contract_invoice_money']").val(data.invoice_money);

            //销售金额-回款金额-去零金额
            var owe_money = BigNumber(data.money).minus(data.back_money).minus(data.zero_money).toNumber();
            $(".form-horizontal input[name='contract_owe_money']").val(owe_money);
            $(".form-horizontal input[name='back_money']").val(owe_money);
            $(".form-horizontal input[name='owe_money']").val(0);
        },
        complete: function () {

        }
    });
}

//回款添加=》销售合同金额=》计算器
$("body").on("keyup", ".rececalculate", function () {
    //查询本行的数据
    var contract_owe_money = $(".form-horizontal input[name='contract_owe_money']").val();
    var back_money = $(".form-horizontal input[name='back_money']").val();
    var zero_money = $(".form-horizontal input[name='zero_money']").val();

    var owe_money = BigNumber(contract_owe_money).minus(back_money).minus(zero_money).toNumber();
    if (owe_money < 0) {
        layer.msg('本次付款的金额和去零金额不能超过 ' + contract_owe_money, {icon: 5});
    }
    $(".form-horizontal input[name='owe_money']").val(owe_money);
    console.log(owe_money);
});