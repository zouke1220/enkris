<?php
namespace Home\Controller;
use Think\Controller;
class EmployController extends Controller {
    public function careers(){
		$emodel=D('Employ');
		//�������ݺͷ�ҳ
		$data=$emodel->search();
		//var_dump($data['page']);exit;
		$this->assign(array(
		    'pdata' => $data['pdata'],
		    'page' => $data['page'],
		));        
        $this->display();
    }
}