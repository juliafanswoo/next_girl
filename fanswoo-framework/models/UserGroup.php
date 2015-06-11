<?php

class UserGroup extends ObjDbBase {

    public $groupid_Num = 0;
    public $groupname_Str = '';
    public $status_Num = 1;
    public $db_name_Str = 'user_group';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'groupid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'groupid' => 'groupid_Num',
        'groupname' => 'groupname_Str',
        'status' => 'status_Num'
    );
    
    public function construct($arg)
    {
            
        $groupid_Num = !empty($arg['groupid_Num']) ? $arg['groupid_Num'] : 0;
        $groupname_Str = !empty($arg['groupname_Str']) ? $arg['groupname_Str'] : '';
        $status_Num = !empty($arg['status_Num']) ? $arg['status_Num'] : 1;
        
        //set
        $this->groupid_Num = $groupid_Num;
        $this->groupname_Str = $groupname_Str;
        $this->status_Num = $status_Num;
        
        return TRUE;
    }
    
}