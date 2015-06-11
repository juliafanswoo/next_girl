<?php

class product_controller extends FS_controller {

    protected $child1_name_Str = 'shop';
    protected $child2_name_Str = 'store';
    protected $child3_name_Str = 'product';

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

    public function hot()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'hot'//管理分類名稱
        )));

        $shop_hot_product_Setting = new Setting();
        $shop_hot_product_Setting->construct_db([
            'db_where_Arr' => [
                'keyword' => 'shop_hot_product'
            ]
        ]);
        $data['global']['shop_hot_product'] = $shop_hot_product_Setting->value_Str;

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

    public function hot_post()
    {

            $shop_hot_product = $this->input->post('shop_hot_product', TRUE);

            $SettingList = new SettingList();
            $SettingList->construct([
                'construct_Arr' => [
                    [
                        'keyword_Str' => 'shop_hot_product',
                        'value_Str' => $shop_hot_product,
                        'modelname_Str' => 'shop'
                    ]
                ]
            ]);
            $SettingList->update();

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/shop/store/product/hot'
            ));
    }

}

?>