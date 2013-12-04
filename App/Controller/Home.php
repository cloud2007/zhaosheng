<?php
//主页
class Home extends Controller{
	function __construct(){
		$this -> check_login();
		//print_r($this -> user);
	}
	
	function index() {
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('index');
		$view -> set('a','123');
		$view -> renderHtml($header.$view.$footer);
	}
	
	//录入名单
	function add() {
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('add');
		$view -> set('a','123');
		$view -> renderHtml($header.$view.$footer);
	}
	
	//读取区域
	function ajax_area($o){
		$area=$o[3];
		if(!$area){
			echo '<option value="0">请先选择省份</option>';
		}else{
			try {
				$area2=Config::item("Area.area2_".$area);
				foreach($area2 as $key => $value){
				//if($_GET['area2'] == $key)
				//$sel = "selected";
				//else
				//$sel = "";
				echo "<option value=\"{$key}\">{$value}</option>";
				}
				echo '<option value="">不选择</option>';
			} 
			catch(Exception $e){
				echo "选择错误!";
			}
		}

	}
	
}
?>