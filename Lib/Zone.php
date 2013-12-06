<?php
//测试类
class Zone extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'zone',
		'columns' => array(
			'id' => 'id',
			'zonename' => 'zonename',
			'creattime' => 'creattime',
			),
		'saveNeeds' => array('zonename'),
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

}
?>