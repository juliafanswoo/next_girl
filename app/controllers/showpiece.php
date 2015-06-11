<?php

class showpiece_controller extends FS_controller {
    
	public function index()
	{
        $data = $this->data;

        $limitstart_Num = $this->input->get('limitstart');
        $limitcount_Num = $this->input->get('limitcount');
        $limitcount_Num = !empty($limitcount_Num) ? $limitcount_Num : 20;
        $data['classid_Num'] = $this->input->get('classid');

        //搜尋的標籤
        if(!empty($data['classid_Num']))
        {
            $data['search_class_ClassMeta'] = new ClassMeta();
            $data['search_class_ClassMeta']->construct_db([
                'db_where_Arr' => [
                    'classid' => $data['classid_Num']
                ]
            ]);
        }
        
        //建立熱門產品
        if(empty($data['classid_Num']))
        {
            $shop_hot_showpiece_Setting = new Setting();
            $shop_hot_showpiece_Setting->construct_db([
                'db_where_Arr' => [
                    'keyword' => 'shop_hot_showpiece'
                ]
            ]);
            $shop_hot_showpiece_Str = $shop_hot_showpiece_Setting->value_Str;
            $shop_hot_showpiece_Arr = explode(PHP_EOL, $shop_hot_showpiece_Str);

            $data['hot_ShowPieceList'] = new ObjList();
            $data['hot_ShowPieceList']->construct_db(array(
                'db_where_or_Arr' => array(
                    'showpieceid' => $shop_hot_showpiece_Arr
                ),
                'db_orderby_Arr' => array(
                    array('prioritynum', 'DESC'),
                    array('updatetime', 'DESC')
                ),
                'model_name_Str' => 'ShowPiece',
                'limitstart_Num' => 0,
                'limitcount_Num' => 9
            ));
        }
        
        //建立內容租賃產品
        $data['all_ShowPieceList'] = new ObjList();
        $data['all_ShowPieceList']->construct_db(array(
            'db_where_or_Arr' => array(
                'classids' => [$data['classid_Num']]
            ),
            'db_where_deletenull_Bln' => TRUE,
            'db_orderby_Arr' => array(
                array('prioritynum', 'DESC'),
                array('updatetime', 'DESC')
            ),
            'model_name_Str' => 'ShowPiece',
            'limitstart_Num' => $limitstart_Num,
            'limitcount_Num' => $limitcount_Num
        ));
        $data['showpiece_links'] = $data['all_ShowPieceList']->create_links(array(
            'base_url_Str' => 'showpiece'
        ));
        
        //建立租賃產品分類
        $data['class_ClassMetaList'] = new ObjList();
        $data['class_ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname_Str' => 'showpiece'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        //建立租賃產品分類2
        $data['class2_ClassMetaList'] = new ObjList();
        $data['class2_ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname_Str' => 'showpiece_class2'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        $data['wrap_name_Str'] = 'showpiece';
        
        //global
		$data['global']['style'][] = 'style';
		$data['global']['style'][] = 'showpiece/list';
        $data['global']['style'][] = 'shop_wrapsidebar';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
        $data['temp']['shop_wrapsidebar'] = $this->load->view('temp/shop_wrapsidebar', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//輸出模板
		$this->load->view('showpiece/list', $data);
	}
    
	public function view(){
        $data = $this->data;
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $showpieceid_Num = $this->input->get('showpieceid');
        
        $data['ShowPiece'] = new ShowPiece();
        if(!empty($showpieceid_Num))
        {
            $data['ShowPiece']->construct_db(array(
                'db_where_Arr' => array(
                    'showpieceid' => $showpieceid_Num
                )
            ));
        }
        
        if(empty($data['ShowPiece']->showpieceid_Num))
        {
            $Message = $this->load->model('Message');
            $Message->show(array('message' => '產品連結輸入錯誤', 'url' => 'showpiece'));
            return FALSE;
        }

        $data['classid_Num'] = $this->input->get('classid');
        
        $data['class_ClassMetaList'] = new ObjList();
        $data['class_ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname_Str' => 'showpiece'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        $data['class2_ClassMetaList'] = new ObjList();
        $data['class2_ClassMetaList']->construct_db(array(
            'db_where_Arr' => array(
                'modelname_Str' => 'showpiece_class2'
            ),
            'model_name_Str' => 'ClassMeta',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        $data['wrap_name_Str'] = 'showpiece';
        
        //global
		$data['global']['style'][] = 'style';
		$data['global']['style'][] = 'shop_wrapsidebar';
		$data['global']['style'][] = 'showpiece/view';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
        $data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
        $data['temp']['shop_wrapsidebar'] = $this->load->view('temp/shop_wrapsidebar', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//輸出模板
		$this->load->view('showpiece/view', $data);
	}
    
}

?>