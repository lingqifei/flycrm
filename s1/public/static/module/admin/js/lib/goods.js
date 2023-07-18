//创建商品目录，批量设置
$(document).ready(function () {
	//批量设置插件
	layer.config({
		path: static_root+'module/admin/js/plugins/layer/', //layer.js所在的目录，可以是绝对目录，也可以是相对目录
		extend: 'extend/layer.ext.js'
	});

	$(".batch_modify_sale").click(function () {
		layer.prompt({
			title: '批量设置销售价格',
			formType: 0 //prompt风格，支持0-2
		}, function (data, index) {
			$(".sku-table input[name='sku_sale_price[]']").val(data);
			$("form input[name='sale_price']").val(data);
			$("form input[name='sale_price']").attr("readonly", "readonly");
			layer.close(index);
		});
	});

	$(".batch_modify_market").click(function () {
		layer.prompt({
			title: '批量设置市场价格',
			formType: 0 //prompt风格，支持0-2
		}, function (data, index) {
			$(".sku-table input[name='sku_market_price[]']").val(data);
			$("form input[name='market_price']").val(data);
			$("form input[name='market_price']").attr("readonly", "readonly");
			layer.close(index);
		});
	});

	$(".batch_modify_cost").click(function () {
		layer.prompt({
			title: '批量设置成本价格',
			formType: 0 //prompt风格，支持0-2
		}, function (data, index) {
			$(".sku-table input[name='sku_cost_price[]']").val(data);
			$("form input[name='cost_price']").val(data);
			$("form input[name='cost_price']").attr("readonly", "readonly");
			layer.close(index);
		});
	});

	$(".batch_modify_stock").click(function () {
		layer.prompt({
			title: '批量设置库存',
			formType: 0 //prompt风格，支持0-2
		}, function (data, index) {
			$(".sku-table input[name='sku_stock[]']").val(data);

			stock = 0;
			$(".sku-table").find("input[name='sku_stock[]']").each(function () {
				stock += Number($(this).val());
			});
			$("form input[name='stock']").val(stock);
			$("form input[name='stock']").attr("readonly", "readonly");
			layer.close(index);
		});
	});


	//点击小类，选择中大类
	$(".spec_and_value").click(function(){
		var spec_id=$(this).attr("data-spec-id");
		$("#spec-id-"+spec_id).attr("checked", true);
	});

	//选择大类后，全先小类
	$(".checkboxCtrlId").click(function(){
		var spec_id=$(this).val();
		var spec_id_class="spec-"+spec_id+"-value";
		$("#"+spec_id_class+" input[type='checkbox']").prop("checked", $(this).prop('checked'));
	});

	//创建规格
	$(".create_spec").click(function(){
		var target=$(this).attr('data-url');
		var chk_value =[];
		$("tbody input[class='spec_and_value']:checked").each(function(){
			spec_id=$(this).attr('data-spec-id');
			spec_name=$(this).attr('data-spec-name');
			spec_value_name=$(this).attr('data-spec-value-name');
			spec_value_id=$(this).val();
			var single = {
				spec_id:spec_id,
				spec_name:spec_name,
				spec_value_name:spec_value_name,
				spec_value_id: spec_value_id
			};
			chk_value.push(single);
		});
		//chk_value_txt=JSON.stringify(chk_value);
		// var target="{:url('GoodsSpec/create')}";
		log(target);
		log(chk_value);
		$.ajax({
			type: "POST",
			url: target,
			data:{"spec_list":chk_value},
			dataType:"json",
			success: function(data){
				var html='<table class="table table-hover sku-table"><thead>';
				html +='	<tr>';
				html +='		<th width="200">商品规格</th>';
				html +='		<th width="50">销售价格</th>';
				html +='		<th width="50">市场价格</th>';
				html +='		<th width="50">成本价格</th>';
				html +='		<th width="50">库存量</th>';
				html +='	</tr>';
				html+='</thead><tbody>';
				$.each(data, function(idx, obj) {
					html +='<tr>';
					html +=  '<td>'+obj.txt_name;
					html +=  '<input type="hidden" name="sku_name[]" value="'+obj.txt_name+'">';
					html +=  '<input type="hidden" name="sku_value_items[]" value="'+obj.txt_id+'">';
					html +=  '</td>';
					html +=  '<td><input type="text" name="sku_sale_price[]" value="0.00"></td>';
					html +=  '<td><input type="text" name="sku_market_price[]" value="0.00"></td>';
					html +=  '<td><input type="text" name="sku_cost_price[]" value="0.00"></td>';
					html +=  '<td><input type="text" name="sku_stock[]" value="0"></td>';
					html +='</tr>';
				});
				html+='</tbody></table>';
				//parent.$("#{$create_id}").html(html);
				parent.$("#create_spec_show").html(html);
				//关闭iframe页面
				var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
				parent.layer.close(index);
				//console.log(data);
			}
		});
	});

	//点击是否启用多计量单位
	$(document).on("click", ".is_more_unit", function () {
		var ischk=$(this).prop("checked");
		if(ischk){
			$(".goods_sku_unit_one").addClass("hidden")
			$(".goods_sku_price_one").addClass("hidden")
			$(".goods_sku_unit_more").removeClass("hidden")
			$(".goods_sku_price_more").removeClass("hidden")


		}else{
			// $(".goods_sku_unit_one").css("display","block")
			// $(".goods_sku_unit_more").css("display","none")
			// $(".goods_sku_price_more").css("display","none")
			// $(".goods_sku_price_one").css("display","block")

			$(".goods_sku_unit_one").removeClass("hidden")
			$(".goods_sku_price_one").removeClass("hidden")

			$(".goods_sku_unit_more").addClass("hidden")
			$(".goods_sku_price_more").addClass("hidden")

		}
	});

	//选择多计量单位生成对应的扩展价格
	$(document).on("change", ".goods_sku_unit_id", function () {
		var obj = $(this);
		var target = obj.attr('data-url');
		var value = obj.val();
		$.ajax({
			type: "POST",
			url: target,
			data: {'id':value},
			dataType: "json",
			beforeSend:function () {

			},
			success: function (result) {
				var html = '<table class="table table-bordered">';
				html += '<tr>';
				html += '<td>基本单位</td>';
				html += '<td>'+result.name+'<input type="hidden" name="sku_unit_id[]" class="form-control" value="'+result.id+'"><input type="hidden" name="unit_name[]" class="form-control" value="'+result.name+'"></td>';
				html += '<td><input type="text" name="market_price[]" class="form-control"></td>';
				html += '<td><input type="text" name="sale_price[]" class="form-control"></td>';
				html += '<td><input type="text" name="vip_price[]" class="form-control"></td>';
				html += '<td><input type="text" name="cost_price[]" class="form-control"></td>';
				html += '</tr>';
				$.each(result.sublist, function(idx, row) {
					html +='<tr>';
					html += '<td>副单位'+(idx+1)+'</td>';
					html += '<td>'+row.name+'<input type="hidden" name="sku_unit_id[]" class="form-control" value="'+row.id+'"><input type="hidden" name="unit_name[]" class="form-control" value="'+row.name+'"></td>';
					html += '<td><input type="text" name="market_price[]" class="form-control"></td>';
					html += '<td><input type="text" name="sale_price[]" class="form-control"></td>';
					html += '<td><input type="text" name="vip_price[]" class="form-control"></td>';
					html += '<td><input type="text" name="cost_price[]" class="form-control"></td>';
					html +='</tr>';
				});
				$(".goods_sku_price_more tbody").html(html);
			},
			complete: function () { //执行完之后执行

			},
		});//end ajax post

	});

});