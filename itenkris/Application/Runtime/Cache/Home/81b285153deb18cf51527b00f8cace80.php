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
    
	<div id="news-header">
        <div id="news-logo"><a href="<?php echo U('Home/News/news/p/'.$p);?>"><img src="/Public/Home/img/news-logo.png"/></a></div>
        <div id="lr"><h2><span class="left">Know more</span><span class="right">&nbsp;about Enkris</span></h2></div>
    </div>
    <div id="conmain">
        <div id="title"><?php echo $data['news_title']?></div>
		<!--此处有百度编辑器输入并排版-->
        <div id="content1">
		<?php echo $data['news_content'];?>
	    </div>
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