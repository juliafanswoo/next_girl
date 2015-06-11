<?php

class User extends ObjDbBase {

    public $uid_Num = 0;
    public $username_Str = '';
    public $email_Str = '';
    public $pic_PicObjList;//照片類別列表
    public $group_UserGroupList;//分類標籤類別列表
    public $updatetime_DateTime;
    public $status_Num = 1;
    public $db_name_Str = 'user';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'uid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'uid' => 'uid_Num',
        'username' => 'username_Str',
        'email' => 'email_Str',
        'picids' => array('pic_PicObjList', 'uniqueids_Str'),
        'groupids' => array('group_UserGroupList', 'uniqueids_Str'),
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        
        //取得引數
        $uid_Num = !empty($arg['uid_Num']) ? $arg['uid_Num'] : 0;
        $username_Str = !empty($arg['username_Str']) ? $arg['username_Str'] : '';
        $email_Str = !empty($arg['email_Str']) ? $arg['email_Str'] : '';
        $picids_Str = !empty($arg['picids_Str']) ? $arg['picids_Str'] : '';
        $picids_Arr = !empty($arg['picids_Arr']) ? $arg['picids_Arr'] : array();
        $groupids_Str = !empty($arg['groupids_Str']) ? $arg['groupids_Str'] : '';
        $groupids_Arr = !empty($arg['groupids_Arr']) ? $arg['groupids_Arr'] : array();
        $updatetime_Str = !empty($arg['updatetime_Str']) ? $arg['updatetime_Str'] : '';
        $updatetime_inputtime_date_Str = !empty($arg['updatetime_inputtime_date_Str']) ? $arg['updatetime_inputtime_date_Str'] : '';
        $updatetime_inputtime_time_Str = !empty($arg['updatetime_inputtime_time_Str']) ? $arg['updatetime_inputtime_time_Str'] : '';
        $status_Num = !empty($arg['status_Num']) ? $arg['status_Num'] : 1;
        
