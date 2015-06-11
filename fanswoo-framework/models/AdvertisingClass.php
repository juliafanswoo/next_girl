<?php

class AdvertisingClass extends ObjDbBase {

    public $classid_Num = 0;
    public $classname_Str = '';
    public $status_Num = 1;
    public $db_name_Str = 'advertising_class';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'classid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'classid' => 'classid_Num',
        'classname' => 'classname_Str',
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
            
        $classid_Num = !empty($arg['classid_Num']) ? $arg['classid_Num'] : 0;
        $classname_Str = !empty($arg['classname_Str']) ? $arg['classname_Str'] : '';
        $status_Num = !empty($arg['status_Num']) ? $arg['status_Num'] : 1;
        
        //set
        $this->classid_Num = $classid_Num;
        $this->classname_Str = $classname_Str;
        $this->status_Num = $status_Num;
        
        return TRUE;
    }
    
}