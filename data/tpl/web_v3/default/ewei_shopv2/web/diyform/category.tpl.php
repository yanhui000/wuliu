<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<div class="page-header">
    当前位置：
	<span class="text-primary">分类管理</span>
</div>
 <div class="page-content">
     <form action="" method="post" class="form-validate">
 
        <table class="table table-hover  table-responsive">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:60px;">ID</th>
                    <th>分类名称</th>
                    <th style="width: 45px;">操作</th>
                </tr>
            </thead>
            <tbody id='tbody-items'>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td><?php  echo $row['id'];?></td>
                    <td>
                        <?php if(cv('diyform.category.edit')) { ?>
                           <input type="text" class="form-control" name="catname[<?php  echo $row['id'];?>]" value="<?php  echo $row['name'];?>">
                        <?php  } else { ?>
                           <?php  echo $row['name'];?>
                        <?php  } ?>
                    </td>
                    <td>
                          <?php if(cv('diyform.category.edit')) { ?>
                            <a data-toggle="ajaxRemove" href="<?php  echo webUrl('diyform/category/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm btn-op btn-operation" data-confirm="确认删除此分类?">
                                 <span data-toggle="tooltip" data-placement="top" data-original-title="删除">
                                    <i class="icow icow-shanchu1"></i>
                                </span>
                            </a>
                        <?php  } ?>
                    </td>
                    </td>
                </tr>
                <?php  } } ?> 
            </tbody>
			
				<tr>
					<td colspan="3">
						  <?php if(cv('diyform.category.edit')) { ?>
            <input type="button" class="btn btn-default" value="添加分类" onclick='addCategory()'>
           <?php  } ?>
           <?php if(cv('diyform.category.edit')) { ?>
            <input type="submit" class="btn btn-primary" value="保存分类">
           <?php  } ?>
					</td>
				</tr>
        </table>
        <?php  echo $pager;?>
  
 
</form>
 </div>
<script>
    function addCategory(){
         var html ='<tr>';
         html+='<td><i class="fa fa-plus"></i></td>';
         html+='<td>';
         html+='<input type="text" class="form-control" name="catname[new]" value="">';
         html+='</td><td></td></tr>';;
         $('#tbody-items').append(html);
    }

</script>
 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>


<!--6Z2S5bKb5piT6IGU5LqS5Yqo572R57uc56eR5oqA5pyJ6ZmQ5YWs5Y+454mI5p2D5omA5pyJ-->