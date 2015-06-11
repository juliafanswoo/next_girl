<?php

class order_controller extends FS_controller {

    protected $child1_name_Str = 'user';
    protected $child2_name_Str = 'order';
    protected $child3_name_Str = 'order';

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
                'url' => 'admin/user/order/order/tablelist'
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

        $orderid_Num = $this->input->post('orderid_Num', TRUE);

        $this->form_validation->set_rules('orderid_Num', '網站標題名稱', 'required');
        $this->form_validation->set_rules('pay_account_Str', '網站標題名稱', 'required');
        $this->form_validation->set_rules('pay_name_Str', '網站標題名稱', 'required');
        $this->form_validation->set_rules('pay_paytime_Str', '網站標題名稱', 'required');

        if ($this->form_validation->run() === TRUE)
        {
            //基本post欄位
            $pay_account_Str = $this->input->post('pay_account_Str', TRUE);
            $pay_name_Str = $this->input->post('pay_name_Str', TRUE);
            $pay_paytime_Str = $this->input->post('pay_paytime_Str', TRUE);
            $pay_remark_Str = $this->input->post('pay_remark_Str', TRUE);

            //建構OrderShop物件，並且更新
            $OrderShop = new OrderShop();
            $OrderShop->construct(array(
                'orderid_Num' => $orderid_Num,
                'pay_account_Str' => $pay_account_Str,
                'pay_name_Str' => $pay_name_Str,
                'pay_paytime_Str' => $pay_paytime_Str,
                'pay_remark_Str' => $pay_remark_Str,
                'pay_status_Num' => 1
            ));
            $OrderShop->update(array(
                'db_update_Arr' => array(
                    'pay_account',
                    'pay_name',
                    'pay_paytime',
                    'pay_remark',
                    'pay_status'
                )
            ));

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/user/order/order/tablelist'
            ));
        }
        else
        {
            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定失敗',
                'url' => 'admin/user/order/order/edit/?orderid='.$orderid_Num
            ));
        }
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
                'uid' => $data['user']['uid'],
                'orderid' => $data['search_orderid_Num'],
                'order_status !=' => -1
            ),
            'db_where_like_Arr' => array(
                'title' => $data['search_title_Str']
            ),
            'db_orderby_Arr' => array(
                array('orderid', 'DESC')
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

}

?>