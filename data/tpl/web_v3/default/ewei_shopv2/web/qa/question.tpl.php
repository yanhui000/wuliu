<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">
    当前位置：<span class="text-primary">问题管理 </span>
</div>

<div class="page-content">
<form action="./index.php" method="get" class="form-horizontal" plugins="form">
    <input type="hidden" name="c" value="site">
    <input type="hidden" name="a" value="entry">
    <input type="hidden" name="m" value="ewei_shopv2">
    <input type="hidden" name="do" value="web">
    <input type="hidden" name="r" value="qa.question">
    <div class="page-toolbar  m-b-sm m-t-sm">
        <div class="col-sm-4">
             <span class=''>
                <?php if(cv('qa.question.add')) { ?>
                    <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('qa/question/add')?>"><i class="fa fa-plus"></i> 添加问题</a>
                <?php  } ?>
            </span>
        </div>
        <div class="col-sm-6 pull-right">
            <div class="input-group">
                <div class="input-group-select">
                    <select name="status" class="form-control" >
                        <option value="">显示</option>
                        <option value="1" <?php  if($_GPC['status']=='1') { ?> selected<?php  } ?>>是</option>
                        <option value="0" <?php  if($_GPC['status']=='0') { ?> selected<?php  } ?>>否</option>
                    </select>
                </div>
                <div class="input-group-select">
                    <select name="isrecommand" class="form-control ">
                        <option value="">推荐</option>
                        <option value="1" <?php  if($_GPC['isrecommand']=='1') { ?> selected<?php  } ?>>是</option>
                        <option value="0" <?php  if($_GPC['isrecommand']=='0') { ?> selected<?php  } ?>>否</option>
                    </select>
                </div>
                <div class="input-group-select">
                    <select name="cate" class="form-control ">
                        <option value="">问题分类</option>
                        <?php  if(is_array($category)) { foreach($category as $item) { ?>
                        <option value="<?php  echo $item['id'];?>" <?php  if(intval($_GPC['cate'])==$item['id']) { ?> selected<?php  } ?>><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <input type="text" class=" form-control" name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"> <span class="input-group-btn">
                <button class="btn  btn-primary" type="submit"> 搜索</button> </span>
            </div>
        </div>
    </div>
</form>

<?php  if(count($list)>0) { ?>
<form action="" method="post">
    <div class="page-table-header">
        <input type="checkbox">
        <div class="btn-group">
            <?php if(cv('qr.question.edit')) { ?>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch" data-href="<?php  echo weburl('qa/question/status', array('status'=>0))?>" disabled="disabled">
                <i class="icow icow-yincang"></i> 隐藏
            </button>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch" data-href="<?php  echo weburl('qa/question/status', array('status'=>1))?>" disabled="disabled">
                <i class="icow icow-xianshi"></i> 显示
            </button>
            <?php  } ?>
            <?php if(cv('qr.question.delete')) { ?>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-remove" data-confirm="确认要删除吗?" data-href="<?php  echo weburl('qr/question/delete')?>" disabled="disabled">
                <i class="icow icow-shanchu1"></i> 删除
            </button>
            <?php  } ?>
        </div>
    </div>
    <table class="table table-hover table-responsive">
        <thead class="navbar-inner">
            <tr>
                <th style="width:25px;">

                </th>
                <th style="width: 100px;">排序</th>
                <th >问题分类</th>
                <th>问题名称</th>
                <th style=" text-align: center;">推荐</th>
                <th style="width:70px; text-align: center;">状态</th>
                <th style="width: 125px;">操作</th>
            </tr>
        </thead>
        <tbody id="sort">
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
                <td><input type="checkbox" value="<?php  echo $row['id'];?>"></td>
                <td>
                    <?php if(cv('qa.question.edit')) { ?>
                    	<a href='javascript:;' data-toggle='ajaxEdit' data-href="<?php  echo webUrl('qa/question/displayorder',array('id'=>$row['id']))?>" ><?php  echo $row['displayorder'];?></a>
                    <?php  } else { ?>
                    	<?php  echo $row['displayorder'];?> 
                    <?php  } ?>
                </td>
                <td><?php  if($row['cate']==0) { ?>未分类<?php  } else { ?><?php  echo $row['catename'];?><?php  } ?></td>
                <td><?php  echo $row['title'];?></td>
                <td style="text-align: center;">
                    <span class='label <?php  if($row['isrecommand']==1) { ?>label-success<?php  } else { ?>label-default<?php  } ?>'
                    <?php if(cv('qa.question.edit')) { ?>
                    data-toggle='ajaxSwitch'
                    data-switch-value='<?php  echo $row['isrecommand'];?>'
                    data-switch-value0='0|否|label label-default|<?php  echo webUrl('qa/question/isrecommand',array('isrecommand'=>1,'id'=>$row['id']))?>'
                    data-switch-value1='1|是|label label-success|<?php  echo webUrl('qa/question/isrecommand',array('isrecommand'=>0,'id'=>$row['id']))?>'
                    <?php  } ?>
                    >
                    <?php  if($row['isrecommand']==1) { ?>是<?php  } else { ?>否<?php  } ?></span>
                </td>
                <td style="text-align: center;">
                    <span class="label <?php  if($row['status']==1) { ?>label-primary<?php  } else { ?>label-default<?php  } ?>"
                          <?php if(cv('qa.question.edit')) { ?>
	                          data-toggle='ajaxSwitch' 
	                          data-switch-value='<?php  echo $row['status'];?>'
	                          data-switch-value0='0|隐藏|label label-default|<?php  echo webUrl('qa/question/status',array('status'=>1,'id'=>$row['id']))?>'
	                          data-switch-value1='1|显示|label label-primary|<?php  echo webUrl('qa/question/status',array('status'=>0,'id'=>$row['id']))?>'
                          <?php  } ?>
                          >
                          <?php  if($row['status']==1) { ?>显示<?php  } else { ?>隐藏<?php  } ?></span>
                    </td>
                    <td style="text-align:left;">
                        <?php if(cv('qa.question.view|qa.question.edit')) { ?>
	                        <a href="<?php  echo webUrl('qa/question/edit', array('id' => $row['id']))?>" class="btn btn-default btn-sm btn-op btn-operation" title="<?php if(cv('qa.question.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>">
                                <span data-toggle="tooltip" data-placement="top" title="" data-original-title="  <?php if(cv('qa.question.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>">
                                       <?php if(cv('qa.question.edit')) { ?>
                                        <i class="icow icow-bianji2"></i>
                                        <?php  } else { ?>
                                        <i class="icow icow-chakan-copy"></i>
                                        <?php  } ?>
                                     </span>
	                        </a>
                        <?php  } ?>
                        <?php if(cv('qa.question.delete')) { ?> 
                        	<a data-toggle='ajaxRemove' href="<?php  echo webUrl('qa/question/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm btn-op btn-operation" data-confirm="确认删除此分类?" title="删除">
                                <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                                        <i class="icow icow-shanchu1"></i>
                                     </span>
                            </a>
                        <?php  } ?>
                        <a class="btn btn-default btn-sm js-clip btn-op btn-operation" title="" data-href="<?php  echo mobileUrl('qa/detail', array('id'=>$row['id']), true)?>">
                             <span data-toggle="tooltip" data-placement="top" title="" data-original-title="复制链接">
                                        <i class="icow icow-lianjie2"></i>
                                     </span>
                        </a>

                        <a href="javascript:void(0);" class="btn btn-default btn-sm btn-op btn-operation" data-toggle="popover" data-trigger="hover" data-html="true" data-content="<img src='<?php  echo $row['qrcode'];?>' width='130' alt='链接二维码'>" data-placement="auto right">
                            <i class="icow icow-erweima3"></i>
                        </a>
                    </td>
                </tr>
                <?php  } } ?> 
            </tbody>
            <tfoot>
                <tr>
                    <td><input type="checkbox"></td>
                    <td colspan="2">
                        <div class="btn-group">
                            <?php if(cv('qr.question.edit')) { ?>
                            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch" data-href="<?php  echo weburl('qa/question/status', array('status'=>0))?>" disabled="disabled">
                                <i class="icow icow-yincang"></i> 隐藏
                            </button>
                            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch" data-href="<?php  echo weburl('qa/question/status', array('status'=>1))?>" disabled="disabled">
                                <i class="icow icow-xianshi"></i> 显示
                            </button>
                            <?php  } ?>
                            <?php if(cv('qr.question.delete')) { ?>
                            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle="batch-remove" data-confirm="确认要删除吗?" data-href="<?php  echo weburl('qr/question/delete')?>" disabled="disabled">
                                <i class="icow icow-shanchu1"></i> 删除
                            </button>
                            <?php  } ?>
                        </div>
                    </td>
                    <td colspan="4" class="text-right"> <?php  echo $pager;?></td>
                </tr>
            </tfoot>
        </table>
        <?php  } else { ?>
        <div class='panel panel-default'>
            <div class='panel-body' style='text-align: center;padding:30px;'>
                未找到相关问题
            </div>
        </div>
            <?php  } ?>
    </form>
</div>

    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>


<!--6Z2S5bKb5piT6IGU5LqS5Yqo572R57uc56eR5oqA5pyJ6ZmQ5YWs5Y+454mI5p2D5omA5pyJ-->