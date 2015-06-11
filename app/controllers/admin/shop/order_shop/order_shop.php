<?php

class order_shop_controller extends FS_controller {

    protected $child1_name_Str = 'shop';
    protected $child2_name_Str = 'order_shop';
    protected $child3_name_Str = 'order_shop';

    public function __construct()
    {
        parent::__construct();
        $data = $this->data;

        if($data['user']['uid'] == '')
        {
            $url = base_url('user/login/?url=admin');
            header('Location: '.$url);
        }

        $this->load->model('AdminModel');
        $this->AdminModel->child1_name_Str = $this->child1_name_Str;
        $this->AdminModel->child2_name_Str = $this->child2_name_Str;
        $this->AdminModel->child3_name_Str = $this->child3_name_Str;

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function edit()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'edit'//管理分類名稱
        )));

        $orderid_Num = $this->input->get('orderid');

        $data['OrderShop'] = new OrderShop();
        $data['OrderShop']->construct_db(array(
            'db_where_Arr' => array(
                'orderid_Num' => $orderid_Num
            )
        ));

        if(empty($data['OrderShop']->orderid_Num))
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '請先選擇欲修改的訂單',
                'url' => 'admin/shop/order_shop/order_shop/tablelist'
            ));
            return FALSE;
        }

        //global
        $data['global']['style'][] = 'admin';
        $data['global']['js'][] = 'script_common';
        $data['global']['js'][] = 'admin';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['admin_header_down'] = $this->load->view('admin/temp/admin_header_down', $data, TRUE);
        $data['temp']['admin_footer'] = $this->load->view('admin/temp/admin_footer', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);
    }

    public function edit_post()
    {
        $data = $this->data;//取得公用數據

        //基本post欄位
        $orderid_Num = $this->input->post('orderid_Num', TRUE);
        $paycheck_status_Num = $this->input->post('paycheck_status_Num', TRUE);
        $product_status_Num = $this->input->post('product_status_Num', TRUE);
        $receive_name_Str = $this->input->post('receive_name_Str', TRUE);
        $receive_phone_Str = $this->input->post('receive_phone_Str', TRUE);
        $receive_time_Str = $this->input->post('receive_time_Str');
        $receive_address_Str = $this->input->post('receive_address_Str');
        $receive_remark_Str = $this->input->post('receive_remark_Str', TRUE);
        $sendtime_Str = $this->input->post('sendtime_Str', TRUE);
        $order_status_Num = $this->input->post('order_status_Num', TRUE);

        //建構OrderShop物件，並且更新
        $OrderShop = new OrderShop();
        $OrderShop->construct(array(
            'orderid_Num' => $orderid_Num,
            'paycheck_status_Num' => $paycheck_status_Num,
            'product_status_Num' => $product_status_Num,
            'receive_name_Str' => $receive_name_Str,
            'receive_phone_Str' => $receive_phone_Str,
            'receive_time_Str' => $receive_time_Str,
            'receive_address_Str' => $receive_address_Str,
            'receive_remark_Str' => $receive_remark_Str,
            'sendtime_Str' => $sendtime_Str,
            'updatetime_Str' => '',
            'order_status_Num' => $order_status_Num
        ));
        $OrderShop->update(array(
            'db_update_Arr' => array(
                'paycheck_status',
                'product_status',
                'receive_name',
                'receive_phone',
                'receive_time',
                'receive_address',
                'receive_remark',
                'sendtime',
                'updatetime',
                'order_status'
            )
        ));

        //送出成功訊息
        $this->load->model('Message');
        $this->Message->show(array(
            'message' => '設定成功',
            'url' => 'admin/shop/order_shop/order_shop/tablelist'
        ));
    }

    public function tablelist()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'tablelist'//管理分類名稱
        )));

        $data['search_orderid_Num'] = $this->input->get('orderid');
        $data['search_title_Str'] = $this->input->get('title');
        $data['search_class_slug_Str'] = $this->input->get('class_slug');

        $limitstart_Num = $this->input->get('limitstart');
        $limitcount_Num = $this->input->get('limitcount');
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : 20;

        $data['OrderShopList'] = new ObjList();
        $data['OrderShopList']->construct_db(array(
            'db_where_Arr' => array(
                'orderid' => $data['search_orderid_Num'],
                'order_status !=' => -1
            ),
            'db_where_like_Arr' => array(
                'title' => $data['search_title_Str']
            ),
            'db_orderby_Arr' => array(
                array('setuptime', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'OrderShop',
            'limitstart_Num' => $limitstart_Num,
            'limitcount_Num' => $limitcount_Num
        ));
        $data['page_links'] = $data['OrderShopList']->create_links(array('base_url_Str' => 'admin/'.$data['child1_name_Str'].'/'.$data['child2_name_Str'].'/'.$data['child3_name_Str'].'/'.$data['child4_name_Str']));

        //view data設定
        $data['admin_sidebox'] = $this->AdminModel->reset_sidebox();

        //global
        $data['global']['style'][] = 'admin';
        $data['global']['js'][] = 'script_common';
        $data['global']['js'][] = 'admin';

        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['admin_header_down'] = $this->load->view('admin/temp/admin_header_down', $data, TRUE);
        $data['temp']['admin_footer'] = $this->load->view('admin/temp/admin_footer', $data, TRUE);

        //輸出模板
        $this->load->view('admin/'.$data['admin_child_url_Str'], $data);

    }

    public function tablelist_post()
    {
        $data = $this->data;//取得公用數據

        $search_orderid_Num = $this->input->post('search_orderid_Num', TRUE);
        $search_class_slug_Str = $this->input->post('search_class_slug_Str', TRUE);
        $search_title_Str = $this->input->post('search_title_Str', TRUE);

        $url_Str = base_url('admin/shop/product_shop/product/tablelist/?');

        if(!empty($search_orderid_Num))
        {
            $url_Str = $url_Str.'&orderid='.$search_orderid_Num;
        }

        if(!empty($search_class_slug_Str))
        {
            $url_Str = $url_Str.'&class_slug='.$search_class_slug_Str;
        }

        if(!empty($search_title_Str))
        {
            $url_Str = $url_Str.'&title='.$search_title_Str;
        }

        header("Location: $url_Str");
    }

    public function delete()
    {
        $hash_Str = $this->input->get('hash');
        $orderid_Num = $this->input->get('orderid');

        //CSRF過濾
        if($hash_Str == $this->security->get_csrf_hash())
        {
            $OrderShop = new OrderShop();
            $OrderShop->construct(array('orderid_Num' => $orderid_Num));
            $OrderShop->delete();

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除成功',
                'url' => 'admin/shop/order_shop/order_shop/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/shop/order_shop/order_shop/tablelist'
            ));
        }
    }

}

?>