<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:101:"/Users/renmenghan/Documents/workspace/PHP/app.rmh.com/public/../application/admin/view/news/edit.html";i:1519051428;s:94:"/Users/renmenghan/Documents/workspace/PHP/app.rmh.com/application/admin/view/public/_meta.html";i:1518961232;s:96:"/Users/renmenghan/Documents/workspace/PHP/app.rmh.com/application/admin/view/public/_footer.html";i:1518945275;}*/ ?>
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
    <link rel="stylesheet" type="text/css" href="/static/admin/uploadify/uploadify.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/static/hadmin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
    <script>
        swf = '/static/admin/uploadify/uploadify.swf';
        image_upload_url = "<?php echo url('image/upload'); ?>";
    </script>
</head>
<body>
<article class="page-container">
  <form class="form form-horizontal" id="form-singwaapp" url="<?php echo url('news/edit',['id'=>$model['id']]); ?>">
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="<?php echo $model['title']; ?>" placeholder="" id="title" name="title">
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">简略标题：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="<?php echo $model['small_title']; ?>" placeholder="" id="samll_title" name="small_title">
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
      <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="catid" class="select">
                 <?php if(is_array($cats) || $cats instanceof \think\Collection || $cats instanceof \think\Paginator): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                   <option value="<?php echo $key; ?>" <?php if($key == $model['catid']): ?> selected="selected" <?php endif; ?> ><?php echo $vo; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>

                  
                </select>
				</span> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">文章摘要：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <textarea name="description" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" ><?php echo $model['description']; ?></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
      </div>
    </div>


    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">允许评论：</label>
      <div class="formControls col-xs-8 col-sm-9 skin-minimal">
        <div class="check-box">
          <input type="checkbox" id="is_allowcomments" name="is_allowcomments" value="1" <?php if(1 == $model['is_allowcomments']): ?> checked <?php endif; ?>>
          <label for="checkbox-pinglun">&nbsp;</label>
        </div>
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">是否推荐到首页头图：</label>
      <div class="formControls col-xs-8 col-sm-9 skin-minimal">
        <div class="check-box">
          <input type="checkbox" id="is_head_figure" name="is_head_figure" value="1" <?php if(1 == $model['is_head_figure']): ?> checked <?php endif; ?>>
          <label for="checkbox-pinglun">&nbsp;</label>
        </div>
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">是否推荐：</label>
      <div class="formControls col-xs-8 col-sm-9 skin-minimal">
        <div class="check-box">
          <input type="checkbox" id="is_position" name="is_position" value="1" <?php if(1 == $model['is_position']): ?> checked<?php endif; ?>>
          <label for="checkbox-pinglun">&nbsp;</label>
        </div>
      </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">缩略图：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <input id="file_upload"  type="file" multiple="true" >
        <img style="display: none" id="upload_org_code_img" src="<?php echo $model['image']; ?>" width="150" height="150">
        <input id="file_upload_image" name="image"  type="hidden" multiple="true" value="<?php echo $model['image']; ?>">
      </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">文章内容：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <script id="editor" type="text/plain" name="content" style="width:100%;height:400px;"><?php echo $model['content']; ?></script>
      </div>
    </div>
    <div class="row cl">
      <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
        <button  class="btn btn-secondary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
        <button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
      </div>
    </div>
  </form>
</article>

<!--header-->
<script type="text/javascript" src="/static/hadmin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/hadmin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/hadmin/static/h-ui/js/H-ui.min.js"></script>
<!--<script type="text/javascript" src="/static/hadmin/static/h-ui.admin/js/H-ui.admin.js"></script>-->
<script type="text/javascript" src="/static/hadmin/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/static/admin/js/common.js"></script>



<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/hadmin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/hadmin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/hadmin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/hadmin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/static/hadmin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/static/hadmin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
        <script type="text/javascript" src="/static/admin/uploadify/jquery.uploadify.min.js"></script>
        <script type="text/javascript" src="/static/admin/js/image.js"></script>
<script type="text/javascript">
  $(function(){
    $('.skin-minimal input').iCheck({
      checkboxClass: 'icheckbox-blue',
      radioClass: 'iradio-blue',
      increaseArea: '20%'
    });

    //表单验证
    $("#form-singwaapp").validate({
      rules:{
        title:{
          required:true,
        },
        small_title:{
          required:true,
        },
        catid:{
          required:true,
        },
        sources_type:{
          required:true,
        },
        is_allowcomments:{
          required:true,
        },

      },
      onkeyup:false,
      focusCleanup:true,
      success:"valid",
      submitHandler:function(form){
        rmhapp_save(form);// 需要小伙伴自定义一个singwaapp_save方法 用来处理抛送请求的哦
      }
    });

    var ue = UE.getEditor('editor');

  });

</script>
<!--/请在上方写此页面业务相关的脚本-->

</body>
</html>