<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand" /> 
<meta name="Keywords" content="氮化镓，氮化镓HEMT材料，大尺寸氮化镓，硅上氮化镓，电力电子器件，微波射频器件" />
<meta name="description" content="Enkris Semiconductor Inc" />
<link href="/Public/Home/css/style.css" rel="stylesheet" type="text/css" />
<title>苏州晶湛半导体有限公司</title>
<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
<!--引用百度地图API-->
<style type="text/css">
    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
</head>
<body>
<div id="Contact">
    <div id="header">
	    <div id="logo"><img src="/Public/Home/img/logo.png"></div>
	    <div id="menu">
		    <ul>
	            <li class="active"><a href="<?php echo U('Index/index'); ?>">Home</a></li>
                <li><a href="<?php echo U('Product/product'); ?>">Product</a></li>
                <li><a href="<?php echo U('News/news'); ?>">News</a></li>
                <li><a href="<?php echo U('Employ/careers'); ?>">Careers</a></li>		 
                <li><a href="<?php echo U('Contact/contact'); ?>">Contact</a></li>
	        </ul> 
		</div>		 
	</div>
    <!--  内容  -->
    
    <div id="pro">
		<div id="switch-tab">
            <p>
	            <span id="bac" class="tab-front"><img src="/Public/Home/img/bac-1.png" /></span>
	            <span class="tab-back"><img src="/Public/Home/img/bac-2.png" /></span>
	            <span class="tab-back"><img src="/Public/Home/img/bac-3.png" /></span>
	            <span class="tab-back"><img src="/Public/Home/img/bac-4.png" /></span>
	        </p>
        </div>		
	    <!--展品展示-->
		<div class="pro-lst">		  
	        <div id="pro-lst-1">
		        <div id="pro-pic-1">
			        <img src="/Public/Uploads/<?php echo $data[0]['pic']?>" />
			    </div>
			    <div id="pro-title-1">
			        <h3><?php echo $data[0]['goods_name']?></h3>
			    </div>
	        </div>		
     	    <div id="introduction">
		        <div id="des-title"><h2>Introduction</h2></div>
				<?php foreach($idata as $v):?>
		        <div id="des-content">
			        <p><?php echo $v['gintro']?></p>
		        </div>
				<?php endforeach;?>				 
	        </div>	
			<div class="clear"></div><!-- html注释：清除float产生浮动 -->
			<?php for($m=1,$n=0;$n<$count-1;){ $m++; $n++; ?>
			<div id="pro-lst-<?php echo $m;?>">
		        <div id="pro-pic-<?php echo $m;?>">
			        <img src="/Public/Uploads/<?php echo $data[$n]['pic']?>" />
			    </div>
			    <div id="pro-title-<?php echo $m;?>">
			        <h3><?php echo $data[$n]['goods_name']?></h3>
			    </div>
	        </div>
			<?php }?>
		</div>
		<!--Si-->
		<?php foreach($data as $k=>$v): if($k<$count-1){ $k++; static $m=0; static $n=0; ?>
		<div class="pro-details">
		    <div id="pro-left">
                <div id="pic-left">   				
			        <div id="l1"><img src="/Public/Uploads/<?php echo $v['logo']?>" /></div>
		            <div id="p1"><img src="/Public/Uploads/<?php echo $v['pic']?>" /></div>
				</div>
				<div class="clear"></div><!-- html注释：清除float产生浮动 --> 
			    <div id="bottom-left" class="s<?php echo $k?>">
		            <img src="/Public/Home/img/ht<?php echo $k;?>-big.png" />
					<table style="vertical-align:middle">
					    <tr>
                            <td><?php echo $v['goods_msc']?></td>
					    <tr>
					</table>
		        </div>
			</div>			
			<div id="pro-right">
		        <div id="pic-right" class="r<?php echo $k;?>">
			        <img src="/Public/Home/img/ht<?php echo $k;?>.png" />
				    <div><p><?php echo $v['goods_td'];?></p></div> 
			    </div>
				<div class="clear"></div><!-- html注释：清除float产生浮动 --> 
			    <div id="content">
		           <?php echo $v['goods_desc']?>
		        </div>
		        <div id="cs-pic">
		            <img id="m1" src="/Public/Uploads/<?php echo $mdata[$m++]['cs']?>" />
			        <img id="n1" src="/Public/Uploads/<?php echo $mdata[$m++]['cs']?>" />
	      	    </div>
		        <div id="cs-des" class="b<?php echo $k;?>">
			        <div id="des1"><img id="x1" src="/Public/Home/img/li-small.png"/><span><?php echo $mdata[$n++]['goods_asc']?></span></div>
			        <div id="des2"><img id="y1" src="/Public/Home/img/li-small.png"/><span><?php echo $mdata[$n++]['goods_asc']?></span></div>
				</div>
		    </div>
		</div>
		<?php }else{?>      
		<!--Customized-->
        <div class="pro-details">
            <div id="gs">
                <h3><?php echo $v['goods_name']?><h3>
	        </div>
            <div id="gs-pic">   
                <img src="/Public/Uploads/<?php echo $v['logo']?>" />
	        </div>
			<div id="Cus-foot">
                <div id="foot">
                    <img src="/Public/Home/img/zdy.png" />
	            </div>
	            <div id="des">
	                <span>Enkris offers customized GaN III-Nitride epi wafers<br>upon request. Please contact <a href="info@enkris.com">info@enkris.com</a> with your demand.<span>
	            </div>
			</div>
	    </div> 
		<?php }?>
		<?php endforeach;?>
	</div>



	<div id="footer">
        &copy;Enkris All rights reserved. Graphic design by Morning Design.<a href="http://www.miitbeian.gov.cn/">苏ICP备14006757号</a>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="/Public/Home/js/map.js"></script>
<script>
//切换的代码
$(".pro-details").hide();
$(".pro-lst").show();
$("#switch-tab p span").click(function(){	
    //点击的第几个按钮	
	var i=$(this).index();
	//先隐藏所有的product
    $(".pro-details").hide();
	$(".pro-lst").hide();
	//显示第i个product
    $(".pro-details").eq(i).show();
	//隐藏其他4个product
    //$(".tab_table").eq(i).sublings().hide();
	//先取消源按钮的选中状态
	$(this).removeClass("tab-front").addClass("tab-back");
	//设置当前按钮选中
	$(this).removeClass("tab-back").addClass("tab-front");
});
</script>