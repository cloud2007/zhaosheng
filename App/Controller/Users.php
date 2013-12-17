<?php
//主页
class Users extends Controller{
	public $model;
	function __construct(){
		$this -> check_login();
		$this -> modelgroup = new Groups();
		$this -> modeluser = new User();
	}
	
	function index($id=NULL) {
		//移动分组处理
		if($_POST['id']&&$_POST['groupid']<>NULL){
			$this -> modeluser -> load($_POST['id']);
			$this -> modeluser -> group = $_POST['groupid'];
			$this -> modeluser -> is_zz = 0;
			$this -> modeluser -> save();
			ShowMsg('处理完毕','/users');
			die;
		}
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('userlist');
		
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
		//$whereand[] = array('addid','='.$this->user->id);
		$options['limit']="{$PageNum},{$pagesize}";
		$options['order']=array('group'=>'asc');
		$options['whereAnd']=$whereand;
		$totalcount = $this -> modeluser -> count($options);
		$pagerData=$pager->getPagerData($totalcount,$currentpage,'/users/index/',4,$pagesize);//参数记录数 当前页数 链接地址 显示样式 每页数量
		$view -> set('pagerData',$pagerData);
		$view -> set('datalist',$this -> modeluser -> find($options));

		$view -> renderHtml($header.$view.$footer);
	}
	
	function grouplists($id=NULL) {
		if(isset($_POST['id']) || isset($_POST['groupname'])){
			$id = $_POST['id'];
			$groupname = $_POST['groupname'];
			if($this->check_groupname($groupname)==0){
				ShowMsg('分组已存在','/users/grouplists');
				die;
			}
			$this -> modelgroup -> id=$id;
			$this -> modelgroup -> groupname=$groupname;
			$this -> modelgroup -> creattime=time();
			$this -> modelgroup -> save();
			ShowMsg('添加分组成功','/users/grouplists');
			die;
		}
		
		$header = new View('header');
		$footer = new View('footer');
		
		$view = new View('grouplist');
		$view -> set('datalist',$this -> modelgroup -> find());
		if(isset($id[3]))$view -> set('datainfo',$this -> modelgroup -> load($id[3]));
		
		$view -> renderHtml($header.$view.$footer);
	}
	
	function check_groupname($check_groupname){
		$rs = $this -> modelgroup -> find(
			array(
				'whereAnd' => array(array('groupname',"='".$check_groupname."'")),
			)
		);
		if($rs){
			return 0;
		}else{
			return 1;
		}
		
	}
	
	//移动分组
	function ajax_group($id){
		$view = new View('ajax_group');
		$view -> set('datainfo',$this -> modeluser -> load($id[3]));
		$view -> set('datalist',$this -> modelgroup -> find());
		$view -> renderHtml($header.$view.$footer);
	}
	
	//设置组长
	function ajax_zuzhang($id){
		$this -> modeluser -> load($id[3]);
		$this -> modeluser -> signs('`group`='.$this -> modeluser->group);
		$this -> modeluser -> is_zz = 1;
		$this -> modeluser -> save();
		ShowMsg('处理完毕','/users');
		die;
	}
	//取消组长
	function ajax_zuzhang_c($id){
		$this -> modeluser -> load($id[3]);
		$this -> modeluser -> is_zz = 0;
		$this -> modeluser -> save();
		ShowMsg('处理完毕','/users');
		die;
	}
	
	//设置组长
	function ajax_admin($id){
		$this -> modeluser -> load($id[3]);
		$this -> modeluser -> grant = 1;
		$this -> modeluser -> save();
		ShowMsg('处理完毕','/users');
		die;
	}
	//取消组长
	function ajax_admin_c($id){
		$this -> modeluser -> load($id[3]);
		$this -> modeluser -> grant = 0;
		$this -> modeluser -> save();
		ShowMsg('处理完毕','/users');
		die;
	}
	
	//重设密码
	function ajax_setpwd($id){
		$this -> modeluser -> load($id[3]);
		$this -> modeluser -> userpwd = md5('888888');
		$this -> modeluser -> save();
		ShowMsg('处理完毕','/users');
		die;
	}
	
}
?>