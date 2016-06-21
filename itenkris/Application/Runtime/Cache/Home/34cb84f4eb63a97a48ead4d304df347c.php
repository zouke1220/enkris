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
    
	<div id="careers-header">
        <h2>Welcome to join us</h2>
    </div>
    <div id="careers-lst">
        <div id="careers-left">
		<?php foreach($pdata as $k=>$v):?>
		    <div id="o1">
		       <img src="/Public/Home/img/need.png"/> 
		       <h4>&nbsp;&nbsp;<?php echo $v['cate']?></h4>
		       <p>Category: <?php echo $v['category']?> <br>Position Type:<?php echo $v['position']?><br> Location:<?php echo $v['location']?></p>
			</div>			
			<div class="clear"></div><!-- html注释：清除float产生浮动 --> 
			<div id="o2">
		        <img src="/Public/Home/img/hd.png"/> 
		        <h4>&nbsp;&nbsp;Key<br />&nbsp;&nbsp;Responsibilities</h4>
			</div>
			<div class="clear"></div><!-- html注释：清除float产生浮动 -->
		    <div id="o3">
			    <?php echo $v['kr']?>
			</div>
		</div>	   
		<div id="careers-right">
		    <div id="o4">
		        <img src="/Public/Home/img/hd.png"/> 
		        <h4>&nbsp;&nbsp;Education & <br />&nbsp;&nbsp;Qualifications</h4>
			</div>
			<div class="clear"></div><!-- html注释：清除float产生浮动 --> 
			<div id="o5">
               <?php echo $v['eq']?>
			</div>
			<div class="clear"></div><!-- html注释：清除float产生浮动 --> 
			<div id="o6">
                <img src="/Public/Home/img/email.png"/> 
		        <p>Send your CVs by e-mail to<br /><a href="HR@enkris.com">HR@enkris.com</a>if you are interested in these positions.</p>
			</div>
			<div class="clear"></div><!-- html注释：清除float产生浮动 --> 
			<div id="o7">
                <img src="/Public/Home/img/ps.png"/>
		        <p>By sending your application you agree that ENKRIS Semiconductors can collect, process, use and save your CV for the purpose of occupational aptitude during the screening process.</p>
			</div>
		<?php endforeach;?>
		</div>
		<div class="clear"></div><!-- html注释：清除float产生浮动 -->	
		<!--分页开始-->
	    <table id="page-table" cellspacing="0"  align="center">
	        <tr
		       <td width="80%">&nbsp;</td>
			   <td align="center" nowrap="true"><?php echo $page;?></td>
		    </tr>
	    </table>
	    <!--分页结束-->
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