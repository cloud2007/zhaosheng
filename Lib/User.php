<?php
//测试类
class User extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'user',
		'columns' => array(
			'id' => 'id',
			'userid' => 'userid',
			'userpwd' => 'userpwd',
			'tel' => 'tel',
			'email' => 'email',
			'qq' => 'qq',
			'group' => 'group',
			'creattime' => 'creattime',
			'logintime' => 'logintime',
			),
		'saveNeeds' => array('userid','userpwd'),
		);
		parent::init($options);
	}
	
	public function dateConvert($timestamp) {
		return date('Y-m-d', $timestamp);
    }

	public function creattime() {
		return $this->dateConvert($this->creattime);
	}

}
?>