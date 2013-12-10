<?php
//主页
class Home extends Controller{
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
		
		//搜索部分
		$arr = explode('-',$id[3]);
		$wd=$_POST['wd']?$_POST['wd']:substr($arr[0],1);
		$status=$_POST['status']?$_POST['status']:substr($arr[1],1);
		$conf=array('wd'=>$wd,'status'=>$status);
		
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('index');
		
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
		$whereand[] = array('addid','='.$this->user->id);
		if($wd)$whereand[] = array('uname',"like '%{$wd}%'");
		if($status)$whereand[] = array('status',"={$status}");
		$options['limit']="{$PageNum},{$pagesize}";
		$options['whereAnd']=$whereand;
		$totalcount = $this -> model -> count($options);
		$pagerData=$pager->getPagerData($totalcount,$currentpage,"/home/index/w{$wd}-s{$status}/",4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
		$view -> set('pagerData',$pagerData);
		$view -> set('datalist',$this -> model -> find($options));
		
		$header -> set('conf',$conf);

		$view -> renderHtml($header.$view.$footer);
	}
	
	function zhuanyi($id=NULL){
		//处理转移
		if($_POST['id']){
			$this -> model -> load($_POST['id']);
			$this -> model -> addid = $_POST['userid'];
			$this -> model -> oldid = $this -> user -> id;
			$this -> model -> reason = $_POST['reason'];
			$this -> model -> edittime = time();			
			$this -> model -> save();
			ShowMsg('处理完毕','/');
			die;
		}
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('zhuanyi');
		$view -> set ('datainfo',$this -> model -> load($id[3]));
		$view -> set ('datauser',$this -> modeluser -> find() );
		$view -> renderHtml($header.$view.$footer);
	}
	
	function oldorder($id=NULL) {
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('index');
		
		$pager = new Pager();
		$pagesize = 10;
		if(isset($id[3])&&is_numeric($id[3])){
			$currentpage=$id[3];
		}else{
			$currentpage=1;
		}
		$PageNum=($currentpage-1)*$pagesize;
		$options = array();
		$whereand = array();
		$whereand[] = array('oldid','='.$this->user->id);
		$options['limit']="{$PageNum},{$pagesize}";
		$options['whereAnd']=$whereand;
		$totalcount = $this -> model -> count($options);
		$pagerData=$pager->getPagerData($totalcount,$currentpage,'/home/oldorder/',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
		$view -> set('pagerData',$pagerData);
		$view -> set('datalist',$this -> model -> find($options));

		$view -> renderHtml($header.$view.$footer);
	}	

	function neworder($id=NULL) {
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('index');
		
		$pager = new Pager();
		$pagesize = 10;
		if(isset($id[3])&&is_numeric($id[3])){
			$currentpage=$id[3];
		}else{
			$currentpage=1;
		}
		$PageNum=($currentpage-1)*$pagesize;
		$options = array();
		$whereand = array();
		$whereand[] = array('addid','='.$this->user->id);
		$whereand[] = array('oldid','<>'.$this->user->id);
		$options['limit']="{$PageNum},{$pagesize}";
		$options['whereAnd']=$whereand;
		$totalcount = $this -> model -> count($options);
		$pagerData=$pager->getPagerData($totalcount,$currentpage,'/home/neworder/',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
		$view -> set('pagerData',$pagerData);
		$view -> set('datalist',$this -> model -> find($options));

		$view -> renderHtml($header.$view.$footer);
	}
	
	function ajax_beizhu($id){
		$view = new View('ajax_beizhu');
		$view -> set('datainfo',$this -> model -> load($id[3]));
		$view -> renderHtml($header.$view.$footer);
	}
	
	function ajax_tixing($id){
		$view = new View('ajax_tixing');
		$view -> set('datainfo',$this -> model -> load($id[3]));
		$view -> renderHtml($header.$view.$footer);
	}
	
	//录入名单
	function add() {
		if( isset($_POST['uname']) ){
			$this -> model -> id=$_POST['id'];
			$this -> model -> uname=$_POST['uname'];
			$this -> model -> addid=$this->user->id;
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