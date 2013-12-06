<?php
//主页
class Xuexiao extends Controller{
	public $modelzone,$modelschool;
	function __construct(){
		$this -> check_login();
		$this -> modelzone = new Zone();
		$this -> modelschool = new School();
	}
	
	function index(){
		$this -> lists();
	}
	
	function lists($id=NULL) {

		if(isset($_POST['id']) || isset($_POST['schoolname'])){
			$id = $_POST['id'];
			$zoneid = $_POST['zoneid'];
			$schoolname = $_POST['schoolname'];
			if($this->check_zonename($schoolname)==0){
				ShowMsg('学校已存在','/xuexiao/lists');
				die;
			}
			$this -> modelschool -> id=$id;
			$this -> modelschool -> zoneid=$zoneid;
			$this -> modelschool -> schoolname=$schoolname;
			$this -> modelschool -> creattime=time();
			$this -> modelschool -> save();
			ShowMsg('添加校区成功','/xuexiao/lists');
			die;
		}

		$header = new View('header');
		$footer = new View('footer');
		
		$view = new View('schoollist');
		$view -> set('zonelist',$this -> modelzone -> getlists());		
		
		$pager = new Pager();
		$pagesize = 10;
		if(isset($id[4])&&is_numeric($id[4])){
			$currentpage=$id[4];
		}else{
			$currentpage=1;
		}
		$PageNum=($currentpage-1)*$pagesize;
		$options = array();
		$whereand = array();
		$options['limit']="{$PageNum},{$pagesize}";
		$totalcount = $this -> modelschool -> count($options);
		$pagerData=$pager->getPagerData($totalcount,$currentpage,'/xuexiao/lists/0/',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
		$view -> set('pagerData',$pagerData);
		$view -> set('datalist',$this -> modelschool -> find($options));
		
		if(isset($id[3]))$view -> set('datainfo',$this -> modelschool -> load($id[3]));
		
		$view -> renderHtml($header.$view.$footer);
	}
	
	function del($id){
		$this -> model -> delete($id[3]);
		ShowMsg('校区删除成功','/xiaoqu/lists');
		die;
	}
	
	function check_zonename($check_zonename){
		$rs = $this -> modelschool -> find(
			array(
				'whereAnd' => array(array('schoolname',"='".$check_zonename."'")),
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