<?php
namespace Admin\Controller;
use Think\Controller;
class NewsController extends BaseController {	
	//新闻添加
    public function add(){
		$newsmodel=D('News');
		if(IS_POST){
			if($newsmodel->create(I('post.'),1)){			
			    if($newsmodel->add()){
			        $this->success('添加新闻成功',U('lst?p='.I('get.p')),3);
					exit;
			    }
			}else{
			    $this->error($newsmodel->getError());
			}		    
		}
		$this->assign(array(
			'_page_title' =>'添加新闻',
			'_page_btn_name' => '新闻列表',
			'_page_btn_link' =>U('lst'),
		));
        $this->display();
    }
	
	//新闻修改
	public function edit(){
    	$id = I('get.id');
		$newsmodel = D('News');
    	if(IS_POST){
    		if($newsmodel->create(I('post.'), 2)){
    			if($newsmodel->save() !== FALSE){
    				$this->success('新闻修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($newsmodel->getError());
    	}
		//取出指定id的数据
		$newdata=$newsmodel->find($id);
		//设置页面信息
		$this->assign(array(
			'newdata' => $newdata,
            '_page_title' =>'修改新闻',
			'_page_btn_name' => '新闻列表',
			'_page_btn_link' =>U('lst'),
		));
        $this->display();
    }
	
	//新闻列表
	public function lst(){
		$newsmodel=D('News');
		//返回数据
		$newsdata=$newsmodel->search();
        //var_dump($newsdata);
		//var_dump($newsdata['data']);
		//var_dump($newsdata['page']);
		$this->assign(array(
    		'newdata' => $newsdata['data'],
    		'page' => $newsdata['page'],
    	));
		//设置页面信息
		$this->assign(array(
            '_page_title' =>'新闻列表',
			'_page_btn_name' => '添加新闻',
			'_page_btn_link' =>U('add'),
		));
        $this->display();
    }
	//新闻删除
	public function delete(){
		$id=I('get.id');
	    $newsmodel=D('News');
		if($newsmodel->delete($id)!==FALSE){
		    $this->success('新闻删除成功',U('lst'),3);
		}else{
			$this->error('新闻删除失败！'.$newsmodel->getError());
		}
	}
}