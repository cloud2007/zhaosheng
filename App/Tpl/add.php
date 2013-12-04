<div id="add">
	<h2>名单录入</h2>
	<form method="post" action="" name="addform" id="addform">
		<ul>
			<li><div><em>*</em>姓名:</div><input type="text" name="sname" datatype="*" nullmsg="学生姓名不能为空" errormsg="学生姓名" /></li>
			<li><div><em>*</em>电话:</div><input type="text" name="tel" datatype="m" nullmsg="手机号码不能为空" errormsg="请输入正确的手机号码！" /></li>
			<li><div>QQ:</div><input type="text" name="qqnum" datatype="n4-12" ignore="ignore" errormsg="请输入输入正确的QQ号码！" /></li>
			<li><div>邮箱:</div><input type="text" name="email" datatype="e" ignore="ignore" errormsg="输入正确的电子邮箱" /></li>
			<li><div>性别:</div><input type="radio" name="sex" value="男"> 男　<input type="radio" name="sex" value="女"> 女</li>
			<li><div>报名人数:</div><input type="text" name="num" size="2" /> 人</li>
			<li><div><em>*</em>所在地区:</div>
				<select name="area1" id="area1" datatype="*" nullmsg="选择所在地区" errormsg="选择所在地区">
					<option value="">选择一个省份</option>
					<?php foreach(Config::item("Area.area1") as $key => $value){?>
					<option value="<?php echo $key;?>"><?php echo $value;?></option>
					<?php }?>
				</select>
				<select name="area2" id="area2" datatype="*" nullmsg="选择所在地区" errormsg="选择所在地区">
					<option value="">请先选择省份</option>
				</select>
				<script type="text/javascript">
					$("#area1").change(function(){
						$("#area2").load("/home/ajax_area/"+$("#area1").val()+"/"+Math.random());
					});
				</script>
			</li>
			<li><div>家庭地址:</div><input type="text" name="addr" size="50" /></li>
			<li style="padding:10px 0"><div>留言内容:</div><textarea name="content" style="height:100px;width:600px;"></textarea></li>
			<li><div><em>*</em>下级招生老师:</div><input type="text" name="teacher" /></li>
			<li><div><em>*</em>初步意向学校:</div><input type="text" name="school" /></li>
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