        //建立PicObjList物件
        check_comma_array($picids_Str, $picids_Arr);
        $pic_PicObjList = $this->load->model('ObjList', nrnum());
        $pic_PicObjList->construct_db(array(
            'db_where_or_Arr' => array(
                'picid_Num' => $picids_Arr
            ),
            'db_from_Str' => 'pic',
            'model_name_Str' => 'PicObj',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        //建立UserGroupList物件
        check_comma_array($groupids_Str, $groupids_Arr);
        $group_UserGroupList = new ObjList();
        $group_UserGroupList->construct_db(array(
            'db_where_or_Arr' => array(
                'groupid_Num' => $groupids_Arr
            ),
            'model_name_Str' => 'UserGroup',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));

        //建立DateTime物件
        $updatetime_DateTime = new DateTimeObj();
        $updatetime_DateTime->construct(array(
            'datetime_Str' => $updatetime_Str,
            'inputtime_date_Str' => $updatetime_inputtime_date_Str,
            'inputtime_time_Str' => $updatetime_inputtime_time_Str
        ));
        
        //將建構方法所計算出的值存入此類別之屬性
        $this->uid_Num = $uid_Num;
        $this->username_Str = $username_Str;
        $this->email_Str = $email_Str;
        $this->pic_PicObjList = $pic_PicObjList;
        $this->group_UserGroupList = $group_UserGroupList;
        $this->updatetime_DateTime = $updatetime_DateTime;
        $this->status_Num = $status_Num;
        
        return TRUE;
    }

    public function register($arg)
    {
        $email_Str = !empty($arg['email_Str']) ? $arg['email_Str'] : '';
        $password_Str = !empty($arg['password_Str']) ? $arg['password_Str'] : '';
        $password2_Str = !empty($arg['password2_Str']) ? $arg['password2_Str'] : '';

        if($password_Str !== $password2_Str)
        {
            return 'Please enter the password twice to confirm agreement';
        }

        if(!preg_match("/^([0-9A-Za-z]+)$/", $password_Str))
        {
            return 'Please enter a password consisting of letters and numbers';
        }

        if(strlen($password_Str) < 8 || strlen($password_Str) > 16)
        {
            return 'Please enter a password of 8-16 characters';
        }

        if(!preg_match('/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/', $email_Str))
        {
            return 'Please enter a valid email format';
        }

        $email_Arr = explode('@', $email_Str);
        if(!checkdnsrr($email_Arr[1], 'MX'))
        {
            return 'Please enter the correct domain';
        }
        
        $this->db->from('user_verification');
        $this->db->where(array('email' => $email_Str));
        $query = $this->db->get();
            
        if($query->num_rows() > 0)
        {
            return 'This account has been registered';
        }

        $password_salt_Str = substr(md5(rand(32767, 65534) + $this->config->item('timenow')), 0, 6);
        $password_md5_Str = $this->md5_password($password_Str, $password_salt_Str);

        $updatetime_DateTimeObj = new DateTimeObj();
        $updatetime_DateTimeObj->construct(array());

        $uid_Num = db_search_max(array(
            'table_name' => 'user',
            'id_name' => 'uid'
        )) + 1;

        $this->db->insert('user_verification', array(
            'uid' => $uid_Num,
            'email' => $email_Str,
            'password' => $password_md5_Str,
            'password_salt' => $password_salt_Str,
            'password_key' => $password_Str,
        ));

        $this->db->insert('user', array(
            'uid' => $uid_Num,
            'email' => $email_Str,
            'username' => $email_Str,
            'groupids' => '100',
            'picids' => '',
            'updatetime' => $updatetime_DateTimeObj->datetime_Str,
            'status' => 1
        ));

        $this->login(array('email_Str' => $email_Str, 'password_Str' => $password_Str));

        return TRUE;
    }
	
	public function login($arg)
    {
	
		$email_Str = !empty($arg['email_Str']) ? $arg['email_Str'] : '';
        $password_Str = !empty($arg['password_Str']) ? $arg['password_Str'] : '';

        $this->db->from('user_verification');
        $this->db->where(array('email' => $email_Str));
        $query = $this->db->get();
        $user_test_Arr = $query->result_array();

        if(!empty($user_test_Arr))
        {
            $password_Str = $this->md5_password($password_Str, $user_test_Arr[0]['password_salt']);
        }
        else
        {
            return '這個電子郵件尚未註冊，請先註冊帳號';
        }
		
		$this->db->from('user_verification');
		$this->db->where(array('email' => $email_Str, 'password' => $password_Str));
		$query = $this->db->get();
			
		if($query->num_rows() > 0)
		{
			$user = $query->result_array();
			$newdata = array(
				'uid'  => $user[0]['uid']
			);
			$this->session->set_userdata($newdata);
			return TRUE;
		}
        else
		{
			return '請輸入正確的密碼';
		}
		
	}

    public function email_reset_password($arg)
    {
        $password_Str = !empty($arg['password_Str']) ? $arg['password_Str'] : '';
        $password2_Str = !empty($arg['password2_Str']) ? $arg['password2_Str'] : '';
        $change_email_key_Str = !empty($arg['change_email_key_Str']) ? $arg['change_email_key_Str'] : '';

        $email_Str = $this->email_Str;

        $this->db->from('user_verification');
        $this->db->where(array('email' => $email_Str, 'change_email_key' => $change_email_key_Str));
        $this->db->where('change_email_updatetime >', 'DATE_ADD(NOW(), INTERVAL -1 HOUR)', FALSE);
        $query = $this->db->get();
        $user_test_Arr = $query->result_array();

        if(!empty($user_test_Arr[0]['change_email_key']) && $user_test_Arr[0]['change_email_key'] === $change_email_key_Str)
        {
            $return_message_Str = $this->change_password([
                'password_Str' => $password_Str,
                'password2_Str' => $password2_Str
            ]);

            $this->db->where('email', $email_Str);
            $this->db->update('user_verification', array(
                'change_email_key' => NULL,
                'change_email_updatetime' => NULL
            ));

            return $return_message_Str;
        }
        else
        {
            return '信箱驗證碼填寫錯誤，請從信箱輸入正確的驗證碼，若驗證碼已經超過一個小時的有效期限，請重新申請信箱驗證碼';
        }

    }

    public function change_password($arg)
    {
        $password_Str = !empty($arg['password_Str']) ? $arg['password_Str'] : '';
        $password2_Str = !empty($arg['password2_Str']) ? $arg['password2_Str'] : '';

        if($password_Str !== $password2_Str)
        {
            return 'Please enter the password twice to confirm agreement';
        }

        if(!preg_match("/^([0-9A-Za-z]+)$/", $password_Str))
        {
            return 'Please enter a password consisting of letters and numbers';
        }

        if(strlen($password_Str) < 8 || strlen($password_Str) > 16)
        {
            return 'Please enter a password of 8-16 characters';
        }

        $password_salt_Str = substr(md5(rand(32767, 65534) + $this->config->item('timenow')), 0, 6);
        $password_md5_Str = $this->md5_password($password_Str, $password_salt_Str);

        $this->db->where('uid', $this->uid_Num);
        $this->db->update('user_verification', array(
            'password' => $password_md5_Str,
            'password_salt' => $password_salt_Str
        ));

        $this->db->where('uid', $this->uid_Num);
        $this->db->update('user_verification', array('password_key' => $password_Str));

        return TRUE;
    }

    public function send_change_password_email()
    {
        $email_Str = $this->email_Str;

        $this->db->from('user_verification');
        $this->db->where(array('email' => $email_Str));
        $query = $this->db->get();
        $user_test_Arr = $query->result_array();

        if(empty($user_test_Arr[0]['uid']))
        {
            return '沒有這個email帳號，請輸入正確的email帳號';
        }

        $this->db->from('user_verification');
        $this->db->where('email', $email_Str);
        $this->db->where('change_email_updatetime >', 'DATE_ADD(NOW(), INTERVAL -1 HOUR)', FALSE);
        $query = $this->db->get();
        $user_Arr = $query->result_array();

        if(!empty($user_Arr[0]['uid']))
        {
            return '這個帳號在一個小時內已經寄出過重設密碼的請求，請檢查信箱內的重設密碼信件，或於一個小時後再重新嘗試';
        }

        $change_email_key_Str = strtoupper(substr(md5(rand(32767, 65534) + $this->config->item('timenow')), 0, 6));
        $change_email_DateTimeObj = new DateTimeObj();
        $change_email_DateTimeObj->construct([]);

        $this->db->where('email', $email_Str);
        $this->db->update('user_verification', array(
            'change_email_key' => $change_email_key_Str,
            'change_email_updatetime' => $change_email_DateTimeObj->datetime_Str
        ));

        $this->db->from('user');
        $this->db->where('email', $email_Str);
        $query = $this->db->get();
        $user_Arr = $query->result_array();

        $website_name_Str = 'fanswoo';
        $name_Str = 'fanswoo';
        $title_Str = $website_name_Str.' - 密碼變更通知';
        $message_Str = $user_Arr[0]['username'].'您好：<br><br>我們收到您於'.$website_name_Str.'申請的密碼變更通知，特地發送信件予您通知<br>您可以點選以下網址並填寫信箱驗證碼，以便修改您的新密碼<br><br>信箱驗證碼：'.$change_email_key_Str.'<br>密碼變更位置：<br>'.'http://'.$_SERVER['HTTP_HOST'].base_url('/user/resetpsw/?').'email='.$email_Str.'&change_email_key='.$change_email_key_Str.'<br><br>若您未申請密碼變更，請直接忽略此郵件即可<br><br>'.date('Y-m-d H:i:s');

        $Mailer = new Mailer;
        $return_message_Str = $Mailer->sendmail($email_Str, $name_Str, $title_Str, $message_Str);
        if($return_message_Str === TRUE)
        {
            return TRUE;
        }
        else
        {
            return $return_message_Str;
        }

    }

    private function md5_password($arg1, $arg2 = '')
    {
        $password_Str = $arg1;
        $password_salt_Str = $arg2;
        $md5_password_Str = md5(md5($password_Str).$password_salt_Str);

        return $md5_password_Str;
    }
	
}