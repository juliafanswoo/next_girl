<?php

class news_controller extends FS_controller {
    
	public function index()
    {
        $data = $this->data;

        $limitstart_Num = $this->input->get('limitstart');
        $limitcount_Num = $this->input->get('limitcount');
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : 10;

        $search_class_slug_Str = $this->input->get('class_slug');
        $class_ClassMeta = new ClassMeta();
        $class_ClassMeta->construct_db(array(
            'db_where_Arr' => array(
                'slug' => $search_class_slug_Str
            )
        ));
        
        $data['new_NoteFieldList'] = new ObjList();
        $data['new_NoteFieldList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => 'note'
            ),
            'db_where_or_Arr' => array(
                'classids' => array($class_ClassMeta->classid_Num)
            ),
            'model_name_Str' => 'NoteField',
            'db_orderby_Arr' => array(
                array('prioritynum', 'DESC'),
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'NoteField',
            'limitstart_Num' => $limitstart_Num,
            'limitcount_Num' => $limitcount_Num
        ));
        $data['page_link'] = $data['new_NoteFieldList']->create_links(array('base_url_Str' => 'news/'));
        
        $data['ClassMetaList'] = new ObjList();
        $data['ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => 'note'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        //global
		$data['global']['style'][] = 'style';
		$data['global']['style'][] = 'news';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//輸出模板
		$this->load->view('news/list', $data);
	}

    public function view()
    {
        $data = $this->data;

        $noteid_Num = $this->input->get('noteid');

        if(empty($noteid_Num))
        {
            $this->load->model('Message');
            $this->Message->show(array('message' => '產品連結輸入錯誤', 'url' => 'shop'));
        }
        
        $data['ClassMetaList'] = new ObjList();
        $data['ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => 'note'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        $data['new_NoteFieldList'] = new ObjList();
        $data['new_NoteFieldList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname' => 'note'
            ),
            'model_name_Str' => 'NoteField',
            'db_orderby_Arr' => array(
                array('prioritynum', 'DESC'),
                array('updatetime', 'DESC')
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'NoteField',
            'limitstart_Num' => 0,
            'limitcount_Num' => 5
        ));
            
        $noteid_Num = $this->input->get('noteid');

        $data['NoteField'] = new NoteField();
        $data['NoteField']->construct_db(array(
            'db_where_Arr' => array(
                'note.noteid' => $noteid_Num
            )
        ));
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'news';
        
        //temp
        $data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
        $data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
        $data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
        
        //輸出模板
        $this->load->view('news/view', $data);
    }

}

?>