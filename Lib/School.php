<?php
//测试类
class School extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'school',
		'columns' => array(
			'id' => 'id',
			'zoneid' => 'zoneid',
			'schoolname' => 'schoolname',
			'creattime' => 'creattime',
			),
		'saveNeeds' => array('schoolname'),
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
	
	public function zonename(){
		$zone = new Zone();
		$zone -> load($this -> zoneid);
		return $zone->zonename;
	}

}
?>