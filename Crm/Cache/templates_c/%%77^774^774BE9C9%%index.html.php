<?php /* Smarty version 2.6.26, created on 2017-05-12 23:32:53
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['sys']['title']; ?>
</title>
<link href="<?php echo @APP; ?>
/View/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo @APP; ?>
/View/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo @APP; ?>
/View/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="<?php echo @APP; ?>
/View/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<!--[if IE]>
<link href="<?php echo @APP; ?>
/View/themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->

<!--[if lte IE 9]>
<script src="<?php echo @APP; ?>
/View/js/speedup.js" type="text/javascript"></script>
<![endif]-->

<script src="<?php echo @APP; ?>
/View/js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/xheditor/xheditor-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/xheditor/xheditor_lang/zh-cn.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/uploadify/scripts/jquery.uploadify.js" type="text/javascript"></script>

<!-- svg图表  supports Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+ -->
<script type="text/javascript" src="<?php echo @APP; ?>
/View/chart/raphael.js"></script>
<script type="text/javascript" src="<?php echo @APP; ?>
/View/chart/g.raphael.js"></script>
<script type="text/javascript" src="<?php echo @APP; ?>
/View/chart/g.bar.js"></script>
<script type="text/javascript" src="<?php echo @APP; ?>
/View/chart/g.line.js"></script>
<script type="text/javascript" src="<?php echo @APP; ?>
/View/chart/g.pie.js"></script>
<script type="text/javascript" src="<?php echo @APP; ?>
/View/chart/g.dot.js"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.core.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.util.date.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.validate.method.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.regional.zh.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.barDrag.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.drag.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.tree.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.accordion.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.ui.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.theme.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.switchEnv.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.alertMsg.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.contextmenu.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.navTab.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.tab.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.resize.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.dialog.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.dialogDrag.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.sortDrag.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.cssTable.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.stable.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.taskBar.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.ajax.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.pagination.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.database.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.datepicker.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.effects.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.panel.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.checkbox.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.history.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.combox.js" type="text/javascript"></script>
<script src="<?php echo @APP; ?>
/View/js/dwz.print.js" type="text/javascript"></script>
<!--
<script src="bin/dwz.min.js" type="text/javascript"></script>
-->
<script src="<?php echo @APP; ?>
/View/js/dwz.regional.zh.js" type="text/javascript"></script>
<script type="text/javascript">
var path ="<?php echo @APP; ?>
"
$(function(){
	DWZ.init("<?php echo @APP; ?>
/View/dwz.frag.xml", {
		loginUrl:"<?php echo @ACT; ?>
/Login/login.html", loginTitle:"登录",	// 弹出登录对话框
//		loginUrl:"login.html",	// 跳到登录页面
		statusCode:{ok:200, error:300, timeout:301}, //【可选】
		pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
		debug:false,	// 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({themeBase:path}); // themeBase 相对于index页面的主题base路径
		}
	});
});

</script>
</head>

<body scroll="no">
<div id="layout">
  <div id="header">
    <div class="headerNav"> <?php if ($this->_tpl_vars['sys']['manager_spath'] == ''): ?> <a class="logo" href="http://bbs.07fly.com"></a> <?php else: ?> <img src='<?php echo @APP; ?>
/Cache/<?php echo $this->_tpl_vars['sys']['manager_spath']; ?>
' width="200" height="50" /> <?php endif; ?>
      <ul class="nav">
        <li><a href="https://me.alipay.com/lingqifei" target="_blank">捐赠</a></li>
        <li><a href="changepwd.html" target="dialog" width="600">设置</a></li>
        <li><a href="http://blog.csdn.net/lx_mai" target="_blank">博客</a></li>
        <li><a href="http://weibo.com/u/2299441430" target="_blank">微博</a></li>
        <li><a href="http://bbs.07fly.net" target="_blank">论坛</a></li>
        <li><a href="<?php echo @ACT; ?>
/Login/logout">退出</a></li>
      </ul>
      <ul class="themeList" id="themeList">
        <li theme="default">
          <div class="selected">蓝色</div>
        </li>
        <li theme="green">
          <div>绿色</div>
        </li>
        <!--<li theme="red"><div>红色</div></li>-->
        <li theme="purple">
          <div>紫色</div>
        </li>
        <li theme="silver">
          <div>银色</div>
        </li>
        <li theme="azure">
          <div>天蓝</div>
        </li>
      </ul>
    </div>
    
    <!-- navMenu --> 
    
  </div>
  <div id="leftside">
    <div id="sidebar_s">
      <div class="collapse">
        <div class="toggleCollapse">
          <div></div>
        </div>
      </div>
    </div>
    <div id="sidebar">
      <div class="toggleCollapse">
        <h2>主菜单</h2>
        <div>收缩</div>
      </div>
      <div class="accordion" fillSpace="sidebar"> <?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v1']):
?><!--显示主模块-->
        <div class="accordionHeader">
          <h2><span>Folder</span><?php echo $this->_tpl_vars['v1']['name']; ?>
</h2>
        </div>
        <div class="accordionContent">
          <ul class="tree treeFolder">
            <?php $_from = $this->_tpl_vars['v1']['parentID']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v2']):
?><!--显示一级菜单-->
            <li><a><?php echo $this->_tpl_vars['v2']['name']; ?>
</a>
              <ul>
                <?php $_from = $this->_tpl_vars['v2']['parentID']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v3']):
?><!--显示二级菜单-->
                <li><a href="<?php echo @ACT; ?>
<?php echo $this->_tpl_vars['v3']['url']; ?>
" target="navTab" rel="<?php echo $this->_tpl_vars['v3']['url']; ?>
"><?php echo $this->_tpl_vars['v3']['name']; ?>
</a></li>
                <?php endforeach; endif; unset($_from); ?>
              </ul>
            </li>
            <?php endforeach; endif; unset($_from); ?>
          </ul>
        </div>
        <?php endforeach; endif; unset($_from); ?> </div>
    </div>
  </div>
  <div id="container">
    <div id="navTab" class="tabsPage">
      <div class="tabsPageHeader">
        <div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
          <ul class="navTab-tab">
            <li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
          </ul>
        </div>
        <div class="tabsLeft">left</div>
        <!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
        <div class="tabsRight">right</div>
        <!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
        <div class="tabsMore">more</div>
      </div>
      <ul class="tabsMoreList">
        <li><a href="javascript:;">我的主页</a></li>
      </ul>
      <div class="navTab-panel tabsPageContent layoutBox">
        <div class="page unitBox">
          <div class="accountInfo">
            <div class="alertInfo">
              <h2><a href="http://www.07fly.com/" target="_blank">零起飞客户关系管理系统</a></h2>
              <a href="http://www.07fly.com/" target="_blank">零起飞客户关系管理系统演示视频</a> </div>
            <div class="right">
              <p><a href="http://www.07fly.com/" target="_blank" style="line-height:19px">使用手册(CHM)</a></p>
              <p><a href="http://www.07fly.com/" target="_blank" style="line-height:19px">开发视频教材</a></p>
            </div>
            <p><span>零起飞客户关系管理系统</span></p>
            <p>零起飞官方微博:<a href="http://weibo.com/u/2299441430" target="_blank">http://weibo.com/u/2299441430</a></p>
          </div>
          <div class="pageFormContent" layoutH="80" style="margin-right:230px">
            <p style="color:red">07FLY-CMS建站系统(QQ)交流群： 156729480 </p>
            <p style="color:red">07FLY-Web桌面应用(QQ)交流群：201192371</p>
            <p style="color:red">07FLY-CRM客户管理(QQ)交流群：575085787</p>
            <p style="color:red">AAARadius宽带计费(QQ)交流群：125444118</p>
            <div class="divider"></div>
            
            <h2>零起飞系列免费项目:</h2>
            <div class="unit"><a href="http://www.07fly.com" target="_blank">桌面应用框架-WebOs</a></div>
            <div class="unit"><a href="http://bbs.07fly.com" target="_blank">宽带认证计费系统-AAA</a></div>
            <div class="unit"><a href="http://oa.07fly.com" target="_blank">零起飞客户关系管理系统-CRM</a></div>
            <div class="unit"><a href="http://cms.07fly.com/" target="_blank">零起飞企业建站管理系统-CMS</a></div>
            <?php echo $this->_tpl_vars['sys']['i_copy']; ?>

            <?php echo $this->_tpl_vars['sys']['i_ser']; ?>
 
          </div>
          <div style="width:230px;position: absolute;top:60px;right:0" layoutH="80">
            <iframe width="100%" height="430" class="share_self"  frameborder="0" scrolling="no" src="<?php echo $this->_tpl_vars['sys']['i_web']; ?>
"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="footer"><a href="http://bbs.07fly.net" target="dialog"><?php echo $this->_tpl_vars['sys']['copyright']; ?>
</a></div>
<div style="display:none"><script src="http://s11.cnzz.com/stat.php?id=1261270154&web_id=1261270154" language="JavaScript"></script></div>
</body>
</html>