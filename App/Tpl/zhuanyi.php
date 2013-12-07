<div id="main">
	<div style="padding:10px;border:1px solid #eeeeee;width:98%;float:left;">
	<form action="" method="post">
		<input type="hidden" name="id" value="<?php echo $datainfo->id;?>" />
		转给其他市场人员: 
		<select id="userid" name="userid">
			<?php foreach($datauser as $v){?>
			<option value="<?php echo $v->id;?>" ><?php echo $v->userid;?></option>
			<?php }?>
		</select>
		转移理由: <input value="" name="reason" size="50" />
		<input type="submit" class="btn2" value=" 转 移 " />
	</form>
</div>