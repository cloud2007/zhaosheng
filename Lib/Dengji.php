<?php
//报名登记
class Dengji extends Data {
	function  __construct() {
	$options = array (
		'key' => 'id',
		'table' => 'dengji',
		'columns' => array(
			'id' => 'id',
			'addid' => 'addid',
			'uname' => 'uname',
			'tel' => 'tel',
			'contact' => 'contact',
			'addr' => 'addr',
			'baoming' => 'baoming',
			'price' => 'price',
			'info' => 'info',
			'types' => 'types',
			'yejizhe' => 'yejizhe',
			'school' => 'school',
			'beizhu' => 'beizhu',
			'creattime' => 'creattime',
		),
		'saveNeeds' => array(),
		);
		parent::init($options);
	}
	
	public function dateConvert($timestamp) {
		return date('Y-m-d', $timestamp);
    }
	
	public function creattime() {
		return $this->dateConvert($this->creattime);
	}
	
	public function getaddname(){
		$addname = new User();
		if($this->addid){
			$rs = $addname -> load($this->addid);
			if($rs){
				return $rs->userid;
			}else{
				return '未填写';
			}
		}else{
			return '未知';
		}
	}
	
	public function getschool(){
		$school = new School();
		$rs = $school -> find(array('whereAnd'=>array(array('id','='.$this->school))));
		if($rs){
			return $rs[0]->schoolname;
		}else{
			return '未填写';
		}
	}

}
?>