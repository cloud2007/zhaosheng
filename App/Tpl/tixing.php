<div id="main">
	<table border="0" cellpadding="0" cellspacing="0" class="mtable1">
		<tr class="table_title">
			<td>ID</td>
			<td>提醒内容</td>
			<td>操作时间</td>
			<td>提醒时间</td>
			<td>操作</td>
		</tr>
		<?php foreach($datalist as $v){?>
		<tr class="table_main">
			<td><?php echo $v->id;?></td>
			<td><?php echo $v->msg;?></td>
			<td><?php echo $v->creattime();?></td>
			<td><?php echo date('Y-m-d',$v->tixingtime);?></td>
			<td><a class="st1" href="/txing/del/<?php echo $v->id;?>">不在提醒</a></td>
		</tr>
		<?php }?>
		<tr class="table_main">
			<td colspan="5"><?php echo $pagerData['linkhtml'];?></td>
		</tr>
		
	</table>
</div>