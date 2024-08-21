var config = {
    version: '1.0.3',
    cssAr: [
        'module/admin/plugin/daterangepicker/static/css/iconfont.css',
        'module/admin/plugin/daterangepicker/static/css/daterangepicker.css'
    ],
    jsAr: [
        'module/admin/plugin/daterangepicker/static/js/moment.js',
        'module/admin/plugin/daterangepicker/static/js/daterangepicker.js'
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

link();
script();

$(document).ready(function () {

    //双日历函数
    $('.daterange-btn').each(function () {
        daterangeinit($(this));
    });

    //选择后面的时间
    $('.daterange-next').each(function () {
        daterangeinitNext($(this));
    });

    //选择当前前面的时间
    $('.daterange-prev').each(function () {
        daterangeinitPrev($(this));
    });

    $('.daterangepicker-b1').each(function () {
        daterangeinit($(this));
    });

    //未来几天
    function daterangeinit(object) {
        object.daterangepicker({
                "showDropdowns": true,
                "linkedCalendars": false,
                "autoUpdateInput": false,
                ranges: {
                    // '今天': [moment(), moment()],
                    // '明天': [moment().subtract(-1, 'days'), moment().subtract(-1, 'days')],
                    '未来七天': [moment(), moment().subtract(-6, 'days')],
                    '本月': [moment().startOf('month'), moment().endOf('month')],
                    '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '下月': [moment().subtract(-1, 'month').startOf('month'), moment().subtract(-1, 'month').endOf('month')],
                    '今年': [moment().startOf('year'), moment().endOf('year')],
                    '去年': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                    // '未来30天': [moment(),moment().subtract(-29, 'days')],
                    // '未来90天': [moment(),moment().subtract(-89, 'days'), ],
                },
                "locale": {
                    cancelLabel: "清除",
                },
                startDate: moment(),
                endDate: moment()
            },
            function (start, end, label) {
                //label:通过它来知道用户选择的是什么，传给后台进行相应的展示
                console.log(label)
                if (label == '今天') {
                    object.val(start.format('YYYY/MM/DD'));
                } else if (label == '明天') {
                    object.val(start.format('YYYY/MM/DD'));
                } else if (label == '未来七天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来30天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来60天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来90天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else {
                    if (start != null && end != null) {
                        object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                    } else {
                        object.val(start.format('YYYY/MM/DD'));
                    }
                }
            }
        );
        //清空日期
        object.on('cancel.daterangepicker', function (ev, picker) {
            object.val('');
        });
    }

    //时间后面的
    function daterangeinitNext(object) {
        object.daterangepicker({
                "showDropdowns": true,
                "linkedCalendars": false,
                "autoUpdateInput": false,
                ranges: {
                    '今天': [moment(), moment()],
                    '明天': [moment().subtract(-1, 'days'), moment().subtract(-2, 'days')],
                    '未来七天': [moment(), moment().subtract(-6, 'days')],
                    '未来30天': [moment(), moment().subtract(-29, 'days')],
                    '未来90天': [moment(), moment().subtract(-89, 'days'),],
                    '本月': [moment().startOf('month'), moment().endOf('month')],
                    '下月': [moment().subtract(-1, 'month').startOf('month'), moment().subtract(-1, 'month').endOf('month')],
                    '今年': [moment().startOf('year'), moment().endOf('year')],
                },
                "locale": {
                    cancelLabel: "清除",
                },
                startDate: moment(),
                endDate: moment()
            },
            function (start, end, label) {
                //label:通过它来知道用户选择的是什么，传给后台进行相应的展示
                console.log(label)
                if (label == '今天') {
                    object.val(start.format('YYYY/MM/DD'));
                } else if (label == '明天') {
                    // object.val(start.format('YYYY/MM/DD'));
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来七天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来30天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来60天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来90天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else {
                    if (start != null && end != null) {
                        object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                    } else {
                        object.val(start.format('YYYY/MM/DD'));
                    }
                }
            }
        );
        //清空日期
        object.on('cancel.daterangepicker', function (ev, picker) {
            object.val('');
        });
    }

    //时间后面的
    function daterangeinitPrev(object) {
        object.daterangepicker({
                "showDropdowns": true,
                "linkedCalendars": false,
                "autoUpdateInput": false,
                ranges: {
                    '今天': [moment(), moment()],
                    '昨天': [moment().subtract(1, 'days'), moment().subtract(2, 'days')],
                    '最近七天': [moment().subtract(6, 'days'), moment()],
                    '最近30天': [moment().subtract(29, 'days'), moment()],
                    '最近90天': [moment().subtract(89, 'days'), moment()],
                    '本月': [moment().startOf('month'), moment().endOf('month')],
                    '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '今年': [moment().startOf('year'), moment().endOf('year')],
                },
                "locale": {
                    cancelLabel: "清除",
                },
                startDate: moment(),
                endDate: moment()
            },
            function (start, end, label) {
                //label:通过它来知道用户选择的是什么，传给后台进行相应的展示
                console.log(label)
                if (label == '今天') {
                    object.val(start.format('YYYY/MM/DD'));
                } else if (label == '昨天') {
                    object.val(start.format('YYYY/MM/DD'));
                    //object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else {
                    if (start != null && end != null) {
                        object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                    } else {
                        object.val(start.format('YYYY/MM/DD'));
                    }
                }
            }
        );
        //清空日期
        object.on('cancel.daterangepicker', function (ev, picker) {
            object.val('');
        });
    }

});