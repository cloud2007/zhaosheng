<?php
//主页
class Home extends Controller{
	public $model;
	function __construct(){
		$this -> check_login();
		$this -> model = new Order();
		$this -> modelzone = new Zone();
	}
	
	function index() {
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('index');
		$view -> set('datalist',$this -> model -> find());
		$view -> renderHtml($header.$view.$footer);
	}
	
	//录入名单
	function add() {
		if( isset($_POST['uname']) ){
			$this -> model -> id=$_POST['id'];
			$this -> model -> uname=$_POST['uname'];
			$this -> model -> tel=$_POST['tel'];
			$this -> model -> qqnum=$_POST['qqnum'];
			$this -> model -> email=$_POST['email'];
			$this -> model -> sex=$_POST['sex'];
			$this -> model -> num=$_POST['num'];
			$this -> model -> area1=$_POST['area1'];
			$this -> model -> area2=$_POST['area2'];
			$this -> model -> addr=$_POST['addr'];
			$this -> model -> content=$_POST['content'];
			$this -> model -> teacher=$_POST['teacher'];
			$this -> model -> school=$_POST['school'];
			$this -> model -> creattime=time();
			$this -> model -> save();
			ShowMsg('名单添加成功','/');
			die;
		}
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('add');
		$view -> set('zonelist',$this -> modelzone -> find());
		
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