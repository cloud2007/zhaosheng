<?php
class Controller{
	public $user = array();
	function __construct(){}
	function error($error_id){
		echo $error_id;
	}
	//检查是否登录，如果已登录，返回登录用户的信息
	function check_login(){
		$cuserLogin = new Login();
		$this -> user = $cuserLogin -> getUser();
		if (!isset($this -> user ->id)) header('Location:/login/login');
	}
	
}
?>