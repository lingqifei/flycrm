<?php /* Smarty version 2.6.26, created on 2019-09-30 08:56:07
         compiled from crm/cst_chance_show.html */ ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5><i class="fa fa-home"></i>销售机会列表</h5>
          <div class="ibox-tools"><a href="javascript:void(0);" class="btn btn-xs btn-default btn-help-detail" data-type="cst_chance"> <i class="fa fa-question-circle"> 操作说明</i></a> </div>
        </div>
        <div class="ibox-content table-responsive">
          <div class="row">
            <form id="pagerForm" method="post" class="form-inline">
              <div class="col-sm-3 m-b-xs"> 
				  		<a href="?" class="btn  btn-default"> <i class="fa fa-refresh"> 刷新</i></a>
				  		<a class="btn btn-info single_operation" data-act="add" href="javascript:void(0)"><i class="fa fa-plus"></i> 添加</a>
                <div class="btn-group">
                  <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">批量操作 <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)" class="batch_operation" data-act="online">批量发短信</a></li>
                    <li><a href="javascript:void(0)" class="batch_operation" data-act="offline">批量发邮件</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)" class="batch_operation" data-act="del">批量删除</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-9 m-b-xs text-right">
                <div class="form-group text-left  pd-b-5">
                  <select data-placeholder="有效期起始..." name="start_date" class="chosen-select" style="width: 150px;" >
                    <option value="0">发现时间所有</option>
                    <option value="3d">最近三天</option>
                    <option value="7d">最近一周</option>
                    <option value="15d">最近半月</option>
                    <option value="1m">最近一月</option>
                    <option value="3m">最近三月</option>
                    <option value="6m">最近六月</option>
                    <option value="12m">最近一年</option>
                  </select>
                </div>
                <div class="form-group text-left pd-b-5">
                  <select data-placeholder="有效期结束..." name="end_date" class="chosen-select" style="width: 150px;" >
                    <option value="0">预计签单时间所有</option>
                    <option value="3d">最近三天</option>
                    <option value="7d">最近一周</option>
                    <option value="15d">最近半月</option>
                    <option value="1m">最近一月</option>
                    <option value="3m">最近三月</option>
                    <option value="6m">最近六月</option>
                    <option value="12m">最近一年</option>
                  </select>
                </div>
              <div class="form-group text-left pd-b-5">
                <select data-placeholder="选择沟通阶段..." name="salestage" class="chosen-select salestage-chosen-select" style="width: 150px;" tabindex="2">
                  <option value="">请选沟通阶段</option>
						<?php $_from = $this->_tpl_vars['salestage']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                  <option value="<?php echo $this->_tpl_vars['v']['dict_id']; ?>
