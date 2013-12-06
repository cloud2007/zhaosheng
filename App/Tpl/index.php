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
			<td><span style="color:Green;">已打过电话</span></td>
			<td><a class="st1" href="" title="点击查看老师的信息">谢丽萍</a></td>
			<td><?php echo $v->creattime();?></td>
			<td><a class="st2" href="javascript:tixing(18752,'张林洁',1)" title="设置提醒">提醒我</a> | <a class="st1" href="javascript:bzhu(18752,'张林洁','9.17明天来校')">备注</a> | <a class="st1" href="zhuan.aspx?bid=18752">转移</a></td>
		</tr>
		<tr class="table_con">
			<td colspan="6"><span>【山东中西医结合大学(山东力明科技职业学院)四川招生基地】</span> <a href="javascript:;" onclick="jQuery('#b_18733').toggle();" title="点击查看" style="color:#777777;">▼</a>9.17明天来校</td>
		</tr>
		<tr id="b_<?php echo $v->id;?>" style="display:none">
			<td colspan="6" class="table_freedback">
				<li>【09-11 15:21:13】<b>杨娟</b>：9.11  现在在车子上   晚上五六点电话</li>
				<li>【09-11 15:21:13】<b>杨娟</b>：9.11  现在在车子上   晚上五六点电话</li>
				<li>【09-11 15:21:13】<b>杨娟</b>：9.11  现在在车子上   晚上五六点电话</li>
			</td>
		</tr>
		<tr	id="c_<?php echo $v->id;?>" style="display:none">
			<td colspan="6" class="table_info">
			<b>联系电话：</b><?php echo $v->tel;?>    <b>性别：</b><?php echo $v->sex==1?'男':'女';?><br>
			<b>地址：</b><?php echo $v->addr;?><br>
			<b>报名人数：</b><?php echo $v->num;?> 人<br>
			<b>联系结果备注：</b><span style="color:Red;"><?php echo $v->content;?></span><br>
			<b>招生老师：</b><?php echo $v->teacher;?><br>
			<b>留言：</b>现在24岁  之前药剂毕业  想挂一个大专口腔文凭  ，电话是家人的【来源：后台录入】
			</td>
		</tr>
		<?php }?>
	</table>
</div>