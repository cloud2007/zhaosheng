<div id="main">
	<h2><p style=" line-height:30px;"><a href="/deng">登记列表</a> | <a href="/deng/add">名单录入</a></p></h2>
	<form name="" action="" method="post">
	<p style="line-height:40px;">查询：<input type="text" style="width:100px;" name="wd" value="<?php echo $conf['wd'];?>" />
		<select name="school" style="line-height:25px;">
			<option value="">选择学校</option>
			<?php foreach($zonelist as $v){?>
			<option value="">◆◆◆◆ <?php echo $v->zonename;?> ◆◆◆◆</option>
				<?php foreach($v->getschoollist() as $vv){?>
				<option value="<?php echo $vv->id;?>" <?php if($conf['school']==$vv->id)echo'selected="selected"';?>>  ---- <?php echo $vv->schoolname;?></option>
				<?php }?>
			<?php }?>
		</select>
		<!--select id="userids" name="userids">
        	<option value="-2"  selected="selected">所有老师</option>
		</select-->
		<input type="submit" value="查找" class="btn2"  />
	</p>
	</form>

	<table border="0" cellpadding="0" cellspacing="0" class="mtable1">
		<tr class="table_title">
			<td>姓名</td>
			<td>录入人</td>
			<td>学校</td>
			<td>业绩者</td>
			<td>缴费金额</td>
			<td>录入时间</td>
			<td>操作</td>
		</tr>
		<?php foreach($datalist as $v){?>
		<tr class="table_main">
			<td><a class="st1" href="javascript:;" onclick="jQuery('#c_<?php echo $v->id;?>').toggle();" title="点击查看"><?php echo $v->uname;?></a> </td>
			<td><?php echo $v->getaddname();?></td>
			<td><?php echo $v->getschool();?></td>
			<td><?php echo $v->yejizhe;?></td>
			<td><?php echo $v->price;?></td>
			<td><?php echo $v->creattime();?></td>
			<td><a class="st1" href="/deng/add/<?php echo $v->id;?>">修改</a> | <a class="st1" href="/deng/del/<?php echo $v->id;?>">删除</a></td>
		</tr>
		<tr	id="c_<?php echo $v->id;?>" style="display:none">
			<td colspan="7" class="table_info">
			<b>联系电话：</b><?php echo $v->tel;?><?php echo $v->contact;?><br>
			<b>备注信息：</b><?php echo $v->beizhu;?><br>
			<b>地址：</b><?php echo $v->addr;?><br>
			<b>接送信息：</b><?php echo $v->info;?><br>
			</td>
		</tr>
		<?php }?>
		<tr class="table_con">
			<td colspan="7" align="center"><?php echo $pagerData['linkhtml'];?></td>
		</tr>
	</table>
</div>