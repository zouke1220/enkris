<?php
namespace Admin\Model;
use Think\Model;
class EmployModel extends Model{
	protected $insertFields = array('cate','category','position','location','kr','eq','addtime');
	protected $updateFields = array('id','cate','category','position','location','kr','eq','addtime');
	protected $_validate = array(
		array('category', 'require', '职位不能为空！', 1, 'regex', 3),
		array('category', '1,150', '职位的值最长不能超过 150 个字符！', 1, 'length', 3),
		array('position', 'require', '类型不能为空！', 1, 'regex', 3),
		array('position', '1,150', '类型的值最长不能超过 150 个字符！', 1, 'length', 3),
		array('location', 'require', '地址不能为空！', 1, 'regex', 3),		
		array('kr', 'require', '主要职责不能为空！', 1, 'regex', 3),		
		array('eq', 'require', '任职条件不能为空！', 1, 'regex', 3),
	);
	public function search($pageSize = 1){
		// 分页
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 设置分页样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		// 取数据
		$data['data'] = $this->alias('a')->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option){
		// 获取当前时间并添加到表单中这样就会插入到数据库中
		$data['addtime']=date('Y-m-d H:i:s',time());
		// 我们自己来过滤这个字段
		$data['kr']=removeXSS($_POST['kr']);
		$data['eq']=removeXSS($_POST['eq']);
	}
	// 修改前
	protected function _before_update(&$data, $option){
		// 获取当前时间并添加到表单中这样就会插入到数据库中
		$data['addtime']=date('Y-m-d H:i:s',time());
		// 我们自己来过滤这个字段
		$data['kr']=removeXSS($_POST['kr']);
		$data['eq']=removeXSS($_POST['eq']);
	}
	// 删除前
	protected function _before_delete($option){
		if(is_array($option['where']['id'])){
			$this->error = '不支持批量删除';
			return FALSE;
		}
	}
}