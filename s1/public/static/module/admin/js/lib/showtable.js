// 列表数据列处理
var listAll = [];
if ($('a').is('.btn-field-set')) {
    var showTable = $("a.btn-field-set").attr("data-id");
    listAll = [];//所有字段
    $(".ajax-list-table").find("thead tr th").each(function (e) {
        f_name = $(this).find("span").html();
        if (f_name != null) {
            listAll[e] = f_name;
        }
    });
    //存所有字段
    log(showTable);
    localStorage.setItem("listAll" + showTable, JSON.stringify(listAll));

    //未设置显示全部列
    if (localStorage.getItem("listSave" + showTable) == null) {
        localStorage.setItem("listSave" + showTable, JSON.stringify(listAll));
    }
}

//表格显示列设置,设置列表表格显示列
$("body").on("click", ".btn-field-set", function () {
    var showTable = $("a.btn-field-set").attr("data-id");
    a = JSON.parse(localStorage.getItem("listAll" + showTable));
    b = JSON.parse(localStorage.getItem("listSave" + showTable));
    var listHtml = '';
    listHtml = "<div class='ibox-content row list-all-field' style='width:80%;'>";
    for (var i = 0; i < a.length; i++) {
        if (typeof (a[i]) != "undefined" && a[i] != null) {
            var index = $.inArray(a[i], b);
            if (index >= 0) {
                chk = "checked";
            } else {
                chk = "";
            }
            listHtml += "<div class='col-sm-4'><input type='checkbox' name='listFieldCheckbox' value='" + a[i] + "' " + chk + "> " + a[i] + "</div>";
            log(a[i]);
        }
    }
    listHtml += "</div>";
    var indxe_list_field = layer.open({
        type: 1,
        title: "列表字段设置",
        scrollbar: false,
        skin: 'layui-layer-demo', //加上边框
        area: ['80%', '60%'], //宽高
        content: listHtml,
        btn: ['保存', '取消'],
        yes: function (index, layero) {
            listSave = [];
            $(".list-all-field input[name='listFieldCheckbox']:checked").each(function (e) {
                if (true == $(this).prop("checked")) {
                    value = $(this).prop('value');
                    listSave[e] = value
                }
            });
            localStorage.setItem("listSave" + showTable, JSON.stringify(listSave));
            turnPage(pageNum);
            //事件
            layer.close(indxe_list_field);
        },
        btn2: function (index, layero) {
            layer.close(index)
        }
    });
});

//初始化隐藏表的列
function initTableCell() {
    var colspan = 0;
    $(".ajax-list-table").find("thead tr th").each(function (index) {
        listSave = JSON.parse(localStorage.getItem("listSave" + showTable));
        f_name = $(this).find("span").html();

        var cell = index + 1
        var item = $.inArray(f_name, listSave);
        //log(item);
        if (item >= 0 || typeof (f_name) == 'undefined') {
            var strth = ".ajax-list-table thead tr th:nth-child("
            var strtd = ".ajax-list-table tbody tr td:nth-child("
            $(strtd + cell + ")").show();
            $(strth + cell + ")").show();
            colspan = colspan + 1;
        } else {
            var strth = ".ajax-list-table thead tr th:nth-child("
            var strtd = ".ajax-list-table tbody tr td:nth-child("
            $(strtd + cell + ")").hide();
            $(strth + cell + ")").hide();
        }
    });
    $(".ajax-list-table").find("tfoot tr td").attr('colspan', colspan);//设置分页行的列数合并

    bindClass();
}

/*表格长文字的过滤*/
function filterTd(v) {
    var rstr = '无';
    if (isEmpty(v)) {
        return '无';
    } else {
        rstr = '<div class="MHover">' + v + '</div>' +
            '<div class="MALL">' + v + '</div>';
    }
    return rstr;
}

//绑定鼠标事件
function bindClass() {
    log('bindclsss');
    $(".MALL").hide();
    $(".MHover").mouseover(function (e) {
        var clientWidth=document.body.clientWidth
        var divWidth=clientWidth-e.pageX-45;
        $(this).next(".MALL").css({
            "color": "#ffffff",
            "z-index": "1000",
            "width": divWidth+"px",
            "padding": "1rem",
            "line-height": ": 1.5rem",
            "position": "absolute",
            "opacity": "1",
            "background-color": "#3595CC",
            "top": e.pageY - 50,
            "left": e.pageX
        }).show();
    });
    $(".MHover").mousemove(function (e) {
        var clientWidth=document.body.clientWidth
        var divWidth=clientWidth-e.pageX-45;
        $(this).next(".MALL").css({
            "color": "#ffffff",
            "z-index": "1000",
            "width": divWidth+"px",
            "padding": "1rem",
            "line-height": ": 200",
            "position": "absolute",
            "opacity": "1",
            "background-color": "#3595CC",
            "top": e.pageY - 50,
            "left": e.pageX
        });
    });
    $(".MHover").mouseout(function () {
        $(this).next(".MALL").hide();
    });
}

//点击隐藏区域，显示所有文字
$("body").on("click", ".MHover", function () {
    var msg = $(this).html();
    layer.tips(msg, $(this), {
        tips: [1, '#3595CC'],
        time: 4000
    });
    $(this).prev().hide();
})

//判断字符是否为空的方法
function isEmpty(obj) {
    if (typeof obj == "undefined" || obj == null || obj == "") {
        return true;
    } else {
        return false;
    }
}