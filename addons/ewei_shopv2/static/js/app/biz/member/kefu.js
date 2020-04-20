define(['core', 'tpl'], function(core, tpl) {
    var modal = {};
    modal.init = function(params) {
        $("#file0").change(function() {

            var fileid = $(this).attr('id');
            FoxUI.loader.show('mini');
            $.ajaxFileUpload({
                url: core.getUrl('util/uploader'),
                data: {
                    file: fileid
                },
                secureuri: false,
                fileElementId: fileid,
                dataType: 'json',
                success: function(res) {
                    if (res.error == 0) {
                        $("#sfzimg").attr('src', res.url).data('filename', res.filename)
                    } else {
                        FoxUI.toast.show("上传失败请 重试")
                    }
                    FoxUI.loader.hide();
                    return
                }
            })
        });
        $("#file1").change(function() {

            var fileid = $(this).attr('id');
            FoxUI.loader.show('mini');
            $.ajaxFileUpload({
                url: core.getUrl('util/uploader'),
                data: {
                    file: fileid
                },
                secureuri: false,
                fileElementId: fileid,
                dataType: 'json',
                success: function(res) {
                    if (res.error == 0) {
                        $("#sfzimg1").attr('src', res.url).data('filename', res.filename)
                    } else {
                        FoxUI.toast.show("上传失败请 重试")
                    }
                    FoxUI.loader.hide();
                    return
                }
            })
        });
        $("#file2").change(function() {

            var fileid = $(this).attr('id');
            FoxUI.loader.show('mini');
            $.ajaxFileUpload({
                url: core.getUrl('util/uploader'),
                data: {
                    file: fileid
                },
                secureuri: false,
                fileElementId: fileid,
                dataType: 'json',
                success: function(res) {
                    if (res.error == 0) {
                        $("#sfzimg2").attr('src', res.url).data('filename', res.filename)
                    } else {
                        FoxUI.toast.show("上传失败请 重试")
                    }
                    FoxUI.loader.hide();
                    return
                }
            })
        });
        $('#btn-submit1').click(function() {
      
            if ($(this).attr('submit')) {
                return
            }
          if ($('#text').isEmpty()) {
                    FoxUI.toast.show('请填写反馈内容');
                    return
                }
           if ($('#name').isEmpty()) {
                    FoxUI.toast.show('请填写联系人');
                    return
                }
           
			if ($('#mobile').isEmpty()) {
                    FoxUI.toast.show('请填写联系方式');
                    return
                }
                if (!$('#mobile').isMobile() && !params.wapopen) {
                    FoxUI.toast.show('请填写正确联系方式');
                    return
                }
           var img = $('#sfzimg').attr('src');
 			var img1 = $('#sfzimg1').attr('src');
           var img2 = $('#sfzimg2').attr('src');
          
          //  var  postdata= $('#mobile').val();


            $(this).html('处理中...').attr('submit', 1);
         // FoxUI.toast.show('提交成功');
           //location.href = 'http://otc.hsade.com/app/index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=member';

            core.json('member/yijian/submit', {
              img:img,
              img1:img1,
              img2:img2,
              text:$('#text').val(),
              mobile:$('#mobile').val(),
              name:$('#name').val()
              
            }, function(json) {
                modal.complete(params, json)
           }, true, true)
        })
    };
    modal.complete = function(params, json) {
        FoxUI.loader.hide();
        if (json.status == 1) {
            FoxUI.toast.show('上传成功');
            if (params.returnurl) {
                location.href = 'http://wuliu.hsade.com/app/index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=member';
            } else {
                location.href = 'http://wuliu.hsade.com/app/index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=member';
            }
				location.href = 'http://wuliu.hsade.com/app/index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=member';
        } else {
            $('#btn-submit1').removeAttr('submit');
            FoxUI.toast.show('提交失败!');
        }
    };

    return modal
});