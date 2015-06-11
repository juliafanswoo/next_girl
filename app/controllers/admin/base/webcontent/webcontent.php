<?php
		
class Webcontent extends CI_Controller {
    
    private $data = array();
	private $father_name = 'webcontent';//管理分類名稱

	public function __construct()
	{
		parent::__construct();
        $this->data = $this->common_model->common();
        $data = $this->common_model->data;
        
		if($data['user']['uid'] == '')
		{
            $url = base_url('user/login/?url=admin');
			header('Location: '.$url);
		}
		
		$this->load->model('admin_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
    
	public function home($input = '')
	{
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'home'//管理分類名稱
        )));
		
		if($input == 'showroom')
        {
			$this->form_validation->set_rules('index_showroom_image', '首頁圖片');
			$this->form_validation->set_rules('index_showroom_content', '首頁文字');
            
			if ($this->form_validation->run() !== FALSE)
			{
                $index_showroom_image = $this->input->post('index_showroom_image', TRUE);
                $index_showroom_content = $this->input->post('index_showroom_content', TRUE);
                
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'index_showroom_image', 'value' => $index_showroom_image) );
				$this->setting_model->update(array());
                
                $this->setting_model->construct( array('keyword' => 'index_showroom_content', 'value' => $index_showroom_content) );
				$this->setting_model->update(array());
				
