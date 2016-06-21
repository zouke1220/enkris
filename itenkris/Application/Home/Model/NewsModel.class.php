<?php 
namespace Home\Model;
use Think\Model;
class NewsModel extends Model{
	//实现翻页效果
    public function search($perPage=4){
	    //查询满足要求的总记录数
        $count = $this->count();
		//实例化分页类 传入总记录数和每页显示的记录数(1)
        $Page = new \Think\Page($count,$perPage);
		//设置分页样式
		$Page->setConfig('next','下一页');
		$Page->setConfig('prev','上一页');
		//分页显示输出
        $pageshow = $Page->show();
        //进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $pdata=$this->limit($Page->firstRow.','.$Page->listRows)
				    ->select();
		//返回数据
		return array(
		   'pdata' => $pdata, //数据
		   'page' => $pageshow, //翻页		
		);
	}
}
?>