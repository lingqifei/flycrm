$(document).ready(function () {
	window.onload=onLoad();

	$(".right_centent").each(function (key, row) {
		setCenterHeight($(this));
	})


	//页面加载
	function onLoad() {
		$('.searchForm').find("input[name='pid']").val('');
		var target = $('#left-tree').attr('data-url');

		log(target);

		$.get(target).success(function (jsonData) {
			//渲染树
			$('#left-tree').treeview({
				data: jsonData,
				levels: 1,
				showTags: false,//显示右边tags
				showCheckbox: false,//是否显示多选
				multiSelect: false,
				showBorder: false,
				onNodeSelected: function (event, node) {
					//设置新增时的父节点
					$('.searchForm').find("input[name='pid']").val(node.id);
					$('.searchForm').find("input[name='id']").val(node.id);
					$('.add-btn').attr('data-id',node.id);
					turnPage(1);
				}
			});
		}, "json");
		//turnPage(1);//页面加载时初始化分页
	}

	//刷新加载-添加
	$("body").on("click", ".refresh-tree", function () {
		onLoad();
		turnPage(1);
	});

	/*-----页面pannel内容区高度自适应 start-----*/
	$(window).resize(function () {
		setCenterHeight();
	});

	function setCenterHeight() {
		var object=$(".right_centent");
		var offsetTop=object.offset().top;
		var windowHeight = $(window).height();
		var centerHight = windowHeight - offsetTop -50;
		object.height(centerHight).css("overflow", "auto");
		log("offsetTop:"+offsetTop)
		log("centerHight:"+centerHight)
	}
	/*-----页面pannel内容区高度自适应 end-----*/
});