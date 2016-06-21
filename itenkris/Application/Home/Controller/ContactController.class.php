<?php
namespace Home\Controller;
use Think\Controller;
class ContactController extends Controller {
    public function contact(){
		$model=D('Contact');
		$data=$model->select();
		$amodel=D('About');
		$adata=$amodel->select();
		$imodel=D('Intro');
		$idata=$imodel->select();
		//var_dump($data);exit;
		$this->assign(array(
		    'data' => $data,
			'adata' => $adata,
			'idata' => $idata,
		));
		$this->display();
    }
}