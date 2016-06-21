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
    <form name="main_form" method="POST" action="/index.php/Admin/Category/edit/id/1.html" >
	    <input type="hidden" name="id" value="<?php echo $cdata['id']; ?>" />
        <table cellspacing="1" cellpadding="3" width="100%">	
            <tr>
			    <td class="label">上级分类：</td>
				<td>
				    <select name="parent_id">
					    <option value="0">顶级分类</option>
					    <?php foreach($catdata as $k=>$v): if($v['id']==$cdata['id']||in_array($v['id'],$children)) continue; if($v['id']==$cdata['parent_id']) $select='selected="selected"'; else $select=''; ?>
                            <option <?php echo $select;?> value="<?php echo $v['id']?>" size="100">
							    <?php echo str_repeat('&nbsp;&nbsp;',3*$v['level']).$v['cat_name'];?>
							</option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
                <td class="label">分类名称：</td>
                <td>
                    <input  size="60" type="text" name="cat_name" value="<?php echo $cdata['cat_name']?>" />
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


<div id="footer">jquery+Thinkphp</div>
</body>
</html>