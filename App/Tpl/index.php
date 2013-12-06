<div id="main">
	<table border="0" cellpadding="0" cellspacing="0" class="mtable1">
		<tr class="table_title">
			<td>姓名</td>
			<td>地区</td>
			<td>是否已联系</td>
			<td>录入人</td>
			<td>录入时间</td>
			<td>操作</td>
		</tr>
		<?php foreach($datalist as $v){?>
		<tr class="table_main">
			<td><a class="st1" href="javascript:;" onclick="jQuery('#c_<?php echo $v->id;?>').toggle();" title="点击查看"><?php echo $v->uname;?></a> </td>
			<td><?php echo Config::item('Area.area1.'.$v->area1).Config::item('Area.area2_'.$v->area1.'.'.$v->area2);?></td>
			<td><span style="color:Green;"><?php echo $v->getstatus();?></span></td>
			<td><?php echo $v->getaddname();?></td>
			<td><?php echo $v->creattime();?></td>
			<td><a class="st2 inline" href="/home/ajax_tixing/<?php echo $v->id;?>">提醒我</a> | <a class="st1 inline" href="/home/ajax_beizhu/<?php echo $v->id;?>">备注</a> | <a class="st1" href="zhuan.aspx?bid=18752">转移</a></td>
		</tr>
		<tr class="table_con">
			<td colspan="6"><span>【<?php echo $v->getschool();?>】</span> <a href="javascript:;" onclick="jQuery('#b_<?php echo $v->id;?>').toggle();" title="点击查看" style="color:#777777;">▼查看备注</a></td>
		</tr>
		<tr id="b_<?php echo $v->id;?>" style="display:none">
			<td colspan="6" class="table_freedback">
				<?php foreach($v -> getbeizhu() as $value){?>
				<li>【<?php echo $value->creattime();?>】<b><?php echo $v->getaddname();?></b>：<?php echo $value->msg;?></li>
				<?php }?>
			</td>
		</tr>
		<tr	id="c_<?php echo $v->id;?>" style="display:none">
			<td colspan="6" class="table_info">
			<b>联系电话：</b><?php echo $v->tel;?>    <b>性别：</b><?php echo $v->sex==1?'男':'女';?><br>
			<b>地址：</b><?php echo $v->addr;?><br>
			<b>报名人数：</b><?php echo $v->num;?> 人<br>
			<b>联系结果备注：</b><span style="color:Red;"><?php echo $v->content;?></span><br>
			<b>招生老师：</b><?php echo $v->teacher;?><br>
			<b>留言：</b><?php echo $v->content;?>
			</td>
		</tr>
		<?php }?>
		<tr class="table_con">
			<td colspan="6" align="center"><?php echo $pagerData['linkhtml'];?></td>
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