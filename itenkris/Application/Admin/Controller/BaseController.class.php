<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function __construct(){
	    //�����ȵ��ø���Ĺ��캯��
		parent::__construct();
		//�жϵ�¼
		if(!session('id')){
		   $this->error('�����ȵ�¼��',U('Login/login'));
		}
    }	
}