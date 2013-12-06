<div id="main">
	<table border="0" cellpadding="0" cellspacing="0" class="mtable1">
		<tr class="table_title">
			<td>ID</td>
			<td>学校名称</td>
			<td>所属校区</td>
			<td>录入时间</td>
			<td>操作</td>
		</tr>
		<?php foreach($datalist as $v){?>
		<tr class="table_main">
			<td><?php echo $v->id;?></td>
			<td><?php echo $v->schoolname;?></td>
			<td><?php echo $v->zonename();?></td>
			<td><?php echo $v->creattime();?></td>
			<td><a class="st2" href="/xuexiao/lists/<?php echo $v->id;?>">修改</a> | <a class="st1" href="/xiaoqu/del/<?php echo $v->id;?>">删除</a></td>
		</tr>
		<?php }?>
		<tr class="table_main">
			<td colspan="5"><?php echo $pagerData['linkhtml'];?></td>
		</tr>
		
	</table>
</div>

<div id="add">
	<h2>学校录入/修改</h2>
	<form method="post" action="/xuexiao/lists" name="addform" id="addform">
		<ul>
			<li><div><em>*</em>学校名:</div><input type="text" name="schoolname" size="40" value="<?php echo $datainfo->schoolname;?>" datatype="*" nullmsg="学校名不能为空" errormsg="输入学校名" /><input type="hidden" name="id" value="<?php echo $datainfo->id;?>" /></li>
			<li><div><em>*</em>所属校区:</div>
			<select name="zoneid" datatype="*" nullmsg="选择所属校区" errormsg="选择所属校区">
				<option value="">请选择所属校区</option>
				<?php foreach($zonelist as $v){?>
				<option value="<?php echo $v->id;?>" <?php if($v->id == $datainfo -> zoneid)echo 'selected="selected"';?>><?php echo $v->zonename;?></option>
				<?php }?>
			</select>
			</li>
			<li style="padding:0 0 0 200px"><input type="submit" class="btn1" value="立刻提交" /></li>
		</ul>
	</form>
</div>
<script type="text/javascript">
$(function(){
	$("#addform").Validform({
		tiptype:3
	});
})
</script>