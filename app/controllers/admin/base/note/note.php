<?php

class note_controller extends FS_controller {

    protected $child1_name_Str = 'base';
    protected $child2_name_Str = 'note';
    protected $child3_name_Str = 'note';

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
            
        $noteid_Num = $this->input->get('noteid');

        $data['NoteField'] = new NoteField();
        $data['NoteField']->construct_db(array(
            'db_where_Arr' => array(
                'note.noteid' => $noteid_Num
            )
        ));

        $data['NoteClassMetaList'] = new ObjList();
        $data['NoteClassMetaList']->construct_db(array(
            'db_where_Arr' => [
                'modelname' => 'note'
            ],
            'model_name_Str' => 'ClassMeta',
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

        $this->form_validation->set_rules('title_Str', '文章標題', 'required');
        $this->form_validation->set_rules('content_Str', '文章內容', 'required');
        
        $noteid_Num = $this->input->post('noteid_Num', TRUE);

        if ($this->form_validation->run() !== FALSE)
        {
            //基本post欄位
            $title_Str = $this->input->post('title_Str', TRUE);
            $classids_Arr = $this->input->post('classids_Arr', TRUE);
            $content_Str = $this->input->post('content_Str');
            $prioritynum_Num = $this->input->post('prioritynum_Num', TRUE);

            //建構Note物件，並且更新
            $NoteField = new NoteField();
            $NoteField->construct(array(
                'noteid_Num' => $noteid_Num,
                'title_Str' => $title_Str,
                'classids_Arr' => $classids_Arr,
                'content_Str' => $content_Str,
                'prioritynum_Num' => $prioritynum_Num,
                'modelname_Str' => 'note'
            ));
            $NoteField->update();

            //送出成功訊息
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '設定成功',
                'url' => 'admin/base/note/note/tablelist/'
            ));
        }
        else
        {
            $validation_errors_Str = validation_errors();
            $validation_errors_Str = !empty($validation_errors_Str) ? $validation_errors_Str : '設定錯誤' ;
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => $validation_errors_Str,
                'url' => 'admin/base/note/note/edit/?noteid='.$noteid_Num
            ));
        }
    }

    public function tablelist()
    {
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'tablelist'//管理分類名稱
        )));

        $data['search_noteid_Num'] = $this->input->get('noteid');
        $data['search_title_Str'] = $this->input->get('title');
        $data['search_class_slug_Str'] = $this->input->get('class_slug');

        $limitstart_Num = $this->input->get('limitstart');
        $limitcount_Num = $this->input->get('limitcount');
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : 20;

        $class_ClassMeta = new ClassMeta();
        $class_ClassMeta->construct_db(array(
            'db_where_Arr' => array(
                'slug' => $data['search_class_slug_Str']
            )
        ));

        $data['NoteList'] = new ObjList();
        $data['NoteList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => 'note',
                'noteid' => $data['search_noteid_Num']
            ),
            'db_where_like_Arr' => array(
                'title_Str' => $data['search_title_Str']
            ),
            'db_where_or_Arr' => array(
                'classids' => array($class_ClassMeta->classid_Num)
            ),
            'db_orderby_Arr' => array(
                array('prioritynum', 'DESC'),
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'Note',
            'limitstart_Num' => $limitstart_Num,
            'limitcount_Num' => $limitcount_Num
        ));
        $data['page_link'] = $data['NoteList']->create_links(array('base_url_Str' => 'admin/'.$data['child1_name_Str'].'/'.$data['child2_name_Str'].'/'.$data['child3_name_Str'].'/'.$data['child4_name_Str']));

        $data['NoteClassMetaList'] = new ObjList();
        $data['NoteClassMetaList']->construct_db(array(
            'db_where_Arr' => [
                'modelname' => 'note'
            ],
            'model_name_Str' => 'ClassMeta',
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

        $search_noteid_Num = $this->input->post('search_noteid_Num', TRUE);
        $search_class_slug_Str = $this->input->post('search_class_slug_Str', TRUE);
        $search_title_Str = $this->input->post('search_title_Str', TRUE);

        $url_Str = base_url('admin/base/note/note/tablelist/?');

        if(!empty($search_noteid_Num))
        {
            $url_Str = $url_Str.'&noteid='.$search_noteid_Num;
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
        $noteid_Num = $this->input->get('noteid');

        //CSRF過濾
        if($hash_Str == $this->security->get_csrf_hash())
        {
            $Note = new Note();
            $Note->construct(array('noteid_Num' => $noteid_Num));
            $Note->delete();

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除成功',
                'url' => 'admin/base/note/note/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => 'hash驗證失敗，請使用標準瀏覽器進行刪除動作',
                'url' => 'admin/base/note/note/tablelist'
            ));
        }
    }

}

?>