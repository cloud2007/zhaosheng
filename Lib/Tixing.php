<?php
//测试类
class Tixing extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'tixing',
		'columns' => array(
			'id' => 'id',
			'orderid' => 'orderid',
			'userid' => 'userid',
			'msg' => 'msg',
			'tixingtime' => 'tixingtime',
			'status' => 'status',
			'creattime' => 'creattime',
			),
		'saveNeeds' => array(),
		);
		parent::init($options);
	}
	
	public function dateConvert($timestamp) {
		return date('Y-m-d H:i:s', $timestamp);
    }
	
	public function creattime() {
		return $this->dateConvert($this->creattime);
	}
	
}
?>