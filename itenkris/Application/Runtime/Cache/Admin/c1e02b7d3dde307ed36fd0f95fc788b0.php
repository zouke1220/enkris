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


<div class="main-div">
    <form name="main_form" method="POST" action="/index.php/Admin/Employ/edit/id/2/p/2.html" enctype="multipart/form-data" >
    	<input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <table cellspacing="1" cellpadding="3" width="100%">
		    <tr>
                <td class="label">职位名称：</td>
                <td>
                    <input  type="text" name="cate" value="<?php echo $data['cate']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">职位类别：</td>
                <td>
                    <input  type="text" name="category" value="<?php echo $data['category']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">类型：</td>
                <td>
                    <input  type="text" name="position" value="<?php echo $data['position']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">地址：</td>
                <td>
                    <textarea id="location" name="location"><?php echo $data['location']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">主要职责：</td>
                <td>
                    <textarea id="kr" name="kr"><?php echo $data['kr']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">任职条件：</td>
                <td>
                    <textarea id="eq" name="eq"><?php echo $data['eq']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>
<!--导入在线编辑器-->
<link href="/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/Public/umeditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/Public/umeditor/lang/zh-cn/zh-cn.js"></script>
<script>
UM.getEditor('kr', {
	initialFrameWidth : "90%",
	initialFrameHeight : 300
});
UM.getEditor('eq', {
	initialFrameWidth : "90%",
	initialFrameHeight : 300
});
</script>

<div id="footer">jquery+Thinkphp</div>
</body>
</html>