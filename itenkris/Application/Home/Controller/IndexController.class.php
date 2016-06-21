<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		$gmodel=D('Goods');
		$model=D('Intro');
		$gdata=$gmodel->select();
		$data=$model->select();
		//var_dump($data);
		$this->assign(array(
		    'gdata' => $gdata,
			'data' => $data,
		));
        $this->display();
    }
}