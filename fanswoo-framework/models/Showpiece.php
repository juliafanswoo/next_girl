<?php

class Showpiece extends ObjDbBase
{

    public $showpieceid_Num = 0;
    public $uid_Num = 0;
    public $name_Str = '';
    public $pic_PicObjList;//照片類別列表
    public $mainpic_PicObjList;//照片類別列表
    public $content_Html = '';//網頁語言類別
    public $content_specification_Html = '';//網頁語言類別
    public $synopsis_Str = '';
    public $price_Num = 0;
    public $class_ClassMetaList;//分類標籤類別列表
    public $prioritynum_Num = 0;
    public $updatetime_DateTime;
    public $status_Num = 1;
    public $db_name_Str = 'showpiece';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'showpieceid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'showpieceid' => 'showpieceid_Num',
        'uid' => 'uid_Num',
        'name' => 'name_Str',
        'price' => 'price_Num',
        'synopsis' => 'synopsis_Str',
        'picids' => array('pic_PicObjList', 'uniqueids_Str'),
        'mainpicids' => array('mainpic_PicObjList', 'uniqueids_Str'),
        'classids' => array('class_ClassMetaList', 'uniqueids_Str'),
        'content' => 'content_Html',
        'content_specification' => 'content_specification_Html',
        'prioritynum' => 'prioritynum_Num',
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['showpieceid_Num', 'uid_Num', 'name_Str', 'picids_Str', 'picids_Arr', 'mainpicids_Str', 'mainpicids_Arr', 'content_Str', 'content_specification_Str', 'synopsis_Str', 'price_Num', 'classids_Str', 'classids_Arr', 'prioritynum_Num', 'updatetime_Str', 'updatetime_inputtime_date_Str', 'updatetime_inputtime_time_Str', 'status_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        //將引數設為物件屬性，或將引數作為物件型屬性的建構值
        $this->set('showpieceid_Num', $showpieceid_Num);
        $this->set('name_Str', $name_Str);
        $this->set('content_Html', $content_Str);
        $this->set('content_specification_Html', $content_specification_Str);
        $this->set('synopsis_Str', $synopsis_Str);
        $this->set('price_Num', $price_Num);
        $this->set('prioritynum_Num', $prioritynum_Num);
        $this->set('status_Num', $status_Num);
        $this->set('class_ClassMetaList', [
            'classids_Str' => $classids_Str,
            'classids_Arr' => $classids_Arr
        ], 'ClassMetaList');
        $this->set('updatetime_DateTime', [
            'datetime_Str' => $updatetime_Str,
            'inputtime_date_Str' => $updatetime_inputtime_date_Str,
            'inputtime_time_Str' => $updatetime_inputtime_time_Str
        ], 'DateTimeObj');
        $this->set('pic_PicObjList', [
            'picids_Str' => $picids_Str,
            'picids_Arr' => $picids_Arr
        ], 'PicObjList');
        $this->set('mainpic_PicObjList', [
            'picids_Str' => $mainpicids_Str,
            'picids_Arr' => $mainpicids_Arr
        ], 'PicObjList');
        $this->set__uid_Num(['uid_Num' => $uid_Num]);
        
        return TRUE;
    }

    public function set__uid_Num($arg)
    {
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['uid_Num']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];

        //若uid為空則以登入者uid作為本物件之預設uid
        if(empty($uid_Num) || empty($uid_Num))
        {
            $data['user'] = get_user();
            $uid_Num = $data['user']['uid'];
        }

        $this->uid_Num = $uid_Num;
    }
    
}