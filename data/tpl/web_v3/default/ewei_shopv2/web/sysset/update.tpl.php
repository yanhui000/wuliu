<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">当前位置：<span class="text-primary">运费修改</span></div>
<div class="page-content">
    <form action="./index.php" method="get" class="form-horizontal form-search" role="form">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="ewei_shopv2" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r"  value="sysset.update" />
    </form>
    <input type="hidden" id="h_o_p" value=<?php  echo $addressInfo['f_origin_pro']?>>
    <input type="hidden" id="h_o_c" value=<?php  echo $addressInfo['f_origin_city']?>>
    <input type="hidden" id="h_o_o" value=<?php  echo $addressInfo['f_origin_county']?>>
    <input type="hidden" id="h_d_p" value=<?php  echo $addressInfo['f_des_pro']?>>
    <input type="hidden" id="h_d_c" value=<?php  echo $addressInfo['f_des_city']?>>
    <input type="hidden" id="h_d_o" value=<?php  echo $addressInfo['f_des_county']?>>
    <input type="hidden" id="h_f"   value=<?php  echo $addressInfo['f_freight']?>>
    <form action="" id="form" method="" class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="f_id" value="<?php  echo $addressInfo['f_id'];?>" />
        <div class="form-group">
            <label class="col-lg control-label">起点</label>
            <div class="col-sm-9 col-xs-12">
                <select id="origin_first" name="f_origin_pro"  class="form-control tp_is_default" style="width:149px;">
                    <option value="0">请选择省</option>
                    <?php  if(is_array($provinceInfo)) { foreach($provinceInfo as $key => $value) { ?>
                        <?php if(cv($value[id] == $addressInfo[f_origin_pro])) { ?>
                    <option selected value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                        <?php  } else { ?>
                    <option value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                        <?php  } ?>
                    <?php  } } ?>
                </select><span id="origin_first_span" style="color: red"></span>
                <select  id="origin_second"  name="f_origin_city" class="form-control tp_is_default" style="width:149px;">
                    <option value="0">请选择市</option>
                    <?php  if(is_array($cityInfo)) { foreach($cityInfo as $key => $value) { ?>
                        <?php if(cv($value[id] == $addressInfo[f_origin_city])) { ?>
                    <option selected value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                        <?php  } else { ?>
                    <option value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                        <?php  } ?>
                    <?php  } } ?>
                </select><span id="origin_second_sapn" style="color: red"></span>
                <select  id="origin_third" name="f_origin_county" class="form-control tp_is_default" style="width:149px;">
                    <option value="0">请选择县</option>
                    <?php  if(is_array($areaInfo)) { foreach($areaInfo as $key => $value) { ?>
                    <?php if(cv($value[id] == $addressInfo[f_origin_county])) { ?>
                    <option selected value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                    <?php  } else { ?>
                    <option value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                    <?php  } ?>
                    <?php  } } ?>
                </select><span id="origin_third_span" style="color: red"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">终点</label>
            <div class="col-sm-9 col-xs-12">
                <select id="dest_first" name="f_des_pro"  class="form-control tp_is_default" style="width:149px;">
                    <option value="0">请选择省</option>
                    <?php  if(is_array($provinceInfo)) { foreach($provinceInfo as $key => $value) { ?>
                    <?php if(cv($value[id] == $addressInfo[f_des_pro])) { ?>
                    <option selected value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                    <?php  } else { ?>
                    <option value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                    <?php  } ?>
                    <?php  } } ?>
                </select><span id="dest_first_span" style="color: red"></span>
                <select  id="dest_second"  name="f_des_city" class="form-control tp_is_default" style="width:149px;">
                    <option value="0">请选择市</option>
                    <?php  if(is_array($des_cityInfo)) { foreach($des_cityInfo as $key => $value) { ?>
                    <?php if(cv($value[id] == $addressInfo[f_des_city])) { ?>
                    <option selected value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                    <?php  } else { ?>
                    <option value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                    <?php  } ?>
                    <?php  } } ?>
                </select><span id="dest_second_span" style="color: red"></span>
                <select  id="dest_third" name="f_des_county" class="form-control tp_is_default" style="width:149px;">
                    <option value="0">请选择县</option>
                    <?php  if(is_array($des_areaInfo)) { foreach($des_areaInfo as $key => $value) { ?>
                    <?php if(cv($value[id] == $addressInfo[f_des_county])) { ?>
                    <option selected value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                    <?php  } else { ?>
                    <option value=<?php  echo $value['id']?>><?php  echo $value['name']?></option>
                    <?php  } ?>
                    <?php  } } ?>
                </select>
            </div>

        </div>
        <div class="form-group">
            <label class="col-lg control-label">运费</label>
            <div class="col-sm-9 col-xs-12">
                <div class="input-group fixsingle-input-group">
                    <input type="text" id="freight" name="f_freight" class="form-control" value=<?php  echo $addressInfo['f_freight']?> /><span id="freight_span" style="color: red"></span>
                    <div class="input-group-addon">元/Kg</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <tr>
                    <td><input value="LEAST_TIME" checked name="strategy" class="strategy" type="radio">最快捷模式</td>
                    <td><input value="LEAST_FEE" name="strategy" class="strategy" type="radio">最经济模式</td>
                    <td><input value="LEAST_DISTANCE" name="strategy" class="strategy" type="radio">最短距离模式</td>
                </tr>
                <input type="button" value="查看路线" id="map" class="btn btn-primary"/><span id="map_span" style="color: red"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <input type="button" value="提交修改" id="subbtn" class="btn btn-primary"  />
            </div>
        </div>
