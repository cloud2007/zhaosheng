<form method="post" action="" name="addform" id="addform">
<div id="beizhuform">
	<li>姓名：<?php echo $datainfo ->uname ;?></li>
	<li>备注：<input type="text" size="50" name="msg" /><input type="hidden" size="50" name="id" value="<?php echo $datainfo->id;?>" /></li>
	<li>电话：
		<input type="radio" name="status" value="1" <?php if($datainfo->status==1)echo 'checked="checked"';?> /> 还未打电话
		<input type="radio" name="status" value="2" <?php if($datainfo->status==2)echo 'checked="checked"';?> /> 已打过电话
		<input type="radio" name="status" value="3" <?php if($datainfo->status==3)echo 'checked="checked"';?> /> 电话不通/电话错误
		<input type="radio" name="status" value="4" <?php if($datainfo->status==4)echo 'checked="checked"';?> /> 其他问题。写在备注中
	</li>
	<li><input type="submit" class="btn1" value="立刻提交" /></li>
</div>
</form>
<style type="text/css">
#beizhuform li{ padding:6px 15px;}
</style>