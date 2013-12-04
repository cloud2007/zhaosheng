<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统-管理员登录</title>
<link href="/Static/style/reset.css" rel="stylesheet" type="text/css" />
<link href="/Static/style/login_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="logo"><b>管理系统--用户登陆</b></div>
<div id="con">
	<div id="left"></div>
	<div id="login">
		<div class="loginlogo"><img src="/static/images/login_logo.gif" /></div>
            <form name="myform" action="/login/loginaction" method="post">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="logTb">
                <tr>
                  <th style="padding-top:7px;">管理账号</th>
                  <td><input  type="text" name="userid" class="input-border" ></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <th style="padding-top:7px;">管理密码</th>
                  <td width="90"><input  type="password" name="userpwd" class="input-border_pwd"></td>
                  <td></td>
                </tr>
                <tr>
                  <th style="padding-top:7px;">验证码</th>
                  <td colspan="2"><input name="vcode" type="text" class="input-yzm" usage="openUrl();" Tip="验证码不能为空！" size="5" maxlength="5" />&nbsp;<img src="/login/vCode" align="absmiddle" alt="图片看不清？点击重新得到验证码" style="cursor:hand;" onClick="this.src+='?p=<?php echo uniqid()?>'" /></td>
                </tr>
                <tr>
                  <th>&nbsp;</th>
                  <td colspan="2" style="padding-top:0px; padding-left:6px; padding-bottom:0px;"><input type="submit" value="" class="login-b" onMouseOver="this.className='login-b2'" onMouseDown="this.className='login-b3'" onMouseOut="this.className='login-b'"/></td>
                </tr>
                <tr>
                  <th>&nbsp;</th>
                  <td colspan="2" ><div class="reg">系统时间:<?php echo date('Y年m月d日 H:m:s',time());?></div></td>
                </tr>
              </table>
		</form>
	</div>
	<div id="right"></div>
</div>
<div id="foot">&copy; 2013</div>
</body>
</html>