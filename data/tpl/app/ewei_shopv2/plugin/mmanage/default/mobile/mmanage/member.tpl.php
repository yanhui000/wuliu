<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('mmanage/common', TEMPLATE_INCLUDEPATH)) : (include template('mmanage/common', TEMPLATE_INCLUDEPATH));?>

<div class='fui-page fui-page-current'>
    <div class="fui-header fui-header-success">
        <div class="fui-header-left">
            <a class="back"></a>
        </div>
        <div class="title">会员管理</div>
        <div class="fui-header-right">
            <a class="btn-more" style="display: none;">更多</a>
        </div>
    </div>
    <div class='fui-content navbar'>

        <!-- 搜索框 -->
        <div class="fui-searchbar bar">
            <div class="searchbar center">
                <input type="submit" class="searchbar-cancel searchbtn" value="搜索">
                <div class="search-input">
                    <i class="icon icon-search"></i>
                    <input type="search" placeholder="输入关键字..." class="search" name="keywords" id="keywords" />
                </div>
            </div>
        </div>

        <!-- 会员列表 -->
        <div class="fui-list-group nomargin container"></div>

        <div class="fui-title center" id="content-more">加载更多</div>
        <div class="fui-title center hide" id="content-empty">没有数据</div>
        <div class="fui-title center hide" id="content-nomore">没有更多了</div>
    </div>

    <div class="head-menu-mask"></div>
    <div class="head-menu">
        <a><i class="icon icon-creditlevel"></i> 会员等级</a>
        <a><i class="icon icon-group"></i> 会员分组</a>
        <a><i class="icon icon-rank"></i> 会员统计</a>
    </div>

    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('mmanage/_tpl/member', TEMPLATE_INCLUDEPATH)) : (include template('mmanage/_tpl/member', TEMPLATE_INCLUDEPATH));?>

    <script type="text/javascript" src="../addons/ewei_shopv2/plugin/mmanage/static/js/init.js?v=<?php  echo time()?>"></script>
    <script language="javascript">
        require(['../addons/ewei_shopv2/plugin/mmanage/static/js/member.js'],function(modal){
            modal.initList();
        });
    </script>

</div>
<?php  $this->footerMenus(null, $texts)?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
<!--913702023503242914-->