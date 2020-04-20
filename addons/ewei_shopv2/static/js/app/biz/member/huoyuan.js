define(['core', 'tpl'], function(core, tpl) {
    var modal = {};
    modal.init = function(params) {
        params = $.extend({
            returnurl: '',
            template_flag: 0,
            new_area: 0
        }, params || {});
        $('#btn-submit2').click(function() {
            var postdata = {};
            if (params.template_flag == 0) {
                if ($('#areas').isEmpty()) {
                    FoxUI.toast.show('请输入装货地址');
                    return
                }
                if ($('#areas3').isEmpty()) {
                    FoxUI.toast.show('请输入卸货地址');
                    return
                }
                if ($('#huoxianxi').isEmpty()) {
                    FoxUI.toast.show('请完善货物信息');
                    return
                }
                if ($('#chexingval').isEmpty()) {
                    FoxUI.toast.show('请选择车长车型');
                    return
                }

                if ($('#areas5').isEmpty()) {
                    FoxUI.toast.show('请选择装货时间');
                    return
                }
                if (!$("#xieyi").prop("checked")) {
            　　      FoxUI.toast.show('确认同意相关协议');
                    return
                } 
                if ($(this).attr('submit')) {
                    return
                }
                $(this).html('保存成功').attr('submit', 1);
                postdata = {
                    'memberdata': {
                        'areas': $('#areas').val(),
                        'areaszhuang': $('#areaszhuang').val(),
                        'areas3': $('#areas3').val(),
                        'areasxie': $('#areasxie').val(),
                         'huoxianxi': $('#huoxianxi').val(),
                        'chexingval': $('#chexingval').val(),
                        'zhaungxie': $('#zhaungxie').val(),
                       'areas5': $('#areas5').val(), 
                       'fuwu': $('#fuwu').val(),   
                       'yunfeiqi': $('#yunfeiqi').val()
                    }
                };
             
                core.json('member/huoyuan/submit', postdata, function(json) {
                    modal.complete(params, json)
                }, true, true)
            }
        })
    };
      modal.complete = function(params, json) {
        FoxUI.loader.hide();
        if (json.status == 1) {
            FoxUI.toast.show('保存成功');
           
        } else {
            $('#btn-submit2').html('确认修改').removeAttr('submit');
            FoxUI.toast.showshow('保存失败!')
        }
    };
   
    return modal
});