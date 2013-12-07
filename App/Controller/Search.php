<?php
//主页
class Search extends Controller{
	public $model;
	function __construct(){
		$this -> check_login();
		$this -> model = new Orders();
		$this -> modelzone = new Zone();
		$this -> modelbeizhu = new Beizhu();
		$this -> modeltixing = new Tixing();
		$this -> modeluser = new User();
	}
	
	function index($id=NULL) {
		$postarray = array();
		$postarray['wd']='w'.$_POST['wd'];
		$postarray['istel']='t'.$_POST['istel'];
		$poststr = implode('-',$postarray);
		//print_r($_POST);
		//处理备注信息
		if($_POST['id']){
			$this -> model -> load($_POST['id']);
			$this -> model -> status = $_POST['status'];
			$this -> model -> save();
			if($_POST['msg']){
				$this -> modelbeizhu -> orderid = $_POST['id'];
				$this -> modelbeizhu -> msg = $_POST['msg'];
				$this -> modelbeizhu -> creattime = time();
				$this -> modelbeizhu -> save();
			}
			ShowMsg('处理完毕','/');
			die;
		}
		//处理提醒
		if($_POST['ids'] && $_POST['msg']){
			$this -> modeltixing -> orderid = $_POST['ids'];
			$this -> modeltixing -> userid = $this -> user -> id;
			$this -> modeltixing -> msg = $_POST['msg'];
			$this -> modeltixing -> tixingtime = strtotime(date("Y-m-d")) + 24*60*60*$_POST['day'];
			$this -> modeltixing -> status = 1;
			$this -> modeltixing -> creattime = time();
			$this -> modeltixing -> save();
			ShowMsg('处理完毕','/');
			die;
		}
		
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('index');
		
		$pager = new Pager();
		$pagesize = 1;
		if(isset($id[3])&&is_numeric($id[3])){
			$currentpage=$id[3];
		}else{
			$currentpage=1;
		}
		$PageNum=($currentpage-1)*$pagesize;
		$options = array();
		$whereand = array();
		$whereand[] = array('addid','='.$this->user->id);
		$options['limit']="{$PageNum},{$pagesize}";
		$options['whereAnd']=$whereand;
		$totalcount = $this -> model -> count($options);
		$pagerData=$pager->getPagerData($totalcount,$currentpage,'/search/index/'.$poststr.'/',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
		$view -> set('pagerData',$pagerData);
		$view -> set('datalist',$this -> model -> find($options));

		$view -> renderHtml($header.$view.$footer);
	}
	
}
?>