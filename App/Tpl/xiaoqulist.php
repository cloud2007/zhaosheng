<div id="main">
	<table border="0" cellpadding="0" cellspacing="0" class="mtable1">
		<tr class="table_title">
			<td>ID</td>
			<td>校区名</td>
			<td>学校数</td>
			<td>录入时间</td>
			<td>操作</td>
		</tr>
		<?php foreach($datalist as $v){?>
		<tr class="table_main">
			<td><?php echo $v->id;?></td>
			<td><?php echo $v->zonename;?></td>
			<td><?php echo $v->getschoolnum();?></td>
			<td><?php echo $v->creattime();?></td>
			<td><a class="st2" href="/xiaoqu/lists/<?php echo $v->id;?>">修改</a> | <a class="st1" href="/xiaoqu/del/<?php echo $v->id;?>">删除</a></td>
		</tr>
		<?php }?>
	</table>
</div>

<div id="add">
	<h2>校区录入/修改</h2>
	<form method="post" action="/xiaoqu/lists" name="addform" id="addform">
		<ul>
			<li><div><em>*</em>校区名:</div><input type="text" name="zonename" size="40" value="<?php echo $datainfo->zonename;?>" datatype="*" nullmsg="校区名不能为空" errormsg="输入校区名" /><input type="hidden" name="id" value="<?php echo $datainfo->id;?>" /></li>
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