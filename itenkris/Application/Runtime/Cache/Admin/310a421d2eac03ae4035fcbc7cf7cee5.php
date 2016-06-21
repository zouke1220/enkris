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

<!-- 搜索 -->
<div class="form-div search_form_div">
    <form action="/index.php/Admin/News/lst" method="GET" name="search_form">
		<p>
			新闻标题：
	   		<input type="text" name="news_title" size="100" value="<?php echo I('get.news_title'); ?>" />
		</p>		
		<p>
			添加时间：
	   		从 <input id="fa" type="text" name="fa" size="20" value="<?php echo I('get.fa'); ?>" /> 
		    到 <input id="ta" type="text" name="ta" size="20" value="<?php echo I('get.ta'); ?>" />
		</p>
		<p><input type="submit" value=" 搜索 " class="button" /></p>
		<p>
		    排序方式:
			<?php $odby=I('get.odby','id_desc'); ?>
		    <input onclick="this->parentNode.parentNode.submit();" 
		    type="radio" name="odby" value="id_desc" <?php if($odby=='id_desc') echo 'checked="checked"';?>/>以添加时间降序
		    <input onclick="this->parentNode.parentNode.submit();" 
		    type="radio" name="odby" value="id_asc" <?php if($odby=='id_asc') echo 'checked="checked"';?>/>以添加时间升序
		</p>
    </form>
</div>
<!-- 新闻列表 -->
<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th>ID</th>				
            <th>新闻标题</th>  
			<th>添加时间</th>
			<th>操作</th>
        </tr>
        <?php foreach($newdata as $k=>$v):?>
        <tr class="tron">
            <td align="center"><?php echo $v['id'];?></td>
			<td align="left"><?php echo $v['news_title'];?></td>
			<td align="center"><span><?php echo $v['addtime'];?></span></td>
            <td align="center">
                <a href="<?php echo U('edit?id='.$v['id']);?>">修改</a>
                <a onclick="return confirm('确定要删除吗？')" href="<?php echo U('delete?id='.$v['id']);?>">删除</a>
	    	</td>
        </tr>
        <?php endforeach; ?>		
    </table>    
	<!--分页开始-->
	<table id="page-table" cellspacing="0">
	    <tr>
		    <td width="80%">&nbsp;</td>
			<td align="center" nowrap="true"><?php echo $page;?></td>
		</tr>
	</table>
	<!--分页结束-->
</div>
<!-- 引入Jquery -->
<script type="text/javascript" src="/Public/umeditor/third-party/jquery.min.js"></script>
<!-- 引入时间插件 -->
<link href="/Public/datetimepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="/Public/datetimepicker/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/datetimepicker/datepicker-zh_cn.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.css" />
<script type="text/javascript" src="/Public/datetimepicker/time/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript" src="/Public/datetimepicker/time/i18n/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script>
//设置使用中文
$.timepicker.setDefaults($.timepicker.regional['zh-CN']);
$("#fa").datetimepicker();
$("#ta").datetimepicker();
</script>
<!-- 引入行高亮显示tron.js -->
<script type="text/javascript" src="/Public/Admin/Js/tron.js"></script>

<div id="footer">jquery+Thinkphp</div>
</body>
</html>