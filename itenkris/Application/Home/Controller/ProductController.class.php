<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller {
    public function product(){
		$model=D('Goods');
		$data=$model->alias('a')
			        ->join('LEFT JOIN goods_pic b ON a.id=b.goods_id')
			        ->field('a.id,a.logo,a.goods_td,a.goods_name,a.goods_msc,a.goods_desc,b.pic')
			        ->select();
		
		$count = $model->count();
		//var_dump($data);

		$mmodel=D('goods_ms');
		$mdata=$mmodel->field('cs,goods_asc')->select();
        //var_dump($mdata);

		$imodel=D('Intro');
		$idata=$imodel->select();

		$this->assign(array(
		    'data' => $data,	
			'idata'=>$idata,
			'count'=>$count,
			'mdata'=>$mdata,
		));
        $this->display();
    }
}