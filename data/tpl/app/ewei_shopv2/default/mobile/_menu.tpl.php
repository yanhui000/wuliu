<?php defined('IN_IA') or exit('Access Denied');?><div class="fui-navbar">

    <a href="<?php  echo mobileUrl('member/fahuo')?>" class="external nav-item <?php  if($_W['routes']=='member.fahuo') { ?>active<?php  } ?>">
        <span class="icon icon-search2"></span>
        <span class="label">发货</span>
    </a>
    
    <?php  if(intval($_W['shopset']['category']['level'])!=-1) { ?>
  <!--  <a href="<?php  echo mobileUrl('member/callrecords')?>" class="external nav-item <?php  if($_W['routes']=='member.callrecords') { ?>active<?php  } ?>" >
        <span class="icon icon-ringpause"></span>
        <span class="label">通话记录</span>
    </a>-->
    <?php  } else { ?>
    <a href="<?php  echo mobileUrl('goods')?>" class="external nav-item <?php  if($_W['routes']=='goods') { ?>active<?php  } ?>" >
        <span class="icon icon-list"></span>
        <span class="label">全部商品</span>
    </a>
    <?php  } ?>
    
    <?php  if(!empty($commission)) { ?>
    <a href="<?php  echo mobileUrl('member/fahuo')?>" class="external nav-item <?php  if($_W['routes']=='member.fahuo') { ?>active<?php  } ?>" style="bottom: .6rem">
        <span class="icon icon-form" style="padding: .6rem; background-color: #F5F5F5; border-radius: 50%; border:2px solid #fff"></span>
        <span class="label" style="top:.5rem">发货</span>
    </a>
    <?php  } ?>
    <a href="<?php  echo mobileUrl('order')?>" class="external nav-item <?php  if($_W['routes']=='order') { ?>active<?php  } ?>" id="menucart">
        <span class="icon icon-dingdan1"></span>
        <span class="label">订单</span>
        <!-- <?php  if($cartcount>0) { ?><span class="badge"><?php  echo $cartcount;?></span><?php  } ?> -->
    </a>
    <a href="<?php  echo mobileUrl('member')?>" class="external nav-item <?php  if($_W['routes']=='member') { ?>active<?php  } ?>">
        <span class="icon icon-person2"></span>
        <span class="label">我的</span>
    </a>
</div>