" hassubinfo="true"><?php echo $this->_tpl_vars['v']['name']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
                </select>
              </div>
				  		<div class="input-group pd-b-5">
                  <input type="text" name="name" placeholder="输入主题关键字搜索" class="form-control">
				  		</div>
                <div class="btn-group">
                  <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
                  <div class="dropdown-menu">
                    <div class="ibox-content">
                      <div class="form-group">
                        <label>客户名称</label>
                        <input type="text" name="customer_name" placeholder="搜索客户名称" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>备注内容</label>
                        <input type="text" name="intro" placeholder="搜索备注内容" class="form-control">
                      </div>
                      <div class="form-group">
                        <button type="button" class="btn btn-primary btn-xs btn-block ajaxSearchForm"><i class="fa fa-search"></i> 搜索</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="input-group">
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-primary ajaxSearchForm"><i class="fa fa-search"></i> 搜索</button>
                  </span> </div>
              </div>
            </form>
          </div>
          <table class="table table-hover sorttable 07fly-table" width="100%">
            <thead>
              <tr>
                <th width="22"><input type="checkbox" class="checkboxCtrl"></th>
                <th width="200"><span>销售机会主题</span></th>
                <th width="200" orderField="by_customer" class="sort-filed"><span>客户名称</span></th>
				  		<th width="120" orderField="by_finddate" class="sort-filed"><span>发现时间</span></th>
                <th width="120" orderField="by_billdate" class="sort-filed"><span>预计签单时间</span></th>
                <th width="100"	orderField="by_money" class="sort-filed"><span>预计金额</span></th>
                <th width="80"><span>当前阶段</span></th>
                <th><span>需求</span></th>
                <th width="80">操作</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            
          </table>
			  <table class="table 07fly-table"><tfoot class="ibox-content"><tr><td align="center" class="pagestring"></td></tr></tfoot></table>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<!-- 自定义js --> 
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script> 
<script id="tableListTpl" type="text/html">
<% for(var i=0;i<list.length;i++) { %>
	<tr>
		<td><input name="chance_id" class="checkboxCtrlId" value="<%=list[i]['chance_id']%>" type="checkbox"></td>
		<td><%=list[i]['name']%><br><small>(创建：<%=list[i]['create_time']%>)</small></td>
		<td>
			<%=list[i]['customer_name']%>
			<br><small>(代表：<%=list[i]['linkman']['name']%>)</small>
		</td>
		<td><%=list[i]['find_date']%></td>
		<td><%=list[i]['bill_date']%></td>
		<td><%=list[i]['money']%></td>
		<td><%=list[i]['salestage_name']%></td>
		<td class="overflow-td"><%=list[i]['intro']%></td>		
		<td width='10'>
			<div class="btn-group">
				<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">操作 <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li class="divider"></li>
					<li><a href="javascript:void(0)" class="single_operation" data-id="<%=list[i]['chance_id']%>" data-act="modify">修改</a></li>
					<li><a href="javascript:void(0)" class="single_operation" data-id="<%=list[i]['chance_id']%>" data-act="del">删除</a></li>
				</ul>
			</div>
		</td>
	</tr>
<% } %>
</script>
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script>
<script type="text/javascript">
var ajaxUrl='<?php echo @ACT; ?>
/crm/CstChance/cst_chance_json/';
$(document).ready(function () {
	turnPage(1);//页面加载时初始化分页
	$('.chosen-select').chosen({search_contains: true});
	$('.chosen-select').chosen().change(function(){
		ajaxSearchFormData = $("form").serialize();
		turnPage(1);
	});
	//添加
	$("body").on("click", ".cst_chance_add", function() {
		layer.open({
			type: 2,
			title: '添加服务记录',
			shadeClose: true,
			fixed: false, //不固定
			area: ['90%', '90%'],
			content: '<?php echo @ACT; ?>
/crm/CstChance/cst_chance_add/' //iframe的url
		});			
		return false;	
	});

	$("body").on("click", ".batch_operation", function() {
		batch_act =$(this).attr("data-act")
		var chk_value =[]; 
    	$("tbody input[class='checkboxCtrlId']:checked").each(function(){ 
        chk_value.push($(this).val()); 
		}); 
		chance_id_txt=chk_value.join(",");
		if(batch_act=="recommend"){
		   act_url="<?php echo @ACT; ?>
/crm/CstChance/cst_chance_modify_recommend/";
		}else if(batch_act=="del"){
			act_url="<?php echo @ACT; ?>
/crm/CstChance/cst_chance_del/";
		}
    //alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value); 
		$.ajax({
			type: "POST",
			url: act_url,
			data:{"chance_id":chance_id_txt},
			dataType:"json",
			success: function(data){
				if(data.statusCode=='200'){
					layer.msg('操作成功', {icon: 1}); 
					turnPage(1);
				}
			},
			complete: function () {//完成响应
			}
		});
	});
	
	$("body").on("click", ".single_operation", function() {
		chance_id =$(this).attr("data-id");
		single_act =$(this).attr("data-act")
		if(single_act=="add"){
			layer.open({
				type: 2,
				title: '添加销售机会',
				shadeClose: true,
				fixed: false, //不固定
				area: ['90%', '90%'],
				content: '<?php echo @ACT; ?>
/crm/CstChance/cst_chance_add/',
				end: function () {
					turnPage(1);//页面加载时初始化分页
				}
			});			
			return false;		
		}else if(single_act=="modify"){
			layer.open({
				type: 2,
				title: '修改销售机会',
				shadeClose: true,
				fixed: false, //不固定
				area: ['90%', '90%'],
				content: '<?php echo @ACT; ?>
/crm/CstChance/cst_chance_modify/chance_id/'+chance_id+'/',
				end: function () {
					turnPage(1);//页面加载时初始化分页
				}
			});			
			return false;	
		}else if(single_act=="del"){
			act_url="<?php echo @ACT; ?>
/crm/CstChance/cst_chance_del/";
			$.ajax({
				type: "POST",
				url: act_url,
				data:{"chance_id":chance_id},
				dataType:"json",
				success: function(data){
					if(data.statusCode=='200'){
						layer.msg('操作成功', {icon: 1}); 
					}
				}
			});
		}

	});
});
</script>