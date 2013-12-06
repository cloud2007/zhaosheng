<?php
//测试类
class Order extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'order',
		'columns' => array(
			'id' => 'id',
			'uname' => 'uname',
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
	
	public function getschoolnum(){
		$school = new School();
		return $school -> count(array('whereAnd'=>array(array('zoneid','='.$this->id))));
	}

}
?>