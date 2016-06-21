<?php
namespace Admin\Model;
use Think\Model;
class AboutModel extends Model{
	protected $insertFields = array('link');
	protected $updateFields = array('id','link');
	protected $_validate = array(
		array('link', 'require', '内部链接不能为空！', 1, 'regex', 3),
		array('link', '1,150', '内部链接的值最长不能超过 150 个字符！', 1, 'length', 3),
	);
	public function search($pageSize = 5){	
		$count = $this->alias('a')->count();
		$page = new \Think\Page($count, $pageSize);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		// 取数据
		$data['data'] = $this->alias('a')->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option){
        /**************** 处理LOGO *******************/
		//判断有没有选择图片
		//var_dump($_FILES);
		if($_FILES['logo']['error'] == 0){
			$upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize = 1024 * 1024 ; // 1M
		    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		    $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
		    $upload->savePath = 'About/logo/'; // 设置附件上传（子）目录
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
				/*
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
				*/
		    	/**************** 把路径放到表单中 *****************/
		    	$data['logo'] = $logo;
				/*
				$data['big_logo'] = $biglogo;
				$data['mid_logo'] = $midlogo;
				$data['sm_logo'] = $smlogo;
				*/
			}
		}
	}
	// 修改前
	protected function _before_update(&$data, $option){
		/**************** 处理LOGO *******************/
		//判断有没有选择图片
		//var_dump($_FILES);
		if($_FILES['logo']['error'] == 0){
			$upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize = 1024 * 1024 ; // 1M
		    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		    $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
		    $upload->savePath = 'About/logo/'; // 设置附件上传（子）目录
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
				/*
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
				*/
		    	/**************** 把路径放到表单中 *****************/
		    	$data['logo'] = $logo;
				/*
				$data['big_logo'] = $biglogo;
				$data['mid_logo'] = $midlogo;
				$data['sm_logo'] = $smlogo;
				*/
			}
			//删除logo
			//先查出原来图片的路径
			$oldLogo=$this->field('logo')->find($id);
            //从硬盘删除
			unlink('./Public/Uploads/'.$oldLogo['logo']);
			/*
			unlink('./Public/Uploads/'.$oldLogo['big_logo']);
			unlink('./Public/Uploads/'.$oldLogo['mid_logo']);
			unlink('./Public/Uploads/'.$oldLogo['sm_logo']);
			*/
		}
	}
	// 删除前
	protected function _before_delete($option){
		if(is_array($option['where']['id'])){
			$this->error = '不支持批量删除';
			return FALSE;
		}
		$images = $this->field('logo,big_logo,mid_logo,sm_logo')->find($option['where']['id']);
		deleteImage($images);
	}
}