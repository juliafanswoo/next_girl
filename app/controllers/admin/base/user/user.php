<?php

class user_controller extends FS_controller {

    protected $child1_name_Str = 'base';
    protected $child2_name_Str = 'user';
    protected $child3_name_Str = 'user';

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
            
        $uid_Num = $this->input->get('uid');

        $data['user_UserFieldShop'] = new UserFieldShop();
        $data['user_UserFieldShop']->construct_db(array(
            'db_where_Arr' => array(
                'user.uid' => $uid_Num
            )
        ));

        if(empty($data['user_UserFieldShop']->uid_Num))
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '請先選擇欲修改的會員',
                'url' => 'admin/base/user/user/tablelist'
            ));
            return FALSE;
        }

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

    public function edit_post()
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
                'url' => 'admin/base/user/user/edit/?uid='.$uid_Num
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/base/user/user/edit/?uid='.$uid_Num
            ));
        }
    }

    public function edit_userfieldshop_post()
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
                'url' => 'admin/base/user/user/edit/?uid='.$uid_Num
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/base/user/user/edit/?uid='.$uid_Num
            ));
        }
    }

    public function edit_changepassword_post()
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
                    'url' => 'admin/base/user/user/edit/?uid='.$uid_Num
                ));
            }
            else
            {
                //送出成功訊息
                $this->load->model('Message');
                $this->Message->show(array(
                    'message' => $change_status_Bln,
                    'url' => 'admin/base/user/user/edit/?uid='.$uid_Num
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
                'url' => 'admin/base/user/user/edit/?uid='.$uid_Num
            ));
        }
    }

    public function tablelist()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'tablelist'//管理分類名稱
        )));

        $data['search_uid_Num'] = $this->input->get('uid');
        $data['search_username_Str'] = $this->input->get('username');
        $data['search_email_Str'] = $this->input->get('email');
        $data['search_group_groupid_Num'] = $this->input->get('group_groupid');

        $limitstart_Num = $this->input->get('limitstart');
        $limitcount_Num = $this->input->get('limitcount');
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : 20;

        $UserGroup = new UserGroup();
        $UserGroup->construct_db(array(
            'db_where_Arr' => array(
                'groupid_Num' => $data['search_group_groupid_Num']
            )
        ));

        $data['user_UserList'] = new ObjList();
        $data['user_UserList']->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $data['search_uid_Num']
            ),
            'db_where_like_Arr' => array(
                'username_Str' => $data['search_username_Str'],
                'email_Str' => $data['search_email_Str']
            ),
            'db_where_or_Arr' => array(
                'groupids' => array($UserGroup->groupid_Num)
            ),
            'db_orderby_Arr' => array(
                array('updatetime', 'DESC'),
                array('uid', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'User',
            'limitstart_Num' => $limitstart_Num,
            'limitcount_Num' => $limitcount_Num
        ));
        $data['product_links'] = $data['user_UserList']->create_links(array('base_url_Str' => 'admin/'.$data['child1_name_Str'].'/'.$data['child2_name_Str'].'/'.$data['child3_name_Str'].'/'.$data['child4_name_Str']));

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

    public function tablelist_post()
    {
        $data = $this->data;//取得公用數據

        $search_uid_Num = $this->input->post('search_uid_Num', TRUE);
        $search_username_Str = $this->input->post('search_username_Str', TRUE);
        $search_email_Str = $this->input->post('search_email_Str', TRUE);
        $search_group_groupid_Num = $this->input->post('search_group_groupid_Num', TRUE);

        $url_Str = base_url('admin/base/user/user/tablelist/?');

        if(!empty($search_uid_Num))
        {
            $url_Str = $url_Str.'&uid='.$search_uid_Num;
        }

        if(!empty($search_username_Str))
        {
            $url_Str = $url_Str.'&username='.$search_username_Str;
        }

        if(!empty($search_email_Str))
        {
            $url_Str = $url_Str.'&email='.$search_email_Str;
        }

        if(!empty($search_group_groupid_Num))
        {
            $url_Str = $url_Str.'&group_groupid='.$search_group_groupid_Num;
        }

        header("Location: $url_Str");
    }

    public function delete()
    {
        $hash_Str = $this->input->get('hash');
        $uid_Num = $this->input->get('uid');

        //CSRF過濾
        if($hash_Str == $this->security->get_csrf_hash())
        {
            $user_User = new UserFieldShop();
            $user_User->construct(array('uid_Num' => $uid_Num));
            $user_User->delete();

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除成功',
                'url' => 'admin/shop/product_shop/product/product_list'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/shop/product_shop/product/product_list'
            ));
        }
    }

}

?>