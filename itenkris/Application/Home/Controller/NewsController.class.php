<?php
namespace Home\Controller;
use Think\Controller;
class NewsController extends Controller {
    public function news(){
		$model=D('News');
		$data=$model->search();
		$this->assign(array(
		    'pdata' => $data['pdata'],	
			'page' => $data['page'],
		));
        $this->display();
    }
	public function newsview(){
		$id=I('get.id');		
		//var_dump($id);
		$p=floor($id/4)+1;
		//var_dump($p);
		$model=D('News');
		$data=$model->find($id);
		//var_dump($data);
		$this->assign(array(
		    'data' => $data,
			'p' => $p,
		));
        $this->display();
    }
}