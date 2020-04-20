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
            <div class="pull-right col-md-6">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name="enabled" id="enabled" class='form-control'>
                            <option value="0">起始位置</option>
                            <option value="1">终点位置</option>
                            <option value="2">运费</option>
                        </select>
                    </div>
                    <input type="text" class=" form-control" id="keyword" name='keyword' placeholder="请输入关键词">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" id="soso" type="button"> 搜索</button>
                    </span>
                </div>
            </div>
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
            <tbody id="tbody">
            <?php  if(is_array($addressInfo)) { foreach($addressInfo as $row) { ?>
            <tr>
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
                <td>[删除][修改]</td>
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
    $('#soso').click(function(){
        //选择
        var enabled = $('#enabled').val();
        //文本
        var keyword = $('#keyword').val();
        var data = new Array();
        data['enablad'] = enabled;
        data['keyword'] = keyword;
        if (keyword == ''){
            $("#keyword").removeAttr("placeholder");
            $("#keyword").attr("placeholder","请填写");
            $("#keyword").attr("style","border-color:red");
            return false;
        }
        var tbody;
        $.ajax({
            type: "post",
            url: "index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=sysset.soso",
            data: {"enabled":enabled,"keyword":keyword},
            dataType: "json",
            success: function(data) {
                if (data.status == 0) {
                    $('#tbody').empty('tr');
                    $('#num_span').remove();
                    $.each(data,function(key,val){

                        console.log(val);
                    })
                }
                // console.log(data.result);
                $("#keyword").removeAttr("style");
            }
        })
    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>     