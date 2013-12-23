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
			'grant' => 'grant',
			'is_zz' => 'is_zz',
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
	
	public function logintime() {
		return date('Y-m-d H:i:s',$this->logintime);
	}
	
	public function group(){
		$group = new Groups();
		try{
			$group -> load($this -> group);
			return $group->groupname;
		}catch (Exception $e) {
			return '-';
		}
		
	}
	
	function grant(){
		if($this -> grant == 1){
			return '管理员';
		}
		return '普通用户';
	}

}
?>