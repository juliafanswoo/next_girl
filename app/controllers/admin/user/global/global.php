<?php

class global_controller extends FS_controller {

    protected $child1_name_Str = 'user';
    protected $child2_name_Str = 'global';
    protected $child3_name_Str = 'global';

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

    public function user()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'user'//管理分類名稱
        )));

        $data['user_UserFieldShop'] = new UserFieldShop();
        $data['user_UserFieldShop']->construct_db(array(
            'db_where_Arr' => array(
                'user.uid' => $data['user']['uid']
            )
        ));

        $data['UserGroupList'] = new ObjList();
        $data['UserGroupList']->construct_db(array(
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'UserGroup',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

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

    public function user_post()
    {
        $data = $this->data;//取得公用數據

        $this->form_validation->set_rules('username_Str', '會員名稱', 'required');
        $uid_Num = $this->input->post('uid_Num', TRUE);

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $username_Str = $this->input->post('username_Str', TRUE);

            //建構User物件，並且更新
            $UserFieldShop = new UserFieldShop();
            $UserFieldShop->construct(array(
                'uid_Num' => $uid_Num,
                'username_Str' => $username_Str
            ));
            $UserFieldShop->update(array(
                'db_update_Arr' => array(
                    'user.username', 'user.updatetime'
                )
            ));

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/user/global/global/user'
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/user/global/global/user'
            ));
        }
    }

    public function user_userfieldshop_post()
    {
        $data = $this->data;//取得公用數據

        $this->form_validation->set_rules('receive_name_Str', '常用收件人姓名', 'required');
        $this->form_validation->set_rules('receive_phone_Str', '常用收件人電話', 'required');
        $this->form_validation->set_rules('receive_address_Str', '常用收件人地址', 'required');
        $uid_Num = $this->input->post('uid_Num', TRUE);

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $receive_name_Str = $this->input->post('receive_name_Str', TRUE);
            $receive_phone_Str = $this->input->post('receive_phone_Str', TRUE);
            $receive_address_Str = $this->input->post('receive_address_Str', TRUE);

            //建構User物件，並且更新
            $UserFieldShop = new UserFieldShop();
            $UserFieldShop->construct(array(
                'uid_Num' => $uid_Num,
                'receive_name_Str' => $receive_name_Str,
                'receive_phone_Str' => $receive_phone_Str,
                'receive_address_Str' => $receive_address_Str
            ));
            $UserFieldShop->update(array(
                'db_update_Arr' => array(
                    'user_field_shop.receive_name',
                    'user_field_shop.receive_phone',
                    'user_field_shop.receive_address'
                )
            ));

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/user/global/global/user'
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/user/global/global/user'
            ));
        }
    }

    public function user_changepassword_post()
    {
        $data = $this->data;//取得公用數據

        $this->form_validation->set_rules('password_Str', '會員密碼', 'required');
        $this->form_validation->set_rules('password2_Str', '會員密碼', 'required');
        $uid_Num = $this->input->post('uid_Num', TRUE);

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $password_Str = $this->input->post('password_Str', TRUE);
            $password2_Str = $this->input->post('password2_Str', TRUE);

            //建構User物件，並且更新
            $User = new User();
            $User->construct(array(
                'uid_Num' => $uid_Num
            ));
            $change_status_Bln = $User->change_password(array(
                'password_Str' => $password_Str,
                'password2_Str' => $password2_Str
            ));

            if($change_status_Bln === TRUE)
            {
                //送出成功訊息
                $this->load->model('Message');
                $this->Message->show(array(
                    'message' => '密碼變更成功',
                    'url' => 'admin/user/global/global/user'
                ));
            }
            else
            {
                //送出成功訊息
                $this->load->model('Message');
                $this->Message->show(array(
                    'message' => $change_status_Bln,
                    'url' => 'admin/user/global/global/user'
                ));
            }
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/user/global/global/user'
            ));
        }
    }

}

?>