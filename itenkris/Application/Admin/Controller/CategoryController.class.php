<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends BaseController {
	//分类添加
    public function add(){
		$catmodel=D('Category');
		if(IS_POST){			
			if($catmodel->create(I('POST.'),1)){
			    if($catmodel->add()){
			        $this->success('添加分类成功',U('lst?p='.I('get.p')),3);
					exit;
			    }
			}else{
			    $this->error($catmodel->getError());
			}		    
		}
		$catdata=$catmodel->getTree();
		$this->assign(array(
		    'catdata' => $catdata,	
			'_page_title' =>'添加分类',
			'_page_btn_name' => '分类列表',
			'_page_btn_link' =>U('lst'),
		));
        $this->display();
    }
	//分类修改
	public function edit(){
    	$id = I('get.id');
		$catmodel = D('Category');
    	if(IS_POST){
    		if($catmodel->create(I('post.'), 2)){
    			if($catmodel->save() !== FALSE){
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($catmodel->getError());
    	}
		//取出指定id的数据
		$cdata=$catmodel->find($id);
		//取出所有的分类做下拉框
		$catdata=$catmodel->getTree();
		//取出当前分类的子分类
        $children=$catmodel->getChildren($id);

		//设置页面信息
		$this->assign(array(
			'cdata' => $cdata,
			'children' => $children,
			'catdata' => $catdata,
            '_page_title' =>'修改列表',
			'_page_btn_name' => '分类列表',
			'_page_btn_link' =>U('lst'),
		));
        $this->display();
    }
	//分类列表
	public function lst(){
		$catmodel=D('Category');
		//返回数据
		$catdata=$catmodel->getTree();
		//设置页面信息
		$this->assign(array(
			'catdata' => $catdata,
            '_page_title' =>'分类列表',
			'_page_btn_name' => '添加分类',
			'_page_btn_link' =>U('add'),
		));
        $this->display();
    }
	//分类删除
	public function delete(){
		$id=I('get.id');
	    $catmodel=D('category');
		if($catmodel->delete($id)!==FALSE){
		    $this->success('分类删除成功',U('lst'),3);
		}else{
			$this->error('删除失败！'.$catmodel->getError());
		}
	}
}