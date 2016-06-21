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


<!-- 分类列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>分类名称</th>				
                <th>操作</th>
            </tr>
            <?php foreach($catdata as $v):?>
            <tr class="tron">
                <td align="left"><?php echo str_repeat('&nbsp;&nbsp;',4*$v['level']).$v['cat_name'];?></td>
                <td align="center">
                   <a href="<?php echo U('edit?id='.$v['id']);?>">修改</a>
                   <a onclick="return confirm('确定要删除吗？')" href="<?php echo U('delete?id='.$v['id']);?>">删除</a>
				</td>
            </tr>
            <?php endforeach; ?>		
        </table>    
    </div>
</form>

<!-- 引入Jquery -->
<script type="text/javascript" src="/Public/umeditor/third-party/jquery.min.js"></script>
<!-- 引入行高亮显示tron.js -->
<script type="text/javascript" src="/Public/Admin/Js/tron.js"></script>

<div id="footer">jquery+Thinkphp</div>
</body>
</html>