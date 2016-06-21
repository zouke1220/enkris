<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends BaseController {	
	//产品添加	
    public function add(){
		//var_dump($_POST);
		$goodsmodel=D('Goods');
		if(IS_POST){
			if($goodsmodel->create(I('post.'),1)){			
			    if($goodsmodel->add()){
			        $this->success('添加产品成功',U('lst?p='.I('get.p')),3);
					exit;
			    }
			}else{
			    $this->error($goodsmodel->getError());
			}		    
		}
		$this->assign(array(
			'_page_title' =>'添加产品',
			'_page_btn_name' => '产品列表',
			'_page_btn_link' =>U('lst'),
		));
        $this->display();
    }
	//产品修改
	public function edit(){
		//var_dump($_POST);
    	$id = I('get.id');
		$goodsmodel = D('Goods');
    	if(IS_POST){
    		if($goodsmodel->create(I('post.'),2)){
				//save()的返回值是,如果失败返回false,如果成功返回受影响的条数(如果修改后和修改前相同就会返回0)
			    if(false!==$goodsmodel->save()){ 
					//显示成功信息,并等待3秒跳转到当前控制器下的lst方法
				    $this->success('操作成功!',U('lst'),3);
					exit;
				}
			}
			//从模型中取出失败原因
			$error=$goodsmodel->getError();
			//有控制器显示错误信息,并在3s后跳到上一页面
			$this->error($error);
		}
		//取出指定id的数据
		$gooddata=$goodsmodel->find($id);
		$picmodel=D('goods_pic');
        $picdata=$picmodel->field('id,pic,big_pic,mid_pic,sm_pic')->where(array('goods_id'=>array('eq',$id)))->select();
		
		$gmmodel=D('goods_ms');
        $gmdata=$gmmodel->field('id,cs,big_cs,mid_cs,sm_cs,goods_asc,goods_id')->where(array('goods_id'=>array('eq',$id)))->select();
		//var_dump($gmdata);
		//var_dump($gmdata);
		//设置页面信息
		$this->assign(array(
			'gooddata' => $gooddata,
			'picdata' => $picdata,
			'gmdata' => $gmdata,
            '_page_title' =>'修改产品',
			'_page_btn_name' => '产品列表',
			'_page_btn_link' =>U('lst'),
		));
        $this->display();
    }
	//处理Ajax删除图片的请求
	public function ajaxDelPic(){
	    $pid=I('get.pid');
        $gpmodel=D('goods_pic');
		//先查出原来图片的路径
		$pic = $gpmodel->field('pic,big_pic,mid_pic,sm_pic')->find($pid);
        //从硬盘删除
		unlink('./Public/Uploads/'.$pic['pic']);
		unlink('./Public/Uploads/'.$pic['big_pic']);
		unlink('./Public/Uploads/'.$pic['mid_pic']);
		unlink('./Public/Uploads/'.$pic['sm_pic']);
		//从数据库删除记录
		$gpmodel->delete($pid);		
	}
	//处理Ajax删除参数的请求
	public function ajaxDelCs(){
	    $cid=I('get.cid');
        $gmmodel=D('goods_ms');
		//先查出原来图片的路径
		$cs = $gmmodel->field('cs,big_cs,mid_cs,sm_cs')->find($cid);
        //从硬盘删除
		unlink('./Public/Uploads/'.$cs['cs']);
		unlink('./Public/Uploads/'.$cs['big_cs']);
		unlink('./Public/Uploads/'.$cs['mid_cs']);
		unlink('./Public/Uploads/'.$cs['sm_cs']);
		//从数据库删除记录
		$gmmodel->delete($cid);		
	}
	//产品列表
	public function lst(){
		$goodsmodel=D('Goods');
		//返回数据
		$gooddata=$goodsmodel->search();
		//var_dump($gooddata);
		$this->assign(array(
    		'gooddata' => $gooddata['data'],
    		'page' => $gooddata['page'],
    	));
		//设置页面信息
		$this->assign(array(
            '_page_title' =>'产品列表',
			'_page_btn_name' => '添加产品',
			'_page_btn_link' =>U('add'),
		));
        $this->display();
    }
	//产品删除
	public function delete(){
		$id=I('get.id');
	    $goodsmodel=D('Goods');
		if($goodsmodel->delete($id)!==FALSE){
		    $this->success('产品删除成功',U('lst'),3);
		}else{
			$this->error('产品删除失败！'.$goodsmodel->getError());
		}
	}
}