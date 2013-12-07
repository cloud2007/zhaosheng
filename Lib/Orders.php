<?php
//测试类
class Orders extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'orders',
		'columns' => array(
			'id' => 'id',
			'uname' => 'uname',
			'addid' => 'addid',
			'oldid' => 'oldid',
			'reason' => 'reason',
			'edittime' => 'edittime',
			'tel' => 'tel',
			'qqnum' => 'qqnum',
			'email' => 'email',
			'sex' => 'sex',
			'num' => 'num',
			'area1' => 'area1',
			'area2' => 'area2',
			'addr' => 'addr',
			'content' => 'content',
			'teacher' => 'teacher',
			'school' => 'school',
			'status' => 'status',
			'creattime' => 'creattime',
			),
		'saveNeeds' => array('uname'),
		);
		parent::init($options);
	}
	
	public function dateConvert($timestamp) {
		return date('Y-m-d', $timestamp);
    }
	
	public function creattime() {
		return $this->dateConvert($this->creattime);
	}
	
	public function getlists(){
		return $this -> find();
	}
	
	public function getschool(){
		$school = new School();
		$rs = $school -> find(array('whereAnd'=>array(array('id','='.$this->school))));
		if($rs){
			return $rs[0]->schoolname;
		}else{
			return '未填写';
		}
	}
	
	public function getaddname(){
		$addname = new User();
		if($this->addid){
			$rs = $addname -> load($this->addid);
			if($rs){
				return $rs->userid;
			}else{
				return '未填写';
			}
		}else{
			return '未知';
		}
	}
	
	public function getoldname(){
		$addname = new User();
		if($this->oldid){
			$rs = $addname -> load($this->oldid);
			if($rs){
				return $rs->userid;
			}else{
				return '未填写';
			}
		}else{
			return '-';
		}
	}
	
	public function getbeizhu(){
		$beizhu = new Beizhu();
		$rs = $beizhu -> find(array('whereAnd'=>array(array('orderid','='.$this->id))));
		if($rs){
			return $rs;
		}else{
			return array();
		}
	}
	
	public function getstatus(){
		switch ($this->status)
		{
		case 1:
		  return '<font style="color:red">还未打电话</font>';
		  break;  
		case 2:
		  return '<font style="color:green">已打过电话</font>';
		  break;
		case 3:
		  return '<font style="color:blue">电话不通/电话错误 </font>';
		  break;
		case 4:
		  return '<font style="color:blue">其他问题</font>';
		  break;
		default:
		  return '<font style="color:black">未知</font>';
		}
	}

}
?>