
if($('a').is('.btn-field-set')) {

	showTable = $("a.btn-field-set").attr("data-id");
	listAll = [];//所有字段

	$(".ajax-list-table").find("thead tr th").each(function (e) {
		f_name = $(this).find("span").html();
		if(f_name != null ) {
			listAll[e] = f_name;
		}

	});
//存所有字段
	log(showTable);
	localStorage.setItem("listAll" + showTable, JSON.stringify(listAll));

//未设置显示全部
	if (localStorage.getItem("listSave" + showTable) == null) {
		localStorage.setItem("listSave" + showTable, JSON.stringify(listAll));
	}

};

//表格显示列设置* ***********************************************************
$("body").on("click", ".btn-field-set", function() {
	a=JSON.parse(localStorage.getItem("listAll"+showTable));
	b=JSON.parse(localStorage.getItem("listSave"+showTable));
	
	listHtml="<div class='ibox-content row list-all-field' style='width:80%;'>";
	for(var i =0; i<a.length; i++){
		if( typeof(a[i]) !="undefined" && a[i] != null ){
			var index = $.inArray(a[i], b); 
			if(index>=0){
			    chk="checked";
			}else{
				 chk="";
			}
			listHtml +="<div class='col-sm-4'><input type='checkbox' name='listFieldCheckbox' value='"+a[i]+"' "+chk+"> "+a[i]+"</div>";
		   log(a[i]);
		}
		
	}
	listHtml +="</div>";

	var indxe_list_field =layer.open({
		type: 1,
		title:"列表字段设置",
		scrollbar: false,
		skin: 'layui-layer-demo', //加上边框
		area: ['80%', '60%'], //宽高
		content: listHtml,
		btn: ['保存', '取消'],
		yes: function(index, layero){
			listSave=[];
			$(".list-all-field input[name='listFieldCheckbox']:checked").each(function(e) {
				if (true == $(this).prop("checked")) {
					value = $(this).prop('value');
					listSave[e]=value
				}
			});
			localStorage.setItem("listSave"+showTable,JSON.stringify(listSave));
			turnPage(pageNum);
			//事件
			layer.close(indxe_list_field);
		},
		btn2: function(index, layero){
			layer.close(index)
		}
	});	
});

//保存设置的字段
$("body").on("click", ".save-list-field", function() {
	 listSave=[];
	 $(".list-all-field input[name='listFieldCheckbox']:checked").each(function(e) {
		if (true == $(this).prop("checked")) {
			value = $(this).prop('value');
			listSave[e]=value
		}
	 });
	localStorage.setItem("listSave"+showTable,JSON.stringify(listSave));
	log(listSave);
});
//********************************************************************表格显示  结束

var index = layer.getFrameIndex(window.name); //获取窗口索引
//保存设置的字段
$("body").on("click", ".close-list-field", function() {
	alert(index);
	layer.close(index);
});

//初始化隐藏表的列
function initTableCell(){
	$(".ajax-list-table").find("thead tr th").each(function(index) {
		
		listSave =JSON.parse(localStorage.getItem("listSave"+showTable));
		f_name= $(this).find("span").html();
		var cell=index+1
		var item = $.inArray(f_name, listSave);
		//log(item);
		if(item>=0 || typeof(f_name)=='undefined'){
			var strth = ".ajax-list-table thead tr th:nth-child("
			var strtd = ".ajax-list-table tbody tr td:nth-child("
			$(strtd+cell+")").show();
			$(strth+cell+")").show();
			//log(cell);
		}else{
			var strth = ".ajax-list-table thead tr th:nth-child("
			var strtd = ".ajax-list-table tbody tr td:nth-child("
			$(strtd+cell+")").hide();
			$(strth+cell+")").hide();
		}
	});	
}