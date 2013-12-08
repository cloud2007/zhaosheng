<form method="post" action="" name="addform" id="addform">
<div id="beizhuform">
	<li>用户名：<?php echo $datainfo ->userid ;?><input type="hidden" size="50" name="id" value="<?php echo $datainfo->id;?>" /></li>
	<li>移动到：
		<select name="groupid" datatype="*" nullmsg="选择所属分组" errormsg="选择所属分组">
			<option value="0">无所属分组</option>
			<?php foreach($datalist as $v){?>
			<option value="<?php echo $v->id;?>" <?php if($v->id == $datainfo -> group)echo 'selected="selected"';?>><?php echo $v->groupname;?></option>
			<?php }?>
		</select>
	</li>
	<li><input type="submit" class="btn1" value="立刻提交" /></li>
</div>
</form>
<style type="text/css">
#beizhuform li{ padding:6px 15px;}
</style>