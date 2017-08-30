<?php /* Smarty version 2.6.26, created on 2017-08-30 08:32:04
         compiled from login.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['sys']['title']; ?>
</title>
<script src="<?php echo @APP; ?>
/View/ui/login/js/jquery-1.8.0.min.js" type="text/javascript" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo @APP; ?>
/View/ui/login/css/register.css"/>
</head>
<body>
<form class="signup_form_form" id="signup_form" method="post" action="" data-secure-action="<?php echo @ACT; ?>
/Index/login" data-secure-ajax-action="">
  <div class='signup_container'>
    <h1 class='signup_title'><?php echo $this->_tpl_vars['sys']['companyname']; ?>
</h1>
    <img src='<?php echo @APP; ?>
/View/ui/login/images/people.png' id='admin'/>
    <div id="signup_forms" class="signup_forms clearfix">
      <div class="form_row first_row"> 
        <!-- <label for="signup_email">请输入用户名</label><div class='tip ok'></div>-->
        <input type="text" name="username" placeholder="请输入用户名" id="signup_name" data-required="required">
      </div>
      <div class="form_row"> 
        <!-- <label for="signup_password">请输入密码</label><div class='tip error'></div>-->
        <input type="password" name="password" placeholder="请输入密码" id="signup_password" data-required="required">
      </div>
    </div>
    <div><?php echo $this->_tpl_vars['txtinfo']; ?>
</div>
    <div class="login-btn-set">
      <div class='rem'>记住我</div>
      <input id="login" type="submit" class='login-btn' value="">
    </div>
    <p class='copyright'>版权所有 零起飞网络</p>
  </div>
</form>
<div style="display:none"><script src="http://s11.cnzz.com/stat.php?id=1261270154&web_id=1261270154" language="JavaScript"></script></div>
</body>
<script type="text/javascript">

$(function(){
    $('.rem').click(function(){
        $(this).toggleClass('selected');
    })
    $('#signup_select').click(function(){
        $('.form_row ul').show();
        event.cancelBubble = true;
    })
    $('#d').click(function(){
        $('.form_row ul').toggle();
        event.cancelBubble = true;
    })

    $('body').click(function(){
        $('.form_row ul').hide();
    })

    $('.form_row li').click(function(){
        var v  = $(this).text();
        $('#signup_select').val(v);
        $('.form_row ul').hide();
    })


})


</script>
</html>