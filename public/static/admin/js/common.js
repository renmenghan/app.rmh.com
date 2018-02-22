/**
 * Created by renmenghan on 2018/2/18.
 */

/**
 * 通过from表单中提交的数据的方法
 */
function rmhapp_save(form) {

    var data = $(form).serialize();
    // 调试
    url = $(form).attr('url');
    
    $.post(url,data,function (result) {
        if (result.code == 0) {
            layer.msg(result.msg,{icon:5,time:2000});
        }else if (result.code == 1){
            layer.msg(result.msg,{icon:1,time:2000});
            layer_close();
            self.location = result.data.jump_url;

        }
    },'JSON');
}

/**
 * 时间插件适配方法
 * @param flag
 */
function selecttime(flag){
    if(flag==1){
        var endTime = $("#countTimeend").val();
        if(endTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',maxDate:endTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }else{
        var startTime = $("#countTimestart").val();
        if(startTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:startTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }
}

/**
 * 通用化删除操作
 * @param obj
 */
function app_del(obj){
    //获取模板地址
    var url=$(obj).attr('del_url');
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            success: function(data){
                if (data.code == 1){
                    // 执行跳转
                    self.location = data.data.jump_url;
                }else if (data.code==0){
                    layer.msg(data.msg,{icon:2,time:2000});
                }
                // $(obj).parents("tr").remove();
                // layer.msg('已删除!',{icon:1,time:1000});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}

/**
 * 通用化修改状态操作
 * @param obj
 */
function app_status(obj) {
    //获取模板地址
    var url=$(obj).attr('status_url');
    layer.confirm('确认要更改吗？',function(index){
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            success: function(data){
                if (data.code == 1){
                    // 执行跳转
                    self.location = data.data.jump_url;
                }else if (data.code==0){
                    layer.msg(data.msg,{icon:2,time:2000});
                }
                // $(obj).parents("tr").remove();
                // layer.msg('已删除!',{icon:1,time:1000});
            },
            error:function(data) {
                console.log(data.msg);
            },
        });
    });
}