				$message = '設定成功';
			}
			else
			{
				$message = validation_errors();
			}
            $url = 'admin/webcontent/home';
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else if($input == 'activity')
        {
			$this->form_validation->set_rules('index_activity_image', '首頁圖片');
			$this->form_validation->set_rules('index_activity_content', '首頁文字');
            
			if ($this->form_validation->run() !== FALSE)
			{
                $index_activity_image = $this->input->post('index_activity_image', TRUE);
                $index_activity_content = $this->input->post('index_activity_content', TRUE);
                
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'index_activity_image', 'value' => $index_activity_image) );
				$this->setting_model->update(array());
                
                $this->setting_model->construct( array('keyword' => 'index_activity_content', 'value' => $index_activity_content) );
				$this->setting_model->update(array());
				
				$message = '設定成功';
			}
			else
			{
				$message = validation_errors();
			}
            $url = 'admin/webcontent/home';
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else if($input == 'news')
        {
			$this->form_validation->set_rules('index_news_image', '首頁圖片');
			$this->form_validation->set_rules('index_news_content', '首頁文字');
            
			if ($this->form_validation->run() !== FALSE)
			{
                $index_news_image = $this->input->post('index_news_image', TRUE);
                $index_news_content = $this->input->post('index_news_content', TRUE);
                
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'index_news_image', 'value' => $index_news_image) );
				$this->setting_model->update(array());
                
                $this->setting_model->construct( array('keyword' => 'index_news_content', 'value' => $index_news_content) );
				$this->setting_model->update(array());
				
				$message = '設定成功';
			}
			else
			{
				$message = validation_errors();
			}
            $url = 'admin/webcontent/home';
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else if($input == 'brand')
        {
			$this->form_validation->set_rules('index_brand_image', '首頁圖片');
			$this->form_validation->set_rules('index_brand_content', '首頁文字');
            
			if ($this->form_validation->run() !== FALSE)
			{
                $index_brand_image = $this->input->post('index_brand_image', TRUE);
                $index_brand_content = $this->input->post('index_brand_content', TRUE);
                
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'index_brand_image', 'value' => $index_brand_image) );
				$this->setting_model->update(array());
                
                $this->setting_model->construct( array('keyword' => 'index_brand_content', 'value' => $index_brand_content) );
				$this->setting_model->update(array());
				
				$message = '設定成功';
			}
			else
			{
				$message = validation_errors();
			}
            $url = 'admin/webcontent/home';
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else
		{
			$child_name = 'home';//管理分類類別名稱
			
			//沒有這個頁面
			if ( ! file_exists('app/views/admin/'.$this->father_name.'/'.$child_name.'.php'))
			{
				show_404();
			}
            
            $this->load->model('setting_list_model');
            $this->setting_list_model->db_construct( array('keyword' => array('index_showroom_image', 'index_showroom_content', 'index_activity_image', 'index_activity_content', 'index_news_image', 'index_news_content', 'index_brand_image', 'index_brand_content') ) );
            $data['setting_list_array'] = $this->setting_list_model->get_array();
				
			//view data設定
			$data['admin_sidebox'] = reset_admin_sidebox($this->father_name, $child_name);
			$data['child_name'] = $child_name;
        
            //global
            $data['global']['style'][] = 'admin';
			$data['global']['js'][] = 'script_common';
            
            //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
			$data['temp']['admin_header_down'] = $this->load->view('admin/temp/admin_header_down', $data, TRUE);
			$data['temp']['admin_footer'] = $this->load->view('admin/temp/admin_footer', $data, TRUE);
				
			//輸出模板
			$this->load->view('admin/'.$this->father_name.'/'.$child_name, $data);
		}
	}
	
	public function story($input = '')
	{
        $data = $this->data;//取得公用數據
        $data = array_merge($data, $this->AdminModel->get_data(array(
            'child4_name_Str' => 'story'//管理分類名稱
        )));
		
		if($input == 'story1')
        {
			$this->form_validation->set_rules('page_story_title1', '標題名稱', 'required');
			$this->form_validation->set_rules('page_story_text1', '副標題名稱', 'required');
			$this->form_validation->set_rules('page_story_content1', '文字內容', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $page_story_title1 = $this->input->post('page_story_title1', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'page_story_title1', 'value' => $page_story_title1) );
				$this->setting_model->update(array());
                
                $page_story_text1 = $this->input->post('page_story_text1', TRUE);
                $this->setting_model->construct( array('keyword' => 'page_story_text1', 'value' => $page_story_text1) );
				$this->setting_model->update(array());
                
                $page_story_content1 = $this->input->post('page_story_content1', TRUE);
                $this->setting_model->construct( array('keyword' => 'page_story_content1', 'value' => $page_story_content1) );
				$this->setting_model->update(array());
				
				$message = '設定成功';
			}
			else
			{
				$message = validation_errors();
					
			}
            $url = 'admin/webcontent/story';
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else if($input == 'story2')
        {
			$this->form_validation->set_rules('page_story_title2', '標題名稱', 'required');
			$this->form_validation->set_rules('page_story_text2', '副標題名稱', 'required');
			$this->form_validation->set_rules('page_story_content2', '文字內容', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $page_story_title2 = $this->input->post('page_story_title2', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'page_story_title2', 'value' => $page_story_title2) );
				$this->setting_model->update(array());
                
                $page_story_text2 = $this->input->post('page_story_text2', TRUE);
                $this->setting_model->construct( array('keyword' => 'page_story_text2', 'value' => $page_story_text2) );
				$this->setting_model->update(array());
                
                $page_story_content2 = $this->input->post('page_story_content2', TRUE);
                $this->setting_model->construct( array('keyword' => 'page_story_content2', 'value' => $page_story_content2) );
				$this->setting_model->update(array());
				
				$message = '設定成功';
			}
			else
			{
				$message = validation_errors();
			}
            $url = 'admin/webcontent/story';
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else if($input == 'story3')
        {
			$this->form_validation->set_rules('page_story_title3', '標題名稱', 'required');
			$this->form_validation->set_rules('page_story_text3', '副標題名稱', 'required');
			$this->form_validation->set_rules('page_story_content3', '文字內容', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $page_story_title3 = $this->input->post('page_story_title3', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'page_story_title3', 'value' => $page_story_title3) );
				$this->setting_model->update(array());
                
                $page_story_text3 = $this->input->post('page_story_text3', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'page_story_text3', 'value' => $page_story_text3) );
				$this->setting_model->update(array());
                
                $page_story_content3 = $this->input->post('page_story_content3', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'page_story_content3', 'value' => $page_story_content3) );
				$this->setting_model->update(array());
				
				$message = '設定成功';
			}
			else
			{
				$message = validation_errors();
			}
            $url = 'admin/webcontent/story';
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else if($input == 'story4')
        {
			$this->form_validation->set_rules('page_story_title4', '標題名稱', 'required');
			$this->form_validation->set_rules('page_story_text4', '副標題名稱', 'required');
			$this->form_validation->set_rules('page_story_content4', '文字內容', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $page_story_title4 = $this->input->post('page_story_title4', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'page_story_title4', 'value' => $page_story_title4) );
				$this->setting_model->update(array());
                
                $page_story_text4 = $this->input->post('page_story_text4', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'page_story_text4', 'value' => $page_story_text4) );
				$this->setting_model->update(array());
                
                $page_story_content4 = $this->input->post('page_story_content4', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'page_story_content4', 'value' => $page_story_content4) );
				$this->setting_model->update(array());
				
				$message = '設定成功';
			}
			else
			{
				$message = validation_errors();
			}
            $url = 'admin/webcontent/story';
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else
		{
			$child_name = 'story';//管理分類類別名稱
			
			//沒有這個頁面
			if ( ! file_exists('app/views/admin/'.$this->father_name.'/'.$child_name.'.php'))
			{
				show_404();
			}
				
            $this->load->model('setting_list_model');
            $this->setting_list_model->db_construct( array('keyword' => array(
                'page_story_title1',
                'page_story_text1',
                'page_story_content1',
                'page_story_title2',
                'page_story_text2',
                'page_story_content2',
                'page_story_title3',
                'page_story_text3',
                'page_story_content3',
                'page_story_title4',
                'page_story_text4',
                'page_story_content4'
            ) ) );
            $data['setting_list_array'] = $this->setting_list_model->get_array();
            
			//view data設定
			$data['admin_sidebox'] = reset_admin_sidebox($this->father_name, $child_name);
			$data['child_name'] = $child_name;
        
            //global
            $data['global']['style'][] = 'admin';
			$data['global']['js'][] = 'script_common';
            
            //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
			$data['temp']['admin_header_down'] = $this->load->view('admin/temp/admin_header_down', $data, TRUE);
			$data['temp']['admin_footer'] = $this->load->view('admin/temp/admin_footer', $data, TRUE);
				
			//輸出模板
			$this->load->view('admin/'.$this->father_name.'/'.$child_name, $data);
		}
	}
    
}

?>