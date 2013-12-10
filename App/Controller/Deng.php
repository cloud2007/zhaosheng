<?php
//主页
class Deng extends Controller{
	public $model;
	function __construct(){
		$this -> check_login();
		$this -> model = new Dengji();
		$this -> modelzone = new Zone();
	}
	
	function index($id=NULL) {
		$arr = explode('-',$id[3]);
		$wd=$_POST['wd']?$_POST['wd']:substr($arr[0],1);
		$school=$_POST['school']?$_POST['school']:substr($arr[1],1);
		$conf=array('wd'=>$wd,'school'=>$school);
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('dengji_list');
		
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
		if($wd)$whereand[] = array('uname',"like '%{$wd}%'");
		if($school)$whereand[] = array('school',"={$school}");
		$options['limit']="{$PageNum},{$pagesize}";
		$options['whereAnd']=$whereand;
		$totalcount = $this -> model -> count($options);
		$pagerData=$pager->getPagerData($totalcount,$currentpage,"/deng/index/w{$wd}-s{$school}/",4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
		$view -> set('pagerData',$pagerData);
		$view -> set('datalist',$this -> model -> find($options));
		
		$view -> set('zonelist',$this -> modelzone -> find());
		
		$view -> set('conf',$conf);

		$view -> renderHtml($header.$view.$footer);
	}
	
	//录入名单
	function add($id=NULL) {
		if( isset($_POST['uname']) ){
			$this -> model -> id=$_POST['id'];
			$this -> model -> uname=$_POST['uname'];
			$this -> model -> addid=$this->user->id;
			$this -> model -> tel=$_POST['tel'];
			$this -> model -> contact=$_POST['contact'];
			$this -> model -> addr=$_POST['addr'];
			$this -> model -> baoming=$_POST['baoming'];
			$this -> model -> price=$_POST['price'];
			$this -> model -> info=$_POST['info'];
			$this -> model -> types=$_POST['types'];
			$this -> model -> yejizhe=$_POST['yejizhe'];
			$this -> model -> school=$_POST['school'];
			$this -> model -> beizhu=$_POST['beizhu'];
			$this -> model -> creattime=time();
			$this -> model -> save();
			ShowMsg('登记成功','/deng');
			die;
		}
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('dengji_add');
		if($id[3]){
		$view -> set('datainfo',$this -> model -> load($id[3]));
		}
		$view -> set('zonelist',$this -> modelzone -> find());
		
		$view -> renderHtml($header.$view.$footer);
	}
	
	//录入名单
	function del($id=NULL) {
		if($id[3]){
			$this -> model -> delete($id[3]);
			ShowMsg('删除成功','/deng');
			die;
		}
		ShowMsg('参数错误','/deng');
		die;
		
	}
	
}
?>