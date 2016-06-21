<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model {
    //定义验证规则
	protected $_validate=array(
		array('goods_name','require','产品名称不能为空',1),
		//array('goods_desc','require','产品描述不能为空',1),
	);
	protected $insertFields = array('goods_name','goods_msc','goods_asc','goods_td','goods_desc','addtime');
	protected $updateFields = array('id','goods_name','goods_msc','goods_asc','goods_td','goods_desc','addtime');
    
	public function search($pageSize = 5){
		$where = array();
		if($goods_name = I('get.goods_name'))
			$where['goods_name'] = array('like', "%$goods_name%");
		if($goods_desc = I('get.goods_desc'))
			$where['goods_desc'] = array('like', "%$goods_desc%");
		$fa = I('get.fa');
		$ta = I('get.ta');
		if($fa && $ta)
			$where['addtime'] = array('between', array($fa,$ta));
		elseif($fa)
			$where['addtime'] = array('egt',$fa);
		elseif($ta)
			$where['addtime'] = array('elt',$ta);
		//排序
		$orderby='id'; //默认排序字段
		$orderway='desc'; //默认排序方式
		$odby=I('get.odby');
		if($odby){
		    if($odby=='id_asc'){
				$orderway='asc';
			}
		}
		//分页
		$count = $this->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		//设置分页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$goodsdata['page'] = $page->show();
		//取数据
		$goodsdata['data'] = $this->order("$orderby $orderway")->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		//返回数据
		return $goodsdata;
	}
	  protected function _before_insert(&$data, $option){
		/**************** 处理LOGO *******************/
		//判断有没有选择图片
		//var_dump($_FILES);
		if($_FILES['logo']['error'] == 0){
			$upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize = 1024 * 1024 ; // 1M
		    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		    $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
		    $upload->savePath = 'Goods/logo/'; // 设置附件上传（子）目录
		    // 上传文件 
		    $info = $upload->upload();
		    if(!$info){
		    	// 获取失败原因把错误信息保存到 模型的error属性中，然后在控制器里会调用$model->getError()获取到错误信息并由控制器打印
		    	$this->error = $upload->getError();
		        return FALSE;
		    }else{
		    	/**************** 生成缩略图 *****************/
				//var_dump($info);
		    	// 先拼成原图上传的路径
		    	$logo = $info['logo']['savepath'] . $info['logo']['savename'];
				//拼出缩略图的路径和名称
				$biglogo = $info['logo']['savepath'] .'big_'. $info['logo']['savename'];
				$midlogo = $info['logo']['savepath'] .'mid_'. $info['logo']['savename'];
				$smlogo = $info['logo']['savepath'] .'sm_'. $info['logo']['savename'];
				//生成缩略图文件
				$image=new \Think\Image();
				//打开要生成缩略图的文件
                $image->open('./Public/Uploads/'.$logo);
				//生成缩略图的文件
				$image->thumb(150,150)->save('./Public/Uploads/'.$biglogo);
				$image->thumb(180,100)->save('./Public/Uploads/'.$midlogo);
				$image->thumb(50,50)->save('./Public/Uploads/'.$smlogo);
		    	/**************** 把路径放到表单中 *****************/
		    	$data['logo'] = $logo;
				$data['big_logo'] = $biglogo;
				$data['mid_logo'] = $midlogo;
				$data['sm_logo'] = $smlogo;
			}
		}
		/******************************/
		// 获取当前时间并添加到表单中这样就会插入到数据库中
		$data['addtime']=date('Y-m-d H:i:s',time());
		//我们自己来过滤这个字段
		$data['goods_desc']=removeXSS($_POST['goods_desc']);
	}
    protected function _after_insert($data, $option){
		/*******处理产品相册图片**********/
		//var_dump($_FILES);
		if(isset($_FILES['pic'])){
		    foreach($_FILES['pic']['name'] as $k=>$v){
			    $pics[]=array(
				    'name'=>$v,
					'type'=>$_FILES['pic']['type'][$k],
					'tmp_name'=>$_FILES['pic']['tmp_name'][$k],
					'error'=>$_FILES['pic']['error'][$k],
					'size'=> $_FILES['pic']['size'][$k],			
				);
			}
		}
		//$_FILES=$pics; //把处理好的数组赋给$_FILES,因为uploadOne函数是到$_FILES中找图片
		//var_dump($_FILES);
		$gpmodel=D('goods_pic');
		//循环每个上传
		foreach($pics as $k=>$v){			
		    if($v['error']==0){
				if(isset($pics[$k]) && $pics[$k]['error'] == 0){
					$upload = new \Think\Upload();// 实例化上传类
		            $upload->maxSize = 1024 * 1024 ; // 1M
		            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		            $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
		            $upload->savePath = 'Goods/pic/'; // 设置附件上传（子）目录
		            // 上传文件 
				    $info=$upload->upload(array($k=>$pics[$k]));
				    //var_dump($info); 
		            if(!$info){
		    	        $this->error = $upload->getError();
		                return FALSE;
		            }else{
		        	    // 先拼成原图上传的路径
		    	        $pic = $info[$k]['savepath'] . $info[$k]['savename'];	
				        //拼出缩略图的路径和名称
				        $bigpic = $info[$k]['savepath'] .'big_'. $info[$k]['savename'];
				        $midpic = $info[$k]['savepath'] .'mid_'. $info[$k]['savename'];
				        $smpic = $info[$k]['savepath'] .'sm_'. $info[$k]['savename'];
				        //生成缩略图文件
				        $image=new \Think\Image();
						//打开要生成缩略图的文件
                        $image->open('./Public/Uploads/'.$pic);
				        //生成缩略图的文件
				        $image->thumb(150,150)->save('./Public/Uploads/'.$bigpic);
				        $image->thumb(180,100)->save('./Public/Uploads/'.$midpic);
				        $image->thumb(50,50)->save('./Public/Uploads/'.$smpic);
		    	        /**************** 把路径放到表单中 *****************/
		    	        $data['pic'] = $pic;
				        $data['big_pic'] = $bigpic;
				        $data['mid_pic'] = $midpic;
				        $data['sm_pic'] = $smpic;
					}
		        }
				$gpmodel->add(array(
					'pic'=>$pic,
					'big_pic'=>$bigpic,
                    'mid_pic'=>$midpic,
                    'sm_pic' =>$smpic,
					'goods_id'=>$data['id'],		
				));
            }
		}
		/*******处理产品参数图片数据信息**********/
		//var_dump($_FILES);
		//var_dump($_POST['goods_asc']);
		if(isset($_FILES['cs'])){
		    foreach($_FILES['cs']['name'] as $k=>$v){
			    $css[]=array(
				    'name'=>$v,
					'type'=>$_FILES['cs']['type'][$k],
					'tmp_name'=>$_FILES['cs']['tmp_name'][$k],
					'error'=>$_FILES['cs']['error'][$k],
					'size'=> $_FILES['cs']['size'][$k],			
				);
			}
		}
		//$_FILES=$css; //把处理好的数组赋给$_FILES,因为uploadOne函数是到$_FILES中找图片
		//var_dump($_FILES);
		$gmmodel=D('goods_ms');
		//循环每个上传
		foreach($css as $k=>$v){			
		    if($v['error']==0){
				if(isset($css[$k]) && $css[$k]['error'] == 0){
					$upload = new \Think\Upload();// 实例化上传类
		            $upload->maxSize = 1024 * 1024 ; // 1M
		            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		            $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
		            $upload->savePath = 'Goods/cs/'; // 设置附件上传（子）目录
		            // 上传文件 
				    $info1=$upload->upload(array($k=>$css[$k]));
				    //var_dump($info1); 
		            if(!$info1){
		    	        $this->error = $upload->getError();
		                return FALSE;
		            }else{
		        	    // 先拼成原图上传的路径
		    	        $cs = $info1[$k]['savepath'] . $info1[$k]['savename'];	
				        //拼出缩略图的路径和名称
				        $bigcs = $info1[$k]['savepath'] .'big_'. $info1[$k]['savename'];
				        $midcs = $info1[$k]['savepath'] .'mid_'. $info1[$k]['savename'];
				        $smcs = $info1[$k]['savepath'] .'sm_'. $info1[$k]['savename'];
				        //生成缩略图文件
				        $image=new \Think\Image();
						//打开要生成缩略图的文件
                        $image->open('./Public/Uploads/'.$cs);
				        //生成缩略图的文件
				        $image->thumb(150,150)->save('./Public/Uploads/'.$bigcs);
				        $image->thumb(180,100)->save('./Public/Uploads/'.$midcs);
				        $image->thumb(50,50)->save('./Public/Uploads/'.$smcs);
		    	        /**************** 把路径放到表单中 *****************/
		    	        $data['cs'] = $cs;
				        $data['big_cs'] = $bigcs;
				        $data['mid_cs'] = $midcs;
				        $data['sm_cs'] = $smcs;
					}
		        }
				$gmmodel->add(array(
					'cs'=>$cs,
					'big_cs'=>$bigcs,
                    'mid_cs'=>$midcs,
                    'sm_cs' =>$smcs,
					'goods_id'=>$data['id'],
					'goods_asc'=>$_POST['goods_asc'][$k],
				));
            }
		}
	}	
	protected function _before_update(&$data, $option){	
		// 判断有没有选择图片
		//获取要修改的商品id
		//var_dump($_POST);
		//var_dump($option);
		$id=$option['where']['id'];		
		//$id=I('post.id');
		/**************** 处理LOGO *******************/
		//判断有没有选择图片
		//var_dump($_FILES);
		if($_FILES['logo']['error'] == 0){
			$upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize = 1024 * 1024 ; // 1M
		    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		    $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
		    $upload->savePath = 'Goods/logo/'; // 设置附件上传（子）目录
		    // 上传文件 
		    $info = $upload->upload();
		    if(!$info){
		    	// 获取失败原因把错误信息保存到 模型的error属性中，然后在控制器里会调用$model->getError()获取到错误信息并由控制器打印
		    	$this->error = $upload->getError();
		        return FALSE;
		    }else{
		    	/**************** 生成缩略图 *****************/
				//var_dump($info);
		    	// 先拼成原图上传的路径
		    	$logo = $info['logo']['savepath'] . $info['logo']['savename'];
				//拼出缩略图的路径和名称
				$biglogo = $info['logo']['savepath'] .'big_'. $info['logo']['savename'];
				$midlogo = $info['logo']['savepath'] .'mid_'. $info['logo']['savename'];
				$smlogo = $info['logo']['savepath'] .'sm_'. $info['logo']['savename'];
				//生成缩略图文件
				$image=new \Think\Image();
				//打开要生成缩略图的文件
                $image->open('./Public/Uploads/'.$logo);
				//生成缩略图的文件
				$image->thumb(150,150)->save('./Public/Uploads/'.$biglogo);
				$image->thumb(180,100)->save('./Public/Uploads/'.$midlogo);
				$image->thumb(50,50)->save('./Public/Uploads/'.$smlogo);
		    	/**************** 把路径放到表单中 *****************/
		    	$data['logo'] = $logo;
				$data['big_logo'] = $biglogo;
				$data['mid_logo'] = $midlogo;
				$data['sm_logo'] = $smlogo;
			}
			//删除logo
			//先查出原来图片的路径
			$oldLogo=$this->field('logo,big_logo,mid_logo,sm_logo')->find($id);
            //从硬盘删除
			unlink('./Public/Uploads/'.$oldLogo['logo']);
			unlink('./Public/Uploads/'.$oldLogo['big_logo']);
			unlink('./Public/Uploads/'.$oldLogo['mid_logo']);
			unlink('./Public/Uploads/'.$oldLogo['sm_logo']);
		}
		/*******处理产品相册图片**********/
		//var_dump($_FILES);
		if(isset($_FILES['pic'])){
		    foreach($_FILES['pic']['name'] as $k=>$v){
			    $pics[]=array(
				    'name'=>$v,
					'type'=>$_FILES['pic']['type'][$k],
					'tmp_name'=>$_FILES['pic']['tmp_name'][$k],
					'error'=>$_FILES['pic']['error'][$k],
					'size'=> $_FILES['pic']['size'][$k],			
				);
			}
		}
		//$_FILES=$pics; //把处理好的数组赋给$_FILES,因为uploadOne函数是到$_FILES中找图片
		//var_dump($_FILES);
		$gpmodel=D('goods_pic');
		//循环每个上传
		foreach($pics as $k=>$v){			
		    if($v['error']==0){
				if(isset($pics[$k]) && $pics[$k]['error'] == 0){
					$upload = new \Think\Upload();// 实例化上传类
		            $upload->maxSize = 2048 * 2048; // 1M
		            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		            $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
		            $upload->savePath = 'Goods/pic/'; // 设置附件上传（子）目录
		            // 上传文件 
				    $info1=$upload->upload(array($k=>$pics[$k]));
				    //var_dump($info1); 
		            if(!$info1){
		    	        $this->error = $upload->getError();
		                return FALSE;
		            }else{
		        	    // 先拼成原图上传的路径
		    	        $pic = $info1[$k]['savepath'] . $info1[$k]['savename'];	
						//拼出缩略图的路径和名称
				        $bigpic = $info1[$k]['savepath'] .'big_'. $info1[$k]['savename'];
				        $midpic = $info1[$k]['savepath'] .'mid_'. $info1[$k]['savename'];
				        $smpic = $info1[$k]['savepath'] .'sm_'. $info1[$k]['savename'];
				        //生成缩略图文件
				        $image=new \Think\Image();
						//打开要生成缩略图的文件
                        $image->open('./Public/Uploads/'.$pic);
				        //生成缩略图的文件
				        $image->thumb(150,150)->save('./Public/Uploads/'.$bigpic);
				        $image->thumb(180,100)->save('./Public/Uploads/'.$midpic);
				        $image->thumb(50,50)->save('./Public/Uploads/'.$smpic);
						//var_dump($pic);
				        $gpmodel->add(array(
					       'pic'=>$pic,
					       'big_pic'=>$bigpic,
                           'mid_pic'=>$midpic,
                           'sm_pic' =>$smpic,
					       'goods_id'=>$id,		
				        ));
					}
		        }					
            }
		}	
	    /*******处理产品参数图片数据信息**********/
		//var_dump($_FILES);
		if(isset($_FILES['cs'])){
		    foreach($_FILES['cs']['name'] as $k=>$v){
			    $css[]=array(
				    'name'=>$v,
					'type'=>$_FILES['cs']['type'][$k],
					'tmp_name'=>$_FILES['cs']['tmp_name'][$k],
					'error'=>$_FILES['cs']['error'][$k],
					'size'=> $_FILES['cs']['size'][$k],			
				);
			}
		}
		//$_FILES=$css; //把处理好的数组赋给$_FILES,因为uploadOne函数是到$_FILES中找图片
		//var_dump($_FILES);
		$gmmodel=D('goods_ms');
		//循环每个上传
		foreach($css as $k=>$v){			
		    if($v['error']==0){
				if(isset($css[$k]) && $css[$k]['error'] == 0){
					$upload = new \Think\Upload();// 实例化上传类
		            $upload->maxSize = 2048 * 2048; // 1M
		            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		            $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
		            $upload->savePath = 'Goods/cs/'; // 设置附件上传（子）目录
		            // 上传文件 
				    $info2=$upload->upload(array($k=>$css[$k]));
				    //var_dump($info2); 
		            if(!$info2){
		    	        $this->error = $upload->getError();
		                return FALSE;
		            }else{
		        	    // 先拼成原图上传的路径
		    	        $cs = $info2[$k]['savepath'] . $info2[$k]['savename'];	
						//拼出缩略图的路径和名称
				        $bigcs = $info2[$k]['savepath'] .'big_'. $info2[$k]['savename'];
				        $midcs = $info2[$k]['savepath'] .'mid_'. $info2[$k]['savename'];
				        $smcs = $info2[$k]['savepath'] .'sm_'. $info2[$k]['savename'];
				        //生成缩略图文件
				        $image=new \Think\Image();
						//打开要生成缩略图的文件
                        $image->open('./Public/Uploads/'.$cs);
				        //生成缩略图的文件
				        $image->thumb(150,150)->save('./Public/Uploads/'.$bigcs);
				        $image->thumb(180,100)->save('./Public/Uploads/'.$midcs);
				        $image->thumb(50,50)->save('./Public/Uploads/'.$smcs);
						//var_dump($cs);
				        $gmmodel->add(array(
					        'cs'=>$cs,
					        'big_cs'=>$bigcs,
                            'mid_cs'=>$midcs,
                            'sm_cs' =>$smcs,
					        'goods_id'=>$data['id'],
					        'goods_asc'=>$_POST['goods_asc'][$k],
				        ));
					}
		        }					
            }
		}
		// 获取当前时间并添加到表单中这样就会插入到数据库中
		$data['addtime']=date('Y-m-d H:i:s',time());
		//我们自己来过滤这个字段
		$data['goods_desc']=removeXSS($_POST['goods_desc']);		
	}
	// 删除前
	protected function _before_delete($option){
		//var_dump($option);
		$id=$option['where']['id'];
		/*****删除相册中的图片***********/
		//先从相册中取出相册所在的硬盘路径
		$gpmodel=D('goods_pic');
		$pics=$gpmodel->field('pic,big_pic,mid_pic,sm_pic')
			          ->where(array('goods_id'=>array('eq',$id)))
			          ->select();
		//var_dump($pics);
		//循环每个图片从硬盘删除
		foreach($pics as $k=>$v){
		    unlink('./Public/Uploads/'.$v);
		}
		//从数据库中把记录删除
		$gpmodel->where(array('goods_id'=>array('eq',$id)))->delete();

		/*****删除产品参数图片数据信息***********/
		//先从产品参数图片中取出产品参数图片所在的硬盘路径
		$gmmodel=D('goods_ms');
		$css=$gmmodel->field('cs,big_cs,mid_cs,sm_cs,goods_asc')
			          ->where(array('goods_id'=>array('eq',$id)))
			          ->select();
		//var_dump($pics);
		//循环每个图片从硬盘删除
		foreach($css as $k=>$v){
		    unlink('./Public/Uploads/'.$v);
		}
		//从数据库中把记录删除
		$gmmodel->where(array('goods_id'=>array('eq',$id)))->delete();
	}
	
}