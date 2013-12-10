<div id="add">
	<h2><p style="padding:10px; line-height:30px;"><a href="/deng">登记列表</a> | <a href="/deng/add">名单录入</a></p></h2>
	<form method="post" action="" name="addform" id="addform">
		<ul>
			<li><div><em>*</em>姓名:</div><input type="hidden" name="id" value="<?php echo $datainfo->id;?>" /><input type="text" name="uname" datatype="*" nullmsg="学生姓名不能为空" value="<?php echo $datainfo->uname;?>" /><span class="Validform_checktip">如:张三</span></li>
			<li><div><em>*</em>电话:</div><input type="text" name="tel" datatype="*" nullmsg="电话号码不能为空" value="<?php echo $datainfo->tel;?>" /><span class="Validform_checktip">输入电话号码，手机或者座机号码</span></li>
			<li><div>其他联系方式:</div><input type="text" name="contact" value="<?php echo $datainfo->contact;?>" /><span class="Validform_checktip">如:E-Mail,Msn等</span></li>
			<li><div><em>*</em>地址:</div><input type="text" name="addr" size="50" datatype="*" nullmsg="地址不能为空" value="<?php echo $datainfo->addr;?>" /><span class="Validform_checktip">如：四川省成都市双流县</span></li>
			<li><div><em>*</em>报名时间:</div><input type="text" name="baoming" datatype="*" nullmsg="报名时间不能为空" value="<?php echo $datainfo->baoming;?>" /><span class="Validform_checktip">如:<?php echo date('Y年m月d日');?>上午</span></li>
			<li><div><em>*</em>缴费金额:</div><input type="text" name="price" datatype="*" nullmsg="报名时间不能为空" value="<?php echo $datainfo->price;?>" /><span class="Validform_checktip">如：500元预报名，7800元全费</span></li>
			<li><div><em>*</em>接送信息:</div><input type="text" name="info" datatype="*" nullmsg="接送信息不能为空" size="50" value="<?php echo $datainfo->info;?>" /><span class="Validform_checktip">如：老王在石羊车站接送</span></li>
			<li><div><em>*</em>类型:</div>
				<select name="types" datatype="*" nullmsg="选择类型">
					<?php foreach(Config::item('Types') as $k=>$v){?>
					<option value="<?php echo $k;?>" <?php if($datainfo->types==$k)echo'selected="selected"';?>><?php echo $v;?></option>
					<?php }?>
				</select><span class="Validform_checktip"></span>
			</li>
			<li style="padding:10px 0"><div><em>*</em>业绩者:</div><input type="text" name="yejizhe" datatype="*" nullmsg="业绩者不能为空" value="<?php echo $datainfo->yejizhe;?>" /><span class="Validform_checktip">请准确填写。否则不计算业绩</span></li>
			<li><div><em>*</em>初步意向学校:</div>
				<select name="school" datatype="*" nullmsg="选择意向学校" errormsg="意向学校">
					<?php foreach($zonelist as $v){?>
					<option value="">◆◆◆◆ <?php echo $v->zonename;?> ◆◆◆◆</option>
						<?php foreach($v->getschoollist() as $vv){?>
						<option value="<?php echo $vv->id;?>" <?php if($datainfo->school==$vv->id)echo'selected="selected"';?>>  ---- <?php echo $vv->schoolname;?></option>
						<?php }?>
					<?php }?>
				</select>
			</li>
			<li style="padding:10px 0"><div><em>*</em>备注:</div><textarea name="beizhu" tip="可填写备注，如学生的情况，咨询情况。" style="height:100px;width:600px;"><?php echo $datainfo->beizhu?$datainfo->beizhu:'可填写备注，如学生的情况，咨询情况。';?></textarea></li>
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