<div id="main">
	<table border="0" cellpadding="0" cellspacing="0" class="mtable1">
		<tr class="table_title">
			<td>ID</td>
			<td>分组名</td>
			<td>组长</td>
			<td>录入时间</td>
			<td>操作</td>
		</tr>
		<?php foreach($datalist as $v){?>
		<tr class="table_main">
			<td><?php echo $v->id;?></td>
			<td><?php echo $v->groupname;?></td>
			<td><?php echo $v->group();?></td>
			<td><?php echo $v->creattime();?></td>
			<td><a class="st2" href="/users/grouplists/<?php echo $v->id;?>">修改</a> | <a class="st1" href="/users/del/<?php echo $v->id;?>">删除</a></td>
		</tr>
		<?php }?>
	</table>
</div>

<div id="add">
	<h2>分组录入/修改</h2>
	<form method="post" action="/users/grouplists" name="addform" id="addform">
		<ul>
			<li><div><em>*</em>分组名:</div><input type="text" name="groupname" size="40" value="<?php echo $datainfo->groupname;?>" datatype="*" nullmsg="分组名不能为空" errormsg="输入分组名" /><input type="hidden" name="id" value="<?php echo $datainfo->id;?>" /></li>
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