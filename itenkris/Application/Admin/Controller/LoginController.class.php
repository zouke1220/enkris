<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
    public function login(){
	    if(IS_POST){
		    $model=D('Admin');
			if($model->validate($model->_login_validate)->create()){
				if($model->login()){
			        $this->success('��¼�ɹ���',U('Index/index'));
				    exit;
				}
			}
			$this->error($model->getError());
		}
		$this->display();
	}
	public function logout(){
	    $model=D('Admin');
		$model->logout();
		redirect('login');
	}
	public function chkcode(){
	    $Verify=new \Think\Verify(array(
		    'fontSize' =>30,  //��֤���С
		    'length' =>4 ,    //��֤��λ��
			'useNoise' => TRUE , //�ر���֤���ӵ�
		));
		$Verify->entry();
	}
}
?>