</div>

</form>
</div>



<script type="text/javascript">
   //起点
    $(function() {
        var h_origin_city = $('#h_o_c').val();
        // 监听省select框
        $("#origin_first").change(function() {
            $('#origin_first_span').html('');
            $.ajax({
                type: "get",
                url: "index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=sysset.freightsetadd2",
                data: {"pnum": $(this).val(),"type":2},
                dataType: "json",
                success: function(data) {
                    //遍历json数据，组装下拉选框添加到html中
                    $("#origin_second").empty();
                    $("#origin_second").html("<option value='0'>请选择市</option>");
                    $("#origin_third").html("<option value='0'>请选择县</option>");
                    $("#map_span").html('');
                    $.each(data.result, function(i, item) {
                        if (item.id == h_origin_city){
                            $("#origin_second").append("<option selected  value='" + item.id + "'>" + item.name + "</option>");
                        } else {
                            $("#origin_second").append("<option value='" + item.id + "'>" + item.name + "</option>");
                        }


                    });
                }
            });
        });

        //监听市select框
        $("#origin_second").change(function() {
            $('#origin_second_sapn').html('');
            $.ajax({
                type: "get",
                url: "index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=sysset.freightsetadd2&type=3",
                data: {"cnum": $(this).val(),"type":3},
                dataType: "json",
                success: function(data) {
                    //遍历json数据，组装下拉选框添加到html中
                    $("#origin_third").html("<option value='0'>请选择县</option>");
                    $.each(data.result, function(i, item) {
                        $("#origin_third").append("<option value='" + item.id + "'>" + item.name + "</option>");
                    });
                }
            });
        });
    });

    //终点
    $(function() {
        //页面初始，加载所有的省份
        // 监听省select框
        $("#dest_first").change(function() {
            $('#dest_first_span').html('');
            $.ajax({
                type: "get",
                url: "index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=sysset.freightsetadd2",
                data: {"pnum": $(this).val(),"type":2},
                dataType: "json",
                success: function(data) {
                    //遍历json数据，组装下拉选框添加到html中
                    $("#dest_second").html("<option value=''>请选择市</option>");
                    $("#dest_third").html("<option value='0'>请选择县</option>");
                    $("#map_span").html('');
                    $.each(data.result, function(i, item) {
                        $("#dest_second").append("<option value='" + item.id + "'>" + item.name + "</option>");
                    });
                }
            });
        });

        //监听市select框
        $("#dest_second").change(function() {
            $('#dest_second_span').html('');
            $.ajax({
                type: "get",
                url: "index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=sysset.freightsetadd2&type=3",
                data: {"cnum": $(this).val(),"type":3},
                dataType: "json",
                success: function(data) {
                    //遍历json数据，组装下拉选框添加到html中
                    $("#dest_third").html("<option value='0'>请选择县</option>");
                    $.each(data.result, function(i, item) {
                        $("#dest_third").append("<option value='" + item.id + "'>" + item.name + "</option>");
                    });
                }
            });
        });
    });
    //获取表单数据
    $("#subbtn").click(function(){
        var data = {};
        var t = $('#form').serializeArray();
        var origin_pro = $('#origin_pro').val();
        var origin_first = $('#origin_first').val();
        var origin_second = $('#origin_second').val();
        var dest_pro = $('#dest_pro').val();
        var dest_first = $('#dest_first').val();
        var dest_second = $('#dest_second').val();
        var freight = $('#freight').val();

        var h_o_p = $('#h_o_p').val();
        var h_o_c = $('#h_o_c').val();
        var h_o_o = $('#h_o_o').val();
        var h_d_p = $('#h_d_p').val();
        var h_d_c = $('#h_d_c').val();
        var h_d_o = $('#h_d_o').val();
        var h_f = $('#h_f').val();
        if(origin_pro == h_o_p || origin_first== h_o_c || origin_second==h_o_o || dest_pro == h_d_p || dest_first == h_d_c || dest_second == h_d_o || freight == h_f){
            $('#sub_span').remove();
            $('#subbtn').after("<span id='sub_span' style='color: red'>数据没有改变</span>");
            return false;
        }
        //起始省
        if (!origin_first) {
            $('#origin_first_span').html('请选择');
            return false;
        }
        //起始市
        if (!origin_second && origin_first != 900000) {
            $('#origin_second_sapn').html('请选择');
            return false;
        }
        //终点省
        if (!dest_first) {
            $('#dest_first_span').html('请选择');
            return false;
        }
        //终点市
        if (!dest_second && origin_first != 900000) {
            $('#dest_second_span').html('请选择');
            return false;
        }

        //价格
        var pattern  = /^[1-9]\d*$/;
        if (!freight) {
            $('#freight_span').html('请填写');
            return false;
        }else if (!pattern.test(freight)){
            $('#freight_span').html('请填写正整数');
            return false;
        }else {
            $('#freight_span').html('')
        }
        $.each(t, function() {
            data [this.name] = this.value;
        });
        $.ajax({
            type: "post",
            url: "index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=sysset.updateadd",
            data: {"data":data},
            dataType: "json",
            success: function(data) {
                if (data.status == 0) {
                    $('#sub_span').remove();
                    $('#subbtn').after("<span id='sub_span' style='color: green'>修改成功</span>");
                }else {
                    $('#sub_span').remove();
                    $('#subbtn').after("<span id='sub_span' style='color: green'>修改失败</span>");
                }
            }
        })

    });

    //调用高德地图 查看大致路线
    $('#map').click(function(){
        var origin_first = $('#origin_first option:selected').text();
        var origin_second = $('#origin_second option:selected').text();
        var origin_third = $('#origin_third option:selected').text();
        var dest_first = $('#dest_first option:selected').text();
        var dest_second = $('#dest_second option:selected').text();
        var dest_third = $('#dest_third option:selected').text();
        var strategy = $("input[name='strategy']:checked").val();

        if (origin_first == '钓鱼岛' || dest_first == '钓鱼岛') {
            $('#map_span').html("当前路线无法驾车到达")
            return false;
        }
        //起始省
        if (origin_first == '请选择省') {
            $('#origin_first_span').html('请选择');
            return false;
        }else if (origin_second == '请选择市' && origin_first != "钓鱼岛") {
            //起始市
            $('#origin_second_sapn').html('请选择');
            return false;
        }else if (dest_first == '请选择省') {
            //终点省
            $('#dest_first_span').html('请选择');
            return false;
        }else if (dest_second == '请选择市' && dest_first != "钓鱼岛") {
            //终点市
            $('#dest_second_span').html('请选择');
            return false;
        }else {
            //调用地图页面
            window.open("index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=sysset.map&origin_second=" + origin_second + "&origin_third=" + origin_third + "&dest_second=" + dest_second + "&dest_third=" + dest_third+ "&strategy=" + strategy);
        }
    })

</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>