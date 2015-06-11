<?php

class UserFieldShop extends User {

    public $receive_name_Str = '';
    public $receive_phone_Str = '';
    public $receive_address_Str = '';
    public $db_name_Arr = array('user', 'user_field_shop');//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'uid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'uid' => 'uid_Num',
        'user.username' => 'username_Str',
        'user.email' => 'email_Str',
        'user.picids' => array('pic_PicObjList', 'uniqueids_Str'),
        'user.groupids' => array('group_UserGroupList', 'uniqueids_Str'),
        'user.updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'user.status' => 'status_Num',
        'user_field_shop.receive_name' => 'receive_name_Str',
        'user_field_shop.receive_phone' => 'receive_phone_Str',
        'user_field_shop.receive_address' => 'receive_address_Str',
    );
	
	public function construct($arg)
	{
        parent::construct($arg);

        $receive_name_Str = !empty($arg['receive_name_Str']) ? $arg['receive_name_Str'] : '';
        $receive_phone_Str = !empty($arg['receive_phone_Str']) ? $arg['receive_phone_Str'] : '';
        $receive_address_Str = !empty($arg['receive_address_Str']) ? $arg['receive_address_Str'] : '';

        $this->receive_name_Str = $receive_name_Str;
        $this->receive_phone_Str = $receive_phone_Str;
        $this->receive_address_Str = $receive_address_Str;
    }
	
}