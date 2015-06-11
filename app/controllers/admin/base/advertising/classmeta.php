<?php

class classmeta_controller extends FS_controller {

    protected $child1_name_Str = 'base';
    protected $child2_name_Str = 'advertising';
    protected $child3_name_Str = 'classmeta';

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

        //引入GET數值
        $classid_Num = $this->input->get('classid');
        $slug_Str = $this->input->get('slug');

        //初始化ClassMeta
        $data['ClassMeta'] = new ClassMeta();
        $data['ClassMeta']->construct_db(array(
            'db_where_Arr' => array(
                'classid_Num' => $classid_Num,
                'slug_Str' => $slug_Str
            ),
            'db_where_deletenull_Bln' => TRUE
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

        $this->form_validation->set_rules('classname_Str', 'classname_Str', 'required');

        if ($this->form_validation->run() !== FALSE)
        {
            $classid_Num = $this->input->post('classid_Num', TRUE);
            $classname_Str = $this->input->post('classname_Str', TRUE);
            $prioritynum_Num = $this->input->post('prioritynum_Num', TRUE);

            $class_ClassMeta = new ClassMeta();
            $class_ClassMeta->construct(array(
                'classid_Num' => $classid_Num,
                'classname_Str' => $classname_Str,
                'prioritynum_Num' => $prioritynum_Num,
                'modelname_Str' => 'advertising'
            ));
            $class_ClassMeta->update(array());

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/base/advertising/classmeta/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => validation_errors(),
                'url' => 'admin/base/advertising/classmeta/tablelist'
            ));
        }
    }

    public function tablelist()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'tablelist'//管理分類名稱
        )));

        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = !empty($limitcount) ? $limitcount : 20;
        $limitcount = $limitcount > 100 ? $limitcount : 100;

        $data['AdvertisingClassList'] = new ObjList();
        $data['AdvertisingClassList']->construct_db(array(
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'AdvertisingClass',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        $data['class_links'] = $data['AdvertisingClassList']->create_links(array('base_url_Str' => 'admin/'.$data['child1_name_Str'].'/'.$data['child2_name_Str'].'/'.$data['child3_name_Str'].'/'.$data['child4_name_Str']));

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

}