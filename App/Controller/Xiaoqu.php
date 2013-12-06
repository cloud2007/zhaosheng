<?php
//主页
class Xiaoqu extends Controller{
	public $model,$models;
	function __construct(){
		$this -> check_login();
		$this -> model = new Zone();
		$this -> models = new Zone();
	}
	
	function index(){
		$this -> lists();
	}
	
	function lists($id=NULL) {
		if(isset($_POST['id']) || isset($_POST['zonename'])){
			$id = $_POST['id'];
			$zonename = $_POST['zonename'];
			if($this->check_zonename($zonename)==0){
				ShowMsg('校区已存在','/xiaoqu/lists');
				die;
			}
			$this -> model -> id=$id;
			$this -> model -> zonename=$zonename;
			$this -> model -> creattime=time();
			$this -> model -> save();
			ShowMsg('添加校区成功','/xiaoqu/lists');
			die;
		}
		
		$header = new View('header');
		$footer = new View('footer');
		
		$view = new View('xiaoqulist');
		$view -> set('datalist',$this -> models -> getlists());
		if(isset($id[3]))$view -> set('datainfo',$this -> model -> load($id[3]));
		
		$view -> renderHtml($header.$view.$footer);
	}
	
	function del($id){
		$this -> model -> delete($id[3]);
		ShowMsg('校区删除成功','/xiaoqu/lists');
		die;
	}
	
	function check_zonename($check_zonename){
		$rs = $this -> models -> find(
			array(
				'whereAnd' => array(array('zonename',"='".$check_zonename."'")),
			)
		);
		if($rs){
			return 0;
		}else{
			return 1;
		}
		
	}	
		
}
?>