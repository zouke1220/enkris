<?php
namespace Admin\Controller;
use Think\Controller;
class AboutController extends BaseController {
    public function add(){
    	if(IS_POST){
    		$model = D('about');
    		if($model->create(I('post.'), 1)){
    			if($id = $model->add()){
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}

		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '添加关于我们',
			'_page_btn_name' => '关于我们列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
    public function edit(){
    	$id = I('get.id');
		$model = D('about');
    	if(IS_POST){    		
    		if($model->create(I('post.'), 2)){
    			if($model->save() !== FALSE){
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$data = $model->find($id);
    	$this->assign('data', $data);

		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '修改关于我们',
			'_page_btn_name' => '关于我们列表',
			'_page_btn_link' => U('lst'),
		));
		$this->display();
    }
    public function delete(){
    	$model = D('about');
    	if($model->delete(I('get.id', 0)) !== FALSE){
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}else{
    		$this->error($model->getError());
    	}
    }
    public function lst(){
    	$model = D('about');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));

		// 设置页面中的信息
		$this->assign(array(
			'_page_title' => '关于我们列表',
			'_page_btn_name' => '添加关于我们',
			'_page_btn_link' => U('add'),
		));
    	$this->display();
    }
}