<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">当前位置：<span class="text-primary">运费详情</span></div>

<div class="page-content">

    <form action="./index.php" method="get" class="form-horizontal form-search" role="form">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="ewei_shopv2" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r"  value="sysset.freightset" />

        <div class="page-toolbar">
            <div class="pull-left">
                <?php if(cv('member.level.add')) { ?>
                    <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('sysset/freightsetadd')?>"><i class='fa fa-plus'></i> 添加路程运费</a>
                <?php  } ?>
            </div>
            <form action="">
            <div class="pull-right col-md-6">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name="enabled" id="enabled" class='form-control'>
                            <option class="a" selected="selected" value="1">起始位置</option>
                            <option class="a"  value="2">终点位置</option>
                            <option class="a"  value="3">运费</option>
                        </select>
                    </div>
                    <input type="text" class=" form-control" id="keyword" name='keyword' placeholder="请输入关键词">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" id=""> 搜索</button>
                    </span>
                </div>
            </div>
            </form>
        </div>
    </form>

    <?php  if(empty($addressInfo)) { ?>
        <div class="panel panel-default">
            <div class="panel-body empty-data">未查询到相关数据</div>
        </div>
    <?php  } else { ?>
        <form action="" method="post" >
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th style="width:240px;">起始位置</th>
                        <th style="width:240px;">终点位置</th>
                        <th style="width:240px;">运费</th>
                        <th style="width:240px;">添加时间</th>
                        <th style="width:240px;">操作</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php  if(is_array($addressInfo)) { foreach($addressInfo as $row) { ?>
                       <tr id=<?php  echo $row['f_id']?>>
                           <?php  if(!$row['f_origin_city'][0]['name']) { ?>
                                <td><?php  echo $row['f_origin_pro'][0]['name'];?></td>
                           <?php  } else if(!$row['f_origin_county'][0]['name']) { ?>
                                <td><?php  echo $row['f_origin_pro'][0]['name'];?>-<?php  echo $row['f_origin_city'][0]['name'];?></td>
                           <?php  } else { ?>
                                <td><?php  echo $row['f_origin_pro'][0]['name'];?>-<?php  echo $row['f_origin_city'][0]['name'];?>-<?php  echo $row['f_origin_county'][0]['name'];?></td>
                           <?php  } ?>

                           <?php  if(!$row['f_des_city'][0]['name']) { ?>
                           <td><?php  echo $row['f_des_pro'][0]['name'];?></td>
                           <?php  } else if(!$row['f_des_county'][0]['name']) { ?>
                           <td><?php  echo $row['f_des_pro'][0]['name'];?>-<?php  echo $row['f_des_city'][0]['name'];?></td>
                           <?php  } else { ?>
                           <td><?php  echo $row['f_des_pro'][0]['name'];?>-<?php  echo $row['f_des_city'][0]['name'];?>-<?php  echo $row['f_des_county'][0]['name'];?></td>
                           <?php  } ?>
                           <td><?php  echo $row['f_freight'];?>/Kg</td>
                           <td><?php  echo date("Y-m-d H:i:s", $row['f_add_time'])?></td>
                           <td>
                               <button class="btn btn-primary delete" type="button">删除</button>
                               <a class='btn btn-primary ' href="<?php  echo webUrl('sysset/update',array('id' => $row['f_id']))?>"> 修改</a>
                           </td>
                       </tr>
                    <?php  } } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right"><span id="num_span" class="pull-right" style="line-height: 28px;">(共<?php  echo count($addressInfo)?>条记录)</span></td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </form>
    <?php  } ?>
</div>


<script type="text/javascript">
    //删除
    $('.delete').click(function(){
        var id = $(this).parents('tr').attr('id');
        $.ajax({
            type: "post",
            url: "index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=sysset.del",
            data: {"id":id,},
            dataType: "json",
            success: function(data) {
                if (data.status == 0) {
                    window.location.reload();
                }
            }
        })
    })

    //搜索后默认选中
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return decodeURI(r[2]); return null; //返回参数值
    }
    var enabled = getUrlParam('enabled');
    var keyword = getUrlParam('keyword');
    var option ='';
    console.log(enabled);
    $('#keyword').val(keyword);
    if (enabled == 1) {
        option = "<option selected=" + "selected" + "value=1" + ">起始位置</option>" + "<option value=2" + ">终点位置</option>" + "<option  value=3>" + "运费</option>";
    } else if(enabled == 2) {
        option = "<option value='1'>起始位置</option>" + "<option selected='selected' value='2'>终点位置</option>" + "<option  value='3'>运费</option>";
    } else {
        option = "<option value='1'>起始位置</option>" + "<option  value='2'>终点位置</option>" + "<option selected='selected' value='3'>运费</option>";
    }
    $('#enabled').empty();
    $('#enabled').append(option);
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>     