<?php

class ProductShop extends ObjDbBase
{

    public $productid_Num = 0;
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
    public $db_name_Str = 'shop_product';//填寫物件聯繫資料庫之名稱
    public $db_uniqueid_Str = 'productid';//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'productid' => 'productid_Num',
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
        
        //取得引數
        $productid_Num = !empty($arg['productid_Num']) ? $arg['productid_Num'] : 0;
        $uid_Num = !empty($arg['uid_Num']) ? $arg['uid_Num'] : 0;
        $name_Str = !empty($arg['name_Str']) ? $arg['name_Str'] : '';
        $picids_Str = !empty($arg['picids_Str']) ? $arg['picids_Str'] : '';
        $picids_Arr = !empty($arg['picids_Arr']) ? $arg['picids_Arr'] : array();
        $mainpicids_Str = !empty($arg['mainpicids_Str']) ? $arg['mainpicids_Str'] : '';
        $mainpicids_Arr = !empty($arg['mainpicids_Arr']) ? $arg['mainpicids_Arr'] : array();
        $content_Str = !empty($arg['content_Str']) ? $arg['content_Str'] : '' ;
        $content_specification_Str = !empty($arg['content_specification_Str']) ? $arg['content_specification_Str'] : '' ;
        $synopsis_Str = !empty($arg['synopsis_Str']) ? $arg['synopsis_Str'] : '' ;
        $price_Num = !empty($arg['price_Num']) ? $arg['price_Num'] : 0 ;
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
        check_comma_array($mainpicids_Str, $mainpicids_Arr);
        $mainpic_PicObjList = $this->load->model('ObjList', nrnum());
        $mainpic_PicObjList->construct_db(array(
            'db_where_or_Arr' => array(
                'picid_Num' => $mainpicids_Arr
            ),
            'db_from_Str' => 'pic',
            'model_name_Str' => 'PicObj',
            'limitstart_Num' => 0,
            'limitcount_Num' => 100
        ));
        
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
        
        //建立ClassMetaList物件
        check_comma_array($classids_Str, $classids_Arr);
        $class_ClassMetaList = $this->load->model('ObjList', nrnum());
        $class_ClassMetaList->construct_db(array(
            'db_where_or_Arr' => array(
                'classid_Num' => $classids_Arr
            ),
            'model_name_Str' => 'ClassMeta',
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
        $content_specification_Html = $content_specification_Str;
        
        //將建構方法所計算出的值存入此類別之屬性
        $this->productid_Num = $productid_Num;
        $this->name_Str = $name_Str;
        $this->pic_PicObjList = $pic_PicObjList;
        $this->mainpic_PicObjList = $mainpic_PicObjList;
        $this->uid_Num = $uid_Num;
        $this->content_Html = $content_Html;
        $this->content_specification_Html = $content_specification_Html;
        $this->synopsis_Str = $synopsis_Str;
        $this->price_Num = $price_Num;
        $this->class_ClassMetaList = $class_ClassMetaList;
        $this->prioritynum_Num = $prioritynum_Num;
        $this->updatetime_DateTime = $updatetime_DateTime;
        $this->status_Num = $status_Num;
        
        return TRUE;
    }
	
}