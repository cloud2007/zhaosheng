<?php
//主页
class Home extends Controller{
	function __construct(){}
	
	function index() {
		$view = new View('index');
		$view -> set('a','123');
		$view -> renderHtml($view->render());
	}
	
	function index1() {
		$view = new View('index');
		$view -> set('a','12344');
		$view -> renderHtml($view->render());
	}
	
}
?>