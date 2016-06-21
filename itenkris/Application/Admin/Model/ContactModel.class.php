<?php
namespace Admin\Model;
use Think\Model;
class ContactModel extends Model {
	protected $insertFields = array('smtel','smemail','tstel','tsemail');
	protected $updateFields = array('id','smtel','smemail','tstel','tsemail');
	protected $_validate = array(
		array('smtel', 'require', '销售热线不能为空！', 1, 'regex', 3),
		array('smtel', '1,150', '销售热线的值最长不能超过 150 个字符！', 1, 'length', 3),
		array('smemail', 'require', '销售email不能为空！', 1, 'regex', 3),
		array('smemail', '1,150', '销售email的值最长不能超过 150 个字符！', 1, 'length', 3),
		array('tstel', 'require', '技术支持热线不能为空！', 1, 'regex', 3),
		array('tstel', '1,150', '技术支持热线的值最长不能超过 150 个字符！', 1, 'length', 3),
		array('tsemail', 'require', '技术email不能为空！', 1, 'regex', 3),
		array('tsemail', '1,150', '技术email的值最长不能超过 150 个字符！', 1, 'length', 3),
	);
	public function search($pageSize = 20){
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		//取数据
		$data['data'] = $this->alias('a')->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
}