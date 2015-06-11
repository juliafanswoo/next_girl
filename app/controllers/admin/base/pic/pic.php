<?php

class pic_controller extends FS_Controller {

    protected $child1_name_Str = 'base';
    protected $child2_name_Str = 'pic';
    protected $child3_name_Str = 'pic';
    
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

        $picid_Num = $this->input->get('picid');
            
        $data['PicObj'] = new PicObj();
        $data['PicObj']->construct_db(array(
        	'db_where_Arr' => array(
        		'picid_Num' => $picid_Num
        	)
        ));
        // echoe($data['PicObj']->picid_Num);
            
        $data['ClassMetaList'] = new ObjList();
        $data['ClassMetaList']->construct_db(array(
        	'db_where_Arr' => array(
        		'uid_Str' => $data['user']['uid'],
        		'modelname' => 'pic'
        	),
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

		$picid_Num = $this->input->post('picid_Num');
        $classids_Arr = $this->input->post('classids_Arr');

		if(!empty($picid_Num))
		{
		    $PicObj = new PicObj();
		    $PicObj->construct_db(array(
		    	'db_where_Arr' => array(
		        	'picid_Num' => $picid_Num
		        )
		    ));
            $PicObj->class_ClassMetaList = new ObjList();
            $PicObj->class_ClassMetaList->construct_db(array(
                'db_where_or_Arr' => array(
                    'classid' => $classids_Arr
                ),
                'db_from_Str' => 'class',
                'model_name_Str' => 'ClassMeta',
                'limitstart_Num' => 0,
                'limitcount_Num' => 100
            ));
            $PicObj->updatetime_DateTime = new DateTimeObj();
		    $PicObj->updatetime_DateTime->construct(array());
		    $PicObj->update(array());

			$this->load->model('Message');
			$this->Message->show(array(
			    'message' => '設定成功',
			    'url' => 'admin/base/pic/pic/tablelist'
			));
		}
		else
		{
	        $picfile_FileArr = $this->input->file('picfile_FileArr');
		    if(!empty($picfile_FileArr))
		    {
		        $PicObj = new PicObj();
		        $PicObj->construct(array(
		           	'picfile_FileArr' => $picfile_FileArr,
                    'classids_Arr' => $classids_Arr,
		            'thumb_Str' => 'w50h50,w300h300'
		        ));
		        $PicObj->upload();

			    $this->load->model('Message');
			    $this->Message->show(array(
			        'message' => '設定成功',
			        'url' => 'admin/base/pic/pic/tablelist'
			    ));
		    }
		    else
		    {
			    $this->load->model('Message');
			    $this->Message->show(array(
			        'message' => '設定失敗',
			        'url' => 'admin/base/pic/pic/tablelist'
			    ));
		    }
		}
	        

	}
	
	public function tablelist()
	{
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'tablelist'//管理分類名稱
        )));

		$limitstart_Num = $this->input->get('limitstart');
        $limitcount_Num = $this->input->get('limitcount');
        $limitcount_Num = empty($limitcount_Num) ? 20 : $limitcount_Num;
        $limitcount_Num = $limitcount_Num > 100 ? 100 : $limitcount_Num;

        $data['search_class_slug_Str'] = $this->input->get('class_slug');
        $data['search_title_Str'] = $this->input->get('title');
        $data['search_picid_Num'] = $this->input->get('picid');

        $class_ClassMeta = new ClassMeta();
        $class_ClassMeta->construct_db(array(
            'db_where_Arr' => array(
                'uid_Str' => $data['user']['uid'],
                'slug_Str' => $data['search_class_slug_Str']
            ),
            'db_where_deletenull_Bln' => FALSE
        ));

        $data['piclist_PicList'] = $this->load->model('ObjList', nrnum());
        $data['piclist_PicList']->construct_db(array(
            'db_where_Arr' => array(
                'picid_Num' => $data['search_picid_Num'],
                'uid_Num' => $data['user']['uid'],
            ),
            'db_where_like_Arr' => array(
                'title_Str' => $data['search_title_Str']
            ),
            'db_where_or_Arr' => array(
                'classids_Str' => array($class_ClassMeta->classid_Num)
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'PicObj',
            'db_orderby_Arr' => array(
                array('prioritynum', 'DESC'),
                array('updatetime', 'DESC')
            ),
            'limitstart_Num' => $limitstart_Num,
            'limitcount_Num' => $limitcount_Num
      	));
        $data['pic_links'] = $data['piclist_PicList']->create_links(array('base_url_Str' => "admin/base/pic/pic/tablelist/?class_slug=$data[search_class_slug_Str]"));

        $data['pic_ClassMetaList'] = $this->load->model('ObjList', nrnum());
        $data['pic_ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'uid_Num' => $data['user']['uid'],
                'modelname' => 'pic'
            ),
            'db_where_deletenull_Bln' => TRUE,
            'model_name_Str' => 'ClassMeta',
            'db_orderby_Arr' => array(
                array('prioritynum', 'DESC'),
                array('updatetime', 'DESC')
            ),
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
        $data = $this->data;

        $search_picid_Num = $this->input->post('search_picid_Num', TRUE);
        $search_title_Str = $this->input->post('search_title_Str', TRUE);
        $search_class_slug_Str = $this->input->post('search_class_slug_Str', TRUE);

        $url_Str = base_url('admin/base/pic/pic/tablelist/?');

        if(!empty($search_picid_Num))
        {
            $url_Str = $url_Str.'&picid='.$search_picid_Num;
        }

        if(!empty($search_title_Str))
        {
            $url_Str = $url_Str.'&title='.$search_title_Str;
        }

        if(!empty($search_class_slug_Str))
        {
            $url_Str = $url_Str.'&class_slug='.$search_class_slug_Str;
        }

        header("Location: $url_Str");
    }
	
    public function delete()
    {
        $hash_Str = $this->input->get('hash');
        $picid_Num = $this->input->get('picid');

        //CSRF過濾
        if($hash_Str == $this->security->get_csrf_hash())
        {
            $PicObj = new PicObj();
            $PicObj->construct(array(
            	'picid_Num' => $picid_Num
            ));
            $PicObj->delete();

            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除成功',
	        	'url' => 'admin/base/pic/pic/tablelist'
            ));
        }
        else
        {
            $this->load->model('Message');
            $this->Message->show(array(
                'message' => '刪除失敗',
	        	'url' => 'admin/base/pic/pic/tablelist'
            ));
        }
    }

}

?>