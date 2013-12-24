<?php
//主页
class Login extends Controller{
	var $keepUserIDTag = 'userid';
	var $keepUserPwdTag = 'userpwd';
	
	function __construct(){
		if(isset($_SESSION[$this->keepUserIDTag]))
        {
            $this->userID = $_SESSION[$this->keepUserIDTag];
            $this->userPwd = $_SESSION[$this->keepUserPwdTag];
        }
	}
	
	function index() {
		$this->login();
	}
	
	function login() {
		if($this -> getUser()) header("Location:/");
		$view = new View('login');
		$view -> renderHtml($view);
	}
	
	function loginout() {
		$this->exitUser();
		ShowMsg('退出成功','/');
	}
	
	function loginaction() {
		if(!$_POST['userid'] || !$_POST['userpwd'] || !$_POST['vcode']){
			ShowMsg('填写不完整','/login/login');
			die;
		}
		if( $_POST['vcode']!=$_SESSION['VCODE'] ){
			ShowMsg('验证码错误','/login/login');
			die;
		}
		
		$user = new User();
		$rs = $user -> find(
			array(
				'whereAnd' => array(array('userid',"='".$_POST['userid']."'")),
			)
		);
		if( !$rs[0]->userid ){
			ShowMsg('用户不存在','/login/login');
			die;
		}
		if( $rs[0]->userpwd!=md5($_POST['userpwd']) ){
			ShowMsg('密码错误','/login/login');
			die;
		}
		$this->userID = $rs[0]->id;
		$this->userId = $rs[0]->userid;
		$this->userPwd = $rs[0]->userpwd;
		$this->userGrant = $rs[0]->id;
		$this->userLogintime = $rs[0]->logintime;
		$this -> keepUser();
		ShowMsg('登录成功','/');
		die;
		
	}
	
	function reg(){
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('reg');
		$obj = new Groups();
		$group = $obj->find();
		$view -> set('group',$group);
		$view -> renderHtml($header.$view.$footer);
	}
	
	function pwd(){
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('edit');
		$view -> set('datainfo',$this -> getUser());
		$view -> renderHtml($header.$view.$footer);
	}
	
	function modify($id){
		$header = new View('header');
		$footer = new View('footer');
		$view = new View('modify');
		$obj = new Groups();
		$group = $obj->find();
		$view -> set('group',$group);
		$user = new User();
		$view -> set('datainfo',$user -> load($id[3]));
		$view -> renderHtml($header.$view.$footer);
	}
	
	//注册页面
	function regaction() {
		if($_POST['id']){
			$user = new User();
			$user -> load($_POST['id']);
			if($_POST['userpwd1'])$user -> userpwd = md5($_POST['userpwd1']);
			$user -> tel = $_POST['tel'];
			$user -> email = $_POST['email'];
			$user -> qq = $_POST['qq'];
			$user -> userid = $_POST['userid'];
			$user -> group = $_POST['group'];
			$user -> grant = 2;
			$user -> save();
			ShowMsg('编辑成功！','/users');
			die;
		}
		if(!$_POST['userid'] || !$_POST['userpwd1'] || !$_POST['userpwd2'] || !$_POST['tel']){
			ShowMsg('填写不完整','/login/reg');
			die;
		}
		
		if( $_POST['userpwd1'] != $_POST['userpwd2'] ){
			ShowMsg('两次输入密码不一致','/login/reg');
			die;
		}
		
		$check = json_decode($this->ajax_check_userid($_POST['userid']));
		if ($check->status=='n'){
			ShowMsg('用户名已存在','/login/reg');
			die;
		}
		
		$user = new User();
		$user -> id = $_POST['id'];
		$user -> userid = $_POST['userid'];
		$user -> userpwd = md5($_POST['userpwd1']);
		$user -> tel = $_POST['tel'];
		$user -> email = $_POST['email'];
		$user -> qq = $_POST['qq'];
		$user -> userid = $_POST['userid'];
		$user -> group = $_POST['group'];
		$user -> grant = 2;
		$user -> creattime = time();
		$user -> logintime = time();
		$user -> save();
		ShowMsg('注册成功，请登录','/');
		die;
	}
	
	//注册页面
	function editaction() {
		
		if( $_POST['userpwd1'] != $_POST['userpwd2'] ){
			ShowMsg('两次输入密码不一致','/login/pwd');
			die;
		}
		
		$user = new User();
		$user -> load($_POST['id']);
		if($_POST['userpwd1']){$user -> userpwd = md5($_POST['userpwd1']);}
		$user -> tel = $_POST['tel'];
		$user -> email = $_POST['email'];
		$user -> qq = $_POST['qq'];
		$user -> save();
		$this -> exitUser();
		ShowMsg('编辑成功，请重新登录','/');
		die;
	}
	
	/**
     *  保持用户登录session
     *
     * @access    public
     * @return    int    成功返回 1 ，失败返回 -1
     */
    function keepUser()
    {
        if($this->userID != '')
        {
			
            @session_register($this->keepUserIDTag);
            $_SESSION[$this->keepUserIDTag] = $this->userID;
			
			@session_register($this->keepUserPwdTag);
            $_SESSION[$this->keepUserPwdTag] = $this->userPwd;
			
            return 1;
        }
        else
        {
            return -1;
        }
    }
	
	/**
     *  结束用户的会话状态
     *
     * @access    public
     * @return    void
     */
    function exitUser()
    {
        @session_unregister($this->keepUserIDTag);
        @session_unregister($this->keepUserPwdTag);
        $_SESSION = array();
    }
	
	//获取用户信息
	function getUser(){
		if(!isset($_SESSION[$this->keepUserIDTag])){
			return NULL;
		}else{
			$user = new User();
			try {   
				$user -> load($_SESSION[$this->keepUserIDTag]);
			} catch (Exception $e) {
				$this->exitUser();
				ShowMsg('发生错误','/');
				die;
			}
					
			if($user->userpwd ==$_SESSION[$this->keepUserPwdTag] ){
				return $user;
			}else{
				$this->exitUser();
				return NULL;
			}
		}
	}	
	
	//验证用户名是否存在
	function ajax_check_userid($o){
		$check_userid = $_POST['param'] ? $_POST['param']:$o;
		$user = new User();
		$rs = $user -> find(
			array(
				'whereAnd' => array(array('userid',"='".$check_userid."'")),
			)
		);
		$res = array();
		if($rs){
			$userid = $rs[0] -> userid;
			if (!$userid){
				$res['info']='验证通过';
				$res['status']='y';
			}else{
				$res['info']='用户名已存在';
				$res['status']='n';
			}
			if($_POST['param']){
				echo json_encode($res);
			}else{
				return json_encode($res);
			}
		}else{
			$res['info']='验证通过';
			$res['status']='y';
			if($_POST['param']){
				echo json_encode($res);
			}else{
				return json_encode($res);
			}
		}
		
	}	
	
	//验证码生产
	function vCode(){
		$im = imagecreate(44,18);
		$back = ImageColorAllocate($im, 245,245,245);
		imagefill($im,0,0,$back); //背景
		srand((double)microtime()*1000000);
		$vcodes='';
		for($i=0;$i<4;$i++){
			$font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
			$authnum=rand(1,9);
			$vcodes.=$authnum;
			imagestring($im, 5, 2+$i*10, 1, $authnum, $font);
		}
		for($i=0;$i<100;$i++)
		{ 
			$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
			imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
		} 
		ImagePNG($im);
		ImageDestroy($im);
		$_SESSION['VCODE'] = $vcodes;
	}
	
}
?>