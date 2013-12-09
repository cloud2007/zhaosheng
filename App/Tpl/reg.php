<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统-注册登记</title>
<link href="/Static/style/reset.css" rel="stylesheet" type="text/css" />
<link href="/Static/style/reg_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Static/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/Static/js/Validform_v5.3.2.js"></script>
</head>

<body>
<form name="myform" id="regform" action="/login/regaction" method="post" autocomplete="off">
<div id="con">
	<div class="title"><b>管理系统--用户注册</b></div>
	<ul>
		<li><div><b>*</b>用户名：</div><input type="text" name="userid" class="input-border_pwd" ajaxurl="/login/ajax_check_userid" datatype="*" nullmsg="用户名不能为空" errormsg="输入用户名" /></li>
		<li><div><b>*</b>密码：</div><input type="password" name="userpwd1" class="input-border_pwd" datatype="s6-18" nullmsg="密码不能为空" errormsg="密码至少6个字符,最多18个字符！" /></li>
		<li><div><b>*</b>确认密码：</div><input type="password" name="userpwd2" class="input-border_pwd" recheck="userpwd1" datatype="*" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" /></li>
		<li><div><b>*</b>手机号码：</div><input type="text" name="tel" class="input-border_pwd" datatype="m" nullmsg="手机号码不能为空" errormsg="请输入正确的手机号码！" /></li>
		<li><div>电子邮箱：</div><input type="text" name="email" class="input-border_pwd" datatype="e" ignore="ignore" errormsg="输入正确的电子邮箱" /></li>
		<li><div>联系QQ：</div><input type="text" name="qq" class="input-border_pwd" datatype="n4-12" ignore="ignore" errormsg="请输入输入正确的QQ号码！" /></li>
		<li><div>所属分组：</div><input type="text" name="group" class="input-border_pwd" ></li>
		<li style=" padding:0 0 0 200px; line-height:50px; border:none"><input type="submit" name="reg" class="btn" value="提交注册"></li>
	</ul>
	<div class="clear"></div>
</div>
</form>
<div id="foot">&copy; 2013</div>
</body>
</html>
<script type="text/javascript">
$(function(){
	$("#regform").Validform({
		tiptype:3
	});
})
</script>