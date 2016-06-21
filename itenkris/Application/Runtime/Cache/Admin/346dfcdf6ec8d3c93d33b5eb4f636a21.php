<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 -<?php echo $_page_title; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/Public/umeditor/third-party/jquery.min.js"></script>
</head>
<body>
<h1>
	<?php if($_page_btn_name): ?>
    <span class="action-span"><a href="<?php echo $_page_btn_link; ?>"><?php echo $_page_btn_name; ?></a></span>
    <?php endif; ?>
    <span class="action-span1"><a href="#">管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo $_page_title; ?> </span>
    <div style="clear:both"></div>
</h1>

<!--  内容  -->

<style>
#ul_pic_list li{
    margin:5px;
	list-style-type:none;
}
</style>
<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front">产品信息</span>
			<span class="tab-back">产品参数</span>
			<span class="tab-back">产品相册</span>
        </p>
    </div>
    <div id="tabbody-div">
	<form enctype="multipart/form-data" action="/index.php/Admin/Goods/add.html" method="post">
	    <!--产品基本信息-->
        <table class="tab_table" cellspacing="1" cellpadding="3" width="100%">	
			<tr>
                <td class="label">产品名称：</td>
                <td>
                    <input  size="60" type="text" name="goods_name" value="" />
                </td>
            </tr>  
			<tr>
                <td class="label">产品logo：</td>
                <td>
                    <input type="file" name="logo" size="60" />
                </td>
            </tr>	
			<tr>
                <td class="label">产品简介：</td>               
			    <td>
                    <textarea id="goods_msc" name="goods_msc"></textarea>
                </td>
            </tr>
			<tr>
                <td class="label">产品特点：</td>               
			    <td>
                    <textarea id="goods_td" name="goods_td"></textarea>
                </td>
            </tr>   
			<tr>
                <td class="label">产品特点描述：</td>               
			    <td>
                    <textarea id="goods_desc" name="goods_desc"></textarea>
                </td>
            </tr>     	  
        </table>
		<!--产品参数信息-->
        <table class="tab_table" cellspacing="1" cellpadding="3" width="100%">		   
			<tr>
			    <td>
			        <input id="btn_add_cs" type="button" value="添加产品参数图片信息"/><hr />	
					<ul id="ul_cs_list"></ul>
				</td>
            </tr>	
        </table>
		<!--产品相册-->
		<table style="display:none;" width="90%" class="tab_table" align="center">
		    <tr>
			    <td>
				    <input id="btn_add_pic" type="button" value="添加一张"/><hr />
					<ul id="ul_pic_list"></ul>						
				</td>
			</tr>
		</table>
	    <div class="button-div">
            <input type="submit" value=" 确定 " class="button"/>
            <input type="reset" value=" 重置 " class="button" />
        </div>	
    </form>
    </div>
</div>
<!--导入在线编辑器-->
<link href="/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/Public/umeditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/Public/umeditor/lang/zh-cn/zh-cn.js"></script>
<script>
UM.getEditor('goods_desc', {
	initialFrameWidth : "90%",
	initialFrameHeight : 300
});
</script>
<script>
//切换的代码
$("#tabbar-div p span").click(function(){
    //点击的第几个按钮
	var i=$(this).index();
	//先隐藏所有的table
    $(".tab_table").hide();
	//显示第i个table
    $(".tab_table").eq(i).show();
	//隐藏其他4个table
    //$(".tab_table").eq(i).sublings().hide();
	//先取消源按钮的选中状态
	$(this).removeClass("tab-front").addClass("tab-back");
	//设置当前按钮选中
	$(this).removeClass("tab-back").addClass("tab-front");
});
//添加一张
$("#btn_add_pic").click(function(){
    var file='<li><input type="file" name="pic[]" /></li>';
	$("#ul_pic_list").append(file);
});
//添加参数信息
$("#btn_add_cs").click(function(){
    var cs='<li>参数数据图：<input type="file" name="cs[]" /><br />参数描述：<input size="60" type="text" name="goods_asc[]" value="" /></li><hr />'
	$("#ul_cs_list").append(cs);
});
</script>

<div id="footer">jquery+Thinkphp</div>
</body>
</html>