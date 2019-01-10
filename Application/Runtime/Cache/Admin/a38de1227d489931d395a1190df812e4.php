<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["hour_ent"]); ?>:-----:<?php echo ($vo["hour_start"]); ?> <br>
    <?php if(is_array($vo["money"])): $i = 0; $__LIST__ = $vo["money"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vom): $mod = ($i % 2 );++$i;?>今日线上充值金额：<?php echo ($vom["money"]); endforeach; endif; else: echo "" ;endif; ?>
    <?php if(is_array($vo["coin"])): $i = 0; $__LIST__ = $vo["coin"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voc): $mod = ($i % 2 );++$i;?>今日手动充值金额：<?php echo ($voc["coin"]); endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>