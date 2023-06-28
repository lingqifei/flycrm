/**
 * @param {Object} fixedCount：要冻结的列数（从左到右）
 * 不传的话，默认不冻结列；
 * 若值不为数字类型或者大于表格列数则提醒报错
 */
function FixedTable(tableId, fixedCount) {
	this.tableId = tableId;
	this.$table = $("#" + tableId);
	if (typeof fixedCount != "undefined") {
		if (typeof fixedCount != "number") {
			throw new Error("冻结的列数不是数字类型，请检查！");
		} else if (fixedCount < 0) {
			throw new Error("冻结的列数不能小于0，请检查！");
		} else if (fixedCount >= this.$table.find("thead tr:eq(0) th").length) {
			throw new Error("冻结的列数不能超过表格的总列数，请检查！");
		} else {
			this.fixedCount = fixedCount;
		}
	} else {
		this.fixedCount = 0;
	}
	
	this.init();
}

FixedTable.prototype = {
	constructor: FixedTable,
	init: function() {
		// 拼装html结构
		this.buildHtml();
		// 为整个容器添加滚动事件
		this.setScroll();
		// 调整一次尺寸
		this.adjustTableSize();
	},
	buildHtml: function() {
		var _this = this;
		// 为表格每个单元格添加索引
		var $theadTrs = this.$table.find("thead>tr");//表示所有表头行
		var $theadTrs = this.$table.find("thead>tr:eq(0) ");//表示表头行按第一行计算
		var fixedHeadHtml = ""; // 冻结表头html代码
		$theadTrs.each(function(trIndex, tr) {
			var $ths = $(tr).find("th");
			var trHtml = "<tr>";
			$ths.each(function(thIndex, th) {
				$(th).attr("adjust", trIndex + "-" + thIndex);
				if (thIndex < _this.fixedCount) {
					trHtml += $(th).prop("outerHTML");
				}
			});
			trHtml += "</tr>";
			fixedHeadHtml += trHtml;
		});
		var $tbodyTrs = this.$table.find("tbody>tr");
		var fixedBodyHtml = ""; // 冻结表体html代码
		$tbodyTrs.each(function(trIndex, tr) {
			var $tds = $(tr).find("td");
			var trHtml = "<tr>";
			$tds.each(function(tdIndex, td) {
				$(td).attr("adjust", trIndex + "-" + tdIndex);
				if (tdIndex < _this.fixedCount) {
					trHtml += $(td).prop("outerHTML");
				}
			});
			trHtml += "</tr>";
			fixedBodyHtml += trHtml;
		});
		
		/**拼装html结构**/
		// 拼表格父级结构
		var tableParentHtml = `
			<div id="table-view-` + this.tableId + `" class="table-view">
			</div>
		`;
		this.$table.wrap(tableParentHtml);
		// 拼冻结表头.table-head>#headTable
		var tableHeadHtml = `
			<div class="table-head">
				<table id="headTable" class="table table-bordered table-striped mb0">
					<thead>` + 
						this.$table.find("thead").html() + `
					</thead>
				</table>
			</div>
		`;
		$("#table-view-" + this.tableId).append(tableHeadHtml);
		if (this.fixedCount > 0) {
			// 拼冻结列和冻结表头公共表头.table-head-fixed>#fixedHeadTable
			var tableHeadFixedHtml = `
				<div class="table-head-fixed">
					<table id="fixedHeadTable" class="table table-bordered table-striped mb0">
						<thead>` + 
							fixedHeadHtml + `
						</thead>
					</table>
				</div>
			`;
			$("#table-view-" + this.tableId).append(tableHeadFixedHtml);
			// 拼冻结列的表格.table-fixed>#fixedTable
			var tableFixedHtml = `
				<div class="table-fixed">
					<table id="fixedTable" class="table table-bordered table-striped mb0">
						<thead>` + 
							fixedHeadHtml + `
						</thead>
						<tbody>` + 
							fixedBodyHtml + `
						</tbody>
					</table>
				</div>
			`;
			$("#table-view-" + this.tableId).append(tableFixedHtml);
		}
	},
	setScroll: function() {
		var oldScrollTop = 0, oldScrollLeft = 0;
		$("#table-view-" + this.tableId).scroll(function() {
			var scrollTop = $(this).scrollTop();
			var scrollLeft = $(this).scrollLeft();
			
			if (oldScrollTop != scrollTop) { // 上下滚动了
				$(this).find(".table-head-fixed").css("top", scrollTop + "px");
				$(this).find(".table-head").css("top", scrollTop + "px");
			}
			if (oldScrollLeft != scrollLeft) { // 左右滚动了
				$(this).find(".table-head-fixed").css("left", scrollLeft + "px");
				$(this).find(".table-fixed").css("left", scrollLeft + "px");
			}
			
			oldScrollTop = scrollTop;
			oldScrollLeft = scrollLeft;
			
		});
	},
	adjustTableSize: function() {
		var _this = this;
		// 表头冻结且列冻结表格表头部分尺寸计算
		$("#table-view-" + this.tableId).find("#fixedHeadTable th").each(function(index, copyEl) {
			alterThSize(copyEl);
		});
		// 表头冻结表格表头部分尺寸计算
		$("#table-view-" + this.tableId).find("#headTable th").each(function(index, copyEl) {
			alterThSize(copyEl);
		});
		// 列冻结表格表头部分尺寸计算
		$("#table-view-" + this.tableId).find("#fixedTable th").each(function(index, copyEl) {
			alterThSize(copyEl);
		});
		// 列冻结表格表体部分尺寸计算
		$("#table-view-" + this.tableId).find("#fixedTable td").each(function(index, copyEl) {
			alertTdSize(copyEl);
		});
		function alterThSize(copyEl) {
			var adjust = $(copyEl).attr('adjust');
			
			var dataTdWidth = _this.$table.find("th[adjust=" + adjust + "]").css('width');
		
			var dataTdHeight = _this.$table.find("th[adjust=" + adjust + "]").css('height');
			$(copyEl).attr("style", "min-width: " + dataTdWidth + "; height: " + dataTdHeight + ";");
		}
		
		function alertTdSize(copyEl) {
			var adjust = $(copyEl).attr('adjust');
			var dataTdWidth = _this.$table.find("td[adjust=" + adjust + "]").css('width');
					
			var dataTdHeight = _this.$table.find("td[adjust=" + adjust + "]").css('height');
			$(copyEl).attr("style", "min-width: " + dataTdWidth + "; height: " + dataTdHeight + ";");
		}
	},
	destory: function() {
		// 移除属性
		this.$table.find("th, td").removeAttr("adjust");
		// 拎出table
		$("#table-view-" + this.tableId).after(this.$table);
		$("#table-view-" + this.tableId).remove();
	}
}