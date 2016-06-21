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


<!-- 列表 -->
<div class="list-div" id="listDiv">
	<table cellpadding="3" cellspacing="1">
    	<tr>
		    <th >ID</th>
			<th >职位名称</th>
            <th >职称类别</th>
            <th >类型</th>
            <th >地址</th>
            <th >主要职责</th>
            <th >任职条件</th>
			<th >发布时间</th>
			<th width="60">操作</th>
        </tr>
		<?php foreach ($data as $k => $v): ?>            
			<tr class="tron">
			    <td align="center"><?php echo $v['id']; ?></td>
				<td align="center"><?php echo $v['cate']; ?></td>
				<td align="center"><?php echo $v['category']; ?></td>
				<td align="center"><?php echo $v['position']; ?></td>
				<td align="center"><?php echo $v['location']; ?></td>
				<td><?php echo $v['kr']; ?></td>
				<td><?php echo $v['eq']; ?></td>
				<td align="center"><?php echo $v['addtime']; ?></td>
		        <td align="center">
		        	<a href="<?php echo U('edit?id='.$v['id'].'&p='.I('get.p')); ?>" title="编辑">编辑</a> |
	                <a href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p')); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
		        </td>
	        </tr>
        <?php endforeach; ?> 
		<!--分页开始-->
	    <table id="page-table" cellspacing="0">
	    <tr>
		    <td width="80%">&nbsp;</td>
			<td align="center" nowrap="true"><?php echo $page;?></td>
		</tr>
	</table>
	<!--分页结束-->
	</table>
</div>

<script>
</script>

<script src="/Public/Admin/Js/tron.js"></script>

<div id="footer">jquery+Thinkphp</div>
</body>
</html>