<?php
//主页
class Txing extends Controller{
	public $model;
	function __construct(){
		$this -> check_login();
		$this -> model = new Tixing();
	}
	
	function index(){
		$this -> lists();
	}
	
	function lists() {
		$header = new View('header');
		$footer = new View('footer');
		
		$view = new View('tixing');
		$this -> model -> status = 1;
		$datalist = $this -> model -> find(
			array('whereAnd' => array(array('userid','='.$this -> user -> id),array('status','=1'),array('tixingtime','<'.time()) ))
		);
		$view -> set('datalist',$datalist);
		
		$view -> renderHtml($header.$view.$footer);
	}
	
	function del($id=NULL){
		$this -> model -> load($id[3]);
		$this -> model -> status =0;
		$this -> model -> save();
		ShowMsg('处理完毕','/txing');
	}

}
?>