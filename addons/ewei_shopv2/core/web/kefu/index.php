<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends WebPage
{
	public function main()
	{
		global $_W;
      header('location: ' . webUrl('kefu.remen'));die;
		
	}
	public function remen(){
    	global $_W;
      	global $_GPC;
      $list = pdo_fetchall('select * from ' . tablename('ewei_shop_member_kefu').' ORDER BY id DESC');

      include $this->template('kefu/index');
    }
  public function kuaixun(){
    	global $_W;
      	global $_GPC;
    $list = pdo_fetchall('select * from ' . tablename('ewei_shop_homepage').'where bid=2');
     include $this->template('homepage/index');
    }
  public function zhengce(){
    	global $_W;
      	global $_GPC;
    $list = pdo_fetchall('select * from ' . tablename('ewei_shop_homepage').'where bid=3');
     include $this->template('homepage/index');
    }
  public function xueyuan(){
    	global $_W;
      	global $_GPC;
    $list = pdo_fetchall('select * from ' . tablename('ewei_shop_homepage').'where bid=4');
     include $this->template('homepage/index');
   }
   public function add(){
    	global $_W;
      	global $_GPC;
     $managers = pdo_fetchall('select * from ' . tablename('ewei_shop_member'));
     include $this->template('homepage/add');
   }
  public function edit(){
  global $_W;
   global $_GPC;
    $managers = pdo_fetchall('select * from ' . tablename('ewei_shop_member'));
    $item = pdo_fetch('select * from ' . tablename('ewei_shop_homepage').'where id='.$_GPC['id']);
    if (!empty($item['images'])) {
			$piclist[0] = $item['images'];
		}
   // var_dump($item['images']);die;
    include $this->template('homepage/add');
  }
  public function delete1(){
  global $_W;
   global $_GPC;
    pdo_delete('ewei_shop_homepage', array('id' => $_GPC['id']));
    show_json(1, '删除成功');
  }
  public function submit(){
  		global $_W;
      	global $_GPC;
    	if(!empty($_GPC['id'])){
           $data['bid']=$_GPC['bid'];
          $data['title']=$_GPC['title'];
          $data['openid']=$_GPC['openid'];
          $data['images']=$_GPC['images'][0];
          $data['content']=$_GPC['content'];
          pdo_update('ewei_shop_homepage', $data, array('id' => $_GPC['id']));
          show_json(1,'修改成功');
        }else{
          $data['bid']=$_GPC['bid'];
          $data['title']=$_GPC['title'];
          $data['openid']=$_GPC['openid'];
          $data['images']=$_GPC['images'][0];
          $data['content']=$_GPC['content'];
          $data['ctime']=time();
          pdo_insert('ewei_shop_homepage', $data);
          show_json(1,'添加成功');
          //show_json(1, array('url' => webUrl('sns/posts/edit', array('id' => $id))));
          //pdo_update('ewei_shop_diyform_type', $insert, array('id' => $diysaveid));
        }
  }
  public function details(){
  global $_W;
   global $_GPC;
    $data = pdo_fetch('select * from ' . tablename('ewei_shop_member_kefu').'where id='.$_GPC['id']);
    $str='';
  
       if($data['kf_img']){
         $str.='<img src="'.tomedia($data["kf_img"]).'">';
     }
    if($data['kf_img1']){
                    $str.='<img src="'.tomedia($data["kf_img1"]).'">';
                  }
    if($data['kf_img2']){
                    $str.='<img src="'.tomedia($data["kf_img2"]).'">';
                  }
               
          
               
    include $this->template('kefu/details');
  //  echo 111;die;
  }
}

?>
