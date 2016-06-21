<?php
namespace Admin\Model;
use Think\Model;
class IntroModel extends Model{
	protected $insertFields = array('cintro','location','zip','gintro');
	protected $updateFields = array('id','cintro','location','zip','gintro');
	protected $_validate = array(
		array('cintro', 'require', '公司简介不能为空！', 1, 'regex', 3),
		array('cintro', '1,3000', '公司简介的值最长不能超过 3000 个字符！', 1, 'length', 3),
		array('location', 'require', '地址不能为空！', 1, 'regex', 3),
		array('location', '1,200', '地址的值最长不能超过 200 个字符！', 1, 'length', 3),
		array('zip', 'require', '邮编不能为空！', 1, 'regex', 3),
		array('zip', '1,10', '邮编的值最长不能超过 10 个字符！', 1, 'length', 3),
		array('gintro', 'require', '产品简介不能为空！', 1, 'regex', 3),
		array('gintro', '1,3000', '产品简介的值最长不能超过 3000 个字符！', 1, 'length', 3),
	);
	public function search($pageSize = 5){
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
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
		    $upload->savePath = 'Intro/'; // 设置附件上传（子）目录
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
		    	/**************** 把路径放到表单中 *****************/
		    	$data['logo'] = $logo;
			}
		}
		//我们自己来过滤这个字段
		$data['cintro']=removeXSS($_POST['cintro']);
		$data['gintro']=removeXSS($_POST['gintro']);
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
		    $upload->savePath = 'Intro/'; // 设置附件上传（子）目录
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
		    	/**************** 把路径放到表单中 *****************/
		    	$data['logo'] = $logo;
			}
		}
		//我们自己来过滤这个字段
		$data['cintro']=removeXSS($_POST['cintro']);
		$data['gintro']=removeXSS($_POST['gintro']);
	}
	// 删除前
	protected function _before_delete($option){
		if(is_array($option['where']['id'])){
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
}