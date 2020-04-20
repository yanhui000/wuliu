<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header" xmlns:border-top="http://www.w3.org/1999/xhtml">
    当前位置：<span class="text-primary">
    客服信息
</span>
</div>

<div class="page-content">


<form action="" method="post">
    <?php  if(count($list)>0) { ?>
    <div class="page-table-header">
        <div class="btn-group">
          
        
        </div>
    </div>
    <table class="table table-responsive" >
        <thead class="navbar-inner">
        <tr style="background: #f5f7f9; ">
            <th style="width:25px;"></th>
            <th>发表人</th>
          <th style="width:200px;">内容</th>
            <th >创建时间</th>
         
          <th style="width:200px;">操作</th>
        </tr>
        <tr></tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr>
            <td>
             <?php  echo $row['id'];?>
            </td>

         <td>
                <?php  echo $row['kf_mname'];?><br/>[<?php  echo $row['kf_mobile'];?>]
            </td>

            <td class="full">[<?php  echo $row['kf_text'];?>]</td>
            

            <td>
                <?php  echo date('Y-m-d', $row['kf_time'])?>
             
            </td>
          
           <td>
               <a href="http://wuliu.hsade.com/web/index.php?c=site&a=entry&m=ewei_shopv2&do=web&r=kefu.details&id=<?php  echo $row['id'];?>">查看详情</a>
             
            </td>
        </tr>

       
       
        <tr></tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
          
        </tfoot>
    </table>
    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何版块!
        </div>
    </div>
    <?php  } ?>

</form>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--4000097827-->