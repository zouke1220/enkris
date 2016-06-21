<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model {
    //定义验证规则
	protected $_validate=array(
		array('cat_name','require','分类名称不能为空',1, 'regex', 3),
	);
	protected $insertFields = array('cat_name','parent_id');
	protected $updateFields = array('id','cat_name','parent_id');

	//找出一个分类的所有子分类的id
	public function getChildren($catid){
	    //取出所有的分类
		$catdata=$this->select();
		//递归从所有的分类中挑出子分类的id
		return $this->_getChildren($catdata,$catid,TRUE);
	}
	private function _getChildren($catdata,$catid,$isClear=FALSE){
	    static $_ret=array();//保存找到子分类的id
		if($isClear){
		    $_ret=array();
			//循环所有分类找子分类
			foreach($catdata as $k=>$v){
			    if($v['parent_id']==$catid){
				    $_ret[]=$v['id'];
					//再找这个$v的子分类
					$this->_getChildren($catdata,$v['id']);
				}
			}
			return $_ret;
		}
	}
	//打印树形结构
	public function getTree(){
	    $catdata=$this->select();
		return $this->_getTree($catdata);
	}
	private function _getTree($catdata,$parent_id=0,$level=0){
	    static $_ret=array();//保存找到子分类的id
		foreach($catdata as $k=>$v){
		    if($v['parent_id']==$parent_id){
			    $v['level']=$level; //用来标记这个分类是第几级的
				$_ret[]=$v;
				//找子分类
				$this->_getTree($catdata,$v['id'],$level+1);
			}
		}
		return $_ret;
	}
	protected function _before_delete($option){
	    //先找出所有的子分类的id
		//var_dump($option);exit;
		$children=$this->getChildren($option['where']['id']);
		if($children){
			$children=implode(',',$children);
			//var_dump($children);exit;
		    //删除这些子分类
			//这里必须生成父类模型,然后调用delete
			//如果使用$this调用delete,那么在调用delete之前就会调用$this->_before_delete,这样就会死循环
			$model= new \Think\Model();
		    $model->table('__CATEGORY__')->delete($children);
		}
	}
}