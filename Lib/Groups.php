<?php
//测试类
class Groups extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'groups',
		'columns' => array(
			'id' => 'id',
			'groupname' => 'groupname',
			'creattime' => 'creattime',
			),
		'saveNeeds' => array('groupname'),
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
	
	public function getschoolnum(){
		$school = new School();
		return $school -> count(array('whereAnd'=>array(array('zoneid','='.$this->id))));
	}
	
	public function getschoollist(){
		$school = new School();
		$rs = $school -> find(array('whereAnd'=>array(array('zoneid','='.$this->id))));
		print_r($rs);
		return $rs;
	}
	
	public function group(){
		$user = new User();
		$rs = $user -> find(array('whereAnd'=>array(array('group','='.$this->id))));
		if($rs){
			return $rs[0]->userid;
		}else{
			return '未设置';
		}
		
	}

}
?>