<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
	protected $insertFields = array('username','password','chkcode');
	protected $updateFields = array('id','username','password');
	//添加和修改管理员时的表单验证规则
	protected $_validate = array(
		array('username', 'require', '用户名不能为空！', 1, 'regex', 3),
		array('username', '', '用户名已经存在！', 1, 'unique', 3),
		array('username', '1,30', '用户名的值最长不能超过 30 个字符！', 1, 'length', 3),
		array('password', 'require', '密码不能为空！', 1, 'regex', 3),
		array('password', '1,32', '密码的值最长不能超过 32 个字符！', 1, 'length', 3),
	);
	//登录表单定义的验证规则
    public $_login_validate = array(
		array('username', 'require', '用户名不能为空！', 1),		
		array('password', 'require', '密码不能为空！', 1),
		array('chkcode', 'require', '验证码不能为空！', 1),
		array('chkcode', 'check_verify', '验证码错误！', 1, 'callback'),
	);
	//检测输入的验证码是否正确,$code为输入的验证码
	function check_verify($code,$id=''){
	    $verify=new \Think\Verify();
		return $verify->check($code,$id);
	}
	public function login(){
	    //从模型中获取用户名和密码
		$username=$this->username;
		$password=$this->password;
		//先查询这个用户名是否存在
		$user=$this->where(array(
		    'username' => array('eq',$username),		
		))->find();
		if($user){
		    if($user['password']==md5($password)){
			    //登录成功存session
				session('id',$user['id']);
				session('username',$user['username']);
				return true;
			}else{
			    $this->error="密码不正确！";
				return false;
			}
		}else{
		    $this->error="用户名不存在！";
			return false;
		}
	}
	public function logout(){
	    session(null);
	}
	// 添加前
	protected function _before_insert(&$data, $option){
		$data['password']=md5($data['password']);
	}
	// 修改前
	protected function _before_update(&$data, $option){
		if($data['password']){
		    $data['password']=md5($data['password']);
		}else{
		    unset($data['password']); //从表单中删除这个字段,就不会修改这个字段
		}
	}
	// 删除前
	protected function _before_delete($option)
	{
		if(is_array($option['where']['id']))
		{
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
}