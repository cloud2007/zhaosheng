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
$tx = new Tixing();
$txcount = $tx -> count( array('whereAnd'=>array(array('userid','='.$_SESSION['userid']),array('status','=1'),array('tixingtime','<'.time()) )) );
?>
<div id="header">
	<a href="/">所有名单</a> | 
	<a href="/home">转给我的</a> |
	<a href="/">转给其他市场的</a>  |
	<a href="/home/add">录入名单</a>  |
	<a href="/home/dengji" style="color:Red;">报名登记</a> |
	<?php if($txcount>0) {?>
	<a href="/system/txing.aspx" target="_blank" style="color:Red;"><em>提醒( <?php echo $txcount;?> )</em></a> |
	<?php }else{?>
	<a href="javascript:;"><em>提醒( 0 )</em></a> |
	<?php }?>
	<a href="/xiaoqu/lists">校区管理</a> |
	<a href="/xuexiao/lists">学校管理</a> |
	<a href="/login/loginout">退出</a>
	<b style="color:#FB01E6;">电话量今日：0个 &nbsp; 昨日：0个</b>
</div>
<div id="search">
	查询：
	<input type="text" value="" name="keys" id="keys" />
	<select name="schoolname" id="schoolname">
		<option value="">选择学校</option>
		<option value="">◆◆◆◆四川市场 ◆◆◆◆</option>
	</select>
	<select id="userids" name="userids">
		<option value="-2"  selected="selected">所有老师</option>
	</select>
	<select id="schoolids" name="schoolids">
		<option value="-2"  selected="selected">==录入方式==</option>
		<option value="0" >后台录入</option>
		<option value="1" >学生在线报名</option>
	</select>
	<select id="baomings" name="baomings">
		<option value="-2"  selected="selected">==电话情况==</option>
		<option value="0" >未电话</option>
		<option value="1" >已打电话</option>
	</select>
	<input type="button" value="查找" name="Text1" onclick="skeys();" class="btn2" />
</div>