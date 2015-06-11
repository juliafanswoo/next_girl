<?php

class user_controller extends FS_controller
{
	
	public function index()
	{
		$url = base_url('user/login');
		header('Location: '.$url);
	}
	
	public function logout()
	{
		$this->session->unset_userdata('uid');
		$url = 'user/login';
		$message = '登出成功';
		
		$this->load->model('Message');
		$this->Message->show(array('message' => $message, 'url' => $url));
	}
	
	//註冊會員
	public function register()
	{
        $data = $this->data;

		if(!empty($data['user']['uid']))
		{
			$url_Str = base_url('page/index');
			header('Location: '.$url_Str);
		}
        
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//view data設定
		$data['validation_errors'] = validation_errors();
		$data['page'] = 'user';
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'user';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//輸出模板
		$this->load->view('user/register.php', $data);
	}
	
	public function register_post()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email_Str', 'email', 'required');
		$this->form_validation->set_rules('password_Str', '密碼', 'required');
		$this->form_validation->set_rules('password2_Str', '密碼', 'required');
		
		if ($this->form_validation->run() !== FALSE)
		{
			$email_Str = $this->input->post('email_Str', TRUE);
			$password_Str = $this->input->post('password_Str', TRUE);
			$password2_Str = $this->input->post('password2_Str', TRUE);

			$User = new User();
			$register_status = $User->register(array(
				'email_Str' => $email_Str,
				'password_Str' => $password_Str,
				'password2_Str' => $password2_Str
			));
			if($register_status === TRUE)
			{
				$url_Str = 'page/index';
				$message_Str = "註冊成功";
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
			}
			else
			{
				$url_Str = 'user/register';
				$message_Str = $register_status;
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
			}
		}
		else
		{
			$url_Str = 'user/register';
			$message = validation_errors();
			
			$this->load->model('Message');
			$this->Message->show(array('message' => $message, 'url' => $url_Str));
		}
	}
	
	public function login()
	{
        $data = $this->data;

		$this->load->library('form_validation');

		if(!empty($data['user']['uid']))
		{
			$url_Str = base_url('page/index');
			header('Location: '.$url_Str);
		}

        $data['url_Str'] = $this->input->get('url');

        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'user';
            
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
				
		//輸出模板
		$this->load->view('user/login.php', $data);
	}
	
	public function login_post()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email_Str', 'email', 'required');
		$this->form_validation->set_rules('password_Str', '密碼', 'required');
		
		if ($this->form_validation->run() !== FALSE)
		{
			$url_Str = $this->input->post('url_Str', TRUE);
			$email_Str = $this->input->post('email_Str', TRUE);
			$password_Str = $this->input->post('password_Str', TRUE);

			$User = new User();
			$login_status = $User->login(array(
				'email_Str' => $email_Str,
				'password_Str' => $password_Str
			));
			if($login_status === TRUE)
			{
				if(empty($url_Str))
				{
					$url_Str = 'page/index';
				}
				$url_Str = base_url($url_Str);
				header("Location: $url_Str");
			}
			else
			{
				$url_Str = 'user/login';
				$message_Str = $login_status;
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
			}
		}
		else
		{
			$url_Str = 'user/login';
			$message_Str = validation_errors();
			
			$this->load->model('Message');
			$this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
		}
	}
	
	//忘記密碼
	public function forgetpsw()
	{
        $data = $this->data;
        
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//view data設定
		$data['validation_errors'] = validation_errors();
		$data['page'] = 'user';
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'user';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//輸出模板
		$this->load->view('user/forgetpsw.php', $data);
	}
	
	//忘記密碼
	public function forgetpsw_post()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email_Str', 'email', 'required');
		
		if($this->form_validation->run() !== FALSE)
		{
			$email_Str = $this->input->post('email_Str', TRUE);

			$User = new User();
			$User->construct_db([
				'db_where_Arr' => [
					'email_Str' => $email_Str
				]
			]);
			$return_message = $User->send_change_password_email();

			if($return_message === TRUE)
			{
				$url_Str = 'user/login';
				$message_Str = '請至信箱收取信件，並重新登入';
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
			}
			else
			{
				$url_Str = 'user/forgetpsw';
				$message_Str = $return_message;
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message_Str, 'url' => $url_Str, 'second' => 6));
			}
		}
		else
		{
			$url_Str = 'user/forgetpsw';
			$message_Str = validation_errors();
			
			$this->load->model('Message');
			$this->Message->show(array('message' => $message_Str, 'url' => $url_Str));
		}
	}
	
	public function resetpsw()
	{
		//使用由email收到的的email_key進行驗證，若驗證成功即可更改密碼
        $data = $this->data;

        $data['email_Str'] = $this->input->get('email');
        $data['change_email_key_Str'] = $this->input->get('change_email_key');
        
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//view data設定
		$data['validation_errors'] = validation_errors();
		$data['page'] = 'user';
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'user';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//輸出模板
		$this->load->view('user/resetpsw', $data);

	}

	public function resetpsw_post()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email_Str', 'email', 'required');
		$this->form_validation->set_rules('change_email_key_Str', 'email key', 'required');
		$this->form_validation->set_rules('password_Str', 'password', 'required');
		$this->form_validation->set_rules('password2_Str', 'password', 'required');

		$email_Str = $this->input->post('email_Str', TRUE);
		$change_email_key_Str = $this->input->post('change_email_key_Str', TRUE);
		$password_Str = $this->input->post('password_Str', TRUE);
		$password2_Str = $this->input->post('password2_Str', TRUE);
		
		if($this->form_validation->run() !== FALSE)
		{
			$User = new User();
			$User->construct_db([
				'db_where_Arr' => [
					'email_Str' => $email_Str
				]
			]);
			$return_message_Str = $User->email_reset_password([
				'password_Str' => $password_Str,
				'password2_Str' => $password2_Str,
				'change_email_key_Str' => $change_email_key_Str
			]);

			if($return_message_Str === TRUE)
			{
				$url_Str = base_url('user/login');
				$message = '密碼變更成功，請重新登入';
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message, 'url' => $url_Str));
			}
			else
			{
				$url_Str = base_url('user/resetpsw/?email='.$email_Str.'&change_email_key='.$change_email_key_Str);
				$message = $return_message_Str;
				
				$this->load->model('Message');
				$this->Message->show(array('message' => $message, 'url' => $url_Str, 'second' => 6));
			}
		}
		else
		{
			$url_Str = base_url('user/resetpsw/?email='.$email_Str.'&change_email_key='.$change_email_key_Str);
			$message = validation_errors();
			
			$this->load->model('Message');
			$this->Message->show(array('message' => $message, 'url' => $url_Str));
		}
	}
	
}

?>