<form method="post" action="" name="addform" id="addform">
<div id="beizhuform">
	<li>姓名：<?php echo $datainfo ->uname ;?></li>
	<li>备注：<input type="text" size="50" name="msg" /><input type="hidden" size="50" name="ids" value="<?php echo $datainfo->id;?>" /></li>
	<li>时间：<input type="text" name="day" size="3" /> 天后</li>
	<li><input type="submit" class="btn1" value="立刻提交" /></li>
</div>
</form>
<style type="text/css">
#beizhuform li{ padding:6px 15px;}
</style>