<?php

class Advertising extends ObjDbBase
{

    public $advertisingid_Num = 0;
    public $uid_Num = 0;
    public $title_Str = '';
    public $pic_PicObjList;//照片類別列表
    public $content_Html = '';//網頁語言類別
    public $href_Str = '';
    public $class_AdvertisingClassList;//分類標籤類別列表
    public $prioritynum_Num = 0;
    public $updatetime_DateTime;
    public $status_Num = 1;
    public $db_name_Str = 'advertising';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'advertisingid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'advertisingid' => 'advertisingid_Num',
        'uid' => 'uid_Num',
        'title' => 'title_Str',
        'href' => 'href_Str',
        'picids' => array('pic_PicObjList', 'uniqueids_Str'),
        'classids' => array('class_AdvertisingClassList', 'uniqueids_Str'),
        'content' => 'content_Html',
        'prioritynum' => 'prioritynum_Num',
        'updatetime' => array('updatetime_DateTime', 'datetime_Str'),
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        
        //取得引數
        $advertisingid_Num = !empty($arg['advertisingid_Num']) ? $arg['advertisingid_Num'] : 0;
        $uid_Num = !empty($arg['uid_Num']) ? $arg['uid_Num'] : 0;
        $title_Str = !empty($arg['title_Str']) ? $arg['title_Str'] : '';
        $picids_Str = !empty($arg['picids_Str']) ? $arg['picids_Str'] : '';
        $picids_Arr = !empty($arg['picids_Arr']) ? $arg['picids_Arr'] : array();
        $href_Str = !empty($arg['href_Str']) ? $arg['href_Str'] : '';
        $content_Str = !empty($arg['content_Str']) ? $arg['content_Str'] : '' ;
        $classids_Str = !empty($arg['classids_Str']) ? $arg['classids_Str'] : '';
        $classids_Arr = !empty($arg['classids_Arr']) ? $arg['classids_Arr'] : array();
        $prioritynum_Num = !empty($arg['prioritynum_Num']) ? $arg['prioritynum_Num'] : 0;
        $updatetime_Str = !empty($arg['updatetime_Str']) ? $arg['updatetime_Str'] : '';
        $updatetime_inputtime_date_Str = !empty($arg['updatetime_inputtime_date_Str']) ? $arg['updatetime_inputtime_date_Str'] : '';
        $updatetime_inputtime_time_Str = !empty($arg['updatetime_inputtime_time_Str']) ? $arg['updatetime_inputtime_time_Str'] : '';
        $status_Num = !empty($arg['status_Num']) ? $arg['status_Num'] : 1;
        
        //若uid為空則以登入者uid作為本物件之預設uid
        if(empty($uid_Num) || empty($uid_Num))
        {
            $data['user'] = get_user();
            $uid_Num = $data['user']['uid'];
        }
        
        //建立PicObjList物件
        check_comma_array($picids_Str, $picids_Arr);
        $pic_PicObjList = new ObjList();
        $pic_PicObjList->construct_db(array(
            'db_where_or_Arr' => array(
                'picid_Num' => $picids_Arr
            ),
            'db_from_Str' => 'pic',
            'model_name_Str' => 'PicObj',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
        //建立ClassMetaList物件
        check_comma_array($classids_Str, $classids_Arr);
        $class_AdvertisingClassList = new ObjList();
        $class_AdvertisingClassList->construct_db(array(
            'db_where_or_Arr' => array(
                'classid_Num' => $classids_Arr
            ),
            'model_name_Str' => 'AdvertisingClass',
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
        
        //HTML值運算
        $content_Html = $content_Str;
        
        //將建構方法所計算出的值存入此類別之屬性
        $this->advertisingid_Num = $advertisingid_Num;
        $this->title_Str = $title_Str;
        $this->href_Str = $href_Str;
        $this->pic_PicObjList = $pic_PicObjList;
        $this->uid_Num = $uid_Num;
        $this->content_Html = $content_Html;
        $this->class_AdvertisingClassList = $class_AdvertisingClassList;
        $this->prioritynum_Num = $prioritynum_Num;
        $this->updatetime_DateTime = $updatetime_DateTime;
        $this->status_Num = $status_Num;
        
        return TRUE;
    }
	
}