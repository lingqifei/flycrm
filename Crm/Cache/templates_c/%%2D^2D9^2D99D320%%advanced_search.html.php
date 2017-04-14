<?php /* Smarty version 2.6.26, created on 2016-12-23 16:27:37
         compiled from customer/advanced_search.html */ ?>

<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/Customer/customer_show/" class="pageForm" onsubmit="return navTabSearch(this);">
		<div class="pageFormContent" layoutH="58">
			<div class="unit">
				<label>客户名称：</label>
				<input type="text"  name="name"/>
				<span class="inputInfo">关键字或全称</span>
			</div>
			<div class="unit">
				<label>客户来源：</label>
				<input name="source.id" value="" type="hidden"/>
				<input class="required" name="source.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/source/" lookupGroup="source"/>
			</div>
			<div class="unit">
				<label>客户等级：</label>
				<input name="level.id" value="" type="hidden"/>
				<input class="required" name="level.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/level/" lookupGroup="level"/>
			</div>
			<div class="unit">
				<label>经济类型：</label>
				<input name="ecotype.id" value="" type="hidden"/>
				<input class="required" name="ecotype.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/ecotype/" lookupGroup="ecotype"/>
			</div>
			<div class="unit">
				<label>所属行业：</label>
				<input name="trade.id" value="" type="hidden"/>
				<input class="required" name="trade.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/trade/" lookupGroup="trade"/>
			</div>
			<div class="unit">
				<label>联系人：</label>
				<input type="text"  name="linkman" />
			</div>
			<div class="unit">
				<label>联系电话：</label>
				<input type="text"  name="tel"/>
				<span class="inputInfo">完整的号码</span>
			</div>
			<div class="unit">
				<label>传真：</label>
				<input type="text"  name="fax" />
				<span class="inputInfo">完整的号码</span>
			</div>
			<div class="unit">
				<label>邮箱地址：</label>
				<input type="text"  name="email" />
				<span class="inputInfo">可多选</span>
			</div>
			<div class="unit">
				<label>邮编：</label>
				<input type="text"  name="zipcode"/>
				<span class="inputInfo">可多选</span>
			</div>
			<div class="unit">
				<label>联系地址：</label>
				<input type="text"  name="address" />
				<span class="inputInfo">可多选</span>
			</div>
			<div class="unit">
				<label>建档日期：</label>
				<input type="text"  name="date1" class="date"/>
				<span class="inputInfo">大于等于，小于等于</span>
			</div>
			<div class="unit">
				<label>管户经理：</label>
				<input type="text"  />
				<span class="inputInfo">全辖查询时用</span>
			</div>
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">开始检索</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="reset">清空重输</button></div></div></li>
			</ul>
		</div>
	</form>
</div>