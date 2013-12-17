<div id="main">
	<table border="0" cellpadding="0" cellspacing="0" class="mtable1">
		<tr class="table_title">
			<td>用户ID</td>
			<td>电话</td>
			<td>QQ</td>
			<td>权限</td>
			<td>分组</td>
			<td>最后登录</td>
			<td>操作</td>
		</tr>
		<?php foreach($datalist as $v){?>
		<tr class="table_main">
			<td><?php echo $v->userid;?></td>
			<td><?php echo $v->tel;?></td>
			<td><?php echo $v->qq;?></td>
			<td><?php echo $v->grant;?></td>
			<td><?php echo $v->group();?></td>
			<td><?php echo $v->logintime();?></td>
			<td><?php if($v->grant==1){?><a class="st2" href="/users/ajax_admin_c/<?php echo $v->id;?>">取消管理</a><?php }else{?><a class="st2" href="/users/ajax_admin/<?php echo $v->id;?>">设管理员</a><?php }?> | <?php if($v->is_zz==1){?><a class="st2" href="/users/ajax_zuzhang_c/<?php echo $v->id;?>">取消组长</a><?php }else{?><a class="st2" href="/users/ajax_zuzhang/<?php echo $v->id;?>">设为组长</a><?php }?> | <a class="st1 inline" href="/users/ajax_group/<?php echo $v->id;?>">移动分组</a> | <a class="st1" href="/users/ajax_setpwd/<?php echo $v->id;?>">重设密码</a></td>
		</tr>
		<?php }?>
		<tr class="table_con">
			<td colspan="7" align="center"><?php echo $pagerData['linkhtml'];?></td>
		</tr>
	</table>
</div>
<script>
$(document).ready(function(){$(".inline").colorbox({});});
</script>
<div style='display:none'>
	<div id='inline_content' style='padding:10px; background:#fff;'>
	<input type="text" value="" id="inline_id" />
	</div>
</div>