<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理系统</title>
<script type="text/javascript" src="/Static/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/Static/js/Validform_v5.3.2.js"></script>
<script type="text/javascript" src="/Static/js/jquery.colorbox.js"></script>
<link href="/Static/style/reset.css" rel="stylesheet" type="text/css" />
<link href="/Static/style/style.css" rel="stylesheet" type="text/css" />
<link href="/Static/style/colorbox.css"  rel="stylesheet" type="text/css" />
</head>

<body>
<?php
if($_SESSION['userid']){
$tx = new Tixing();
$txcount = $tx -> count( array('whereAnd'=>array(array('userid','='.$_SESSION['userid']),array('status','=1'),array('tixingtime','<'.time()) )) );
}
?>
<div id="header">
	<?php echo $headeruser->userid.'你好！';?>
	<a href="/">所有名单</a> | 
	<a href="/home/neworder">转给我的</a> |
	<a href="/home/oldorder">转给其他市场的</a>  |
	<a href="/home/add">录入名单</a>  |
	<a href="/deng" style="color:Red;">报名登记</a> |
	<?php if($txcount>0) {?>
	<a href="/txing" target="_blank" style="color:Red;"><em>提醒( <?php echo $txcount;?> )</em></a> |
	<?php }else{?>
	<a href="javascript:;"><em>提醒( 0 )</em></a> |
	<?php }?>
	<?php if ($headeruser->grant==1){?>
	<a href="/xiaoqu/lists">校区管理</a> |
	<a href="/xuexiao/lists">学校管理</a> |
	<a href="/users/grouplists">分组管理</a> |
	<a href="/users/index">用户管理</a> |
	<a href="/login/reg">注册新用户</a> |
	<?php }?>
	<a href="/login/pwd">我的账户</a> |
	<a href="/login/loginout">退出</a>
	<!--b style="color:#FB01E6;">电话量今日：0个 &nbsp; 昨日：0个</b-->
</div>
<form name="" action="/home/index" method="post">
<div id="search">
	查询：
	<input type="text" name="wd" value="<?php echo $conf['wd'];?>" />
	<!--select name="schoolname" id="schoolname">
		<option value="">选择学校</option>
		<?php foreach($headerzone as $v){?>
		<option value="">◆◆◆◆ <?php echo $v->zonename;?> ◆◆◆◆</option>
			<?php foreach($v->getschoollist() as $vv){?>
			<option value="<?php echo $vv->id;?>">  ---- <?php echo $vv->schoolname;?></option>
			<?php }?>
		<?php }?>
	</select>
	<select id="userids" name="userids">
		<option value=""  selected="selected">所有人</option>
		<?php foreach($headerusers as $v){?>
		<option value="<?php echo $v->id;?>"><?php echo $v->userid;?></option>
		<?php }?>
	</select>
	<!--select id="schoolids" name="schoolids">
		<option value="-2"  selected="selected">==录入方式==</option>
		<option value="0" >后台录入</option>
		<option value="1" >学生在线报名</option>
	</select-->
	<select name="status">
		<option value=""  selected="selected">==电话情况==</option>
		<option value="1" <?php if($conf['status']==1)echo'selected="selected"';?>>未电话</option>
		<option value="2" <?php if($conf['status']==2)echo'selected="selected"';?>>已打电话</option>
		<option value="3" <?php if($conf['status']==3)echo'selected="selected"';?>>电话不通/电话错误</option>
		<option value="4" <?php if($conf['status']==4)echo'selected="selected"';?>>其他</option>
	</select>
	<input type="submit" value="查找" name="Text1" onclick="skeys();" class="btn2" />
</div>
</form>