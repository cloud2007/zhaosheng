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
		$options['limit']="{$PageNum},{$pagesize}";
		$totalcount = $this -> model -> count($options);
		$pagerData=$pager->getPagerData($totalcount,$currentpage,'/home/index/',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
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