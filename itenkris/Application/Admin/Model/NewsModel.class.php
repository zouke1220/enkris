<?php
namespace Admin\Model;
use Think\Model;
class NewsModel extends Model {
    //定义验证规则
	protected $_validate=array(
		array('news_title','require','新闻标题不能为空',1),
		array('news_content','require','新闻内容不能为空',1),
	);
	protected $insertFields = array('news_title','news_content','addtime');
	protected $updateFields = array('id','news_title','news_content','addtime');
    
	public function search($pageSize = 2){
		if($news_title = I('get.news_title'))
			$where['news_title'] = array('like', "%$news_title%");
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
		//设置分页样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$newsdata['page'] = $page->show();
		//取数据
		$newsdata['data'] = $this->order("$orderby $orderway")->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		//返回数据
		return $newsdata;
	}
    protected function _before_insert(&$data, $option){
		// 获取当前时间并添加到表单中这样就会插入到数据库中
		$data['addtime']=date('Y-m-d H:i:s',time());
		//我们自己来过滤这个字段
		$data['news_content']=removeXSS($_POST['news_content']);
	}
	protected function _before_update(&$data, $option){
		// 获取当前时间并添加到表单中这样就会插入到数据库中
		$data['addtime']=date('Y-m-d H:i:s',time());
		//我们自己来过滤这个字段
		$data['news_content']=removeXSS($_POST['news_content']);
	}
}