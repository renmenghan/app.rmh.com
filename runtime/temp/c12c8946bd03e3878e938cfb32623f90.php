<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:101:"/Users/renmenghan/Documents/workspace/PHP/app.rmh.com/public/../application/admin/view/admin/add.html";i:1518869048;s:94:"/Users/renmenghan/Documents/workspace/PHP/app.rmh.com/application/admin/view/public/_meta.html";i:1518860642;s:96:"/Users/renmenghan/Documents/workspace/PHP/app.rmh.com/application/admin/view/public/_footer.html";i:1518860136;}*/ ?>
<!--header-->

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/static/hadmin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/static/hadmin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/hadmin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/hadmin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/hadmin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/hadmin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/hadmin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/static/hadmin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
</head>
<body>
<article class="page-container">
  <form class="form form-horizontal" id="form-admin-add" method="post" action="<?php echo url('admin/add'); ?>">
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员名：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="" placeholder="" id="username" name="username">
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>密码：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password">
      </div>
    </div>

    <div class="row cl">
      <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</article>
<script type="text/javascript" src="/static/hadmin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/hadmin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/hadmin/static/h-ui/js/H-ui.min.js"></script>
<!--<script type="text/javascript" src="/static/hadmin/static/h-ui.admin/js/H-ui.admin.js"></script>-->
<script type="text/javascript" src="/static/hadmin/static/h-ui.admin/js/H-ui.admin.js"></script>

</body>
</html>