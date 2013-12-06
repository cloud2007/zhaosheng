<?php
//测试类
class Beizhu extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'beizhu',
		'columns' => array(
			'id' => 'id',
			'orderid' => 'orderid',
			'msg' => 'msg',
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