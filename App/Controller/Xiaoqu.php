<?php
//主页
class Xiaoqu extends Controller{
	function __construct(){
		$this -> check_login();
		//print_r($this -> user);
	}
	
	function lists() {
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('xiaoqulist');
		$view -> renderHtml($header.$view.$footer);
	}
	
}
?>